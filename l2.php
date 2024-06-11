<?php
 session_start();
 $email=$_SESSION['email'];
 $d  = date("d-m-Y");
 $monthYear = date('m-Y', strtotime($d));

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cf";
$data=array();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select name , ebill,water,gas,transportation,plants,AQI,month from footprints where email= '$email' and DATE_FORMAT(month, '%m-%Y')='$monthYear' ";
$result = $conn->query($sql);



foreach($result as $row){
    
    array_push($data, array("Name"=>$row->name , "y"=> $row->ebill + $row->water+$row->gas+$row->transportation));
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
