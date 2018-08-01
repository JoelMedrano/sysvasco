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

    var idMarca = $(this).val();

    var datos = new FormData();
  	datos.append("idMarca", idMarca);

    	$.ajax({

        url:"../ajax/modelos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

          if(!respuesta){

            var nuevoCodigo = idMarca+"001";
            $("#nuevoCodigo").val(nuevoCodigo);

          }else{

            var nuevoCodigo = Number(respuesta["codigo"]) + 1;
            $("#nuevoCodigo").val(nuevoCodigo);

          }
        }
  	})

})

/*=============================================
AGREGANDO PRECIO DE NETO
=============================================*/

$("#nuevoPreBru").change(function(){

  if($(".porcentaje").prop("checked")){

    var valorPorcentaje = $(".nuevoPorcentaje").val();

    var porcentaje = Number(($("#nuevoPreBru").val()*valorPorcentaje/100))+Number($("#nuevoPreBru").val());

    $("#nuevoPreNet").val(porcentaje);
    $("#nuevoPreNet").prop("readonly", true);

  }

})
