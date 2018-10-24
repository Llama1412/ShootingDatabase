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
			<div class="i1" onclick="location.href='deadlines.php';"><h2>Competition Deadlines</h2></div>
			<div class="i2 active" onclick="location.href='team.php';"><h2>The Team<h2></div>
			<div class="i3" onclick="location.href='scores.php';"><h2>Scores</h2></div>
			<div class="i4" onclick="location.href='gallery.php';"><h2>Gallery</h2></div>
			<div class="i5" onclick="location.href='admin.php';"><h2>Admin</h2></div>
		</div>
	<div class="searchbar">
		<script src="searcher.js"></script>
		<input type="text" id="Search" onkeyup="search()" placeholder="Search for users..">

		<ul id="Users">
			<?php
				$con=mysqli_connect("localhost","root","","shootingdatabase");
				if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				};
				$result = mysqli_query($con,"SELECT * FROM people ORDER BY Surname");
				while($row = mysqli_fetch_array($result))
				{
				echo "<li><a href='results.php?id=" . $row['UserID'] . "'>" . $row['FirstName'] . " " . $row['Surname'] . "</a></li>";
				};
			?>
		</ul>
	</div>
	<div class="footer">
	</div>
</div>
</body>
<html>