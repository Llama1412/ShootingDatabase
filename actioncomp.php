<?php
header('Content-Type: application/json');
include 'connection.php';

$input = filter_input_array(INPUT_POST);



if ($input["action"] === "edit" )
{
    $query = "
        UPDATE competitions
        SET Name = '".$input["name"]."',
        Type = '".$input["type"]."',
        R1 = '".$input["r1"]."',
        R2 = '".$input["r2"]."',
        R3 = '".$input["r3"]."',
        R4 = '".$input["r4"]."',
        R5 = '".$input["r5"]."'

        WHERE CompID = '".$input["compid"]."'";
        mysqli_query($connect, $query);
}
if ($input["action"] === "delete") {
    $query = "
    DELETE FROM competitions
    WHERE CompID = '".$input["compid"]."'";
    mysqli_query($connection, $query);
}

echo json_encode($input)
?>