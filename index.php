<!DOCTYPE html>
<html>
  <head>
    <title>Not So Basic</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="css/grid.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <div id="wrapper" class="center">
    <div id="main">
      <h1>The "One-Stop-Shop" for Unique URLs</h1>
      <h4>Describe your site/business:</h4>
      <ul id="rules">
        <li>Enter each keyword one by one (the more specific the better)</li>
        <li>Keywords must contain only letters (no numbers or special characters)</li>
        <li>Press submit when ready for available domains!</li>
      </ul>
      <input id="keywords" placeholder="Enter a keyword...">

    </div>

    <div id ="chosenWords">
      <ul id="chosenWordsGrid">
        <!-- <li><button type="button" class="cancelWord">x</button><p>word1</p></li>
        <li><button type="button" class="cancelWord">x</button><p>word1</p></li>
        <li><p>word1</p></li> -->
      </ul>
    </div>
    <button type="button" id="submit">Submit</button>
    <div id="returnMessage"></div>

    <div id="loader"></div>

    <div id="results">

      <ul id="resultsGrid" class="grid">
        <!-- <li class="width-12-12-m width-4-12 domain" style="background-color:blue">
          <h3 class="name">testtestestestestest</h3>
          <p class="price">test</p>
        </li>
        <li class="width-12-12-m width-4-12 domain">
          <h3 class="name">testtestestestestest</h3>
          <p class="price">test</p>
        </li> -->
      </ul>

    </div>
    <div id="footer">
      <p>Copyright © 2020 · Barak Harari & Asaf Harari</p>
    </div>
  </div>
  </body>

</html>
