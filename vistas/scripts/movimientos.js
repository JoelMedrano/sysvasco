var tabla;

//Función que se ejecuta al inicio
function init(){
	listar();
	$("#fecha_inicio").change(listar);
	$("#fecha_fin").change(listar);

	//Cargamos los items al select cliente
	$.post("../ajax/movimientos.php?op=selectTipo", function(r){
							$("#tipo").html(r);
							$('#tipo').selectpicker('refresh');
	});

}


//Función Listar
function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

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
					url: '../ajax/movimientos.php?op=movsfecha',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin},
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 22,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para anular registros
function eliminar(fecha)
{
	bootbox.confirm("¿Está Seguro de eliminar los movimientos de esta fecha?", function(result){
		if(result)
        {
        	$.post("../ajax/movimientos.php?op=eliminar", {fecha : fecha}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
}

//Función Listar
function listarA()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var tipo = $("#tipo").val();

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
					url: '../ajax/movimientos.php?op=movstipo',
					data:{fecha_inicio: fecha_inicio,fecha_fin: fecha_fin, tipo: tipo},
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


init();
