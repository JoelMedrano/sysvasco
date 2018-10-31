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


	//Cargamos los items al select Horarios
	$.post("../ajax/consultasD.php?op=selectHorarios", function(r){
	            $("#id_horario").html(r);
	            $('#id_horario').selectpicker('refresh');

	});


	//Cargamos los items al select Refrigerios
	$.post("../ajax/consultasD.php?op=selectRefrigerios", function(r){
	            $("#cod_ref").html(r);
	            $('#cod_ref').selectpicker('refresh');

	});


	






}

//Función limpiar
function limpiar()
{
	$("#id_trab").val("");
	$("#id_trab").selectpicker('refresh');

	$("#id_horario").val("");
	$("#id_horario").selectpicker('refresh');

	$("#cod_ref").val("");
	$("#cod_ref").selectpicker('refresh');


	$("#id_hor_ref").val("");


	
	


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
					url: '../ajax/horario_refrigerio_trabajador.php?op=listar',
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
		url: "../ajax/horario_refrigerio_trabajador.php?op=guardaryeditar",
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

function mostrar(id_hor_ref)
{
	$.post("../ajax/horario_refrigerio_trabajador.php?op=mostrar",{id_hor_ref : id_hor_ref}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		
		$("#id_hor_ref").val(data.id_hor_ref);


 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		$("#id_horario").val(data.id_horario);
		$('#id_horario').selectpicker('refresh');

		$("#cod_ref").val(data.cod_ref);
		$('#cod_ref').selectpicker('refresh');

		

	


 
 	})
}

//Función para desactivar registros
function desactivar(id_hor_ref)
{
	bootbox.confirm("¿Está seguro de desactivar?", function(result){
		if(result)
        {
        	$.post("../ajax/horario_refrigerio_trabajador.php?op=desactivar", {id_hor_ref : id_hor_ref}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_hor_ref)
{
	bootbox.confirm("¿Está seguro de activar?", function(result){
		if(result)
        {
        	$.post("../ajax/horario_refrigerio_trabajador.php?op=activar", {id_hor_ref : id_hor_ref}, function(e){
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
