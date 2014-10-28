<?php 
require_once('../connection/db.php'); 
@session_start();
if($_SESSION['nm']==""){
//redirect to login page
@header("location:../dlt_login.php");
}
$sql1="SELECT distinct a.groupName,count(b.category) FROM usergroup a,user b where a.usergroupID=b.category group by category";
$rs1 = mysql_query($sql1) or die(mysql_error());
$rows1 = mysql_fetch_array($rs1);

mysql_select_db($database, $ntrl);
$query_rsUsergroup = "SELECT * FROM usergroup ORDER BY usergroup.usergroupID ";
$rsUsergroup = mysql_query($query_rsUsergroup, $ntrl) or die(mysql_error());
$row_rsUsergroup = mysql_fetch_array($rsUsergroup);


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




	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387506872: Neon - Responsive Admin Template created by Laborator -->
</head>
<body class="page-body page-fade">

<div class="page-container">	
	
<div class="sidebar-menu">
	
		<header class="logo-env">
		
		<!-- logo -->
		<div class="logo">
			<a href="index.php">
				<img src="../img/logo3.png" alt="" />
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
		<a href=""><i class="entypo-user"></i><span>Users</span></a>
		

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
	<div class="main-content" style="margin-top: -2%">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img <img src="../img/logo.png" alt="" />
					
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
<?php echo "<b>". date("l, d F Y");?> <li class="sep"></li> Welcome <img src="../img/icons/users.png" height="15" /><?php echo  $_SESSION['nm'];?> 
		
			</li>
					
			<li class="sep"></li><br>
			
			<li style="float: right"><a href="../logout.php">Log Out <i class="entypo-logout right"></i></a></li>
		</ul>
		
	</div>
	
</div>

<hr />
<div class="row">
		
			<div class="col-sm-6">
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Add New Group</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
					<div class="panel-body">
						
							<div class="form-group">
							<label class="col-sm-3 control-label" for="field-1">Usergroup</label>
							<div class="col-sm-5">
							<input name="usergroup" id="usergroup" class="form-control" type="text" placeholder="usergroup">
							</div>
							<button class="btn btn-success" type="button" id="btnsave" name="btnsave" >Save Group</button>
							</div>
						
					</div>	
				</div>
				
			</div>
		
			<div class="col-sm-6">
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Existing User Group/Current Number of Users</div>
						
						<div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div>
					</div>
						
					<div class="panel-body no-padding">
				<?php $class=array("primary"=>"1","info"=>"2","danger"=>"3","success"=>"4","warning"=>"5"); do { ?>
								<li class="list-group-item">
									<span class="badge badge-<?php  echo array_rand($class,1); ?>"><?php echo $rows1[1]; ?></span>
									<?php echo $rows1[0]; ?>
								</li>
					<?php } while ($rows1 = mysql_fetch_array($rs1)); ?>			
			</div>
				</div>
				
			</div>
			
		</div>
			
									
				
		
</div>
<script type="text/javascript">
$(document).ready(function() {

$('#btnsave').click(function() {
s = $('#usergroup').val();
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

<!-- Footer 
<footer class="main">
	
    <div class="pull-right">
		<?php 
		include '../includes/footer.php';
		?>
	</div>

</footer>-->
</div>


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
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
		
</body>
</html>