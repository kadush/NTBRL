<?php
@require_once('../connection/db.php');
$currentmonth=date("m");
$currentyear=date("Y");
$previousmonth=date("m")- 1;

if ($currentmonth ==1)
{
$previousmonth=12;
$currentyear=date("Y")-1;
}
else
{
$previousmonth=date("m")- 1;
$currentyear=date("Y");
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

//total patients in county
function TOTALFacilitypercounty($county){
		
$sql="SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY
FROM `facilitys` , `districts` ,`countys`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$county'

";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
return $rw;
	
}
function TOTALFacilityReportedpercounty($county,$previousmonth,$currentyear){
$sql= "SELECT 
`consumption`.`facility` AS a,
`facilitys`.`name` AS b, 
`districts`.`name` AS c,
consumption.commodity AS d,
consumption.quantity AS e,
consumption.quantity_used AS f,
consumption.end_bal AS g,
consumption.q_req AS h,
`countys`.`name` as county
FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$county'
AND MONTH(consumption.date)='$previousmonth'
AND YEAR(consumption.date)='$currentyear'
Group by `consumption`.`facility`";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
return $rw;
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
	     $TT=TOTALFacilityReportedpercounty($row['ID'],$previousmonth,$currentyear);
		 $TT1=TOTALFacilitypercounty($row['ID']);
		 $siteC=GetAllGeneSitesInCounty($row['ID']);
		
	 
  	 $countyid=$row['ID'];
   	 $countyname=trim($row['name']);
	 $sql=mysql_query("select province as provid from  countys where ID='$countyid'") or die(mysql_error());
	 $sqlarray=mysql_fetch_array($sql);
	 $provid=$sqlarray['provid'];
   ?>
		<entity link='countyallocation.php?id=<?php echo $countyid;?>' id='<?php echo $countyid;?>' displayValue ='<?php  $countyname ?>'
        
		toolText='<?php echo $countyname . " County";?>
		&lt;BR&gt;<?php echo "Total No of Facilities: " .$TT1; ?>
		&lt;BR&gt;<?php echo "Reported facilities: " .$TT; ; ?>
		&lt;BR&gt;<?php echo "GeneXpert Sites: " .$siteC ; ?>' 
		
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