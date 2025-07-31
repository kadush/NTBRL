<?php
//include("head.php");

@require_once('../connection/db.php'); 

$sql= "SELECT c.id as a,c.county as b,c.date as c, sum(c.allocated) as d
 FROM `consumption_view` c
WHERE 
 c.status=1
 Group by c.county";
$rssample = mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
$row_rssample = mysqli_fetch_assoc($rssample);
$num=mysqli_num_rows($rssample);

function TOTALFacilityAllocatedpercounty($county){
    $sql= "SELECT c.mfl
    FROM `consumption_view` c
    WHERE c.status='1'
    AND c.county = '$county'";
    $q=mysqli_query($dbConn,$sql) or die();
    $rw=mysqli_num_rows($q);
    return $rw;
    }
?>


<style type="text/css" title="currentStyle">
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/demo_page.css";
@import "../jquery-ui-1.10.3/demos/DataTables/media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" language="javascript" src="../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.js"></script>

<script type="text/javascript" language="javascript" src=" ../jquery-ui-1.10.3/demos/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			
/* Formating function for row details */

 
$(document).ready(function() {
	
	function fnFormatDetails ( oTable, nTr )
{ 
    var aData = oTable.fnGetData( nTr );
    var res='';
	//location.href = '#?id='+aData[1];
        $.ajax({
        type: "POST",
        url: "../ajax_data/allo.php",
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

 
    			<table class="table table-bordered" id="example" width="100%">
						<thead>
								<tr>
									
						            <th style="text-align: center" >County ID </th>
						            <th style="text-align: center" >County Name</th>
						            <th style="text-align: center" >Reporting Period</th>
						            <th style="text-align: center" >Allocated / Total Facilities</th>
						            <th style="text-align: center" >Total Allocations </th>
						            
						         </tr>
							</thead>
							<tbody>
								
                                     <?php
                                     if ($num=='0') {
                                         # code...
                                     } else {
                                         # code...
                                                                         
                                     do {
									 	   $TT=TOTALFacilityAllocatedpercounty($row_rssample['b']);
									       $TT1=getAllGeneSitesInCountyX($row_rssample['b']);
									       $row_rssample['c']= @date('Y', strtotime($row_rssample['c']));
									 ?>      
						<tr class="odd gradeX">
						 
						
						<td style="text-align: center"> <?php echo $row_rssample['a']; ?></td>
						<td style="text-align: center"> <?php echo $row_rssample['b']; ?> County</td>
						<td style="text-align: center"> <?php echo $row_rssample['c']; ?></td>
						<td style="text-align: center"> <?php echo $TT.' / '.$TT1; ?> </td>
						<td style="text-align: center"> <?php echo $row_rssample['d']; ?> </td> 
						 </tr>
						      <?php } while ($row_rssample = mysqli_fetch_assoc($rssample)); }?> 
						      
						       <?php  ?>  
								
							</tbody>
						</table>
						