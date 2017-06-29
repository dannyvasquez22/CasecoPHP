<?php
	require '../config.php';
	
	/* Nombre de La Tabla */
	$sTabla = " categoria";
	
	/* Array que contiene los nombres de las columnas de la tabla*/
	$aColumnas = array('cate_nombre', 'cate_descripcion');
	
	/* columna indexada */
	$sIndexColumn = "cate_nombre";
	
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
	$rResult = $mysqli->query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = " SELECT FOUND_ROWS()	";
	$rResultFilterTotal = $mysqli->query($sQuery);
	$aResultFilterTotal = $rResultFilterTotal->fetch_array();
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = " SELECT COUNT(".$sIndexColumn.")	FROM $sTabla ";
	$rResultTotal = $mysqli->query($sQuery);
	$aResultTotal = $rResultTotal->fetch_array();
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
	
	while ( $aRow = $rResult->fetch_array()) {
		$row = array();
		for ( $i=0 ; $i<count($aColumnas) ; $i++ ) {
			$row[] = ($aRow[ $aColumnas[$i] ]=="0") ? '-' : $aRow[ $aColumnas[$i] ];
		}
		
/*		<td>
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $row['id']?>" data-codigo="<?php echo $row['countryCode']?>" data-nombre="<?php echo $row['countryName']?>" data-moneda="<?php echo $row['currencyCode']?>" data-capital="<?php echo $row['capital']?>" data-continente="<?php echo $row['continentName']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
		</td>*/
		
		$row[] = "<td><a href='../../views/categoria/update.php?nombre=".$aRow['cate_nombre']."&&descripcion=".$aRow['cate_descripcion']."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
		$row[] = "<td><a href='#'' data-nombre=".$aRow['cate_nombre']." data-descripcion=".$aRow['cate_descripcion']." data-toggle='modal' data-target='#confirm-update'><span class='glyphicon glyphicon-pencil'></span></a></td>";
		$row[] = "<td><a href='#'' data-href='../../views/categoria/delete.php?nombre=".$aRow['cate_nombre']."' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash'></span></a></td>";
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>