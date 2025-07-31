<?php
include("connection/db.php");
error_reporting(0);
$rec = 0;
$handle = fopen('gxsites.csv', 'r');

$count = 0;
do {
    $rec++;
    if ($rec == 1) {
        continue;
    } else {

        $fcode = mysqli_real_escape_string($dbConn, $data[0]);
        $fname = mysqli_real_escape_string($dbConn, $data[1]);
        $county = mysqli_real_escape_string($dbConn, $data[3]);
        $sub_county = mysqli_real_escape_string($dbConn, $data[2]);

        $update = "UPDATE sample1 SET county='$county', sub_county='$sub_county', fname='$fname', ref_fname='$fname' where facility='$fcode' and county='';";
        //exit;		
        $rwCN =  mysqli_query($dbConn, $update) or die(mysqli_error($dbConn));
        $count = $count + 1;

        do {
            //echo $data[1].'<br>';
            //echo $update;
        } while (@mysqli_fetch_assoc($qCN));
    }
} while (($data = fgetcsv($handle, 195, ',', '"')) !== FALSE);

echo mysqli_error($dbConn);

echo $count . " Samples Updated";
	
            //echo mysqli_error($dbConn);

