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

$sql .= "select year, quarter, district, county,count(DISTINCT facility) as totalFac,
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
sum( CASE WHEN (rec_lab != 'Rechecked') THEN 1 ELSE 0 END ) AS notrechecked ";

//National level
if ($co == '0') { //all counties

  if ($qr == 0) {
    $sql .= "from eqa where year='$yr'";
  } else {
    $sql .= "from eqa where year='$yr'";
  }
} elseif (($co != '0') and ($sc == '0')) { //specific county

  if ($qr == 0) {
    $sql .= "from eqa where year='$yr' and county='$co'";
  } else {
    $sql .= "from eqa where year='$yr' and county='$co'";
  }
} elseif (($co != '0') and ($sc != '0')) { //specific sub county

  if ($qr == 0) {
    $sql .= "from eqa where year='$yr' and  district='$sc'";
  } else {
    $sql .= "from eqa where year='$yr' and  district='$sc'";
  }
}


// exit;
$query1 = mysqli_query($dbConn, $sql);
$numrows = mysqli_num_rows($query1);
$row1 = mysqli_fetch_assoc($query1);


if ($numrows == 0) {
  echo "No data";
} else {
  do {
    $year = $row1['year'];
    $county = $row1['county'];
    $totalFac = $row1['totalFac'];

    $tt = $row1['tt'];
    $rechecked1 = $row1['rechecked1'];
    $unacceptable1 =  $row1['unacceptable1'];
    $Nrechecked1 = $row1['non1'];
    $rechecked2 =  $row1['rechecked2'];
    $unacceptable2 = $row1['unacceptable2'];
    $Nrechecked2 = $row1['non2'];
    $rechecked3 = $row1['rechecked3'];
    $unacceptable3 = $row1['unacceptable3'];
    $Nrechecked3 = $row1['non3'];
    $rechecked4 = $row1['rechecked4'];
    $unacceptable4 = $row1['unacceptable4'];
    $Nrechecked4 = $row1['non4'];
    $grandTotal = ($totalFac);

    //year summary
    $recheckedY=$rechecked1+$rechecked2+$rechecked3+$rechecked4;
    $$unacceptableY=$unacceptable1+$unacceptable2+$unacceptable3+$unacceptable4;
    $notrecheckedY = $row1['notrechecked'];

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

    $chart='<chart caption="Trend of Unacceptable performance lab" showLabels="1" showvalues="1" decimals="0" xAxisName="' . $year . '" yAxisName="No. of Labs"  placeValuesInside="0" rotateValues="0"><categories><category label="Q1" /><category label="Q2" /><category label="Q3" /><category label="Q4" /></categories><dataset seriesName="No. of Total lab." color="AFD8F8" ><set value="'.$totalFac.'" /><set value="'.$totalFac.'" /><set value="'.$totalFac.'" /><set value="'.$totalFac.'" /></dataset><dataset seriesName="No. of Recheked lab." color="F6BD0F" ><set value="'.$rechecked1.'" /><set value="'.$rechecked2.'" /><set value="'.$rechecked3.'" /><set value="'.$rechecked4.'" /></dataset><dataset seriesName="No. of Unacceptable lab." color="8BBA00" ><set value="'.$unacceptable1.'" /><set value="'.$unacceptable2.'" /><set value="'.$unacceptable3.'" /><set value="'.$unacceptable4.'" /></dataset><dataset seriesName="% of Unacceptable lab." renderAs="Line"><set value="'.$unacceptable1P.'" /><set value="'.$unacceptable2P.'" /><set value="'.$unacceptable3P.'" /><set value="'.$unacceptable4P.'" /></dataset></chart>';


    $eqa .= '<div class="row"><div class="col-sm-5"><table class="table table-bordered" style="max-width: 400px;"><!--style="font-family:Times New Roman;font-size: 11px;"-->
    <tr>
      <th style="text-align: center;font-size: 14px;" colspan="4"><strong>Distribution ratio of Unacceptable laboratory</strong></th>
    </tr>
    <tr>
      <td style="text-align: center;font-size: 12px;" colspan="2"><strong><font color="#990000">Number of laboratory (total)</font></strong></td>
      <td style="text-align: center;" colspan="2"><strong>' . $totalFac . '</strong></td>
    </tr>
    <tr>
      <td style="text-align: center;"><font color="#990000">' . $year . '</font></td>
      <td style="text-align: center;"> </td>
      <td style="text-align: center;"><font color="#990000">Number</font></td>
      <td style="text-align: center;"><font color="#990000">%</font></td>
    </tr>
    <tr>
      <td rowspan="3"><strong>Q1</strong></td>
      <td style="text-align: center;">Recheked laboratory</td>
      <td style="text-align: center;">' . $rechecked1 . '</td>
      <td style="text-align: center;">' . $rechecked1P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Unacceptable laboratory</td>
      <td style="text-align: center;">' . $unacceptable1 . '</td>
      <td style="text-align: center;">' . $unacceptable1P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Never Participated</td>
      <td style="text-align: center;">' . $Nrechecked1 . '</td>
      <td style="text-align: center;">' . $Nrechecked1P . '</td>
    </tr>
    <tr>
      <td rowspan="3"><strong>Q2</strong></td>
      <td style="text-align: center;">Recheked laboratory</td>
      <td style="text-align: center;">' . $rechecked2 . '</td>
      <td style="text-align: center;">' . $rechecked2P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Unacceptable laboratory</td>
      <td style="text-align: center;">' . $unacceptable2 . '</td>
      <td style="text-align: center;">' . $unacceptable2P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Never Participated</td>
      <td style="text-align: center;">' . $Nrechecked2 . '</td>
      <td style="text-align: center;">' . $Nrechecked2P . '</td>
    </tr>
    <tr>
      <td rowspan="3"><strong>Q3</strong></td>
      <td style="text-align: center;">Recheked laboratory</td>
      <td style="text-align: center;">' . $rechecked3 . '</td>
      <td style="text-align: center;">' . $rechecked3P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Unacceptable laboratory</td>
      <td style="text-align: center;">' . $unacceptable3 . '</td>
      <td style="text-align: center;">' . $unacceptable3P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Never Participated</td>
      <td style="text-align: center;">' . $Nrechecked3 . '</td>
      <td style="text-align: center;">' . $Nrechecked3P . '</td>
    </tr>
    <tr>
      <td rowspan="3"><strong>Q4</strong></td>
      <td style="text-align: center;">Recheked laboratory</td>
      <td style="text-align: center;">' . $rechecked4 . '</td>
      <td style="text-align: center;">' . $rechecked4P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Unacceptable laboratory<br></td>
      <td style="text-align: center;">' . $unacceptable4 . '</td>
      <td style="text-align: center;">' . $unacceptable4P . '</td>
    </tr>
    <tr>
      <td style="text-align: center;">Never Participated</td>
      <td style="text-align: center;">' . $Nrechecked4 . '</td>
      <td style="text-align: center;">' . $Nrechecked4P . '</td>
    </tr>
  </table>
';
  } while ($row1 = mysqli_fetch_assoc($query1));
}
$eqa .= "</tbody></table></div> <div class='col-sm-5'>

   
<div id='chartdivtre2'> </div>
<script type='text/javascript'>
   var myChart = new FusionCharts('mscombi2D', 'myChartId10', '600', '380','0');
   myChart.setXMLData('$chart');
   myChart.render('chartdivtre2');
</script>



</div></div>";

echo $eqa;
