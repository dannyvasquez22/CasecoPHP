<?php
	require '../../controllers/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Proviene de boostrap para que sea responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../media/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../media/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../../media/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="../../media/css/myDatatable.css">
	<script type="text/javascript" src="../../media/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../media/js/tether.min.js"></script>
	<script type="text/javascript" src="../../media/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../../media/js/dataTables.fixedColumns.min.js"></script>
	<meta charset="utf-8">
	<title>Learning 1.0</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2 style="text-align:center">Categorias</h2>
		</div>

		<div class="row">
			<a hhref='#' class="btn btn-primary" data-toggle='modal' data-target='#confirm-insert'>Nuevo Registro</a>
			<a href="../../welcome.php" class="btn btn-primary">Regresar</a>
		</div>

		<br><br>

		<div class="row table-responsive">
			<table class="display" id="tblCategoria">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
				<tbody>
					
				</tbody>			
			</table>
		</div>
	</div>

	<!-- Insert Modal -->
	<div class="modal fade" id="confirm-insert" tabindex="-1" role="dialog" aria-labelledby="InsertModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="row">
					<h3 style="text-align:center">NUEVO REGISTRO</h3>
				</div>
				
				<form class="form-horizontal" method="POST" action="return false" onsubmit="return false" autocomplete="off">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" required>
						</div>
					</div>
										
					<div class="form-group">
						<label for="descripcion" class="col-sm-3 control-label">Descripción</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" value="">
						</div>
					</div>
									
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="btn-ingresar" type="submit" class="btn btn-primary">Ingresar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Delete Modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="DeleteModal">Eliminar Registro</h4>
				</div>
				
				<div class="modal-body">
					¿Desea eliminar este registro?
				</div>
				
				<div class="modal-footer">
					<form class="form-horizontal" method="POST" action="return false" onsubmit="return false" autocomplete="off">
						<button id="btn-eliminar" type="submit" class="btn btn-danger btn-ok">Eliminar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Update Modal -->
	<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="UpdateModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="row">
					<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
				</div>
				
				<!-- <form class="form-horizontal" method="POST" action="../../controllers/categoria/update.php" autocomplete="off"> -->
				<form class="form-horizontal" method="POST" action="return false" onsubmit="return false" autocomplete="off">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" required>
						</div>
					</div>
										
					<div class="form-group">
						<label for="descripcion" class="col-sm-3 control-label">Descripción</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" value="">
						</div>
					</div>
									
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="btn-modificar" type="submit" class="btn btn-primary">Modificar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="msg-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title" id="message">X</h4>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-o" data-dismiss="modal">Aceptar</button>
		        </div>
	      	</div>
	    </div>
   	</div>

	<script src="../../media/js/categoria.js"></script>
</body>
</html>