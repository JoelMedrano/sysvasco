var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	

	//Cargamos los items al select personal
	$.post("../ajax/consultasD.php?op=selectPersonalNombreLargo", function(r){
	            $("#id_trab").html(r);
	            $('#id_trab').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de permiso
	$.post("../ajax/registro_manual_horas_dias.php?op=selectAccion", function(r){
	            $("#id_accion").html(r);
	            $('#id_accion').selectpicker('refresh');

	});



	//Cargamos los items al select tipo de permiso
	$.post("../ajax/registro_manual_horas_dias.php?op=selectOpciones", function(r){
	            $("#id_descontar_ref").html(r);
	            $('#id_descontar_ref').selectpicker('refresh');

	});










	$("#imagenmuestra1").hide();
	$("#imagenmuestra2").hide();
	$("#imagenmuestra3").hide();
	$("#imagenmuestra4").hide();


}

//Función limpiar
function limpiar()
{
	$("#id_rmhd").val("");
	$("#fecha").val("");
	$("#hora_ing").val("");
	$("#hora_sal").val("");
	$("#obs").val("");

	$("#tip_permiso").val("COMISION");
	$("#tip_permiso").selectpicker('refresh');

	$("#id_trab").val("AGUILAR CAMACHO LUISA");
	$("#id_trab").selectpicker('refresh');

	$("#id_accion").val("AGREGAR");
	$("#id_accion").selectpicker('refresh');

	$("#horas_dscto_esp").val("");

	





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
					url: '../ajax/registro_manual_horas_dias.php?op=listar',
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
		url: "../ajax/registro_manual_horas_dias.php?op=guardaryeditar",
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

function mostrar(id_rmhd)
{
	$.post("../ajax/registro_manual_horas_dias.php?op=mostrar",{id_rmhd : id_rmhd}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh');

		$("#id_rmhd").val(data.id_rmhd);
		$("#fecha").val(data.fecha);
		$("#hora_ing").val(data.hora_ing); 
		$("#hora_sal").val(data.hora_sal);
		$("#obs").val(data.obs);


		$("#hora_ing_especial").val(data.hora_ing_especial); 
		$("#hora_sal_especial").val(data.hora_sal_especial);

		$("#horas_dscto_esp").val(data.horas_dscto_esp);
		

		$("#id_accion").val(data.id_accion);
		$('#id_accion').selectpicker('refresh'); 


		$("#id_descontar_ref").val(data.id_accion);
		$('#id_descontar_ref').selectpicker('refresh'); 

	
 	})


}



//AGREGADO EL 06122018 - LEYDI GODOS

function filtrar()
{

	id_trab = $("#id_trab").val();
	fecha = $("#fecha").val();



	$.post("../ajax/registro_manual_horas_dias.php?op=filtrar",{id_trab : id_trab, fecha : fecha  }, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		
		$("#hora_ing").val(data.hora_ing); 
		$("#hora_sal").val(data.hora_sal);
		$("#fecha").val(data.fecha);

		$("#id_trab").val(data.id_trab);
		$('#id_trab').selectpicker('refresh'); 

		
		$("#falta").val(data.falta); 

	
 	})




}




//Función para desactivar registros
function desactivar(id_permiso)
{
	bootbox.confirm("¿Está seguro de desactivar el permiso?", function(result){
		if(result)
        {
        	$.post("../ajax/registro_manual_horas_dias.php?op=desactivar", {id_permiso : id_permiso}, function(e){
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
        	$.post("../ajax/registro_manual_horas_dias.php?op=activar", {id_permiso : id_permiso}, function(e){
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
        	$.post("../ajax/registro_manual_horas_dias.php?op=desaprobar", {id_permiso : id_permiso}, function(e){
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
        	$.post("../ajax/registro_manual_horas_dias.php?op=aprobar", {id_permiso : id_permiso}, function(e){
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
        	$.post("../ajax/registro_manual_horas_dias.php?op=desaprobarRRHH", {id_permiso : id_permiso}, function(e){
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
        	$.post("../ajax/registro_manual_horas_dias.php?op=aprobarRRHH", {id_permiso : id_permiso}, function(e){
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