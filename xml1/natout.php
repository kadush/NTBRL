<?php
error_reporting(1);
session_start();
@require_once('../connection/db.php'); 
@require_once('../includes/functions.php');
 $currentyear=$_GET['mwaka']; 
 $currentmonth=$_GET['mwezi'];
 $filter=$_GET['filtertype'];
 $fromfilter=$_GET['from'];
 $tofilter=$_GET['to'];
 $fromdate=$_GET['fdate'];
 $todate=$_GET['tdate'];
 $startmonth =  1; 
 $endmonth =  12; 

//get number of pos tests done
	  function TotalPos1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'   ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'   ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE  YEAR(End_Time)='$currentyear'   ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance NOT DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance NOT DETECTED'OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance NOT DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE'  OR  Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR  Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED' THEN 1 ELSE 0 END ) AS mtb
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'   ";
	  }
	     
	  $query=mysql_query($sequel) or die(mysql_error());
    	$re=mysql_fetch_row($query);
	    return $re[0];
	  }
	  //get number of Neg tests done
	  function TotalNeg1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'   ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE  YEAR(End_Time)='$currentyear'";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel=" SELECT sum(CASE WHEN Test_Result = 'MTB NOT DETECTED'  THEN 1 ELSE 0 END) as neg
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'";
	  }
	     
	  $query=mysql_query($sequel) or die(mysql_error());
	  $re=mysql_fetch_row($query);
	  return $re[0];
	  }
	    //get number of rif tests done
	  function TotalRif1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif  
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'";

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'   ";
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif
              FROM  sample WHERE End_Time BETWEEN '$fromfilter' AND '$tofilter'   ";
	  }
	    elseif ($filter==3)//month/year
	  {
	    $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif
              FROM  sample WHERE MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear'  ";
 	  }
	    elseif ($filter==4)//year only
	  {
	  $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif
              FROM  sample WHERE  YEAR(End_Time)='$currentyear'   ";
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	   $sequel="SELECT sum( CASE WHEN Test_Result = 'MTB DETECTED HIGH; Rif Resistance DETECTED' OR Test_Result = 'MTB DETECTED LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED MEDIUM; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance DETECTED'  OR  Test_Result = 'MTB DETECTED VERY LOW; Rif Resistance INDETERMINATE' THEN 1 ELSE 0 END ) AS rif
              FROM  sample WHERE End_Time BETWEEN '$fromdate' AND '$todate'   ";
	  }
	     
	  $query=mysql_query($sequel) or die(mysql_error());
	  $re=mysql_fetch_row($query);
	  return $re[0];
	  }




   $tpos=TotalPos1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
   $tneg=TotalNeg1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate) ;
   $trif=TotalRif1($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);

?>
<chart showPercentageInLabel="0" showValues="0" showLabels="0" showLegend="1" showPercentValues="1" bgcolor="#FFFFFF" showBorder="0" >
	
 <set  label="MTB Detected" color="00ACE8" value="<?php echo $tpos; ?>"/>
 <set  label="MTB Not Detected" color="C295F2" value="<?php echo $tneg; ?>"/>
 <set  label="RIF Resistant" color="ADFF2F" value="<?php echo $trif;?>"/>

</chart>