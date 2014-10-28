<?php 

require_once('connection/db.php');

mysql_select_db($database, $ntrl);
include('header.php');
$facilityname=$_SESSION['facility'];
$facilitycode=$_SESSION['mfl'];
$month = $_GET['month'];
$year = $_GET['year'];
$reportingdate=$year."-".$month."-30";
//check if te facility has reported for th previous month
			

$querytt = "SELECT * FROM sample1 WHERE MONTH(End_Time)='$month' AND YEAR(End_Time)='$year' AND cond=1 and facility=".$_SESSION['mfl'];
$rstt = mysql_query($querytt, $ntrl) or die(mysql_error());
$rowtt = mysql_fetch_assoc($rstt);
$vtotaltest = mysql_num_rows($rstt);


$monthname = GetMonthName($month);

if ($month == 0) // to cater for end year i.e Dec report, beginin balance is ending bal of nov
{
$month  = 12;
$recordyear = @date('Y') - 1;
}
else
{
$recordyear = @date('Y');
}

$previousmonth = $month - 1; //..eg if current month = May; submission should be for Apr; opening balance Apr should be end bal Mar

$query= "SELECT end_bal as ebal FROM consumption WHERE MONTH(date)='$previousmonth' AND YEAR(date)='$year' and facility=".$_SESSION['mfl'];

$rs = mysql_query($query, $ntrl) or die(mysql_error());
$row = mysql_fetch_assoc($rs);
$beginningbal = $row['ebal'];

if (isset($_POST["submitreport"])) {
 $sql="INSERT INTO consumption (`facility`,`commodity` ,`b_bal` ,`quantity` ,`quantity_used` ,`losses` ,`pos` ,`neg` ,`end_bal` ,`q_req` ,`comments`, `status`,`date`  ) VALUES ('$_POST[mfl]','$_POST[commodity]','$_POST[oqualkit]','$_POST[recqualkit]','$_POST[uqualkit]','$_POST[wqualkit]','$_POST[pqualkit]',
'$_POST[iqualkit]','$_POST[equalkit]','$_POST[rqualkit]','$_POST[comments]','0','$reportingdate'),('$_POST[mfl]','$_POST[commodity1]','$_POST[oqualkit1]','$_POST[recqualkit1]','$_POST[uqualkit1]','$_POST[wqualkit1]','$_POST[pqualkit1]','$_POST[iqualkit1]','$_POST[equalkit1]','$_POST[rqualkit1]','$_POST[comments1]','0','$reportingdate')";
	
$retval = mysql_query( $sql, $ntrl );
if(! $retval )
{
     $errormsg= 'Could not enter data.Try Again';
}
else
{
	 $suceessmsg= 'Consumption Report Successfully Submitted </div>';
}


mysql_close($ntrl);
}
?>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    
	<script type="text/javascript">
