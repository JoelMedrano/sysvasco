<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Habilitarabono_Tiempoextra_Enreloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_nomtrab,$id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias,$obser_detalle,$vencidas,$truncas,$fec_del_dec,$fec_al_dec,$tot_dias_dec,$pen_dias_dec,$obser)
	{
		

		$num_elementos=0;
		$sw=true;
		$item=1;

		while ($num_elementos <count($id_periodo))
		{
			$sql_detalle = "INSERT INTO vacaciones(nro_doc,correlativo, id_periodo,fec_del,fec_al,tot_dias,pen_dias,obser_detalle,vencidas,truncas,fec_del_dec,fec_al_dec,tot_dias_dec,pen_dias_dec,obser) 
			VALUES ('$id_nomtrab','$item', '$id_periodo[$num_elementos]','$fec_del[$num_elementos]','$fec_al[$num_elementos]','$tot_dias[$num_elementos]','$pen_dias[$num_elementos]','$obser_detalle[$num_elementos]',
				'$vencidas[$num_elementos]','$truncas[$num_elementos]','$fec_del_dec[$num_elementos]','$fec_al_dec[$num_elementos]','$tot_dias_dec[$num_elementos]','$pen_dias_dec[$num_elementos]',
				'$obser[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			$item=$item + 1;
		
		}

		return $sw;
	}


	//Implementamos un método para editar registros
	public function editar($nro_doc, $correlativo, $id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias, $obser_detalle, $obser)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($correlativo))
		{			
			$sql_detalle="UPDATE vacaciones SET  correlativo='$correlativo[$num_elementos]',    fec_del='$fec_del[$num_elementos]' ,fec_al='$fec_al[$num_elementos]' , tot_dias='$tot_dias[$num_elementos]' , pen_dias='$pen_dias[$num_elementos]', obser_detalle='$obser_detalle[$num_elementos]',  obser='$obser[$num_elementos]'   WHERE nro_doc='$nro_doc' AND correlativo='$correlativo[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	public function insertar2($nro_doc, $CantItems,  $correlativo, $id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias, $obser_detalle, $obser)
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;
		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		while ($num_elementos < count($correlativo))
		{	
			$item=$item + 1;
			$sql_detalle = "INSERT INTO vacaciones  (  nro_doc, correlativo,id_periodo,fec_del,fec_al, tot_dias, pen_dias,  obser_detalle, obser ) VALUES( '$nro_doc', '$item','$CantItems','$fec_del[$num_elementos]','$fec_al[$num_elementos]','$tot_dias[$num_elementos]','$pen_dias[$num_elementos]' ,  '$obser_detalle[$num_elementos]', '$obser[$num_elementos]'  )  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			
		}

			return $sw;

	}


	//Implementamos un método para anular la venta
	public function habilitar_abono($id_hor_ext)
	{
		$sql="UPDATE horas_extras_personal SET abonar='1' WHERE id_hor_ext='$id_hor_ext'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para anular la venta
	public function desabilitar_abono($id_hor_ext)
	{
		$sql="UPDATE horas_extras_personal SET abonar='2' WHERE id_hor_ext='$id_hor_ext'";
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
					 est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND id_cp='$id_cp' 
			ORDER BY  cp.id_cp DESC;
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_cp)
	{
		$sql="SELECT hpp.id_fec_dscto  AS id_cp,
					 hpp.id_hor_per,
    				 hpp.fecha, 
					 hpp.id_trab, 
					 hpp.situacion,  
					 hpp.fecha ,
					 tr.nombres,
					 hpp.tiempo_des,
					 IF(hpp.id_incidencia='1', 'PERMISO', 'TARDANZA') AS incidencia,
					 IFNULL(pp.Permiso,'') AS permiso ,
					 IFNULL(pp.motivo,'') AS motivo,
					 hpp.id_fec_dscto,
					 IF(hpp.descontar='1', 'X DESCONTAR', 'NO DESCONTAR') AS situacion,
					 IF(hpp.descontado='2', 'NO DESCONTADO', 'DESCONTADO') AS estado 
				FROM horas_permiso_personal hpp
				LEFT JOIN (
					Select  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) As nombres
					FROM  trabajador tr
					) As tr ON  tr.id_trab=hpp.id_trab  
				LEFT JOIN (
					SELECT  pp.id_trab, pp.tip_permiso, pp.fecha_procede, TbPer.Des_Larga AS Permiso, pp.motivo
					FROM permiso_personal pp 
					LEFT JOIN tabla_maestra_detalle  Tbper ON 
					TbPer.des_corta= pp.tip_permiso
					) AS pp ON pp.id_trab= hpp.id_trab
				     AND       pp.fecha_procede=hpp.fecha 
				where hpp.id_fec_dscto ='$id_cp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT    hepc.id_cp AS id_cp,
						TbPea.Des_Corta AS Ano,
					    TbFpa.Des_Larga AS Descrip_fec_pag,
					    hep.id_hor_ext AS id_hor_ext,
					    hep.fecha,
						hep.nombres,
						hep.cantidad,
						hep.tiempo_fin,
						hep.abonado,
						hep.abonar,
						hep.observacion,
						hep.est_reg,
						hep.estado_dia,
						hep.situacion,
						hep.estado
			FROM horas_extras_personal_cab hepc 
				LEFT JOIN cronograma_pagos cp  ON 
				hepc.id_cp=cp.id_cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN 
				(
				SELECT DISTINCT  hep.id_hor_ext,
			         			 hep.id_fec_abono  AS id_cp,
								 hep.fecha, 
								 hep.id_trab,  
								 tr.nombres,
								 hep.cantidad,
								 hep.tiempo_fin,
								 IF(hep.abonar='1', 'X ABONAR', 'NO ABONAR') AS situacion,
								 IF(hep.abonado='2', 'NO ABONADO', 'ABONADO') AS estado,
								 hep.abonado,
								 hep.abonar,
								 hep.est_reg,
								 fe.estado AS estado_dia,
								 hep.observacion
				FROM horas_extras_personal hep
				LEFT JOIN (
					SELECT  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) AS nombres
					FROM  trabajador tr
					) AS tr ON  tr.id_trab=hep.id_trab 
				LEFT JOIN fechas AS fe ON 
				fe.fecha=hep.fecha 
				) AS hep ON  hep.id_cp= hepc.id_cp
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND hepc.habilitar_abono='1'
			AND hep.abonado='2'
			ORDER BY  cp.id_cp DESC;";
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


	public function selectPermisosTardanzasNoDescontadas()
	{
		$sql="SELECT     hpp.id_hor_per,
    				 hpp.fecha, 
					 hpp.id_trab, 
					 hpp.situacion,  
					 hpp.fecha ,
					 tr.nombres,
					 hpp.tiempo_des,
					 IF(hpp.id_incidencia='1', 'PERMISO', 'TARDANZA') AS incidencia,
					 IFNULL(pp.Permiso,'') AS permiso ,
					 IFNULL(pp.motivo,'') AS motivo,
					 hpp.id_fec_dscto 
				FROM horas_permiso_personal hpp
				LEFT JOIN (
					SELECT  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) AS nombres
					FROM  trabajador tr
					) AS tr ON  tr.id_trab=hpp.id_trab  
				LEFT JOIN (
					SELECT  pp.id_trab, pp.tip_permiso, pp.fecha_procede, TbPer.Des_Larga AS Permiso, pp.motivo
					FROM permiso_personal pp 
					LEFT JOIN tabla_maestra_detalle  Tbper ON 
					TbPer.des_corta= pp.tip_permiso
					) AS pp ON pp.id_trab= hpp.id_trab
				     AND       pp.fecha_procede=hpp.fecha 
				WHERE hpp.descontado='2'
				AND hpp.descontar='1' 
				 ";
		return ejecutarConsulta($sql);		
	}







	
}
?>