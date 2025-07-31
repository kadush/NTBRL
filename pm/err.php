<?php 
session_start();

require_once('../connection/db.php'); //connection file
$currentmonth=date("m");
$currentyear=date("Y");
/* query for getting all samples ever done */
$sql= "Select f.name as facility,s.Error_Code as code,s.Error_Notes as note
FROM sample1 s , facilitys f WHERE s.facility=f.facilitycode AND s.cond=1 and (Test_Result='Error') and MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' ORDER BY s.tym desc";

$query=mysqli_query($dbConn,$sql);
$numrows=@mysqli_num_rows($query);

if(!$numrows){
$dyn_table .= '<table class="table table-bordered" id="table-1"><tr><td align="center"> <small>No Data to Display </small></td></tr><table>';
}
else{
$i=0;
$dyn_table = '<table class="table table-bordered" id="table-1">';	
while($row=mysqli_fetch_assoc($query)){
	
	$facility=$row['facility'];
	$errcode=$row['code'];
	$errdesc=$row['note'];
	
if ($i % 10000 == 0){ 
$dyn_table .= ' <thead><tr class="odd gradeX"><th><small>Facility Name</small></th><th><small>Error code</small></th></th><th><small>Error Description</small></th></thead> <tbody>';

          $dyn_table .= '<td><small>' .$facility. '</small></td>';
		  $dyn_table .= '<td><small>' .$errcode. '</small></td>';
		  $dyn_table .= '<td><small>' .$errdesc. '</small></td></tr>';
		  
} 
else{
	      $dyn_table .= '<td><small>' .$facility. '</small></td>';
		  $dyn_table .= '<td><small>' .$errcode. '</small></td>';
		  $dyn_table .= '<td><small>' .$errdesc. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
 $dyn_table .= '</tbody></table>';	
	
}

$dyn_table .= '<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>';
echo $dyn_table;

?>