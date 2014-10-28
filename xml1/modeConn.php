<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqldatalan="SELECT COUNT(section3.data) as datalan FROM section3 WHERE section3.data='LAN'" ;	
$querydatalan=mysql_query($sqldatalan,$conn ) or die(mysql_error());
$rsdatalan=mysql_fetch_assoc($querydatalan);

$lan1=$rsdatalan['datalan'];
/* ****************************************************/
$sqldatamodem="SELECT COUNT(section3.data) as datamodem FROM section3 WHERE section3.data='Modem'";	
$querydatamodem=mysql_query($sqldatamodem,$conn ) or die(mysql_error());
$rsdatamodem=mysql_fetch_assoc($querydatamodem);

$modem1=$rsdatamodem['datamodem'];
/* ****************************************************/
$sqlwireless1="SELECT COUNT(section3.data) as wireless1 FROM section3 WHERE section3.data='wireless1'";	
$querywireless1=mysql_query($sqlwireless1,$conn ) or die(mysql_error());
$rswireless1=mysql_fetch_assoc($querywireless1);

$wireless11=$rswireless1['wireless1'];
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $lan1; ?>" label="LAN" color="008900"/>
 <set value="<?php echo $modem1; ?>" label="Modem" color="BF0000"/>
 <set value="<?php echo $wireless11; ?>" label="Wireless" color="AD42A2"/>

 </chart>