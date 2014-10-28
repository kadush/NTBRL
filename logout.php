<?php
require_once('connection/db.php'); 
session_start();
$sq="INSERT INTO activitylog (`uname`, `activity`, `ugroup`) VALUES ('".$_SESSION['nm']."','logout','".$_SESSION['cat']."')";
$activity=mysql_query($sq) or die(mysql_error());
session_destroy();
header("location:dlt_login.php");
?>

