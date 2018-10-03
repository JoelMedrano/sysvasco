<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class FT_hoja2_1
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
  ftc.idftc,
  ftc.idmft,
  CONCAT(ftc.com_color,' - ',cc.combo_color) AS com_color,
  CONCAT(ftc.tela1,' - ',t1.desc_1) AS tela1,
  CONCAT(ftc.color1,' - ',c1.color_1) AS color1,
  CONCAT(ftc.tela2,' - ',t2.desc_2) AS tela2,
  CONCAT(ftc.color2,' - ',c2.color_2) AS color2,
  CONCAT(ftc.tela3,' - ',t3.desc_3) AS tela3,
  CONCAT(ftc.color3,' - ',c3.color_3) AS color3
FROM
  fic_teccomb ftc 
  LEFT JOIN 
    (SELECT 
      RIGHT(cod_argumento, 2) AS com_color,
      des_larga AS combo_color 
    FROM
      tabla_m_detalle 
    WHERE cod_tabla = 'tcol' 
      AND cod_argumento < 100) AS cc 
    ON ftc.com_color = cc.com_color 
  LEFT JOIN 
    (SELECT 
      RIGHT(cod_argumento, 2) AS cod_color1,
      des_larga AS color_1 
    FROM
      tabla_m_detalle 
    WHERE cod_tabla = 'tcol' 
      AND cod_argumento < 100) AS c1 
    ON ftc.color1 = c1.cod_color1 
  LEFT JOIN 
    (SELECT 
      RIGHT(cod_argumento, 2) AS cod_color2,
      des_larga AS color_2 
    FROM
      tabla_m_detalle 
    WHERE cod_tabla = 'tcol' 
      AND cod_argumento < 100) AS c2 
    ON ftc.color2 = c2.cod_color2 
  LEFT JOIN 
    (SELECT 
      RIGHT(cod_argumento, 2) AS cod_color3,
      des_larga AS color_3 
    FROM
      tabla_m_detalle 
    WHERE cod_tabla = 'tcol' 
      AND cod_argumento < 100) AS c3 
    ON ftc.color3 = c3.cod_color3 
  LEFT JOIN 
    (SELECT DISTINCT 
      IFNULL(Tabla_M_Detalle.Des_Larga, '') AS linea,
      SUBSTRING(Producto.CodFab, 1, 6) AS sublinea1,
      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS desc_1,
      IFNULL(Tabla_M_Detalle_2.Des_Corta, '') AS und 
    FROM
      Producto 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle 
        ON LEFT(Producto.CodFab, 3) = Tabla_M_Detalle.Des_Corta 
        AND (
          Tabla_M_Detalle.Cod_Tabla = 'TLIN' 
          OR Tabla_M_Detalle.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 
        ON SUBSTRING(Producto.CodFab, 4, 3) = Tabla_M_Detalle_1.Valor_3 
        AND (
          Tabla_M_Detalle_1.Cod_Tabla = 'TSUB' 
          OR Tabla_M_Detalle_1.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_2 
        ON Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
        AND (
          Tabla_M_Detalle_2.Cod_Tabla = 'TUND' 
          OR Tabla_M_Detalle_2.Cod_Tabla IS NULL
        ) 
    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
      AND EstPro = '1') AS t1 
    ON ftc.tela1 = t1.sublinea1 
  LEFT JOIN 
    (SELECT DISTINCT 
      IFNULL(Tabla_M_Detalle.Des_Larga, '') AS linea,
      SUBSTRING(Producto.CodFab, 1, 6) AS sublinea2,
      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS desc_2,
      IFNULL(Tabla_M_Detalle_2.Des_Corta, '') AS und 
    FROM
      Producto 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle 
        ON LEFT(Producto.CodFab, 3) = Tabla_M_Detalle.Des_Corta 
        AND (
          Tabla_M_Detalle.Cod_Tabla = 'TLIN' 
          OR Tabla_M_Detalle.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 
        ON SUBSTRING(Producto.CodFab, 4, 3) = Tabla_M_Detalle_1.Valor_3 
        AND (
          Tabla_M_Detalle_1.Cod_Tabla = 'TSUB' 
          OR Tabla_M_Detalle_1.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_2 
        ON Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
        AND (
          Tabla_M_Detalle_2.Cod_Tabla = 'TUND' 
          OR Tabla_M_Detalle_2.Cod_Tabla IS NULL
        ) 
    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
      AND EstPro = '1') AS t2 
    ON ftc.tela2 = t2.sublinea2 
  LEFT JOIN 
    (SELECT DISTINCT 
      IFNULL(Tabla_M_Detalle.Des_Larga, '') AS linea,
      SUBSTRING(Producto.CodFab, 1, 6) AS sublinea3,
      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS desc_3,
      IFNULL(Tabla_M_Detalle_2.Des_Corta, '') AS und 
    FROM
      Producto 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle 
        ON LEFT(Producto.CodFab, 3) = Tabla_M_Detalle.Des_Corta 
        AND (
          Tabla_M_Detalle.Cod_Tabla = 'TLIN' 
          OR Tabla_M_Detalle.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 
        ON SUBSTRING(Producto.CodFab, 4, 3) = Tabla_M_Detalle_1.Valor_3 
        AND (
          Tabla_M_Detalle_1.Cod_Tabla = 'TSUB' 
          OR Tabla_M_Detalle_1.Cod_Tabla IS NULL
        ) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_2 
        ON Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
        AND (
          Tabla_M_Detalle_2.Cod_Tabla = 'TUND' 
          OR Tabla_M_Detalle_2.Cod_Tabla IS NULL
        ) 
    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
      AND EstPro = '1') AS t3 
    ON ftc.tela3 = t3.sublinea3 
WHERE ftc.idmft = '$idmft'";

    return ejecutarConsulta($sql);
  }

  public function eliminar($idmft){

    $sql="DELETE FROM det01_fictec WHERE idmft='$idmft'";

    return ejecutarConsulta($sql);
  }

  public function listarCombos(){
      $sql="SELECT 
                        mft.idmft,
                        mft.cod_mod,
                        m.nom_mod,
                        fc.cod_color,
                        c.color,
                        CONCAT(mft.cod_mod,' - ',fc.cod_color,' - ',c.color) AS detalle  
                        FROM
                        maestro_ficha_tecnica mft 
                        LEFT JOIN fictec_color fc 
                            ON mft.idmft = fc.idmft 
                        LEFT JOIN 
                            (SELECT 
                            RIGHT(cod_argumento, 2) AS cod_color,
                            des_larga AS color 
                            FROM
                            tabla_m_detalle 
                            WHERE cod_tabla = 'tcol' 
                            AND cod_argumento < 100) AS c 
                            ON fc.cod_color = c.cod_color 
                        LEFT JOIN modelojf m 
                            ON mft.cod_mod = m.cod_mod";

      return ejecutarConsulta($sql);
  }

  public function selectTela1(){
    $sql="SELECT DISTINCT 
    SUBSTRING(Producto.CodFab, 1, 6) AS tela1,
    CONCAT(SUBSTRING(Producto.CodFab, 1, 6),' - ',IFNULL(Tabla_M_Detalle_1.Des_Larga, '')) AS nom_tela1
  FROM
    Producto 
    LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle 
      ON LEFT(Producto.CodFab, 3) = Tabla_M_Detalle.Des_Corta 
      AND (
        Tabla_M_Detalle.Cod_Tabla = 'TLIN' 
        OR Tabla_M_Detalle.Cod_Tabla IS NULL
      ) 
    LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 
      ON SUBSTRING(Producto.CodFab, 4, 3) = Tabla_M_Detalle_1.Valor_3 
      AND (
        Tabla_M_Detalle_1.Cod_Tabla = 'TSUB' 
        OR Tabla_M_Detalle_1.Cod_Tabla IS NULL
      ) 
    LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_2 
      ON Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
      AND (
        Tabla_M_Detalle_2.Cod_Tabla = 'TUND' 
        OR Tabla_M_Detalle_2.Cod_Tabla IS NULL
      ) 
  WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
    AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
    AND EstPro = '1'
    ORDER BY SUBSTRING(Producto.CodFab, 1, 6)";

    return ejecutarConsulta($sql);
  }


}

?>
