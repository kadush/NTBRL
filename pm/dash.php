<?php
require_once('../connection/db.php'); 
$qr = $_POST['qr'];
$yr = $_POST['yr'];
$countyID = $_POST['co']; 
$DistrictID = $_POST['sc'];

if ($countyID==0) {//all county
	if ($qr==0) {
			$sql="SELECT year, facility, fname, district, county, sum(diag_pos) AS diag_pos, sum(diag_scanty) AS diag_scanty, sum(diag_neg) AS diag_neg, sum(flp_pos) AS flp_pos, sum(flp_scanty) AS flp_scanty, sum(flp_neg) AS flp_neg from workload where year='$yr' group by fname";
		    $sqlcount="SELECT quarter, lessone, zfive,ften,ttwenty,above
				FROM(
				SELECT 
				
				quarter as quarter ,sum( CASE WHEN num<1 THEN 1 ELSE 0 END) as lessone,
				
				sum( CASE WHEN num >=1 AND num <=5 THEN 1 ELSE 0 END ) AS zfive,
				
				sum( CASE WHEN num>5 AND num <=10  THEN 1 ELSE 0 END) as ften,
				
				sum( CASE WHEN num>10 AND num <=20 THEN 1 ELSE 0 END ) AS ttwenty,
				
				sum( CASE WHEN num>20 THEN 1 ELSE 0 END ) AS above
				
				FROM workload where year='$yr' group by quarter
				)x";
		} else {
			$sql="SELECT * from workload where quarter='$qr' and year='$yr'";
		}
	} else { 
		
		if ($sc==0) {//all districts in county
			if ($qr==0) {
				$sql="SELECT year, facility, fname, district, county, sum(diag_pos) AS diag_pos, sum(diag_scanty) AS diag_scanty, sum(diag_neg) AS diag_neg, sum(flp_pos) AS flp_pos, sum(flp_scanty) AS flp_scanty, sum(flp_neg) AS flp_neg from workload where year='$yr' and countyid='$countyID' group by fname";
				$sqlcount="SELECT quarter, lessone, zfive,ften,ttwenty,above
				FROM(
				SELECT 
				
				quarter as quarter ,sum( CASE WHEN num<1 THEN 1 ELSE 0 END) as lessone,
				
				sum( CASE WHEN num >=1 AND num <=5 THEN 1 ELSE 0 END ) AS zfive,
				
				sum( CASE WHEN num>5 AND num <=10  THEN 1 ELSE 0 END) as ften,
				
				sum( CASE WHEN num>10 AND num <=20 THEN 1 ELSE 0 END ) AS ttwenty,
				
				sum( CASE WHEN num>20 THEN 1 ELSE 0 END ) AS above
				
				FROM workload where year='$yr' and countyid='$countyID' group by quarter
				)x";
			} else {
				$sql="SELECT * from workload where quarter='$qr' and year='$yr' and countyid='$countyID'";
			}
					
		} else { //specific sc
			if ($qr==0) {
				$sql="SELECT year, facility, fname, district, county, sum(diag_pos) AS diag_pos, sum(diag_scanty) AS diag_scanty, sum(diag_neg) AS diag_neg, sum(flp_pos) AS flp_pos, sum(flp_scanty) AS flp_scanty, sum(flp_neg) AS flp_neg from workload where year='$yr' and districtid='$DistrictID' group by fname";
				$sqlcount="SELECT quarter, lessone, zfive,ften,ttwenty,above
				FROM(
				SELECT 
				
				quarter as quarter ,sum( CASE WHEN num<1 THEN 1 ELSE 0 END) as lessone,
				
				sum( CASE WHEN num >=1 AND num <=5 THEN 1 ELSE 0 END ) AS zfive,
				
				sum( CASE WHEN num>5 AND num <=10  THEN 1 ELSE 0 END) as ften,
				
				sum( CASE WHEN num>10 AND num <=20 THEN 1 ELSE 0 END ) AS ttwenty,
				
				sum( CASE WHEN num>20 THEN 1 ELSE 0 END ) AS above
				
				FROM workload where year='$yr' and districtid='$DistrictID' group by quarter
				)x";
			} else {
				$sql="SELECT * from workload where quarter='$qr' and year='$yr' and districtid='$DistrictID'";
			}
		}

}
	

//exit;
$query1=mysqli_query($dbConn,$sql);
$numrows=@mysqli_num_rows($query1);
$row1=@mysqli_fetch_assoc($query1);

$querycount=mysqli_query($dbConn,$sqlcount);
$numrowscount=@mysqli_num_rows($querycount);
$rowcount=@mysqli_fetch_assoc($querycount);


