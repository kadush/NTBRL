<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlmonth="SELECT count(section6.timeframe) as month FROM `section6` WHERE section6.timeframe='monthly'";	
$querymonth=mysql_query($sqlmonth,$conn ) or die(mysql_error());
$rsmonth=mysql_fetch_assoc($querymonth);

$month=$rsmonth['month'];
/* ****************************************************/		
$sqlQ="SELECT count(section6.timeframe) as Quarterly FROM `section6` WHERE section6.timeframe='Quarterly'";	
$queryQ=mysql_query($sqlQ,$conn ) or die(mysql_error());
$rsQ=mysql_fetch_assoc($queryQ);

$Quarterly=$rsQ['Quarterly'];
/* ****************************************************/	
$sqlwk="SELECT count(section6.timeframe) as Weeklywk FROM `section6` WHERE section6.timeframe='Weekly'";	
$querywk=mysql_query($sqlwk,$conn ) or die(mysql_error());
$rswk=mysql_fetch_assoc($querywk);

$Weeklywk=$rswk['Weeklywk'];

/* ****************************************************/	
$sqlother="SELECT count(section6.timeframe) as other FROM `section6` WHERE section6.timeframe='Others'";	
$queryother=mysql_query($sqlother,$conn ) or die(mysql_error());
$rsother=mysql_fetch_assoc($queryother);

$other=$rsother['other'];
/* ****************************************************/	
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $month; ?>" label="Monthly" color="4249AD"/>
 <set value="<?php echo $Quarterly; ?>" label="Quarterly" color="D4AC31" />
 <set value="<?php echo $Weeklywk; ?>" label="Weekly" color="429EAD"/>
 <set value="<?php echo $other; ?>" label="Other" color="AD42A2"/>


 </chart>