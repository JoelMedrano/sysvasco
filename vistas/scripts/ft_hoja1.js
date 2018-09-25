var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});

	$.post("../ajax/ft_hoja1.php?op=colores&id=",function(r){
					$("#colores").html(r);
	});

  //Cargamos los items al select cliente
  $.post("../ajax/ft_hoja1.php?op=selectModelos", function(r){
              $("#cod_mod").html(r);
              $('#cod_mod').selectpicker('refresh');
  });

  //Cargamos los items al select cliente
  $.post("../ajax/ft_hoja1.php?op=selectDiseñador", function(r){
              $("#id_trab").html(r);
              $('#id_trab').selectpicker('refresh');
  });

  //Cargamos los items al select cliente
  $.post("../ajax/ft_hoja1.php?op=selectTela1", function(r){
              $("#tela1_mod").html(r);
              $('#tela1_mod').selectpicker('refresh');
  });

  //Cargamos los items al select cliente
  $.post("../ajax/ft_hoja1.php?op=selectTela2", function(r){
              $("#tela2_mod").html(r);
              $('#tela2_mod').selectpicker('refresh');
  });

  //Cargamos los items al select cliente
  $.post("../ajax/ft_hoja1.php?op=selectTela3", function(r){
              $("#tela3_mod").html(r);
              $('#tela3_mod').selectpicker('refresh');
  });

  $("#imagenmuestra").hide();
  $("#imagenmuestra2").hide();

}

//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$('input[type=checkbox]').prop('checked', false);
	$("#nombre").val("");
	$("#descripcion").val("");

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
					url: '../ajax/ft_hoja1.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
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
		url: "../ajax/ft_hoja1.php?op=guardaryeditar",
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

function mostrar(idmft)
{
	$.post("../ajax/ft_hoja1.php?op=mostrar",{idmft : idmft}, function(data, status)
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
		$("#fecha_hora").val(data.fecha);

    $("#imagenmuestra").show();
    $("#imagenmuestra").attr("src","../files/fichas_tecnicas/"+data.imagen);
    $("#imagenactual").val(data.imagen);

    $("#imagenmuestra2").show();
    $("#imagenmuestra2").attr("src","../files/fichas_tecnicas/"+data.imagen2);
    $("#imagenactual2").val(data.imagen2);


		$("#idmft").val(data.idmft);

 	});

	$.post("../ajax/ft_hoja1.php?op=colores&id="+idmft,function(r){
					$("#colores").html(r);
	});
}


//Función para anular registros
function rechazar(idmft)
{
	bootbox.confirm("¿Está Seguro de rechazar la FT?", function(result){
		if(result)
        {
        	$.post("../ajax/ft_hoja1.php?op=rechazar", {idmft : idmft}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para anular registros
function aprobar(idmft,idusuario)
{
	bootbox.confirm("¿Está Seguro de aprobar la FT?", function(result){
		if(result)
        {
        	$.post("../ajax/ft_hoja1.php?op=aprobar", {idmft : idmft}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para anular registros
function eliminar(idmft)
{
	bootbox.confirm("¿Está Seguro de eliminar la FT?", function(result){
		if(result)
        {
        	$.post("../ajax/ft_hoja1.php?op=eliminar", {idmft : idmft}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


init();
