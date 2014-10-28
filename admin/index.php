
<?php 
require_once('../connection/db.php'); 
@session_start();
if($_SESSION['nm']==""){
//redirect to login page
@header("location:../dlt_login.php");

}

$todaydate=@date("d");
$currentM=@date("m");
$currentyr=@date("Y");
$sql="SELECT 
(
   SELECT count(*) FROM facilitys
)AS facilities, 
(
SELECT COUNT(*) FROM activitylog where activity='login' AND MONTH(tym)='$currentM' AND YEAR(tym)='$currentyr' AND DAY(tym)='$todaydate'
)AS log,
(
SELECT count(*)  FROM user
)AS users";
$rs = mysql_query($sql) or die(mysql_error());
$rows = mysql_fetch_assoc($rs);

$sql1="SELECT distinct a.groupName,count(b.category) FROM usergroup a,user b where a.usergroupID=b.category group by category";
$rs1 = mysql_query($sql1) or die(mysql_error());
$rows1 = mysql_fetch_array($rs1);

$query_rssample = "SELECT a.uname as b,a.activity as c,b.groupName as d, a.tym as e FROM activitylog a, usergroup b WHERE a.ugroup=b.usergroupID GROUP BY a.ID DESC";
$rssample = mysql_query($query_rssample) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);

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
	<div class="col-sm-3">
	
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $rows['users'] ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Registered Users</h3>
			<p>so far in our website.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			 <div class="num" data-start="0" data-end="70" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>GeneXpert Sites</h3>
			<p>in the country.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-mail"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $rows['log'] ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
			
			<h3>Access Logs</h3>
			<p>attempted today.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-rss"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $rows['facilities'] ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
			
			<h3>Registered Facilities</h3>
			<p>in the country.</p>
		</div>
		
	</div>
</div>

<br />

<div class="row">
	<div class="col-sm-8">
	
		<div class="panel panel-primary" id="charts_env">
		
			<div class="panel-heading">
				<div class="panel-title">Site Login / Logout Stats</div>
				
				
			</div>
	
			<div class="panel-body">
			   <div id="chartdivtrendd"  align="center"> 
				 <script type="text/javascript">
				    var myChart = new FusionCharts("../FusionCharts/Charts/MSLine.swf", "myChartId", "650", "210", "0", "0");
				    myChart.setDataURL("logtrend.php");
				    myChart.render("chartdivtrendd");
				 </script> 
								
			</div>

				</div>				
		</div>	

	</div>

	<div class="col-sm-4">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Real Time Stats
						<br />
						<small>current system users</small>
					</h4>
				</div>
				
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


<br />

<div class="row">
	
	
	<div class="col-sm-12">
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Recent System Logs</div>
				
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
						<th>#</th>
						<th>Name</th>
						<th>Position</th>
						<th>Activity</th>
						<th>Time of Activity</th>
					</tr>
				</thead>
				
				<tbody>
					<?php do { ?>
					<tr>
						<td><label class="cb-wrapper">
<input id="chk-2" type="checkbox">
<div class="checked"></div>
</label></td>
						<td><?php echo $row_rssample['b']; ?></td>
						<td><?php echo $row_rssample['d']; ?></td>
						<td><?php echo $row_rssample['c']; ?></td>
						<td><?php echo $row_rssample['e']; ?></td>
					</tr>
					<?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?>
					
				</tbody>
			</table>
		</div>
		
	</div>
	
</div>

<br />


<script type="text/javascript">
	// Code used to add Todo Tasks
	jQuery(document).ready(function($)
	{
		var $todo_tasks = $("#todo_tasks");
		
		$todo_tasks.find('input[type="text"]').on('keydown', function(ev)
		{
			if(ev.keyCode == 13)
			{
				ev.preventDefault();
				
				if($.trim($(this).val()).length)
				{
					var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white"><input type="checkbox" /><label>'+$(this).val()+'</label></div></li>');
					$(this).val('');
					
					$todo_entry.appendTo($todo_tasks.find('.todo-list'));
					$todo_entry.hide().slideDown('fast');
					replaceCheckboxes();
				}
			}
		});
	});
</script>

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
	
	
</body>
</html>