<?php 
require_once('../connection/db.php'); 


	if (isset($_GET['id'])){
	$ID = $_GET['id'];
	}

mysql_select_db($database, $ntrl);
$sql = "DELETE FROM user WHERE id ='$ID'" ;

$delete = mysql_query($sql, $ntrl );
$row = mysql_affected_rows();
    if($delete){
        
		@header("Location:userlog.php");
    }
//echo "Deleted data successfully\n";


?>
