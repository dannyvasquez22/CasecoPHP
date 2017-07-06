<?php
	require_once 'models/routes.php';

	session_start();

	if (!isset($_SESSION['usuario'])) {
		header('Location: ' . RUTA);
	}
?>
 
<?php require_once 'header.php'; ?>
				<div class="container">
	                <div class="row">
	                    <div class="col-lg-8 col-lg-offset-2">
	                        <h1 class="page-header">Bienvenido: <?php echo $_SESSION['usuario'];?></h1>  
	                        <p class="lead">En el lado derecho podrá desplegar un menú vertical con todas las opciones disponibles para el administrador.</p>
	                    </div>
	            	</div>
	            </div>
	        </div>        <!-- /#page-content-wrapper -->

	    </div>    <!-- /#wrapper -->
<?php require_once 'footer.php'; ?>