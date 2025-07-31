<?php 
require_once('header.php');

$sql="SELECT ID,name from countys";
$query1=mysqli_query($dbConn,$sql);
$numrows=@mysqli_num_rows($query1);
$row1=mysqli_fetch_assoc($query1);

$maximumyear= GetMaxYear();
$minyear=GetMinYear();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from demo.neontheme.com/forms/wizard/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:45:46 GMT -->
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
	<script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
		    var today = new Date();
			var d= today.getDate();
			var m = today.getMonth()+1;
			
			function setSelectedIndex(i)
	
			{
			var s = document.getElementById("monthly");
			s.options[i-1].selected = true;
			
			return;
			
			}
			
			setSelectedIndex(m);
		
		}); 
    </script>	
<body onload="document.getElementById('getreport').click();">
<div class="page container">
<div class="well well-sm">
	
	<form>
	  <div class="row">
		<div class="col-md-8 col-md-offset-6">
			<input type="radio" name="period" id="1" class="radioBtn" value="Monthly" checked="checked">
		    <label>Monthly</label>
		    <input type="radio" name="period" id="2" class="radioBtn" value="Quarterly" >
		    <label>Quarterly</label>
		    <input type="radio" name="period" id="3" class="radioBtn" value="Semi Annual" >
		    <label>Semi Annual</label>
		    <input type="radio" name="period" id="4" class="radioBtn" value="Yearly">
		    <label>Yearly</label>
		    <input type="radio" name="period" id="5" class="radioBtn" value="Date Range" >
		    <label>Date Range</label>
		    <input type="radio" name="period" id="6" class="radioBtn" value="Cumulative">
		    <label>Specific Date </label>
		</div>
	</div>	
	<div class="row">							
	<div class="col-md-12">
	    <div class="col-md-2">
	    	<div class="form-group">
	    	 County:<select class="form-control" id="county" name="county">
				<option value = "0">All</option>
				<?php do { ?>
					<option value = "<?php echo $row1['ID']?>"><?php echo $row1['name']?></option>
				<?php } while($row1=mysqli_fetch_assoc($query1));  ?>
			   </select>
			</div>
		</div>	
		 <div class="col-md-2">
	    	<div class="form-group">
	    	 <div id="sc1">  </div>
			</div>
		</div>								
	    <div class="col-md-2">
	    	<div class="form-group">
	    	<div id="fac">  </div>
			</div>
		</div>	
		<div class="col-md-5">
	    	<div id="rowdiv1">
		    	
					<div  align="center" id="pliz" class="my-div me_1" >
				            <div class="col-md-4">Month:<select class="form-control" name="monthly" id="monthly">
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
						    </select></div>
						     
							<?php
							$years = range ($maximumyear, $minyear  ); 
							
							// Make the years pull-down menu.
							echo '<div class="col-md-4">Year:<select  class="form-control" name="monthyear" >';
								foreach ($years as $value)
							 	{
									echo "<option value=\"$value\">$value</option>\n";
								}
								
							echo '</select></div>';
					   
					  ?>
				    </div>
				    
				    
				    <div  align="center" class="my-div me_2" style="DISPLAY: none" >
				    <div class="col-md-5"> Quarter:<select  class="form-control" name="quarterly">
							<option value = "1">January-March</option>
							<option value = "2">April-June</option>
							<option value = "3">July-September</option>
							<option value = "4">October-December</option>
						   </select></div>
				               
				    <?php
							$years = range ($maximumyear,$minyear); 
							
							// Make the years pull-down menu.
							echo '<div class="col-md-4"> Year:<select  class="form-control" name="quarteryear" >';
								foreach ($years as $value)
							 	{
									echo "<option value=\"$value\">$value</option>\n";
								}
								
							echo '</select></div>';
					   
					  ?>
				    </div>
				    <div align="center" class="my-div me_3" style="DISPLAY: none">
							 	
								    <div class="col-md-5"> Semi:
								    		<select class="form-control" name="semi">
												<option value = "1">January-June</option>
												<option value = "2">July-December</option>
										    </select>
								               
								    
								    </div>
								      <?php
							$years = range ($maximumyear,$minyear  ); 
							
							// Make the years pull-down menu.
							echo '<div class="col-md-4"> Year:<select class="form-control" name="semiyear" >';
							  foreach ($years as $value)
							 	{
									echo "<option value=\"$value\">$value</option>\n";
								}
								
							echo '</select></div>';
					   
					  ?>
								
					 </div>
				    <div  align="center" class="my-div me_4" style="DISPLAY: none" >
						<?php
							$years = range ($maximumyear,$minyear  ); 
							
							// Make the years pull-down menu.
							echo ' <div class="col-md-4">Year:<select  class="form-control" name="yearly" >';
								foreach ($years as $value)
							 	{
									echo "<option value=\"$value\">$value</option>\n";
								}
								
							echo '</select></div>';
					   
					  ?>
				    </div>
				
				     
				    <div  align="center" class="my-div me_5" style="DISPLAY: none" >
				      <div class="col-md-4"> From:<div class="input-group">
						<input class="form-control datepicker" type="text" data-format="yyyy-mm-d" id="startdate" name="startdate" >
						<div class="input-group-addon">
						<a href="#">
						<i class="entypo-calendar"></i>
						</a>
						</div>
						</div>
					</div>
				   <div class="col-md-4"> To:<div class="input-group">
						<input class="form-control datepicker" type="text" data-format="yyyy-mm-d" id="enddate" name="enddate" >
						<div class="input-group-addon">
						<a href="#">
						<i class="entypo-calendar"></i>
						</a>
						</div>
						</div>
					</div>
				    </div>
				    <div  align="center" class="my-div me_6" style="DISPLAY: none" >
				     <div class="col-md-4"> No Date needed
					  </div>
				    </div>
			</div>
		<div class="col-md-2">
	    	<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="getreport" id="getreport" type="button" class="btn btn-success" value="Generate Report"  />
			</div>
		</div>
	    </div>
	    
	   </div>
	 </div>
	 
 </form>
 </div>
