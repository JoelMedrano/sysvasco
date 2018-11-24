var tabla;

//Función que se ejecuta al inicio
function init(){
	
	
	//Cargamos los items al select cliente
	$.post("../ajax/planilla.php?op=selectFechaPago", function(r){
	            $("#fecha_pago").html(r);
	            $('#fecha_pago').selectpicker('refresh');
	});
}



init();
