<?php

require_once "../modelos/marca.php";

class ControladorMarcas{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearMarca(){

		if(isset($_POST["nuevaMarca"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])){

				$datos = $_POST["nuevaMarca"];

				$respuesta = ModeloMarcas::mdlIngresarMarca($datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "marca.php";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
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
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarmarcas($item, $valor){

		$tabla = "marcas";

		$respuesta = ModeloMarcas::mdlMostrarMarcas($tabla, $item, $valor);

		return $respuesta;

	}

}
