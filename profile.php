<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarbonCatalyst - Profile</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

    .profile-container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border: solid black 1px;
      background-color: #dee2e6;
      width:90%;
    }

    .profile-picture {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 20px;
      object-fit: cover;
      border: solid black 1px;
    }

    .user-info {
      text-align: center;
      margin-bottom: 30px;
    }

    .post-container {
      border-top: 1px solid #dee2e6;
      padding-top: 20px;
    }

    .post {
      margin-bottom: 20px;
    }

    /* Responsive Navigation Bar */
    .navbar {
      background-color: darkgreen;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #ffffff;
    }

    /* Edit Profile Modal */
    #editProfileModal {
      text-align: left;
    }

    .total {
    flex-basis: 100%;
    margin-top: 20px;
    text-align:center;

    padding :30px 30px 30px 30px;
    display: flex;
    background-color: #dee2e6;
   
}
  </style>
</head>

<body>
<?php
 $email=$_SESSION['email'];
 $d  = date("d-m-Y");
 //$monthYear = date('m-Y', strtotime($d));
 $previousMonthYear = date('m-Y', strtotime('-1 month'));
 $dataPoints1 = array();
 $dataPoints2 = array();
 $dataPoints3= array();
 $dataPoints4= array();
 $s=0;
 $previousMonthYear1=date('m-Y', strtotime(date('Y-m-01') . ' -1 month'));
 
$data = array();

/*

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'cf';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
*/

try{

    $link = new \PDO(   'mysql:host=localhost;dbname=cf;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root',
                        '', 
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
            
    $handle = $link->prepare("select name , ebill,water,gas,transportation,plants,AQI,month from footprints where email= '$email' and DATE_FORMAT(month, '%m-%Y')='$previousMonthYear1' "); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    
		
    foreach($result as $row){
        array_push($dataPoints1, array("label"=> "electricity footprint", "y"=> $row->ebill));
		$s=$s+0.82*$row->ebill;
    }
	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "Water footprint", "y"=> $row->water));
		$s=$s+0.344*$row->water;
    }

	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "Gas footprint", "y"=> $row->gas));
		$s=$s+3.2*$row->gas;
    }
	

    foreach($result as $row){
      array_push($dataPoints1, array("label"=> "Transportation", "y"=> $row->transportation));
  //$s=$s+0.18*$row->transportation;
  }
	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "AQI", "y"=> $row->AQI));
		
    }

   


	array_push($dataPoints2, array("label"=> "electricity footprint", "y"=> 20));
	array_push($dataPoints2, array("label"=> "Water footprint", "y"=> 15));
	array_push($dataPoints2, array("label"=> "Gas footprint", "y"=> 10));
	array_push($dataPoints2, array("label"=> "AQI", "y"=>6));



    $handle1 = $link->prepare("select name , ebill  from footprints where email= '$email'"); 
    $handle1->execute(); 
    $result1 = $handle1->fetchAll(\PDO::FETCH_OBJ);

    $handle2 = $link->prepare("select name , ebill,water,gas,plants,AQI,month,transportation from footprints where email= '$email' order by month asc"); 
    $handle2->execute(); 
    $result2 = $handle2->fetchAll(\PDO::FETCH_OBJ);

    foreach($result1 as $row1){
        array_push($data, array("label"=> $row1->name, "y"=> $row1->ebill));
    }

    foreach($result2 as $row2){
      $d=$row2->month;
      $monthYear = date('m-Y', strtotime($d));
      array_push($dataPoints3, array("label"=>$monthYear , "y"=> 0.82*$row2->ebill + 0.344*$row2->water+3.2*$row2->gas))/*+0.18*$row2->transportation))*/;
      array_push($dataPoints4, array("label"=> $monthYear, "y"=> 200));
  }


	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}

$_SESSION['footprint']=$s;
	

