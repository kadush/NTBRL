<?php
session_start();

require_once('../connection/db.php');

error_reporting(0);
if ($_SESSION['nm'] == "" and ($_SESSION['cat'] != 1 or $_SESSION['cat'] != 4  or $_SESSION['cat'] != 6)) { //if access level is not equal to then
	//redirect to login page
	@header("location:../index.php");
}

function getAllGeneSitesInCountyX($countyID)
{
	global $dbConn;
	$sql = "SELECT * from allgxsites
WHERE `county` ='$countyID'
AND `mfl`!=99999";
	$query = mysqli_query($dbConn, $sql)  or die(mysqli_error($dbConn));
	$rs = mysqli_num_rows($query);
	return $rs;
}
function TOTALFacilitypercounty($county)
{
	global $dbConn;
	$sql = "SELECT count(*)
	FROM `facility_map`
	WHERE county= '$county'";
	$q = mysqli_query($dbConn, $sql) or die();
	$rw = mysqli_num_rows($q);
	return $rw;
}

function TOTALFacilityReportedpercounty($county)
{
	global $dbConn;

	$sql = "SELECT Distinct mfl,county
		FROM consumption_view
		WHERE county = '$county'";
	$q = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	$rw = mysqli_num_rows($q);
	return $rw;
}

$sql = "SELECT Distinct county as a from facility_map ORDER BY county ASC";
$rssample = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);

$maximumyear = date('Y');
$minyear = 2011;

$query_rsSI = "SELECT id,name FROM devices ORDER BY id ASC";
$rsSI = mysqli_query($dbConn, $query_rsSI) or die(mysqli_error($dbConn));
$row_rsSI = mysqli_fetch_assoc($rsSI);
$rows = mysqli_num_rows($rsSI);

$query_rsST = "SELECT `type` FROM specimen_type ORDER BY id";
$rsST = mysqli_query($dbConn, $query_rsST) or die(mysqli_error($dbConn));
$row_rsST = mysqli_fetch_assoc($rsST);
$totalRows_rsST = mysqli_num_rows($rsST);


$sql = "SELECT Distinct county as name from facility_map Order by county ASC";
$query1 = mysqli_query($dbConn, $sql);
$numrows = @mysqli_num_rows($query1);
$row1 = mysqli_fetch_assoc($query1);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.neontheme.com/frontend/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:44:33 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />

	<title>TibuLims</title>
	<link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon" />


	<link rel="stylesheet" href="../admin/neon/neon-x/assets/frontend/css/bootstrap-min.css" id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/frontend/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/frontend/css/neon.css" id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css" id="style-resource-5">
	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>

	<script src="../admin/neon/neon-x/assets/frontend/js/jquery-1.11.0.min.js"></script>
	<script>
		$.noConflict();
	</script>


</head>

<body>
	<div class="main content">

		<div class="wrap">
			<div class="site-header-container container">
				<div id="top">

					<div align="center" id="logo">
						<img width="600px" height="80px" src="../assets/img/Tibu-Lims.png" class="img-responsive" />
						<!-- <img align="right" src="img/gx.jpg" alt="" height="65px"/> -->
					</div>

				</div>
				<div class="row">

					<div class="col-md-12">

						<header class="site-header">


							<span><strong><?php echo @date("l, d F Y"); ?> <br /> <span class="quiet">Welcome : </span></strong>

								<div class="btn-group">

									<button class="btn dropdown-toggle btn-blue" data-toggle="dropdown"><?php echo  $_SESSION['nm']; ?></button>


								</div><!-- /btn-group -->
								<?php

								if ($_SESSION['cat'] == 1) { ?>

									<a href="../admin/index.php">
										<button class="btn btn-default btn-icon btn-xs" type="button">
											Switch to Admin Level

										</button>
									</a>

								<?php
								}

								?>

							</span>

							<nav class="site-nav">

								<ul class="main-menu hidden-xs" id="main-menu">
									<li>
										<a href="index.php"><i class="entypo-home"></i><span>Home</span></a>
									</li>
									<li>
										<a>
											<i class="entypo-layout"></i><span>Facilities</span>
										</a>
										<ul>
											<li><a href="dlt_facility.php"><i class="entypo-record"></i><span>Facility Mapping</span></a></li>
											<li><a href="refac.php"><i class="entypo-record"></i><span>Referral Facilities</span></a></li>
										</ul>
									</li>
									<li>
										<a href="issue.php"><i class="entypo-menu"></i><span>SLA</span></a>
									</li>
									<li>
										<a href="day.php"><i class="entypo-gauge"></i><span>Days Offline</span></a>
									</li>
									<?php if ($_SESSION['cat'] == 10) {
									} else { ?>
										<li>
											<a>
												<i class="entypo-bag"></i><span>Commodities</span>
											</a>

											<ul>
												<li>
													<a href="allocation.php"><i class="entypo-record"></i><span>Reporting View</span></a>
												</li>
												<li>
													<a href="inve.php"><i class="entypo-record"></i><span>Inventory Summary</span></a>
												</li>
												<!-- <li>
													<a  href="calibration.php"></i><span>Calibration</span></a>
												</li> -->
											</ul>
										</li>

										<li>
											<a>
												<i class="entypo-clipboard"></i><span>Reports</span>
											</a>
											<ul>
												<li><a href="rep.php"><i class="entypo-record"></i><span>WRDs</span></a></li>
												<li><a href="eqarep.php"><i class="entypo-record"></i><span>EQA</span></a></li>
												<li><a href="mtbpos.php"><i class="entypo-record"></i><span>RR Cases</span></a></li>
											</ul>
										</li>
										<li>
											<a href="contact.php"><i class="entypo-chat"></i><span>Contacts</span></a>
										</li>
									<?php } ?>
									<li>
										<a>
											<i class="entypo-logout"></i><span>Settings </span>
										</a>
										<ul>
											<li><a href="changePass.php" id="reset">Change Password</a></li>
											<li><a href="../includes/logout.php" id="logout">Logout</a></li>
										</ul>
									</li>
								</ul>


								<div class="visible-xs">

									<a href="#" class="menu-trigger">
										<i class="entypo-menu"></i>
									</a>

								</div>
							</nav>

						</header>
						<hr>
					</div>

				</div>

			</div>

		</div>
		<script src="../admin/neon/neon-x/assets/frontend/js/gsap/main-gsap.js" id="script-resource-1"></script>
		<script src="../admin/neon/neon-x/assets/frontend/js/bootstrap.js" id="script-resource-2"></script>
		<script src="../admin/neon/neon-x/assets/frontend/js/joinable.js" id="script-resource-3"></script>
		<script src="../admin/neon/neon-x/assets/frontend/js/resizeable.js" id="script-resource-4"></script>

		<script src="../admin/neon/neon-x/assets/frontend/js/neon-custom.js" id="script-resource-6"></script>
</body>

</html>