<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlpull="SELECT count(section6.distribution) as pull FROM `section6` WHERE section6.distribution='Pull System'";	
$querypull=mysql_query($sqlpull,$conn ) or die(mysql_error());
$rspull=mysql_fetch_assoc($querypull);

$pull=$rspull['pull'];
/* ****************************************************/		
$sqlpush="SELECT count(section6.distribution) as push FROM `section6` WHERE section6.distribution='Push System'";	
$querypush=mysql_query($sqlpush,$conn ) or die(mysql_error());
$rspush=mysql_fetch_assoc($querypush);

$push=$rspush['push'];
/* ****************************************************/		
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $pull; ?>" label="Pull System" color="429EAD"/>
 <set value="<?php echo $push; ?>" label="Push System" color="D4AC31"/>
 
 </chart>