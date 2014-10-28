<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlSLB="SELECT COUNT(section6.XpertTracking) as SLB FROM section6 WHERE section6.XpertTracking='Stock ledger book'" ;	
$querySLB=mysql_query($sqlSLB,$conn ) or die(mysql_error());
$rsSLB=mysql_fetch_assoc($querySLB);

  $SLB=$rsSLB['SLB'];
/* ****************************************************/
$sqlElec="SELECT COUNT(section6.XpertTracking) as Elec FROM section6 WHERE section6.XpertTracking='Electronic system	'";	
$queryElec=mysql_query($sqlElec,$conn ) or die(mysql_error());
$rsElec=mysql_fetch_assoc($queryElec);

  $Elec=$rsElec['Elec'];
/* ****************************************************/
$sqlNot="SELECT COUNT(section6.XpertTracking) as Noty FROM section6 WHERE section6.XpertTracking='Not recorded	'";	
$queryNot=mysql_query($sqlNot,$conn ) or die(mysql_error());
$rsNot=mysql_fetch_assoc($queryNot);

  $Not=$rsNot['Noty'];
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $SLB; ?>" label="Stock ledger book" color="008900"/>
 <set value="<?php echo $Elec; ?>" label="Electronic System" color="BF0000"/>
 <set value="<?php echo $Not; ?>" label="Not Recorded" color="0000"/>

 </chart>