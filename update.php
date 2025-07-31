<?php 
require_once('../connection/db.php');
//echo "test";

 $sql="Update facilitys SET name='$_POST[fname]',district='$_POST[district]',genesite='$_POST[genesite]',partner='$_POST[partner]' WHERE facilitycode='$_POST[code]'";
 //exit;
 $retval = mysqli_query($dbConn, $sql, $ntrl );
 
if(! $retval )
{
	$arr = array('message' => 'Update Failed', 'title' => 'Update Response');
     echo json_encode($arr);
	
}
  
else {
	$arr = array('message' => 'Update Successfull', 'title' => 'Update Response');
     echo json_encode($arr);
	
}
  
?>