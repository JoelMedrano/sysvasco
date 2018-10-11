var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})


	//Cargamos los items al select categoria
	$.post("../ajax/maternidad.php?op=selectColaboradorasPlanilla", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});



	$("#data_adjunta_muestra").hide();


}

//Función limpiar
function limpiar()
{
	

	$("#id_trab").val("");
	$("#id_trab").selectpicker('refresh');


	
	$("#fec_nac_hij1_c1").val("");
	$("#fec_nac_hij2_c1").val("");
	$("#fec_nac_hij3_c1").val("");
	$("#lugar_c1").val("");
	$("#observa_c1").val("");
	$("#data_adjunta_c1").val("");
	$("#fec_nac_hij1_c2").val("");
	$("#fec_nac_hij2_c2").val("");
	$("#fec_nac_hij3_c2").val("");
	$("#lugar_c2").val("");
	$("#observa_c2").val("");
	$("#data_adjunta_c2").val("");
	$("#fec_nac_hij1_c3").val("");
	$("#fec_nac_hij2_c3").val("");
	$("#fec_nac_hij3_c3").val("");
	$("#lugar_c3").val("");
	$("#observa_c3").val("");
	$("#data_adjunta_c3").val("");

	





}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$('#nombre').focus();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/maternidad.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 15,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{ 
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/maternidad.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(id_trab)
{
	$.post("../ajax/maternidad.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		

		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh'); 

		$("#id_maternidad").val(data.id_maternidad);


		$("#fec_nac_c1").val(data.fec_nac_c1);
		$("#lugar_c1").val(data.lugar_c1);
 		$("#observa_c1").val(data.observa_c1);

 		$("#data_adjunta_hij1_c1_actual").val(data.data_adjunta_hij1_c1);
 		$("#data_adjunta_hij2_c1_actual").val(data.data_adjunta_hij2_c1);
 		$("#data_adjunta_hij3_c1_actual").val(data.data_adjunta_hij3_c1);

 		$("#fec_nac_c2").val(data.fec_nac_c2);
 		$("#lugar_c2").val(data.lugar_c2);
 		$("#observa_c2").val(data.observa_c2);

 		$("#data_adjunta_hij1_c2_actual").val(data.data_adjunta_hij1_c2);
 		$("#data_adjunta_hij2_c2_actual").val(data.data_adjunta_hij2_c2);
 		$("#data_adjunta_hij3_c2_actual").val(data.data_adjunta_hij3_c2);

 		$("#fec_nac_c3").val(data.fec_nac_c3);
 		$("#lugar_c3").val(data.lugar_c3);
 		$("#observa_c3").val(data.observa_c3);

 		$("#data_adjunta_hij1_c3_actual").val(data.data_adjunta_hij1_c3);
 		$("#data_adjunta_hij2_c3_actual").val(data.data_adjunta_hij2_c3);
 		$("#data_adjunta_hij3_c3_actual").val(data.data_adjunta_hij3_c3);


	

 
 	})
}


//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}

init();
