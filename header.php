<?php require_once 'models/routes.php'; ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="media/css/menu-principal.css"> -->
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/sidebar.css">
		<!-- <link rel="stylesheet" type="text/css" href="/media/css/bootstrap-theme.css"> -->
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/myDatatable.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/animate.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA; ?>/media/css/font-awesome.css">
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/sidebar.js" async="async"></script>
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/tether.min.js"></script>
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo RUTA; ?>/media/js/dataTables.fixedColumns.min.js"></script>
		<!-- Malogra la busqueda TMR -->
		<!-- <script type="text/javascript" src="<?php echo RUTA; ?>/media/js/dataTables.pageResize.min.js"></script> -->
		<meta charset="utf-8">
		<title>Learning 1.0</title>
	</head>
	
	<body>
	    <div id="wrapper">
	        <div class="overlay"></div>
	    	<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">		<!-- Sidebar -->
	            <ul class="nav sidebar-nav">
	                <li class="sidebar-brand"><a href="#">Menu Principal</a></li>
	                <li><a href="<?php echo RUTA; ?>/welcome.php"><i class="fa fa-fw fa-home"></i>Inicio</a></li>
	                <li><a href="#"><i class="fa fa-fw fa-dropbox"></i>Productos</a></li>
	                <li><a href="#"><i class="fa fa-fw fa-folder"></i>Clientes</a></li>
	                <li><a href="#"><i class="fa fa-fw fa-bank"></i>Proveedores</a></li>
	                <li class="dropdown">
	                  	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Unitarios <span class="caret"></span></a>
	                  	<ul class="dropdown-menu" role="menu">
	                    	<li class="dropdown-header">Elementos:</li>
	                    	<li><a href="<?php echo RUTA; ?>/views/almacen/read.php">Almacenes</a></li>
	                    	<li><a href="<?php echo RUTA; ?>/views/cargo/read.php">Cargos</a></li>
					  		<li><a href="<?php echo RUTA; ?>/views/marca/read.php">Marcas</a></li>
	                    	<li><a href="<?php echo RUTA; ?>/views/categoria/read.php">Categorias</a></li>
	                    	<li><a href="<?php echo RUTA; ?>/views/unidadMedida/read.php">Unidades de Medida</a></li>
	                    	<li><a href="<?php echo RUTA; ?>/views/tienda/read.php">Tiendas</a></li>
	                    	<li><a href="<?php echo RUTA; ?>/views/vehiculo/read.php">Vehículos</a></li>
	                  	</ul>
	                </li>
	                <!-- <li><a href="#"><i class="fa fa-fw fa-file-o"></i> Page four</a></li> -->
	                <!-- <li><a href="#"><i class="fa fa-fw fa-dropbox"></i> Page 5</a></li> -->
	                <li><a href="#"><i class="fa fa-fw fa-twitter"></i>Contacto</a></li>
	                <li><a href="#"><i class="fa fa-fw fa-cog"></i>Configuración</a></li>
	                <li><a href="<?php echo RUTA; ?>/controllers/usuario/logout.php"><i class="fa fa-fw fa-sign-out"></i>Cerrar sesión</a></li>
	            </ul>
	        </nav>       <!-- /#sidebar-wrapper -->
	        
	        <div id="page-content-wrapper">		<!-- Page Content -->
				<button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
					<span class="hamb-top"></span>
					<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
				</button>