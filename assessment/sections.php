 <?php
include("assessheader.php");
require_once('../connection/db.php'); 

// Make the connection:
$conn = mysql_connect($hostname, $username, $password);


mysql_select_db('db_ntrl');

$query_rsfacilitys = "SELECT facilitys.facilitycode, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysql_query($query_rsfacilitys, $conn) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);

$query_rstype_of_patient = "SELECT type_of_patient.id, type_of_patient.type FROM type_of_patient ORDER BY type_of_patient.id";
$rstype_of_patient = mysql_query($query_rstype_of_patient, $conn) or die(mysql_error());
$row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
$totalRows_rstype_of_patient = mysql_num_rows($rstype_of_patient);

$query_rsfacSEC = "SELECT s1.id as ID,s1.facility as CODE,s2.name as FNAME
FROM section1 s1 
LEFT JOIN facilitys s2 ON s2.facilitycode=s1.facility
ORDER by s1.id desc
LIMIT 1";
$rsfacSEC = mysql_query($query_rsfacSEC, $conn) or die(mysql_error());
$row_rsfacSEC = mysql_fetch_assoc($rsfacSEC);


?>
<?php

if (isset($_POST["submitsection1"])) {
	
$sql=
"INSERT INTO section1 (facility,assessor,doa,medName,medPhone,TbName,TbPhone,labName,labPhone,gName,gPhone,DtName,DtPhone)
VALUES('$_POST[faciltyN]',
'$_POST[assessor]',
'$_POST[date]',
'$_POST[medname]',
'$_POST[medphone]',
'$_POST[TBname]',
'$_POST[TBphone]',
'$_POST[labname]',
'$_POST[labphone]',
'$_POST[Gname]',
'$_POST[Gphone]',
'$_POST[DtName]',
'$_POST[DtPhone]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}


echo "<script>";
    echo "window.location.href='sections.php?#fragment-2'";
   echo "</script>";


$query_rsfacSEC = "SELECT s1.id as ID,s1.facility as CODE,s2.name as FNAME
FROM section1 s1 
LEFT JOIN facilitys s2 ON s2.facilitycode=s1.facility
ORDER by s1.id desc
LIMIT 1";
$rsfacSEC = mysql_query($query_rsfacSEC, $conn) or die(mysql_error());
$row_rsfacSEC = mysql_fetch_assoc($rsfacSEC);


}   
mysql_close($conn);




?>
<?php

if (isset($_POST["submitsection2"])) {
	
$sql=
"INSERT INTO section2 (facility,cumulative,tbpermonth,mtb,hiv,followup,treatment,list,posfollow,hivtest,tbtest,challenges)
VALUES('$_POST[facility]',
'$_POST[cumulativeTB]',
'$_POST[TBpermonth]',
'$_POST[MTB]',
'$_POST[hiv]',
'$_POST[follow]',
'$_POST[treat]',
'$_POST[site]',
'$_POST[come]',
'$_POST[hivtest]',
'$_POST[tbtest]',
'$_POST[challenges]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

   echo "<script>";
    echo "window.location.href='sections.php?#fragment-3'";
   echo "</script>";
mysql_close($conn);
}



?>
<?php

if (isset($_POST["submitsection3"])) {
	
$sql=
"INSERT INTO section3 (`facility`, `make`, `serial`, `make2`, `serial2`, `make3`, `serial3`, `make4`, `serial4`, `make5`, `serial5`, `online`, `computer`, `os`, `ram`, `cpu`, `space`, `policy`, `lis`, `server`, `lisreport`, `network`, `net_connection`, `pay`, `availability`, `convenience`, `data`, `provider`)
VALUES('$_POST[facility]',
'$_POST[make]',
'$_POST[serial]',
'$_POST[make2]',
'$_POST[serial2]',
'$_POST[make3]',
'$_POST[serial3]',
'$_POST[make4]',
'$_POST[serial4]',
'$_POST[make5]',
'$_POST[serial5]',
'$_POST[local]',
'$_POST[comp]',
'$_POST[os]',
'$_POST[ram]',
'$_POST[cpu]',
'$_POST[space]',
'$_POST[policies]',
'$_POST[lis]',
'$_POST[server]',
'$_POST[lisrep]',
'$_POST[netwak]',
'$_POST[internet]',
'$_POST[pay]',
'$_POST[available]',
'$_POST[fast]',
'$_POST[connect]',
'$_POST[provider]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

   echo "<script>";
    echo "window.location.href='sections.php?#fragment-4'";
   echo "</script>";
mysql_close($conn);
}



?>
<?php

if (isset($_POST["submitsection4"])) {
	
$sql=
"INSERT INTO section4(`facility`, `reference`, `test`, `distance`, `sample`, `frequency`)
VALUES('$_POST[facility]','$_POST[Rfacility]','$_POST[test]','$_POST[distance]','$_POST[sample]','$_POST[frequency]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

echo "<script>";
echo "window.location.href='sections.php?#fragment-4'";
echo "</script>";
mysql_close($conn);
}
?>
<?php
if (isset($_POST["submitsection5"])) {
	
$sql=
"INSERT INTO section5 ( `facility`, `ttest`, `mtb`, `Rifampicin`, `recsample`, `workflow`, `resultreturn`, `resultback`, `format`, `microscopy`, `ptype`, `rif`, `sampleNO`, `recorded`)
VALUES('$_POST[facility]',
'$_POST[ttest]',
'$_POST[mtb]',
'$_POST[Rifampicin]',
'$_POST[recsample]',
'$_POST[workflow]',
'$_POST[resultreturn]',
'$_POST[resultback]',
'$_POST[format]',
'$_POST[microscopy]',
'$_POST[ptype]',
'$_POST[rif]',
'$_POST[sampleNO]',
'$_POST[recorded]')";


	
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

   echo "<script>";
    echo "window.location.href='sections.php?#fragment-6'";
   echo "</script>";
mysql_close($conn);
}

?>

<?php

if (isset($_POST["submitsection6"])) {
	
	$XpertTracking=$_POST['Xpert'].$_POST['Xpert1'];
	$emergencykits=$_POST['emergency'].$_POST['we'];
$sql=
"INSERT INTO section6 (`facility` ,`responsible`,`testtype`, `distribution`, `timeframe`, `day`, `send`, `contactperson`, `name`, `no`, `emergencykits`, `XpertTracking`, `system`, `howoften`, `Kitsstored`, `Managed`,`com`)
VALUES('$_POST[facility]',
'$_POST[responsible]',
'$_POST[testtype]',
'$_POST[distribution]',
'$_POST[timeframe]',
'$_POST[day]',
'$_POST[send]',
'$_POST[contactperson]',
'$_POST[name]',
'$_POST[no]',
'".$emergencykits."',
'".$XpertTracking."',
'$_POST[system]',
'$_POST[howoften]',
'$_POST[Kitsstored]',
'$_POST[Managed]',
'$_POST[com]')";


$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}

require('../phpmailer/class.phpmailer.php');

$mail = new PHPMailer();$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
/*$mail->Username = 'alupe.eid@gmail.com';
$mail->Password = 'alupepassword';*/
$subject="Site Assessment Alert";

$mail->Username = 'ntbrl007@gmail.com';
	$mail->Password = 'masaiboy7';
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Port = 465; 
  $contactemail="jeergo@yahoo.com";
  $emailaddress="jlusike@clintonhealthaccess.org";
  $emailaddress2="onjathi@clintonhealthaccess.org";
  $emailaddress3="tngugi@clintonhealthaccess.org";
  $emailaddress4="klukondo@gmail.com";
  $emailaddress5="elvismuriithi@gmail.com ";
  $mail->From="eid-nairobi@googlegroups.com";

	$mail->FromName="NTBRL - Alerts";
	$mail->Sender="ntbrl007@gmail.com";
	$mail->AddReplyTo("ntbrl007@gmail.com.", "NTBRL - Alerts");
	$mail->AddAddress($contactemail);
	//$mail->AddCC($emailaddress);
	$mail->AddCC($emailaddress);
	$mail->AddCC($emailaddress2);
	$mail->AddCC($emailaddress3);
	$mail->AddCC($emailaddress4);
	$mail->AddCC($emailaddress5);

$mail->Subject = $subject;
$mail->IsHTML(false);

//$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
$mail->Body = "
Jeremiah, 

".$row_rsfacSEC['FNAME']. " assessment data has been successfully saved.

Many Thanks.
--
TB Support Team

This email was automatically generated. Please do not respond to this email address or it will ignored.


";
if(!$mail->Send())
{
   $errorsending= $batchno ." Error sending : " . $mail->ErrorInfo;
 	/*  echo '<script type="text/javascript">' ;
	echo "window.location.href='partnerbatchdetails.php?errorsending=$errorsending&ID=$batchno'";
	echo '</script>';*/
}
else
{
	
	echo "<script>";
    echo "window.location.href='sections.php?#fragment-1'";
    echo "</script>";
	
	
}

mysql_close($conn);
}



?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen"    required  />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
	<script src="../jquery-ui-1.10.3/tests/jquery-1.9.1.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.mouse.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.resizable.js"></script>
	<script src="../jquery-ui-1.10.3/ui/jquery.ui.accordion.js"></script>
    <script src="../jquery-ui-1.10.3/ui/jquery.ui.tabs.js"></script>
<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.datepicker.css">
<script src="../jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
 <script type="text/javascript">
$(function() {
$( "#tabs" ).tabs();
});

$(function() {
        $( "#date" ).datepicker({ altField: "#date",altFormat: "d-MM-yy",maxDate : "0D" });
		
	

    });
	
  
</script>

<script type="text/javascript">
$(document).ready( function (){
	  
  $("#gene2").click(function(){
  $("#make2").prop("disabled", !$(this).is(':checked'));
  $("#serial2").prop("disabled", !$(this).is(':checked'));
});

$("#gene3").click(function(){
  $("#make3").prop("disabled", !$(this).is(':checked'));
  $("#serial3").prop("disabled", !$(this).is(':checked'));
});

$("#gene4").click(function(){
  $("#make4").prop("disabled", !$(this).is(':checked'));
  $("#serial4").prop("disabled", !$(this).is(':checked'));
});

  $("#gene5").click(function(){
  $("#make5").prop("disabled", !$(this).is(':checked'));
  $("#serial5").prop("disabled", !$(this).is(':checked'));
});

	$('#challenges').click(function(){
    var final = '';
        $('.challenge:checked').each(function(){        
        var values = $(this).val();
        final += values+',';
		$('#challenges').val(final);
    });
    
	});
	
	$('#emergency').change(function () {
		if ($(this).find('option:selected').text() == "Other")
        $('#we').prop('disabled', false);
    else {
		$('#we').val('');
        $('#we').prop('disabled',true );
    }
	
});
$('#Xpert').change(function () {
		if ($(this).find('option:selected').text() == "Other")
        $('#Xpert1').prop('disabled', false);
		
    else {
		$('#Xpert1').val('');
        $('#Xpert1').prop('disabled',true );
    }
});



});


</script>
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

	<div class="left" id="main-left">
           
         <div id="tabs">
<ul>
                 <li><a href="#fragment-1">Section I</a></li>
                 <li><a href="#fragment-2">Section II</a></li>
                 <li><a href="#fragment-3">Section III</a></li>
                 <li><a href="#fragment-4">Section IV</a></li>
                 <li><a href="#fragment-5">Section V</a></li>
                 <li><a href="#fragment-6">Section VI</a></li>
                </ul>
                
                
                
             <div id="fragment-1">
             
          <form name="save" method="post">
        
        <table  border="1" cellpadding="0" cellspacing="0" class="data-table" >	
        <tr>
        <th>
        		<h3>Section 1.1 </h3>
        </th>
        </tr>
        <tr class='even'>
        
		<th style="font-size:9px;">Name of Assessor:</th>
        <td><input type="text" name="assessor" id="assessor"    required  /></td>
        <th style="font-size:9px;">Date of Assessment:</th>
        <td><input type="text" name="date" id="date"   value=""    required  /></td>
        </tr>
        
        <tr class='odd'>
		<th style="font-size:9px;">Facility Name:	</th>
        <td colspan="3">
        
        <select name="faciltyN" id="faciltyN" selected='selected' >
      <option value="0">Select Facility</option>
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
        <th>
        		<h3>Section 1.2 </h3>
        </th>
        </tr>
       
       	
		<tr class='odd'>
		<th style="font-size:9px;">Position: </th>
        
        <th style="font-size:9px;">Name:</th>
        
        <th style="font-size:9px;" colspan="2">Phone Number:</th>
        </tr>
        
        <tr class='even'>
		<th style="font-size:9px;">Medical Superintendent/ Facility in-charge:	</th>
        <td><input type="text" name="medname" id="medname"    required  /></td>
        <td colspan="2"><input type="text" name="medphone" id="medphone"   value=""    required  /></td>
        </tr>
        
         <tr class='odd'>
		<th style="font-size:9px;">TB Clinic in-charge:	</th>
        <td><input type="text" name="TBname" id="TBname"    required  /></td>
        <td colspan="2"><input type="text" name="TBphone" id="TBphone"   value=""    required  /></td>
        </tr>
        
        <tr class='even'>
		<th style="font-size:9px;">Lab Manager	:	</th>
        <td><input type="text" name="labname" id="labname"    required  /></td>
        <td colspan="2"><input type="text" name="labphone" id="labphone"   value=""    required  /></td>
        </tr>
        
        <tr class='odd'>
		<th style="font-size:9px; font-weight:bold;">GeneXpert bench Tech:	</th>
        <td><input type="text" name="Gname" id="Gname"    required  /></td>
        <td colspan="2"><input type="text" name="Gphone" id="Gphone"   value=""    required  /></td>
        </tr>
       <tr class='even'>
		<th style="font-size:9px; font-weight:bold;">DTLC:	</th>
        <td ><input type="text" name="DtName" id="DtName"  /></td>
        <td colspan="2"><input type="text" name="DtPhone" id="DtPhone"     /></td>
        </tr> 
        <tr>
         <div id="submit" align="center" >
            <input type="submit" name="submitsection1" id="submitsection1" value="Save & Continue"  class="button" />
          </div>
          </tr>
</table>
              </form>
           </div>
            
            
             <div id="fragment-2">
             
            <form name="save2" method="post">
            <table class="data-table" border="1">
            <tr> 
		<th><h3>Section 2.1 </h3></th>
        </tr>
        <tr>
        <td>
		<div>
        
			<p>
            <label>Facility Name:</label><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC['CODE']; ?>"    required  /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC['FNAME']; ?>" disabled   required  /></p>
            <p>
            <label> Cumulative no of TB patients (in the last 3 years):  </label>
            <input type="text" name="cumulativeTB" id="cumulativeTB" width="40px"   required  />
            </p>
			<p>
			  <label> No of patients with presumptive TB per month: </label>
              <input type="text" name="TBpermonth" id="TBpermonth" width="40px"   required  />
		  </p>
			<p>
			  <label >No of MDR-TB suspects/month (contacts, retreatment, relapses, non-converters):  </label>
               <input type="text" name="MTB" id="MTB" width="40px"   required  />
		  </p>
			<p>
			  <label>No  of TB patients on HIV care and treatment:</label>
			  <input type="text" name="hiv" id="hiv" width="40px"   required  />
		  </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        		<h3>Section 2.2 </h3>
        </th>
        </tr>
        <tr>
        <td>        
		<div>
			<p><label>How are patients followed up when their results come back? </label>
       <select name="follow" id="follow"  >
      <option value="0">Select One</option>
      <option value="Patients told to come back on certain date">Patients told to come back on certain date</option>
      <option value="Contacted via phone when results are in">Contacted via phone when results are in</option>
      <option value="Health workers find them during outreach session's">Health workers find them during outreach session's</option>
      <option value="Wait for patients to come back to facility">Wait for patients to come back to facility</option>
      
    </select>     
            
            </p>
		</div>
        
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 2.3</h3>
        </th>
        </tr>
        <tr>
        <td>
		<div>
			<p><label>Where are patients initiated on treatment?</label>
            
            <select name="treat" id="treat"  >
      <option value="0">Select One</option>
      <option value="At this facility when they come to collect their results">At this facility when they come to collect their results       </option>
      <option value="Referred to a different facility to obtain treatment">Referred to a different facility to obtain treatment</option>
      
    </select>
             </p>
			
		</div>
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 2.4</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>If referred to a different facility, is the list of patients initiated sent back from the treatment site?</label>
            
            <select name="site" id="site"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> </p>
		</div>
        
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.5</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>How many patients initiated come for follow up visits (ONLY answer if treatment at this facility) </label>
      <select name="come" id="come"  >
      <option value="0">Select One</option>
      <option value="Less than 10%">Less than 10%</option>
      <option value="10-20%">10-20%</option>
      <option value="20-30%">20-30%</option>
      <option value="30-40%">30-40%</option>
      <option value="40-50% ">40-50%</option>
      <option value="50-60%">50-60%</option>
      <option value="60-75%">60-75%</option>
      <option value="75-100%">75-100%</option>
    </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.6</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>Are all patients that come in for a TB test also given an HIV test?</label> 
      <select name="hivtest" id="hivtest"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.7</h3>
        </th>
        <tr>
        <td>
		<div>
			<p><label>Are all patients that come in for an HIV treatment screened and tested for TB test?</label>
      <select name="tbtest" id="tbtest"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 2.8</h3>
        </th>
        <tr>
        <td>
        <div>
			
           <p><label> What are the biggest challenges when it comes to tuberculosis care?</label>  
            </p>
            <input type="checkbox" id="chal0" class="challenge" value="Patient identification number" > Patient identification number	
            
            
            
    <input type="checkbox" id="chal1" class="challenge" value="Access to testing" > Access to testing
    
    
    
    <input type="checkbox" id="chal2" class="challenge" value="Delivering results to patients"  > Delivering results to patients         
     
    <input type="checkbox" id="chal3" class="challenge" value="Long turnaround times for receiving results " > Long turnaround times for receiving results 
    
    
    
    <input type="checkbox" id="chal4" class="challenge" value="Linking patients to treatment" > Linking patients to treatment	
    
   
    <input type="checkbox" id="chal5" class="challenge" value="Identifying TB co-infections among HIV patients" > Identifying TB co-infections among HIV patients
    
 <p>
            <textarea name="challenges" id="challenges" rows="4" cols="50" required> 
             </textarea> 
   </p>
		</div>
        </td>
        </tr>
        
        <tr>
        
        <div id="submit" align="center">
<input name="submitsection2" type="submit" id="submitsection2" value="Save & Continue"  class="button" /> 
 </div>
            
         </tr>
         </table>
         </form>
         
         
         </div>
         
         
         
          <div id="fragment-3">
            
            <form name="save3" method="post">
            <table class="data-table" border="1">
            <tr> 
		<th width="65%"><h3>Section 3.1 </h3></th>
        </tr>
        <tr>
        <td>
        
          
		<div>
        <p>
            <label>Facility Name:</label><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC['CODE']; ?>"    required  /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC['FNAME']; ?>" disabled   required  /></p>
			<p><label>What is the make, model and serial number of the GeneXpert instrument?</label></p>
		  
            <ul>
				<table border="1" cellpadding="0" cellspacing="0" class="data-table" width="100%">
                <tr>
                <th style="font-size:9px;">#</th>
                <th style="font-size:9px;">GeneXpert1</th>
                <th style="font-size:9px;"><input type="checkbox" name="gene2" id="gene2" />GeneXpert2</th>
                <th style="font-size:9px;"><input type="checkbox" class="gene3"  id="gene3" />GeneXpert3</th>
                <th style="font-size:9px;"><input type="checkbox" class="gene4"  id="gene4" />GeneXpert4</th>
                <th style="font-size:9px;"><input type="checkbox" class="gene5"  id="gene5" />GeneXpert5</th>
                </tr>
                <tr>
                <th style="font-size:9px;">Make and model:</th>
                <td><input type="text" name="make" id="make"    required  /></td>
                 <td><input type="text" name="make2" id="make2" disabled="disabled"     /></td>
                  <td><input type="text" name="make3" id="make3"  disabled="disabled"     /></td>
                   <td><input type="text" name="make4" id="make4" disabled="disabled"      /></td>
                    <td><input type="text" name="make5" id="make5"disabled="disabled"       /></td>
                </tr>
                <tr>
                <th style="font-size:9px;">Serial No:</th>
                <td><input type="text" name="serial" id="serial" required  /></td>
                <td><input type="text" name="serial2" id="serial2" disabled="disabled"   /></td>
                <td><input type="text" name="serial3" id="serial3" disabled="disabled"   /></td>
                <td><input type="text" name="serial4" id="serial4" disabled="disabled"   /></td>
                <td><input type="text" name="serial5" id="serial5" disabled="disabled"   /></td>
                
                </tr>
                </table>
                
                
				
			</ul>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        
		<h3>Section 3.2</h3>
       </th>
       </tr>
       	
        <tr>
        <td>
        <div>
			<p><label>Is there local support and/ online support for the instrument?  </label>
            <select name="local" id="local"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> </p>
    </div>
            </td>
            </tr>
		
      <tr>
        <th>        
		<h3>Section 3.3</h3>
        </th>
        </tr>
		
        <tr>
        <td><div>
        
        
	    <p><label>At the site, is there a computer (desktop/ laptop) that can be configured to be used to run the instruments' software LIMS? </label>
        <select name="comp" id="comp"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select> 
        </p>
        </div>
        </td>
        </tr>
        <tr>
        <td>
        <div>
        <label>If so what are the hardware and software specifications?</label>
			<ul>
                <li>Operating System:<input type="text" name="os" id="os"/></li>
				<li>RAM (Random Access Memory:<input type="text" name="ram" id="ram" /></li>
				<li>CPU Processor speed:<input type="text" name="cpu" id="cpu" /></li>
				<li>Hard disk space:<input type="text" name="space" id="space" /></li>
			</ul>
            </div>
          </td>
          </tr>  
		
        <tr>
        <th>
		<h3>Section 3.4</h3>
        </th>
		
        <tr>
        <td><div>
		  <p><label>Are there any existing polices on software installation and configuration on the computers?</label>
          <select name="policies" id="policies"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select>
          </p>
          </div>
          </td>
          </tr>
		
        <tr>
        <th>
        <h3>Section 3.5</h3>
        </th>
        </tr>
		
        <tr>
        <td><div>
		  <p><label>Is there an existing LIS (Laboratory Information System)? </label>
          <select name="lis" id="lis"  >
      
      
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
          </p>
          </div>
        </td>
        </tr>
        <tr>
        <td>
        <div>
          <p>
          <label>If yes, please specify the details including the name, the vendor etc</label>
              <ul>       
                <li>Is it LIS HL7 (server) compliant? <select name="server" id="server"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></li>
                <li> How is the reporting done on LIS?<textarea name="lisrep" id="lisrep"    required  ></textarea></li></li>
              </ul>
          </p>
          
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 3.6</h3>
        </th>
        </tr>
		
        <tr>
        <td>
        <div>
		  <p><label>Is there an existing network infrastructure and if so, what are the specific design configurations (LAN (Local Area Network), W-LAN)?</label>
          <select name="netwak" id="netwak"  >
     <option value="0">Select One</option>
      <option value="LAN">LAN</option>
      <option value="Modem">Modem</option>
      <option value="wireless">wireless</option>
      
    </select>
          </p>
		 </div>
        </td>
       </tr>
       
        <tr>
        <th>
        <h3>Section 3.7</h3>
        </th>
		
        <tr>
        <td>
        <div>
		  <p><label> Does the lab section have access to stable Internet? </label>
          <select name="internet" id="internet"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select>
          
          <ul>       
                <li>If yes, who pays for internet?<input type="text" name="pay" id="pay"  /> </li>
                <li>How many days per week is it available?<input type="text" name="available" id="available"  /></li>
                <li>How fast is the Internet connection?<input type="text" name="fast" id="fast"  /> </li>
          </ul>
          </p>
          </div>
          </td>
          </tr>
		
        <tr>
        <th>
        <h3>Section 3.8</h3>
        </th>
        </tr>
        <tr>
        <td>
		<div>
		  <p><label>What do you use to connect to the Internet? </label>
          
          <select name="connect" id="connect"  >
      <option value="0">Select One</option>
      <option value="LAN">LAN</option>
      <option value="Modem">Modem</option>
      <option value="wireless">wireless</option>
    </select>
            </p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
        <h3>Section 3.9</h3>
        </th>
        <tr>
        <td>
		<div>
        
		  <p><label>What is the mobile company network coverage stable in you area</label>
          
          <select name="provider" id="provider"  >
      <option value="0">Select One</option>
      <option value="Safaricom">Safaricom</option>
      <option value="Zain">Zain</option>
      <option value="Yu">Yu</option>
       <option value="Orange">Orange</option>
    </select>
          </p>
          </div>
          </td>
          </tr>
          <tr>
		  <div id="submit" align="center" >
            <input type="submit" name="submitsection3" id="submitsection3" value="Save & Continue"  class="button" />
            </div>
            </tr>
           </table>
           </form> 
                 
                          
</div>
              
              
          <div id="fragment-4">
          
          <form name="save4" method="post">
          <table border='0' class='data-table'>	
          <tr colspan="2"><div style="background-color:#FF9"> NOTE:If a facility has more than one referral site,just click on Save & Continue and enter the other site.Else,click Section V to proceed with the next section</div></tr>
         <tr class='even'><input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC['CODE']; ?>"    required  />
           <th style="font-size:9px;">Name of Genexpert site</th>
           <td> <input type="facility" name="facility" id="facility"   value="<?php echo $row_rsfacSEC['FNAME']; ?>" disabled   required  /></td>
           </tr>
           <tr>
            <th style="font-size:9px;">Name of Referral site</th>
            <td> <select name="Rfacility" id="Rfacility" selected='selected' >
      <option value="0">Select Facility</option>
      <?php
do { 
?>
      <option value="<?php echo $row_rsfacilitys['name']?>"><?php echo $row_rsfacilitys['name']; ?></option>
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
            <th style="font-size:9px;">Type of test received from site? (Diagnosis or RIF  Resistance)
</th><td> <input type="text" name="test" id="test"   value=""    required  /></td>
</tr>
             <tr>
             <th style="font-size:9px;">Approximate distance from site</th> <td> <input type="text" name="distance" id="distance"   value=""    required  /></td></tr>
             <tr>
            <th style="font-size:9px;">Average Number of Samples per Week</th><td> <input type="text" name="sample" id="sample"   value=""    required  /></td></tr>
             <tr><th style="font-size:9px;">Frequency of sample referral </th><td> <input type="text" name="frequency" id="frequency"   value=""    required  /></td></tr>
            
              
          
            
            <tr>
              <div id="submit" align="center" >
            <input type="submit" name="submitsection4" id="submitsection4" value="Save & Continue"  class="button" />
            </div>
            </tr>
            </table>
          
          </form>
             
            
</div>
              
              
         <div id="fragment-5">
        <form name="save4" method="post">
          <table border='0' class='data-table'>	
		    <tr class='even'>
            <th>
           <h3>Section 5.1</h3>
           </th>
           
           <tr>
           <td>
		<div>
            <p>
              <label>Facility Name:</label>
              <input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC['CODE']; ?>"    required  /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC['FNAME']; ?>" disabled   required  />
            </p>
            
            
			<p><strong>Total tests performed?<input type="text" name="ttest" id="ttest"   value=""    required  /></strong></p>
			<p><strong>MTB  detected</strong><input type="text" name="mtb" id="mtb"   value=""    required  /></p>
			<p><strong>RIF </strong><em>(Rifampicin)</em><strong>Resistant</strong><input type="text" name="Rifampicin" id="Rifampicin"   value=""    required  /></p>
		</div>
        </td>
        </tr>
        <tr>
        <th>
		<h3>Section 5.2</h3>
        </th>
        <tr>
        <td>
		<div>
		  <p><strong>How are samples  received in the lab recorded </strong><em>(workflow from sample receipt to processing)</em><strong>?</strong><textarea name="recsample" id="recsample"   value=""    required>  </textarea></p>
		  <p><strong>How is the  workflow managed?</strong><select name="workflow" id="workflow"   value="">
          
           <option value="0">Select One</option>
      <option value="LIMS">LIMS</option>
      <option value="Lab Register">Lab Register</option>
      <option value="other (please specify) ">other (please specify) </option>
         
          </select></p>
</div>
       </td>
       </tr>
        <tr>
        <th>
		<h3>Section 5.3</h3>
        </th>
         <tr>
        <td>
		<div>
	    <p><strong>What  is the average turn around time from sample collection to results being  returned to clinic or patients?</strong></p>
	    <p><strong>Results  returned within the facility to TB Clinic? </strong><input type="text" name="resultreturn" id="resultreturn"   value=""    required  /></p>
	    <p><strong>Results  returned to referring facilities?</strong><input type="text" name="resultback" id="resultback"   value=""    required  /></p>
			
		</div>
        </td>
       </tr>
         <tr>
        <th>
        
		<h3>Section 5.4</h3>
        </th>
         <tr>
        <td>
		<div>
		  <p><strong>What  is the standard format used to relay results to clinicians?</strong>
          <select name="format" id="format"  >
      <option value="0">Select One</option>
      <option value="hard copy (replicate of request form)"> hard copy (replicate of request form)</option>
      <option value="hardcopy (GeneXpert printout)">hardcopy (GeneXpert printout)</option>
      <option value="email">email</option>
     		
    </select></p>
		</div>
        </td>
        </tr>
         <tr>
        <th>
        <h3>Section 5.5</h3>
        </th>
        </tr>
         <tr>
        <td>
		<div>
		  <p><strong>Does the facility  still use sputum microscopy for TB detection?</strong><select name="microscopy" id="microscopy"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		  <p><strong> If yes, please specify under  which cases microscopy is carried out</strong> <select name="ptype" id="ptype"  selected='selected'>
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
    </select></p>
        </div>
</td>
</tr>
        <tr>
        <th>
        <h3>Section 5.6</h3>
        </th>
         <tr>
        <td>
		<div>
		  <p><strong>Are  RIF resistance cases referred to the NTRL for DST </strong>(1-09-2012-30-08-2013)<strong>? </strong><select name="rif" id="rif"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		  <p><strong>If yes, how many samples have been referred to NTRL?</strong><input type="text" name="sampleNO" id="sampleNO"      /></p>
		</div>
        </td>
        </tr>
         <tr>
        <th>
        <h3>Section 5.7</h3>
        </th>
        </tr>
         <tr>
        <td>
		<div>
		  <p><strong>How are results from NTRL recorded in the facility? </strong><select name="recorded" id="recorded"  >
      <option value="0">Select One</option>
      <option value="Using a folder"> Using a folder</option>
      <option value="Using a referral lab register">Using a referral lab register	</option>
       <option value="using LIMS">using LIMS	</option>
     <option value="other (please specify) ">other (please specify) </option>
    </select></p>
		</div>
           </td>
           </tr>
           <tr>
           <div id="submit" align="center" >
            <input type="submit" name="submitsection5" id="submitsection5" value="Save & Continue"  class="button" />
            </div>
         
            </tr>
              
            </table>
            </form>
             </div >
          
                           
         <div id="fragment-6">
         <form name="save6" method="post">
          <table border='0' class='data-table'>	
          <tr>
          <th>
             <h3>Section 6.1</h3>
           </th> 
           </tr>
           <tr>
          <td> 
		<div>
            <p>
              <label>Facility Name:</label>
              <input type="hidden" name="facility" id="facility" value="<?php echo $row_rsfacSEC['CODE']; ?>"    required  /><input type="text" name="facilityN" id="facilityN" width="40px" value="<?php echo $row_rsfacSEC['FNAME']; ?>" disabled   required  />
            </p>
            <p><strong>Who is  responsible for supplying GeneXpert reagents and commodities to the facility?</strong>
              <select name="responsible" id="responsible"  >
                <option value="0">Select One</option>
                <option value="Partner Budget (specify which tests)">Partner Budget (specify which tests)</option>
                <option value="CMS (KEMSA) (specify which tests)">CMS (KEMSA) (specify which tests)</option>
                
              </select>
              </p>
              <p>
              <label>Type of tests</label><input type="text" name="testtype" id="testtype" />
            </p>
</div>
</td>
</tr>
<tr>
          <th>
		<h3>Section 6.2</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How  are lab supplies distributed?</strong><select name="distribution" id="distribution"  >
      <option value="0">Select One</option>
      <option value="Pull System"> Pull System</option>
      <option value="Push System">Push System	</option>
            		
    </select></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
		<h3>Section 6.3</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
	    <p><strong>If pull system, what is the timeframe for these deliveries? Are lab supplies  ordered and delivered in the same timeframe each time? (i.e. quarterly,  monthly)</strong>
                
      <select name="timeframe" id="timeframe"   >
      <option value="0">Select One</option>
      <option value="Weekly"> Weekly</option>
      <option value="Monthly">Monthly	</option>
      <option value="Quarterly">Quarterly	</option>
      <option value="Yearly">Yearly	</option>
      <option value="Others">Others	</option>
      </select>
    
        </p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
		<h3>Section 6.4</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>Is  there a set day when the facility reports on stock commodities?</strong><select name="day" id="day"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p> 
          <p><strong>If  yes, where does the facility send the stock commodity management report to?</strong><select name="send" id="send"  >
      <option value="0">Select One</option>
      <option value="KEMSA"> KEMSA</option>
      <option value="NTRL">NTRL	</option>
       <option value="NPHLS">NPHLS	</option>
       <option value="Partner">Partner	</option>
     		
    </select></p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.5</h3>
        </th>
        </tr>
        <tr>
          <td>
          <div>
	  <p><strong>Is there a contact  officer at the district for the facility to call with issues or queries  regarding stock levels of lab commodities?</strong><select name="contactperson" id="contactperson"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      
    </select></p>
		  <p>If yes, specify who
		  	<ul>
          <li>Contact  Name:<input type="text" name="name" id="name"     /></li>
		   <li> Contact  Number:<input type="text" name="no" id="no"     /></li>
           </ul>
           </p>
        </div>
        </td>
       </tr>
       <tr>
          <th>
        <h3>Section 6.7</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How  many emergency GeneXpert kits have been ordered in the last year?</strong>
          
      <select ame="emergency" id="emergency" onChange="changetextbox(); ">
      <option value="0">Select One</option>
      <option value="1">1	</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="">Other</option>
     </select>
          <input type="text" name="we" id="we" disabled="disabled" />
          </p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.8</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>How are lab commodities for TB Xpert testing tracked and recorded at this facility?</strong> 
          <select name="Xpert" id="Xpert"  >
      <option value="0">Select One</option>
      <option value="Not recorded	">Not recorded	</option>
      <option value="Stock ledger book">Stock ledger book</option>
      <option value="Electronic system	">Electronic system	</option>
      <option value="">Other</option>
     		
    </select>
    <input type="text" name="Xpert1" id="Xpert1"  disabled="disabled" />
    
          </p>
		</div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.9</h3>
        </th>
        </tr><tr>
          <td>
		<div>
		  <p><strong>If  there is a system in place to monitor Xpert kits are these updated regularly?  </strong> <select name="system" id="system"  >
      <option value="0">Select One</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
     		
    </select></p>
          
          <p><strong>If yes, how often are these systems updated? </strong>
      <select name="howoften" id="howoften"   >
      <option value="0">Select One</option>
      <option value="Daily">Daily</option>
      <option value="Every 2-4 days">Every 2-4 days</option>
      <option value="Weekly">Weekly</option>
      <option value="Biweekly">Biweekly</option>
      <option value="Monthly">Monthly</option>
      <option value="During supervision">During supervision</option>
        		
       </select>
          
          </p>
        </div>
        </td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.10</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		  <p><strong>Where are TB Xpert testing Kits stored?</strong><textarea name="Kitsstored" id="Kitsstored" rows="4" cols="50">  </textarea> </p>
          <p><strong>If the kits are stored away from TB lab, how are they managed and dispensed to the lab?</strong><textarea name="Managed" id="Managed" rows="4" cols="50"> </textarea></p>
		</div>
		</td>
        </tr>
        <tr>
          <th>
        <h3>Section 6.11</h3>
        </th>
        </tr>
        <tr>
          <td>
		<div>
		 
          <p><strong>Additional Comments:</strong></p><p><textarea name="com" id="com" rows="4" cols="50"> </textarea></p>
		</div>
		</td>
        </tr>
                    
            <tr>
             <div id="submit" align="center" >
            <input type="submit" name="submitsection6" id="submitsection6" value="Save & Continue"  class="button" />
            </div>
              
        </tr>
              
            </table>
            </form>
          </div>
              
              
              
         </div>
         
     </div>
		</div>
<div class="clearer">&nbsp;</div>

	  
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>