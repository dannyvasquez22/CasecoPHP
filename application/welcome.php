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
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<title>Learning 1.0</title>
	</head>
	
	<body>
		<div id="mySidenav" class="sidenav">
		  	<ul>
		  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  		<li><a href="#">Inicio</a></li>
		  		<li><a href="#">Productos</a></li>
		  		<li><a href="#">Clientes</a></li>
		  		<li><a href="#">Proveedores</a></li>
		  		<li class="activado"><a href="#">Unitarios</a>
	  				<ul>
				  		<li><a href="views/categoria/read.php">Categorias</a></li>
				  		<li><a href="#">aaa</a></li>
				  		<li><a href="#">bbb</a></li>
		  			</ul>
		  		</li>
		  		<li><a href="#">Calculadora</a></li>
		  	</ul>
		</div>

		<div id="main">
			<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menú</span>
			<h2><?php echo 'Bienvenido ' . $_SESSION['usuario']; ?></h2>
		</div>

		<script type="text/javascript">
			function openNav() {
			    document.getElementById("mySidenav").style.width = "250px";
			    document.getElementById("main").style.marginLeft = "250px";
			    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
			}

			function closeNav() {
			    document.getElementById("mySidenav").style.width = "0";
			    document.getElementById("main").style.marginLeft= "0";
			    document.body.style.backgroundColor = "white";
			}

			$(document).ready(function(){
				$('.sidenav ul li:has(ul)').click(function(e){					
					if ($(this).hasClass('activado')){
						$(this).removeClass('activado');
						$(this).children('ul').slideUp();
					} else {
						$('.sidenav ul li ul').slideUp();
						$('.sidenav ul li').removeClass('activado');
						$(this).addClass('activado');
						$(this).children('ul').slideDown();
					}
				});
				$('.sidenav ul li ul li a').click(function(){
					window.location.href = $(this).attr("href");
				});
			});
		</script> 
	</body>
</html>