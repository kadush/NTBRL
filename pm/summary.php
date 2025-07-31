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
        sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='2')  THEN 1 ELSE 0 END ) AS rechecked2,
        sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='2')  THEN 1 ELSE 0 END ) AS unacceptable2, 
        sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='3')  THEN 1 ELSE 0 END ) AS rechecked3,
        sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='3')  THEN 1 ELSE 0 END ) AS unacceptable3, 
        sum( CASE WHEN (rec_lab = 'Rechecked') and (quarter='4')  THEN 1 ELSE 0 END ) AS rechecked4,
        sum( CASE WHEN (un_lab = 'Unacceptable') and (quarter='4')  THEN 1 ELSE 0 END ) AS unacceptable4,
        sum( CASE WHEN (rec_lab != 'Rechecked') THEN 1 ELSE 0 END ) AS notrechecked  ";

//National level
if ($co == '0') { //all counties

  if ($qr == 0) {
    $sqlRec .= "from eqa where year='$yr'";
  } else {
    $sqlRec .= "from eqa where year='$yr'";
  }
} elseif (($co != '0') and ($sc == '0')) { //specific county

  if ($qr == 0) {
    $sqlRec .= "from eqa where year='$yr' and county='$co'";
  } else {
    $sqlRec .= "from eqa where year='$yr' and county='$co'";
  }
} elseif (($co != '0') and ($sc != '0')) { //specific sub county

  if ($qr == 0) {
    $sqlRec .= "from eqa where year='$yr' and  district='$sc'";
  } else {
    $sqlRec .= "from eqa where year='$yr' and  district='$sc'";
  }
}


//echo $sqlRec;
$queryRec = mysqli_query($dbConn, $sqlRec);
$numrowsRec = mysqli_num_rows($queryRec);
$rowsRec = mysqli_fetch_assoc($queryRec);

do {
  $year = $rowsRec['year'];
  $county = $rowsRec['county'];
  $totalFac = $rowsRec['totalFac'];

  $tt = $rowsRec['tt'];
  $rechecked1 = $rowsRec['rechecked1'];
  $unacceptable1 =  $rowsRec['unacceptable1'];
  $rechecked2 =  $rowsRec['rechecked2'];
  $unacceptable2 = $rowsRec['unacceptable2'];
  $rechecked3 = $rowsRec['rechecked3'];
  $unacceptable3 = $rowsRec['unacceptable3'];
  $rechecked4 = $rowsRec['rechecked4'];
  $unacceptable4 = $rowsRec['unacceptable4'];
  $grandTotal = ($totalFac);

  $TotalRechecked = ($rechecked1 + $rechecked2 + $rechecked3 + $rechecked4);
  $TotalRecheckedP = round(($TotalRechecked / $grandTotal * 100), 0);

  //year summary
  $recheckedY = $rechecked1 + $rechecked2 + $rechecked3 + $rechecked4;
  $$unacceptableY = $unacceptable1 + $unacceptable2 + $unacceptable3 + $unacceptable4;
  $notrecheckedY = $row1['notrechecked'];

  $rechecked1P = round(($rechecked1 / $grandTotal * 100), 0);
  $unacceptable1P = round(($unacceptable1 / $grandTotal * 100), 0);
  $rechecked2P = round(($rechecked2 / $grandTotal * 100), 0);
  $unacceptable2P = round(($unacceptable2 / $grandTotal * 100), 0);
  $rechecked3P = round(($rechecked3 / $grandTotal * 100), 0);
  $unacceptable3P = round(($unacceptable3 / $grandTotal * 100), 0);
  $rechecked4P = round(($rechecked4 / $grandTotal * 100), 0);
  $unacceptable4P = round(($unacceptable4 / $grandTotal * 100), 0);
} while ($rowsRec = mysqli_fetch_assoc($queryRec));





