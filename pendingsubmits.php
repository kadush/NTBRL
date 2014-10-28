<?php 
session_start();
require_once('connection/db.php'); 

?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<title>DLTLD</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
</head>

<body id="top">

<div id="network">
	<div class="center-wrapper">

		<div class="left"><?php
date_default_timezone_set('Europe/Moscow');

$script_tz = date_default_timezone_get();


?><?php echo "<b>". date("l, d F Y")."</b>";?> <span class="text-separator">|</span> <strong><span class="quiet">Welcome </span></strong> <span class="text-separator">|</span> <img src="img/icons/users.png" height="15" /> <?php echo  $_SESSION['nm'];?>
        </div>
		<div class="right">

			<ul class="tabbed" id="network-tabs">
				<li class="current-tab"><a href="#">DLTLD </a></li>
				<li><a href="logout.php"><img src="img/icons/exit.png" height="15" />Log Out  </a></li>
				
			</ul>
				
				
			</ul>

			<div class="clearer">&nbsp;</div>
		
		</div>
		
		<div class="clearer">&nbsp;</div>

	</div>
</div>

<div id="site" style="overflow: hidden;">
	<div class="center-wrapper">

		<div id="header">
			<div class="clearer">&nbsp;</div>

			<div id="site-title">

				<div align="center"> <h1><img src="img/logo.png" alt="" /></h1></div>

			</div>
<div id="navigation">
				
				<div id="main-nav">

					<ul class="tabbed">
                   <li ><a href="pendings.php"><img src="img/icons/Home.png" height="20" />Homepage </a></li>	
					<li><a href="logout.php"><img src="img/icons/exit.png" height="20" />Log Out  </a></li>
					</ul>
              </div>
         </div>
	</div>
</div>

		</div>
		</div>
        </div>
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