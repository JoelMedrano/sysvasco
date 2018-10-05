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
	$.post("../ajax/prestamos.php?op=selectTrabajadoresActivos", function(r){
	            $("#solicitante").html(r);
	            $('#solicitante').selectpicker('refresh');

	});


	//Cargamos los items al select Trabajadores Activos
	$.post("../ajax/prestamos.php?op=selectTrabajadorPermisoAprobacion", function(r){
	            $("#aprob_por").html(r);
	            $('#aprob_por').selectpicker('refresh');

	});


	


	//Cargamos los items al select Tipo de Descuento (Por planilla o interno)
	$.post("../ajax/prestamos.php?op=selectTipoDsctoPrestamo", function(r){
	            $("#tip_dscto").html(r);
	            $('#tip_dscto').selectpicker('refresh');

	});


	//Cargamos los items al select Tipo de Descuento (Por planilla o interno)
	$.post("../ajax/prestamos.php?op=selectModalidadPrestamo", function(r){
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


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto4", function(r){
	            $("#fec_des4").html(r);
	            $('#fec_des4').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto5", function(r){
	            $("#fec_des5").html(r);
	            $('#fec_des5').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto6", function(r){
	            $("#fec_des6").html(r);
	            $('#fec_des6').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto7", function(r){
	            $("#fec_des7").html(r);
	            $('#fec_des7').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto8", function(r){
	            $("#fec_des8").html(r);
	            $('#fec_des8').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto9", function(r){
	            $("#fec_des9").html(r);
	            $('#fec_des9').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto10", function(r){
	            $("#fec_des10").html(r);
	            $('#fec_des10').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto11", function(r){
	            $("#fec_des11").html(r);
	            $('#fec_des11').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto12", function(r){
	            $("#fec_des12").html(r);
	            $('#fec_des12').selectpicker('refresh');

	});




	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto13", function(r){
	            $("#fec_des13").html(r);
	            $('#fec_des13').selectpicker('refresh');

	});




	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto14", function(r){
	            $("#fec_des14").html(r);
	            $('#fec_des14').selectpicker('refresh');

	});




	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto15", function(r){
	            $("#fec_des15").html(r);
	            $('#fec_des15').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto16", function(r){
	            $("#fec_des16").html(r);
	            $('#fec_des16').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto17", function(r){
	            $("#fec_des17").html(r);
	            $('#fec_des17').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto18", function(r){
	            $("#fec_des18").html(r);
	            $('#fec_des18').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto19", function(r){
	            $("#fec_des19").html(r);
	            $('#fec_des19').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto20", function(r){
	            $("#fec_des20").html(r);
	            $('#fec_des20').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto21", function(r){
	            $("#fec_des21").html(r);
	            $('#fec_des21').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto22", function(r){
	            $("#fec_des22").html(r);
	            $('#fec_des22').selectpicker('refresh');

	});




	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto23", function(r){
	            $("#fec_des23").html(r);
	            $('#fec_des23').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto24", function(r){
	            $("#fec_des24").html(r);
	            $('#fec_des24').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto25", function(r){
	            $("#fec_des25").html(r);
	            $('#fec_des25').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto26", function(r){
	            $("#fec_des26").html(r);
	            $('#fec_des26').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto27", function(r){
	            $("#fec_des27").html(r);
	            $('#fec_des27').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto28", function(r){
	            $("#fec_des28").html(r);
	            $('#fec_des28').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto29", function(r){
	            $("#fec_des29").html(r);
	            $('#fec_des29').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto30", function(r){
	            $("#fec_des30").html(r);
	            $('#fec_des30').selectpicker('refresh');

	});



	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectMedida", function(r){
	            $("#medida").html(r);
	            $('#medida').selectpicker('refresh');

	});









	$("#data_adjunta_muestra").hide();


}

