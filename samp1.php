<?php
include("header.php");
require_once('connection/db.php');
$mfl=$_SESSION['mfl'];
mysql_select_db($database, $ntrl);
$query_rsexamination_required = "SELECT examination_required.id, examination_required.type FROM examination_required ORDER BY examination_required.id";
$rsexamination_required = mysql_query($query_rsexamination_required, $ntrl) or die(mysql_error());
$row_rsexamination_required = mysql_fetch_assoc($rsexamination_required);
$totalRows_rsexamination_required = mysql_num_rows($rsexamination_required);

mysql_select_db($database, $ntrl);
$query_rshiv_status = "SELECT hiv_status.id, hiv_status.status FROM hiv_status ORDER BY hiv_status.id";
$rshiv_status = mysql_query($query_rshiv_status, $ntrl) or die(mysql_error());
$row_rshiv_status = mysql_fetch_assoc($rshiv_status);
$totalRows_rshiv_status = mysql_num_rows($rshiv_status);

$query_rstype_of_patient = "SELECT type_of_patient.id, type_of_patient.type FROM type_of_patient ORDER BY type_of_patient.id";
$rstype_of_patient = mysql_query($query_rstype_of_patient, $ntrl) or die(mysql_error());
$row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
$totalRows_rstype_of_patient = mysql_num_rows($rstype_of_patient);

/*$query_rsfacilitys = "SELECT facilitys.facilitycode, facilitys.name FROM facilitys ORDER BY facilitys.name";
$rsfacilitys = mysql_query($query_rsfacilitys, $ntrl) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);
*/
$facilitycode= $_SESSION['mfl'];

