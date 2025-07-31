<?php
include("header.php");
include("../ajax_data/dateww.php");

error_reporting(0);

if ($_SESSION['cat'] == 10) {
	$pc = $_SESSION['district2'];
	if ($pc == '') {
		$sql = "";
	} else {
		$splittedNumbers = explode(",", $pc);
		$numbers = "'" . implode("', '", $splittedNumbers) . "'";

		$sql = " WHERE `county` IN ($numbers) ";
	}
}
else {
	$sql = "";
}
$query_rsSLA1 = "SELECT
    sum(CASE WHEN `status`='Completed' THEN 1 ELSE 0 END) as completed,
    sum(CASE WHEN `status` = 'Pending' THEN 1 ELSE 0 END ) AS pending,
    sum(CASE WHEN `status` =  'Escalated'  THEN 1 ELSE 0 END) as escalated
    FROM sla $sql";

//$query_rsSLA1 = "SELECT
//    sum(CASE WHEN `status`='Completed' THEN 1 ELSE 0 END) as completed,
//    sum(CASE WHEN `status` = 'Pending' THEN 1 ELSE 0 END ) AS pending,
//    sum(CASE WHEN `status` =  'Escalated'  THEN 1 ELSE 0 END) as escalated
//    FROM sla where county='$countyName'";

//$query_rsSLA1;
$rsOrg = mysqli_query($dbConn, $query_rsSLA1) or die(mysqli_error($dbConn));
$row_rsOrg = mysqli_fetch_assoc($rsOrg);
$ttr = mysqli_num_rows($rsOrg);
if ($ttr == 0) {
	$c = 0;
	$p = 0;
	$e = 0;
	$total = 0;
} else {
	$c = (int)$row_rsOrg['completed'];
	$p = (int)$row_rsOrg['pending'];
	$e = (int)$row_rsOrg['escalated'];
	$total = $c + $p + $e;
}

//query_rsSLA = "SELECT * FROM `sla` where county='$countyName' ORDER BY `sla`.`id` DESC";
$query_rsSLA = "SELECT * FROM `sla` $sql ORDER BY `sla`.`id` DESC";
$rsSLA = mysqli_query($dbConn, $query_rsSLA) or die(mysqli_error($dbConn));
$row_rsSLA = mysqli_fetch_assoc($rsSLA);
$totalC = mysqli_num_rows($rsSLA);

$dataSLA .= '<table class="display table table-striped" id="table-1" style="text-align: center;">
						<thead>
							<tr>
								<th>Date issue reported </th>
								<th>Reported by</th>
								<th>Facility</th>
								<th>Sub county </th>
								<th>County</th>
								<th>Component</th>
								<th>Part</th>
								<th>Issue</th>
								<th>Recurrence</th>
								<th>Status</th>
								<th>Date issue resolved</th>
								<th>TAT</th>
								<th>Cepheid Intervention Report</th>
							</tr>
						</thead>
						<tbody>';


do {

	//var_dump($row_rsSLA);

	$recid = $row_rsSLA['id'];


	$int_date = $row_rsSLA['reportedate'];
	$tick_date = $row_rsSLA['DateResolved'];

	if ($row_rsSLA['status'] == 'Completed') {
		$int_time = Count_Days_Without_Weekends($tick_date, $int_date);
		$tat = $int_time . ' Day(s)';
		$row_rsSLA['status'] = '<div class="label label-success">Completed</div>';

		if ($row_rsSLA['filename_ir'] == '') {

			$ir = '<li><a style="color:red">Intervention Report</a></li>';
		} else {

			$ir = '<li><a  target="blank" href="' . $ext . 'pdf.php?id=2&id2=' . $row_rsSLA['filename_ir'] . '">Intervention Report</a></li>';
		}

		$link = '<a href="interventions.php?id=' . $recid . '">
										<button class="btn btn-info" type="button" title="Update"><i class="entypo-eye"></i></button>
									</a>
												';
	} else if ($row_rsSLA['status'] == 'Pending') {

		$tat = ' -- ';

		$row_rsSLA['status'] = '<div class="label label-warning">Pending</div>';

		$link = '';
	}

	if ($row_rsSLA['filename_ir'] == '') {
		$report = '<i class="entypo-cancel"></i>';
	} else {
		$report = '<a target="blank" href="../tickets/' . $row_rsSLA['filename_ir'] . '"><i class="entypo-doc-text-inv"></i></a>';
	}

	if ($row_rsSLA['CepheidNumb'] == '') {
		$CN = '--';
	} else {
		$CN = $row_rsSLA['CepheidNumb'];
	}
	$dataSLA .= '<tr>
			<td>' . $row_rsSLA['dateOccurred'] . '</td>
			<td>' . $row_rsSLA['assigned_to'] . '</td>
			<td>' . $row_rsSLA['site_name'] . '</td>
			<td>' . $row_rsSLA['sub_county'] . '</td>
			<td>' . $row_rsSLA['county'] . '</td>
			<td>' . $row_rsSLA['component'] .  '</td>
			<td>' . $row_rsSLA['parts'] . '</td>
			<td>' . $row_rsSLA['issue'] . '</td>
			<td>' . $row_rsSLA['recurrent'] . '</td>
			<td>' . $row_rsSLA['status'] . '</td>
			<td>' . $row_rsSLA['DateResolved'] . '</td>
			<td>' . $tat . '</td>
			<td>' . $report . '</td>
			
		</tr>';
} while ($row_rsSLA = mysqli_fetch_array($rsSLA));

