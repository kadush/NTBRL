<?php 
require_once('../connection/db.php'); 
session_start();
if($_SESSION['nm']=="" or $_SESSION['cat']!=1){
//redirect to login page
header("location:../dlt_login.php");

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
	
	<title>NTLD-P | Dashboard</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
    <script language="JavaScript" src="../FusionMaps/JSClass/FusionMaps.js"></script>
    <script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387506872: Neon - Responsive Admin Template created by Laborator -->
</head>
<body class="page-body page-fade">

<div class="page-container">	
	
<div class="sidebar-menu">
	
		<header class="logo-env">
		
		<!-- logo -->
		<!-- <div class="logo">
			<a href="index.php">
				<img src="../img/gx.jpg" class="img-responsive" alt="Responsive image" style="width: 170px" />
			</a>
		</div> -->
		
				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
			<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
				<i class="entypo-menu"></i>
			</a>
		</div>
						
		
		<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
		<div class="sidebar-mobile-menu visible-xs">
			<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
				<i class="entypo-menu"></i>
			</a>
		</div>
		
	</header>
		
<ul id="main-menu" class="">
								
	<li>
			<a href="index.php"><i class="entypo-gauge"></i><span>Dashboard</span></a>
	
	</li>

	<li>
		<a href=""><i class="entypo-user"></i><span>Users</span></a>
		

		<ul>
		<li>
			<a href="userlog.php"><span>Add/View Users</span></a>
		</li>

		<li>
			<a href="usergp.php"><span>Add/View UserGroups</span></a>
		</li>

		</ul>

    </li>

	

	<li>
		<a href=""><i class="entypo-window"></i><span>Facilities</span></a>
						
		<ul>
			<li>
				<a href="addfacility.php"><span>Add Facility</span></a>
		    </li>
									
			<li>
				<a href="facility.php"><span>View/Edit facility</span></a>
	       </li>
	
		</ul>
	
	</li>
	
	<li>
		<a href=""><i class="entypo-bag"></i><span>Extra</span></a>
						
		<ul>
			<li>
				<a href="changePass.php"><span>Change Password</span></a>
			</li>
	    </ul>
	
	</li>
</ul>
			
		
</div>	