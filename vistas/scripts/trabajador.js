var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	

	//Cargamos los items al select funcion del trabajador
	$.post("../ajax/consultasD.php?op=selectFuncion", function(r){
	            $("#id_funcion").html(r);
	            $('#id_funcion').selectpicker('refresh');

	});


	//Cargamos los items al select area del trabajador
	$.post("../ajax/consultasD.php?op=selectArea", function(r){
	            $("#id_area").html(r);
	            $('#id_area').selectpicker('refresh');

	});




	//Cargamos los items al select tipo de documento
	$.post("../ajax/consultasD.php?op=selectTipoDocumento", function(r){
	            $("#id_tip_doc").html(r);
	            $('#id_tip_doc').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectTipoPlanilla", function(r){
	            $("#id_tip_plan").html(r);
	            $('#id_tip_plan').selectpicker('refresh');

	});


   //Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectCentroCostos", function(r){
	            $("#id_cen_cost").html(r);
	            $('#id_cen_cost').selectpicker('refresh');

	});


	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectManoDeObra", function(r){
	            $("#id_tip_man_ob").html(r);
	            $('#id_tip_man_ob').selectpicker('refresh');

	});



	//Cargamos los items al select tipo de planilla
	$.post("../ajax/consultasD.php?op=selectSucursal", function(r){
	            $("#id_sucursal").html(r);
	            $('#id_sucursal').selectpicker('refresh');

	});



	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectCategoriaLaboral", function(r){
	            $("#id_categoria").html(r);
	            $('#id_categoria').selectpicker('refresh');

	});


	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectFormaDePago", function(r){
	            $("#id_form_pag").html(r);
	            $('#id_form_pag').selectpicker('refresh');

	});



	//Cargamos los items al select categoria laboral
	$.post("../ajax/consultasD.php?op=selectTipoContrato", function(r){
	            $("#id_tip_cont").html(r);
	            $('#id_tip_cont').selectpicker('refresh');

	});


	//Cargamos los items al select estado civil
	$.post("../ajax/consultasD.php?op=selectEstadoCivil", function(r){
	            $("#id_est_civil").html(r);
	            $('#id_est_civil').selectpicker('refresh');

	});



	//Cargamos los items al select regimen pensionario
	$.post("../ajax/consultasD.php?op=selectRegimenPensionario", function(r){
	            $("#id_reg_pen").html(r);
	            $('#id_reg_pen').selectpicker('refresh');

	});



	//Cargamos los items al select comision actual
	$.post("../ajax/consultasD.php?op=selectComisionActual", function(r){
	            $("#id_com_act").html(r);
	            $('#id_com_act').selectpicker('refresh');

	});




	//Cargamos los items al select genero
	$.post("../ajax/consultasD.php?op=selectGenero", function(r){
	            $("#id_genero").html(r);
	            $('#id_genero').selectpicker('refresh');

	});



	//Cargamos los items al select t registro
	$.post("../ajax/consultasD.php?op=selectTRegistro", function(r){
	            $("#id_t_registro").html(r);
	            $('#id_t_registro').selectpicker('refresh');

	});















	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$("#codigo").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");
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
					url: '../ajax/trabajador.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
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
		url: "../ajax/articulo.php?op=guardaryeditar",
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

function mostrar(id_trab)
{
	$.post("../ajax/trabajador.php?op=mostrar",{id_trab : id_trab}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#id_funcion").val(data.id_funcion);
		$('#id_funcion').selectpicker('refresh'); 

        $("#id_genero").val(data.id_genero);
		$('#id_genero').selectpicker('refresh'); 

		$("#id_tip_doc").val(data.id_tip_doc);
		$('#id_tip_doc').selectpicker('refresh'); 

		$("#id_tip_plan").val(data.id_tip_plan);
		$('#id_tip_plan').selectpicker('refresh');

		$("#id_sucursal").val(data.id_sucursal);
		$('#id_sucursal').selectpicker('refresh');

		$("#id_area").val(data.id_area);
		$('#id_area').selectpicker('refresh'); 

		$("#id_cen_cost").val(data.id_cen_cost);
		$('#id_cen_cost').selectpicker('refresh'); 

		$("#id_tip_man_ob").val(data.id_tip_man_ob);
		$('#id_tip_man_ob').selectpicker('refresh'); 

		$("#id_categoria").val(data.id_categoria);
		$('#id_categoria').selectpicker('refresh');

		$("#id_form_pag").val(data.id_form_pag);
		$('#id_form_pag').selectpicker('refresh');

		$("#id_tip_cont").val(data.id_tip_cont);
		$('#id_tip_cont').selectpicker('refresh');

		$("#id_est_civil").val(data.id_est_civil);
		$('#id_est_civil').selectpicker('refresh');

		$("#id_reg_pen").val(data.id_reg_pen);
		$('#id_reg_pen').selectpicker('refresh');

		$("#id_com_act").val(data.id_com_act);
		$('#id_com_act').selectpicker('refresh');

		$("#id_t_registro").val(data.id_t_registro);
		$('#id_t_registro').selectpicker('refresh');




		$("#id_trab").val(data.id_trab);
		$("#nom_trab").val(data.nom_trab);
		$("#apepat_trab").val(data.apepat_trab);
		$("#apemat_trab").val(data.apemat_trab);
		$("#num_doc_trab").val(data.num_doc_trab);
		


	


 	})
}

//Función para desactivar registros
function desactivar(idarticulo)
{
	bootbox.confirm("¿Está Seguro de desactivar el artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idarticulo)
{
	bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result){
		if(result)
        {
        	$.post("../ajax/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
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