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


	//Cargamos los items al select cliente
	$.post("../ajax/consultasD.php?op=selectSituacionInformativaAnterior", function(r){
	            $("#id_sit_inf_ant").html(r);
	            $('#id_sit_inf_ant').selectpicker('refresh');
	});	


	//Cargamos los items al select cliente
	$.post("../ajax/consultasD.php?op=selectSituacionInformativaActual", function(r){
	            $("#id_sit_inf_act").html(r);
	            $('#id_sit_inf_act').selectpicker('refresh');
	});	


	



}

//Función limpiar
function limpiar()
{

	$("#id_nomtrab").val("");
	$("#id_nomtrab").selectpicker('refresh');

	$("#id_trab").val("");
	$("#nro_doc").val("");
	$("#sucursal").val("");
	$("#area_trab").val("");
	$("#fec_ing_trab").val("");



	$("#tie_ren_ant").val("");
	$("#fec_ini_ant").val("");
	$("#fec_fin_ant").val("");
	$("#tie_ren_con").val("");
	$("#fec_ini_con").val("");
	$("#fec_fin_con").val("");


	$("#id_sit_inf_ant").val("");
	$("#id_sit_inf_ant").selectpicker('refresh');

	$("#id_sit_inf_act").val("");
	$("#id_sit_inf_act").selectpicker('refresh');

	
	
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

		$("#btnGuardar").show();
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
					url: '../ajax/historial_contratos.php?op=listar',
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
					url: '../ajax/historial_contratos.php?op=selectPeriodosVacaciones',
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
		url: "../ajax/historial_contratos.php?op=guardaryeditar",
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

function mostrar(nro_doc)
{
		$.post("../ajax/historial_contratos.php?op=mostrar",{nro_doc : nro_doc}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_nomtrab").val(data.id_nomtrab);
		$("#id_nomtrab").selectpicker('refresh');

		$("#nro_doc").val(data.nro_doc);
		$("#apemat_trab").val(data.apemat_trab);
		$("#id_trab").val(data.id_trab);

		$("#sucursal").val(data.sucursal);
		$("#area_trab").val(data.area_trab);

		$("#fec_ing_trab").val(data.fec_ing_trab);

		$("#id_con_trab").val(data.id_con_trab);

		$("#CantItems").val(data.CantItems);

		$("#fec_ini_ant").val(data.fec_ini_ant);
		$("#fec_fin_ant").val(data.fec_fin_ant);
        $("#tie_ren_ant").val(data.tie_ren_ant);


        $("#id_sit_inf_ant").val(data.id_sit_inf_ant);
		$("#id_sit_inf_ant").selectpicker('refresh');
		


		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});


	$.post("../ajax/historial_contratos.php?op=listarDetalle&id="+nro_doc,function(r){
	        $("#detalles").html(r);
	});




 	
}

//Función para anular registros
function anular(nro_doc)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/contratos.php?op=anular", {nro_doc : nro_doc}, function(e){
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
$("#btnGuardar").show();
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



function agregarDetalle(id_periodo,periodo)
  {
  	
  	
    if (id_periodo!="")
    {
    	
    	var fila='<tr class="filas" size="3" id="fila'+cont+'">'+
    	'<td><input type="text" size="1" name="correlativo[]" ></td>'+
    	'<td><input type="hidden" size="5" name="id_periodo[]" value="'+id_periodo+'">'+periodo+'</td>'+
    	'<td><input type="text" size="8" name="fec_del[]" ></td>'+
    	'<td><input type="text" size="8" name="fec_al[]" ></td>'+
    	'<td><input type="text" size="2" name="tot_dias[]" ></td>'+
    	'<td><input type="text" size="2" name="pen_dias[]" ></td>'+
    	'<td><input type="text" size="70" name="obser_detalle[]" ></td>'+
    	'<td><input type="text" size="20" name="obser[]" ></td>'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
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
  	
  }

init();