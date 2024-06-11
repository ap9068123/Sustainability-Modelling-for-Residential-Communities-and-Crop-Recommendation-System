<?php
 
$dataPoints = array(
	array("label" => "Oven", "y" => array(4, 6, 8, 9, 7)),
	array("label" => "Microwawe", "y" => array(5, 6, 7, 8, 6.5)),
	array("label" => "PC & Peripherals", "y" => array(6, 8, 10, 11, 9.5)),
	array("label" => "Air Conditioner", "y" => array(8, 9, 13, 14, 10.5)),
	array("label" => "Dishwasher", "y" => array(5, 7, 9, 12, 7.5)),
	array("label" => "Electric Kettle", "y" => array(4, 6, 8, 9, 7)),
	array("label" => "Fridge", "y" => array(8, 9, 12, 13, 11))
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "dark2",
	title: {
		text: "Energy Consumption",
		fontColor: "white"
	},
	axisY: {
		title: "Energy Consumption (in kWh)"
	},
	data: [{
		type: "boxAndWhisker",
		color: "white",
		upperBoxColor: "red",
		lowerBoxColor: "blue",
		yValueFormatString: "#,##0 kWh",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<br><br>
<br><br>
<div id="chartContainer" style="height: 370px; width: 100%;">
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html> 