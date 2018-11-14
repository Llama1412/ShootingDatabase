<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');



$name = $_POST["shooter"];
$date = $_POST["date"];
$score = $_POST["score"];
$target = $_POST["target"];



$query = "INSERT INTO scores (UserID, Date, Score, Target) VALUES ('".$name."', '".$date."', '".$score."', '".$target."');";
mysqli_query($connection, $query);
header("location:adminscores.php");    
?>
