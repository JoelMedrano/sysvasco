<?php

class TablaModelos{

  /*=============================================
  MOSTRAR LA TABLA DE MODELOS
  =============================================*/

  public function mostrarTablaModelos(){

    $imagen = "<img src='../files/modelos/default/anonymous.png' width='40px'>";
    $botenes =  "<div class="btn-group">

                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div";

    echo '{
            "data": [
              [
                "1",
                "JACKYFORM",
                "10010",
                "TRUZA SPORT",
                "ACTIVO",
                "TRUZA",
                "020",
                "'.$imagen.'",
                "0.00",
                "0.00",
                "2018-07-23 12:40:10",
                "botones"
              ],
              [
                "2",
                "JACKYFORM",
                "10011",
                "TANGA OLIMPICA",
                "ACTIVO",
                "TRUZA",
                "030",
                "'.$imagen.'",
                "0.00",
                "0.00",
                "2018-07-23 12:40:10",
                "botones"
              ]
            ]
          }';

  }
}

/*=============================================
ACTIVAR TABLA MODELOS
=============================================*/

$activarModelos = new TablaModelos();
$activarModelos -> mostrarTablaModelos();
