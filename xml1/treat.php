<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sql="SELECT count(section2.treatment) as treatment1 FROM `section2` WHERE section2.treatment='At this facility when they come to collect their results'";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$treatment1=$rs['treatment1'];
/* ****************************************************/		
$sql2="SELECT count(section2.treatment) as treatment2 FROM `section2` WHERE section2.treatment='At this facility when they come to collect their results'";	
$query2=mysql_query($sql2,$conn ) or die(mysql_error());
$rs2=mysql_fetch_assoc($query2);

$treatment2=$rs2['treatment2'];
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $treatment2; ?>" label="At this facility when they come to collect their results" color="008900"/>
 <set value="<?php echo $treatment1; ?>" label="Referred to a different facility to obtain treatment" color="00759B"/>


 </chart>