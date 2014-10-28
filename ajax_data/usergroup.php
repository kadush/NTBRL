<?php
@require_once('../connection/db.php'); 
if (isset($_POST['id'])){
$usergroup = $_POST['id'];
	
$sql="INSERT INTO usergroup (groupName) VALUES('$usergroup')";
$retval = mysql_query( $sql, $ntrl );

}
?>