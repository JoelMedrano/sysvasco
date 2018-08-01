<?php

require_once "conexion.php";

class ModeloModelos{

	/*=============================================
	MOSTRAR Modelos
	=============================================*/

	static public function mdlMostrarModelos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT	*	FROM $tabla WHERE $item = :$item ORDER BY id_modelo DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}
