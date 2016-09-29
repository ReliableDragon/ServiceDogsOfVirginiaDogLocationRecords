<html><head><link rel=stylesheet href=db.css></head><script src=db.js></script>
<?php
    $servername = "mysql.servicedogsva.org";
    $username = "ked9ua";
    $password = "M!kado2014";
    $dbname = "sdvrec";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //Create Drop Down Options for Dogs
    $sql = "SELECT id, name FROM Dogs ORDER BY name";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $s = "";
            if ($row["id"] == $_GET["sel"]) $s = " selected=selected";
            $dogMenu = $dogMenu . "<option value=" . $row["id"]. $s.">" . $row["name"]. "</option>";
            $s = "";
        }
    } else {
        $dogMenu = "0 results";
    }
    
    //Create Drop Down Options for Volunteers
    $sql = "SELECT id, name FROM Volunteers ORDER BY name";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $volMenu = $volMenu . "<option value=" . $row["id"].">" . $row["name"]. "</option>";
        }
    }
?>
<body><form>
<div id=layout>
    <div id=menu>
        <table><tr><td> Locations</td><td>Coming Soon</td><td>Coming Soon</td><td>Coming Soon</td></tr></table>
    </div>
    <div style="height:100%; background-color:white; opacity:.65;"></div>
    <img style="position:absolute; top:45px; left:35px;" src="./sdv.png">
    <h1 id=head>Dog Socialization Records</h1>
</div>
<div id=left>
    <p>
        Submissions Overview: (Vol, update, complete percentage)<br>
        - By Dog<br>
        - By Volunteer<br><br>
        Trainer View (Dogs x Location Chart)<br>
        - By Puppy Class/Status<br><br>
    </p>
</div>
<div id=right>
    
</div>
    

</form></body></html>

