<?php
include("ASHeader.php");
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sql="SELECT SUM(section5.ttest) as tt, SUM(section5.mtb) as mtb, SUM(section5.Rifampicin) as rif FROM  section5";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$tt=$rs['tt'];
$mtb=$rs['mtb'];
$rif=$rs['rif'];
/* ****************************************************/
$sqllab="SELECT COUNT(section5.workflow) as lab FROM section5 WHERE section5.workflow='Lab Register'" ;	
$querylab=mysql_query($sqllab,$conn ) or die(mysql_error());
$rslab=mysql_fetch_assoc($querylab);

$lab=$rslab['lab'];
/* ****************************************************/
$sqllims="SELECT COUNT(section5.workflow) as lims FROM section5 WHERE section5.workflow='LIMS'";	
$querylims=mysql_query($sqllims,$conn ) or die(mysql_error());
$rslims=mysql_fetch_assoc($querylims);

$lims=$rslims['lims'];
/* ****************************************************/
$sqloth="SELECT COUNT(section5.workflow) as oth FROM  section5 WHERE section5.workflow='LIMS'";		
$queryoth=mysql_query($sqloth,$conn ) or die(mysql_error());
$rsoth=mysql_fetch_assoc($queryoth);

$oth=$rsoth['oth'];
/* ****************************************************/
$sqlrifyes="SELECT COUNT(section5.rif) as rifyes FROM section5 WHERE section5.rif='Yes'" ;	
$queryrifyes=mysql_query($sqlrifyes,$conn ) or die(mysql_error());
$rsrifyes=mysql_fetch_assoc($queryrifyes);

  $rifyes=$rsrifyes['rifyes'];
/* ****************************************************/
$sqlrifno="SELECT COUNT(section5.rif) as rifno FROM section5 WHERE section5.rif='No'";	
$queryrifno=mysql_query($sqlrifno,$conn ) or die(mysql_error());
$rsrifno=mysql_fetch_assoc($queryrifno);

  $rifno=$rsrifno['rifno'];
?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
<style type="text/css" title="currentStyle">
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({"bJQueryUI":true});
			} );
		</script>
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
            <table>
            <tr>
            <td colspan="2">
             <div class="section-title" style="width:577px;float:left;">Sample processed in the last one year
             </div>
             </td>
              
           
    <td colspan="2" >
             <div class="section-title" style="width:577px;float:left;">Management of workflow</div>
             </td> 
    
             
             </tr>
     <tr>
     <td>
     <div id="chart1"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChart1", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/samples.php");
    myChart.render("chart1");
    
   </script> 
</div>
</td>
<td>
<div style="vertical-align:top;" >
<table style="width:285px; " class="data-table">
<tr>
<th style="text-align:center" width="33%">#</th>
<th  width="38%" style="text-align:center"># of Patients</th>
<th width="38%" style="text-align:center">Action</th>

</tr>
<tr> 
<th>Total Test</th>
<td style="text-align:center"><?php echo $tt ;?></td>
<td rowspan="3" style="text-align:center"><a href="samsum.php" >View</a></td>
</tr>
<tr>
<th>Mtb Detected</th>
<td style="text-align:center"><?php echo $mtb ;?></td>

</tr>
<tr>
<th>Rifampicin</th>
<td style="text-align:center"><?php echo $rif ;?></td>

</tr>


</table>
</div>
</td>



<td>           
  <div id="chartwf"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartwf", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/workflow.php");
    myChart.render("chartwf");
    
   </script> 
</div>
<td width="19%">

<div style="vertical-align:top;" >
<table style="width:300px;" class="data-table">
<tr>
<th style="text-align:center" width="43%">#</th>
<th width="23%" style="text-align:center"># of Sites</th>
<th style="text-align:center" width="34%">Action</th>
</tr>
<tr>
<th style="text-align:center">Lab Register</th>
<td style="text-align:center"><?php echo $lab ;?></td>
<th style="text-align:center"><a href="worklab.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">LIMS</th>
<td style="text-align:center"><?php echo $lims ;?></td>
<th style="text-align:center"><a href="worklims.php">View</a></th>
</tr>

<tr>
<th style="text-align:center">Others</th>
<td style="text-align:center"><?php echo $oth ;?></td>
<th style="text-align:center"><a href="workoth.php">View</a></th>
</tr>

</table>
</div>
</td>
 
</tr>
</table>
<table>
<tr>
            <td width="18%">
             <div class="section-title" style="width:375px;float:left;">Turn Around Time </div>
             </td>
            <td width="23%" >
             <div class="section-title" style="width:375px;float:left;">Results Relay Format
             </div>
             </td>
    
     <td width="23%" >
             <div class="section-title" style="width:375px;float:left;">Results From NTRL Recorded</div>
             </td> 
             
             </tr>
     <tr>
     <td>
     <div id="chartturn"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Bar2D.swf", "myChartturn", "320", "190", "0", "0");
    myChart.setDataURL("../xml1/turn.php");
    myChart.render("chartturn");
    
   </script> 
</div>

</td>

<td>
<div style="vertical-align:top;" id="chartFor"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartFor", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/format.php");
    myChart.render("chartFor");
    
   </script> 
</div>

</td>

<td>           
  <div id="chartrec"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartrec", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/record.php");
    myChart.render("chartrec");
    
   </script> 
</div>

</td>
 
</tr>
</table>
<table>
            <tr>
            <td colspan="2">
             <div class="section-title" style="width:577px;float:left;">Sputum Microscopy Cases</div>
             </td>
              
           
    <td colspan="2" >
             <div class="section-title" style="width:577px;float:left;">Rif cases referred to NTRL</div>
             </td> 
    
             
             </tr>
     <tr>
     <td colspan="2">
     <div id="chartmicro"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Column2D.swf", "myChartmicro", "550", "170", "0", "0");
    myChart.setDataURL("../xml1/micro.php");
    myChart.render("chartmicro");
    
   </script> 
</div>
</td>




<td>           
  <div id="chartrifcases"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartrifcases", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/rifcases.php");
    myChart.render("chartrifcases");
    
   </script> 
</div>
<td width="19%">

<div style="vertical-align:top;" >
<table style="width:260px;" class="data-table">
<tr>
<th style="text-align:center" width="33%">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th style="text-align:center"width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $rifyes ;?></td>
<th style="text-align:center"><a href="rify.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $rifno ;?></td>
<th style="text-align:center"><a href="rifn.php">View</a></th>
</tr>



</table>
</div>
</td>
 
</tr>
</table>
</div>

		
<div class="clearer">&nbsp;</div>

</div>
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>