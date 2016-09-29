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


    $sql = "CREATE TABLE Rep_DogSit (";
    
    foreach($_POST as $key => $value) {
        $sql .= $key . " VARCHAR(300), ";
    }
    $sql = substr($sql, 0, -2) . ")";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
?>