<?php
//echo "kadush";
require_once('../includes/functions.php');
require_once('../connection/db.php');
error_reporting(0);
$FacID = $_POST['facility'];

$period = $_POST['period'];
$month = $_POST['monthly'];
$monthyear = $_POST['monthyear'];
$specimen_type = $_POST['specimen_type'];

if ($specimen_type == '1') {
	$specimen = "All Samples";
	$addspecimen = " ";
} else {
	$specimen = $specimen_type;
	$addspecimen = "specimen_type='$specimen' AND";
}
//get number of tests done Nationally

$sql = "SELECT name as fn, modular as modular FROM facilitys where facilitycode='$FacID'";
$query = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
$rs = mysqli_fetch_assoc($query);
$fname = $rs['fn'];
$title = $fname;
$modular = $rs['modular'];

$currentmonth = date("m");
$year = date("Y");
$previousmonth = date("m") - 1;


if ($currentmonth == 1) {
	$year = date("Y");
	$previousmonth = 12;
	$previousyear = date("Y") - 1;
} else {
	$previousmonth = date("m") - 1;
	$previousyear = date("Y");
}


/*get the least days of expiration-cartridge  */
$q = "SELECT 
  (
   SELECT (c.end_bal+c.received) FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Cartridge' ORDER BY c.date DESC LIMIT 1
  )AS cart, 
  (
  SELECT DATEDIFF( max( s.Expiration_Date ) , NOW() )  FROM samplescm s WHERE s.facility='$FacID'
  )AS DiffDate, 
  (
   SELECT (c.end_bal+c.received) FROM consumption c WHERE  c.facility='$FacID' and c.commodity='Falcon Tubes'  ORDER BY c.date DESC LIMIT 1
  )AS tubes,
  (
   SELECT count(ID) FROM samplescm WHERE MONTH(End_Time)='$currentmonth' and  YEAR(End_Time)='$year' and cond=1 and facility='$FacID'
  )AS tt";
$r = mysqli_query($dbConn, $q) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($r);
$expdate = $row['DiffDate'];
$cartridges = $row['cart'];
$tubes = $row['tubes'];
$testdonethismonth = $row['tt'];

/* get any stock adjustments in the current month*/
$query_rssample = "SELECT 
  (
   SELECT SUM(c_quantity) FROM stock_adjustment WHERE MONTH(date)='$month' and  YEAR(date)='$year' and facility='$FacID' and adjustment=1 LIMIT 1
  )AS pos_cart, 
  (
   SELECT SUM(f_quantity) FROM stock_adjustment WHERE MONTH(date)='$month' and  YEAR(date)='$year' and facility='$FacID' and adjustment=1 LIMIT 1
  )AS pos_falc, 
  (
   SELECT SUM(c_quantity) FROM stock_adjustment WHERE MONTH(date)='$month' and  YEAR(date)='$year' and facility='$FacID' and adjustment=0 LIMIT 1
  )AS neg_cart,
  (
   SELECT SUM(f_quantity) FROM stock_adjustment WHERE MONTH(date)='$month' and  YEAR(date)='$year' and facility='$FacID' and adjustment=0 LIMIT 1
  )AS neg_falc";
$rssample = mysqli_query($dbConn, $query_rssample) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$pos_cart = (int) $row_rssample['pos_cart'];
$pos_falc = (int) $row_rssample['pos_falc'];
$neg_cart = (int) $row_rssample['neg_cart'];
$neg_falc = (int) $row_rssample['neg_falc'];

/* calculate the ending balances of each commodity */
$remainingcarts = ($cartridges + $pos_cart) - ($testdonethismonth + $neg_cart);
$remainingtubes = ($tubes + $pos_falc) - ($testdonethismonth + $neg_falc);
/* variables used in index.php*/
if ($remainingcarts < 0 or $remainingcarts == 0) {
	$remainingcarts = 0;
	$expdate = 0;
}
if ($remainingtubes < 0 or $remainingtubes == 0) {
	$remainingtubes = 0;
}
/*/Gex Perfomance Module_Name
function getGxPerfomanceF($FacID){
	
$sql="SELECT GXSN as sn,
 count(*) as tt
 FROM samplescm where cond='1' and facility='$FacID'";	
$query=mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
$rs=mysqli_fetch_array($query);
return $rs;
	
	}

$module=getGxPerfomanceF($FacID); */

