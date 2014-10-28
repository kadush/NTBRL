<?php require_once('connection/db.php'); 
include("header.php");
 
	if (isset($_GET['id'])){
		$sampleID = $_GET['id'];
	}
?>
<?php

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT s.ID as ID,s.lab_no as ln, s.fullname as a, s.age as b, f.name as c, s.End_Time as d, s.Test_Result as e,  s.pat_type as f 
FROM sample1 s , facilitys f WHERE s.Refacility=f.facilitycode AND s.cond=1 and Test_Result='positive' and mtbRif='positive' and s.facility=".$_SESSION['mfl'];
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);

?>

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content" style="">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Sample Results With Errors
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
			 <table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>Lab No</th>
			            <th>Patient Name</th>
			            <th>Referred Facility</th>
			            <th>Date Tested</th>
			            <th>MTB Result</th>
			            <th>Actions</th>
			          
			         </tr>
				</thead>
				<tbody>
				   <?php do { $row_rssample['d']= @date('d-M-Y', strtotime($row_rssample['d']));?>      
						<tr class="odd gradeX">
						 
						<td> <?php echo $row_rssample['ln']; ?></td>
						<td> <?php echo $row_rssample['a']; ?></td>
						<td> <?php echo $row_rssample['c']; ?></td>
						<td> <?php echo $row_rssample['d']; ?></td> 
						<td> <?php echo $row_rssample['e']; ?></td>
						
						
						<td>
							<a title="View Full Profile"class="btn btn-info btn-sm btn-icon icon-left" <?php echo "href='patientview.php?id=" .urlencode($row_rssample['ID']) ."'";?>>
							<i class="entypo-info"></i>
							 &nbsp;
							</a>
							<a title="View GeneXpert Info" class="btn btn-default btn-sm btn-icon icon-left" <?php echo "href='machineview.php?id=" .urlencode($row_rssample['ID']) ."'";?>>
							<i class="entypo-monitor"></i>
							 &nbsp;
							</a>
						</td> 
						 </tr>
			      <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
			      
			        </tbody>
			</table>

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
	


	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	
	
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>