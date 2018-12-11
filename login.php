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
	if (isset($_SESSION["valid"])) {
		header("Location: admin.php");
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
        <link rel="stylesheet" href="login.css">

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
                    <li class="nav-item active">
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
                <div class="row">
                    <div class="col">
                        <div class="login-page">
			                <div class="form">
				                <form class="login-form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
					                <h1 class="titletext">Admin Login</h1>
					                <input name="pass" type="password" placeholder="password" type="password">
					                <button>login</button>
				                </form>

                                <?php
                                if (isset($_SESSION["msg"])) {
                                    echo $_SESSION["msg"];
                                    $_SESSION["msg"] = "";
                                }
                                $result = mysqli_query($connection,"SELECT * FROM credentials WHERE identifier = 1");
                                
                                while($row = mysqli_fetch_array($result))
                                {
                                    $hashedpass = $row['PassHash'];
                                };
                                if (!empty($_POST['pass'])) {
                                    if (hash("sha512", $_POST["pass"]) == $hashedpass) {
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