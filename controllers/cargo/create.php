<?php  
	require_once '../../models/bl/cargoBL.php';
	require_once '../../models/dto/cargo.php';

	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';
	$sueldoMin = isset($_POST['sueldoMin']) ? $_POST['sueldoMin'] : '0.00';
	$sueldoMax = isset($_POST['sueldoMax']) ? $_POST['sueldoMax'] : '0.00';
	$fechaCreacion = date("Y-m-d");

	$cargo = new Cargo($nombre, $descripcion, $fechaCreacion, $sueldoMin, $sueldoMax, 1);
	$result = CargoBL::getInstance()->insert($cargo);
	echo $result;
?>