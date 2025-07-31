<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.neontheme.com/neon/neon-x/assets/frontend//main/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:44:33 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>NTLD-P</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	

	<link rel="stylesheet" href="neon/neon-x/assets/frontend//css/bootstrap-min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/frontend//css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/frontend//css/neon.css"  id="style-resource-3">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	
    <script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
   
	<script src="neon/neon-x/assets/frontend/js/jquery-1.11.0.min.js"></script>
<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="http://demo.neontheme.com/assets/neon/neon-x/assets/frontend//js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
	<!-- TS1412235722: Neon - Responsive Admin Template created by Laborator -->
</head>
<body>

<div class="wrap" style="background-color: #FFFFFF !important">
	<div class="site-header-container container" >
		<div class="row">
	
			<div class="col-md-12">
				<section class="site-logo">
				 
						<style>
							IMG.displayed {
							    display: block;
							    margin-left: auto;
							    margin-right: auto;
							    padding-top: 0; 
							    max-width: 100%;
 							    height: auto;
 							    vertical-align: middle;
							    }
						</style>
						
						<span>
						<div class="displayed">
							
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="../img/logo.png" class="displayed" />
								</a>
							
						</div>
						</span>
				</section>	
					
			</div>	
			
			
		</div>

	<div class="row">
	
		<div class="col-md-12">
			
			<header class="site-header">
				
			
				<span><strong><?php echo date("l, d F Y");?> <br />
					  <span class="quiet">Welcome : </span></strong>
						<div class="label label-info">
							<?php echo  $_SESSION['nm'];?>
						</div>
						
						<a href="../pm/">
							<button class="btn btn-default btn-icon btn-xs" type="button">
								Switch to Program Level
							</button>
						</a>
						</span>
				
				<nav class="site-nav">
					
					<ul class="main-menu hidden-xs" id="main-menu">
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



	<script src="neon/neon-x/assets/frontend//js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/frontend//js/bootstrap.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/frontend//js/joinable.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/frontend//js/resizeable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/frontend//js/neon-slider.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/frontend//js/neon-custom.js" id="script-resource-6"></script>
		
</body>


</html>
 