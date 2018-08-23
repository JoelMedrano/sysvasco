var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})

	//Cargamos los items al select la marca
	$.post("../ajax/modelo.php?op=selectMarca", function(r){
							$("#id_marca").html(r);
							$('#id_marca').selectpicker('refresh');

	});

	//Cargamos los items al select el tipo
	$.post("../ajax/modelo.php?op=selectTipo", function(r){
							$("#tip_mod").html(r);
							$('#tip_mod').selectpicker('refresh');

	});

	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$("#cod_mod").val("");
	$("#nom_mod").val("");
	$("#tip_mod").val("");
	$("#lin_mod").val("");
	$("#pv_mod").val("");
	$("#cmp_mod").val("");
	$("#imagenmuestra").attr("style","display: none;");
	$("#imagenactual").val("");
	$("#id_modelo").val("");
	$("#imagen").attr("src","");

}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$('#cod_mod').focus();
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
					url: '../ajax/modelo.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 12,//Paginación
	  "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/modelo.php?op=guardaryeditar",
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

function mostrar(id_modelo)
{
	$.post("../ajax/modelo.php?op=mostrar",{id_modelo : id_modelo}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#id_marca").val(data.id_marca);
		$('#id_marca').selectpicker('refresh');
		$("#cod_mod").val(data.cod_mod);
		$("#nom_mod").val(data.nom_mod);
		$("#tip_mod").val(data.tip_mod);
		$('#tip_mod').selectpicker('refresh');
		$("#lin_mod").val(data.lin_mod);
		$("#pv_mod").val(data.pv_mod);
		$("#cmp_mod").val(data.cmp_mod);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/modelos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
 		$("#id_modelo").val(data.id_modelo);

 	})
}

//Función para desactivar registros
function desactivar(id_modelo)
{
	bootbox.confirm("¿Está Seguro de desactivar el modelo?", function(result){
		if(result)
        {
        	$.post("../ajax/modelo.php?op=desactivar", {id_modelo : id_modelo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función para activar registros
function activar(id_modelo)
{
	bootbox.confirm("¿Está Seguro de activar el modelo?", function(result){
		if(result)
        {
        	$.post("../ajax/modelo.php?op=activar", {id_modelo : id_modelo}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}


init();
