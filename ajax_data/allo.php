<?php

@require_once('../connection/db.php'); 
$conn = mysql_connect($hostname, $username, $password);

 
 
    if (isset($_POST['id'])){
		$countyID = $_POST['id'];
	    $sql4="SELECT 
			`consumption`.`facility` AS a,
			`facilitys`.`name` AS b, 
			`districts`.`name` AS c,
			consumption.commodity AS d,
			consumption.b_bal AS e,
			consumption.quantity AS f,
			consumption.quantity_used AS g,
			consumption.end_bal AS h,
			consumption.q_req AS i,
			consumption.allocated AS j,
			consumption.date AS k
			FROM `consumption` ,facilitys, `districts` ,`countys`
			WHERE 
			`consumption`.`facility`= `facilitys`.`facilitycode`
			AND  `districts`.`ID` = `facilitys`.`district`
			AND `countys`.`ID` = `districts`.`county`
			AND `countys`.`ID` = '$countyID'
			AND `consumption`.`status`=1
			GROUP BY `consumption`.`ID` ";
	//echo $sql4;
  
    $result=mysql_query($sql4,$conn) or die(mysql_error());
	//$data_array=mysql_fetch_assoc( $result);
	
	if( mysql_num_rows($result)==0){
			
			 $table .= '<table class="table table-striped"><tr><td colspan="6" style="text-align:center">There are no reported facilities in this County</td></tr></table>';
			} 
    else{
    	
        $table.='<table class="table table-striped"><tr><th  style="text-align:center">MFL Code</th><th  style="text-align:center">Facility Name</th><th  style="text-align:center">District</th><th  style="text-align:center">Commodity</th><th style="text-align:center">Beginning Balance</th><th style="text-align:center">Quantity Issued(From KEMSA) </th><th style="text-align:center">Quantity Used</th><th  style="text-align:center">Closing Balance</th><th  style="text-align:center">Requested</th><th  style="text-align:center">Allocated</th><th  style="text-align:center">Period</th></tr>';
		
	   while ($data_array=mysql_fetch_assoc($result))
       {
       
        $table.='<tr><td style="text-align:center">'.$data_array['a'].'</td><td style="text-align:center">'.$data_array['b'].'</td><td style="text-align:center">'.$data_array['c'].'</td><td style="text-align:center">'.$data_array['d'].'</td><td style="text-align:center">'.$data_array['e'].'</td><td style="text-align:center">'.$data_array['f'].'</td><td style="text-align:center">'.$data_array['g'].'</td><td style="text-align:center">'.$data_array['h'].'</td><td style="text-align:center">'.$data_array['i'].'</td><td style="text-align:center">'.$data_array['j'].'</td><td style="text-align:center">'.$data_array['k']= @date('M-Y', strtotime($data_array['k'])).'</td></tr>';
		
		
		
      } 
    }
  
        $table .= '</table>';
      
        echo $table;
   
           
     }
?>
