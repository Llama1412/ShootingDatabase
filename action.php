<?php
include 'connection.php';
header('Content-Type: application/json');

$input = filter_input_array(INPUT_POST);

$firstname = mysqli_real_escape_string($connect, $input["FirstName"]);
$surname = mysqli_real_escape_string($connect, $input["Surname"]);
$house = mysqli_real_escape_string($connect, $input["House"]);
$year = mysqli_real_escape_string($connect, $input["Year"]);




if ($input["action"] === "edit" )
{
    $query = "
        UPDATE people
        SET FirstName = '".$input["firstname"]."',
        Surname = '".$input["surname"]."',
        House = '".$input["house"]."',
        Year = '".$input["year"]."'
        WHERE UserID = '".$input["UserID"]."'";
        mysqli_query($connect, $query);
}
if ($input["action"] === "delete") {
    $query = "
    DELETE FROM people
    WHERE UserID = '".$input["UserID"]."'";
    mysqli_query($connection, $query);
}

echo json_encode($input)
?>
