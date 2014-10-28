<?php
//include("header.php");
require_once('connection/db.php');

$conn = mysql_connect($hostname, $username, $password);

mysql_select_db('db_ntrl');

mysql_select_db($database, $ntrl);
$query_rsexamination_required = "SELECT examination_required.id, examination_required.type FROM examination_required ORDER BY examination_required.id";
$rsexamination_required = mysql_query($query_rsexamination_required, $ntrl) or die(mysql_error());
$row_rsexamination_required = mysql_fetch_assoc($rsexamination_required);
$totalRows_rsexamination_required = mysql_num_rows($rsexamination_required);

mysql_select_db($database, $ntrl);
$query_rshiv_status = "SELECT hiv_status.id, hiv_status.status FROM hiv_status ORDER BY hiv_status.id";
$rshiv_status = mysql_query($query_rshiv_status, $ntrl) or die(mysql_error());
$row_rshiv_status = mysql_fetch_assoc($rshiv_status);
$totalRows_rshiv_status = mysql_num_rows($rshiv_status);

$query_rstype_of_patient = "SELECT type_of_patient.id, type_of_patient.type FROM type_of_patient ORDER BY type_of_patient.id";
$rstype_of_patient = mysql_query($query_rstype_of_patient, $conn) or die(mysql_error());
$row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
$totalRows_rstype_of_patient = mysql_num_rows($rstype_of_patient);

$query_rsfacilitys = "SELECT facilitys.facilitycode, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysql_query($query_rsfacilitys, $ntrl) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);

$query="SELECT sample1.lab_no as num FROM sample1 ORDER by tym  ASC LIMIT 1";
$rs = mysql_query($query, $conn) or die(mysql_error());
$rows = mysql_fetch_assoc($rs); 
$no=$rows['num'];
if( @mysql_affected_rows($rs)==0){
$num = substr($no,-5);
$namba=str_pad($num + 1, 5, 0, STR_PAD_LEFT);

}

else{
	
$num=rand(1, 1);
for ($i = 1; $i <=$num ; $i++) {
    $namba= str_pad($i,5,'0', STR_PAD_LEFT);
}
 
}

if (isset($_POST["btnUpload"])) {
  $sql=
"INSERT INTO sample1 (`lab_no`,`op_no`,`regno`, `fullname`, `gender`, `age`,`ageb`, `mobile`,`address`,`pat_type`,`facility`,`Refacility`,`coldate`,`smear`,`h_status`,`exam_req`) VALUES (
'$_POST[labno]',
'$_POST[opno]',
'$_POST[regno]',
'$_POST[name]',
'$_POST[sex]',
'$_POST[age]',
'$_POST[ageb]',
'$_POST[tel]',
'$_POST[address]',
'$_POST[ptype]',
'$_POST[facility]',
'$_POST[refacility]',
'$_POST[date]',
'$_POST[smear]',
'$_POST[hstatus]',
'$_POST[exam]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
 echo '<div class="errormsgbox">Could not enter data.Try Again</div>';
}
 $suceessmsg= '<div class="success">Patient details successfully saved </div>';

echo "<script>";
echo "window.location.href='samp.php?msg=$suceessmsg'";
echo "</script>";
mysql_close($conn);
}

mysql_select_db($database, $ntrl);
$query_rssample = "SELECT * FROM sample1 WHERE `cond` = 0 ";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);

//$totalRows_rssample = mysql_num_rows($rssample);

?>


<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery-ui.css">
<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.3/demos/demos.css">

<script type="text/javascript">
$(document).ready( function (){
	  
  $("#newP").click(function(){
  $("#opno").prop("disabled", $(this).is(':checked'));
  $("#regno").prop("disabled", $(this).is(':checked'));
  
});
});
</script>
 
<div class="main" id="main-two-columns">
 <div class="left" id="main-left">
    <div id="demo" align="center">
       <div class="section-title" style="width:1015px"> Patient's Register   </div>
	<?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
<form name="save" method="post">
    <table border="1" align="center" cellpadding="0" cellspacing="0" class="data-table" style="width: 1030px;">
		<tr class='odd'>
		
         <th colspan="1" style="text-align:center;"> <font size="1.2">Testing Facility:</font></th>
  <td colspan="3" style="text-align:center;"> <?php echo  $_SESSION['nm'];?>
    <input type="hidden" name="facility" value="<?php echo  $_SESSION['mfl'];?>"  />
   </td>
   <th colspan="1" style="text-align:center;"> <font size="1.2">Referred From(Facility):</font></th>
  <td colspan="3" style="text-align:center;">
    <select name="refacility" id="refacility" selected='selected' >
      <option value="0"> <font size="1.2">Select Facility</font></option>
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
    </select>
   </td>
   </tr>
   <tr>
	<th  style='background-color:#FFFFFF' colspan='8' width=200px>&nbsp;    </th>
