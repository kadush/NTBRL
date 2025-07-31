<?php 
require_once('../connection/db.php'); 
include("Aheader.php");

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($dbConn,$theValue) : mysqli_escape_string($dbConn,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["btnsubmit"]) == "r_form")) {

$updateSQL = sprintf("UPDATE sample SET System_Name=%s, Exported_Date =%s, Report_User_Name=%s, Need_Lot_Specific_Parameters=%s, Reagent_Lot_Number=%s, Assay_Disclaimer=%s, Sample_ID=%s, Test_Type=%s, Assay=%s, Assay_Version=%s, Assay_Type=%s, User=%s, Status=%s, Start_Time=%s, End_Time=%s, Error_Status=%s, Reagent_Lot_ID=%s, Expiration_Date=%s, Cartridge_SN=%s, Module_Name=%s, Module_SN=%s, Instrument_SN=%s, SW_Version=%s, Test_Result=%s,   	Test_Disclaimer=%s,fullname=%s,age=%s, gender=%s, address=%s, mobile=%s, p_email=%s, facility=%s, Refacility=%s, c_email=%s, date1=%s, specimen_type=%s, coldate=%s, h_status=%s, exam_req=%s, pat_type=%s, rif=%s, ptr_reg=%s, ptr_start=%s, ptr_end=%s, ctr_reg=%s, ctr_start=%s, ctr_end=%s, dlt=%s, cond=%s WHERE ID=%s",

		               
					   GetSQLValueString($_POST['1'], "text"),
					   GetSQLValueString($_POST['2'], "text"),
					   GetSQLValueString($_POST['3'], "text"),
					   GetSQLValueString($_POST['4'], "text"),
					   GetSQLValueString($_POST['5'], "text"),
					   GetSQLValueString($_POST['6'], "text"),
					   GetSQLValueString($_POST['7'], "text"),
					   GetSQLValueString($_POST['8'], "text"),
					   GetSQLValueString($_POST['9'], "text"),
					   GetSQLValueString($_POST['10'], "text"),
					   GetSQLValueString($_POST['11'], "text"),
					   GetSQLValueString($_POST['12'], "text"),
					   GetSQLValueString($_POST['13'], "text"),
					   GetSQLValueString($_POST['14'], "text"),
					   GetSQLValueString($_POST['15'], "text"),
					   GetSQLValueString($_POST['16'], "text"),
					   GetSQLValueString($_POST['17'], "text"),
					   GetSQLValueString($_POST['18'], "text"),
					   GetSQLValueString($_POST['19'], "text"),
					   GetSQLValueString($_POST['20'], "text"),
					   GetSQLValueString($_POST['21'], "text"),
					   GetSQLValueString($_POST['22'], "text"),
					   GetSQLValueString($_POST['23'], "text"),
					   GetSQLValueString($_POST['24'], "text"),
					   GetSQLValueString($_POST['25'], "text"),
					   GetSQLValueString($_POST['fullname'], "text"),
					   GetSQLValueString($_POST['age'], "text"),
					   GetSQLValueString($_POST['gender'], "text"),
					   GetSQLValueString($_POST['add'], "text"),
					   GetSQLValueString($_POST['mobile'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['facility'], "text"),
					   GetSQLValueString($_POST['facilityR'], "text"),
					   GetSQLValueString($_POST['eclinician'], "text"),
					   GetSQLValueString($_POST['date'], "text"),
					   GetSQLValueString($_POST['specimen'], "text"),
					   GetSQLValueString($_POST['coldate'], "text"),
					   GetSQLValueString($_POST['status'], "text"),
					   GetSQLValueString($_POST['exam'], "text"),
					   GetSQLValueString($_POST['ptype'], "text"),
					   GetSQLValueString($_POST['rif'], "text"),
					   GetSQLValueString($_POST['ptr'], "text"),
					   GetSQLValueString($_POST['pfrom'], "text"),
					   GetSQLValueString($_POST['pto'], "text"),
					   GetSQLValueString($_POST['ctr'], "text"),
					   GetSQLValueString($_POST['cfrom'], "text"),
					   GetSQLValueString($_POST['cto'], "text"),
					   GetSQLValueString($_POST['lastTdate'], "text"),
					   GetSQLValueString($_POST['cond'], "text"),
					   GetSQLValueString($_POST['num'], "int"));
echo $updateSQL;
mysqli_select_db($database, $ntrl);
$Result1 = mysqli_query($dbConn,$updateSQL, $ntrl) or die(mysqli_error($dbConn)());

 if (mysqli_affected_rows($ntrl) == 1) { //If the Insert Query was successfull.
 
 $success='<div class="success">Request Form data has been successfully saved </div>';
 
 $successmsg=urlencode($success);
  echo "<script>";
  echo "window.location.href='dlt_allsampleview.php?msg=$successmsg'";
  echo "</script>";

 //@header('Location: dlt_allsampleview.php?msg='.$successmsg);
 

 
                // Finish the page:
                
            } 
			
			
			
			else { // If it did not run OK.
               				 
 $error='<div class="errormsgbox">Update Failed.Please try again</div>';
 
 $errormsg=urlencode($error);
  echo "<script>";
  echo "window.location.href='dlt_requestForm.php?msg=$errormsg'";
  echo "</script>";
     }
		
}

?>
<?php require_once('../connection/db.php'); 
//include('../includes/functions.php');
if (isset($_GET['id'])){
		$SampleID = $_GET['id'];
		
	}

mysqli_select_db($database, $ntrl);
$query_rssamp = "SELECT * FROM sample WHERE sample.ID=".$SampleID;

$rssamp = mysqli_query($dbConn,$query_rssamp, $ntrl) or die(mysqli_error($dbConn)());
$row_rssamp = mysqli_fetch_assoc($rssamp);
$totalRows_rssamp = mysqli_num_rows($rssamp);


?>

<?php
mysqli_select_db($database, $ntrl);
$query_rshiv_status = "SELECT hiv_status.id, hiv_status.status FROM hiv_status ORDER BY hiv_status.id";
$rshiv_status = mysqli_query($dbConn,$query_rshiv_status, $ntrl) or die(mysqli_error($dbConn)());
$row_rshiv_status = mysqli_fetch_assoc($rshiv_status);
$totalRows_rshiv_status = mysqli_num_rows($rshiv_status);


mysqli_select_db($database, $ntrl);
$query_rscountys = "SELECT countys.ID, countys.name FROM countys ORDER BY countys.name";
$rscountys = mysqli_query($dbConn,$query_rscountys, $ntrl) or die(mysqli_error($dbConn)());
$row_rscountys = mysqli_fetch_assoc($rscountys);
$totalRows_rscountys = mysqli_num_rows($rscountys);

mysqli_select_db($database, $ntrl);
$query_rsgenexpert_result = "SELECT genexpert_result.id, genexpert_result.mtb_indicator FROM genexpert_result ORDER BY genexpert_result.id";
$rsgenexpert_result = mysqli_query($dbConn,$query_rsgenexpert_result, $ntrl) or die(mysqli_error($dbConn)());
$row_rsgenexpert_result = mysqli_fetch_assoc($rsgenexpert_result);
$totalRows_rsgenexpert_result = mysqli_num_rows($rsgenexpert_result);

mysqli_select_db($database, $ntrl);
$query_rsdistrict = "SELECT districts.ID, districts.name FROM districts ORDER BY districts.name";
$rsdistrict = mysqli_query($dbConn,$query_rsdistrict, $ntrl) or die(mysqli_error($dbConn)());
$row_rsdistrict = mysqli_fetch_assoc($rsdistrict);
$totalRows_rsdistrict = mysqli_num_rows($rsdistrict);

mysqli_select_db($database, $ntrl);
$query_rsfacilitys = "SELECT facilitys.ID, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysqli_query($dbConn,$query_rsfacilitys, $ntrl) or die(mysqli_error($dbConn)());
$row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysqli_num_rows($rsfacilitys);

mysqli_select_db($database, $ntrl);
$query_rsexamination_required = "SELECT examination_required.id, examination_required.type FROM examination_required ORDER BY examination_required.id";
$rsexamination_required = mysqli_query($dbConn,$query_rsexamination_required, $ntrl) or die(mysqli_error($dbConn)());
$row_rsexamination_required = mysqli_fetch_assoc($rsexamination_required);
$totalRows_rsexamination_required = mysqli_num_rows($rsexamination_required);

mysqli_select_db($database, $ntrl);
$query_rsgenexpert_interpretation = "SELECT genexpert_interpretation.id, genexpert_interpretation.findings FROM genexpert_interpretation ORDER BY genexpert_interpretation.id";
$rsgenexpert_interpretation = mysqli_query($dbConn,$query_rsgenexpert_interpretation, $ntrl) or die(mysqli_error($dbConn)());
$row_rsgenexpert_interpretation = mysqli_fetch_assoc($rsgenexpert_interpretation);
$totalRows_rsgenexpert_interpretation = mysqli_num_rows($rsgenexpert_interpretation);

mysqli_select_db($database, $ntrl);
$query_rsregime = "SELECT regime.id, regime.type FROM regime ORDER BY regime.id";
$rsregime = mysqli_query($dbConn,$query_rsregime, $ntrl) or die(mysqli_error($dbConn)());
$row_rsregime = mysqli_fetch_assoc($rsregime);
$totalRows_rsregime = mysqli_num_rows($rsregime);

mysqli_select_db($database, $ntrl);
$query_rstype_of_patient = "SELECT type_of_patient.id, type_of_patient.type FROM type_of_patient ORDER BY type_of_patient.id";
$rstype_of_patient = mysqli_query($dbConn,$query_rstype_of_patient, $ntrl) or die(mysqli_error($dbConn)());
$row_rstype_of_patient = mysqli_fetch_assoc($rstype_of_patient);
$totalRows_rstype_of_patient = mysqli_num_rows($rstype_of_patient);
?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.datepicker.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
	<script src="../jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
<script src="../jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css"> <script>
 
    $(document).ready(function() {
		//alert("Boss inawak");
   $('#coldate').change(function() {
			
   var d1 = $('#dob').datepicker('getDate');
   var d2 = $('#coldate').datepicker('getDate');
   //alert(d2);
   var diff = 0;
   if (d1 && d2) {
   var diff = Math.floor(((d2 - d1) / (1000 * 60 * 60 * 24)/(28*12))); 
    }
    $('#age').val(diff);
	   //alert(diff);
	   });	
    });	
 
 
 
    $(function() {
       	$( "#lastTdate" ).datepicker({maxDate : "0D",
			altField: "#lastTdate",
			altFormat: "d-MM-yy",
			dateFormat : $.datepicker.ATOM,
			changeMonth : true,
			changeYear : true});

    });
	
	 $(function() {
$( "#cfrom" ).datepicker({
defaultDate: "+1w",
dateFormat: "d-MM-yy",
changeMonth : true,
changeYear : true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#cto" ).datepicker( "option", "minDate", selectedDate );
}
});

$( "#cto" ).datepicker({
defaultDate: "+1w",
dateFormat: "d-MM-yy",
changeMonth : true,
changeYear : true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#cfrom" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
	
	$(function() {
$( "#pfrom" ).datepicker({
defaultDate: "+1w",
dateFormat: "d-MM-yy",
changeMonth : true,
changeYear : true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#pto" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#pto" ).datepicker({
defaultDate: "+1w",
dateFormat: "d-MM-yy",
changeMonth : true,
changeYear : true,
numberOfMonths: 1,
onClose: function( selectedDate ) {
$( "#pfrom" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
	
	$(function() {
        $( "#coldate" ).datepicker({
		
			maxDate : "0D",
			dateFormat : $.datepicker.ATOM,
			changeMonth : true,
			changeYear : true });
    });
	
	$(function() {
        $( "#date" ).datepicker({ altField: "#date",altFormat: "d-MM-yy",maxDate : "0D" });

    });
	
	$(function() {
        $( "#dob" ).datepicker({yearRange : "-120:+0",
			maxDate : "0D",
			dateFormat : $.datepicker.ATOM,
			changeMonth : true,
			changeYear : true});

    });
	
	
	
	</script>


<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
 
<div class="section-title" style="width:950px">Tuberculosis Culture & DST Request Form </div>
<?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
<form action="#"  name="r_form" class="TTWForm" method="POST" novalidate="">
  <table align="center"  border="1" cellpadding="0" cellspacing="0" class="data-table" style="width: auto; height:auto">
    
    
  <tr>
  <td>
  Sample ID:
  </td>
  <td><input name="name" id="name"  type="text" value="<?php echo $row_rssamp['Sample_ID']; ?>" disabled="disabled" />
  <input type="hidden" name="age" id="age"   value="" />
  </td>
  
  </tr>
  
  <tr>
  <td> 
  <label for="field1">Patient Names: </label>
  <input type="hidden" value="<?php echo $row_rssamp['ID']; ?>" name="num" />
  
  <input type="hidden" value="1" name="cond" id="cond" />
  <input type="hidden" value="<?php echo $row_rssamp['System_Name']; ?>" name="1" />
  <input type="hidden" value="<?php echo $row_rssamp['Exported_Date']; ?>" name="2" />
  <input type="hidden" value="<?php echo $row_rssamp['Report_User_Name']; ?>" name="3" />
  <input type="hidden" value="<?php echo $row_rssamp['Need_Lot_Specific_Parameters']; ?>" name="4" />
  <input type="hidden" value="<?php echo $row_rssamp['Reagent_Lot_Number']; ?>" name="5" />
  <input type="hidden" value="<?php echo $row_rssamp['Assay_Disclaimer']; ?>" name="6" />
  <input type="hidden" value="<?php echo $row_rssamp['Sample_ID']; ?>" name="7" />
  <input type="hidden" value="<?php echo $row_rssamp['Test_Type']; ?>" name="8" />
  <input type="hidden" value="<?php echo $row_rssamp['Assay']; ?>" name="9" />
  <input type="hidden" value="<?php echo $row_rssamp['Assay_Version']; ?>" name="10" />
  <input type="hidden" value="<?php echo $row_rssamp['Assay_Type']; ?>" name="11" />
  <input type="hidden" value="<?php echo $row_rssamp['User']; ?>" name="12" />
  <input type="hidden" value="<?php echo $row_rssamp['Status']; ?>" name="13" />
  <input type="hidden" value="<?php echo $row_rssamp['Start_Time']; ?>" name="14" />
  <input type="hidden" value="<?php echo $row_rssamp['End_Time']; ?>" name="15" />
  <input type="hidden" value="<?php echo $row_rssamp['Error_Status']; ?>" name="16" />
  <input type="hidden" value="<?php echo $row_rssamp['Reagent_Lot_ID']; ?>" name="17" />
  <input type="hidden" value="<?php echo $row_rssamp['Expiration_Date']; ?>" name="18" />
  <input type="hidden" value="<?php echo $row_rssamp['Cartridge_SN']; ?>" name="19" />
  <input type="hidden" value="<?php echo $row_rssamp['Module_Name']; ?>" name="20" />
  <input type="hidden" value="<?php echo $row_rssamp['Module_SN']; ?>" name="21" />
  <input type="hidden" value="<?php echo $row_rssamp['Instrument_SN']; ?>" name="22" />
  <input type="hidden" value="<?php echo $row_rssamp['SW_Version']; ?>" name="23" />
  <input type="hidden" value="<?php echo $row_rssamp['Test_Result']; ?>" name="24" />
  <input type="hidden" value="<?php echo $row_rssamp['Test_Disclaimer']; ?>" name="25" />
        
  </td>
  <td  ><input name="fullname" id="fullname"  type="text" value="" />
    
    
  <td><label for="field3">Date of Birth : </label></td>
  <td>
    
    <input type="text" name="dob" id="dob"   value="" />
    
    </td>
  
  <td><label for="field3">Gender : </label></td>
  <td>
    <select name="gender" id="gender"  >
      <option value="0">Select gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    </td>
  </tr>
  
  <tr>
  <td><label for="field4">Physical Address : </label></td>
  <td>
    <input type="text" name="add" id="add"   value="" />
   </td>
  
  

  <td><label for="field3">Mobile No : </label></td>
  <td>
    <input type="text" name="mobile" id="mobile"   value="" />
    </td>
  
  <td><label for="field3">Email Address : </label></td>
  <td>
    <input type="text" name="email" id="email"   value="" />
   </td>
  </tr>
  <tr>
  
  
  <td><label for="field3">Facility : </label></td>
  <td><span id="spryselect4">
    <select name="facility" id="facility" selected='selected' >
      <option value="0">Select Facility</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsfacilitys['ID']?>"><?php echo $row_rsfacilitys['name']; ?></option>
      <?php
} while ($row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys));
  $rows = mysqli_num_rows($rsfacilitys);
  if($rows > 0) {
      mysqli_data_seek($rsfacilitys, 0);
	  $row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
  }
?>
    </select>
    <span class="selectRequiredMsg">Please select an item.</span></span></td>
    
    <td><label for="field3">Facility(referred from) : </label></td>
  <td>
    <select name="facilityR" id="facilityR" selected='selected' >
      <option value="0">Select Facility</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsfacilitys['ID']?>"><?php echo $row_rsfacilitys['name']; ?></option>
      <?php
} while ($row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys));
  $rows = mysqli_num_rows($rsfacilitys);
  if($rows > 0) {
      mysqli_data_seek($rsfacilitys, 0);
	  $row_rsfacilitys = mysqli_fetch_assoc($rsfacilitys);
  }
?>
    </select>
    </td>
  </tr>
  <tr>
  <td><label for="field3">Clinician Name : </label></td>
  <td>
    <input type="text" name="clinician" id="clinician"   value="<?php echo $row_rssamp['User']; ?>" disabled="disabled"/>
    </td>
  
  <td><label for="field3">Clinician Email : </label></td>
  <td>
    <input type="text" name="eclinician" id="eclinician"   value="" />
    </td>
  
  <td><label for="field3">Date : </label></td>
  <td>
    <input type="text" name="date" id="date"   value="" />
    </td>
  </tr>
  <tr>
  <td><label for="field3">Type of specimen : </label></td>
  <td>
    <input type="text" name="specimen" id="specimen"   value="" />
    </td>
  
  <td><label for="field3">Date of collection : </label></td>
  <td><span id="sprytextfield12">
    <input type="text" name="coldate" id="coldate"   value="" />
    </td>
  </tr>
  <tr>
  <td><label for="field3">Hiv Status : </label></td>
  <td>
    <select name="status" id="status"  selected='selected'>
      <option value="0">Select Status</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rshiv_status['status']?>"><?php echo $row_rshiv_status['status']; ?></option>
      <?php
} while ($row_rshiv_status = mysqli_fetch_assoc($rshiv_status));
  $rows = mysqli_num_rows($rshiv_status);
  if($rows > 0) {
      mysqli_data_seek($rshiv_status, 0);
	  $row_rshiv_status = mysqli_fetch_assoc($rshiv_status);
  }
?>
    </select>
    </td>
   <td><label for="field3">Examination Required : </label></td>
  <td>
    <select name="exam" id="exam" selected='selected'  >
      <option value="0">Select exam type</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsexamination_required['type']?>"><?php echo $row_rsexamination_required['type']; ?></option>
      <?php
} while ($row_rsexamination_required = mysqli_fetch_assoc($rsexamination_required));
  $rows = mysqli_num_rows($rsexamination_required);
  if($rows > 0) {
      mysqli_data_seek($rsexamination_required, 0);
	  $row_rsexamination_required = mysqli_fetch_assoc($rsexamination_required);
  }
?>
    </select>
   </td>
        
        <td><label for="field3">Type of Patient : </label></td>
  <td>
    <select name="ptype" id="ptype"  selected='selected'>
      <option value="0">Type of Patient</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rstype_of_patient['type']?>"><?php echo $row_rstype_of_patient['type']; ?></option>
      <?php
} while ($row_rstype_of_patient = mysqli_fetch_assoc($rstype_of_patient));
  $rows = mysqli_num_rows($rstype_of_patient);
  if($rows > 0) {
      mysqli_data_seek($rstype_of_patient, 0);
	  $row_rstype_of_patient = mysqli_fetch_assoc($rstype_of_patient);
  }
?>
    </select>
    </td>
        
  </tr>
  <tr>
  <td><label for="field3">GeneXpert Result : </label></td>
  <td>
    <input type="text" value="<?php echo $row_rssamp['Test_Result']; ?>" name="res" id-"res" disabled="disabled"/>
    </td>
   <td><label for="field3">RIF Interpretation : </label></td>
  <td> 
    <select name="rif" id="rif" selected='selected' >
      <option value="0">RIF interpretation</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsgenexpert_interpretation['findings']?>"><?php echo $row_rsgenexpert_interpretation['findings']; ?></option>
      <?php
} while ($row_rsgenexpert_interpretation = mysqli_fetch_assoc($rsgenexpert_interpretation));
  $rows = mysqli_num_rows($rsgenexpert_interpretation);
  if($rows > 0) {
      mysqli_data_seek($rsgenexpert_interpretation, 0);
	  $row_rsgenexpert_interpretation = mysqli_fetch_assoc($rsgenexpert_interpretation);
  }
?>
    </select>
     </td>
  </tr>
  <tr>
  <td><label for="field3">Previous Treatment Regime : </label></td>
  <td>
    <select name="ptr" id="ptr" selected='selected' >
      <option value="0">Regime Type</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsregime['type']?>"><?php echo $row_rsregime['type']; ?></option>
      <?php
} while ($row_rsregime = mysqli_fetch_assoc($rsregime));
  $rows = mysqli_num_rows($rsregime);
  if($rows > 0) {
      mysqli_data_seek($rsregime, 0);
	  $row_rsregime = mysqli_fetch_assoc($rsregime);
  }
?>
    </select>
   </td>
   <td><label for="field3">From(Date) : </label></td>
  <td>
    <input type="text" name="pfrom" id="pfrom"   value="" />
  </td>
  <td><label for="field3">To(Date) : </label></td>
  <td>
  <input type="text" name="pto" id="pto"   value="" /></td>
  
 
  
  </tr>
  <tr>
  <td><label for="field3">Current Treatment Regime : </label></td>
  <td>
  
  <select name="ctr" id="ctr"  selected='selected' >
      <option value="0">Regime Type</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsregime['type']?>"><?php echo $row_rsregime['type']; ?></option>
      <?php
} while ($row_rsregime = mysqli_fetch_assoc($rsregime));
  $rows = mysqli_num_rows($rsregime);
  if($rows > 0) {
      mysqli_data_seek($rsregime, 0);
	  $row_rsregime = mysqli_fetch_assoc($rsregime);
  }
?>
    </select></td>
  <td><label for="field3">From(Date) : </label></td>
  <td>
    
    <input type="text" name="cfrom" id="cfrom"   value="" />
   </td>
  <td><label for="field3">To(Date) : </label></td>
  <td>
    <input type="text" name="cto" id="cto"   value="" />
    </td>
        
  </tr>
  <tr>
  <td><label for="field3">Date of last treatment : </label></td>
  <td>
    <input type="text" name="lastTdate" id="lastTdate"   value="" />
  </td>
        
  </tr>
  <tr>
  <td colspan="6">
  <div id="submit" align="center">
<input name="btnsubmit" type="submit" id="btnsubmit" value="Submit"  class="button"> 
 </div></td>
      </tr>
  </table>
  
</form>
 </div>

	
		
<div class="clearer">&nbsp;</div>

	  </div>
	</div>
</div>
</div>



</body>
</html>
<?php
include("../includes/footer.php");

@mysqli_free_result($update);
@mysqli_free_result($rssamp);
?>
