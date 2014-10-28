<?php
if (isset($_GET['id'])){
		   $countyID = $_GET['id'];
	} 

$startmonth=1;
$endmonth=12;
//
@require_once('../connection/db.php'); 
//get month names from ID
function GetMonthName($month)
{
 if ($month==1)
 {
     $monthname=" Jan ";
 }
else if ($month==2)
 {
     $monthname=" Feb ";
 }else if ($month==3)
 {
     $monthname=" Mar ";
 }else if ($month==4)
 {
     $monthname=" Apr ";
 }else if ($month==5)
 {
     $monthname=" May ";
 }else if ($month==6)
 {
     $monthname=" Jun ";
 }else if ($month==7)
 {
     $monthname=" Jul ";
 }else if ($month==8)
 {
     $monthname=" Aug ";
 }else if ($month==9)
 {
     $monthname=" Sep ";
 }else if ($month==10)
 {
     $monthname=" Oct ";
 }else if ($month==11)
 {
     $monthname=" Nov ";
 }
  else if ($month==12)
 {
     $monthname=" Dec ";
 }
  else if ($month==13)
 {
     $monthname=" Jan - Sep  ";
 }
return $monthname;
}

function gettestsdone($month,$year){
	
 $sql="SELECT COUNT(*) FROM sample1 where cond='1' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function getmtbpos($month,$year){
$sql="SELECT 
sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtbpos
FROM sample1
WHERE MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";

$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
 
	
	}

