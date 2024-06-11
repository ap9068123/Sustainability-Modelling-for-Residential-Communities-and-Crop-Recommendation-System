<?php
// Connect to MySQL database
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch coordinates from the database
$sql = "SELECT * FROM plantation";
$result = $conn->query($sql);

// Create an array to store coordinate data
$coordinates = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $coordinates[] = array(
            'lat' => $row['lat'],
            'lng' => $row['longi'],
            'name' => $row['name']
        );
    }
}

// Convert the array to JSON and output it
echo json_encode($coordinates);

$conn->close();

?>


