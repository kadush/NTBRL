<?php 
require_once('../connection/db.php'); 


	if (isset($_GET['id'])){
	$ID = $_GET['id'];
	}
$newpass=md5(123456);

$sql = "UPDATE user SET password='$newpass' WHERE id ='$ID'" ;

$reset = mysqli_query($dbConn,$sql);
$row = mysqli_affected_rows($dbConn);
    if($reset){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";
