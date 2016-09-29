<html>
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
    
    //Calling info
    $form = "Rep_DogSitting";
    $id = 13;
    
    //Pull form info
    $sql = "SELECT * FROM " . $form. " WHERE dogID=0 OR dogID=". $id. " LIMIT 2";
    $result = $conn->query($sql);
    if ($result->num_rows > 1) {
        // output form data
        $lbl = $result->fetch_assoc();
        $rsp = $result->fetch_assoc();
        foreach($lbl as $key => $value) {
           // echo "<p>" . $value . "<br>" . $rsp[$key];
        }
    } else {
        echo "Form Submission not found!";
    }
?>
<p>
    <h1>Description</h1>
<p>
    There are two types of forms:<ul>
        <li>Report: "Rep_FormName"</li>
        <li>Application: "App_FormName"</li>
    </ul>
    <b>Applications</b> have <em>one id</em> associated with them and only <em>one submission</em> per id. <br>
    <b>Reports</b> have <em>two ids</em> associated with them and allow <em>multiple submissions</em> per id pair.
</p>
<p>
    This page takes a database table set up such that:<ul>
        <li>The type of submission is distingushed in the table name.</li>
        <li>The first columns contain the necessary id/date information for identifying the submission.</li>
        <li>Each row contains a complete individual submission.</li>
    </ul>
    Parameters should be provided to this page as follows:<ul>
        <li>The <em>type</em> of form.</li>
        <li>The <em>name</em>of the form.</li>
        <li>Either the <em>dog id</em> and/or <em>volunteer/client id</em>, as applicable.</li>
        <li>The <em>date</em>, as applicable.</li>
        <li><em>Linked HTML</em> containing the output formatting.</li>
    </ul>
    This page should:<ul>
        <li>Select the correct submission from the database.</li>
        <li>Parse the responses into the HTML formatting specified.</li>
    </ul>
</p>
</html>