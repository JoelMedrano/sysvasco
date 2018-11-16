var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	


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
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
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
					url: '../ajax/horasextras_horasdiasenreloj.php?op=listar',
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
					url: '../ajax/horasextras_horasdiasenreloj.php?op=selectHorasExtrasNoAbonadas',
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
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/horasextras_horasdiasenreloj.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}

function mostrar(id_cp)
{
		$.post("../ajax/horasextras_horasdiasenreloj.php?op=mostrar",{id_cp : id_cp}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		


		$("#id_cp").val(data.id_cp);

		$("#num").val(data.num);

		




		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});

 	$.post("../ajax/horasextras_horasdiasenreloj.php?op=listarDetalle&id="+id_cp,function(r){
	        $("#detalles").html(r);
	});	
}

//Función para anular registros
function desabilitar_abono(id_cp)
{
	bootbox.confirm("¿Está Seguro de desabilitar abono?", function(result){
		if(result)
        {
        	$.post("../ajax/horasextras_horasdiasenreloj.php?op=desabilitar_abono", {id_cp : id_cp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


//Función para anular registros
function habilitar_abono(id_cp)
{
	bootbox.confirm("¿Está Seguro de habilitar abono?", function(result){
		if(result)
        {
        	$.post("../ajax/horasextras_horasdiasenreloj.php?op=habilitar_abono", {id_cp : id_cp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;


var cont = $('#num').val();


var detalles=0;




//$("#guardar").hide();
$("#btnGuardar").hide();


function agregarDetalle(id_hor_ext, fecha, nombres, estado_dia, cantidad, tiempo_fin, observacion, situacion,  estado)
  {
  	

    if (id_hor_ext!="")  
    {
    	
    	var fila='<tr class="filas" size="3" id="fila'+cont+'">'+
    	'<td><input type="text" readonly size="1" autocomplete="off"  name="id_hor_ext[]" value="'+id_hor_ext+'" ></td>'+
    	'<td><input type="text" readonly size="7" autocomplete="off" name="fecha[]" value="'+fecha+'"></td>'+
    	'<td><input type="text" readonly size="35" autocomplete="off" name="nombres[]" value="'+nombres+'"></td>'+
    	'<td><input type="text" readonly size="10" autocomplete="off" name="estado_dia[]" value="'+estado_dia+'"></td>'+
    	'<td><input type="text" readonly size="8" autocomplete="off" name="cantidad[]" value="'+cantidad+'"></td>'+
    	'<td><input type="text"  size="8" autocomplete="off" name="tiempo_fin[]" value="'+tiempo_fin+'"></td>'+
    	'<td><input type="text" size="45" autocomplete="off" name="observacion[]" value="'+observacion+'"></td>'+
    	'<td><input type="text" readonly autocomplete="off" size="10" name="situacion[]" value="'+situacion+'"></td>'+
    	'<td><input type="text" readonly autocomplete="off" size="10" name="estado[]" value="'+estado+'"></td>'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del periodo");
    }

  }

 





  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();

  	detalles=detalles-1;
  	
  }

init();