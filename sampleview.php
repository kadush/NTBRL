<?php
include("header.php");
require_once('connection/db.php');

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT * FROM sample1 WHERE `cond` = 0 and facility=".$_SESSION['mfl'];
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);

//$totalRows_rssample = mysql_num_rows($rssample);

?>

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
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

<div class="main-content">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Sample(s) with Pending GeneXpert Details
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
        <th>Lab No </th>
        <th>Patient Name</th>
        <th>Age </th>
        <th>Gender</th>
        <th>Type of patient</th>
        <th>Smear(+ve/-ve)</th>
        <th>Date of Sample Collection</th>
        <!--<th style="text-align: center;">Actions</th>-->
        
        
        </tr>
	</thead>
	<tbody>
   		
	<?php if  ($totalRows_rssample=mysql_num_rows($rssample)==0)
			{
				//echo '<div >No fields to display</div>';
				
					   }  
					  else{
					   do { ?>      
			<tr class="odd gradeX">
			<td> <?php echo $row_rssample['lab_no']; ?></td>
			<td> <?php echo $row_rssample['fullname']; ?></td>
			<td> <?php echo $row_rssample['age']; ?></td> 
			<td> <?php echo $row_rssample['gender']; ?></td>
			<td> <?php echo $row_rssample['pat_type']; ?></td>
			<td> <?php echo $row_rssample['smear']; ?></td>
			<td> <?php echo $row_rssample['coldate']; ?></td> 
			
			<!--<td><a style="float: left;margin-left: 7%;" href="csv_upload.php"><img src="img/icons/edit.png" height="20" alt="Update" title="Upload Sample Results "/></a> 
				<a style="float: right;margin-right: 7%;" <?php echo "href='deleteSamp.php?id=" .urlencode($row_rssample['lab_no']) ."'";?>><img src="img/icons/erase.png" height="20" alt="Delete" title="Delete Sample Result"/></a>
			</td> -->  
			  
			    </tr>
			     <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); }?> 
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