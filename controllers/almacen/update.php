<?php
	require_once '../../models/bl/almacenBL.php';
	require_once '../../models/dto/almacen.php';

	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '-';

	$almacen = new Almacen($codigo, $nombre, $direccion);
	$result = AlmacenDAO::getInstance()->update($almacen);
	echo $echo;
	
?>