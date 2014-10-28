<?php
include('../includes/functions.php');
?>

<chart  yAxisName="# of Tests" lineThickness="1" showValues="0" formatNumberScale="0" anchorRadius="2" showAlternateHGridColor="1" alternateHGridAlpha="5" alternateHGridColor="CC3300" shadowAlpha="40" bgcolor="#FFFFFF" showBorder="0">
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
<dataset seriesName='Test Done' color='A666EDD' >
<?php   

 $startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=gettestsdone($startmonth,$currentyear);
		
		
?>

<set value='<?php echo $totaltests; ?>' />
<?php
}
?>
</dataset>

<dataset seriesName='MTB Positive Test' color='F1683C' >
<?php   

$startmonth =  1; 
 $endmonth =  12;
 $currentyear=$_GET['mwaka']; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$mtbpos=getmtbpos($startmonth,$currentyear);
		
		
?>

<set value='<?php echo $mtbpos; ?>' />
<?php
}
?>
</dataset>
<dataset seriesName='MTB Negative Test' color='DBDC25' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$mtbneg=getmtbneg($startmonth,$currentyear);
		
		
?>

<set value='<?php echo $mtbneg; ?>' />
<?php
}
?>
</dataset>

<dataset seriesName='MTB Rif Res Test' color='2AD62A' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
 $currentyear=$_GET['mwaka'];
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$mtbrif=getmtbrif($startmonth,$currentyear);
		
		
?>

<set value='<?php echo $mtbrif; ?>' />
<?php
}
?>
</dataset>
<dataset seriesName='Tests With Errors' color='F1690D' >
<?php   

$startmonth =  1; 
 $endmonth =  12;
 $currentyear=$_GET['mwaka']; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$errors=getError($startmonth,$currentyear);
		
		
?>

<set value='<?php echo $errors; ?>' />
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