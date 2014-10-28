<?php
include("ASHeader.php");
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlyes="SELECT COUNT(section3.computer) as yes FROM section3 WHERE section3.computer='Yes'" ;	
$queryyes=mysql_query($sqlyes,$conn ) or die(mysql_error());
$rsyes=mysql_fetch_assoc($queryyes);

$yes=$rsyes['yes'];
/* ****************************************************/
$sqlno="SELECT COUNT(section3.computer) as no FROM section3 WHERE section3.computer='No'";	
$queryno=mysql_query($sqlno,$conn ) or die(mysql_error());
$rsno=mysql_fetch_assoc($queryno);

$no=$rsno['no'];
/* ****************************************************/
$sqlpolyes="SELECT COUNT(section3.policy) as polyes FROM section3 WHERE section3.policy='Yes'" ;	
$querypolyes=mysql_query($sqlpolyes,$conn ) or die(mysql_error());
$rspolyes=mysql_fetch_assoc($querypolyes);

$polyes=$rspolyes['polyes'];
/* ****************************************************/
$sqlpolno="SELECT COUNT(section3.policy) as polno FROM section3 WHERE section3.policy='No'";	
$querypolno=mysql_query($sqlpolno,$conn ) or die(mysql_error());
$rspolno=mysql_fetch_assoc($querypolno);

$polno=$rspolno['polno'];
/* ****************************************************/	
$sqllisyes="SELECT COUNT(section3.lis) as lisyes FROM section3 WHERE section3.lis='Yes'" ;	
$querylisyes=mysql_query($sqllisyes,$conn ) or die(mysql_error());
$rslisyes=mysql_fetch_assoc($querylisyes);

$lisyes=$rslisyes['lisyes'];
/* ****************************************************/
$sqllisno="SELECT COUNT(section3.lis) as lisno FROM section3 WHERE section3.lis='No'";	
$querylisno=mysql_query($sqllisno,$conn ) or die(mysql_error());
$rslisno=mysql_fetch_assoc($querylisno);

$lisno=$rslisno['lisno'];
/* ****************************************************/
$sqlnetworklan="SELECT COUNT(section3.network) as networklan FROM section3 WHERE section3.network='LAN'" ;	
$querynetworklan=mysql_query($sqlnetworklan,$conn ) or die(mysql_error());
$rsnetworklan=mysql_fetch_assoc($querynetworklan);

$lan=$rsnetworklan['networklan'];
/* ****************************************************/
$sqlnetworkmodem="SELECT COUNT(section3.network) as networkno FROM section3 WHERE section3.network='Modem'";	
$querynetworkno=mysql_query($sqlnetworkmodem,$conn ) or die(mysql_error());
$rsnetworkno=mysql_fetch_assoc($querynetworkno);

$modem=$rsnetworkno['networkno'];
/* ****************************************************/
$sqlwireless="SELECT COUNT(section3.network) as wireless FROM section3 WHERE section3.network='wireless'";	
$querywireless=mysql_query($sqlwireless,$conn ) or die(mysql_error());
$rswireless=mysql_fetch_assoc($querywireless);

$wireless=$rswireless['wireless'];
/* ****************************************************/
$sqlyescon="SELECT COUNT(section3.net_connection) as yescon FROM section3 WHERE section3.net_connection='Yes'" ;	
$queryyescon=mysql_query($sqlyescon,$conn ) or die(mysql_error());
$rsyescon=mysql_fetch_assoc($queryyescon);

$yesconn=$rsyescon['yescon'];
/* ****************************************************/
$sqlnoconn="SELECT COUNT(section3.net_connection) as noconn FROM section3 WHERE section3.net_connection='No'";	
$querynoconn=mysql_query($sqlnoconn,$conn ) or die(mysql_error());
$rsnoconn=mysql_fetch_assoc($querynoconn);

 $noconn=$rsnoconn['noconn'];
 /* ****************************************************/
$sqldatalan="SELECT COUNT(section3.data) as datalan FROM section3 WHERE section3.data='LAN'" ;	
$querydatalan=mysql_query($sqldatalan,$conn ) or die(mysql_error());
$rsdatalan=mysql_fetch_assoc($querydatalan);

$lan1=$rsdatalan['datalan'];
/* ****************************************************/
$sqldatamodem="SELECT COUNT(section3.data) as datamodem FROM section3 WHERE section3.data='Modem'";	
$querydatamodem=mysql_query($sqldatamodem,$conn ) or die(mysql_error());
$rsdatamodem=mysql_fetch_assoc($querydatamodem);

$modem1=$rsdatamodem['datamodem'];
/* ****************************************************/
$sqlwireless1="SELECT COUNT(section3.data) as wireless1 FROM section3 WHERE section3.data='wireless1'";	
$querywireless1=mysql_query($sqlwireless1,$conn ) or die(mysql_error());
$rswireless1=mysql_fetch_assoc($querywireless1);

$wireless11=$rswireless1['wireless1'];
/* ****************************************************/
$sqlonlineyes="SELECT COUNT(section3.online) as onlineyes FROM section3 WHERE section3.online='Yes'" ;	
$queryonlineyes=mysql_query($sqlonlineyes,$conn ) or die(mysql_error());
$rsonlineyes=mysql_fetch_assoc($queryonlineyes);

$onlineyes=$rsonlineyes['onlineyes'];
/* ****************************************************/
$sqlonlineno="SELECT COUNT(section3.online) as onlineno FROM section3 WHERE section3.online='No'";	
$queryonlineno=mysql_query($sqlonlineno,$conn ) or die(mysql_error());
$rsonlineno=mysql_fetch_assoc($queryonlineno);

