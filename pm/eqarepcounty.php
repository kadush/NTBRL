<?php
require_once('header.php');

$sql = "SELECT Distinct county from eqa";
$query1 = mysqli_query($dbConn, $sql);
$numrows = @mysqli_num_rows($query1);
$row1 = mysqli_fetch_assoc($query1);

?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.neontheme.com/forms/wizard/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:45:46 GMT -->
<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">
<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css" id="style-resource-2">
<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css" id="style-resource-3">
<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css" id="style-resource-5">
<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css" id="style-resource-6">

<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

<!-- <div class="well well-sm">
	<h4>Please fill the details to register new account.</h4>
</div> -->
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		<input type="hidden" value="2" id="level" name="level" />
		<!-- <div class="col-md-2">
	    	<div class="form-group">
	    	 County:<select class="form-control" id="co">
				<option value = "0">All</option>
				<?php do { ?>
					<option value = "<?php echo $row1['county'] ?>"><?php echo $row1['county'] ?></option>
				<?php } while ($row1 = mysqli_fetch_assoc($query1));  ?>
			   </select>
			</div>
		</div>	
		 <div class="col-md-2">
	    	<div class="form-group">
	    	 Sub County:<div id="sc1">  </div>
			</div>
		</div>								 -->
		<div class="col-md-2">
			<div class="form-group">
				Quarter:<select class="form-control" id="qr">
					<option value="0">Yearly</option>
					<option value="1">Q1</option>
					<option value="2">Q2</option>
					<option value="3">Q3</option>
					<option value="4">Q4</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">

				<?php
				$years = range($maximumyear, $minyear);

				// Make the years pull-down menu.
				echo ' Year:<select class="form-control" id="yr">';
				foreach ($years as $value) {
					echo "<option value=\"$value\">$value</option>\n";
				}

				echo '</select>';

				?>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="getreport" id="getreport" type="button" class="btn btn-success" value="Generate Report" />
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-1">
		<div id="result"></div>
	</div>
</div>
<footer class="main">

	<div class="pull-right">
		<?php
		include("../includes/footer.php");

		?>
	</div>

</footer>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$("#getreport").click(function() {
			var a = $('option:selected', $('#qr')).val();
			var b = $('option:selected', $('#yr')).val();
			var sc = $('option:selected', $('#sc')).val();
			var co = $('option:selected', $('#co')).val();
			var d = $('#level').val();
			// alert (a);
			//alert (d);

			$.ajax({

				type: "POST",
				url: "eqapercounty.php",
				data: 'qr=' + a + '&yr=' + b + '&sc=' + sc + '&co=' + co + '&level=' + d,
				async: true,
				cache: false,
				success: function(data) {
					$('#result').html(data)
				}

			})

		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$("#co").change(function() {

			if ($("#co option:selected").val() == 0) {
				$('#sc1').hide();
			} else {
				$('#sc1').show();
				var cid = $("#co option:selected").val();
				//alert(cid);

			}


			$.post("sc.php", {
					d: cid
				},
				function(data) {
					//alert(data);
					$('#sc1').html(data);
				});

		});
		//return data; 
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
<script src="../admin/neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>

</body>

<!-- Mirrored from demo.neontheme.com/forms/wizard/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:45:49 GMT -->

</html>