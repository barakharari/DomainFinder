<!DOCTYPE html>
<html>
  <head>
    <title>Domain Finder</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="wordGenerator.js"></script>
    <style>
      body {
        font-family: "Roboto", sans-sans-serif;
        font-size: 1.2em;
      }
      input, button {
        font-family: inherit;
        font-size: inherit;
      }
    </style>
  </head>
  <body>
    <div id="root"></div>

    <form id="form">
      Keywords: <br><input type="text" id="keywords"><br>
      <input type="button" value = "Submit" onclick="processInput()">
    </form>

    <br>

    <div id="results"></div>
  </body>

</html>