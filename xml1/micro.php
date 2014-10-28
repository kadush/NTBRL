
<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlallpat="SELECT COUNT(section5.ptype) as allpat FROM section5 WHERE section5.ptype='All patients'" ;	
$queryallpat=mysql_query($sqlallpat,$conn ) or die(mysql_error());
$rsallpat=mysql_fetch_assoc($queryallpat);

$allpat=$rsallpat['allpat'];
/* ****************************************************/
$sqlnewcase="SELECT COUNT(section5.ptype) as newcase FROM section5 WHERE section5.ptype='New case PTB'";	
$querynewcase=mysql_query($sqlnewcase,$conn ) or die(mysql_error());
$rsnewcase=mysql_fetch_assoc($querynewcase);

$newcase=$rsnewcase['newcase'];
 /* ****************************************************/
$sqlnewp="SELECT COUNT(section5.ptype) as newp FROM section5 WHERE section5.ptype='New Patients'" ;	
$querynewp=mysql_query($sqlnewp,$conn ) or die(mysql_error());
$rsnewp=mysql_fetch_assoc($querynewp);

$newp=$rsnewp['newp'];
/* ****************************************************/


?>

<chart yAxisName="# of facilities"  useRoundEdges="1" bgColor="FFFFFF,FFFFFF" showBorder="0">
        <set label="All patients" value="<?php echo $allpat ?>"  /> 
        <set label="New case PTB" value="<?php echo $newcase ?>" /> 
        <set label="New Patient" value="<?php echo $newp ?>" />  
        
</chart>

