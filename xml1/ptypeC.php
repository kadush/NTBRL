<?php

if (isset($_GET['id'])){
		  $countyID = $_GET['id'];
	}
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

$sqlsputumpos="SELECT mtbsputumpos,rifsputumpos,mtbsputumneg,rifsputumneg,mtbReturn,rifReturn,mtbFailure,rifFailure,mtbFailureRt,rifFailureRt,mtbNP,rifNP,mtbNewcase,rifNewcase,mtbContact,rifContact,mtbRef,rifRef,mtbHCWs,rifHCWs,mtbHivSmear,rifHivSmear
FROM(SELECT 
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR 'MTB DETECTED LOW; Rif Resistance NOT DETECTED' OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result ='MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result ='MTB DETECTED HIGH; Rif Resistance DETECTED' OR 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR Test_Result ='MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample
LEFT  JOIN `facilitys` ON `sample`.`facility` = `facilitys`.`ID`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID')x";

$querysputumpos=mysql_query($sqlsputumpos,$conn ) or die(mysql_error());
$rssputumpos=mysql_fetch_assoc($querysputumpos);

 $mtbsputumpos=$rssputumpos['mtbsputumpos'];
 $rifsputumpos=$rssputumpos['rifsputumpos'];
 $mtbsputumneg=$rssputumpos['mtbsputumneg'];
 $rifsputumneg=$rssputumpos['rifsputumneg'];
 $mtbReturn=$rssputumpos['mtbReturn'];
 $rifReturn=$rssputumpos['rifReturn'];
 $mtbFailure=$rssputumpos['mtbFailure'];
 $rifFailure=$rssputumpos['rifFailure'];
 $mtbFailureRt=$rssputumpos['mtbFailureRt'];
 $rifFailureRt=$rssputumpos['rifFailureRt'];
 $mtbNP=$rssputumpos['mtbNP'];
 $rifNP=$rssputumpos['rifNP'];
 $mtbNewcase=$rssputumpos['mtbNewcase'];
 $rifNewcase=$rssputumpos['rifNewcase'];
 $mtbContact=$rssputumpos['mtbContact'];
 $rifContact=$rssputumpos['rifContact'];
 $mtbRef=$rssputumpos['mtbRef'];
 $rifRef=$rssputumpos['rifRef'];
 $mtbHCWs=$rssputumpos['mtbHCWs'];
 $rifHCWs=$rssputumpos['rifHCWs'];
 $mtbHivSmear=$rssputumpos['mtbHivSmear'];
 $rifHivSmear=$rssputumpos['rifHivSmear'];
/* ****************************************************/
?>

<chart palette="2" yAxisName="# of Patients"  showLabels="1" showvalues="0"  numberPrefix="" showSum="0" decimals="0" useRoundEdges="1" legendBorderAlpha="0" bgcolor="FFFFFF" showborder="0">
<categories>
<category label="sputum smear-positive relapse" />
<category label="sputum smear-negative relapse" />
<category label="Return after defaulting" />
<category label="Failure 1-st line treatment" />
<category label="Failure re-treatment" />
<category label="New Patients" />
<category label="New case PTB" />
<category label="MDR TB Contact" />
<category label="Refugees SS+ve" />
<category label="HCWs" />
<category label="Hiv(+) & Smear(-)" />
</categories>
<dataset seriesName="MTB +ve" color="AFD8F8" showValues="0">
<set value="<?php echo $mtbsputumpos; ?>" />
<set value="<?php echo $mtbsputumneg; ?>" />
<set value="<?php echo $mtbReturn; ?>" />
<set value="<?php echo $mtbFailure; ?>" />
<set value="<?php echo $mtbFailureRt; ?>" />
<set value="<?php echo $mtbNP; ?>" />
<set value="<?php echo $mtbNewcase; ?>" />
<set value="<?php echo $mtbContact; ?>" />
<set value="<?php echo $mtbRef; ?>" />
<set value="<?php echo $mtbHCWs; ?>" />
<set value="<?php echo $mtbHivSmear; ?>" />
</dataset>
<dataset seriesName="Rif Resistant" color="F6BD0F" showValues="0">
<set value="<?php echo $rifsputumpos ; ?>" />
<set value="<?php echo $rifsputumneg ; ?>" />
<set value="<?php echo $rifReturn ; ?>" />
<set value="<?php echo $rifFailure ; ?>" />
<set value="<?php echo $rifFailureRt ; ?>" />
<set value="<?php echo $rifNP ; ?>" />
<set value="<?php echo $rifNewcase ; ?>" />
<set value="<?php echo $rifContact ; ?>" />
<set value="<?php echo $rifRef ; ?>" />
<set value="<?php echo $rifHCWs ; ?>" />
<set value="<?php echo $rifHivSmear ; ?>" />
</dataset>

</chart>