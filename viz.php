<?php
 session_start();
 $email=$_SESSION['email'];
 $d=$_POST['date'];
 $monthYear = date('m-Y', strtotime($d));
$dataPoints1 = array();
$dataPoints2 = array();
$s=0;

$data = array();

try{

    $link = new \PDO(   'mysql:host=localhost;dbname=cf;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root',
                        '', 
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare("select name , ebill,water,gas,transportation,plants,AQI from footprints where email= '$email' and DATE_FORMAT(month, '%m-%Y')='$monthYear' "); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints1, array("label"=> "electricity footprint", "y"=> 0.82*$row->ebill));
		$s=$s+$row->ebill;
    }
	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "Water footprint", "y"=> 0.344*$row->water));
		$s=$s+$row->water;
    }

	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "Gas footprint", "y"=> 3.2*$row->gas));
		$s=$s+$row->gas;
    }

	foreach($result as $row){
		array_push($dataPoints1, array("label"=> "Transportation", "y"=> 0.18*$row->transportation));
	$s=$s+$row->transportation;
	}
	

/*	foreach($result as $row){
        array_push($dataPoints1, array("label"=> "AQI", "y"=> $row->AQI));
		
    }*/


	array_push($dataPoints2, array("label"=> "electricity footprint", "y"=> 164));//200
	array_push($dataPoints2, array("label"=> "Water footprint", "y"=> 1.032));//3000
	array_push($dataPoints2, array("label"=> "Gas footprint", "y"=> 32));//10
	array_push($dataPoints2, array("label"=> "Transportation", "y"=> 54));//300
	//array_push($dataPoints2, array("label"=> "AQI", "y"=>6));



    $handle1 = $link->prepare("select name , ebill  from footprints where email= '$email'"); 
    $handle1->execute(); 
    $result1 = $handle1->fetchAll(\PDO::FETCH_OBJ);
    foreach($result1 as $row1){
        array_push($data, array("label"=> $row1->name, "y"=> $row1->ebill));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}

$_SESSION['footprint']=$s;
	
?>


<!DOCTYPE HTML>
<html>
<head>
    <style>
        .total {
    flex-basis: 100%;
    margin-top: 20px;
    text-align:center;

    padding :30px 30px 30px 30px;
    display: flex;
}
    </style>
<script>
window.onload = function() {
 



	var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Carbon Footprint Visualization"
	},
	axisY:{
		includeZero: true,
			title: "Footprint (in KgCO2e)"
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},

	data: [{
		type: "column",
		name: "Actual footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.## KgCO2e",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Ideal Footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.## KgCO2e",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

var pi = new CanvasJS.Chart("pichartContainer", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Overview"
	},
	axisY: {
		title: "Footprint (in KgCO2e)"
	},
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.## KgCO2e",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});


pi.render();



var line = new CanvasJS.Chart("linechartContainer", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Comparison with ideal values"
	},
	axisY: {
		title: "Footprint (in KgCO2e)"
	},
	/*data: [{
		type: "line",
		yValueFormatString: "#,##0.## Units",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]*/


	
	data: [{
		type: "line",
		name: "Actual footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.## KgCO2e",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	},{
		type: "line",
		name: "Ideal Footprint",
		indexLabel: "{y}",
		yValueFormatString: "#0.## KgCO2e",
		showInLegend: true,
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});


line.render();




 
}
</script>
</head>
<body>
    <br>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<br>

<div class="total">

<div id="pichartContainer" style="height: 370px; width: 100%;"></div>
&nbsp;&nbsp;
<div id="linechartContainer" style="height: 370px; width: 100%;"></div>

</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              