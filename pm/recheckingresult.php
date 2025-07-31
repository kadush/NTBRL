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
if ($co == '0') { //all counties

	if ($qr == 0) {

		$sql = "SELECT year, facility, fname, district, county, SUM(ml_pos) AS ml_pos, SUM(ml_scanty) AS ml_scanty, SUM(ml_neg) AS ml_neg, SUM(ml_hfp) AS ml_hfp, SUM(ml_lfp) AS ml_lfp, SUM(ml_hfn) AS ml_hfn, SUM(ml_lfn) AS ml_lfn, SUM(ml_qe) AS ml_qe, SUM(fc_pos) AS fc_pos, SUM(fc_scanty) AS fc_scanty, SUM(fc_neg) AS fc_neg, SUM(fc_hfp) AS fc_hfp, SUM(fc_lfp) AS fc_lfp, SUM(fc_hfn) AS fc_hfn, SUM(fc_lfn) AS fc_lfn, SUM(fc_qe) AS fc_qe,rec_lab,un_lab from eqa where year='$yr' group by fname order by county,district ASC";
	} else {

		$sql = "SELECT * from eqa where quarter='$qr' and year='$yr' group by fname order by county,district ASC";
	}
} elseif (($co != '0') and ($sc == '0')) {
	//specific county

	if ($qr == 0) {

		$sql = "SELECT year, facility, fname, district, county, SUM(ml_pos) AS ml_pos, SUM(ml_scanty) AS ml_scanty, SUM(ml_neg) AS ml_neg, SUM(ml_hfp) AS ml_hfp, SUM(ml_lfp) AS ml_lfp, SUM(ml_hfn) AS ml_hfn, SUM(ml_lfn) AS ml_lfn, SUM(ml_qe) AS ml_qe, SUM(fc_pos) AS fc_pos, SUM(fc_scanty) AS fc_scanty, SUM(fc_neg) AS fc_neg, SUM(fc_hfp) AS fc_hfp, SUM(fc_lfp) AS fc_lfp, SUM(fc_hfn) AS fc_hfn, SUM(fc_lfn) AS fc_lfn, SUM(fc_qe) AS fc_qe,rec_lab,un_lab from eqa where year='$yr' and county='$co' group by fname order by county,district ASC";
	} else {

		$sql = "SELECT * from eqa where quarter='$qr' and year='$yr' and county='$co' group by fname order by county,district ASC";
	}
} elseif (($co != '0') and ($sc != '0')) {  //specific sub county

	if ($qr == 0) {

		$sql = "SELECT year, facility, fname, district, county, SUM(ml_pos) AS ml_pos, SUM(ml_scanty) AS ml_scanty, SUM(ml_neg) AS ml_neg, SUM(ml_hfp) AS ml_hfp, SUM(ml_lfp) AS ml_lfp, SUM(ml_hfn) AS ml_hfn, SUM(ml_lfn) AS ml_lfn, SUM(ml_qe) AS ml_qe, SUM(fc_pos) AS fc_pos, SUM(fc_scanty) AS fc_scanty, SUM(fc_neg) AS fc_neg, SUM(fc_hfp) AS fc_hfp, SUM(fc_lfp) AS fc_lfp, SUM(fc_hfn) AS fc_hfn, SUM(fc_lfn) AS fc_lfn, SUM(fc_qe) AS fc_qe,rec_lab,un_lab from eqa where year='$yr' and district='$sc' group by fname order by county,district ASC";
	} else {

		$sql = "SELECT * from eqa where quarter='$qr' and year='$yr' and district='$sc' group by fname order by county,district ASC";
	}
}


//echo $sql;
// exit;
$query1 = mysqli_query($dbConn, $sql);
$numrows = @mysqli_num_rows($query1);
$row1 = @mysqli_fetch_assoc($query1);

