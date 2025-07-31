<?php
include("header.php");

require_once('../connection/db.php');

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '-1');
error_reporting(0);

if (isset($_GET['id'])) {
	$countyID = $_GET['id'];
} else {
	$countyID = 'Baringo';
}
$sql1 = "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));";
$result = mysqli_query($dbConn, $sql1) or die(mysqli_error($dbConn));
if ($countyID == '0') {
	$sql = "Select * FROM consumptionwithcm_pm";

	$height = 3000;
	$title = "National Inventory";
	$q1 = "SELECT DISTINCT mfl FROM facility_map where genesite=1 and mfl !='99999'";
	$r1 = mysqli_query($dbConn, $q1) or die(mysqli_error($dbConn));
	$row1 = mysqli_fetch_assoc($r1);
	$totalreporting = mysqli_num_rows($r1);
} else {
	$sql = "Select * FROM consumptionwithcm_pm
	WHERE county= '$countyID'
	GROUP BY mfl";

	$title = $countyID . " County Inventory";
	$height = 400;

	$totalreporting = getAllGeneSitesInCountyX($countyID);
}

$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($result);
$reported = mysqli_num_rows($result);
//var_dump($row); exit; 
$table .= '<table class="table table-bordered datatable" id="invt"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Sub County</th><th  style="text-align:center">County</th><th  style="text-align:center">Test Done(Previous Month)</th><th  style="text-align:center">Test Done(This Month)</th><th  style="text-align:center">Remaining Cartridges</th><th  style="text-align:center">Remaining Falcon Tubes</th></tr>';
$sumrc = 0;
$sumrt = 0;

if ($reported == '0') {
	$table .= '<tr><td colspan="9" style="text-align:center">Facilities have not Submitted their monthly consumption report</td></tr>';
	$table .= '</table>';
} else {
	
	do {
		$fid = $row['mfl'];
		$fname = htmlspecialchars($row['facility'], ENT_QUOTES, 'UTF-8');
		//$dd= (int) $row['DiffDate'];
		$cartridges = (int) $row['BBCart'];
		$tubes = $row['BBFT'];
		$testdonethismonth = $row['CMM'];
		$testdonePrevmonth = $row['PM'];

		$query_rssample = "SELECT 
		(
		SELECT SUM(c_quantity) FROM st_view WHERE mfl  LIKE '%$fid%' and adjustment=1 LIMIT 1
		)AS pos_cart, 
		(
		SELECT SUM(f_quantity) FROM st_view WHERE mfl  LIKE '%$fid%' and adjustment=1 LIMIT 1
		)AS pos_falc, 
		(
		SELECT SUM(c_quantity) FROM st_view WHERE mfl  LIKE '%$fid%' and adjustment=0 LIMIT 1
		)AS neg_cart,
		(
		SELECT SUM(f_quantity) FROM st_view WHERE mfl  LIKE '%$fid%' and adjustment=0 LIMIT 1
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


		$sumrc += $remainingcarts;
		$sumrt += $remainingtubes;
		$table .= '<tr><td style="text-align:center">' . $fid . '</td><td style="text-align:center">' . $fname . '</td><td style="text-align:center">' . $row['sub_county'] . '</td><td style="text-align:center">' . $row['county'] . '</td><td style="text-align:center">' . $testdonePrevmonth . '</td><td style="text-align:center">' . $testdonethismonth . '</td><td style="text-align:center">' . $remainingcarts . '</td><td style="text-align:center">' . $remainingtubes . '</td></tr>';

		
	} while ($row = mysqli_fetch_assoc($result));

	$table .= '<tr><td colspan="5" style="text-align:center">Total Remaining Cartridges = ' . $sumrc . '</td><td colspan="4" style="text-align:center">Total remaining Falcon Tubes = ' . $sumrt . '</td></tr>';
	$table .= '</table>';
}
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

<div class="main-content" style="margin-left: 1%">
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
		<div class="alert alert-default" style="display: block;margin-left: auto;margin-right: auto;padding-top: 0;max-width: 100%;height: auto; ">

			<h3 align="center"><?php echo $title; ?></h3>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-gradient" data-collapsed="0">

				<div class="panel-heading">
					<div class="panel-title">
						Commodity Inventory
					</div>
					<div class="panel-title" style="padding-left: 22%">
						Reported Facilities <span class="badge badge-info"><?php echo $reported . ' / ' . $totalreporting ?> </span>
					</div>
					<div class="panel-heading" style="float: right;padding-top: .7%">
						<a href="../phpexcel/commodities.php?id=<?php echo $countyID; ?>">
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