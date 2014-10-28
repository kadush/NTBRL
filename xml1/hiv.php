<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

/* ****************************************************/
$sqlpos="SELECT pos,neg,notsp
FROM(
SELECT 
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as pos,
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as neg,
sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END) as notsp
FROM sample)x" ;	
$querypos=mysql_query($sqlpos,$conn ) or die(mysql_error());
$rspos=mysql_fetch_assoc($querypos);

$pos=$rspos['pos'];
$neg=$rspos['neg'];
$notsp=$rspos['notsp'];
/* ****************************************************/
?>
<chart showPercentagevalues="1"  bgcolor="FFFFFF"  showborder="0" bordercolor="0080FF" palette="2" animation="1" formatNumberScale="0"  pieSliceDepth="30" startingAngle="125" >

 <set value="<?php echo $pos; ?>" label="Positive" color="C295F2"/>
 <set value="<?php echo $neg; ?>" label="Negative" color="#ADFF2F"/>
 <set value="<?php echo $notsp; ?>" label="Not specified" color="00ACE8"/>

 <styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>