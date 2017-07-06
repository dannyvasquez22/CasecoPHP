<?php
	require_once '../../models/bl/categoriaBL.php';
	require_once '../../models/dto/categoria.php';

	$referencia = $_POST['referencia'];
	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$categoria = new Categoria($nombre, $descripcion);
	$result = CategoriaDAO::getInstance()->update($categoria, $referencia);
	echo $echo;
	
?>