
<?php 
@include('header.php');
require_once('connection/db.php'); 

mysql_select_db($database, $ntrl);

$sql= "SELECT `sample1`.`lab_no` AS a, `sample1`.`End_Time` AS b, `facilitys`.`name` AS c, `districts`.`name` AS d, countys.name AS e
FROM `sample1` , `facilitys` , `districts`,countys
WHERE `sample1`.`Refacility` = `facilitys`.`facilitycode`
AND `districts`.`ID` = `facilitys`.`district`
AND `districts`.`county` = `countys`.`ID`
AND `sample1`.`cond`=1
AND `sample1`.`facility` = ".$_SESSION['mfl'];

$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){
$dyn_table .= '<table class="table table-bordered" id="table-1"><tr bgcolor="#CCC"><th><small>Lab No</small></th></th><th><small>Date Tested</small></th><th><small>Referred From</small></th><th><small>District</small></th><th><small>County</small></th>';
$dyn_table .= '<tr><td colspan="4" align="center"> <small>No Data to Display </small></td></tr><table>';
}
else{
$i=0;
$dyn_table = '<table class="table table-bordered" id="table-1">';	
while($row=mysql_fetch_assoc($query)){
	
$samp=$row['a'];
$date=$row['b']=@date("d-M-Y",strtotime($row['b']));
$facility=$row['c'];	
$district=$row['d'];
$county=$row['e'];

	
if ($i % 10000 == 0){ 
$dyn_table .= ' <thead><tr class="odd gradeX"><th><small>Lab No</small></th></th><th><small>Date Tested</small></th><th><small>Referred From</small></th><th><small>District</small></th><th><small>County</small></th></thead> <tbody>';

          $dyn_table .= '<td><small>' .$samp. '</small></td>';
		  $dyn_table .= '<td><small>' .$date. '</small></td>';
		  $dyn_table .= '<td><small>' .$facility. '</small></td>';
		  $dyn_table .= '<td><small>' .$district. '</small></td>';
		  $dyn_table .= '<td><small>' .$county. '</small></td></tr>';
		  
} 
else{
	      $dyn_table .= '<td><small>' .$samp. '</small></td>';
		  $dyn_table .= '<td><small>' .$date. '</small></td>';
		  $dyn_table .= '<td><small>' .$facility. '</small></td>';
		  $dyn_table .= '<td><small>' .$district. '</small></td>';
		  $dyn_table .= '<td><small>' .$county. '</small></td></tr>';
		           	
} 
       
	$i++;	
		
}	
	
$dyn_table .= '</tbody></table>';	
	
}
//get number of tests done county
 function totalTestsFacilityWise($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate)
	  {
	  if ($filter==0) //last submission
	  {
	  $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
 
FROM sample1 WHERE
 MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  AND facility=".$_SESSION['mfl'];

	  }
	  elseif ($filter==1)//last 6 months $fromdate$todate
	  {
	  $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
FROM sample1 WHERE
 End_Time BETWEEN '$fromdate' AND '$todate'  AND cond='1'  AND facility=".$_SESSION['mfl'];
	  }
	  elseif ($filter==2)//cusomtize dates $fromfiler $tofilter
	  {
	  	  $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
FROM sample1 WHERE
 End_Time BETWEEN '$fromfilter' AND '$tofilter'  AND cond='1'  AND facility=".$_SESSION['mfl'];
	  }
	    elseif ($filter==3)//month/year
	  {
	   $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err 
FROM sample1 WHERE
 MONTH(End_Time)='$currentmonth' AND YEAR(End_Time)='$currentyear' AND cond='1'  AND facility=".$_SESSION['mfl'];
 	  }
	    elseif ($filter==4)//year only
	  {
	 $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
FROM sample1 WHERE
  YEAR(End_Time)='$currentyear'  AND cond='1'  AND facility=".$_SESSION['mfl'];
	  }
	    elseif ($filter==7) //last 6 months $fromdate$todate
	  {
	  	  $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
FROM sample1 WHERE
 End_Time BETWEEN '$fromdate' AND '$todate' AND cond='1'  AND facility=".$_SESSION['mfl'];
	  }
	       elseif ($filter==8) //all
	  {
	  	  $sequel="SELECT count(*) AS tt,
   sum(CASE WHEN Test_Result = 'positive' THEN 1 ELSE 0 END) AS mtb,
   sum(CASE WHEN Test_Result = 'negative' THEN 1 ELSE 0 END) AS neg,
   sum(CASE WHEN mtbRif = 'positive' THEN 1 ELSE 0 END) AS rif,
   sum(CASE WHEN age>15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 6 AND 15 THEN 1 ELSE 0 END),
   sum(CASE WHEN age Between 1 AND 5 THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Male' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Female' THEN 1 ELSE 0 END),
   sum(CASE WHEN gender='Not specified' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Positive' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Negative' THEN 1 ELSE 0 END),
   sum(CASE WHEN h_status='Not Done' or h_status='Declined' THEN 1 ELSE 0 END),
   sum(CASE WHEN Test_Result = 'ERROR' THEN 1 ELSE 0 END) AS err
   FROM sample1 WHERE  cond='1'  AND facility=".$_SESSION['mfl'];
	  }
	     
$query=mysql_query($sequel) or die(mysql_error());
$rs=mysql_fetch_array($query);
return $rs;
}
$TTF=totalTestsFacilityWise($filter,$currentmonth,$currentyear,$fromfilter,$tofilter,$fromdate,$todate);
?>
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"  id="style-resource-4">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    <script language="JavaScript" src="FusionCharts/JSClass/FusionCharts.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<!-- TS1387507087: Neon - Responsive Admin Template created by Laborator -->

