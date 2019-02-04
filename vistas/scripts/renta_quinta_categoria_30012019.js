var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

		//Cargamos los items al select cliente
	$.post("../ajax/consultasD.php?op=selectTrabajadorVacaciones", function(r){
	            $("#id_nomtrab").html(r);
	            $('#id_nomtrab').selectpicker('refresh');
	});	

	

	




}

//Función limpiar
function limpiar()
{
	$("#id_nomtrab").val("");
	$("#id_trab").val("");
	$("#CantItems").val("");
	$("#nro_doc").val("");
	$("#sucursal").val("");
	$("#area_trab").val("");
	$("#fec_ing_trab").val("");

	$(".filas").remove();
	


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
		listarArticulos();

		
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



//Función ListarArticulos
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/renta_quinta_categoria.php?op=selectTrabajadoresDestajeros',
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

function mostrar(id_cp)
{
	$.post("../ajax/renta_quinta_categoria.php?op=mostrar",{id_cp : id_cp}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#CantItems").val(data.CantItems);
		$("#Ano").val(data.Ano);
		$("#Descrip_fec_pag").val(data.Descrip_fec_pag);
		$("#id_cp").val(data.id_cp);

		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});

 	$.post("../ajax/pago_destajeros.php?op=listarDetalle&id_cp="+id_cp,function(r){
	        $("#detalles").html(r);
	});
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
