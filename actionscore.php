<?php

// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
// Note that is just an example. Should take precautions such as filtering the input data.

header('Content-Type: application/json');
include 'connection.php';

$input = filter_input_array(INPUT_POST);


if ($input["action"] === "edit" )

{
    $query = "
        UPDATE scores
        SET Date = '".$input["date"]."',
        Score = '".$input["score"]."',
        Target = '".$input["target"]."'
        WHERE ScoreID = '".$input["scoreid"]."'";
        mysqli_query($connect, $query);
}
if ($input["action"] === "delete") {
    $query = "
    DELETE FROM scores
    WHERE ScoreID = '".$input["scoreid"]."'";
    mysqli_query($connection, $query);
}

echo json_encode($input)
?>
