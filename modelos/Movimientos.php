<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Movimientos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function movsfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT	m.fecha AS id_fecha,
						m.fecha,
						CASE
						WHEN MONTH(m.fecha)='1' THEN 'ENERO'
						WHEN MONTH(m.fecha)='2' THEN 'FEBRERO'
						WHEN MONTH(m.fecha)='3' THEN 'MARZO'
						WHEN MONTH(m.fecha)='4' THEN 'ABRIL'
						WHEN MONTH(m.fecha)='5' THEN 'MAYO'
						WHEN MONTH(m.fecha)='6' THEN 'JUNIO'
						WHEN MONTH(m.fecha)='7' THEN 'JULIO'
						WHEN MONTH(m.fecha)='8' THEN 'AGOSTO'
						WHEN MONTH(m.fecha)='9' THEN 'SEPTIEMBRE'
						WHEN MONTH(m.fecha)='10' THEN 'OCTUBRE'
						WHEN MONTH(m.fecha)='11' THEN 'NOVIEMBRE'
						ELSE MONTH(m.fecha)='DICIEMBRE'
						END AS mes,
						MONTH(fecha) AS m
						FROM movimientosjf m
						WHERE DATE(m.fecha)>='$fecha_inicio' AND DATE(m.fecha)<='$fecha_fin'
						GROUP BY m.fecha";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para anular la cotizacion
	public function eliminar($fecha)
	{
		$sql="DELETE FROM movimientosjf WHERE fecha='$fecha'";
		return ejecutarConsulta($sql);
	}

	public function movstipo($fecha_inicio,$fecha_fin,$tipo)
	{
		$sql="SELECT		m.tipo,
										LEFT(m.tipo,1) AS id,
										m.fecha,
										m.taller,
										m.documento,
										m.almacen,
										a.modelo,
										a.cod_color,
										a.color,
										a.cod_talla,
										SUM(CASE WHEN a.cod_talla = '1' THEN m.cantidad ELSE 0 END) AS 't1',
										SUM(CASE WHEN a.cod_talla = '2' THEN m.cantidad ELSE 0 END) AS 't2',
										SUM(CASE WHEN a.cod_talla = '3' THEN m.cantidad ELSE 0 END) AS 't3',
										SUM(CASE WHEN a.cod_talla = '4' THEN m.cantidad ELSE 0 END) AS 't4',
										SUM(CASE WHEN a.cod_talla = '5' THEN m.cantidad ELSE 0 END) AS 't5',
										SUM(CASE WHEN a.cod_talla = '6' THEN m.cantidad ELSE 0 END) AS 't6',
										SUM(CASE WHEN a.cod_talla = '7' THEN m.cantidad ELSE 0 END) AS 't7',
										SUM(CASE WHEN a.cod_talla = '8' THEN m.cantidad ELSE 0 END) AS 't8'
										FROM movimientosjf m
										LEFT JOIN articulojf a
										ON m.articulo=a.articulo
										WHERE DATE(m.fecha)>='$fecha_inicio' AND DATE(m.fecha)<='$fecha_fin' AND m.tipo='$tipo'
										GROUP BY m.tipo,m.fecha,m.taller,m.documento,m.almacen,a.modelo,a.cod_color,a.color
										ORDER BY m.fecha ASC, m.almacen ASC, m.taller ASC, a.modelo ASC, a.cod_color ASC";

		return ejecutarConsulta($sql);
	}

	public function selectTipo()
	{
		$sql="SELECT		t.des_corta AS tipo,
										CONCAT(t.des_corta,' - ',t.des_larga) AS descripcion
										FROM tabla_maestra_detalle t WHERE t.cod_tabla='TOPE'";

		return ejecutarConsulta($sql);
	}

	public function listarFacturas(){

		$sql="SELECT		m.tipo,
										m.documento,
										m.fecha,
										m.cliente as codigo,
										m.nom_cliente,
										pe.peso,
										m.rev_doc
										FROM movimientosjf m
										LEFT JOIN
											(SELECT
											m.documento,
											SUM(m.cantidad*p.peso) AS peso
											FROM movimientosjf m
											LEFT JOIN
												(SELECT
												a.articulo,
												a.peso_art AS peso
												FROM articulojf a) AS p
											ON m.articulo=p.articulo
											WHERE m.tipo IN ('S02','S03','S70') AND (DAY(m.fecha) BETWEEN DAY(NOW())-2 AND DAY(NOW())) AND (MONTH(m.fecha)=MONTH(NOW())) AND vendedor NOT IN ('08','06')
											GROUP BY m.documento) AS pe
										ON m.documento=pe.documento
										WHERE m.tipo IN ('S02','S03','S70') AND (DAY(m.fecha) BETWEEN DAY(NOW())-2 AND DAY(NOW())) AND (MONTH(m.fecha)=MONTH(NOW())) AND vendedor NOT IN ('08','06')
										GROUP BY m.tipo, m.documento, m.fecha, m.cliente, m.nom_cliente, m.rev_doc
										ORDER BY m.fecha DESC, m.documento DESC";

		return ejecutarConsulta($sql);
	}

	public function aprobarPedido($documento,$idusuario){

		$sql="UPDATE movimientosjf m SET m.rev_doc='aprobado', m.vb_doc='$idusuario' WHERE m.documento='$documento'";

		return ejecutarConsulta($sql);
	}

	public function rechazarPedido($documento,$idusuario){

		$sql="UPDATE movimientosjf m SET m.rev_doc='rechazado', m.vb_doc='$idusuario' WHERE m.documento='$documento'";

		return ejecutarConsulta($sql);
	}

	public function mostrar($documento){

		$sql="SELECT			m.documento,
											m.fecha,
											m.cliente,
											m.nom_cliente,
											m.vendedor,
											SUM(m.cantidad) AS und,
											SUM(m.total)*1.18 AS soles
											FROM movimientosjf m
											WHERE m.tipo IN ('S02','S03','S70') AND m.documento='$documento'
											GROUP BY m.documento,m.fecha,m.cliente,m.nom_cliente,m.vendedor";

												return ejecutarConsultaSimpleFila($sql);

	}


	public function listarDetalle($documento){

		$sql="SELECT		a.modelo,
										a.nombre,
										a.cod_color,
										a.color,
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '1' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '1' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't1',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '2' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '2' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't2',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '3' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '3' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't3',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '4' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '4' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't4',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '5' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '5' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't5',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '6' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '6' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't6',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '7' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '7' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't7',
										CASE WHEN (SUM(CASE WHEN a.cod_talla = '8' THEN m.cantidad ELSE 0 END))>0 THEN SUM(CASE WHEN a.cod_talla = '8' THEN m.cantidad ELSE 0 END) ELSE '' END AS 't8',
										SUM(cantidad) AS subtotal
										FROM movimientosjf m
										LEFT JOIN articulojf a
										ON m.articulo=a.articulo
										WHERE m.documento='$documento' AND m.tipo IN ('S02','S03','S70')
										GROUP BY m.documento,m.almacen,a.modelo,a.cod_color,a.color
										ORDER BY m.fecha ASC, m.almacen ASC, m.taller ASC, a.modelo ASC, a.cod_color ASC";

		return ejecutarConsulta($sql);
	}

}

?>
