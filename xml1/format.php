<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlHCG="SELECT COUNT(section5.format) as HCG FROM section5 WHERE section5.format='hardcopy (GeneXpert printout)'" ;	
$queryHCG=mysql_query($sqlHCG,$conn ) or die(mysql_error());
$rsHCG=mysql_fetch_assoc($queryHCG);

$HCG=$rsHCG['HCG'];
/* ****************************************************/
$sqlHCR="SELECT COUNT(section5.format) as HCR FROM section5 WHERE section5.format='hard copy (replicate of request form)'";	
$queryHCR=mysql_query($sqlHCR,$conn ) or die(mysql_error());
$rsHCR=mysql_fetch_assoc($queryHCR);

 $HCR=$rsHCR['HCR'];
 /* ****************************************************/
?>
<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">

 <set label="Hardcopy(GeneXpert printout)" value="<?php echo $HCG ?>"   color="F1683C" /> 
 <set label="Hard copy(replicate of request form)" value="<?php echo $HCR ?>" color="DBDC25"/> 

</chart>