<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '-1');
header('Content-Type: application/json; charset-utf-8');
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'MFL CODE', 'FACILITY NAME', 'DISTRICT', 'COUNTY', 'PROVINCE' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "MFL CODE";
	
	/* DB table to use */
	$sTable = "facilitymapping";
		
	/* Database connection information */
	$gaSql['user']       = "ntbrl";
	$gaSql['password']   = "ntbrl@2014!";
	$gaSql['db']         = "db_NTBRL";
	$gaSql['server']     = "localhost";
	
	
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
	 * mysqli connection
	 */
	if ( ! $gaSql['link'] = mysqli_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
	{
		fatal_error( 'Could not open connection to server' );
	}

	if ( ! mysqli_select_db( $gaSql['db'], $gaSql['link'] ) )
	{
		fatal_error( 'Could not select database ' );
	}
	
	mysqli_set_charset('utf8',$gaSql['link']);
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
				$sOrder .= "".$aColumns[ $iColumnIndex ]." ".
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
				$sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
			$sWhere .= $aColumns[$iColumnIndex]." LIKE '%".mysqli_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "SELECT `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
	    FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	// echo $sQuery;
	// exit;
	$rResult = mysqli_query($dbConn, $sQuery, $gaSql['link'] ) or fatal_error( 'mysqli Error: ' . mysqli_errno() );
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysqli_query($dbConn, $sQuery, $gaSql['link'] ) or fatal_error( 'mysqli Error: ' . mysqli_errno() );
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	// echo $iFilteredTotal;
	// exit;
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(*)
		FROM   $sTable
	";
	// echo $sQuery;
	// exit;
	$rResultTotal = mysqli_query($dbConn, $sQuery, $gaSql['link'] ) or fatal_error( 'mysqli Error: ' . mysqli_errno() );
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval(0),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	// var_dump($output);
	// exit;
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
	
	   // echo '<pre>';
       // var_dump($output);
       // exit;
	echo json_encode($output);

?>