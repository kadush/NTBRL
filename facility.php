<?php
include("header.php");
require_once('../connection/db.php');

$sql = "SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY, 
`provinces`.`name` AS PROVINCE,
facilitys.genesite AS STATUS

FROM `facilitys` , `districts` ,`countys`, `provinces`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`province` = `provinces`.`ID`
AND `facilitys`.`facilitycode` > 1
 ";
$rssample=mysqli_query($dbConn,$sql, $ntrl);
$row_rssample = @mysqli_fetch_assoc($rssample);
$rw=mysqli_num_rows($rssample);

$query_rsCounty = "SELECT countys.ID, countys.name FROM countys ORDER BY countys.name";
$rsCounty = mysqli_query($dbConn,$query_rsCounty, $ntrl) or die(mysqli_error($dbConn)());
$row_rsCounty = mysqli_fetch_assoc($rsCounty);
$totalRows_rsCounty = mysqli_num_rows($rsCounty);

$query_rsFType = "SELECT  DISTINCT ftype FROM `facilitys`";
$rsFType = mysqli_query($dbConn,$query_rsFType, $ntrl) or die(mysqli_error($dbConn)());
$row_rsFType = mysqli_fetch_assoc($rsFType);
$totalRows_rsFType = mysqli_num_rows($rsFType);

$query_rsDist = "SELECT districts.ID, districts.name FROM `districts`";
$rsDist = mysqli_query($dbConn,$query_rsDist, $ntrl) or die(mysqli_error($dbConn)());
$row_rsDist = mysqli_fetch_assoc($rsDist);
$totalRows_rsDist = mysqli_num_rows($rsDist);

$query_rsPartner = "SELECT partnercode, partnername FROM `partners`";
$rsPartner = mysqli_query($dbConn,$query_rsPartner, $ntrl) or die(mysqli_error($dbConn)());
$row_rsPartner = mysqli_fetch_assoc($rsPartner);
$totalRows_rsPartner = mysqli_num_rows($rsPartner);

?>

	<link rel="stylesheet" href="neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon-theme-min.css"  id="style-resource-6">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon-forms-min.css"  id="style-resource-7">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom-min.css"  id="style-resource-8">

	
<script>$.noConflict();</script>

	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
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
	<script type="text/javascript">
function showAjaxModal(s)
{
	
	jQuery('#modal-7').modal('show', {backdrop: 'static'});
	//alert(s);
	//exit;
	jQuery.ajax({
		type: "POST",
        url: "fac.php",
        data: 'id=' + s,
        cache: false,
        dataType:"json",
		success: function(data)
		{
			$.each(data,function(i,v){
                		$("#"+i).val(v)
                		
                	});
		}
	});
}
</script>

<div class="main-content" style="margin-left: 2.25%">

<div class="row">
	
	<div class="col-sm-12" style="float: right !important;margin-right: 0.25%;">
		
		<div class="panel panel-gradient" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">All Facilities In The Country</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
				
			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>MFL CODE</th>
				        <th>FACILITY NAME</th>
				        <th>DISTRICT </th>
				        <th>COUNTY</th>
				        <th>PROVINCE</th>
				        <th>STATUS</th>
				        <th>OPERATIONS</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					if ($rw<1) {
						
					}
					
					else {
						
					do {
						if ( $row_rssample['STATUS']==1) {
							$row_rssample['STATUS']='<div class="label label-success">Genesite</div>';
							
						} else {
							$row_rssample['STATUS']='<div class="label label-warning">Normal Facility</div>';
						}
												
					?>
					<tr>
						<td><?php echo $row_rssample['CODE']; ?></td>
						<td><?php echo $row_rssample['FACILITY']; ?></td>
						<td><?php echo $row_rssample['DISTRICT']; ?></td>
						<td><?php echo $row_rssample['COUNTY']; ?></td>
						<td><?php echo $row_rssample['PROVINCE']; ?></td>
						<td><?php echo $row_rssample['STATUS']; ?></td>
						<td>
							<a class="btn btn-default btn-sm btn-icon icon-left" href="javascript:;" onclick="showAjaxModal(<?php echo $row_rssample['CODE']; ?>);">
							<i class="entypo-pencil"></i>
							Edit
							</a>
							
							<!-- <a class="btn btn-info btn-sm btn-icon icon-left" href="#">
							<i class="entypo-info"></i>
							Profile
							</a> -->
						</td>
					</tr>
					<?php } while ($row_rssample = mysqli_fetch_assoc($rssample)); } ?>
					
				</tbody>
			</table>


