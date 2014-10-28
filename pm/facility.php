<?php
include('header.php');
@require_once('../connection/db.php'); 
if (isset($_GET['id'])){
  $FacID = $_GET['id'];
	}
/* ****************************************************/
$q = "SELECT DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate FROM sample1 s WHERE s.facility='$FacID'";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$expdate= $row['DiffDate'];

$q = "SELECT (c.end_bal+c.allocated) AS cart FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Cartridge' ORDER BY c.date DESC LIMIT 1";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$cartridges= $row['cart'];

$q = "SELECT (c.end_bal+c.allocated) AS tubes FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Falcon Tubes'  ORDER BY c.date DESC LIMIT 1";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$tubes= $row['tubes'];

$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$currentmonth' and  YEAR(End_Time)='$currentyear' and cond=1 and facility='$FacID'";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$testdonethismonth = mysql_num_rows($rssample);

$remainingcarts= $cartridges - $testdonethismonth;
$remainingtubes= $tubes - $testdonethismonth;

$module=getGxPerfomance($FacID);
?>
<!DOCTYPE html>
<html lang="en">
	
	
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css"  id="style-resource-6">
    <script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>
	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
   
<div class="main-content" style="margin-top: 4%;">
	<div class="row" style="margin-left: 2%;">
		
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
<div class="row" style="margin-left: 1%">
	 <table class="table table-bordered">
  	<tr>
  		<td align="center"><strong>Genexpert Serial Number : </strong> <div class="label label-info"><?php echo $module[0] ;?> </div></td>
  		
  		<td align="center"><strong>Number of Tests Done : </strong><div class="label label-success"> <?php echo $module[1] ;?></div></td>
  		
  	</tr>
  </table> 
	<div class="col-sm-6">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Test Trends for Year: 
						<br />
						<small>2014</small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="charttrend"  align="center"> 
         		<script type="text/javascript">
      			var myChart = new FusionCharts("../FusionCharts/Charts/MSLine.swf", "myChartId", "600", "280", "0", "0");
			    myChart.setDataURL("../xml1/facilitytrendline.php<?php echo "?fid=".$FacID;?>");
			    myChart.render("charttrend");
			    
			   </script> 
			</div>
          </div>
		</div>
		
	</div>
	<div class="col-sm-6">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						GeneXpert Performance
						<br />
						<small><?php echo $module[0] ;?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartperfomance"  align="center"> 
         		<script type="text/javascript">
      			var myChart = new FusionCharts("../FusionCharts/Charts/StackedColumn2D.swf", "myChartId", "600", "280", "0", "0");
			    myChart.setDataURL("../xml1/geneperfomance.php<?php echo "?fid=".$FacID;?>");
			    myChart.render("chartperfomance");
			    
			   </script> 
			</div>
			<!--<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">A1</td>
					<td  style="text-align:center">A2</td>
					<td  style="text-align:center">A3</td>
					<td  style="text-align:center">A4</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># of Tests</td>
					<td style="text-align:center"><?php echo $module[0] ;?></td>
					<td style="text-align:center"><?php echo $module[1];?></td>
					<td style="text-align:center"><?php echo $module[2] ;?></td>
					<td style="text-align:center"><?php echo $module[3] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center"># of Errors</td>
					<td style="text-align:center"><?php echo $module[4] ;?></td>
					<td style="text-align:center"><?php echo $module[5] ;?></td>
					<td style="text-align:center"><?php echo $module[6] ;?></td>
					<td style="text-align:center"><?php echo $module[7] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">% of Errors</td>
					<td style="text-align:center"><?php if ($module[4]==0){ echo (0)."%" ;} else {echo round((($module[4]/$module[0])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[5]==0){ echo (0)."%" ;} else {echo round((($module[5]/$module[1])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[6]==0){ echo (0)."%" ;} else {echo round((($module[6]/$module[2])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[7]==0){ echo (0)."%" ;} else {echo round((($module[7]/$module[4])*100),1)."%";}?></td>
					</tr>
					</tbody>
			</table> -->
          </div>
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