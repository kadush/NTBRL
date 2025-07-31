 <?php
require_once('../connection/db.php'); 
error_reporting(E_ALL & ~E_NOTICE);
ini_set('memory_limit', '-1'); 
ini_set('max_execution_time', 0);


// Table Name that you want
// to export in csv
//$ShowTable = "blogs";
/*
$FileName = "_export.csv";
$file = fopen($FileName,"w");

$sql = mysqli_query($dbConn,"SELECT * FROM  sample1 where year(End_Time)='2018' and month(End_Time)>6");
$row = mysqli_fetch_assoc($sql);
// Save headings alone
	$HeadingsArray=array();
	foreach($row as $name => $value){
		$HeadingsArray[]=$name;
	}
	fputcsv($file,$HeadingsArray); 
	
// Save all records without headings

	while($row = mysqli_fetch_assoc($sql)){
	$valuesArray=array();
		foreach($row as $name => $value){
		$valuesArray[]=$value;
		}
	fputcsv($file,$valuesArray); 
	}
	fclose($file);

header("Location: $FileName");

echo "Complete Record saves as CSV in file: <b style=\"color:red;\">$FileName</b>"; */


/* vars for export */
// database record to be exported
$db_record = 'sample1';
// optional where query
$where = "
Left join facilitys on sample1.facility = facilitys.facilitycode
Left join facilitiess on sample1.Refacility = facilitiess.facilitycode
left join districts on districts.ID = facilitys.district
left join countys on districts.county = countys.ID where year(End_Time)='2018'";
// filename for export
$csv_filename = 'Lab_Register_'.date('Y-m-d').'.csv';
// database variables
// $hostname = "localhost";
// $user = "XXXXXXXXX";
// $password = "XXXXXXXXX";
// $database = "XXXXXXXXX";
// // Database connecten voor alle services
// mysqli_connect($hostname, $user, $password)
// or die('Could not connect: ' . mysqli_error($dbConn)());
					
// mysqli_select_db($database)
// or die ('Could not select database ' . mysqli_error($dbConn)());
// create var to be filled with export data
$csv_export = '';
// query to get data from database
echo $query = mysqli_query($dbConn,"SELECT Sample_ID AS sid,Patient_ID AS pid,lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e,h_status as hs, pat_type AS f, mobile AS g, facilitys.name AS tf,  facilitiess.name AS h, districts.name AS di, countys.name AS co,  Test_Result AS i,mtbRif AS rif,User as j, coldate as cd, tym AS udt 
FROM ".$db_record." ".$where);
//exit;
$field = @mysqli_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysqli_field_name($query,$i).',';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '';
while($row = @mysqli_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
    $csv_export.= '"'.$row[mysqli_field_name($query,$i)].'",';
  }	
  $csv_export.= '
';	
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);

?> 