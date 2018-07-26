<?php

 require_once "../modelos/modelos.modelo.php";

class ControladorModelos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarModelos($item, $valor){


		$respuesta = ModeloModelos::mdlMostrarModelos($item, $valor);

		return $respuesta;

	}

}
