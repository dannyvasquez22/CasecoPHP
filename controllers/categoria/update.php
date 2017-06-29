<?php
	
	require '../config.php';
	
	$referencia = $_POST['referencia'];
	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';
	
	$sql = "UPDATE categoria SET cate_nombre='$nombre', cate_descripcion='$descripcion' WHERE cate_nombre = '$referencia'";
	$resultado = $mysqli->query($sql);
	echo $resultado;
	
?>