<?php  
/*	require '../config.php';

	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$sql = "INSERT INTO categoria (cate_nombre, cate_descripcion) VALUES ('$nombre', '$descripcion')";
	$result = $mysqli->query($sql);
	echo $result;*/

	require_once '../../models/bl/categoriaBL.php';
	require_once '../../models/dto/categoria.php';

	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$categoria = new Categoria($nombre, $descripcion);
	$result = CategoriaBL::getInstance()->insert($categoria);
	echo $result;
?>