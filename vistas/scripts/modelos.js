/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/

$.ajax({
  url:"../ajax/datatable-modelos.ajax.php",
  success:function(respuesta){

    console.log("respuesta", respuesta);
  }

})

$('.tablaModelos').DataTable( {
    "ajax": "../ajax/datatable-modelos.ajax.php"
} );
