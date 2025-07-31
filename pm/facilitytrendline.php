<?php 
$facility = $_GET['facility'];
$mwaka = $_GET['mwaka'];
?>
<html>
  <head>        
    <title>My First chart using FusionCharts XT - Using JavaScript</title>      
    <script src="../FusionCharts/FusionCharts.js"></script>
   
  </head>   
  <body>     
    <div id="chartContainer">FusionCharts XT will load here!</div>          
    <script type="text/javascript"><!--

      var myChart = new FusionCharts( "MSLine", "myChartId", "500", "200", "0" );

      myChart.setXMLUrl("../xml1/facilitytrendline.php?fid=<?php echo $facility."%26mwaka=".$mwaka ?>");

      myChart.render("chartContainer");      
    // -->  
    </script>      
  </body> 
</html>