const preps = ['by', 'about', 'at', 'like', 'of', 'on', 'to', 'with']
const conj = ['after', 'because', 'before', 'if', 'and', 'till', 'when']
const pronouns = ['I', 'me', 'we', 'us', 'you', 'she', 'her', 'he', 'him', 'it', 'they', 'them']
const nums = ['100', '101']

function processInput(){
  const keywordsString = document.getElementById("keywords").value
  const querySizeString = document.getElementById("querySize").value

  var keywords = keywordsString.split(" ");
  var relatedWords = []
  var index = 0

  keywords.forEach((word) => {
    fetchFromAPI("https://api.datamuse.com/words?rel_jja=" + word, function(response){
      relatedWords.push(response);
      index++;
      if (index === keywords.length){
        //Collected all related words from keywords, store them in "domainWords"
        handleRelatedWords(relatedWords);
      }
    }); // site that doesn’t send Access-Control-*
  });

}

function fetchFromAPI(url, callback){
  const proxyurl = "https://cors-anywhere.herokuapp.com/";
  fetch(proxyurl + url) // https://cors-anywhere.herokuapp.com/https://example.com
  .then(response => response.text())
  .then(contents => {
    return callback(getWords(JSON.parse(contents)));
  })
  .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"));
  return null;
}

function getWords(contents){
  retVal = [];
  var i = 0;
  while (i < 20 && i != contents.length){
    retVal.push(contents[i]["word"])
    i += 1;
  }
  return retVal;
}

function sendDomains(domainNames){
  var jsonString = JSON.stringify(domainNames)
  $.ajax({
    url: "gdapi.php",
    type: "post",
    data: {words: jsonString},
    sucess: function(res){
    }
  });
}

function handleRelatedWords(relatedWords){
  var domains = [];
  while (domains.length < 60){
    if (relatedWords.length === 1){
      domains = relatedWords[0];
      break;
    }
    const firstIndex = getRandomInt(relatedWords.length)
    const firstSecond = getRandomInt(relatedWords[firstIndex].length)
    const secondIndex = getRandomInt(relatedWords.length)
    const secondSecond = getRandomInt(relatedWords[secondIndex].length)
    const firstWord = relatedWords[firstIndex][firstSecond]
    const secondWord = relatedWords[secondIndex][secondSecond]
    domains.push(firstWord + secondWord)
  }
  console.log(domains);
  //sendDomains(domains)
}

function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}
