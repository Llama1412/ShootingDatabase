<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');


$connect = mysqli_connect("localhost", "root", "", "shootingdatabase");

$firstname = $_POST["firstname"];
$surname = $_POST["surname"];
$house = $_POST["house"];
$year = $_POST["year"];

$query = "INSERT INTO people (FirstName, Surname, House, Year) VALUES ('".$firstname."', '".$surname."', '".$house."', '".$year."');";
mysqli_query($connect, $query);
header("location:admin.php");    
?>
