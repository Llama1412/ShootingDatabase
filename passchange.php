<?php
session_start();
include 'connection.php';

    $result = mysqli_query($connection,"SELECT * FROM credentials WHERE identifier = '1'");
    $currpass = $_POST["currpass"];
    $newpass = $_POST["newpass"];
    $currpasshash = hash("sha512", $currpass);
    $newpasshash = hash("sha512", $newpass);
    
    while($row = mysqli_fetch_array($result))
    {
        $oldpass = $row['PassHash'];
    };

    if ($currpasshash == $oldpass) {
        $query = "UPDATE credentials SET PassHash = '".$newpasshash."' WHERE identifier = '1'";
        mysqli_query($connection, $query);
        $_SESSION["message"] = "Password successfully changed!";
        header("location:login.php");    
    } else {
        $_SESSION["message"] = "Did not work.";
        header("location:login.php");
    }

?>