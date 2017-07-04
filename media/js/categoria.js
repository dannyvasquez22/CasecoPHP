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

    $('#confirm-insert').on('hidden.bs.modal', function(){ 
		$(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
	});

	$('#confirm-insert').on('show.bs.modal', function(e) {
		/*document.getElementById('nombre').setAttribute('autofocus', 'autofocus');*/
		$('#confirm-insert').on('click', '#btn-ingresar', function() {
			var name = $('#confirm-insert #nombre').val();
			var description = $('#confirm-insert #descripcion').val();
			/*alert(name);*/
			insert(name, description);
		});
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var nombre = button.data('nombre'); // Extraer la información de atributos de datos

		$('#confirm-delete').on('click', '#btn-eliminar', function() {
			remove(nombre);
		});

	});

	$('#confirm-update').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var nombre = button.data('nombre'); // Extraer la información de atributos de datos
		var descripcion = button.data('descripcion'); // Extraer la información de atributos de datos

		var modal = $(this);
		modal.find('.modal-content #nombre').val(nombre);
		modal.find('.modal-content #descripcion').val(descripcion);
		var reference = modal.find('.modal-content #nombre').val();

		$('#confirm-update').on('click', '#btn-modificar', function(){
			var name = $('#confirm-update #nombre').val();
			var description = $('#confirm-update #descripcion').val();
			modify(name, description, reference);
		});
	});

});

function modify(nombre, descripcion, referencia) {
    $.ajax({
        url: "../../controllers/categoria/update.php",
        type: "POST",
        data: "nombre="+nombre+"&descripcion="+descripcion+"&referencia="+referencia,
        success: function(resp){
    		if (resp) {
    			/*alert(resp);*/
    			$('#msg-modal #message').text('Elemento modificado');
    			$('#msg-modal').modal("show");
    			$('#confirm-update').modal("hide");
    			$('#tblCategoria').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de modificar el elemento');
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function remove(nombre) {
    $.ajax({
        url: "../../controllers/categoria/delete.php",
        type: "POST",
        data: "nombre="+nombre,
        success: function(resp){
    		if (resp) {
    			$('#msg-modal #message').text('Elemento eliminado');
    			$('#msg-modal').modal("show");
    			$('#confirm-delete').modal("hide");
    			$('#tblCategoria').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de eliminar el elemento');
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function insert(nombre, descripcion) {
	$.ajax({
		url: "../../controllers/categoria/create.php",
		type: "POST",
		data: "nombre="+nombre+"&descripcion="+descripcion,
		success: function(resp){
			if (resp) {
    			$('#msg-modal #message').text('Elemento insertado');
    			$('#msg-modal').modal("show");
    			$('#confirm-insert').modal("hide");
    			$('#tblCategoria').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de insertar el elemento');
    			$('#msg-modal').modal("show");
    		}
		}
	});
}