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
	$.post("../ajax/descuentos_judiciales.php?op=selectTrabajador", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});

	$("#data_adjunta_muestra").hide();


}




//Función limpiar
function limpiar()
{
	$("#id_des_jud").val("");
	$("#id_trab").val("");
	$("#mon_men").val("");
	$("#obs_des_jud").val("");
	$("#fec_ini").val("");
	$("#fec_fin").val("");



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
					url: '../ajax/descuentos_judiciales.php?op=listar',
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
		url: "../ajax/descuentos_judiciales.php?op=guardaryeditar",
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

function mostrar(id_des_jud)
{
	$.post("../ajax/descuentos_judiciales.php?op=mostrar",{id_des_jud : id_des_jud}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_des_jud").val(data.id_des_jud);
		$("#obs_des_jud").val(data.obs_des_jud);
		$("#fec_ini").val(data.fec_ini);
		$("#fec_fin").val(data.fec_fin);
 		$("#mon_men").val(data.mon_men);

 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		$("#data_adjunta_muestra").show();
		$("#data_adjunta_muestra").attr("src","../files/descuentos_judiciales/"+data.data_adjunta);
		$("#data_adjunta_actual").val(data.data_adjunta);




 	})
}

//Función para desactivar registros
function desactivar(id_des_jud)
{
	bootbox.confirm("¿Está seguro de desactivar el descuento judicial?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_judiciales.php?op=desactivar", {id_des_jud : id_des_jud}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_des_jud)
{
	bootbox.confirm("¿Está seguro de activar el descuento judicial?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_judiciales.php?op=activar", {id_des_jud : id_des_jud}, function(e){
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
