<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="css/favicon.ico">
        <title>Shooting Database</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/jumbotron.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="index.php"><img src="images/OundleLogoWhite.png" style="height: 50px; width: 50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deadlines.php">Competition Deadlines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Admin</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <main role="main">
            <div class="bimage container-fluid" style="background: url('images/backgrounds/toby.png'); background-size: 100%;">
                <div class="jumbotron container-fluid" style="min-height: 30%; background:rgba(255,255,255,0)">
                    <div class="container" style="min-height: 30%">
                        <h1 class="display-2" style="padding-top: 10%; padding-bottom: 10%; text-align: center; color: #f2f5f9; overflow: hidden;"><strong>
                            Oundle School Shooting Database
                            </strong>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 3%;">
                <div class="row">
                    <div class="col" style="">
                        <h2>Upcoming Competitions</h2>
                        <table class='table table-hover table-striped table-fluid' style="width: 100%;">
                        <tr>
                            <th>Competition Name</th>
                            <th>Next Round</th>
                            <th>Deadline</th>
                        </tr>
                        <?php
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
                    <div class="col" style="width: 100%;">
                        <h2>Recent High Scores</h2>
                        <table class="table table-hover table-striped table-fluid" style="align: center;">
                        <tr>
                            <th style="align: center;">Last Name</th>
                            <th>First Name</th>
                            <th>Score</th>
                            <th>Target Type</th>
                            <th>Date</th>
                        </tr>
                        <?php
                            $con=mysqli_connect("localhost","root","","shootingdatabase");
                            if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            };
                            
                            $result = mysqli_query($con,"SELECT * FROM scores ORDER BY Score DESC LIMIT 5");
                            
                            
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
            </div>
            </div>
            </div>
            <hr>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
        <script src="jspopper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>