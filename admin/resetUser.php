<?php 
require_once('../connection/db.php'); 


	if (isset($_GET['id'])){
	$ID = $_GET['id'];
	}
$newpass=md5(123456);
mysql_select_db($database, $ntrl);
$sql = "UPDATE user SET password='$newpass' WHERE id ='$ID'" ;

$reset = mysql_query($sql, $ntrl );
$row = mysql_affected_rows();
    if($reset){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";


?>
