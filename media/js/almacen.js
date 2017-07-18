$(document).ready(function(){
	var fecha = new Date();

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
	  	"lengthMenu": [[ 10, 20, 30, 40, 50, -1],  [ '10', '20', '30', '40', '50', 'Todos' ]],
	  	"iDisplayLength": 10,
	  	"pageResize": true,
        "responsive": true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../../controllers/almacen/pagination_process.php",
		/*"dom": '<"toolbar">frtip',*/
		"dom": 'Bfrtip', 
        "buttons": [
            {
                extend: 'pageLength'
                /*,text: "Mostrar buttons.pageLength filas"*/ //da error al cambiar de valor
            }, 
            {
                extend: 'copy',
                text: 'Copiar'
            }, 
            {
            	extend: 'csv',
            	title: 'Almacenes_' + fecha.getDate() + "_" + (fecha.getMonth() + 1) + "_" + fecha.getFullYear()
            },
            {
            	extend: 'excel',
            	customize: function( xlsx ) {
	                var sheet = xlsx.xl.worksheets['sheet1.xml'];
	 
	                $('row c[r^="B"]', sheet).attr( 's', '2' ); //hacer negrita una columna completa --> B significa la columna con el valor alfabetico propio de excel
	                $('row c[r*="2"]', sheet).attr( 's', '25' ); // borders a una celda --> el 2  especifica la fila empezando a contar desde el titulo como 0
	            },
            	title: 'Almacenes_' + fecha.getDate() + "_" + (fecha.getMonth() + 1) + "_" + fecha.getFullYear()
            },
            {
            	extend: 'pdf',
            	exportOptions: {
                    //columns: ':visible' // solo las columnas visibles
                    //columns: [ 0, ':visible' ] //la columna cero y todas las visibles
                    columns: [ 1, 2 ] //columnas especificas
                },
                /*customize: function ( doc ) { // para agregar imagenes, aun con errores tmr
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: '../images/menu3.png'
                    } );
                },*/
            	title: 'Almacenes_' + fecha.getDate() + "_" + (fecha.getMonth() + 1) + "_" + fecha.getFullYear(),
            	message: 'PDF creado con PDFMake y botones para DataTables.'
            	/*orientation: 'landscape', // estilos de la pagina
                pageSize: 'LEGAL'*/
            },
            {
                text: 'JSON',
                action: function ( e, dt, button, config ) {
                    var data = dt.buttons.exportData();
 
                    $.fn.dataTable.fileSave(
                        new Blob( [ JSON.stringify( data ) ] ),
                        'Almacenes_' + fecha.getDate() + "_" + (fecha.getMonth() + 1) + "_" + fecha.getFullYear() + '.json'
                    );
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                message: 'La impresión se logro gracias a el botón Print para DataTables',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: 'Columnas visibles',
                columns: [ 0, 1, 2 ]
            }            
        ]
	});

    //le quitamos la clase por defecto que toman los botones del datatable y le asignamos una creada por nosotros
    $('.dt-buttons>a').removeClass();
    $('.dt-buttons>a').addClass('btn btn-primary btnExternalDatatable');

	$("#tblAlmacen_filter").css("display","none");  // ocultar busqueda global de datatable

	/*$("div.toolbar").html('<b>Aquí se encuentran todos los almacénes registrados hasta el momento.</b>');*/

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