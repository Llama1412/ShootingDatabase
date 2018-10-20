<html>
<title>Oundle Shooting Database </title>
<link rel="stylesheet" type="text/css" href="login.css">

<?php
		session_start();
		if (isset($_SESSION["valid"])) {
			header("Location: admin.php");
		}
		?>

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
			<div class="i2" onclick="location.href='team.php';"><h2>The Team<h2></div>
			<div class="i3" onclick="location.href='scores.php';"><h2>Scores</h2></div>
			<div class="i4" onclick="location.href='gallery.php';"><h2>Gallery</h2></div>
			<div class="i5 active" onclick="location.href='admin.php';"><h2>Admin</h2></div>
		</div>



		<div class="loginholder">
		<div class="login-page">
			<div class="form">
				<form class="login-form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
					<h1 class="titletext">Admin Login</h1>
					<input name="pass" type="text" placeholder="password">
					<button>login</button>
				</form>


				<?php
				if (isset($_SESSION["msg"])) {
					echo $_SESSION["msg"];
					$_SESSION["msg"] = "";
				}

				if (!empty($_POST['pass'])) {
					if ($_POST["pass"] == "TestPassword123") {
						$_SESSION["valid"] = true;
						$_SESSION["time"] = time();
						header("Location: admin.php");
					} else {
						echo "Incorrect password";
					}
				}
	  			?>



			</div>
		</div>
		</div>
		
		
		
	<div class="footer">
	</div>
</div>
</body>
<html>