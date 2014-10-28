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
			             
			              $sql="SELECT lab_no AS 'Lab No',End_Time AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Test_Result AS `Test Result`  FROM  sample1 WHERE month(End_Time) = '$monthly' AND Year(End_Time) = '$monthyear'   AND cond='1' AND facility='$mfl' AND facility='$mfl'";
						 
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
		            	
			              $sql="SELECT lab_no AS 'Lab No',End_Time AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Test_Result AS `Test Result` FROM  sample1 WHERE End_Time BETWEEN '$startmonth' AND '$endmonth'  AND cond='1' AND facility='$mfl'";
			        
					}elseif($_POST['period'] == 'Yearly'){
			              
			             $sql="SELECT lab_no AS 'Lab No',End_Time AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Test_Result AS `Test Result`  FROM  sample1 WHERE Year(End_Time) = '$yearly' AND cond='1' AND facility='$mfl'";
			        
			        }elseif($_POST['period'] == 'Date Range'){
			              
			             $sql="SELECT lab_no AS 'Lab No',End_Time AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Test_Result AS `Test Result` FROM  sample1 WHERE End_Time BETWEEN '$startdate' AND '$enddate'  AND cond='1' AND facility='$mfl'";
			        
			        }elseif($_POST['period'] == 'Specific Date'){
			              
			             $sql="SELECT lab_no AS 'Lab No',End_Time AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Test_Result AS `Test Result` FROM  sample1 WHERE End_Time ='$specificdate'  AND cond='1' AND facility='$mfl'";
			        
			        } 
			
$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);
require('mysql_table.php');

header("");

  
class PDF extends PDF_MySQL_Table
{
function Header() 

 
{
	if ($_REQUEST['generatereport'])
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
							$dt= $monthname .'-'.  $monthyear;	
			           
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
	//Title
	$this->SetFont('Times','',8);
	$this->Image('logo.png',120,6,50);
	$this->Cell(0,9,'GeneXpert Register for the period: '.$dt, 3,1,'C'); 
	$this->Ln(5);


	//Ensure table header is output
	parent::Header();
}
function Footer()
{
//Position at 1.5 cm from bottom
$this->SetY(-10);
//Arial italic 8
$this->SetFont('Times','I',8);
 //$this->$date = @date("d M Y");
//Page number
/*Page 1
catalogue.txt*/
$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}


$pdf=new PDF();
$pdf->addPage('L');;

$pdf->SetFont('Times','',9);
$offset = 1;
$img_offset = 20;
$img_width = 30;
$start_row_init = 40;
$cell_width = 0;
$line_height = 10;
$spacing = 10; // spacing between items
$start_row = $start_row_init;

if ($start_row + $img_height >= 200 - 20) {
$start_row = $start_row_init;
$pdf->addPage('L');
}




$prop=array('HeaderColor'=>array(160,160,160),
			'color1'=>array(204,255,229),
			'color2'=>array(204,229,255),
			'border'=>(0),
			'padding'=>2);


$pdf->SetFont('Times','B',9);
//

$pdf->Table( $sql, $prop);

$pdf->Output();
ob_end_flush(); 
}
 
?>
<?php
mysql_free_result($query);
?>

