<?php
@require_once('../connection/db.php'); 
mysql_select_db($database, $ntrl);
$sql= "SELECT ID as a,name as b from countys";
$rssample = mysql_query($sql, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);

$currentmonth=@date("m");
$currentyear=@date("Y");
$previousmonth=@date("m")- 1;

if ($currentmonth ==1)
{
$previousmonth=12;
$currentyear=@date("Y")-1;
}
else
{
$previousmonth=@date("m")- 1;
$currentyear=@date("Y");
}
function TOTALFacilitypercounty($county){
		
$sql="SELECT 
`facilitys`.`facilitycode` AS CODE,
`facilitys`.`name` AS FACILITY, 
`districts`.`name` AS DISTRICT,
`countys`.`name` AS COUNTY
FROM `facilitys` , `districts` ,`countys`
WHERE 
`districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$county'

";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
return $rw;
	
}
function TOTALFacilityReportedpercounty($county,$previousmonth,$currentyear){
$sql= "SELECT 
`consumption`.`facility` AS a,
`facilitys`.`name` AS b, 
`districts`.`name` AS c,
consumption.commodity AS d,
consumption.quantity AS e,
consumption.quantity_used AS f,
consumption.end_bal AS g,
consumption.q_req AS h,
`countys`.`name` as county
FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND `countys`.`ID` = `districts`.`county`
AND `countys`.`ID` = '$county'
AND MONTH(consumption.date)='$previousmonth'
AND YEAR(consumption.date)='$currentyear'
Group by `consumption`.`facility`";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
return $rw;
}
?>
<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>

	</head>
<body>

	<div class="col-sm-3">

		<div class="panel panel-gradient">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>
						County Reporting
					</h4>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
		
			<div class="panel-body no-padding">
				<table class="table table-striped">
							<thead>
							<tr >
								<td style="font-weight: bold;"> Counties</td>
								<td style="font-weight: bold;">Reported / Total(Facilities)</td>
							</tr>
						</thead>
				         <tbody>
					
						 <?php do { $TT=TOTALFacilityReportedpercounty($row_rssample['a'],$previousmonth,$currentyear); $TT1=TOTALFacilitypercounty($row_rssample['a']);  ?>      
			            <tr class="odd gradeX">
			            	<td> <a href="countyallocation.php?id=<?php echo $row_rssample['a']; ?>"><?php echo $row_rssample['b']; ?></a></td>
			                <td style="text-align: center"> <?php echo $TT.' / '.$TT1; ?></td>
			            </tr>
					      <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
					   
					    </tbody>
						</table>
			</div>
		</div>

	</div>

			

<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-9"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-28991003-3']);
		_gaq.push(['_setDomainName', 'laborator.co']);
		_gaq.push(['_setAllowLinker', true]);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
	</script>
	
</body>
</html>
