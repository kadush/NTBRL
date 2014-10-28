<?php
require_once('connection/db.php');
$json1 = file_get_contents('php://input');
$arr=json_decode($json1,true);
header("Content-Type:application/json");
   if($arr['password']!='80SHe5MF7gM73t4aog5Q')
     {
	 //echo "Authentication failed";
	  header("HTTP/1.1 401");
	 }
	else{
				//get array values
				
				$systemName = mysql_real_escape_string($arr['systemName']);
				$exportedDate = mysql_real_escape_string($arr['exportedDate']);
				$assay = mysql_real_escape_string($arr['assays']);
				$assayVersion = mysql_real_escape_string($arr['assayVersion']);
				$sampleid = mysql_real_escape_string($arr['sampleId']);
				$patientId = mysql_real_escape_string($arr['patientId']);
				$user = mysql_real_escape_string($arr['user']);
				$status = mysql_real_escape_string($arr['status']);
				$startTime = mysql_real_escape_string($arr['startTime']);
				$endTime = mysql_real_escape_string($arr['endTime']);
				$errorStatus = mysql_real_escape_string($arr['errorStatus']);
				$reagentLotId = mysql_real_escape_string($arr['reagentLotId']);
				$cartridgeExpirationDate = mysql_real_escape_string($arr['cartridgeExpirationDate']);
				$cartridgeSerial = mysql_real_escape_string($arr['cartridgeSerial']);
				$moduleName = mysql_real_escape_string($arr['moduleName']);
				$moduleSerial = mysql_real_escape_string($arr['moduleSerial']);
				$instrumentSerial = mysql_real_escape_string($arr['instrumentSerial']);
				$softwareVersion = mysql_real_escape_string($arr['softwareVersion']);
				$resultIdMtb = mysql_real_escape_string($arr['resultIdMtb']);
				$facilitycode=mysql_real_escape_string($arr['hostId']);
				
				   if($arr['resultIdMtb']==1) {
				   	$resultIdMtb="Exclude";
				   }
				   elseif($arr['resultIdMtb']==2) {
				   	$resultIdMtb="Invalid";
				   }
				   
				   elseif($arr['resultIdMtb']==3) {
				   	$resultIdMtb="Error";
				   }
				   
				   elseif($arr['resultIdMtb']==4) {
				   	$resultIdMtb="Negative";
				   }
				   
				   elseif($arr['resultIdMtb']==5) {
				   	$resultIdMtb="Positive";
				   }
				   
				   elseif($arr['resultIdMtb']==6) {
				   	$resultIdMtb="Indeterminate";
				   }
					$resultIdRif = $arr['resultIdRif'];
				   if($arr['resultIdRif']==1) {
				   	$resultIdRif="Exclude";
				   }
				   elseif($arr['resultIdRif']==2) {
				   	$resultIdRif="Invalid";
				   }
				   
				   elseif($arr['resultIdRif']==3) {
				   	$resultIdRif="Error";
				   }
				   
				   elseif($arr['resultIdRif']==4) {
				   	$resultIdRif="Negative";
				   }
				   
				   elseif($arr['resultIdRif']==5) {
				   	$resultIdRif="Positive";
				   }
				   
				   elseif($arr['resultIdRif']==6) {
				   	$resultIdRif="Indeterminate";
				   }
				$deviceSerial = mysql_real_escape_string($arr['deviceSerial']);
		
		//checks if there is such a sample
		 
		 $sql="SELECT ID as recordId, Refacility as referredFrom,op_no as outpatientNumber,ip_no as inpatientNumber,regno as referringSiteNumber,fullname as patientName, gender as gender, age as age,ageb as ageType, mobile as patientCell,address as patientAddress,pat_type as caseDefinition,smear as smear,h_status as hiv,exam_req as examinationRequired,d_email as dtlcEmail,c_no as clinicianCell,c_name as clinicianName,c_email as clinicianEmail FROM sample1 where lab_no='$sampleid' LIMIT 1";
		 $checkSample = mysql_query($sql) or die(mysql_error());
         $row_rsFinC = mysql_fetch_assoc($checkSample);
		 
			//If sample is not found
			if(@mysql_num_rows($checkSample)==0){
				

				
         	//insert new record
         /*	foreach ($arr as $key => $value)s
			{
			   $insert .= "`".$key."`,";
			   $insert1=trim($insert,',');
			   
			   $sql_insert .= "'".$value."',";
			   $sql_insert1=trim($sql_insert,',');
			}
			*/
			 $insert="INSERT INTO sample1 (`System_Name`, `Exported_Date`, `Reagent_Lot_Number`, `Sample_ID`, `Patient_ID`, `Assay`, `Assay_Version`, `User`, `Status`, `Start_Time`, `End_Time`, `Error_Status`, `Expiration_Date`, `Cartridge_SN`, `Module_Name`, `Module_SN`, `Instrument_SN`, `SW_Version`,`GXSN`, `Test_Result`, `mtbRif`,`facility`,`Refacility`,`cond`) 
			  VALUES('".$systemName."','" .$exportedDate."','" .$reagentLotId."','" .$sampleid."','".$patientId."','" .$assay."','" .$assayVersion."','" .$user."','" .$status."','" .$startTime."','" .$endTime."','" .$errorStatus."','" .$cartridgeExpirationDate."','" .$cartridgeSerial."','" .$moduleName."','" .$moduleSerial."','" .$instrumentSerial."','" .$softwareVersion."','" .$deviceSerial."','" .$resultIdMtb."','" .$resultIdRif."','" .$facilitycode."','" .$facilitycode."','1')";
			  
			 $retval = mysql_query( $insert, $ntrl );	
				
				if (!$retval){
				//echo "500";
				header("HTTP/1.1 500");
				}
				else{
				//echo 'New Sample found and it has been inserted';
				header("HTTP/1.1 201");
				//printf("Last inserted record has id %d\n", mysql_insert_id());
				$newrec = mysql_insert_id();
				echo json_encode(array('recordId' => $newrec ), JSON_NUMERIC_CHECK);
				exit;		
				}
			
			} 
			
			else {
			    //getting contents of the sample
				//update existing
				/*foreach ($arr as $key => $value)
					{
					   $sql_Update .= $key." = '".$value."',";
					}
				$where="cond='1' WHERE lab_no='".$arr['sampleId']."'";*/
				
			
				$update ="UPDATE sample1 SET `System_Name`='$systemName', `Exported_Date`='$exportedDate', `Reagent_Lot_Number`='$reagentLotId', `Sample_ID`='$sampleid', `Patient_ID`='$patientId', `Assay`='$assay', `Assay_Version`='$assayVersion', `User`='$user', `Status`='$status', `Start_Time`='$startTime', `End_Time`='$endTime', `Error_Status`='$errorStatus', `Expiration_Date`='$cartridgeExpirationDate', `Cartridge_SN`='$cartridgeSerial', `Module_Name`='$moduleName', `Module_SN`='$moduleSerial', `Instrument_SN`='$instrumentSerial', `SW_Version`='$softwareVersion', `GXSN`='$deviceSerial', `Test_Result`='$resultIdMtb', `mtbRif`='$resultIdRif',cond='1' WHERE lab_no = '$sampleid'";
				
				$retval = mysql_query( $update, $ntrl );
				
				if (!$retval){
                //echo "500";
				header("HTTP/1.1 500");
				}
				else{
				//echo $arr['sampleId']. " has been Updated";
				header("HTTP/1.1 200");			
				}
				
			}
		echo json_encode($row_rsFinC);   		  
		 
    }
?>
