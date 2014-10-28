<?php

@require_once('../connection/db.php'); 
if (isset($_GET['id'])){
		$countyID = $_GET['id'];
		  
	}
mysql_select_db($database, $ntrl);
$sql= "SELECT countys.ID as a,countys.name as b,sum(consumption.allocated) as c
 FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND consumption.status=1
AND `countys`.`ID` = `districts`.`county`
Group by  countys.ID";
$RsCounty = mysql_query($sql, $ntrl) or die(mysql_error());
$row_RsCounty = mysql_fetch_assoc($RsCounty);


$maximumyear = GetMaxYearCon();
$minyear = GetMinYearCon();

?>
<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>

	</head>
<body>
	
	
					
			        <table class='table table-striped'>
					<form name="generate" class="form-control" method="POST" action="../mpdf/rep_all.php" >
			        <tr>
					<th>
					 County:
					</th>
					 
					<td style="text-align:left" >  
					<select name="county" id="county" class="form-control">
			        <option value="0">All Counties</option>
			        <?php
					do { 
					?>
					      <option value="<?php echo $row_RsCounty['a']; ?>"><?php echo $row_RsCounty['b']; ?></option>
					      <?php
					} while ($row_RsCounty = mysql_fetch_assoc($RsCounty)); ?> 
					?>
			        </select>
			        </td>
			        </tr>
			        <tr>
					<th colspan='2' width=auto>&nbsp;</th>
					</tr>
					<tr>
				    <th> Facility:
					</th> 
					<td style="text-align:left">
					
			        <div class="result" id="result"></div>
			        </td>	
					<tr>
					<th colspan='2' width=auto>&nbsp;</th>
					</tr>
					<tr>
			  		<th>    
			        Periods: 
			    	</th>
					    <td style="text-align:left">
					    	<input type="radio" name="period" id="1" class="radioBtn" value="Monthly">
						    <label>Monthly</label>
						    <input type="radio" name="period" id="2" class="radioBtn" value="Quarterly" >
						    <label>Quarterly</label>
						    <input type="radio" name="period" id="3" class="radioBtn" value="Yearly">
						    <label>Yearly</label>
						        
						    
						    
					<div  align="center" class="my-div me_1" style="DISPLAY: none" >
			            Month:<select name="monthly" class="form-control">
						<option value = "">Select Month</option>
						<option value = "1">January</option>
						<option value = "2">February</option>
						<option value = "3">March</option>
						<option value = "4">April</option>
						<option value = "5">May</option>
						<option value = "6">June</option>
						<option value = "7">July</option>
						<option value = "8">August</option>
						<option value = "9">September</option>
						<option value = "10">October</option>
						<option value = "11">November</option>
						<option value = "12">December</option>
					    </select><br>
					     Year:
						<?php
						$years = range ($maximumyear,$minyear  ); 
						
						// Make the years pull-down menu.
						echo '<select name="monthyear" class="form-control">';
						echo "<option value=\"0\">Select year</option>\n";
							foreach ($years as $value)
						 	{
								echo "<option value=\"$value\">$value</option>\n";
							}
							
						echo '</select>';
				   
				  ?>
			    </div>
			    
			    
			    <div  align="center" class="my-div me_2" style="DISPLAY: none" >
			     Month:<select name="quarterly" class="form-control">
						<option value = "">Select Quarter</option>
						<option value = "1">January-March</option>
						<option value = "2">April-June</option>
						<option value = "3">July-October</option>
						<option value = "4">November-December</option>
					   </select>
			               <br>
			     Year:<?php
						$years = range ($maximumyear,$minyear  ); 
						
						// Make the years pull-down menu.
						echo '<select name="quarteryear" class="form-control">';
						echo "<option value=\"0\">Select year</option>\n";
							foreach ($years as $value)
						 	{
								echo "<option value=\"$value\">$value</option>\n";
							}
							
						echo '</select>';
				   
				  ?>
			    </div>
			    <div  align="center" class="my-div me_3" style="DISPLAY: none" >
					Year:<?php
						$years = range ($maximumyear,$minyear  ); 
						
						// Make the years pull-down menu.
						echo '<select name="yearly" class="form-control">';
						echo "<option value=\"0\">Select year</option>\n";
							foreach ($years as $value)
						 	{
								echo "<option value=\"$value\">$value</option>\n";
							}
							
						echo '</select>';
				   
				  ?>
			    </div>
			
			     	    
			</td>  
				
			</tr>
						
			<tr>
			<th style='background-color:#FFFFFF' colspan='2' width=auto>&nbsp;</th>
			</tr>
			<tr class='odd'>
			<td colspan="2">
			  <div id="submit" align="center">
			  	<input type="submit" class="btn btn-green" name="generate" value="Generate Report"   />&nbsp;&nbsp;&nbsp;
				<input type="reset" class="btn btn-default" name="reset" value="Reset Fields" onclick="window.location.reload()" />
			    </div>
			</td>
			</tr>
			</form></table>
          
			
			
			 

<script type="text/javascript">
$(document).ready(function(){
     $('.radioBtn').click(function(){
         
         var div_id = $(this).attr('id');
         $('.my-div').hide(); 
         $('.me_'+div_id).show();   
     }); 
     
	 $("#county").change(function () {

     if($("#county option:selected").val() == 0 ){
         $('.result').hide();
     } else if ($("#county option:selected").val() > 0){
        $('.result').show();
         cid=$("#county option:selected").val();
         	               
     }
     
 
    $.post("ajax_all.php", 
    { d : cid },
    function(data) {
    	//alert(data);
    	$('.result').html(data);
    });
                
    });
    return data; 
});
 </script>
			

<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-9"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
	
</body>
</html>
