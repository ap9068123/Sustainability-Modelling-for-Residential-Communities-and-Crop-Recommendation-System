<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarbonCatalyst - Rewards</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color:darkgreen;
    color: white;
    text-align: center;
    padding: 1em;
}

#rewards-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: solid black 1px;
}

.reward {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #eaeaea;
    border-radius: 4px;

}

.reward img {
    width: 30%;
    height:30%;
}

.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255, 255, 255, 0.8); /* semi-transparent white background */
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* Ensure it's above other content */
}

.loader {
  border: 8px solid #f3f3f3;
  border-top: 8px solid darkgreen;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite; /* Apply rotation animation */
}
.show
{
   width: 50%;
   height: 30%;
   background-color:white;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>
</head>
<body>
<div class="loading-overlay">
    <!--<div class="loader"></div>-->
    <div class="show">
    <h1 style="font-size: 100px;" align="center">🎉🎉</h1>
    </div>
   
  </div>
    <header>
        <h1>User Rewards</h1>
    </header>
    <br><br><br><br>
    <section id="rewards-container">
        <!-- Rewards will be displayed here -->
      

        <?php

$notificationMessage="CarbonCatalyst                                                            Congratulations🎉🎉 you won a reward";
//$notificationMessage = "🎉 \uD83D\uDD0E Congratulations! You've won a special reward! Check your account for details. \uD83C\uDF1F";
$notificationMessage1="<h2><strong style='color:Green;'>CarbonCatalyst</strong><br>Congratulations!! you won a reward.</h2>";
//echo $notificationMessage1;      
        
            
             //session_start();
             require_once('calculate_cf_diff.php');
             $email=$_SESSION['email'];
             $a=$_SESSION['a'];
             $b=$_SESSION['b'];
             $t=0;



             $f=$b-$a;


                    if($f>0)
                    {
                        $f=$f/$b;
                        //echo $f*100 ." ";

                        if($f*100>10)
                        {
                            $t=1;
                            
                        }

                        


                    }
             
             $d  = date("Y-m-d");
             $monthYear = date('m-Y', strtotime($d));

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
                    $g="For reducing the CF";

                    $sql = "SELECT * FROM reward where email='$email' and DATE_FORMAT(month, '%m-%Y')='$monthYear' and reward='$g' ";
                    $result = $conn->query($sql); 
                    $h="For reducing the CF";
                    $c=150;

                    if ($result->num_rows ==0 && $t==1)
                    {
                        $sql1="INSERT INTO reward (email,month,reward,credit)
                                VALUES ( '{$email}', '$d','{$h}','{$c}')";


                                
                        $result1 = $conn->query($sql1);

                        $sql2="UPDATE users set credit=credit+150 where email='$email'";
                        $result2 = $conn->query($sql2); 

                        echo $mess;
                        echo "<script>
                                // Check if the browser supports notifications
                                if ('Notification' in window) {
                                    // Request permission to show notifications
                                    Notification.requestPermission().then(function(permission) {
                                        if (permission === 'granted') {
                                            // Show the desktop notification
                                            var notification = new Notification('$notificationMessage');
                                        }
                                    });
                                }
                              </script>";

                        
                    }

                   /* else{
                        echo $mess;

                        

                        // Use PHP to output JavaScript code that triggers the desktop notification
                        echo "<script>
                                // Check if the browser supports notifications
                                if ('Notification' in window) {
                                    // Request permission to show notifications
                                    Notification.requestPermission().then(function(permission) {
                                        if (permission === 'granted') {
                                            // Show the desktop notification
                                            var notification = new Notification('$notificationMessage');
                                        }
                                    });
                                }
                              </script>";
                       
                    }*/

                    require_once('r.php');
        ?>
    </section>

    <script>
        var f = <?php echo json_encode($t); ?>;
      /*  document.addEventListener("DOMContentLoaded", function () {
    // Dummy data (replace this with real data from your server)
    const userRewards = [
        { name: "Gold Badge", image: "coupom.jpg" },
       // { name: "Silver Badge", image: "d1.jpg" },
        //{ name: "Bronze Badge", image: "cf_homepage.jpg" },
    ];

    const rewardsContainer = document.getElementById("rewards-container");

    // Display user rewards

    if(f==1)
    {
    userRewards.forEach(reward => {
        const rewardElement = document.createElement("div");
        rewardElement.classList.add("reward");

        const imageElement = document.createElement("img");
        imageElement.src = reward.image;
        imageElement.alt = reward.name;

        const nameElement = document.createElement("p");
        nameElement.textContent = reward.name;

        rewardElement.appendChild(imageElement);
        rewardElement.appendChild(nameElement);
        rewardsContainer.appendChild(rewardElement);
    });
    

}

else
{
   alert("No reward found !!");
   const g = document.createElement("h1");
   g.textContent="No reward found!!";

   rewardsContainer.appendChild(g);


   

}


});*/


document.addEventListener("DOMContentLoaded", function() {
  // Show loading overlay initially
  var loadingOverlay = document.querySelector(".loading-overlay");
  loadingOverlay.style.display = "flex"; // Make sure it's visible initially

  // Hide loading overlay after a delay
  setTimeout(function() {
    loadingOverlay.style.opacity = "1"; // Fade out the overlay
    setTimeout(function() {
      loadingOverlay.style.display = "none"; // Hide the overlay completely
    }, 300); // Adjust the delay to match the duration of the CSS fade-out transition
  }, 1000); // Adjust the delay before hiding the overlay (in milliseconds)
});

    </script>
</body>
</html>
