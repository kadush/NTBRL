<?php 
require_once('../connection/db.php'); 
@session_start();
if($_SESSION['nm']==""){
//redirect to login page
@header("location:../dlt_login.php");
}
mysql_select_db($database, $ntrl);
$query_rsUser = "SELECT user.id as id, user.name as nm,user.username as un, user.st as ac, usergroup.groupName as gp FROM user,usergroup WHERE  user.category=usergroup.usergroupID ORDER BY user.id";
$rsUser = mysql_query($query_rsUser, $ntrl) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);

require_once('../connection/db.php'); 

mysql_select_db($database, $ntrl);
$query_rsUsergroup = "SELECT * FROM usergroup ORDER BY usergroup.usergroupID ";
$rsUsergroup = mysql_query($query_rsUsergroup, $ntrl) or die(mysql_error());
$row_rsUsergroup = mysql_fetch_assoc($rsUsergroup);
$totalRows_rsUsergroup = mysql_num_rows($rsUsergroup);

$query_rsfacilitys = "SELECT facilitys.facilitycode, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysql_query($query_rsfacilitys, $ntrl) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);
?>


<?php
$newpassword = md5($_POST['password']);
$repeatnewpassword = md5($_POST['password1']);
if (isset($_POST["btnsave"])) {
	if($newpassword==$repeatnewpassword){
		
			$sql="INSERT INTO user (name,category,mfl,facility,username,password,st)
			VALUES('$_POST[name]',
			'$_POST[category]',
			'$_POST[mfl]',
			'$_POST[fname]',
			'$_POST[username]',
			'$newpassword',1)";
			
			$retval = mysql_query($sql, $ntrl );
			if(! $retval )
			{
			 $errormsg ="Could not enter data.Try Again";
			}
			else{
			   $suceessmsg= 'User successfully added';
			   @header("Location:userlog.php");
			   mysql_close($ntrl);
			}
	  }
	else {
		$errormsg="Passwords do not match";
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
	
	<title>DLTLD | Dashboard</title>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
	<link rel="stylesheet" href="neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>


<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			
/* Formating function for row details */

 
$(document).ready(function() {
	
	
	function fnFormatDetails ( oTable, nTr )
{ 
    var aData = oTable.fnGetData( nTr );
    var res='';
	//location.href = '#?id='+aData[1];
        $.ajax({
        type: "POST",
        url: "../ajax_data/user.php",
		data: "id="+aData[1],
        async: true,
		cache: false,
        success: function(data) {
			     res=data;
			     oTable.fnOpen(nTr,res,'r');
			    
			}
   
     });  
 return res;
	
}
	
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png">';
    nCloneTd.className = "center";
     
    $('#example thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );
     
    $('#example tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );
     
    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#example').dataTable( {
       "bJQueryUI":true, "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });
     
    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $('#example tbody td img').live('click', function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );			
			
</script>





	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387506872: Neon - Responsive Admin Template created by Laborator -->
</head>
<body class="page-body page-fade" style="font-size: 12px;">

<div class="page-container">	
	
<div class="sidebar-menu">
	
		<header class="logo-env">
		
		<!-- logo -->
		<div class="logo">
			<a href="index.php">
				<img src="../img/logo3.png" alt="" />
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
	<style>
		.page-container .sidebar-menu #main-menu li {font-size: 11px;}
		
	</style>
		
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
					<img <img src="../img/logo.png" alt="" />
					
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
<?php echo "<b>". date("l, d F Y");?> <li class="sep"></li> Welcome <img src="../img/icons/users.png" height="15" /><?php echo  $_SESSION['nm'];?> 
		
			</li>
					
			<li class="sep"></li><br>
			
			<li style="float: right"><a href="../logout.php">Log Out <i class="entypo-logout right"></i> </a></li>
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

<script type="text/javascript">
$(document).ready( function (){
	  
  $("#facility").change(function(){
  $('#fname').val($('option:selected', $(this)).text());
  $('#mfl').val( $(this).val() );
  $('#name').val($('option:selected', $(this)).text());
  
});
});
</script>

<div class="col-md-6"  style="width: auto;">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active"><a href="#home" data-toggle="tab">View Users</a></li>
			<li><a href="#profile" data-toggle="tab">Add User</a></li>
			
		</ul>
		
		<div class="tab-content" style="width: auto">
			<div class="tab-pane active" id="home" style="width: 950px">
				<table class="table table-bordered" id="example">
						<thead>
							<tr>
								
								<th>User ID </th>
					            <!-- <th>Full Name</th>-->
					            <th>UserName</th>
					            <th>User Category</th>
					            <th>Status</th> 
					            <th>Action</th>             
					        </tr>
						</thead>
						<tbody>
							
								 <?php do { if($row_rsUser['ac'] == 1) {										
										$row_rsUser['ac'] ='<div class="label label-success">Active</div>';
										} else if($row_rsUser['ac'] == 0) { 
										$row_rsUser['ac'] ='<div class="label label-warning">Disabled</div>';
										}     ?> 
							<tr>
							
							      <td><?php echo $row_rsUser['id']; ?></td>
					              <!-- <td><?php echo $row_rsUser['nm']; ?></td>-->
					              <td><?php echo $row_rsUser['un']; ?></td>
					              <td><?php echo $row_rsUser['gp']; ?></td>
					              <td><?php echo $row_rsUser['ac']; ?></td>
					              <td>
					                   <?php if($row_rsUser[3] == 1) {										
										echo '<a href="activation.php?id='.$row_rsUser['id'].'&st='.$row_rsUser[3].'"><button class="btn btn-gold" id="deact" type="button" title="Deactivate Account"><i class="entypo-cancel"></i></button></a>';
										} else if($row_rsUser[3] == 0) { 
										echo '<a href="activation.php?id='.$row_rsUser['id'].'&st='.$row_rsUser[3].'"><button class="btn btn-green" id="act" type="button" title="Activate Account"><i class="entypo-check"></i></button></a>';
										 }     ?>
									    <a href="deleteUser.php?id=<?php echo $row_rsUser['id']; ?>"><button class="btn btn-red" type="button" title="Delete User/Account"><i class="entypo-trash"></i></button></a>
													
										<a href="resetUser.php?id=<?php echo $row_rsUser['id']; ?>"><button class="btn btn-blue" type="button" title="Reset User/Account"><i class="entypo-pencil"></i></button></a>							
								  </td>   
					         </tr>
					                <?php } while ($row_rsUser = mysql_fetch_array($rsUser)); ?>
					    </tbody>
					</table>
            </div>
			<div class="tab-pane" id="profile" style="width: auto" >
			<?php if ($errormsg !="")
			{
			?> 
			<div class="alert alert-danger" style="text-align: center;width: 250px;"><?php 
			
	               echo  $errormsg;
			
			?><a href="userlog.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
			<?php } ?>
			<?php if ($suceessmsg !="")
					{
					?> 
				<div class="alert alert-success" style="text-align: center;width: 250px;"><?php 
					
			     echo   $suceessmsg ;
			
			?><a href="userlog.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>
			<?php } ?>
			 <form name="save" method="post">
			      <table class="table table-striped" style="width: auto;">
			      
			       <tr>
			       <th style="text-align: center;"><font size="1.4">Name</font></th>
			       <td style="text-align: center;"><input type="text" class="form-control" name="name" id="name" size="30" required /> </td>
			       <th style="text-align: center;"><font size="1.4">Category</font></th>
			       <td style="text-align: center;">
			       	<select name="category" id="category"  class="form-control" >
			      <option value="0">Select Usergroup</option>
			      <?php
			do { 
			?>
			      <option value="<?php echo $row_rsUsergroup['usergroupID']?>"><?php echo $row_rsUsergroup['groupName']; ?></option>
			      <?php
			} while ($row_rsUsergroup = mysql_fetch_assoc($rsUsergroup));
			  $rows = mysql_num_rows($rsUsergroup);
			  if($rows > 0) {
			      mysql_data_seek($rsUsergroup, 0);
				  $row_rsUsergroup = mysql_fetch_assoc($rsUsergroup);
			  }
			?>
			    </select>
			    
			    <input type="hidden" name="fname" id="fname" />
			    <input type="hidden" name="mfl" id="mfl"  />
			       </td>
			       </tr>
			       <tr>
				   <th  colspan='4' >&nbsp;</th>
				   </tr>	
			       <tr>
			       <th style="text-align: center;" colspan="1"><font size="1.4">Facility</font></th>
			
			<td style="text-align:center;" colspan="3">
			    <select name="facility" id="facility"  class="form-control" >
			      <option value="0"> <font size="1.4">Select Facility</font></option>
			      <?php
			do { 
			?>
			      <option value="<?php echo $row_rsfacilitys['facilitycode']?>"><?php echo $row_rsfacilitys['name']; ?></option>
			      <?php
			} while ($row_rsfacilitys = mysql_fetch_assoc($rsfacilitys));
			  $rows = mysql_num_rows($rsfacilitys);
			  if($rows > 0) {
			      mysql_data_seek($rsfacilitys, 0);
				  $row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
			  }
			?>
			    </select></td>
			       </tr>
			       <tr>
					<th  colspan='4' >&nbsp;</th>
					</tr>	
			       <tr>
			       <th style="text-align: center;" colspan='1'><font size="1.4">Username</font></th>
			       <td style="text-align: left;" colspan='3'><input type="text" class="form-control"  name="username" id="username"  size="25"  required autocomplete="off"  /></td>
			       </tr>
			       <tr>
					<th  colspan='4' >&nbsp;</th>
					</tr>	
			       <tr>
			       <th style="text-align: center;"><font size="1.4">Password</font></th>
			       <td style="text-align: center;"><input type="password" class="form-control" name="password" id="password" required  /></td>
			       
			       <th style="text-align: center;"><font size="1.4">Repeat Password </font></th>
			       <td style="text-align: center;"><input type="password" class="form-control" name="password1" id="password1" a required  /></td>
			       </tr>
			       <tr>
					<th  colspan='4' >&nbsp;</th>
					</tr>	
			       <tr>
			       
			        <td colspan="4" >
			        <div align="center">
			        <button class="btn btn-success btn-icon icon-left" type="submit" name="btnsave">Add User<i class="entypo-user-add"></i></button>
			        <input type="reset" name="button2" id="button2" value="Reset" class="btn btn-default"     />
			        </div>
			        </td>
			        </tr>
			      </table>
			    <input type="hidden" name="MM_insert" value="save"  />
			  </form>
					
			</div>
			
		</div>
		
		
	</div>
<script type="text/javascript">
jQuery(window).load(function()
{
	$("#table-2").dataTable({
		"sPaginationType": "bootstrap",
		"sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
		"bStateSave": false,
		"iDisplayLength": 8,
		"aoColumns": [
			{ "bSortable": false },
			null,
			null,
			null,
			null
		]
	});
	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
	
	// Highlighted rows
	$("#table-2 tbody input[type=checkbox]").each(function(i, el)
	{
		var $this = $(el),
			$p = $this.closest('tr');
		
		$(el).on('change', function()
		{
			var is_checked = $this.is(':checked');
			
			$p[is_checked ? 'addClass' : 'removeClass']('highlight');
		});
	});
	
	// Replace Checboxes
	$(".pagination a").click(function(ev)
	{
		replaceCheckboxes();
	});
});
	
// Sample Function to add new row
var giCount = 1;

function fnClickAddRow() 
{
	$('#table-2').dataTable().fnAddData(['<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount+".2", giCount+".3", giCount+".4", giCount+".5" ]);
	
	replaceCheckboxes(); // because there is checkbox, replace it
	
	giCount++;
}
</script>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#act1").click(function(ev)
		{
			ev.preventDefault();
			
			var opts = {
				"closeButton": true,
				"debug": false,
				"positionClass": "toast-bottom-left",
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};

			toastr.success("Account has been Activated.",null, opts);
		});
		
		
		$("#deact1").click(function(ev)
		{
			ev.preventDefault();
			
			var opts = {
				"closeButton": true,
				"debug": false,
				"positionClass": "toast-bottom-left",
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};
			
			toastr.warning("Account has been deactivated.", null, opts);
		});
	});
</script>

</div>
</div>


	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.dialog.js"></script>
	<script src="neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
		
</body>
</html>