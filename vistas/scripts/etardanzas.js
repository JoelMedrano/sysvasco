var tabla;

//Función que se ejecuta al inicio
function init(){
	
	listar();

}

//Función limpiar


//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		           
		        ],
		"ajax":
				{
					url: '../ajax/consultasj.php?op=listarTardanzas',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 3, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}





init();