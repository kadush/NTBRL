<?php 
require_once('../connection/db.php'); 

echo $countyID = $_POST['county'];
echo $q1 = "SELECT DISTINCT facility FROM sample1 where facility<99999";
$r1 = mysqli_query($dbConn,$q1, $ntrl) or die(mysqli_error($dbConn));
$row1 = mysqli_fetch_assoc($r1);
$totalreporting = mysqli_num_rows($r1);

$currentmonth=date("m");
$currentyear=date("Y");
$previousmonth=date("m")- 1;
$year=date("Y");
if ($currentmonth ==1)
{
$previousmonth=12;
$year=date("Y")-1;
}
else
{
$previousmonth=date("m")- 1;
$currentyear=date("Y");
$year=date("Y");
} 
 if($countyID==0){
	$sql="Select DISTINCT c.facility as fcode, f.name as fname, DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate,(c.end_bal+c.received) AS cart
        FROM consumption c
        left join facilitys f on c.facility = f.facilitycode
		left join sample1 s on s.facility = c.facility
		where s.Expiration_Date IS NOT NULL
		and c.facility<99999
		and c.commodity='Cartridge'
        and Year(c.date) = '$year'
		and month(c.date) = '$previousmonth'
		GROUP BY c.facility";
}
else {
	$sql="Select DISTINCT c.facility as fcode, f.name as fname, DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate,(c.end_bal+c.received) AS cart
        FROM consumption c
        left join facilitys f on c.facility = f.facilitycode
		left join sample1 s on s.facility = c.facility
		left join districts d on d.ID = f.district
		left join countys co on co.ID = d.county
		where s.Expiration_Date IS NOT NULL
		and c.facility>1
		and c.commodity='Cartridge'
        and Year(c.date) = '$year'
		and month(c.date) = '$previousmonth'
		and co.ID = '$countyID'
		GROUP BY c.facility";
}
   echo $sql;
   $result=mysqli_query($dbConn,$sql)or die(mysqli_error($dbConn)); 
   $row=mysqli_fetch_assoc($result);
   $reported=mysqli_num_rows($result);
   //var_dump($row); exit; 
    $table.='<table class="table table-bordered datatable" id="invt"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Test Done(Previous Month)</th><th  style="text-align:center">Test Done(This Month)</th><th  style="text-align:center">Remaining Cartridges</th><th  style="text-align:center">Remaining days(Expiration)</th><th  style="text-align:center">Remaining Falcon Tubes</th></tr>';
    $sumrc=0;
	$sumrt=0;
   do
  {
  	$fid=$row['fcode'];
   	$fname= htmlspecialchars($row['fname'], ENT_QUOTES, 'UTF-8');
  	$dd= (int) $row['DiffDate'];
	$cartridges= (int) $row['cart'];
	
	$q = "SELECT (c.end_bal+c.received) AS tubes FROM consumption c WHERE  c.facility='$fid' and c.commodity='Falcon Tubes'  ORDER BY c.date DESC LIMIT 1";
	$r = mysqli_query($dbConn,$q, $ntrl) or die(mysqli_error($dbConn));
	$row = mysqli_fetch_assoc($r);
	$tubes= $row['tubes'];
	
	$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$currentmonth' and  YEAR(End_Time)='$currentyear' and cond=1 and facility='$fid'";
	$rssample = mysqli_query($dbConn,$query_rssample, $ntrl) or die(mysqli_error($dbConn));
	$row_rssample = mysqli_fetch_assoc($rssample);
	$testdonethismonth = mysqli_num_rows($rssample);
	
	$query_rssample = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$previousmonth' and  YEAR(End_Time)='$year' and cond=1 and facility='$fid'";
	$rssample = mysqli_query($dbConn,$query_rssample, $ntrl) or die(mysqli_error($dbConn));
	$row_rssample = mysqli_fetch_assoc($rssample);
	$testdonePrevmonth = mysqli_num_rows($rssample);
	
	$query_rssample = "SELECT 
(
 SELECT SUM(c_quantity) FROM stock_adjustment WHERE MONTH(date)='$currentmonth' and  YEAR(date)='$currentyear' and facility LIKE '%$fid%' and adjustment=1 LIMIT 1
)AS pos_cart, 
(
 SELECT SUM(f_quantity) FROM stock_adjustment WHERE MONTH(date)='$currentmonth' and  YEAR(date)='$currentyear' and facility LIKE '%$fid%' and adjustment=1 LIMIT 1
)AS pos_falc, 
(
 SELECT SUM(c_quantity) FROM stock_adjustment WHERE MONTH(date)='$currentmonth' and  YEAR(date)='$currentyear' and facility LIKE '%$fid%' and adjustment=0 LIMIT 1
)AS neg_cart,
(
 SELECT SUM(f_quantity) FROM stock_adjustment WHERE MONTH(date)='$currentmonth' and  YEAR(date)='$currentyear' and facility LIKE '%$fid%' and adjustment=0 LIMIT 1
)AS neg_falc";
$rssample = mysqli_query($dbConn,$query_rssample, $ntrl) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$pos_cart= (int) $row_rssample['pos_cart'];
$pos_falc= (int) $row_rssample['pos_falc'];
$neg_cart= (int) $row_rssample['neg_cart'];
$neg_falc= (int) $row_rssample['neg_falc'];


$remainingcarts= ($cartridges + $pos_cart) - ($testdonethismonth + $neg_cart);
$remainingtubes= ($tubes + $pos_falc) - ($testdonethismonth + $neg_falc);
	
	if ($remainingcarts<0 or $remainingcarts==0) {
		$remainingcarts=0;
		$dd=0;
	}
	if ($remainingtubes<0) {
		$remainingtubes=0;
	}
	
	if ($dd=='NULL' or '') {
		$dd=0;
	}
	 if ($dd<0) {
	 	$dd = 0;
		  } 
	 $sumrc+=$remainingcarts;
	 $sumrt+=$remainingtubes;
   $table .= '<tr><td style="text-align:center">'.$fid.'</td><td style="text-align:center">'.$fname.'</td><td style="text-align:center">'.$testdonePrevmonth.'</td><td style="text-align:center">'.$testdonethismonth.'</td><td style="text-align:center">'.$remainingcarts.'</td><td style="text-align:center">'.$dd.' days</td><td style="text-align:center">'.$remainingtubes.'</td></tr>';
   
   }   
   
    while($row=mysqli_fetch_assoc($result));
    $table .= '<tr><td colspan="4" style="text-align:center">Total Remaining Cartridges = '.$sumrc.'</td><td colspan="3" style="text-align:center">Total remaining Falcon Tubes = '.$sumrt.'</td></tr>';
    $table .= '</table>';

echo $table;	
	exit;

?>