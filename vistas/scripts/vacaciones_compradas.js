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
	$.post("../ajax/vacaciones_compradas.php?op=selectFechaspago", function(r){
	            $("#id_cp_vac_com").html(r);
	            $('#id_cp_vac_com').selectpicker('refresh');
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
					url: '../ajax/vacaciones_compradas.php?op=listar',
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
					url: '../ajax/vacaciones_compradas.php?op=selectTrabajadoresDestajeros',
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
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/vacaciones_compradas.php?op=guardaryeditar",
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

function mostrar(id_permiso)
{
		$.post("../ajax/vacaciones_compradas.php?op=mostrar",{id_permiso : id_permiso}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);


		

		$("#nombres").val(data.nombres);
		$("#id_permiso").val(data.id_permiso);


		$("#fecha_procede").val(data.fecha_procede);
		$("#fecha_hasta").val(data.fecha_hasta);

		$("#pago_vac_comp").val(data.pago_vac_comp);

		
		$("#id_cp_vac_com").val(data.id_cp_vac_com);
		$('#id_cp_vac_com').selectpicker('refresh'); 


		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});

 	$.post("../ajax/vacaciones_compradas.php?op=listarDetalle&id_permiso="+id_permiso,function(r){
	        $("#detalles").html(r);
	});	
}

//Función para anular registros
function anular(nro_doc)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/vacaciones_compradas.php?op=anular", {nro_doc : nro_doc}, function(e){
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


function agregarDetalle(id_trab, nombres, sueldo, bono_des_trab)
  {
  		var prod_soles=0;

    if (id_trab!="")
    {
        var dif_soles=prod_soles-sueldo;
    	var fila='<tr class="filas" size="3" id="fila'+cont+'">'+
    	'<td><input type="text" size="3" readonly name="correlativo[]" ></td>'+
    	'<td><input type="hidden" size="40" name="id_trab[]" value="'+id_trab+'">'+nombres+'</td>'+
    	'<td><input type="hidden" size="15" readonly name="sueldo[]" value="'+sueldo+'">'+sueldo+'</td>'+
    	'<td><input type="hidden" size="15" readonly name="bono_des_trab[]" value="'+bono_des_trab+'">'+bono_des_trab+'</td>'+
    	'<td><input type="text" size="15" name="prod_soles[]" ></td>'+
    	'<td><input type="text" size="15" readonly name="dif_soles[]" ></td>'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#detalles').append(fila);
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del trabajador");
    }	

  }



 





  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	calcularTotales();
  	detalles=detalles-1;
  	
  }

init();