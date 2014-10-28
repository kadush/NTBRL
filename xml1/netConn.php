<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlyescon="SELECT COUNT(section3.net_connection) as yescon FROM section3 WHERE section3.net_connection='Yes'" ;	
$queryyescon=mysql_query($sqlyescon,$conn ) or die(mysql_error());
$rsyescon=mysql_fetch_assoc($queryyescon);

$yesconn=$rsyescon['yescon'];
/* ****************************************************/
$sqlnoconn="SELECT COUNT(section3.net_connection) as noconn FROM section3 WHERE section3.net_connection='No'";	
$querynoconn=mysql_query($sqlnoconn,$conn ) or die(mysql_error());
$rsnoconn=mysql_fetch_assoc($querynoconn);

 $noconn=$rsnoconn['noconn'];
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">

 <set label="Yes" value="<?php echo $yesconn ?>"   color="F1683C" /> 
 <set label="No" value="<?php echo $noconn ?>" color="DBDC25"/> 

</chart>