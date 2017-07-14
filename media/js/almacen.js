$(document).ready(function(){
	$('#tblAlmacen tfoot th').each( function () {
    	var title = $(this).text();
    	if (title != "") {
    		$(this).html( '<input type="text"/>' );
    	}
	});

	var table = $('#tblAlmacen').DataTable({
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
			{ "orderable": false, "targets": 3 }, // Prohibe la ordanacion por eta columna
	    	{ "orderable": false, "targets": 4 }, // Prohibe la ordanacion por eta columna
	    	{ "visible": false,  "targets": 0 } // Para ocultar una columna
	  	],
	  	"lengthMenu": [10, 20, 30, 40, 50],
	  	"iDisplayLength": 10,
	  	"pageResize": true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../../controllers/almacen/pagination_process.php"
	});

	$("#tblAlmacen_filter").css("display","none");  // ocultar busqueda global de datatable

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
			var direccion = $('#confirm-insert #direccion').val();
			/*alert(name);*/
			insert(name, direccion);
		});
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var codigo = button.data('codigo'); // Extraer la información de atributos de datos

		$('#confirm-delete').on('click', '#btn-eliminar', function() {
			remove(codigo);
		});

	});

	$('#confirm-update').on('show.bs.modal', function(e) {
		var button = $(e.relatedTarget); // Botón que activó el modal
		var codigo = button.data('codigo'); // Extraer la información de atributos de datos
		var nombre = button.data('nombre'); // Extraer la información de atributos de datos
		var direccion = button.data('direccion'); // Extraer la información de atributos de datos

		var modal = $(this);
		modal.find('.modal-content #nombre').val(nombre);
		modal.find('.modal-content #direccion').val(direccion);		

		$('#confirm-update').on('click', '#btn-modificar', function(){
			var name = $('#confirm-update #nombre').val();
			var direccion = $('#confirm-update #direccion').val();
			modify(name, direccion, codigo);
		});
	});

});

function modify(nombre, direccion, codigo) {
    $.ajax({
        url: "../../controllers/almacen/update.php",
        type: "POST",
        data: "nombre="+nombre+"&direccion="+direccion+"&codigo="+codigo,
        success: function(resp){
    		if (resp) {
    			/*alert(resp);*/
    			$('#msg-modal #message').text('Elemento modificado');
    			$('#msg-modal').modal("show");
    			$('#confirm-update').modal("hide");
    			$('#tblAlmacen').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de modificar el elemento');
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function remove(codigo) {
    $.ajax({
        url: "../../controllers/almacen/delete.php",
        type: "POST",
        data: "codigo="+codigo,
        success: function(resp){
    		if (resp) {
    			$('#msg-modal #message').text('Elemento eliminado');
    			$('#msg-modal').modal("show");
    			$('#confirm-delete').modal("hide");
    			$('#tblAlmacen').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de eliminar el elemento');
    			$('#msg-modal').modal("show");
    		}
        }       
    });
}

function insert(nombre, direccion) {
	$.ajax({
		url: "../../controllers/almacen/create.php",
		type: "POST",
		data: "nombre="+nombre+"&direccion="+direccion,
		success: function(resp){
			if (resp) {
				/*alert(resp);*/
    			$('#msg-modal #message').text('Elemento insertado');
    			$('#msg-modal').modal("show");
    			$('#confirm-insert').modal("hide");
    			$('#tblAlmacen').DataTable().ajax.reload();
    		} else {
    			$('#msg-modal #message').text('Ocurrio un problema al momento de insertar el elemento');
    			$('#msg-modal').modal("show");
    		}
		}
	});
}