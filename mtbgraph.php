 <?php 
 include("FusionCharts/FusionCharts.php");
 include("connection/db.php"); 

   //$strXML will be used to store the entire XML document generated
   //Generate the chart element
   
$strXML .= "<chart  caption='TESTS' yAxisName='patients' showLabels='1' showvalues='0'  numberPrefix='$' showSum='1' decimals='0' useRoundEdges='1' legendBorderAlpha='0'>";
 
 //Fetch all factory records
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
WHERE Province IS NOT NULL
GROUP BY Province ";

 
   $result = mysql_query($strQuery) or die(mysql_error());
   
        $category ="";
		$xml_postive="";
		$xml_negative="";
		
   //Iterate through each factory
   if ($result) {
      while($ors = mysql_fetch_array($result)) {
         //Generate <set label='..' value='..'/>
		
	$category .="<category label='" . $ors['Province'] . "' />";	
	$xml_postive .="<set value='" . $ors['MTBPOS'] . "'/>";	
	$xml_negative .="<set value='" . $ors['MTBNEG'] . "'/>";	

         //free the resultset
      }
   }
   //Finally, close <chart> element
   
   
   $strXML.= "<categories> ";
   $strXML.=  $category;
   $strXML.= "</categories> ";
   
   $strXML.= "<dataset seriesname='MTB DETECTED'>";
   $strXML.=$xml_postive;
   
   $strXML.= "</dataset><dataset seriesname='MTB NOT DETECTED'>";
   $strXML.= $xml_negative;
   $strXML.= "</dataset>";  
   
   
   
   
   $strXML.= "</chart>";
   
   
      //Create the Chart with data from $strXML
   echo renderChart("FusionCharts/Charts/Msline.swf", "", $strXML, "FactoSum", 500, 300, 1, 1);
   
   ?>
