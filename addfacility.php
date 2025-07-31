<?php
include("Asidebar.php");

$query_rsCounty = "SELECT countys.ID, countys.name FROM countys ORDER BY countys.name";
$rsCounty = mysqli_query($dbConn,$query_rsCounty, $ntrl) or die(mysqli_error($dbConn)());
$row_rsCounty = mysqli_fetch_assoc($rsCounty);
$totalRows_rsCounty = mysqli_num_rows($rsCounty);

$query_rsFType = "SELECT  DISTINCT ftype FROM `facilitys`";
$rsFType = mysqli_query($dbConn,$query_rsFType, $ntrl) or die(mysqli_error($dbConn)());
$row_rsFType = mysqli_fetch_assoc($rsFType);
$totalRows_rsFType = mysqli_num_rows($rsFType);

$query_rsOwner = "SELECT DISTINCT owner FROM `facilitys`";
$rsOwner = mysqli_query($dbConn,$query_rsOwner, $ntrl) or die(mysqli_error($dbConn)());
$row_rsOwner = mysqli_fetch_assoc($rsOwner);
$totalRows_rsOwner = mysqli_num_rows($rsOwner);

$query_rsPartner = "SELECT partnercode, partnername FROM `partners`";
$rsPartner = mysqli_query($dbConn,$query_rsPartner, $ntrl) or die(mysqli_error($dbConn)());
$row_rsPartner = mysqli_fetch_assoc($rsPartner);
$totalRows_rsPartner = mysqli_num_rows($rsPartner);
if (isset($_POST["btnUpload"])) {
$sql="INSERT INTO facilitys (`facilitycode`,`name`,`district`,`ftype`, `owner`, partner , genesite) VALUES (
'$_POST[code]',
'$_POST[fname]',
'$_POST[district]',
'$_POST[ftype]',
'$_POST[owner]',
'$_POST[partner]',
'$_POST[genesite]')";
//exit;

$retval = mysqli_query($dbConn, $sql );
if(! $retval )
{
  $errormsg='An Error Occurred.Please Try Again';
}
else {
	$suceessmsg= 'Facility Details Successfully Saved';
}
 
}
?>

<div class="main-content" style="margin-top: -1%">
<?php include("Aheader.php");	 ?>	
		
<hr />

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


<div class="row">
	<div class="col-sm-12">
	
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				
				<div class="panel-title">Add New Facility</div>
			</div>
	
			<div class="panel-body">
				<?php if ($errormsg !="")
					{
					?> 
				<div class="alert alert-danger col-md-6 col-md-offset-3" style="text-align: center;">
					<span><?php echo  $errormsg; ?></span>
					<a href="addfacility.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<?php if ($suceessmsg !="")
						{
						?> 
					<div class="alert alert-success col-md-6 col-md-offset-3" style="text-align: center;" > 
						<span><?php echo $suceessmsg; ?></span>	
						<a href="addfacility.php" data-rel="close" class="close pull-right"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
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
					<label>Type of Facility:</label>	
					<select name="ftype" class="form-control" data-first-option="false" required>
					<option value="">Type of Facility</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsFType['ftype']?>"><?php echo $row_rsFType['ftype']; ?></option>
							      <?php
							} while ($row_rsFType = mysqli_fetch_assoc($rsFType));
							  $rows = mysqli_num_rows($rsFType);
							  if($rows > 0) {
							      mysqli_data_seek($rsFType, 0);
								  $row_rsFType = mysqli_fetch_assoc($rsFType);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div class="col-md-4">
					<div class="form-group">
					<label>Type of Ownership:</label>	
					<select class="form-control" name="owner" data-first-option="false" required>
					<option value="">Type of Ownership</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsOwner['owner']?>"><?php echo $row_rsOwner['owner']; ?></option>
							      <?php
							} while ($row_rsOwner = mysqli_fetch_assoc($rsOwner));
							  $rows = mysqli_num_rows($rsOwner);
							  if($rows > 0) {
							      mysqli_data_seek($rsOwner, 0);
								  $row_rsOwner = mysqli_fetch_assoc($rsOwner);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>County:</label>	
					<select class="form-control" name="county" id="county" data-first-option="false" required>
					<option value="">Select One County</option>
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
						
					<div name="district" id="district">  </div>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div class="col-md-4">
					<div class="form-group">
					<label>Partner:</label>
						
					<select class="form-control" name="partner" id="partner" required>
					<option value="">Select One Partner</option>
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
						<option value="">Select One Type</option>
						<option value="0">Normal Health Centre</option>
						<option value="1">GeneSite</option>				
					</select>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div align="center">
					<button class="btn btn-success" type="submit" name="btnUpload" id="btnUpload">Save Details</button>
					<input type="reset" name="reset" class="btn btn-default"/>
				</div>
			</form>
			</div>				
		</div>	

	</div>

</div>

<br />




<!-- Footer -->
<footer class="main">
	
    <div class="pull-right">
		<?php 
		include '../includes/footer.php';
		?>
	</div>

</footer>	
</div>
	

	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/js/selectboxit/jquery.selectBoxIt.css"  id="style-resource-3">

	<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script src="neon/neon-x/assets/js/selectboxit/jquery.selectBoxIt.min.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	
<script type="text/javascript">
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
 </script>
</body>
</html>