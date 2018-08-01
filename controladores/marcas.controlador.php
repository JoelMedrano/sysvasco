<?php

 require_once "../modelos/marcas.modelo.php";

class ControladorMarcas{

  /*=============================================
	CREAR MARCAS
	=============================================*/
  static public function ctrCrearMarca(){

      if(isset($_POST["nuevaMarca"])){

          if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])){

              $tabla = "marcas";
              $datos = $_POST["nuevaMarca"];

              $respuesta = ModeloMarcas::mdlIngresarMarca($tabla, $datos);

              if ($respuesta == "ok") {

                echo'<script>

            					swal({
            						  type: "success",
            						  title: "La marca ha sido guardada correctamente",
            						  showConfirmButton: true,
            						  confirmButtonText: "Cerrar"
            						  }).then(function(result){
            									if (result.value) {

            									window.location = "marcas.php";

            									}
            								})

            					</script>';

              }

          }else {
              echo'<script>

                    swal({
                        type: "error",
                        title: "¡La marca no puede ir vacía o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                        if (result.value) {

                        window.location = "marca.php";

                        }
                      })

                    </script>';
          }

      }

  }

	/*=============================================
	MOSTRAR MARCAS
	=============================================*/

	static public function ctrMostrarMarcas($item, $valor){

		$tabla = "marcas";

		$respuesta = ModeloMarcas::mdlMostrarMarcas($tabla, $item, $valor);

		return $respuesta;

	}

}
