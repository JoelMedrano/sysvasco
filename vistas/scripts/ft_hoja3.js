var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});
	//Cargamos los items al select cliente
	$.post("../ajax/ft_hoja3.php?op=combos", function (r) {
		$("#idmft_color").html(r);
		$('#idmft_color').selectpicker('refresh');
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

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear() + "-" + (month) + "-" + (day);
	$('#fecha_hora').val(today);

	//Marcamos el primer tipo_documento
	$("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');
}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarMP();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles = 0;
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
			url: '../ajax/ft_hoja3.php?op=listar',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20, //Paginación
		"order": [
			[4, "desc"]
		] //Ordenar (columna,orden)
	}).DataTable();
}


//Función ListarArticulos
function listarMP() {
	tabla = $('#tblarticulos').dataTable({
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [

		],
		"ajax": {
			url: '../ajax/ft_hoja3.php?op=listarMP',
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
		url: "../ajax/ft_hoja3.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			bootbox.alert(datos);
			mostrarform(false);
			listar();
		}

	});
	limpiar();
}

function mostrar(idavios) {
	$.post("../ajax/ft_hoja3.php?op=mostrar", {
		idavios: idavios
	}, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		//$("#idmft_color").val(data.idmft_color);

		$("#idmft_color").val(data.idmft_color);
		$("#idmft_color").selectpicker('refresh');


		$("#idavios").val(data.idavios);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
	});

	$.post("../ajax/ft_hoja3.php?op=listarDetalle&id=" + idavios, function (r) {
		$("#detalles").html(r);
	});

}

//Función para anular registros
function anular(idventa) {
	bootbox.confirm("¿Está Seguro de anular la venta?", function (result) {
		if (result) {
			$.post("../ajax/venta.php?op=anular", {
				idventa: idventa
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto = 18;
var cont = 0;
var detalles = 0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto() {
	var tipo_comprobante = $("#tipo_comprobante option:selected").text();
	if (tipo_comprobante == 'Factura') {
		$("#impuesto").val(impuesto);
	} else {
		$("#impuesto").val("0");
	}
}

function agregarDetalle(idarticulo, articulo,color,cod_linea, und, prov) {
	var consumo = 1;
	var consumo_tenido = 1;
	//var descuento = 0;

	if (idarticulo != "") {
		//var subtotal = consumo + 1;
		var fila = '<tr class="filas" id="fila' + cont + '">' +
			'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
			'<td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '" readonly>' + articulo + '</td>' +
			'<td><input type="text" name="color[]" id="color[]" value="' + color + '" readonly></td>' +
			'<td><input type="text" name="cod_linea[]" id="cod_linea[]" value="' + cod_linea + '" readonly></td>' +
			'<td><input type="text" name="und[]" id="und[]" value="' + und + '" readonly></td>' +
			'<td><input type="text" name="ubicacion[]"></td>' +
			'<td><input type="number" name="consumo[]" id="consumo[]" value="' + consumo + '"></td>' +
			'<td><input type="number" name="consumo_tenido[]" id="consumo_tenido[]" value="' + consumo_tenido + '"></td>' +
			'<td><input type="text" name="prov[]" id="prov[]" value="' + prov + '" readonly></td>' +
			'<td></td>' +
			'</tr>';
		cont++;
		detalles = detalles + 1;
		$('#detalles').append(fila);
		modificarSubototales();
	} else {
		alert("Error al ingresar el detalle, revisar los datos del artículo");
	}
}

function modificarSubototales()
{

  calcularTotales();

}
function calcularTotales() {
	var sub = document.getElementsByName("subtotal");
	var total = 0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/. " + total);
	$("#total_venta").val(total);
	evaluar();
}

function evaluar() {
	if (detalles > 0) {
		$("#btnGuardar").show();
	} else {
		$("#btnGuardar").hide();
		cont = 0;
	}
}

function eliminarDetalle(indice) {
	$("#fila" + indice).remove();
	calcularTotales();
	detalles = detalles - 1;
	evaluar()
}

init();
