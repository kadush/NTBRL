<?php
    ob_start();
	include "connection/db.php";
	if (isset($_GET['id'])){
		$SampleID = $_GET['id'];
		}

	mysql_select_db($database, $ntrl);
	$query_rssamp = "SELECT s.lab_no AS ln,s.End_Time AS dt, s.fullname AS fn,s.gender AS g,s.age AS a, s.pat_type AS pt,s.smear as sm, s.mobile AS m, f.name AS fc, s.Test_Result AS tr,s.mtbRif AS rif, s.User as u FROM sample1 s , facilitys f WHERE s.cond=1 and s.Refacility = f.facilitycode AND s.ID='$SampleID'";
	
	$rssamp = mysql_query($query_rssamp, $ntrl) or die(mysql_error());
	$row_rssamp = mysql_fetch_assoc($rssamp);
	$totalRows_rssamp = mysql_num_rows($rssamp);
	
	$html = '
	<style>
	table {margin-bottom: 1.4em; width: 100%;}
	th {font-weight: bold; font-size:11px;text-align:center;}
	thead th {background: #C3D9FF;}
	th,td,caption {padding: 4px 10px 4px 5px;}
	tr.even td {background: #F2F6FA;}
	tfoot {font-style: italic;}
	caption {background: #EEE;}
	
	table.data-table {
		border: 1px solid #CCB;
		margin-bottom: 0em;
		width: auto;
		text-align:center;
	}
	table.data-table th {
		background: #F0F0F0;
		border: 1px solid #DDD;
		color: #555;
		text-align:center;
	}
	table.data-table tr {border-bottom: 1px solid #DDD;}
	table.data-table td, table th {padding: 7px;}
	table.data-table td {
		background: #F6F6F6;
		border: 1px solid #DDD;
		font-size:11px;
	}
	table.data-table tr.even td {background: #FCFCFC;}
	
	</style>
	
	<h5>GeneXpert Result</h5>';
	$html .= '<table border="1" class = "data-table" align="center">';
	$html .= '
	<thead><tr>
	<th style="text-align:center">Lab No.</th>
	<td style="text-align:center">'.$row_rssamp['ln'].'</td>
	<th style="text-align:center">Patient Name</th>
	<td style="text-align:center">'.$row_rssamp['fn'].'</td>
	<th style="text-align:center">Gender</th>
	<td style="text-align:center">'.$row_rssamp['g'].'</td>
	<th style="text-align:center">Age</th>
	<td style="text-align:center">'.$row_rssamp['a'].'</td>
	</tr>
	<tr>
	<th style="text-align:center">Patient Type</th>
	<td style="text-align:center">'.$row_rssamp['pt'].'</td>
	<th style="text-align:center">Smear Type</th>
	<td style="text-align:center">'.$row_rssamp['sm'].'</td>
	<th style="text-align:center">Mobile No.</th>
	<td style="text-align:center">'.$row_rssamp['m'].'</td>
	<th style="text-align:center">Date Tested</th>
	<td style="text-align:center">'.$row_rssamp['dt']= @date("d-M-Y",strtotime($row_rssamp['dt'])).'</td>
	</tr>
	<tr>
	<th style="text-align:center">MTB Result</th>
	<td style="text-align:center">'.$row_rssamp['tr'].'</td>
	<th style="text-align:center">MTB Rif Result</th>
	<td style="text-align:center">'.$row_rssamp['rif'].'</td>
	<th style="text-align:center">Referred Facility</th>
	<td style="text-align:center">'.$row_rssamp['fc'].'</td>
	<th style="text-align:center">Technician</th>
	<td style="text-align:center">'.$row_rssamp['u'].'</td>
	</tr></thead><tbody>';
	 	
	$html .= '</tbody></table>';
    include_once("mpdf/mpdf.php");
    $mpdf=new mPDF(); 
    $mpdf->AddPage('L');
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	ob_end_flush(); exit; 
    mysql_free_result($results); ?>

