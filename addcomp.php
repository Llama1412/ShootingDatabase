<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');



$name = $_POST["name"];
$r1 = $_POST["r1"];
$r2 = $_POST["r2"];
$r3 = $_POST["r3"];
$r4 = $_POST["r4"];
$r5 = $_POST["r5"];


$query = "INSERT INTO competitions (Name, R1, R2, R3, R4, R5) VALUES ('".$name."', '".$r1."', '".$r2."', '".$r3."', '".$r4."', '".$r5."');";
mysqli_query($connection, $query);
header("location:admincompetitions.php");    
?>
