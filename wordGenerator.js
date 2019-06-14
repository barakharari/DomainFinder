const connectors = ['atthe', 'likethe', 'likeits', 'it', 'of', 'onto', 'on', 'to', 'outof', 'with', 'withthe', 'like', 'by', 'outof', 'but', 'also', 'so', 'and', 'asif', 'unlike', '', '', '']
const starters = ['the', 'this', 'do', 'make', 'if', 'we', 'some', 'another', 'favorite', 'prefer', 'first', 'next', 'soon', 'finally', 'when', '100', '101', '', '', '']
const enders = ['shop', 'store', 'buy', '', '']

var keywords = ['']


function validate() {
  var returnMessage;
  input = document.getElementById("keywords").value;

  var onlyThreeWords = /^(?:\w+\W+){0,1}(?:\w+)$/.test(input);
  var noNumbers = /(?:[\d]+ ){0,2}[\d]+/.test(input);
  var noSpecialChars = /\/\W|_/g.test(input);

  if (onlyThreeWords === true && noNumbers === false && noSpecialChars === false) {
    document.getElementById("returnMessage").style.color = "MediumSeaGreen";
    returnMessage = "Input valid"
    processInput(input)
  } else {
    document.getElementById("returnMessage").style.color = "red";
    returnMessage = "Input invalid: please make sure you are meeting the input conditions";
  }
  document.getElementById("returnMessage").innerHTML = returnMessage;
}


function processInput(input){

  // Get a price range

  keywords = input.split(" ");
  var index = 0
  var relatedWords = []

  keywords.forEach((word) => {
    dataMuseAPI("https://api.datamuse.com/words?rel_jja=" + word, function(response){
      relatedWords.push(...response);
      index++;
      if (index === keywords.length){
        //Collected all related words from keywords, store them in "domainWords"
        handleRelatedWords(relatedWords);
      }
    }); 
  });

}

function dataMuseAPI(url, callback){
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

  while (i < 15 && i != words.length){
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

  //RANDOM INSERTION

  while (domains.length < 120){
    var word;
    switch(rand(6)){
      case 0:
        word = starters[rand(starters.length)] + keywords[rand(keywords.length)] + connectors[rand(connectors.length)] + relatedWords[rand(relatedWords.length)];
        break;
      case 1:
      word = keywords[rand(keywords.length)] + connectors[rand(connectors.length)] + relatedWords[rand(relatedWords.length)] + enders[rand(enders.length)];
        break;
      case 2:
      word = starters[rand(starters.length)] + relatedWords[rand(relatedWords.length)] + connectors[rand(connectors.length)] + keywords[rand(keywords.length)];
        break;
      case 3:
      word = relatedWords[rand(relatedWords.length)] + connectors[rand(connectors.length)] + keywords[rand(keywords.length)];
        break;
      case 4:
      word = relatedWords[rand(relatedWords.length)] + keywords[rand(keywords.length)];
      break;
      case 5:
      word = keywords[rand(keywords.length)] + relatedWords[rand(relatedWords.length)];
      break;
    }
    domains.push(word + '.com')
  }

  // console.log(domains)

  //Send the domains to the PHP script
  sendDomains(domains)
}

function rand(max) {
  return Math.floor(Math.random() * Math.floor(max));
}
