<?php
$pos = $_GET['pos'];
$neg = $_GET['neg'];
$rif = $_GET['rif'];

?>
<html>
  <head>        
   <script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

  </head>   
  <body>     
  	<div id="chartnat3"  align="center"></div>
    		<?php if (($pos==0) and ($neg==0) and ($rif==0)) { ?> 
				
			<script type="text/javascript">
			var myChart = new FusionCharts("Doughnut2D", "myChartnatg", "300", "133", "0");
			myChart.setDataXML("<chart></chart>");
            myChart.render("chartnat3");
		    </script>
				
			<?php } else { ?>
				<script type="text/javascript">
			    var myChart = new FusionCharts("Doughnut2D", "myChartnatg", "300", "133", "0");
			    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"  pieSliceDepth="30" startingAngle="125"><set value="<?php echo $rif; ?>" label="Not Specified" color="C295F2"/><set value="<?php echo $neg; ?>" label="Female" color="#ADFF2F"/><set value="<?php echo $pos; ?>" label="Male" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			    myChart.render("chartnat3");
			    
			   </script> 
			<?php } ?>
			
	    	   
  </body> 
</html>