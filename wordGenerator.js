const connectors = ['bythe', 'about', 'atthe', 'likethe', 'of', 'onto', 'on', 'to', 'with', 'withthe', 'like', 'by', 'outof']
const starters = ['after', 'because', 'before', 'if', 'and', 'till', 'when', '100', '101']
const enders = ['me', 'we', 'us', 'you', 'she', 'her', 'he', 'him', 'it', 'they', 'them']

var keywords = []


function processInput(){

  // Get a price range

  const keywordsString = document.getElementById("keywords").value

  keywords = keywordsString.split(" ");
  var index = 0
  var relatedWords = []

  keywords.forEach((word) => {
    fetchFromAPI("https://api.datamuse.com/words?rel_jja=" + word, function(response){
      relatedWords.push(...response);
      index++;
      if (index === keywords.length){
        //Collected all related words from keywords, store them in "domainWords"
        handleRelatedWords(relatedWords);
      }
    }); // site that doesn’t send Access-Control-*
  });

}

function fetchFromAPI(url, callback){
  fetch(url) 
  .then(response => response.text())
  .then(response => {
    return callback(getWords(JSON.parse(response)));
  })
  .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"));
  return null;
}

function getWords(words){
  retVal = [];
  var i = 0;
  while (i < 20 && i != words.length){
    retVal.push(words[i]["word"])
    i++;
  }
  return retVal;
}

function sendDomains(domainNames){
  var jsonString = JSON.stringify(domainNames)
  $.ajax({
    url: "gdapi.php",
    type: "post",
    data: {words: jsonString},
    success: function(res){
      //Here you could organize the response from godaddy api
      document.getElementById("results").innerHTML = res
    }
  });
}

///////////////////////////////////////////
//    MARK::Domain creating function     //
///////////////////////////////////////////

function handleRelatedWords(relatedWords){
  var domains = [];

  // for (var i = 0; i < 60; i++){ 
  //   var name = ""
  //   switch(rand(10)){
  //     case 0:
  //       name = keywords[rand(keywords.length)] + relatedWords[rand(relatedWords.length)]
  //       break;
  //     case 1:
  //       name = relatedWords[rand(relatedWords.length)] + keywords[rand(keywords.length)]
  //       break;
  //     case 2:
  //       name = relatedWords[rand(relatedWords.length)] + preps[rand(preps.length)] + keywords[rand(keywords.length)]
  //       break;
  //   }
  //   domains.push(name);
  // }

  

  //RANDOM INSERTION

  while (domains.length < 60){
    if (relatedWords.length === 1){
      domains = relatedWords[0];
      break;
    }

    domains.push(relatedWords[rand(relatedWords.length)] + relatedWords[rand(relatedWords.length)])
  }


  sendDomains(domains)
}

function rand(max) {
  return Math.floor(Math.random() * Math.floor(max));
}
