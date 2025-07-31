<?php
require_once('../connection/db.php');

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
AND `facilitys`.`facilitycode` <11000
 ";
$rssample=mysqli_query($dbConn,$sql, $ntrl);
$row_rssample = @mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>DLTLD | Dashboard</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

<script type="text/javascript">
function showAjaxModal()
{
	jQuery('#modal-7').modal('show', {backdrop: 'static'});
	
	jQuery.ajax({
		url: "fac.php",
		success: function(response)
		{
			jQuery('#modal-7 .modal-body').html(response);
		}
	});
}
</script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387506872: Neon - Responsive Admin Template created by Laborator -->
</head>
<body class="page-body page-fade">

<div class="page-container">	
	
<div class="sidebar-menu fixed">
	
		<header class="logo-env">
		
		<!-- logo -->
		<div class="logo">
			<a href="index.php">
				<img src="../img/logo3.png" class="img-responsive" alt="Responsive image"/>
			</a>
		</div>
		
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
			<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
				<i class="entypo-menu"></i>
			</a>
		</div>
						
		
		<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
		<div class="sidebar-mobile-menu visible-xs">
			<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
				<i class="entypo-menu"></i>
			</a>
		</div>
		
	</header>
		
<ul id="main-menu" class="">
								
	<li>
			<a href="index.php"><i class="entypo-gauge"></i><span>Dashboard</span></a>
	
	</li>
	<li>
							<a >
								<i class="entypo-bag"></i><span>Samples</span>
							</a>
							
							<ul style="width: 100%">
								<li>
									<a href="sampleview.php"><span><i class="entypo-suitcase"></i></span><span>Sample List</span><span class="badge badge-info" style="float: right;" ><?php echo $notup ;?></span></a>
								</li>
								<li>
									<a href="allsampleview.php"><span><i class="entypo-suitcase"></i></span><span>Complete Records</span><span class="badge badge-success" style="float: right;" ><?php echo $complete ;?></span></a>
							    </li>
							    <li>
									<a href="sampleErr.php"><span><i class="entypo-suitcase"></i></span><span>Error Records</span><span class="badge badge-danger" style="float: right;"><?php echo $errors ;?></span></a>
							    </li>
							</ul>
						</li>

	<li>
		<a>
			<i class="entypo-user"></i><span>Users</span>
	    </a>
		

		<ul>
		<li>
			<a href="userlog.php"><span>Add/View Users</span></a>
		</li>

		<li>
			<a href="usergp.php"><span>Add/View UserGroups</span></a>
		</li>

		</ul>

    </li>

	

	<li>
		<a href=""><i class="entypo-bag"></i><span>Extra</span><span class="badge badge-info badge-roundless">New Items</span></a>
		

		<ul>
		<li>
			<a href=""><span>County</span><span class="badge badge-success">47</span></a>
		
			<ul>
				<li>
					<a href="addfacility.php"><span>Facilities</span></a>
			    </li>
			    
           </ul>

       </li>

		
		<li>
			<a href=""><span>GeneXpert Sites</span></a>
			<ul>
				<li>
						<a href=""><span>GeneXpert Sites</span></a>
				</li>
			</ul>

		</li>

		<li>
			<a href=""><span>Change Password</span></a>
		</li>

		

		</ul>

</li>

</ul>
			
		
</div>	
	<div class="main-content" style="margin-top: -1%">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="../img/logo.png" class="img-responsive" />
				</a>
		    </li>
		
		</ul>
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			<li>
				<?php
					date_default_timezone_set('Europe/Moscow');
					
					$script_tz = date_default_timezone_get();
?>
<?php echo "<b>". @date("l, d F Y");?> <li class="sep"></li> Welcome <img src="../img/icons/users.png" height="15" /><?php echo  $_SESSION['nm'];?> 
		
			</li>
					
			<li class="sep"></li><br>
			
			<li style="float: right"><a href="../logout.php">Log Out <i class="entypo-logout right"></i></a></li>
		</ul>
		
	</div>
	
</div>

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
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">All Facilities In The Country</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
				
			<table class="table table-bordered" id="table-1">
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
					<?php do {
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
							<a class="btn btn-default btn-sm btn-icon icon-left" href="javascript:;" onclick="showAjaxModal();">
							<i class="entypo-pencil"></i>
							Edit
							</a>
							
							<a class="btn btn-info btn-sm btn-icon icon-left" href="#">
							<i class="entypo-info"></i>
							Profile
							</a>
						</td>
					</tr>
					<?php } while ($row_rssample = mysqli_fetch_assoc($rssample)); ?>
					
				</tbody>
			</table>
		</div>
		
	</div>
	
</div>

<!-- Modal 7 (Ajax Modal)-->
<div class="modal fade" id="modal-7">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Dynamic Content</h4>
			</div>
			
			<div class="modal-body">
			
				Content is loading...
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info">Save changes</button>
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
	

	<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-9"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
	
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