<?php 
require_once('connection/db.php'); 


	if (isset($_GET['id'])){
	$sampleID = $_GET['id'];
	}

mysql_select_db($database, $ntrl);
 $sql = "DELETE FROM sample1 WHERE lab_no ='$sampleID'" ;

$delete = mysql_query( $sql, $ntrl );
$row = mysql_affected_rows();
    if($delete){
        
		@header("Location:sampleview.php");
    }
//echo "Deleted data successfully\n";


?>
