<?php require_once('connection/db.php'); 
include("header.php");


mysql_select_db($database, $ntrl);
$sql = "SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY, 
`provinces`.`name` AS PROVINCE 

FROM `facilitys` , `districts` ,`countys`, `provinces`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`province` = `provinces`.`ID`
 ";
$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table2 .= '<tr bgcolor="#CCC"><th><small>Code</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>County</small></th><th><small>Province</small></th>';
$dyn_table2 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table2 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">'; 
 	
while($row=mysql_fetch_assoc($query)){
	

$code=$row['CODE'];	
$facility=$row['FACILITY'];	
$district=$row['DISTRICT'];
$county=$row['COUNTY'];
$province=$row['PROVINCE'];
	
	
if ($i % 10000 == 0){ 
$dyn_table2 .= ' <thead><tr class="odd gradeX"><th><small>Code</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>County</small></th><th><small>Province</small></th></thead> <tbody>';

          
		  $dyn_table2 .= '<td align="left"><small>' .$code . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $district . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $county . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' .$province. '</small></td></tr>';
		    		   
		  
  
} 
else{
	     
		  $dyn_table2 .= '<td align="left"><small>' .$code . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $district . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' . $county . '</small></td>';
		  $dyn_table2 .= '<td align="left" ><small>' .$province. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table2 .= '</tbody></table>';	
	
}


?>


<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery-ui.css">

<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.3/demos/demos.css">
<style type="text/css" title="currentStyle">
@import "jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({"bJQueryUI":true});
			} );
		</script>
	</head>
	<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

   <div class="left" id="main-left">
   <?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
   
      <div class="section-title" style="width:990px">Mapping of all facilities in the country</div>
			<div id="demo" align="center">

		<?php
		echo $dyn_table2;
		?>
	
			</div>
           
		</div> 
	</div> 
		<?php
include("sidebar.php");
?>

</div>
	</body>
</html>

<?php
include("includes/footer.php");
?>