<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reward Page</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
  }
  
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
  }
  
  .reward {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
  }
  
  .reward:last-child {
    border-bottom: none;
  }
  
  .reward img {
    
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
  }
  
  .reward .reward-details {
    flex: 1;
    padding: 20px 20px 20px 20px;
  }
  
  .reward .reward-details h3 {
    margin: 0;
    font-size: 18px;
  }
  
  .reward .reward-details p {
    margin: 5px 0;
    color: #666;
  }
  
  .points {
    font-size: 24px;
    text-align: center;
    margin-top: 20px;
  }
  .g
  {
    background-color: darkgreen;
    margin: 0 auto;
    width: 60%;
    height: 70%;
    color: white;
    padding: 20px 20px 20px 20px;
    border-radius: 8px;
    text-align:center;
    

  }

  button
  {
    padding: 10px 10px 10px 10px;
    text-align: right;
    border-radius: 4px;
   
  
  }
</style>
</head>
<body>
<?php 
//session_start();
$email=$_SESSION['email'];
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
$mess= "<h1 align='center'>Congratulations, You won a reward</h1>";
$m="";

//$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reward where email='$email' order by month desc";
$result = $conn->query($sql); 

$sql1 = "SELECT * FROM users where email='$email'";
$result1 = $conn->query($sql1); 

echo '<div class="container">';
echo '<h1>Rewards</h1>';

$s=0;
$m=1;

foreach($result1 as $row)
{
   
 
 $s=$row['credit'];
  $_SESSION['points']=$s;
}

echo '<div class="g"><span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span> '.$s.' points &nbsp;&nbsp&nbsp;&nbsp<button><a href="redeem.php" style="text-decoration:none;color:black;" >Redeem</a></button></div><br><br><br>';




foreach($result as $row)
{
   echo '  <div class="reward">
  
   <div class="reward-details">
     <h3> Reward '.$m++. '   ('.$row['month'].')</h3>
     <p>' .$row['reward'] . '</p>
   </div>
   <span>'.$row['credit'].' points</span>
   
 </div><br><br>
 ';



}






echo '</div>';


?>

  
  


</body>
</html>
