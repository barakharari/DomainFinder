<?php

  function getDomains($relatedWords, $keywords){

    $domains = array();

    $connectors = array("atthe", "likethe", "likeits", "it", "of", "onto", "on", "to", "outof", "with", "withthe", "like", "by", "outof", "but", "also", "so", "and", "unlike");
    $starters = array("the", "this", "do", "make", "if", "we", "some", "another", "favorite", "prefer", "first", "next", "soon", "finally", "when", "100", "101", "", "", "");
    $enders = array("shop", "store", "buy", "", "");

    $s = sizeof($starters);
    $k = sizeof($keywords);
    $c = sizeof($connectors);
    $r = sizeof($relatedWords);
    $e = sizeof($enders);

    //RANDOM INSERTION
    while (sizeof($domains) < 120){
      $word = "";
      switch(rand(0,5)){
        case 0:
          $word = $starters[rand(0, $s)] . $keywords[rand(0, $k)] . $connectors[rand(0, $c)] . $relatedWords[rand(0, $r)];
          break;
        case 1:
          $word = $keywords[rand(0, $k)] . $connectors[rand(0, $c)] . $relatedWords[rand(0, $r)] . $enders[rand(0, $e)];
          break;
        case 2:
          $word = $starters[rand(0, $s)] . $relatedWords[rand(0, $r)] . $connectors[rand(0, $c)] . $keywords[rand(0, $k)];
          break;
        case 3:
          $word = $relatedWords[rand(0, $r)] . $connectors[rand(0, $c)] . $keywords[rand(0, $k)];
          break;
        case 4:
          $word = $relatedWords[rand(0, $r)] . $keywords[rand(0, $k)];
        break;
        case 5:
          $word = $keywords[rand(0, $k)] . $relatedWords[rand(0, $r)];
        break;
      }
      array_push($domains, $word . ".com");
    }
    return $domains;
  }

  function getRelatedWords($keywords){

    $ch = curl_init();

    $headers = array(
      "Content-Type: application/json",
      "Accept: application/json"
    );

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $rw = array();

    for ($i=0; $i<=sizeof($keywords); $i++){
      $url = "https://api.datamuse.com/words?rel_jja=" . $keywords[$i];
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);
      $words = json_decode($result);
      foreach ($words as $word){
        array_push($rw, $word->word);
      }
    }

    return $rw;

  }

?>
