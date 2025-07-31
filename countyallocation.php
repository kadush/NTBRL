<?php
include("header.php");
if (isset($_GET['id'])){
		$countyID = $_GET['id'];
	}
require_once('../connection/db.php'); 
$userlab=$_SESSION['lab'];
$currentmonth=@date("m");
$currentyear=@date("Y");
$previousmonth=@date("m")- 1;
$year=@date("Y");
if ($currentmonth ==1)
{
$previousmonth=12;
$currentyear=@date("Y")-1;
}
else
{
$previousmonth=@date("m")- 1;
$currentyear=@date("Y");
}

$previousmonthname=GetMonthName($previousmonth);

$reportingdate= date("Y-n-j", strtotime("last day of previous month"));
mysql_select_db($database, $ntrl);
$sql= "SELECT 
`consumption`.`ID` AS id,
`consumption`.`facility` AS a,
`facilitys`.`name` AS b, 
consumption.commodity AS c,
consumption.date AS d,
consumption.b_bal AS e,
consumption.quantity_used AS f,
consumption.losses as l,
consumption.pos as p,
consumption.neg as n,
consumption.end_bal AS g,
consumption.q_req AS h,
consumption.status AS st,
consumption.quantity AS q,
consumption.allocated AS al,
consumption.received AS r
FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`date`= '$reportingdate'
AND `consumption`.`facility`= `facilitys`.`facilitycode`
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$countyID'
ORDER BY `facilitys`.`name`

";
$rsallctn = mysql_query($sql, $ntrl) or die(mysql_error());
$row_rsallctn = mysql_fetch_assoc($rsallctn);

