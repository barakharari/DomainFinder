<!DOCTYPE html>
<html>
  <head>
    <title>Domain Finder</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="wordGenerator.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap');
      body {
        font-family: 'Roboto Mono', monospace;
        font-size: 0.8em;
      }
      #container {
        margin: auto;
        width: 600px;
        margin-top: 10%;
      }
      input, button {
        font-family: inherit;
        font-size: inherit;
      }
      button {
        font-weight: 600;
      }

      #returnMessage {
        font-size: 0.5em;
        margin-top: 5px;
      }
      input:focus, textarea:focus{
        background-color: #F7EAFF;

      }
    </style>
  </head>
  <body>
  <div id="container">

    <h1>Domain Ideas</h1>

    <p>Make sure your input meets the following criteria:</p>
    <ul>
      <li>Max three words long with no added spaces</li>
      <li>Words must be separated by spaces</li>
      <li>Must contain only letters (no numbers or special characters)</li>
    </ul>

    <input id="keywords" placeholder="Enter your keywords...">

    <button type="button" onclick=validate()>Submit</button>

    <p id="returnMessage"></p>
    <br>
    <div id="results"></div>
  </div>
  </body>

</html>
