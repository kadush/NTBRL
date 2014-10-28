<?php
session_start();
require('phpmailer/class.phpmailer.php');

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
$emailaddress5="elvismuriithi@gmail.com";
$mail->From="eid-nairobi@googlegroups.com";

	$mail->FromName="NTBRL - Alerts";
	$mail->Sender="ntbrl007@gmail.com";
	$mail->AddReplyTo("ntbrl007@gmail.com.", "NTBRL - Alerts");
	$mail->AddAddress($contactemail);
	//$mail->AddCC($emailaddress);
	$mail->AddBCC($emailaddress);
	$mail->AddBCC($emailaddress2);
	$mail->AddBCC($emailaddress3);
	$mail->AddBCC($emailaddress4);
	$mail->AddBCC($emailaddress5);

$mail->Subject = $subject;
$mail->IsHTML(false);

//$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
$mail->Body = "
Jeremiah, 

Site $facilityname assessment data has been successfully saved.

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
	ECHO "SUCCESS";
	/*echo '<script type="text/javascript">' ;
	echo "window.location.href='emailpartnerindividualresults.php?ID=$batchno&labtestedin=$labtestedin&facility=$facility&mainemail=$contactemail&alternateemail=$emailaddress&contactpersonname=$contactpersonname&feedback=$feedback'";
	echo '</script>';
  */
 
}

?>