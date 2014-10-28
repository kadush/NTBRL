<?php 
@include("header.php");
require_once('connection/db.php');

if (isset($_POST["btnChange"])) {
$username = $_POST['username'];
$password = md5($_POST['password']);
$newpassword = md5($_POST['newpassword']);
$repeatnewpassword = md5($_POST['repeatnewpassword']);

$result = mysql_query("SELECT password FROM user WHERE username='$username' and password = '$password'");

if(!$result) 
{ 
  $errormsg = 'Current Username/Password Not Found' ;
  
} 

if(mysql_num_rows($result)){
    if($newpassword==$repeatnewpassword){
        $sql=mysql_query("UPDATE user SET password='$repeatnewpassword' where username='$username'");        
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
<!doctype html>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">

<?php include("sb.php"); ?>


<div class="main-content" style="">

<div class="row">
	<div class="col-md-9">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
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
			   <form name="up" class="validate" method="POST" novalidate="novalidate">
			      <table  class='table table-bordered'>	
					<tr class='even'>
					   <th style="text-align:center;"> Current Username :</th>
					   <td style="text-align:center;" > <input type="text" name="username" size="25" required  class="form-control" autocomplete="off" /></td> 
					   <th style="text-align:center;"> Current Password :</th>
					   <td style="text-align:center;" > <input type="password" name="password" required  class="form-control" /></td>
							
						</tr>	
					        <tr>
							<th  style='background-color:#FFFFFF' colspan="4"  >&nbsp;</th>
							</tr>
							<tr class='odd'>
							<th style="text-align:center;">  New Password :</th>
							<td style="text-align:center;"> <input type="password" name="newpassword" required  class="form-control"   /></td>
							<th style="text-align:center;"> Confirm password :</th>
							<td style="text-align:center;"> <input type="password" name="repeatnewpassword"   required  class="form-control"  />
							
					        <tr>
							<th  style='background-color:#FFFFFF'colspan="4" >&nbsp;</th>
							</tr>
					        
					    </tr>
							 <tr class='odd'>
					    <td colspan="4">
					    
					    <div id="submit" align="center">
						<input type="submit" name="btnChange" id="btnChange" value="Update Password"  class="btn btn-success"> 
						<input type="reset"  value="Reset Fields"  class="btn btn-default"> 
						 </div>
					
					    </td>
					    </tr>
					</table>
			       </form>
				
			</div>
		
		</div>
	
	</div>
	
</div>

	


	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>