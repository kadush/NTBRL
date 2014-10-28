<?php
    ob_start();
	include "../connection/db.php";
	if (isset($_GET['id']))
	{
	$mfl = $_GET['id'];
	}
	$facilityname=$_GET['id2'];
	$dt=@date("d-M-Y");
    $sql="SELECT s.lab_no AS a,s.End_Time AS b, s.fullname AS c,s.gender AS d,s.age AS e, s.pat_type AS f, s.mobile AS g, f.name AS h, s.Test_Result AS i, s.User as j FROM sample1 s , facilitys f WHERE s.cond=1 and s.Refacility = f.facilitycode AND s.coldate='$dt' AND s.facility='$mfl'  ";
	$results = mysql_query($sql,$ntrl) or die(mysql_error());
	$rows = mysql_fetch_assoc($results);
	
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
	<img style="margin-left: 18%;" src="../img/logo.png" />
	<h4>'.$facilityname.' GeneXpert Register For The Period:  '.$dt;'</h4>';
	$html .= '<table border="1" class = "data-table" align="center">';
	$html .= '
	<thead><tr>
	<th style="text-align:center">Lab No.</th>
	<th style="text-align:center">Date Tested</th>
	<th style="text-align:center">Patient Name</th>
	<th style="text-align:center">Gender</th>
	<th style="text-align:center">Age</th>
	<th style="text-align:center">Patient Type</th>
	<th style="text-align:center">Mobile No.</th>
	<th style="text-align:center">Test Result</th>
	<th style="text-align:center">Referred Facility</th>
	<th style="text-align:center">Technician</th>
	</tr></thead><tbody>';
	 do {
	 	$rows['b']= @date("d-M-Y",strtotime($rows['b']));
	$html .= '
	<tr class"odd">
	<td style="text-align:center">'.$rows['a'].'</td>
	<td style="text-align:center">'.$rows['b'].'</td>
	<td style="text-align:center">'.$rows['c'].'</td>
	<td style="text-align:center">'.$rows['d'].'</td>
	<td style="text-align:center">'.$rows['e'].'</td>
	<td style="text-align:center">'.$rows['f'].'</td>
	<td style="text-align:center">'.$rows['g'].'</td>
	<td style="text-align:center">'.$rows['h'].'</td>
	<td style="text-align:center">'.$rows['i'].'</td>
	<td style="text-align:center">'.$rows['j'].'</td>
	</tr>';
	} while ($rows = mysql_fetch_assoc($results));
	$html .= '</tbody></table>';
    include_once("mpdf.php");
    $mpdf=new mPDF(); 
    $mpdf->AddPage('L');
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	ob_end_flush(); exit; 
    mysql_free_result($results); ?>

