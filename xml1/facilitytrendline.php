<?php
include('../includes/functions.php');
$_SESSION['mfl'];

if (isset($_GET['fid'])){
 $FacID = $_GET['fid'];
	} 

if (isset($_GET['year'])){
	$year = $_GET['year'];
}
else {
	$year = @date('Y');
}  

function gettestsdone1($FacID,$month,$year){
	
 $sql="SELECT COUNT(*) FROM sample1 where cond='1' AND MONTH(End_Time)='$month' AND YEAR(End_Time)='$year' AND facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function getmtbpos1($FacID,$month,$year){
$sql="SELECT 
sum( CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END ) AS mtbpos
FROM sample1
WHERE cond=1 and MONTH(End_Time)='$month' AND YEAR(End_Time)='$year' AND facility='$FacID'";

$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
 
	
	}

function getmtbneg1($FacID,$month,$year){
$sql="SELECT sum( CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END ) AS MTBNEG
FROM sample1
where cond=1 and MONTH(End_Time)='$month' AND YEAR(End_Time)='$year' AND facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
	
function getmtbrif1($FacID,$month,$year){
$sql="SELECT 
sum( CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END ) AS mtbrif
FROM sample1
 WHERE cond=1 and MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'  AND facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
function gettestwitherrors($FacID,$month,$year){
$sql="SELECT 
sum( CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END ) AS err
FROM sample1
 WHERE cond=1 and MONTH(End_Time)='$month' AND YEAR(End_Time)='$year'  AND facility='$FacID'";	
$query=mysql_query($sql) or die(mysql_error());
$rs=mysql_fetch_row($query);
return $rs[0]	;
	
	}
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
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totaltests=gettestsdone1($FacID,$startmonth,$year);
		
		
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
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$mtbpos=getmtbpos1($FacID,$startmonth,$year);
		
		
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
		
		$mtbneg=getmtbneg1($FacID,$startmonth,$year);
		
		
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
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$mtbrif=getmtbrif1($FacID,$startmonth,$year);
		
		
?>

<set value='<?php echo $mtbrif; ?>' />
<?php
}
?>
</dataset>
<dataset seriesName='Test With Error' color='C673EDD' >
<?php   

$startmonth =  1; 
 $endmonth =  12; 
		for ( $startmonth=1;$startmonth< 13;  $startmonth++)
  		{  
		
		$totalerr=gettestwitherrors($FacID,$startmonth,$year);
		
		
?>

<set value='<?php echo $totalerr; ?>' />
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