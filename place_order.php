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

$num = $_POST['num'];
$add = $_POST['add'];
$pro= $_POST['pro'];






session_start();
$e=$_SESSION['email'];
$amount=$_SESSION['amount'];
$d  = date("Y-m-d");

$sql = "INSERT INTO orders (name, email,product,num,Address,date,coins)
VALUES ('$name', '$email', '$pro','$num','$add','$d','$amount')";


if ($conn->query($sql) === TRUE) {

    $sql2="UPDATE users set credit=credit-'$amount' where email='$email'";
                        $result2 = $conn->query($sql2); 
    echo '<br><br><br><h1 style="color:darkgreen;" align="center">Order placed successfully</h1>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//header("Location: index.html");
$conn->close();
?>