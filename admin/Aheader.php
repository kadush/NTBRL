<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="../img/ntlp.jpg" class="img-responsive" />
				</a>
		    </li>
		
		</ul>
	</div>
	
	
	<!-- Raw Links -->
	<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
		<ul class="list-inline links-list pull-right">
			<li>
				<?php
					date_default_timezone_set('Europe/Moscow');
					
					$script_tz = date_default_timezone_get();
					?>
					<?php echo "<b>". @date("l, d F Y");?> <li class="sep"></li> Welcome <img src="../img/icons/users.png" height="15" /><?php echo  $_SESSION['nm'];?> 
		
			</li>
					
			<li class="sep"></li><a href="../pm/">
				<button class="btn btn-default btn-icon btn-xs" type="button">
					Switch to Program Level
					
				</button>
			</a>
			<br>
			
			<li style="float: right"><a href="../includes/logout.php">Log Out <i class="entypo-logout right"></i></a></li>
		</ul>
		
	</div>
	
</div>

