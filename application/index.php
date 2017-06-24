<?php
	require 'controllers/config.php';
	include 'controllers/commons/funciones.php';

	session_start(); //Iniciar una nueva sesión o reanudar la existente
	
	if(isset($_SESSION["id_usuario"])) { //En caso de existir la sesión redireccionamos
		header("Location: welcome.php");
	}
	
	$errors = array();
	
	if(!empty($_POST)) {
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password)) {
			$errors[] = "Debe llenar todos los campos";
		}

		$errors[] = login($usuario, $password);	
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>	
	<meta charset="utf-8">
	<title>Learning 1.0</title>
	<?php require_once('headLogin.php'); ?>
</head>
<body>
	<div class="contenedor-formulario">    
		<div class="wrap">
			<form action="" class="formulario" name="formulario_login" method="POST">
				<div>
					<div class="input-group">
						<input type="text" id="usuario" name="usuario" autofocus="true">
						<label class="label" for="usuario">Usuario:</label>
					</div>
					<div class="input-group">
						<input type="password" id="password" name="password">
						<label class="label" for="password">Contraseña:</label>
					</div>
					<input type="submit" id="btn-submit" value="Ingresar">
				</div>
			</form>			
		</div>
	</div>

	<script type="text/javascript" src="js/formularioLogin.js"></script>
</body>
</html>