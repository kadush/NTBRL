<?php 
require_once('../connection/db.php'); 

 $allocation=$_POST['allocation'];

    $id = $_GET['id'];
	$county = $_GET['cid'];

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
mysql_select_db($database, $ntrl);
$sql = "UPDATE consumption SET status=1,allocated='$allocation' WHERE ID = $id" ;
$update = mysql_query( $sql, $ntrl );
$row = mysql_affected_rows();
    if($update){
       @header("Location:countyallocation.php?id=$county");
    }
//echo "Deleted data successfully\n";

}
?>
