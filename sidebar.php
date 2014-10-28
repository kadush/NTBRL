
<?php 
require_once('connection/db.php'); 
 
mysql_select_db($database, $ntrl);

$query_rssample = "SELECT * FROM sample1 WHERE cond=1 and facility=".$_SESSION['mfl'];
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);


$query_rssample1 = "SELECT * FROM sample1 WHERE cond=0 and facility=".$_SESSION['mfl'];
$rssample1 = mysql_query($query_rssample1, $ntrl) or die(mysql_error());
$row_rssample1 = mysql_fetch_assoc($rssample1);
$total1 = mysql_num_rows($rssample1);


?>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
   <link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery-ui.css">
	
	
	<link rel="stylesheet" href="jquery-ui-1.10.3/demos/demos.css">


<div style="margin-left:70px;">

<div class="right sidebar" id="sidebar">

				   <div class="section">

					<div class="section-title" style="width:136px">Quick Links </div>
					
					</div>

					<div class="section-content">

						<ul class="nice-list">
							<li>
								<div class="success" style="width: 135px"><a href="samp.php">Add Patient Details </a></div>
								
								<div class="clearer">&nbsp;</div>
							</li>
							<li>
								<div class="success" style="width: 135px"><a href="csv_upload.php">Upload Result Files<?php echo " [ ".$total1." ]" ;?></a></div>
								
								<div class="clearer">&nbsp;</div>
							</li>
							
							<li>
								<div class="success" style="width: 135px"><a href="changePass.php">Change Password</a></div>
								
								<div class="clearer">&nbsp;</div>
							</li>
							<li>
								<div class="success" style="width: 135px"><a href="DLTLD SYSTEM USER GUIDE.pdf" target="_blank">User manual</a></div>
								<div class="clearer">&nbsp;</div>
							</li>
						</ul>

					</div>

				</div>

				
</div>
			</div>
						

						