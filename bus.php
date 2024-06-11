<!DOCTYPE html>
<html lang="en">
<head>
     <title>CarbonCatalyst - Bus Service</title>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Four-Wheeler Route between Two Cities</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <style>
    
        .container {
    display: flex;
    justify-content: space-between; /* Aligns items to the beginning and end of the container */
  }
        table
        {
            width: 50%;
        }

        tr{
            border: solid black 2px;
            

        }

        th{
            background-color: darkgreen;
            color:white;
            padding: 18px 18px 18px 18px;
            border: solid black 2px;
            text-decoration: solid;
        }

        
        td{
            padding: 15px 15px 15px 15px;
            border: solid black 2px;
            text-align: center;
            

        }
          #map {
              width:50%;
       height: 400px;
      padding-top: 50px ;
      border:solid black 1px;
    }
    
    #p
    {
        border:solid black 1px;
    }
    </style>
</head>
<body>
 
<div class="container">   
    


<?php

$s=$_POST['source'];
$d=$_POST['destination'];
$date=$_POST['date'];
$csvFile = 'bus_dataset1.csv';


$fileHandle = fopen($csvFile, 'r');


if ($fileHandle === false) {
    die('Error opening file');
}


$filteredData = [];
$m=9999999;

echo "<div id='p'>";
echo "<table  align='center'>";
echo "<h1  align='center'>All Available Buses  </h1>";
echo '<tr><th>Bus Id</th><th>Source</th><th>Destination</th><th>Distance (in Kms)</th><th>Fare (in Rs)</th>
<th>Time (in 24 hrs format)</th>
<th>Day</th></tr>';

while (($data = fgetcsv($fileHandle)) !== false) {
 
    $dayOfWeek = date("l", strtotime($date));

    if ($data[1]==$s && $data[2]==$d && $data[6]==$dayOfWeek) {
        // Add filtered data to the result array

        if($m>(int)$data[3])
        {
            $m=(int)$data[3];
        }

        $filteredData[] = $data;
        echo '<tr>';
        echo '<td>'.$data[0]. '<br>'.'</td>';
        echo '<td>'.$data[1]. '<br>'.'</td>';
        echo '<td>'.$data[2]. '<br>'.'</td>';
        echo '<td>'.$data[3]. '<br>'.'</td>';
        echo '<td>'.$data[4]. '<br>'.'</td>';
        echo '<td>'.$data[5]. '<br>'.'</td>';
        echo '<td>'.$data[6]. '<br>'.'</td>';
        echo '</tr>';
    }

  
    
}

echo "</table>";

echo "</div>";

?>

<div id="map" align="center">
    
</div>
<?php

echo "</div>";
$fileHandle1 = fopen($csvFile, 'r');

echo "<table><h1 align='center'>Best Route </h1>";
    echo "<table  align='center'>";
echo '<tr><th>Bus Id</th><th>Source</th><th>Destination</th><th>Distance (in Kms)</th><th>Fare (in Rs)</th>
<th>Time (in 24 hrs format)</th>
<th>Day</th></tr>';

    while (($data1 = fgetcsv($fileHandle1)) !== false)
    {
        if ($data1[1]==$s && $data1[2]==$d && $data1[6]==$dayOfWeek && $m==(int)$data1[3]) {
            
    
           
    
            //$filteredData[] = $data;
            echo '<tr>';
            echo '<td>'.$data1[0]. '<br>'.'</td>';
            echo '<td>'.$data1[1]. '<br>'.'</td>';
            echo '<td>'.$data1[2]. '<br>'.'</td>';
            echo '<td>'.$data1[3]. '<br>'.'</td>';
            echo '<td>'.$data1[4]. '<br>'.'</td>';
            echo '<td>'.$data1[5]. '<br>'.'</td>';
            echo '<td>'.$data1[6]. '<br>'.'</td>';
            echo '</tr>';
        }
    }


    echo "</table>";
    


fclose($fileHandle);




?>

   <br><br><br>
 

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
  <script>

 
    var map = L.map('map').setView([0, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var control = L.Routing.control({
      waypoints: [],
      routeWhileDragging: true,
      router: L.Routing.osrmv1({
        serviceUrl: 'https://router.project-osrm.org/route/v1'
      }),
      lineOptions: {
        styles: [{color: 'blue', opacity: 0.6, weight: 4}]
      }
    }).addTo(map);


    
    function cityToCoordinates(cityName, callback) {
      var geocoder = L.Control.Geocoder.nominatim();
      geocoder.geocode(cityName, function(results) {
        if (results.length > 0) {
          var coords = results[0].center;
          var lat = coords.lat;
          var lng = coords.lng;
          callback(lat, lng);
        } else {
          callback(null, null);
        }
      });
    }
   



   
      var city1 = "<?php echo $s; ?>";//document.getElementById('city1').value;
      var city2 = "<?php echo $d; ?>";//document.getElementById('city2').value;
      console.log(city1);
      
   var a;
    var b;

     var r;
     var s;
   
     
       cityToCoordinates(city1, function(lat, lng) {
        if (lat !== null && lng !== null) {
            
            if(a==null && b==null)
            {
             a=lat;
             b=lng;
          
            }
          console.log('Latitude for ' + city1 + ':', lat);
          console.log('Longitude for ' + city1 + ':', lng);
        
        } else {
          console.log('Coordinates not found for ' + city1);
        }
      });

     

      cityToCoordinates(city2, function(lat, lng) {
        if (lat !== null && lng !== null) {
            
             control.setWaypoints([
      /* L.latLng([23.2584857,77.401989 ]), 
        L.latLng([22.7203616,75.868199])  */

        L.latLng([a,b]), 
        L.latLng([lat,lng])  
      ]);
            
              if(r==null && s==null)
            {
             r=lat;
             s=lng;
          
            }
          console.log('Latitude for ' + city2 + ':', lat);
          console.log('Longitude for ' + city2 + ':', lng);
         
        } else {
          console.log('Coordinates not found for ' + city2);
        }
      });


      // Manually specify coordinates for cities
    
       console.log(a);

     
    
  </script>

</body>
</html>

