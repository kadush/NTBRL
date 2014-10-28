<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlnetworklan="SELECT COUNT(section3.network) as networklan FROM section3 WHERE section3.network='LAN'" ;	
$querynetworklan=mysql_query($sqlnetworklan,$conn ) or die(mysql_error());
$rsnetworklan=mysql_fetch_assoc($querynetworklan);

$lan=$rsnetworklan['networklan'];
/* ****************************************************/
$sqlnetworkmodem="SELECT COUNT(section3.network) as networkno FROM section3 WHERE section3.network='Modem'";	
$querynetworkno=mysql_query($sqlnetworkmodem,$conn ) or die(mysql_error());
$rsnetworkno=mysql_fetch_assoc($querynetworkno);

$modem=$rsnetworkno['networkno'];
/* ****************************************************/
$sqlwireless="SELECT COUNT(section3.network) as wireless FROM section3 WHERE section3.network='wireless'";	
$querywireless=mysql_query($sqlwireless,$conn ) or die(mysql_error());
$rswireless=mysql_fetch_assoc($querywireless);

$wireless=$rswireless['wireless'];
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $lan; ?>" label="LAN" color="008900"/>
 <set value="<?php echo $modem; ?>" label="Modem" color="BF0000"/>
 <set value="<?php echo $wireless; ?>" label="Wireless" color="0000"/>

 </chart>