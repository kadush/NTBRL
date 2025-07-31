<?php
error_reporting(0);
@require_once('../connection/db.php');

if (isset($_POST['c'])) {
	$countyID = $_POST['c'];
	$deviceID = $_POST['d'];
	if ($deviceID == '1') {
		$addsql = " AND genesite='1' ";
		$device=' GeneXpert ';
	} elseif ($deviceID == '2') {
		$addsql = " AND truenat='1' ";
		$device=' TrueNat ';
	} elseif ($deviceID == '3') {
		$addsql = " AND xray='1' ";
		$device=' CADBOX ';
	} else {
		$addsql = " AND igra='1' ";
		$device=' IGRA ';
	}
	$sql = "SELECT DISTINCT sub_county as b FROM facility_map WHERE county='$countyID' $addsql ";
	$rsFinC = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	$row_rsFinC = mysqli_fetch_assoc($rsFinC);
	$rows = mysqli_num_rows($rsFinC);

	if ($rows == '0') {
		$table .= '<div class="alert alert-info"> No'.$device.'Device in '.$countyID. ' County</div>';
		
		$table .= '<script type="text/javascript">
					$(document).ready(function() {
						//$("#sc1").hide();
						$("#fac").hide();
					});
					</script>';
	} else {

		$table .= 'Sub County:<select name="sub_county" id="sub_county" class="form-control"  data-first-option="false"><option value="0">All</option>';

		do {
			$table .= '<option value="' . $row_rsFinC['b'] . '">' . $row_rsFinC['b'] . '</option>';
		} while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		$table .= '<script type="text/javascript">
					$(document).ready(function() {
						$("#sub_county").change(function() {
							var sc = $("#sub_county").val()
							var fac = $("#facility").val()
							var level = $("#level").val()
							sd = $("#device option:selected").val();
							if (sc == 0) {
								$("#fac").hide();
								document.getElementById("level").value = "2";
							} else {
								document.getElementById("level").value = "1";
								$("#fac").show();
			
								$.post("getGS.php", {
										c: sc, d: sd
									},
									function(data) {
										$("#fac").html(data);
									});
							}
			
						});
			 });
				</script>';
	}
	echo $table;
}
