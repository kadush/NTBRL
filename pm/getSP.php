<?php
error_reporting(0);
@require_once('../connection/db.php'); 

if (isset($_POST['d'])){

$deviceID=$_POST['d'];
if ($deviceID=='1') {
	$sql= "SELECT `type` FROM specimen_type ORDER BY id";
} elseif ($deviceID=='2') {
	$sql= "SELECT Distinct Sample_Type as `type` FROM sampletn";
}
else {
	exit;
}

//$sql= "SELECT `type` FROM specimen_type ORDER BY id";
$rsFinC = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= 'Specimen
		<select name="specimen_type" id="specimen_type" class="form-control" style="min-width: 100px !important">
			<option value="1">All</option>';
        
        do{	
        $table .= '<option value="'.$row_rsFinC['type'].'">'.$row_rsFinC['type'].'</option>';
		}while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
