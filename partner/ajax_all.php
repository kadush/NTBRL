<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

if (isset($_POST['d'])){
$countyID=$_POST['d'];
 $sql= "SELECT 
`consumption`.`ID` AS id,
`consumption`.`facility` AS a,
`facilitys`.`name` AS b, 
`districts`.`name` AS c,
consumption.commodity AS d,
consumption.quantity AS e,
consumption.quantity_used AS f,
consumption.end_bal AS g,
consumption.q_req AS h,
consumption.status AS st
FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$countyID'
group by `consumption`.`facility`";
$rsFinC = mysql_query($sql, $conn) or die(mysql_error());
$row_rsFinC = mysql_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= '<select name="facility" id="facility" class="form-control">';
        $table .= '<option value="0">All Facilities</option>';
        do{	
        $table .= '<option value="'.$row_rsFinC['a'].'">'.$row_rsFinC['b'].'</option>';
		}while ($row_rsFinC = mysql_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>