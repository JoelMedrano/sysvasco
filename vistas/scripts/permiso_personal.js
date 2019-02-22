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


	//Cargamos los items al select tipo de permiso
	$.post("../ajax/consultasD.php?op=selectVacacionesCompradas", function(r){
	            $("#id_vac_com").html(r);
	            $('#id_vac_com').selectpicker('refresh');

	});






	//Cargamos los items al select personal
	$.post("../ajax/consultasD.php?op=selectPersonalNombreLargo", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});

	//Cargamos los items al select Fechas 
	$.post("../ajax/permiso_personal.php?op=selectFechaPagoVacaciones1", function(r){
	            $("#id_fecha_pago1").html(r);
	            $('#id_fecha_pago1').selectpicker('refresh');

	});

	//Cargamos los items al select Fechas 
	$.post("../ajax/permiso_personal.php?op=selectFechaPagoVacaciones2", function(r){
	            $("#id_fecha_pago2").html(r);
	            $('#id_fecha_pago2').selectpicker('refresh');

	});


	//Cargamos los items al select Fechas 
	$.post("../ajax/permiso_personal.php?op=selectFechaPagoVacaciones3", function(r){
	            $("#id_fecha_pago3").html(r);
	            $('#id_fecha_pago3').selectpicker('refresh');

	});

	//Cargamos los items al select Fechas 
	$.post("../ajax/permiso_personal.php?op=selectFechaPagoVacaciones4", function(r){
	            $("#id_fecha_pago4").html(r);
	            $('#id_fecha_pago4').selectpicker('refresh');

	});







	$("#imagenmuestra1").hide();
	$("#imagenmuestra2").hide();
	$("#imagenmuestra3").hide();
	$("#imagenmuestra4").hide();


}

//Función limpiar
function limpiar()
{
	$("#fecha_emision").val("");
	$("#fecha_procede").val("");
	$("#fecha_hasta").val("");
	$("#dias").val("");
	$("#id_permiso").val("");
	$("#id_trab").val("");
	$("#hora_ing").val("");
	$("#hora_sal").val("");
	$("#motivo").val("");


	$("#monto_a_pagar").val("");

	

	$("#tip_permiso").val("COMISION");
	$("#tip_permiso").selectpicker('refresh');

	$("#id_trab").val("AGUILAR CAMACHO LUISA FLORA");
	$("#id_trab").selectpicker('refresh');



	$("#id_fecha_pago1").val("");
	$("#id_fecha_pago1").selectpicker('refresh');

	$("#id_fecha_pago2").val("");
	$("#id_fecha_pago2").selectpicker('refresh');

	$("#id_fecha_pago3").val("");
	$("#id_fecha_pago3").selectpicker('refresh');

	$("#id_fecha_pago4").val("");
	$("#id_fecha_pago4").selectpicker('refresh');




	$("#imagenmuestra1").attr("src","");
	$("#imagenactual1").val("");

	$("#imagenmuestra2").attr("src","");
	$("#imagenactual2").val("");

	$("#imagenmuestra3").attr("src","");
	$("#imagenactual3").val("");

	$("#imagenmuestra4").attr("src","");
	$("#imagenactual4").val("");


}

//Función mostrar formulario
function mostrarform(flag)
{
	//limpiar();
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
		$("#dias").val(data.dias); 


		$("#tip_permiso").val(data.tip_permiso);
		$('#tip_permiso').selectpicker('refresh'); 

		$("#id_fecha_pago1").val(data.id_fecha_pago1);
		$('#id_fecha_pago1').selectpicker('refresh'); 

		$("#monto_a_pagar").val(data.monto_a_pagar); 

		
		$("#id_fecha_pago2").val(data.id_fecha_pago2);
		$('#id_fecha_pago2').selectpicker('refresh'); 

		$("#id_fecha_pago3").val(data.id_fecha_pago3);
		$('#id_fecha_pago3').selectpicker('refresh'); 

		$("#id_fecha_pago4").val(data.id_fecha_pago4);
		$('#id_fecha_pago4').selectpicker('refresh'); 


		$("#hora_ing").val(data.hora_ing);
		$("#hora_sal").val(data.hora_sal);
 		$("#motivo").val(data.motivo);



 		$("#imagenmuestra1").show();
		$("#imagenmuestra1").attr("src","../files/permisos_personal/"+data.imagen1);
		$("#imagenactual1").val(data.imagen1);

		$("#imagenmuestra2").show();
		$("#imagenmuestra2").attr("src","../files/permisos_personal/"+data.imagen2);
		$("#imagenactual2").val(data.imagen2);


		$("#imagenmuestra3").show();
		$("#imagenmuestra3").attr("src","../files/permisos_personal/"+data.imagen3);
		$("#imagenactual3").val(data.imagen3);


		$("#imagenmuestra4").show();
		$("#imagenmuestra4").attr("src","../files/permisos_personal/"+data.imagen4);
		$("#imagenactual4").val(data.imagen4);



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




//Función para desactivar registros
function eliminar(id_permiso)
{
	bootbox.confirm("¿Está seguro de eliminar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=eliminar", {id_permiso : id_permiso}, function(e){
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


//Función para desactivar registros
function desaprobarRRHH(id_permiso)
{
	bootbox.confirm("¿Está seguro de desaprobar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=desaprobarRRHH", {id_permiso : id_permiso}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function aprobarRRHH(id_permiso)
{
	bootbox.confirm("¿Está seguro de aprobar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/permiso_personal.php?op=aprobarRRHH", {id_permiso : id_permiso}, function(e){
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