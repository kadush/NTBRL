<?php 
require_once('../connection/db.php'); 

$UserID = $_GET['id'];
$status = $_GET['st'];

mysql_select_db($database, $ntrl);

if ($status==0) {
	$sql = "UPDATE user SET st=1 WHERE id ='$UserID'" ;
} 
else if ($status==1) {
	$sql = "UPDATE user SET st=0 WHERE id ='$UserID'" ;
}

$update = mysql_query( $sql, $ntrl );
$row = mysql_affected_rows();
    if($update){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";


?>
