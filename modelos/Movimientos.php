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

}

?>
