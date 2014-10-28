<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlp="SELECT count(section6.responsible) as partner FROM `section6` WHERE section6.responsible='Partner Budget (specify which tests)'";	
$queryp=mysql_query($sqlp,$conn ) or die(mysql_error());
$rsp=mysql_fetch_assoc($queryp);

$partner=$rsp['partner'];
/* ****************************************************/		
$sqlc="SELECT count(section6.responsible) as partnercms FROM `section6` WHERE section6.responsible='CMS (KEMSA) (specify which tests)'";	
$queryc=mysql_query($sqlc,$conn ) or die(mysql_error());
$rsc=mysql_fetch_assoc($queryc);

$partnercms=$rsc['partnercms'];
	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $partner; ?>" label="Partner" color="AD42A2"/>
 <set value="<?php echo $partnercms; ?>" label="CMS" color="4249AD"/>
 
 </chart>