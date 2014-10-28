<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

 $table.='<table class="table table-striped"><tr><th  style="text-align:center">Facility Name</th><th  style="text-align:center">Type of Tests</th><th  style="text-align:center">Distance</th><th  style="text-align:center">Average No. of Samples</th><th  style="text-align:center">Frequency</th></tr>';

 
    if (isset($_POST['id'])){
		$FacilityID = $_POST['id'];
	    $sql4="SELECT * FROM section4 WHERE section4.facility='$FacilityID'";
	
  
    $result=mysql_query($sql4,$conn);
	$data_array=mysql_fetch_assoc( $result);
	
	 $sql5="SELECT sum(sample*4) FROM section4 WHERE section4.facility='$FacilityID'";
	
  
    $result1=mysql_query($sql5,$conn);
	$data_array1=mysql_fetch_assoc( $result1);
	
       
	   while ($data_array=mysql_fetch_assoc($result))
       {
       
        $table .= '<tr><td style="text-align:center">'.$data_array['reference'].'</td><td style="text-align:center">'.$data_array['test'].'</td><td style="text-align:center">'.$data_array['distance'].'</td><td style="text-align:center">'.$data_array['sample'].'</td><td style="text-align:center">'.$data_array['frequency'].'</td></tr>';
	   } 
	   	$table.='<tr><th style="text-align:center" colspan="5">Total Average Tests per Month: '.$data_array1['sum(sample*4)'].'</th></tr>';
  
        $table .= '</table>';
      
        echo $table;
   
           
     }
?>

