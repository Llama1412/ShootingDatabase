<?php
session_start();
unset($_SESSION["valid"]);
unset($_SESSION["time"]);
header("Location: login.php");
$_SESSION["msg"] = "<br> Successfully logged out.";
?>