<?php

if (isset($_GET['id'])){
		  $countyID = (int) $_GET['id'];
	}

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlabove15="SELECT above15,btwn,below 
FROM(
SELECT 
sum(CASE WHEN age>15 THEN 1 ELSE 0 END) as above15,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as btwn,
sum(CASE WHEN age Between 0 AND 5 THEN 1 ELSE 0 END) as below 
FROM sample
LEFT  JOIN `facilitys` ON `sample`.`facility` = `facilitys`.`ID`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID')x" ;	
$queryabove15=mysql_query($sqlabove15,$conn ) or die(mysql_error());
$rsabove15=mysql_fetch_assoc($queryabove15);

$above15=$rsabove15['above15'];
$btwn=$rsabove15['btwn'];
$below=$rsabove15['below'];
?>
<chart bgcolor="FFFFFF"   showborder="0" palette="2" animation="1" pieSliceDepth="30" startingAngle="125">

 <set value="<?php echo $above15; ?>" label="Above 15 Yrs" color="C295F2"/>
 <set value="<?php echo $btwn; ?>" label="Btwn 5-15 Yrs" color="#ADFF2F"/>
 <set value="<?php echo $below; ?>" label="Below 5 Yrs" color="00ACE8"/>

 <styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>