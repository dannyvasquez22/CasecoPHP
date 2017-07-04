<?php
	session_start();
	require 'controllers/config.php';

/*	$usuario = $_SESSION["usuario"];

	if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}	*/
	
?>
 
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="media/css/menu-principal.css">
		<script type="text/javascript" src="media/js/jquery-3.2.1.min.js"></script>
		<title>Learning 1.0</title>
	</head>
	
	<body>
		<div id="mostrar-nav"></div>
		<nav>
			<ul class="menu">
				<li><a href="#">Inicio</a></li>
				<li><a href="#">Productos</a></li>
				<li><a href="#">Clientes</a></li>
				<li><a href="#">Proveedores</a></li>
				<li><a href="#">Unitarios</a>
					<ul>
					  		<li><a href="views/categoria/read.php">Categorias</a></li>
					  		<li><a href="views/marca/read.php">Marcas</a></li>
					  		<li><a href="#">bbb</a></li>					
					</ul>
				</li>
				<li><a href="#">Contacto</a></li>
			</ul>
		</nav>

		<header>
			<h1>Menú Principal</h1> 
		</header>
		<article><p>En el lado derecha podrá desplegar un menú vertical con todas las opciones disponibles para el administrador.</p></article>
		<footer>
			Hecho por Danny Vasquez
		</footer>
		<script type="text/javascript" src="media/js/mostrar-nav.js"></script>
	</body>
</html>