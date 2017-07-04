<?php
	require_once '../../models/bl/marcaBL.php';
	require_once '../../models/dto/marca.php';

	$referencia = $_POST['referencia'];
	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$marca = new Marca($nombre, $descripcion);
	$result = MarcaDAO::getInstance()->update($marca, $referencia);
	echo $echo;
	
?>