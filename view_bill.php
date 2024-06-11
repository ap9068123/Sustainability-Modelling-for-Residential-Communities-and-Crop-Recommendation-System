<?php
                 session_start();
                 
                 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        .grid-container {
  display: grid;
  align-content: center;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 10px;
}

.grid-item {
  /* Optionally, you can add styles to the grid items */
  padding: 30px 30px 30px 30px;
}

.grid-item img {
  max-width: 100%;
  height: 100%;
}

.g1
{
    background-color: darkgreen;
    color: white;
    Height: 25%;
}

    </style>
</head>
<body>
<?php
                 //session_start();
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
                        $t="Not found";
                    
                       $mydate=strtotime($date);
                    
                    ?>

                  
      <div class="g1">

      <h1 align="center">Monthly Bills </h1>

      </div>

      <div class="grid-container">
  <div class="grid-item">
  <img src="images/<?php if(!empty($row['a'])){ echo $row['a'];} else {echo $t;} ?>" alt="" class="profile-picture img-fluid">
  <p align="center">Electricity Bill</p>
  </div>
  <div class="grid-item">
  <img src="images/<?php if(!empty($row['b'])){ echo $row['b'];} else {echo 'Not found';}?>" alt="" class="profile-picture img-fluid">
  <p align="center">Water Bill</p>
  </div>
  <div class="grid-item">
  <img src="images/<?php if(!empty($row['c'])){ echo $row['c'];} else {echo 'Not found';} ?>" alt="" class="profile-picture img-fluid">
  <p align="center">Gas Bill</p>
  </div>
  <!-- 

  <div class="grid-item">
  <img src="images/<?php if(!empty($row['d'])){ echo $row['d'];} else {echo 'Not found';} ?>" alt="" class="profile-picture img-fluid">
  <p align="center">Oil Bill</p>
  </div>
  <div class="grid-item">
  <img src="images/<?php if(!empty($row['e'])){ echo $row['e'];} else {echo 'Not found';} ?>" alt="" class="profile-picture img-fluid">
  <p align="center">Odometer</p>
  </div>
  Add more grid items as needed -->
</div>
     
      
</body>
</html>