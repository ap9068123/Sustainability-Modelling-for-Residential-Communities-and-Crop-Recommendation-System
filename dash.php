<?php
                 session_start();
                   $email=$_SESSION['email'];
                   $date=$_POST['date'];
                   
 $monthYear = date('m-Y', strtotime($date));

 $host = 'localhost';
 $dbUsername = 'root';
 $dbPassword = '';
 $dbName = 'cf';
 
 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM footprints where email='$email' and DATE_FORMAT(month, '%m-%Y')='$monthYear' ";
                    $result = $conn->query($sql);

                    
                        $row = $result->fetch_assoc() ;
                    
                      
                    
                    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carbon Footprint Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .dashboard {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 20px;
    }

    .category {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: #65ef2f;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .category .icon {
      font-size: 50px;
      margin-bottom: 10px;
    }

    .category .label {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .category .count {
      font-size: 24px;
      font-weight: bold;
    }

    /* Center gas category */
    .center-category {
      grid-column: span 2; /* Span two columns */
      text-align: center;
    }
  </style>
</head>
<body>



<br><br>
<div class="dashboard">

    <div class="category center-category">
        <h1>Monthly Consumptions</h1>
      </div>

  <div class="category">
    <span class="icon">🚗</span>
    <div class="label">Distance</div>
    <div class="count"><?php if(!empty($row)) {  echo $row['transportation'] ;}
    else
    {
        echo "0";
    
    };?> Kms</div>
  </div>
  <div class="category">
    <span class="icon">⚡</span>
    <div class="label">Electricity</div>
    <div class="count"><?php  if(!empty($row)) { echo $row['ebill'] ;}
    else
    {
        echo "0";
    
    };?> KWh</div>
  </div>
  <div class="category">
    <span class="icon">💧</span>
    <div class="label">Water</div>
    <div class="count"><?php if(!empty($row)) {echo $row['water'];}
    else
    {
        echo "0";
    
    };?> Cubic meters</div>
  </div>
  <div class="category">
    <span class="icon">⛽</span>
    <div class="label">Petrol/Diesel</div>
    <div class="count"><?php if(!empty($row)) { echo $row['pbill'];}
    else
    {
        echo "0";
    
    };?> litres</div>
  </div>
  <div class="category center-category">
    <span class="icon">🛢️</span>
    <div class="label">Gas</div>
    <div class="count"><?php  if(!empty($row)) { echo $row['gas'];}
    else
    {
        echo "0";
    
    };?> Kgs</div>
  </div>
</div>

</body>
</html>
