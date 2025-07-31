<?php
error_reporting(0);
@require_once('../connection/db.php'); 

if (isset($_POST['d'])){
$countyID=$_POST['d'];
 $sql= "SELECT `facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY
FROM `facilitys` , `districts` ,`countys`
WHERE `facilitys`.`genesite` ='1'
and `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` ='$countyID'
AND `facilitys`.`facilitycode`<99999";
$rsFinC = mysqli_query($dbConn,$sql, $ntrl) or die(mysqli_error($dbConn));
$row_rsFinC = mysqli_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= ' Facility:<select name="facility" id="facility" class="form-control"  data-first-option="false"><option value="0">All</option>';
        
        do{	
        $table .= '<option value="'.$row_rsFinC['CODE'].'">'.$row_rsFinC['FACILITY'].'</option>';
		}while ($row_rsFinC = mysqli_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>
