<?php
include("header.php");

@require_once('../connection/db.php');
error_reporting(0);

if (isset($_GET['id'])) {
	$countyID = $_GET['id'];
} else {
	$countyID = 'Baringo';
}
$sql1 = "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));";
$result = mysqli_query($dbConn, $sql1) or die(mysqli_error($dbConn));
if ($countyID == '0') {
	$sql = "Select DISTINCT c.mfl as fcode, c.facility as fname ,(c.end_bal+c.received) AS cart
	FROM consumption_view c
	WHERE c.commodity='Cartridge'
	GROUP BY c.facility";

	$height = 3000;

	$q1 = "SELECT DISTINCT mfl FROM facility_map where genesite=1";
	$r1 = mysqli_query($dbConn, $q1) or die(mysqli_error($dbConn));
	$row1 = mysqli_fetch_assoc($r1);
	$totalreporting = mysqli_num_rows($r1);

	$title = "National Inventory";
} else {
	$sql = "Select DISTINCT c.mfl as fcode, c.facility as fname ,(c.end_bal+c.received) AS cart
	FROM consumption_view c
	WHERE c.commodity='Cartridge' AND county= '$countyID'
	GROUP BY c.facility";

	$title = $countyID . " County Inventory";
	$height = 400;

	$totalreporting = getAllGeneSitesInCountyX($countyID);
}

$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
$row = @mysqli_fetch_assoc($result);
$reported = @mysqli_num_rows($result);
//var_dump($row); exit; 
@$table .= '<table class="table table-bordered datatable" id="invt"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Test Done(Previous Month)</th><th  style="text-align:center">Test Done(This Month)</th><th  style="text-align:center">Remaining Cartridges</th><th  style="text-align:center">Remaining Falcon Tubes</th></tr>';
$sumrc = 0;
$sumrt = 0;
do {
	$fid = $row['fcode'];
	$fname = htmlspecialchars($row['fname'], ENT_QUOTES, 'UTF-8');
	//$dd= (int) $row['DiffDate'];
	$cartridges = (int) $row['cart'];

	$q = "SELECT 
	(
	   SELECT (c.end_bal+c.received) FROM consumption_view c WHERE  c.mfl='$fid' and c.commodity='Falcon Tubes' LIMIT 1
	)AS tubes , 
	(
	SELECT count(*) FROM samplescm WHERE cond=1 and facility='$fid'
	)AS cm,
	(
	SELECT count(*) FROM samplespm WHERE cond=1 and facility='$fid'
	)AS pm";
	$r = mysqli_query($dbConn, $q) or die(mysqli_error($dbConn));
	$row = mysqli_fetch_assoc($r);
	$tubes = $row['tubes'];
	$testdonethismonth = $row['cm'];
	$testdonePrevmonth = $row['pm'];

	$query_rssample = "SELECT 
(
 SELECT SUM(c_quantity) FROM st_view WHERE mfl  ='$fid' and adjustment=1 LIMIT 1
)AS pos_cart, 
(
 SELECT SUM(f_quantity) FROM st_view WHERE mfl  ='$fid' and adjustment=1 LIMIT 1
)AS pos_falc, 
(
 SELECT SUM(c_quantity) FROM st_view WHERE mfl  ='$fid' and adjustment=0 LIMIT 1
)AS neg_cart,
(
 SELECT SUM(f_quantity) FROM st_view WHERE mfl  ='$fid' and adjustment=0 LIMIT 1
)AS neg_falc";
	$rssample = mysqli_query($dbConn, $query_rssample) or die(mysqli_error($dbConn));
	$row_rssample = mysqli_fetch_assoc($rssample);
	$pos_cart = (int) $row_rssample['pos_cart'];
	$pos_falc = (int) $row_rssample['pos_falc'];
	$neg_cart = (int) $row_rssample['neg_cart'];
	$neg_falc = (int) $row_rssample['neg_falc'];


	$remainingcarts = ($cartridges + $pos_cart) - ($testdonethismonth + $neg_cart);
	$remainingtubes = ($tubes + $pos_falc) - ($testdonethismonth + $neg_falc);

	if ($remainingcarts < 0 or $remainingcarts == 0) {
		$remainingcarts = 0;
		$dd = 0;
	}
	if ($remainingtubes < 0) {
		$remainingtubes = 0;
	}

	// if ($dd=='NULL' or '') {
	// 	$dd=0;
	// }
	//  if ($dd<0) {
	//  	$dd = 0;
	// 	  } 
	$sumrc += $remainingcarts;
	$sumrt += $remainingtubes;
	$table .= '<tr><td style="text-align:center">' . $fid . '</td><td style="text-align:center">' . $fname . '</td><td style="text-align:center">' . $testdonePrevmonth . '</td><td style="text-align:center">' . $testdonethismonth . '</td><td style="text-align:center">' . $remainingcarts . '</td><td style="text-align:center">' . $remainingtubes . '</td></tr>';
} while ($row = mysqli_fetch_assoc($result));
$table .= '<tr><td colspan="4" style="text-align:center">Total Remaining Cartridges = ' . $sumrc . '</td><td colspan="3" style="text-align:center">Total remaining Falcon Tubes = ' . $sumrt . '</td></tr>';
$table .= '</table>';

