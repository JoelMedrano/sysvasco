<?php

 require_once "../modelos/modelos.modelo.php";

class ControladorModelos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarModelos($item, $valor){

    $tabla= "modelojf";

		$respuesta = ModeloModelos::mdlMostrarModelos($tabla, $item, $valor);

		return $respuesta;

	}

}
