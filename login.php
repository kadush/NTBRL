
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="Laborator.co" />
	
	<title>DTLTD | Login</title>
<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
<script src="admin/neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>

<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-10"></script>

</head>
<body class="page-body login-page login-form-fall">

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
				<p class="description"><a href="#" class="logo">
				<img src="img/logo.png" alt="" />
			</a></p>
			
			
			<p class="description">Dear user, log in to access the admin area!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method="post" action="logfile.php" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login" id="login">
						Login In
						<i class="entypo-login"></i>
					</button>
				</div>
				
			</form>
			
			
			<div class="login-bottom-links">
				
				<a href="#" class="link">Forgot your password?</a>
				
				<br />
				
				
				
			</div>
			
		</div>
		
	</div>
	
</div>


</body>
</html>