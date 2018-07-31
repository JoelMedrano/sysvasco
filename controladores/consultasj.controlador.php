<?php

 require_once "../modelos/consultasj.modelo.php";

class ControladorConsultasJ{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarAreas(){

		$respuesta = ModeloConsultasJ::mdlMostrarAreas();

		return $respuesta;

	}

}
