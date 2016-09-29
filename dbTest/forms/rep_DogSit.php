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
    
    $ins = "INSERT INTO Rep_DogSit (";
    $val = " VALUES ( ";

    foreach( $_POST as $key => $value) {
        if($value != null) {
            $ins = $ins . $key . ", ";
            $val = $val . "\"" . $value . "\", ";
        }
    }
    $ins = substr($ins, 0, -2) . ")";
    $val = substr($val, 0, -2) . ")";
    
    $sql = $ins . $val;       
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
?>