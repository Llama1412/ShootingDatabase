<html>
<title>Oundle Shooting Database </title>
<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div class="container">
	<div class="topbar" style="position: relative">
		<img class="topimage" src="images\barback.jpg" height="125">
		<div class="logo">
		<img src="images\OundleLogo.png" height="95" width="95">
		</div>
	</div>
	<div class="titlebar">
	<h1>Oundle School Shooting Database</h1>
		<div class="pagetitle">
		</div>
	</div>
		<div class="navbar">
			<div class="i0 active" onclick="location.href='index.php';"><h2>Homepage</h2></div>
			<div class="i1" onclick="location.href='deadlines.php';"><h2>Competition Deadlines</h2></div>
			<div class="i2" onclick="location.href='team.php';"><h2>The Team<h2></div>
			<div class="i3" onclick="location.href='scores.php';"><h2>Scores</h2></div>
			<div class="i4" onclick="location.href='gallery.php';"><h2>Gallery</h2></div>
			<div class="i5" onclick="location.href='admin.php';"><h2>Admin</h2></div>
		</div>
		<?php
		$userid = $_GET["id"];
		$dataPoints = array();
		
		$con=mysqli_connect("localhost","root","","shootingdatabase");
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		};

		$result = mysqli_query($con,"SELECT * FROM scores WHERE UserID = '" . $userid . "' ORDER BY Date");
		$k=0;
		
		while($row = mysqli_fetch_array($result))
			{
			array_push($dataPoints, array("label"=> $k, "y" => $row["Score"]));
			$k = $k+1;
			}
		
		
		?>
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
				maximum: <?php echo $k ?> - 1,
				interval: 1,
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
		<div id="chartContainer"></div>
		<script src="canvasjs.min.js"></script>
		
	<div class="footer">
	</div>
</div>
</body>
<html>