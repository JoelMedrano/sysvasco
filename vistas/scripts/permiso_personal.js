var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select tipo de permiso
	$.post("../ajax/consultasD.php?op=selectTipoPermiso", function(r){
	            $("#tip_permiso").html(r);
	            $('#tip_permiso').selectpicker('refresh');

	});

	//Cargamos los items al select personal
	$.post("../ajax/consultasD.php?op=selectPersonal", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});






	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$("#codigo").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");
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
					url: '../ajax/permiso_personal.php?op=listar',
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
		url: "../ajax/permiso_personal.php?op=guardaryeditar",
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

function mostrar(id_permiso)
{
	$.post("../ajax/permiso_personal.php?op=mostrar",{id_permiso : id_permiso}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');
		$("#id_permiso").val(data.id_permiso);
		$("#fecha_emision").val(data.fecha_emision);
		$("#fecha_procede").val(data.fecha_procede); 
		$("#fecha_hasta").val(data.fecha_hasta);
		$("#tip_permiso").val(data.tip_permiso);
		$('#tip_permiso').selectpicker('refresh'); 
		$("#hora_ing").val(data.hora_ing);
		$("#hora_sal").val(data.hora_sal);
 		$("#motivo").val(data.motivo);

 	})
}

//Función para desactivar registros
function desactivar(id_permiso)
{
	bootbox.confirm("¿Está seguro de desactivar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=desactivar", {id_permiso : id_permiso}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(id_permiso)
{
	bootbox.confirm("¿Está seguro de activar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=activar", {id_permiso : id_permiso}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


//Función para desactivar registros
function desaprobar(id_permiso)
{
	bootbox.confirm("¿Está seguro de desaprobar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=desaprobar", {id_permiso : id_permiso}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function aprobar(id_permiso)
{
	bootbox.confirm("¿Está seguro de aprobar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=aprobar", {id_permiso : id_permiso}, function(e){
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