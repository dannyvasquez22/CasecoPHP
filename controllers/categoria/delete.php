<?php
	
	require '../config.php';
 
	$nombre = $_POST['nombre'];
	$sql = "DELETE FROM categoria WHERE cate_nombre = '$nombre'";
	$resultado = $mysqli->query($sql);
	echo $resultado;
	
?>