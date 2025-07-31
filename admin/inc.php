<?php
include("header.php");
require_once('connection/db.php');

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)>='$previousmonth' and  YEAR(End_Time)='$year' and age='' and pat_type='' and h_status='' and gender='' and lab_no='' and fullname='' and facility=".$_SESSION['mfl'];
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


<?php include("sb.php"); ?>

<div class="main-content" style="">

<div class="row">
	<div class="col-md-9" style="float: right !important;margin-right: 0.25%;min-width: 1100px !important">
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Sample(s) Awaiiting Patient Details (This Month)
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			 <table class="table table-bordered datatable" id="table-2">
					<thead>
						<tr>
				        <th>Sample ID </th>
				        <th>Patient ID</th>
				        <th>Date Tested </th>
			            <th>MTB Result </th>
			            <th>MTB Rif </th>
				        <th>Actions</th>
				        
				        </tr>
					</thead>
					<tbody>
				   		
					<?php 
					   do { ?>      
							<tr class="odd gradeX">
							<td> <?php echo $row_rssample['Sample_ID']; ?></td>
							<td> <?php echo $row_rssample['Patient_ID']; ?></td>
							<td> <?php echo $row_rssample['End_Time']; ?></td> 
							<td> <?php echo $row_rssample['Test_Result']; ?></td>
							<td> <?php echo $row_rssample['mtbRif']; ?></td>
							
							<td>
								<a href="editTR.php?id=<?php echo $row_rssample['ID']; ?>&name=<?php echo $row_rssample['Patient_ID']; ?>"><img src="img/icons/edit.png" height="20" alt="Edit" title="Edit Patient Details "/>Edit</a> 
							</td> 
														  
							</tr>
					 <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
							     
							     
				        </tbody>
				</table>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-2").dataTable({
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
	<script src="admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	
	
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
	
	
	<script type="text/javascript">

		
		function update(num) {
			//alert($("#save_"+num).serialize());
		var that = this;
		        $.ajax({
		        	 
		                type: "POST",
		                url: "update.php",
		                data: $("#save_"+num).serialize(),
		                dataType:"json",
		                cache:false,
		                success: function(data) {
		                	
		                   var opts = {
							"closeButton": true,
							"debug": false,
							"positionClass": "toast-bottom-left",
							"onclick": null,
							"sdeDuration": "1000",
							"tihowDuration": "300",
							"himeOut": "10000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						};
						
						 toastr.success(data.message, data.title, opts);
						 window.location.href='sampleview.php';
		                },
		                error: function () {
		                	
		                    var opts = {
							"closeButton": true,
							"debug": false,
							"positionClass": "toast-bottom-left",
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						};
						
						toastr.success(data.message, data.title, opts);
		                }
		            })
		       
		        } // End of  keyup function
		
		 // End of document.ready

 </script>
  

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