<?php 
require_once('../connection/db.php'); 

$UserID = $_GET['id'];
$status = $_GET['st'];

if ($status==0) {
	$sql = "UPDATE user SET st=1 WHERE id ='$UserID'" ;
} 
else if ($status==1) {
	$sql = "UPDATE user SET st=0 WHERE id ='$UserID'" ;
}

$update = mysqli_query($dbConn, $sql);
$row = mysqli_affected_rows($dbConn);
    if($update){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";
