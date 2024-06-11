            <?php
            // session_start();
             $email=$_SESSION['email'];
             /*$d  = date("Y-m-d");
             $monthYear = date('m-Y', strtotime($d));*/

             $previousMonthYear = date('m-Y', strtotime('-1 month'));
             $previousMonthYear1 = date('m-Y', strtotime('-2 month'));
             
              $previousMonthYear2=date('m-Y', strtotime(date('Y-m-01') . ' -1 month'));
               $previousMonthYear3=date('m-Y', strtotime(date('Y-m-01') . ' -2 month'));
               $host = 'localhost';
               $dbUsername = 'root';
               $dbPassword = '';
               $dbName = 'cf';
                //$email=$_SESSION['email'];
               
               $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM footprints where email='$email' and DATE_FORMAT(month, '%m-%Y')='$previousMonthYear2'";
                    $sql1 = "SELECT * FROM footprints where email='$email' and DATE_FORMAT(month, '%m-%Y')='$previousMonthYear3'";
                    $result = $conn->query($sql); 
                    $a=0;
                    $b=0;

                    while ($row2 = $result->fetch_assoc())
                    {

                        $a=0.82*$row2['ebill'] + 0.344*$row2['water']+3.2*$row2['gas']+0.18*$row2['transportation'];

                    }

                    $result1 = $conn->query($sql1); 

                    while ($row = $result1->fetch_assoc())
                    {

                        $b=0.82*$row['ebill'] + 0.344*$row['water']+3.2*$row['gas']+0.18*$row['transportation'];

                    }

                    

                    $_SESSION['a']=$a;
                    $_SESSION['b']=$b;
                   

                    


                    
        ?>