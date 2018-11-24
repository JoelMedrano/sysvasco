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

	$("#id_ren_qui_cat").val("");
	$("#mon_total").val("");
	


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
					url: '../ajax/renta_quinta_categoria.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 12,//Paginación
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
		url: "../ajax/renta_quinta_categoria.php?op=guardaryeditar",
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

function mostrar(id_ren_qui_cat)
{
	$.post("../ajax/renta_quinta_categoria.php?op=mostrar",{id_ren_qui_cat : id_ren_qui_cat}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		
		$("#id_ren_qui_cat").val(data.id_ren_qui_cat);
		$("#mon_total").val(data.mon_total);



 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');



 
 	})
}



//Función para desactivar registros
function desactivar(id_abo_reg)
{
	bootbox.confirm("¿Está seguro de desactivar?", function(result){
		if(result)
        {
        	$.post("../ajax/renta_quinta_categoria.php?op=desactivar", {id_abo_reg : id_abo_reg}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_abo_reg)
{
	bootbox.confirm("¿Está seguro de activar?", function(result){
		if(result)
        {
        	$.post("../ajax/renta_quinta_categoria.php?op=activar", {id_abo_reg : id_abo_reg}, function(e){
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
