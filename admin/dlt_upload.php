<?php

include('Aheader.php');

if ((isset($_POST["btnUpload"]) == "up")) {
	//p@55w0rddv1
	$connect = mysql_connect('localhost','root','');
if (!$connect) { 
    die('Could not connect to MySQL: ' . mysql_error()); 
} 

$cid =mysql_select_db('db_ntrl',$connect); 
$fieldseparator = ",";
$lineseparator = "\n";
$target_path = "../Csvfiles/";

$target_path = $target_path . basename( $_FILES['file']['name']); 

/********************************/


if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
	
	
   /* echo "The file ".  basename( $_FILES['file']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";*/
}

/********************************/


$csvfile= $target_path;
$max_size = "3000";
$addauto = 1;

$save = 1;
$outputfile = "output.sql";
/********************************/

if(!file_exists($csvfile)) {
	
	$error= '<div class="errormsgbox">File not found. Make sure you specified the correct path. </div>' ;
	
  echo "<script>";
  echo "window.location.href='dlt_upload.php?msg=$error'";
  echo "</script>";
  
exit;
}

$file = @fopen($csvfile,"r");

if(!$file) {
   
$error= '<div class="errormsgbox">Please select a file to upload. </div>';
 echo "<script>";
  echo "window.location.href='dlt_upload.php?msg=$error'";
  echo "</script>";
  
exit;
}

$size = filesize($csvfile);

if(!$size) {
$error= '<div class="errormsgbox">>File is empty. </div>';
echo "<script>";
  echo "window.location.href='dlt_upload.php?msg=$error'";
  echo "</script>";
exit;
}

if($_FILES['file']['size'] > $max_size){
$error= '<div class="errormsgbox">Please Select a smaller file to Upload </div>';

echo "<script>";
  echo "window.location.href='dlt_upload.php?msg=$error'";
  echo "</script>";

exit;
}

/*if(file_exists(($_FILES['file']['size'])== $target_path)){

echo '<div class="errormsgbox">File already exists.Try another one </div>';

exit;
}
*/
$csvcontent = fread($file,$size);

fclose($file);

//include("db.php");

$lines = 0;
$queries = "";
$linearray = array();
$count=1;
$checker=0;
$sql_insert="insert into sample set ";
$insert_array=array();


foreach(explode($lineseparator,$csvcontent) as $line) {


$lines++;
$line = trim($line," \t");

$line = str_replace("\r","",$line);


$echostring = str_replace($line ,"",-1);

$linearray = explode($fieldseparator,$line);

if ($count>1 && $count<=66):

if(($linearray[0]) !="" && $linearray[1] !=""){

$temp_array=array(str_replace(" ", "_",str_replace("/", "",$linearray[0]))=>$linearray[1]);

$insert_array=array_merge($insert_array,$temp_array);

		
}
	endif;

	$count++;
	
}
$insert_array['Exported_Date']=date('Y-m-d', strtotime($insert_array['Exported_Date']));
$insert_array['Start_Time']=date('Y-m-d', strtotime($insert_array['Start_Time']));
$insert_array['End_Time']=date('Y-m-d', strtotime($insert_array['End_Time']));
$insert_array['Expiration_Date']=date('Y-m-d', strtotime($insert_array['Expiration_Date']));

//echo $insert_array['Exported_Date'];

foreach ($insert_array as $key => $value)
{
  
  $sql_insert .= $key."= '".$value."',";
  $fin=trim($sql_insert,',');
}

$sql_insert;
 
$query=mysql_query($fin, $connect );

//echo "Found a total of $lines records in this csv file.<br>";
 
$suceessmsg= '<div class="success">File successfully uploaded </div>';

echo "<script>";
echo "window.location.href='dlt_upload.php?msg=$suceessmsg'";
echo "</script>";
@header( 'Location: dlt_upload.php');

mysql_close($connect);
	
	
	
}
?>
<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
   <link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery.ui.tabs.css">
   <link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
    
  
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<div class="clearer">&nbsp;</div>
<div class="main" id="main-two-columns">

  <div class="left" id="main-left">
  <div class="section-title" style="width:950px">UPDATE TEST RESULTS FOR COMPLETED RUNS   </div>
  <?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
   <form name="up" action="#" enctype="multipart/form-data" class="TTWForm" method="POST" novalidate="">

    <table border="1" align="center" cellpadding="0" cellspacing="0" class="dataa-table" style="width: auto;">
      
    <tr>
      <td>
	  	<table border='0' class='data-table'>	
		<tr class='even'>
		<th colspan='1'>
		 <font size="1.2"> Date of Upload		</font></th>
		<td colspan='2'> <font size="1.2"> <?php echo date('d-M-Y'); ?></font></td>
		</tr>	
		<tr>
		<th style='background-color:#FFFFFF' colspan='3' width=200px>&nbsp;</th>
		</tr>	
		<tr class='even'>
  		  <th>    
     <label for="t"> <font size="1.2">Locate the .CSV Result File to Import  </font></label>
    	 </th>
		    <td>
    
    <span id="sprytextfield1">
    
    <input type="file" name="file"  required />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>  
		</tr>
		 <tr class='odd'>
    <td colspan="2">
    
    <div id="submit" align="center">
<input name="btnUpload" type="submit" id="btnUpload" value="Upload File"  class="button"> 
 </div>

    </td>
    </tr>
		</table> 
    
	<td>&nbsp;</td>
	<th >
	<div class='notice' ><small> The Results Upload & Entering Patient Details Must be Done as Follows: <br><br>&nbsp;&nbsp;&nbsp;&nbsp;i)Save the .CSV File in a Flash Disk/ Network Folder i.e ( save as <font color='#FF0000' style='font-size:14px'> filename </font> .CSV )<br>
&nbsp;&nbsp;&nbsp;&nbsp;ii) Locate the Specific .CSV file for Result Update <br> &nbsp;&nbsp;&nbsp;&nbsp; e.g
	 <strong><font color='#FF0000' style='font-size:16px'>v3008- estermwangi_2013.06.06_10.31.42.csv</font></strong> 
	 <br>&nbsp;&nbsp;&nbsp;&nbsp;iii) Click "Upload File" Button &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;iv) A Confirmation Message on Successfull/Unsuccessful Upload<br> 
		&nbsp;&nbsp;&nbsp;&nbsp;v) Proceed to Enter the Missing Patient Details as on Request Form 
	 </small>
	 </div>
</th>


    </tr>
   
    </table>
  </form>
  </div>

	
<div class="clearer">&nbsp;</div>

</div>




</body>
</html>
<?php
include("../includes/footer.php");
?>