<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Abonos_En_Efectivo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO abonos_en_efectivo (id_trab,
												 fec_suc,
												 detalle,
												 num_cuotas,
												 cantidad,
												 pagado,
												 saldo,
												 data_adjunta,
												 fec_des1,
												 mon_des1,
												 fec_des2,
											     mon_des2,
											     fec_des3,
												 mon_des3,
												 est_abo_efe,
												 est_reg,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$id_trab',	
											    '$fec_suc',
												'$detalle',
												'$num_cuotas',
												'$cantidad',
												'$pagado',
												'$saldo',
												'$data_adjunta',
												'$fec_des1',
												'$mon_des1',
												'$fec_des2',
												'$mon_des2',
												'$fec_des3',
												'$mon_des3',
												'2',
												'1',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_abo_efe,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE abonos_en_efectivo SET    id_trab='$id_trab',
												   fec_suc='$fec_suc',
			 									   detalle='$detalle',
												   num_cuotas='$num_cuotas',
												   cantidad='$cantidad',
												   pagado='$pagado',
												   saldo='$saldo',
												   data_adjunta='$data_adjunta',
												   fec_des1='$fec_des1',
												   mon_des1='$mon_des1',
												   fec_des2='$fec_des2',
												   mon_des2='$mon_des2',
												   fec_des3='$fec_des3',
												   mon_des3='$mon_des3',
												   fec_mod='$fec_reg',
												   usu_mod='$usu_reg',
												   pc_mod='$pc_reg'
										     WHERE id_abo_efe='$id_abo_efe'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_abo_efe,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE abonos_en_efectivo SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_abo_efe='$id_abo_efe'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_abo_efe,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE abonos_en_efectivo SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_abo_efe='$id_abo_efe'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_abo_efe)
	{
		$sql="SELECT     dee.id_abo_efe,
		                 DATE(dee.fec_suc) AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
					     dee.id_trab, 
				         dee.detalle,
				         dee.num_cuotas,
				         dee.cantidad,
				         dee.pagado,
				         dee.saldo,
				         dee.data_adjunta,
				         TbFpa1.fecha1,  fec_des1, dee.mon_des1,
				         TbFpa2.fecha2,  fec_des2, dee.mon_des2,
				         TbFpa3.fecha3,  fec_des3, dee.mon_des3,
				         dee.tip_dscto,
				         dee.est_reg
				         FROM abonos_en_efectivo dee
				INNER JOIN trabajador  tra ON
				dee.id_trab= tra.id_trab
				LEFT JOIN 
				(SELECT  dee.id_abo_efe,  CONCAT (TbPea.Des_Corta,' - ',TbFpa1.des_larga ) AS   fecha1
				 FROM abonos_en_efectivo dee 
				  LEFT JOIN  cronograma_pagos AS cp  ON    dee.fec_des1=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa1 ON    TbFpa1.cod_argumento=  dee.fec_des1 AND TbFpa1.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON   TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa1 ON  TbFpa1.id_abo_efe= dee.id_abo_efe
				LEFT JOIN 
				(SELECT  dee.id_abo_efe,  CONCAT (TbPea.Des_Corta,' - ',TbFpa2.des_larga ) AS   fecha2
				 FROM abonos_en_efectivo dee 
				  LEFT JOIN  cronograma_pagos AS cp  ON   dee.fec_des2=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa2 ON  TbFpa2.cod_argumento=  dee.fec_des2 AND TbFpa2.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa2 ON  TbFpa2.id_abo_efe= dee.id_abo_efe
				LEFT JOIN 
				(SELECT  dee.id_abo_efe,  CONCAT (TbPea.Des_Corta,' - ',TbFpa3.des_larga ) AS   fecha3
				 FROM abonos_en_efectivo dee 
				  LEFT JOIN  cronograma_pagos AS cp  ON   dee.fec_des3=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa3 ON  TbFpa3.cod_argumento=  dee.fec_des3 AND TbFpa3.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa3 ON  TbFpa3.id_abo_efe= dee.id_abo_efe
				WHERE  dee.id_abo_efe='$id_abo_efe'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     dee.id_abo_efe,
		                 DATE_FORMAT(dee.fec_suc, '%d/%m/%Y') AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         dee.detalle,
				         dee.num_cuotas,
				         dee.modalidad,
				         dee.cantidad,
				         dee.pagado,
				         dee.saldo,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         dee.tip_dscto,
				         tare.`des_larga` AS des_area,
				         dee.est_abo_efe,
				         dee.est_reg
				         FROM abonos_en_efectivo dee
				INNER JOIN trabajador  tra ON
				dee.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= dee.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= dee.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				ORDER BY   dee.id_abo_efe DESC";
		return ejecutarConsulta($sql);
	}


	public function obtenerIdAprobador($id)
	{
		$sql="SELECT     tra.id_trab
				         FROM trabajador tra
				INNER JOIN usuario usu ON
				usu.login= '$id'
				AND usu.id_trab= tra.id_trab";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosCotizacion()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_cotizacion,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}







}

?>
