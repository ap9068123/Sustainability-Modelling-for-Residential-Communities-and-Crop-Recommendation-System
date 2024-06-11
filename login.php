<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['email'];
$password = $_POST['password'];


session_start();
$_SESSION['email']=$username;
$sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    header("Location: home.php");
    exit();
} else {
    echo'<script>alert("Invalid username or password.")</script>';
    
    echo '<br><br><br><h1 style="color:red;" align="center">Wrong credentials</h1>';
    
}
//header("Location: index.html");
$conn->close();
?>