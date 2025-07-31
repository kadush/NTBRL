<?php 
include "../connection/db.php";
// 	
 // $sth = mysqli_query($dbConn,"SELECT `facilitys`.`facilitycode` AS CODE,`facilitys`.`name` AS FACILITY,`districts`.`name` AS DISTRICT,`countys`.`name` AS COUNTY,`provinces`.`name` AS PROVINCE FROM `facilitys` , `districts` ,`countys`, `provinces` WHERE `districts`.`ID` = `facilitys`.`district` AND `countys`.`ID` = `districts`.`county` AND `countys`.`province` = `provinces`.`ID`",$conn);

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'MFL CODE', 'FACILITY NAME', 'DISTRICT', 'COUNTY', 'PROVINCE' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "ajax";
	
	
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * Local functions
	 */
	function fatal_error ( $sErrorMessage = '' )
	{
		header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		die( $sErrorMessage );
	}

	
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$iColumnIndex = array_search( $_GET['mDataProp_'.$_GET['iSortCol_'.$i]], $aColumns );
				$sOrder .= "`".$aColumns[ $iColumnIndex ]."` ".
				 	($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and mysqli's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($dbConn, $_GET['sSearch'] )."%' OR ";
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$iColumnIndex = array_search( $_GET['mDataProp_'.$i], $aColumns );
			$sWhere .= $aColumns[$iColumnIndex]." LIKE '%".mysqli_real_escape_string($dbConn,$_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "SELECT `facilitys`.`facilitycode` AS CODE,`facilitys`.`name` AS FACILITY,`districts`.`name` AS DISTRICT,`countys`.`name` AS COUNTY,`provinces`.`name` AS PROVINCE 
	FROM `facilitys` , `districts` ,`countys`, `provinces` 
	WHERE `districts`.`ID` = `facilitys`.`district` 
	AND `countys`.`ID` = `districts`.`county` 
	AND `countys`.`province` = `provinces`.`ID`";
	$rResult = mysqli_query($dbConn, $sQuery, $gaSql['link'] ) or fatal_error( 'mysqli Error: ' . mysqli_errno($dbConn) );
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query($dbConn, $sQuery ) or fatal_error( 'mysqli Error: ' . mysqli_errno($dbConn) );
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysqli_query($dbConn, $sQuery, $gaSql['link'] ) or fatal_error( 'mysqli Error: ' . mysqli_errno($dbConn) );
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[ $aColumns[$i] ] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[ $aColumns[$i] ] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>


<div id="invdiv"> 
				    <script type="text/javascript">
					   	var myChart = new FusionCharts("Bar2D", "myChartnat", "635", "<?php echo $height; ?>", "0");
						myChart.setXMLUrl("xml1/inv.php?id=<?php echo $countyID; ?>");
			            myChart.render("invdiv");
					</script>
				</div>

				function TOTALFacilitypercounty($county){
		
		$sql="SELECT 
		`facilitys`.`facilitycode` AS CODE,
		`facilitys`.`name` AS FACILITY, 
		`districts`.`name` AS DISTRICT,
		`countys`.`name` AS COUNTY
		FROM `facilitys` , `districts` ,`countys`
		WHERE `facilitys`.`genesite` ='1'
		and `districts`.`ID` = `facilitys`.`district`
		AND `countys`.`ID` = `districts`.`county`
		AND `countys`.`ID` = '$county'
		
		";
		$q=mysqli_query($dbConn,$sql) or die();
		$rw=mysqli_num_rows($q);
		return $rw;
			
		}
		function getAllGeneSitesInCounty($county)
		{
		$sql="SELECT 
		distinct `sample1`.`facility` AS a,
		`facilitys`.`name` AS b, 
		`districts`.`name` AS c,
		`sample1`.`GXSN` AS d,
		`countys`.`name` as e
		FROM `sample1` ,`facilitys`, `districts` ,`countys`
		WHERE 
		`sample1`.`facility`= `facilitys`.`facilitycode`
		AND  `districts`.`ID` = `facilitys`.`district`
		AND `countys`.`ID` = `districts`.`county`
		AND `countys`.`ID` ='$county'
		GROUP BY `sample1`.`facility`,`facilitys`.`name`";
		$query=mysqli_query($dbConn,$sql) or die(mysqli_error($dbConn));
		$rs=mysqli_num_rows($query);
		return $rs;
				
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
		$q=mysqli_query($dbConn,$sql) or die();
		$rw=mysqli_num_rows($q);
		return $rw;
		}
		?>