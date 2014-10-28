<?php
include('header.php');
	if (isset($_GET['id'])){
		$countyID = $_GET['id'];
		  
	}
?>
<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

    $sqlCN="SELECT name AS cN FROM countys WHERE ID ='$countyID'";
	$qCN=mysql_query($sqlCN,$conn ) or die(mysql_error());
	$rwCN=mysql_fetch_assoc($qCN);
    $countyname=$rwCN['cN'];


$sql="SELECT County,total
FROM(
SELECT 
countys.name AS County,
count(*) as total
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID'
Group by County
)x" ;	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);
if( mysql_num_rows($query)==0)
   {
		 $errormsg= 'There are no tests done in ' .$countyname. ' County';
   } 
 
/* ****************************************************/
 $sql="SELECT 
		`section3`.`facility` AS a,
		`facilitys`.`name` AS b, 
		`districts`.`name` AS c,
		section3.make AS d,
		`countys`.`name` as e
		FROM `section3` ,facilitys, `districts` ,`countys`
		WHERE 
		`section3`.`facility`= `facilitys`.`facilitycode`
		AND  `districts`.`ID` = `facilitys`.`district`
		AND `countys`.`ID` = `districts`.`county`
		AND `countys`.`ID` ='$countyID'";	
$q=mysql_query($sql,$conn ) or die(mysql_error());
$r=mysql_fetch_assoc($q);

       
/* ****************************************************/
$TTC=totalTestsCountyWise1($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$ageC=totalTestsPerCountyByAge1($countyID, $filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate); 
$genderC=totalTestsPerCountyByGender1($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$hstatusC=totalTestsPerCountyByHStatus1($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$ptypeC=totalTestsPerCountyByPtype1($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);

?>
<!DOCTYPE html>
<html lang="en">
	
	
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="../FusionMaps/JSClass/FusionMaps.js"></script>
    <script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>
    
<div class="main-content" style="margin-top: 5%;margin-left: .3%">
	<ol class="breadcrumb" class="navbar-fixed-top">
		<form id="customForm"  method="GET" action="" >
<div><strong> Date Range: </strong>&nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></B></U>   |<small>  
<?php

if (isset($_GET['id'])){
		 $_SESSION['cid'] = $_GET['id'];
		 $countyID =  $_SESSION['cid'];
	}

   if ($filter==1)//LAST 3 MONTHS
    {
    echo "<a href='$D?id=$countyID&filter=0' title=' Click to Filter View to Last Submission Statistics'>   Last Upload </a> | 
          <a href='$D?id=$countyID&filter=7' title=' Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>";           
    }
    elseif ($filter==7)//LAST 6 MONTHS
    {
    echo "<a href=' $D?id=$countyID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload</a>  |
          <a href=' $D?id=$countyID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a>"; 

    }
    elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
    {

    echo "<a href=' $D?id=$countyID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a>  |
          <a href=' $D?id=$countyID&filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a> |
          <a href=' $D?id=$countyID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==4) || ($filter==3)) //month/year filter
    {
    echo "<a href=' $D?id=$countyID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a> |
          <a href=' $D?id=$countyID&filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>  |
          <a href=' $D?id=$countyID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==0) ||($filter=='') || ($filter==8)) //Lst submitted//all
    {

     echo "<a href='$D?id=$countyID&filter=7' title=' Click to Filter View to Last 3 months Statistics'>   Last 6 Months </a>  | 
           <a href='$D?id=$countyID&filter=1' title=' Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";
   
    }
?>|    
<a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;' title='Click to Filter View based on Date Range you Specify"> Customize Dates</a></font></small>
</div>    
<div style="margin-left: 46%;margin-top: -1%;">
	| 
	        <?php
                $year = GetMaxYear1();
                $twoless = GetMinYear1();
                echo "<a href=$D?id=$countyID&filter=8 title='Click to Filter View cumulative data'>   All  | </a>";
                for ($year; $year >= $twoless; $year--) 
                {
                    echo "<a href=$D?id=$countyID&year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
                }
            ?>
</div>
<div style="margin-left: 69%;margin-top: -1%">
             <?php $year = $_GET['year'];
                  if ($year == "") 
                  {
                     $year = @date('Y');
                  }
                  echo "<a href =$D?id=$countyID&year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>"; ?>  |
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | 
            <?php echo "<a href =$D?id=$countyID&year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>
</div>


<div class="mid" id="HiddenDiv" style="DISPLAY: none" >
	
<div>From:<label style="margin-left: 15%">To:</label></div>
<div class="col-md-2">
<input class="form-control datepicker" type="text" data-format="yyyy-mm-dd" id="fromfilter" name="fromfilter" size="18"  />
</div>

<div class="col-md-2">
<input class="form-control datepicker" type="text" data-format="yyyy-mm-dd" id="tofilter" name="tofilter" size="18" />
</div>
<input type="submit" id="submitform" name="submitform" value="Filter" class="btn btn-green"/>
</div>


</form>
</ol>

 <?php if ($errormsg !="")
					{
					?> 
				<div class="alert alert-danger" style="text-align: center;width: 320px;"><?php 
				
		               echo  $errormsg;
		
				?></div>
				<?php } else
						{ ?>
						<h2 align="center"><?php echo $countyname ?> County Summaries</h2>
				<?php } ?>
<hr />
<div class="row">
	<div class="col-sm-5">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Testing Trends for:
					<br />
						<small><?php echo $currentyear; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<div id="chartdivtre"> <?php $kad="id=".$countyID."&mwaka=".$currentyear; ?>
				   <script type="text/javascript">
				      var myChart = new FusionCharts("../FusionCharts/Charts/MSLine.swf", "myChartId", "525", "345", "0", "0");
				    myChart.setDataURL("countytrendline.php?<?php echo $kad; ?>");
				    myChart.render("chartdivtre");
				    
				   </script> 
				</div>
			</div>
		</div>

	</div>
	

	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Age:
						<br />
						<small><?php echo $minY = GetMinYear1(); ?> - <?php echo $maxY = GetMaxYear1(); ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		  
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center"><5 Yrs</td>
					<td  style="text-align:center">Btwn 5-15 Yrs</td>
					<td  style="text-align:center">>15 Yrs</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center"><?php echo $TTC[4] ;?></td>
					<td style="text-align:center"><?php echo $TTC[7] ;?></td>
					<td style="text-align:center"><?php echo $TTC[10] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $TTC[5] ;?></td>
					<td style="text-align:center"><?php echo $TTC[8] ;?></td>
					<td style="text-align:center"><?php echo $TTC[11] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $TTC[6] ;?></td>
					<td style="text-align:center"><?php echo $TTC[9] ;?></td>
					<td style="text-align:center"><?php echo $TTC[12] ;?></td>
					</tr>
					</tbody>
				</table>
			
		</div>

	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Tests By Age
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<div id="chartnat1"  align="center"> 
         <script type="text/javascript">
    var myChart = new FusionCharts("../FusionCharts/Charts/Doughnut2D.swf", "myChartnat", "300", "133", "0", "0");
    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"  pieSliceDepth="30" startingAngle="125"><set value="<?php echo $ageC[0]; ?>" label="Above 15 Yrs" color="C295F2"/><set value="<?php echo $ageC[1]; ?>" label="Btwn 5-15 Yrs" color="#ADFF2F"/><set value="<?php echo $ageC[2]; ?>" label="Below 5 Yrs" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
    myChart.render("chartnat1");
    
   </script> 
</div>
			</div>
		</div>

	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Tests By Gender
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<div id="chartnat2"  align="center"> 
         		<script type="text/javascript">
			   var myChart = new FusionCharts("../FusionCharts/Charts/Pie3D.swf", "myChartnat", "300", "133", "0", "0");
			   myChart.setDataXML('<chart bgcolor="FFFFFF" showborder="0" palette="2" animation="1"  pieSliceDepth="30" startingAngle="125" ><set value="<?php echo $genderC[0]; ?>" label="Male" color="C295F2"/><set value="<?php echo $genderC[1]; ?>" label="Female" color="#ADFF2F"/><set value="<?php echo $genderC[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			   myChart.render("chartnat2");
			    
			   </script> 
			</div>
			</div>
		</div>

	</div>
	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Gender
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">Male</td>
					<td  style="text-align:center">Female</td>
					<td  style="text-align:center">Not specified</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center"><?php echo $TTC[13] ;?></td>
					<td style="text-align:center"><?php echo $TTC[16];?></td>
					<td style="text-align:center"><?php echo $TTC[19] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $TTC[14] ;?></td>
					<td style="text-align:center"><?php echo $TTC[17] ;?></td>
					<td style="text-align:center"><?php echo $TTC[20] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $TTC[15] ;?></td>
					<td style="text-align:center"><?php echo $TTC[18] ;?></td>
					<td style="text-align:center"><?php echo $TTC[21] ;?></td>
					</tr>
					</tbody>
					</table> 
		</div>

	</div>
	
	
</div>


<br />

<div class="row">
	
	<div class="col-sm-5">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Cumulative Data Since The Year
					<br />
						<small><?php echo $minY = GetMinYear1(); ?> - <?php echo $maxY = GetMaxYear1(); ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<table class="table table-condensed">
			<thead>
			<tr>
			<td style="text-align:center">Total Tests</td>
			<td style="text-align:center">MTB +ve</td>
			<td style="text-align:center">MTB -ve</td>
			<td style="text-align:center">RIF Resistant</td>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td style="text-align:center"><?php echo $TTC[0] ;?></td>
			<td style="text-align:center"><?php echo $TTC[1]  ;?></td>
			<td style="text-align:center"><?php echo $TTC[2] ;?></td>
			<td style="text-align:center"><?php echo $TTC[3] ;?></td>
			</tr>
			</tbody>
			</table>
		</div>

	</div>
		
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Tests By Hiv Status
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<div id="chartnat3"  align="center"> 
        		<script type="text/javascript">
      			var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartnat", "300", "140", "0", "0");
			    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"   pieSliceDepth="30" startingAngle="125"> <set value="<?php echo $hstatusC[0]; ?>" label="Positive" color="C295F2"/><set value="<?php echo $hstatusC[1]; ?>" label="Negative" color="#ADFF2F"/><set value="<?php echo $hstatusC[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			    myChart.render("chartnat3"); 
			    </script> 
			</div>
				
			</div>
		</div>

	</div>
	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Hiv Status
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">+ve</td>
					<td  style="text-align:center">-ve</td>
					<td  style="text-align:center">Not specified</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center"><?php echo $TTC[22] ;?></td>
					<td style="text-align:center"><?php echo $TTC[25] ;?></td>
					<td style="text-align:center"><?php echo $TTC[28] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $TTC[23] ;?></td>
					<td style="text-align:center"><?php echo $TTC[26] ;?></td>
					<td style="text-align:center"><?php echo $TTC[29] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $TTC[24] ;?></td>
					<td style="text-align:center"><?php echo $TTC[27];?></td>
					<td style="text-align:center"><?php echo $TTC[30] ;?></td>
					</tr>
					</tbody>
				</table>
			
		</div>

	</div>
	
</div>

<br />
<div class="row">
	
	<div class="col-sm-5">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Outcome By Patient Categories
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
				
			<div id="chartp"  align="center"> 
	         	<script type="text/javascript">
	      		var myChart = new FusionCharts("../FusionCharts/Charts/StackedColumn2D.swf", "myChartnat", "500", "300", "0", "0");
	     	 	myChart.setDataXML('<chart palette="2" yAxisName="# of Patients"  showLabels="1" showvalues="0"  numberPrefix="" showSum="0" decimals="0" useRoundEdges="1" legendBorderAlpha="0" bgcolor="FFFFFF" showborder="0"><categories><category label="sputum smear-positive relapse" /><category label="sputum smear-negative relapse" /><category label="Return after defaulting" /><category label="Failure 1-st line treatment" /><category label="Failure re-treatment" /><category label="New Patients" /><category label="New case PTB" /><category label="MDR TB Contact" /><category label="Refugees SS+ve" /><category label="HCWs" /><category label="Hiv(+) & Smear(-)" /></categories><dataset seriesName="MTB Pos" color="AFD8F8" showValues="0"><set value="<?php echo $ptypeC[0]; ?>" /><set value="<?php echo $ptypeC[2]; ?>" /><set value="<?php echo $ptypeC[4]; ?>" /><set value="<?php echo $ptypeC[6]; ?>" /><set value="<?php echo $ptypeC[8]; ?>" /><set value="<?php echo $ptypeC[10]; ?>" /><set value="<?php echo $ptypeC[12]; ?>" /><set value="<?php echo $ptypeC[14]; ?>" /><set value="<?php echo $ptypeC[16]; ?>" /><set value="<?php echo $ptypeC[18]; ?>" /><set value="<?php echo $ptypeC[20]; ?>" /></dataset><dataset seriesName="Rif Resistant" color="F6BD0F" showValues="0"><set value="<?php echo $ptypeC[1] ; ?>" /><set value="<?php echo $ptypeC[3] ; ?>" /><set value="<?php echo $ptypeC[5] ; ?>" /><set value="<?php echo $ptypeC[7] ; ?>" /><set value="<?php echo $ptypeC[9] ; ?>" /><set value="<?php echo $ptypeC[11] ; ?>" /><set value="<?php echo $ptypeC[13] ; ?>" /><set value="<?php echo $ptypeC[15] ; ?>" /><set value="<?php echo $ptypeC[17] ; ?>" /><set value="<?php echo $ptypeC[19] ; ?>" /><set value="<?php echo $ptypeC[21] ; ?>" /></dataset></chart>');
	     		myChart.render("chartp");
	            </script> 
			</div>

		</div>
		
	</div>

	<div class="col-sm-7">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By patient Categories
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
				
			<table class="table table-striped">
				<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td style="text-align:center">sputum smear (+) relapse</td>
					<td style="text-align:center">sputum smear (-) relapse</td>
					<td style="text-align:center">Return after defaulting</td>
					<td style="text-align:center">Failure 1st line treatment</td>
					<td style="text-align:center">Failure re-treatment</td>
					<td style="text-align:center">New Patients</td>
					<td style="text-align:center">New case PTB</td>
					<td style="text-align:center">MDR TB Contact</td>
					<td style="text-align:center">Refugees SS+ve</td>
					<td style="text-align:center">HCWs</td>
					<td style="text-align:center">Hiv (+) & Smear (-)</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"> Tests</td>
					<td style="text-align:center"><?php echo $TTC[31] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[34] ;?></td>
					<td style="text-align:center"><?php echo $TTC[37] ;?></td>
					<td style="text-align:center"><?php echo $TTC[40] ;?></td>
					<td style="text-align:center"><?php echo $TTC[43] ;?></td>
					<td style="text-align:center"><?php echo $TTC[46] ;?></td>
					<td style="text-align:center"><?php echo $TTC[49] ;?></td>
					<td style="text-align:center"><?php echo $TTC[52] ;?></td>
					<td style="text-align:center"><?php echo $TTC[55] ;?></td>
					<td style="text-align:center"><?php echo $TTC[58] ;?></td>
					<td style="text-align:center"><?php echo $TTC[61] ;?></td>

					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $TTC[32] ;?></td>
					<td style="text-align:center"><?php echo $TTC[35] ;?></td>
					<td style="text-align:center"><?php echo $TTC[38] ;?></td>
					<td style="text-align:center"><?php echo $TTC[41] ;?></td>
					<td style="text-align:center"><?php echo $TTC[44] ;?></td>
					<td style="text-align:center"><?php echo $TTC[47] ;?></td>
					<td style="text-align:center"><?php echo $TTC[50] ;?></td>
					<td style="text-align:center"><?php echo $TTC[53] ;?></td>
					<td style="text-align:center"><?php echo $TTC[56] ;?></td>
					<td style="text-align:center"><?php echo $TTC[59] ;?></td>
					<td style="text-align:center"><?php echo $TTC[62] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $TTC[33] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[36] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[39] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[42] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[45] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[48] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[51] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[54] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[57] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[60] ; ?></td>
					<td style="text-align:center"><?php echo $TTC[63] ; ?></td>
					</tr>
					</tbody>
					</table>
						
		</div>
		
	</div>

</div>
<div class="row">
	<div class="col-sm-7">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						GeneXpert Sites In The County
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
				
			<table class="table table-striped">
				<thead>
					<?php if( mysql_num_rows($q)>0)
            { ?>
					<tr>
					<th style="text-align:center;">Mfl Code</th>
					<th style="text-align:center;">Facility Name</th>
					<th style="text-align:center;">District</th>
					<th style="text-align:center;">GeneXpert Serial No.</th>
					</thead>
					<?php do { ?>
					<tbody>
					<tr>
					<td style="text-align:center"><?php echo $r['a']; ?></td>
				    <td style="text-align:center"><?php echo $r['b']; ?></td>
				    <td style="text-align:center"><?php echo $r['c']; ?></td>
				    <td style="text-align:center"><?php echo $r['d']; ?></td>
					</tr>
					<?php } while($r=mysql_fetch_assoc($q)); } else 
   {
		 echo '<div class="alert alert-warning">There are no GeneXpert Sites in ' .$countyname. ' County</div>';
   }  ?>
					</tbody>
					</table>
						
		</div>
		
	</div>
	
</div>
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
	
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
    <script src="../admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
		
		
	</script>
	
</body>
</html>