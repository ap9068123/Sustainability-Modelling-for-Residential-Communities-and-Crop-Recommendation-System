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

<div class="g1">

      <h1 align="center">Plant Progress </h1>

      </div>
      
<?php
                // session_start();
                   $email=$_SESSION['email'];
                   //$date=$_POST['date'];
                   
 //$monthYear = date('m-Y', strtotime($date));

 $host = 'localhost';
 $dbUsername = 'root';
 $dbPassword = '';
 $dbName = 'cf';
 
 $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM plantation where email='$email'";
                    $result = $conn->query($sql);

                    
                        //$row = $result->fetch_assoc() ;
                         
                        echo ' <div class="grid-container">';


                        foreach($result as $row){
                         

                            $t="images/".$row['image'];
                          
                            echo '<div class="grid-item">';
                            echo '<img src="'.$t.'">';
                            echo "Plant View on " .$row['date'];
                            echo '</div>';

                        }

                        echo '</div>';
                    
                       //$mydate=strtotime($date);
                    
                    ?>

                  
      


     
      
</body>
</html>