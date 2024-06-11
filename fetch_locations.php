<?php
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';


$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch locations
$sql = "select name, location,lat,longi FROM plantation";
$result = $conn->query($sql);

// Prepare data to send as JSON
$locations = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($locations);

?>
