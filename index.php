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
			<div class="i5" onclick="location.href='login.php';"><h2>Admin</h2></div>
		</div>
	<div class="deadlines">
	<?php
	echo "<table>
		<tr>
			<th>Competition Name</th>
			<th>Next Round</th>
			<th>Deadline</th>
		</tr>";
		
	$con=mysqli_connect("localhost","root","","shootingdatabase");
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	};
	$result = mysqli_query($con,"SELECT * FROM competitions");
	
	while($row = mysqli_fetch_array($result)) 
	{
		$timestamp = time();
		$r1 = strtotime($row["R1"]);
		$r2 = strtotime($row["R2"]);
		$r3 = strtotime($row["R3"]);
		$r4 = strtotime($row["R4"]);
		$r5 = strtotime($row["R5"]);
		$nexttime = 0;
		$nextdate = "";
		$nextround = "";
		$run = True;
		
		while($run) {
			if ($timestamp < $r1) {
				$nextround = "Round 1";
				$nexttime = $r1;
				break;
			}
				
			elseif ($timestamp < $r2) {
				$nextround = "Round 2";
				$nexttime = $r2;
				break;
			}
			
			elseif ($timestamp < $r3) {
				$nextround = "Round 3";
				$nexttime = $r3;
				break;
			}
			
			elseif ($timestamp < $r4) {
				$nextround = "Round 4";
				$nexttime = $r4;
				break;
			}
			
			elseif ($timestamp < $r5) {
				$nextround = "Round 5";
				$nexttime = $r5;
				break;
			}
			
			else {
				break;
			}
			
		};
		
		if ($nexttime != 0) {
			$nextdate = date("j/n/y", $nexttime);
			echo "<tr>";
			echo "<td>" . $row["Name"] . "</td>";
			echo "<td>" . $nextround . "</td>";
			echo "<td>" . $nextdate . "</td>";
			echo "</tr>";
			
		}
	}
		
	
	
	
	echo "</table>";
	?>
	</div>
	<div class="topscores">
	<?php
	$con=mysqli_connect("localhost","root","","shootingdatabase");
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	};

	$result = mysqli_query($con,"SELECT * FROM scores ORDER BY Score DESC LIMIT 5");

	echo "<table>
		<tr>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Score</th>
			<th>Target Type</th>
			<th>Date</th>
		</tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	$userdata = mysqli_query($con,"SELECT * FROM people WHERE UserID = '" .  $row["UserID"] . "'");
	if (!$userdata) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
	$userinfo = mysqli_fetch_array($userdata);
	$date = date("j/n/y", strtotime($row['Date']));
	
	echo "<tr>";
	echo "<td>" . $userinfo['Surname'] . "</td>";
	echo "<td>" . $userinfo['FirstName'] . "</td>";
	echo "<td>" . $row['Score'] . "</td>";
	echo "<td>" . $row['Target'] . "</td>";
	echo "<td>" . $date . "</td>";
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