<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sql="SELECT SUM(section5.ttest) as tt, SUM(section5.mtb) as mtb, SUM(section5.Rifampicin) as rif FROM  section5";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$tt=$rs['tt'];
$mtb=$rs['mtb'];
$rif=$rs['rif'];

	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $tt; ?>" label="Total Test" color="BF0000"/>
 <set value="<?php echo $mtb; ?>" label="MTB +VE" color="00759B"/>
 <set value="<?php echo $rif; ?>" label="Rifampicin" color="0000"/>


 </chart>