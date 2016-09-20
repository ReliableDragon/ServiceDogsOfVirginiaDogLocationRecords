 function disp() {
    var y = document.getElementById("dog");
    var z = y.options[y.selectedIndex].value;
    var x = document.getElementById("current").checked;
    window.location = "http://servicedogsva.org/dbTest/dbLoc.php?sel=" + z + "&current=" + x;
}
    
function insertRec() {
    var z = document.getElementById("newDate").value;
    var y = document.getElementById("newDog");
    var w = y.options[y.selectedIndex].value;
    var v = document.getElementById("newVol");
    var x = v.options[v.selectedIndex].value;
    window.location = "http://servicedogsva.org/dbTest/dbLoc.php?add=true&newDate=" + z + "&newDog=" + w + "&newVol=" + x;
}
