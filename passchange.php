<?php
session_start();
include 'connection.php';

    $result = mysqli_query($connection,"SELECT * FROM credentials WHERE identifier = '1'");
    while($row = mysqli_fetch_array($result))
    {
        $oldpass = $row['PassHash'];
    };

    $currpass = $_POST["currpass"];
    $newpass = $_POST["newpass"];
    $currpasshash = hash("sha512", $currpass);
    $newpasshash = hash("sha512", $newpass);
    

    if ($currpasshash == $oldpass) {
        $query = "UPDATE credentials SET PassHash = '".$newpasshash."' WHERE identifier = '1'";
        mysqli_query($connection, $query);
        $_SESSION["message"] = "Password successfully changed!";
        header("location:login.php");    
    } else {
        $_SESSION["message"] = "Incorrect password!";
        header("location:login.php");
    }

?>