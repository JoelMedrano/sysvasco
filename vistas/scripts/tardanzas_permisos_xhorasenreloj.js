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
					url: '../ajax/tardanzas_permisos_xhorasenreloj.php?op=listar',
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
					url: '../ajax/tardanzas_permisos_xhorasenreloj.php?op=selectPermisosTardanzasNoDescontadas',
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
		url: "../ajax/tardanzas_permisos_xhorasenreloj.php?op=guardaryeditar",
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
		$.post("../ajax/tardanzas_permisos_xhorasenreloj.php?op=mostrar",{id_cp : id_cp}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		


		$("#id_cp").val(data.id_cp);




		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});

 	$.post("../ajax/tardanzas_permisos_xhorasenreloj.php?op=listarDetalle&id="+id_cp,function(r){
	        $("#detalles").html(r);
	});	
}

//Función para anular registros
function desabilitar_descuento(id_cp)
{
	bootbox.confirm("¿Está Seguro de desabilitar descuento?", function(result){
		if(result)
        {
        	$.post("../ajax/tardanzas_permisos_xhorasenreloj.php?op=desabilitar_descuento", {id_cp : id_cp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


//Función para anular registros
function habilitar_descuento(id_cp)
{
	bootbox.confirm("¿Está Seguro de habilitar descuento?", function(result){
		if(result)
        {
        	$.post("../ajax/tardanzas_permisos_xhorasenreloj.php?op=habilitar_descuento", {id_cp : id_cp}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}





//Función para anular registros
function anular(nro_doc)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/tardanzas_permisos_xhorasenreloj.php?op=anular", {nro_doc : nro_doc}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto()
  {
  	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#impuesto").val(impuesto); 
    }
    else
    {
        $("#impuesto").val("0"); 
    }
  }

function agregarDetalle(id_hor_per,fecha,nombres, tiempo_des, tiempo_fin, incidencia, permiso,  observacion, situacion, estado  )
  {
  	

    if (id_hor_per!="")
    {
    	
    	var fila='<tr class="filas" size="3" id="fila'+cont+'">'+
    	'<td><input type="text" size="1" readonly name="id_hor_per[]" value="'+id_hor_per+'" ></td>'+
    	'<td><input type="text" size="7" readonly name="fecha[]" value="'+fecha+'"></td>'+
    	'<td><input type="text" size="30" readonly name="nombres[]" value="'+nombres+'"></td>'+
    	'<td><input type="text" size="7" readonly name="tiempo_des[]" value="'+tiempo_des+'"></td>'+
    	'<td><input type="text" size="7"  name="tiempo_fin[]" value="'+tiempo_fin+'"></td>'+
    	'<td><input type="text" size="10" readonly name="incidencia[]" value="'+incidencia+'"></td>'+
    	'<td><input type="text" size="15" readonly name="permiso[]" value="'+permiso+'"></td>'+
    	'<td><input type="text" size="25"  name="observacion[]" value="'+observacion+'"></td>'+
    	'<td><input type="text" size="15" readonly name="situacion[]" value="'+situacion+'"></td>'+
    	'<td><input type="text" size="15" readonly name="estado[]" value="'+estado+'"></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    	modificarSubototales();
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del periodo");
    }

  }

  function modificarSubototales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var desc = document.getElementsByName("descuento[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i <cant.length; i++) {
    	var inpC=cant[i];
    	var inpP=prec[i];
    	var inpD=desc[i];
    	var inpS=sub[i];

    	inpS.value=(inpC.value * inpP.value)-inpD.value;
    	document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();

  }
  function calcularTotales(){
  	var sub = document.getElementsByName("subtotal");
  	var total = 0.0;

  	for (var i = 0; i <sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/. " + total);
    $("#total_venta").val(total);

  }





  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	
  }

init();