var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

	//Cargamos los items al select categoria
	$.post("../ajax/articulo.php?op=selectCategoria", function(r){
	            $("#idcategoria").html(r);
	            $('#idcategoria').selectpicker('refresh');

	});

	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$("#id_ano").val("");
	$("#obs_reg_pen").val("");
	$("#id_reg_pen").val("");
	$("#onp_apo_obl").val("");
	$("#onp_com_men_rem").val("");
	$("#onp_com_men").val("");
	$("#onp_pri_seg").val("");
	$("#onp_apo_act").val("");
	$("#onp_apo_mix").val("");
	$("#int_apo_obl").val("");
	$("#int_com_men_rem").val("");
	$("#int_com_anu").val("");
	$("#int_com_men").val("");
	$("#int_pri_seg").val("");
	$("#int_apo_act").val("");
	$("#int_apo_mix").val("");
	$("#pri_apo_obl").val("");
	$("#pri_com_men_rem").val("");
	$("#pri_com_anu").val("");
	$("#pri_com_men").val("");
	$("#pri_pri_seg").val("");
	$("#pri_apo_act").val("");
	$("#pri_apo_mix").val("");
	$("#pro_apo_obl").val("");
	$("#pro_com_men_rem").val("");
	$("#pro_com_anu").val("");
	$("#pro_com_men").val("");
	$("#pro_pri_seg").val("");
	$("#pro_apo_act").val("");
	$("#pro_apo_mix").val("");
	$("#hab_apo_obl").val("");
	$("#hab_com_men_rem").val("");
	$("#hab_com_anu").val("");
	$("#hab_com_men").val("");
	$("#hab_pri_seg").val("");
	$("#hab_apo_act").val("");
	$("#hab_apo_mix").val("");
	$("#sj_apo_obl").val("");
	$("#sj_com_men_rem").val("");
	$("#sj_apo_mix").val("");


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
					url: '../ajax/regimen_pensionario.php?op=listar',
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
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/regimen_pensionario.php?op=guardaryeditar",
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

function mostrar(id_reg_pen)
{
	$.post("../ajax/regimen_pensionario.php?op=mostrar",{id_reg_pen : id_reg_pen}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		

		$("#id_reg_pen").val(data.id_reg_pen);
		$("#id_ano").val(data.id_ano);
		$("#obs_reg_pen").val(data.obs_reg_pen);
		$("#onp_apo_obl").val(data.onp_apo_obl);
		$("#onp_com_men_rem").val(data.onp_com_men_rem);
		$("#onp_com_anu").val(data.onp_com_anu);
 		$("#onp_com_men").val(data.onp_com_men);
 		$("#onp_pri_seg").val(data.onp_pri_seg);
 		$("#onp_apo_act").val(data.onp_apo_act);
 		$("#onp_apo_mix").val(data.onp_apo_mix);
 		$("#int_apo_obl").val(data.int_apo_obl);
 		$("#int_com_men_rem").val(data.int_com_men_rem);
 		$("#int_com_anu").val(data.int_com_anu);
 		$("#int_com_men").val(data.int_com_men);
 		$("#int_pri_seg").val(data.int_pri_seg);
 		$("#int_apo_act").val(data.int_apo_act);
 		$("#int_apo_mix").val(data.int_apo_mix);
 		$("#pri_apo_obl").val(data.pri_apo_obl);
 		$("#pri_com_men_rem").val(data.pri_com_men_rem);
 		$("#pri_com_anu").val(data.pri_com_anu);
 		$("#pri_com_men").val(data.pri_com_men);
 		$("#pri_pri_seg").val(data.pri_pri_seg);
 		$("#pri_apo_act").val(data.pri_apo_act);
 		$("#pri_apo_mix").val(data.pri_apo_mix);
 		$("#pro_apo_obl").val(data.pro_apo_obl);
 		$("#pro_com_men_rem").val(data.pro_com_men_rem);
 		$("#pro_com_anu").val(data.pro_com_anu);
 		$("#pro_com_men").val(data.pro_com_men);
 		$("#pro_pri_seg").val(data.pro_pri_seg);
 		$("#pro_apo_act").val(data.pro_apo_act);
 		$("#pro_apo_mix").val(data.pro_apo_mix);
 		$("#hab_apo_obl").val(data.hab_apo_obl);
 		$("#hab_com_men_rem").val(data.hab_com_men_rem);
 		$("#hab_com_anu").val(data.hab_com_anu);
 		$("#hab_com_men").val(data.hab_com_men);
 		$("#hab_pri_seg").val(data.hab_pri_seg);
 		$("#hab_apo_act").val(data.hab_apo_act);
 		$("#hab_apo_mix").val(data.hab_apo_mix);
 		$("#sj_apo_obl").val(data.sj_apo_obl);
 		$("#sj_com_men_rem").val(data.sj_com_men_rem);
 		$("#sj_apo_mix").val(data.sj_apo_mix);

 	})
}

//Función para desactivar registros
function desactivar(id_reg_pen)
{
	bootbox.confirm("¿Está seguro de desactivar el regimen pensionario?", function(result){
		if(result)
        {
        	$.post("../ajax/regimen_pensionario.php?op=desactivar", {id_reg_pen : id_reg_pen}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_reg_pen)
{
	bootbox.confirm("¿Está seguro de activar el regimen pensionario?", function(result){
		if(result)
        {
        	$.post("../ajax/regimen_pensionario.php?op=activar", {id_reg_pen : id_reg_pen}, function(e){
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
