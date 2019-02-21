var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(true);
	listar();


	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	})

	//Cargamos los items al select categoria
	$.post("../ajax/devolucion.php?op=selectVendedor", function (r) {
		$("#cod_ven").html(r);
		$('#cod_ven').selectpicker('refresh');

	});

	//Cargamos los items al select categoria
	$.post("../ajax/devolucion.php?op=selectAlmacen", function (r) {
		$("#cod_alm").html(r);
		$('#cod_alm').selectpicker('refresh');

    });
    
}






//Función limpiar
function limpiar() {
	$("#articulo").val("");
	$("#articulo").focus();
}

//Función para desactivar registros
function limpiarNulos() {
	$.post("../ajax/devolucion.php?op=limpiarNulos", function (e) {

		tabla.ajax.reload();
	});

}


//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		//$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		//$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform() {
	limpiar();


	$("#num_mov").val("");


	$("#cod_ven").val("0");
	$('#cod_ven').selectpicker('refresh');



	$("#cod_alm").val("0");
	$('#cod_alm').selectpicker('refresh');

	$("#cod_cli").val("");

}

//Función Listar
function listar() {
	var num_mov = $("#num_mov").val();

	tabla = $('#tbllistado').dataTable({
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax": {
			url: '../ajax/devolucion.php?op=listarProd',
			data: {
				num_mov: num_mov
			},
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20, //Paginación
		"order": [
			[0, "desc"]
		] //Ordenar (columna,orden)
	}).DataTable();
}


//Función para guardar o editar

function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/devolucion.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			//bootbox.alert(datos);	          
			//mostrarform(false);
			//TODO:aqui se podria cargar los datos
			tabla.ajax.reload();
		}

	});
	limpiar();

}




init();