<?php
session_start();
if (!isset($_SESSION["valid"])) {
    header("Location: login.php");
    $_SESSION["msg"] = "Please login";
}
?>

<html>
    <h1>Admin Page</h1>
</html>