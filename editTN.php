<?php
include("connection/db.php");
//error_reporting(0);
$rec = 0;
$handle = fopen('missing.csv', 'r');

$count = 0;
do {
    $rec++;
    if ($rec == 1) {
        continue;
    } else {


        //$facilitycode = mysqli_real_escape_string($dbConn, '13402');
        $facilitycode = mysqli_real_escape_string($dbConn, $data[0]);

        $sqlCN = "SELECT county,sub_county,facility FROM facility_map WHERE `mfl`='$facilitycode'";
        $qCN = mysqli_query($dbConn, $sqlCN) or die(mysqli_error($dbConn)());
        $rwCN = mysqli_fetch_assoc($qCN);
    
        $cname = mysqli_real_escape_string($dbConn, $rwCN['county']); //name of county
        $scname = mysqli_real_escape_string($dbConn, $rwCN['sub_county']); //name of county
        $fcname = mysqli_real_escape_string($dbConn, $rwCN['facility']); //name of county
        

        $update = "UPDATE sample1 SET `fname`= '$fcname',`county`= '$cname', `sub_county`= '$scname' WHERE facility='$facilitycode' and fname='';";

        echo $update . '<br>';

        //exit;
        // $rwCN = mysqli_fetch_assoc($dbConn, $update);

        $count = $count + 1;

        // do {
        //     //echo $data[1].'<br>';
        //     echo $update;
        // } while (@mysqli_fetch_assoc($qCN));
    }
} while (($data = fgetcsv($handle, 200, ',', '"')) !== FALSE);

echo mysqli_error($dbConn);

// echo $count1 . " Samples Updated";
echo $count . ' Records updated';
                
                        //echo mysqli_error($dbConn);