if ($co == '0') { //all counties

  if ($qr == 0) {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp,sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' group by quarter";
  } else {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where quarter='$qr' and year='$yr' group by quarter";
  }
} elseif (($co != '0') and ($sc == '0')) { //specific county

  if ($qr == 0) {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp,sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and county='$co' group by quarter";
  } else {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where quarter='$qr' and year='$yr' and county='$co' group by quarter";
  }
} elseif (($co != '0') and ($sc != '0')) { //specific sub county

  if ($qr == 0) {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt,sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where year='$yr' and district='$sc' group by quarter";
  } else {
    $sql = "SELECT year, quarter, facility, fname, district, county,sum(tt) AS tt, sum(sp) AS sp, sum(st) AS st, sum(cl) AS cl, sum(th) AS th, sum(si) AS si, sum(ev) AS ev from evaluation where quarter='$qr' and year='$yr' and district='$sc' group by quarter";
  }
}

//echo $sql;


// exit;
$query1 = mysqli_query($dbConn, $sql);
$numrows = mysqli_num_rows($query1);
$row1 = mysqli_fetch_assoc($query1);


if ($numrows == 0) {
    $tt = 0;
    $sp = 0;
    $st =  0;
    $cl =  0;
    $th = 0;
    $si = 0;
    $ev = 0;
    $grandTotal = ($tt);
} else {
  do {
    $year = $row1['year'];
    $county = $row1['county'];
    $quarter = $row1['quarter'];

    $tt = $row1['tt'];
    $sp = $row1['sp'];
    $st =  $row1['st'];
    $cl =  $row1['cl'];
    $th = $row1['th'];
    $si = $row1['si'];
    $ev = $row1['ev'];
    $grandTotal = ($tt);

    $spP = round(($sp / $grandTotal * 100), 0);
    $stP = round(($st / $grandTotal * 100), 0);
    $clP = round(($cl / $grandTotal * 100), 0);
    $thP = round(($th / $grandTotal * 100), 0);
    $siP = round(($si / $grandTotal * 100), 0);
    $evP = round(($ev / $grandTotal * 100), 0);


    $smear .= '<tr>
    <td><strong>Quarter ' . $quarter . '</strong></td>
    <td> </td>
    <td> </td>
    <td> </td>
  </tr>
  <tr>
    <td>Number(%) of Sputum Quality</td>
    <td>' . $sp . '</td>
    <td>' . $spP . '</td>
    <td></td>
  </tr>
  <tr>
    <td>Number(%) of Staining</td>
    <td>' . $st . '</td>
    <td>' . $stP . '</td>
    <td></td>
  </tr>
  <tr>
    <td>Number(%) of Cleanness</td>
    <td>' . $cl . '</td>
    <td>' . $clP . '</td>
    <td></td>
  </tr>
  <tr>
    <td>Number(%) of Thickness</td>
    <td>' . $th . '</td>
    <td>' . $thP . '</td>
    <td></td>
  </tr>
  <tr>
    <td>Number(%) of Size</td>
    <td>' . $si . '</td>
    <td>' . $siP . '</td>
    <td></td>
  </tr>
  <tr>
    <td>Number(%) of Evenness</td>
    <td>' . $ev . '</td>
    <td>' . $evP . '</td>
    <td></td>';
  } while ($row1 = mysqli_fetch_assoc($query1));


  $eqa .= '<table class="table table-striped" style="max-width: 800px;"><!--style="font-family:Times New Roman;font-size: 11px;"-->
    <tr>
      <th style="text-align: center;font-size: 14px;" colspan="4"><strong>Summary results of rechecking</strong></th>
    </tr>
    <tr>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td><strong><font color="#990000">' . $county . ' COUNTY</font></strong></td>
      <td><strong><font color="#990000">Year</font></strong></td>
      <td><strong><font color="#990000">' . $year . '</font></strong></td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td> </td>
      <td><strong><font color="#990000">Number</font></strong></td>
      <td><strong><font color="#990000">Percentage</font></strong></td>
      <td><strong><font color="#990000">Target</font></strong></td>
      
    </tr>
    <tr>
      <td>Number of operational laboratories</td>
      <td>' . $totalFac . '</td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked (%)</td>
      <td>' . $totalRechecked . '</td>
      <td>' . $totalRecheckedP . '%</td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>1st quarter</strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked (%)</td>
      <td>' . $rechecked1 . ' </td>
      <td>' . $rechecked1P . '</td>
      <td>90%</td>
    </tr>
    <tr>
      <td><strong>2nd quarter</strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked (%)</td>
      <td>' . $rechecked2 . ' </td>
      <td>' . $rechecked2P . '</td>
      <td>90%</td>
    </tr>
    <tr>
      <td><strong>3rd quarter</strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked (%)</td>
      <td>' . $rechecked3 . ' </td>
      <td>' . $rechecked3P . '</td>
      <td>90%</td>
    </tr>
    <tr>
      <td><strong>4th quarter</strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked (%)</td>
      <td>' . $rechecked4 . ' </td>
      <td>' . $rechecked4P . '</td>
      <td>90%</td>
    </tr>
    <tr>
      <td><strong>Year</strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked all 4 quarters (%) </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those rechecked at least 1Q but not all quater (%)</td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of those Not rechecked (%)</td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Number of positive slides rechecked</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of negative slides rechecked</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Overall percentage positives in the laboratories routine</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Overall percentage high false positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Overall percentage false negatives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Overal percentage true positives / all positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Overall detection proportional to the controllers</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with more than 1 HFP</td>
      <td></td>
      <td></td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with 100% true positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with 95-99% true positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with 90-94% true positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with 85-89% true positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with &lt;85% true positives</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories with insufficient data to calculate this parameter</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Number (%) of laboratories with more than 1 FN</td>
      <td></td>
      <td></td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories as good as controllers at detecting positives (&gt;=0.95)</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories almost as good as controllers at detecting positives (0.85-0.94)</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories moderately good at detecting positives (0.75-0.84)</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories doing poorly at detecting positives (0.50-0.74)</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number (%) of laboratories doing very poorly at detecting positives (&lt;0.50)</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories with insufficient data to calculate this parameter</td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>1st quarter </strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories recheked EQA</td>
      <td>' . $rechecked1 . ' </td>
      <td>' . $rechecked1P . '</td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of Unacceptable laboratories (%)</td>
      <td>' . $unacceptable1 . ' </td>
      <td>' . $unacceptable1P . '</td>
      <td>Less than 20%</td>
    </tr>
    <tr>
      <td><strong>2nd quarter </strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories recheked EQA</td>
      <td>' . $rechecked2 . ' </td>
      <td>' . $rechecked2P . '</td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of Unacceptable laboratories (%)</td>
      <td>' . $unacceptable2 . ' </td>
      <td>' . $unacceptable2P . '</td>
      <td>Less than 20%</td>
    </tr>
    <tr>
      <td><strong>3rd quarter </strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories recheked EQA</td>
      <td>' . $rechecked3 . ' </td>
      <td>' . $rechecked3P . '</td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of Unacceptable laboratories (%)</td>
      <td>' . $unacceptable3 . ' </td>
      <td>' . $unacceptable3P . '</td>
      <td>Less than 20%</td>
    </tr>
    <tr>
      <td><strong>4th quarter </strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories recheked EQA</td>
      <td>' . $rechecked4 . ' </td>
      <td>' . $rechecked4P . '</td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of Unacceptable laboratories (%)</td>
      <td>' . $unacceptable4 . ' </td>
      <td>' . $unacceptable4P . '</td>
      <td>Less than 20%</td>
    </tr>
    <tr>
      <td><strong>Year</td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of laboratories recheked EQA</td>
      <td>1</td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <td>Number of Unacceptable laboratories (%)</td>
      <td>#VALUE!</td>
      <td> </td>
      <td>Less than 30%</td>
    </tr>
    <tr>
      <td> </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong><font color="#990000">Smear praparation</font></strong></td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>';
}

$end = '</table>';


echo $eqa . $smear . $end;
