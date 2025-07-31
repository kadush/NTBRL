<?php require_once('../connection/db.php'); 
include("header.php");
$query_rsUser = "SELECT  * FROM facility_map where mfl !='99999' ORDER BY facility asc";
$rsUser = mysqli_query($dbConn,$query_rsUser) or die(mysqli_error($dbConn));
$row_rsUser = mysqli_fetch_assoc($rsUser);
$totalRows_rsUser = mysqli_num_rows($rsUser);

$query_rsGX = "SELECT  * FROM facility_map where genesite=1 and mfl !='99999' ORDER BY facility asc";
$rsGX = mysqli_query($dbConn,$query_rsGX) or die(mysqli_error($dbConn));
$row_rsGX = mysqli_fetch_assoc($rsGX);
$totalRows_rsGX = mysqli_num_rows($rsGX);

//$query_rsR = "SELECT distinct mfl,facility,sub_county,county FROM consumption_view where mfl !='99999' ORDER BY facility asc";
$query_rsR = "SELECT * FROM facility_map where truenat=1 and mfl !='99999' ORDER BY facility asc";
$rsR = mysqli_query($dbConn,$query_rsR) or die(mysqli_error($dbConn));
$row_rsR = mysqli_fetch_assoc($rsR);
$totalRows_rsR = mysqli_num_rows($rsR);

//$query_rsNR = "SELECT  * FROM facilitynotsubmittedcr where mfl !='99999' ORDER BY facility asc";
$query_rsNR = "SELECT  * FROM facility_map where xray=1 and mfl !='99999' ORDER BY facility asc";
$rsNR = mysqli_query($dbConn,$query_rsNR) or die(mysqli_error($dbConn));
$row_rsNR = mysqli_fetch_assoc($rsNR);
$totalRows_rsNR = mysqli_num_rows($rsNR);
?>
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/entypo.css"  id="style-resource-2">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/font-icons/entypo/css/animation.css"  id="style-resource-3">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/neon.css"  id="style-resource-5">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/css/custom.css"  id="style-resource-6">

	<script src="../admin/neon/neon-x/assets/js/jquery-1.10.2.min.js"></script>
    

<div class="main-content" style="margin-left: 1%">

<div class="row">
<div class="col-md-10 col-md-offset-1">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active"><a href="#allFac" data-toggle="tab">All facilities</a></li>
			<li><a href="#gx" data-toggle="tab">GeneXpert Sites</a></li>
			<li><a href="#withR" data-toggle="tab">TrueNat Sites</a></li>
			<li><a href="#withoutR" data-toggle="tab">CAD4TB Sites</a></li>
			
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane active" id="allFac">
				<table class="table table-bordered" id="example">
					<thead>
						<tr>
						<th>MFL CODE</th>
						<th>FACILITY NAME</th>
						<th>SUB COUNTY </th>
						<th>COUNTY</th>
						<th>PROVINCE</th>
						</tr>
					</thead>
					<tbody>
						
								<?php do {   ?> 
						<tr>
						
								<td><?php echo $row_rsUser['mfl']; ?></td>
								<td><?php echo $row_rsUser['facility']; ?></td>
								<td><?php echo $row_rsUser['sub_county']; ?></td>
								<td><?php echo $row_rsUser['county']; ?></td>
								<td><?php echo $row_rsUser['region']; ?></td>
								
							</tr>
								<?php } while ($row_rsUser = mysqli_fetch_array($rsUser)); ?>
					</tbody>
				</table>
            </div>
			<div class="tab-pane" id="gx">
				<table class="table table-bordered" id="gxtable">
					<thead>
						<tr>
						<th>MFL CODE</th>
						<th>FACILITY NAME</th>
						<th>SUB COUNTY </th>
						<th>COUNTY</th>
						<th>PROVINCE</th>
						<th>DEVICE MODULES</th>
						</tr>
					</thead>
					<tbody>
						
								<?php do {   ?> 
						<tr>
						
								<td><?php echo $row_rsGX['mfl']; ?></td>
								<td><?php echo $row_rsGX['facility']; ?></td>
								<td><?php echo $row_rsGX['sub_county']; ?></td>
								<td><?php echo $row_rsGX['county']; ?></td>
								<td><?php echo $row_rsGX['region']; ?></td>
								<td><?php echo $row_rsGX['modular']; ?></td>
								
							</tr>
								<?php } while ($row_rsGX = mysqli_fetch_array($rsGX)); ?>
					</tbody>
				</table>

			</div>
			<div class="tab-pane" id="withR">

				<table class="table table-bordered" id="Rtable">
					<thead>
						<tr>
						<th>MFL CODE</th>
						<th>FACILITY NAME</th>
						<th>SUB COUNTY </th>
						<th>COUNTY</th>
						
						</tr>
					</thead>
					<tbody>
						
								<?php do {   ?> 
						<tr>
						
								<td><?php echo $row_rsR['mfl']; ?></td>
								<td><?php echo $row_rsR['facility']; ?></td>
								<td><?php echo $row_rsR['sub_county']; ?></td>
								<td><?php echo $row_rsR['county']; ?></td>
								
								
							</tr>
								<?php } while ($row_rsR = mysqli_fetch_array($rsR)); ?>
					</tbody>
				</table>

			</div>
			<div class="tab-pane" id="withoutR">
				<table class="table table-bordered" id="nrtable">
					<thead>
						<tr>
						<th>MFL CODE</th>
						<th>FACILITY NAME</th>
						<th>SUB COUNTY </th>
						<th>COUNTY</th>
						</tr>
					</thead>
					<tbody>
						
								<?php do {   ?> 
						<tr>
						
								<td><?php echo $row_rsNR['mfl']; ?></td>
								<td><?php echo $row_rsNR['facility']; ?></td>
								<td><?php echo $row_rsNR['sub_county']; ?></td>
								<td><?php echo $row_rsNR['county']; ?></td>
																
							</tr>
								<?php } while ($row_rsNR = mysqli_fetch_array($rsNR)); ?>
					</tbody>
				</table>

			</div>
					
		</div>
		
		
	</div>


