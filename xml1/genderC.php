<?php
if (isset($_GET['id'])){
		  $countyID = $_GET['id'];
	}
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

/* ****************************************************/
$sqlmale="SELECT male,female,notsp
FROM(
SELECT 
sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END) as male,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as female,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as notsp
FROM sample
LEFT  JOIN `facilitys` ON `sample`.`facility` = `facilitys`.`ID`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID')x" ;	
$querymale=mysql_query($sqlmale,$conn ) or die(mysql_error());
$rsmale=mysql_fetch_assoc($querymale);

$male=$rsmale['male'];
$female=$rsmale['female'];
$notsp=$rsmale['notsp'];
/* ****************************************************/
?>
<chart bgcolor="FFFFFF" showborder="0" palette="2" animation="1" pieSliceDepth="30" startingAngle="125" >

 <set value="<?php echo $male; ?>" label="Male" color="C295F2"/>
 <set value="<?php echo $female; ?>" label="Female" color="#ADFF2F"/>
 <set value="<?php echo $notsp; ?>" label="Not specified" color="00ACE8"/>

 <styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>