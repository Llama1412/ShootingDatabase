<?php
 
$dataPoints = array(
	array("label"=> 1, "y"=> 79),
	array("label"=> 2, "y"=> 99),
	array("label"=> 3, "y"=> 100),
	array("label"=> 4, "y"=> 89),
	array("label"=> 5, "y"=> 91),
	array("label"=> 6, "y"=> 93),
	array("label"=> 7, "y"=> 95),
	array("label"=> 8, "y"=> 95),
	array("label"=> 9, "y"=> 92),
	array("label"=> 10, "y"=> 96),
	array("label"=> 11, "y"=> 52),
	array("label"=> 12, "y"=> 99),
	array("label"=> 13, "y"=> 99),
	array("label"=> 14, "y"=> 98),
	array("label"=> 15, "y"=> 96),
	array("label"=> 16, "y"=> 95),
	array("label"=> 17, "y"=> 99),
	array("label"=> 18, "y"=> 93),
	array("label"=> 19, "y"=> 86),
	array("label"=> 20, "y"=> 100)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	//theme: "light2",
	title:{
		text: "User's Scores"
	},
	axisX:{
		minimum: 0,
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: "Score",
		maximum: 104,
		interval: 5,
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="canvasjs.min.js"></script>
</body>
</html>        