<?php
$pos = $_GET['pos'];
$neg = $_GET['neg'];
$ind = $_GET['ind'];
$rif = $_GET['rif'];
$err = $_GET['err'];

?>
<html>
  <head>        
   <script language="JavaScript" src="../FusionCharts/FusionCharts.js"></script>

  </head>   
  <body>     
    <div id="chartnatw"  align="center">FusionCharts XT will load here! </div>
		
         <?php if (($pos==0) and ($neg==0)) { ?> 
						
			<script type="text/javascript">
			var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "195", "0");
			myChart.setDataXML("<chart></chart>");
            myChart.render("chartnatw");
		    </script>		
				
			<?php } else { ?> 
	         <script type="text/javascript">
	          var myChart = new FusionCharts("Pie2D", "myChartnat", "300", "195", "0");
	          myChart.setDataXML('<chart bgcolor="#FFFFFF" showBorder="0" ><set  isSliced="1" label="MTB Pos" color="00ACE8" value="<?php echo $pos; ?>"/><set  label="MTB Neg" color="C295F2" value="<?php echo $neg; ?>"/><set  label="RIF Resistant" color="ADFF2F" value="<?php echo $rif;?>"/><set  label="Errors" color="ff0000" value="<?php echo $err; ?>"/><set  label="RIF Indeterminate" color="AD662F" value="<?php echo $ind;?>"/></chart>');  
	          myChart.render("chartnatw");
	         </script> 
		    <?php } ?>
			 
	    	   
  </body> 
</html>