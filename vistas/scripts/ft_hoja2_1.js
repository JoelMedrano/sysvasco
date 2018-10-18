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

	});

	$('#com_color').change(function () {
		selectColor1();
		selectColor2();
		selectColor3();

	});

}

//Función limpiar
function limpiar() {


	$("#idmft").val("");
	$('#idmft').selectpicker('refresh');
	$("#com_color").val("");
	$('#com_color').selectpicker('refresh');

	$("#com_color").val("");
	$('#com_color').selectpicker('refresh');

	$("#tela1").val("0");
	$('#tela1').selectpicker('refresh');
	$("#tela1").val("").trigger('change');
	$("#color1").val("0");
	$('#color1').selectpicker('refresh');
	$("#color1").val("").trigger('change');

	$("#tela2").val("0");
	$('#tela2').selectpicker('refresh');
	$("#tela2").val("").trigger('change');
	$("#color2").val("0");
	$('#color2').selectpicker('refresh');
	$("#color2").val("").trigger('change');

	$("#tela3").val("0");
	$('#tela3').selectpicker('refresh');
	$("#tela3").val("").trigger('change');
	$("#color3").val("0");
	$('#color3').selectpicker('refresh');
	$("#color3").val("").trigger('change');

	$("#idftc").val("");
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
		url: "../ajax/ft_hoja2_1.php?op=guardaryeditar",
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

		$("#com_color").val(data.com_color);
		$("#com_color").selectpicker('refresh');

		$("#tela1").val(data.tela1);
		$("#tela1").selectpicker('refresh');

		$("#tela2").val(data.tela2);
		$("#tela2").selectpicker('refresh');

		$("#tela3").val(data.tela3);
		$("#tela3").selectpicker('refresh');

		$("#color1").val(data.color1);
		$("#color1").selectpicker('refresh');

		$("#color2").val(data.color2);
		$("#color2").selectpicker('refresh');

		$("#color3").val(data.color3);
		$("#color3").selectpicker('refresh');

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

//TODO: SELECT PARA LAS FICHAS TECNICAS
/*function selectCombo() {
	//Cargamos los items al combobox departamento
	$.post("../ajax/ft_hoja2_1.php?op=selectCombo", function (r) {
		$("#com_color").html(r);
		$('#com_color').selectpicker('refresh');

	});
}*/

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

function selectColor2() {


	//Cargamos los items al combobox departamento
	tela2 = $("#tela2").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectColor2", {
		tela2: tela2
	}, function (r) {
		$("#color2").html(r);
		$('#color2').selectpicker('refresh');
	});
}

function selectColor3() {


	//Cargamos los items al combobox departamento
	tela3 = $("#tela3").val();

	$.post("../ajax/ft_hoja2_1.php?op=selectColor3", {
		tela3: tela3
	}, function (r) {
		$("#color3").html(r);
		$('#color3').selectpicker('refresh');
	});
}


init();