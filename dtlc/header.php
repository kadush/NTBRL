<?php 
require_once('../connection/db.php'); 
include('../includes/functions.php');
session_start();

if($_SESSION['nm']=="" or $_SESSION['cat']>5){
//redirect to login page
@header("location:dlt_login.php");
}

$mwaka = $_GET['year'];
$mwezi = $_GET['mwezi'];

if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	if ($filter == 1)//LAST 3 MONTHS
	{
		$todate = @date("Y-m-d");
		// current date
		$fromdate = @date('Y-m-d', strtotime('-3 month'));
		$displayfromdate = @date("d-M-Y", strtotime($fromdate));
		$displaytodate = @date("d-M-Y", strtotime($todate));
		$title = "Last 3 Months";
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 3;
		$mapwidth = 540;

	} elseif ($filter == 7)//last 6 months
	{
		$todate = @date("Y-m-d");
		// current date
		$fromdate = @date('Y-m-d', strtotime('-6 month'));
		$displayfromdate = @date("d-M-Y", strtotime($fromdate));
		$displaytodate = @date("d-M-Y", strtotime($todate));
		$title = "Last 6 Months";
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 6;
		$mapwidth = 540;
	} elseif ($filter == 0)//last submission
	{
		$filter = 0;
		$colspan = 6;
		$mapwidth = 540;
		$currentmonth = GetMaxMonthbasedonMaxYear($mwezi);
		$displaymonth = GetMonthName($currentmonth);
		$currentyear = GetMaxYear($mwaka);
		$title = "Last Upload :" . $displaymonth . ' - ' . $currentyear;
		//get current month and year
	} elseif ($filter == 3)//month/year
	{
		$displaymonth =GetMonthName($mwezi);
		$title = $displaymonth . ' - ' . $mwaka;
		//get current month and year
		$currentmonth = $mwezi;
		$currentyear = $mwaka;
		$colspan = 1;
		$mapwidth = 540;
	} elseif ($filter == 4)//year
	{
		$title = $mwaka;
		//get current month and year
		$currentmonth = "";
		//get current month and year
		$currentyear = $mwaka;
		$colspan = 12;
		$mapwidth = 400;
	}
	elseif ($filter == 8)//all
	{
		$currentmonth = GetMaxMonthbasedonMaxYear($mwezi);
		$currentyear = GetMaxYear($mwaka);
		$displaymonth = GetMonthName($currentmonth);
		$minyear = GetMinYear();
		$title = "Cumulative Data : " . $minyear . ' to ' . $displaymonth . ' - ' . $currentyear;
		
	}
} else {
	if ($_REQUEST['submitform']) {
		$filter = 2;
		$fromfilter = $_GET['fromfilter'];
		$tofilter = $_GET['tofilter'];
		$displayfromfilter = @date("d-M-Y", strtotime($fromfilter));
		$displaytofilter = @date("d-M-Y", strtotime($tofilter));
		$title = $displayfromfilter . "  to  " . $displaytofilter;
		$currentmonth = @date("m");
		$currentyear = @date("Y");
		$colspan = 1;
		$mapwidth = 540;
	} else {
		if (isset($mwaka)) {
			if (isset($mwezi)) {
				$filter = 3;
				$displaymonth = GetMonthName($mwezi);
				$title = $displaymonth . ' - ' . $mwaka;
				//get current month and year
				$currentmonth = $mwezi;
				$currentyear = $mwaka;
				$colspan = 1;
				$mapwidth = 540;
			} else {
				$filter = 4;
				$title = $mwaka;
				//get current month and year
				$currentmonth = "";
				//get current month and year
				$currentyear = $mwaka;
				$colspan = 12;
				$mapwidth = 400;
			}
		} else  {	
		    $filter = 0;
			$colspan = 6;
			$mapwidth = 540;

			$currentmonth = GetMaxMonthbasedonMaxYear($samp);
			$displaymonth = GetMonthName($currentmonth);
			$currentyear = GetMaxYear($samp);
			$title = "Last Upload :" . $displaymonth . ' - ' . $currentyear;
			//get current month and year
		}
	}
}

if (isset($_SESSION['mfl'])){
		  $FacID = $_SESSION['mfl'];
	} 
mysql_select_db($database, $ntrl);

$query_rssample = "SELECT * FROM sample1 WHERE cond=1 and facility=".$_SESSION['mfl'];
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);


$query_rssample1 = "SELECT * FROM sample1 WHERE cond=0 and facility=".$_SESSION['mfl'];
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$total1 = mysql_num_rows($rssample1);


$dt=@date("d-M-Y");
//echo $dt;
$query_rssample2 = "SELECT * FROM sample1 WHERE cond=1 and coldate='$dt' and facility=".$_SESSION['mfl'];
$rssample2 = mysql_query($query_rssample2, $ntrl) or die(mysql_error());
$row_rssample2 = mysql_fetch_assoc($rssample2);
$total2 = mysql_num_rows($rssample2);

$facilitycode= $_SESSION['mfl'];

