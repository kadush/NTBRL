
<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sql="SELECT count(section2.challenges) as chalPIN FROM `section2` WHERE section2.challenges='Patient identification number,'";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$chalPIN=$rs['chalPIN'];
		
$sql1="SELECT count(section2.challenges) as chalAccess FROM `section2` WHERE section2.challenges='Access to testing,'";	
$query1=mysql_query($sql1,$conn ) or die(mysql_error());
$rs1=mysql_fetch_assoc($query1);

$chalAccess=$rs1['chalAccess'];

?>

<chart yAxisName="# of facilities"  useRoundEdges="1" bgColor="FFFFFF,FFFFFF" showBorder="0">
        <set label="Patient identification number" value="<?php echo $chalPIN ?>"  /> 
        <set label="Access to testing" value="<?php echo $chalAccess ?>" /> 
        <set label="Delivering results to patients" value="4" /> 
        <set label="Long turnaround times for receiving results" value="7" /> 
        <set label="Linking patients to treatment" value="3" />
        <set label="Identifying TB co-infections among HIV patients" value="2" />
</chart>

