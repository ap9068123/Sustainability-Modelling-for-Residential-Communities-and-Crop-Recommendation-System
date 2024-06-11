<?php


        
            

             $email=$_SESSION['email'];
           
             $d  = date("Y-m-d");
             $monthYear = date('m-Y', strtotime($d));
             //echo $monthYear;
             $previousMonthYear = date('m-Y', strtotime('-1 month'));
             
             $previousMonthYear1= date('m-Y', strtotime(date('Y-m-01') . ' -1 month'));

             //echo $previousMonthYear;

             $host = 'localhost';
             $dbUsername = 'root';
             $dbPassword = '';
             $dbName = 'cf';
             
             $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        
                    $m="";
                   // $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                   

                    $sql4 = "select name ,email, ebill,water,gas,plants,AQI,month,transportation, 0.82*ebill + 0.344*water + 3.2*gas + 0.18*transportation as total from footprints where DATE_FORMAT(month, '%m-%Y')='$previousMonthYear1' order by total asc limit 3";
                    $result4 = $conn->query($sql4);

                    $topUsers = array();

                    

// Check if there are any results
$t=$result4->num_rows ;
if ($t> 0) {
    // Fetch each row and store it in the array
    while ($row4 = $result4->fetch_assoc()) {
        $topUsers[] = $row4['email'];
    }



}



                    $a="";
                    $b="";
                    $c1="";
                  
                    //$a=$topUsers[0];
                    //$b=$topUsers[1];
                    
                     if($t>=3)
                    {
                        
                    
                    $a=$topUsers[0];
                    
                    
                    }
                    
                     if($t>=3)
                    {
                        
                    
                    $b=$topUsers[1];
                    
                    
                    }
                    
                    //echo $t;
                    
                    if($t>=3)
                    {
                        
                    
                    $c1=$topUsers[2];
                    
                    
                    }
                   // echo $a." ".$b." ". $c1;
                    

                    $h="On toping the leaderboard";

                    $sql = "SELECT * FROM leaderboard where email='$email' and DATE_FORMAT(month, '%m-%Y')='$monthYear'";
                    $result = $conn->query($sql); 
                    
                    $c=100;

                    if ($result->num_rows ==0 && ($email==$a || $email==$b ||$email==$c1))
                    {
                        $sql1="INSERT INTO reward (email,month,reward,credit)
                                VALUES ( '{$email}', '$d','{$h}','{$c}')";

$sql3="INSERT INTO leaderboard (email,month,reward,credit)
VALUES ( '{$email}', '$d','{$h}','{$c}')";


                                
                        $result1 = $conn->query($sql1);
                        $result3 = $conn->query($sql3);

                        $sql2="UPDATE users set credit=credit+100 where email='$email'";
                        $result2 = $conn->query($sql2); 

                        
                

                        
                    }

                  

                  
        ?>