<?php
include('header.php');
require_once('../connection/db.php'); 
//get a list of facility
$sql= "SELECT Distinct s.facility AS a, f.name AS b FROM sample1 s,facilitys f
where s.facility=f.facilitycode and s.facility>1 group by s.facility";
$rsFinC = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//to be used in facility.php

$FacID = $_GET['id'];
if (isset($_GET['year'])){
 $mwaka = $_GET['year'];
} 
else {
	$mwaka = date('Y');
}
$mwaka = $_GET['year'];
$mwezi = $_GET['mwezi'];

  $sql="SELECT name as fn FROM facilitys where facilitycode='$FacID'";	
  $query=mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
  $rs=mysqli_fetch_assoc($query);
  $fname=$rs['fn'];


if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	$FacID = $_GET['id'];
	
	if ($filter == 1)//LAST 3 MONTHS
	{
		$todate = @date("Y-m-d");
		// current date
		$fromdate = @date('Y-m-d', strtotime('-3 month'));
		$displayfromdate = @date("d-M-Y", strtotime($fromdate));
		$displaytodate = @date("d-M-Y", strtotime($todate));
		$title = "Last 3 Months";
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 3;
		$mapwidth = 540;

	} elseif ($filter == 7)//last 6 months
	{
		$todate = @date("Y-m-d");
		// current date
		$fromdate = @date('Y-m-d', strtotime('-6 month'));
		$displayfromdate = @date("d-M-Y", strtotime($fromdate));
		$displaytodate = @date("d-M-Y", strtotime($todate));
		$title = "Last 6 Months";
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 6;
		$mapwidth = 540;
	} elseif ($filter == 0)//last submission
	{
		$filter = 0;
		$colspan = 6;
		$mapwidth = 540;
		$currentmonth = GetMaxMonthbasedonMaxYear($mwezi);
		$displaymonth = GetMonthName($currentmonth);
		$currentyear = GetMaxYear($mwaka);
		$title = "Last Upload :" . $displaymonth . ' - ' . $currentyear;
		//get current month and year
	} elseif ($filter == 3)//month/year
	{
		$displaymonth =GetMonthName($mwezi);
		$title = $displaymonth . ' - ' . $mwaka;
		//get current month and year
		$currentmonth = $mwezi;
		$currentyear = $mwaka;
		$colspan = 1;
		$mapwidth = 540;
	} elseif ($filter == 4)//year
	{
		$title = $mwaka;
		//get current month and year
		$currentmonth = "";
		//get current month and year
		$currentyear = $mwaka;
		$colspan = 12;
		$mapwidth = 400;
	}
	elseif ($filter == 8)//all
	{
		$currentmonth = GetMaxMonthbasedonMaxYear($mwezi);
		$currentyear = GetMaxYear($mwaka);
		$displaymonth = GetMonthName($currentmonth);
		$minyear = GetMinYear();
		$title = "Cumulative Data : " . $minyear . ' to ' . $displaymonth . ' - ' . $currentyear;
		
	}
} else {
	if ($_REQUEST['submitform']) {
		$filter = 2;
		$fromfilter = $_GET['fromfilter'];
		$tofilter = $_GET['tofilter'];
		$displayfromfilter = @date("d-M-Y", strtotime($fromfilter));
		$displaytofilter = @date("d-M-Y", strtotime($tofilter));
		$title = $displayfromfilter . "  to  " . $displaytofilter;
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 1;
		$mapwidth = 540;
	} else {
		if (isset($mwaka)) {
			if (isset($mwezi)) {
				$filter = 3;
				$displaymonth = GetMonthName($mwezi);
				$title = $displaymonth . ' - ' . $mwaka;
				//get current month and year
				$currentmonth = $mwezi;
				$currentyear = $mwaka;
				$colspan = 1;
				$mapwidth = 540;
			} else {
				$filter = 4;
				$title = $mwaka;
				//get current month and year
				$currentmonth = "";
				//get current month and year
				$currentyear = $mwaka;
				$colspan = 12;
				$mapwidth = 400;
			}
		} else  {	
		    $filter = 0;
			$colspan = 6;
			$mapwidth = 540;

			$currentmonth = GetMaxMonthbasedonMaxYear($samp);
			$displaymonth = GetMonthName($currentmonth);
			$currentyear = GetMaxYear($samp);
			$title = "Last Upload :" . $displaymonth . ' - ' . $currentyear;
			//get current month and year
		}
	}
}


