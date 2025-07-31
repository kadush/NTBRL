<?php
session_start();

require_once('../connection/db.php');

error_reporting(0);
$sql1 = "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));";
$result = mysqli_query($dbConn, $sql1) or die(mysqli_error($dbConn));

$level = $_POST['level'];
$co = $_POST['co'];
$sc = $_POST['sc'];
$qr = $_POST['qr'];
$yr = $_POST['yr'];


$sqlRec .= "select year, quarter, district, county,count(DISTINCT facility) as totalFac,
sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='1')  THEN 1 ELSE 0 END ) AS rechecked1,
sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='1')  THEN 1 ELSE 0 END ) AS unacceptable1, 
sum( CASE WHEN (rec_lab = '-') and (quarter='1')  THEN 1 ELSE 0 END ) AS non1, 
sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='2')  THEN 1 ELSE 0 END ) AS rechecked2,
sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='2')  THEN 1 ELSE 0 END ) AS unacceptable2, 
sum( CASE WHEN (rec_lab = '-') and (quarter='2')  THEN 1 ELSE 0 END ) AS non2, 
sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='3')  THEN 1 ELSE 0 END ) AS rechecked3,
sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='3')  THEN 1 ELSE 0 END ) AS unacceptable3,
sum( CASE WHEN (rec_lab = '-') and (quarter='3')  THEN 1 ELSE 0 END ) AS non3, 
sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='4')  THEN 1 ELSE 0 END ) AS rechecked4,
sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='4')  THEN 1 ELSE 0 END ) AS unacceptable4,
sum( CASE WHEN (rec_lab = '-') and (quarter='4')  THEN 1 ELSE 0 END ) AS non4, 
sum( CASE WHEN (rec_lab != 'Rechecked') THEN 1 ELSE 0 END ) AS notrechecke from eqa where year='$yr' GROUP BY county order by county ASC";

//echo $sqlRec;
$queryRec = mysqli_query($dbConn, $sqlRec);
$numrowsRec = mysqli_num_rows($queryRec);
$rowsRec = mysqli_fetch_assoc($queryRec);

if ($numrowsRec=='0') {
    $eqa .= 'No data for found for '. $yr;
} else {
   
$eqa .= '<table class="table table-striped table table-bordered" style="text-align:center">
<thead>
  <tr>
    <th style="text-align:center"><font color="#000">Year: '.$yr.'</font></th>
    <th rowspan="3" style="text-align:center"><font color="#990000">Total Facilities</font></th>
    <th colspan="3" style="text-align:center"><font color="#000">Q1</font></th>
    <th colspan="3" style="text-align:center"><font color="#000">Q2</font></th>
    <th colspan="3" style="text-align:center"><font color="#000">Q3</font></th>
    <th colspan="3" style="text-align:center"><font color="#000">Q4</font></th>
  </tr>
  <tr><strong>
    <th style="text-align:center"><font color="#990000">County</font></th>
    <th style="text-align:center"><font color="#990000">Rechecked</font></th>
    <th style="text-align:center"><font color="#990000">Unacceptable</font></th>
    <th style="text-align:center"><font color="#990000">Never Participated</font></th>
    <th style="text-align:center"><font color="#990000">Rechecked</font></th>
    <th style="text-align:center"><font color="#990000">Unacceptable</font></th>
    <th style="text-align:center"><font color="#990000">Never Participated</font></th>
    <th style="text-align:center"><font color="#990000">Rechecked</font></th>
    <th style="text-align:center"><font color="#990000">Unacceptable</font></th>
    <th style="text-align:center"><font color="#990000">Never Participated</font></th>
    <th style="text-align:center"><font color="#990000">Rechecked</font></th>
    <th style="text-align:center"><font color="#990000">Unacceptable</font></th>
    <th style="text-align:center"><font color="#990000">Never Participated</font></th>
    
  </tr>
  
</thead>
<tbody>';
do {

  $year = $rowsRec['year'];
  $county = $rowsRec['county'];
  $totalFac = $rowsRec['totalFac'];

  $tt = $rowsRec['tt'];
    $rechecked1 = $rowsRec['rechecked1'];
    $unacceptable1 =  $rowsRec['unacceptable1'];
    $Nrechecked1 = $rowsRec['non1'];
    $rechecked2 =  $rowsRec['rechecked2'];
    $unacceptable2 = $rowsRec['unacceptable2'];
    $Nrechecked2 = $rowsRec['non2'];
    $rechecked3 = $rowsRec['rechecked3'];
    $unacceptable3 = $rowsRec['unacceptable3'];
    $Nrechecked3 = $rowsRec['non3'];
    $rechecked4 = $rowsRec['rechecked4'];
    $unacceptable4 = $rowsRec['unacceptable4'];
    $Nrechecked4 = $rowsRec['non4'];
    $grandTotal = ($totalFac);

  $TotalRechecked = ($rechecked1 + $rechecked2 + $rechecked3 + $rechecked4);
  $TotalRecheckedP = round(($TotalRechecked / $grandTotal * 100), 0);

  //year summary
  $recheckedY = $rechecked1 + $rechecked2 + $rechecked3 + $rechecked4;
  $$unacceptableY = $unacceptable1 + $unacceptable2 + $unacceptable3 + $unacceptable4;
  $notrecheckedY = $rowsRec['notrechecked'];

    $rechecked1P = round(($rechecked1 / $grandTotal * 100), 0);
    $Nrechecked1P = round(($Nrechecked1 / $grandTotal * 100), 0);
    $unacceptable1P = round(($unacceptable1 / $grandTotal * 100), 0);
    $rechecked2P = round(($rechecked2 / $grandTotal * 100), 0);
    $Nrechecked2P = round(($Nrechecked2 / $grandTotal * 100), 0);
    $unacceptable2P = round(($unacceptable2 / $grandTotal * 100), 0);
    $rechecked3P = round(($rechecked3 / $grandTotal * 100), 0);
    $Nrechecked3P = round(($Nrechecked3 / $grandTotal * 100), 0);
    $unacceptable3P = round(($unacceptable3 / $grandTotal * 100), 0);
    $rechecked4P = round(($rechecked4 / $grandTotal * 100), 0);
    $Nrechecked4P = round(($Nrechecked4 / $grandTotal * 100), 0);
    $unacceptable4P = round(($unacceptable4 / $grandTotal * 100), 0);
  $eqa .= '
    <tr>
      <td>'.$county.'</td>
      <td>'.$totalFac.'</td>
      <td>'.$rechecked1.'</td>
      <td>'.$unacceptable1.'</td>
      <td>'.$Nrechecked1.'</td>
      <td>'.$rechecked2.'</td>
      <td>'.$unacceptable2.'</td>
      <td>'.$Nrechecked2.'</td>
      <td>'.$rechecked3.'</td>
      <td>'.$unacceptable3.'</td>
      <td>'.$Nrechecked3.'</td>
      <td>'.$rechecked4.'</td>
      <td>'.$unacceptable4.'</td>
      <td>'.$Nrechecked4.'</td>
    </tr>
  ';

} while ($rowsRec = mysqli_fetch_assoc($queryRec));


$eqa .= '</body></table>';

}
echo $eqa;
