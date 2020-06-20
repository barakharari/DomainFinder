<?php


    // set your key and secret
  $headers = array(
    'Authorization: sso-key dLPB7Gvs6tAy_TM1r2bdjX3bFub1vUywXcZ:updUkdTKDzbQxm2oQvcbT',
    'Content-Type: application/json',
    'Accept: application/json'
  );

  //Data
  $words = $_POST['words'];


  if (isset($words)){

    $url = "https://api.godaddy.com/v1/domains/available?checkType=FAST";

    // // open connection
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); //Can be post, put, delete, etc.
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $words);

    $result = curl_exec($ch);
    $dn = json_decode($result, true);
    $info = $dn['domains'];
    $domains = [];

    //filter the results you want

    for ($i = 0; $i <= 60 || $i == sizeof(array($words)); $i++){
      if ($info[$i]['available'] == 1){
        $obj = new stdClass();
        $obj->name = $info[$i]['domain'];
        $obj->price = $info[$i]['price'];
        array_push($domains, $obj);
      }
    }

    echo json_encode($domains);

    curl_close($ch);

  } else{
    echo "NULL DATA";
  }

?>
