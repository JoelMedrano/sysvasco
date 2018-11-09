<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class FT_hoja3
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idmft_color,$idarticulo,$ubicacion,$consumo,$consumo_tenido)
	{
		$sql="INSERT INTO avios (idmft_color,estado)
		VALUES ('$idmft_color','por aprobar')";
		//return ejecutarConsulta($sql);
		$idaviosnew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_avios(idavios, idarticulo,ubicacion,consumo,consumo_tenido) VALUES ('$idaviosnew', '$idarticulo[$num_elementos]','$ubicacion[$num_elementos]','$consumo[$num_elementos]','$consumo_tenido[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	
	//Implementamos un método para anular la venta
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idavios)
	{
		$sql="SELECT * FROM avios WHERE idavios='$idavios'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idavios)
	{
		$sql="SELECT 
										da.idavios,
										da.idarticulo,
										d.descripcion,
										d.color,
										d.cod_linea,
										d.und,
										da.ubicacion,
										da.consumo,
										da.consumo_tenido,
										d.prov
									FROM
										detalle_avios da 
										LEFT JOIN 
											(SELECT DISTINCT 
												SUBSTRING(p.CodFab, 1, 6) AS cod_linea,
												Tb4.Des_larga AS linea,
												p.Codpro AS codpro,
												p.CodFab AS codfab,
												p.DesPro AS descripcion,
												tmd.Des_Larga AS color,
												Tb2.Des_Corta AS und,
												p.CodAlm01 AS stock,
												p.CosPro AS cospro,
												IFNULL(prov.razpro, 'PENDIENTE') AS prov 
											FROM
												Producto AS p 
												LEFT JOIN 
													(SELECT 
														pmp.codpro,
														pro.razpro 
													FROM
														preciomp pmp 
														LEFT JOIN proveedor pro 
															ON pmp.CodProv1 = pro.CodRuc) AS prov 
													ON prov.codpro = p.Codpro,
												Tabla_M_Detalle AS tmd,
												Tabla_M_Detalle AS Tb1,
												Tabla_M_Detalle AS Tb2,
												Tabla_M_Detalle AS Tb4 
											WHERE tmd.Cod_Tabla IN ('TCOL') 
												AND Tb2.Cod_Tabla IN ('TUND') 
												AND tB4.Cod_Tabla IN ('TLIN') 
												AND Tb1.Cod_Tabla IN ('TSUB') 
												AND tmd.Cod_Argumento = p.ColPro 
												AND Tb2.Cod_Argumento = p.UndPro 
												AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
												AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
												AND Tb4.Des_Corta = Tb1.Des_Corta) AS d 
											ON da.idarticulo = d.codpro 
									WHERE da.idavios = '$idavios'";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT 
						a.idavios,
						a.estado,
						a.idmft_color,
						mft.idmft,
						fc.cod_color,
						c.color,
						mft.cod_mod,
						m.nom_mod 
					FROM
						avios a 
						LEFT JOIN fictec_color fc 
						ON a.idmft_color = fc.idmft_color 
						LEFT JOIN 
						(SELECT 
							RIGHT(cod_argumento, 2) AS cod_color,
							des_larga AS color 
						FROM
							tabla_m_detalle 
						WHERE cod_tabla = 'tcol' 
							AND cod_argumento < 100) AS c 
						ON fc.cod_color = c.cod_color 
						LEFT JOIN maestro_ficha_tecnica mft 
						ON fc.idmft = mft.idmft 
						LEFT JOIN modelojf m 
						ON mft.cod_mod = m.cod_mod";

		return ejecutarConsulta($sql);		
	}

	public function combos()
	{
		$sql="SELECT 
		fc.idmft_color,
		CASE
		  WHEN a.idmft_color IS NULL 
		  THEN CONCAT(
			fc.idmft_color,
			' - ',
			mft.cod_mod,
			' - ',
			c.color
		  ) 
		  ELSE CONCAT(
			fc.idmft_color,
			' - ',
			mft.cod_mod,
			' - ',
			c.color,
			' - OK'
		  ) 
		END AS color 
	  FROM
		fictec_color fc 
		LEFT JOIN maestro_ficha_tecnica mft 
		  ON fc.idmft = mft.idmft 
		LEFT JOIN 
		  (SELECT 
			RIGHT(cod_argumento, 2) AS cod_color,
			des_larga AS color 
		  FROM
			tabla_m_detalle 
		  WHERE cod_tabla = 'tcol' 
			AND cod_argumento < 100) c 
		  ON fc.cod_color = c.cod_color 
		LEFT JOIN avios a 
		  ON fc.idmft_color = a.idmft_color 
	  ORDER BY mft.cod_mod";

		return ejecutarConsulta($sql);
	}

	public function listarMP()
	{
		$sql="SELECT DISTINCT 
									SUBSTRING(p.CodFab, 1, 6) AS cod_linea,
									Tb4.Des_larga AS linea,
									p.Codpro AS codpro,
									p.CodFab AS codfab,
									p.DesPro AS descripcion,
									tmd.Des_Larga AS color,
									Tb2.Des_Corta AS und,
									p.CodAlm01 AS stock,
									p.CosPro as cospro,
									IFNULL(prov.razpro, 'PENDIENTE') AS prov 
								FROM
									Producto AS p 
									LEFT JOIN 
										(SELECT 
											pmp.codpro,
											pro.razpro 
										FROM
											preciomp pmp 
											LEFT JOIN proveedor pro 
												ON pmp.CodProv1 = pro.CodRuc) AS prov 
										ON prov.codpro = p.Codpro,
									Tabla_M_Detalle AS tmd,
									Tabla_M_Detalle AS Tb1,
									Tabla_M_Detalle AS Tb2,
									Tabla_M_Detalle AS Tb4 
								WHERE tmd.Cod_Tabla IN ('TCOL') 
									AND Tb2.Cod_Tabla IN ('TUND') 
									AND tB4.Cod_Tabla IN ('TLIN') 
									AND Tb1.Cod_Tabla IN ('TSUB') 
									AND tmd.Cod_Argumento = p.ColPro 
									AND Tb2.Cod_Argumento = p.UndPro 
									AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
									AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
									AND Tb4.Des_Corta = Tb1.Des_Corta";

		return ejecutarConsulta($sql);
	}


	
}
?>