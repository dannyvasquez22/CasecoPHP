<?php
	/*require '../config.php';*/
	require_once '../../models/database.php';
	
	/* Nombre de La Tabla */
	$sTabla = " cargo";
	
	/* Array que contiene los nombres de las columnas de la tabla*/
	$aColumnas = array('carg_nombre', 'carg_descripcion', 'carg_sueldoMin', 'carg_sueldoMax', 'carg_fechaCreacion', 'carg_estado');

	$aAColumnas = array('carg_nombre', 'carg_descripcion', 'carg_sueldoMin', 'carg_sueldoMax', "DATE_FORMAT(carg_fechaCreacion, '%d/%m/%Y')", "IF(carg_estado = 1, 'Activo', 'Inactivo')");
	
	/* columna indexada */
	$sIndexColumn = "carg_nombre";
	
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
			$sWhere .= $aColumnas[$i]." LIKE '".$_GET['sSearch']."%' OR ";
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
			$sWhere .= $aColumnas[$i]." LIKE '".$_GET['sSearch_'.$i]."%' ";
		}
	}
		
	//Obtener datos para mostrar SQL queries
	$sQuery = " SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aAColumnas))." FROM $sTabla $sWhere $sOrder $sLimit ";
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
		for ( $i=0 ; $i<count($aAColumnas) ; $i++ ) {
			$row[] = $aRow[ $aAColumnas[$i] ];
		}

		$row[] = "<td><a href='#'' data-nombre='".$aRow['carg_nombre']."' data-descripcion='".$aRow["carg_descripcion"]."' data-sueldomin='".$aRow["carg_sueldoMin"]."' data-sueldomax='".$aRow["carg_sueldoMax"]."' data-estado='".$aRow["IF(carg_estado = 1, 'Activo', 'Inactivo')"]."' data-toggle='modal' data-target='#confirm-update'><span class='glyphicon glyphicon-pencil iconosDatatable'></span></a></td>";
		if ($aRow["IF(carg_estado = 1, 'Activo', 'Inactivo')"] == 1 || $aRow["IF(carg_estado = 1, 'Activo', 'Inactivo')"] == 'Activo') {
			$row[] = "<td><a href='#'' data-nombre='".$aRow['carg_nombre']."' data-estado='".$aRow["IF(carg_estado = 1, 'Activo', 'Inactivo')"]."' data-toggle='modal' data-target='#confirm-delete' onclick='msg(1);'><span class='glyphicon glyphicon-trash iconosDatatable'></span></a></td>"; 
		} else {
			$row[] = "<td><a href='#'' data-nombre='".$aRow['carg_nombre']."' data-estado='".$aRow["IF(carg_estado = 1, 'Activo', 'Inactivo')"]."' data-toggle='modal' data-target='#confirm-delete' onclick='msg(0);'><span class='glyphicon glyphicon-share-alt iconosDatatable'></span></a></td>"; 
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>