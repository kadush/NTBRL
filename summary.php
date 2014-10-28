<?php require_once('connection/db.php'); 

	if (isset($_GET['id'])){
		$FacID = $_GET['id'];
	}

$sql= "SELECT
 `sample`.`Sample_ID` AS SAMPLE,
 
  `facilitys`.`name` AS FACILITY, 
  `districts`.`name` AS DISTRICT, `provinces`.`name` AS PROVINCE
FROM 
`sample` , `facilitys` , `districts` ,`countys`, `provinces`
WHERE `sample`.`facility` = `facilitys`.`ID`
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`province` = `provinces`.`ID`  "  ;



$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table .= '<tr bgcolor="#CCC"><th><small>Sample</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>Province</small></th>';
$dyn_table .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$samp=$row['SAMPLE'];

$facility=$row['FACILITY'];	
$district=$row['DISTRICT'];
$province=$row['PROVINCE'];
	
	
if ($i % 10000 == 0){ 
$dyn_table .= ' <thead><tr class="odd gradeX"><th><small>Sample</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>Province</small></th></thead> <tbody>';

          $dyn_table .= '<td align="left"><small>' .$samp . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' . $district . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' .$province. '</small></td></tr>';
		    		   
		  
  
} 
else{
	      $dyn_table .= '<td align="left"> <small>' .$samp . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' . $district . '</small></td>';
		  $dyn_table .= '<td align="left" ><small>' .$province. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table .= '</tbody></table>';	
	
}


?>
