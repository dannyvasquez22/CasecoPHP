<?php
	require 'controllers/config.php';
	
	$where = "";
	
	if(!empty($_POST)) {
		$valor = $_POST['campo'];
		if(!empty($valor)) {
			$where = "WHERE cate_nombre LIKE '$valor%'";
		}
	}
	$sql = "SELECT cate_nombre, cate_descripcion FROM categoria $where";
	$resultado = $mysqli->query($sql);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Proviene de boostrap para que sea responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<link href="css/jquery.dataTables.min.css" rel="stylesheet">	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<meta charset="utf-8">
	<title>Caseco 1.0</title>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tblCategoria').DataTable({
				"order": [[0, "asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
					"infoFiltered": "(filtrada de _MAX_ registros)",
					"loadingRecords": "Cargando...",
					"processing":     "Procesando...",
					"search": "Buscar:",
					"zeroRecords":    "No se encontraron registros coincidentes",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},					
				}
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
			<a href="views/categoria/create.php" class="btn btn-primary">Nuevo Registro</a>
			<br><br>
			<!-- Busqueda usando boton -->
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<b>Nombre: </b><input type="text" id="campo" name="campo" onKeyUp="buscar();"/>
				<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
			</form>
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
				
				<tbody>
					<?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
						<tr>
							<td><?php echo $row['cate_nombre']; ?></td>
							<td><?php echo $row['cate_descripcion']; ?></td>
							<td><a href="views/categoria/update.php?nombre=<?php echo $row['cate_nombre']; ?>&&descripcion=<?php echo $row['cate_descripcion'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="#" data-href="views/categoria/delete.php?nombre=<?php echo $row['cate_nombre']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
				</div>
				
				<div class="modal-body">
					¿Desea eliminar este registro?
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a class="btn btn-danger btn-ok">Delete</a>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
			
			$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});
	</script>
</body>
</html>