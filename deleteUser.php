<?php 
require_once('../connection/db.php'); 


	if (isset($_GET['id'])){
	$ID = $_GET['id'];
	}

$sql = "DELETE FROM user WHERE id ='$ID'" ;

$delete = mysqli_query($dbConn,$sql);
$row = mysqli_affected_rows($dbConn);
    if($delete){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";


?>
