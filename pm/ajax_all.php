<?php
@require_once('../connection/db.php'); 

if (isset($_POST['d'])){
$countyID=$_POST['d'];
$sql= "SELECT `c`.`mfl` AS a,`c`.`facility` AS b
FROM consumption_view
WHERE `c`.`county` = '$countyID'
AND c.status ='1'
group by `c`.`facility`";
$rsFinC = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= '<select name="facility" id="facility" class="form-control">';
        $table .= '<option value="0">All Facilities</option>';
        do{	
        $table .= '<option value="'.$row_rsFinC['a'].'">'.$row_rsFinC['b'].'</option>';
		}while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>