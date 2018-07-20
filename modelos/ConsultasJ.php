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
		$sql="SELECT	cod_argumento as area,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tare'";
						
		return ejecutarConsulta($sql);		
	}	
}

?>