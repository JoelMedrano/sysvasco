<?php

require_once "conexion.php";

class ModeloMarcas{

  /*=============================================
  MOSTRAR CATEGORIAS
  =============================================*/

  static public function mdlMostrarMarcas($item, $valor){

      if($item != null){

          $stmt = Conexion::conectar()->prepare("SELECT * FROM modelojf WHERE $item = :$item");

          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

          $stmt -> execute();

          return $stmt -> fetch();

      }else{

          $stmt = Conexion::conectar()->prepare("SELECT * FROM modelojf ");

          $stmt -> execute();

          return $stmt -> fetchAll();

      }

    $stmt -> close();

    $stmt = null;

  }

}
