var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(true);
	listar();


	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	})

	//Cargamos los items al select categoria
	$.post("../ajax/produccion.php?op=selectTaller", function (r) {
		$("#cod_taller").html(r);
		$('#cod_taller').selectpicker('refresh');

	});

	//Cargamos los items al select categoria
	$.post("../ajax/produccion.php?op=selectAlmacen", function (r) {
		$("#cod_alm").html(r);
		$('#cod_alm').selectpicker('refresh');

	});
}

//Función limpiar
function limpiar() {
	$("#articulo").val("");
	$("#articulo").focus();



	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear() + "-" + (month) + "-" + (day);
	$('#fecha_hora').val(today);


}

//Función para desactivar registros
function limpiarNulos() {
	$.post("../ajax/produccion.php?op=limpiarNulos", function (e) {

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


	$("#cod_taller").val("0");
	$('#cod_taller').selectpicker('refresh');



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
			url: '../ajax/produccion.php?op=listarProd',
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
		url: "../ajax/produccion.php?op=guardaryeditar",
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