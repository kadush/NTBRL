<?php
include("ASHeader.php");
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sql="SELECT SUM(section2.tbpermonth) as tb, SUM(section2.mtb) as mtb,SUM(section2.cumulative) as cumulative,SUM(section2.hiv) as hiv FROM  section2";	
$query=mysql_query($sql,$conn ) or die(mysql_error());
$rs=mysql_fetch_assoc($query);

$cumulative=$rs['cumulative'];
$tb=$rs['tb'];
$mtb=$rs['mtb'];
$hiv=$rs['hiv'];
/* ****************************************************/	
$sql5="SELECT count(section2.followup) as follow1 FROM `section2` WHERE section2.followup='Patients told to come back on certain date'";	
$query5=mysql_query($sql5,$conn ) or die(mysql_error());
$rs5=mysql_fetch_assoc($query5);

$follow1=$rs5['follow1'];
/* ****************************************************/		
$sql2="SELECT count(section2.followup) as follow2 FROM `section2` WHERE section2.followup='Contacted via phone when results are in'";	
$query2=mysql_query($sql2,$conn ) or die(mysql_error());
$rs2=mysql_fetch_assoc($query2);

$follow2=$rs2['follow2'];
/* ****************************************************/	
$sql3="SELECT count(section2.followup) as follow3 FROM `section2` WHERE section2.followup='Health workers find them during outreach session'";	
$query3=mysql_query($sql3,$conn ) or die(mysql_error());
$rs3=mysql_fetch_assoc($query3);

$follow3=$rs3['follow3'];

/* ****************************************************/	
$sql4="SELECT count(section2.followup) as follow4 FROM `section2` WHERE section2.followup='Wait for patients to come back to facility'";	
$query4=mysql_query($sql4,$conn ) or die(mysql_error());
$rs4=mysql_fetch_assoc($query4);

$follow4=$rs4['follow4'];
/* ****************************************************/
$sqlhivtest="SELECT count( section2.hivtest ) AS Yes FROM `section2`
WHERE section2.hivtest = 'Yes'";	
$queryhivtest=mysql_query($sqlhivtest,$conn ) or die(mysql_error());
$rshivtest=mysql_fetch_assoc($queryhivtest);

$hivtestyes=$rshivtest['Yes'];

		
$sql1hivtest="SELECT count(section2.hivtest) as no FROM `section2` WHERE section2.hivtest='No'";	
$query1hivtest=mysql_query($sql1hivtest,$conn ) or die(mysql_error());
$rs1hivtest=mysql_fetch_assoc($query1hivtest);

$hivtestno=$rs1hivtest['no'];
/* ****************************************************/
$sqltbyes="SELECT count(section2.tbtest) as tbyes FROM `section2` WHERE section2.tbtest='Yes'";	
$querytbyes=mysql_query($sqltbyes,$conn ) or die(mysql_error());
$rstbyes=mysql_fetch_assoc($querytbyes);

  $tbyes=$rstbyes['tbyes'];
		
$sqltbno="SELECT count(section2.tbtest) as tbno FROM `section2` WHERE section2.tbtest='tbno'";	
$querytbno=mysql_query($sqltbno,$conn ) or die(mysql_error());
$rstbno=mysql_fetch_assoc($querytbno);

  $tbno=$rstbno['tbno'];

?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
            <table>
            <tr>
            <td width="31%">
             <div class="section-title" style="width:338px;float:left;">TB patients vs MDR-TB Patients
             </div>
             </td>
            <td width="31%" >
             <div class="section-title" style="width:338px;float:left;">Summary Statistics(Tb v Mtb)</div>
             </td>
    
     <td width="41%" >
             <div class="section-title" style="width:445px;float:left;">Challenges in TB Care
             </div>
             </td> 
             
             </tr>
     <tr>
     <td>
     <div id="chart"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/tbVmtb.php");
    myChart.render("chart");
    
   </script> 
</div>
</td>

