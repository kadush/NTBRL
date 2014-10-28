
<?php require_once('connection/db.php'); 

$sql= "SELECT `Provinces`.`name` AS Province, 
sum(CASE WHEN cond='1' THEN 1 ELSE 0 END) as total,
sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb,
 
sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg,

sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif, 
sum(
CASE WHEN Test_Result = 'MTB DETECTED'
AND `h_status` = 'POSITIVE'
THEN 1
ELSE 0
END ) AS HIVPOS
FROM `sample`
LEFT JOIN `facilitys` ON `sample`.`facility` = `facilitys`.`ID`
LEFT JOIN `districts` ON `districts`.`ID` = `facilitys`.`district`
LEFT JOIN `countys` ON `countys`.`ID` = `districts`.`county`
LEFT JOIN `provinces` ON `countys`.`province` = `provinces`.`ID`
WHERE Province IS NOT NULL
GROUP BY Province ";


$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table4 .= '
<tr  bgcolor="#CCC">
<th align="center"><small>PROVINCES</small></th>
<th align="center"><small>TOTAL TESTS DONE</small></th>
<th align="center"><small>MTB NOT DETECTED</small></th>
<th align="center"><small>MTB DETECTED</small></th>
<th align="center"><small>RIF RESISTANT</small></th>
<th align="center"><small>HIV POSITIVE</small></th>
</tr>';
$dyn_table4 .= '<tr><td rowspan="5" align="center"> <small>No Data to Display </small></td></tr>';
}
else{
$i=0;
$dyn_table4 = '<table  class="data-table" width="200px" cellpadding="0" border="1" align="left" bgcolor="#CCC" >';	
while($row=mysql_fetch_assoc($query)){

$prov=$row['Province'];	
$total=$row['total'];
@$ttotal+=$total;
$mtbp=$row['mtb'];
@$tmtbp+=$mtbp;	
$rif=$row['rif'];
@$trif+=$rif;		
$hiv=$row['HIVPOS'];
@$thiv+=$hiv;	
$mtbn=$row['neg'];
@$tmtbn+=$mtbn;	
	
if ($i % 10000 == 0){ 
$dyn_table4 .= '
<tr  bgcolor="#CCC">
<th align="center"><small>PROVINCES</small></th>
<th align="center"><small>TOTAL TESTS DONE</small></th>
<th align="center"><small>MTB NOT DETECTED</small></th>
<th align="center"><small>MTB DETECTED</small></th>
<th align="center"><small>RIF RESISTANT</small></th>
<th align="center"><small>HIV POSITIVE</small></th>
</tr>';

$dyn_table4 .= '<tr><td align="center"><small>' .$prov . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$total . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$mtbn. '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$mtbp . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' . $rif . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' . $hiv . '</small></td></tr>';
																															  
		    		     		   
  
} 
 else{
	$dyn_table4 .= '<tr><td align="center"> <small>' .$prov . '</small></td>';
	$dyn_table4 .= '<td align="center"> <small>' .$total . '</small></td>';
	$dyn_table4 .= '<td align="center"><small>' .$mtbn. '</small></td>';
	$dyn_table4 .= '<td align="center"><small>' .$mtbp . '</small></td>';
	$dyn_table4 .= '<td align="center"><small>' . $rif . '</small></td>';
	$dyn_table4 .= '<td align="center"><small>' . $hiv . '</small></td></tr>';
																																					
} 
       
	$i++;	
		
}	
$dyn_table4 .= '<tr><th align="center"><small>TOTALS </small></th>';
$dyn_table4 .= '<td align="center"> <small>' .$ttotal . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$tmtbn. '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$tmtbp . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' .$trif . '</small></td>';
$dyn_table4 .= '<td align="center"><small>' . $thiv . '</small></td></tr>';	  
$dyn_table4 .= '</table>';	
	
}

?>
