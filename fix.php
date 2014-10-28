<?php
@require_once('connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

if (isset($_POST['id'])){
$searchno=$_POST['id'];
}
$sql= "SELECT lab_no as labno,op_no as opno,regno as regno,fullname as name, gender as gender, age as age,ageb as ageb, mobile as p_no,address as address,pat_type as ptype,Refacility as refacility,coldate as date,smear as smear,h_status as hstatus,exam_req as exam,d_email as d_email,c_no as c_no,c_name as c_name,c_email as c_email FROM sample1 WHERE op_no='$searchno' or ip_no='$searchno' or regno='$searchno'";
$rsFinC = mysql_query($sql, $conn) or die(mysql_error());
$row_rsFinC = mysql_fetch_assoc($rsFinC);


if( mysql_num_rows($rsFinC)==0)
{
	
} 
else
{

  echo json_encode($row_rsFinC);
}
mysql_close($conn);
?>