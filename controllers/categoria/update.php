<?php
	
/*	require '../config.php';
	
	$referencia = $_POST['referencia'];
	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';
	
	$sql = "UPDATE categoria SET cate_nombre='$nombre', cate_descripcion='$descripcion' WHERE cate_nombre = '$referencia'";
	$resultado = $mysqli->query($sql);
	echo $resultado;*/

	require_once '../../models/bl/categoriaBL.php';
	require_once '../../models/dto/categoria.php';

	$referencia = $_POST['referencia'];
	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$categoria = new Categoria($nombre, $descripcion);
	$result = CategoriaDAO::getInstance()->update($categoria, $referencia);
	echo $echo;
	
?>