<?php
	require '../../controllers/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Proviene de boostrap para que sea responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">
	<link href="../../css/jquery.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/my.css">
	<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
	<script src="../../js/tether.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.dataTables.min.js"></script>
	<script src="../../js/dataTables.fixedColumns.min.js"></script>
	<meta charset="utf-8">
	<title>Caseco 1.0</title>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tblCategoria tfoot th').each( function () {
	        	var title = $(this).text();
	        	if (title != "") {
	        		$(this).html( '<input type="text" placeholder="Escriba '+title+'" />' );
	        	}
	    	});

			var table = $('#tblCategoria').DataTable({
				"order": [[0, "asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por página",
					"info": "Mostrando página _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles.",
					"infoFiltered": "(filtrada de _MAX_ registros)",
					"loadingRecords": "Cargando ...",
					"processing":     "Procesando ...",
					"search": "Búsqueda global:",
					"zeroRecords":    "No se encontraron registros.",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},					
				},
				"columnDefs": [
					{ "orderable": false, "targets": 2},
			    	{ "orderable": false, "targets": 3 }
			  	],
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "../../controllers/categoria/pagination_process.php"
			});

			table.columns().every( function () {
		        var that = this;
		 
		        $( 'input', this.footer() ).on( 'keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        });
		    });
		});
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2 style="text-align:center">Categorias</h2>
		</div>

		<div class="row">
			<a href="../../views/categoria/create.php" class="btn btn-primary">Nuevo Registro</a>
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
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
				<tbody>
					
				</tbody>			
			</table>
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
					<a class="btn btn-danger btn-ok">Eliminar</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
				<!-- $('#tblPacientes').DataTable().ajax.reload(); -->
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
				
				<form class="form-horizontal" method="POST" action="update.php" autocomplete="off">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" required>
						</div>
					</div>
					
					<input type="hidden" id="referencia" name="referencia" value="" />
					
					<div class="form-group">
						<label for="descripcion" class="col-sm-3 control-label">Descripción</label>
						<div class="col-sm-8">
							<input type="test" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" value="">
						</div>
					</div>
									
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button type="submit" class="btn btn-primary">Modificar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			
			$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});

		$('#confirm-update').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

			var button = $(e.relatedTarget); // Botón que activó el modal
			var nombre = button.data('nombre'); // Extraer la información de atributos de datos
			var descripcion = button.data('descripcion'); // Extraer la información de atributos de datos

			var modal = $(this);
			modal.find('.modal-content #nombre').val(nombre);
			modal.find('.modal-content #referencia').val(nombre);
			modal.find('.modal-content #descripcion').val(descripcion);
			
			$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});
	</script>
</body>
</html>