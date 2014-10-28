<?php require_once('../connection/db.php'); 
include("header.php");
$facilitycode= $_SESSION['mfl'];

$sqlCN="SELECT  countys.ID AS cid,countys.name AS cN 
FROM countys,facilitys ,districts
WHERE 
`facilitys`.`facilitycode`='$facilitycode'
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county` ";

$qCN=mysql_query($sqlCN) or die(mysql_error());
$rwCN=mysql_fetch_assoc($qCN);
$countyID=$rwCN['cid'];
$cname=$rwCN['cN'];

$sql = "SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY
FROM `facilitys` , `districts` ,`countys`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$countyID'";
$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table2 .= '<tr bgcolor="#CCC"><th><small>Code</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>County</small></th>';
$dyn_table2 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table2 = '<table class="table table-bordered datatable" id="table-1">'; 
 	
while($row=mysql_fetch_assoc($query)){
	
-
$code=$row['CODE'];	
$facility=$row['FACILITY'];	
$district=$row['DISTRICT'];
$county=$row['COUNTY'];

	
	
if ($i % 10000 == 0){ 
$dyn_table2 .= ' <thead><tr class="odd gradeX"><th><small>Code</small></th><th><small>Facility</small></th><th><small>District</small></th><th><small>County</small></th></thead> <tbody>';

          
		  $dyn_table2 .= '<td align="left"><small>' . $code . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $district . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $county . '</small></td></tr>';
		    		   
		  
  
} 
else{
	     
		  $dyn_table2 .= '<td align="left"><small>' . $code . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $facility . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $district . '</small></td>';
		  $dyn_table2 .= '<td align="left"><small>' . $county . '</small></td></tr>';
		           	
} 
       
	      $i++;	
		
}	
	
         $dyn_table2 .= '</tbody></table>';	
	
}


?>

	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">
		
<?php include("sidebar.php"); ?>

<div class="main-content">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Mapping of all Facilities in <?php echo $cname; ?> County
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			<?php
		echo $dyn_table2;
		?>

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
			</div>
		
		</div>
	
	</div>
</div>
	


	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	
	
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>