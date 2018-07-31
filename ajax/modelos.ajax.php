<?php

require_once  "../controladores/modelos.controlador.php";
require_once  "../modelos/modelos.modelo.php";

require_once  "../controladores/consultasj.controlador.php";
require_once  "../modelos/consultasj.modelo.php";

class AjaxModelos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $cod_argumento;

  public function ajaxCrearCodigoModelo(){

    $item = "cod_argumento";
    $valor = $this->cod_argumento;


    $respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);

    echo json_encode($respuesta);

  }

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/

if(isset($_POST["cod_argumento"])){

	$codigoModelo = new AjaxModelos();
	$codigoModelo -> cod_argumento = $_POST["cod_argumento"];
	$codigoModelo -> ajaxCrearCodigoModelo();

}
