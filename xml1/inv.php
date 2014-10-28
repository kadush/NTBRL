<?php @require_once('../connection/db.php'); 
//total patients in county
function getInv($facility){
	
$sql="SELECT DISTINCT s.facility, DATEDIFF( max( s.Expiration_Date ) , NOW( ) ) AS DiffDate, f.name
FROM sample1 s, facilitys f
WHERE s.facility = f.facilitycode
GROUP BY s.facility";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
?>
<chart xAxisName="Facilities" yAxisName="No of Days Remaining(Expiration)"  bgColor="F1F1F1" showValues="0" canvasBorderThickness="1" canvasBorderColor="999999" plotFillAngle="330" plotBorderColor="999999" showAlternateVGridColor="1" divLineAlpha="0" bgcolor="#FFFFFF" showBorder="0">

 <?php 
   $sql="SELECT DISTINCT s.facility as fcode, f.name as fname, DATEDIFF( max( s.Expiration_Date ) , NOW() ) AS DiffDate, (c.end_bal+c.allocated) AS cart
		FROM sample1 s
        left join facilitys f on s.facility = f.facilitycode
		left join consumption c on s.facility = c.facility
		where s.facility IS NOT NULL
		GROUP BY s.facility ";
   $result=mysql_query($sql)or die(mysql_error());
   $row=mysql_fetch_assoc($result);
   //var_dump($row); exit; 
    
   do
  {
	$fid=$row['fcode'];
   	$fname=trim($row['fname']);
  	$dd=$row['DiffDate'];
	$cart= (int) $row['cart'];
	//if ($cart==NULL) {
		//$cart==0;
	//}
	 
	 if ($dd<0) {
	 	$dd = 0;
		 ?>
		 <set label='<?php echo $fname ?>' value='<?php echo $dd ?>'
            toolText='<?php echo "Facility Name: " .$fname; ?>
           			  <?php echo "\nFacility Code: " .$fid; ?>
			          <?php echo "\nNo Inventory Recorded" ;?>'/> 
		 
		 
    	<?php  } 
    	else {  ?>
		<set label='<?php echo $fname ?>' value='<?php echo $dd ?>'
            toolText='<?php echo "Facility Name: " .$fname; ?>
           			  <?php echo "\nFacility Code: " .$fid; ?>
			          <?php echo "\nRemaining days(Expiration): " .$dd." Days"; ?>
			          <?php echo "\nRemaining Cartridges: " .$cart." Cartridges"; ?>'/> 

		<?php
		  }
   }
while($row=mysql_fetch_assoc($result));
?>	

</chart>