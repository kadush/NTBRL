<?php
include('Asidebar.php');
require_once('../connection/db.php'); 

mysqli_select_db($database, $ntrl);
$query_rsUser = "SELECT user.id, user.name,user.password, usergroup.groupName FROM user,usergroup WHERE  user.category=usergroup.usergroupID ORDER BY user.id";
$rsUser = mysqli_query($dbConn,$query_rsUser, $ntrl) or die(mysqli_error($dbConn)());
$row_rsUser = mysqli_fetch_array($rsUser);
$totalRows_rsUser = mysqli_num_rows($rsUser);
?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<script src="../jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
<style type="text/css" title="currentStyle">
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable({"bJQueryUI":true});
			} );
		</script>

<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

  <div class="left" id="main-left">
    	<div id="demo" align="center">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>                
                <th>User ID </th>
                <th>User Name</th>
                <th>User Password</th>
                <th>User Category</th>
                              
             </tr>
	</thead>
	<tbody>
		
			 <?php do { ?>      
<tr class="odd gradeX">
                  
                  <td><?php echo $row_rsUser[0]; ?></td>
                  <td><?php echo $row_rsUser[1]; ?></td>
                  <td><?php echo $row_rsUser[2]; ?></td>
                  <td><?php echo $row_rsUser[3]; ?></td>
                  
                </tr>
                <?php } while ($row_rsUser = mysqli_fetch_array($rsUser)); ?>
                </tbody>
</table>
        
			</div>
           </div>
		</div> 
		<?php
include("Aheader.php");
?>

</div>
	</body>
</html>
<?php
include("../includes/footer.php");
?>