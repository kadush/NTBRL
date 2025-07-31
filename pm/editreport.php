<?php 
require_once('../connection/db.php');

mysqli_select_db($database, $ntrl);
include('header.php');
$facilityname=$_GET['nm'];
$facilitycode=$_GET['mfl'];
$month = $_GET['month'];
$year = $_GET['year'];
$countyID=$_GET['id'];

//check if the facility has reported for th previous month

$query= "SELECT * FROM consumption WHERE commodity='cartridge' and MONTH(date)='$month' AND YEAR(date)='$year' and facility='$facilitycode'";
$rs = mysqli_query($dbConn,$query, $ntrl) or die(mysqli_error($dbConn));
$row = mysqli_fetch_assoc($rs);

$idc = $row['ID'];
$beginningbalc = $row['b_bal'];
$quantityrecc = $row['quantity'];
$qusedc = $row['quantity_used'];
$lossesc = $row['losses'];
$posc = $row['pos'];
$negc = $row['neg'];
$endbalc = $row['end_bal'];
$qreqc = $row['q_req'];


$query1= "SELECT * FROM consumption WHERE commodity='Falcon tubes' and MONTH(date)='$month' AND YEAR(date)='$year' and facility='$facilitycode'";
$rs1 = mysqli_query($dbConn,$query1, $ntrl) or die(mysqli_error($dbConn));
$row1 = mysqli_fetch_assoc($rs1);

$idf = $row1['ID'];
$beginningbalf = $row1['b_bal'];
$quantityrecf = $row1['quantity'];
$qusedf = $row1['quantity_used'];
$lossesf = $row1['losses'];
$posf = $row1['pos'];
$negf = $row1['neg'];
$endbalf = $row1['end_bal'];
$qreqf = $row1['q_req'];


if (isset($_POST["submitreport"])) {
$q1="UPDATE consumption SET `b_bal`='$_POST[oqualkit]', `quantity`='$_POST[recqualkit]', `quantity_used`='$_POST[uqualkit]', `losses`='$_POST[wqualkit]', `pos`='$_POST[pqualkit]', `neg`='$_POST[iqualkit]', `end_bal`='$_POST[equalkit]', `q_req`='$_POST[rqualkit]' WHERE `ID`='$idc'";
$retval = mysqli_query($dbConn, $q1, $ntrl );

$sq1="UPDATE consumption SET `b_bal`='$_POST[oqualkit1]', `quantity`='$_POST[recqualkit1]', `quantity_used`='$_POST[uqualkit1]', `losses`='$_POST[wqualkit1]', `pos`='$_POST[pqualkit1]', `neg`='$_POST[iqualkit1]', `end_bal`='$_POST[equalkit1]', `q_req`='$_POST[rqualkit1]' WHERE `ID`='$idf'";
$retval1 = mysqli_query($dbConn, $sq1, $ntrl );

if(! $retval1 or ! $retval )
{
	 
     $errormsg= 'Could not enter data.Try Again';
}
else
{
	 $suceessmsg= 'Commodity Inventory Successfully Updated </div>';
	 
}
echo "<script>";
echo "window.location.href='editreport.php?month='$month'&year='$year'&mfl='$facilitycode'&nm='$facilityname'";
echo "</script>";

   
} 
   	//header("Location: countyallocation.php");

?>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<script type="text/javascript">
function writeMessage()
{
	//..cartridge balances
		
	document.forms[0].equalkit.value	= document.forms[0].oqualkit.value   - (- document.forms[0].recqualkit.value) - document.forms[0].uqualkit.value - document.forms[0].wqualkit.value - (- document.forms[0].pqualkit.value) - document.forms[0].iqualkit.value; 
	
	if (document.forms[0].equalkit.value < 0) {
        document.forms[0].equalkit.value = 0;
    }
}
</script>
<script type="text/javascript">
function writeMessage1()
{
	//..falcon tubes balances
	document.forms[0].equalkit1.value	= document.forms[0].oqualkit1.value   - (- document.forms[0].recqualkit1.value) - document.forms[0].uqualkit1.value - document.forms[0].wqualkit1.value - (- document.forms[0].pqualkit1.value) - document.forms[0].iqualkit1.value; 
	if (document.forms[0].equalkit1.value < 0) {
        document.forms[0].equalkit1.value = 0;
    }
}
</script>
<body>

<div class="main-content" style="margin-left: .25%;margin-right: .25">
	
<div class="row" >
	<div style="width: auto;">
	<?php if ($errormsg !="")
			{
			?> 
		<div class="alert alert-danger" style="text-align: center;width: 300px;"><?php 
		
             echo $errormsg. '<a href="" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a>';

		?></div>
		<?php } ?>
		<?php if ($suceessmsg !="")
				{
				?> 
			<div class="alert alert-success" style="text-align: center;width: 300px;" ><?php 
				
		     echo $suceessmsg ;
		     echo "<div class='alert alert-info' style='text-align: center;width: 150px;' ><a href='countyallocation.php?id=$countyID'>Click HERE to View</a></div>" ;
		
		?></div>
		<?php exit; } ?>
						
	</div>
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo $facilityname. ' GeneXpert Consumption Report -'. $monthname = GetMonthName($month) . $year;?>
				</div>
				
				<div class="panel-options">
					
								<a href="countyallocation.php?id=<?php echo $countyID; ?>"	<input type="button" class="btn btn-info" value="Go back"/> Go back</a>
								
				</div>
			</div>
			
			<div class="panel-body">
			    <form method="post" action="" name="customForm" autocomplete="off">