?>

<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css" id="style-resource-3">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css" id="style-resource-5">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css" id="style-resource-6">

<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
<script language="JavaScript" src="../FusionMaps/JSClass/FusionMaps.js"></script>
<script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

<!-- TS1387507087: Neon - Responsive ../admin Template created by Laborator -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var table = $("#invt").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
			"oTableTools": {},

		});
	});
</script>

<div class="main-content" style="margin-top: %;margin-left: .3%">
	<div class="row">
		<div class="col-md-4 col-md-offset-5">
			<form id="customForm" method="GET" action="">
				<table>
					<tr>
						<td>
							<select name="id" class="form-control">
								<option value="">Select One County</option>
								<?php
								$sqlDW = "SELECT Distinct county as a from facility_map order by county ASC";
								$rssampleDW = mysqli_query($dbConn, $sqlDW) or die(mysqli_error($dbConn));
								$row_rssampleDW = mysqli_fetch_assoc($rssampleDW);

								do { ?>
									<option value="<?php echo $row_rssampleDW['a']; ?>"> <?php echo $row_rssampleDW['a']; ?> County <span class="badge badge-info badge-roundless" style="float: right"></span></option>
								<?php } while ($row_rssampleDW = mysqli_fetch_assoc($rssampleDW)); ?>
								<option value="0">All Counties</option>
							</select>
						</td>
						<td>
							<input type="submit" value="Filter" class="btn btn-green" />
						</td>
					</tr>
				</table>

			</form>
		</div>

	</div>
	<div class="row">
		<div class="alert alert-default" style="display: block;margin-left: auto;margin-right: auto;padding-top: 0;max-width: 100%;height: auto;vertical-align: middle; ">

			<h3 align="center"><?php echo $title; ?></h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">

			<div class="panel panel-gradient" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						Commodity Inventory
					</div>
					<div class="panel-title" style="padding-left: 12%">
						Reported Facilities <span class="badge badge-info"><?php echo $reported . ' / ' . $totalreporting ?> </span>
					</div>
					<div class="panel-heading" style="float: right;padding-top: .7%">
						<!-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
				<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
				<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				
				
				 -->

						<a href="../phpexcel/commodities.php">
							<div class="btn-group">
								<button type="button" class="btn btn-info">Download</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
									<i class="entypo-down"></i>
								</button>

							</div>
						</a>
					</div>
				</div>

				<div class="panel-body">

					<div id="accordion-test-2" class="panel-group">

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapseTwo" data-parent="#accordion-test-2" data-toggle="collapse"> Table Representation </a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse in">
								<div class="panel-body">

									<!-- <form role="form" class="form-horizontal form-groups-bordered">
	
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Select One Commodity</label>
						
						<div class="col-sm-7">
							
							<div class="radio radio-replace">
								<input type="radio" id="rd-1" name="radio1" value="Cartridge" checked="checked" >
								<label>Cartridges</label>
							</div>
							
							<div class="radio radio-replace">
								<input type="radio" id="rd-2" name="radio1" value="Falcon Tubes" >
								<label>Falcon Tubes</label>
							</div>
													
						</div>
					</div>
					
					
					
				</form>
				<div id="result"></div> -->

									<?php echo $table; ?>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<!-- <h4 class="panel-title">
		  <a href="#collapseOne" data-parent="#accordion-test-2" data-toggle="collapse">Graphical Representation 
					
	      </a>
		</h4> -->
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
									<div id="invdiv">
										<script type="text/javascript">
											var myChart = new FusionCharts("Bar2D", "myChartnat", "635", "<?php echo $height; ?>", "0");
											myChart.setXMLUrl("../xml1/inv.php?id=<?php echo $countyID; ?>");
											myChart.render("invdiv");
										</script>
									</div><br />
									<div align="right">
										<p>
											<a>
												<span class="badge badge-success">&nbsp;&nbsp;&nbsp;</span>
												Inventory well balanced
											</a>
										</p>
										<p>
											<a>
												<span class="badge badge-danger">&nbsp;&nbsp;&nbsp;</span>
												Cartridges about to expire(less than 90days)
											</a>
										</p>
										<p>
											<a>
												<span class="badge badge-warning">&nbsp;&nbsp;&nbsp;</span>
												Both or Either Cartridges or Falcon Tubes about to get finished(count below 50)
											</a>
										</p>

									</div>

								</div>

							</div>


						</div>
					</div>
				</div>

			</div>

		</div>
		<!-- <div class="col-md-6">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Commodity Inventory.
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				<div id="invdiv"> 
				    <script type="text/javascript">
					   	var myChart = new FusionCharts("../FusionCharts/Charts/Bar2D.swf", "myChartnat", "635", "700", "0", "0");
						myChart.setDataURL("../xml1/inv.php");
			            myChart.render("invdiv");
					</script>
				</div><br />
				<div align="right">
					<p>
					<a>
					<span class="badge badge-success">&nbsp;&nbsp;&nbsp;</span>
					Inventory well balanced 
					</a>
					</p>
					<p>
					<a>
					<span class="badge badge-danger">&nbsp;&nbsp;&nbsp;</span>
					Cartridges about to expire
					</a>
					</p>
					<p>
					<a>
					<span class="badge badge-warning">&nbsp;&nbsp;&nbsp;</span>
					Cartridges about to get finished
					</a>
					</p>
				</div>
				
			</div>
		
		</div>
	
	</div> -->
		<div class="col-md-6">

			<div class="panel panel-gradient" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						Day (s) Since Last Upload.
					</div>

					<div class="panel-options">
						<!-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a> -->
					</div>
				</div>

				<div class="panel-body">
					<div id="invday">
						<script type="text/javascript">
							var myChart = new FusionCharts("Bar2D", "myChartnat1", "635", "<?php echo $height; ?>", "0");
							myChart.setXMLUrl("../xml1/day.php?id=<?php echo $countyID; ?>");
							myChart.render("invday");
						</script>
					</div>
				</div>

			</div>

		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('input:radio[name="radio"]').change(function() {

				s = ($(this).val());

				$.ajax({
					type: "POST",
					url: "getcomm.php",
					data: "id=" + s,
					async: true,
					cache: false,
					success: function(data) {
						$('#result').html(data)
					}

				});

			});
		});
	</script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#table-1").dataTable({
				"sPaginationType": "bootstrap",
				"aLengthMenu": [
					[10, 25, 50, -1],
					[10, 25, 50, "All"]
				],
				"bStateSave": true
			});

			$(".dataTables_wrapper select").select2({
				minimumResultsForSearch: -1
			});
		});
	</script>
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css" id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css" id="style-resource-2">

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


	<!-- Footer -->
	<footer class="main">

		<div class="pull-right">
			<?php
			include("../includes/footer.php");
			mysqli_close($dbConn);
			?>
		</div>

	</footer>
</div>

</body>

</html>