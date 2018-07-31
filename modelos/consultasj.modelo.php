<?php

require_once "conexion.php";

class ModeloConsultasJ{

	/*=============================================
	MOSTRAR Modelos
	=============================================*/

	static public function mdlMostrarAreas(){


      $stmt = Conexion::conectar()->prepare("SELECT cod_argumento,
																										cod_tabla,
																										des_larga FROM tabla_maestra_detalle WHERE cod_tabla='TMAR'");

      $stmt -> execute();

      return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;


  }

}