$tnat=totalTestsFacilityWise($FacID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
$tt=totalTestsByOutcomeFacilityWise($FacID,$filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$age=totalTestsByAgeFacilityWise($FacID,$filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$gender=totalTestsByGenderFacilityWise($FacID,$filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$hstatus=totalTestsByHStatusFacilityWise($FacID,$filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
$ptype=totalTestsByPtypeFacilityWise($FacID,$filter, $currentmonth, $currentyear, $fromfilter, $tofilter, $fromdate, $todate);
/* ****************************************************/
$cm=@date("m");
$cy=@date("Y");
$pm=@date("m")- 1;

if ($cm ==1)
{
$pm=12;
$cy=@date("Y")-1;
}
else
{
$pm=@date("m")- 1;
$cy=@date("Y");
} 
$q = "SELECT DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate FROM sample1 s WHERE s.facility LIKE '%$FacID%'";
$r = mysqli_query($dbConn,$q, $ntrl) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($r);
$expdate= $row['DiffDate'];

$q = "SELECT (c.end_bal+c.received) AS cart FROM consumption c WHERE  c.facility LIKE '%$FacID%' and c.commodity='Cartridge' ORDER BY c.date DESC LIMIT 1";
$r = mysqli_query($dbConn,$q, $ntrl) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($r);
$cartridges= $row['cart'];

$q = "SELECT (c.end_bal+c.received) AS tubes FROM consumption c WHERE  c.facility LIKE '%$FacID%' and c.commodity='Falcon Tubes'  ORDER BY c.date DESC LIMIT 1";
$r = mysqli_query($dbConn,$q, $ntrl) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($r);
$tubes= $row['tubes'];

$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$cm' and  YEAR(End_Time)='$cy' and cond=1 and facility LIKE '%$FacID%'";
$rssample = mysqli_query($dbConn,$query_rssample, $ntrl) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$testdonethismonth = mysqli_num_rows($rssample);

$query_rssample = "SELECT 
(
 SELECT c_quantity FROM stock_adjustment WHERE MONTH(date)='$cm' and  YEAR(date)='$cy' and facility LIKE '%$FacID%' and adjustment=1 LIMIT 1
)AS pos_cart, 
(
 SELECT f_quantity FROM stock_adjustment WHERE MONTH(date)='$cm' and  YEAR(date)='$cy' and facility LIKE '%$FacID%' and adjustment=1 LIMIT 1
)AS pos_falc, 
(
 SELECT c_quantity FROM stock_adjustment WHERE MONTH(date)='$cm' and  YEAR(date)='$cy' and facility LIKE '%$FacID%' and adjustment=0 LIMIT 1
)AS neg_cart,
(
 SELECT f_quantity FROM stock_adjustment WHERE MONTH(date)='$cm' and  YEAR(date)='$cy' and facility LIKE '%$FacID%' and adjustment=0 LIMIT 1
)AS neg_falc";
$rssample = mysqli_query($dbConn,$query_rssample, $ntrl) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$pos_cart= (int) $row_rssample['pos_cart'];
$pos_falc= (int) $row_rssample['pos_falc'];
$neg_cart= (int) $row_rssample['neg_cart'];
$neg_falc= (int) $row_rssample['neg_falc'];


$remainingcarts= ($cartridges + $pos_cart) - ($testdonethismonth + $neg_cart);
$remainingtubes= ($tubes + $pos_falc) - ($testdonethismonth + $neg_falc);

if ($remainingcarts<0 or $remainingcarts==0  ) {
	$remainingcarts=0;
	$expdate=0;
	}


$module=getGxPerfomance($FacID);
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
    <script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>
   
<div class="main-content" style="margin-left: 0.25%;margin-right: 0.25%;">
	<div class="row">
		<form id="customForm"  method="GET" action="">
		 <table border="0" class="table table-striped" style="width: 700px;  margin-left: auto;  margin-right: auto; " >
		  	<tr>
		  		<td align="center"><span class="label label-default">Select Facility</span></td>
		  		 <td align="center">
		  		 	<div class="col-sm-9">
		  		 		
			  			<select name="id" id="id" class="form-control" >
			  			<option value="">Select One Facility</option>
					    <?php do{ 	?>
					    <option value="<?php echo $row_rsFinC['a'];?>"> <?php echo $row_rsFinC['b'];?></option>
						<?php } while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));?>
					    </select> 
				    </div>
				   
			<!--	</td>
		  		
		  		 <td align="left"><span class="label label-default">Select year</span></td>
		  			<td align="left">
					<?php
						$years = range ($maximumyear,$minyear); 
						
						// Make the years pull-down menu.
						echo '<select  class="form-control" name="year">';
					
							foreach ($years as $value)
						 	{
								echo "<option value=\"$value\">$value</option>\n";
							}
							
						echo '</select>';
				   
				  ?>
				</td> 
		  		<td>-->
		  			<input type="submit"  value="Filter" class="btn btn-green"/>
		  		</td>
		  	</tr>
		  </table>
	</form>
    </div>
	<div class="row" >
		<div class="alert alert-default" style="display: block;margin-left: auto;margin-right: auto;padding-top: 0;max-width: 100%;height: auto;vertical-align: middle; ">
		
		<h3 align="center"><?php echo $FacID.' | '.$fname; ?> Analytics</h3>
		</div>
		</div>
	
	<div class="row" >
		
	<div class="col-sm-3">
	
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $testdonethismonth; ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>Tests Done</h3>
			<p>this month.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-basket"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $remainingcarts; ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Remaining Cartridges</h3>
			<p>so far from the inventory.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-calendar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $expdate; ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
			
			<h3>Remaining Days</h3>
			<p>to cartridges expiration.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-volume"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $remainingtubes; ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
			
			<h3>Remaining F.Tubes</h3>
			<p>so far from the inventory..</p>
		</div>
		
	</div>
</div>


<div class="row">
	<ol class="breadcrumb" style="padding-left: 1%;padding-right: 0.25%;">
		<form id="customForm"  method="GET" action="" >
<div><strong> Date Range: </strong>&nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></B></U>   |<small>  
<?php



   if ($filter==1)//LAST 3 MONTHS
    {
    echo "<a href='$D?id=$FacID&filter=0' title=' Click to Filter View to Last Submission Statistics'>   Last Upload </a> | 
          <a href='$D?id=$FacID&filter=7' title=' Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>";           
    }
    elseif ($filter==7)//LAST 6 MONTHS
    {
    echo "<a href=' $D?id=$FacID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload</a>  |
          <a href=' $D?id=$FacID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a>"; 

    }
    elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
    {

    echo "<a href=' $D?id=$FacID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a>  |
          <a href=' $D?id=$FacID&filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a> |
          <a href=' $D?id=$FacID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==4) || ($filter==3)) //month/year filter
    {
    echo "<a href=' $D?id=$FacID&filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a> |
          <a href=' $D?id=$FacID&filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>  |
          <a href=' $D?id=$FacID&filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==0) ||($filter=='') || ($filter==8)) //Lst submitted//all
    {

     echo "<a href='$D?id=$FacID&filter=7' title=' Click to Filter View to Last 3 months Statistics'>   Last 6 Months </a>  | 
           <a href='$D?id=$FacID&filter=1' title=' Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";
   
    }
?>|    
<a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;' title='Click to Filter View based on Date Range you Specify"> Customize Dates</a></font></small>
<span class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	| 
	        <?php
                $year = GetMaxYear();
                $twoless = GetMinYear();
                echo "<a href=$D?id=$FacID&filter=8 title='Click to Filter View cumulative data'>   All  | </a>";
                for ($year; $year >= $twoless; $year--) 
                {
                    echo "<a href=$D?id=$FacID&year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
                }
            ?>
<span class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
             <?php $year = $_GET['year'];
                  if ($year == "") 
                  {
                     $year = @date('Y');
                  }
                  echo "<a href =$D?id=$FacID&year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>"; ?>  |
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | 
            <?php echo "<a href =$D?id=$FacID&year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>
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
						Test Trends for Year: 
						<br />
						<small><?php echo $currentyear ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivtrendd"  align="center"> 
         		<script type="text/javascript">
         		
      			var myChart = new FusionCharts("MSLine", "myChartId", "500", "200");
			    myChart.setXMLUrl("../xml1/facilitytrendline.php<?php echo "?fid=".$FacID."%26mwaka=".$currentyear;?>");
			    myChart.render("chartdivtrendd");
			    
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
					var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "195", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnatw");
				    </script>		
						
					<?php } else { ?> 
			         <script type="text/javascript">
			          var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "195", "0");
			          myChart.setDataXML('<chart bgcolor="#FFFFFF" showBorder="0" ><set  isSliced="1" label="MTB Pos" color="00ACE8" value="<?php echo $tt[2]; ?>"/><set  label="MTB Neg" color="C295F2" value="<?php echo $tt[3]; ?>"/><set  label="RIF Resistant" color="ADFF2F" value="<?php echo $tt[4];?>"/><set  label="Errors" color="ff0000" value="<?php echo $tt[6]; ?>"/><set  label="RIF Indeterminate" color="AD662F" value="<?php echo $tt[5];?>"/></chart>');  
			          myChart.render("chartnatw");
			         </script> 
				    <?php } ?>
			 
		       
			</div>
		</div>

	</div>
	<div class="col-md-4">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Cumulative Data For
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			
                          <table class="table table-responsive">
                         	<thead>
							<tr>
							<td style="text-align:center">Total Tests</td>
							<td style="text-align:center">MTB +ve</td>
							<td style="text-align:center">MTB -ve</td>
							<td style="text-align:center">RIF Resistant</td>
							<td style="text-align:center">RIF Indeterminate</td>
							<td style="text-align:center">Errors / Invalid</td>
							</tr>
							</thead>
							<tbody>
							<tr>
							<td style="text-align:center"><?php echo $tt[1]  ;?></td>
							<td style="text-align:center"><?php echo $tt[2] ;?></td>
							<td style="text-align:center"><?php echo $tt[3] ;?></td>
							<td style="text-align:center"><?php echo $tt[4] ;?></td>
							<td style="text-align:center"><?php echo $tt[5] ;?></td>
							<td style="text-align:center"><?php echo $tt[6] ;?></td>
							</tr>
							</tbody>
						</table>

			</div>

		</div>
	
	</div>
	
</div>
<div class="row">
	<div class="col-sm-5">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						GeneXpert Performance [<?php echo $module[0] ;?>]
						<br />
						<small>Tests done: <?php echo $module[1] ;?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivperfomance"  align="center"> 
         		<script type="text/javascript">
      			var myChart = new FusionCharts("StackedColumn2DLine", "myChartId", "500", "200", "0", "0");
			    myChart.setXMLUrl("../xml1/geneperfomance.php<?php echo "?fid=".$FacID;?>");
			    myChart.render("chartdivperfomance");
			    
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
					var myChart = new FusionCharts("Doughnut2D", "myChartnat", "300", "133", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat1");
				    </script>
						
					<?php } else { ?>
						<script type="text/javascript">
					    var myChart = new FusionCharts("Doughnut2D", "myChartnat", "300", "133", "0");
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
					<td  style="text-align:center">Btwn 6-15 Yrs</td>
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
<div class="row">
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
					var myChart = new FusionCharts("Pie3D", "myChartnat", "300", "130", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat2");
				    </script>		
						
					<?php } else { ?>
					
         		<script type="text/javascript">
			   var myChart = new FusionCharts("Pie3D", "myChartnat", "300", "130", "0");
			   myChart.setDataXML('<chart bgcolor="FFFFFF" showborder="0" palette="2" animation="1"  pieSliceDepth="30" startingAngle="125" ><set value="<?php echo $gender[0]; ?>" label="Male" color="C295F2"/><set value="<?php echo $gender[1]; ?>" label="Female" color="#ADFF2F"/><set value="<?php echo $gender[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			   myChart.render("chartnat2");
			    
			   </script> <?php } ?>
			</div>
		</div>

	</div>
	<div class="col-sm-3">

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
					var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "140", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat3");
				    </script>		
						
					<?php } else { ?> 
        		<script type="text/javascript">
      			var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "130", "0");
			    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"   pieSliceDepth="30" startingAngle="125"> <set value="<?php echo $hstatus[0]; ?>" label="Positive" color="C295F2"/><set value="<?php echo $hstatus[1]; ?>" label="Negative" color="#ADFF2F"/><set value="<?php echo $hstatus[2]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			    myChart.render("chartnat3"); 
			    </script> 
			    <?php } ?>
			
				
			</div>
		</div>

	</div>
	<div class="col-sm-3">

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
<div class="row">
	
	<!-- <div class="col-sm-5">
		
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
	      		var myChart = new FusionCharts("StackedColumn2D", "myChartnat", "550", "310");
	     	 	myChart.setDataXML('<chart palette="2" yAxisName="# of Patients"  showLabels="1" showvalues="0"  numberPrefix="" showSum="0" decimals="0" useRoundEdges="1" legendBorderAlpha="0" bgcolor="FFFFFF" showborder="0"><categories><category label="sputum smear-positive relapse" /><category label="sputum smear-negative relapse" /><category label="Return after defaulting" /><category label="Failure 1-st line treatment" /><category label="Failure re-treatment" /><category label="Extra pulmonary" /><category label="New case PTB" /><category label="MDR TB Contact" /><category label="Refugees SS+ve" /><category label="HCWs" /><category label="Hiv Symp" /></categories><dataset seriesName="MTB Pos" color="AFD8F8" showValues="0"><set value="<?php echo $ptypeC[0]; ?>" /><set value="<?php echo $ptypeC[2]; ?>" /><set value="<?php echo $ptypeC[4]; ?>" /><set value="<?php echo $ptypeC[6]; ?>" /><set value="<?php echo $ptypeC[8]; ?>" /><set value="<?php echo $ptypeC[10]; ?>" /><set value="<?php echo $ptypeC[12]; ?>" /><set value="<?php echo $ptypeC[14]; ?>" /><set value="<?php echo $ptypeC[16]; ?>" /><set value="<?php echo $ptypeC[18]; ?>" /><set value="<?php echo $ptypeC[20]; ?>" /></dataset><dataset seriesName="Rif Resistant" color="F6BD0F" showValues="0"><set value="<?php echo $ptypeC[1] ; ?>" /><set value="<?php echo $ptypeC[3] ; ?>" /><set value="<?php echo $ptypeC[5] ; ?>" /><set value="<?php echo $ptypeC[7] ; ?>" /><set value="<?php echo $ptypeC[9] ; ?>" /><set value="<?php echo $ptypeC[11] ; ?>" /><set value="<?php echo $ptypeC[13] ; ?>" /><set value="<?php echo $ptypeC[15] ; ?>" /><set value="<?php echo $ptypeC[17] ; ?>" /><set value="<?php echo $ptypeC[19] ; ?>" /><set value="<?php echo $ptypeC[21] ; ?>" /></dataset></chart>');
	     		myChart.render("chartp");
	            </script> 
			</div>

		</div>
		
	</div> -->

	<div class="col-sm-12">
		
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
					<td style="text-align:center">Smear positive at 2 months</td>
					<td style="text-align:center">All smear negative PTB cases</td>
					<td style="text-align:center">Return after defaulting</td>
					<td style="text-align:center">Failure 1st line treatment</td>
					<td style="text-align:center">Failure re-treatment</td>
					<td style="text-align:center">Extra Pulmonary</td>
					<td style="text-align:center">New presumptive PTB</td>
					<td style="text-align:center">DR TB Contact</td>
					<td style="text-align:center">Refugees SS+ve</td>
					<td style="text-align:center">HCWs</td>
					<td style="text-align:center">Hiv (+)ve with symptoms of TB</td>
					<td style="text-align:center">Relapse</td>
					<td style="text-align:center">Prisoners with TB symptoms</td>
					<td style="text-align:center">Patients who develop TB while on IPT</td>
					<td style="text-align:center">No Patient type</td>
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
					<td style="text-align:center"><?php echo $tnat[60] ;?></td>
					<td style="text-align:center"><?php echo $tnat[63] ;?></td>
					<td style="text-align:center"><?php echo $tnat[66] ;?></td>
					<td style="text-align:center"><?php echo $tnat[69] ;?></td>

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
					<td style="text-align:center"><?php echo $tnat[61] ;?></td>
					<td style="text-align:center"><?php echo $tnat[64] ;?></td>
					<td style="text-align:center"><?php echo $tnat[67] ;?></td>
					<td style="text-align:center"><?php echo $tnat[70] ;?></td>
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
					<td style="text-align:center"><?php echo $tnat[62] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[65] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[68] ; ?></td>
					<td style="text-align:center"><?php echo $tnat[71] ;?></td>
					</tr>
					</tbody>
					</table>
						
		</div>
		
	</div>

</div>
	
<!-- Footer -->
<footer class="main" style="margin-left: 1%;">
	
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