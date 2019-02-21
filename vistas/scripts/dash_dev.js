var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});


}

//Función limpiar
function limpiar() {
	$("#idcliente").val("");
	$("#cliente").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#impuesto").val("0");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");


}

//Función mostrar formulario
function mostrarform(flag) {
	//limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#grafico").hide();
		$("#formularioDetalle").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles = 0;
	} else {
		$("#listadoregistros").show();
		$("#grafico").show();
		$("#formularioDetalle").hide();
		$("#btnagregar").show();
	}
}


//Función cancelarform
function cancelarform() {
	limpiar();
	mostrarform(false);
	listar()
}

//Función Listar
function listar() {
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

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
			url: '../ajax/devolucion.php?op=listarDoc',
			data: {
				fecha_inicio: fecha_inicio,
				fecha_fin: fecha_fin
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


function mostrar(num_mov) {
	$.post("../ajax/devolucion.php?op=mostrar", {
		num_mov: num_mov
	}, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);


		$("#cod_mov").val(data.cod_mov);
		$("#cantidad").val(data.cantidad);
		$("#nom_ing").val(data.nom_ing);
		$("#nom_apro").val(data.nom_apro);
		$("#fecha").val(data.fecha);

		$("#cod_cli").val(data.cod_cli);
		$("#nom_cli").val(data.nom_cli);
		$("#cod_ven").val(data.cod_ven);

		$("#nom_ven").val(data.nom_ven);

		$("#cant_primera").val(data.cant_primera);
		$("#cant_segunda").val(data.cant_segunda);



		$("#num_mov").val(data.num_mov);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
	});

	$.post("../ajax/devolucion.php?op=listarDetalle&id=" + num_mov, function (r) {
		$("#detalles").html(r);
	});
}

//Función para anular registros
function aprobar(num_mov,cod_alm) {
	bootbox.confirm("¿Está Seguro de aprobar el documento?", function (result) {
		if (result) {
			$.post("../ajax/devolucion.php?op=aprobar", {
				num_mov: num_mov,
				cod_alm: cod_alm
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para anular registros
function rechazar(num_mov,cod_alm) {
	bootbox.confirm("¿Está Seguro de rechazar el documento?", function (result) {
		if (result) {
			$.post("../ajax/devolucion.php?op=rechazar", {
				num_mov: num_mov,
				cod_alm: cod_alm
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}



init();
