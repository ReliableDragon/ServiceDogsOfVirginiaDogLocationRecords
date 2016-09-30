// Basically a dummy function for testing.
function AlertOnSuccess() {
  alert("Records Updated!");
}

// Calls AddSocializationRecord.php via AJAX for Socialization.php
function asyncDbCall() {
  
  // Mostly boilerplate.
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "AddSocializationRecord.php", true);
  xhttp.onreadystatechange = function()  {
    if (xhttp.status == 200) {
      if (xhttp.readyState == 4) {
      document.getElementById("successBanner").innerHTML = xhttp.responseText;
      } else if (xhttp.readyState == 2) {
        document.getElementById("successBanner").innerHTML = "Loading...";
      }
    } else {
      alert("There was an error: " + xhttp.status);
    }
  };
  
  var elems = document.getElementsByClassName("formEntry");
  // Set up post arguments.
  var params = "";
  for (var i = 0; i < elems.length; i++) {
    if (i !== 0) {
      params += "&";
    }
    params += elems.item(i).name;
    params += "=" + elems.item(i).value;
  }
  // These ensure that the request will be sent every time, and prevent the
  // browser from caching our page and pre-empting the ajax request.
  // TODO(gabe): Find out if there's a better way to achieve this.
  xhttp.setRequestHeader("Pragma", "no-cache");
  xhttp.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
  xhttp.setRequestHeader("Expires", 0);
  xhttp.setRequestHeader("Last-Modified", new Date(0));
  xhttp.setRequestHeader("If-Modified-Since", new Date(0));
  // Tell the XMLRequest that we're sending POST arguments.
  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}