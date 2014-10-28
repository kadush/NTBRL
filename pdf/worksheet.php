<?php
ob_start();
 include "../connection/db.php";
if (isset($_GET['id']))
{
     $mfl = $_GET['id'];
}
$query_register = "SELECT * FROM  sample1 ";
$register = mysql_query($query_register) or  die(mysql_error());
$row_register = mysql_fetch_assoc($register);
$totalRows_register = mysql_num_rows($register);
	
require('mysql_table.php');

header("");

 $dt=@date("d-M-Y");

class PDF extends PDF_MySQL_Table
{
function Header() 

 
{
	//Title
	$this->SetFont('Times','',8);
	$this->Image('logo.png',120,6,50);
	$this->Cell(0,9,'GeneXpert Register for the period: '.sprintf(@date("d-M-Y")) , 3,1,'C');
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
 //$this->$date = date("d M Y");
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

$pdf->Table("SELECT lab_no AS 'Lab No',coldate AS Date, fullname AS `Patient Name`,gender AS Sex,age as Age, pat_type AS `Patient Type`, mobile AS `Mobile No`,  Refacility AS `Referrred From`,Test_Result AS `Test Result`,User  FROM  sample1 WHERE coldate='$dt' AND facility='$mfl'  ", $prop);

//SELECT * FROM accounting WHERE date between '" . $startdate . "' AND '" . $enddate . "' order by date ASC",$prop);

$pdf->Output();
ob_end_flush(); 


?>
<?php
mysql_free_result($register);
?>

