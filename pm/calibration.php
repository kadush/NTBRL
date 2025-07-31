<?php
include("header.php");
$query = "SELECT Distinct (s.facility ) AS a FROM sample1 s where s.facility<99999";
$rs = mysqli_query($dbConn,$query) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($rs);
$totalrows = mysqli_num_rows($rs);
 
?>
<!DOCTYPE html>
<html lang="en">
	
	
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>

<div class="main-content" style="margin-top: %;margin-left: .3%">
	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Equipment Calibration
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			 <table class="table table-bordered datatable" id="table-2">
					<thead>
						<tr>
					        <th style="text-align:center">Mfl Code</th>
					        <th style="text-align:center">Facility Name</th>
					        <th style="text-align:center">Date of Installation</th>
					        <th style="text-align:center">No of Tests Since Installation</th>
					        <th style="text-align:center">Date of Last Calibration</th>
					        <th style="text-align:center">Next Scheduled Calibration</th><!-- (Based on last Calibration) -->
					        <th style="text-align:center">No of Tests since Last Calibration</th>
					        
					        <!-- <th style="text-align:center">Next Scheduled Calibration(No of test)</th> 
					        <th style="text-align:center">Warranty Status</th>-->
				        </tr>
					</thead>
					<tbody>
				   		
					<?php 
							
					do
						  {
						  	$facilitycode = $row['a'];
							
							//check if calibrated
							$query1 = "SELECT * FROM calibration where facility='$facilitycode'";
							$rs1 = mysqli_query($dbConn,$query1) or die(mysqli_error($dbConn));
							$row1 = mysqli_fetch_assoc($rs1);
							$totalrows1 = mysqli_num_rows($rs1);
							
							
							if ($totalrows1>0) { //if yes
							$q = "SELECT 
							(
							   SELECT count(*) FROM sample1 where facility='$facilitycode' and cond='1'
							)AS totaltests, 
							(
							SELECT End_Time From sample1 where facility='$facilitycode' and cond='1' having MIN(ID)
							)AS instal,
							(
							SELECT name From facilitys where facilitycode like '%$facilitycode%'
							)AS facilityname";
							$rss = mysqli_query($dbConn,$q) or die(mysqli_error($dbConn));
							$r = mysqli_fetch_assoc($rss);
							
							$fname = $r['facilityname'];
							$installationdate= date('d-M-Y', strtotime($r['instal']));
							$dateofcal = date('d-M-Y', strtotime($row1['date']));
							$nextdate=  date('d-M-Y', strtotime($row1['next_date']));
							$testsafterinstall= $r['totaltests'];
							$tym=$row1['date'];
							$q1 = "SELECT count(*) as tt, End_Time FROM sample1  where facility='$facilitycode' and (End_Time)>'$tym' and cond='1'";
							$rss1 = mysqli_query($dbConn,$q1) or die(mysqli_error($dbConn));
							$r1 = mysqli_fetch_assoc($rss1);
							$testsaftercalibration= $r1['tt'];
							$average=$testsaftercalibration/4;
							
							$currentdate=date("d-M-Y");
							$warranty= date("d-M-Y", strtotime("+2 years", strtotime($nextdate)));
							if ($currentdate>$warranty) {
								$warranty='Void';
								
							} else {
								$warranty='Valid';
							}
															
							} else {
								
							$query_rssample = "SELECT 
							(
							   SELECT count(*) FROM sample1 where facility='$facilitycode' and cond='1'
							)AS totaltests, 
							(
							SELECT End_Time From sample1 where facility='$facilitycode' and cond='1' having MIN(ID)
							)AS instal,
							(
							SELECT name From facilitys where facilitycode like '%$facilitycode%'
							)AS facilityname";
							
							$rssample = mysqli_query($dbConn,$query_rssample) or die(mysqli_error($dbConn));
							$row_rssample = mysqli_fetch_assoc($rssample);
							$total = mysqli_num_rows($rssample);
							
							$fname = $row_rssample['facilityname'];
							$installationdate= date('d-M-Y', strtotime($row_rssample['instal']));
							$dateofcal='Not Done';
							$nextdate = date("d-M-Y", strtotime("+1 years", strtotime($row_rssample['instal']))); 
							$testsafterinstall= $row_rssample['totaltests'];
							$testsaftercalibration='-';
							$average='-';
							
							$currentdate=date("d-M-Y");
							//$warranty= date("d-M-Y", strtotime("+2 years", strtotime($nextdate)));
							if (($dateofcal=='Not Done' && $nextdate<$currentdate)) {
								$warranty='Void';
								
							}
							elseif (($dateofcal!='Not Done' && $currentdate>$nextdate)) {
								$warranty='Void';
								
							} else {
								$warranty='Valid';
							}
							}
							
							
							
					   	?>      
							<tr class="odd gradeX">
							<td style="text-align:center"> <?php echo $facilitycode; ?></td>
							<td style="text-align:center"> <?php echo $fname; ?></td>
							<td style="text-align:center"> <?php echo $installationdate; ?></td>
							<td style="text-align:center"> <?php echo $testsafterinstall; ?></td>
							 
							<td style="text-align:center"> <?php echo $dateofcal; ?></td>
							<td style="text-align:center"> <?php echo $nextdate; ?></td>
							<td style="text-align:center"> <?php echo $testsaftercalibration; ?></td>
							<!-- <td style="text-align:center"> <?php echo $warranty; ?></td> -->
							
							</tr>
							
														
						<?php }  while ($row = mysqli_fetch_assoc($rs));
					 ?> 				
							     
				        </tbody>
				</table>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-2").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>


			</div>
		
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
<script type="text/javascript">
	
		function update() {
		// alert($("#inv2").serialize());
		// exit;
		var that = this;
		        $.ajax({
		        	 
		                type: "POST",
		                url: "../updatestock.php",
		                data: $("#inv2").serialize(),
		                dataType:"json",
		                cache:false,
		                success: function(data) {
		                	window.location.href='viewconsumption.php';
		                   var opts = {
							"closeButton": true,
							"debug": false,
							"positionClass": "toast-bottom-left",
							"onclick": null,
							"sdeDuration": "1000",
							"tihowDuration": "300",
							"himeOut": "10000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						};
						
						 toastr.success(data.message, data.title, opts);
						 
		                },
		                error: function () {
		                	
		                    var opts = {
							"closeButton": true,
							"debug": false,
							"positionClass": "toast-bottom-left",
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						};
						
						toastr.success(data.message, data.title, opts);
		                }
		            })
		       
		        } // End of  keyup function
		
		 // End of document.ready

 </script>


	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
    <script src="../admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
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