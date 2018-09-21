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
	$.post("../ajax/descuentos_insumos_destajeros.php?op=selectTrabajadoresActivos", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});


	//Cargamos los items al select Tipo de Descuento (Por planilla o interno)
	$.post("../ajax/descuentos_insumos_destajeros.php?op=selectTipoDsctoPrestamo", function(r){
	            $("#tip_dscto").html(r);
	            $('#tip_dscto').selectpicker('refresh');

	});


	//Cargamos los items al select Tipo de Descuento (Por planilla o interno)
	$.post("../ajax/descuentos_insumos_destajeros.php?op=selectModalidadPrestamo", function(r){
	            $("#modalidad").html(r);
	            $('#modalidad').selectpicker('refresh');

	});







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
	$("#imagen").attr("src","");
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
					url: '../ajax/descuentos_insumos_destajeros.php?op=listar',
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
		url: "../ajax/descuentos_insumos_destajeros.php?op=guardaryeditar",
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

function mostrar(id_ins_des)
{
	$.post("../ajax/descuentos_insumos_destajeros.php?op=mostrar",{id_ins_des : id_ins_des}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_ins_des").val(data.id_ins_des);
		$("#fec_suc").val(data.fec_suc);
		$("#detalle").val(data.detalle);
 		$("#num_cuotas").val(data.num_cuotas);
 		$("#cantidad").val(data.cantidad);
 		$("#pagado").val(data.pagado);
 		$("#saldo").val(data.saldo);
 		$("#fec_des1").val(data.fec_des1);
 		$("#fec_des2").val(data.fec_des2);
 		$("#fec_des3").val(data.fec_des3);


 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		$("#tip_dscto").val(data.tip_dscto);
		$('#tip_dscto').selectpicker('refresh');

		$("#modalidad").val(data.modalidad);
		$('#modalidad').selectpicker('refresh');


	


 
 	})
}

//Función para desactivar registros
function desaprobar(id_ins_des)
{
	bootbox.confirm("¿Está Seguro de desaprobar el prestamo?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_insumos_destajeros.php?op=desaprobar", {id_ins_des : id_ins_des}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function aprobar(id_ins_des)
{
	bootbox.confirm("¿Está Seguro de aprobar el prestamo?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_insumos_destajeros.php?op=aprobar", {id_ins_des : id_ins_des}, function(e){
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
