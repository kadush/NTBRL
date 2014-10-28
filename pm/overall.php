<?php
include('header1.php');

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
$sql="SELECT total,mtb,neg,rif,errs
FROM(
SELECT 

sum(CASE WHEN cond='1' THEN 1 ELSE 0 END) as total,

sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,

sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,

sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,  

sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS errs  
FROM sample1 where cond=1)x" ;	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$total=$rs['total'];
$mtb=$rs['mtb'];
$notb=$rs['neg'];
$rif=$rs['rif'];
$errs=$rs['errs'];

/* ****************************************************/
$tnat=totalTestsNational($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$tt=totalTestsByOutcome($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$age=totalTestsByAge($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$gender=totalTestsByGender($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$hstatus=totalTestsByHStatus($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$ptype=totalTestsByPtype($filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
?>
<!DOCTYPE html>
<html lang="en">
<script language="JavaScript" src="../FusionMaps/JSClass/FusionMaps.js"></script>
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>


<div class="main-content" style="padding-left: 1.5%;padding-right: 1.5%;">   
<div class="row" >
	<ol class="breadcrumb" class="navbar-fixed-top">
		<form id="customForm"  method="GET" action="" >
<div><strong> Date Range: </strong>&nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></B></U>   |<small>  
<?php


   if ($filter==1)//LAST 3 MONTHS
    {?>
    <a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> 
<?php
}
elseif ($filter==7)//LAST 6 MONTHS
{
?>
   <a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload</a>  |
   <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
{
?>
    <a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a>  |
    <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a> |
    <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
<?php
}
elseif (($filter==4) || ($filter==3)) //month/year filter
{
 ?><a href="<?php echo $D; ?>?filter=0" title=" Click to Filter View to Last Submission Statistics">   Last Upload </a> | <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 6 months Statistics">   Last 6 Months </a>  |
 <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
 <?php
    }
    elseif (($filter==0) ||($filter=='') || ($filter==8)) //Lst submitted//all
    {
?>
      <a href="<?php echo $D; ?>?filter=7" title=" Click to Filter View to Last 3 months Statistics">   Last 6 Months </a>  | <a href="<?php echo $D; ?>?filter=1" title=" Click to Filter View to Last 3 months Statistics">   Last 3 Months </a> 
    <?php
    }
?>|    <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Filter View based on Date Range you Specify"> Customize Dates</a></font></small>
<class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
 | <?php
                $year = GetMaxYear();
                $twoless = GetMinYear();
				echo "<a href=$D?filter=8 title='Click to Filter View cumulative data'>   All  | </a>";
                for ($year; $year >= $twoless; $year--) {

                    echo "<a href=$D?year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
                }
                        ?>
<span class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
           <?php $year = $_GET['year'];
                        if ($year == "") {
                            $year = @date('Y');
                        }
                        echo "<a href =$D?year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>";
                    ?> | <?php echo "<a href =$D?year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb </a>"; ?>| <?php echo "<a href =$D?year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | <?php echo "<a href =$D?year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>
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
</div>
<div class="row">
	<div class="col-sm-5">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						National Outcome For:
					<br />
						<small><?php echo $minY = GetMinYear(); ?> - <?php echo $maxY = GetMaxYear(); ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<div id="mapdiv"> 
				    <script type="text/javascript">
					   var map = new FusionMaps("../FusionMaps/FCMap_KenyaCounty.swf", "mapdiv", "525", "375", "0", "0");
					   map.setDataURL("../xml1/countymap.php");		   
					   map.render("mapdiv");
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
						National Tests Outcome
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
				<div id="chartnatw"  align="center"> </div>
					<?php if (($tt[0]==0) and ($tt[1]==0) and ($tt[2]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "163", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnatw");
				    </script>		
						
					<?php } else { ?> 
			         <script type="text/javascript">
			          var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartnat", "300", "163", "0", "0");
			          myChart.setDataXML('<chart bgcolor="#FFFFFF" showBorder="0" ><set  isSliced="1" label="MTB Pos" color="00ACE8" value="<?php echo $tt[1]; ?>"/><set  label="MTB Neg" color="C295F2" value="<?php echo $tt[2]; ?>"/><set  label="RIF Resistant" color="ADFF2F" value="<?php echo $tt[3];?>"/></chart>');  
			          myChart.render("chartnatw");
			         </script> 
				    <?php } ?>
			 
		       
			</div>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						National Statistics From The Year:
						<br />
						<small><?php echo $minY = GetMinYear(); ?> - <?php echo $maxY = GetMaxYear(); ?></small>
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
					<td style="text-align:center">Total Tests</td>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">MTB -ve</td>
					<td style="text-align:center">RIF Resistant</td>
					<td style="text-align:center">Errors</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"><?php echo $total ;?></td>
					<td style="text-align:center"><?php echo $mtb ;?></td>
					<td style="text-align:center"><?php echo $notb ;?></td>
					<td style="text-align:center"><?php echo $rif ;?></td>
					<td style="text-align:center"><?php echo $errs ;?></td>
					</tr>
					</tbody>
				</table> <br>
					<b>&nbsp;&nbsp;&nbsp;&nbsp;Cumulative View :  <?php echo $title; ?> </b>
					<table class="table table-bordered">
					<thead>
					<tr>
					<td style="text-align:center">Total Tests</td>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">MTB -ve</td>
					<td style="text-align:center">RIF Resistant</td>
					<td style="text-align:center">Errors</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"><?php echo $tt[0] ;?></td>
					<td style="text-align:center"><?php echo $tt[1]  ;?></td>
					<td style="text-align:center"><?php echo $tt[2] ;?></td>
					<td style="text-align:center"><?php echo $tt[3] ;?></td>
					<td style="text-align:center"><?php echo $tt[4] ;?></td>
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
				<div id="chartnat1"  align="center"> FusionCharts will load here</div>
					<?php if (($age[0]==0) and ($age[1]==0) and ($age[2]==0)) { ?>
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Doughnut2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "133", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat1");
				    </script>
						
					<?php } else { ?>
						<script type="text/javascript">
					    var myChart = new FusionCharts("../FusionCharts/Charts/Doughnut2D.swf", "myChartnat", "300", "133", "0", "0");
					    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"  pieSliceDepth="30" startingAngle="125"><set value="<?php echo $age[0]; ?>" label="Above 15 Yrs" color="C295F2"/><set value="<?php echo $age[1]; ?>" label="Btwn 5-15 Yrs" color="#ADFF2F"/><set value="<?php echo $age[2]; ?>" label="Below 5 Yrs" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
					    myChart.render("chartnat1");
					    
					   </script> 
					<?php } ?>
					
			</div>
		</div>

	</div>
	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Age
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
					<td  style="text-align:center"><5 Yrs</td>
					<td  style="text-align:center">Btwn 5-15 Yrs</td>
					<td  style="text-align:center">>15 Yrs</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center"><?php echo $tnat[0] ;?></td>
					<td style="text-align:center"><?php echo $tnat[3] ;?></td>
					<td style="text-align:center"><?php echo $tnat[6] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $tnat[1] ;?></td>
					<td style="text-align:center"><?php echo $tnat[4] ;?></td>
					<td style="text-align:center"><?php echo $tnat[7] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $tnat[2] ;?></td>
					<td style="text-align:center"><?php echo $tnat[5] ;?></td>
					<td style="text-align:center"><?php echo $tnat[8] ;?></td>
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
						Testing Trends For: 
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
				<div id="chartdivtre"> 
				   <script type="text/javascript">
				      var myChart = new FusionCharts("../FusionCharts/Charts/MSLine.swf", "myChartId", "520", "300", "0", "0");
				    myChart.setDataURL("../xml1/nationaltrendline.php?mwaka=<?php echo $currentyear; ?>");
				    myChart.render("chartdivtre");
				    
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
					 Tests by Gender
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
				<div id="chartnat2"  align="center">FusionCharts will load here</div>

					<?php if (($gender[0]==0) and ($gender[1]==0) and ($gender[2]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Pie3D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "130", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat2");
				    </script>		
						
					<?php } else { ?>
					
         		<script type="text/javascript">
			   var myChart = new FusionCharts("../FusionCharts/Charts/Pie3D.swf", "myChartnat", "300", "130", "0", "0");
			   myChart.setDataXML('<chart bgcolor="FFFFFF" showborder="0" palette="2" animation="1"  pieSliceDepth="30" startingAngle="125" ><set value="<?php echo $gender[0]; ?>" label="Male" color="C295F2"/><set value="<?php echo $gender[1]; ?>" label="Female" color="#ADFF2F"/><set value="<?php echo $gender[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			   myChart.render("chartnat2");
			    
			   </script> <?php } ?>
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
					<td style="text-align:center"><?php echo $tnat[9] ;?></td>
					<td style="text-align:center"><?php echo $tnat[12];?></td>
					<td style="text-align:center"><?php echo $tnat[15] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $tnat[10] ;?></td>
					<td style="text-align:center"><?php echo $tnat[13] ;?></td>
					<td style="text-align:center"><?php echo $tnat[16] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $tnat[11] ;?></td>
					<td style="text-align:center"><?php echo $tnat[14] ;?></td>
					<td style="text-align:center"><?php echo $tnat[17] ;?></td>
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
				<div id="chartnat3"  align="center"></div>
				 <?php if (($hstatus[0]==0) and ($hstatus[1]==0) and ($hstatus[2]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "140", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat3");
				    </script>		
						
					<?php } else { ?> 
        		<script type="text/javascript">
      			var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartnat", "300", "140", "0", "0");
			    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"   pieSliceDepth="30" startingAngle="125"> <set value="<?php echo $hstatus[0]; ?>" label="Positive" color="C295F2"/><set value="<?php echo $hstatus[1]; ?>" label="Negative" color="#ADFF2F"/><set value="<?php echo $hstatus[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			    myChart.render("chartnat3"); 
			    </script> 
			    <?php } ?>
			
				
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
					<td style="text-align:center"><?php echo $tnat[18] ;?></td>
					<td style="text-align:center"><?php echo $tnat[21] ;?></td>
					<td style="text-align:center"><?php echo $tnat[24] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $tnat[19] ;?></td>
					<td style="text-align:center"><?php echo $tnat[22] ;?></td>
					<td style="text-align:center"><?php echo $tnat[25] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $tnat[20] ;?></td>
					<td style="text-align:center"><?php echo $tnat[23];?></td>
					<td style="text-align:center"><?php echo $tnat[26] ;?></td>
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
		      var myChart = new FusionCharts("../FusionCharts/Charts/StackedColumn2D.swf", "myChartnat", "480", "300", "0", "0");
		      myChart.setDataXML('<chart palette="2" yAxisName="# of Patients"  showLabels="1" showvalues="0"  numberPrefix="" showSum="0" decimals="0" useRoundEdges="1" legendBorderAlpha="0" bgcolor="FFFFFF" showborder="0"><categories><category label="sputum smear-positive relapse" /><category label="sputum smear-negative relapse" /><category label="Return after defaulting" /><category label="Failure 1-st line treatment" /><category label="Failure re-treatment" /><category label="New Patients" /><category label="New case PTB" /><category label="MDR TB Contact" /><category label="Refugees SS+ve" /><category label="HCWs" /><category label="Hiv(+) & Smear(-)" /></categories><dataset seriesName="MTB Pos" color="AFD8F8" showValues="0"><set value="<?php echo $ptype[0]; ?>" /><set value="<?php echo $ptype[2]; ?>" /><set value="<?php echo $ptype[4]; ?>" /><set value="<?php echo $ptype[6]; ?>" /><set value="<?php echo $ptype[8]; ?>" /><set value="<?php echo $ptype[10]; ?>" /><set value="<?php echo $ptype[12]; ?>" /><set value="<?php echo $ptype[14]; ?>" /><set value="<?php echo $ptype[16]; ?>" /><set value="<?php echo $ptype[18]; ?>" /><set value="<?php echo $ptype[20]; ?>" /></dataset><dataset seriesName="Rif Resistant" color="F6BD0F" showValues="0"><set value="<?php echo $ptype[1] ; ?>" /><set value="<?php echo $ptype[3] ; ?>" /><set value="<?php echo $ptype[5] ; ?>" /><set value="<?php echo $ptype[7] ; ?>" /><set value="<?php echo $ptype[9] ; ?>" /><set value="<?php echo $ptype[11] ; ?>" /><set value="<?php echo $ptype[13] ; ?>" /><set value="<?php echo $ptype[15] ; ?>" /><set value="<?php echo $ptype[17] ; ?>" /><set value="<?php echo $ptype[19] ; ?>" /><set value="<?php echo $ptype[21] ; ?>" /></dataset></chart>');
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
					<td style="text-align:center"><?php echo $tnat[27] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[30] ;?></td>
					<td style="text-align:center"><?php echo $tnat[33] ;?></td>
					<td style="text-align:center"><?php echo $tnat[36] ;?></td>
					<td style="text-align:center"><?php echo $tnat[39] ;?></td>
					<td style="text-align:center"><?php echo $tnat[42] ;?></td>
					<td style="text-align:center"><?php echo $tnat[45] ;?></td>
					<td style="text-align:center"><?php echo $tnat[48] ;?></td>
					<td style="text-align:center"><?php echo $tnat[51] ;?></td>
					<td style="text-align:center"><?php echo $tnat[54] ;?></td>
					<td style="text-align:center"><?php echo $tnat[57] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center"><?php echo $tnat[28] ;?></td>
					<td style="text-align:center"><?php echo $tnat[31] ;?></td>
					<td style="text-align:center"><?php echo $tnat[34] ;?></td>
					<td style="text-align:center"><?php echo $tnat[37] ;?></td>
					<td style="text-align:center"><?php echo $tnat[40] ;?></td>
					<td style="text-align:center"><?php echo $tnat[43] ;?></td>
					<td style="text-align:center"><?php echo $tnat[46] ;?></td>
					<td style="text-align:center"><?php echo $tnat[49] ;?></td>
					<td style="text-align:center"><?php echo $tnat[52] ;?></td>
					<td style="text-align:center"><?php echo $tnat[55] ;?></td>
					<td style="text-align:center"><?php echo $tnat[58] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center"><?php echo $tnat[29] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[32] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[35] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[38] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[41] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[44] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[47] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[50] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[53] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[56] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[59] ; ?></td>
					</tr>
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