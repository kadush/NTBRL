<?php @require_once('connection/db.php'); 
include("header.php");

if (isset($_GET['id'])){
		$SampleID = $_GET['id'];
		
	}

mysql_select_db($database, $ntrl);
$query_rssamp = "SELECT * FROM sample1 WHERE sample1.ID='$SampleID'";

$rssamp = mysql_query($query_rssamp, $ntrl) or die(mysql_error());
$row_rssamp = mysql_fetch_assoc($rssamp);
$totalRows_rssamp = mysql_num_rows($rssamp);


?>


	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
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

<div class="main-content">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Tuberculosis Culture & DST Request Form for: <?php echo $row_rssamp['fullname']; ?> 
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			 <form action="allsampleview.php"  name="r_form" class="form-group" >
			 <table class="table table-bordered">
			 	  <tr>
				  <td>
				   <label> Lab No: </label>
				  </td>
				  
				  <td><input name="name" id="name" size="25"  type="text" value="<?php echo $row_rssamp['lab_no']; ?>" disabled="disabled" /></td>
				   <td> 
				  <label for="field1">Full Name: </label>
				  </td>
				  <td>
				  <input type="text" value="<?php echo $row_rssamp['fullname']; ?>" name="num" disabled="disabled" />
				  </td>
				  <td><label>Age:</label></td>
				  <td>
				  <input type="text" name="age" id="age"   value="<?php echo $row_rssamp['age']; ?>" disabled="disabled" />
				  </td>
				  
				  </tr>
				  
				  <tr>
				        
				 
				  <td>  <label>Gender </label></td>
				  <td><input name="fullname" id="fullname"  type="text" value="<?php echo $row_rssamp['gender']; ?>"  disabled="disabled" />
				  <td><label>Mobile No:</label></td>
				  <td><input name="fullname" id="fullname"  type="text" value="<?php echo $row_rssamp['mobile']; ?>"  disabled="disabled" />
				    
				    
				  <td><label for="field3">Physical address </label></td>
				  <td>
				    
				    <input type="text" name="dob" id="dob"   value="<?php echo $row_rssamp['address']; ?>"   disabled="disabled" />
				    
				  </td>
				  
				  
				  </tr>
				  
				  <tr>
				  <td><label for="field4">HIV Status</label></td>
				  <td>
				    <input type="text" name="add" id="add"    value="<?php echo $row_rssamp['h_status']; ?>"   disabled="disabled" />
				  </td>
				  
				  
				
				  <td><label for="field3">Examination Required: </label></td>
				  <td>
				    <input type="text" name="mobile" id="mobile"    value="<?php echo $row_rssamp['exam_req']; ?>"   disabled="disabled" />
				  </td>
				  
				  <td><label for="field3">Type of patient</label></td>
				  <td>
				    <input type="text" name="email" id="email"   size="35" value="<?php echo $row_rssamp['pat_type']; ?>"   disabled="disabled" />
				   </td>
				  </tr>
				  
				  <tr>
				  <td><label for="field3">Clinician Name : </label></td>
				  <td>
				    <input type="text" name="clinician" id="clinician" size="25"  value="<?php echo $row_rssamp['User']; ?>" disabled="disabled" />
				    </td>
				  
				 <!-- <td><label for="field3">Type of specimen : </label></td>
				  <td>
				    <input type="text" name="specimen" id="specimen"    value="<?php echo $row_rssamp['specimen_type']; ?>"   disabled="disabled" />
				  </td> -->
				  
				  <td><label for="field3">Date of collection : </label></td>
				  <td>
				    <input type="text" name="coldate" id="coldate"    value="<?php echo $row_rssamp['coldate']; ?>"   disabled="disabled" />
				    </td>
				  </tr>
				  
				  <tr>
				  <td><label for="field3">MTB Result : </label></td>
				  <td colspan="">
				    <input type="text" value="<?php echo $row_rssamp['Test_Result']; ?>" name="res" id-"res" disabled="disabled" />
				  </td>
				   <td><label for="field3">MTB Rif Result : </label></td>
				  <td colspan="">
				    <input type="text" value="<?php echo $row_rssamp['mtbRif']; ?>" name="res" id-"res" disabled="disabled" />
				  </td>
				  </tr>
				  
				  <tr>
				  <td colspan="6">
				  <div id="submit" align="center">
				<input type="submit" value="Close Profile View"  class="btn btn-blue"> 
				 </div></td>
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
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
	
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