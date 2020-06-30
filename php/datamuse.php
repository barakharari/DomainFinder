<?php

  function getDomains($relatedWords, $keywords){

    $domains = array();

    $conjunctions = array("for", "and", "nor", "but", "or", "so");
    $adjectives = array("good", "new", "first", "last", "long", "great", "little", "own", "old", "right", "big", "high", "different", "small", "large", "next", "early", "young", "important", "quick");
    $adverbs = array("not", "very", "always", "together", "simply");
    $prepositions = array("above", "against", "along", "among", "around", "towards", "of", "in", "into", "near", "at");

    $a = sizeof($adjectives);
    $k = sizeof($keywords);
    $c = sizeof($conjunctions);
    $r = sizeof($relatedWords);
    $ad = sizeof($adverbs);
    $p = sizeof($prepositions);

    //RANDOM INSERTION
    while (sizeof($domains) < 5000){
      $word = "";
      $test = 6;
      switch(rand(0,6)){
        case 0:
          $word = $relatedWords[rand(0, $r)] . $conjunctions[rand(0,$c)] . $keywords[rand(0, $k)];
          break;
        case 1:
          $word = $keywords[rand(0, $k)] . $conjunctions[rand(0,$c)] . $relatedWords[rand(0, $r)];
          break;
        case 2:
          $word = $keywords[rand(0, $k)] . $relatedWords[rand(0, $r)];
          break;
        case 3:
          $word = $adverbs[rand(0, $ad)] . $adjectives[rand(0, $a)] . $keywords[rand(0, $k)];
          break;
        case 4:
          $word = $adjectives[rand(0,$a)] . $keywords[rand(0, $k)];
          break;
        case 5:
          $word = $keywords[rand(0, $k)] . $relatedWords[rand(0, $r)];
          break;
        case 6:
          $word = $keywords[rand(0, $k)] . $prepositions[rand(0, $p)] . $relatedWords[rand(0, $r)];
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
      $url = "https://api.datamuse.com/words?rel_trg=" . $keywords[$i];
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
