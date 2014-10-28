<?php 
@require_once('connection/db.php');

//p@55w0rddv1
include('header.php');

if ((isset($_POST["btnUpload"]) == "up")) {
mysql_select_db($database, $ntrl);	
$fieldseparator = ",";
$lineseparator = "\n";
$target_path = "Csvfiles/";

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
	
  $error = '<div class="alert alert-danger">File not found.Please Try again. </div>' ;
  echo "<script>";
  echo "window.location.href='csv_upload.php?msg=$error'";
  echo "</script>";
  
exit;
}

$file = @fopen($csvfile,"r");

if(!$file) {
		
	$error= '<div class="alert alert-danger">Please select a file to upload. </div>';

echo "<script>";
  echo "window.location.href='csv_upload.php?msg=$error'";
  echo "</script>";
  
exit;
}

$size = filesize($csvfile);

if(!$size) {
echo  '<div class="alert alert-danger">>File is empty. </div>';

}

if($_FILES['file']['size'] > $max_size){
 $error = '<div class="alert alert-danger">Please Select a smaller file to Upload </div>';
 echo "<script>";
  echo "window.location.href='csv_upload.php?msg=$error'";
  echo "</script>";
exit;
}

/*if(file_exists(($_FILES['file']['size'])== $target_path)){

echo '<div class="alert alert-danger">File already exists.Try another one </div>';

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
$sql_insert="update sample1 set ";
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
$insert_array['Exported_Date']=@date('Y-m-d', strtotime($insert_array['Exported_Date']));
$insert_array['Start_Time']=@date('Y-m-d', strtotime($insert_array['Start_Time']));
$insert_array['End_Time']=@date('Y-m-d', strtotime($insert_array['End_Time']));
$insert_array['Expiration_Date']=@date('Y-m-d', strtotime($insert_array['Expiration_Date']));

 
$where=",cond='1' WHERE lab_no='".$insert_array['Sample_ID']."'";

foreach ($insert_array as $key => $value)
{
  
  $sql_insert .= $key."= '".$value."',";
  $fin=trim($sql_insert,',');
 
}
$sql_insert;
$save=$fin.$where;
$query=mysql_query($save,$ntrl);

$suceessmsg= '<div class="alert alert-success">File successfully uploaded </div>';

echo "<script>";
echo "window.location.href='csv_upload.php?msg=$suceessmsg'";
echo "</script>";


	
	
	
}
?>

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content">

<div class="row">
	<div class="col-md-7">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					UPDATE TEST RESULTS FOR COMPLETED RUNS
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			   <?php
			   if(isset($_GET['msg'])){
				echo $_GET['msg'];
				}
			   ?>
			   <form name="up" action="#" enctype="multipart/form-data" class="TTWForm" method="POST" novalidate="">
			
				  	<table  class='table table-bordered'>	
					<tr class='even'>
					<th colspan='1'>
					  Date of Upload
                    </th>
					<td colspan='2'>  <?php echo @date('d-M-Y'); ?></td>
					</tr>	
					<tr>
					  <th style='background-color:#FFFFFF' colspan='3' >&nbsp;</th>
					</tr>	
					<tr class='even'>
			  		<th>    
			        <label for="t"> Locate the .CSV Result File to Import</label>
			    	</th>
					<td>
			        <input type="file" name="file"  required />
			        </td>  
					</tr>
			        <tr>
					<th style='background-color:#FFFFFF' colspan='3' width=200px>&nbsp;</th>
					</tr>
					 <tr class='odd'>
			    <td colspan="2">
			    
			    <div id="submit" align="center">
				<input name="btnUpload" type="submit" id="btnUpload" value="Upload File"  class="btn btn-success" /> 
				<input type="reset"  value="Reset Fields"  class="btn btn-default" onclick="window.location.reload();"> 
				</div>
			
			    </td>
			    </tr>
	     </table> 
			</div>
		
		</div>
	
	</div>
	<div class="col-md-5">
		<blockquote class="blockquote-gold">
			The Results Upload & Entering Patient Details Must be Done as Follows: <br>
			i) Save the .CSV File in a Flash Disk/ Network Folder i.e (save as <font color='#FF0000' style='font-size:14px'> filename </font> .CSV)<br>
            ii) Locate the Specific .CSV file for Result Update <br>  e.g
           <strong><font color='#FF0000' style='font-size:14px'>v3008- estermwangi_2013.06.06_10.31.42.csv</font></strong><br>
           iii) Click "Upload File" Button <br> 
	       iv) A Confirmation Message on Successfull / Unsuccessful Upload<br> 
		
	
  </div>
</div>

	


	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
	
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>