<td>
<table width="92%" class="data-table">
<tr>
<th style="text-align:center" width="68%">Cumulative No. of patients</th>
<td width="32%" style="text-align:center"><?php echo $cumulative ;?></td>
</tr>
<tr>
<th style="text-align:center">TB Patients</th>
<td style="text-align:center"><?php echo $tb ;?></td>
</tr>
<tr>
<th style="text-align:center">MDR-TB patients</th>
<td style="text-align:center"><?php echo $mtb ;?></td>
</tr>
<tr>
<th style="text-align:center">HIV care patients</th>
<td style="text-align:center"><?php echo $hiv ;?></td>
</tr>


</table>
</td>

<td>           
  <div id="chartchal"  align="left"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Column2D.swf", "myChartId", "475", "250", "0", "0");
    myChart.setDataURL("../xml1/challenges.php");
    myChart.render("chartchal");
    
   </script> 
</div>
</td>
 
</tr>
<tr>
            <td width="31%">
             <div class="section-title" style="width:338px;float:left;">Mode of patients Follow-up</div>
             </td>
            <td width="31%" >
             <div class="section-title" style="width:338px;float:left;">Summary Statistics(follow up)
             </div>
             </td>
    
     <td width="41%" >
             <div class="section-title" style="width:445px;float:left;">Place of initiation of treatment</div>
             </td> 
             
             </tr>
     <tr>
     <td>
     <div id="chartfollow"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId", "280", "350", "0", "0");
    myChart.setDataURL("../xml1/followup.php");
    myChart.render("chartfollow");
    
   </script> 
</div>
</td>

<td>
<table width="92%" class="data-table">
<tr>
<th style="text-align:center" width="70%">Mode</th>
<th style="text-align:center"  width="15%"># of Site</th>
<th style="text-align:center" width="15%">Action</th>

</tr>
<tr>
<th style="text-align:center">Told  to come back on certain date</th>
<td style="text-align:center"><?php echo $follow1 ;?></td>
<td style="text-align:center"><a href="followup1.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Contacted via phone </th>
<td style="text-align:center"><?php echo $follow2 ;?></td>
<td style="text-align:center"><a href="followup2.php">View</a></td>
</tr>
<tr>
<th style="text-align:center"><p>During Outreach sessions</p></th>
<td style="text-align:center"><?php echo $follow3 ;?></td>
<td style="text-align:center"><a href="followup3.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Patients come back to facility</th>
<td style="text-align:center"><?php echo $follow4 ;?></td>
<td style="text-align:center"><a href="followup4.php">View</a></td>
</tr>

</table>
</td>

<td>           
  <div id="charttreat"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId", "380", "325", "0", "0");
    myChart.setDataURL("../xml1/treat.php");
    myChart.render("charttreat");
    
   </script> 
</div>
</td>
 
</tr>
</table>
<table>
<tr>
             <td colspan="2">
             <div class="section-title" style="width:577px;float:left;">TB patients given an HIV test?
             </div>
             </td>
            
    
      <td colspan="2">
             <div class="section-title" style="width:577px;float:left;">HIV patients given an TB test? 
             </div>
          
         </td> 
             </tr>
     <tr>
     <td> 
     <div id="charttbhiv"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId", "295", "170", "0", "0");
    myChart.setDataURL("../xml1/hivtest.php");
    myChart.render("charttbhiv");
    
   </script> 
</div>
</td>
<td>

<table width="272px" class="data-table">
<tr>
<th style="text-align:center" width="68%">Outcome</th>
<th style="text-align:center" width="32%"># of Patients</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $hivtestyes ;?></td>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $hivtestno ;?></td>
</tr>



</table>
</td>

<td>           
  <div id="charthiv"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId",  "295", "170", "0", "0");
    myChart.setDataURL("../xml1/tbtest.php");
    myChart.render("charthiv");
    
   </script> 
</div>
</td>
<td>
<table width="272px" class="data-table">
<tr>
<th style="text-align:center" width="68%">Outcome</th>
<th style="text-align:center" width="32%"># of Patients</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $tbyes ;?></td>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $tbno ;?></td>
</tr>



</table>
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