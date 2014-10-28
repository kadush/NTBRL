<?php 
@require_once('connection/db.php'); 
if (isset($_GET['id'])){
		$SampleID = $_GET['id'];
		
	}

mysql_select_db($database, $ntrl);
$query_rssamp = "SELECT * FROM sample1 WHERE sample1.lab_no='$SampleID'";

$rssamp = mysql_query($query_rssamp, $ntrl) or die(mysql_error());
$row_rssamp = mysql_fetch_assoc($rssamp);
$totalRows_rssamp = mysql_num_rows($rssamp);

$rname=urlencode($row_rssamp['c_name']);
$rnamephone=urlencode($row_rssamp['c_no']);
$labno=urlencode($row_rssamp['lab_no']);
$opno=urlencode($row_rssamp['op_no']);
$pname=urlencode($row_rssamp['fullname']);
$mtb=urlencode($row_rssamp['Test_Result']);
$mtbrif=urlencode($row_rssamp['mtbRif']);

/*$message .= "Hello Team, 

GeneXpert test for ".$row_rssamp['fullname']." was successfully done. Please notify the patient to visit the facility where the test was done from to collect the results. Below are the tets summaries.

	    Lab No : ".$row_rssamp['lab_no']."
		Date Tested : ".$row_rssamp['coldate'].",
		Patient Name : ".$row_rssamp['fullname'].",
		Gender : ".$row_rssamp['gender'].",
		Age : ".$row_rssamp['age'].",
		Patient Type : ".$row_rssamp['pat_type'].",
		Mobile No : ".$row_rssamp['mobile'].",
		Test Result  ".$row_rssamp['Test_Result'].",
		Technician : ".$row_rssamp['User'].",
    
Many Thanks.
--
TB Support Team";
//echo $message;
exit;*/
//$rnamephone = "254723643694";

$x= file_get_contents("http://41.57.109.242:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$rnamephone&text=Hi+$rname+%0a+Genexpert+Test+Result+for+$pname+whose+Op/Ip+No+-+$opno+has+been+done.+%0a+The+outcome+is:+MTB+$mtb+n+MTBRif:+$mtbrif");

  echo 'sms sent';
	
/*if(!$x)
{
   $errormsg= 'Error sending SMS';
 	echo '<script type="text/javascript">' ;
	echo "window.location.href='allsampleview.php?errormsg=$errormsg'";
	echo '</script>';
}
else
{
     $suceessmsg = 'SMS Sent Sucessfully';
     echo '<script type="text/javascript">' ;
	 echo "window.location.href='allsampleview.php?suceessmsg=$suceessmsg'";
	 echo '</script>';

}*/
ob_flush();
?>