<?php require_once('../connection/db.php'); 
//include('../includes/functions.php');
//session_start();

mysql_select_db($database, $ntrl);
$sql = "SELECT
`section1`.`id` AS NO, 
`section1`.`facility` AS CODE,
`facilitys`.`name` AS FACILITY, 
`section1`.`assessor` AS ASSESSOR,
`section1`.`doa` AS DATE

FROM `section1` , `facilitys` 
WHERE 
`section1`.`facility`=`facilitys`.`facilitycode`
 ";
$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table2 .= '<tr bgcolor="#CCC"><th><small>#</small></th><th><small>Facility Name</small></th><th><small>Date Assessment Done</small></th><th><small>Assessment Done By</small></th><th><small>Action</small></th>';
$dyn_table2 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table2 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">'; 
 	
while($row=mysql_fetch_assoc($query)){
	
$no=$row['NO'];
$code=$row['CODE'];	
$facility=$row['FACILITY'];	
$assessor=$row['ASSESSOR'];
$date=$row['DATE'];

	
if ($i % 10000 == 0){ 
$dyn_table2 .= ' <thead><tr class="odd gradeX"><th><small>#</small></th><th><small>Facility Name</small></th><th><small>Date Assessment Done</small></th><th><small>Assessment Done By</small></th><th><small>Action</small></th></thead> <tbody>';

           $dyn_table2 .= '<td align="left"><small>' .$no . '</small></td>';
		  
		  $dyn_table2 .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $date . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $assessor . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small><a href="viewassessment.php?id='.urlencode($row['CODE']).' ">Details</a></small></td></tr>';
		 
		    		   
		  
  
} 
else{
	     $dyn_table2 .= '<td align="left"><small>' .$no . '</small></td>';
		
		  $dyn_table2 .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $date . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $assessor . '</small></td>';
		  
		  $dyn_table2 .= '<td align="left" ><small><a href="viewassessment.php?id='.urlencode($row['CODE']).' ">Details</a></small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table2 .= '</tbody></table>';	
	
}


?>


<?php
include("assessheader.php");
?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<script src="../jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css">

<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({"bJQueryUI":true});
			} );
		</script>
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

	<div class="left" id="main-left">
    
     <div class="section-title" style="width:950px">List of assessed facilities  </div>
            <div id="demo" align="center">


<?php
echo $dyn_table2;
?>

            </div>
            </div>

<div class="clearer">&nbsp;</div>

	
</body>
</html>
<?php
include("../includes/footer.php");
?>