<?php 
$facility= $_GET['facility']; 
?>
<html>
  <head>        
    <title>My First chart using FusionCharts XT - Using JavaScript</title>      
    <script src="../FusionCharts/FusionCharts.js"></script>
   
  </head>   
  <body>  
  	<div id="chartdivperfomance"  align="center"> </div>   
    <script type="text/javascript">
    
		var myChart = new FusionCharts("StackedColumn2DLine", "myChartId", "500", "200", "0", "0");
	    myChart.setXMLUrl("../xml1/geneperfomance.php?fid=<?php echo $facility; ?>");
	    myChart.render("chartdivperfomance");
			    
	</script>     
         
  </body> 
</html>