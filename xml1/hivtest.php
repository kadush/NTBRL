
<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlhivtest="SELECT count( section2.hivtest ) AS Yes FROM `section2`
WHERE section2.hivtest = 'Yes'";	
$queryhivtest=mysql_query($sqlhivtest,$conn ) or die(mysql_error());
$rshivtest=mysql_fetch_assoc($queryhivtest);

$hivtestyes=$rshivtest['Yes'];

		
$sql1hivtest="SELECT count(section2.hivtest) as no FROM `section2` WHERE section2.hivtest='No'";	
$query1hivtest=mysql_query($sql1hivtest,$conn ) or die(mysql_error());
$rs1hivtest=mysql_fetch_assoc($query1hivtest);

$hivtestno=$rs1hivtest['no'];	

?>

<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">

        <set label="Yes" value="<?php echo $hivtestyes ?>"  /> 
        <set label="No" value="<?php echo $hivtestno ?>" /> 
               
</chart>

