<style type="text/css" title="currentStyle">
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<?php
error_reporting(0);
@require_once('../connection/db.php'); 
$conn = mysqli_connect($hostname, $username, $password);



 if (isset($_POST['id'])){
		$comm = $_POST['id'];
	    $sql4="SELECT c.facility, f.name , (c.end_bal+c.received) AS cart FROM consumption c , facilitys f WHERE  c.commodity='$comm' and c.facility=f.facilitycode group by c.facility ORDER BY c.date DESC";
	    // echo $sql4;
	    // exit;
    $result=mysqli_query($dbConn,$sql4,$conn) or die(mysqli_error($dbConn));
	//$data_array=mysqli_fetch_assoc( $result);
	
	if( mysqli_num_rows($result)==0){
			
			 $table .= '<table class="table table-striped" id="table-1"><tr><td colspan="6" style="text-align:center">There are no tests done in this County</td></tr></table>';
			} 
    else{
       	$table.='<table class="table table-striped"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Inventory Balance('.$comm.')</th></tr>';

	   while ($data_array=mysqli_fetch_array($result))
       {
       
        $table .= '<tr><td style="text-align:center">'.$data_array['facility'].'</td><td style="text-align:center">'.$data_array['name'].'</td><td style="text-align:center">'.$data_array['cart'].'</td></tr>';
	
      } 
    }
  
  $table .= '</table>';
      
        echo $table;
   
           
     }
?>
<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script type="text/javascript">
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
</script>