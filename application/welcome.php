<?php
	session_start();
	require 'controllers/config.php';
	
	if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$usuario = $_SESSION['usuario'];
?>
 
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/menu-principal.css">
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
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
					  		<li><a href="#">aaa</a></li>
					  		<li><a href="#">bbb</a></li>					
					</ul>
				</li>
				<li><a href="#">Contacto</a></li>
			</ul>
		</nav>

		<header>
			<h1>Menú vertical</h1> 
		</header>
		<article><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus nostrum totam libero perferendis non, mollitia! Eaque at perspiciatis vitae repudiandae quam distinctio cum incidunt laboriosam, odit alias animi, similique enim.</p></article>
		<footer>
			Hecho por Danny Vasquez
		</footer>
		<script type="text/javascript" src="js/mostrar-nav.js"></script>
	</body>
</html>