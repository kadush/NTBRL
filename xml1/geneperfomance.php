<?php
include('../includes/functions.php');
if (isset($_GET['fid'])){
   $FacID = $_GET['fid'];
	}

$sql="SELECT Module_SN as moduleserial,count(*) as totaltests,sum(CASE WHEN Test_Result='ERROR' THEN 1 ELSE 0 END) AS Errors
FROM sample1 where cond='1' and facility='$FacID' GROUP BY Module_SN ";	
$query=mysql_query($sql) or die(mysql_error());

?>
<chart yAxisName="# of Tests" xAxisName="Genexpert Modules" showvalues="0" stack100Percent="0" showPercentValues="0" bgcolor="#FFFFFF" showBorder="0">
  <?php 
  $mods = array();
  $tts = array();
  $errs = array();
  while ($rs=mysql_fetch_assoc($query)){
  	
	$mods[]= $rs['moduleserial'];
	$tts[]= $rs['totaltests'];
	$errs[]= $rs['Errors'];
  }; 

  	?>
 
 	<?php //do { ?>
        <categories>
        		<?php foreach($mods AS $value){?>
        	    <category label="<?php  echo $value; ?>" />
        		<?php }?>
                    
        </categories>

        <dataset seriesName="Test Done" color="78AE1C">
        	       <?php foreach($tts AS $value){?>    	     	
                <set value="<?php echo $value; ?>" />
                   <?php }?>                    
        </dataset>

        <dataset seriesName="Errors" color="DA3608" >
        	<?php foreach($errs AS $value){?> 
        	    <set value="<?php echo $value; ?>" />
                 <?php }?>                               
        </dataset>
 <?php //} while($rs=mysql_fetch_assoc($query));  ?>

</chart>