
<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqltbyes="SELECT count(section2.tbtest) as tbyes FROM `section2` WHERE section2.tbtest='Yes'";	
$querytbyes=mysql_query($sqltbyes,$conn ) or die(mysql_error());
$rstbyes=mysql_fetch_assoc($querytbyes);

  $tbyes=$rstbyes['tbyes'];
		
$sqltbno="SELECT count(section2.tbtest) as tbno FROM `section2` WHERE section2.tbtest='tbno'";	
$querytbno=mysql_query($sqltbno,$conn ) or die(mysql_error());
$rstbno=mysql_fetch_assoc($querytbno);

  $tbno=$rstbno['tbno'];

?>

<chart showPercentageInLabel="1" showValues="1" showLabels="0" showLegend="1" showPercentValues="1">
 
 <set value="<?php echo $tbyes; ?>" label="Yes" color="40C7F9"/>
 <set value="<?php echo $tbno; ?>" label="No" color="00496C"/>


 </chart>
