<?php
include("connection/db.php");
error_reporting(0);
$rec = 0;
$handle = fopen('GXRefFac.csv', 'r');

$count = 0;
do {
    $rec++;
    if ($rec == 1) {
        continue;
    } else {

        $fcode = mysqli_real_escape_string($dbConn, $data[0]);
        $fname = mysqli_real_escape_string($dbConn, $data[1]);
       
        $update = "UPDATE sample1 SET ref_fname='$fname' where Refacility='$fcode' and (ref_fname='' or ref_fname='NULL');";
        //exit;		
        $rwCN =  mysqli_query($dbConn, $update) or die(mysqli_error($dbConn));
        $count = $count + 1;

        // do {
        //     //echo $data[1].'<br>';
        //     //echo $update;
        // } while (@mysqli_fetch_assoc($qCN));
    }
} while (($data = fgetcsv($handle, 7000, ',', '"')) !== FALSE);

echo mysqli_error($dbConn);

echo $count . " Samples Updated";
	
            //echo mysqli_error($dbConn);