//Función limpiar
function limpiar()
{
	$("#id_pre").val("");
	$("#fec_sol").val("");

	$("#registrante").val("");
	$("#registrante").selectpicker('refresh');


	$("#solicitante").val("");
	$("#solicitante").selectpicker('refresh');

	$("#aprob_por").val("");
	$("#aprob_por").selectpicker('refresh');

	$("#modalidad").val("");
	$("#modalidad").selectpicker('refresh');

	$("#tip_dscto").val("");
	$("#tip_dscto").selectpicker('refresh');

	$("#medida").val("");
	$("#medida").selectpicker('refresh');

	$("#cantidad").val("");
	$("#num_cuotas").val("");
	$("#pagado").val("");
	$("#saldo").val("");
	$("#motivo").val("");
	$("#fec_des1").val("");
	$("#fec_des1").selectpicker('refresh');

	$("#mon_des1").val("");
	$("#fec_des2").val("");
	$("#fec_des2").selectpicker('refresh');

	$("#mon_des2").val("");
	$("#fec_des3").val("");
	$("#fec_des3").selectpicker('refresh');

	$("#mon_des3").val("");
	$("#fec_des4").val("");
	$("#fec_des4").selectpicker('refresh');

	$("#mon_des4").val("");
	$("#fec_des5").val("");
	$("#fec_des5").selectpicker('refresh');

	$("#mon_des5").val("");
	$("#fec_des6").val("");
	$("#fec_des6").selectpicker('refresh');

	$("#mon_des6").val("");
	$("#fec_des7").val("");
	$("#fec_des7").selectpicker('refresh');

	$("#mon_des7").val("");
	$("#fec_des8").val("");
	$("#fec_des8").selectpicker('refresh');

	$("#mon_des8").val("");
	$("#fec_des9").val("");
	$("#fec_des9").selectpicker('refresh');

	$("#mon_des9").val("");
	$("#fec_des10").val("");
	$("#fec_des10").selectpicker('refresh');

	$("#mon_des10").val("");
	$("#fec_des11").val("");
	$("#fec_des11").selectpicker('refresh');

	$("#mon_des11").val("");
	$("#fec_des12").val("");
	$("#fec_des12").selectpicker('refresh');

	$("#mon_des12").val("");
	$("#fec_des13").val("");
	$("#fec_des13").selectpicker('refresh');

	$("#mon_des13").val("");
	$("#fec_des14").val("");
	$("#fec_des14").selectpicker('refresh');

	$("#mon_des14").val("");
	$("#fec_des15").val("");
	$("#fec_des15").selectpicker('refresh');

	$("#mon_des15").val("");
	$("#fec_des16").val("");
	$("#fec_des16").selectpicker('refresh');

	$("#mon_des16").val("");
	$("#fec_des17").val("");
	$("#fec_des17").selectpicker('refresh');

	$("#mon_des17").val("");
	$("#fec_des18").val("");
	$("#fec_des18").selectpicker('refresh');

	$("#mon_des18").val("");
	$("#fec_des19").val("");
	$("#fec_des19").selectpicker('refresh');

	$("#mon_des19").val("");
	$("#fec_des20").val("");
	$("#fec_des20").selectpicker('refresh');

	$("#mon_des20").val("");
	$("#fec_des21").val("");
	$("#fec_des21").selectpicker('refresh');

	$("#mon_des21").val("");
	$("#fec_des22").val("");
	$("#fec_des22").selectpicker('refresh');

	$("#mon_des22").val("");
	$("#fec_des23").val("");
	$("#fec_des23").selectpicker('refresh');

	$("#mon_des23").val("");
	$("#fec_des24").val("");
	$("#fec_des24").selectpicker('refresh');
	
	$("#mon_des24").val("");
	$("#fec_des25").val("");
	$("#fec_des25").selectpicker('refresh');

	$("#mon_des25").val("");
	$("#fec_des26").val("");
	$("#fec_des26").selectpicker('refresh');

	$("#mon_des26").val("");
	$("#fec_des27").val("");
	$("#fec_des27").selectpicker('refresh');

	$("#mon_des27").val("");
	$("#fec_des28").val("");
	$("#fec_des28").selectpicker('refresh');

	$("#mon_des28").val("");
	$("#fec_des29").val("");
	$("#fec_des29").selectpicker('refresh');

	$("#mon_des29").val("");
	$("#fec_des30").val("");
	$("#fec_des30").selectpicker('refresh');
	
	$("#mon_des30").val("");
	



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
					url: '../ajax/prestamos.php?op=listar',
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
		url: "../ajax/prestamos.php?op=guardaryeditar",
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

function mostrar(id_pre)
{
	$.post("../ajax/prestamos.php?op=mostrar",{id_pre : id_pre}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#registrante").val(data.registrante);
		$("#fec_sol").val(data.fec_sol);


		$("#id_pre").val(data.id_pre);
		$("#motivo").val(data.motivo);
 		$("#num_cuotas").val(data.num_cuotas);
 		$("#cantidad").val(data.cantidad);
 		$("#pagado").val(data.pagado);
 		$("#saldo").val(data.saldo);

 		$("#solicitante").val(data.solicitante);
		$('#solicitante').selectpicker('refresh');

		$("#aprob_por").val(data.aprob_por);
		$('#aprob_por').selectpicker('refresh');

		$("#tip_dscto").val(data.tip_dscto);
		$('#tip_dscto').selectpicker('refresh');

		$("#modalidad").val(data.modalidad);
		$('#modalidad').selectpicker('refresh');

	//	$("#data_adjunta_muestra").show();
		//$("#data_adjunta_muestra").attr("src","../files/prestamos/"+data.data_adjunta);
		$("#data_adjunta_actual").val(data.data_adjunta);



		$("#medida").val(data.medida);
		$('#medida').selectpicker('refresh');



		$("#fec_des1").val(data.fec_des1);
		$('#fec_des1').selectpicker('refresh');
		$("#mon_des1").val(data.mon_des1);

		$("#fec_des2").val(data.fec_des2);
		$('#fec_des2').selectpicker('refresh');
		$("#mon_des2").val(data.mon_des2);

		$("#fec_des3").val(data.fec_des3);
		$('#fec_des3').selectpicker('refresh');	
		$("#mon_des3").val(data.mon_des3);

		$("#fec_des4").val(data.fec_des4);
		$('#fec_des4').selectpicker('refresh');
		$("#mon_des4").val(data.mon_des4);

		$("#fec_des5").val(data.fec_des5);
		$('#fec_des5').selectpicker('refresh');
		$("#mon_des5").val(data.mon_des5);

		$("#fec_des6").val(data.fec_des6);
		$('#fec_des6').selectpicker('refresh');
		$("#mon_des6").val(data.mon_des6);

		$("#fec_des7").val(data.fec_des7);
		$('#fec_des7').selectpicker('refresh'); 
        $("#mon_des7").val(data.mon_des7);

		$("#fec_des8").val(data.fec_des8);
		$('#fec_des8').selectpicker('refresh');
		$("#mon_des8").val(data.mon_des8);

		$("#fec_des9").val(data.fec_des9);
		$('#fec_des9').selectpicker('refresh');
		$("#mon_des9").val(data.mon_des9);

		$("#fec_des10").val(data.fec_des10);
		$('#fec_des10').selectpicker('refresh');
        $("#mon_des10").val(data.mon_des10);

		$("#fec_des11").val(data.fec_des11);
		$('#fec_des11').selectpicker('refresh');
		$("#mon_des11").val(data.mon_des11);

		$("#fec_des12").val(data.fec_des12);
		$('#fec_des12').selectpicker('refresh');
        $("#mon_des12").val(data.mon_des12);

		$("#fec_des13").val(data.fec_des13);
		$('#fec_des13').selectpicker('refresh');
		$("#mon_des13").val(data.mon_des13);

		$("#fec_des14").val(data.fec_des14);
		$('#fec_des14').selectpicker('refresh');
		$("#mon_des14").val(data.mon_des14);

		$("#fec_des15").val(data.fec_des15);
		$('#fec_des15').selectpicker('refresh');
		$("#mon_des15").val(data.mon_des15);

		$("#fec_des16").val(data.fec_des16);
		$('#fec_des16').selectpicker('refresh');
		$("#mon_des16").val(data.mon_des16);

		$("#fec_des17").val(data.fec_des17);
		$('#fec_des17').selectpicker('refresh');
		$("#mon_des17").val(data.mon_des17);

		$("#fec_des18").val(data.fec_des18);
		$('#fec_des18').selectpicker('refresh');
		$("#mon_des18").val(data.mon_des18);

		$("#fec_des19").val(data.fec_des19);
		$('#fec_des19').selectpicker('refresh');
		$("#mon_des19").val(data.mon_des19);

		$("#fec_des20").val(data.fec_des20);
		$('#fec_des20').selectpicker('refresh');
		$("#mon_des20").val(data.mon_des20);

		$("#fec_des21").val(data.fec_des21);
		$('#fec_des21').selectpicker('refresh');
		$("#mon_des21").val(data.mon_des21);

		$("#fec_des22").val(data.fec_des22);
		$('#fec_des22').selectpicker('refresh');
		$("#mon_des22").val(data.mon_des22);

		$("#fec_des23").val(data.fec_des23);
		$('#fec_des23').selectpicker('refresh');
		$("#mon_des23").val(data.mon_des23);

		$("#fec_des24").val(data.fec_des24);
		$('#fec_des24').selectpicker('refresh');
		$("#mon_des24").val(data.mon_des24);

		$("#fec_des25").val(data.fec_des25);
		$('#fec_des25').selectpicker('refresh');
		$("#mon_des25").val(data.mon_des25);

		$("#fec_des26").val(data.fec_des26);
		$('#fec_des26').selectpicker('refresh');
		$("#mon_des26").val(data.mon_des26);

		$("#fec_des27").val(data.fec_des27);
		$('#fec_des27').selectpicker('refresh');
		$("#mon_des27").val(data.mon_des27);

		$("#fec_des28").val(data.fec_des28);
		$('#fec_des28').selectpicker('refresh');
		$("#mon_des28").val(data.mon_des28);

		$("#fec_des29").val(data.fec_des29);
		$('#fec_des29').selectpicker('refresh');
		$("#mon_des29").val(data.mon_des29);

		$("#fec_des30").val(data.fec_des30);
		$('#fec_des30').selectpicker('refresh');
		$("#mon_des30").val(data.mon_des30);





 
 	})
}

//Función para desactivar registros
function desaprobar(id_pre)
{
	bootbox.confirm("¿Está Seguro de desaprobar el prestamo?", function(result){
		if(result)
        {
        	$.post("../ajax/prestamos.php?op=desaprobar", {id_pre : id_pre}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function aprobar(id_pre)
{
	bootbox.confirm("¿Está Seguro de aprobar el prestamo?", function(result){
		if(result)
        {
        	$.post("../ajax/prestamos.php?op=aprobar", {id_pre : id_pre}, function(e){
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
