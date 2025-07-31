<?php
require_once('connection/db.php'); 
session_start();
$facility = urlencode($_SESSION['facility']);
$sq="INSERT INTO activitylog (`uname`,`facility`, `activity`, `ugroup`) VALUES ('".$_SESSION['nm']."','$facility','logout','".$_SESSION['cat']."')";
$activity=mysql_query($sq) or die(mysql_error());
session_destroy();
header("location:dlt_login.php");
?>

