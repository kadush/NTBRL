<?php
//session_start();

include('header.php');
require_once('connection/db.php');


$userlab=$_SESSION['lab'];
$currentmonth=@date("m");
$currentyear=@date("Y");
$previousmonth=@date("m")- 1;

if ($currentmonth ==1)
{
$previousmonth=12;
$currentyear=@date("Y")-1;
}
else
{
$previousmonth=@date("m")- 1;
$currentyear=@date("Y");
}


$previousmonthname=GetMonthName($previousmonth);

//$submittedstatus=GetProcurementReportStatus($previousmonth,$currentyear,$userlab);
//get month names from ID

$reportpage='submitconsumptionreport.php?';
?>
    <link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<style type="text/css">
<!--
.style1 {color: #00526C}
-->
</style>
<body class="page-body">

<div class="main-content" style="margin-top: 6%; float: left;margin-left: 1%;">

<div class="row">

	<ol class="breadcrumb bc-2" style="width: 800px">
	<font color="#FF0000" style="font-family:Verdana, Arial, Helvetica, sans-serif"><strong>Please note that you <u>CANNOT </u>access the main system until the below pending tasks have been completed.</strong></font></p>
	
	</ol><br>
<ol class="breadcrumb" style="width: 120px"><strong>Pending Tasks</strong></ol><br>
<div class="alert alert-warning" style="width: 400px"><table >				
				<?php 
				//..show the pending consumption report submit		
				if (($submittedstatus == 0 ) || ($errorsending !=""))
				{?>
					<tr>
					<td width="1400px"><div class="notice" style="width: auto"><?php echo '<strong><a href='.$reportpage.'month='.$previousmonth.'&year='.$currentyear.'&view=1> Click to Submit Consumption Report for  [  '.$previousmonthname.' , '.$currentyear.' ] </a> </strong>'; ?></div>
					</td>
					</tr>
					<?php
				}//..end -> show the pending consumption report submit
				
				//..show the pending requisitions submit
				if ($checknoall > 0 ) 
				{?>
					<tr>
					<td><div class="notice"><?php echo  "<strong>"."<a href=scmssubmissions.php    > There are ".$checknoall." Facility Requisitions that need to be Submitted. </a>"."</strong>";?></div>
					</td>
					</tr><?php
				}//.. end -> show the pending requisitions submit?>
			
				</table>
			</div>		
</div>
<footer class="main">
<div class="pull-right">
<?php
include("includes/footer.php");
?>
</div>
</footer>	
</div>
</body>


