<?php
include("header.php");
 $maximumyear = GetMaxYear();
 $minyear = GetMinYear();

?>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="FusionCharts/JSClass/FusionCharts.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
     $('.radioBtn').click(function(){
         
         var div_id = $(this).attr('id');
         $('.my-div').hide(); 
         $('.me_'+div_id).show();   
     }); 

}); 
 </script>

<body class="page-body">

<div class="page-container">
		
<?php include("sb.php"); ?>

<div class="main-content">

<div class="row">
	
	<div class="col-md-8">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo  $_SESSION['facility'];  ?> Reporting Form.
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				 <form name="generate" class="TTWForm" method="POST" action="mpdf/rep.php" >
			    <table  class='table table-bordered'>
	  	 
		<input type="hidden" name="mfl" value="<?php  echo $_SESSION['mfl'];?>" />
		<input type="hidden" name="fn" value="<?php  echo $_SESSION['facility'];?>" />
		</tr>
		
		<tr class='even'>
		<th style="text-align:center">
		 Report Type:
		 </th>
		 
		<td style="text-align:left" >  
		<div class="col-md-5"><select  class="form-control" name="rep">
        <option value="0">Select Report</option>
        <option value="Lab Register">Lab Register</option>
        </select></div>
        </td>
       </tr>	
		<tr>
		<th style='background-color:#FFFFFF' colspan='2' width=auto>&nbsp;</th>
		</tr>	
		<tr class='even'>
  		  <th style="text-align:center">    
    Duration/Periods: 
    	 </th>
		    <td >
		    	<input type="radio" name="period" id="1" class="radioBtn" value="Monthly">
			    <label>Monthly</label>
			    <input type="radio" name="period" id="2" class="radioBtn" value="Quarterly" >
			    <label>Quarterly</label>
			    <input type="radio" name="period" id="3" class="radioBtn" value="Yearly">
			    <label>Yearly</label>
			    <input type="radio" name="period" id="4" class="radioBtn" value="Date Range" >
			    <label>Date Range</label>
			    <input type="radio" name="period" id="5" class="radioBtn" value="Specific Date">
			    <label>Specific Date </label>
			     
			    
			    
		<div  align="center" class="my-div me_1" style="DISPLAY: none" >
            <div class="col-md-5">Month:<select  class="form-control" name="monthly" >
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
		    </select></div>
		     
			<?php
			$years = range ($maximumyear,$minyear  ); 
			
			// Make the years pull-down menu.
			echo '<div class="col-md-4">Year:<select  class="form-control" name="monthyear" >';
			echo "<option value=\"0\">Select year</option>\n";
				foreach ($years as $value)
			 	{
					echo "<option value=\"$value\">$value</option>\n";
				}
				
			echo '</select></div>';
	   
	  ?>
    </div>
    
    
    <div  align="center" class="my-div me_2" style="DISPLAY: none" >
    <div class="col-md-5"> Quarters:<select  class="form-control" name="quarterly">
			<option value = "">Select Quarter</option>
			<option value = "1">January-March</option>
			<option value = "2">April-June</option>
			<option value = "3">July-October</option>
			<option value = "4">November-December</option>
		   </select></div>
               
    <?php
			$years = range ($maximumyear,$minyear  ); 
			
			// Make the years pull-down menu.
			echo '<div class="col-md-4"> Year:<select  class="form-control" name="quarteryear" >';
			echo "<option value=\"0\">Select year</option>\n";
				foreach ($years as $value)
			 	{
					echo "<option value=\"$value\">$value</option>\n";
				}
				
			echo '</select></div>';
	   
	  ?>
    </div>
    <div  align="center" class="my-div me_3" style="DISPLAY: none" >
		<?php
			$years = range ($maximumyear,$minyear  ); 
			
			// Make the years pull-down menu.
			echo ' <div class="col-md-4">Year:<select  class="form-control" name="yearly" >';
			echo "<option value=\"0\">Select year</option>\n";
				foreach ($years as $value)
			 	{
					echo "<option value=\"$value\">$value</option>\n";
				}
				
			echo '</select></div>';
	   
	  ?>
    </div>

     
    <div  align="center" class="my-div me_4" style="DISPLAY: none" >
      <div class="col-md-4"> From:<div class="input-group">
		<input class="form-control datepicker" type="text" data-format="yyyy-mm-d" id="startdate" name="startdate" data-end-date="d">
		<div class="input-group-addon">
		<a href="#">
		<i class="entypo-calendar"></i>
		</a>
		</div>
		</div>
	</div>
   <div class="col-md-4"> To:<div class="input-group">
		<input class="form-control datepicker" type="text" data-format="yyyy-mm-d" id="enddate" name="enddate" data-end-date="d" >
		<div class="input-group-addon">
		<a href="#">
		<i class="entypo-calendar"></i>
		</a>
		</div>
		</div>
	</div>
    </div>
    <div  align="center" class="my-div me_5" style="DISPLAY: none" >
     <div class="col-md-4"> Select Date:<div class="input-group">
		<input class="form-control datepicker" type="text" data-format="yyyy-mm-d" id="specificdate" name="specificdate" data-end-date="d" >
		<div class="input-group-addon">
		<a href="#">
		<i class="entypo-calendar"></i>
		</a>
		</div>
		</div>
	  </div>
    </div>
	    
</td> 
	
</tr>
			
<tr>
<th style='background-color:#FFFFFF' colspan='2' width=auto>&nbsp;</th>
</tr>
		 <tr class='odd'>
    <td colspan="2" height="20">
    
    <div id="submit" align="center">
 <input type="submit"  name="generatereport" value="Generate Report" class="btn btn-success"  />&nbsp;&nbsp;&nbsp;
	<input type="reset" name="reset" value="Reset Options" class="btn btn-default" />
 </div>

    </td>
    </tr>
   
	</table>
	

			</div>

		</div>
	
	</div>
	
</div>
	
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">
     <script src="admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
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