function getmtbneg($month,$year){
$sql="SELECT sum( CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END ) AS MTBNEG
FROM sample1
where MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
	
function getmtbrif($month,$year){
$sql="SELECT 
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1
 WHERE MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function getError($month,$year){
$sql="SELECT 
sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1
 WHERE MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function GetMaxMonthbasedonMaxYear()
{
	
	$getmaxyear = "SELECT month(max(End_Time)) AS maxmonth FROM sample1 ";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maxmonth'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('m');
	}
return $showyear;
}

function GetMaxYear()
{
    $getmaxyear = "SELECT max(year(End_Time)) AS maximumyear FROM sample1";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maximumyear'];
	
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

function GetMinYear()
{
	$getmaxyear = "SELECT MIN(year(End_Time)) AS minimumyear FROM sample1 ";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['minimumyear'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

function GetMaxYearCon()
{
    $getmaxyear = "SELECT max(year(date)) AS maximumyear FROM consumption";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['maximumyear'];
	
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}

function GetMinYearCon()
{
	$getmaxyear = "SELECT MIN(year(date)) AS minimumyear FROM consumption ";
	$maxyear = mysql_query($getmaxyear) or die(mysql_error());
	$year = mysql_fetch_array($maxyear);
	$showyear = $year['minimumyear'];
	if ($showyear !='')
	{
	}
	else
	{
	$showyear=date('Y');
	}
	
return $showyear;
}
//Gex Perfomance Module_Name
function getGxPerfomance($FacID){
	
$sql="SELECT GXSN as sn,
 count(*) as tt
 FROM sample1 where cond='1' and facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_array($query);
return $rs;
	
	}

function getFacilitiesWithTestsInCounty($countyID){
 $sql= "SELECT 
`sample1`.`facility` AS a,
`facilitys`.`name` AS b
FROM sample1,facilitys, `districts` ,`countys`
WHERE 
`sample1`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$countyID'
group by `sample1`.`facility`";
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_array($query);
return $rs;
}
	
	function gettbvsmtb($tb,$mtb){
		
$sql="SELECT section2.cumulative, section2.tbpermonth, section2.mtb section2.hiv  FROM  section2 where  id=1";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
	//get number of tests done Nationally
	  function totalTestsNational($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	  $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,
sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err 
FROM sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err  
FROM sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	  $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err
FROM sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	   $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err  
FROM sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err  
FROM sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err
FROM sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	  elseif ($filter==8) //all
	  {
	  	  $sequel="SELECT sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err 
FROM sample1 WHERE cond='1'  ";
	  }
	     
	  $query=mysql_query($sequel) or die(mysql_error());
	  $rs=mysql_fetch_row($query);
	  return $rs;
		
	  }
	//get number of tests done by Outcome
	  function totalTestsByOutcome($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err   
       FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err    
       FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err  
       FROM  sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err   
       FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err    
       FROM  sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err    
       FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	    elseif ($filter==8) //all
	  {
	   $sequel="SELECT  count(CASE WHEN cond='1' THEN 1 ELSE 0 END),
	   sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ),
	   sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END),
	   sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
	   sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err    
       FROM  sample1 WHERE cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	  
	
function getCountytestsdone($countyID,$month,$year){
$sql="SELECT COUNT(*) AS totaltests
From sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
WHERE cond=1 and `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function getCountymtbpos($countyID,$month,$year){
$sql="SELECT 
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtbpos
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'
";

$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
 
	}

function getCountymtbneg($countyID,$month,$year){
$sql="SELECT mtbneg
FROM(
SELECT 
sum( CASE WHEN Test_Result = 'negative ' THEN 1 ELSE 0 END ) AS mtbneg
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'
)x";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
	
function getCountymtbrif($countyID,$month,$year){
$sql="SELECT mtbrif
FROM(
SELECT 
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'
)x";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
	
	function getCountyErrors($countyID,$month,$year){
$sql="SELECT mtbrif
FROM(
SELECT 
sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'
)x";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}

//get number of tests done by age
	  function totalTestsByAge($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  } elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM  sample1 WHERE cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	
//get number of tests done by Gender
	  function totalTestsByGender($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	     elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END)

              FROM  sample1 WHERE cond='1'  ";
	  }
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	  
//get number of tests done by HStatus
	  function totalTestsByHStatus($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	  elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)


              FROM  sample1 WHERE cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	  //get number of tests done by ptype
function totalTestsByPtype($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	  $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1  WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	     elseif ($filter==8) //all
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1 WHERE cond='1'  ";
	  }
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	  
	  //get number of tests done county
	  function totalTestsCountyWise($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	  $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,
sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum( CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err
 
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
 sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err 
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	  $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
 sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	   $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
 sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
 sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
 sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,

sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err 
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	       elseif ($filter==8) //all
	  {
	  	  $sequel="SELECT count(*) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 
sum(CASE WHEN (age Between 1 AND 5) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END) as totalbelow,
sum( CASE WHEN ( age Between 1 AND 5 ) AND ( Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbbelow,
sum( CASE WHEN  (age Between 1 AND 5) AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbelow,
sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END) as totalbtwn,
sum( CASE WHEN  (age Between 6 AND 15) AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbbtwn,
sum( CASE WHEN (age Between 6 AND 15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifbtwn,
sum(CASE WHEN (age>15) THEN 1 ELSE 0 END) as totalabove,
sum( CASE WHEN (age>15) AND  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbabove,
sum( CASE WHEN  (age>15) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifabove,
sum(CASE WHEN (gender='Male') THEN 1 ELSE 0 END) as totalMale,
sum( CASE WHEN (gender='Male') AND  (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbMale,
sum( CASE WHEN (gender='Male') AND  (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifMale,
sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END) as totalFemale,
sum( CASE WHEN (gender='Female') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFemale,
sum( CASE WHEN (gender='Female') AND    (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifFemale,
sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN (gender='Not specified') AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN (gender='Not specified') AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbNA,
sum( CASE WHEN (h_status='Not Done' OR h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifNA,
sum(CASE WHEN pat_type='sputum smear-positive relapse' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='sputum smear-negative relapse' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='New Patients' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN pat_type='New case PTB' THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='MDR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv(+) & Smear(-)' THEN 1 ELSE 0 END) as totalHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear,
sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS err 
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND cond='1'  ";
	  }
	     
	  $query=mysql_query($sequel) or die(mysql_error());
	  $rs=mysql_fetch_row($query);
	  return $rs;
		
	  }

	  //get number of tests done Per County by age
	  function totalTestsPerCountyByAge($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1' ";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	     elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN age>15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END)
              FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	
//get number of tests done Per County by Gender
	  function totalTestsPerCountyByGender($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	     elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END) FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND cond='1'  ";
	  }
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	  
//get number of tests done Per County by HStatus
	  function totalTestsPerCountyByHStatus($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	  elseif ($filter==8) //all
	  {
	  	   $sequel="SELECT  sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END)
 FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
	    //get number of tests done Per County by ptype
function totalTestsPerCountyByPtype($countyID,$filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	  $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1' ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1' ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND  YEAR(End_Time)='$currentyear'  AND cond='1' ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  ";
	  }
	  elseif ($filter==8) //all
	  {
	   $sequel="SELECT sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN  (pat_type='sputum smear-positive relapse') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='sputum smear-negative relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum( CASE WHEN (pat_type='New Patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='New Patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum( CASE WHEN (pat_type='New case PTB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New case PTB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum( CASE WHEN (pat_type='MDR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='MDR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSmear,
sum( CASE WHEN (pat_type='Hiv(+) & Smear(-)') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSmear  
FROM sample1
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT  JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE `countys`.`ID` ='$countyID' AND cond='1'  ";
	  }
	     
	  $resultReport=mysql_query($sequel);
	  $resultArr=@mysql_fetch_array($resultReport);
	  return $resultArr;
		
	  }
?>