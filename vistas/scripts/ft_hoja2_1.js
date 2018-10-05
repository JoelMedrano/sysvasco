var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();
	selectFT();
	

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});

	$('#idmft').change(function () {
		selectCombo();
		selectTela1();
		selectTela2();
		selectTela3();
		selectColor1();
	});

	$('#tela1').change(function () {
		selectColor1();
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
	$("#tela1_mod").val("0");
	$('#tela1_mod').selectpicker('refresh');
	$("#tela2_mod").val("0");
	$('#tela2_mod').selectpicker('refresh');
	$("#tela3_mod").val("0");
	$('#tela3_mod').selectpicker('refresh');
	$("#bord_mod").val("0");
	$('#bord_mod').selectpicker('refresh');
	$("#esta_mod").val("0");
	$('#esta_mod').selectpicker('refresh');
	$("#manu_mod").val("0");
	$('#manu_mod').selectpicker('refresh');



	$("#imagen_muestra").attr("src", "");
	$("#imagenactual_imagen").val("");

	$("#imagen2_muestra").attr("src", "");
	$("#imagenactual_imagen2").val("");


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
		url: "../ajax/ft_hoja1.php?op=guardaryeditar",
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

function mostrar(idftc) {
	$.post("../ajax/ft_hoja2_1.php?op=mostrar", {
		idftc: idftc
	}, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		$("#idmft").val(data.idmft);
		$("#idmft").selectpicker('refresh');


		$("#idftc").val(data.idftc);

	});

}

//TODO: SELECT PARA LAS FICHAS TECNICAS
function selectFT() {
	//Cargamos los items al combobox departamento
	$.post("../ajax/ft_hoja2_1.php?op=selectFT", function (r) {
		$("#idmft").html(r);
		$('#idmft').selectpicker('refresh');

	});
}

function selectCombo() {
	//Cargamos los items al combobox departamento
	idmft = $("#idmft").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectCombo", {
		idmft: idmft
	}, function (r) {
		$("#com_color").html(r);
		$('#com_color').selectpicker('refresh');
	});
}

function selectTela1() {
	//Cargamos los items al combobox departamento
	idmft = $("#idmft").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectTela1", {
		idmft: idmft
	}, function (r) {
		$("#tela1").html(r);
		$('#tela1').selectpicker('refresh');
	});
}

function selectTela2() {
	//Cargamos los items al combobox departamento
	idmft = $("#idmft").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectTela2", {
		idmft: idmft
	}, function (r) {
		$("#tela2").html(r);
		$('#tela2').selectpicker('refresh');
	});
}

function selectTela3() {
	//Cargamos los items al combobox departamento
	idmft = $("#idmft").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectTela3", {
		idmft: idmft
	}, function (r) {
		$("#tela3").html(r);
		$('#tela3').selectpicker('refresh');
	});
}

function selectColor1() {
	//Cargamos los items al combobox departamento
	tela1 = $("#tela1").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectColor1", {
		tela1: tela1
	}, function (r) {
		$("#color1").html(r);
		$('#color1').selectpicker('refresh');
	});
}


init();
