<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tardanzas_Permisos_Xhorasenreloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	


	//Implementamos un método para editar registros
	public function editar($id_cp,$id_hor_per,$tiempo_fin,$observacion)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($id_hor_per))
		{			
			$sql_detalle="UPDATE horas_permiso_personal SET id_fec_dscto='$id_cp', tiempo_fin='$tiempo_fin[$num_elementos]',    observacion='$observacion[$num_elementos]'   WHERE  id_hor_per='$id_hor_per[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	

		//Implementamos un método para anular la venta
	public function habilitar_descuento($id_cp)
	{
		$sql="UPDATE horas_permiso_personal_cab SET habilitar_dscto='1' WHERE id_cp='$id_cp'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para anular la venta
	public function desabilitar_descuento($id_cp)
	{
		$sql="UPDATE horas_permiso_personal_cab SET habilitar_dscto='2' WHERE id_cp='$id_cp'";
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
					 hpp.tiempo_fin,
					 IF(hpp.id_incidencia='1', 'PERMISO', IF(hpp.id_incidencia='2','TARDANZA' , 'FALTA')) AS incidencia,
					 IFNULL(pp.Permiso,'') AS permiso ,
					 IFNULL(pp.motivo,'') AS motivo,
					 hpp.id_fec_dscto,
					 IF(hpp.descontar='1', 'X DESCONTAR', 'NO DESCONTAR') AS situacion,
					 IF(hpp.descontado='2', 'NO DESCONTADO', 'DESCONTADO') AS estado,
					 hpp.observacion 
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
				where hpp.id_fec_dscto ='$id_cp'
				and hpp.est_reg='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' as pd ,
					 hppc.id_cp AS id_cp,
					 cp.id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 cp.des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 cp.est_reg,
					 hppc.habilitar_dscto 
			FROM horas_permiso_personal_cab hppc 
				LEFT JOIN cronograma_pagos cp  ON 
				hppc.id_cp=cp.id_cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
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
		$sql="SELECT hpp.id_hor_per,
    				 hpp.fecha, 
					 hpp.id_trab, 
					 hpp.situacion,  
					 hpp.fecha ,
					 tr.nombres,
					 hpp.tiempo_des,
					 hpp.tiempo_fin,
					 IF(hpp.id_incidencia='1', 'PERMISO', 'TARDANZA') AS incidencia,
					 IFNULL(pp.Permiso,'') AS permiso ,
					 IFNULL(pp.motivo,'') AS motivo,
					 hpp.id_fec_dscto,
					 hpp.observacion,
					 IF(hpp.descontar='1', 'X DESCONTAR', 'NO DESCONTAR') AS situacion,
					 IF(hpp.descontado='2', 'NO DESCONTADO', 'DESCONTADO') AS estado
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