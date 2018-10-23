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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
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
            <div class="container container-fluid" style="margin-top: 3%;">
                <div class="row">
                    <div class="col">
                        <table class='table table-hover table-striped table-fluid' style="width: 100%;">
                        <tr>
                            <th>Name</th>
                            <th>Round 1</th>
                            <th>Round 2</th>
                            <th>Round 3</th>
                            <th>Round 4</th>
                            <th>Round 5</th>
                        </tr>
                        <?php
                            $con=mysqli_connect("localhost","root","","shootingdatabase");
                            if (mysqli_connect_errno()) {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            };
                            
                            $result = mysqli_query($con,"SELECT * FROM competitions ORDER BY Name");
                            
                            
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
                </div>
            </div>
            <div class="footer">
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