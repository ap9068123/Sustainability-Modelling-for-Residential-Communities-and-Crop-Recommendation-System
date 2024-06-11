<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$name = $_POST['name'];
$email = $_POST['email'];

$message = $_POST['message'];







session_start();
$e=$_SESSION['email'];
//$amount=$_SESSION['amount'];
$d  = date("Y-m-d");

$sql = "INSERT INTO contact (name, email,message,date)
VALUES ('$name', '$email', '$message','$d')";


if ($conn->query($sql) === TRUE) {

  
    echo '<br><br><br><h1 style="color:darkgreen;" align="center">Feedback received successfully</h1>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>