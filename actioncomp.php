<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');


$connect = mysqli_connect("localhost", "root", "", "shootingdatabase");
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
    mysqli_query($connect, $query);
}

echo json_encode($input)
?>
