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
    <h1 id=head>Dog Location Records</h1>
    <div id=left>
        <p><b>Show History</b><br>
            <select onchange="disp();" name=dog id="dog">
                    <option value=0>All</option>
                    <?php echo $dogMenu; ?>
            </select>
            <input onchange="disp();" type=checkbox id=current <?php if ($_GET["current"] == 'true') echo "checked";?>>Show Current Only
        </p>
        <p><b>Add Move</b><br>
            On <input id="newDate" type=text placeholder=yyyy-mm-dd style=width:85px>, 
            <select id="newDog">
                <option value = 0>--</option>
                <?php echo $dogMenu; ?>
            </select> went to 
            <select id="newVol">
                <option value=0>--</option>
                <?php echo $volMenu; ?>
            </select>
            <input onclick="insertRec();" type=button value="Add">
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
    <div id=right>
        <p><b>Results</b><br><table style=text-align:center>
        <?php
            //default query
            $from = "FROM (SELECT * FROM LocationHistory ORDER BY date DESC) AS dl ";
            $joins = "JOIN Dogs ON Dogs.id=dl.dogID JOIN Volunteers ON Volunteers.id=dl.volID";
            $tag = "";

            //change default query
            $dogSel = $_GET["sel"];
            $current = ($_GET["current"] == 'true');
            if ( $dogSel > 0) {
                $tag = " WHERE dogID=" . $dogSel;
                if ( $current ) $tag = $tag . " && date <= CURRENT_DATE ORDER BY date DESC LIMIT 1";
            }
            if ( $current && $dogSel == 0) {
                $from = "FROM (SELECT * FROM LocationHistory WHERE date <= CURRENT_DATE ORDER BY date DESC) AS dl ";
                $tag = " GROUP BY dogID";
            }
            
            //query output
            $sql = "SELECT Dogs.name AS dog, dl.date, Volunteers.name AS vol " . $from . $joins . $tag;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["date"]. "</td><td>" . $row["dog"]. "</td><td>went to</td><td>" . $row["vol"] . "</td></tr>";
                }
            } else {
                echo "<br>0 results";
            }
            $conn->close();
        ?></table>
    </div>
    
</div>
</form></body></html>

