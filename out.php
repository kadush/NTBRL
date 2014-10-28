<?php
//print_r( $_POST);

	
$sql="INSERT INTO sample1 (`lab_no`,`op_no`,`ip_no`,`regno`, `fullname`, `gender`, `age`,`ageb`, `mobile`,`address`,`pat_type`,`facility`,`Refacility`,`coldate`,`smear`,`h_status`,`exam_req`,`d_email`,`d_no`,`c_name`,`c_email`) VALUES (
'$_POST[labno]',
'$_POST[opno]',
'$_POST[ipno]',
'$_POST[regno]',
'$_POST[name]',
'$_POST[sex]',
'$_POST[age]',
'$_POST[ageb]',
'$_POST[p_no]',
'$_POST[address]',
'$_POST[ptype]',
'$_POST[facility]',
'$_POST[refacility]',
'$_POST[date]',
'$_POST[smear]',
'$_POST[hstatus]',
'$_POST[exam]',
'$_POST[d_email]',
'$_POST[d_no]',
'$_POST[c_name]',
'$_POST[c_email]')";


$retval = mysql_query( $sql, $conn );
if(! $retval )
{
 echo '<div class="alert alert-warning">Could not enter data.Try Again</div>';
}
 $suceessmsg= '<div class="alert alert-success">Patient details successfully saved </div>';

echo "<script>";
echo "window.location.href='try2.php?msg=$suceessmsg'";
echo "</script>";
mysql_close($conn);

?>