function writeMessage()
{
<!--document.forms[0].mySecondInput.value=document.forms[0].myInput.value; -->

<!--TAQMAN CALCULUS -->	
	//..cartridge balances
	document.forms[0].equalkit.value	= document.forms[0].oqualkit.value   - (- document.forms[0].recqualkit.value) - document.forms[0].uqualkit.value - document.forms[0].wqualkit.value - (- document.forms[0].pqualkit.value) - document.forms[0].iqualkit.value; 
	
	document.forms[0].espexagent.value 	= document.forms[0].ospexagent.value - (- document.forms[0].recspexagent.value) -	 document.forms[0].uspexagent.value - document.forms[0].wspexagent.value - (- document.forms[0].pspexagent.value) - document.forms[0].ispexagent.value;
	
	document.forms[0].eampinput.value	= document.forms[0].oampinput.value	- (- document.forms[0].recampinput.value) -	 document.forms[0].uampinput.value 	- document.forms[0].wampinput.value - (- document.forms[0].pampinput.value) - document.forms[0].iampinput.value;
	
	document.forms[0].eampflapless.value= document.forms[0].oampflapless.value 	- (- document.forms[0].recampflapless.value)	-	 document.forms[0].uampflapless.value - document.forms[0].wampflapless.value - (- document.forms[0].pampflapless.value) - document.forms[0].iampflapless.value;
	
	document.forms[0].eampktips.value	= document.forms[0].oampktips.value	- (- document.forms[0].recampktips.value)	-	 document.forms[0].uampktips.value 	- document.forms[0].wampktips.value - (- document.forms[0].pampktips.value) - document.forms[0].iampktips.value;
	
	document.forms[0].eampwash.value	= document.forms[0].oampwash.value - (- document.forms[0].recampwash.value) -	 document.forms[0].uampwash.value - document.forms[0].wampwash.value - (- document.forms[0].pampwash.value) - document.forms[0].iampwash.value;
	
	document.forms[0].ektubes.value		= document.forms[0].oktubes.value - (- document.forms[0].recktubes.value) -	 document.forms[0].uktubes.value - document.forms[0].wktubes.value  - (- document.forms[0].pktubes.value) - document.forms[0].iktubes.value;
	
	<!--document.forms[0].econsumables.value= document.forms[0].oconsumables.value - (- document.forms[0].recconsumables.value)	-	 document.forms[0].uconsumables.value - document.forms[0].wconsumables.value  - (- document.forms[0].pconsumables.value) - document.forms[0].iconsumables.value; -->


	
//END TAQMAN CALCULUS 	
}
</script>
<script type="text/javascript">
function writeMessage1()
{
	//..falcon tubes balances
	document.forms[0].equalkit1.value	= document.forms[0].oqualkit1.value   - (- document.forms[0].recqualkit1.value) - document.forms[0].uqualkit1.value - document.forms[0].wqualkit1.value - (- document.forms[0].pqualkit1.value) - document.forms[0].iqualkit1.value; 
	
	document.forms[0].espexagent1.value 	= document.forms[0].ospexagent1.value - (- document.forms[0].recspexagent1.value) -	 document.forms[0].uspexagent1.value - document.forms[0].wspexagent1.value - (- document.forms[0].pspexagent1.value) - document.forms[0].ispexagent1.value;
	
	document.forms[0].eampinput1.value	= document.forms[0].oampinput1.value	- (- document.forms[0].recampinput1.value) -	 document.forms[0].uampinput1.value 	- document.forms[0].wampinput1.value - (- document.forms[0].pampinput1.value) - document.forms[0].iampinput1.value;
	
	document.forms[0].eampflapless1.value= document.forms[0].oampflapless1.value 	- (- document.forms[0].recampflapless1.value)	-	 document.forms[0].uampflapless1.value - document.forms[0].wampflapless1.value - (- document.forms[0].pampflapless1.value) - document.forms[0].iampflapless1.value;
	
	document.forms[0].eampktips1.value	= document.forms[0].oampktips1.value	- (- document.forms[0].recampktips1.value)	-	 document.forms[0].uampktips1.value 	- document.forms[0].wampktips1.value - (- document.forms[0].pampktips1.value) - document.forms[0].iampktips1.value;
	
	document.forms[0].eampwash1.value	= document.forms[0].oampwash1.value - (- document.forms[0].recampwash1.value) -	 document.forms[0].uampwash1.value - document.forms[0].wampwash1.value - (- document.forms[0].pampwash1.value) - document.forms[0].iampwash1.value;
	
	document.forms[0].ektubes1.value		= document.forms[0].oktubes1.value - (- document.forms[0].recktubes1.value) -	 document.forms[0].uktubes1.value - document.forms[0].wktubes1.value  - (- document.forms[0].pktubes1.value) - document.forms[0].iktubes1.value;
	
	<!--document.forms[0].econsumables1.value= document.forms[0].oconsumables1.value - (- document.forms[0].recconsumables1.value)	-	 document.forms[0].uconsumables1.value - document.forms[0].wconsumables1.value  - (- document.forms[0].pconsumables1.value) - document.forms[0].iconsumables1.value; -->

}
</script>
<script type="text/javascript">
function writeMessageviral()
{
	<!--calculates the items for request for TAQMAN kits  -->
	document.forms[0].rvspexagent.value		=Math.round(document.forms[0].rvqualkit.value * 0.15); 
	document.forms[0].rvampinput.value		=Math.round(document.forms[0].rvqualkit.value * 0.2); 
	document.forms[0].rvampflapless.value	=Math.round(document.forms[0].rvqualkit.value * 0.2); 
	document.forms[0].rvampktips.value		=Math.round(document.forms[0].rvqualkit.value * 0.15);
	document.forms[0].rvampwash.value		=Math.round(document.forms[0].rvqualkit.value * 0.5); 
	document.forms[0].rvktubes.value		=Math.round(document.forms[0].rvqualkit.value * 0.05);  
	//document.forms[0].rvconsumables.value	=Math.round(document.forms[0].rvqualkit.value * 0.05); 
	<!--end calculates the items for request for taqman kits -->
}
</script>
 <script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }

	
	function getDisaprovalReason(approve) {		
		
		var strURL="getDisaprovalReason.php?rejid="+approve;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv2').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

	function getDesign(test_type) {		
		
		var strURL="getDisaprovalReason.php?test_type="+test_type;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv3').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

</script>
<body class="page-body">

<div class="main-content" >

<div class="row" style="margin-top: -3%; float: left;margin-left: 3%;">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo $_SESSION['facility']; ?> Monthly Consumption Report - GeneXpert
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			    <form method="post" action="" name="customForm" autocomplete="off">
<table class="table table-bordered"><!--mother table -->
	<tr><!--mother row 1 -->
	<td colspan="2"><!--mother td 1 -->
		<table>
		<tr><input type="hidden" name="mfl"  value="<?php  echo $facilitycode ; ?>"/>
			
		
			<!--<td><span class="section-title"><?php //echo $monthname .' , '.$year ?> Statistics</span> </td> -->
			<td>
	            <table class="table table-bordered">			
				<thead>
				<tr class="even">
				<th style="text-align: center;"style="text-align: center;">Total No. of Tests Done <small>( In <?php echo $monthname .' , '.$year ?></small>)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td style="text-align: center;background-color:#FFFFFF"><?php echo $vtotaltest ;?></td>     
				         
				</tr>
				</tbody>
		  </table>
			
			 </td>
			
			 
			
			</tr>
		  </table>	<div style="float: right;width: auto;"><?php if ($errormsg !="")
					{
					?> 
				<div class="alert alert-danger" style="text-align: center;width: 400px;"><?php 
				
		               echo  $errormsg. '<a href="" data-rel="close" style="float: right;"><i class="entypo-cancel"></i></a>';
		
				?></div>
				<?php } ?>
				<?php if ($suceessmsg !="")
						{
						?> 
					<div class="alert alert-success" style="text-align: center;width: 400px;" ><?php 
						
				     echo   $suceessmsg. '<a href="index.php">Click to go Home</i></a>' ;
				
				?></div>
				<?php } ?></div>
	</td><!--end mother td 1 -->
	</tr><!--end mother row 1 -->
	
	<tr><!--mother row 2 -->
	<td colspan="2"><!--mother td 2 -->
		<!--<div id="statediv3"></div> 		 -->
		
		<!-- new table design -->
		<table class="table table-bordered" style="font-family:Times New Roman;font-size: 11px; ">
			<thead>
			<tr class="even">
				<td colspan="13" style="background-color:#FFFFFF"><div align="center"><strong><font color="#996600">You <font color="#FF0000">MUST</font> Enter a value in the boxes provided below.</font></strong></div></td>				
			</tr>
			<tr>
				<th style="text-align: center;"rowspan="2">#</th>
				<th style="text-align: center;"style="width:200px" rowspan="2">COMMODITY </th>
				<th style="text-align: center;"rowspan="2">BEGINNING BALANCE</th>
				<th style="text-align: center;"style="font-size:10px" colspan=""><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE <BR />(KEMSA, SCMS / RDC)</font></th>
				<th style="text-align: center;"rowspan="2">QUANTITY USED</th>
				<th style="text-align: center;"rowspan="2">LOSSES /WASTAGE</th>
				<th style="text-align: center;"style="width:200px" colspan="2">ADJUSTMENTS</th>
				<th style="text-align: center;"rowspan="2">ENDING BALANCE</th>
				<th style="text-align: center;"rowspan="2">QUANTITY REQUESTED</th>				
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
				  <input type="text"  class="form-control" value="<?php echo $beginningbal ;?>" name="oqualkit" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999"/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control" name="recqualkit" size="2" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()"/>
                </div></td>
				
				<td><div align="center">
				  <input type="text"  class="form-control" readonly name="uqualkit" size="5" value="<?php echo $vtotaltest;?>"  style = "background:#F6F6F6; font-weight:bold; color:#999999" />
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="wqualkit" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage()" />
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control"  class="text" name="pqualkit" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage()" />
                </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="iqualkit" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage()"/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  readonly style = "background:#F6F6F6;" name="equalkit" size="5" />
			    </div></td>
			    <td>
			    <input type="text" style="background:#FFE1FA;" size="5" name="rqualkit" onkeyup="writeMessageeid()" class="form-control">
			    </td>
				</tr>
				<tr>
				<td style="background-color:#FFFFFF">2</td>
				<td>Falcon Tubes  <input type="hidden" name="commodity1" value="Falcon Tubes" /></td>
				<td><div align="center">
				  <input type="text"  class="form-control" value="<?php echo $beginningbal ;?>" name="oqualkit1" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999"/>
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control" name="recqualkit1" size="2" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage1()" />
                </div></td>
				
				<td><div align="center">
				  <input type="text"  class="form-control" readonly name="uqualkit1" size="5" value="<?php echo $vtotaltest;?>"  style = "background:#F6F6F6; font-weight:bold; color:#999999" />
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="wqualkit1" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage1()" />
			    </div></td>
				<td><div align="center">
                  <input type="text"  class="form-control"  class="text" name="pqualkit1" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage1()" />
                </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  class="text" name="iqualkit1" size="5" style = "background:#FFFFCC;" onkeyup="writeMessage1()"/>
			    </div></td>
				<td><div align="center">
				  <input type="text"  class="form-control"  readonly style = "background:#F6F6F6;" name="equalkit1" size="5" />
			    </div></td>
			    <td>
			    <input type="text" style="background:#FFE1FA;" size="5" name="rqualkit1" required="required" class="form-control">
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
		<input name="submitreport" type="submit" class="btn btn-success" value="Submit Consumption Report" style="width:300px; height:40px; font-weight:bold" />
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