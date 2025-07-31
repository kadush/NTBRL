<?php 
include("header.php");
//@require_once('../connection/db.php'); 
	if (isset($_GET['id'])){
		$sampleID = $_GET['id'];
	}

$query_rssample = "SELECT s.Status,s.Start_Time,s.End_Time,s.Assay,s.Assay_Version,s.Assay_Type,s.Reagent_Lot_Number,s.Reagent_Lot_ID,s.Expiration_Date,s.Cartridge_SN,s.Module_Name,s.Module_SN,s.Instrument_SN,s.SW_Version,s.Exported_Date,s.User, s.Test_Result, s.Sample_ID AS sid,s.Patient_ID AS pid, s.ID as ID,s.lab_no as ln, s.fullname as a, s.age as b, f.name as c, s.End_Time as d, s.Test_Result as e,  s.mtbRif as f,s.age,s.gender,s.address,s.mobile,s.coldate,s.h_status,s.pat_type, s.smear, s.c_name,s.c_email,s.c_no,d_email FROM sample1 s , facilitys f WHERE s.Refacility=f.facilitycode AND s.cond=1 and Test_Result='positive' and mtbRif='positive' ";
$rssample = mysqli_query($dbConn,$query_rssample) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$total = mysqli_num_rows($rssample);

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
	
	<!-- TS1387507087: Neon - Responsive ../admin Template created by Laborator -->

<div class="main-content" style="">

<div class="row">
	<div class="col-md-11" style="float: right !important;margin-right: 0.25%;min-width: 1100px !important">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Sample Results - MTB Positive and Rif Resistance 
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
			            <!-- <th>MTB Result</th> -->
			            <th>Actions</th>
			          
			         </tr>
				</thead>
				<tbody>
				   <?php do { $row_rssample['d']= @date('d-M-Y', strtotime($row_rssample['d'])); 
				    	$row_rssample['Start_Time']= date('d-M-Y', strtotime(	$row_rssample['Start_Time']));
						$row_rssample['End_Time']= date('d-M-Y', strtotime(	$row_rssample['End_Time']));
						$row_rssample['Expiration_Date']= date('d-M-Y', strtotime(	$row_rssample['Expiration_Date']));
						$row_rssample['Exported_Date']= date('d-M-Y', strtotime(	$row_rssample['Exported_Date']));
				    
				   if($row_rssample['ln']==''){
				   	    	
				   	    $row_rssample['ln']=$row_rssample['sid'];
				   	
				   }
				   if($row_rssample['a']==''){
				   	    	
				   	    $row_rssample['a']=$row_rssample['pid'];
				   	
				   }
				   
				   ?>      
						<tr class="odd gradeX">
						 
						<td> <?php echo $row_rssample['ln']; ?></td>
						<td> <?php echo $row_rssample['a']; ?></td>
						<td> <?php echo $row_rssample['c']; ?></td>
						<td> <?php echo $row_rssample['d']; ?></td> 
						<!-- <td> <?php echo $row_rssample['e']; ?></td>
						 -->
						
						<td>
							<a title="View Full Profile" class="btn btn-info btn-sm btn-icon icon-left" data-toggle="modal" data-target="#<?php echo $row_rssample['ID']; ?>" > 
							<i class="entypo-info"></i>
							 &nbsp;
							</a>
						</td> 
						 </tr>
						 <!-- Modal -->
							<div class="modal" id="<?php echo $row_rssample['ID']; ?>" tabindex="-1" role="dialog" style="width: 1000px;">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Patient Information</h4>
							      </div>
							      <div class="modal-body" style="width: 1200px; height: 150px">
							      	<div class="col-md-4">
							      	   <label for="field1">Lab No: </label> <?php echo $row_rssample['ln']; ?>
									 </div> 
									 <div class="col-md-4">
									  <label for="field1">Full Name: </label>
									  <?php echo $row_rssample['a']; ?>
									  </div>
									  <div class="col-md-4">
									  <label>Age: </label><?php echo $row_rssample['age']; ?>
									  </div>
									  <div class="col-md-4">
									  	<label>Gender: </label><?php echo $row_rssample['gender']; ?>
									  </div>
									  <div class="col-md-4">
									  	<label>Mobile No: </label><?php echo $row_rssample['mobile']; ?>
									  </div>
									  <div class="col-md-4"><label for="field3">Physical address: </label>
									    <?php echo $row_rssample['address']; ?>
									  </div>
									  <div class="col-md-4"><label for="field4">HIV Status: </label>
									  	<?php echo $row_rssample['h_status']; ?>
									  </div>
									 
									  <div class="col-md-4"><label for="field3">Type of patient: </label>
									  	<?php echo $row_rssample['pat_type']; ?>
									  </div>
									  <div class="col-md-4"><label for="field3">Clinician Name: </label>
									  	<?php echo $row_rssample['User']; ?>
									  </div>
									  
									  <div class="col-md-4"><label for="field3">Date of collection: </label>
									  	<?php echo $row_rssample['d']; ?>
									  </div>
									  <div class="col-md-4"><label for="field3">MTB Result: </label>
									  	<?php echo $row_rssample['e']; ?>
									  </div>
									   <div class="col-md-4"><label for="field3">MTB Rif Result: </label>
									   	<?php echo $row_rssample['f']; ?>
									   </div>
									  
							      </div>
							      <div class="modal-header">
							        <h4 class="modal-title" id="myModalLabel">Genexpert Information</h4>
							        
							      </div>
							       <div class="modal-body" style="width: 1000px; height: 150px">
							      	<div class="col-md-4">
							      	   <label for="field1">Test Status: </label> <?php echo $row_rssample['Status']; ?>
									 </div> 
									 <div class="col-md-4">
									  <label for="field1">Start Time: </label>
									  <?php echo $row_rssample['Start_Time'];?>
									  </div>
									  <div class="col-md-4">
									  <label>End Time:  </label><?php echo $row_rssample['End_Time']; ?>
									  </div>
									  
									  <div class="col-md-4">
									  	<label>Assay Version:  </label><?php echo $row_rssample['Assay_Version']; ?>
									  </div>
									  						 
									  <div class="col-md-4"><label for="field3">Cartridge S/N: </label>
									  	<?php echo $row_rssample['Cartridge_SN']; ?>
									  </div> 
									  <div class="col-md-4"><label for="field3">Expiration Date: </label>
									  	<?php echo 	$row_rssample['Expiration_Date'];?>
									  </div>
									  <div class="col-md-4"><label for="field3">Module Name: </label>
									  	<?php echo $row_rssample['Module_Name']; ?>
									  </div>
									  <div class="col-md-4"><label for="field3">Module S/N: </label>
									  	<?php echo $row_rssample['Module_SN']; ?>
									  </div>
									   <div class="col-md-4"><label for="field3">Instrument S/N: </label>
									   	<?php echo $row_rssample['Instrument_SN']; ?>
									   </div>
									   <div class="col-md-4"><label for="field3">S/W Version: </label>
									   	<?php echo $row_rssample['SW_Version']; ?>
									   </div>
									   <div class="col-md-4"><label for="field3">Exported Date: </label>
									   	<?php echo 	$row_rssample['Exported_Date'];?>
									   </div>
									  
							      </div>
							      <div class="modal-footer">
							        
							      </div>
							    </div>
							  </div>
							</div>
			      <?php } while ($row_rssample = mysqli_fetch_assoc($rssample)); ?> 
			      
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


