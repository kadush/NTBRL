<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqllab="SELECT COUNT(section5.workflow) as lab FROM section5 WHERE section5.workflow='Lab Register'" ;	
$querylab=mysql_query($sqllab,$conn ) or die(mysql_error());
$rslab=mysql_fetch_assoc($querylab);

$lab=$rslab['lab'];
/* ****************************************************/
$sqllims="SELECT COUNT(section5.workflow) as lims FROM section5 WHERE section5.workflow='LIMS'";	
$querylims=mysql_query($sqllims,$conn ) or die(mysql_error());
$rslims=mysql_fetch_assoc($querylims);

$lims=$rslims['lims'];
/* ****************************************************/
$sqloth="SELECT COUNT(section5.workflow) as oth FROM  section5 WHERE section5.workflow='LIMS'";		
$queryoth=mysql_query($sqloth,$conn ) or die(mysql_error());
$rsoth=mysql_fetch_assoc($queryoth);

$oth=$rsoth['oth'];
/* ****************************************************/
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $lab; ?>" label="Lab Register" color="F1683C"/>
 <set value="<?php echo $lims; ?>" label="LIMS" color="DBDC25"/>
 <set value="<?php echo $oth; ?>" label="Others" color="00759B"/>


 </chart>