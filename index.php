<!DOCTYPE html>
<html lang="es">
<head>	
	<meta charset="utf-8">
	<title>Learning 1.0</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="media/css/estiloSASS.css">
	<link rel="icon" type="image/x-icon" href="media/css/Favicon-blue-fedora/favicon.ico">
	<script type="text/javascript" src="media/js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="contenedor-formulario">    
		<div class="wrap">
			<form action="return false" onsubmit="return false" class="formulario" name="formulario_login" method="POST">
				<div>
					<div class="input-group">
						<input type="text" id="usuario" name="usuario">
						<label class="label" for="usuario">Usuario:</label>
					</div>
					<div class="input-group">
						<input type="password" id="password" name="password">
						<label class="label" for="password">Contraseña:</label>
					</div>
					<div id="login-alert" class="msgError"></div>
					<input type="submit" id="btn-submit" value="Iniciar sesión">
				</div>
			</form>			
		</div>
	</div>
	<div class="fondo">	</div>
	<script type="text/javascript" src="media/js/formularioLogin.js"></script>
</body>
</html>