<body class="page-body">

<div class="page-container">
		
	<?php include("sb.php"); ?>

<div class="main-content" >
<div class="row">
	<ol class="breadcrumb">
		<form id="customForm"  method="GET" action="" >
<div><strong> Date Range: </strong>&nbsp;<U><B><font color="#0000CC"><?php echo $title; ?></B></U>   |<small>  
<?php

if (isset($_GET['id'])){
		 $_SESSION['cid'] = $_GET['id'];
		 $countyID =  $_SESSION['cid'];
	}

   if ($filter==1)//LAST 3 MONTHS
    {
    echo "<a href='$D?filter=0' title=' Click to Filter View to Last Submission Statistics'>   Last Upload </a> | 
          <a href='$D?filter=7' title=' Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>";           
    }
    elseif ($filter==7)//LAST 6 MONTHS
    {
    echo "<a href=' $D?filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload</a>  |
          <a href=' $D?filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a>"; 

    }
    elseif (($filter==2) || ($_REQUEST['submitfrom']))//customeized
    {

    echo "<a href=' $D?filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a>  |
          <a href=' $D?filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a> |
          <a href=' $D?filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==4) || ($filter==3)) //month/year filter
    {
    echo "<a href=' $D?filter=0' title='Click to Filter View to Last Submission Statistics'>   Last Upload </a> |
          <a href=' $D?filter=7' title='Click to Filter View to Last 6 months Statistics'>   Last 6 Months </a>  |
          <a href=' $D?filter=1' title='Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";

    }
    elseif (($filter==0) ||($filter=='') || ($filter==8)) //Lst submitted//all
    {

     echo "<a href='$D?filter=7' title=' Click to Filter View to Last 3 months Statistics'>   Last 6 Months </a>  | 
           <a href='$D?filter=1' title=' Click to Filter View to Last 3 months Statistics'>   Last 3 Months </a> ";
   
    }
?>|    
<a onclick ="javascript:ShowHide('HiddenDiv')" href="javascript:;' title='Click to Filter View based on Date Range you Specify"> Customize Dates</a></font></small>
<class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
 	| 
	        <?php
                $year = GetMaxYear();
                $twoless = GetMinYear();
                echo "<a href=$D?filter=8 title='Click to Filter View cumulative data'>   All  | </a>";
                for ($year; $year >= $twoless; $year--) 
                {
                    echo "<a href=$D?year=$year&filter=4 title='Click to Filter View to $year'>   $year  | </a>";
                }
            ?>

<class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
             <?php $year = $_GET['year'];
                  if ($year == "") 
                  {
                     $year = @date('Y');
                  }
                  echo "<a href =$D?year=$year&mwezi=1&filter=3 title='Click to Filter View to Jan, $year'>Jan</a>"; ?>  |
            <?php echo "<a href =$D?year=$year&mwezi=2&filter=3 title='Click to Filter View to Feb, $year'>Feb</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=3&filter=3 title='Click to Filter View to Mar, $year'>Mar</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=4&filter=3 title='Click to Filter View to Apr, $year'>Apr</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=5&filter=3 title='Click to Filter View to May, $year'>May</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=6&filter=3 title='Click to Filter View to Jun, $year'>Jun</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=7&filter=3 title='Click to Filter View to Jul, $year'>Jul</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=8&filter=3 title='Click to Filter View to Aug, $year'>Aug</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=9&filter=3 title='Click to Filter View to Sept, $year'>Sept</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=10&filter=3 title='Click to Filter View to Oct, $year'>Oct</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=11&filter=3 title='Click to Filter View to Nov, $year'>Nov</a>"; ?>  | 
            <?php echo "<a href =$D?year=$year&mwezi=12&filter=3 title='Click to Filter View to Dec, $year'>Dec</a>"; ?>
<span class="label label-default">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</div>

<div class="mid" id="HiddenDiv" style="DISPLAY: none" >
	
<div>From:<label style="margin-left: 15%">To:</label></div>
<div class="col-md-2">
<input class="form-control datepicker" type="text" data-format="yyyy-mm-dd" id="fromfilter" name="fromfilter" size="18"  />
</div>

<div class="col-md-2">
<input class="form-control datepicker" type="text" data-format="yyyy-mm-dd" id="tofilter" name="tofilter" size="18" />
</div>
<input type="submit" id="submitform" name="submitform" value="Filter" class="btn btn-green"/>
</div>


</form>
</ol>
</div>
<div class="row">
	<div class="col-md-7">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Cumulative Data
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			
                         <table class="table table-responsive">
                         	<thead>
							<tr>
							<td style="text-align:center">Total Tests</td>
							<td style="text-align:center">MTB +ve</td>
							<td style="text-align:center">MTB -ve</td>
							<td style="text-align:center">RIF Resistant</td>
							<td style="text-align:center">Errors</td>
							</tr>
							</thead>
							<tbody>
							<tr>
							<td style="text-align:center"><?php echo $TTF[0] ;?></td>
							<td style="text-align:center"><?php echo $TTF[1]  ;?></td>
							<td style="text-align:center"><?php echo $TTF[2] ;?></td>
							<td style="text-align:center"><?php echo $TTF[3] ;?></td>
							<td style="text-align:center"><?php echo $TTF[13] ;?></td>
							</tr>
							</tbody>
						</table>

			</div>

		</div>
	
	</div>
	<div class="col-md-5">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Test Result By Outcome
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			   <div id="chartnatw"  align="center"> </div>
			   	<?php if (($TTF[1]==0) and ($TTF[2]==0) and ($TTF[3]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Doughnut2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "163", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnatw");
				    </script>		
						
					<?php } else { ?>
		         <script type="text/javascript">
		          var myChart = new FusionCharts("FusionCharts/Charts/Pie2D.swf", "myChartnat", "300", "200", "0", "0");
		          myChart.setDataXML('<chart bgcolor="#FFFFFF" showBorder="0" ><set  isSliced="1" label="MTB Pos" color="00ACE8" value="<?php echo $TTF[1]; ?>"/><set  label="MTB Neg" color="C295F2" value="<?php echo $TTF[2]; ?>"/><set  label="RIF Resistant" color="ADFF2F" value="<?php echo $TTF[3];?>"/></chart>');  
		          myChart.render("chartnatw");
		         </script>
		         <?php } ?> 
		      
			</div>

		</div>
	
	</div>
	<div class="col-md-4">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Test Result By Age
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			    <div id="chartnat1"  align="center"></div>
					<?php if (($TTF[4]==0) and ($TTF[5]==0) and ($TTF[6]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Doughnut2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "163", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat1");
				    </script>		
						
					<?php } else { ?>  
		         <script type="text/javascript">
		     		var myChart = new FusionCharts("FusionCharts/Charts/Doughnut2D.swf", "myChartnat", "272", "160", "0", "0");
		    		myChart.setDataXML('<chart  bgcolor="FFFFFF"   showborder="0"  palette="2" animation="1"  pieSliceDepth="30" startingAngle="125"><set value="<?php echo $TTF[4]; ?>" label="Above 15 Yrs" color="C295F2"/><set value="<?php echo $TTF[5]; ?>" label="Btwn 5-15 Yrs" color="#ADFF2F"/><set value="<?php echo $TTF[6]; ?>" label="Below 5 Yrs" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
		    		myChart.render("chartnat1");
			     </script> 
				 <?php } ?>

			</div>

		</div>
	
	</div>
	<div class="col-md-4">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Test Result By Gender
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			    <div id="chartnat2"  align="center"></div>
			    	<?php if (($TTF[7]==0) and ($TTF[8]==0) and ($TTF[9]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Pie3D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "163", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat2");
				    </script>		
						
					<?php } else { ?>  
			         <script type="text/javascript">
			     	 var myChart = new FusionCharts("FusionCharts/Charts/Pie3D.swf", "myChartnat", "272", "160", "0", "0");
			    	 myChart.setDataXML('<chart bgcolor="FFFFFF" showborder="0" palette="2" animation="1"  pieSliceDepth="30" startingAngle="125" ><set value="<?php echo $TTF[7]; ?>" label="Male" color="C295F2"/><set value="<?php echo $TTF[8]; ?>" label="Female" color="#ADFF2F"/><set value="<?php echo $TTF[9]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
			    	 myChart.render("chartnat2");
			    	 </script> 
			        <?php } ?>

			</div>

		</div>
	
	</div>
	<div class="col-md-4">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Test Result By Hiv Status
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			    <div id="chartnat3"  align="center"> </div>
			    	<?php if (($TTF[10]==0) and ($TTF[11]==0) and ($TTF[12]==0)) { ?> 
						
					<script type="text/javascript">
					var myChart = new FusionCharts("../FusionCharts/Charts/Pie2D.swf?ChartNoDataText=No data to display", "myChartnat", "300", "163", "0", "0");
					myChart.setDataXML("<chart></chart>");
		            myChart.render("chartnat3");
				    </script>		
						
					<?php } else { ?>  
			    
	                 <script type="text/javascript">
	      			 var myChart = new FusionCharts("FusionCharts/Charts/Pie2D.swf", "myChartnat", "272", "160", "0", "0");
	   				 myChart.setDataXML('<chart  bgcolor="FFFFFF"  showborder="0"  palette="2" animation="1"   pieSliceDepth="30" startingAngle="125"> <set value="<?php echo $TTF[10]; ?>" label="Positive" color="C295F2"/><set value="<?php echo $TTF[11]; ?>" label="Negative" color="#ADFF2F"/><set value="<?php echo $TTF[12]; ?>" label="Not specified" color="00ACE8"/><styles><definition><style type="font" name="CaptionFont" size="11" color="666666" /><style type="font" name="SubCaptionFont" bold="0" /></definition><application><apply toObject="caption" styles="CaptionFont" /><apply toObject="SubCaption" styles="SubCaptionFont" /></application></styles></chart>');
	    			 myChart.render("chartnat3");
	                 </script> 
	               <?php } ?>

				</div>


			</div>

		</div>
	
	</div>
	
	<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-gradient" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Sample Mapping
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
			<?php echo $dyn_table; ?>
                      
			</div>

		</div>
	
	</div>
</div>
	
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>

	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/bootstrap-datepicker.js" id="script-resource-11"></script>
	<script src="admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
	
<!-- Footer -->
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("includes/footer.php");
		?>
		</div>
	
</footer>		
</div>
</div>	
</body>
</html>