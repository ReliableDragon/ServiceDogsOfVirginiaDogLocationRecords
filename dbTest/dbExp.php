<?php
//$servername = "mysql.servicedogsva.org";
//$username = "ked9ua";
//$password = "M!kado2014";
$servername = "localhost";
$username = "root";
$password = "servicedogs";
$dbname = "sdvrec";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html><head></head><script>
function disp() {
    var y = document.getElementById("dog");
    var z = y.options[y.selectedIndex].value;
    var x = document.getElementById("current").checked;
    window.location = "http://servicedogsva.org/dbTest/dbExp.php?sel=" + z + "&current=" + x;
    }
</script><body><center><h1>Dog Location History</h1>
<p>
    <form><select onchange="disp();" name=dog id="dog">
        <option value=0>All</option>
<?php
$sql = "SELECT id, name FROM Dogs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $s = "";
        if ($row["id"] == $_GET["sel"]) $s = " selected=selected";
        echo "<option value=" . $row["id"]. $s.">" . $row["name"]. "</option>";
        $s = "";
    }
} else {
    echo "0 results";
}
?>
    </select><input onchange="disp();" type=checkbox id=current <?php if ($_GET["current"] == 'true') echo "checked";?>>Show Current Only<p><hr><table style=text-align:center>
<?php
$sql = "SELECT dogID, date, volID FROM LocationHistory";
if ( $_GET["sel"] > 0) { $sql = $sql . " WHERE dogID=" . $_GET["sel"];
if ( $_GET["current"] == 'true') $sql = $sql . " ORDER BY date DESC LIMIT 1"; }
//!!!!Need to modify the following if statement to show most recent location as opposed to first location!!!!!!
if ( $_GET["current"] == 'true' && $_GET["sel"] == 0) $sql = $sql . " GROUP BY dogID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $spec = $conn->query("SELECT name FROM Dogs WHERE id=" . $row["dogID"]);
        $dog = $spec->fetch_assoc();
        $spec = $conn->query("SELECT name FROM Volunteers WHERE id=" . $row["volID"]);
        $vol = $spec->fetch_assoc();
        echo "<tr><td>" . $row["date"]. "</td><td>" . $dog["name"]. "</td><td>went to</td><td>" . $vol["name"] . "</td></tr>";
    }
} else {
    echo "<br>0 results";
}
$conn->close();
?>
    </table></form>
    
</body></html>

