<?php 
require_once('connection/db.php'); 
session_start();

function GetMaxMonthbasedonMaxYear()
{
	
	$getmaxyear = "SELECT month(max(End_Time)) AS maxmonth FROM sample1 ";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maxmonth'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('m');
	}
return $showyear;
}

function GetMaxYear()
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

function GetMinYear()
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
function GetMonthName($month)
{
 if ($month==1)
 {
     $monthname=" Jan ";
 }
else if ($month==2)
 {
     $monthname=" Feb ";
 }else if ($month==3)
 {
     $monthname=" Mar ";
 }else if ($month==4)
 {
     $monthname=" Apr ";
 }else if ($month==5)
 {
     $monthname=" May ";
 }else if ($month==6)
 {
     $monthname=" Jun ";
 }else if ($month==7)
 {
     $monthname=" Jul ";
 }else if ($month==8)
 {
     $monthname=" Aug ";
 }else if ($month==9)
 {
     $monthname=" Sep ";
 }else if ($month==10)
 {
     $monthname=" Oct ";
 }else if ($month==11)
 {
     $monthname=" Nov ";
 }
  else if ($month==12)
 {
     $monthname=" Dec ";
 }
  else if ($month==13)
 {
     $monthname=" Jan - Sep  ";
 }
return $monthname;
}


if($_SESSION['nm']=="" or $_SESSION['cat']>3 ){
//redirect to login page
@header("location:dlt_login.php");
}
if (isset($_SESSION['mfl'])){
		  $FacID = $_SESSION['mfl'];
	} 
@mysql_select_db($database, $ntrl);

$sql="SELECT GXSN as serial,count(*) as totaltests FROM sample1 where cond='1' and facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_assoc($query);
$SN=$rs['serial'];
$TT=$rs['totaltests'];

$query_rssample = "SELECT * FROM sample1 WHERE cond=1 and Test_Result!='ERROR' and facility=".$_SESSION['mfl'];
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$complete = mysql_num_rows($rssample);


$query_rssample1 = "SELECT * FROM sample1 WHERE cond=0 and facility=".$_SESSION['mfl'];
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$notup = mysql_num_rows($rssample1);

$query_rssample1 = "SELECT * FROM sample1 WHERE Test_Result='ERROR' and facility=".$_SESSION['mfl'];
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$errors = mysql_num_rows($rssample1);

$query_rssample1 = "SELECT * FROM sample1 WHERE Test_Result='Positive' and mtbRif='Positive' and facility=".$_SESSION['mfl'];
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$mtbrif = mysql_num_rows($rssample1);


$dt=@date("d-M-Y");
//echo $dt;
$query_rssample2 = "SELECT * FROM sample1 WHERE cond=1 and coldate='$dt' and facility=".$_SESSION['mfl'];
$rssample2 = mysql_query($query_rssample2, $ntrl) or die(mysql_error());
$row_rssample2 = mysql_fetch_assoc($rssample2);
$todayswork = mysql_num_rows($rssample2);


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

function lastDateOfMonth($Month, $Year=-1) {
    if ($Year < 0) $Year = 0+@date("Y");
    $aMonth = @mktime(0, 0, 0, $Month, 1, $Year);
    $NumOfDay = 0+@date("t", $aMonth);
    $LastDayOfMonth = @mktime(0, 0, 0, $Month, $NumOfDay, $Year);
    return $LastDayOfMonth;
}
$displayDate=@strtotime(@date("Y-m-d", lastDateOfMonth($currentmonth)))."<br>";
$todaysdate=@strtotime(@date("Y-m-d"));


$query_rssample2 = "SELECT * FROM consumption WHERE MONTH(date)='$currentmonth' and  YEAR(date)='$currentyear' and facility='$FacID'";
$rssample2 = mysql_query($query_rssample2, $ntrl) or die(mysql_error());
$row_rssample2 = mysql_fetch_assoc($rssample2);
$totalrow = mysql_num_rows($rssample2);

$query = "SELECT * FROM consumption WHERE MONTH(date)='$previousmonth' and  YEAR(date)='$currentyear' and facility='$FacID'";
$rs = mysql_query($query, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rs);
$reportedpreviousmonth= mysql_num_rows($rs);

