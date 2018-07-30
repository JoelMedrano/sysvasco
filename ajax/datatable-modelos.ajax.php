<?php

class TablaModelos{

  /*=============================================
  MOSTRAR LA TABLA DE MODELOS
  =============================================*/

  public function mostrarTablaModelos(){

    $imagen = "<img src='../files/modelos/default/anonymous.png' width='40px'>";


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
