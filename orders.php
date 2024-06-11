<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarbonCatalyst - Transactions</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .leaderboard {
            
            max-width:600px;
           margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border:solid black 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: darkgreen;
            color: white;
           padding: 20px 20px 20px 20px;
        }

        th, td:first-child {
            width: 20%;
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="leaderboard">
        <h2 align="center">Transactions</h2><br>
        <table id="leaderboardTable">
            <tr style="background-color: darkgreen;">
                <th>Name</th>
    
                <th>Prduct</th>
                 <th>Date</th>
                <th>Coins</th>
              
            </tr>

            <?php
           
           
        

           $host = 'localhost';
           $dbUsername = 'root';
           $dbPassword = '';
           $dbName = 'cf';
           
           $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
           

           $e=$_SESSION['email'];


$sql = "select * from orders where email='$e'";

            $result = $conn->query($sql);

            
            
                $row2 = $result->fetch_assoc() ;
   

                foreach($result as $row2)
             {

                   
                    echo "<tr>";

                    echo "<td>" . $row2['name'] . "</td>";
                   
                   echo "<td>" .  $row2['product']  . "</td>";
                   echo "<td>" .  $row2['date']  . "</td>";
                   echo "<td>" .  $row2['coins']  . '&nbsp;<span style="background-color:gold; color:gold;border-radius:50%;">&#9711;</span></td>';
                 
                    echo "</tr><br>";
                  
            }
            
            
            $conn->close();
            ?>
            
      
        </table>
        <br><br><br>
    </div>
    <script>
        // JavaScript code goes here (if needed)
    </script>
</body>
</html>
