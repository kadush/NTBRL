<?php
require('phpmailer/class.phpmailer.php');
@require_once('connection/db.php'); 
if (isset($_GET['id'])){
		$SampleID = $_GET['id'];
		
	}

mysql_select_db($database, $ntrl);
$query_rssamp = "SELECT * FROM sample1 WHERE sample1.lab_no='$SampleID'";

$rssamp = mysql_query($query_rssamp, $ntrl) or die(mysql_error());
$row_rssamp = mysql_fetch_assoc($rssamp);
$totalRows_rssamp = mysql_num_rows($rssamp);

/*$table.='<table border="0" class="table table-bordered">
    <tr>
	    <td>Lab No. </td> 
		<td>Date Tested </td> 
		<td>Patient Name </td> 
		<td>Gender </td> 
		<td>Age </td> 
		<td>Patient Type </td> 
		<td>Mobile No. </td> 
		<td>Test Result </td> 
		<td>Technician </td> 
    </tr>
    <tr>
      <td>'.$row_rssamp['lab_no'].'</td>
      <td>'.$row_rssamp['coldate'].'</td>
      <td>'.$row_rssamp['fullname'].'</td>
      <td>'.$row_rssamp['gender'].'</td>
      <td>'.$row_rssamp['age'].'</td>
      <td>'.$row_rssamp['pat_type'].'</td>
      <td>'.$row_rssamp['mobile'].'</td>
      <td>'.$row_rssamp['Test_Result'].'</td>
      <td>'.$row_rssamp['User'].'</td>
    </tr>
   
  </table>';
*/

$mail = new PHPMailer();$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$subject="Test Result Alert";

$mail->Username = 'elvismuriithi@gmail.com';
$mail->Password = 'kadushqwer';
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Port = 465; 
$contactemail="elvismuriithi@yahoo.com";
//$emailaddress="tngugi@gmail.com";
//$emailaddress1="elvismuriithi@yahoo.com";
//$emailaddress2="bmungai@chskenya.org";
//$emailaddress3="jnjenga@chskenya.org";
//$emailaddress4="schebore@chskenya.org";
//$emailaddress5="jlusike@clintonhealthaccess.org";
$mail->From="elvismuriithi@gmail.com";
$mail->FromName="Test - Alerts";
$mail->Sender="elvismuriithi@gmail.com";
$mail->AddReplyTo("elvismuriithi@gmail.com.", "Test - Alerts");
$mail->AddAddress($contactemail);
//$mail->AddCC($emailaddress);
//$mail->AddCC($emailaddress1);
//$mail->AddCC($emailaddress2);
//$mail->AddCC($emailaddress3);
//$mail->AddCC($emailaddress4);
//$mail->AddCC($emailaddress5);
$mail->Subject = $subject;
$mail->IsHTML(TRUE);

//$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
$mail->Body = "
Hello Team, 

GeneXpert test for ".$row_rssamp['fullname']." was successfully done. Please notify the patient to visit the facility where the test was done from to collect the results. Below are the test summaries.\n

	    Lab No : ".$row_rssamp['lab_no']."
		, Date Tested : ".$row_rssamp['coldate']."\n
		, Patient Name : ".$row_rssamp['fullname']."\n
		, Gender : ".$row_rssamp['gender']."\n
		, Age : ".$row_rssamp['age']."\n
		, Patient Type : ".$row_rssamp['pat_type']."\n
		, Mobile No : ".$row_rssamp['mobile']."\n
		, MTB Result: ".$row_rssamp['Test_Result']."\n
		, MTB Rif: ".$row_rssamp['mtbRif']."\n
		, Technician : ".$row_rssamp['User']."\n.
    
Many Thanks.
--
TB Support Team

This email was automatically generated. Please do not respond to this email address or it will ignored.

";

if(!$mail->Send())
{
   $errormsg= 'Error sending Email';
 	echo '<script type="text/javascript">' ;
	echo "window.location.href='allsampleview.php?errormsg=$errormsg'";
	echo '</script>';
}
else
{
     $suceessmsg = 'Email Sent Sucessfully';
     echo '<script type="text/javascript">' ;
	 echo "window.location.href='allsampleview.php?suceessmsg=$suceessmsg'";
	 echo '</script>';

}

?>