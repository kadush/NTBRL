<?php require_once('../connection/db.php'); 
include('Aheader.php');
//session_start();
?>
<?php 
	if (isset($_GET['id'])){
		$sampleID = $_GET['id'];
	}

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT * FROM sample WHERE `cond` = 0 ";
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
    
       <div class="section-title" style="width:950px"> GeneXpert Result(s) Pending Patient Details   </div>
			<div id="demo" align="center">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
        <th>Sample ID </th>
        <th>Exported Date &amp; Time</th>
        <th>Report User </th>
        <th>Test Result</th>
        <th>Action</th>
        
        </tr>
	</thead>
	<tbody>
		
	<?php do { ?>      
<tr class="odd gradeX">
 <td> <?php echo $row_rssample['Sample_ID']; ?></td>
<td><?php echo $row_rssample['Exported_Date']; ?></td>
<td> <?php echo $row_rssample['Report_User_Name']; ?></td> 

<td> <?php echo $row_rssample['Test_Result']; ?></td>

<td><a <?php echo "href='dlt_requestForm.php?id=" .urlencode($row_rssample['ID']) ."'";?>>Edit Request Form</a></td>   
    </tr>
     <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
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