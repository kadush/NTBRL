<?php
require_once('../connection/db.php');

$query_rsCounty = "SELECT countys.ID, countys.name FROM countys ORDER BY countys.name";
$rsCounty = mysql_query($query_rsCounty, $ntrl) or die(mysql_error());
$row_rsCounty = mysql_fetch_assoc($rsCounty);
$totalRows_rsCounty = mysql_num_rows($rsCounty);

$query_rsFType = "SELECT  DISTINCT ftype FROM `facilitys`";
$rsFType = mysql_query($query_rsFType, $ntrl) or die(mysql_error());
$row_rsFType = mysql_fetch_assoc($rsFType);
$totalRows_rsFType = mysql_num_rows($rsFType);

$query_rsOwner = "SELECT DISTINCT owner FROM `facilitys`";
$rsOwner = mysql_query($query_rsOwner, $ntrl) or die(mysql_error());
$row_rsOwner = mysql_fetch_assoc($rsOwner);
$totalRows_rsOwner = mysql_num_rows($rsOwner);

if (isset($_POST["btnUpload"])) {
$sql="INSERT INTO facilitys (`facilitycode`,`name`,`district`,`ftype`, `owner`, `contactperson`, `contacttelephone`,`ContactEmail`) VALUES (
'$_POST[code]',
'$_POST[fname]',
'$_POST[district]',
'$_POST[ftype]',
'$_POST[owner]',
'$_POST[incharge]',
'$_POST[tel]',
'$_POST[email]')";
//exit;

$retval = mysql_query( $sql, $ntrl );
if(! $retval )
{
  $errormsg='An Error Occurred.Please Try Again';
}
 $suceessmsg= 'Facility Details Successfully Saved';
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
	
	<title>DLTLD | Dashboard</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

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
		<div class="logo">
			<a href="index.php">
				<img src="../img/logo3.png" class="img-responsive" alt="Responsive image"/>
			</a>
		</div>
		
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
		<a href=""><i class="entypo-bag"></i><span>Extra</span><span class="badge badge-info badge-roundless">New Items</span></a>
		

		<ul>
		<li>
			<a href=""><span>County</span><span class="badge badge-success">47</span></a>
		
			<ul>
				<li>
					<a href="addfacility.php"><span>Facilities</span></a>
			    </li>
			    
           </ul>

       </li>

		
		<li>
			<a href=""><span>GeneXpert Sites</span></a>
		

			<ul>
			<li>
					<a href=""><span>GeneXpert Sites</span></a>
			</li>

			</ul>

</li>

		<li>
			<a href=""><span>Change Password</span></a>
		</li>

		

		</ul>

</li>

</ul>
			
		
</div>	
	<div class="main-content" style="margin-top: -1%">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
			<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="../img/logo.png" class="img-responsive" />
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
					
			<li class="sep"></li><br>
			
			<li style="float: right"><a href="../logout.php">Log Out <i class="entypo-logout right"></i></a></li>
		</ul>
		
	</div>
	
</div>

<hr />

<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
	
</script>


<div class="row">
	<div class="col-sm-12">
	
		<div class="panel panel-primary" id="charts_env">
		
			<div class="panel-heading">
				
				<div class="panel-title">Add New Facility</div>
			</div>
	
			<div class="panel-body">
				<?php if ($errormsg !="")
					{
					?> 
				<div class="alert alert-danger col-md-6 col-md-offset-3" style="text-align: center;">
					<span><?php echo  $errormsg; ?></span>
					<a href="addfacility.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<?php if ($suceessmsg !="")
						{
						?> 
					<div class="alert alert-success col-md-6 col-md-offset-3" style="text-align: center;" > 
						<span><?php echo $suceessmsg; ?></span>	
						<a href="addfacility.php" data-rel="close" class="close pull-right"><i class="entypo-cancel"></i></a></div>
				<?php } ?>
				<form name="save" id="save" class="validate" method="post" role="form">
			    <div class="col-md-4">
					<div class="form-group">
					<label>Mfl Code:</label>
			    	<input type="text" name="code" id="code" data-validate="required"  class="form-control" data-mask="999999" >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Facility Name:</label>	
				    <input class="form-control" type="text" name="fname" id="fname" data-validate="required">
				    </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Type of Facility:</label>	
					<select name="ftype" class="selectboxit" data-first-option="false" >
					<option>Type of Facility</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsFType['ftype']?>"><?php echo $row_rsFType['ftype']; ?></option>
							      <?php
							} while ($row_rsFType = mysql_fetch_assoc($rsFType));
							  $rows = mysql_num_rows($rsFType);
							  if($rows > 0) {
							      mysql_data_seek($rsFType, 0);
								  $row_rsFType = mysql_fetch_assoc($rsFType);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div class="col-md-4">
					<div class="form-group">
					<label>Type of Ownership:</label>	
					<select class="selectboxit" name="owner" data-first-option="false">
					<option>Type of Ownership</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsOwner['owner']?>"><?php echo $row_rsOwner['owner']; ?></option>
							      <?php
							} while ($row_rsOwner = mysql_fetch_assoc($rsOwner));
							  $rows = mysql_num_rows($rsOwner);
							  if($rows > 0) {
							      mysql_data_seek($rsOwner, 0);
								  $row_rsOwner = mysql_fetch_assoc($rsOwner);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>County:</label>	
					<select class="selectboxit" name="county" id="county" data-first-option="false">
					<option value="0">All counties</option>
					<?php
							do { 
							?>
							      <option value="<?php echo $row_rsCounty['ID']?>"><?php echo $row_rsCounty['name']; ?></option>
							      <?php
							} while ($row_rsCounty = mysql_fetch_assoc($rsCounty));
							  $rows = mysql_num_rows($rsCounty);
							  if($rows > 0) {
							      mysql_data_seek($rsCounty, 0);
								  $row_rsCounty = mysql_fetch_assoc($rsCounty);
							  }
					?>
					
					</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>District:</label>	
					<div name="district" id="district">  </div>
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div class="col-md-4">
					<div class="form-group">
					<label>Person In Charge:</label>	
					<input class="form-control" type="text" name="incharge">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Telephone:</label>	
					<input type="text" name="tel" data-validate="required"  class="form-control" data-mask="9999999999">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Email:</label>	
					<input class="form-control" type="text" name="email" data-validate="email">
					</div>
				</div>
				<div class="clear"></div>
				<br>
				<div align="center">
					<button class="btn btn-success" type="submit" name="btnUpload" id="btnUpload">Save Details</button>
					<input type="reset" name="reset" class="btn btn-default"/>
				</div>
			</form>
			</div>				
		</div>	

	</div>

</div>

<br />




<!-- Footer -->
<footer class="main">
	
    <div class="pull-right">
		<?php 
		include '../includes/footer.php';
		?>
	</div>

</footer>	
</div>
	

	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/js/selectboxit/jquery.selectBoxIt.css"  id="style-resource-3">

	<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script src="neon/neon-x/assets/js/selectboxit/jquery.selectBoxIt.min.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	
<script type="text/javascript">
$(document).ready(function(){
   
	 $("#county").change(function () {

     if($("#county option:selected").val() == 0 ){
         $('#district').hide();
     } else if ($("#county option:selected").val() > 0){
        $('#district').show();
         cid=$("#county option:selected").val();
         	 //alert(cid);
         	             
     }
     

    $.post("ajax_all.php", 
    { d : cid },
    function(data) {
    	//alert(data);
    	$('#district').html(data);
    });
                
    });
    //return data; 
});
 </script>
</body>
</html>