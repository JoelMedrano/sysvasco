<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Descuentos_Insumos_Destajeros
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
													$modalidad,
													$tip_dscto,
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
		$sql="INSERT INTO descuentos_insumos_destajeros (            id_trab,
												 fec_suc,
												 detalle,
												 num_cuotas,
												 modalidad,
												 tip_dscto,
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
												 est_ins_des,
												 est_reg,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$id_trab',	
											    '$fec_suc',
												'$detalle',
												'$num_cuotas',
												'$modalidad',
												'$tip_dscto',
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
												'0',
												'1',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_ins_des,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
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
		$sql="UPDATE descuentos_insumos_destajeros SET             id_trab='$id_trab',
											   fec_suc='$fec_suc',
		 									   detalle='$detalle',
											   num_cuotas='$num_cuotas',
											   modalidad='$modalidad',
											   tip_dscto='$tip_dscto',
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
										 WHERE id_ins_des='$id_ins_des'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_ins_des,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_insumos_destajeros SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_ins_des='$id_ins_des'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_ins_des,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_insumos_destajeros SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_ins_des='$id_ins_des'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ins_des)
	{
		$sql="SELECT     did.id_ins_des,
		                 DATE(did.fec_suc) AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
					     did.id_trab, 
				         did.detalle,
				         did.num_cuotas,
				         did.modalidad,
				         did.cantidad,
				         did.pagado,
				         did.saldo,
				         did.data_adjunta,
				         TbFpa1.fecha1,  fec_des1, did.mon_des1,
				         TbFpa2.fecha2,  fec_des2, did.mon_des2,
				         TbFpa3.fecha3,  fec_des3, did.mon_des3,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         did.tip_dscto,
				         did.est_reg
				         FROM descuentos_insumos_destajeros did
				INNER JOIN trabajador  tra ON
				did.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= did.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= did.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN 
				(SELECT  did.id_ins_des,  CONCAT (TbPea.Des_Corta,' - ',TbFpa1.des_larga ) AS   fecha1
				 FROM descuentos_insumos_destajeros did 
				  LEFT JOIN  cronograma_pagos AS cp  ON    did.fec_des1=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa1 ON    TbFpa1.cod_argumento=  did.fec_des1 AND TbFpa1.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON   TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa1 ON  TbFpa1.id_ins_des= did.id_ins_des
				LEFT JOIN 
				(SELECT  did.id_ins_des,  CONCAT (TbPea.Des_Corta,' - ',TbFpa2.des_larga ) AS   fecha2
				 FROM descuentos_insumos_destajeros did 
				  LEFT JOIN  cronograma_pagos AS cp  ON   did.fec_des2=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa2 ON  TbFpa2.cod_argumento=  did.fec_des2 AND TbFpa2.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa2 ON  TbFpa2.id_ins_des= did.id_ins_des
				LEFT JOIN 
				(SELECT  did.id_ins_des,  CONCAT (TbPea.Des_Corta,' - ',TbFpa3.des_larga ) AS   fecha3
				 FROM descuentos_insumos_destajeros did 
				  LEFT JOIN  cronograma_pagos AS cp  ON   did.fec_des3=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa3 ON  TbFpa3.cod_argumento=  did.fec_des3 AND TbFpa3.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa3 ON  TbFpa3.id_ins_des= did.id_ins_des
				WHERE did.id_ins_des='$id_ins_des'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     '-' AS ins_des,
						 did.id_ins_des,
		                 DATE_FORMAT(did.fec_suc, '%d/%m/%Y') AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         did.detalle,
				         did.num_cuotas,
				         did.modalidad,
				         did.cantidad,
				         did.pagado,
				         did.saldo,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         did.tip_dscto,
				         tare.`des_larga` AS des_area,
				         did.est_ins_des,
				         did.est_reg
				         FROM descuentos_insumos_destajeros did
				INNER JOIN trabajador  tra ON
				did.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= did.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= did.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				order by   did.id_ins_des desc";
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
