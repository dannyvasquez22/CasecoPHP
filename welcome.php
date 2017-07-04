<?php
	session_start();
	require 'controllers/config.php';

/*	$usuario = $_SESSION["usuario"];

	if(!isset($_SESSION["usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}	*/
	
?>
 
<?php require_once 'header.php'; ?>
				<div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <h1 class="page-header">Bienvenido</h1>  
	                        <p class="lead">En el lado derecho podrá desplegar un menú vertical con todas las opciones disponibles para el administrador.</p>
	                    </div>
	            	</div>
	            </div>
	        </div>        <!-- /#page-content-wrapper -->

	    </div>    <!-- /#wrapper -->
<?php require_once 'footer.php'; ?>