<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarbonCatalyst - Leaderboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .leaderboard {
            max-width: 600px;
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
        <h2 align="center">Leaderboard</h2><br>
        <table id="leaderboardTable">
            <tr style="background-color: darkgreen;">
                <th>Rank</th>
                <th>Player</th>
                <th>Score</th>
            </tr>

            <?php
           
            require_once('lead.php');
            $email=$_SESSION['email'];
            $d  = date("d-m-Y");
            
           // echo $d." ";

            $previousMonthYear = date('m-Y', strtotime('-1 month'));
             $previousMonthYear1=date('m-Y', strtotime(date('Y-m-01') . ' -1 month'));

            
            //echo $previousMonthYear;
        

            $host = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'cf';
            
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
           

            $sql = "select name , ebill,water,gas,plants,AQI,month,transportation, 0.82*ebill + 0.344*water + 3.2*gas + 0.18*transportation as total from footprints where DATE_FORMAT(month, '%m-%Y')='$previousMonthYear1' order by total asc";



            //$sql1 = "select name , ebill,water,gas,plants,AQI,month,transportation from footprints where DATE_FORMAT(month, '%m-%Y')='$monthYear'";
            $result = $conn->query($sql);

             $s=0;
             $rank=1;
            
                $row2 = $result->fetch_assoc() ;
   

                foreach($result as $row2)
             {

                    $s=0.82*$row2['ebill'] + 0.344*$row2['water']+3.2*$row2['gas']/*+0.18*$row2['transportation']*/;
                    echo "<tr>";
                    echo "<td>" . $rank . "</td>";
                    echo "<td>" . $row2['name'] . "</td>";
                   
                    echo "<td>";
                    
                    if($s>200)
                    {
                      
                     echo "<h4> <strong> <span style='color:red'>".$s.' Units</span> </strong>'."</h4>";
                    }

                    else if($s<=200)
                    {
                        echo "<h4> <strong> <span style='color:darkgreen'>".$s.' Units</span> </strong>'."</h4>";
                    }



                    echo "</td></tr>";
                    $rank++;
            }
            
            
            $conn->close();
            ?>
        </table>
    </div>
    <script>
        // JavaScript code goes here (if needed)
    </script>
</body>
</html>
