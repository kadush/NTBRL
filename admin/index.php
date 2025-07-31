
<?php 
include("Asidebar.php");

$todaydate=@date("d");
$currentM=@date("m");
$currentyr=@date("Y");
$sql="SELECT 
(
   SELECT count(*) FROM facilitys
)AS facilities, 
(
SELECT COUNT(distinct uname) FROM activitylog where activity='login' AND MONTH(tym)='$currentM' AND YEAR(tym)='$currentyr' AND DAY(tym)='$todaydate' 
)AS log,
(
SELECT count(*)  FROM user
)AS users,
(
SELECT count(ID) FROM facilitys where genesite=1
)AS devices";
$rs = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn)());
$rows = mysqli_fetch_assoc($rs);

$sql1="SELECT distinct a.groupName,count(b.category) FROM usergroup a,user b where a.usergroupID=b.category group by category";
$rs1 = mysqli_query($dbConn,$sql1) or die(mysqli_error($dbConn)());
$rows1 = mysqli_fetch_array($rs1);

$query_rssample = "SELECT a.uname as b,a.activity as c,b.groupName as d, a.tym as e,a.facility as f FROM activitylog a, usergroup b WHERE a.ugroup=b.usergroupID AND MONTH(a.tym)='$currentM' AND YEAR(a.tym)='$currentyr' ORDER BY a.ID DESC";
$rssample = mysqli_query($dbConn,$query_rssample) or die(mysqli_error($dbConn)());
$row_rssample = mysqli_fetch_assoc($rssample);

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
	<div class="col-sm-3">
	<a href="userlog.php">
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $rows['users'] ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Registered Users</h3>
			<p>so far in our website.</p>
		</div>
	</a>	
	</div>
	
	<div class="col-sm-3">
	<a href="facility.php">
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			 <div class="num" data-start="0" data-end="<?php echo $rows['devices'] ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>GeneXpert Devices</h3>
			<p>in the country.</p>
		</div>
	</a>	
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
	<a href="facility.php">
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-rss"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $rows['facilities'] ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
			
			<h3>Facilities</h3>
			<p>in the country.</p>
		</div>
	</a>	
	</div>
</div>

<br />

<div class="row">
	<div class="col-sm-8">
	
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">Site Login / Logout Stats</div>
				
				
			</div>
	
			<div class="panel-body">
			   <div id="chartdivtrendd"  align="center"> 
				 <script type="text/javascript">
				    var myChart = new FusionCharts("MSLine", "myChartId", "640", "210");
				    myChart.setDataURL("logtrend.php");
				    myChart.render("chartdivtrendd");
				 </script> 
								
			</div>

				</div>				
		</div>	

	</div>

	<div class="col-sm-4">

		<div class="panel panel-gradient" data-collapsed="0">
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
					<?php } while ($rows1 = mysqli_fetch_array($rs1)); ?>			
			</div>
		</div>

	</div>
</div>


<br />

<div class="row">
	
	
	<div class="col-sm-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
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
						<th>Facility</th>
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
						<td><?php echo $row_rssample['f']; ?></td>
						<td><?php echo $row_rssample['d']; ?></td>
						<td><?php echo $row_rssample['c']; ?></td>
						<td><?php echo $row_rssample['e']; ?></td>
					</tr>
					<?php } while ($row_rssample = mysqli_fetch_assoc($rssample)); ?>
					
				</tbody>
			</table>
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