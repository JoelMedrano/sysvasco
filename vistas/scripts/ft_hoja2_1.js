var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});

	//Cargamos los items al select cliente
	$.post("../ajax/ft_hoja2.php?op=selectFT", function (r) {
		$("#cod_mod").html(r);
		$('#cod_mod').selectpicker('refresh');
	});

}

//Función limpiar
function limpiar() {


	$("#cod_mod").val("0");
	$('#cod_mod').selectpicker('refresh');
	$("#molde_muestra").attr("src", "");
	$("#moldeactual_molde").val("");

	$("#idmft").val("");

	$("#idmft").show();

	$(".filas").remove();
	$("#total").html("0");




}

//Función mostrar formulario
function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarCombos();

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
			url: '../ajax/ft_hoja2_1.php?op=listar',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 20, //Paginación
		"order": [
			[0, "asc"]
		] //Ordenar (columna,orden)
	}).DataTable();
}


//Función ListarArticulos
function listarCombos() {
	tabla = $('#tblarticulos').dataTable({
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de tabla
		buttons: [

		],
		"ajax": {
			url: '../ajax/ft_hoja2_1.php?op=listarCombos',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 12, //Paginación
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
		url: "../ajax/ft_hoja2_1.php?op=guardaryeditar",
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

function mostrar(idmft) {
	$.post("../ajax/ft_hoja2_1.php?op=mostrar", {
		idmft: idmft
	}, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		$("#cod_mod").val(data.cod_mod);
		$("#cod_mod").selectpicker('refresh');

		$("#idmft").val(data.idmft);

		$("#idmft").hide();

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
	});

	$.post("../ajax/ft_hoja2_1.php?op=listarDetalle&id=" + idmft, function (r) {
		$("#detalles").html(r);
	});
}


//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var cont = 0;
var detalles = 0;
//$("#guardar").hide();
$("#btnGuardar").hide();

function agregarDetalle(idarticulo, articulo) {

	//Cargamos los items al select cliente


	var consumo = 1;

	if (idarticulo != "") {
		var subtotal = 1 / consumo;

		$.post("../ajax/ft_hoja2_1.php?op=selectTela1", function (r) {
			$("#tela1").html(r);
			$('#tela1').selectpicker('refresh');
		});


		var fila = '<tr class="filas" id="fila' + cont + '">' +
			'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button></td>' +
			'<td><input type="hidden" size="15" name="idarticulo[]" value="' + idarticulo + '">' + articulo + '</td>' +
			'<td><select id="tela1" name="tela1" class="form-control selectpicker" data-live-search="true" required></select></td>' +
			'<td><input type="number" style="width: 50px;" name="cant_pieza[]"></td>' +
			'<td><input type="text" name="sent_tela[]"></td>' +
			'<td><input type="text" name="tapete[]"></td>' +
			'<td><input type="text" name="collareta[]"></td>' +
			'<td><input type="number" style="width: 50px;" name="consumo[]" value="' + consumo + '" step="any"></td>' +
			'<td><input type="text" name="tono[]"></td>' +
			'<td><input type="text" name="observaciones[]"></td>' +
			'<td><span name="subtotal" id="subtotal' + cont + '" step="any">' + subtotal + '</span></td>' +
			'<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>' +
			'</tr>';
		cont++;
		detalles = detalles + 1;
		$('#detalles').append(fila);
		modificarSubototales();
	} else {
		alert("Error al ingresar el detalle, revisar los datos del artículo");
	}
}

function modificarSubototales() {
	var cons = document.getElementsByName("consumo[]");
	var sub = document.getElementsByName("subtotal");

	for (var i = 0; i < cons.length; i++) {
		var inpC = cons[i];
		var inpS = sub[i];

		inpS.value = (1 / inpC.value).toFixed(4);
		document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
	}
	calcularTotales();

}

function calcularTotales() {
	var sub = document.getElementsByName("subtotal");
	var total = 0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/. " + total);
	$("#total_cotizacion").val(total);
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

//Función para anular registros
function eliminar(idmft) {
	bootbox.confirm("¿Está Seguro de eliminar la FT?", function (result) {
		if (result) {
			$.post("../ajax/ft_hoja2.php?op=eliminar", {
				idmft: idmft
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();
