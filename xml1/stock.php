<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlpart="SELECT count(section6.send) as part FROM `section6` WHERE section6.send='Partner'";	
$querypart=mysql_query($sqlpart,$conn ) or die(mysql_error());
$rspart=mysql_fetch_assoc($querypart);

$part=$rspart['part'];
/* ****************************************************/		
$sqlK="SELECT count(section6.send) as KEMSA FROM `section6` WHERE section6.send='KEMSA'";	
$queryK=mysql_query($sqlK,$conn ) or die(mysql_error());
$rsK=mysql_fetch_assoc($queryK);

$KEMSA=$rsK['KEMSA'];
/* ****************************************************/	
$sqlnp="SELECT count(section6.send) as NPHLS FROM `section6` WHERE section6.send='NPHLS'";	
$querynp=mysql_query($sqlnp,$conn ) or die(mysql_error());
$rsnp=mysql_fetch_assoc($querynp);

$NPHLS=$rsnp['NPHLS'];

/* ****************************************************/	
$sqlNTRL="SELECT count(section6.send) as NTRL FROM `section6` WHERE section6.send='NTRL'";	
$queryNTRL=mysql_query($sqlNTRL,$conn ) or die(mysql_error());
$rsNTRL=mysql_fetch_assoc($queryNTRL);

$NTRL=$rsNTRL['NTRL'];
/* ****************************************************/	
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $part; ?>" label="Partner" color="AD42A2"/>
 <set value="<?php echo $KEMSA; ?>" label="KEMSA" color="D4AC31" />
 <set value="<?php echo $NPHLS; ?>" label="NPHLS" color="008900"/>
 <set value="<?php echo $NTRL; ?>" label="NTRL" color="BF0000"/>


 </chart>