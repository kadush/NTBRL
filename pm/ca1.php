<?php
@require_once('../connection/db.php'); 

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

				
				 <div class="col-md-4 col-md-offset-5">
				 	<form id="customForm"  method="GET" action="">
				 		<table>
				 			<tr>
				 				<td>
				 					<select name="id" class="form-control" >
						  			<option value="">Select One County</option>
								    <?php do{ $TT=TOTALFacilityReportedpercounty($row_rssample['a']); $TT1=getAllGeneSitesInCountyX($row_rssample['a']); 	?>
								    <option value="<?php echo $row_rssample['a']; ?>"> <?php echo $row_rssample['a']; ?> County <span class="badge badge-info badge-roundless" style="float: right" ><?php echo $TT.' / '.$TT1; ?></span></option>
									<?php } while ($row_rssample = mysqli_fetch_assoc($rssample));?>
								    </select>
								 </td>
								 <td> 
								    <input type="submit"  value="Filter" class="btn btn-green"/>
				 				</td>
				 			</tr>
				 		</table>
				 	
					 </form>
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
		
</body>
</html>
