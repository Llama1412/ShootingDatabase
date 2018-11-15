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
    if (!isset($_SESSION["valid"])) {
        header("Location: login.php");
        $_SESSION["msg"] = "<br> Please login";
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="css/jumbotron.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/animation.css">
        <script src="js\jquery-1.11.1.min.js"></script>
        <script src="js\jquery.tabledit.min.js"></script>
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
                        <a class="nav-link" href="admin.php" style="color: #e2b331">Edit Users</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="adminscores.php">Edit Scores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admincompetitions.php" style="color: #e2b331">Edit Competitions</a>
                    </li>
                    </li class="nav-item">

                    <a class="nav-link" href="logout.php" style="color: #ff4538"><strong>Logout</strong></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input type="text" class='mySearch input-medium' id="ls_query" placeholder="Search people">
                </form>
            </div>
        </nav>












        <main role="main">
            <div class="container container-fluid" style="margin-top: 3%;">
                <div class="row">
                    <div class="col">
                        <h1>Admin page</h1>
                        <h2>Edit Scores</h2>
                        <input type="text" id="filter" placeholder="filter by name" class="tabledit-input form-control input-sm" onkeyup="filterFunction()">
                        <table id="maintable" class="table table-hover table-striped table-fluid text-center" style="align: center;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Shooter</th>
                                <th>Date</th>
                                <th>Score</th>
                                <th>Target</th>
                            </tr>
                        </thead>
                        <tbody>
                        <script>
                        function filterFunction() {
                        // Declare variables 
                        var input, filter, table, tr, td, i;
                        input = document.getElementById("filter");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("maintable");
                        tr = table.getElementsByTagName("tr");

                        // Loop through all table rows, and hide those who don't match the search query
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[1];
                            if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                            } 
                        }
                        }
                        </script>
                            <?php
                                if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }; 
                                $result = mysqli_query($connection, "SELECT * FROM scores ORDER BY ScoreID DESC");
                                while($row = mysqli_fetch_array($result))
                                {;
                                $userdata = mysqli_query($connection,"SELECT * FROM people WHERE UserID = '" .  $row["UserID"] . "'");
                                if (!$userdata) {
                                   printf("Error: %s\n", mysqli_error($connection));
                                   exit();
                                }
                                $userinfo = mysqli_fetch_array($userdata);
                                $shooter = $userinfo["FirstName"] . " " . $userinfo["Surname"];
                                echo "<tr>";
                                echo "<td>" . $row['ScoreID'] . "</td>";
                                echo "<td>" . $shooter . "</td>";
                                echo "<td>" .  $row['Date'] . "</td>";
                                echo "<td>" .  $row['Score'] . "</td>";
                                echo "<td>" .  $row['Target'] . "</td>";
                                echo "</tr>";
                                };
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                            <script>
                                $('#maintable').Tabledit({
                                    url: 'actionscore.php',
                                    columns: {
                                        identifier: [0, 'scoreid'],
                                        editable: [[2, 'date'], [3, 'score'], [4, "target"]]
                                    },
                                    buttons: {
                                        edit: {
                                            class: 'btn btn-sm btn-default btn-success',
                                            html: 'Edit',
                                            action: 'edit'
                                        },
                                        delete: {
                                            class: 'btn btn-sm btn-default btn-danger',
                                            html: 'Delete',
                                            action: 'delete'
                                        },
                                        save: {
                                            class: 'btn btn-sm btn-success',
                                            html: 'Save'
                                        },
                                        restore: {
                                            class: 'btn btn-sm btn-warning',
                                            html: 'Restore',
                                            action: 'restore'
                                        },
                                        confirm: {
                                            class: 'btn btn-sm btn-danger',
                                            html: 'Confirm'
                                        }
                                    }
                                });
                            </script>
                            <h2>Add Scores</h2>
                            <form action="addscore.php" method="post">
                            <table class="table table-hover table-striped table-fluid text-center">
                                <thead>
                                    <tr>
                                        <th>Shooter</th>
                                        <th>Date</th>
                                        <th>Score</th>
                                        <th>Target</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th><select name="shooter" class="form-control">
                                        <?php
                                        if (mysqli_connect_errno()) {
                                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                        }; 
                                        $result = mysqli_query($connection, "SELECT * FROM people ORDER BY Surname ASC");
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<option value='". $row["UserID"]."'>".$row["FirstName"]." ".$row["Surname"]."</option>";
                                        }
                                        ?>
                                    </select></th>
                                    <th><input class="tabledit-input form-control input-sm" type="date" name="date" placeholder="Date"></th>
                                    <th><input class="tabledit-input form-control input-sm" type="number" name="score" placeholder="Score"></th>
                                    <th><input class="tabledit-input form-control input-sm" type="number" name="target" placeholder="Target"></th>
                                    <th><button type="submit" class="tabledit-edit-button btn btn-sm btn-default btn-success" style="float: none;">Add</button></th>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
        </main>
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