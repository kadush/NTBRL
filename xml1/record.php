
<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sql="SELECT count(section5.recorded) as reg FROM `section5` WHERE section5.recorded='Using a referral lab register'";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$reg=$rs['reg'];
/* ****************************************************/		
$sql1="SELECT count(section5.recorded) as folder FROM `section5` WHERE section5.recorded='Using a folder'";	
$query1=mysql_query($sql1,$conn ) or die(mysql_error());
$rs1=mysql_fetch_assoc($query1);

$folder=$rs1['folder'];
/* ****************************************************/
$sqlother="SELECT COUNT(section5.recorded) as other FROM section5 WHERE section5.recorded='other (please specify) '" ;	
$queryother=mysql_query($sqlother,$conn ) or die(mysql_error());
$rsother=mysql_fetch_assoc($queryother);

$other=$rsother['other'];
/* ****************************************************/
?>

<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 
 <set value="<?php echo $reg; ?>" label="Using a referral lab register" color="40C7F9"/>
 <set value="<?php echo $folder; ?>" label="Using a folder" color="00496C"/>
 <set value="<?php echo $other; ?>" label="Others" color="00759B"/>

 </chart>