?>


  <!-- Navigation Bar -->





  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">CarbonCatalyst</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Profile Container -->
  <div class="container profile-container">
    <div class="row">
      <div class="col-md-4">
      <?php
                 //  session_start();
                   $email=$_SESSION['email'];

                   $host = 'localhost';
                   $dbUsername = 'root';
                   $dbPassword = '';
                   $dbName = 'cf';
                   
                   $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM users where email='$email'";
                    $result = $conn->query($sql);

                    
                        $row = $result->fetch_assoc() ;
                    
                    
                    ?>
      <img src="images/<?php echo $row['img']; ?>" alt="" class="profile-picture img-fluid">
        <!--<img src="AJAY PARMAR.jpeg" alt="Profile Picture" class="profile-picture img-fluid">-->
      </div>
      <div class="col-md-8">
        <div class="user-info">
        <?php
                
                   $email=$_SESSION['email'];

                   $host = 'localhost';
                   $dbUsername = 'root';
                   $dbPassword = '';
                   $dbName = 'cf';
                   
                   $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM users where email='$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                           echo "<br><br><h3><strong>Name : ".$row['name']."</strong></h3>";
                           echo "<h3><strong>E-mail : ".$row['email']."</strong></h3>";
                           
                          
                        }
                    } else {
                        echo "<tr><td colspan='3'>No transactions found</td></tr>";
                    }

                    $conn->close();
                    ?>
        </div>
      </div>
    </div>

    <div class="post-container">
      
      <?php
                   
                   $email=$_SESSION['email'];
                   $footprint=$_SESSION['footprint'];

                   $host = 'localhost';
                   $dbUsername = 'root';
                   $dbPassword = '';
                   $dbName = 'cf';
                   
                   $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM users where email='$email'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                          $t=$_SESSION['footprint'];

                          if($t>200)
                          {
                            
                           echo "<br><br><br><h3> <strong>Carbon Footprint : <span style='color:red'>".$_SESSION['footprint'].' KgCO2e </span> </strong>'."</h3><br><br><br>";
                          }

                          else if($t<=200)
                          {
                            echo "<br><br><br><h3> <strong>Carbon Footprint : <span style='color:darkgreen'>".$_SESSION['footprint']. ' KgCO2e </span> </strong>'."</h3><br><br><br>";
                          }
                          
                          
                        }
                    } else {
                        echo "<tr><td colspan='3'>No transactions found</td></tr>";
                    }

                    $conn->close();



                    ?>
      </div>
      <!-- Add more posts as needed -->
    </div>
  </div>

  <!--vis-->
  

<div class="total">

<div id="linechartContainer" style="height: 370px; width: 100%;"></div>

</div>


  <!-- Edit Profile Modal -->
  <div class="modal" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Add your form for editing profile information here -->
          <form action="update_profile.php"  method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
              <label for="editName">Name</label>
              <input type="text" class="form-control" name="editName" placeholder="Your Name">
            </div>
            
             <!--<div class="form-group">
              <label for="a">Profle Picture</label>-->
              
              
              <br>
              <input type="file" name="a" accept="image/x-png,image/gif,image/jpeg,image/jpg" placeholder="Choose Photo" required><br><br>
              
              
              
           <!-- </div>-->
           <!--- <div class="form-group">
              <label for="editEmail">Email</label>
              <input type="email" class="form-control" name="editEmail" placeholder="Your Email">
            </div>
            
            -->
            <div class="form-group">
              <label for="editLocation">Location</label>
              <input type="text" class="form-control" name="editLocation" placeholder="Your Location">
            </div>
            <button type="submit" class="btn" style="background-color: darkgreen; color:white">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

window.onload = function() {
  var line = new CanvasJS.Chart("linechartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Monthly Visualizations"
	},
	
		axisX: {
		title: "Months"
	},
	
	axisY: {
		title: "Footprint (in KgCO2e)"
	},
	/*data: [{
		type: "line",
		yValueFormatString: "#,##0.## Units",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]*/


	
	data: [{
		type: "line",
		name: "Ideal footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
	},
  {
		type: "line",
		name: "Actual footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}
]
});


line.render();

}
</script>
  

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>

</html>
