var tabla;

//Función que se ejecuta al inicio
function init(){

	mostrarformDatos(true);

	mostrarDatos(id_trab);


	$("#formularioDatos").on("submit",function(e)
	{
		guardaryeditardatos(e);	
	});

	


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
function mostrarformDatos(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").hide();
		$("#formularioregistrosDatos").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#formularioregistrosDatos").hide();
		$("#btnagregar").show();
	}
}


//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarformDatos(false);
}


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
	          mostrarformDatos(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}


function guardaryeditardatos(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formularioDatos")[0]);

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
	          mostrarformDatos(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}


function mostrarDatos(id_trab)
{
	$.post("../ajax/trabajador_datos.php?op=mostrarDatos",{id_trab : id_trab}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarformDatos(true);

	

		$("#id_trab").val(data.id_trab);
		$("#nom_trab").val(data.nom_trab);
		$("#apepat_trab").val(data.apepat_trab);
		$("#apemat_trab").val(data.apemat_trab);
		$("#num_doc_trab").val(data.num_doc_trab);
		


	


 	})
}


init();