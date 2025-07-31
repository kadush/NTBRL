<?php
include("connection/db.php");
error_reporting(1);
$rec = 1;
$handle = fopen('New_Truenat.csv', 'r');

$count = 1;
do {
    $rec++;
    if ($rec == 1) {
        continue;
    } else {

        $fcode = mysqli_real_escape_string($dbConn, $data[1]);
        //$fname = mysqli_real_escape_string($dbConn, $data[1]);
        $labname = mysqli_real_escape_string($dbConn, $data[1]);
       //$sub_county = mysqli_real_escape_string($dbConn, $data[2]);

        echo $update = "
        UPDATE facility_map SET labname='$labname', truenat='1', tmodular='2' where mfl='$fcode';";
        //exit;		
        //$rwCN =  mysqli_query($dbConn, $update) or die(mysqli_error($dbConn));
        $count = $count + 1;

        do {
            //echo $data[1].'<br>';
            //echo $update;
        } while (@mysqli_fetch_assoc($qCN));
    }
} while (($data = fgetcsv($handle, 50, ',', '"')) !== FALSE);

echo mysqli_error($dbConn);

echo $count . " Samples Updated";
	
            //echo mysqli_error($dbConn);
