<?php 
 include("FusionCharts/FusionCharts.php");
 include("connection/db.php"); 
 include("includes/functions.php");
 $currentyear=$_GET['mwaka'];
$currentmonth=$_GET['mwezi'];
   //$strXML will be used to store the entire XML document generated
   //Generate the chart element

$strQuery = "SELECT `Provinces`.`name` AS Province, COUNT( * ) AS TOTAL, COUNT(
CASE WHEN Test_Result = 'MTB DETECTED'
THEN 1
ELSE NULL
END ) AS MTBPOS, COUNT(
CASE WHEN Test_Result = 'MTB NOT DETECTED'
THEN 1
ELSE NULL
END ) AS MTBNEG, COUNT(
CASE WHEN Test_Result = 'MTB DETECTED'
AND `rif` = 'No RIF Resistance'
THEN 1
ELSE NULL
END ) AS RIFRES, COUNT(
CASE WHEN Test_Result = 'MTB DETECTED'
AND `h_status` = 'POSITIVE'
THEN 1
ELSE NULL
END ) AS HIVPOS
FROM `sample`
LEFT JOIN `facilitys` ON `sample`.`facility` = `facilitys`.`ID`
LEFT JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`

WHERE MONTH(coldate ) =09 AND
YEAR( coldate )= 2013 AND
Province IS NOT NULL
GROUP BY Province ";

 
   $result = mysql_query($strQuery) or die(mysql_error());
   
        $category ="";
		$xml_postive="";
		$xml_negative="";
		$test="";
		
   //Iterate through each factory
   if ($result) {
      while($ors = mysql_fetch_array($result)) {
         //Generate <set label='..' value='..'/>
		
	$category .="<category label='" . $ors['Province'] . "' />";	
	$xml_postive .="<set value='" . $ors['MTBPOS'] . "'/>";	
	$xml_negative .="<set value='" . $ors['MTBNEG'] . "'/>";	
    $test .="<category label='" . $ors['TOTAL'] . "' />";	
         //free the resultset
      }
   }
   //Finally, close <chart> element
   
   
   ?>
   
<chart caption="" subcaption=""  yAxisName="# of Tests"  lineThickness="2" showValues="0" formatNumberScale="0" anchorRadius="2" divLineAlpha="20" divLineColor="CC3300" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" labelStep="" numvdivlines="10" chartRightMargin="35" bgColor="FFFFFF" bgAngle="270" bgAlpha="10,10"  showBorder='0' formatNumberScale="0">

<categories >
<?php  

		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  $monthname=GetMonthName($startmonth);
		
?>
<category label='<?php echo $monthname ;?>' />
<?php
}
?>
</categories>
<dataset seriesName='Test Done ' color='A666EDD' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$test;
		
		
?>

<set value='<?php echo $test; ?>' />
<?php
}
?>
	</dataset>

<dataset seriesName='MTB Positive Tests' color='F6BD0F' >
	<?php   $startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  
		
		$xml_postive ;
?>

<set value='<?php echo $xml_postive; ?>' />
<?php
}
?>
</dataset>

<dataset seriesName='MTB Negative Tests' color='FF0080' >
	<?php   $startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  
		
		$xml_negative;
?>

<set value='<?php echo $xml_negative; ?>' />
<?php
}
?>
</dataset>
<styles>

<definition>
<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
<style name="DataShadow" type="Shadow" alpha="40"/>
</definition>

<application>
<apply toobject="DIVLINES" styles="Anim1"/>
<apply toobject="HGRID" styles="Anim2"/>
<apply toobject="DATALABELS" styles="DataShadow,Anim2"/>
</application>
</styles>
</chart>