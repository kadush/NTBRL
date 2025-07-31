<?php
error_reporting(0);
require_once('connection/db.php');
require('phpmailer/class.phpmailer.php');

$json1 = file_get_contents('php://input');
$arr = json_decode($json1, true);
header("Content-Type:application/json");
if ($arr['password'] != '80SHe5MF7gM73t4aog5Q') {
	//echo "Authentication failed";
	header("HTTP/1.1 401");
} else {
	//get array values
	$uniqueId = mysqli_real_escape_string($dbConn, $arr['uniqueId']);
	$systemName = mysqli_real_escape_string($dbConn, $arr['systemName']);
	$exportedDate = mysqli_real_escape_string($dbConn, $arr['exportedDate']);
	$assay = mysqli_real_escape_string($dbConn, $arr['assays']);
	$assayVersion = mysqli_real_escape_string($dbConn, $arr['assayVersion']);
	$sampleid = mysqli_real_escape_string($dbConn, $arr['sampleId']);
	$patientId = mysqli_real_escape_string($dbConn, $arr['patientId']);
	$user = mysqli_real_escape_string($dbConn, $arr['user']);
	$status = mysqli_real_escape_string($dbConn, $arr['status']);
	$startTime = mysqli_real_escape_string($dbConn, $arr['startTime']);
	$endTime = mysqli_real_escape_string($dbConn, $arr['endTime']);
	$errorStatus = mysqli_real_escape_string($dbConn, $arr['errorStatus']);
	$errorCode = mysqli_real_escape_string($dbConn, $arr['errorCode']);
	$errorNotes = mysqli_real_escape_string($dbConn, $arr['errorNotes']);
	$reagentLotId = mysqli_real_escape_string($dbConn, $arr['reagentLotId']);
	$cartridgeExpirationDate = mysqli_real_escape_string($dbConn, $arr['cartridgeExpirationDate']);
	$cartridgeSerial = mysqli_real_escape_string($dbConn, $arr['cartridgeSerial']);
	$moduleName = mysqli_real_escape_string($dbConn, $arr['moduleName']);
	$moduleSerial = mysqli_real_escape_string($dbConn, $arr['moduleSerial']);
	$instrumentSerial = mysqli_real_escape_string($dbConn, $arr['instrumentSerial']);
	$softwareVersion = mysqli_real_escape_string($dbConn, $arr['softwareVersion']);
	$resultIdMtb = mysqli_real_escape_string($dbConn, $arr['resultIdMtb']);
	$facilitycode = mysqli_real_escape_string($dbConn, $arr['hostId']);

	if ($arr['resultIdMtb'] == 1) {
		$resultIdMtb = "Exclude";
	} elseif ($arr['resultIdMtb'] == 2) {
		$resultIdMtb = "Invalid";
	} elseif ($arr['resultIdMtb'] == 3) {
		$resultIdMtb = "Error";
	} elseif ($arr['resultIdMtb'] == 4) {
		$resultIdMtb = "Negative";
	} elseif ($arr['resultIdMtb'] == 5) {
		$resultIdMtb = "Positive";
	} elseif ($arr['resultIdMtb'] == 6) {
		$resultIdMtb = "Indeterminate";
	} elseif ($arr['resultIdMtb'] == 7) {
		$resultIdMtb = "No Result";
	} elseif ($arr['resultIdMtb'] == 8) {
		$resultIdMtb = "Trace";
	}
	$resultIdRif = $arr['resultIdRif'];
	if ($arr['resultIdRif'] == 1) {
		$resultIdRif = "Exclude";
	} elseif ($arr['resultIdRif'] == 2) {
		$resultIdRif = "Invalid";
	} elseif ($arr['resultIdRif'] == 3) {
		$resultIdRif = "Error";
	} elseif ($arr['resultIdRif'] == 4) {
		$resultIdRif = "Negative";
	} elseif ($arr['resultIdRif'] == 5) {
		$resultIdRif = "Positive";
	} elseif ($arr['resultIdRif'] == 6) {
		$resultIdRif = "Indeterminate";
	}
	$deviceSerial = mysqli_real_escape_string($dbConn, $arr['deviceSerial']);

	if ($softwareVersion == '4.6a') {
		$cartridgeSerial = $uniqueId;
	} else {
		$cartridgeSerial = $cartridgeSerial;
	}

	//checks if there is such a sample using cartridge no

	$sql = "SELECT ID as recordId, Refacility as referredFrom,op_no as outpatientNumber,op_no as inpatientNumber,regno as referringSiteNumber,fullname as patientName, gender as gender, age as age,ageb as ageType, mobile as patientCell,address as patientAddress,pat_type as caseDefinition,smear as smear,h_status as hiv,exam_req as examinationRequired,d_email as dtlcEmail,c_no as clinicianCell,c_name as clinicianName,c_email as clinicianEmail FROM sample1 where Cartridge_SN='$cartridgeSerial'  and facility='$facilitycode' LIMIT 1";
	$checkcartridge = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	$row_cartridge = @mysqli_fetch_assoc($checkSample);
	if (mysqli_num_rows($checkcartridge) == 1) {
		exit;
	} else {

		//checks if there is such a sample using lab no

		$sql = "SELECT ID as recordId, Refacility as referredFrom,op_no as outpatientNumber,op_no as inpatientNumber,regno as referringSiteNumber,fullname as patientName, gender as gender, age as age,ageb as ageType, mobile as patientCell,address as patientAddress,pat_type as caseDefinition,smear as smear,h_status as hiv,exam_req as examinationRequired,d_email as dtlcEmail,c_no as clinicianCell,c_name as clinicianName,c_email as clinicianEmail FROM sample1 where lab_no='$sampleid' LIMIT 1";
		$checkSample = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
		$row_rsFinC = mysqli_fetch_assoc($checkSample);

		//If sample is not found
		if (mysqli_num_rows($checkSample) == 0) {

			//insert new record
			/*	foreach ($arr as $key => $value)s
			{
			   $insert .= "`".$key."`,";
			   $insert1=trim($insert,',');
			   
			   $sql_insert .= "'".$value."',";
			   $sql_insert1=trim($sql_insert,',');
			}
			*/
			$sqlCN = "SELECT county,sub_county,facility FROM facility_map WHERE `mfl`='$facilitycode'";

			$qCN = mysqli_query($dbConn, $sqlCN) or die(mysqli_error($dbConn));
			$rwCN = mysqli_fetch_assoc($qCN);
			$cname = mysqli_real_escape_string($dbConn, $rwCN['county']); //name of county
			$scname = mysqli_real_escape_string($dbConn, $rwCN['sub_county']); //name of county
			$fcname = mysqli_real_escape_string($dbConn, $rwCN['facility']); //name of county
			$insert = "INSERT INTO sample1 (`unq_id`,`System_Name`, `Exported_Date`, `Reagent_Lot_Number`, `Sample_ID`, `Patient_ID`, `Assay`, `Assay_Version`, `User`, `Status`, `Start_Time`, `End_Time`, `Error_Status`, `Error_Code`, `Error_Notes`, `Expiration_Date`, `Cartridge_SN`, `Module_Name`, `Module_SN`, `Instrument_SN`, `SW_Version`,`GXSN`, `Test_Result`, `mtbRif`,`facility`,`Refacility`,`cond`,`on_off`,`specimen_type`,`county`,`sub_county`,`fname`,`ref_county`,`ref_sc`,`ref_fname`)
			  VALUES('" . $uniqueId . "','" . $systemName . "','" . $exportedDate . "','" . $reagentLotId . "','" . $sampleid . "','" . $patientId . "','" . $assay . "','" . $assayVersion . "','" . $user . "','" . $status . "','" . $startTime . "','" . $endTime . "','" . $errorStatus . "','" . $errorCode . "','" . $errorNotes . "','" . $cartridgeExpirationDate . "','" . $cartridgeSerial . "','" . $moduleName . "','" . $moduleSerial . "','" . $instrumentSerial . "','" . $softwareVersion . "','" . $deviceSerial . "','" . $resultIdMtb . "','" . $resultIdRif . "','" . $facilitycode . "','" . $facilitycode . "','1','0','Sputum','$cname','$scname','$fcname','$cname','$scname','$fcname')";

			$retval = mysqli_query($dbConn, $insert) or die(mysqli_error($dbConn));

			if (!$retval) {
				//echo "500";
				header("HTTP/1.1 500");
			} else {
				//echo 'New Sample found and it has been inserted';
				header("HTTP/1.1 201");
				//printf("Last inserted record has id %d\n", mysqli_insert_id());
				$newrec = mysqli_insert_id($dbConn);
				echo json_encode(array('recordId' => $newrec), JSON_NUMERIC_CHECK);
				exit;
			}
		} else {
			//getting contents of the sample
			//update existing
			/*foreach ($arr as $key => $value)
					{
					   $sql_Update .= $key." = '".$value."',";
					}
				$where="cond='1' WHERE lab_no='".$arr['sampleId']."'";*/


			$facilitycode = mysqli_real_escape_string($dbConn, $arr['hostId']);
			$update = "UPDATE sample1 SET `unq_id`='$uniqueId', `System_Name`='$systemName', `Exported_Date`='$exportedDate', `Reagent_Lot_Number`='$reagentLotId', `Sample_ID`='$sampleid', `Patient_ID`='$patientId', `Assay`='$assay', `Assay_Version`='$assayVersion', `User`='$user', `Status`='$status', `Start_Time`='$startTime', `End_Time`='$endTime', `Error_Status`='$errorStatus', `Error_Code`='$errorCode', `Error_Notes`='$errorNotes', `Expiration_Date`='$cartridgeExpirationDate', `Cartridge_SN`='$cartridgeSerial', `Module_Name`='$moduleName', `Module_SN`='$moduleSerial', `Instrument_SN`='$instrumentSerial', `SW_Version`='$softwareVersion', `GXSN`='$deviceSerial', `Test_Result`='$resultIdMtb', `mtbRif`='$resultIdRif',cond='1' WHERE lab_no = '$sampleid' and facility='$facilitycode'";

			$retval = mysqli_query($dbConn, $update) or die(mysqli_error($dbConn));

			if (!$retval) {
				//echo "500";
				header("HTTP/1.1 500");
			} else {
				//echo $arr['sampleId']. " has been Updated";
				header("HTTP/1.1 200");

				$SampleID = $arr['sampleId'];

				$query_rssamp = "SELECT * FROM sample1 WHERE lab_no='$SampleID'"; //c_name,c_no,s_no,lab_no,op_no,regno,mobile,age,fullname,Test_Result,mtbRif,Refacility,facility,sms_status,email_status
				$rssamp = mysqli_query($dbConn, $query_rssamp) or die(mysqli_error($dbConn));
				$row_rssamp = mysqli_fetch_assoc($rssamp);
				$totalRows_rssamp = mysqli_num_rows($rssamp);

				$cname = urlencode($row_rssamp['c_name']);
				$cphone = urlencode($row_rssamp['c_no']);
				$sphone = urlencode($row_rssamp['s_no']);
				$labno = urlencode($row_rssamp['lab_no']);
				$opno = urlencode($row_rssamp['op_no']);
				$regno = urlencode($row_rssamp['regno']);
				$mobile = urlencode($row_rssamp['mobile']);
				$age = urlencode($row_rssamp['age']);
				$pname = urlencode($row_rssamp['fullname']);
				$mtb = urlencode($row_rssamp['Test_Result']);
				$mtbrif = urlencode($row_rssamp['mtbRif']);
				$fcode = $row_rssamp['Refacility'];
				$tcode = $row_rssamp['facility'];

				$q = "SELECT facilityname as fname FROM facility_view WHERE facilitycode='$fcode'";
				$rs = mysqli_query($dbConn, $q) or die(mysqli_error($dbConn));
				$r = mysqli_fetch_assoc($rs);
				$fname = urlencode($r['fname']);
				$fname1 = $r['fname'];

				$qq = "SELECT name FROM facilitys WHERE facilitycode='$tcode'";
				$rss = mysqli_query($dbConn, $qq) or die(mysqli_error($dbConn));
				$rr = mysqli_fetch_assoc($rss);
				$tname = urlencode($rr['name']);
				$tname1 = $rr['name'];

				$date = date('d-M-Y', strtotime($row_rssamp['End_Time']));
				$today = date("Y-m-d");
				$date1 = date('d-M-Y', strtotime($today));


				$interval = abs(strtotime($date1) - strtotime($date));
				$hourdiff = round((strtotime($date1) - strtotime($date)) / 3600, 1);
				$days = floor($interval / (60 * 60 * 24));
				//start days check
				if ($days > 48) {
				} else {

					if ($row_rssamp['sms_status'] == 1) {
					} else {

						if ($row_rssamp['c_no'] == '2547________' or $row_rssamp['c_no'] == '' or $row_rssamp['c_no'] == '2547') {
						} else {

							if ($mtb == 'Positive') {

								echo $x = file_get_contents("https://api.prsp.tangazoletu.com/?User_ID=13863&passkey=53P3YMG3&service=1&sender=NLTP&dest=$cphone&msg=Genexpert+Test+for+$pname+done+at+$fname.+%0aThe+Summaries+are;Op/Ip+No:$opno,MobileNo:$mobile,Age:$age,MTB:$mtb,RIF:$mtbrif");
							} elseif ($mtb == 'Negative') {

								echo $x = file_get_contents("https://api.prsp.tangazoletu.com/?User_ID=13863&passkey=53P3YMG3&service=1&sender=NLTP&dest=$cphone&msg=Genexpert+Test+for+$pname+done+at+$fname.+%0aThe+Summaries+are;Op/Ip+No:$opno,MobileNo:$mobile,Age:$age,MTB:$mtb");
							} else {
							}
						}
						if ($row_rssamp['s_no'] == '2547________' or $row_rssamp['s_no'] == '' or $row_rssamp['s_no'] == '2547') {
						} else {

							if ($row_rssamp['c_no'] == $row_rssamp['s_no']) {
							} else {

								if ($mtb == 'Positive' or $mtb == 'Trace') {

									echo $x = file_get_contents("https://api.prsp.tangazoletu.com/?User_ID=13863&passkey=53P3YMG3&service=1&sender=NLTP&dest=$sphone&msg=Genexpert+Test+for+$pname+done+at+$fname.+%0aThe+Summaries+are;Op/Ip+No:$opno,MobileNo:$mobile,Age:$age,MTB:$mtb,RIF:$mtbrif");
								} elseif ($mtb == 'Negative') {

									echo $x = file_get_contents("https://api.prsp.tangazoletu.com/?User_ID=13863&passkey=53P3YMG3&service=1&sender=NLTP&dest=$sphone&msg=Genexpert+Test+for+$pname+done+at+$fname.+%0aThe+Summaries+are;Op/Ip+No:$opno,MobileNo:$mobile,Age:$age,MTB:$mtb");
								} else {
								}
							}
						}

						if ($x) {

							$query_rssamp = "UPDATE sample1 SET sms_status=1 WHERE lab_no='$SampleID'";
							$rssamp = mysqli_query($dbConn, $query_rssamp) or die(mysqli_error($dbConn));
						} else {
						}
					}
					//end

					if ($row_rssamp['email_status'] == 1) {
					} else {
						if ($mtb != 'ERROR' || $mtb != 'Invalid' || $mtb != 'No Result') {
							//send email
							$mail = new PHPMailer();
							$mail->IsSMTP();
							$mail->Host = "smtp.gmail.com";
							$mail->SMTPAuth = true;
							$subject = "Genexpert Test Results Alert";
							//$mail->Username = 'genexpert.nltp@gmail.com';
							//$mail->Password = 'gxlims@2015!';
							$SEmail= 'tibulims.nltp.co.ke';
							$mail->Username = $SEmail;
							$mail->Password = 'axslaegzhbatpmna';
							$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
							$mail->SMTPSecure = 'tls'; //tls secure transfer enabled REQUIRED for Gmail
							$mail->Port = 587; //25 //587
							$contactemail = $row_rssamp['d_email'];
							$emailaddress = $row_rssamp['c_email'];
							$emailaddress1 = $row_rssamp['s_email'];
							$mail->From = $SEmail;
							$mail->FromName = "Genexpert Results Alert";
							$mail->Sender = $SEmail;
							//$mail->AddReplyTo("genexpert.nltp@gmail.com.", "Test - Alerts");
							$mail->AddAddress($contactemail);
							$mail->AddCC($emailaddress);
							$mail->AddCC($emailaddress1);
							$mail->Subject = $subject;
							$mail->IsHTML(TRUE);
							//$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
							$mail->Body = "
							Hello Team, <br>							
							GeneXpert test for " . $row_rssamp['fullname'] . " was successfully done. Please notify the patient to visit the facility where the test was done from to collect the results. Below are the test summaries.<br>
							
								    Lab No : " . $row_rssamp['lab_no'] . " <br>
									Date Tested : " . $row_rssamp['coldate'] . " <br>
									Patient Name : " . $row_rssamp['fullname'] . " <br>
									Gender : " . $row_rssamp['gender'] . " <br>
									Age : " . $row_rssamp['age'] . " <br>
									Patient Type : " . $row_rssamp['pat_type'] . " <br>
									Mobile No : " . $row_rssamp['mobile'] . " <br>
									MTB Result: " . $row_rssamp['Test_Result'] . " <br>
									MTB Rif: " . $row_rssamp['mtbRif'] . " <br>
									Testing Facility: " . $tname1 . " <br>
									Referring Facility: " . $fname1 . " <br>
									Technician : " . $row_rssamp['User'] . " .<br>
							    
							Many Thanks.<br>
							-- TIBULIMS Support Team <br>
							This email was automatically generated. Please do not respond to this email address since it will be ignored.";

							if (!$mail->Send()) {
							} else {

								$query_rssamp = "UPDATE sample1 SET email_status=1 WHERE lab_no='$SampleID'";
								$rssamp = mysqli_query($dbConn, $query_rssamp) or die(mysqli_error($dbConn));
							}
						}

						//Main team

						// if ($mtb == 'Positive' and $mtbrif == 'Positive') {
						// 	//send email
						// 	$mail = new PHPMailer();
						// 	$mail->IsSMTP();
						// 	$mail->Host = "smtp.gmail.com";
						// 	$mail->SMTPAuth = true;
						// 	$subject = "Test Result Alert(MTB RIF)";
						// 	//$mail->Username = 'genexpert.nltp@gmail.com';
						// 	//$mail->Password = 'gxlims@2015!';
						// 	$mail->Username = 'genexpert.nltp@gmail.com';
						// 	$mail->Password = 'gxkenya@2015';
						// 	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
						// 	$mail->SMTPSecure = 'tls'; //tls secure transfer enabled REQUIRED for Gmail
						// 	$mail->Port = 587; //25
						// 	$contactemail = "kiplimorichard@gmail.com";
						// 	$emailaddress = "dorothymibei@gmail.com";
						// 	$emailaddress1 = "mutheewanjiru@gmail.com";
						// 	$emailaddress2 = "jckiarie@gmail.com";
						// 	$emailaddress3 = "drunyaboke@gmail.com";
						// 	$emailaddress4 = "elvismuriithi@gmail.com";
						// 	$mail->From = "genexpert.nltp@gmail.com";
						// 	$mail->FromName = "Test - Alerts";

						// 	$mail->Sender = "genexpert.nltp@gmail.com"; //gxalertmails@nltp.co.ke
						// 	//$mail->AddReplyTo("genexpert.nltp@gmail.com.", "Test - Alerts");
						// 	$mail->AddAddress($contactemail);
						// 	$mail->AddCC($emailaddress);
						// 	$mail->AddCC($emailaddress1);
						// 	$mail->AddCC($emailaddress2);
						// 	$mail->AddCC($emailaddress3);
						// 	$mail->AddCC($emailaddress4);
						// 	$mail->Subject = $subject;
						// 	$mail->IsHTML(TRUE);

						// 	//$mail->AddStringAttachment($doc, $reporttitle, 'base64', 'application/pdf');
						// 	$mail->Body = "
						// 	Hello Team, <br>

						// 	Below are the test summaries for GeneXpert test having Positive outcomes on both MTB and RIF.<br>

						// 	        Full Name: " . $row_rssamp['fullname'] . "<br>
						// 		    Lab No : " . $row_rssamp['lab_no'] . " <br>
						// 			Date Tested : " . $row_rssamp['coldate'] . " <br>
						// 			Patient Name : " . $row_rssamp['fullname'] . " <br>
						// 			Gender : " . $row_rssamp['gender'] . " <br>
						// 			Age : " . $row_rssamp['age'] . " <br>
						// 			Patient Type : " . $row_rssamp['pat_type'] . " <br>
						// 			Mobile No : " . $row_rssamp['mobile'] . " <br>
						// 			MTB Result: " . $row_rssamp['Test_Result'] . " <br>
						// 			MTB Rif: " . $row_rssamp['mtbRif'] . " <br>
						// 			Testing Facility: " . $tname . " <br>
						// 			Referring Facility: " . $fname . " <br>
						// 			Technician : " . $row_rssamp['User'] . " .<br>

						// 	Many Thanks.<br>
						// 	-- <br>
						// 	TB Support Team <br>
						// 	This email was automatically generated. Please do not respond to this email address since it will be ignored.";

						// 	if (!$mail->Send()) {
						// 	} else {

						// 		//$query_rssamp = "UPDATE sample1 SET email_status=1 WHERE lab_no='$SampleID'";
						// 		//$rssamp = mysqli_query($dbConn,$query_rssamp) or die(mysqli_error($dbConn));

						// 	}
						// }
					}
				}
			}
		}
		echo json_encode($row_rsFinC);
		//echo $x= file_get_contents("https://api.prsp.tangazoletu.com/?User_ID=13863&passkey=53P3YMG3&service=1&sender=NLTP&dest=254724690198&msg=success+API.");

	}
}
