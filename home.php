<?php
            session_start();
            $email=$_SESSION['email'];
            $d  = date("d-m-Y");

            $previousMonthYear = date('m-Y', strtotime('-1 month'));
        

            $host = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'cf';
            
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
           

            $sql = "select name , ebill,water,gas,plants,AQI,month,transportation, 0.82*ebill + 0.344*water + 3.2*gas as total from footprints where DATE_FORMAT(month, '%m-%Y')='$previousMonthYear' and email='$email'";



            //$sql1 = "select name , ebill,water,gas,plants,AQI,month,transportation from footprints where DATE_FORMAT(month, '%m-%Y')='$monthYear'";
            $result = $conn->query($sql);

             $s=0;
             $rank=1;
            
                $row2 = $result->fetch_assoc() ;
   

                foreach($result as $row2)
             {

                    $s=0.82*$row2['ebill'] + 0.344*$row2['water']+3.2*$row2['gas']/*+0.18*$row2['transportation']*/;
                    
            }
            
            
            $conn->close();
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CarbonCatalyst - Home</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  
<style>
  /* Style for the dropdown container */
  
  body
  {
       font-family: Arial, sans-serif;
  }
  .dropdown {
    position: relative;
    display: inline-block;
  }

  /* Style for the dropdown button */
  .dropdown-btn {
    background-color:darkgreen;
    color: #fff;
    padding: 10px;
    border: none;
    cursor: pointer;
  }



  /* Style for the dropdown content (hidden by default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  /* Style for the dropdown items */
  .dropdown-content a {
    color: #333;
    padding: 12px 16px;
    display: block;
    text-decoration: none;
  }

  /* Style for the dropdown items on hover */
  .dropdown-content a:hover {
    background-color: darkgreen;
    color: white;
  }

  /* Show the dropdown content when hovering over the dropdown button */
  .dropdown:hover .dropdown-content {
    display: block;
  }

  img
  {
    object-fit: contain;
    mix-blend-mode: color-burn;
  }
  
  .notification-button {
  position: relative; /* Position relative to make ::after absolute positioning relative to this */
  padding: 10px 20px;
  background-color: darkgreen;
  color: white;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.notification-button::after {
  content: "1"; /* Text content for the notification */
  position: absolute; /* Position the notification */
  top: 0; /* Adjust top position */
  right: 0; /* Adjust right position */
  background-color: red; /* Notification background color */
  color: white; /* Notification text color */
  width: 20px; /* Width of the notification */
  height: 20px; /* Height of the notification */
  border-radius: 50%; /* Make it a circle */
  display: flex; /* Use flexbox for centering */
  justify-content: center; /* Center horizontally */
  align-items: center; /* Center vertically */
  font-size: 12px; /* Font size of the notification text */
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

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>


</head>
<body>
  <div class="loading-overlay">
    <div class="loader"></div>
  </div>
<nav id="n" class="navbar navbar-default" style="background-color: darkgreen;">
  <div class="container-fluid">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" id="nvvv">
        <span class="icon-bar " ></span>
        <span class="icon-bar" ></span>
        <span class="icon-bar" ></span>                        
      </button>
      <a class="navbar-brand" id="cf" href="#"><span style="font-size:30px;color: white;">CarbonCatalyst &nbsp;&nbsp; &nbsp;&nbsp;</span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       

        <li class="active">
        
          <div class="dropdown">
            <button class="dropdown-btn" style="background-color: white;color: darkgreen;">Home</button>
            <div class="dropdown-content">
             
            </div>


            &nbsp;

            &nbsp;
        
        </li>

        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="m">Menu</button>
            <div class="dropdown-content">
              <a href="Plantation_info.html">Plantation Information</a>
              <a href="plant_view.php">Plant Progress</a>
               <a href="plotmap.html">Plant Locations</a>
              <a href="cf_details.html">Footprint Details</a>
              <a href="bills.html">Monthly Bills</a>
              

            </div>

            
            &nbsp;

            &nbsp;
        
        </li>

        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="h">Dashboard</button>
            <div class="dropdown-content">
              <a href="select.html">Visualisation</a>
              <a href="monthly_con.html">Monthly Consumptions</a>
              <a href="datav.php">Power Consumption by Devices</a>
            
            </div>

            
            &nbsp;

            &nbsp;
        
        </li>


        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="hi">Transport Service</button>
            <div class="dropdown-content">
              <a href="bus_service.html">Bus Service</a>
              
              <a href="ticket.html">Upload ticket</a>
            </div>

            
            &nbsp;

            &nbsp;
        
        </li>




        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="hi">Tracker</button>
            <div class="dropdown-content">
            
             <a href="rec.html">Graphical Analysis</a>
              <a href="personalised_action_plan.html">Personalised Action Plan</a>
               <a href="Recommend.html">Suggestions</a>
               
            </div>

            
            &nbsp;

            &nbsp;
        
        </li>
        
         <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="hi">Crop Predictor</button>
            <div class="dropdown-content">
              <a href="http://carboncatalystcroppredictor.pythonanywhere.com/">Predict Crop</a>
              
            
            </div>

            
            &nbsp;

            &nbsp;
        
        </li>

        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="l">Leaderboard</button>
            <div class="dropdown-content">
              <a href="leaderboard.php">Leaderboard</a>
             
            </div>
        

             
            &nbsp;

            &nbsp;
        </li>

        <li>
        
          <div class="dropdown">
            <button class="notification-button" class="dropdown-btn" id="l3">Incentives</button>
            <div class="dropdown-content">
              <a href="rewards.php">Rewards</a>
              <a href="orders.php">Transactions</a>
              <a href="redeem.php">Redeem</a>
            
            </div>
        

             
            &nbsp;

            &nbsp;
        </li>
 
        <li>
        
          <div class="dropdown">
            <button class="dropdown-btn" id="a">About</button>
            <div class="dropdown-content">
              <a href="about.html">About</a>
              <a href="contact.html">Contact</a>
           
            </div>
        

             
            &nbsp;

            &nbsp;
        </li>
        


        <li>
        
        <div class="dropdown">
          <button class="dropdown-btn" id="a">Announcement</button>
          <div class="dropdown-content">
            <a href="brod.html">Announcement</a>
            
         
          </div>
      

           
          &nbsp;

          &nbsp;
      </li>



        

      <!--  <li>
          <a href="#"><span style="font-size:20px;color: white;">Contact Us</span> </a></li>
        <li><a href="#"><span style="font-size:20px;color: white;">About Us</span></a></li>
        <li><a href="#"><span style="font-size:20px;color: white;">Help</span></a></li>

      -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><span class="glyphicon glyphicon-user" style=" color: white;"></span> <span style="font-size:20px; color: white;">&nbsp;Profile </span></a></li>
        <li><a href="logout.html"><span class="glyphicon glyphicon-log-in" style=" color: white;"></span><span style="font-size:20px;color: white;">&nbsp;Sign Out</span></a></li>
      </ul>
    </div>
  </div>
</nav>
  


<br><br><br>

  <div class="container">
    <div class="jumbotron jumbotron-fluid" id="c">

  <div> <img id="myImage" class="center" src="cf_homepage.jpg" alt=""></div>
  <br><br>

  <div class="text-center popup " id="e">

    <p style="display: block;margin-right: auto;width: 200px;"><span style="font-size: 15px;">Your</span><br><span style="font-size: 40px;">CARBON</span><br><span style="font-size: 30px;">FOOTPRINT</span><br><span style="font-size: 15px;">Number</span></p>
    <i style="display: block;margin-left: auto;width: 200px;font-size: 40px;" class="fa">&#xf06c;</i>
    <h1 id="demo" style="display: block;margin-left: auto;width: 200px;"><?php echo (int)$s ." <p>KgCO2e</p>" ?></h1>
    <h1 id="demo1" style="display: block;margin-left: auto;width: 150px;font-size: 25px;background-color: rgb(105, 238, 105);border-radius: 16px;"></h1>
    <br>
  </div>


  

  <br><br><br><br><br><br><br>

<div class="text-center" >
  <i id="tr" style="font-size:40px ; color: rgb(66, 128, 66);border: black;" class="fa">&#xf144;</i><br>
  	<button type="button"><a href="profile.php" style="text-decoration: none;color: black;">Track your<br>Journey</a></button>
</div>
 
<br><br><br><br><br><br><br>
<button type="button" class="pull-left" id="b1" style="font-size:20px;background-color:rgb(97, 175, 97);color:white;border:solid darkgreen 2px; border-radius: 6px;"><i class="fa fa-history" style="border-radius: 120px;"></i>&nbsp;<a href="select.html" style="text-decoration: none;color: white;">History</a></button>
	<button type="button" class="pull-right" id="b2"style="font-size:20px;background-color:rgb(97, 175, 97);color:white;border:solid darkgreen 2px; border-radius: 6px;"><span style="border:solid darkgreen 2px; border-radius: 100px;">&#43;</span > <a href="cf_details.html" style="text-decoration: none;color: white;">Update your bills</a></button>
  <br>
  <br>
  </div>
  
  
</div>

<br><br><br><br><br>

  <div class="container">
    <div class="jumbotron jumbotron-fluid" id="m1">

    <p>  Do you want to decrease your Carbon Footprint, but you don't know how? Here is a tip to help you out.</p>
<h1>Go digital</h1>

<div class="center">
<p >It's never been easier to collaborate with others online.

Whether through sharing documents using cloud storage or
video conferencing instead of travelling ,you can reduce your waste and
omissions. Try moving away from printed documents where possible and
encourage others to work on their digital skills for the workplace.</p>
</div>
    <div> <img class="left" style="height: 200px;width: 50x;" src="ibuyer-house.png" alt=""></div>

</div>
</div>

<script>
  function myFunction(a) {
    if(a<=200)
    {
      document.getElementById("demo1").innerHTML="Good Job";
      
      

    }

    else
    {
      document.getElementById("demo1").innerHTML="Improve!!";
      
        // Get the image element by ID
       /* var imageElement = document.getElementById("myImage");

        // Change the image source based on the condition
  
        imageElement.src = "def.jpg";*/
      
    }
  }
  myFunction(<?php echo $s?>);



  function color_change(a) {
    if(a<20)
    {
      document.getElementById("c").style.backgroundColor = "rgb(192, 206, 192)";
      document.getElementById("m1").style.backgroundColor = "rgb(192, 206, 192)";
      document.getElementById("e").style.backgroundColor = "darkgreen";
      document.getElementById("b1").style.backgroundColor = "darkgreen";
      document.getElementById("b2").style.backgroundColor = "darkgreen";
      document.getElementById("demo1").style.backgroundColor = "darkgreen";
      document.getElementById("tr").style.color = "darkgreen";
      document.getElementById("cf").style.color = "darkgreen";
      document.getElementById("nvvv").style.backgroundColor = "darkgreen";

    }

    else
    {
      document.getElementById("c").style.backgroundColor = "rgb(212, 121, 125)";
      document.getElementById("m1").style.backgroundColor = "rgb(212, 121, 125)";
      document.getElementById("e").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("b1").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("b2").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("demo1").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("n").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("tr").style.color = "rgb(192, 39, 47)";
      document.getElementById("cf").style.color = "rgb(192, 39, 47)";
      document.getElementById("nvvv").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("a").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("h").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("hi").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("m").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("l").style.backgroundColor = "rgb(192, 39, 47)";
      document.getElementById("l3").style.backgroundColor = "rgb(192, 39, 47)";
      
        // Get the image element by ID
        var imageElement = document.getElementById("myImage");

        // Change the image source based on the condition
  
        imageElement.src = "d.jpg";
      

    }
  }

  color_change(2);

  document.addEventListener("DOMContentLoaded", function() {
  // Show loading overlay initially
  var loadingOverlay = document.querySelector(".loading-overlay");
  loadingOverlay.style.display = "flex"; // Make sure it's visible initially

  // Hide loading overlay after a delay
  setTimeout(function() {
    loadingOverlay.style.opacity = "0"; // Fade out the overlay
    setTimeout(function() {
      loadingOverlay.style.display = "none"; // Hide the overlay completely
    }, 300); // Adjust the delay to match the duration of the CSS fade-out transition
  }, 1000); // Adjust the delay before hiding the overlay (in milliseconds)
});
  </script>



</body>
</html>
