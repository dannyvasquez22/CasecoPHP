<?php  
	require_once '../../models/bl/marcaBL.php';
	require_once '../../models/dto/marca.php';

	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$marca = new Marca($nombre, $descripcion);
	$result = MarcaBL::getInstance()->insert($marca);
	echo $result;

?>