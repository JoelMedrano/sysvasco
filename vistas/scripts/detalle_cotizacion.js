var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	selectMP();


	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})


	$('#idarticulo').change(function() {
			precioMP();
	});



}

//Función limpiar
function limpiar()
{
	$("#iddetalle_cotizacion").val("");
	$("#idarticulo").val("0");
	$('#idarticulo').selectpicker('refresh');
	$("#cantidad").val("");

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
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
					url: '../ajax/detalle_cotizacion.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 30,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/detalle_cotizacion.php?op=guardaryeditar",
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

function mostrar(iddetalle_cotizacion)
{
	$.post("../ajax/detalle_cotizacion.php?op=mostrar",{iddetalle_cotizacion : iddetalle_cotizacion}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idarticulo").val(data.idarticulo);
		$("#idarticulo").selectpicker('refresh');
		$("#cantidad").val(data.cantidad);
		$("#precio_cotizacion").val(data.precio_cotizacion);
		$("#precio_cotizacion").selectpicker('refresh');
 		$("#iddetalle_cotizacion").val(data.iddetalle_cotizacion);

 	})
}

//Función para desactivar registros
function eliminar(iddetalle_cotizacion)
{
	bootbox.confirm("¿Está Seguro de eliminar el detalle?", function(result){
		if(result)
        {
        	$.post("../ajax/detalle_cotizacion.php?op=eliminar", {iddetalle_cotizacion : iddetalle_cotizacion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


//CORREGIR
function selectMP()
{
	//Cargamos los items al combobox departamento
	$.post("../ajax/detalle_cotizacion.php?op=selectMP", function(r){
	            $("#idarticulo").html(r);

	});
}

function precioMP()
{

	//Cargamos los items al combobox departamento
	idarticulo=$("#idarticulo").val();

	$.post("../ajax/detalle_cotizacion.php?op=precioMP",{idarticulo: idarticulo}, function(r){
	            $("#precio_cotizacion").html(r);
							$('#precio_cotizacion').selectpicker('refresh');
	});
}




init();
