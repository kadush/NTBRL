<?php 
require_once('../connection/db.php'); 
require_once('../includes/functions.php');
session_start();
if (isset($_GET['id'])){
		 $_SESSION['cid'] = $_GET['id'];
		 $countyID =  $_SESSION['cid'];
	}
$conn = mysql_connect($hostname, $username, $password);

    $sqlCN="SELECT name AS cN FROM countys WHERE ID ='$countyID'";
	$qCN=mysql_query($sqlCN,$conn ) or die(mysql_error());
	$rwCN=mysql_fetch_assoc($qCN);
    $countyname=$rwCN['cN'];
?>
<?php
if($_SESSION['nm']=="" or $_SESSION['cat']<4 or $_SESSION['cat']==5 ){
//redirect to login page
@header("location:../dlt_login.php");
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

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.neontheme.com/frontend/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:44:33 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>DLTLD</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	

	<link rel="stylesheet" href="../frontend/css/bootstrap-min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../frontend/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../frontend/css/neon.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
    <script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
   
	<script src="../frontend/js/jquery-1.11.0.min.js"></script>
<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="http://demo.neontheme.com/assets/frontend/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
	<!-- TS1412235722: Neon - Responsive Admin Template created by Laborator -->
</head>
<body>

<div class="wrap">
	<div class="site-header-container container">
		<div class="row">
	
			<div class="col-md-12">
				<section class="site-logo">
				 
						<style>
							IMG.displayed {
							    display: block;
							    margin-left: auto;
							    margin-right: auto;padding-top: 0; }
						</style>
						
						<span><IMG src="../img/logo.png" class="displayed" ></span>
					</section>	
					
			</div>	
			
			
		</div>

	<div class="row">
	
		<div class="col-md-12">
			
			<header class="site-header">
				
			
				<span><strong><?php echo @date("l, d F Y");?> <br />  <span class="quiet">Welcome : </span></strong>
								
								<div class="btn-group">
									
								  <button class="btn dropdown-toggle btn-blue" data-toggle="dropdown"><?php echo  $_SESSION['nm'];?> <span class="caret"></span></button>
									  <ul class="dropdown-menu">
									    <li><a href="changePass.php" id="reset">Change Password</a></li>
									    <li><a href="../logout.php" id="logout">Logout</a></li>
									  </ul>
								
								</div><!-- /btn-group -->
								
							
						</span>
				
				<nav class="site-nav">
					
					<ul class="main-menu hidden-xs" id="main-menu">
						<li class="active">
							<a href="overall.php"><i class="entypo-home"></i><span>Home</span></a>
						</li>
						
						<li>
							<a href="fmap.php"><i class="entypo-layout"></i><span>County View</span></a>
						</li>
						<!--<li>
							<a href="../assessmentSummary/section2.php"><i class="entypo-newspaper"></i><span>Assessment</span></a>
						</li> -->
						<li>
							<a href="dlt_facility.php"><i class="entypo-menu"></i><span>Facilities</span></a>
						</li>
						<?php if ($_SESSION['cat']!=6) {?>
						<li>
							<a >
								<i class="entypo-bag"></i><span>Allocation</span>
							</a>
							
							<ul>
								<li>
									<a href="allocation.php"><span>View Allocation</span></a>
								</li>
								<li class="active">
									<a  href="allocationsummary.php"><span>Allocation Summary</span></a>
							    </li>
							</ul>
						</li>
						 <?php } ?>
						 <li>
							<a href="inventory.php"><i class="entypo-newspaper"></i><span>Inventory</span></a>
						</li>
						<li style="float: right">
							<a href="../logout.php">
								Log Out <i class="entypo-logout right"></i>
							</a>
						</li>
					</ul>
					
				
					<div class="visible-xs">
						
						<a href="#" class="menu-trigger">
							<i class="entypo-menu"></i>
						</a>
						
					</div>
				</nav>
				
			</header>
			<hr>
		</div>
		
	</div>
	
</div>

</div>	



	<script src="../frontend/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../frontend/js/bootstrap.js" id="script-resource-2"></script>
	<script src="../frontend/js/joinable.js" id="script-resource-3"></script>
	<script src="../frontend/js/resizeable.js" id="script-resource-4"></script>
	<script src="../frontend/js/neon-slider.js" id="script-resource-5"></script>
	<script src="../frontend/js/neon-custom.js" id="script-resource-6"></script>
	
	
</body>

<!-- Mirrored from demo.neontheme.com/frontend/main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:45:08 GMT -->
</html>