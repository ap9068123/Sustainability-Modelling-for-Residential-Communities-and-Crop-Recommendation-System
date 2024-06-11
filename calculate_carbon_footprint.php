<?php
// Database connection settings
session_start();
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';
 $email=$_SESSION['email'];

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
$previousMonthYear1=date('m-Y', strtotime(date('Y-m-01') . ' -1 month'));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from the database
$sql = "select ebill,water,gas,transportation from footprints where email= '$email' and DATE_FORMAT(month, '%m-%Y')='$previousMonthYear1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetching data from each row
    $row = $result->fetch_assoc();
    $distance = $row["transportation"];
    $gas = $row["gas"];
    $electricity = $row["ebill"];
    $water = $row["water"];

    // Calculate carbon footprint
    $carbon_footprint_distance = $distance * 0.18; // Example formula for distance
    $carbon_footprint_gas = $gas * 3.2; // Example formula for gas consumption
    $carbon_footprint_electricity = $electricity * 0.82; // Example formula for electricity consumption
    $carbon_footprint_water = $water * 0.344; // Example formula for water consumption

    // Send the calculated data as JSON response
    echo json_encode([$carbon_footprint_distance, $carbon_footprint_gas, $carbon_footprint_electricity, $carbon_footprint_water]);
} else {
    echo "No data found";
}

$conn->close();
?>
