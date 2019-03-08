<?php
    $DS = DIRECTORY_SEPARATOR;
    file_exists(__DIR__ . $DS . 'core' . $DS . 'Handler.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Handler.php' : die('Handler.php not found');
    file_exists(__DIR__ . $DS . 'core' . $DS . 'Config.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Config.php' : die('Config.php not found');
    include 'connection.php';
    use AjaxLiveSearch\core\Config;
    use AjaxLiveSearch\core\Handler;
    
    if (session_id() == '') {
        session_start();
    }
    
        $handler = new Handler();
        $handler->getJavascriptAntiBot();
    ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="css/favicon.ico">
        <title>Shooting Database</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">        <link href="css/jumbotron.css" rel="stylesheet">
        <link href="css/jumbotron.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/animation.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="deadlines.php">Competition Deadlines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Admin</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input type="text" class='mySearch input-medium' id="ls_query" placeholder="Search people">
                </form>
            </div>
        </nav>
        <main role="main">
            <div class="container container-fluid" style="margin-top: 3%;">
                <?php
                    if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    };
                    $results = mysqli_query($connection,"SELECT * FROM people WHERE UserID = '" . $_GET["id"] . "'");
                    $row = mysqli_fetch_array($results);  
                    echo "<h1>" . $row["FirstName"] . " " . $row["Surname"] . "</h1>";                
                    ?>
                <div class="row">
                    <div class="col" id="chartContainer">
                        <!-- Graph-->
                        <?php
                            $userid = $_GET["id"];
                                  $xaxis = array();
                                  $yaxis = array();
                                  
                                  if (mysqli_connect_errno()) {
                                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                  };
                            
                                  $result = mysqli_query($connection,"SELECT * FROM scores WHERE UserID = '" . $_GET["id"] . "'");
                                  $k=1;
                                  $tot=0;
                                  $averagePoints=[];
                                  $average=0;
                                  
                                  while($row = mysqli_fetch_array($result)) {
                                      array_push($xaxis, $k);
                                      array_push($yaxis, $row["Score"]);
                                      $k = $k+1;
                                      $tot = $tot + $row["Score"];
                                  }
                                  $average = $tot/($k-1);
                            
                                  ?>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-striped table-fluid text-center" style="align: center;">
                        <tr>
                            <th>Score</th>
                            <th>Target Type</th>
                            <th>Date</th>
                        </tr>
                        <?php
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            };
                    
                            $result = mysqli_query($connection,"SELECT * FROM scores WHERE UserID = '" . $_GET["id"] . "'");
                                                
                            while($row = mysqli_fetch_array($result))
                            {
                            $date = date("j/n/y", strtotime($row['Date']));
                            
                            echo "<tr>";
                            echo "<td>" . $row['Score'] . "</td>";
                            echo "<td>" . $row['Target'] . "</td>";
                            echo "<td>" . $date . "</td>";
                            echo "</tr>";
                            };
                            echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <script src="node_modules\chart.js\dist\Chart.bundle.js"></script>
        <script src="node_modules\chartjs-plugin-annotation\chartjs-plugin-annotation.js"></script>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: <?php echo json_encode($xaxis, JSON_NUMERIC_CHECK); ?>,
                datasets: [{
                    data: <?php echo json_encode($yaxis, JSON_NUMERIC_CHECK); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
                },
                options: {
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            min:0
                        }
                        }]
                    },
                    legend: {
                        display: false,
                    },
                    annotation: {
                        annotations: [{
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: <?php echo $average ?>,
                            borderColor: 'rgb(255, 0, 0)',
                            borderWidth: 4,
                            label: {
                                enabled: true,
                                content: 'Average = ' + <?php echo $average ?>,
                                position: "left",
                                yAdjust: 20,
                                }
                        }]
                    }

                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.11.1.min.js"></script>
        <!-- Live Search Script -->
        <script type="text/javascript" src="js/ajaxlivesearch.min.js"></script>
        <script>
            jQuery(document).ready(function(){
                jQuery(".mySearch").ajaxlivesearch({
                    loaded_at: <?php echo time(); ?>,
                    token: <?php echo "'" . $handler->getToken() . "'"; ?>,
                    max_input: <?php echo Config::getConfig('maxInputLength'); ?>,
                    onResultClick: function(e, data) {
                        // get the index 0 (first column) value
                        var selectedOne = jQuery(data.selected).find('td').eq('0').text();
                        if (selectedOne.length !== 0) {
                            window.location.href = 'scores.php?id=' + selectedOne;
                        }
                        
                    },
                    onResultEnter: function(e, data) {
                        // do whatever you want
                        // jQuery("#ls_query").trigger('ajaxlivesearch:search', {query: 'test'});
                    },
                    onAjaxComplete: function(e, data) {
            
                    }
                });
            })
        </script>
    </body>
</html>
