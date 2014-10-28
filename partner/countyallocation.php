<?php
include("header.php");
if (isset($_GET['id'])){
		$countyID = $_GET['id'];
		  
	}
@require_once('../connection/db.php'); 
mysql_select_db($database, $ntrl);
$sql= "SELECT 
`consumption`.`ID` AS id,
`consumption`.`facility` AS a,
`facilitys`.`name` AS b, 
`districts`.`name` AS c,
consumption.date AS d,
consumption.b_bal AS e,
consumption.quantity_used AS f,
consumption.end_bal AS g,
consumption.q_req AS h,
consumption.status AS st,
consumption.quantity AS q
FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND consumption.status=0
AND `countys`.`ID` = '$countyID'";
$rsallctn = mysql_query($sql, $ntrl) or die(mysql_error());
$row_rsallctn = mysql_fetch_assoc($rsallctn);

?>
<!DOCTYPE html>
<html lang="en">
	
	
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon//neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon//neon-x/assets/js/jquery-1.10.2.min.js"></script>
      

<div class="main-content" style="margin-top: 6%;margin-left: .3%">
 
<div class="row">
<?php include('ca.php'); ?>
	<div class="col-sm-9">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Genexpert County Allocation
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                 <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				<table class="table table-bordered" id="table-1">
						<thead>
							<tr>
								
					            <th style="text-align: center">Mfl</th>
					            <th style="text-align: center">Facility Name</th>
					            <th style="text-align: center">District</th>
					            <th style="text-align: center">Period</th>
					            <th style="text-align: center">Quantity Received</th>
					            <th style="text-align: center">Quantity Issued(From KEMSA)</th>
					            <th style="text-align: center">Quantity Consumed</th> 
					            <th style="text-align: center">End Month Physical Count</th>
					            <th style="text-align: center">Quantity Requested For Re-Supply</th>
					            <th style="text-align: center">Quantity Allocated</th>
					            
					            <th style="text-align: center">Status</th>
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
								<td style="text-align: center"><?php echo $row_rsallctn['g']; ?></td>
								<td style="text-align: center"><?php echo $row_rsallctn['h']; ?></td>
								<td style="text-align: center"><form method="post" action="<?php echo "addAllocation.php?id=" .urlencode($row_rsallctn['id']) ."&cid=" .$countyID."";?>"><input type="text" name="allocation" size="2" /><input type="image" align="right" src="../img/icons/sv.jpg" alt="Allocate" height="20"  width="18" title="Allocate"  ></form></td>
								
								<td style="text-align: center"><marquee length="80%" scrolldelay="300"><div class="label label-success"><?php echo $row_rsallctn['st']; ?></div></marquee></td>
								 
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