
<?php require_once('connection/db.php'); 

$sql= "SELECT section3.facility AS MFL, facilitys.name AS FACILITY,section3.make AS MAKE, section3.serial AS SERIAL, section3.online AS LOCAL FROM section3,facilitys WHERE facilitys.facilitycode=section3.facility "  ;



$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table3 .= '<tr bgcolor="#CCC"><th><small>Mfl</small></th><th><small>
Make</small></th><th><small>
Make</small></th><th><small>Serial</small></th><th><small>Local Support</small></th>';
$dyn_table3 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table3 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$mfl=$row['MFL'];
$facility=$row['FACILITY'];	
$make=$row['MAKE'];	
$serial=$row['SERIAL'];
$local=$row['LOCAL'];
	
	
if ($i % 10000 == 0){ 
$dyn_table3 .= '<thead><tr class="odd gradeX"><th><small>Mfl</small></th><th><small>Facility</small></th><th><small>Make</small></th><th><small>Serial</small></th><th><small>Local Support</small></th></thead> <tbody>';

          $dyn_table3 .= '<td align="left"><small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $make . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $serial . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' .$local. '</small></td></tr>';
		    		   
		  
  
} 
else{
	      $dyn_table3 .= '<td align="left"> <small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $make . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $serial . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' .$local. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table3 .= '</tbody></table>';	
	
}




?>