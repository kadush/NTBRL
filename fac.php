<?php
require_once('../connection/db.php'); 

if (isset($_POST['id'])){
$searchno=$_POST['id'];
}
$sql= "SELECT f.facilitycode as code,f.name as fname,f.district as district, d.county as county, f.genesite as genesite, f.partner as partner FROM facilitys f,districts d WHERE facilitycode='$searchno' and d.ID=f.district ";
$rsFinC = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn)());
$row_rsFinC = mysqli_fetch_assoc($rsFinC);


if( mysqli_num_rows($rsFinC)==0)
{
	
} 
else
{

  echo json_encode($row_rsFinC);
}

?>