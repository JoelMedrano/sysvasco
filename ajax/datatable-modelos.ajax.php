<?php

require_once  "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

class TablaModelos{

  /*=============================================
  MOSTRAR LA TABLA DE MODELOS
  =============================================*/
    public function mostrarTablaModelos(){

      $item = null;
      $valor = null;

      $modelos = ControladorModelos::ctrMostrarModelos($item,$valor);

      $botones =  "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

      $datosJson = '{
              "data": [';

              for ($i=0; $i < count($modelos); $i++) {

                $imagen =   "<img src='".$modelos[$i]["ima_mod"]."' width='40px'>";

                $datosJson .= '[
                      "'.($i+1).'",
                      "'.$modelos[$i]["id_marca"].'",
                      "'.$modelos[$i]["cod_mod"].'",
                      "'.$modelos[$i]["nom_mod"].'",
                      "'.$modelos[$i]["est_mod"].'",
                      "'.$modelos[$i]["tip_mod"].'",
                      "'.$modelos[$i]["lin_mod"].'",
                      "'.$imagen.'",
                      "S/ '.number_format($modelos[$i]["pb_mod"],2).'",
                      "S/ '.number_format($modelos[$i]["pn_mod"],2).'",
                      "'.$modelos[$i]["fec_cre"].'",
                      "'.$botones.'"
                    ],';
              }

              $datosJson = substr($datosJson,0,-1);
              $datosJson .=']

            }';

      echo $datosJson;

    }
  }

/*=============================================
ACTIVAR TABLA MODELOS
=============================================*/

$activarModelos = new TablaModelos();
$activarModelos -> mostrarTablaModelos();
