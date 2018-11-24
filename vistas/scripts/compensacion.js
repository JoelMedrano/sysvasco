var tabla;

//Función que se ejecuta al inicio
function init() {
	mostrarform(false);
	listar();
	selectTrab();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});

	$('#id_trab').change(function () {
		selectTardanza();
		selectExtras();

	});

	$('#id_hor_per').change(function () {
		selectHorasT();
		
	});

	$('#id_hor_ext').change(function () {
		selectHorasE();
		
	});
}

//Función limpiar
function limpiar() {
	$("#idcategoria").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
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
			url: '../ajax/compensacion.php?op=listar',
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
//Función para guardar o editar

function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/categoria.php?op=guardaryeditar",
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

function mostrar(id_trab) {
	$.post("../ajax/compensacion.php?op=mostrar", {
		id_trab: id_trab
	}, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);


		$("#id_trab").val(data.id_trab);
		$("#id_trab").selectpicker('refresh');


	})
}

//TODO: SELECT PARA ACTIVAR TRABAJADORES
function selectTrab() {
	//Cargamos los items al combobox departamento
	$.post("../ajax/compensacion.php?op=selectTrab", function (r) {
		$("#id_trab").html(r);
		$('#id_trab').selectpicker('refresh');

	});
}

//TODO: select para tardanzas
function selectTardanza() {
	//Cargamos los items al combobox departamento
	id_trab = $("#id_trab").val();

	$.post("../ajax/compensacion.php?op=selectTardanza", {
		id_trab: id_trab
	}, function (r) {
		$("#id_hor_per").html(r);
		$('#id_hor_per').selectpicker('refresh');
	});
}


//TODO: select para horas tardanzas
function selectHorasT() {
	//Cargamos los items al combobox departamento
	id_trab = $("#id_trab").val();
	id_hor_per = $("#id_hor_per").val();
	//alert(id_trab+id_hor_per);
	$.post("../ajax/compensacion.php?op=selectHorasT", {
		id_trab: id_trab,
		id_hor_per: id_hor_per
	}, function (r) {
		$("#cant_horas").html(r);
		$('#cant_horas').selectpicker('refresh');
	});
}


//TODO: select para tardanzas
function selectExtras() {
	//Cargamos los items al combobox departamento
	id_trab = $("#id_trab").val();

	$.post("../ajax/compensacion.php?op=selectExtras", {
		id_trab: id_trab
	}, function (r) {
		$("#id_hor_ext").html(r);
		$('#id_hor_ext').selectpicker('refresh');
	});
}

//TODO: select para horas tardanzas
function selectHorasE() {
	//Cargamos los items al combobox departamento
	id_trab = $("#id_trab").val();
	id_hor_ext = $("#id_hor_ext").val();
	//alert(id_trab+id_hor_ext);
	$.post("../ajax/compensacion.php?op=selectHorasE", {
		id_trab: id_trab,
		id_hor_ext: id_hor_ext
	}, function (r) {
		$("#cant_horasE").html(r);
		$('#cant_horasE').selectpicker('refresh');
	});
}

function restarHoras() {

	id_hor_per = document.getElementById("cant_horas").value;
	id_hor_ext = document.getElementById("cant_horasE").value;

	console.log(id_hor_per);
	console.log(id_hor_ext);


	inicioMinutos = parseInt(id_hor_per.substr(3, 2));
	console.log(inicioMinutos);

	inicioHoras = parseInt(id_hor_per.substr(0, 2));
	console.log(inicioHoras);

	finMinutos = parseInt(id_hor_ext.substr(3, 2));
	console.log(finMinutos);

	finHoras = parseInt(id_hor_ext.substr(0, 2));
	console.log(finHoras);

	transcurridoMinutos = inicioMinutos - finMinutos;
	transcurridoHoras = inicioHoras - finHoras;
	
	if(transcurridoHoras <= 0){
		transcurridoHoras=transcurridoHoras*0;
	}

	if (transcurridoMinutos < 0) {
		transcurridoHoras--;
		transcurridoMinutos = 60 + transcurridoMinutos;
	}

	horas = transcurridoHoras.toString();
	minutos = transcurridoMinutos.toString();

	if (minutos.length < 2) {
		minutos = "0" + minutos;
	}

	if (horas.length < 2) {
		horas = "0" + horas;
	}

	


	document.getElementById("total").value = horas + ":" + minutos;

}



//Función para desactivar registros
function desactivar(idcategoria) {
	bootbox.confirm("¿Está Seguro de desactivar la Categoría?", function (result) {
		if (result) {
			$.post("../ajax/categoria.php?op=desactivar", {
				idcategoria: idcategoria
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Función para activar registros
function activar(idcategoria) {
	bootbox.confirm("¿Está Seguro de activar la Categoría?", function (result) {
		if (result) {
			$.post("../ajax/categoria.php?op=activar", {
				idcategoria: idcategoria
			}, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}


init();