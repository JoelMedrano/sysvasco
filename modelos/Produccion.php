<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Produccion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar8($num_mov,$cod_taller,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario)
	{
		$sql="INSERT INTO movimientos (cod_mov,num_mov,cod_taller,fecha_hora,articulo,cod_alm,cod_cli,cant_mov,idusuario) 
          VALUES ('I20','$num_mov','$cod_taller','$fecha_hora',(CONCAT('1','$articulo')),'$cod_alm','$cod_cli','1','$idusuario')";
		return ejecutarConsulta($sql);
	}

		//Implementamos un método para insertar registros
		public function insertar7($num_mov,$cod_taller,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario)
		{
			$sql="INSERT INTO movimientos (cod_mov,num_mov,cod_taller,fecha_hora,articulo,cod_alm,cod_cli,cant_mov,idusuario) 
						VALUES ('I20','$num_mov','$cod_taller','$fecha_hora','$articulo','$cod_alm','$cod_cli','1','$idusuario')";
			return ejecutarConsulta($sql);
		}

	public function limpiarMov($num_mov)
	{
		$sql="DELETE FROM mov_resumen WHERE num_mov='$num_mov'";

		return ejecutarConsulta($sql);
	}

	public function limpiarNulos()
	{
		
		$sql="DELETE 
		movimientos 
	  FROM
		movimientos 
		LEFT JOIN articulojf 
		  ON movimientos.articulo = articulojf.articulo 
	  WHERE articulojf.articulo IS NULL";

		return ejecutarConsulta($sql);

	}

	public function insertarResumen($num_mov)
	
	{

		$sql="INSERT INTO mov_resumen 
		(SELECT 
		  cod_mov,
		  num_mov,
		  cod_taller,
		  fecha_hora,
		  articulo,
		  cod_alm,
		  cod_cli,
		  SUM(cant_mov),
		  idusuario,
			estado,
			'' as aprobado,
			IFNULL(cod_ven,'') AS cod_ven
		FROM
		  movimientos m 
		WHERE num_mov = '$num_mov' 
		GROUP BY cod_mov,
		  num_mov,
		  cod_taller,
		  fecha_hora,
		  articulo,
		  cod_alm,
		  cod_cli,
		  idusuario)";

		return ejecutarConsulta($sql);
	}



    public function listarProd($num_mov)
    {
		$sql="SELECT 
					m.cod_mov,
					m.num_mov,
					m.cod_taller,
					m.cod_alm,
					IFNULL(a.modelo,'Limpiar') AS modelo,
					IFNULL(a.cod_color,'-') AS cod_color,
					IFNULL(a.color,'-') AS color,
					SUM(
						CASE
						WHEN a.cod_talla = '1' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't1',
					SUM(
						CASE
						WHEN a.cod_talla = '2' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't2',
					SUM(
						CASE
						WHEN a.cod_talla = '3' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't3',
					SUM(
						CASE
						WHEN a.cod_talla = '4' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't4',
					SUM(
						CASE
						WHEN a.cod_talla = '5' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't5',
					SUM(
						CASE
						WHEN a.cod_talla = '6' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't6',
					SUM(
						CASE
						WHEN a.cod_talla = '7' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't7',
					SUM(
						CASE
						WHEN a.cod_talla = '8' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't8',
					SUM(m.cant_mov) AS 'subtotal' 
					FROM
					movimientos m 
					LEFT JOIN articulojf a 
						ON m.articulo = a.articulo 
					WHERE m.num_mov = '$num_mov' 
					AND m.cod_mov = 'I20' 
					GROUP BY m.cod_mov,
					m.num_mov,
					m.cod_taller,
					m.cod_alm,
					a.modelo,
					a.cod_color,
					a.color
					ORDER BY a.modelo,a.cod_color ";

        return ejecutarConsulta($sql);
	}


public function listarDetalle($num_mov)
    {
		$sql="SELECT 
					m.cod_mov,
					m.num_mov,
					m.cod_taller,
					m.cod_alm,
					IFNULL(a.modelo,'Limpiar') AS modelo,
					IFNULL(a.cod_color,'-') AS cod_color,
					IFNULL(a.color,'-') AS color,
					SUM(
						CASE
						WHEN a.cod_talla = '1' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't1',
					SUM(
						CASE
						WHEN a.cod_talla = '2' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't2',
					SUM(
						CASE
						WHEN a.cod_talla = '3' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't3',
					SUM(
						CASE
						WHEN a.cod_talla = '4' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't4',
					SUM(
						CASE
						WHEN a.cod_talla = '5' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't5',
					SUM(
						CASE
						WHEN a.cod_talla = '6' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't6',
					SUM(
						CASE
						WHEN a.cod_talla = '7' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't7',
					SUM(
						CASE
						WHEN a.cod_talla = '8' 
						THEN m.cant_mov 
						ELSE 0 
						END
					) AS 't8',
					SUM(m.cant_mov) AS 'subtotal' 
					FROM
					movimientos m 
					LEFT JOIN articulojf a 
						ON m.articulo = a.articulo 
					WHERE m.num_mov = '$num_mov' 
					AND m.cod_mov = 'I20' 
					GROUP BY m.cod_mov,
					m.num_mov,
					m.cod_taller,
					m.cod_alm,
					a.modelo,
					a.cod_color,
					a.color
					ORDER BY a.modelo,a.cod_color ";

        return ejecutarConsulta($sql);
	}
	
	public function selectTaller()
	{

		$sql="SELECT 
					tmd.des_corta AS cod_taller,
					CONCAT(tmd.des_corta,' - ',tmd.des_larga) AS nom_taller 
				FROM
					tabla_maestra_detalle tmd 
				WHERE tmd.cod_tabla = 'TTLL'";

		return ejecutarConsulta($sql);
	}

	public function selectAlmacen()
	{

		$sql="SELECT 
					tmd.des_corta AS cod_alm,
					CONCAT(tmd.des_corta,' - ',tmd.des_larga) AS nom_alm 
				FROM
					tabla_maestra_detalle tmd 
				WHERE tmd.cod_tabla = 'TALM'";

		return ejecutarConsulta($sql);
	}

	public function listarDoc($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT 
								mr.cod_mov,
								mr.num_mov,
								DATE(mr.fecha_hora) AS fecha,
								SUM(cant_mov) AS cantidad,
								mr.estado,
								mr.idusu_apro,
								u.nombre 
							FROM
								mov_resumen mr
								LEFT JOIN usuario u
								ON mr.idusu_apro=u.idusuario
								WHERE DATE(fecha_hora) >= '$fecha_inicio' 
									AND DATE(fecha_hora) <= '$fecha_fin' 
									AND mr.cod_mov='I20'
								GROUP BY mr.num_mov 
								ORDER BY mr.fecha_hora";
		
		return ejecutarConsulta($sql);
	}

	public function prodMes()
	{

		$sql="SELECT
		DAY(fecha_hora) AS dia,
		SUM(cant_mov) suma 
		FROM mov_resumen mr
		WHERE MONTH(fecha_hora)=MONTH(NOW()) AND cod_mov='I20'
		GROUP BY DAY(fecha_hora)";

		return ejecutarConsulta($sql);

	}

	public function aprobar($num_mov,$idusuario)
	{
		$sql="UPDATE mov_resumen SET estado='1', idusu_apro='$idusuario' WHERE num_mov='$num_mov';";

		return ejecutarConsulta($sql);
	}


	public function rechazar($num_mov,$idusuario)
	{
		$sql="UPDATE mov_resumen SET estado='2', idusu_apro='$idusuario' WHERE num_mov='$num_mov';";

		return ejecutarConsulta($sql);
	}

	public function mostrar($num_mov)
	{
		$sql="SELECT 
									mr.cod_mov,
									mr.num_mov,
									DATE(mr.fecha_hora) AS fecha,
									SUM(cant_mov) AS cantidad,
									mr.estado,
									mr.idusuario,
									u1.nombre AS nom_ing,
									mr.idusu_apro,
									u.nombre AS nom_apro 
								FROM
									mov_resumen mr 
									LEFT JOIN usuario u 
										ON mr.idusu_apro = u.idusuario 
										LEFT JOIN usuario u1
										ON mr.idusuario=u1.idusuario
								WHERE mr.num_mov='$num_mov'
								GROUP BY mr.num_mov 
								ORDER BY mr.fecha_hora";

		return ejecutarConsultaSimpleFila($sql);
	}

}

?>