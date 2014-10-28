<?php
include("ASHeader.php");
@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);
		
$sqlp="SELECT count(section6.responsible) as partner FROM `section6` WHERE section6.responsible='Partner Budget (specify which tests)'";	
$queryp=mysql_query($sqlp,$conn ) or die(mysql_error());
$rsp=mysql_fetch_assoc($queryp);

$partner=$rsp['partner'];
/* ****************************************************/		
$sqlc="SELECT count(section6.responsible) as partnercms FROM `section6` WHERE section6.responsible='CMS (KEMSA) (specify which tests)'";	
$queryc=mysql_query($sqlc,$conn ) or die(mysql_error());
$rsc=mysql_fetch_assoc($queryc);
$partnercms=$rsc['partnercms'];

/* ****************************************************/
$sqlpull="SELECT count(section6.distribution) as pull FROM `section6` WHERE section6.distribution='Pull System'";	
$querypull=mysql_query($sqlpull,$conn ) or die(mysql_error());
$rspull=mysql_fetch_assoc($querypull);

$pull=$rspull['pull'];
/* ****************************************************/		
$sqlpush="SELECT count(section6.distribution) as push FROM `section6` WHERE section6.distribution='Push System'";	
$querypush=mysql_query($sqlpush,$conn ) or die(mysql_error());
$rspush=mysql_fetch_assoc($querypush);

$push=$rspush['push'];
/* ****************************************************/
$sqlmonth="SELECT count(section6.timeframe) as month FROM `section6` WHERE section6.timeframe='monthly'";	
$querymonth=mysql_query($sqlmonth,$conn ) or die(mysql_error());
$rsmonth=mysql_fetch_assoc($querymonth);

$month=$rsmonth['month'];
/* ****************************************************/		
$sqlQ="SELECT count(section6.timeframe) as Quarterly FROM `section6` WHERE section6.timeframe='Quarterly'";	
$queryQ=mysql_query($sqlQ,$conn ) or die(mysql_error());
$rsQ=mysql_fetch_assoc($queryQ);

$Quarterly=$rsQ['Quarterly'];
/* ****************************************************/	
$sqlwk="SELECT count(section6.timeframe) as Weeklywk FROM `section6` WHERE section6.timeframe='Weekly'";	
$querywk=mysql_query($sqlwk,$conn ) or die(mysql_error());
$rswk=mysql_fetch_assoc($querywk);

$Weeklywk=$rswk['Weeklywk'];

/* ****************************************************/	
$sqlother="SELECT count(section6.timeframe) as other FROM `section6` WHERE section6.timeframe='Others'";	
$queryother=mysql_query($sqlother,$conn ) or die(mysql_error());
$rsother=mysql_fetch_assoc($queryother);

$other=$rsother['other'];
/* ****************************************************/
$sqlpart="SELECT count(section6.send) as part FROM `section6` WHERE section6.send='Partner'";	
$querypart=mysql_query($sqlpart,$conn ) or die(mysql_error());
$rspart=mysql_fetch_assoc($querypart);

$part=$rspart['part'];
/* ****************************************************/		
$sqlK="SELECT count(section6.send) as KEMSA FROM `section6` WHERE section6.send='KEMSA'";	
$queryK=mysql_query($sqlK,$conn ) or die(mysql_error());
$rsK=mysql_fetch_assoc($queryK);

$KEMSA=$rsK['KEMSA'];
/* ****************************************************/	
$sqlnp="SELECT count(section6.send) as NPHLS FROM `section6` WHERE section6.send='NPHLS'";	
$querynp=mysql_query($sqlnp,$conn ) or die(mysql_error());
$rsnp=mysql_fetch_assoc($querynp);

$NPHLS=$rsnp['NPHLS'];

/* ****************************************************/	
$sqlNTRL="SELECT count(section6.send) as NTRL FROM `section6` WHERE section6.send='NTRL'";	
$queryNTRL=mysql_query($sqlNTRL,$conn ) or die(mysql_error());
$rsNTRL=mysql_fetch_assoc($queryNTRL);

$NTRL=$rsNTRL['NTRL'];
/* ****************************************************/
$sqlyescon="SELECT COUNT(section6.contactperson) as yescon FROM section6 WHERE section6.contactperson='Yes'" ;	
$queryyescon=mysql_query($sqlyescon,$conn ) or die(mysql_error());
$rsyescon=mysql_fetch_assoc($queryyescon);

$yesconn=$rsyescon['yescon'];
/* ****************************************************/
$sqlnoconn="SELECT COUNT(section6.contactperson) as noconn FROM section6 WHERE section6.contactperson='No'";	
$querynoconn=mysql_query($sqlnoconn,$conn ) or die(mysql_error());
$rsnoconn=mysql_fetch_assoc($querynoconn);

