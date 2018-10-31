var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
	


	//Cargamos los items al select Fechas 
	$.post("../ajax/prestamos.php?op=selectFechaDscto1", function(r){
	            $("#fec_des1").html(r);
	            $('#fec_des1').selectpicker('refresh');

	});


}

//Función limpiar
function limpiar()
{
	$("#Ano").val("");
	$("#id_cp").val("");
	$("#id_hor_lac").val("");
	$("#cantidad_horas").val("");


	$("#fec_des1").val("");
	$("#fec_des1").selectpicker('refresh');



   
}


//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
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
					url: '../ajax/horas_lactancia.php?op=listar',
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
					url: '../ajax/horas_lactancia.php?op=selectTrabajadoresDestajeros',
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
		url: "../ajax/horas_lactancia.php?op=guardaryeditar",
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

function mostrar(id_hor_lac)
{
		$.post("../ajax/horas_lactancia.php?op=mostrar",{id_hor_lac : id_hor_lac}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);



		$("#fec_des1").val(data.fec_des1);
		$('#fec_des1').selectpicker('refresh');

		$("#id_hor_lac").val(data.id_hor_lac);
		$("#CantItems").val(data.CantItems);
		$("#Ano").val(data.Ano);
		$("#Descrip_fec_pag").val(data.Descrip_fec_pag);
		$("#id_cp").val(data.id_cp);
		$("#cantidad_horas").val(data.cantidad_horas);

	
		//Ocultar y mostrar los botones
		$("#btnGuardar").show();
		$("#btnCancelar").show();
		//$("#btnAgregarArt").hide();
		$("#btnAgregarArt").show();
 	});

 	
}

//Función para anular registros
function anular(nro_doc)
{
	bootbox.confirm("¿Está Seguro de anular la venta?", function(result){
		if(result)
        {
        	$.post("../ajax/horas_lactancia.php?op=anular", {nro_doc : nro_doc}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


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