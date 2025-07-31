<?php
@require_once('../connection/db.php'); 

$qr = $_POST['qr'];
$yr = $_POST['yr'];
$countyID = $_POST['co']; 
$DistrictID = $_POST['sc'];

if ($countyID==0) {//all county
	if ($qr==0) {
		$sql="SELECT year, facility, fname, district, county, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' group by fname";
		
		} else {
		$sql="SELECT * from evaluation where quarter='$qr' and year='$yr'";
		}
	} else { //all districts in county
		
		if ($sc==0) {
			if ($qr==0) {
			$sql="SELECT year, facility, fname, district, county, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and countyid='$countyID' group by fname";
			
			} else {
			$sql="SELECT * from evaluation where quarter='$qr' and year='$yr' and countyid='$countyID'";
			}
					
		} else {
			if ($qr==0) {
				$sql="SELECT year, facility, fname, district, county, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and districtid='$DistrictID' group by fname";
				
				} else {
				$sql="SELECT * from evaluation where quarter='$qr' and year='$yr' and districtid='$DistrictID'";
				}
		}

}


//exit;
$query1=mysqli_query($dbConn,$sql);
$numrows=@mysqli_num_rows($query1);
$row1=mysqli_fetch_assoc($query1);


if ($numrows==0) {
	echo "No data";
} else {
$eqa.='<table class="table table-bordered">
<thead>
	<tr>
		<td colspan="3" style="background-color: #FFFFFF"></td>
		<th style="text-align: center;" colspan="13">NUMBER OF SMEARS DONE BY THE LAB </th>
	</tr>
	<tr>
		<th style="text-align: center;" rowspan="3">#</th>
		<th style="text-align: center;" rowspan="3">District </th>
		<th style="text-align: center;" rowspan="3">Controlled lab</th>
		<th style="text-align: center;" rowspan="3">Total Slides</th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Specimen</font></th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Staining</font></th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Cleanliness</font></th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Thickness</font></th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Size</font></th>
		<th style="text-align: center;"  colspan="2"><font color="#990000">Evenness</font></th>
						
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
$st=  $row1['st'];
$cl =  $row1['cl'];
$th = $row1['th'];
$si = $row1['si'];
$ev=$row1['ev'];
$grandTotal=($sp+$st+$cl+$th+$si+$ev);

$spP= round( ($sp/$grandTotal*100), 2);
$stP= round( ($st/$grandTotal*100), 2);
$clP= round( ($cl/$grandTotal*100), 2);
$thP= round( ($th/$grandTotal*100), 2);
$siP= round( ($si/$grandTotal*100), 2);
$evP= round( ($ev/$grandTotal*100), 2);


 $eqa.='<tr>
 <td style="text-align: center;">'.$row1['facility'].'</td>
 <td style="text-align: center;">'.$row1['district'].'</td>
 <td style="text-align: center;">'.$row1['fname'].'</td>
 <td style="text-align: center;">'.$grandTotal.'</td>
 <td style="text-align: center;">'.$sp.'</td>
 <td style="text-align: center;">'.$spP.'</td>
 <td style="text-align: center;">'.$st.'</td>
 <td style="text-align: center;">'.$stP.'</td>
 <td style="text-align: center;">'.$cl.'</td>
 <td style="text-align: center;">'.$clP.'</td>
 <td style="text-align: center;">'.$th.'</td>
 <td style="text-align: center;">'.$thP.'</td>
 <td style="text-align: center;">'.$si.'</td>
 <td style="text-align: center;">'.$siP.'</td>
 <td style="text-align: center;">'.$ev.'</td>
 <td style="text-align: center;">'.$evP.'</td>
 
</tr>';
}
while($row1=mysqli_fetch_assoc($query1));
}
$eqa.='</tbody></table>';								


echo $eqa;
?>