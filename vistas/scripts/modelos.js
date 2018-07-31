/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/

/*$.ajax({
  url:"../ajax/datatable-modelos.ajax.php",
  success:function(respuesta){

    console.log("respuesta", respuesta);
  }

})*/

$('.tablaModelos').DataTable( {

    dom: 'Bfrtip',//Definimos los elementos del control de tabla
    buttons:  [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'
              ],
    "ajax": "../ajax/datatable-modelos.ajax.php",

} );

/*=============================================
CAPTURANDO LA MARCA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaMarca").change(function(){

    var cod_argumento = $(this).val();

    var datos = new FormData();
  	datos.append("cod_argumento", cod_argumento);

    	$.ajax({

        url:"../ajax/modelos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success:function(respuesta){

          console.log("respuesta", respuesta);

        }

  	})

})
