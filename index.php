<?php
include("header.php");
$mfl=$_SESSION['mfl'];
require_once('connection/db.php'); 

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

<div class="main-content" style="">
<div class="row">
		
	<div class="col-sm-3">
	
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $testdonethismonth; ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>Tests Done</h3>
			<p>this month.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-basket"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $remainingcarts; ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Remaining Cartridges</h3>
			<p>so far from the inventory.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-calendar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $expdate; ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
			
			<h3>Remaining Days</h3>
			<p>to cartridges expiration.</p>
		</div>
		
	</div>
	
	<div class="col-sm-3">
	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-volume"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $remainingtubes; ?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
			
			<h3>Remaining F.Tubes</h3>
			<p>so far from the inventory..</p>
		</div>
		
	</div>
</div>
<div class="row">
	
	<div class="col-sm-8">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Test Trends for Year: 
						<br />
						<small>2014</small>
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
				<strong>Today's worksheet-<?php echo "<b>". @date("l, d F Y")."</b>";?></strong>
			</p>
			<p>
				<small>
              There are <?php echo "[".$todayswork."]" ;?> sample(s) that have been processed today. 
               <?php if (($todayswork)>0){ echo "Click <strong><a href='mpdf/worksheet.php?id=$mfl'><font color='#000000' >HERE </font></a></strong> to view the samples."; }  ?><strong>
             </small>
            </p>
            </blockquote>
  </div>
  
  <!--<div class="col-md-4">
		
			
		<blockquote class="blockquote-green">
			<p>
				<strong>Updated Samples</strong>
			</p>
			<p>
				<small><?php echo "[".$complete."]" ;?> sample(s) ha(s/ve) been updated.Click <strong><a href="allsampleview.php">HERE</a></strong> to view.
             </small>
             </p>
        </blockquote>
  </div>
  <div class="col-md-4">
		
			
		<blockquote class="blockquote-danger">
			<p>
				<strong>Samples with Errors</strong>
			</p>
			<p>
				<small><?php echo "[".$errors."]" ;?> sample(s) ha(s/ve) been updated and Resulted with <strong>ERRORS</strong>.Click <strong><a href="sampleErr.php">HERE</a></strong> to view.
             </small>
             </p>
        </blockquote>
  </div>-->
  <div class="col-md-4">
		
			
		<blockquote class="blockquote-danger">
			<p>
				<strong>Samples(MTB+ / RIF+)</strong>
			</p>
			<p>
				<small><?php echo "[".$mtbrif."]" ;?> sample(s) ha(s/ve) Resulted as <strong>MTB+/RIF Resistant</strong>.<?php if ($mtbrif==0) {
					
				} else { ?>
					
					Click <strong><a href="mtbpos.php">HERE</a></strong> to view.
				<?php }
				 ?> 
             </small>
             </p>
        </blockquote>
  </div>
  
</div>
<div class="row">
   <table class="table table-bordered">
  	<tr>
  		<td align="center"><strong>Genexpert Serial Number : </strong> <div class="label label-info"><?php echo $SN ;?> </div></td>
  		
  		<td align="center"><strong>Number of Tests Done : </strong><div class="label label-success"> <?php echo $TT ;?></div></td>
  		
  	</tr>
  </table> 

</div>

<div class="row">
	
	<div class="col-sm-8">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						GeneXpert Performance [<?php echo $SN ;?>]
						<br />
						<small>Tests done: <?php echo $TT ;?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivperfomance"  align="center"> 
         		<script type="text/javascript">
      			var myChart = new FusionCharts("FusionCharts/Charts/StackedColumn2D.swf", "myChartId", "650", "280", "0", "0");
			    myChart.setDataURL("xml1/geneperfomance.php<?php echo "?fid=".$FacID;?>");
			    myChart.render("chartdivperfomance");
			    
			   </script> 
			</div>
          </div>
		</div>
		
	</div>
	<!--<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary Per Module
						<br />
						<small><?php echo $title; ?></small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">A1</td>
					<td  style="text-align:center">A2</td>
					<td  style="text-align:center">A3</td>
					<td  style="text-align:center">A4</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># of Tests</td>
					<td style="text-align:center"><?php echo $module[0] ;?></td>
					<td style="text-align:center"><?php echo $module[1];?></td>
					<td style="text-align:center"><?php echo $module[2] ;?></td>
					<td style="text-align:center"><?php echo $module[3] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center"># of Errors</td>
					<td style="text-align:center"><?php echo $module[4] ;?></td>
					<td style="text-align:center"><?php echo $module[5] ;?></td>
					<td style="text-align:center"><?php echo $module[6] ;?></td>
					<td style="text-align:center"><?php echo $module[7] ;?></td>
					</tr>
					<tr>
					<td style="text-align:center">% of Errors</td>
					<td style="text-align:center"><?php if ($module[4]==0){ echo (0)."%" ;} else {echo round((($module[4]/$module[0])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[5]==0){ echo (0)."%" ;} else {echo round((($module[5]/$module[1])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[6]==0){ echo (0)."%" ;} else {echo round((($module[6]/$module[2])*100),1)."%";}?></td>
					<td style="text-align:center"><?php if ($module[7]==0){ echo (0)."%" ;} else {echo round((($module[7]/$module[4])*100),1)."%";}?></td>
					</tr>
					</tbody>
					</table> 
		</div>

	</div>-->
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