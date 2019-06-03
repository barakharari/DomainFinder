<?php

    // set your key and secret
  $header = array(
    'Authorization: sso-key dLPB7Gvs6tAy_No57peq2oDmwz9sYR67x6U:No5y5a62Eukd2tzKJCHaC8'
  );
  // open connection
  $ch = curl_init();
  $timeout=$_POST["querysize"];
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); 
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); //Can be post, put, delete, etc.
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

  // echo $dn['domain'];

  //Data
  $words = $_POST['words'];

  if (isset($words)){
    $wordsArray = json_decode($words, true);
    echo 'Data: ';
    for ($i = 0; $i <= sizeof($wordsArray); $i++){
      $name = $wordsArray[$i];
      $com = '.com';
      $domain = $name.$com;    // see GoDaddy API documentation - https://developer.godaddy.com/doc
      $url = "https://api.godaddy.com/v1/domains/available?domain=".$domain;
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);

      $dn = json_decode($result, true);

      //Make sure that the price is low, and the domain is available

      if ($dn['price'] <= 11990000 && $dn['available'] == 1){
        echo '<pre>';
        print_r($dn);
        echo '</pre>';
      }

    }
    curl_close($ch);

  } else{
    echo "NULL DATA";
  }

?>