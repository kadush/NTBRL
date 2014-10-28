<?php
include("header.php");
$mfl=$_SESSION['mfl'];
$sql4="SELECT 
			consumption.commodity AS a1,
			consumption.b_bal AS a,
			consumption.quantity AS b,
			consumption.quantity_used AS c,
			consumption.losses as d,
			consumption.pos as e,
			consumption.neg as f,
			consumption.end_bal AS g,
			consumption.q_req AS h,
			consumption.allocated AS i,
			consumption.date AS j
			FROM `consumption`
			WHERE 
			`consumption`.`facility`='$mfl' GROUP BY consumption.date,consumption.commodity";
$rssample = mysql_query($sql4, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);
?>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content">

<div class="row">
	
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo  $_SESSION['facility'];  ?> Consumption Report
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
						<th style="text-align:center">Commodity </th>
			            <th style="text-align:center">Beginning Balance </th>
			            <th style="text-align:center">Quantity Received (From Partners)</th>
			            <th style="text-align:center">Quantity Used</th>
			            <th style="text-align:center">Losses (Maybe destroyed)</th>
			            <th style="text-align:center">Positives (Received from other sources)</th>
			            <th style="text-align:center">Negatives (Issued Out) </th>
			            <th style="text-align:center">Ending Balance</th>
			            <th style="text-align:center">Quantity Requested</th>
			            <th style="text-align:center">Quantity Allocated</th>
			            <th style="text-align:center">Reporting Period</th>
			         </tr>
				</thead>
				<tbody>
				   <?php do {  $row_rssample['j']= @date('M-Y', strtotime($row_rssample['j']));?>      
					 <tr class="odd gradeX">
						<td style="text-align:center"> <?php echo $row_rssample['a1']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['a']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['b']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['c']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['d']; ?></td> 
						<td style="text-align:center"> <?php echo $row_rssample['e']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['f']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['g']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['h']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['i']; ?></td>
						<td style="text-align:center"> <?php echo $row_rssample['j']; ?></td>
					
					</tr>
			      <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
			      
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
	
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
     <script src="admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
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