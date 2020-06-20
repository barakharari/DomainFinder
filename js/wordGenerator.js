const connectors = ['atthe', 'likethe', 'likeits', 'it', 'of', 'onto', 'on', 'to', 'outof', 'with', 'withthe', 'like', 'by', 'outof', 'but', 'also', 'so', 'and', 'asif', 'unlike', '', '', '']
const starters = ['the', 'this', 'do', 'make', 'if', 'we', 'some', 'another', 'favorite', 'prefer', 'first', 'next', 'soon', 'finally', 'when', '100', '101', '', '', '']
const enders = ['shop', 'store', 'buy', '', '']

var keywords = ['']

$(document).ready(function(){
  $("button").click(function(){
    var returnMessage;
    input = document.getElementById("keywords").value;

    var onlyThreeWords = /([\w\W]\s)+/.test(input);
    var noNumbers = /(?:[\d]+ ){0,2}[\d]+/.test(input);
    var noSpecialChars = /\/\W|_/g.test(input);

    if (onlyThreeWords === true && noNumbers === false && noSpecialChars === false) {
      document.getElementById("returnMessage").style.color = "MediumSeaGreen";
      returnMessage = "Input valid"
      // processInput(input)
      sendNames(input.split(" "))
    } else {
      document.getElementById("returnMessage").style.color = "red";
      returnMessage = "Input invalid: please make sure you are meeting the input conditions";
    }
    document.getElementById("returnMessage").innerHTML = returnMessage;
  })
})

function sendNames(keywords){
  document.getElementById("resultsGrid").innerHTML = ""

  $.ajax({
    url: "php/gdapi.php",
    type: "POST",
    dataType:"json",
    data: {words: keywords},
    success: function(res){
      console.log("Success")
      console.log(res)
      for (i = 0; i < res.length; i++){
        outputToDOM(res[i])
      }

    },
    error: function(){
      alert("Something went wrong...")
    }
  });
}

function outputToDOM(info){

  r = Math.floor(Math.random() * 255)
  b = Math.floor(Math.random() * 255)
  g = Math.floor(Math.random() * 255)

  console.log("r:" + r + "b:" + b + "g:" + g)

  color = "#eee"

  if (r > 50 && g > 50){
    color = "#000"
  }

  var name = info.name
  var price = info.price.toString().substring(0,4)
  price = price.substring(0,2) + "." + price.substring(2,4)

  document.getElementById("resultsGrid").innerHTML +=
    `<li class='width-12-12-m width-4-12' style="background-color:rgb(${r},${g},${b}); color:${color}">
      <a target="_blank" href="https://www.godaddy.com/domainsearch/find?segment=repeat&checkAvail=1&tmskey=&domainToCheck=${name}">
        <h3 class="name">Domain: ${name}</h3>
        <p class="price">Price: $${price}</p>
      </a>
    </li>`
  document.getElementById("footer").style.position = "static"
}
