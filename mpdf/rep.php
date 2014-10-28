<?php
    ob_start();
	include "../connection/db.php";
	
	
	if ($_REQUEST['generatereport'])
    {
    $mfl = $_POST['mfl'];
    //get date range
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];	
	//get month n year
	$monthly = $_POST['monthly'];
	$monthyear = $_POST['monthyear'];
	//get quarterly
	$quarterly = $_POST['quarterly'];
	$quarteryear = $_POST['quarteryear'];					
	//get yearly
	$yearly = $_POST['yearly'];
	$specificdate = $_POST['specificdate'];
	
        if($_POST['period'] == 'Monthly'){
             
              $sql="SELECT lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e, pat_type AS f, mobile AS g, f.name AS h,  Test_Result AS i,mtbRif AS rif,User as j FROM   sample1 s , facilitys f WHERE s.Refacility = f.facilitycode AND month(End_Time) = '$monthly' AND Year(End_Time) = '$monthyear'   AND cond='1'  AND facility='$mfl'";
			  $sql1="SELECT count(CASE WHEN cond='1' THEN 1 ELSE 0 END ) as tests,sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs FROM   sample1 WHERE month(End_Time) = '$monthly' AND Year(End_Time) = '$monthyear' AND cond='1' AND facility='$mfl'";
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
        	
             $sql="SELECT lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e, pat_type AS f, mobile AS g, f.name AS h,  Test_Result AS i,mtbRif AS rif,User as j FROM   sample1 s , facilitys f WHERE s.Refacility = f.facilitycode AND End_Time BETWEEN '$startmonth' AND '$endmonth'  AND cond='1'  AND facility='$mfl'  ";
             $sql1="SELECT count(CASE WHEN cond='1' THEN 1 ELSE 0 END ) as tests,sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs FROM   sample1 WHERE End_Time BETWEEN '$startmonth' AND '$endmonth' AND cond='1' AND facility='$mfl'";
        
		}elseif($_POST['period'] == 'Yearly'){
              
             $sql="SELECT lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e, pat_type AS f, mobile AS g, f.name AS h,  Test_Result AS i,mtbRif AS rif,User as j FROM   sample1 s , facilitys f WHERE s.Refacility = f.facilitycode AND Year(End_Time) = '$yearly' AND cond='1'  AND facility='$mfl'  ";
             $sql1="SELECT count(CASE WHEN cond='1' THEN 1 ELSE 0 END ) as tests,sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs FROM   sample1 WHERE Year(End_Time) = '$yearly' AND cond='1' AND facility='$mfl'";
        
        }elseif($_POST['period'] == 'Date Range'){
              
             $sql="SELECT lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e, pat_type AS f, mobile AS g, f.name AS h,  Test_Result AS i,mtbRif AS rif,User as j FROM   sample1 s , facilitys f WHERE s.Refacility = f.facilitycode AND  End_Time BETWEEN '$startdate' AND '$enddate'  AND cond='1'  AND facility='$mfl'  ";
             $sql1="SELECT count(CASE WHEN cond='1' THEN 1 ELSE 0 END ) as tests,sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs FROM   sample1 WHERE End_Time BETWEEN '$startdate' AND '$enddate' AND cond='1' AND facility='$mfl'";
        
        }elseif($_POST['period'] == 'Specific Date'){
              
             $sql="SELECT lab_no AS a,End_Time AS b, fullname AS c,gender AS d,age AS e, pat_type AS f, mobile AS g, f.name AS h, Test_Result AS i,mtbRif AS rif,User as j FROM   sample1 s , facilitys f WHERE s.Refacility = f.facilitycode AND End_Time ='$specificdate'  AND cond='1'  AND facility='$mfl'  ";
        	 $sql1="SELECT count(CASE WHEN cond='1' THEN 1 ELSE 0 END ) as tests, sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtb,sum( CASE WHEN Test_Result =  'negative'  THEN 1 ELSE 0 END) as neg,sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS rif,sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS errs FROM  sample1 WHERE End_Time ='$specificdate'  AND cond='1'  AND facility='$mfl'";
        
        } 
    }
			
	$result = mysql_query($sql,$ntrl) or die(mysql_error());
	$rows = mysql_fetch_assoc($result);
	$tests= mysql_affected_rows($rows);
	$result1 = mysql_query($sql1,$ntrl) or die(mysql_error());
	$rows1 = mysql_fetch_assoc($result1);
	
	if ($_REQUEST['generatereport'])
          {
          	 $facilityname =$_POST['fn'];
			 
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
        }elseif($_POST['period'] == 'Date Range'){
              
                 //get date range
				$startdate = $_POST['startdate'];
				$startdate = @date("d-M-Y",strtotime($startdate));
				$enddate = $_POST['enddate'];	
				$enddate = @date("d-M-Y",strtotime($enddate));
				$dt= $startdate. ' to ' . $enddate;

        }elseif($_POST['period'] == 'Specific Date'){
              
	             $specificdate = $_POST['specificdate'];
                 $specificdate = @date("d-M-Y",strtotime($specificdate));
							 $dt= $specificdate;
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
	$html .= '<h4>'.$facilityname.' GeneXpert Register For The Period:  '.$dt.'</h4>';
	$html .= '<table border="1" class = "data-table" align="center">';
	$html .= '
	<thead><tr>
	<th style="text-align:center">Lab No.</th>
	<th style="text-align:center">Date Tested</th>
	<th style="text-align:center">Patient Name</th>
	<th style="text-align:center">Gender</th>
	<th style="text-align:center">Age</th>
	<th style="text-align:center">Patient Type</th>
	<th style="text-align:center">Mobile No.</th>
	<th style="text-align:center">Referred Facility</th>
	<th style="text-align:center">MTB Result</th>
	<th style="text-align:center">MTB/RIf Result</th>
	<th style="text-align:center">Technician</th>
	</tr></thead><tbody>';
	 do {
	 	$rows['b']= @date("d-M-Y",strtotime($rows['b']));
	$html .= '
	<tr class"odd">
	<td style="text-align:center">'.$rows['a'].'</td>
	<td style="text-align:center">'.$rows['b'].'</td>
	<td style="text-align:center">'.$rows['c'].'</td>
	<td style="text-align:center">'.$rows['d'].'</td>
	<td style="text-align:center">'.$rows['e'].'</td>
	<td style="text-align:center">'.$rows['f'].'</td>
	<td style="text-align:center">'.$rows['g'].'</td>
	<td style="text-align:center">'.$rows['h'].'</td>
	<td style="text-align:center">'.$rows['i'].'</td>
	<td style="text-align:center">'.$rows['rif'].'</td>
	<td style="text-align:center">'.$rows['j'].'</td>
	</tr>';
	} while ($rows = mysql_fetch_assoc($result));
	$html .= '</tbody></table>';
	$html .= '<table border="1" class = "data-table" align="center">
	<tbody><tr class"odd">
	<th style="text-align:center">No.of tests done</th>
	<td style="text-align:center">'.$rows1['tests'].'</td>
	<th style="text-align:center">No.of MTB Pos</th>
	<td style="text-align:center">'.$rows1['mtb'].'</td>
	<th style="text-align:center">No.of MTB Neg</th>
	<td style="text-align:center">'.$rows1['neg'].'</td>
	<th style="text-align:center">No.of MTB Rif</th>
	<td style="text-align:center">'.$rows1['rif'].'</td>
	<th style="text-align:center">No.of Test with Errors</th>
	<td style="text-align:center">'.$rows1['errs'].'</td>';
	$html .= '</tbody></table>';
    include_once("mpdf.php");
    $mpdf=new mPDF(); 
    $mpdf->AddPage('L');
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	ob_end_flush(); exit; 
    mysql_free_result($result);?>