$onlineno=$rsonlineno['onlineno'];
/* ****************************************************/
$sql= "SELECT section3.facility AS MFL, facilitys.name AS FACILITY,section3.make AS MAKE, section3.serial AS SERIAL, section3.online AS LOCAL FROM section3,facilitys WHERE facilitys.facilitycode=section3.facility "  ;



$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table3 .= '<tr bgcolor="#CCC"><th style="text-align:center"><small>Mfl</small></th><th style="text-align:center"><small>
Make</small></th><th style="text-align:center"><small>
Make</small></th><th style="text-align:center"><small>Serial</small></th><th style="text-align:center"><small>Local Support</small></th>';
$dyn_table3 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table3 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$mfl=$row['MFL'];
$facility=$row['FACILITY'];	
$make=$row['MAKE'];	
$serial=$row['SERIAL'];
$local=$row['LOCAL'];
	
	
if ($i % 10000 == 0){ 
$dyn_table3 .= '<thead><tr class="odd gradeX"><th style="text-align:center"><small>Mfl</small></th><th style="text-align:center"><small>Facility</small></th><th style="text-align:center"><small>Make</small></th><th style="text-align:center"><small>Serial</small></th><th style="text-align:center"><small>Local Support</small></th></thead> <tbody>';

          $dyn_table3 .= '<td align="left"><small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $make . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $serial . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' .$local. '</small></td></tr>';
		    		   
		  
  
} 
else{
	      $dyn_table3 .= '<td align="left"> <small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $make . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $serial . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' .$local. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table3 .= '</tbody></table>';	
	
}

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
            <td width="25%">
             <div class="section-title" style="width:375px;float:left;">PC to run LIMS
             </div>
             </td>
              
            <td width="29%" >
             <div class="section-title" style="width:375px;float:left;">Policies on S/W Installation</div>
             </td>
    <td width="46%" >
             <div class="section-title" style="width:370px;float:left;">Existing LIMS</div>
             </td> 
    
             
             </tr>
     <tr>
     <td>
     <div id="chart"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartId", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/computer.php");
    myChart.render("chart");
    
   </script> 
</div>
<table  style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $yes ;?></td>
<td><a href="pcLimsY.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $no ;?></td>
<td><a href="pcLimsN.php">View</a></th>
</tr>



</table>
</td>

<td>
<div id="chartpol"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartpol", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/policy.php");
    myChart.render("chartpol");
    
   </script> 
</div>
<table align="center" style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $polyes ;?></td>
<td><a href="policyY.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $polno ;?></td>
<td><a href="policyN.php">View</a></th>
</tr>



</table>
</td>

<td>           
  <div id="chartlis"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChart", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/lis.php");
    myChart.render("chartlis");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $lisyes ;?></td>
<td><a href="">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $lisno ;?></td>
<td><a href="">View</a></th>
</tr>



</table>
</td>
 
</tr>
<tr>
            <td width="25%">
             <div class="section-title" style="width:375px;float:left;">Network Infrastructure </div>
             </td>
            <td width="29%" >
             <div class="section-title" style="width:375px;float:left;">Access to internet
             </div>
             </td>
    
     <td width="46%" >
             <div class="section-title" style="width:370px;float:left;"><strong>Mode of connecting to the Internet</strong></div>
             </td> 
             
             </tr>
     <tr>
     <td>
     <div id="chartnetInf"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartnetInf", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/netInf.php");
    myChart.render("chartnetInf");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">LAN</th>
<td style="text-align:center"><?php echo $lan ;?></td>
<td><a href="netLan.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Modem</th>
<td style="text-align:center"><?php echo $modem ;?></td>
<td><a href="netM.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">Wireless</th>
<td style="text-align:center"><?php echo $wireless ;?></td>
<td><a href="netW.php">View</a></th>
</tr>


</table>
</td>

<td>
<div style="vertical-align:top;" id="chartConn"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartConn", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/netConn.php");
    myChart.render("chartConn");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $yesconn ;?></td>
<td><a href="netIko.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $noconn ;?></td>
<td><a href="netNop.php">View</a></th>
</tr>



</table>
</td>

<td>           
  <div id="chartmodeConn"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartmodeConn", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/modeConn.php");
    myChart.render("chartmodeConn");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">LAN</th>
<td style="text-align:center"><?php echo $lan1 ;?></td>
<td><a href="modL.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Modem</th>
<td style="text-align:center"><?php echo $modem1 ;?></td>
<td><a href="modM.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">Wireless</th>
<td style="text-align:center"><?php echo $wireless11 ;?></td>
<td><a href="modW.php">View</a></th>
</tr>


</table>
</td>
 
</tr>
<tr>
            <td colspan="2">
             <div class="section-title" style="width:780px;float:left;">GeneXpert List
             </div>
             </td>
            
    
     <td width="46%" >
             <div class="section-title" style="width:370px;float:left;">Local Support</div>
             </td> 
             
             </tr>
<tr>
<td colspan="2">
 <div id="demo" align="center">

		<?php
		echo $dyn_table3;
		?>
</div>
</td>
<td>
<div style="vertical-align:top;" id="chartlocal"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartlocal", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/local.php");
    myChart.render("chartlocal");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Yes</th>
<td style="text-align:center"><?php echo $onlineyes ;?></td>
<td><a href="">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $onlineno ;?></td>
<td><a href="">View</a></th>
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