$dataSLA .= '</tbody></table> ';

$data = $dataSLA;

//check if calibrated
$query = "SELECT * FROM calibration $sql";
$rs = mysqli_query($dbConn, $query) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($rs);
$totalRows = mysqli_num_rows($rs);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />

	<title>TibuLims|PM</title>
	<link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="../assets/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
	<link rel="stylesheet" href="../assets/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
	<link rel="stylesheet" href="../assets/neon/neon-x/assets/css/font-icons/entypo/css/animation.css" id="style-resource-3">
	<link rel="stylesheet" href="../assets/neon/neon-x/assets/css/neon.css" id="style-resource-5">
	<link rel="stylesheet" href="../assets/neon/neon-x/assets/css/custom.css" id="style-resource-6">
	<script src="../assets/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
	<script src="../assets/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>
</head>

<script type="text/javascript">
	$(document).ready(function() {

		$('#searchpatient').hide();

	});
</script>
<script>
	$(function() {
		$("save").validate();
	});
</script>
<body onload="document.getElementById('getreport').click();">
	<div class="main-content" style="padding-left: 1%;padding-right: 1%;">
		<div class="row">
			<div class="col-sm-3">
				<a href="index.php">
					<div class="tile-stats tile-green">
						<div class="icon"><i class="entypo-chart-bar"></i></div>
						<div class="num" data-start="0" data-end="<?php echo $total; ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $total; ?></div>
						<h3>Total cases</h3>
						<p></p>
					</div>
				</a>
			</div>

			<div class="col-sm-3">

				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="entypo-basket"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $p; ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $p; ?></div>

					<h3>Active Cases</h3>
					<p></p>
				</div>

			</div>

			<div class="col-sm-3">

				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-calendar"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $c; ?>" data-postfix="" data-duration="1500" data-delay="1200"><?php echo $c; ?></div>

					<h3>Resolved Cases</h3>
					<p></p>
				</div>

			</div>

			<div class="col-sm-3">

				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-volume"></i></div>
					<div class="num" data-start="0" data-end="<?php echo $e; ?>" data-postfix="" data-duration="1500" data-delay="1800"><?php echo $e; ?></div>

					<h3>Overdue Cases</h3>
					<p></p>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-md-12">

				<ul class="nav nav-tabs bordered">
					<!-- available classes "bordered", "right-aligned" -->
					<li class="active"><a href="#profile" data-toggle="tab">Reported Issue(s)</a></li>
					<li><a href="#home" data-toggle="tab">Calibration Status</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane" id="home">
						<table class="display table table-striped" id="table-2">
							<thead>
								<tr>
									<th>Mfl</th>
									<th>Facility</th>
									<th>Sub County</th>
									<th>County</th>
									<th>Reported by</th>
									<th>Next date</th>
									<th>Status</th>
									<th>Date Reported</th>
								</tr>
							</thead>
							<tbody>

								<?php
								if ($totalRows == '0') {
									# code...
								} else {

									do {

										$recid = $row['id'];

										$nextdate =  date('d-M-Y', strtotime($row['next_date']));
										// $currentdate = date("d-M-Y");
										// $stt = 1;

										// if ($nextdate < $currentdate  ) {
										// 	$warranty = '<div class="label label-danger">Calibration Due</div>';
										// } elseif ($nextdate > $currentdate ) {
										// 	$warranty = '<div class="label label-success">Active</div>';
										// } else {
										// 	$warranty = '<div class="label label-success">Unknown</div>';
										// }

										$today = date("Y/m/d"); //Today
										$date =  $row['next_date']; //Date
									   
										if (strtotime($today) < strtotime($date)) {
											$warranty = '<div class="label label-success">Active</div>';
										}else{
											$warranty = '<div class="label label-danger">Calibration Due</div>';
									   }

								?>
										<tr>
											<td><?php echo $row['facility']; ?></td>
											<td><?php echo $row['fname']; ?></td>
											<td><?php echo $row['sub_county']; ?></td>
											<td><?php echo $row['county']; ?></td>
											<td><?php echo $row['done by']; ?></td>
											<td><?php echo $nextdate; ?></td>
											<td><?php echo $warranty; ?></td>
											<td><?php echo $row['editDate']; ?></td>

										</tr>
								<?php } while ($row = mysqli_fetch_assoc($rs));
								} ?>
							</tbody>
						</table>

					</div>
					<div class="tab-pane active" id="profile">
						<?php echo $data; ?>
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
<script src="../admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
<script src="../admin/neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
<script src="../admin/neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-7"></script>
<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-8"></script>
<script src="../admin/neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-9"></script>
<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-10"></script>
<script src="../admin/neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>

<script type="text/javascript" src="../admin/neon/neon-x/assets/js/jquery-multi-select/js/jquery.multi-select.js"></script>
<script src="../admin/neon/neon-x/assets/js/select2/select2.js"></script>
<script src="../admin/neon/neon-x/assets/js/select-init.js"></script>

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

			$("#table-2").dataTable({
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
</body>

</html>