$query = "SELECT s.id, f.name, s.to_fac, s.date, s.f_quantity, s.c_quantity, s.adjustment
FROM stock_adjustment s, facilitys f, `districts` d,`countys` c
WHERE 
`s`.`facility`= `f`.`facilitycode`
AND `s`.`date`= '$year'
AND `d`.`ID` = `f`.`district`
AND `c`.`ID` = `d`.`county`
AND `c`.`ID` = '$countyID'";
$rssam = mysql_query($query, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($rssam);
$total1 = mysql_num_rows($rssam);
// $TT=TOTALFacilityReportedpercounty($countyID,$previousmonth,$currentyear); 
// $TT1=TOTALFacilitypercounty($countyID);
?>
<!DOCTYPE html>
<html lang="en">
	
	
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript">
function showAjaxModal(s)
{
	
	jQuery('#modal-7').modal('show', {backdrop: 'static'});
	// alert(s);
	// exit;
	jQuery.ajax({
		type: "POST",
        url: "../getstock.php",
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

<div class="main-content" style="margin-top: %;margin-left: .3%">
 
<div class="row">
<?php include('ca1.php'); ?>
	<div class="col-sm-12">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Genexpert County Allocation For <?php echo $countyname; ?> County <!-- <span class="badge badge-info badge-roundless" style="float: right" ><?php echo $TT.' / '.$TT1; ?></span> -->
					</h4>
				</div>
				
				<div class="panel-options">
					
				</div>
			</div>
			<div class="panel-body no-padding">
				<table class="table table-bordered" id="table-1">
						<thead>
							<tr>
								
					            <th style="text-align: center">Mfl</th>
					            <th style="text-align: center">Facility Name</th>
					            <th style="text-align: center">Commodity</th>
					            <th style="text-align: center">Period</th>
					            <th style="text-align: center">Beginning Balance</th>
					            <th style="text-align: center">Quantity Issued(From KEMSA)</th>
					            <th style="text-align: center">Quantity Consumed</th>
					            <th style="text-align: center">Losses (Maybe destroyed)</th>
					            <th style="text-align: center">Positives (Received from other Facilities)</th>
					            <th style="text-align: center">Negatives (Issued out to other Facilities) </th>
					            <th style="text-align: center">End Month Physical Count</th>
					            <th style="text-align: center">Quantity Requested For Re-Supply</th>
					            <th style="text-align: center">Quantity Allocated</th>
					            <th style="text-align: center">Quantity Delivered</th>
					            <th style="text-align: center">Quantity Been Allocated</th>
					            <th style="text-align: center">Status</th>
					            <th style="text-align: center">Action</th>
					        </tr>
					         
						</thead>
						<tbody>
							
					    <?php if( @mysql_num_rows($rsallctn)==0)
                                 {
		                          
                                 } else { do {  $row_rsallctn['d']= @date('M-Y', strtotime($row_rsallctn['d']));
                                    if ($row_rsallctn['st']==0) {
                                 	    $row_rsallctn['st']='Awaiting Allocation';
									     } 
								?>      
								<tr class="odd gradeX">
								<td style="text-align: center"><?php echo $row_rsallctn['a']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['b']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['c']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['d']; ?></td> 
								<td style="text-align: center"><?php echo $row_rsallctn['e']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['q']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['f']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['l']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['p']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['n']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['g']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['h']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['al']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['r']; ?></td>
								<td style="text-align: center"><form method="post" action="<?php echo "addAllocation.php?id=" .urlencode($row_rsallctn['id']) ."&cid=" .$countyID."";?>"><input type="text" name="allocation" size="2" /><input type="image" align="right" src="../img/icons/sv.JPG" alt="Allocate" height="20"  width="18" title="Allocate"  ></form></td>
								
								<td style="text-align: center"><marquee length="80%" scrolldelay="300"><div class="label label-success"><?php echo $row_rsallctn['st']; ?></div></marquee></td>
								<td>
									<a href="editreport.php?month=<?php echo $previousmonth.'&year='.$currentyear.'&mfl='. $row_rsallctn['a'].'&nm='. $row_rsallctn['b'].'&id='.$countyID; ?>"><img src="../img/icons/edit.png" height="20" alt="Edit" title="Edit Patient Details "/>Edit</a> 
								</td>
								</tr>
				        <?php } while ($row_rsallctn = mysql_fetch_assoc($rsallctn)); } ?> 
								      
								       
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
<div class="row">
	<div class="col-md-9 col-md-offset-2">
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Inventory Adjustment for <?php echo date('Y'); ?>
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
					        <th style="text-align:center">Facility(Recording)</th>
					        <th style="text-align:center">Facility to</th>
					        <th style="text-align:center">Date of Receipt</th>
					        <th style="text-align:center">Cartridges</th>
					        <th style="text-align:center">Falcon Tubes</th>
					        <th style="text-align:center">Adjustment Type</th>
					        <th style="text-align:center">Edit</th>
					        <th style="text-align:center">Delete</th>
				        </tr>
					</thead>
					<tbody>
				   		
					<?php 
					if ($total1==0) {
						
												
						
					} else {
										
					
					   do
					    {
					   	    $code = $row['to_fac'];
							
							$sqlCN="SELECT facilitys.name AS cN 
							FROM facilitys
							WHERE
							facilitys.facilitycode='$code'";
							
							$qCN=mysql_query($sqlCN) or die(mysql_error());
							$rwCN=mysql_fetch_assoc($qCN);
							$fname = $rwCN['cN'];
					
						
					   	if ($row['adjustment']==0) {
							   $row['adjustment']='<div class="label label-secondary">Negative (Issue out)</div>';
						   } 
						else {
							   $row['adjustment']='<div class="label label-success">Positive (Received from other sites)</div>';
						   }
						   
					   	?>      
							<tr class="odd gradeX">
							<td style="text-align:center"> <?php echo $row['name'];; ?></td>
							<td style="text-align:center"> <?php echo $fname; ?></td>
							<td style="text-align:center"> <?php echo $row['date']= @date('d-M-Y', strtotime($row['date'])); ?></td> 
							<td style="text-align:center"> <?php echo $row['c_quantity']; ?></td>
							<td style="text-align:center"> <?php echo $row['f_quantity']; ?></td>
							<td style="text-align:center"> <?php echo $row['adjustment']; ?></td>
							<td>
								<a href="javascript:;" onclick="showAjaxModal(<?php echo $row['id']; ?>);"><img src="../img/icons/edit.png" height="20" alt="Edit" title="Edit Patient Details "/>Edit</a> 
							</td> 
							<td>  
								<a data-toggle="modal" data-target="#del_<?php echo $row['id']; ?>"><img src="../img/icons/erase.png" height="20" alt="Delete" title="Delete Sample Result"/>Delete</a>
							</td> 
							</tr>
							<!-- Modal for delete -->
							<div class="modal" id="del_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog">
								    <div class="modal-content" style="width: 700px">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title">Delete Sample <i class="entypo-attention"></i></h4>
								      </div>
								      <div class="modal-body">
								      	<div class="row">
									       <div class="col-md-12">
									       	<h5><label for="field3">Do you really want to delete the sample with the following details?</label></h5>
										   </div>
									   </div>
									   <div class="row">
										  <div class="col-md-5">
										   	<label for="field3">Facility: </label>
										   	<?php echo $fname; ?>
										   </div>
										   <div class="col-md-3">
										   	<label for="field3">Date: </label>
										   	<?php echo $row['date']; ?>
										   </div>
										   <div class="col-md-2">
										   	<label for="field3">Catridges: </label>
										   	<?php echo $row['c_quantity']; ?>
										   </div>
										   <div class="col-md-3">
										   	<label for="field3">Falcon Tubes: </label>
										   	<?php echo $row['f_quantity']; ?>
										   </div>
									  </div>
								      </div>
								      <div class="modal-footer">
								        <a <?php echo "href='deletestock.php?id=" .urlencode($row['id']) ."'";?>><button type="button" class="btn btn-danger">Delete Sample</button></a>
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
														
						<?php }  while ($row = mysql_fetch_assoc($rssam));
					} ?> 				
							     
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

<!-- Modal 7 (Ajax Modal)-->
<div class="modal fade" id="modal-7">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Profile</h4>
			</div>
			
			<div class="modal-body">
			
				<form name="inv2" id="inv2" class="TTWForm" method="POST" >
					    		<input type="hidden" name="id" id="id" />
								
					      <div class="form-group">
								<label class="col-sm-4 control-label">Adjustment Type:</label>
						  	 						
								<div class="col-sm-5">
									<select name="adj" id="adj" class="form-control" required>
									<option value="">Select Type</option>
								        <option value="1">Positive (Received from other facilities)</option>
								        <option value="0">Negative (Issued out to other facilities)</option>
							         </select>
							
								</div>
					
								<div class="clear"></div>
								<br />
							
								<label class="col-sm-4 control-label">Facility Type:</label>
						  	 						
								<div class="col-sm-4">
									<div class="radio radio-replace">
										<input type="radio" id="1" name="ftype" class="ftype" value="1" required="">
										<label>GeneSite (Facility with a GeneXpert Machine)</label>
									</div>
								<div class="clear"></div>
									<div class="radio radio-replace">
										<input type="radio" id="2" name="ftype" class="ftype" value="0">
										<label>Referral Facility</label>
									</div>
								</div>
								<div class="clear"></div>
								<br />
<script type="text/javascript">
    $(document).ready(function(){
     $('.ftype').click(function(){
         var div_id = $(this).attr('id');
         $('.my-div').hide(); 
         $('.me_'+div_id).show();   
     }); 

}); 
 </script>
                            <div  align="center" class="my-div me_1" style="display: none">
                            	<label class="col-sm-4 control-label">Facility From / To</label>
								
								<div class="col-md-4">								
									<select name="facility" id="facility" class="form-control" data-allow-clear="true" data-placeholder="Select One GeneSite Facility" >
									      <option></option>
									      <optgroup label="GeneSite Facilities">
									      <?php
											do { 
											?>
											      <option value="<?php echo $row_rsFinC['a']?>"><?php echo $row_rsFinC['b']; ?></option>
											      <?php
											} while ($row_rsFinC = mysql_fetch_assoc($rsFinC));
											  $rows = mysql_num_rows($rsFinC);
											  if($rows > 0) {
											      mysql_data_seek($rsFinC, 0);
												  $row_rsFinC = mysql_fetch_assoc($rsFinC);
											  }
											?>
											</optgroup>
									    </select>
									    
								</div>
								<div class="clear"></div>
							<br />
                            	
                            </div>
                            <div  align="center" class="my-div me_2" style="display: none" >
                            	<label class="col-sm-4 control-label">Facility From / To</label>
								
								<div class="col-md-4">	
																
									<select name="facility1" id="facility1" class="form-control" data-allow-clear="true" data-placeholder="Select One Referral Facility" >
									      <option></option>
									      <optgroup label="Referral Facilities">
									      <?php
											do { 
											?>
											      <option value="<?php echo $row_rsfacilitys['CODE']?>"><?php echo $row_rsfacilitys['FACILITY']; ?></option>
											      <?php
											} while ($row_rsfacilitys = mysql_fetch_assoc($rsfacilitys));
											  $rows = mysql_num_rows($rsfacilitys);
											  if($rows > 0) {
											      mysql_data_seek($rsfacilitys, 0);
												  $row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
											  }
											?>
											</optgroup>
									    </select>
									    
								</div>
								<div class="clear"></div>
							<br />
                            	
                            </div>
							
								
								<label class="col-sm-4 control-label">Date of Receipt / Issue out: </label>
								
								<div class="col-md-3">
									<div class="input-group">
										<input class="form-control datepicker" type="text" required data-format="yyyy-mm-dd" id="recdate2" name="recdate2" data-end-date="d" >
											<div class="input-group-addon">
												<a href="#">
												<i class="entypo-calendar"></i>
												</a>
											</div>
										</div>
								</div>
								<div class="clear"></div>
							<br />
							
							<label class="col-sm-4 control-label">Cartridges Received / Issue out: </label>
								
							<div class="col-md-2">
								<input type="text" required class="form-control" id="c_quantity" name="c_quantity" />	
							</div>
							
							<div class="clear"></div>
							<br />
							<label class="col-sm-4 control-label">Falcon Tubes Received / Issue out: </label>
								
							<div class="col-md-2">
								<input type="text" required class="form-control" id="f_quantity" name="f_quantity" />	
							</div>
							
							<div class="clear"></div>
							
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
	
	</div>
</div>
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
<script type="text/javascript">
	
		function update() {
		// alert($("#inv2").serialize());
		// exit;
		var that = this;
		        $.ajax({
		        	 
		                type: "POST",
		                url: "../updatestock.php",
		                data: $("#inv2").serialize(),
		                dataType:"json",
		                cache:false,
		                success: function(data) {
		                	window.location.href='viewconsumption.php';
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

	<script type="text/javascript">
$(document).ready(function() {

$('#btnsave').click(function() {
s = $('#allocation').val();
//alert(s);

        $.ajax({
        	 
                type: "POST",
                url: "../ajax_data/usergroup.php",
                data: 'id=' + s,
                cache: false,
                success: function(data) {
                    alert(data);
                    
                   var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-bottom-left",
					"onclick": null,
					"sdeDuration": "1000",
					"tihowDuration": "300",
					"himeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
				
				toastr.success("Group successfully added", "Save Response", opts);
                },
                error: function () {
                	document.getElementById('search').value = "";
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
				
				toastr.error("Could not enter data.Try Again", "Save Response", opts);
                }
            })
       
        }); // End of  keyup function

    }); // End of document.ready

 </script>

	


	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
    <script src="../admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
		
		
	</script>
	
</body>
</html>