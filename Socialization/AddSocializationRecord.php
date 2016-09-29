<?php
$servername = "localhost";
$username = "root";
$password = "servicedogs";
$dbname = "ServiceDogs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO Socialization (dog_id, volunteer_id, date, location, description) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param('iisss', $_POST["dogID"], $_POST["volID"], $_POST["date"], $_POST["location"], $_POST["description"]);
$stmt->execute();
$result = $stmt->get_result();

echo "Socialization records successfully updated!";

$stmt->close();
$conn->close();
?>




