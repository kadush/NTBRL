<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlpolyes="SELECT COUNT(section3.policy) as polyes FROM section3 WHERE section3.policy='Yes'" ;	
$querypolyes=mysql_query($sqlpolyes,$conn ) or die(mysql_error());
$rspolyes=mysql_fetch_assoc($querypolyes);

$polyes=$rspolyes['polyes'];
/* ****************************************************/
$sqlpolno="SELECT COUNT(section3.policy) as polno FROM section3 WHERE section3.policy='No'";	
$querypolno=mysql_query($sqlpolno,$conn ) or die(mysql_error());
$rspolno=mysql_fetch_assoc($querypolno);

$polno=$rspolno['polno'];
/* ****************************************************/
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $polyes; ?>" label="Yes" color="AD42A2"/>
 <set value="<?php echo $polno; ?>" label="No" color="4249AD"/>


 </chart>