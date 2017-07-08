<?php  
	require_once '../../models/bl/cargoBL.php';
	require_once '../../models/dto/cargo.php';

	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];

	if ($estado == 'Activo') {
		$estado = '0';
	} else {
		$estado = '1';
	}

	$cargo = new Cargo($nombre);
	$result = CargoBL::getInstance()->delete($cargo, $estado);
	echo $result;
?>