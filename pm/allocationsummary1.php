<?php
//include("head.php");

@require_once('../connection/db.php'); 
mysql_select_db($database, $ntrl);
$sql= "SELECT countys.ID as a,countys.name as b,consumption.date as c, sum(consumption.allocated) as d
 FROM `consumption` ,facilitys, `districts` ,`countys`
WHERE 
`consumption`.`facility`= `facilitys`.`facilitycode`
AND  `districts`.`ID` = `facilitys`.`district`
AND consumption.status=1
AND `countys`.`ID` = `districts`.`county`
Group by  countys.ID";
$rssample = mysql_query($sql, $ntrl) or die(mysql_error());
$row_rssample = mysql_fetch_assoc($rssample);

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
AND `countys`.`ID` = '$county'";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
return $rw;
	
}
function TOTALFacilityAllocatedpercounty($county){
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
AND consumption.status=1
AND `countys`.`ID` = '$county'";
$q=mysql_query($sql) or die();
$rw=mysql_num_rows($q);
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
								
									 <?php do {
									 	   $TT=TOTALFacilityAllocatedpercounty($row_rssample['a']);
									       $TT1=TOTALFacilitypercounty($row_rssample['a']);
									       $row_rssample['c']= @date('Y', strtotime($row_rssample['c']));
									 ?>      
						<tr class="odd gradeX">
						 
						
						<td style="text-align: center"> <?php echo $row_rssample['a']; ?></td>
						<td style="text-align: center"> <?php echo $row_rssample['b']; ?> County</td>
						<td style="text-align: center"> <?php echo $row_rssample['c']; ?></td>
						<td style="text-align: center"> <?php echo $TT.' / '.$TT1; ?> </td>
						<td style="text-align: center"> <?php echo $row_rssample['d']; ?> </td> 
						 </tr>
						      <?php } while ($row_rssample = mysql_fetch_assoc($rssample)); ?> 
						      
						       <?php  ?>  
								
							</tbody>
						</table>
						