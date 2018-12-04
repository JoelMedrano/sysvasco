<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Confeccion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idmft,$id_operacion,$descripcion,$idtipo_maquina,$idcodigo_puntada,$ancho_costura,$puntadas_pulgadas)
	{
		$sql="INSERT INTO confeccion (idmft,id_operacion,descripcion,idtipo_maquina,idcodigo_puntada,ancho_costura,puntadas_pulgadas)
		VALUES ('$idmft','$id_operacion','$descripcion','$idtipo_maquina','$idcodigo_puntada','$ancho_costura','$puntadas_pulgadas')";

		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($idconfeccion,$idmft,$id_operacion,$descripcion,$idtipo_maquina,$idcodigo_puntada,$ancho_costura,$puntadas_pulgadas)
	{
		$sql="UPDATE confeccion SET idmft='$idmft',id_operacion='$id_operacion',descripcion='$descripcion',idtipo_maquina='$idtipo_maquina',idcodigo_puntada='$idcodigo_puntada',ancho_costura='$ancho_costura',puntadas_pulgadas='$puntadas_pulgadas' WHERE idconfeccion='$idconfeccion'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idconfeccion)
	{
		$sql="DELETE FROM confeccion WHERE idconfeccion='$idconfeccion'";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idconfeccion)
	{
		$sql="SELECT * FROM confeccion where idconfeccion='$idconfeccion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT 
						c.idconfeccion,
						mft.idmft,
						m.cod_mod,
						m.nom_mod,
						c.id_operacion,
						o.nombre AS operacion,
						c.descripcion,
						c.idtipo_maquina,
						tm.nombre AS tipo_maquina,
						c.idcodigo_puntada,
						cp.nombre AS codigo_puntada,
						c.ancho_costura,
						c.puntadas_pulgadas 
						FROM
						confeccion c 
						LEFT JOIN maestro_ficha_tecnica mft 
							ON c.idmft = mft.idmft 
						LEFT JOIN modelojf m 
							ON mft.cod_mod = m.cod_mod 
						LEFT JOIN operacion o 
							ON o.id_operacion = c.id_operacion 
						LEFT JOIN tipo_maquina tm 
							ON c.idtipo_maquina = tm.idtipo_maquina 
						LEFT JOIN codigo_puntada cp 
							ON c.idcodigo_puntada = cp.idcodigo_puntada";
	
		return ejecutarConsulta($sql);

	}

	public function selectFT()
	{
		$sql="SELECT 
					mft.idmft,
					CONCAT(mft.idmft,' - ',mft.cod_mod,' - ',m.nom_mod) AS ft
				FROM
					maestro_ficha_tecnica mft
					LEFT JOIN modelojf m
					ON mft.cod_mod=m.cod_mod";

		return ejecutarConsulta($sql);

	}

	public function selectOP()
	{
		$sql="SELECT 
					o.id_operacion,
					o.nombre 
				FROM
					operacion o ";

		return ejecutarConsulta($sql);
	}

	public function selectTM()
	{
		$sql="SELECT 
					idtipo_maquina,
					nombre 
				FROM
					tipo_maquina ";

		return ejecutarConsulta($sql);
	}

	public function selectCP($idtipo_maquina)
	{
		$sql="SELECT 
		idcodigo_puntada,
		nombre 
	  FROM
		codigo_puntada 
	  WHERE idtipo_maquina = '$idtipo_maquina' ";

		return ejecutarConsulta($sql);
	}

	public function selectCP2()
	{
		$sql="SELECT 
		idcodigo_puntada,
		nombre 
	  FROM
		codigo_puntada ";

		return ejecutarConsulta($sql);
	}

}

?>
