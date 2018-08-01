<?php

require_once  "../controladores/modelos.controlador.php";
require_once  "../modelos/modelos.modelo.php";

require_once  "../controladores/consultasj.controlador.php";
require_once  "../modelos/consultasj.modelo.php";

class AjaxModelos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idMarca;

  public function ajaxCrearCodigoModelo(){

    $item = "id_marca";
    $valor = $this->idMarca;


    $respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);

    echo json_encode($respuesta);

  }

}

/*=============================================
GENERAR CÓDIGO A PARTIR DE ID MARCA
=============================================*/

if(isset($_POST["idMarca"])){

	$codigoModelo = new AjaxModelos();
	$codigoModelo -> idMarca = $_POST["idMarca"];
	$codigoModelo -> ajaxCrearCodigoModelo();

}
