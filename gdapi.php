<?php

    // set your key and secret
  $headers = array(
    'Authorization: sso-key dLPB7Gvs6tAy_No57peq2oDmwz9sYR67x6U:No5y5a62Eukd2tzKJCHaC8',
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
    print_r($dn['domains']);

    
    // for ($i = 0; $i <= 10; $i++){
    //   $name = $wordsArray[$i];
    //   $com = '.com';
    //   $domain = $name.$com;    // see GoDaddy API documentation - https://developer.godaddy.com/doc
    //   $url = "https://api.godaddy.com/v1/domains/available?domain=".$domain;
    //   curl_setopt($ch, CURLOPT_URL, $url);
    //   $result = curl_exec($ch);

    //   $dn = json_decode($result, true);

    //   //Make sure that the price is low, and the domain is available

    //   if ($dn['price'] <= 11990000 && $dn['available'] == 1){
    //     echo '<pre>';
    //     print_r($dn);
    //     echo '</pre>';
    //   }
    //}

    curl_close($ch);

  } else{
    echo "NULL DATA";
  }

?>