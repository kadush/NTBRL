<?php 
require_once('../connection/db.php'); 

 $allocation=$_POST['allocation'];

    $id = $_GET['id'];
	$county = $_GET['cid'];

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {

$sql = "UPDATE consumption SET status=1,allocated='$allocation' WHERE ID = $id" ;
$update = mysqli_query($dbConn, $sql);
$row = mysqli_affected_rows($dbConn);
    if($update){
       @header("Location:countyallocation.php?id=$county");
    }
//echo "Deleted data successfully\n";

}
?>