<div id="result"></div>
<footer class="main">
	
	<div class="pull-right">
		<?php
		include("../includes/footer.php");
		
		?>
		</div>
	
</footer>
</div>
<script type="text/javascript">
		$(document).ready(function(){
		     $('.radioBtn').click(function(){
		         $('.radioBtn').che
		         var div_id = $(this).attr('id');
		         $('.my-div').hide(); 
		         $('.me_'+div_id).show();   
		     }); 
		
		}); 
    </script>	
<script type="text/javascript">
$(document).ready( function (){
	  
  $("#getreport").click(function(){
  	var b = $("input[name=period]:checked").val()
  	var f = $("#facility").val()
    var a=$('form').serialize();
    
  	$.ajax({
        	    type: "POST",
                url: "kila.php",
                data: '?period='+b+'&'+a,
                async: true,
				cache: false,
                success: function(data) {
				  $('#result').html(data)   			    
				}
                  
            })
            
            
    if (f>1) {
  	 //alert('newfac');
  		$.ajax({
        	    type: "POST",
                url: "newfac.php",
                data: '?period='+b+'&'+a,
                async: true,
				cache: false,
                success: function(data) {
				  $('#result').html(data)   			    
				}
                  
            })
  	   
  };
  
 });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
   
	 $("#county").change(function () {

     if($("#county option:selected").val() == 0 ){
         $('#sc1').hide();
         $('#fac').hide();
     } else if ($("#county option:selected").val() > 0){
        $('#sc1').show();
        $('#fac').show();
         cid=$("#county option:selected").val();
         	 //alert(cid);
         	             
     }
     

    $.post("../admin/ajax_all.php", 
    { d : cid },
    function(data) {
    	//alert(data);
    	$('#sc1').html(data);
    });
    $.post("getfacility.php", 
    { d : cid },
    function(data) {
    	//alert(data);
    	$('#fac').html(data);
    });
                
    });
    //return data; 
});
 </script>
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
    <script src="../admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
	<script src="../FusionCharts/FusionCharts.js"></script>
	
</body>

<!-- Mirrored from demo.neontheme.com/forms/wizard/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Oct 2014 07:45:49 GMT -->
</html>