<html><head></head>
<script>
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
</script>
<style>
    #menu td:hover {color:#FFDB91}
    #menu a {color:inherit; text-decoration:inherit}
    h1{font-family:century gothic}
    #sad td{padding-bottom:20px}
    #sad td:hover {opacity:.90}
    #sad img{width:100px; border:solid #FFDB91}
    .sh {display:none}
    select{font-family:century gothic; font-size:9pt;}
    input{font-family:century gothic; font-size:9pt}
    #blurb span {font-size:15pt; color:#CE1019}
    #right td {padding-right:15px; text-align:left;}
</style>
<?php
    //$servername = "mysql.servicedogsva.org";
    $servername = "localhost"; // This will connect locally. Much faster! :)
    $username = "ked9ua";
    $password = "M!kado2014";
    $dbname = "sdvrec";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<body style="background-image:url(./bg.jpg); background-size:cover; font-family:Adobe Garamond Pro;"><form>
<div id=layout>
    <div id=menu style="height:75px; background-color:#72A68F;">
        <table style="text-align:center; color:white; position:absolute; top:25px; right:35px; font-size:28px; font-family:Century Gothic; width:800px;"><tr><td> Locations</td><td>Coming Soon</td><td>Coming Soon</td><td>Coming Soon</td></tr></table>
    </div>
    <div style="height:100%; background-color:white; opacity:.65;"></div>
    <img style="position:absolute; top:45px; left:35px;" src="./sdv.png">
    <div id=head style="position:absolute; top:125px; left:37px;"><h1>
        Dog Location Records
    </h1></div>
    
    <div id=left style="position:absolute; top:190px; left:35px; height:75%; width:45%;">
        <br><b>Show History</b><br>
        <select onchange="disp();" name=dog id="dog">
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
            </select>
        <input onchange="disp();" type=checkbox id=current <?php if ($_GET["current"] == 'true') echo "checked";?>>Show Current Only
        <p>
            <b>Add Move</b><br>
            On <input id="newDate" type=text placeholder=yyyy-mm-dd style=width:85px>, 
            <select id="newDog">
                <option value = 0>--</option>
                <?php
                    $sql = "SELECT id, name FROM Dogs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"].">" . $row["name"]. "</option>";
                        }
                    }
                    ?>
            </select> went to 
            <select id="newVol">
                <option value=0>--</option>
                <?php
                    $sql = "SELECT id, name FROM Volunteers ORDER BY name";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["id"].">" . $row["name"]. "</option>";
                        }
                    }
                    ?>
            </select>
            <input onclick="insertRec();" type=button value="Add" style="">
            <!--Insert new Location Record-->
            <div id=insert_record>
                <?php
                if ($_GET["add"] == 'true' && $_GET["newDog"] != 0 && $_GET["newVol"] != 0 && $_GET["newDate"] != "") {
                    $nd = $_GET['newDog'];
                    $nt = date("Y-m-d", strtotime($_GET['newDate']));
                    $nv = $_GET['newVol'];
                    $sql = "INSERT INTO LocationHistory (dogID, date, volID)
                    VALUES ( $nd, '$nt', $nv)";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            ?>
            </div>  
        </p>
    </div>
    <div id=right style="position:absolute;top:190px; right:35px; height:75%; width:45%; background-color:white; border:solid thin; padding-left:20px;">
        
        <p><b>Results</b><br><table style=text-align:center>
        <?php
        $sql = "SELECT dogID, date, volID FROM (SELECT * FROM LocationHistory ORDER BY date DESC) AS dl";
        if ( $_GET["sel"] > 0) { $sql = $sql . " WHERE dogID=" . $_GET["sel"];
        if ( $_GET["current"] == 'true') $sql = $sql . " && date <= CURRENT_DATE ORDER BY date DESC LIMIT 1"; }
        if ( $_GET["current"] == 'true' && $_GET["sel"] == 0) $sql = "SELECT dogID, date, volID FROM (SELECT * FROM LocationHistory WHERE date <= CURRENT_DATE ORDER BY date DESC) AS dl GROUP BY dogID";
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
        ?></table>
    </div>
    
</div>
</form></body></html>

