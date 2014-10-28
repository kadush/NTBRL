<?php
include('header.php');
@require_once('../connection/db.php'); 
if (isset($_GET['facility'])){
  $FacID = $_GET['facility'];
	}
/* ****************************************************/


if (isset($_GET['year'])){
	$year = $_GET['year'];
}
else {
	$year = @date('Y');
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
    <script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>
	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
		$(document).ready( function (){
			  
		  $("#facility").change(function(){
		  $('#facilityname').val($('option:selected', $(this)).val());
		 
		});
		});
	</script>
   
<div class="main-content">
<div class="row" style="margin-top: -3%;margin-left: 1%">
	<form id="customForm"  method="GET" action="" >
 <table border="0" class="table table-condensed" style="width: 700px">
  	<tr>
  		<td align="center"><span class="label label-success">Select Facility</span></td>
  		 <td align="left">
  		 	
  			<select name="facility" id="facility" class="form-control">
		    <?php do{ 	?>
		    <option value="<?php echo $row_rsFinC['a'];?>"> <?php echo $row_rsFinC['b'];?></option>
			<?php } while ($row_rsFinC = mysql_fetch_assoc($rsFinC));?>
		   </select> 
		    
		   
		</td>
  		
  		<td align="left"><span class="label label-success">Select year</span></td>
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
  		<td>
  			<input type="submit"  value="Filter" class="btn btn-green"/>
  		</td>
  	</tr>
  </table></form>

  
	<div class="col-sm-6">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Test Trends for Year: 
						<br />
						<small><?php echo $FacID.' | '.$year; ?></small>
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
			    myChart.setDataURL("../xml1/facilitytrendline.php<?php echo "?year=".$year."%26fid=".$FacID?>");
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
						<small>2014</small>
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
			<table class="table table-striped">
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
					</table> 
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