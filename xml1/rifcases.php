<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlrifyes="SELECT COUNT(section5.rif) as rifyes FROM section5 WHERE section5.rif='Yes'" ;	
$queryrifyes=mysql_query($sqlrifyes,$conn ) or die(mysql_error());
$rsrifyes=mysql_fetch_assoc($queryrifyes);

$rifyes=$rsrifyes['rifyes'];
/* ****************************************************/
$sqlrifno="SELECT COUNT(section5.rif) as rifno FROM section5 WHERE section5.rif='No'";	
$queryrifno=mysql_query($sqlrifno,$conn ) or die(mysql_error());
$rsrifno=mysql_fetch_assoc($queryrifno);

$rifno=$rsrifno['rifno'];
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">

 <set label="Yes" value="<?php echo $rifyes ?>"  color="AD42A2" /> 
 <set label="No" value="<?php echo $rifno ?>" color="4249AD"/> 

</chart>