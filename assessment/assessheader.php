<?php 
require_once('../connection/db.php'); 
@session_start();
if($_SESSION['nm']==""){
//redirect to login page
@header("location:../dlt_login.php");
}
mysql_select_db($database, $ntrl);

$query_rssample = "SELECT * FROM sample WHERE cond=1 order by sample.ID";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);


$query_rssample1 = "SELECT * FROM sample WHERE cond=0 order by sample.ID";
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$total1 = mysql_num_rows($rssample1);

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


?><?php echo "<b>". date("l, d F Y")."</b>";?> <span class="text-separator">|</span> <strong><span class="quiet">Welcome </span></strong> <span class="text-separator">|</span>  <?php echo  $_SESSION['nm'];?> </div>
		<div class="right">

			<ul class="tabbed" id="network-tabs">
				<li class="current-tab"><a href="#">DLTLD </a></li>
				<li><a href="../logout.php">Log Out</a></li>
				
			</ul>
				
				
			</ul>

			<div class="clearer">&nbsp;</div>
		
		</div>
		
		<div class="clearer">&nbsp;</div>

	</div>
</div>

<div id="site">
	<div class="center-wrapper">

		<div id="header">
			<div class="clearer">&nbsp;</div>

			<div id="site-title">

				<div align="center"> <h1><img src="../img/logo.png" alt="" /></h1></div>

			</div>
<div id="navigation">
				
				<div id="main-nav">

					<ul class="tabbed">
                    <li ><a href="../index.php">Homepage </a></li>
                    <li><a href="sections.php">Add  Assessment</a></li>
                    <li><a href="assessmentlist.php">View Assessment</a></li>
                    <li><a href="dlt_upload.php">Upload Legacy Data</a></li>
                    <li><a href="dlt_sampleview.php">Sample List</a></li>
   					<li><a href="../logout.php">Log Out  </a></li>
					</ul>

					<div class="clearer">&nbsp;</div>

				</div>

				
		</div>
	</div>
</div>

		</div>
		</div>
        </div>