<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class FT_hoja2
{
	//Implementamos nuestro constructor
	public function __construct()
	{

  }

  public function listar()
  {
    $sql="SELECT		mft.idmft,
                    DATE(mft.fecha_hora) AS fecha,
                    m.id_marca,
                    ma.nombre AS marca,
                    mft.cod_mod,
                    m.nom_mod,
                    mft.id_trab,
                    CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador,
                    mft.idusuario,
                    UPPER(u.nombre) AS desarrollador,
                    (SELECT nombre FROM usuario u WHERE u.idusuario=mft.vb_mft) AS vb,
                    mft.estado,
                    mft.editable
                    FROM maestro_ficha_tecnica mft
                    LEFT JOIN modelojf m
                    ON mft.cod_mod=m.cod_mod
                    LEFT JOIN marcas ma
                    ON m.id_marca=ma.id_marca
                    LEFT JOIN usuario u
                    ON mft.idusuario=u.idusuario
                    LEFT JOIN trabajador t
                    ON mft.id_trab=t.id_trab";

    return ejecutarConsulta($sql);
  }

	public function mostrar($idmft){


	}


}

?>