<!-- Modal 7 (Ajax Modal)-->
<div class="modal fade" id="modal-7">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Profile</h4>
			</div>
			
			<div class="modal-body">
			
				<form name="save" id="save" class="validate" method="post" role="form">
				<div class="col-md-4">
					<div class="form-group">
					<label>Mfl Code:</label>
			    	<input type="text" name="code" id="code" data-validate="required"  class="form-control" data-mask="99999" >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Facility Name:</label>	
				    <input class="form-control" type="text" name="fname" id="fname" data-validate="required">
				    </div>
				</div>
				
				
				<div class="col-md-4">
					<div class="form-group">
					<label>County:</label>	
					<select class="form-control" name="county" id="county" >
					<option value="0">All counties</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsCounty['ID']?>"><?php echo $row_rsCounty['name']; ?></option>
							      <?php
							} while ($row_rsCounty = mysqli_fetch_assoc($rsCounty));
							  $rows = mysqli_num_rows($rsCounty);
							  if($rows > 0) {
							      mysqli_data_seek($rsCounty, 0);
								  $row_rsCounty = mysqli_fetch_assoc($rsCounty);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>District:</label>
						
					<select class="form-control" name="district" id="district" required>
					<option value="0">All Districts</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsDist['ID']?>"><?php echo $row_rsDist['name']; ?></option>
							      <?php
							} while ($row_rsDist = mysqli_fetch_assoc($rsDist));
							  $rows = mysqli_num_rows($rsDist);
							  if($rows > 0) {
							      mysqli_data_seek($rsDist, 0);
								  $row_rsDist = mysqli_fetch_assoc($rsDist);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Partner:</label>
						
					<select class="form-control" name="partner" id="partner" required>
					<option value="0">All Partners</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsPartner['partnercode']?>"><?php echo $row_rsPartner['partnername']; ?></option>
							      <?php
							} while ($row_rsPartner = mysqli_fetch_assoc($rsPartner));
							  $rows = mysqli_num_rows($rsPartner);
							  if($rows > 0) {
							      mysqli_data_seek($rsPartner, 0);
								  $row_rsPartner = mysqli_fetch_assoc($rsPartner);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Facility Type:</label>
						
					<select class="form-control" name="genesite" id="genesite" required>
					<option value="0">Normal Health Centre</option>
					<option value="1">GeneSite</option>				
					</select>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				
				<!-- <div align="center">
					<button class="btn btn-success" type="submit" name="btnUpload" id="btnUpload">Save Details</button>
					<input type="reset" name="reset" class="btn btn-default"/>
				</div> -->
			</form>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-info" name="btnUpload" id="btnUpload" type="button" onClick="update()">Save changes</button>
									
			</div>
		</div>
	</div>
</div>
		</div>
		
	</div>
	
</div>

<!-- <script type="text/javascript">
$(document).ready(function(){
   
	 $("#county").change(function () {

     if($("#county option:selected").val() == 0 ){
         $('#district').hide();
     } else if ($("#county option:selected").val() > 0){
        $('#district').show();
         cid=$("#county option:selected").val();
         	 //alert(cid);
         	             
     }
     

    $.post("ajax_all.php", 
    { d : cid },
    function(data) {
    	//alert(data);
    	$('#district').html(data);
    });
                
    });
    //return data; 
});
 </script> -->
<script type="text/javascript">
	
		function update() {
		//alert($("#save").serialize());
		//exit;
		var that = this;
		        $.ajax({
		        	 
		                type: "POST",
		                url: "update.php",
		                data: $("#save").serialize(),
		                dataType:"json",
		                cache:false,
		                success: function(data) {
		                	window.location.href='facility.php';
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

	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.dialog.js"></script>
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
	
	  

<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		@include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>
</body>
</html>