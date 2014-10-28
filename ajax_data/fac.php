<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

 
 
    if (isset($_POST['id'])){
		$CountyID = $_POST['id'];
	    $sql4="SELECT mfl,fname,total,mtb,neg,rif,errs

FROM(
SELECT 
facilitys.facilitycode AS mfl,
facilitys.name as fname,
sum(CASE WHEN cond='1' THEN 1 ELSE 0 END) as total,

sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,

sum(CASE WHEN Test_Result = 'negative'  THEN 1 ELSE 0 END) as neg,

sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif, 

sum( CASE WHEN Test_Result = 'ERROR' OR Test_Result = 'Invalid' OR Test_Result = 'Indeterminate' THEN 1 ELSE 0 END ) AS errs 
FROM sample1 
LEFT  JOIN `facilitys` ON `sample1`.`facility` = `facilitys`.`facilitycode`
LEFT  JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT  JOIN `countys` ON `countys`.`ID` = `districts`.`county`

WHERE `countys`.`ID` ='$CountyID'
GROUP BY fname
)x";
	//echo $sql4;
	
  
    $result=mysql_query($sql4,$conn) or die(mysql_error());
	//$data_array=mysql_fetch_assoc( $result);
	
	if( mysql_num_rows($result)==0){
			
			 $table .= '<table class="table table-striped"><tr><td colspan="6" style="text-align:center">There are no tests done in this County</td></tr></table>';
			} 
    else{
       	$table.='<table class="table table-striped"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Total Tests</th><th  style="text-align:center">MTB Positive</th><th style="text-align:center">MTB Negative</th><th  style="text-align:center">RIF Resistant</th><th  style="text-align:center">Errors / Invalid</th></tr>';

	   while ($data_array=mysql_fetch_array($result))
       {
       $facility=$data_array['mfl'];
        $table .= '<tr><td style="text-align:center"><a href="facility.php?id='.$facility.'">'.$data_array['mfl'].'</a></td><td style="text-align:center">'.$data_array['fname'].'</td><td style="text-align:center">'.$data_array['total'].'</td><td style="text-align:center">'.$data_array['mtb'].'</td><td style="text-align:center">'.$data_array['neg'].'</td><td style="text-align:center">'.$data_array['rif'].'</td><td style="text-align:center">'.$data_array['errs'].'</td></tr>';
	
      } 
    }
  
  $table .= '</table>';
      
        echo $table;
   
           
     }
?>
