<?php
include("ASHeader.php");
@require_once('../connection/db.php'); 

/* ****************************************************/
$sql= "SELECT section5.facility AS MFL, facilitys.name AS FACILITY,section5.workflow as lab FROM section5,facilitys WHERE facilitys.facilitycode=section5.facility AND section5.workflow='other (please specify)'"  ;



$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){

$dyn_table3 .= '<td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table3 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$mfl=$row['MFL'];
$facility=$row['FACILITY'];	
$lab=$row['lab'];	
	
	
if ($i % 10000 == 0){ 
$dyn_table3 .= '<thead><tr class="odd gradeX"><th><small>Mfl</small></th><th><small>Facility</small></th><th><small>Mode of Management</small></th></thead> <tbody>';

          $dyn_table3 .= '<td align="left"><small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		   $dyn_table3 .= '<td align="left"><small>' .$lab . '</small></td></tr>';
		 
		    		   
		  
  
} 
else{
	      $dyn_table3 .= '<td align="left"><small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		   $dyn_table3 .= '<td align="left"><small>' .$lab . '</small></td></tr>';
		 
} 
       
	$i++;	
		
}	
	
$dyn_table3 .= '</tbody></table>';	
	
}

?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
<style type="text/css" title="currentStyle">
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({"bJQueryUI":true});
			} );
		</script>
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
            
            <div id="demo" align="center">

		<?php
		echo $dyn_table3;
		?>
	
			</div>
</div>

		
<div class="clearer">&nbsp;</div>

</div>
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>