<?php
include("header.php");
require_once('connection/db.php'); 

?>

<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
<script language="JavaScript" src="scripts/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery-ui.css">
	<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.datepicker.css">
<link rel="stylesheet" href="jquery-ui-1.10.3/demos/demos.css">
<script>
	$(function() {
		$( "#fromfilter" ).datepicker({
			altField: "#fromfilter",
			altFormat: "yy-mm-dd",
			maxDate : "0D",
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			
		});
		$( "#tofilter" ).datepicker({
			altField: "#tofilter",
			altFormat:  "yy-mm-dd",
			maxDate : "0D",
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			
		});
	});
	</script>
<div class="clearer">&nbsp;</div>
<div class="main" id="main-two-columns">
<div align="center">
<form id="customForm"  method="GET" action="" >
<table>
<tr> 

<th colspan="2">Date Range: |   <small> <a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;" title=" Click to Filter View based on Date Range you Specify"> Customize Dates</a></small></th>    
<td>    </td><td></td>
                    
                
</tr>
<tr>
<th><div class="mid" id="HiddenDiv" style="DISPLAY: none" >
<table style="width:auto;height:auto;"  >
<tr>
<td><label for="from">From</label>
<input type="text" id="fromfilter" name="fromfilter" size="20"  />
</td>
<td>
<label for="to">to</label>
</td>
<td>
<input type="text" id="tofilter" name="tofilter" size="20" />

</td>
<td>
<input type="submit" id="submitform" name="submitform" value="Filter" class="button"/></td>
            </tr></table>
</div></th>
</tr></table>
</form>


</div>



			
</div>

		
<div class="clearer">&nbsp;</div>

	  </div>
	</div>
</div>

</body>
</html>
<?php
include("includes/footer.php");
?>