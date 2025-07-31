<?php
error_reporting(0);
@require_once('../connection/db.php'); 

if (isset($_POST['d'])){
$countyID=$_POST['d'];
$sql= "SELECT district as b FROM eqa WHERE county='$countyID' group by district ";
$rsFinC = mysqli_query($dbConn,$sql, $ntrl) or die(mysqli_error($dbConn));
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= '<select id="sc" class="form-control"><option value="0">All</option>';
        
        do{	
        $table .= '<option value="'.$row_rsFinC['b'].'">'.$row_rsFinC['b'].'</option>';
		}while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>
