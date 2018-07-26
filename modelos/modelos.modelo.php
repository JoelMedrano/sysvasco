<?php

require_once "conexion.php";

class ModeloModelos{

	/*=============================================
	MOSTRAR Modelos
	=============================================*/

	static public function mdlMostrarModelos($item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT		id_modelo,
																											des_larga AS id_area,
																											cod_mod,
																											nom_mod,
																											est_mod,
																											tip_mod,
																											lin_mod,
																											ima_mod,
																											pb_mod,
																											pn_mod,
																											fec_cre
																											FROM modelojf m
																											LEFT JOIN
																											(SELECT
																											cod_argumento AS 'id_area',
																											cod_tabla,
																											des_larga
																											FROM tabla_maestra_detalle tmd
																											WHERE cod_tabla='tmar') AS mar
																											ON m.id_marca=mar.id_area WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT		id_modelo,
																											des_larga AS id_marca,
																											cod_mod,
																											nom_mod,
																											est_mod,
																											tip_mod,
																											lin_mod,
																											ima_mod,
																											pb_mod,
																											pn_mod,
																											fec_cre
																											FROM modelojf m
																											LEFT JOIN
																											(SELECT
																											cod_argumento AS 'id_area',
																											cod_tabla,
																											des_larga
																											FROM tabla_maestra_detalle tmd
																											WHERE cod_tabla='tmar') AS mar
																											ON m.id_marca=mar.id_area");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}
