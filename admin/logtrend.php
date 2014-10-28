<?php
include('../includes/functions.php');
 $_SESSION['mfl'];

if (isset($_GET['fid'])){
		   echo $FacID = $_GET['fid'];
	}   

function getlogs($month,$year){
	
 $sql="SELECT COUNT(*) FROM activitylog where activity='login' AND MONTH(tym)='$month' AND YEAR(tym)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function getlogout($month,$year){
	
 $sql="SELECT COUNT(*) FROM activitylog where activity='logout' AND MONTH(tym)='$month' AND YEAR(tym)='$year'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}

?>

<chart  yAxisName="# of Login Attempts" lineThickness="1" showValues="0" formatNumberScale="0" anchorRadius="2" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="#DDD" shadowAlpha="40" bgcolor="#FFFFFF" showBorder="0">
<categories >
<?php  

		for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++)
  		{  $monthname=GetMonthName($startmonth);
		
?>
<category label='<?php echo $monthname ;?>' />
<?php
}
?>
</categories>
<dataset seriesName='Login Attempts' color='A666EDD' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totallogin=getlogs($startmonth,2014);
		
		
?>

<set value='<?php echo $totallogin; ?>' />
<?php
}
?>
</dataset>

<dataset seriesName='Logout Attempts' color='F1683C' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totallogout=getlogout($startmonth,2014);
		
		
?>

<set value='<?php echo $totallogout; ?>' />
<?php
}
?>
</dataset>

<styles>

<definition>
<style name="Anim1" type="animation" param="_xscale" start="0" duration="1"/>
<style name="Anim2" type="animation" param="_alpha" start="0" duration="0.6"/>
<style name="DataShadow" type="Shadow" alpha="40"/>
</definition>
-
<application>
<apply toObject="DIVLINES" styles="Anim1"/>
<apply toObject="HGRID" styles="Anim2"/>
<apply toObject="DATALABELS" styles="DataShadow,Anim2"/>
</application>
</styles>
</chart>