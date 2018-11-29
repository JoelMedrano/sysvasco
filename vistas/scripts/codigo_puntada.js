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
	$.post("../ajax/codigo_puntada.php?op=select", function(r){
	            $("#idtipo_maquina").html(r);
	            $('#idtipo_maquina').selectpicker('refresh');

	});

	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	
	$("#nombre").val("");
	$("#descripcion").val("");
	

	
	$("#idcodigo_puntada").val("");
	
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
					url: '../ajax/codigo_puntada.php?op=listar',
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
		url: "../ajax/codigo_puntada.php?op=guardaryeditar",
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

function mostrar(idcodigo_puntada)
{
	$.post("../ajax/codigo_puntada.php?op=mostrar",{idcodigo_puntada : idcodigo_puntada}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idtipo_maquina").val(data.idtipo_maquina);
		$('#idtipo_maquina').selectpicker('refresh');
		$("#codigo").val(data.codigo);
		$("#nombre").val(data.nombre);
		
		$("#descripcion").val(data.descripcion);

 		$("#idcodigo_puntada").val(data.idcodigo_puntada);
 		

 	})
}

//Función para desactivar registros
function desactivar(idcodigo_puntada)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/codigo_puntada.php?op=desactivar", {idcodigo_puntada : idcodigo_puntada}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(idcodigo_puntada)
{
	bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/codigo_puntada.php?op=activar", {idcodigo_puntada : idcodigo_puntada}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}



init();