</tr>
   <tr class='even'>
   	<th style="text-align:left;"> <font size="1.6"><input type="checkbox" name="newP" id="newP" value="New Patient"/> New Patient</font></th>
   <th style="text-align:center;"> <font size="1.2">Lab No:</font></th>
		<td colspan="2" style="text-align:center;" > <input type="text" name="labno" value="<?php echo @date("dmy_").$_SESSION['mfl']."_". $namba?>" readonly /></td>
		
		<th  style="text-align:center;"> <font size="1.2">Op/IP No:</font></th>
		<td  style="text-align:center;" > <input type="text" name="opno" id="opno" value=""/></td>
		<th  style="text-align:center;"> <font size="1.2">Reg No:</font></th>
		<td  style="text-align:center;" > <input type="text" name="regno" id="regno" value="" /></td>
		</tr>	
        <tr>
		<th  style='background-color:#FFFFFF' colspan='8' width=200px>&nbsp;</th>
		</tr>
		<tr class='odd'>
		<th> <font size="1.2"> Patient Name:</font></th>
		<td> <input type="text" name="name" required size="30"  /></td>
		<th> <font size="1.2">Age:</font></th>
		<td> <input type="text" name="age" size="2" required  />
		<select name="ageb">
        <option value="1">Year(s)</option>
        <option value="0">Month(s)</option>
        
          </select>
		</td>
        <th> <font size="1.2">Gender:</font></th>
		<td> <select name="sex">
        <option value="0">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        
          </select> </td>
		
		<th > <font size="1.2">Date:</font></th>
		<td > <input type="text" name="date" value="<?php echo @date("d-M-Y")?>" size="12" readonly /></td>
		</tr>
        <tr>
		<th  style='background-color:#FFFFFF' colspan='8' width=200px>&nbsp;</th>
		</tr>
        <tr class='even'>
		
		</tr>
        
        <tr class='odd'>
        <th > <font size="1.2">Physical Address:</font></th>
		<td > <input type="text" name="address" required size="30"  /></td>
		<th > <font size="1.2">Tel:</font></th>
		<td > <input type="text" name="tel" required  /></td>
        <th > <font size="1.2">Type of Patient : </font></th>
  <td>
    <select name="ptype" id="ptype"  selected='selected'>
      <option value="0">Type of Patient</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rstype_of_patient['type']?>"><?php echo $row_rstype_of_patient['type']; ?></option>
      <?php
} while ($row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient));
  $rows = mysql_num_rows($rstype_of_patient);
  if($rows > 0) {
      mysql_data_seek($rstype_of_patient, 0);
	  $row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
  }
?>
    </select>
    </td>
    <th > <font size="1.2">Smear(+ve/-ve):</font></th>
		<td ><select name="smear">
        <option value="0">Select Type</option>
        <option value="Positive">Positive</option>
        <option value="Negative">Negative</option>
        
          </select></td>
		</tr>
         <tr>
		<th  style='background-color:#FFFFFF' colspan='8' width=200px>&nbsp;</th>
		</tr>
		<tr class='odd'>
        <th > <font size="1.2">HIV Status</font></th>
		<td > <select name="hstatus" id="hstatus"  selected='selected'>
      <option value="0">Select Status</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rshiv_status['status']?>"><?php echo $row_rshiv_status['status']; ?></option>
      <?php
} while ($row_rshiv_status = mysql_fetch_assoc($rshiv_status));
  $rows = mysql_num_rows($rshiv_status);
  if($rows > 0) {
      mysql_data_seek($rshiv_status, 0);
	  $row_rshiv_status = mysql_fetch_assoc($rshiv_status);
  }
?>
    </select></td>
		
        <th > <font size="1.2"> Examination Required: </font></th>
  <td>
    <select name="exam" id="exam" selected='selected'  >
      <option value="0">Select exam type</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsexamination_required['type']?>"><?php echo $row_rsexamination_required['type']; ?></option>
      <?php
} while ($row_rsexamination_required = mysql_fetch_assoc($rsexamination_required));
  $rows = mysql_num_rows($rsexamination_required);
  if($rows > 0) {
      mysql_data_seek($rsexamination_required, 0);
	  $row_rsexamination_required = mysql_fetch_assoc($rsexamination_required);
  }
?>
    </select>
    </td>
    </tr>
        <tr>
		<th  style='background-color:#FFFFFF' colspan='8' width=200px>&nbsp;</th>
		</tr>
        <tr  class='even'>	
        
    </tr>
		 <tr class='odd'>
    <td colspan="8">
    
    <div id="submit" align="center">
<input type="submit" name="btnUpload" id="btnUpload" value="Save Data"  class="button" style="font-size:1.2;"> 
<input type="reset" name="res" id="res" value="Reset Fields"  class="button" style="font-size:1.2;" onclick="window.location.reload();"> 
 </div>

    </td>
    </tr>
		</table>
       </form>
   
    </div>
	
</div>
</div>
<?php
include("sidebar.php");
?>	
<div class="clearer">&nbsp;</div>

	  
	</div>
</div>

</body>
</html>
<?php
include("includes/footer.php");
?>