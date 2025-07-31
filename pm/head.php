<?php 
require_once('../connection/db.php'); 
require_once('../includes/functions.php');
session_start();
if (isset($_GET['id'])){
		 $_SESSION['cid'] = $_GET['id'];
		 $countyID =  $_SESSION['cid'];
	}
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
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
	<title>DLTLD</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
</head>

<body id="top">

<div id="network">
	<div class="center-wrapper">

		<div class="left"><?php
date_default_timezone_set('Europe/Moscow');

$script_tz = date_default_timezone_get();


?>
<?php echo "<b>". @date("l, d F Y")."</b>";?> <span class="text-separator">|</span> <strong><span class="quiet">Welcome </span></strong> <span class="text-separator">|</span><img src="../img/icons/users.png" height="15" />   <?php echo  $_SESSION['nm'];?>
         </div>
		<div class="right" style="overflow: hidden;">

			<ul class="tabbed" id="network-tabs">
				<li class="current-tab"><a href="#">DLTLD </a></li>
				<li><a href="../logout.php"><img src="../img/icons/exit.png" height="15" />Log Out  </a></li>
				
			</ul>
				
				
			</ul>

			<div class="clearer">&nbsp;</div>
		
		</div>
		
		<div class="clearer">&nbsp;</div>

	</div>
</div>

<div id="site" style="overflow: hidden;>
	<div class="center-wrapper">

		<div id="header">
			<div class="clearer">&nbsp;</div>

			<div id="site-title">

				<div align="center"> <h1><img src="../img/logo.png" alt="" /></h1></div>

			</div>
<div id="navigation">
				
				<div id="main-nav">

					<ul class="tabbed">
                    <li ><a href="overall.php"><img src="../img/icons/kenya.jpg" height="20" />Overall View </a></li>
   					<li ><a href="../assessmentSummary/section2.php"><img src="../img/icons/dashboard1.png" height="20" />Assessment</a></li>
                    <li ><a href="fmap.php"><img src="../img/icons/county1.jpg" height="20" />County View</a></li>
                    <li><a href="dlt_facility.php"><img src="../img/icons/hospital.png" height="20" />Facilities</a></li>
                    <?php if ($_SESSION['cat']!=6) {?>
                    <li><a href="allocation.php"><img src="../img/icons/worksheets2.jpg" height="20" />Allocation</a></li>
                    <li><a href="allocationsummary.php"><img src="../img/icons/report5.png" height="20" />Allocation Summary</a></li>
					<?php 
					 }
					?>
					
                    <li ><a href="refmap.php"><img src="../img/icons/disp.png" height="20" />Referral mapping</a></li>
                    <li><a href="../logout.php"><img src="../img/icons/exit.png" height="20" />Log Out  </a></li>
					</ul>
              </div>
         </div>
	</div>
</div>

		</div>
		</div>
        </div>
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
 
