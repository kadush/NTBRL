<?php
@require_once('../connection/db.php'); 
//total patients in county
function gettestsdonepercounty($county){
	
 $sql="SELECT COUNT(*) FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE  `countys`.`ID` ='$county' AND  cond='1'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}

function getmtbpospercounty($county){
$sql="SELECT 
sum(CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtbpos
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE  `countys`.`ID` ='$county'";

$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return  (int) $rs[0]	;
 
	}

function getmtbnegpercounty($county){
$sql="SELECT sum( CASE WHEN Test_Result = 'MTB NOT DETECTED' THEN 1 ELSE 0 END ) AS MTBNEG
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE  `countys`.`ID` ='$county'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return (int) $rs[0]	;
	
	}
	
function getmtbrifpercounty($county){
$sql="SELECT 
sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE  `countys`.`ID` ='$county'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return  (int) $rs[0];
	
	}
function GetAllGeneSitesInCounty($county)
{
	$sql="SELECT 
		`section3`.`facility` AS a,
		`facilitys`.`name` AS b, 
		`districts`.`name` AS c,
		section3.make AS d,
		`countys`.`name` as county
		FROM `section3` ,facilitys, `districts` ,`countys`
		WHERE 
		`section3`.`facility`= `facilitys`.`facilitycode`
		AND  `districts`.`ID` = `facilitys`.`district`
		AND `countys`.`ID` = `districts`.`county`
		AND `countys`.`ID` ='$county'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_num_rows($query);
	return $rs;
		
}
		
?>

<map showBevel='0' showMarkerLabels='1' fillColor='F1f1f1' borderColor='000000' hoverColor='efeaef' canvasBorderColor='FFFFFF' baseFont='Verdana' baseFontSize='10' markerBorderColor='000000' markerBgColor='FF5904' markerRadius='6' legendPosition='bottom' useHoverColor='1' showMarkerToolTip='1'  showExportDataMenuItem='1' >

	<data>
	  <?php 
   $sql="select ID,name from countys ";
   $result=mysql_query($sql)or die(mysql_error());

$colors=array("FFFFCC"=>"1","E2E2C7"=>"2","FFCCFF"=>"3","F7F7F7"=>"5","FFCC99"=>"6","B3D7FF"=>"7","CBCB96"=>"8","FFCCCC"=>"9");

   while($row=mysql_fetch_array($result))
  {
	 	 
  	 $countyid=$row['ID'];
   	 $countyname=trim($row['name']);
	 $sql=mysql_query("select province as provid from  countys where ID='$countyid'") or die(mysql_error());
	 $sqlarray=mysql_fetch_array($sql);
	 $provid=$sqlarray['provid'];
   ?>
		<entity link='countyview.php?id=<?php echo $countyid;?>' id='<?php echo $countyid;?>' displayValue ='<?php  $countyname ?>'
        
		toolText='<?php echo $countyname . " County";?>
		&lt;BR&gt;<?php echo "Total Tests: " .gettestsdonepercounty($countyid); ?>
		&lt;BR&gt;<?php echo "MTB Positive: " .getmtbpospercounty($countyid); ?>
		&lt;BR&gt;<?php echo "Not Detected: " .getmtbnegpercounty($countyid); ?>
		&lt;BR&gt;<?php echo "RIF Resistant: " .getmtbrifpercounty($countyid); ?>
		&lt;BR&gt;<?php echo "GeneXpert Sites: " .GetAllGeneSitesInCounty($countyid); ?>' 
		
		color='<?php  echo array_rand($colors,1); ?>'  />
		
		
<?php
		}
?>		
		
	</data>
	
	
 
	
		<styles> 
  <definition>
   <style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/>
   <style name='HTMLFont' type='font' color='333333' borderColor='CCCCCC' bgColor='FFFFFF'/>
   <style name='myShadow' type='Shadow' distance='1'/>
  </definition>
  <application>
   <apply toObject='MARKERS' styles='myShadow' /> 
   <apply toObject='MARKERLABELS' styles='HTMLFont,myShadow' />
   <apply toObject='TOOLTIP' styles='TTipFont' />
  </application>
 </styles>
</map>