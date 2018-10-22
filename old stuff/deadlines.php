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
			<div class="i0" onclick="location.href='index.php';"><h2>Homepage</h2></div>
			<div class="i1 active" onclick="location.href='deadlines.php';"><h2>Competition Deadlines</h2></div>
			<div class="i2" onclick="location.href='team.php';"><h2>The Team<h2></div>
			<div class="i3" onclick="location.href='scores.php';"><h2>Scores</h2></div>
			<div class="i4" onclick="location.href='gallery.php';"><h2>Gallery</h2></div>
			<div class="i5" onclick="location.href='admin.php';"><h2>Admin</h2></div>
		</div>
		
		<div class="deadtable">
			<?php
			$con=mysqli_connect("localhost","root","","shootingdatabase");
			if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			};

			$result = mysqli_query($con,"SELECT * FROM competitions ORDER BY Name");

			echo "<table class='deadlinestable'>
				<tr>
					<th>Name</th>
					<th>Round 1</th>
					<th>Round 2</th>
					<th>Round 3</th>
					<th>Round 4</th>
					<th>Round 5</th>
				</tr>";
	
			while($row = mysqli_fetch_array($result))
			{
			$date1 = date("d/m/y", strtotime($row['R1']));
			$date2 = date("d/m/y", strtotime($row['R2']));
			$date3 = date("d/m/y", strtotime($row['R3']));
			$date4 = date("d/m/y", strtotime($row['R4']));
			$date5 = date("d/m/y", strtotime($row['R5']));
			
			echo "<tr>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $date1 . "</td>";
			echo "<td>" . $date2 . "</td>";
			echo "<td>" . $date3 . "</td>";
			echo "<td>" . $date4 . "</td>";
			echo "<td>" . $date5 . "</td>";
			echo "</tr>";
			};
			echo "</table>";
			?>
		
		</div>
	<div class="footer">
	</div>
</div>
</body>
<html>