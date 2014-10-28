<?php
error_reporting(0);
session_start();
include "connection/db.php";

define('IN_CB',true);

define('VERSION', '2.1.0');

if(version_compare(phpversion(),'5.0.0','>=')!==true)
	exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>'.phpversion().'</b>.');

if(!function_exists('imagecreate'))
	exit('Sorry, make sure you have the GD extension installed before running this script.');
require('html/function.php');
include('html/config.php');
$mfl=$_SESSION['mfl'];
$facilityname=$_GET['id2'];
$dt=@date("d-M-Y");
$sql="SELECT s.lab_no AS a,s.coldate AS b, s.fullname AS c, f.name AS d FROM sample1 s , facilitys f WHERE s.cond=0 and s.Refacility = f.facilitycode AND s.facility='$mfl'";
$results = mysql_query($sql,$ntrl) or die(mysql_error());
$rows = mysql_fetch_assoc($results);
?>
<html>
<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
<body onLoad="JavaScript:window.print();">
<div align="center">
<h3> <center> GeneXpert Register </center></h3>
<table class="table table-condensed">

<thead><tr>
	<th style="text-align:center">Lab No.</th>
	<th style="text-align:center">Date Tested</th>
	<th style="text-align:center">Patient Name</th>
	<th style="text-align:center">Referred Facility</th>
	<th style="text-align:center">Lab No Barcode</th>
	<th style="text-align:center">Patient Name Barcode</th>
</tr></thead><tbody>
	<?php
	 do {
	 	$num=$rows['a'];
	 	$pno="<span class='style7'>Lab NO : <strong>$num</strong>   </span>  <br>
		<img src='html/image.php?code=code128&o=2&dpi=50&t=50&r=1&rot=0&text=$num&f1=Arial.ttf&f2=8&a1=&a2=B' />";
		
		$name=$rows['c'];
	 	$pname ="<span class='style7'>Patient Name : <strong>$name</strong>   </span>  <br>
		<img src='html/image.php?code=code128&o=2&dpi=50&t=50&r=1&rot=0&text=$name&f1=Arial.ttf&f2=8&a1=&a2=B' />";
		//echo $image;
		//exit;
	    ?>
	<tr class"odd">
	<td style="text-align:center"><?php echo $rows['a']; ?></td>
	<td style="text-align:center"><?php echo $rows['b']; ?></td>
	<td style="text-align:center"><?php echo $rows['c']; ?></td>
	<td style="text-align:center"><?php echo $rows['d']; ?></td>
	<td style="text-align:center"><?php echo "<img src='html/image.php?code=code128&o=2&dpi=50&t=50&r=1&rot=0&text=$num&f1=Arial.ttf&f2=6&a1=&a2=B&a3='  /> ";?></td>
	<td style="text-align:center"><?php echo "<img src='html/image.php?code=code128&o=2&dpi=50&t=50&r=1&rot=0&text=$name&f1=Arial.ttf&f2=6&a1=&a2=B&a3='  /> ";?></td>
	
	</tr></tbody>
	<?php } while ($rows = mysql_fetch_assoc($results)); ?>


</table>

</body>
</html>