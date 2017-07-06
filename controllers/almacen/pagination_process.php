<?php
	/*require '../config.php';*/
	require_once '../../models/database.php';
	
	/* Nombre de La Tabla */
	$sTabla = " almacen";
	
	/* Array que contiene los nombres de las columnas de la tabla*/
	$aColumnas = array('alm_codigo', 'alm_nombre', 'alm_direccion');
	
	/* columna indexada */
	$sIndexColumn = "alm_codigo";
	
	// Paginacion
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
	}
		
	//Ordenacion
	if ( isset( $_GET['iSortCol_0'] ) )	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
				$sOrder .= $aColumnas[ intval( $_GET['iSortCol_'.$i] ) ]."
				".$_GET['sSortDir_'.$i] .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" ) {
			$sOrder = "";
		}
	}
	
	//Filtracion
	$sWhere = "";
	if ( $_GET['sSearch'] != "" ) {
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumnas) ; $i++ ) {
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	// Filtrado de columna individual 
	for ( $i=0 ; $i<count($aColumnas) ; $i++ ) {
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ) {
			if ( $sWhere == "" ) {
				$sWhere = "WHERE ";
			} else {
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
		}
	}
		
	//Obtener datos para mostrar SQL queries
	$sQuery = " SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))." FROM $sTabla $sWhere $sOrder $sLimit ";
	$rResult = Database::getInstance()->prepare($sQuery);
	$rResult->execute();
/*	$rResult = $rResult->fetchAll(PDO::FETCH_ASSOC);*/
	
	/* Data set length after filtering */
	$sQuery = " SELECT FOUND_ROWS()	";
	$rResultFilterTotal = Database::getInstance()->prepare($sQuery);
	$rResultFilterTotal->execute();
	while ($row = $rResultFilterTotal->fetch()) {
        $iFilteredTotal = $row['FOUND_ROWS()'];
    }
	
	/* Total data set length */
	$sQuery = " SELECT COUNT(".$sIndexColumn.") AS cant FROM $sTabla ";
	$rResultTotal = Database::getInstance()->prepare($sQuery);
	$rResultTotal->execute();
	while ($row = $rResultTotal->fetch()) {
        $iTotal = $row['cant'];
    }
	
	/*
		* Output
	*/
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	$data = $rResult->fetchAll(PDO::FETCH_ASSOC);
	foreach ( $data as $aRow ) {
		$row = array();
		for ( $i=0 ; $i<count($aColumnas) ; $i++ ) {
			$row[] = ($aRow[ $aColumnas[$i] ]=="0") ? '-' : $aRow[ $aColumnas[$i] ];
		}

		$row[] = "<td><a href='#'' data-codigo=".$aRow['alm_codigo']." data-nombre='".$aRow["alm_nombre"]."' data-direccion='".$aRow["alm_direccion"]."' data-toggle='modal' data-target='#confirm-update'><span class='glyphicon glyphicon-pencil iconosDatatable'></span></a></td>";
		$row[] = "<td><a href='#'' data-codigo=".$aRow['alm_codigo']." data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash iconosDatatable'></span></a></td>";
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>