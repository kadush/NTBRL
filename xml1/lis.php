<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqllisyes="SELECT COUNT(section3.lis) as lisyes FROM section3 WHERE section3.lis='Yes'" ;	
$querylisyes=mysql_query($sqllisyes,$conn ) or die(mysql_error());
$rslisyes=mysql_fetch_assoc($querylisyes);

$lisyes=$rslisyes['lisyes'];
/* ****************************************************/
$sqllisno="SELECT COUNT(section3.lis) as lisno FROM section3 WHERE section3.lis='No'";	
$querylisno=mysql_query($sqllisno,$conn ) or die(mysql_error());
$rslisno=mysql_fetch_assoc($querylisno);

$lisno=$rslisno['lisno'];
/* ****************************************************/
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $lisyes; ?>" label="Yes" color="008900"/>
 <set value="<?php echo $lisno; ?>" label="No" color="BF0000"/>


 </chart>