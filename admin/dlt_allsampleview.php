<?php require_once('../connection/db.php'); 


include("Aheader.php");
 
	if (isset($_GET['id'])){
		$sampleID = $_GET['id'];
	}
?>
<?php

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT s.ID as ID,s.Sample_ID AS a, s.fullname as b, s.age as c, f.name as d, s.Exported_Date as e, s.Test_Result as f,  s.pat_type as g,s.rif as h 
FROM sample s 
LEFT JOIN facilitys f ON s.facility=f.ID
WHERE s.cond =1";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);


$total = mysql_num_rows($rssample);


//$totalRows_rssample = mysql_num_rows($rssample);

if  ($totalRows_rssample=mysql_num_rows($rssample)==0)
{
	echo '<div class="errormsgbox">No fields to display</div>';
	
		   } 
?>



<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<script src="../jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
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
	</head>
	<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

   <div class="left" id="main-left">
   
   
      <div class="section-title" style="width:950px">Sample Results With Patient Details   </div><?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
			<div id="demo" align="center">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th>Sample ID </th>
            <th>Patient Name </th>
            <th> Age</th>
            <th> Facility </th>
            <th> Date Tested </th>
            <th> MTB Result </th>
            <th> Rif Status </th>
            <th> Patient Type  </th>
            <th colspan="" valign="middle">Action</th>
            <th colspan="" valign="middle">Action</th>
           
		</tr>
	</thead>
	<tbody>
		
			 <?php do { ?>      
<tr class="odd gradeX">
 
<td> <?php echo $row_rssample['a']; ?></td> 
<td> <?php echo $row_rssample['b']; ?></td>
<td> <?php echo $row_rssample['c']; ?></td>
<td><?php echo $row_rssample['d']; ?></td>
<td> <?php echo $row_rssample['e']; ?></td> 
<td> <?php echo $row_rssample['f']; ?></td>
<td><?php echo $row_rssample['g']; ?></td>
<td> <?php echo $row_rssample['h']; ?></td> 
<td><a <?php echo "href='dlt_patientview.php?id=" .urlencode($row_rssample['ID']) ."'";?>>Full Profile</a>
</td>
<td>
<a <?php echo "href='dlt_machineview.php?id=" .urlencode($row_rssample['ID']) ."'";?>>Machine Info</a>
</td> 

    </tr>
      <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
      
       <?php  ?>  
		
	</tbody>
</table>
			</div>
           
		</div> 
		<?php
include("Asidebar.php");
?>

</div>
	</body>
</html>
<?php
mysql_free_result($rssample);
?>
<?php
include("../includes/footer.php");
?>