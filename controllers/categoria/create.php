<?php  
	require '../config.php';

	$nombre = $_POST['nombre'];
	$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '-';

	$sql = "INSERT INTO categoria (cate_nombre, cate_descripcion) VALUES ('$nombre', '$descripcion')";
	$result = $mysqli->query($sql);
	echo $result;
?>