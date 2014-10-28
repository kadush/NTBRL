<?php
include("header.php");
require_once('connection/db.php'); 
$mfl=$_SESSION['mfl'];
?>


	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="FusionCharts/JSClass/FusionCharts.js"></script>
    <script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-9"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content" style="margin-top: 10%;">

<div class="row">
	
	<div class="col-sm-8">
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Test Trends for Year: 
						<br />
						<small>2013</small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivtrendd"  align="center"> 
         		<script type="text/javascript">
      			var myChart = new FusionCharts("FusionCharts/Charts/MSLine.swf", "myChartId", "650", "280", "0", "0");
			    myChart.setDataURL("xml1/facilitytrendline.php<?php echo "?fid=".$FacID;?>");
			    myChart.render("chartdivtrendd");
			    
			   </script> 
			</div>
          </div>
		</div>
		
	</div>
 <div class="col-md-4">
		
			
		<blockquote class="blockquote-gold">
			<p>
				<strong>Quick Links</strong>
			</p>
			<p>
				<small>You have  <?php echo "(".$total1.")" ;?> sample(s) awaiting patients details. ☐ To enter the details, Click <strong><a href="sampleview.php">HERE</a></strong>  OR Click <strong>Add Patient Details</strong>  on the sidebar on the left hand side of your screen or
               <strong>Samples</strong> then <strong>Sample List</strong> on the MENU bar.
             </small>
             </p>
        </blockquote>
  </div>
  
  <div class="col-md-4">
		<blockquote class="blockquote-gold">
			<p>
				<strong>Today's worksheet-<?php echo "<b>". @date("l, d F Y")."</b>";?></strong>
			</p>
			<p>
				<small>
              There are <?php echo "(".$todayswork.")" ;?> samples that have been processed today. 
               <?php if ($todayswork!=0){ echo "Click <strong><a href='pdf/worksheet.php?id=$mfl'><font color='#000000' >HERE </font></a></strong> to view the samples."; }  ?><strong>
             </small>
            </p>
  </div>
             
		
		
	</div>
	


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