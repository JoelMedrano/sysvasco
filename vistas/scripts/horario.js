var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	


}

//Función limpiar
function limpiar()
{
	$("#id_horario").val("");
	$("#descrip").val("");
	$("#lunes_ingreso").val("");
	$("#lunes_salida").val("");
	$("#martes_ingreso").val("");
	$("#martes_salida").val("");
	$("#miercoles_ingreso").val("");
	$("#miercoles_salida").val("");
	$("#jueves_ingreso").val("");
	$("#jueves_salida").val("");
	$("#viernes_ingreso").val("");
	$("#viernes_salida").val("");
	$("#sabado_ingreso").val("");
	$("#sabado_salida").val("");
	$("#domingo_ingreso").val("");
	$("#domingo_salida").val("");


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
					url: '../ajax/horario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
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
		url: "../ajax/horario.php?op=guardaryeditar",
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

function mostrar(id_horario)
{
	$.post("../ajax/horario.php?op=mostrar",{id_horario : id_horario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		
		$("#id_horario").val(data.id_horario);
		$("#descrip").val(data.descrip);
		$("#lunes_ingreso").val(data.lunes_ingreso);
		$("#lunes_salida").val(data.lunes_salida);
		$("#martes_ingreso").val(data.martes_ingreso);
		$("#martes_salida").val(data.martes_salida);
		$("#miercoles_ingreso").val(data.miercoles_ingreso);
		$("#miercoles_salida").val(data.miercoles_salida);
		$("#jueves_ingreso").val(data.jueves_ingreso);
		$("#jueves_salida").val(data.jueves_salida);
		$("#viernes_ingreso").val(data.viernes_ingreso);
		$("#viernes_salida").val(data.viernes_salida);
		$("#sabado_ingreso").val(data.sabado_ingreso);
		$("#sabado_salida").val(data.sabado_salida);
		$("#domingo_ingreso").val(data.domingo_ingreso);
		$("#domingo_salida").val(data.domingo_salida);

 	})
}

//Función para desactivar registros
function desactivar(id_horario)
{
	bootbox.confirm("¿Está Seguro de desactivar el horario?", function(result){
		if(result)
        {
        	$.post("../ajax/horario.php?op=desactivar", {id_horario : id_horario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id_horario)
{
	bootbox.confirm("¿Está Seguro de activar el horario?", function(result){
		if(result)
        {
        	$.post("../ajax/horario.php?op=activar", {id_horario : id_horario}, function(e){
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