<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Modelo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

  //Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT	m.id_modelo,
									m.id_marca as 'marca',
									ma.nombre,
									m.codigo,
									m.cod_mod,
									m.nom_mod,
									m.est_mod,
									m.tip_mod,
									m.lin_mod,
									m.ima_mod,
									m.pb_mod,
									m.pn_mod,
									m.fec_cre
									FROM modelojf m
									LEFT JOIN marcas ma
									ON m.id_marca=ma.id_marca";

		return ejecutarConsulta($sql);
	}


}

?>