$seq = "SELECT COUNT(DISTINCT facility) AS fac,
sum(CASE WHEN cond='1' THEN 1 ELSE 0 END) as total,
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,
sum( CASE WHEN Test_Result = 'Trace' THEN 1 ELSE 0 END ) AS trace,
sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,
sum( CASE WHEN mtbRif = 'Indeterminate' THEN 1 ELSE 0 END ) AS ind,  
sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs,
sum( CASE WHEN Test_Result = 'Invalid' THEN 1 ELSE 0 END ) AS inv,
sum( CASE WHEN Test_Result = 'No result' THEN 1 ELSE 0 END ) AS nor,
sum( CASE WHEN exam_req= 'Panel Testing' THEN 1 ELSE 0 END ) AS pt,
sum(CASE WHEN (age Between 1 AND 5) THEN 1 ELSE 0 END) as totalbelow,
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
sum(CASE WHEN  gender is null  THEN 1 ELSE 0 END) as totalNotsp,
sum( CASE WHEN ( gender is null ) AND   (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNotsp,
sum( CASE WHEN ( gender is null ) AND   (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNotsp,  
sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END) as totalPos,
sum( CASE WHEN (h_status='Positive') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPos,
sum( CASE WHEN (h_status='Positive') and   (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifPos, 
sum(CASE WHEN  (h_status='Negative') THEN 1 ELSE 0 END) as totalNeg,
sum( CASE WHEN (h_status='Negative') and  (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNeg,
sum( CASE WHEN (h_status='Negative') and  (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifNeg,  
sum( CASE WHEN (h_status='Not Done') OR h_status='Declined' THEN 1 ELSE 0 END) as totalND,
sum( CASE WHEN (h_status='Not Done') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbND,
sum( CASE WHEN (h_status='Not Done') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifND,
sum( CASE WHEN (h_status='Declined') OR h_status='Declined' THEN 1 ELSE 0 END) as totalD,
sum( CASE WHEN (h_status='Declined') and (Test_Result = 'positive') THEN 1 ELSE 0 END ) AS mtbD,
sum( CASE WHEN (h_status='Declined') and  (mtbRif = 'positive')   THEN 1 ELSE 0 END ) AS rifD,
sum(CASE WHEN pat_type='smear positive at 2 months' THEN 1 ELSE 0 END) as totalsputumpos,
sum( CASE WHEN  (pat_type='smear positive at 2 months') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumpos,
sum( CASE WHEN (pat_type='smear positive at 2 months') AND (mtbRif = 'positive')  THEN 1 ELSE 0 END ) AS rifsputumpos,
sum(CASE WHEN pat_type='All smear negative PTB cases' THEN 1 ELSE 0 END) as totalsputumneg,
sum( CASE WHEN (pat_type='All smear negative PTB cases') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbsputumneg,
sum( CASE WHEN (pat_type='All smear negative PTB cases') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifsputumneg,
sum(CASE WHEN pat_type='Return after defaulting' THEN 1 ELSE 0 END) as totalReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbReturn,
sum( CASE WHEN (pat_type='Return after defaulting') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifReturn,
sum(CASE WHEN pat_type='Failure 1-st line treatment' THEN 1 ELSE 0 END) as totalFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailure,
sum( CASE WHEN (pat_type='Failure 1-st line treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailure,  
sum( CASE WHEN pat_type='Failure re-treatment' THEN 1 ELSE 0 END) as totalFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbFailureRt,
sum( CASE WHEN (pat_type='Failure re-treatment') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifFailureRt,  
sum(CASE WHEN pat_type='Extra pulmonary' THEN 1 ELSE 0 END) as totalNP,
sum( CASE WHEN (pat_type='Extra pulmonary') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNP,
sum( CASE WHEN (pat_type='Extra pulmonary') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNP,  
sum(CASE WHEN (pat_type='New presumptive PTB'  or pat_type='New patients') THEN 1 ELSE 0 END) as totalNewcase,
sum( CASE WHEN (pat_type='New presumptive PTB'  or pat_type='New patients') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNewcase,
sum( CASE WHEN (pat_type='New presumptive PTB'  or pat_type='New patients') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNewcase,  
sum(CASE WHEN pat_type='DR TB Contact' THEN 1 ELSE 0 END) as totalContact,
sum( CASE WHEN (pat_type='DR TB Contact') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbContact,
sum( CASE WHEN (pat_type='DR TB Contact') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifContact,  
sum(CASE WHEN pat_type='Refugees SS+ve' THEN 1 ELSE 0 END) as totalRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRef,
sum( CASE WHEN (pat_type='Refugees SS+ve') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRef,
sum(CASE WHEN pat_type='HCWs' THEN 1 ELSE 0 END) as totalHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHCWs,
sum( CASE WHEN (pat_type='HCWs') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHCWs,  
sum(CASE WHEN pat_type='Hiv +ve with symptoms of TB' THEN 1 ELSE 0 END) as totalHivSy,
sum( CASE WHEN (pat_type='Hiv +ve with symptoms of TB') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbHivSy,
sum( CASE WHEN (pat_type='Hiv +ve with symptoms of TB') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifHivSy,
sum(CASE WHEN pat_type='Relapse' THEN 1 ELSE 0 END) as totalRe,
sum( CASE WHEN (pat_type='Relapse') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbRe,
sum( CASE WHEN (pat_type='Relapse') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifRe,
sum(CASE WHEN pat_type='Prisoners with TB symptoms' THEN 1 ELSE 0 END) as totalPr,
sum( CASE WHEN (pat_type='Prisoners with TB symptoms') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbPr,
sum( CASE WHEN (pat_type='Prisoners with TB symptoms') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifPr,
sum(CASE WHEN pat_type='Patients who develop TB while on IPT' THEN 1 ELSE 0 END) as totalIPT,
sum( CASE WHEN (pat_type='Patients who develop TB while on IPT') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbIPT,
sum( CASE WHEN (pat_type='Patients who develop TB while on IPT') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifIPT,
sum(CASE WHEN pat_type='No Patient type' THEN 1 ELSE 0 END) as totalNopt,
sum( CASE WHEN (pat_type='No Patient type') AND (Test_Result = 'positive')  THEN 1 ELSE 0 END ) AS mtbNopt,
sum( CASE WHEN (pat_type='No Patient type') AND (mtbRif = 'positive') THEN 1 ELSE 0 END ) AS rifNopt,
sum( CASE WHEN (sms_status='1') THEN 1 ELSE 0 END ) AS sms,
sum( CASE WHEN (email_status='1') THEN 1 ELSE 0 END ) AS email

FROM sample1 ";

if ($period == 'Monthly') {
	function GetMonthNameF($month)
	{
		if ($month == 1) {
			$monthname = " Jan ";
		} else if ($month == 2) {
			$monthname = " Feb ";
		} else if ($month == 3) {
			$monthname = " Mar ";
		} else if ($month == 4) {
			$monthname = " Apr ";
		} else if ($month == 5) {
			$monthname = " May ";
		} else if ($month == 6) {
			$monthname = " Jun ";
		} else if ($month == 7) {
			$monthname = " Jul ";
		} else if ($month == 8) {
			$monthname = " Aug ";
		} else if ($month == 9) {
			$monthname = " Sep ";
		} else if ($month == 10) {
			$monthname = " Oct ";
		} else if ($month == 11) {
			$monthname = " Nov ";
		} else if ($month == 12) {
			$monthname = " Dec ";
		} else if ($month == 13) {
			$monthname = " Jan - Sep  ";
		}
		return $monthname;
	}


	//get month n year
	$expected = 4 * 20 * $modular;
	$dt = GetMonthNameF($month) . ' - ' . $monthyear;
	$currentyear = $monthyear;

	$where = " where $addspecimen MONTH(End_Time)='$month' AND YEAR(End_Time)='$monthyear' AND cond='1' AND facility='$FacID' ";
	$sequel = $seq . $where;
} elseif ($period == 'Quarterly') {
	//get quarterly
	$expected = (4 * 20 * $modular * 3);
	$quarterly = $_POST['quarterly'];
	$quarteryear = $_POST['quarteryear'];
	$currentyear = $quarteryear;
	if ($quarterly == 1) {
		$startdate = $quarteryear . "-01-01";
		$enddate = $quarteryear . "-03-31";
		$monthname = " January-March ";
	} else if ($quarterly == 2) {
		$startdate = $quarteryear . "-04-01";
		$enddate = $quarteryear . "-06-30";
		$monthname = " April-June ";
	} else if ($quarterly == 3) {
		$startdate = $quarteryear . "-07-01";
		$enddate = $quarteryear . "-09-30";
		$monthname = " July-September ";
	} else if ($quarterly == 4) {
		$startdate = $quarteryear . "-10-01";
		$enddate = $quarteryear . "-12-31";
		$monthname = " October-December ";
	}
	$dt = $monthname . $quarteryear;

	$where = "  WHERE $addspecimen  QUARTER(End_Time)='$quarterly' AND YEAR(End_Time)='$quarteryear' AND cond='1' AND facility='$FacID'";
	$sequel = $seq . $where;
} elseif ($period == 'Yearly') {

	//get yearly
	$expected = (4 * 20 * $modular * 12);
	$yearly = $_POST['yearly'];
	$dt = $yearly;
	$currentyear = $yearly;

	$where = "  WHERE $addspecimen YEAR(End_Time)='$yearly' AND cond='1' AND facility='$FacID'";
	$sequel = $seq . $where;
} elseif ($period == 'Date Range') {

	//get date range

	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];
	$currentyear = @date("Y");
	$dt = @date("d-M-Y", strtotime($startdate)) . ' to ' . @date("d-M-Y", strtotime($enddate));

	$where = "  WHERE $addspecimen  End_Time BETWEEN '$startdate' AND '$enddate' AND cond='1' AND facility='$FacID'";
	$sequel = $seq . $where;
} elseif ($period == 'Cumulative') {

	$dt = 'Cumulative Data';
	$currentyear = @date("Y");

	$where = "  WHERE $addspecimen cond='1' AND facility='$FacID'";
	$sequel = $seq . $where;
} elseif ($period == 'Semi Annual') {
	//get semi
	$expected = (4 * 20 * $modular * 6);
	$sa = $_POST['semi'];
	$sayear = $_POST['semiyear'];
	$currentyear = $sayear;
	if ($sa == 1) {
		$startdate = $sayear . "-01-01";
		$enddate = $sayear . "-06-30";
		$dt = "Q1-Q2 (January-June " . $sayear . ")";
	} else if ($sa == 2) {
		$startdate = $sayear . "-07-01";
		$enddate = $sayear . "-12-31";
		$dt = "Q3-Q4 (July-December " . $sayear . ")";
	}

	$where = "  WHERE $addspecimen End_Time BETWEEN '$startdate' AND '$enddate' AND cond='1' AND facility='$FacID'";
	$sequel = $seq . $where;
}

$query = mysqli_query($dbConn, $sequel) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($query);
//echo $sequel;
//var_dump($row);
// $row['fac'];
// exit;	
do {
	$errors = $row['errs'] + $row['inv'] + $row['nor'];
	if ($row['total'] > 0) {
		$errorrate = round((($row['errs'] / $row['total']) * 100));
		$uti = round(((($row['totalMale'] + $row['totalFemale']) / $row['total']) * 100));
		$geneuti = round((($row['total'] / ($expected)) * 100));
		$SMSuti = round((($row['sms'] / ($row['total'])) * 100));
		$Emailuti = round((($row['email'] / ($row['total'])) * 100));
		$MTBpos = round(((($row['mtb']+$row['trace']) / $row['total']) * 100));
		if (is_nan($SMSuti)) $SMSuti = 0;
		if (is_nan($Emailuti)) $Emailuti = 0;
	} else {

		$errorrate = 0;
		$uti = 0;
		$geneuti = 0;
		$row['email'] = 0;
		$row['sms'] = 0;
		$SMSuti = 0;
		$Emailuti = 0;
		$MTBpos = 0;
	}
	$res .= '
<div class="row" >
			<div class="alert alert-default" style="display: block;margin-left: auto;margin-right: auto;padding-top: 0;max-width: 100%;height: auto;vertical-align: middle; ">
			<h3 align="center">' . $FacID . ' | ' . $fname . ' Analytics</h3>
			</div>
		</div>
		<div class="row" >
		
	<div class="col-sm-2">
	
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="' . $uti . '" data-postfix="" data-duration="1500" data-delay="600">' . $uti . '%</div>
			
			<p>System(GxLims) Utilization</h3>
			<p>Period: ' . $dt . '</p>
		</div>
		
	</div>
	
	<div class="col-sm-2">
	
		<div class="tile-stats tile-neon-red">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="' . $geneuti . '" data-postfix="" data-duration="1500" data-delay="600">' . $geneuti . '%</div>
			
			<p>GeneXpert Utilization</h3>
			<p>Period: ' . $dt . '</p>
		</div>
		
	</div>
	
	<div class="col-sm-2">
	
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-basket"></i></div>
			<div class="num" data-start="0" data-end="' . $remainingcarts . '" data-postfix="" data-duration="1500" data-delay="0">' . $remainingcarts . '</div>
			
			<p>Remaining Cartridges</h3>
			<p>so far from the inventory.</p>
		</div>
		
	</div>
	
	<div class="col-sm-2">
	
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-calendar"></i></div>
			<div class="num" data-start="0" data-end="' . $expdate . '" data-postfix="" data-duration="1500" data-delay="1200">' . $expdate . '</div>
			
			<p>Remaining Days</h3>
			<p>to cartridges expiration.</p>
		</div>
		
	</div>
	
	<div class="col-sm-2">
	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-volume"></i></div>
			<div class="num" data-start="0" data-end="' . $remainingtubes . '" data-postfix="" data-duration="1500" data-delay="1800">' . $remainingtubes . '</div>
			
			<p>Remaining F.Tubes</h3>
			<p>so far from the inventory.</p>
		</div>
		
	</div>
	<div class="col-sm-2">
	
		<div class="tile-stats tile-cyan">
			<div class="icon"><i class="entypo-volume"></i></div>
			<div class="num" data-start="0" data-end="' . $errorrate . '%" data-postfix="" data-duration="1500" data-delay="1800">' . $errorrate . '%</div>
			
			<p>Error Rate</h3>
			<p>Period: ' . $dt . '</p>
		</div>
		
	</div>
</div>
<div class="row">
<div class="col-md-12 col-md-offset-3">
	<div class="col-sm-2">
	
		<div class="tile-title tile-red">
			
			<div class="title">
				<h3>' . $MTBpos . '%</h3>
				<p>MTB Positivity.</p>
				<p>Period: ' . $dt . '</p>
			</div>
		</div>
		
	</div>
	<div class="col-sm-2">
	
		<div class="tile-title tile-plum">
			
			<div class="title">
				<h3>' . $row['sms'] . ' [' . $SMSuti . '%]</h3>
				<p>SMS Sent.</p>
				<p>Period: ' . $dt . '</p>
			</div>
		</div>
		
	</div>
	<div class="col-sm-2">
	
		<div class="tile-title tile-purple">
			
			<div class="title">
				<h3>' . $row['email'] . ' [' . $Emailuti . '%]</h3>
				<p>Emails Sent.</p>
				<p>Period: ' . $dt . '</p>
			</div>
		</div>
	  </div>
	</div>

</div>
<div class="row">
	<div class="col-sm-5">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Test Trends for Year: 
						<br />
						<small>' . $currentyear . '</small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivtrendd"  align="center" id="chartdivtrendd"> </div> 
         		<script type="text/javascript">
         			 $("#chartdivtrendd").load("facilitytrendline.php?facility=' . $FacID . '&mwaka=' . $currentyear . '");
			    </script> 
			</div>
          </div>
		
	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						 Tests Outcomes
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			<div class="panel-body no-padding" id="res1">
				
			         <script type="text/javascript">
			         
			          $( "#res1" ).load( "chart1.php?pos=' . $row['mtb'] . '&neg=' . $row['neg'] . '&rif=' . $row['rif'] . '&ind=' . $row['ind'] . '&err=' . $errors . '" );
			         </script> 
				    
			</div>
		</div>

	</div>

	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
			<div class="panel-title">
			<h4>
				Test Statistics
				<br />
				<small> ' . $dt . ' </small>
			</h4>
		</div>
	
	</div>
	  
	<div style="min-height: 200px">
		<table class="table table-bordered">
			<thead>
			<tr>
				<td style="text-align:center" rowspan="2">Total Devices</td>
				<td style="text-align:center" rowspan="2">Total Tests</td>
				<td style="text-align:center" colspan="3">MTB</td>
				<td style="text-align:center" colspan="2">RIF</td>
				<td style="text-align:center" rowspan="2">Errors / Invalid / No Result</td>
				<td style="text-align:center" rowspan="2">PT</td>
			</tr>
			<tr>
				<td style="text-align:center">+ve</td>
				<td style="text-align:center">Tr</td>
				<td style="text-align:center">-ve</td>
				<td style="text-align:center">Res</td>
				<td style="text-align:center">Ind.</td>
			</tr>
			
			</thead>
			<tbody>
			<tr>
				<td style="text-align:center">' . $row['fac'] . '</td>
				<td style="text-align:center">' . $row['total']  . '</td>
				<td style="text-align:center">' . $row['mtb'] . '</td>
				<td style="text-align:center">' . $row['trace'] . '</td>
				<td style="text-align:center">' . $row['neg'] . '</td>
				<td style="text-align:center">' . $row['rif'] . '</td>
				<td style="text-align:center">' . $row['ind'] . '</td>
				<td style="text-align:center"> <a onclick ="javascript:ShowHide("errorview")" href="javascript:;" title=" Click to Filter View based on Date Range you Specify">' . $errors . ' </a></font></small></td>
				<td style="text-align:center">' . $row['pt'] . '</td>
			</tr>
			</tbody>
			   </table>
			   <ul class="country-list">
					<li>
						Errors<span class="badge badge-danger">' . $row['errs'] . '</span>
					</li>
					<li>
						Invalid<span class="badge badge-warning">' . $row['inv'] . '</span>
					</li>
					<li>
						No Result<span class="badge badge-primary">' . $row['nor'] . '</span>
					</li>
			   </ul>
			   </div>
			   <div id="errorview" style="DISPLAY: none" >		
			 </div>
			
		</div>
	</div>
	</div>
<div class="row">
	<div class="col-sm-5">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						GeneXpert Performance [' . $module[0] . ']
						<br />
						<small>Tests done: ' . $module[1] . '</small>
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			<div class="panel-body no-padding">
				
			<div id="chartdivperfomance"  align="center"> 
         		<script type="text/javascript">
         			 $("#chartdivperfomance").load("gx.php?facility=' . $FacID . '");
			    </script> 
			</div>
          </div>
		</div>
		
	</div>
<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Tests By Age
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
			</div>
		
			<div class="panel-body no-padding" id="res2">
				
			         <script type="text/javascript">
			          $( "#res2" ).load( "chartage.php?pos=' . $row['totalbelow'] . '&neg=' . $row['totalbtwn'] . '&rif=' . $row['totalabove'] . '" );
			         </script> 
				    
			</div>
		</div>

	</div>
	<div class="col-sm-4">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Age
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center"><5 Yrs</td>
					<td  style="text-align:center">Btwn 6-15 Yrs</td>
					<td  style="text-align:center">>15 Yrs</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center">' . $row['totalbelow'] . '</td>
					<td style="text-align:center">' . $row['totalbtwn'] . '</td>
					<td style="text-align:center">' . $row['totalabove'] . '</td>
					
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">' . $row['mtbbelow'] . '</td>
					<td style="text-align:center">' . $row['mtbbtwn'] . '</td>
					<td style="text-align:center">' . $row['mtbabove'] . '</td>
					
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center">' . $row['rifbelow'] . '</td>
					<td style="text-align:center">' . $row['rifbtwn'] . '</td>
					<td style="text-align:center">' . $row['rifabove'] . '</td>
					</tr>
					</tbody>
				</table>
			
		</div>

	</div>
	
</div>
<div class="row">
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
					 Tests by Gender
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			<div class="panel-body no-padding">
				<div class="panel-body no-padding" id="res3">
				
			         <script type="text/javascript">
			          $( "#res3" ).load( "chartgender.php?pos=' . $row['totalMale'] . '&neg=' . $row['totalFemale'] . '&rif=' . $row['totalNotsp'] . '" );
			         </script> 
				    
				</div>
			
			</div>
		</div>

	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Gender
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">Male</td>
					<td  style="text-align:center">Female</td>
					<td  style="text-align:center">Not specified</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center">' . $row['totalMale'] . '</td>
					<td style="text-align:center">' . $row['totalFemale'] . '</td>
					<td style="text-align:center">' . $row['totalNotsp'] . '</td>
					
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">' . $row['mtbMale'] . '</td>
					<td style="text-align:center">' . $row['mtbFemale'] . '</td>
					<td style="text-align:center">' . $row['mtbNotsp'] . '</td>
					
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center">' . $row['rifMale'] . '</td>
					<td style="text-align:center">' . $row['rifFemale'] . '</td>
					<td style="text-align:center">' . $row['rifNotsp'] . '</td>
					</tr>
					</tbody>
					</table> 
		</div>

	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Tests By Hiv Status
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			<div class="panel-body no-padding">
				<div class="panel-body no-padding" id="res4">
				
			         <script type="text/javascript">
			          $( "#res4" ).load( "charthiv.php?pos=' . $row['totalPos'] . '&neg=' . $row['totalNeg'] . '&rif=' . $row['totalND'] . '&ind=' . $row['totalD'] . '" );
			         </script> 
				    
				</div>
			
				
			</div>
		</div>

	</div>
	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By Hiv Status
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
		
			
				<table class="table table-striped">
					<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td  style="text-align:center">+ve</td>
					<td  style="text-align:center">-ve</td>
					<td  style="text-align:center">Not Done</td>
					<td  style="text-align:center">Declined</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"># Tests</td>
					<td style="text-align:center">' . $row['totalPos'] . '</td>
					<td style="text-align:center">' . $row['totalNeg'] . '</td>
					<td style="text-align:center">' . $row['totalND'] . '</td>
					<td style="text-align:center">' . $row['totalD'] . '</td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">' . $row['mtbPos'] . '</td>
					<td style="text-align:center">' . $row['mtbNeg'] . '</td>
					<td style="text-align:center">' . $row['mtbND'] . '</td>
					<td style="text-align:center">' . $row['mtbD'] . '</td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center">' . $row['rifPos'] . '</td>
					<td style="text-align:center">' . $row['rifNeg'] . '</td>
					<td style="text-align:center">' . $row['rifND'] . '</td>
					<td style="text-align:center">' . $row['rifD'] . '</td>
					</tr>
					</tbody>
				</table>
			
		</div>

	</div>
	
</div>

<br />
<div class="row">
	
	<!-- <div class="col-sm-3">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Outcome By Patient Categories
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
				
			<div id="chartp"  align="center"> 
              <script type="text/javascript">
		      var myChart = new FusionCharts("StackedColumn2D", "myChartnat", "480", "300", "0");
		      myChart.render("chartp");
		      </script> 
			  </div>

		</div>
		
	</div> -->

	<div class="col-sm-12">
		
		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						Summary By patient Categories
						<br />
						<small>' . $dt . '</small>
					</h4>
				</div>
				
				
			</div>
				
			<table class="table table-striped">
				<thead>
					<tr>
					<td  style="text-align:center">#</td>
					<td style="text-align:center">Smear positive at 2 months</td>
					<td style="text-align:center">All smear negative PTB cases</td>
					<td style="text-align:center">Return after defaulting</td>
					<td style="text-align:center">Failure 1st line treatment</td>
					<td style="text-align:center">Failure re-treatment</td>
					<td style="text-align:center">Extra Pulmonary</td>
					<td style="text-align:center">New presumptive PTB</td>
					<td style="text-align:center">DR TB Contact</td>
					<td style="text-align:center">Refugees SS+ve</td>
					<td style="text-align:center">HCWs</td>
					<td style="text-align:center">Hiv (+)ve with symptoms of TB</td>
					<td style="text-align:center">Relapse</td>
					<td style="text-align:center">Prisoners with TB symptoms</td>
					<td style="text-align:center">Patients who develop TB while on IPT</td>
					<td style="text-align:center">No Patient type</td>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td style="text-align:center"> Tests</td>
					<td style="text-align:center">' . $row['totalsputumpos'] . '</td>
					<td style="text-align:center">' . $row['totalsputumneg'] . '</td>
					<td style="text-align:center">' . $row['totalReturn'] . '</td>
					<td style="text-align:center">' . $row['totalFailure'] . '</td>
					<td style="text-align:center">' . $row['totalFailureRt'] . '</td>
					<td style="text-align:center">' . $row['totalNP'] . '</td>
					<td style="text-align:center">' . $row['totalNewcase'] . '</td>
					<td style="text-align:center">' . $row['totalContact'] . '</td>
					<td style="text-align:center">' . $row['totalRef'] . '</td>
					<td style="text-align:center">' . $row['totalHCWs'] . '</td>
					<td style="text-align:center">' . $row['totalHivSy'] . '</td>
					<td style="text-align:center">' . $row['totalRe'] . '</td>
					<td style="text-align:center">' . $row['totalPr'] . '</td>
					<td style="text-align:center">' . $row['totalIPT'] . '</td>
					<td style="text-align:center">' . $row['totalNopt'] . '</td>
					</tr>
					<tr>
					<td style="text-align:center">MTB +ve</td>
					<td style="text-align:center">' . $row['mtbsputumpos'] . '</td>
					<td style="text-align:center">' . $row['mtbsputumneg'] . '</td>
					<td style="text-align:center">' . $row['mtbReturn'] . '</td>
					<td style="text-align:center">' . $row['mtbFailure'] . '</td>
					<td style="text-align:center">' . $row['mtbFailureRt'] . '</td>
					<td style="text-align:center">' . $row['mtbNP'] . '</td>
					<td style="text-align:center">' . $row['mtbNewcase'] . '</td>
					<td style="text-align:center">' . $row['mtbContact'] . '</td>
					<td style="text-align:center">' . $row['mtbRef'] . '</td>
					<td style="text-align:center">' . $row['mtbHCWs'] . '</td>
					<td style="text-align:center">' . $row['mtbHivSy'] . '</td>
					<td style="text-align:center">' . $row['mtbRe'] . '</td>
					<td style="text-align:center">' . $row['mtbPr'] . '</td>
					<td style="text-align:center">' . $row['mtbIPT'] . '</td>
					<td style="text-align:center">' . $row['mtbNopt'] . '</td>
					</tr>
					<tr>
					<td style="text-align:center">Rif Resistant</td>
					<td style="text-align:center">' . $row['rifsputumpos'] . '</td>
					<td style="text-align:center">' . $row['rifsputumneg'] . '</td>
					<td style="text-align:center">' . $row['rifReturn'] . '</td>
					<td style="text-align:center">' . $row['rifFailure'] . '</td>
					<td style="text-align:center">' . $row['rifFailureRt'] . '</td>
					<td style="text-align:center">' . $row['rifNP'] . '</td>
					<td style="text-align:center">' . $row['rifNewcase'] . '</td>
					<td style="text-align:center">' . $row['rifContact'] . '</td>
					<td style="text-align:center">' . $row['rifRef'] . '</td>
					<td style="text-align:center">' . $row['rifHCWs'] . '</td>
					<td style="text-align:center">' . $row['rifHivSy'] . '</td>
					<td style="text-align:center">' . $row['rifRe'] . '</td>
					<td style="text-align:center">' . $row['rifPr'] . '</td>
					<td style="text-align:center">' . $row['rifIPT'] . '</td>
					<td style="text-align:center">' . $row['rifNopt'] . '</td>
					</tr>
					</tbody>
					</table>
						
		</div>
		
	</div>

</div>';
} while ($row = mysqli_fetch_assoc($query));
echo @$res;

mysqli_close($dbConn);