<table class="table table-bordered"><!--mother table -->
	
	<tr><!--mother row 2 -->
	<td colspan="2"><!--mother td 2 -->
		<!--<div id="statediv3"></div> 		 -->
		
		<!-- new table design -->
		<table class="table table-bordered" style="font-family:Times New Roman;font-size: 11px; ">
			<thead>
			<tr>
				<th style="text-align: center;"rowspan="2">#</th>
				<th style="text-align: center;"style="width:200px" rowspan="2">COMMODITY </th>
				<th style="text-align: center;"rowspan="2">BEGINNING BALANCE</th>
				<th style="text-align: center;"style="font-size:10px" colspan=""><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE <BR />(KEMSA, SCMS / RDC)</font></th>
				<th style="text-align: center;"rowspan="2">QUANTITY USED</th>
				<th style="text-align: center;"rowspan="2">LOSSES /WASTAGE</th>
				<th style="text-align: center;"style="width:200px" colspan="2">ADJUSTMENTS</th>
				<th style="text-align: center;"rowspan="2">ENDING BALANCE</th>
				<th style="text-align: center;"rowspan="2">QUANTITY FOR RE-SUPPLY</th>				
			</tr>
			<tr>
				<th style="text-align: center;">QUANTITY </th>
				<th style="text-align: center;">POSITIVE<br /><small style="color:#00CC00">(Received from other source)</small></th>
				<th style="text-align: center;">NEGATIVE<br /><small style="color:#9900CC">(Issued Out)</small></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td style="background-color:#FFFFFF">1</td>
				<td>Catridge  <input type="hidden" name="commodity" value="Cartridge" /></td>
				<td><div align="center">
				  <input type="text"  class="form-control" value="<?php echo $beginningbalc ;?>" name="oqualkit" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999" readonly/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control" name="recqualkit" size="2" value="<?php  echo $quantityrecc ; ?>" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()" required/>
                </div></td>
				
				<td><div align="center">
				  <input type="text"  class="form-control"  name="uqualkit" size="5" value="<?php echo $qusedc;?>"  style = "background:#F6F6F6; font-weight:bold; color:#999999" readonly/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="wqualkit" size="5" value="<?php echo $lossesc;?>" style = "background:#FFFFCC;" onkeyup="writeMessage()" required/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control"  class="text" name="pqualkit" size="5" value="<?php echo $posc;?>" style = "background:#FFFFCC;" onkeyup="writeMessage()" required/>
                </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="iqualkit" size="5" value="<?php echo $negc;?>" style = "background:#FFFFCC;" onkeyup="writeMessage()" required/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  readonly style = "background:#F6F6F6;" name="equalkit" size="5" value="<?php echo $endbalc;?>"/>
			    </div></td>
			    <td>
			    <input type="text" style="background:#FFE1FA;" size="5" name="rqualkit" value="<?php echo $qreqc;?>" class="form-control" required>
			    </td>
				</tr>
				<tr>
				<td style="background-color:#FFFFFF">2</td>
				<td>Falcon Tubes  <input type="hidden" name="commodity1" value="Falcon Tubes" /></td>
				<td><div align="center">
				  <input type="text"  class="form-control" value="<?php echo $beginningbalf ;?>" name="oqualkit1" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999" readonly/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control" name="recqualkit1" size="2" value="<?php  echo $quantityrecf ; ?>" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage1()" required/>
                </div></td>
				
				<td><div align="center">
				  <input type="text"  class="form-control"  name="uqualkit1" size="5" value="<?php echo $qusedf;?>"  style = "background:#F6F6F6; font-weight:bold; color:#999999" readonly/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="wqualkit1" size="5" value="<?php echo $lossesf;?>" style = "background:#FFFFCC;" onkeyup="writeMessage1()" required/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control"  class="text" name="pqualkit1" size="5" value="<?php echo $posf;?>" style = "background:#FFFFCC;" onkeyup="writeMessage1()" required/>
                </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="iqualkit1" size="5" value="<?php echo $negf;?>" style = "background:#FFFFCC;" onkeyup="writeMessage1()" required/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  readonly style = "background:#F6F6F6;" name="equalkit1" size="5" value="<?php echo $endbalf;?>" required />
			    </div></td>
			    <td>
			    <input type="text" style="background:#FFE1FA;" size="5" name="rqualkit1" required class="form-control" value="<?php echo $qreqf ;?>">
			    </td>
				</tr>
			</tbody>
			
		</table>
		<!--end new table design -->
		
			<p><hr /></p>
			<p>&nbsp;</p>
			
			<!--end new table design viral load -->
			
	</td><!--end mother td 2 -->
	</tr><!--end mother row 2 -->
	
	<tr><!--mother row 3 -->	
	<td > 
		<div align="center" >
		<table>
		<tr>
			
		<td colspan="3">
			<div align="center">
			<font color="#CC3300"><strong>General comments (if any)</strong></font>
		<!--mother row 4 -->
		
		 <textarea name="comments" rows="" cols="160" style="background:#FFFFCC"></textarea></td>
		</div>
		</tr>
		</table></div>
	</td>		
	</tr><!--mother row 3 -->	
	
				  
	<tr><!--mother row 7 -->
		<td align="center" colspan="3"><div align="center">
		<input name="submitreport" type="submit" class="btn btn-success" value="Update Consumption Report" style="width:300px; height:40px; font-weight:bold" />
	  <!-- <input name="btnCancel" type="button" id="btnCancel" value="Cancel " class="button" style="width:180px"> --></div></td>
	</tr><!--end mother row 7 -->
</table><!--end mother table -->
</form>
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
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	
	
<!-- Footer -->
<footer class="main" style="margin-left: 3%;">
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