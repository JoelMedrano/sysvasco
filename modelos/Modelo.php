<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Modelo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_marca,$cod_mod,$nom_mod,$tip_mod,$lin_mod,$imagen,$pv_mod,$cmp_mod,$idusuario)
	{
		$sql="INSERT INTO modelojf (id_marca,cod_mod,nom_mod,est_mod,tip_mod,lin_mod,imagen,pv_mod,cmp_mod,idusuario)
		VALUES ('$id_marca','$cod_mod','$nom_mod','1','$tip_mod','$lin_mod','$imagen','$pv_mod','$cmp_mod','$idusuario')";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($id_modelo,$id_marca,$cod_mod,$nom_mod,$tip_mod,$lin_mod,$imagen,$pv_mod,$cmp_mod,$idusuario)
	{
		$sql="UPDATE modelojf SET id_marca='$id_marca',
															cod_mod='$cod_mod',
															nom_mod='$nom_mod',
															tip_mod='$tip_mod',
															lin_mod='$lin_mod',
															imagen='$imagen',
															pv_mod='$pv_mod',
															cmp_mod='$cmp_mod',
															idusuario='$idusuario'
															WHERE id_modelo='$id_modelo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_modelo)
	{
		$sql="SELECT * FROM modelojf WHERE id_modelo='$id_modelo'";
		return ejecutarConsultaSimpleFila($sql);
	}


  //Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT	m.id_modelo,
									m.id_marca as 'marca',
									ma.nombre,
									m.cod_mod,
									m.nom_mod,
									m.est_mod,
									m.tip_mod,
									m.lin_mod,
									m.imagen,
									m.pv_mod,
									m.cmp_mod,
									m.fec_cre
									FROM modelojf m
									LEFT JOIN marcas ma
									ON m.id_marca=ma.id_marca";

									return ejecutarConsulta($sql);
	}

	//para seleccionar el tipo
	public function selectTipo(){
		$sql="SELECT	tip_mod
									FROM modelojf
									GROUP BY tip_mod";

  							  return ejecutarConsulta($sql);

	}


	//Implementamos un método para desactivar registros
	public function desactivar($id_modelo)
	{
		$sql="UPDATE modelojf SET est_mod=0 WHERE id_modelo='$id_modelo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_modelo)
	{
		$sql="UPDATE modelojf SET est_mod=1 WHERE id_modelo='$id_modelo'";
		return ejecutarConsulta($sql);
	}

	//select modelo

	public function selectMod()
	{
		$sql="SELECT 		m.id_modelo,
										m.cod_mod,
										CONCAT(m.cod_mod,' ',m.nom_mod,' - ',ma.nombre) AS modelo
										FROM modelojf m
										LEFT JOIN marcas ma
										ON m.id_marca=ma.id_marca
										LEFT JOIN cotizacion c
										ON m.cod_mod=c.cod_mod
										WHERE c.cod_mod IS NULL";

		return ejecutarConsulta($sql);
	}

}

?>
