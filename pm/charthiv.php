<?php
$pos = $_GET['pos'];
$neg = $_GET['neg'];
$rif = $_GET['rif'];
$ind = $_GET['ind'];
?>
<html>
  <head>        
   <script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

  </head>   
  <body>     
  	<div id="chartnat4"  align="center"> </div>
    		<?php if (($pos==0) and ($neg==0) and ($rif==0)) { ?> 
				
			<script type="text/javascript">
			var myChart = new FusionCharts("Doughnut2D", "myChartnath", "300", "133", "0");
			myChart.setDataXML("<chart></chart>");
            myChart.render("chartnat4");
		    </script>
				
			<?php } else { ?>
				<script type="text/javascript">
			    var myChart = new FusionCharts("Doughnut2D", "myChartnath", "300", "133", "0");
			    myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"  pieSliceDepth="30" startingAngle="125"><set value="<?php echo $rif; ?>" label="Not Done" color="C295F2"/><set  label="Declined" color="AD662F" value="<?php echo $ind;?>"/><set value="<?php echo $neg; ?>" label="Negative" color="#ADFF2F"/><set value="<?php echo $pos; ?>" label="Positive" color="00ACE8"/></chart>');
			    myChart.render("chartnat4");
			    
			   </script> 
			<?php } ?>
			
	    	   
  </body> 
</html>