if ($numrows == 0) {
	"No data";
} else {

	$eqa .= '<table class="table table-bordered" > <!--style="font-family:Times New Roman;font-size: 11px;"-->
	<thead>

	<strong><tr>
		<td colspan="4" style="background-color: #FFFFFF"></td>
		<th style="text-align: center;" colspan="8">EVALUATION OF THE MICROSCOPY LABS </th>
		<th style="text-align: center;" colspan="8">EVALUATION OF THE FIRST CONTROLLERS</th>
	</tr>
	<tr>
		<th style="text-align: center;" rowspan="3">#</th>
		<th style="text-align: center;" rowspan="3">County </th>
		<th style="text-align: center;" rowspan="3">Sub County </th>
		<th style="text-align: center;" rowspan="3">Controlled lab</th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Results reported for rechecked smears (#)</font></th>
		<th style="text-align: center; " colspan="5"><font color="#990000">Errors detected in EQA (#)</font></th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Results reported for rechecked smears (#)</font></th>
		<th style="text-align: center; " colspan="5"><font color="#990000">Errors detected in EQA (#)</font></th>
		<th style="text-align: center; " colspan="4"><font color="#990000">Participated EQA</font></th>
		<th style="text-align: center;" rowspan="3">Recheked lab.</th>
		<th style="text-align: center;" rowspan="3">Unaccceptable lab <br>(Any Major or more<br> than 3 minor errors)</th>
						
	</tr>
	<tr>
		<th style="text-align: center;">Pos </th>
		<th style="text-align: center;">Scanty</th>
		<th style="text-align: center;">Neg</th>
		<th style="text-align: center;">HFP </th>
		<th style="text-align: center;">LFP</th>
		<th style="text-align: center;">HFN</th>
		<th style="text-align: center;">LFN </th>
		<th style="text-align: center;">QE</th>
		<th style="text-align: center;">Pos </th>
		<th style="text-align: center;">Scanty</th>
		<th style="text-align: center;">Neg</th>
		<th style="text-align: center;">HFP </th>
		<th style="text-align: center;">LFP</th>
		<th style="text-align: center;">HFN</th>
		<th style="text-align: center;">LFN </th>
		<th style="text-align: center;">QE</th>
		<th style="text-align: center;">Q1</th>
		<th style="text-align: center;">Q2</th>
		<th style="text-align: center;">Q3 </th>
		<th style="text-align: center;">Q4</th>
			</tr>
		</thead></strong>
<tbody>';

	do {
		$fac = $row1['facility'];
		$query_rssample = "SELECT  
  (
    SELECT sum(CASE WHEN rec_lab='Rechecked' THEN 1 ELSE 0 END) 
    FROM eqa where quarter='1' and year='$yr' and facility='$fac' group by fname
    )AS q1,
    (
    SELECT sum(CASE WHEN rec_lab='Rechecked' THEN 1 ELSE 0 END)  
    FROM eqa where quarter='2' and year='$yr' and facility='$fac' group by fname
    )AS q2,
	(
	SELECT sum(CASE WHEN rec_lab='Rechecked' THEN 1 ELSE 0 END)  
    FROM eqa where quarter='3' and year='$yr' and facility='$fac' group by fname
    )AS q3,
    (
    SELECT sum(CASE WHEN rec_lab='Rechecked' THEN 1 ELSE 0 END) 
    FROM eqa where quarter='4' and year='$yr' and facility='$fac' group by fname
    )AS q4 ";
		$rssample = @mysqli_query($dbConn, $query_rssample) or die(mysqli_error($dbConn));
		$row_rssample = @mysqli_fetch_assoc($rssample);
		$Q1check = (int) $row_rssample['q1'];
		$Q2check = (int) $row_rssample['q2'];
		$Q3check = (int) $row_rssample['q3'];
		$Q4check = (int) $row_rssample['q4'];




		$eqa .= '<tr>
 <td style="text-align: center;">' . $row1['facility'] . '</td>
 <td style="text-align: center;">' . $row1['county'] . '</td>
 <td style="text-align: center;">' . $row1['district'] . '</td>
 <td style="text-align: center;">' . $row1['fname'] . '</td>
 <td style="text-align: center;">' . $row1['ml_pos'] . '</td>
 <td style="text-align: center;">' . $row1['ml_scanty'] . '</td>
 <td style="text-align: center;">' . $row1['ml_neg'] . '</td>
 <td style="text-align: center;">' . $row1['ml_hfp'] . '</td>
 <td style="text-align: center;">' . $row1['ml_lfp'] . '</td>
 <td style="text-align: center;">' . $row1['ml_hfn'] . '</td>
 <td style="text-align: center;">' . $row1['ml_lfn'] . '</td>
 <td style="text-align: center;">' . $row1['ml_qe'] . '</td>
 <td style="text-align: center;">' . $row1['fc_pos'] . '</td>
 <td style="text-align: center;">' . $row1['fc_scanty'] . '</td>
 <td style="text-align: center;">' . $row1['fc_neg'] . '</td>
 <td style="text-align: center;">' . $row1['fc_hfp'] . '</td>
 <td style="text-align: center;">' . $row1['fc_lfp'] . '</td>
 <td style="text-align: center;">' . $row1['fc_hfn'] . '</td>
 <td style="text-align: center;">' . $row1['fc_lfn'] . '</td>
 <td style="text-align: center;">' . $row1['fc_qe'] . '</td>
 <td style="text-align: center;">' . $Q1check . '</td>
 <td style="text-align: center;">' . $Q2check . '</td>
 <td style="text-align: center;">' . $Q3check . '</td>
 <td style="text-align: center;">' . $Q4check . '</td>
 <td style="text-align: center;">' . $row1['rec_lab'] . '</td>
 <td style="text-align: center;">' . $row1['un_lab'] . '</td>
</tr>';
	} while ($row1 = @mysqli_fetch_assoc($query1));

	$eqa .= '</tbody></table>';
}

echo $eqa;
