<?php
include('Aheader.php');
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
if (isset($_POST["btnsave"])) {
		
$sql="INSERT INTO user (name,category,mfl,facility,username,password)
VALUES('$_POST[name]',
'$_POST[category]',
'$_POST[mfl]',
'$_POST[fname]',
'$_POST[username]',
'$_POST[password]')";

$retval = mysql_query( $sql, $ntrl );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
$suceessmsg= '<div class="success">User successfully added </div>';
   echo "<script>";
   echo "window.location.href='users.php?msg=$suceessmsg'";
   echo "</script>";
mysql_close($ntrl);
}

?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen"    required  />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>
	<script src="../jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.sortable.js"></script>
<script src="../jquery-ui-1.10.3/ui/jquery.ui.tabs.js"></script>
 <script>
	$(function() {
		var tabs = $( "#tabs" ).tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {
				tabs.tabs( "refresh" );
			}
		});
	});
	</script>
<script type="text/javascript">
$(document).ready( function (){
	  
  $("#facility").change(function(){
  $('#fname').val($('option:selected', $(this)).text());
  $('#mfl').val( $(this).val() );
  $('#username').val($('option:selected', $(this)).text());
  
});
});
</script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
   
	<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

  <div class="left" id="main-left">

       <div id="tabs">
	<ul>
		<li><a href="#tabs-1">Add a User</a></li>
		
		
	</ul>
	    <div id="tabs-1">
		<p>
       <?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
       <form name="save" method="post">
      <table  align="center" class="data-table" style="width: auto;">
      
       <tr>
       <th style="text-align: center;"><font size="1.4">Name</font></th>
       <td style="text-align: center;"><input type="text" name="name" id="name" size="30" required /> </td>
       <th style="text-align: center;"><font size="1.4">Category</font></th>
       <td style="text-align: center;"><select name="category" id="category" selected='selected' >
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
		<th style='background-color:#FFFFFF' colspan='4' >&nbsp;</th>
		</tr>	
       <tr>
       <th style="text-align: center;" colspan="1"><font size="1.4">Facility</font></th>

<td style="text-align:center;" colspan="3">
    <select name="facility" id="facility" selected='selected' >
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
    </select></td
       </tr>
       <tr>
		<th style='background-color:#FFFFFF' colspan='4' >&nbsp;</th>
		</tr>	
       <tr>
       	
       <tr>
       <th style="text-align: center;"><font size="1.4">Username</font></th>
       <td style="text-align: center;"><input type="text" name="username" id="username"  size="35"  required  /></td>
       </tr>
       <tr>
		<th style='background-color:#FFFFFF' colspan='4' >&nbsp;</th>
		</tr>	
       <tr>
       <th style="text-align: center;"><font size="1.4">Password</font></th>
       <td style="text-align: center;"><input type="password" name="password" id="password" required  /></td>
       
       <th style="text-align: center;"><font size="1.4">Repeat Password </font></th>
       <td style="text-align: center;"><input type="password" name="password1" id="password1"  required  /></td>
       </tr>
       <tr>
		<th style='background-color:#FFFFFF' colspan='4' >&nbsp;</th>
		</tr>	
       <tr>
       
        <td colspan="4" >
        <div align="center">
        <input type="submit" name="btnsave" id="btnsave" value="Add User"      />
        <input type="reset" name="button2" id="button2" value="Reset"      />
        </div>
        </td>
        </tr>
      </table>
    <input type="hidden" name="MM_insert" value="save"  />
    </form>
       
       
               </p>
	       </div>
	 
      </div>
	</div>
    </div>
    <?php
include('Asidebar.php');
?>
    
</div>

</div>
</body>
</html>
<?php
include("../includes/footer.php");
?>