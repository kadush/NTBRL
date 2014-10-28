<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlyes="SELECT COUNT(section3.computer) as yes FROM section3 WHERE section3.computer='Yes'" ;	
$queryyes=mysql_query($sqlyes,$conn ) or die(mysql_error());
$rsyes=mysql_fetch_assoc($queryyes);

$yes=$rsyes['yes'];

$sqlno="SELECT COUNT(section3.computer) as no FROM section3 WHERE section3.computer='No'";	
$queryno=mysql_query($sqlno,$conn ) or die(mysql_error());
$rsno=mysql_fetch_assoc($queryno);

$no=$rsno['no'];
?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $yes; ?>" label="Yes" color="429EAD"/>
 <set value="<?php echo $no; ?>" label="No" color="00759B"/>


 </chart>