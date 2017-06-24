<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Proviene de boostrap para que sea responsive -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">
		<script src="../../js/tether.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		<title>Caseco 1.0</title>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="../../controllers/categoria/update.php" autocomplete="off">
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $_GET['nombre']; ?>" required>
					</div>
				</div>
				
				<input type="hidden" id="referencia" name="referencia" value="<?php echo $_GET['nombre']; ?>" />
				
				<div class="form-group">
					<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
					<div class="col-sm-4">
						<input type="test" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" value="<?php echo $_GET['descripcion']; ?>" required>
					</div>
				</div>
								
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<a href="../../index.php" class="btn btn-default">Regresar</a>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>