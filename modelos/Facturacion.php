<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Facturacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar8($num_mov,$cod_ven,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario)
	{
		$sql="INSERT INTO movimientos (cod_mov,num_mov,cod_ven,fecha_hora,articulo,cod_alm,cod_cli,cant_mov,idusuario,cod_taller,estado) 
          VALUES ('S03','$num_mov','$cod_ven','$fecha_hora',(CONCAT('1','$articulo')),'$cod_alm','$cod_cli','1','$idusuario','','1')";
		return ejecutarConsulta($sql);
	}

		//Implementamos un método para insertar registros
		public function insertar7($num_mov,$cod_ven,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario)
		{
			$sql="INSERT INTO movimientos (cod_mov,num_mov,cod_ven,fecha_hora,articulo,cod_alm,cod_cli,cant_mov,idusuario,cod_taller,estado) 
						VALUES ('S03','$num_mov','$cod_ven','$fecha_hora','$articulo','$cod_alm','$cod_cli','1','$idusuario','','1')";
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
		  IFNULL(cod_taller,'') AS cod_taller,
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
                        mr.num_mov,
                        mr.cod_ven,
                        a.modelo,
                        a.cod_color,
                        a.color,
                        mr.cant_mov AS venta,
                        /* TALLA 1*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '1' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't1',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '1' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's1',
                        /* TALLA 2*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '2' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't2',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '2' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's2',
                        /* TALLA 3*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '3' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't3',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '3' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's3',
                        /* TALLA 4*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '4' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't4',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '4' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's4',
                        /* TALLA 5*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '5' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't5',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '5' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's5',
                        /* TALLA 6*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '6' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't6',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '6' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's6',
                        /* TALLA 7*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '7' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't7',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '7' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's7',
                        /* TALLA 8*/
                        SUM(
                        CASE
                            WHEN a.cod_talla = '8' 
                            THEN mr.cant_mov 
                            ELSE 0 
                        END
                        ) AS 't8',
                        SUM(
                        CASE
                            WHEN a.cod_talla = '8' 
                            THEN (
                            a.stock + IFNULL(mri.ingresos, 0) - IFNULL(mrs.salidas, 0)
                            ) 
                            ELSE 0 
                        END
                        ) AS 's8',
                        SUM(mr.cant_mov) AS 'subtotal' 
                    FROM
                        mov_resumen mr 
                        LEFT JOIN 
                        (SELECT 
                            mr.articulo,
                            SUM(mr.cant_mov) AS ingresos 
                        FROM
                            mov_resumen mr 
                        WHERE mr.estado = '1' 
                            AND mr.cod_alm = '01' 
                            AND SUBSTRING(mr.cod_mov, 1, 1) = 'I' 
                        GROUP BY mr.articulo) AS mri 
                        ON mr.articulo = mri.articulo 
                        LEFT JOIN 
                        (SELECT 
                            mr.articulo,
                            SUM(mr.cant_mov) AS salidas 
                        FROM
                            mov_resumen mr 
                        WHERE mr.estado = '1' 
                            AND mr.cod_alm = '01' 
                            AND SUBSTRING(mr.cod_mov, 1, 1) = 'S' 
                        GROUP BY mr.articulo) AS mrs 
                        ON mr.articulo = mrs.articulo 
                        LEFT JOIN articulojf a 
                        ON mr.articulo = a.articulo 
                    WHERE mr.cod_mov = 'S03' 
                        AND num_mov = '$num_mov' 
                        AND mr.estado = '1' 
                    GROUP BY mr.num_mov,
                        mr.cod_ven,
                        a.modelo,
                        a.cod_color,
                        a.color ";

        return ejecutarConsulta($sql);
	}


