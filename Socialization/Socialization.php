<html>
  <head>
    <script type="text/javascript" src="Socialization.js"></script>
  </head>
  <body>
    <h1>Socialization Form</h1>
    <div>
      <p id="successBanner"></p>
    </div>
    <div>
      <p>Enter Dog ID:</p>
      <textarea name="dogID" class="formEntry" rows=1>5</textarea>
    </div>
    <div>
      <p>Enter Volunteer ID:</p>
      <textarea name="volID" class="formEntry" rows=1>6</textarea>
    </div>
    <div>
      <p>Enter Date (mm/dd/yyyy):</p>
      <textarea name="date" class="formEntry" rows=1>2016-05-05</textarea>
    </div>
    <div>
      <p>Enter Location:</p>
      <textarea name="location" class="formEntry">here</textarea>
    </div>
    <div>
      <p>Enter Description:</p>
      <textarea name="description" class="formEntry">good</textarea>
    </div>
    <button onclick='asyncDbCall();' type="button">Submit</button>
  </body>
</html>