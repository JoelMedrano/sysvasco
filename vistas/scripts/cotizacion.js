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
	$.post("../ajax/cotizacion.php?op=selectMod", function(r){
							$("#cod_mod").html(r);
							$('#cod_mod').selectpicker('refresh');
	});

	//Cargamos los items al select cliente
	$.post("../ajax/cotizacion.php?op=selectDiseñador", function(r){
							$("#id_trab").html(r);
							$('#id_trab').selectpicker('refresh');
	});

	//Cargamos los items al select cliente
	$.post("../ajax/cotizacion.php?op=selectTela1", function(r){
							$("#tela1_mod").html(r);
							$('#tela1_mod').selectpicker('refresh');
	});

	//Cargamos los items al select cliente
	$.post("../ajax/cotizacion.php?op=selectTela2", function(r){
							$("#tela2_mod").html(r);
							$('#tela2_mod').selectpicker('refresh');
	});

	//Cargamos los items al select cliente
	$.post("../ajax/cotizacion.php?op=selectTela3", function(r){
							$("#tela3_mod").html(r);
							$('#tela3_mod').selectpicker('refresh');
	});


}

//Función limpiar
function limpiar()
{

	$("#empresa").val("1");
	$('#empresa').selectpicker('refresh');
	$("#cod_mod").val("0");
	$('#cod_mod').selectpicker('refresh');
	$("#color_mod").val("");
	$("#tallas_mod").val("");
	$("#id_trab").val("0");
	$('#id_trab').selectpicker('refresh');
	$("#div_mod").val("");
	$("#temp_mod").val("");
	$("#dest_mod").val("");
	$("#tela1_mod").val("0");
	$('#tela1_mod').selectpicker('refresh');
	$("#tela2_mod").val("0");
	$('#tela2_mod').selectpicker('refresh');
	$("#tela3_mod").val("0");
	$('#tela3_mod').selectpicker('refresh');
	$("#bord_mod").val("0");
	$('#bord_mod').selectpicker('refresh');
	$("#esta_mod").val("0");
	$('#esta_mod').selectpicker('refresh');
	$("#manu_mod").val("0");
	$('#manu_mod').selectpicker('refresh');

	$("#idcotizacion").val("");

	$("#total_cotizacion").val("");
	$(".filas").remove();
	$("#total").html("0");

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);


}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
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
					url: '../ajax/cotizacion.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
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
					url: '../ajax/cotizacion.php?op=listarArticulosCotizacion',
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

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cotizacion.php?op=guardaryeditar",
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

function mostrar(idcotizacion)
{
	$.post("../ajax/cotizacion.php?op=mostrar",{idcotizacion : idcotizacion}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#cod_mod").val(data.cod_mod);
		$("#cod_mod").selectpicker('refresh');
		$("#empresa").val(data.empresa);
		$("#empresa").selectpicker('refresh');
		$("#color_mod").val(data.color_mod);
		$("#tallas_mod").val(data.tallas_mod);
		$("#id_trab").val(data.id_trab);
		$("#id_trab").selectpicker('refresh');
		$("#div_mod").val(data.div_mod);
		$("#temp_mod").val(data.temp_mod);
		$("#dest_mod").val(data.dest_mod);
		$("#tela1_mod").val(data.tela1_mod);
		$("#tela1_mod").selectpicker('refresh');
		$("#tela2_mod").val(data.tela2_mod);
		$("#tela2_mod").selectpicker('refresh');
		$("#tela3_mod").val(data.tela3_mod);
		$("#tela3_mod").selectpicker('refresh');
		$("#bord_mod").val(data.bord_mod);
		$("#bord_mod").selectpicker('refresh');
		$("#esta_mod").val(data.esta_mod);
		$("#esta_mod").selectpicker('refresh');
		$("#manu_mod").val(data.manu_mod);
		$("#manu_mod").selectpicker('refresh');

		$("#idcotizacion").val(data.idcotizacion);

		//Ocultar y mostrar los botones
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").hide();
 	});

 	$.post("../ajax/cotizacion.php?op=listarDetalle&id="+idcotizacion,function(r){
	        $("#detalles").html(r);
	});
}

//Función para anular registros
function rechazar(idcotizacion)
{
	bootbox.confirm("¿Está Seguro de rechazar la cotizacion?", function(result){
		if(result)
        {
        	$.post("../ajax/cotizacion.php?op=rechazar", {idcotizacion : idcotizacion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para anular registros
function aprobar(idcotizacion,idusuario)
{
	bootbox.confirm("¿Está Seguro de aprobar la cotizacion?", function(result){
		if(result)
        {
        	$.post("../ajax/cotizacion.php?op=aprobar", {idcotizacion : idcotizacion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


//Función para anular registros
function noeditar(idcotizacion)
{
	bootbox.confirm("¿Está Seguro de cerrar la cotizacion?", function(result){
		if(result)
        {
        	$.post("../ajax/cotizacion.php?op=noeditar", {idcotizacion : idcotizacion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para anular registros
function editar(idcotizacion)
{
	bootbox.confirm("¿Está Seguro de editar la cotizacion?", function(result){
		if(result)
        {
        	$.post("../ajax/cotizacion.php?op=editar", {idcotizacion : idcotizacion}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para anular registros
function eliminar(idcotizacion)
{
	bootbox.confirm("¿Está Seguro de eliminar la cotizacion?", function(result){
		if(result)
        {
        	$.post("../ajax/cotizacion.php?op=eliminar", {idcotizacion : idcotizacion}, function(e){
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

function agregarDetalle(idarticulo,articulo,precio_cotizacion)
  {
  	var cantidad=1;
    var descuento=0;

    if (idarticulo!="")
    {
    	var subtotal=cantidad*precio_cotizacion;
    	var fila='<tr class="filas" id="fila'+cont+'">'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
    	'<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'" step="any"></td>'+
    	'<td><input type="number" name="precio_cotizacion[]" id="precio_cotizacion[]" value="'+precio_cotizacion+'" step="any"></td>'+
    	'<td><input type="number" name="descuento[]" value="'+descuento+'" step="any"></td>'+
    	'<td><span name="subtotal" id="subtotal'+cont+'" step="any">'+subtotal+'</span></td>'+
    	'<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    	modificarSubototales();
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del artículo");
    }
  }

  function modificarSubototales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_cotizacion[]");
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
    $("#total_cotizacion").val(total);
    evaluar();
  }

  function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide();
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	evaluar()
  }

init();
