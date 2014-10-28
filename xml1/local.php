<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlonlineyes="SELECT COUNT(section3.online) as onlineyes FROM section3 WHERE section3.online='Yes'" ;	
$queryonlineyes=mysql_query($sqlonlineyes,$conn ) or die(mysql_error());
$rsonlineyes=mysql_fetch_assoc($queryonlineyes);

$onlineyes=$rsonlineyes['onlineyes'];
/* ****************************************************/
$sqlonlineno="SELECT COUNT(section3.online) as onlineno FROM section3 WHERE section3.online='No'";	
$queryonlineno=mysql_query($sqlonlineno,$conn ) or die(mysql_error());
$rsonlineno=mysql_fetch_assoc($queryonlineno);

$onlineno=$rsonlineno['onlineno'];
/* ****************************************************/
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $onlineyes; ?>" label="Yes" color="008900"/>
 <set value="<?php echo $onlineno; ?>" label="No" color="BF0000"/>


 </chart>