$sqlCN="SELECT  countys.ID AS cid,countys.name AS cN 
FROM countys,facilitys ,districts
WHERE 
`facilitys`.`facilitycode`='$facilitycode'
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county` ";

$qCN=mysql_query($sqlCN) or die(mysql_error());
$rwCN=mysql_fetch_assoc($qCN);
$countyID=$rwCN['cid'];
$cname=$rwCN['cN'];

$sql= "SELECT 
`sample1`.`facility` AS a,
`facilitys`.`name` AS b
FROM sample1,facilitys, `districts` ,`countys`
WHERE 
`sample1`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$countyID'
group by `sample1`.`facility`";
$rsFinC = mysql_query($sql) or die(mysql_error());
$row_rsFinC = mysql_fetch_assoc($rsFinC);
//var_dump($row_rsFinC);

function GetMaxYear2()
{
    $getmaxyear = "SELECT max(year(End_Time)) AS maximumyear FROM sample1";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maximumyear'];
	
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

function GetMinYear2()
{
	$getmaxyear = "SELECT MIN(year(End_Time)) AS minimumyear FROM sample1 ";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['minimumyear'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

 $maximumyear = GetMaxYear2();
 $minyear = GetMinYear2();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>DLTLD</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="../FusionMaps/JSClass/FusionMaps.js"></script>
    <script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507089: Neon - Responsive Admin Template created by Laborator -->
</head>
<div  class="navbar-fixed-top" style="margin-left: 1.5%;float: left;background-color: #FFFFFF">
	<table>
		<tr>
			<td><strong><?php echo @date("l, d F Y");?> <br />  <span class="quiet">Welcome : </span></strong>
				
				<div class="btn-group open">
					<div class="label label-info">
					<?php echo  $_SESSION['nm'];?> ( DTLC <?php echo $cname; ?> County )
				
					</div>
					
				</div>
				
			</td>
			<td ><img style="margin-left: 25%;" src="../img/logo.png" alt=""/></td>
		</tr>
	</table>	
 
</div>

<body style =  "z-index: 100" class="page-body" >

<div class="page-container horizontal-menu">
	
	<header class="navbar navbar-fixed-top" style="margin-top: 5%;z-index: 100"><!-- set fixed position by adding class "navbar-fixed-top" -->
	
	
	<div class="navbar-inner">
	
		<!-- logo -->
		<div class="navbar-brand">
			
		</div>
		
		
		<!-- main menu -->
<ul class="navbar-nav">
	<li>
		<a href="countyview.php?id=<?php echo $countyID; ?>"><i class="entypo-home"></i><span>Home</span></a>
	</li>

	<li>
		<a href="facility.php"><i class="entypo-layout"></i><span>Facilities</span></a>
	</li>
	<li>
		<a href="dashboard.php"><i class="entypo-gauge"></i><span>Dashboard</span></a>
	</li>

	<li>
		<a href="summ.php"><i class="entypo-newspaper"></i><span>Report</span></a>
	</li>

	
</ul>
						
		
		<!-- notifications and other links -->
		<ul class="nav navbar-right pull-right">
			
			
			<li style="float: right">
				<a href="../logout.php">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
			
		</ul>

	</div>
	
</header>
<style type="text/css">

#broke {
float: left;
width: 50%;	
}

#sere {
clear: both;
}

#trans {
float: left;
width: 50%;	
}

#st {
float: left;
width: 47.5%;	
}

</style>


<script type="text/javascript">
var tname =/^[A-Za-z0-9 ]{3,200}$/;
var uname =/^[0-9 ]{3,20}$/;

function validate(){
	
   var oname = document.getElementById('oname').value;
   var ename = document.getElementById('ename').value;
   var broker = document.getElementById('broker').value;
    var str1= document.getElementById('date4').value;
    var str2= document.getElementById('date5').value;
	
var m1=str1.substring(5,7); 
var m2=str2.substring(5,7); 
var dt1=str1.substring(8,10); 
var dt2=str2.substring(8,10); 
var y1=str1.substring(0,4);
var y2=str2.substring(0,4);


var errors = [];
var minlength=6;
	


if(dt2 > dt1){
alert("Date of Price Cannot be Greater than Date of Stamp");
return false;
	
}

if(m2 > m1){
alert("Month of Price Cannot be Greater than Month of Stamp");
return false;
	
}

if(y2 > y1){
alert("Year of Price Cannot be Greater than Year of Stamp");
return false;
	
}
	
	
 if(broker=="0"){
	 alert("No Broker Name");
	 return false;
	 }

   if(str1=="0000-00-00"){
	  alert("No Date of Stamp"); 
	return false; 
 
   } 
      if(str2=="0000-00-00"){
	  alert("No Date of Price"); 
	return false; 
 
   } 	
   
 if (!tname.test(oname)) {
  errors[errors.length] = "No / Invalid Transferor name .";
 } 
 if (!tname.test(ename)) {
  errors[errors.length] = "No / Invalid Transferee name .";
 } 
 
 if (errors.length > 0) {
  reportErrors(errors);
  return false;
 }

return true;
}

function reportErrors(errors){
 var msg = "Please Enter Valid Data...\n";
 for (var i = 0; i<errors.length; i++) {
 var numError = i + 1;
  msg += "\n" + numError + ". " + errors[i];
}
 alert(msg);
}
</script>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	var YAP = document.getElementById("rat");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
			YAP.style.display = "block";
		text.innerHTML = "SEARCH";
  	}
	else {
		ele.style.display = "block";
		YAP.style.display = "none";
		text.innerHTML = "SEARCH";
	}
} 
</script>
     <script language="JavaScript">
function ShowHide(divId)
{
if(document.getElementById(divId).style.display == 'none')
{
document.getElementById(divId).style.display='block';
}
else
{
document.getElementById(divId).style.display = 'none';
}
}
</script>
