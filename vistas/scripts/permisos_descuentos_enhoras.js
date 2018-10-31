var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});

	$.post("../ajax/permisos_descuentos_enhoras.php?op=colores&id=", function (r) {
		$("#colores").html(r);
	});



}

//Función limpiar
function limpiar() {


	$("#empresa").val("1");
	$('#empresa').selectpicker('refresh');
	$("#cod_mod").val("0");
	$('#cod_mod').selectpicker('refresh');
	$("#color_mod").val("");
	$("#tallas_mod").val("");
	$("#id_trab").val("0");
	$('#id_trab').selectpicker('refresh');
	$("#div_mod").val("");
	$("#temp_mod").val("");
	$("#dest_mod").val("");


	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear() + "-" + (month) + "-" + (day);
	$('#fecha_hora').val(today);
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform() {
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar() {
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
			url: '../ajax/permisos_descuentos_enhoras.php?op=listar',
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
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/permisos_descuentos_enhoras.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

function mostrar(id_cp) {
	

	$.post("../ajax/permisos_descuentos_enhoras?op=mostrar",{id_cp : id_cp}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

	

	

		$("#id_cp").val(data.id_cp);

	

		

	});

	$.post("../ajax/permisos_descuentos_enhoras.php?op=colores&id=" + id_cp, function (r) {
		$("#colores").html(r);
	});
}


//Función para anular registros
function rechazar(idmft) {
	bootbox.confirm("¿Está Seguro de rechazar la FT?", function (result) {
		if (result) {
			$.post("../ajax/permisos_descuentos_enhoras.php?op=rechazar", {
				idmft: idmft
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para anular registros
function aprobar(idmft, idusuario) {
	bootbox.confirm("¿Está Seguro de aprobar la FT?", function (result) {
		if (result) {
			$.post("../ajax/permisos_descuentos_enhoras.php?op=aprobar", {
				idmft: idmft
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para anular registros
function eliminar(idmft) {
	bootbox.confirm("¿Está Seguro de eliminar la FT?", function (result) {
		if (result) {
			$.post("../ajax/permisos_descuentos_enhoras.php?op=eliminar", {
				idmft: idmft
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();
