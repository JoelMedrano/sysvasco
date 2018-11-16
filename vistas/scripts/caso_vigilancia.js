var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

	//Cargamos los items al select Trabajadores Activos
	$.post("../ajax/consultasD.php?op=selectPersonalNombreLargo", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});


	






}

//Función limpiar
function limpiar()
{
	$("#id_trab").val("");
	$("#id_trab").selectpicker('refresh');

	$("#id_caso_vig").val("");
	$("#canhoras_max").val("");
	$("#fedo_canhoras_max").val("");
	$("#porc_pago").val("");
	


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
					url: '../ajax/caso_vigilancia.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
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
		url: "../ajax/caso_vigilancia.php?op=guardaryeditar",
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

function mostrar(id_caso_vig)
{
	$.post("../ajax/caso_vigilancia.php?op=mostrar",{id_caso_vig : id_caso_vig}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		
		$("#id_caso_vig").val(data.id_caso_vig);
		$("#canhoras_max").val(data.canhoras_max);
		$("#fedo_canhoras_max").val(data.fedo_canhoras_max);
		$("#porc_pago").val(data.porc_pago);



 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		

	


 
 	})
}

//Función para desactivar registros
function desactivar(id_caso_vig)
{
	bootbox.confirm("¿Está seguro de desactivar?", function(result){
		if(result)
        {
        	$.post("../ajax/caso_vigilancia.php?op=desactivar", {id_caso_vig : id_caso_vig}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_caso_vig)
{
	bootbox.confirm("¿Está seguro de activar?", function(result){
		if(result)
        {
        	$.post("../ajax/caso_vigilancia.php?op=activar", {id_caso_vig : id_caso_vig}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//función para generar el código de barras
function generarbarcode()
{
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}

init();