public function listarDetalle($num_mov)
    {
		$sql="SELECT 
										m.cod_mov,
										m.num_mov,
										m.cod_ven,
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
										AND m.cod_mov = 'I05' 
										GROUP BY m.cod_mov,
										m.num_mov,
										m.cod_ven,
										m.cod_alm,
										a.modelo,
										a.cod_color,
										a.color
										ORDER BY a.modelo,a.cod_color ";

        return ejecutarConsulta($sql);
	}

	public function selectVendedor()
	{

		$sql="SELECT 
								tmd.des_corta AS cod_ven,
								CONCAT(
									tmd.des_corta,
									' - ',
									tmd.des_larga
								) AS nom_ven
							FROM
								tabla_maestra_detalle tmd 
							WHERE tmd.cod_tabla = 'TVEN'";

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
									mr.cod_cli,
									c.nombre_cliente AS nom_cli,
									mr.cod_ven,
									DATE(mr.fecha_hora) AS fecha,
									mr.cod_alm,
									SUM(mr.cant_mov) AS cantidad,
									mr.estado,
									mr.idusu_apro,
									u.nombre 
								FROM
									mov_resumen mr 
									LEFT JOIN usuario u 
										ON mr.idusu_apro = u.idusuario
										LEFT JOIN clientesjf c
										ON mr.cod_cli=c.cliente 
								WHERE DATE(fecha_hora) >= '$fecha_inicio' 
									AND DATE(fecha_hora) <= '$fecha_fin' 
									AND mr.cod_mov = 'S03' 
								GROUP BY mr.cod_alm, mr.num_mov
								ORDER BY mr.fecha_hora,
									mr.cod_alm";
		
		return ejecutarConsulta($sql);
	}

	public function devMes()
	{

		$sql="SELECT
		DAY(fecha_hora) AS dia,
		SUM(cant_mov) suma 
		FROM mov_resumen mr
		WHERE MONTH(fecha_hora)=MONTH(NOW()) AND cod_mov='I05'
		GROUP BY DAY(fecha_hora)";

		return ejecutarConsulta($sql);

	}

	public function aprobar($num_mov,$cod_alm,$idusuario)
	{
		$sql="UPDATE mov_resumen SET estado='1', idusu_apro='$idusuario' WHERE num_mov='$num_mov' AND cod_alm='$cod_alm'";

		return ejecutarConsulta($sql);
	}


	public function rechazar($num_mov,$cod_alm,$idusuario)
	{
		$sql="UPDATE mov_resumen SET estado='2', idusu_apro='$idusuario' WHERE num_mov='$num_mov' AND cod_alm='$cod_alm'";

		return ejecutarConsulta($sql);
	}

	public function mostrar($num_mov)
	{
		$sql="SELECT 
									mr.cod_mov,
									mr.num_mov,
									mr.cod_cli,
									c.nombre_cliente AS nom_cli,
									mr.cod_ven,
									v.nom_ven,
									DATE(mr.fecha_hora) AS fecha,
									SUM(mr.cant_mov) AS cantidad,
									SUM(
										CASE
											WHEN mr.cod_alm = '01' 
											THEN mr.cant_mov 
											ELSE 0 
										END
									) AS 'cant_primera',
									SUM(
										CASE
											WHEN mr.cod_alm = 'SE' 
											THEN mr.cant_mov 
											ELSE 0 
										END
									) AS 'cant_segunda',
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
										ON mr.idusuario = u1.idusuario 
									LEFT JOIN clientesjf c 
										ON mr.cod_cli = c.cliente 
									LEFT JOIN 
										(SELECT 
											tmd.des_corta AS cod_ven,
											CONCAT(
												tmd.des_corta,
												' - ',
												tmd.des_larga
											) AS nom_ven 
										FROM
											tabla_maestra_detalle tmd 
										WHERE tmd.cod_tabla = 'TVEN') AS v 
										ON mr.cod_ven = v.cod_ven 
								WHERE mr.num_mov = '$num_mov' 
									AND mr.cod_mov = 'I05' 
								GROUP BY mr.num_mov 
								ORDER BY mr.fecha_hora,
									mr.cod_alm";

		return ejecutarConsultaSimpleFila($sql);
	}

}

?>