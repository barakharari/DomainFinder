<?php

  include 'datamuse.php';

  //Data
  $words = $_POST['words'];
  $urls = getDomains(getRelatedWords($words), $words);

  $domains = [];

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

  $numUrls = 0;
  $u = sizeof($urls);

  for ($k = 0; $k < $u - $u/10; $k+= $u/10){

    if ($numUrls >= 100){break;}

    $currentURLs = array_slice($urls, $k, $k + $u/10);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($currentURLs));

    $result = curl_exec($ch);
    $dn = json_decode($result, true);
    $info = $dn['domains'];

    //filter the results you want

    for ($j=0; $j < sizeof($currentURLs); $j++){
      if ($info[$j]['available'] == 1){
        $obj = new stdClass();
        $obj->name = $info[$j]['domain'];
        $obj->price = $info[$j]['price'];
        array_push($domains, $obj);
        $numUrls++;
      }
    }
  }

  echo json_encode($domains);
  curl_close($ch);

?>
