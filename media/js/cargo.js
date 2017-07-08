$(document).ready(function(){
	$('#tblCargo tfoot th').each( function () {
    	var title = $(this).text();
    	if (title != "") {
    		$(this).html( '<input type="text"/>' );
    	}
	});

	var table = $('#tblCargo').DataTable({
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
			{ "orderable": false, "targets": 6 }, // Prohibe la ordanacion por eta columna
	    	{ "orderable": false, "targets": 7 } // Prohibe la ordanacion por eta columna
	  	],
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../../controllers/cargo/pagination_process.php"
	});

	$("#tblCargo_filter").css("display","none");  // ocultar busqueda global de datatable

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

    $('#confirm-insert').on('hidden.bs.modal', function(){ 
		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
	});

	$('#confirm-insert').on('show.bs.modal', function(e) {
		/*document.getElementById('nombre').setAttribute('autofocus', 'autofocus');*/
		$('#confirm-insert').on('click', '#btn-ingresar', function() {
			var name = $('#confirm-insert #nombre').val();
			var descripcion = $('#confirm-insert #descripcion').val();
			var sueldoMin = $('#confirm-insert #sueldoMin').val();
			var sueldoMax = $('#confirm-insert #sueldoMax').val();
			/*alert(name);*/
			insert(name, descripcion, sueldoMin, sueldoMax);
		});
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var nombre = button.data('nombre'); // Extraer la información de atributos de datos
		var estado = button.data('estado'); // Extraer la información de atributos de datos

		$('#confirm-delete').on('click', '#btn-eliminar', function() {
			remove(nombre, estado);
		});

	});

	$('#confirm-update').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var nombre = button.data('nombre'); // Extraer la información de atributos de datos
		var descripcion = button.data('descripcion'); // Extraer la información de atributos de datos
		var sueldoMin = button.data('sueldomin'); // Extraer la información de atributos de datos
		var sueldoMax = button.data('sueldomax'); // Extraer la información de atributos de datos

		var modal = $(this);
		modal.find('.modal-content #nombre').val(nombre);
		modal.find('.modal-content #descripcion').val(descripcion);		
		modal.find('.modal-content #sueldoMin').val(sueldoMin);
		modal.find('.modal-content #sueldoMax').val(sueldoMax);

		$('#confirm-update').on('click', '#btn-modificar', function(){
			var name = $('#confirm-update #nombre').val();
			var descripcion = $('#confirm-update #descripcion').val();
			var sueldoMin = $('#confirm-update #sueldoMin').val();
			var sueldoMax = $('#confirm-update #sueldoMax').val();

			modify(name, descripcion, sueldoMin, sueldoMax, nombre);
		});
	});

});

function modify(nombre, descripcion, sueldoMin, sueldoMax, referencia) {
    $.ajax({
        url: "../../controllers/cargo/update.php",
        type: "POST",
        data: "nombre="+nombre+"&descripcion="+descripcion+"&sueldoMin="+sueldoMin+"&sueldoMax="+sueldoMax+"&referencia="+referencia,
        success: function(resp){
    		if (resp) {
    			/*alert(resp);*/
    			$('#msg-modal #message').text('Elemento modificado');
    			$('#msg-modal').modal("show");
    			$('#confirm-update').modal("hide");
    			$('#tblCargo').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de modificar el elemento');
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function remove(nombre, estado) {
    $.ajax({
        url: "../../controllers/cargo/delete.php",
        type: "POST",
        data: "nombre="+nombre+"&estado="+estado,
        success: function(resp){
    		if (resp) {
    			if(estado == 'Activo') {
    				$('#msg-modal #message').text('Elemento eliminado'); 
    			} else {
    				$('#msg-modal #message').text('Elemento recuperado'); 
    			}
    			$('#msg-modal').modal("show");
    			$('#confirm-delete').modal("hide");
    			$('#tblCargo').DataTable().ajax.reload();
    		} else {
    			if (estado == 'Activo') {
    				$('#msg-modal #message').text('Ocurrio un problema al momento de eliminar el elemento');
    			} else {
    				$('#msg-modal #message').text('Ocurrio un problema al momento de recuperar el elemento');
    			}
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function insert(nombre, descripcion, sueldoMin, sueldoMax){
	$.ajax({
		url: "../../controllers/cargo/create.php",
		type: "POST",
		data: "nombre="+nombre+"&descripcion="+descripcion+"&sueldoMin="+sueldoMin+"&sueldoMax="+sueldoMax,
		success: function(resp){
			if (resp) {
				/*alert(resp);*/
    			$('#msg-modal #message').text('Elemento insertado');
    			$('#msg-modal').modal("show");
    			$('#confirm-insert').modal("hide");
    			$('#tblCargo').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de insertar el elemento');
    			$('#msg-modal').modal("show");
    		}
		}
	});
}

function msg(estado) {
	if (estado == 0) {
		$('#confirm-delete .modal-title').text('Recuperar registro');
		$('.modal-body').text('¿Desea recuperar el registro seleccionado?');
		$('#btn-eliminar').text('Recuperar');
	} else {
		$('#confirm-delete .modal-title').text('Eliminar registro');
		$('.modal-body').text('¿Desea eliminar el registro seleccionado?');
		$('#btn-eliminar').text('Eliminar');
	}
}