$noconn=$rsnoconn['noconn'];
 /* ****************************************************/	
 
 $sqlSLB="SELECT COUNT(section6.XpertTracking) as SLB FROM section6 WHERE section6.XpertTracking='Stock ledger book'" ;	
$querySLB=mysql_query($sqlSLB,$conn ) or die(mysql_error());
$rsSLB=mysql_fetch_assoc($querySLB);

  $SLB=$rsSLB['SLB'];
/* ****************************************************/
$sqlElec="SELECT COUNT(section6.XpertTracking) as Elec FROM section6 WHERE section6.XpertTracking='Electronic system	'";	
$queryElec=mysql_query($sqlElec,$conn ) or die(mysql_error());
$rsElec=mysql_fetch_assoc($queryElec);

  $Elec=$rsElec['Elec'];
/* ****************************************************/
$sqlNot="SELECT COUNT(section6.XpertTracking) as Noty FROM section6 WHERE section6.XpertTracking='Not recorded	'";	
$queryNot=mysql_query($sqlNot,$conn ) or die(mysql_error());
$rsNot=mysql_fetch_assoc($queryNot);

  $Not=$rsNot['Noty'];
  /* ****************************************************/
$sql= "SELECT section6.facility AS MFL, facilitys.name AS FACILITY,section6.Kitsstored AS STORED, section6.Managed AS Managed  FROM section6,facilitys WHERE facilitys.facilitycode=section6.facility "  ;



$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table3 .= '<tr bgcolor="#CCC"><th style="text-align:center"><small>Mfl</small></th><th style="text-align:center"><small>
STORED</small></th><th style="text-align:center"><small>
STORED</small></th><th style="text-align:center"><small>Managed</small></th><th style="text-align:center"><small>Local Support</small></th>';
$dyn_table3 .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table3 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$mfl=$row['MFL'];
$facility=$row['FACILITY'];	
$STORED=$row['STORED'];	
$Managed=$row['Managed'];
$local=$row['LOCAL'];
	
	
if ($i % 10000 == 0){ 
$dyn_table3 .= '<thead><tr class="odd gradeX"><th><small>Mfl</small></th><th><small>Facility</small></th><th><small>Storage Area</small></th><th style="text-align:center"><small>Management & Dispensation to the Lab</small></th></thead> <tbody>';

          $dyn_table3 .= '<td align="left"><small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $STORED . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $Managed . '</small></td></tr>';
		  	   
		  
  
} 
else{
	      $dyn_table3 .= '<td align="left"> <small>' .$mfl . '</small></td>';
		  $dyn_table3 .= '<td align="left"><small>' .$facility . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $STORED . '</small></td>';
		  $dyn_table3 .= '<td align="left" ><small>' . $Managed . '</small></td></tr>';
		 
		           	
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
             <div class="section-title" style="width:375px;float:left;">Supplier of Xpert Reagents
             </div>
             </td>
              
            <td width="29%" >
             <div class="section-title" style="width:375px;float:left;">Distribution of Supplies</div>
             </td>
    <td width="46%" >
             <div class="section-title" style="width:370px;float:left;">TimeFrame for Push Delivery</div>
             </td> 
    
             
             </tr>
     <tr>
     <td>
     <div id="chartsup"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartsup", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/supplier.php");
    myChart.render("chartsup");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Partners</th>
<td style="text-align:center"><?php echo $partner ;?></td>
<td><a href="supP.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">CMS</th>
<td style="text-align:center"><?php echo $partnercms; ?></td>
<td><a href="supCM.php">View</a></th>
</tr>


</table>
</td>

<td>
<div id="chartdistr"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartdistr", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/distribution.php");
    myChart.render("chartdistr");
    
   </script> 
</div>
<table align="center" style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%">Action</th>
</tr>
<tr>
<th style="text-align:center">Pull System</th>
<td style="text-align:center"><?php echo $pull ;?></td>
<td><a href="pull.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">Push System</th>
<td style="text-align:center"><?php echo $push ;?></td>
<td><a href="push.php">View</a></th>
</tr>



</table>
</td>

<td>           
  <div id="charttm"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myCharttm", "380", "170", "0", "0");
    myChart.setDataURL("../xml1/timeframe.php");
    myChart.render("charttm");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%" style="text-align:center">Action</th>
</tr>
<tr>
<th style="text-align:center">Quarterly</th>
<td style="text-align:center"><?php echo $Quarterly ;?></td>
<td style="text-align:center" rowspan="5"><a href="tframe.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Monthly</th>
<td style="text-align:center"><?php echo $month ;?></td>

