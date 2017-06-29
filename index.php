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
			<form action="return false" onsubmit="return false" class="formulario" name="formulario_login" method="POST">
				<div>
					<div class="input-group">
						<input type="text" id="usuario" name="usuario" autofocus="true">
						<label class="label" for="usuario">Usuario:</label>
					</div>
					<div class="input-group">
						<input type="password" id="password" name="password">
						<label class="label" for="password">Contraseña:</label>
					</div>
					<div id="login-alert" class="msgError"></div>
					<input type="submit" id="btn-submit" value="Ingresar">
				</div>
			</form>			
		</div>
	</div>
	<script type="text/javascript" src="media/js/formularioLogin.js"></script>
</body>
</html>