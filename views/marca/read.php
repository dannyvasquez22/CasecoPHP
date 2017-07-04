<?php require_once '../../header.php'; ?>
	<div class="container">
		<div class="row">
			<h2 style="text-align:center">Marcas</h2>
		</div>

		<div class="row">
			<a hhref='#' class="btn btn-primary btnExternalDatatable" data-toggle='modal' data-target='#confirm-insert'>Nuevo Registro</a>
			<a href="../../welcome.php" class="btn btn-primary btnExternalDatatable">Regresar</a>
		</div>

		<br><br>

		<div class="row table-responsive">
			<table class="display" id="tblMarca">
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
					<h3 class="tituloh3">NUEVO REGISTRO</h3>
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
					<h4 class="modal-title tituloh3" id="DeleteModal">Eliminar Registro</h4>
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
					<h3 class="tituloh3">MODIFICAR REGISTRO</h3>
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
		          <h4 class="modal-title texto" id="message">X</h4>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-ok" data-dismiss="modal">Aceptar</button>
		        </div>
	      	</div>
	    </div>
   	</div>

	</div>        <!-- /#page-content-wrapper -->

	    </div>    <!-- /#wrapper -->
	<script src="../../media/js/marca.js"></script>

<?php require_once '../../footer.php'; ?>