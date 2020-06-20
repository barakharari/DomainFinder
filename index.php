<!DOCTYPE html>
<html>
  <head>
    <title>Domain Finder</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/wordGenerator.js"></script>
    <link rel="stylesheet" type="text/css" href="css/grid.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <div id="wrapper" class="center">
    <div id="main">
      <h1>Domain Finder</h1>
      <h4>Make sure your input meets the following criteria:</h4>
      <ul id="rules">
        <li>Max three words long with no added spaces</li>
        <li>Words must be separated by spaces</li>
        <li>Must contain only letters (no numbers or special characters)</li>
      </ul>
      <input id="keywords" placeholder="Enter your keywords...">
      <button type="button" id="submit">Submit</button>
      <div id="returnMessage"></div>
    </div>

    <div id="results">

      <ul id="resultsGrid" class="grid">
        <!-- <li class="width-12-12-m width-4-12" style="background-color:blue">
          <h3 class="name">testtestestestestest</h3>
          <p class="price">test</p>
        </li>
        <li class="width-12-12-m width-4-12">
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