</div>

	

<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			
/* Formating function for row details */

 
$(document).ready(function() {
	$('#Rtable').DataTable( {
		responsive: true
	} );

	$('#nrtable').DataTable( {
		responsive: true
	} );

	$('#gxtable').DataTable( {
		responsive: true
	} );
	
	function fnFormatDetails ( oTable, nTr )
{ 
    var aData = oTable.fnGetData( nTr );
    var res='';
	//location.href = '#?id='+aData[1];
        $.ajax({
        type: "POST",
        url: "../ajax_data/user.php",
		data: "id="+aData[1],
        async: true,
		cache: false,
        success: function(data) {
			     res=data;
			     oTable.fnOpen(nTr,res,'r');
			    
			}
   
     });  
 return res;
	
}
	
    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png">';
    nCloneTd.className = "center";
     
    $('#example thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );
     
    $('#example tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );
     
    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#example').dataTable( {
       "bJQueryUI":true, "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });
     
    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $('#example tbody td img').live('click', function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "../jquery-ui-1.10.3/demos/DataTables/examples/examples_support/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );			
			
</script>
	
<!-- Footer -->
<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2-bootstrap.css"  id="style-resource-1">
	<link rel="stylesheet" href="../admin/neon/neon-x/assets/js/select2/select2.css"  id="style-resource-2">

	<script src="../admin/neon/neon-x/assets/js/gsap/main-gsap.js" id="script-resource-1"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js" id="script-resource-2"></script>
	<script src="../admin/neon/neon-x/assets/js/bootstrap.min.js" id="script-resource-3"></script>
	<script src="../admin/neon/neon-x/assets/js/joinable.js" id="script-resource-4"></script>
	<script src="../admin/neon/neon-x/assets/js/resizeable.js" id="script-resource-5"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-api.js" id="script-resource-6"></script>
	<script src="../admin/neon/neon-x/assets/js/jquery.dataTables.min.js" id="script-resource-7"></script>
	<script src="../admin/neon/neon-x/assets/js/dataTables.bootstrap.js" id="script-resource-8"></script>
	<script src="../admin/neon/neon-x/assets/js/select2/select2.min.js" id="script-resource-9"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-chat.js" id="script-resource-10"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-custom.js" id="script-resource-11"></script>
	<script src="../admin/neon/neon-x/assets/js/neon-demo.js" id="script-resource-12"></script>
<footer class="main">
	
		<div class="pull-right">
		<?php
		include("../includes/footer.php");
		?>
		</div>
	
</footer>		
</div>

</body>
</html>