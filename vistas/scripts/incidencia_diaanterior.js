var tabla;

//Función que se ejecuta al inicio
function init(){
	
	
	listar_IncidenciaDiaAnterior();

}



//Función Listar
function listar_IncidenciaDiaAnterior()
{
	tabla=$('#tbllistado_incidencias').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		           
		        ],
		"ajax":
				{
					url: '../ajax/incidencias_diaanterior.php?op=listarIncidenciasDiaAnterior',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 15,//Paginación
	    "order": [[ 7, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


init();