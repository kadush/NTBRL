window.onload = function() {
  var month = new Array("January", "February", "March", "April", "May", "June", "July",    "August", "September", "October", "November", "December");
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth();
  var currentMonth = month[mm];
  var yyyy = today.getFullYear();
  today = currentMonth + ' ' + dd + ', ' + yyyy;
  document.getElementById('test').innertext() = today;
}
<div class="col-sm-5">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						National Outcome For:
					<br />
						<small>'.$minY = GetMinYear().'-'.$maxY = GetMaxYear().'</small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding"><div class="panel-body" id="mapdiv">
				<script>
					$( "#mapdiv" ).load( "map.php" );
				</script>
			</div>
			</div>
		</div>

	</div>
	<div class="col-md-5">
		<div id="accordion-test-2" class="panel-group">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h4 class="panel-title">
		  <a href="#collapseOne" data-parent="#accordion-test-2" data-toggle="collapse"> Testing Trends For: 
					<br />
						<small><?php echo $currentyear; ?></small>
					
	      </a>
		</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		<div class="panel-body">
			<div id="chartdivtre2"> </div>
				   <script type="text/javascript">
					    var myChart = new FusionCharts("../FusionCharts/MSLine.swf", "myChartId10", "500", "250","0");
					    myChart.setXMLUrl("../xml1/nationaltrendline.php?mwaka=<?php echo $currentyear; ?>");
					    myChart.render("chartdivtre2");
				   </script>
			
		</div>
		</div>
		</div>
		<div class="panel panel-default">
		<div class="panel-heading">
		<h4 class="panel-title">
		<a href="#collapseTwo" data-parent="#accordion-test-2" data-toggle="collapse"> Testing Trends For: 
					<br />
						<small>'. $dt.'</small>
					
	     </a>
		</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
		<div class="panel-body">
			<div id="chartdivtre"> </div>
				   <script type="text/javascript">
				    var myChart = new FusionCharts("MSLine", "myChartId", "450", "200", "0");
				    myChart.setXMLUrl("../xml1/allyears.php");
				    myChart.render("chartdivtre");
				    
				   </script>  
			
		</div>
		</div>
		</div>
		
		</div>
</div>