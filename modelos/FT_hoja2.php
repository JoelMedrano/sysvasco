<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class FT_hoja2
{
	//Implementamos nuestro constructor
	public function __construct()
	{

  }

  	//Implementamos un método para insertar registros
	public function insertar($idmft,$molde,$idarticulo,$desc_pieza,$cant_pieza,$sent_tela,$tapete,$collareta,$consumo,$tono,$observaciones)
	{
    $sql="UPDATE maestro_ficha_tecnica SET molde='$molde' where idmft='$idmft'";
    
		//return ejecutarConsulta($sql);
		$idfictecnew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO det01_fictec(idmft,idarticulo,desc_pieza,cant_pieza,sent_tela,tapete,collareta,consumo, tono,observaciones) VALUES ('$idmft', '$idarticulo[$num_elementos]','$desc_pieza[$num_elementos]','$cant_pieza[$num_elementos]','$sent_tela[$num_elementos]','$tapete[$num_elementos]','$collareta[$num_elementos]','$consumo[$num_elementos]','$tono[$num_elementos]','$observaciones[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

  public function listar()
  {
    $sql="SELECT    mft.idmft,
                    DATE(mft.fecha_hora) AS fecha,
                    m.id_marca,
                    ma.nombre AS marca,
                    mft.cod_mod,
                    m.nom_mod,
                    mft.id_trab,
                    CONCAT(
                      t.apepat_trab,
                      ' ',
                      t.apemat_trab,
                      ' ',
                      t.nom_trab
                    ) AS diseñador,
                    mft.idusuario,
                    UPPER(u.nombre) AS desarrollador,
                    (SELECT
                      nombre
                    FROM
                      usuario u
                    WHERE u.idusuario = mft.vb_mft) AS vb,
                    mft.estado,
                    mft.editable
                  FROM
                    maestro_ficha_tecnica mft
                    LEFT JOIN modelojf m
                      ON mft.cod_mod = m.cod_mod
                    LEFT JOIN marcas ma
                      ON m.id_marca = ma.id_marca
                    LEFT JOIN usuario u
                      ON mft.idusuario = u.idusuario
                    LEFT JOIN trabajador t
                      ON mft.id_trab = t.id_trab";

    return ejecutarConsulta($sql);
  }

	public function mostrar($idmft){

    $sql="SELECT      mft.idmft,
                      mft.cod_mod,
                      m.nom_mod,
                      mft.tela1_mod,
                      mft.tela2_mod,
                      mft.tela3_mod,
                      mft.molde 
                    FROM
                      maestro_ficha_tecnica mft 
                      LEFT JOIN modelojf m 
                        ON mft.cod_mod = m.cod_mod 
                    WHERE m.nom_mod IS NOT NULL
                    AND mft.idmft = '$idmft'";

    return ejecutarConsultaSimpleFila($sql);
  }
  

  public function selectFT(){
    $sql="SELECT    mft.idmft,
                    mft.cod_mod,
                    m.nom_mod,
                    CONCAT(
                      mft.idmft,
                      ' - ',
                      mft.cod_mod,
                      ' - ',
                      m.nom_mod
                    ) AS ftmod 
                  FROM
                    maestro_ficha_tecnica mft 
                    LEFT JOIN modelojf m 
                      ON mft.cod_mod = m.cod_mod 
                  WHERE m.nom_mod IS NOT NULL 
                  ORDER BY mft.idmft";

    return ejecutarConsulta($sql);
  }


  public function listarDetalle($idmft){
    $sql="SELECT 
                  dt.idmft,
                  dt.iddet1,
                  dt.idarticulo,
                  CONCAT(dt.idarticulo, ' - ', t.nombre) AS nombre,
                  dt.desc_pieza,
                  dt.cant_pieza,
                  dt.sent_tela,
                  dt.tapete,
                  dt.collareta,
                  dt.consumo,
                  dt.tono,
                  dt.observaciones,
                  IFNULL((1 / dt.consumo), 0) AS subtotal 
                FROM
                  det01_fictec dt 
                  LEFT JOIN 
                    (SELECT 
                      SUBSTRING(pro.codfab, 1, 6) AS idarticulo,
                      tmd.des_larga AS nombre,
                      tmd.des_corta AS cod_linea,
                      lin.linea 
                    FROM
                      producto pro 
                      LEFT JOIN tabla_m_detalle AS tmd 
                        ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                      LEFT JOIN 
                        (SELECT 
                          SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                          tmd.des_larga AS linea,
                          tmd.des_corta AS cod_linea 
                        FROM
                          producto pro 
                          LEFT JOIN tabla_m_detalle AS tmd 
                            ON LEFT(pro.codfab, 3) = tmd.des_corta 
                        WHERE pro.estpro = '1' 
                          AND tmd.cod_tabla = 'tlin' 
                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                        ON SUBSTRING(pro.codfab, 1, 6) = cod_sublinea 
                    WHERE pro.estpro = '1' 
                      AND tmd.cod_tabla = 'tsub' 
                      AND tmd.des_corta = lin.cod_linea 
                    GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t 
                    ON dt.idarticulo = t.idarticulo 
                WHERE dt.idmft = '$idmft' 
                ORDER BY dt.idarticulo";

    return ejecutarConsulta($sql);
  }

  public function eliminar($idmft){

    $sql="DELETE FROM det01_fictec WHERE idmft='$idmft'";

    return ejecutarConsulta($sql);
  }


}

?>
