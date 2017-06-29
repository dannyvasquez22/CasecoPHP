<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Proviene de boostrap para que sea responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../media/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../media/css/bootstrap-theme.css">
	<script src="../../media/js/tether.min.js"></script>
	<script type="text/javascript" src="../../media/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../media/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Caseco 1.0</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3 style="text-align:center">NUEVO REGISTRO</h3>
		</div>

		<form class="form-horizontal" method="POST" action="../../controllers/categoria/create.php" autocomplete="off">
			<div class="form-group">
				<label for="nombre" class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aquí el nombre de la categoría." required>
				</div>
			</div>
			<div class="form-group">
				<label for="descripcion" class="col-sm-2 control-label">Descripción</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Escribe aquí la descripción de la categoría.">
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