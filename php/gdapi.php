<?php

  include 'datamuse.php';

  //Data
  $words = $_POST['words'];
  $urls = getDomains(getRelatedWords($words), $words);


  if (isset($urls)){

      // set your key and secret
    $headers = array(
      'Authorization: sso-key dLPB7Gvs6tAy_TM1r2bdjX3bFub1vUywXcZ:updUkdTKDzbQxm2oQvcbT',
      'Content-Type: application/json',
      'Accept: application/json'
    );


    $godaddyurl = "https://api.godaddy.com/v1/domains/available?checkType=FAST";

    // // open connection
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $godaddyurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); //Can be post, put, delete, etc.
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($urls));

    $result = curl_exec($ch);
    $dn = json_decode($result, true);
    $info = $dn['domains'];
    $domains = [];

    //filter the results you want

    for ($i = 0; $i <= 80 || $i == sizeof($urls); $i++){
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