$q = "SELECT DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate FROM sample1 s WHERE s.facility='$FacID'";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$expdate= $row['DiffDate'];

$q = "SELECT (c.end_bal+c.allocated) AS cart FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Cartridge' ORDER BY c.date DESC LIMIT 1";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$cartridges= $row['cart'];

$q = "SELECT (c.end_bal+c.allocated) AS tubes FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Falcon Tubes'  ORDER BY c.date DESC LIMIT 1";
$r = mysql_query($q, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($r);
$tubes= $row['tubes'];

$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$currentmonth' and  YEAR(End_Time)='$currentyear' and cond=1 and facility='$FacID'";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$testdonethismonth = mysql_num_rows($rssample);

$remainingcarts= $cartridges - $testdonethismonth;
$remainingtubes= $tubes - $testdonethismonth;

?>
<?php
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>DLTLD | Lab</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="FusionMaps/JSClass/FusionMaps.js"></script>
    <script language="JavaScript" src="FusionCharts/JSClass/FusionCharts.js"></script>
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
				<div class="label label-info">
					<?php echo  $_SESSION['nm'];?>
				</div
			</td>
			<td>
				<img style="margin-left: 25%;" src="img/logo.png" class="img-responsive" alt=""/>
			</td>
		</tr>
	</table>	
 </div>
           
<body class="page-body" >

<div class="page-container horizontal-menu" style="background-color: #FFFFFF;">
	
	<header class="navbar navbar-fixed-top" style="margin-top: 5%"><!-- set fixed position by adding class "navbar-fixed-top" -->
	
	
	<div class="navbar-inner">
	
		<!-- logo -->
		<div class="navbar-brand">
			
		</div>
		
		
		<!-- main menu -->
<ul class="navbar-nav" style="margin-left: 15%">
	<?php if ($reportedpreviousmonth>0) { ?>
	<li>
		<a href="index.php"><i class="entypo-home"></i><span>Home</span></a>
	</li>
    <li>
	  <a href="#"><span><i class="entypo-suitcase"></i></span><span>Samples</span></a>
		<ul>
			<li>
				<a href="sampleview.php"><span><i class="entypo-suitcase"></i></span><span>Sample List</span><span class="badge badge-info"><?php echo $notup ;?></span></a>
			</li>
			<li>
				<a href="allsampleview.php"><span><i class="entypo-suitcase"></i></span><span>Complete Records</span><span class="badge badge-success"><?php echo $complete ;?></span></a>
		    </li>
		    <li>
				<a href="sampleErr.php"><span><i class="entypo-suitcase"></i></span><span>Error Records</span><span class="badge badge-danger"><?php echo $errors ;?></span></a>
		    </li>
		</ul>
    </li>
	<li>
		<a href="dashboard.php"><i class="entypo-gauge"></i><span>Dashboard</span></a>
	</li>

	<li>
		<a href="facility.php"><i class="entypo-vcard"></i><span>Facilities</span></a>
	</li>
	
	<li>
		<a href="#"><i class="entypo-list-add"></i><span>Consumption Report</span></a>
	
			<ul>
				<li>
					<a href="viewconsumption.php"><i class="entypo-list-add"></i><span>View Consumption</span></a>
				</li>
				<?php if ( ($todaysdate==$displayDate) and ($totalrow==0))
				    {
		               echo '<li><a href="submitconsumptionreport.php?month='.$currentmonth.'&year='.$currentyear.'"><i class="entypo-list-add"></i><span>Consumption Reporting</span></a></li>';
		            }
			      
		        ?>
			</ul>
	</li>		
     
     <li>
		<a href="summ.php"><i class="entypo-menu"></i><span>Reports</span></a>
	</li>
    <?php }  else { ?>
    <li>
		<a href="pendings.php"><i class="entypo-home"></i><span>Home</span></a>
	</li>
     <?php } ?>
	
</ul>
						
		
		<!-- notifications and other links -->
		<ul class="nav navbar-right pull-right">
			
			
			<li style="float: right">
				<a href="logout.php">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
			
		</ul>

	</div>
	
</header>
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
 