$sqlCN="SELECT provinces.ID AS cid,provinces.name AS cN 
FROM countys,facilitys ,districts,provinces
WHERE
`facilitys`.`facilitycode`='$facilitycode'
AND `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `provinces`.`ID` = `countys`.`province` ";

$qCN=mysql_query($sqlCN) or die(mysql_error());
$rwCN=mysql_fetch_assoc($qCN);
$countyID=$rwCN['cid'];
$cname=$rwCN['cN'];

$query_rsfacilitys = "SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY
FROM `facilitys` , `districts` , `countys`, `provinces`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `provinces`.`ID` = `countys`.`province`
AND `provinces`.`ID` = '$countyID'";
$rsfacilitys = mysql_query($query_rsfacilitys, $ntrl) or die(mysql_error());
$row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
$totalRows_rsfacilitys = mysql_num_rows($rsfacilitys);


$query="SELECT sample1.lab_no as num FROM sample1 where facility='$mfl' ORDER by tym DESC LIMIT 1";
$rs = mysql_query($query, $ntrl) or die(mysql_error());
$rows = mysql_fetch_assoc($rs); 
$no=$rows['num'];
if( @mysql_affected_rows($rs)==0){
$num = substr($no,-5);
$namba=str_pad($num + 1, 5, 0, STR_PAD_LEFT);

}

else
{
	
$num=rand(1, 1);
for ($i = 1; $i <=$num ; $i++) {
    $namba= str_pad($i,5,'0', STR_PAD_LEFT);
}
 
}
if (isset($_POST["btnUpload"])) {
   $sql=
"INSERT INTO sample1 (`lab_no`,`op_no`,`regno`, `fullname`, `gender`, `age`,`ageb`, `mobile`,`address`,`pat_type`,`facility`,`Refacility`,`coldate`,`smear`,`h_status`,`exam_req`,`d_email`,`c_no`,`c_name`,`c_email`) VALUES (
'$_POST[labno]',
'$_POST[opno]',
'$_POST[regno]',
'$_POST[name]',
'$_POST[sex]',
'$_POST[age]',
'$_POST[ageb]',
'$_POST[p_no]',
'$_POST[address]',
'$_POST[ptype]',
'$_POST[facility]',
'$_POST[refacility]',
'$_POST[date]',
'$_POST[smear]',
'$_POST[hstatus]',
'$_POST[exam]',
'$_POST[d_email]',
'$_POST[c_no]',
'$_POST[c_name]',
'$_POST[c_email]')";
//exit;

$retval = mysql_query( $sql, $ntrl );
if(! $retval )
{
 echo '<div style="text-align: center;width: 250px;" class="alert alert-warning">Could not enter data.Try Again<a href="samp1.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>';
}
 $suceessmsg= '<div style="text-align: center;width: 250px;" class="alert alert-success">Patient details successfully saved <a href="samp1.php" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a></div>';

echo "<script>";
echo "window.location.href='samp1.php?msg=$suceessmsg'";
echo "</script>";
mysql_close($conn);
}
mysql_select_db($database, $ntrl);
$query_rssample = "SELECT * FROM sample1 WHERE `cond` = 0 ";
$rssample = mysql_query($query_rssample, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);
$total = mysql_num_rows($rssample);

//$totalRows_rssample = mysql_num_rows($rssample);

?>
    <link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
     
         $('#searchpatient').hide(); 
        

     }); 
     </script>

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content">

<div class="row">
	<div class="col-md-12">
		
		
		<div class="panel minimal minimal-gray">
			
			<div class="panel-heading">
				<div class="panel-title"><h4>Patient's Register </h4></div>
				
					<div class="col-sm-5" style="float: right">
						
						<div class="input-group">
						<label><strong><font color="red"></font>Search By Ip/No,Op/No or Referring Site Reg No: </strong></label>
						<input class="form-control" type="text" name="search" id="search" autocomplete="off"><label  for="field-1">  &nbsp;&nbsp; </label>
						<span class="input-group-btn"><input class="btn btn-primary" type="submit" id="btnsearch" name="btnsearch" value="Search" />
						</span>
						</div>
				
					</div>
				
			</div>
			
			<div class="panel-body" id="my-div me_1">
				
				<div class="panel panel-gradient" data-collapsed="0">
								
								<!-- panel head -->
								<div class="panel-heading">
									<div class="panel-title">Add New Patient</div>
									
									<div class="panel-options">
										<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
										<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
										<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
									</div>
								</div>
								
								<!-- panel body -->
								<div class="panel-body">
									<?php
   if(isset($_GET['msg'])){
	echo $_GET['msg'];
	}
   ?>
					<form name="save" id="save" class="validate" method="post" role="form">
					<div class="col-md-6">
						<input type="hidden" id="facility" name="facility" value="<?php echo  $_SESSION['mfl'];?>"  />
						<label  for="field-1"><strong>Testing Facility:</strong></label>
						<input type="text"  value="<?php echo  $_SESSION['facility'];?>" class="form-control" readonly   />
			
					</div>
					
					<div class="col-md-6">
						<label  for="field-1"><strong><font color="red">*</font>Referred From(Facility):</strong></label>
						<select name="refacility" id="refacility" class="select2" data-allow-clear="true" data-placeholder="Select One Facility...">
						      <option></option>
						      <optgroup label="National Facilities">
						      <?php
								do { 
								?>
								      <option value="<?php echo $row_rsfacilitys['CODE']?>"><?php echo $row_rsfacilitys['FACILITY']; ?></option>
								      <?php
								} while ($row_rsfacilitys = mysql_fetch_assoc($rsfacilitys));
								  $rows = mysql_num_rows($rsfacilitys);
								  if($rows > 0) {
								      mysql_data_seek($rsfacilitys, 0);
									  $row_rsfacilitys = mysql_fetch_assoc($rsfacilitys);
								  }
								?>
								</optgroup>
						    </select>
					</div>
					
					<div class="clear"></div>
					<br />
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong>Lab No:</strong></label>
						<input type="text" class="form-control" name="labno" value="<?php echo @date("dmy_").$_SESSION['mfl']."_". $namba?>"  readonly />
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong><font color="red"></font>Op/IP No:</strong></label>
						<input type="text" class="form-control" id="opno" name="opno" placeholder="Op/IP No" />
						</div>
					</div>
					
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong><font color="red"></font>TB Reg No:</strong></label>
						<input type="text" class="form-control" id="regno" name="regno" placeholder="Referring Site Reg no" />
						</div>
					</div>
					
					<div class="clear"></div>
					<br />
					
					<div class="col-md-4">
						<div class="form-group">
						<label  for="field-1"><strong><font color="red">*</font>Patient Name:</strong></label>
						<input type="text" name="name" id="name" data-validate="required,name"  class="form-control" placeholder="Patient Name">
						</div>
					</div>
					
					<div class="col-md-1">
						<div class="form-group">
						<label  for="field-1"><strong><font color="red">*</font>Age:</strong></label>
						<input type="text" data-validate="required" name="age" id="age" class="form-control" data-mask="99" placeholder="Age" />
						</div>
					</div>
					
					<div class="col-md-2">
						<label  for="field-1"><strong>  &nbsp;&nbsp; </strong></label>
						<select name="ageb" id="ageb" class="form-control">
				        <option value="1">Year(s)</option>
				        <option value="0">Month(s)</option>
				        </select>
					</div>
					
					<div class="col-md-2">
						<label  for="field-1"><strong><font color="red">*</font>Gender:</strong></label>
						<select name="sex" id="gender" class="form-control" data-first-option="false">
				        <option value="0">Select Gender</option>
				        <option value="Male">Male</option>
				        <option value="Female">Female</option>
				        </select>
					</div>
					
					<div class="col-md-3">
						<label  for="field-1"><strong>Date of Sample Collection:</strong></label>
						<div class="input-group">
						<input type="text" name="date" data-validate="required" class="form-control datepicker" data-format="dd-M-yyyy"  data-end-date="d" placeholder="Select Date">
						<div class="input-group-addon">
						<a href="#">
						<i class="entypo-calendar"></i>
						</a>
						</div>
						</div>
					</div>
					<div class="clear"></div>
					<br />
					
					<div class="col-md-3">
						<label  for="field-1"><strong>Physical Address:</strong></label>
						<input type="text" name="address" id="address" class="form-control" placeholder="Physical Address">
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong><font color="red"></font>Patient Mobile No:</strong></label>
						<input type="text" name="p_no" id="p_no" class="form-control" data-mask="9999999999" placeholder="Patient Mobile No" />
					    </div>
					</div>
					
					<div class="col-md-3">
					    <label  for="field-1"><strong><font color="red">*</font>Type of Patient:</strong></label>
						<select name="ptype" id="ptype"   class="form-control">
					      <option value="0">Type of Patient</option>
					      <?php
							do { 
							?>
							      <option value="<?php echo $row_rstype_of_patient['type']?>"><?php echo $row_rstype_of_patient['type']; ?></option>
							      <?php
							} while ($row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient));
							  $rows = mysql_num_rows($rstype_of_patient);
							  if($rows > 0) {
							      mysql_data_seek($rstype_of_patient, 0);
								  $row_rstype_of_patient = mysql_fetch_assoc($rstype_of_patient);
							  }
							?>
					    </select>
					</div>
					
					<div class="col-md-3">
						<label  for="field-1"><strong><font color="red">*</font>Smear(+ve/-ve):</strong></label>
						<select name="smear" id="smear" class="form-control" >
				        <option value="0">Select Type</option>
				        <option value="Positive">Positive</option>
				        <option value="Negative">Negative</option>
						<option value="Not Done">Not Done</option>
				        </select>
					</div>
					
					<div class="clear"></div>
					<br />
					
					<div class="col-md-2">
						<label  for="field-1"><strong><font color="red">*</font>Hiv Status:</strong></label>
						<select name="hstatus" id="hstatus"  class="form-control" >
					      <option value="0">Select Status</option>
					      <?php
							do { 
							?>
							      <option value="<?php echo $row_rshiv_status['status']?>"><?php echo $row_rshiv_status['status']; ?></option>
							      <?php
							} while ($row_rshiv_status = mysql_fetch_assoc($rshiv_status));
							  $rows = mysql_num_rows($rshiv_status);
							  if($rows > 0) {
							      mysql_data_seek($rshiv_status, 0);
								  $row_rshiv_status = mysql_fetch_assoc($rshiv_status);
							  }
							?>
					    </select>
					</div>
					
					<div class="col-md-3">
						<label  for="field-1"><strong><font color="red">*</font>Examination Required:</strong></label>
						<select name="exam" id="exam" class="form-control" >  >
					      <option value="0">Select Examination</option>
					      <?php
							do { 
							?>
							      <option value="<?php echo $row_rsexamination_required['type']?>"><?php echo $row_rsexamination_required['type']; ?></option>
							      <?php
							} while ($row_rsexamination_required = mysql_fetch_assoc($rsexamination_required));
							  $rows = mysql_num_rows($rsexamination_required);
							  if($rows > 0) {
							      mysql_data_seek($rsexamination_required, 0);
								  $row_rsexamination_required = mysql_fetch_assoc($rsexamination_required);
							  }
							?>
					    </select>
					</div>
					<div class="clear"></div>
					<br />
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong>CTLC Email :</strong></label>
						<input type="text"   class="form-control" name="d_email" id="d_email" data-validate="email" placeholder="DTLC Email" />
						</div>
					</div>
					
									
					<div class="col-md-3">
						<div class="form-group">
					    <label  for="field-1"><strong>Clinician Name:</strong></label>
						<input type="text" name="c_name" id="c_name"  class="form-control" placeholder="Clinician Name">
						</div>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong>Clinician Email:</strong></label>
						<input type="text" class="form-control" id="c_email" name="c_email" data-validate="email" placeholder="Clinician Email" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label  for="field-1"><strong>Clinician Mobile No:</strong></label>
						<input type="text" name="c_no" id="c_no" data-validate="required" value="2547"  class="form-control" data-mask="999999999999" placeholder="Clinician Mobile No" />
						</div>
					</div>
										
					<div class="clear"></div>
					<br />
					<div class="col-md-12" align="center">
					<button class="btn btn-success" type="submit" name="btnUpload" id="btnUpload">Save Details</button>
					<button class="btn" type="reset">Reset</button>
					</div>
					
					</form>
									
					</div>
					
				</div>
							
						
			</div>
			
		</div>
		
	</div>
			
</div>
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
	<script src="admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.validate.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.inputmask.bundle.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap-tagsinput.min.js" id="script-resource-8"></script>
	
	
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/toastr.js" id="script-resource-7"></script>
<script type="text/javascript">
$(document).ready(function() {

$('#btnsearch').click(function() {
$("#save")[0].reset();
s = $('#search').val();
//alert(s);
  
        $.ajax({
        	 
                type: "POST",
                url: "fix.php",
                data: 'id=' + s,
                cache: false,
                dataType:"json",
                success: function(data) {
                	document.getElementById('search').value = "";
                	$.each(data,function(i,v){
                		$("#"+i).val(v)
                		
                	});
                   //alert(data);$('#searchpatient').show(); $('#result').html(data);
                    
                   var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-bottom-left",
					"onclick": null,
					"sdeDuration": "1000",
					"tihowDuration": "300",
					"himeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
				
				toastr.success("One Patient Found", "Search Response", opts);
                },
                error: function () {
                	document.getElementById('search').value = "";
                    var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-bottom-left",
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
				
				toastr.error("No patient Found", "Search Response", opts);
                }
            })
       
        }); // End of  keyup function

    }); // End of document.ready

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