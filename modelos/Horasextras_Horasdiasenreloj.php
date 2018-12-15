<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Horasextras_Horasdiasenreloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	


	//Implementamos un método para editar registros
	public function editar($id_cp, $id_hor_ext, $tiempo_fin,  $observacion)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($id_hor_ext))
		{			
			$sql_detalle="UPDATE horas_extras_personal SET    tiempo_fin='$tiempo_fin[$num_elementos]' ,  observacion='$observacion[$num_elementos]'   WHERE id_hor_ext='$id_hor_ext[$num_elementos]'  ";
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
	public function mostrar($id_cp)
	{
		$sql="SELECT '-' as pd ,
					 id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 est_reg,
					 ff.num 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN (
				SELECT COUNT(hep.id_hor_ext)  AS num, hep.id_fec_abono
				FROM horas_extras_personal hep
				WHERE hep.id_fec_abono='$id_cp'
				) AS ff  ON ff.id_fec_abono= cp.id_cp
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND id_cp='$id_cp' 
			ORDER BY  cp.id_cp DESC;
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_cp)
	{
		$sql="SELECT DISTINCT hep.id_hor_ext,
	                 hep.id_fec_abono  AS id_cp,
					 DATE_FORMAT(hep.fecha, '%d/%m/%Y') AS  fecha,
					 hep.id_trab, 
					 tr.nombres,
					 hep.cantidad,
					 hep.tiempo_fin,
					 hep.id_fec_abono,
					 fe.estado AS estado_dia,
					 IF(hep.abonar='1', 'X ABONAR', 'NO ABONAR') AS situacion,
					 IF(hep.abonado='2', 'NO ABONADO', 'ABONADO') AS estado ,
					 hep.observacion,
					 ff.num,
					 hep.por_pago
				FROM horas_extras_personal hep
				LEFT JOIN (
					SELECT  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) AS nombres
					FROM  trabajador tr
					) AS tr ON  tr.id_trab=hep.id_trab  
				LEFT JOIN fechas fe ON 
				fe.fecha= hep.fecha
			    LEFT JOIN (
				SELECT COUNT(hep.id_hor_ext)  AS num, hep.id_fec_abono
				FROM horas_extras_personal hep
				WHERE hep.id_fec_abono='$id_cp'
				) AS ff  ON ff.id_fec_abono= hep.id_fec_abono
				WHERE hep.id_fec_abono='$id_cp'
				AND hep.est_reg='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' AS pd ,
					 hepc.id_cp AS id_cp,
					 cp.id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 cp.des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 cp.est_reg,
					 hepc.habilitar_abono
			FROM horas_extras_personal_cab hepc 
				LEFT JOIN cronograma_pagos cp  ON 
				hepc.id_cp=cp.id_cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			ORDER BY  cp.id_cp DESC;
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