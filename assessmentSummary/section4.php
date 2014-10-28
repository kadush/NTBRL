<?php
include("ASHeader.php");

@require_once('../connection/db.php'); 

/* ****************************************************/
$sql= "SELECT `section4`.`facility` AS MFL, `facilitys`.`name` AS FACILITY
FROM `section4` , `facilitys`
WHERE `section4`.`facility` = `facilitys`.`facilitycode`
GROUP BY `section4`.`facility`

";

$query=mysql_query($sql);
$numrows=@mysql_num_rows($query);

if(!$numrows){

$dyn_table3 .= '<td colspan="4" align="center"> No Data to Display </td></tr>';
}
else{
$i=0;
$dyn_table3 = '<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">';	
while($row=mysql_fetch_assoc($query)){
	
$mfl=$row['MFL'];
$facility=$row['FACILITY'];	
	
if ($i % 10000 == 0){ 
$dyn_table3 .= '<thead><tr class="odd gradeX"><th>Mfl</th><th>Facility</th></thead> <tbody>';

          $dyn_table3 .= '<td align="left">' .$mfl . '</td>';
		  $dyn_table3 .= '<td align="left">' .$facility . '</td></tr>';
		 
		
} 
else{
	      $dyn_table3 .= '<td align="left">' .$mfl . '</td>';
		  $dyn_table3 .= '<td align="left">' .$facility . '</td></tr>';
		   
} 
       
	  
	$i++;	
		
}	
	
$dyn_table3 .= '</tbody></table>';	
	
}

?>

<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<link rel="stylesheet" href="../jquery-ui-1.10.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../FusionCharts/Contents/Style.css" type="text/css" />
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
	location.href = '#?id='+aData[1];
  $.ajax({
        type: "POST",
        url: "../ajax_data/test.php",
		data: "id="+aData[1],
        async: true,
		cache: false,
        success: function(data) {
			//$("#example").append('<div id="example2"></div>');
             res=data;
			    //alert (res);
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
<script language="JavaScript" src="../FusionCharts/JSClass/FusionCharts.js"></script>

<link rel="stylesheet" href="../jquery-ui-1.10.3/demos/demos.css">
   
<div class="clearer">&nbsp;</div>

<div class="main" id="main-two-columns">

			<div class="left" id="main-left">
            
            <div id="demo" align="center">

		<?php
		echo $dyn_table3;
		?>
	    <div style="background-color:#DDD;" id="example2"> </div>
			</div>
</div>

		
<div class="clearer">&nbsp;</div>

</div>
	</div>
</div>
</div>

</body>
</html>
<?php
include("../includes/footer.php");
?>