<?php
include('connection/db.php');

$sql="SELECT `provinces`.`name` AS PROVINCE,
 Count(`sample`.`Test_Result`) AS `TESTRESULT`,
 COUNT(`provinces`.`name`) AS TOTAL
  
  
FROM `sample` , `provinces` , `facilitys` ,`countys`, `districts`
WHERE `sample`.`facility` = `facilitys`.`ID`
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`province` = `provinces`.`ID`
GROUP BY `provinces`.`name`";
$query=mysql_query($sql);
$numrows=mysql_num_rows($query);
if(!$numrows){
	
echo"No Data Exists";	
	
}
else{
$i=0;
$dyn_table1 = '<table  class="data-table" "cellpadding="0" border="1" align="left" >';	
while($row=mysql_fetch_assoc($query)){
	
$provinces=$row['PROVINCE'];
$test=$row['TESTRESULT'];
@$ttest+=$test;
$total=$row['TOTAL'];
@$ttotal+=$total;
	
if ($i % 10 == 0){ 
$dyn_table1 .= '<tr bgcolor="#2daebf"><th><small>Provinces</small></th><th><small>Test Done</small></th><th><small>Total</small></th>';
          $dyn_table1 .= '<tr class=even><td align="left"><small>' .$provinces . '</small></td>';
		  $dyn_table1 .= '<td align="left" ><small>' . $test . '</small></td>';
		  $dyn_table1 .= '<td align="left" ><small>' . $total. '</small></td></tr>';
		  		   
		  
  
} 
else{
	      $dyn_table1 .= '<tr class=even><td align="left"><small>' .$provinces . '</small></td>';
		  $dyn_table1 .= '<td align="left" ><small>' . $test . '</small></td>';
		  $dyn_table1 .= '<td align="left" ><small>' . $total. '</small></td></tr>';
          	
} 
           
	
	$i++;	
	
	
	
	
}	
$dyn_table1 .='<tr><td><b>TOTALS</b></td><td><b>'.$ttest.'</b></td><td><b>'.$ttotal.'</b></td></tr>';	
$dyn_table1 .= '</table>';	
	
}




?>