if ($numrows==0) {
	echo "No data";
} 
else {
$eqa.='<table class="table table-bordered">
	<thead>
	<tr>
		<td colspan="3" style="background-color: #FFFFFF"></td>
		<th style="text-align: center;" colspan="6"><strong>NUMBERS OF SMEARS DONE BY THE LABS</strong></th>
		<th style="text-align: center;" colspan="6"><strong>ANALYSIS</strong></th>
	</tr>
	<tr>
	
		<th style="text-align: center;" rowspan="3">#</th>
		<th style="text-align: center;" rowspan="3">District </th>
		<th style="text-align: center;" rowspan="3">Controlled lab</th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Diagnosis</font></th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Follow-up</font></th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Diagnosis</font></th>
		<th style="text-align: center; " colspan="3"><font color="#990000">Follow-up</font></th>
		
	</tr>
	<tr>
		<th style="text-align: center;">Pos </th>
		<th style="text-align: center;">Scanty</th>
		<th style="text-align: center;">Neg</th>
		<th style="text-align: center;">Pos </th>
		<th style="text-align: center;">Scanty</th>
		<th style="text-align: center;">Neg</th>
		<th style="text-align: center;">% Pos </th>
		<th style="text-align: center;">%Scanty</th>
		<th style="text-align: center;">Total Smear</th>
		<th style="text-align: center;">% Pos/Scanty </th>
		<th style="text-align: center;">Total Smear</th>
		<th style="text-align: center;">Grand Total</th>
	</tr>
</thead>
<tbody>';
									
do {
	
$diagpos = $row1['diag_pos'];
$diagscanty = $row1['diag_scanty'];
$diagneg =  $row1['diag_neg'];
$flppos =  $row1['flp_pos'];
$flpscanty = $row1['flp_scanty'];
$flpneg = $row1['flp_neg'];
$totalDS=($diagpos+$diagscanty+$diagneg);
$totalFS=($flppos+$flpscanty+$flpneg);
$grandTotal=($totalDS+$totalFS);
$diagposP= round( ($diagpos/$totalDS*100), 2);
$diagscantyP= round( ($diagscanty/$totalDS*100), 2);
$flpposScantyP=round( (($flppos+$flpscanty)/$totalFS*100), 2);

 $eqa.='<tr>
 <td style="text-align: center;">'.$row1['facility'].'</td>
 <td style="text-align: center;">'.$row1['district'].'</td>
 <td style="text-align: center;">'.$row1['fname'].'</td>
 <td style="text-align: center;">'.$diagpos.'</td>
 <td style="text-align: center;">'.$diagscanty.'</td>
 <td style="text-align: center;">'.$diagneg.'</td>
 <td style="text-align: center;">'.$flppos.'</td>
 <td style="text-align: center;">'.$flpscanty.'</td>
 <td style="text-align: center;">'.$flpneg.'</td>
 <td style="text-align: center;">'.$diagposP.'</td>
 <td style="text-align: center;">'.$diagscantyP.'</td>
 <td style="text-align: center;">'.$totalDS.'</td>
 <td style="text-align: center;">'.$flpposScantyP.'</td>
 <td style="text-align: center;">'.$totalFS.'</td>
 <td style="text-align: center;">'.$grandTotal.'</td>
 
</tr>';
}
while($row1=mysqli_fetch_assoc($query1));
$eqa.='</tbody></table>';
}



$eqa.='<div class="row"> ';
do{
	$quarter = $rowcount['quarter'];	
	$a = $rowcount['lessone'];	
	$b = $rowcount['zfive'];
	$c = $rowcount['ften'];
	$d = $rowcount['ttwenty'];
	$e = $rowcount['above'];
	
	$sm=$a+$b+$c+$d+$e;

if ($sm>0) {
	

$eqa.='<div class="col-sm-3">
<table class="table-bordered"  style="width: 300px">
<thead>
  <tr class="even">
    <th style="text-align: center;" colspan="7"><strong>Number of Slides / Day [ Q'.$quarter.' ]</strong></th>
  </tr>
  <tr>
    <th style="text-align: center;">Category</th>
    <th style="text-align: center;">&lt;1</th>
    <th style="text-align: center;">1-5</th>
    <th style="text-align: center;">5.1-10</th>
    <th style="text-align: center;">10.1-20</th>
    <th style="text-align: center;">&gt;20</th>
    <th style="text-align: center;">Total Labs<br></th>
  </tr>
</thead>
  <tr>
    <th style="text-align: center;background-color: #f5f5f6;">No of Labs</th>
    <td style="text-align: center;">'.$a.'</td>
    <td style="text-align: center;">'.$b.'</td>
    <td style="text-align: center;">'.$c.'</td>
    <td style="text-align: center;">'.$d.'</td>
    <td style="text-align: center;">'.$e.'</td>
    <td style="text-align: center;">'.$sm.'</td>
  </tr>
</table></div>';								
}
}	
while($rowcount=@mysqli_fetch_assoc($querycount));
$eqa.='</div> ';

echo $eqa;
?>