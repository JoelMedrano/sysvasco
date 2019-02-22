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
					url: '../ajax/habilitarabono_tiempoextra_enreloj.php?op=listar',
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
					url: '../ajax/habilitarabono_tiempoextra_enreloj.php?op=selectPermisosTardanzasNoDescontadas',
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
		url: "../ajax/habilitarabono_tiempoextra_enreloj.php?op=guardaryeditar",
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
		$.post("../ajax/habilitarabono_tiempoextra_enreloj.php?op=mostrar",{id_cp : id_cp}, function(data, status)
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

 	$.post("../ajax/habilitarabono_tiempoextra_enreloj.php?op=listarDetalle&id="+id_cp,function(r){
	        $("#detalles").html(r);
	});	
}

//Función para habilitar registros
function habilitar_abono(id_hor_ext)
{
	bootbox.confirm("Abonar el tiempo extra?", function(result){
		if(result)
        {
        	$.post("../ajax/habilitarabono_tiempoextra_enreloj.php?op=habilitar_abono", {id_hor_ext : id_hor_ext}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload(null, false);
        	});	
        }
	})
}

//Función para anular registros
function desabilitar_abono(id_hor_ext)
{
	bootbox.confirm("¿No abonar el tiempo extra?", function(result){
		if(result)
        {
        	$.post("../ajax/habilitarabono_tiempoextra_enreloj.php?op=desabilitar_abono", {id_hor_ext : id_hor_ext}, function(e){
        		bootbox.alert(e);
	           tabla.ajax.reload(null, false);
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

function agregarDetalle(id_hor_per,fecha)
  {
  	

    if (id_hor_per!="")
    {
    	
    	var fila='<tr class="filas" size="3" id="fila'+cont+'">'+
    	'<td><input type="text" size="7" name="id_hor_per[]" value="'+id_hor_per+'" ></td>'+
    	'<td><input type="hidden" size="7" name="fecha[]" value="'+fecha+'"></td>'+
    	'<td><input type="text" size="40" name="fec_del[]" ></td>'+
    	'<td><input type="text" size="15" name="fec_al[]" ></td>'+
    	'<td><input type="text" size="15" name="tot_dias[]" ></td>'+
    	'<td><input type="text" size="25" name="pen_dias[]" ></td>'+
    	'<td><input type="text" size="30" name="obser_detalle[]" ></td>'+
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