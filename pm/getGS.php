<?php
error_reporting(0);
require_once('../connection/db.php');

if (isset($_POST['d'])) {

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
	$sql = "SELECT mfl,facility FROM facility_map WHERE sub_county='$countyID' $addsql ";
	$rsFinC = mysqli_query($dbConn, $sql, $ntrl) or die(mysqli_error($dbConn));
	$row_rsFinC = mysqli_fetch_assoc($rsFinC);
	//var_dump($row_rsFinC);

	$table .= ' GeneSite:<select name="mfl" id="mfl" class="form-control"  data-first-option="false"><option value="0">All</option>';

	do {
		$table .= '<option value="' . $row_rsFinC['mfl'] . '">' . $row_rsFinC['facility'] . '</option>';
	} while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
	$table .= '</select>';

	$table .= "<script type='text/javascript'>
					$(document).ready(function() {
					$('#mfl').change(function() {
					var fac =  $('#mfl').val()

					if (fac == '0') {
						document.getElementById('level').value = '1';
					} else {
						document.getElementById('level').value = '0';
					}

					//alert(document.getElementById('level').value);
				}); });
				</script>";

	echo $table;
}
