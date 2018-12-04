<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Fechas_Calendario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementamos un método para insertar registros
	public function insertar($fecha_desde, $fecha_hasta )
	{


		$sql="INSERT INTO fechas (fecha)
		SELECT * FROM 
		(SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) fechas FROM
		 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
		 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
		 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
		 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
		 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
		WHERE fechas BETWEEN '$fecha_desde' AND '$fecha_hasta' ;

		 ";
		return ejecutarConsulta($sql);


	}


	//Implementamos un método para anular la venta
	public function actualizar($fecha_desde, $fecha_hasta )
	{
		$sql="UPDATE fechas SET  ano=SUBSTRING(fecha, 1, 4),
     			                 mes=SUBSTRING(fecha, 6, 2), 
                                 dia=SUBSTRING(fecha, 9, 2),
                                 nom_dia=(ELT(WEEKDAY(fecha) + 1, 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO')),
                                 estado='LABORABLE'
			WHERE fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}




	//Implementamos un método para anular la venta
	public function actualizar_nolaborables($fecha_desde, $fecha_hasta )
	{
		$sql="UPDATE fechas SET  estado='NO LABORABLE'
			WHERE fecha BETWEEN '$fecha_desde' AND '$fecha_hasta' 
			AND nom_dia='DOMINGO'";
		return ejecutarConsulta($sql);
	}




	


	//Implementamos un método para editar registros
	public function editar($fecha, $estado)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($fecha))
		{			
			$sql_detalle="UPDATE fechas SET   estado='$estado[$num_elementos]'   WHERE fecha='$fecha[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	


	


	public function insertar2($id_cp, $id_hor_ext, $tiempo_fin,  $observacion)
	{
		


		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($id_hor_ext))
		{	
			
			$sql_detalle="UPDATE horas_extras_personal SET   id_fec_abono='$id_cp' ,  tiempo_fin='$tiempo_fin[$num_elementos]' ,  observacion='$observacion[$num_elementos]'   WHERE id_hor_ext='$id_hor_ext[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;


		}

			return $sw;

	}


		//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function traerfechasdeintervalo($id_ano)
	{
		$sql="SELECT   CONCAT(TbPea.Des_Corta, '-01-01') AS fecha_desde,
		               CONCAT(TbPea.Des_Corta, '-12-31') AS fecha_hasta,
		               TbPea.Des_Corta AS ano 
		      FROM tabla_maestra_detalle TbPea 
			  WHERE TbPea.Cod_tabla='TPEA'
			  AND TbPea.Cod_Argumento='$id_ano'  ";
		return ejecutarConsulta($sql);

	}





	


	//Implementamos un método para anular la venta
	public function habilitar_abono($id_cp)
	{
		$sql="UPDATE horas_extras_personal_cab SET habilitar_abono='1' WHERE id_cp='$id_cp'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para anular la venta
	public function desabilitar_abono($id_cp)
	{
		$sql="UPDATE horas_extras_personal_cab SET habilitar_abono='2' WHERE id_cp='$id_cp'";
		return ejecutarConsulta($sql);
	}






	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ano)
	{
		$sql="SELECT  	fe.ano, 
						TbMes.Des_larga AS MesLargo,
						fe.mes,
						fe.dia,
						 DATE(fe.fecha) AS fecha,
						fe.nom_dia, 
						fe.estado ,
						TbAno.cod_argumento AS id_ano,
						'1' AS IdValidar 
					FROM  fechas fe
					LEFT JOIN tabla_maestra_detalle  TbMes
					ON TbMes.cod_argumento= fe.mes 
					AND TbMes.cod_tabla='MESF'
					LEFT JOIN tabla_maestra_detalle TbAno
					ON TbAno.cod_tabla='TPEA'
					AND TbAno.des_corta= fe.ano
				WHERE TbAno.cod_argumento='$id_ano'
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_ano)
	{
		$sql="SELECT    fe.ano, 
						TbMes.Des_larga AS MesLargo,
						fe.mes,
						fe.dia,
						DATE(fe.fecha) AS fecha,
						fe.nom_dia, 
						fe.estado 
					FROM  fechas fe
					LEFT JOIN tabla_maestra_detalle  TbMes
					ON TbMes.cod_argumento= fe.mes 
					AND TbMes.cod_tabla='MESF'
					LEFT JOIN tabla_maestra_detalle TbAno
					ON TbAno.cod_tabla='TPEA'
					AND TbAno.des_corta= fe.ano
				WHERE TbAno.cod_argumento='$id_ano'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT DISTINCT ano,  TbAno.cod_argumento AS id_ano 
				 FROM fechas AS fe
				LEFT JOIN tabla_maestra_detalle TbAno
					ON TbAno.cod_tabla='TPEA'
					AND TbAno.des_corta= fe.ano
			";
		return ejecutarConsulta($sql);		
	}

	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function obtenercantidaditems($nro_doc)
	{
		$sql="SELECT MAX(correlativo)
		 FROM vacaciones 
		 WHERE nro_doc='$nro_doc' 
		 ";
		return ejecutarConsulta($sql);	
	}


	public function selectHorasExtrasNoAbonadas()
	{
		$sql="SELECT hep.id_fec_abono  AS id_cp,
					 hep.id_hor_ext,
					 DATE_FORMAT(hep.fecha, '%d/%m/%Y') AS  fecha,
					 hep.id_trab, 
					 tr.nombres,
					 hep.cantidad,
					 hep.tiempo_fin,
					 hep.id_fec_abono,
					 fe.estado AS estado_dia,
					 IF(hep.abonar='1', 'X ABONAR', 'NO ABONAR') AS situacion,
					 IF(hep.abonado='2', 'NO ABONADO', 'ABONADO') AS estado ,
					 hep.observacion
				FROM horas_extras_personal hep
				LEFT JOIN (
					SELECT  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) AS nombres
					FROM  trabajador tr
					) AS tr ON  tr.id_trab=hep.id_trab  
				LEFT JOIN fechas fe ON 
				fe.fecha= hep.fecha
				WHERE  hep.abonado='2'
				AND hep.abonar='1' 
				 ";
		return ejecutarConsulta($sql);		
	}







	
}
?>