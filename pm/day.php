<?php require_once('../connection/db.php');
include("header.php");
if (isset($_GET['id'])) {

	$countyName = $_GET['id'];
	$device = $_GET['device'];
	if ($device == '1') {
		$deviceNM = ' GeneXpert ';
		if ($countyName != '0') {
			$height = 400;
		} else {
			$height = 3000;
		}
	} elseif ($device == '2') {
		$deviceNM = ' TrueNat ';
		if ($countyName != '0') {
			$height = 200;
		} else {
			$height = 1500;
		}
	} elseif ($device == '3') {
		$deviceNM = ' CADBOX ';
		if ($countyName != '0') {
			$height = 100;
		} else {
			$height = 300;
		}
	} else {
		$deviceNM = ' IGRA ';
	}

	if ($countyName != '0') {
		//$height = 400;
		$title = "Days Since Last result Upload for " . $deviceNM . " sites - " . $countyName . " County";
	} else {
		//$height = 3000;
		$title = "Days Since Last Upload for all " . $deviceNM . " sites in the country";
	}
} else {
	$title = "Select an Instrument and County then hit Filter";
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


<body onload="document.getElementById('getreport').click();">
	<div class="main-content" style="margin-right: 1%;margin-left: 1%">
		<div class="row">
			<div class="col-md-4 col-md-offset-5">
				<form id="customForm" method="GET" action="">
					<table>
						<tr>
							<td>
								<strong>Instrument</strong>
								<select name="device" id="device" class="form-control" required style="max-width: 150px !important">
									<?php
									do {
									?>
										<option value="<?php echo $row_rsSI['id'] ?>"><?php echo $row_rsSI['name']; ?></option>
									<?php
									} while ($row_rsSI = mysqli_fetch_assoc($rsSI));
									$rows = mysqli_num_rows($rsSI);
									if ($rows > 0) {
										mysqli_data_seek($rsSI, 0);
										$row_rsSI = mysqli_fetch_assoc($rsSI);
									}
									?>
								</select>

							</td>
							&nbsp;&nbsp;&nbsp;
							<td>
								<strong>County</strong>
								<?php
								if ($_SESSION['cat'] == 10) {
									$pc = $_SESSION['district2'];
									if ($pc == '') {
										$sql = "SELECT ID,`name` from countys";
									} else {
										$splittedNumbers = explode(",", $pc);
										$numbers = "'" . implode("', '", $splittedNumbers) . "'";

										$sql = "SELECT ID,`name` from countys WHERE `name` IN ($numbers) ";
									}
									$query1 = mysqli_query($dbConn, $sql);
									$numrows = mysqli_num_rows($query1);
									$row1 = mysqli_fetch_assoc($query1);

								?>
									<select class="form-control" id="id" name="id">
										<?php if ($pc == '') { ?>
											<option value="0">All</option>
										<?php } ?>
										<?php do { ?>
											<option value="<?php echo $row1['name'] ?>"><?php echo $row1['name'] ?></option>
										<?php } while ($row1 = mysqli_fetch_assoc($query1));  ?>
									</select>

								<?php } else {

									$sql = "SELECT ID,`name` from countys";
									$query1 = mysqli_query($dbConn, $sql);
									$numrows = mysqli_num_rows($query1);
									$row1 = mysqli_fetch_assoc($query1);
								?>

									<select class="form-control" id="id" name="id">
										<option value="0">All</option>
										<?php do { ?>
											<option value="<?php echo $row1['name'] ?>"><?php echo $row1['name'] ?></option>
										<?php } while ($row1 = mysqli_fetch_assoc($query1));  ?>
									</select>

								<?php } ?>
							</td>
							<td style="padding-top: 5%;"><strong>&nbsp;&nbsp;</strong>
								<input type="submit" name="getreport" value="Filter" class="btn btn-green" />
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
			<div class="col-md-6 col-md-offset-3">

				<div class="panel panel-gradient" data-collapsed="0">

					<div class="panel-body">
						<div id="invday">
							<script type="text/javascript">
								var myChart = new FusionCharts("Bar2D", "myChartnat1", "635", "<?php echo $height; ?>", "0");
								myChart.setXMLUrl("../xml1/day.php?device=<?php echo $device; ?>&id=<?php echo $countyName; ?>");
								myChart.render("invday");
							</script>
						</div>
					</div>

				</div>

			</div>
		</div>

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
				?>
			</div>

		</footer>
	</div>

</body>

</html>