</tr>
<tr>
<th style="text-align:center">Weekly</th>
<td style="text-align:center"><?php echo $Weeklywk ;?></td>

</tr>
<tr>
<th style="text-align:center">Other</th>
<td style="text-align:center"><?php echo $other ;?></td>

</tr>


</table>
</td>
 
</tr>
<tr>
            <td width="25%">
             <div class="section-title" style="width:375px;float:left;">Receipient of Stock commodity Report </div>
             </td>
            <td width="29%" >
             <div class="section-title" style="width:375px;float:left;">Contact Person for Queries</div>
             </td>
    
     <td width="46%" >
             <div class="section-title" style="width:370px;float:left;">Interval of Updating Kits</div>
             </td> 
             
             </tr>
     <tr>
     <td>
     <div id="chartstock"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartstock", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/stock.php");
    myChart.render("chartstock");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%" style="text-align:center">Action</th>
</tr>
<tr>
<th style="text-align:center">PARTNER</th>
<td style="text-align:center"><?php echo $part ;?></td>
<td style="text-align:center" rowspan="5"><a href="rec.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">KEMSA</th>
<td style="text-align:center"><?php echo $KEMSA ;?></td>

</tr>
<tr>
<th style="text-align:center">NPHLS</th>
<td style="text-align:center"><?php echo $NPHLS ;?></td>

</tr>
<tr>
<th style="text-align:center">NTRL</th>
<td style="text-align:center"><?php echo $NTRL ;?></td>

</tr>


</table>
</td>

<td>
<div style="vertical-align:top;" id="chartcontact"  align="center"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartcontact", "280", "170", "0", "0");
    myChart.setDataURL("../xml1/contact.php");
    myChart.render("chartcontact");
    
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
<td><a href="co.php">View</a></th>
</tr>
<tr>
<th style="text-align:center">No</th>
<td style="text-align:center"><?php echo $noconn ;?></td>
<td><a href="cono.php">View</a></th>
</tr>



</table>
</td>

<td>           
  <div id="chartinterval"  align="center"> 
   <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartinterval", "380", "170", "0", "0");
    myChart.setDataURL("../xml1/interval.php");
    myChart.render("chartinterval");
    
   </script> 
</div>
<table style="width:385px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%" style="text-align:center">Action</th>
</tr>
<tr>
<th style="text-align:center">Quarterly</th>
<td style="text-align:center"><?php echo $Quarterly ;?></td>
<td style="text-align:center" rowspan="5"><a href="int.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Monthly</th>
<td style="text-align:center"><?php echo $month ;?></td>
</tr>
<tr>
<th style="text-align:center">Weekly</th>
<td style="text-align:center"><?php echo $Weeklywk ;?></td>

</tr>
<tr>
<th style="text-align:center">Other</th>
<td style="text-align:center"><?php echo $other ;?></td>

</tr>


</table>
</td>
 
</tr>
</table>
<table>
 <tr >
   <td colspan="2">
             <div align="center" class="section-title" style="width:855px; margin-left:150px;">Recording of Lab Commodities</div>
             </td>
             </tr>
<tr>
<td>
 <div id="chartrecComm"  align="center" style="margin-left:150px;"> 
         <script type="text/javascript">
      var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf", "myChartrecComm", "450", "170", "0", "0");
    myChart.setDataURL("../xml1/recComm.php");
    myChart.render("chartrecComm");
    
   </script> 
</div>
</td>
<td >
<div style="vertical-align:top;" >
<table style="width:400px;" class="data-table">
<tr>
<th width="33%" style="text-align:center">#</th>
<th width="38%" style="text-align:center"># of Sites</th>
<th width="29%" style="text-align:center"> Action</th>
</tr>
<tr> 
<th style="text-align:center">Stock ledger book</th>
<td style="text-align:center"><?php echo $SLB ;?></td>
<td rowspan="3" style="text-align:center"><a href="rlab.php">View</a></td>
</tr>
<tr>
<th style="text-align:center">Electronic system</th>
<td style="text-align:center"><?php echo $Elec ;?></td>

</tr>
<tr>
<th style="text-align:center">Not recorded	</th>
<td style="text-align:center"><?php echo $Not ;?></td>

</tr>


</table>
</div>
</td>


</tr>
	</table>
    <table>
 <tr >
   <td colspan="2">
             <div align="center" class="section-title" style="width:1180px; ">Storage of Xpert Kits</div>
             </td>
             </tr>
<tr>
<td>
 <?php echo $dyn_table3 ?>
 
</td>

</tr>
</table>
    


		
<div class="clearer">&nbsp;</div>


	
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>