<?php
session_start();

require_once('../connection/db.php');

error_reporting(0);
$sql1 = "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));";
$result = mysqli_query($dbConn, $sql1) or die(mysqli_error($dbConn));

$level = $_POST['level'];
$co = $_POST['co'];
$sc = $_POST['sc'];
$qr = $_POST['qr'];
$yr = $_POST['yr'];

//National level
if ($co == '0') { //all counties year, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev 

	if ($qr == 0) {
		$sql = "SELECT year, facility, fname, district, county, sum(tt) AS tt, sum(sp) AS sp,sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' group by fname order by county,district ASC";
	} else {
		$sql = "SELECT * from evaluation where quarter='$qr' and year='$yr' group by fname order by county,district ASC";
	}
} elseif (($sc == '0') and ($co != '0')) { //specific county

	if ($qr == 0) {
		$sql = "SELECT year, facility, fname, district, county, sum(tt) AS tt, sum(sp) AS sp,sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and county='$co' group by fname order by county,district ASC";
	} else {
		$sql = "SELECT * from evaluation where quarter='$qr' and year='$yr' and county='$co' group by fname order by county,district ASC";
	}
} elseif (($sc != '0') and ($co != '0')) { //specific sub county

	if ($qr == 0) {
		$sql = "SELECT year, facility, fname, district, county, sum(tt) AS tt, sum(sp) AS sp,sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and district='$sc' group by fname order by county,district ASC ";
	} else {
		$sql = "SELECT * from evaluation where quarter='$qr' and year='$yr' and district='$sc' group by fname order by county,district ASC ";
	}
}


$sql;

// exit;
$query1 = mysqli_query($dbConn, $sql);
$numrows = mysqli_num_rows($query1);
$row1 = mysqli_fetch_assoc($query1);


if ($numrows == 0) {
	echo "No data";
} else {
	$eqa .= '<table class="table table-bordered"><!--style="font-family:Times New Roman;font-size: 11px;"-->
<thead>
	<tr>
		<td colspan="4" style="background-color: #FFFFFF"></td>
		<th style="text-align: center;" colspan="13">NUMBER OF SMEARS DONE BY THE LAB </th>
	</tr>
	<tr>
		<th style="text-align: center;" rowspan="3">#</th>
		<th style="text-align: center;" rowspan="3">County </th>
		<th style="text-align: center;" rowspan="3">Sub County </th>
		<th style="text-align: center;" rowspan="3">Controlled lab</th>
		<th style="text-align: center;" rowspan="3">Total Slides</th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Specimen</font></th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Staining</font></th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Cleanliness</font></th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Thickness</font></th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Size</font></th>
		<th style="text-align: center; " colspan="2"><font color="#990000">Evenness</font></th>
						
	</tr>
	<tr>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		<th style="text-align: center;">S </th>
		<th style="text-align: center;">% </th>
		
	</tr>
	</thead>
<tbody>';

	do {

		$tt = $row1['tt'];
		$sp = $row1['sp'];
		$st =  $row1['st'];
		$cl =  $row1['cl'];
		$th = $row1['th'];
		$si = $row1['si'];
		$ev = $row1['ev'];
		$grandTotal = ($tt);

		$spP = round(($sp / $grandTotal * 100), 0);
		if (is_nan($spP)) $spP = 0;
		$stP = round(($st / $grandTotal * 100), 0);
		if (is_nan($stP)) $stP = 0;
		$clP = round(($cl / $grandTotal * 100), 0);
		if (is_nan($clP)) $clP = 0;
		$thP = round(($th / $grandTotal * 100), 0);
		if (is_nan($thP)) $thP = 0;
		$siP = round(($si / $grandTotal * 100), 0);
		if (is_nan($siP)) $siP = 0;
		$evP = round(($ev / $grandTotal * 100), 0);
		if (is_nan($evP)) $evP = 0;


		$eqa .= '<tr>
 <td style="text-align: center;">' . $row1['facility'] . '</td>
 <td style="text-align: center;">' . $row1['county'] . '</td>
 <td style="text-align: center;">' . $row1['district'] . '</td>
 <td style="text-align: center;">' . $row1['fname'] . '</td>
 <td style="text-align: center;">' . $grandTotal . '</td>
 <td style="text-align: center;">' . $sp . '</td>
 <td style="text-align: center;">' . $spP . '</td>
 <td style="text-align: center;">' . $st . '</td>
 <td style="text-align: center;">' . $stP . '</td>
 <td style="text-align: center;">' . $cl . '</td>
 <td style="text-align: center;">' . $clP . '</td>
 <td style="text-align: center;">' . $th . '</td>
 <td style="text-align: center;">' . $thP . '</td>
 <td style="text-align: center;">' . $si . '</td>
 <td style="text-align: center;">' . $siP . '</td>
 <td style="text-align: center;">' . $ev . '</td>
 <td style="text-align: center;">' . $evP . '</td>
 
</tr>';
	} while ($row1 = mysqli_fetch_assoc($query1));
}
$eqa .= '</tbody></table>';


echo $eqa;
