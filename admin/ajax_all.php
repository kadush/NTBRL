<?php
error_reporting(0);
@require_once('../connection/db.php'); 

if (isset($_POST['d'])){
$countyID=$_POST['d'];
 $sql= "SELECT DISTINCT sub_county FROM facility_map WHERE county='$countyID'";
$rsFinC = mysqli_query($dbConn,$sql, $ntrl) or die(mysqli_error($dbConn)());
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= '<select name="district" id="district" class="form-control"  data-first-option="false">';
        
        do{	
        $table .= '<option value="'.$row_rsFinC['sub_county'].'">'.$row_rsFinC['sub_county'].'</option>';
		}while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>
