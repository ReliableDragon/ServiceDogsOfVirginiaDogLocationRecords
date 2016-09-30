<?php
// A .php file intended as the target of an AJAX request.
// It takes a dog_id, volunteer_id, date, location, and description
// as POST arguments, and inserts them to the Socialization table.
// Echoes success message on success, and currently nothing on error,
// as I wasn't able to find where the errors went when using prepared
// statements.
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

// Prepare SQL statement without variables.
$stmt = $conn->prepare("INSERT INTO Socialization (dog_id, volunteer_id, date, location, description) VALUES(?, ?, ?, ?, ?)");
// Bind variables separately, to prevent SQL injection.
$stmt->bind_param('iisss', $_POST["dogID"], $_POST["volID"], $_POST["date"], $_POST["location"], $_POST["description"]);
$stmt->execute();
$result = $stmt->get_result();

echo "Socialization records successfully updated!";

$stmt->close();
$conn->close();
?>




