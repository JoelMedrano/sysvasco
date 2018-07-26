<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ConsultasJ
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Seleccionar desde la lista de trabajadores
	public function select()
	{
		$sql="SELECT	id_trab,
						CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab,' ',t.num_doc_trab,' - ',tf.des_larga,' - ',ta.des_larga) AS trabajador
						FROM trabajador t
						LEFT JOIN
						(SELECT
						cod_argumento,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tare') AS ta
						ON t.id_area=ta.cod_argumento
						LEFT JOIN
						(SELECT
						cod_argumento,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tfun') AS tf
						ON t.id_funcion=tf.cod_argumento
						ORDER BY apepat_trab";

		return ejecutarConsulta($sql);
	}

	//Seleccionar desde la lista de cargo
	public function selectFuncion()
	{
		$sql="SELECT	cod_argumento as cargo,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tfun'";

		return ejecutarConsulta($sql);
	}

	//Seleccionar desde la lista de areas
	public function selectArea()
	{
		$sql="SELECT	cod_argumento as 'id_area',
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tare'";

		return ejecutarConsulta($sql);
	}

	public function selectMarca()
	{
		$sql="SELECT	cod_argumento AS 'id_area',
									cod_tabla,
									des_larga
									FROM tabla_maestra_detalle tmd
									WHERE cod_tabla='tmar'";

		return ejecutarConsulta($sql);
	}

	public function modelosj()
	{
		$sql="SELECT	id_modelo,
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
									ON m.id_marca=mar.id_area";

									return ejecutarConsulta($sql);
	}


}

?>
