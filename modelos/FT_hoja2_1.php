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
	public function insertar($idmft,$com_color,$tela1,$tela2,$tela3,$color1,$color2,$color3)
	{
		$sql="INSERT INTO fic_teccomb (idmft,com_color,tela1,tela2,tela3,color1,color2,color3) 
          VALUES('$idmft','$com_color','$tela1','$tela2','$tela3','$color1','$color2','$color3')";

    return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function editar(	$idmft,$id_trab,$empresa,
													$color_mod,
													$tallas_mod,
													$div_mod,
													$temp_mod,
													$dest_mod,
													$tela1_mod,
													$tela2_mod,
													$tela3_mod,
													$bord_mod,
													$esta_mod,
													$manu_mod,
													$imagen,
													$imagen2,
													$colores)
	{


			 $sql="UPDATE maestro_ficha_tecnica SET id_trab='$id_trab',
			 																				empresa='$empresa',
																							color_mod='$color_mod',
																							tallas_mod='$tallas_mod',
																							div_mod='$div_mod',
																							temp_mod='$temp_mod',
																							dest_mod='$dest_mod',
																							tela1_mod='$tela1_mod',
																							tela2_mod='$tela2_mod',
																							tela3_mod='$tela3_mod',
																							bord_mod='$bord_mod',
																							esta_mod='$esta_mod',
																							manu_mod='$manu_mod',
																							imagen='$imagen',
																							imagen2='$imagen2'
																							WHERE idmft='$idmft'";


		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM fictec_color WHERE idmft='$idmft'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($colores))
		{
			$sql_detalle = "INSERT INTO fictec_color(idmft, cod_color) VALUES('$idmft', '$colores[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	public function listar()
	{
		$sql="SELECT  ftc.idftc,
                  ftc.idmft,
                  CONCAT(mft.cod_mod, ' - ', m.nom_mod) AS cod_mod,
                  CONCAT(ftc.com_color, ' - ', cc.color) AS com_color,
                  CONCAT(ftc.tela1, ' - ', t1.articulo) AS tela1,
                  CONCAT(ftc.color1, ' - ', c1.color) AS color1,
                  CONCAT(ftc.tela2, ' - ', t2.articulo) AS tela2,
                  CONCAT(ftc.color2, ' - ', c2.color) AS color2,
                  CONCAT(ftc.tela3, ' - ', t3.articulo) AS tela3,
                  CONCAT(ftc.color3, ' - ', c3.color) AS color3 
                FROM
                  fic_teccomb ftc 
                  LEFT JOIN maestro_ficha_tecnica mft 
                    ON ftc.idmft = mft.idmft 
                  LEFT JOIN modelojf m 
                    ON mft.cod_mod = m.cod_mod 
                  LEFT JOIN 
                    (SELECT DISTINCT 
                      SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                      AND EstPro = '1') AS t1 
                    ON ftc.tela1 = t1.idarticulo 
                  LEFT JOIN 
                    (SELECT DISTINCT 
                      SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                      AND EstPro = '1') AS t2 
                    ON ftc.tela2 = t2.idarticulo 
                  LEFT JOIN 
                    (SELECT DISTINCT 
                      SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                      IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                    WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                      AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                      AND EstPro = '1') AS t3 
                    ON ftc.tela3 = t3.idarticulo 
                  LEFT JOIN 
                    (SELECT 
                      RIGHT(cod_argumento, 2) AS cod_color,
                      des_larga AS color 
                    FROM
                      tabla_m_detalle 
                    WHERE cod_tabla = 'tcol' 
                      AND cod_argumento < 100) AS cc 
                    ON ftc.com_color = cc.cod_color 
                  LEFT JOIN 
                    (SELECT 
                      RIGHT(cod_argumento, 2) AS cod_color,
                      des_larga AS color 
                    FROM
                      tabla_m_detalle 
                    WHERE cod_tabla = 'tcol' 
                      AND cod_argumento < 100) AS c1 
                    ON ftc.color1 = c1.cod_color 
                  LEFT JOIN 
                    (SELECT 
                      RIGHT(cod_argumento, 2) AS cod_color,
                      des_larga AS color 
                    FROM
                      tabla_m_detalle 
                    WHERE cod_tabla = 'tcol' 
                      AND cod_argumento < 100) AS c2 
                    ON ftc.color2 = c2.cod_color 
                  LEFT JOIN 
                    (SELECT 
                      RIGHT(cod_argumento, 2) AS cod_color,
                      des_larga AS color 
                    FROM
                      tabla_m_detalle 
                    WHERE cod_tabla = 'tcol' 
                      AND cod_argumento < 100) AS c3 
                    ON ftc.color3 = c3.cod_color";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idftc)
	{
		$sql="SELECT 
                  ftc.idftc,
                  ftc.idmft,
                  ftc.com_color,
                  ftc.tela1,
                  ftc.color1,
                  ftc.tela2,
                  ftc.color2,
                  ftc.tela3,
                  ftc.color3
                FROM
                  fic_teccomb ftc
                  WHERE ftc.idftc='$idftc'";

		return ejecutarConsultaSimpleFila($sql);
  }
  
  public function selectFT(){
    $sql="SELECT  mft.idmft,
                  CONCAT(
                    mft.idmft,
                    ' - ',
                    mft.cod_mod,
                    ' - ',
                    m.nom_mod
                  ) AS modelo 
                FROM
                  maestro_ficha_tecnica mft 
                  LEFT JOIN modelojf m 
                    ON mft.cod_mod = m.cod_mod
                ORDER BY mft.idmft";

    return ejecutarConsulta($sql);
  }

  public function selectCombo($idmft){
    $sql="SELECT 
                  fc.idmft,
                  fc.cod_color AS com_color,
                  CASE
                    WHEN ftc.com_color IS NULL 
                    THEN CONCAT(fc.cod_color, ' - ', c.color) 
                    ELSE CONCAT(
                      ftc.com_color,
                      ' - ',
                      c.color,
                      ' - OK'
                    ) 
                  END AS color 
                FROM
                  fictec_color fc 
                  LEFT JOIN 
                    (SELECT 
                      RIGHT(cod_argumento, 2) AS cod_color,
                      des_larga AS color 
                    FROM
                      tabla_m_detalle 
                    WHERE cod_tabla = 'tcol' 
                      AND cod_argumento < 100) AS c 
                    ON fc.cod_color = c.cod_color 
                  LEFT JOIN fic_teccomb ftc 
                    ON fc.cod_color = ftc.com_color AND fc.idmft=ftc.idmft
                          WHERE fc.idmft='$idmft'";

    return ejecutarConsulta($sql);
  }

  public function selectTela1($idmft){
    $sql="SELECT    mft.idmft,
                    mft.tela1_mod,
                    CONCAT(mft.tela1_mod,' - ',t.articulo) AS tela1
                  FROM
                    maestro_ficha_tecnica mft 
                    LEFT JOIN 
                      (SELECT DISTINCT 
                        SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                        IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                      WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                        AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                        AND EstPro = '1') AS t 
                      ON mft.tela1_mod = t.idarticulo 
                  WHERE mft.idmft = '$idmft' ";

    return ejecutarConsulta($sql);
  }

  public function selectTela2($idmft){
    $sql="SELECT    mft.idmft,
                    mft.tela2_mod,
                    CONCAT(mft.tela2_mod,' - ',t.articulo) AS tela2
                  FROM
                    maestro_ficha_tecnica mft 
                    LEFT JOIN 
                      (SELECT DISTINCT 
                        SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                        IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                      WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                        AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                        AND EstPro = '1') AS t 
                      ON mft.tela2_mod = t.idarticulo 
                  WHERE mft.idmft = '$idmft' ";

    return ejecutarConsulta($sql);
  }


  public function selectTela3($idmft){
    $sql="SELECT    mft.idmft,
                    mft.tela3_mod,
                    CONCAT(mft.tela3_mod,' - ',t.articulo) AS tela3
                  FROM
                    maestro_ficha_tecnica mft 
                    LEFT JOIN 
                      (SELECT DISTINCT 
                        SUBSTRING(Producto.CodFab, 1, 6) AS idarticulo,
                        IFNULL(Tabla_M_Detalle_1.Des_Larga, '') AS articulo 
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
                      WHERE Tabla_M_Detalle.Des_Corta = Tabla_M_Detalle_1.Des_Corta 
                        AND Tabla_M_Detalle.Des_Corta IN ('BLO', 'TEL') 
                        AND EstPro = '1') AS t 
                      ON mft.tela3_mod = t.idarticulo 
                  WHERE mft.idmft = '$idmft' ";

    return ejecutarConsulta($sql);
  }


  public function selectColor1($tela1){

    $sql="SELECT    SUBSTRING(pro.CodFab, 1, 6) AS tela1,
                    RIGHT(pro.ColPro, 2) AS cod_color,
                    CONCAT(
                      RIGHT(pro.ColPro, 2),
                      ' - ',
                      TbCol.Des_Larga
                    ) AS color 
                  FROM
                    Producto AS pro 
                    LEFT JOIN Tabla_M_Detalle AS TbLin 
                      ON LEFT(pro.CodFab, 3) = TbLin.Des_Corta 
                      AND (
                        TbLin.Cod_Tabla = 'TLIN' 
                        OR TbLin.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbSub 
                      ON SUBSTRING(pro.CodFab, 4, 3) = TbSub.Valor_3 
                      AND (
                        TbSub.Cod_Tabla = 'TSUB' 
                        OR TbSub.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbCol 
                      ON TbCol.Cod_Argumento = pro.ColPro 
                      AND (
                        TbCol.Cod_Tabla = 'TCOL' 
                        OR TbCol.Cod_Tabla IS NULL
                      ) 
                  WHERE TbLin.Des_Corta = TbSub.Des_Corta 
                    AND TbLin.Des_Corta IN ('BLO', 'TEL') 
                    AND pro.EstPro = '1' 
                    AND SUBSTRING(pro.CodFab, 1, 6) = '$tela1' 
                  ORDER BY SUBSTRING(pro.CodFab, 1, 6) ASC,
                    RIGHT(pro.ColPro, 2) ASC";

    return ejecutarConsulta($sql);
  }

  public function selectColor2($tela2){

    $sql="SELECT    SUBSTRING(pro.CodFab, 1, 6) AS tela2,
                    RIGHT(pro.ColPro, 2) AS cod_color,
                    CONCAT(
                      RIGHT(pro.ColPro, 2),
                      ' - ',
                      TbCol.Des_Larga
                    ) AS color 
                  FROM
                    Producto AS pro 
                    LEFT JOIN Tabla_M_Detalle AS TbLin 
                      ON LEFT(pro.CodFab, 3) = TbLin.Des_Corta 
                      AND (
                        TbLin.Cod_Tabla = 'TLIN' 
                        OR TbLin.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbSub 
                      ON SUBSTRING(pro.CodFab, 4, 3) = TbSub.Valor_3 
                      AND (
                        TbSub.Cod_Tabla = 'TSUB' 
                        OR TbSub.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbCol 
                      ON TbCol.Cod_Argumento = pro.ColPro 
                      AND (
                        TbCol.Cod_Tabla = 'TCOL' 
                        OR TbCol.Cod_Tabla IS NULL
                      ) 
                  WHERE TbLin.Des_Corta = TbSub.Des_Corta 
                    AND TbLin.Des_Corta IN ('BLO', 'TEL') 
                    AND pro.EstPro = '1' 
                    AND SUBSTRING(pro.CodFab, 1, 6) = '$tela2' 
                  ORDER BY SUBSTRING(pro.CodFab, 1, 6) ASC,
                    RIGHT(pro.ColPro, 2) ASC";

    return ejecutarConsulta($sql);

  }
  
  public function selectColor3($tela3){

    $sql="SELECT    SUBSTRING(pro.CodFab, 1, 6) AS tela3,
                    RIGHT(pro.ColPro, 2) AS cod_color,
                    CONCAT(
                      RIGHT(pro.ColPro, 2),
                      ' - ',
                      TbCol.Des_Larga
                    ) AS color 
                  FROM
                    Producto AS pro 
                    LEFT JOIN Tabla_M_Detalle AS TbLin 
                      ON LEFT(pro.CodFab, 3) = TbLin.Des_Corta 
                      AND (
                        TbLin.Cod_Tabla = 'TLIN' 
                        OR TbLin.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbSub 
                      ON SUBSTRING(pro.CodFab, 4, 3) = TbSub.Valor_3 
                      AND (
                        TbSub.Cod_Tabla = 'TSUB' 
                        OR TbSub.Cod_Tabla IS NULL
                      ) 
                    LEFT JOIN Tabla_M_Detalle AS TbCol 
                      ON TbCol.Cod_Argumento = pro.ColPro 
                      AND (
                        TbCol.Cod_Tabla = 'TCOL' 
                        OR TbCol.Cod_Tabla IS NULL
                      ) 
                  WHERE TbLin.Des_Corta = TbSub.Des_Corta 
                    AND TbLin.Des_Corta IN ('BLO', 'TEL') 
                    AND pro.EstPro = '1' 
                    AND SUBSTRING(pro.CodFab, 1, 6) = '$tela3' 
                  ORDER BY SUBSTRING(pro.CodFab, 1, 6) ASC,
                    RIGHT(pro.ColPro, 2) ASC";

    return ejecutarConsulta($sql);

  }

}
?>
