<?php
    ob_start();
	include "../connection/db.php";
	if ($_REQUEST['generate'])
    {
    	
	    $county = $_POST['county'];
		$facility = $_POST['facility'];	
		//get month n year
		$monthly = $_POST['monthly'];
		$monthyear = $_POST['monthyear'];
		//get quarterly
		$quarterly = $_POST['quarterly'];
		$quarteryear = $_POST['quarteryear'];					
		//get yearly
		$yearly = $_POST['yearly'];
		
		if($_POST['period'] == 'Monthly'){
			
			if($county==0){
			 
              $sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND month(consumption.date) = '$monthly' 
					AND Year(consumption.date) = '$monthyear'
					AND status=1";
			}
			else if($county>0 and $facility==0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `countys`.`ID` ='$county'
					AND month(consumption.date) = '$monthly' 
					AND Year(consumption.date) = '$monthyear'
					AND status=1";
			}
			else if($county>0 and $facility>0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `consumption`.`facility`='$facility'
					AND `countys`.`ID` ='$county'
					AND month(consumption.date) = '$monthly' 
					AND Year(consumption.date) = '$monthyear'
					AND status=1";
			}
        }elseif($_POST['period'] == 'Quarterly'){
        	
        	      if ($quarterly==1)
				 {
				     $startmonth=$quarteryear."-01-01";
					 $endmonth=$quarteryear."-03-31";
				 }
				  else if ($quarterly==2)
				 {
				     $startmonth=$quarteryear."-04-01";
					 $endmonth=$quarteryear."-06-30";
				 }else if ($quarterly==3)
				 {
				     $startmonth=$quarteryear."-05-01";
					 $endmonth=$quarteryear."-09-30";
				 }else if ($quarterly==4)
				 {
				     $startmonth=$quarteryear."-10-01";
					 $endmonth=$quarteryear."-12-31";
				 }
        	
        	     if($county==0){
			 
              $sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `countys`.`ID` = `districts`.`county`
					AND  consumption.date BETWEEN '$startmonth' AND '$endmonth'
					AND status=1";
			}
			else if($county>0 and $facility==0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `countys`.`ID` ='$county'
					AND `countys`.`ID` = `districts`.`county`
					AND  consumption.date BETWEEN '$startmonth' AND '$endmonth'
					AND status=1";
			}
			else if($county>0 and $facility>0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `consumption`.`facility`='$facility'
					AND `countys`.`ID` ='$county'
					AND `countys`.`ID` = `districts`.`county`
					AND  consumption.date BETWEEN '$startmonth' AND '$endmonth'
					AND status=1";
			}
             
        
		}elseif($_POST['period'] == 'Yearly'){
              	if($county==0){
			 
              $sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND Year(consumption.date) = '$yearly'
                    AND status=1";
			}
			else if($county>0 and $facility==0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `countys`.`ID` ='$county'
					AND Year(consumption.date) = '$yearly'
					AND status=1";			}
			else if($county>0 and $facility>0){
				$sql="SELECT `consumption`.`ID` AS id,`consumption`.`facility` AS a,`facilitys`.`name` AS b, `districts`.`name` AS c,consumption.commodity AS d,consumption.b_bal AS bb,consumption.quantity AS e,consumption.quantity_used AS f,consumption.end_bal AS g,consumption.q_req AS h,consumption.allocated AS i
					FROM `consumption` ,facilitys, `districts` ,`countys`
					WHERE 
					`consumption`.`facility`= `facilitys`.`facilitycode`
					AND  `districts`.`ID` = `facilitys`.`district`
					AND `countys`.`ID` = `districts`.`county`
					AND `consumption`.`facility`='$facility'
					AND `countys`.`ID` ='$county'
					AND Year(consumption.date) = '$yearly'
					AND status=1";
			}
             		
	    }
		$result = mysql_query($sql,$ntrl) or die(mysql_error());
	    $rows = mysql_fetch_assoc($result);
}

   if ($_REQUEST['generate'])
          {
          	if($_POST['period'] == 'Monthly'){
			             			
	             	//get month n year
					$month = $_POST['monthly'];
					 if ($month==1)
					 {
					     $monthname=" Jan ";
					 }
					else if ($month==2)
					 {
					     $monthname=" Feb ";
					 }else if ($month==3)
					 {
					     $monthname=" Mar ";
					 }else if ($month==4)
					 {
					     $monthname=" Apr ";
					 }else if ($month==5)
					 {
					     $monthname=" May ";
					 }else if ($month==6)
					 {
					     $monthname=" Jun ";
					 }else if ($month==7)
					 {
					     $monthname=" Jul ";
					 }else if ($month==8)
					 {
					     $monthname=" Aug ";
					 }else if ($month==9)
					 {
					     $monthname=" Sep ";
					 }else if ($month==10)
					 {
					     $monthname=" Oct ";
					 }else if ($month==11)
					 {
					     $monthname=" Nov ";
					 }
					  else if ($month==12)
					 {
					     $monthname=" Dec ";
					 }
					$monthyear = $_POST['monthyear'];
					$dt= $monthname .'- '.  $monthyear;	
			           
        }elseif($_POST['period'] == 'Quarterly'){
        	//get quarterly
				$quarterly = $_POST['quarterly'];
				 if ($quarterly==1)
				 {
				     $monthname=" January-March ";
				 }
				else if ($quarterly==2)
				 {
				     $monthname=" April-June ";
				 }else if ($quarterly==3)
				 {
				     $monthname=" July-October ";
				 }else if ($quarterly==4)
				 {
				     $monthname=" November-December ";
				 }
				$quarteryear = $_POST['quarteryear'];	
				$dt= $monthname . $quarteryear;
		}elseif($_POST['period'] == 'Yearly'){
                
				//get yearly
                $yearly = $_POST['yearly'];
                $dt= $yearly;
        }
		
		if($county==0){
			 
              $title=" All Counties";
			}
			else if($county>0 and $facility==0){
				$sqlCN="SELECT name AS cN FROM countys WHERE ID ='$county'";
				$qCN=mysql_query($sqlCN,$ntrl ) or die(mysql_error());
				$rwCN=mysql_fetch_assoc($qCN);
			    $countyname=$rwCN['cN'];
				$title="All facilities in " .$countyname. " County";
			}
			else if($county>0 and $facility>0){
				$sqlCN="SELECT name AS cN FROM countys WHERE ID ='$county'";
				$qCN=mysql_query($sqlCN,$ntrl ) or die(mysql_error());
				$rwCN=mysql_fetch_assoc($qCN);
			    $countyname=$rwCN['cN'];
				$title="Specific facilities in " .$countyname. " County";
			}
             		
		
		
 }
	
	
	 	
	$html = '
	<style>
	table {margin-bottom: 1.4em; width: 100%;}
	th {font-weight: bold; font-size:11px;text-align:center;}
	thead th {background: #C3D9FF;}
	th,td,caption {padding: 4px 10px 4px 5px;}
	tr.even td {background: #F2F6FA;}
	tfoot {font-style: italic;}
	caption {background: #EEE;}
	
	table.data-table {
		border: 1px solid #CCB;
		margin-bottom: 0em;
		width: auto;
		text-align:center;
	}
	table.data-table th {
		background: #F0F0F0;
		border: 1px solid #DDD;
		color: #555;
		text-align:center;
	}
	table.data-table tr {border-bottom: 1px solid #DDD;}
	table.data-table td, table th {padding: 7px;}
	table.data-table td {
		background: #F6F6F6;
		border: 1px solid #DDD;
		font-size:11px;
	}
	table.data-table tr.even td {background: #FCFCFC;}
	
	</style>';
	$html .= '<img style="margin-left: 18%;" src="../img/logo.png" />';
	$html .= '<h4>GeneXpert Commodity Allocation in '.$title.' For The Period:  '.$dt.'</h4>';
	$html .= '<table border="1" class = "data-table" align="center">';
	$html .= '
	<thead><tr>
	<th style="text-align:center">MFL Code</th>
	<th style="text-align:center">Facility Name</th>
	<th style="text-align:center">Facility District</th>
	<th style="text-align:center">Commodity</th>
	<th style="text-align:center">Beginning Balance</th>
	<th style="text-align:center">Quantity Issued(From KEMSA) </th>
	<th style="text-align:center">Quantity Used</th>
	<th style="text-align:center">Ending Balance</th>
	<th style="text-align:center">Quantity Requested</th>
	<th style="text-align:center">Quantity Allocated</th>
	</tr></thead><tbody>';
	do {
	$html .= '
	<tr class"odd">
	<td style="text-align:center">'.$rows['a'].'</td>
	<td style="text-align:center">'.$rows['b'].'</td>
	<td style="text-align:center">'.$rows['c'].'</td>
	<td style="text-align:center">'.$rows['d'].'</td>
	<td style="text-align:center">'.$rows['bb'].'</td>
	<td style="text-align:center">'.$rows['e'].'</td>
	<td style="text-align:center">'.$rows['f'].'</td>
	<td style="text-align:center">'.$rows['g'].'</td>
	<td style="text-align:center">'.$rows['h'].'</td>
	<td style="text-align:center">'.$rows['i'].'</td>
	</tr>';
	}
    while ($rows = mysql_fetch_assoc($result)); 
	$html .= '</tbody></table>';
    include_once("mpdf.php");
    $mpdf=new mPDF(); 
    $mpdf->AddPage('L');
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	ob_end_flush(); exit; 
    mysql_free_result($result);?>


