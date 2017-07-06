<?php  
	require_once '../../models/bl/almacenBL.php';
	require_once '../../models/dto/almacen.php';

	$nombre = $_POST['nombre'];
	$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '-';

	$almacen = new Almacen($nombre, $direccion);
	$result = AlmacenBL::getInstance()->insert($almacen);
	echo $result;
?>