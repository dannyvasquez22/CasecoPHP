<!DOCTYPE html>
<html lang="es">
<head>	
	<meta charset="utf-8">
	<title>Learning 1.0</title>
	<?php require_once('headLogin.php'); ?>
	<style type="text/css">
		.contenedor-formulario .formulario .msgError {
        font-family: "Roboto", Arial;
        font-size: 16px;
        color: red;
        width: 100%;
        outline: none;
        padding: 15px;
        background: none;
        border: none;
        border-bottom: 2px solid #BBDEFB; }
	</style>
</head>
<body>
	<div class="contenedor-formulario">    
		<div class="wrap">
			<!-- <form action="login.php" class="formulario" name="formulario_login" method="POST"> -->
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
					<input type="submit" id="btn-submit" value="Ingresar" onclick="messageError(document.getElementById('usuario').value, document.getElementById('password').value);">
				</div>
			</form>			
		</div>
	</div>
	<script type="text/javascript">
		function messageError(usuario, password) {
	        /*alert(usuario + ' - ' +password);*/
	        $.ajax({
	            url: "controllers/usuario/login.php",
	            type: "POST",
	            data: "usuario="+usuario+"&password="+password,
	            success: function(resp){
            		$('#login-alert').html(resp); 
	            }       
	        });
	    }
	</script>
	<script type="text/javascript" src="media/js/formularioLogin.js"></script>
</body>
</html>