<?php
	
	require '../../controllers/config.php';
 
	$nombre = $_GET['nombre'];
	
	$sql = "DELETE FROM categoria WHERE cate_nombre = '$nombre'";
	$resultado = $mysqli->query($sql);
	
?>
 
<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Proviene de boostrap para que sea responsive -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">
		<script src="../../js/tether.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<title>Caseco 1.0</title>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
				<?php if($resultado) { ?>
				<h3>REGISTRO ELIMINADO</h3>
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php } ?>
				
				<a href="../../index.php" class="btn btn-primary">Regresar</a>
				
				</div>
			</div>
		</div>
	</body>
</html>