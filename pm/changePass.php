<?php 
	include("header.php");
	require_once('../connection/db.php');
	error_reporting(0);
	if (isset($_POST["btnChange"])) {
		$username = $_SESSION['nm'];
		$password = md5($_POST['password']);
		$newpassword = md5($_POST['newpassword']);
		$repeatnewpassword = md5($_POST['repeatnewpassword']);
				
		$result = mysqli_query($dbConn,"SELECT password FROM user WHERE name='$username' and password = '$password'");
		
		if(!$result) 
		{ 
		  $errormsg = 'Current Username/Password Not Found' ;
		  
		} 
		
		//exit;
		if(mysqli_num_rows($result)){
		    if($newpassword==$repeatnewpassword){
		        $sql=mysqli_query($dbConn,"UPDATE user SET password='$newpassword' where name='$username' and password = '$password'");        
		        if($sql) 
		        { 
		              $suceessmsg = 'Password Successfully Changed' ;
		              
		        }
		        else
		        {
		              $errormsg = 'Error Changing Password.Try Again' ;
					  
		        }       
		    } else {
		              $errormsg = 'New/Repeat Password do not match' ;
					  
		    }
		} else {
					  $errormsg = 'Invalid Username/Password' ;
					  
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
	
	<title>DLTLD</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">
	
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507089: Neon - Responsive Admin Template created by Laborator -->
</head>

<div class="main-content">


<div id="content-row" class="row">
	<div class="col-md-8 col-md-offset-2" >
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading text-center">
				<div class="panel-title">
					 Change Login Password to the System. 
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				 <?php if ($errormsg !="")
					{
					?> 
				<div class="alert alert-danger" style="text-align: center;width: 250px;"><?php 
				
		               echo  $errormsg;
		
				?><a href="changePass.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<?php if ($suceessmsg !="")
						{
						?> 
					<div class="alert alert-success" style="text-align: center;width: 250px;" ><?php 
						
				     echo   $suceessmsg ;
				
				?><a href="changePass.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				   <form name="up" class="validate" method="POST" role="form">
						    <div class="col-md-4">
								<div class="form-group">
								<label>Current Password :</label>
						    	<input type="password" name="password" required  class="form-control" autocomplete="off"/>
								</div>
							</div>
							 <div class="col-md-4">
								<div class="form-group">
								<label>New Password :</label>
						    	<input type="password" name="newpassword" required  class="form-control"   />
								</div>
							</div>
							 <div class="col-md-4">
								<div class="form-group">
								<label>Confirm New Password :</label>
						    	<input type="password" name="repeatnewpassword"   required  class="form-control"  />
								</div>
							</div><br />
							  <div id="submit" align="center">
								<input type="submit" name="btnChange" id="btnChange" value="Update Password"  class="btn btn-success"> 
								<input type="reset"  value="Reset Fields"  class="btn btn-default"> 
							  </div>
					     
			       </form>
				
			</div>
		
		</div>
	
	</div>
	
	
</div>

	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	







<!--
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
-->
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		@include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>