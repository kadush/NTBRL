<?php
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

if (isset($_POST['d'])){
$countyID=$_POST['d'];
 $sql= "SELECT ID as a ,name as b FROM districts WHERE county=$countyID";
$rsFinC = mysql_query($sql, $conn) or die(mysql_error());
$row_rsFinC = mysql_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

	    $table .= '<select name="district" id="district" class="form-control"  data-first-option="false">';
        
        do{	
        $table .= '<option value="'.$row_rsFinC['a'].'">'.$row_rsFinC['b'].'</option>';
		}while ($row_rsFinC = mysql_fetch_assoc($rsFinC));
		$table .= '</select>';
		
	echo $table;
}
?>
