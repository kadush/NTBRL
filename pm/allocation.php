<?php
include("header.php");

@require_once('../connection/db.php');

$sql = "SELECT ID as a,name as b from countys ORDER BY name ASC";
$rssample = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);

?>
<!DOCTYPE html>
<html lang="en">


<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css" id="style-resource-3">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css" id="style-resource-5">
<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css" id="style-resource-6">

<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
<script language="JavaScript" src="../FusionMaps/FusionMaps.js"></script>

<div class="main-content" style="margin-left: .3%">
	<div class="row">
		<?php include('ca.php'); ?>
		<div class="col-sm-9">
			<div class="panel panel-gradient">
				<div class="panel-heading">
					<div class="panel-title">
						<h4>
							Genexpert County Allocation
						</h4>
					</div>
					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
					</div>
				</div>
				<div class="panel-body no-padding">
					<div id="mapdiv" align="center">
						<script type="text/javascript">
							var map = new FusionMaps("../FusionMaps/FCMap_KenyaCounty.swf", "mapdiv", "650", "600", "0", "0");
							map.setDataURL("../xml1/countyall.php");
							map.render("mapdiv");
						</script>
					</div>
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




<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css" id="style-resource-1">
<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css" id="style-resource-2">
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