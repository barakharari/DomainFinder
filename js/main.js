const connectors = ['atthe', 'likethe', 'likeits', 'it', 'of', 'onto', 'on', 'to', 'outof', 'with', 'withthe', 'like', 'by', 'outof', 'but', 'also', 'so', 'and', 'asif', 'unlike', '', '', '']
const starters = ['the', 'this', 'do', 'make', 'if', 'we', 'some', 'another', 'favorite', 'prefer', 'first', 'next', 'soon', 'finally', 'when', '100', '101', '', '', '']
const enders = ['shop', 'store', 'buy', '', '']

var keywords = ['']

$(document).ready(function(){

  var words = []

  $("#submit").click(function(){
    var returnMessage;
    input = document.getElementById("keywords").value;

    sendNames(words)
  })

  $(document).on("click", ".cancelWord", function(e){
    name = this.parentNode.querySelector("p").textContent

    for (i = 0; i < words.length; i++){
      if (words[i] == name){
        words.splice(i)
        break
      }
    }

    console.log(words)

    if (words.length == 0){$("#submit").css("opacity", 0)}

    this.parentNode.remove()

  })

  $('#keywords').keypress(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){

        if (words.length == 0){$("#submit").css("opacity", 1)}

        input = document.getElementById("keywords").value;
        if (checkInput(input) != null){
          words.push(input)
          document.getElementById("chosenWordsGrid").innerHTML +=
          `<li class="width-4-12-m width-2-12"><button type="button" class="cancelWord">x</button><p>${input}</p></li>`
          this.value = ""
        }
      }
  });
})

function checkInput(input){
  var onlyThreeWords = /([\w\W]\s)+/.test(input);
  var noNumbers = /(?:[\d]+ ){0,2}[\d]+/.test(input);
  var noSpecialChars = /\/\W|_/g.test(input);

  // if (onlyThreeWords === true && noNumbers === false && noSpecialChars === false) {
  //   document.getElementById("returnMessage").style.color = "MediumSeaGreen";
  //   returnMessage = "Input valid"
  //   // processInput(input)
  // } else {
  //   document.getElementById("returnMessage").style.color = "red";
  //   returnMessage = "Input invalid: please make sure you are meeting the input conditions";
  //   document.getElementById("returnMessage").innerHTML = returnMessage;
  // }
  return 5
}

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
    `<li class='width-12-12-m width-4-12 domain' style="background-color:rgb(${r},${g},${b}); color:${color}">
      <a target="_blank" href="https://www.godaddy.com/domainsearch/find?segment=repeat&checkAvail=1&tmskey=&domainToCheck=${name}">
        <h3 class="name">Domain: ${name}</h3>
        <p class="price">Price: $${price}</p>
      </a>
    </li>`
  document.getElementById("footer").style.position = "static"
}
