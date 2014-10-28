<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sql="SELECT SUM(section2.tbpermonth) as tb, SUM(section2.mtb) as mtb FROM  section2";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$tb=$rs['tb'];
$mtb=$rs['mtb'];

	?>


<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 <set value="<?php echo $tb; ?>" label="TB patients" color="BF0000"/>
 <set value="<?php echo $mtb; ?>" label="MTB patients" color="00759B"/>


 </chart>