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


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto1", function(r){
	            $("#fec_des1").html(r);
	            $('#fec_des1').selectpicker('refresh');

	});

	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto2", function(r){
	            $("#fec_des2").html(r);
	            $('#fec_des2').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto3", function(r){
	            $("#fec_des3").html(r);
	            $('#fec_des3').selectpicker('refresh');

	});




	$("#data_adjunta_muestra").hide();




}

//Función limpiar
function limpiar()
{
	$("#id_ins_des").val("");
	$("#fec_suc").val("");
	$("#id_trab").val("");


	$("#modalidad").val("QUINCENAL");
	$("#modalidad").selectpicker('refresh');

	$("#tip_dscto").val("DESCUENTO POR PLANILLA");
	$("#tip_dscto").selectpicker('refresh');


	$("#cantidad").val("");
	$("#num_cuotas").val("");
	$("#pagado").val("");
	$("#saldo").val("");
    $("#detalle").val("");

	$("#fec_des1").val("");
	$("#fec_des1").selectpicker('refresh');
	$("#mon_des1").val("");

	$("#fec_des2").val("");
	$("#fec_des2").selectpicker('refresh');
	$("#mon_des2").val("");

	$("#fec_des3").val("");
	$("#fec_des3").selectpicker('refresh');
	$("#mon_des3").val("");




	


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


 		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		$("#tip_dscto").val(data.tip_dscto);
		$('#tip_dscto').selectpicker('refresh');

		$("#modalidad").val(data.modalidad);
		$('#modalidad').selectpicker('refresh');


		$("#fec_des1").val(data.fec_des1);
		$('#fec_des1').selectpicker('refresh');
		$("#mon_des1").val(data.mon_des1);

		$("#fec_des2").val(data.fec_des2);
		$('#fec_des2').selectpicker('refresh');
		$("#mon_des2").val(data.mon_des2);


		$("#fec_des3").val(data.fec_des3);
		$('#fec_des3').selectpicker('refresh');
		$("#mon_des3").val(data.mon_des3);


			
		$("#data_adjunta_muestra").show();
		$("#data_adjunta_muestra").attr("src","../files/prestamos/"+data.data_adjunta);
		$("#data_adjunta_actual").val(data.data_adjunta);

	


 
 	})
}

//Función para desactivar registros
function desactivar(id_ins_des)
{
	bootbox.confirm("¿Está Seguro de desactivar el descuento?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_insumos_destajeros.php?op=desactivar", {id_ins_des : id_ins_des}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_ins_des)
{
	bootbox.confirm("¿Está Seguro de activar el descuento?", function(result){
		if(result)
        {
        	$.post("../ajax/descuentos_insumos_destajeros.php?op=activar", {id_ins_des : id_ins_des}, function(e){
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
