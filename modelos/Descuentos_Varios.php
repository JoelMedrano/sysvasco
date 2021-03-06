<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Descuentos_Varios
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
		$sql="INSERT INTO descuentos_varios (            id_trab,
												 fec_suc,
												 detalle,
												 num_cuotas,
												 modalidad,
												 tip_dscto,
												 cantidad,
												 pagado,
												 saldo,
												 fec_des1,
												 mon_des1,
												 fec_des2,
												 mon_des2,
												 fec_des3,
												 mon_des3,
												 est_des_var,
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
	public function editar(                         $id_des_var,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
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
		$sql="UPDATE descuentos_varios SET     id_trab='$id_trab',
											   fec_suc='$fec_suc',
		 									   detalle='$detalle',
											   num_cuotas='$num_cuotas',
											   modalidad='$modalidad',
											   tip_dscto='$tip_dscto',
											   cantidad='$cantidad',
											   pagado='$pagado',
											   saldo='$saldo',
											   fec_des1='$fec_des1',
											   mon_des1='$mon_des1',
											   fec_des2='$fec_des2',
											   mon_des2='$mon_des2',
											   fec_des3='$fec_des3',
											   mon_des3='$mon_des3',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_des_var='$id_des_var'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_des_var,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_varios SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_des_var='$id_des_var'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_des_var,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_varios SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_des_var='$id_des_var'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_des_var)
	{
		$sql="SELECT     dv.id_des_var,
		                 dv.id_trab,
		                 DATE(dv.fec_suc) AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         dv.detalle,
				         dv.num_cuotas,
				         dv.modalidad,
				         dv.cantidad,
				         dv.pagado,
				         dv.saldo,
				         TbFpa1.fecha1,  fec_des1,
				         dv.mon_des1,
				         TbFpa2.fecha2,  fec_des2,
				         dv.mon_des2,
				         TbFpa3.fecha3,  fec_des3,
				         dv.mon_des3,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         dv.tip_dscto,
				         tare.`des_larga` AS des_area,
				         dv.est_des_var,
				         dv.est_reg
				         FROM descuentos_varios dv
				INNER JOIN trabajador  tra ON
				dv.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= dv.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= dv.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				LEFT JOIN 
				(SELECT  dv.id_des_var,  CONCAT (TbPea.Des_Corta,' - ',TbFpa1.des_larga ) AS   fecha1
				 FROM descuentos_varios dv
				  LEFT JOIN  cronograma_pagos AS cp  ON    dv.fec_des1=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa1 ON    TbFpa1.cod_argumento=  dv.fec_des1 AND TbFpa1.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON   TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa1 ON  TbFpa1.id_des_var= dv.id_des_var
				LEFT JOIN 
				(SELECT  dv.id_des_var,  CONCAT (TbPea.Des_Corta,' - ',TbFpa2.des_larga ) AS   fecha2
				 FROM descuentos_varios dv
				  LEFT JOIN  cronograma_pagos AS cp  ON   dv.fec_des2=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa2 ON  TbFpa2.cod_argumento=  dv.fec_des2 AND TbFpa2.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa2 ON  TbFpa2.id_des_var= dv.id_des_var
				LEFT JOIN 
				(SELECT  dv.id_des_var,  CONCAT (TbPea.Des_Corta,' - ',TbFpa3.des_larga ) AS   fecha3
				 FROM descuentos_varios dv
				  LEFT JOIN  cronograma_pagos AS cp  ON   dv.fec_des3=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa3 ON  TbFpa3.cod_argumento=  dv.fec_des3 AND TbFpa3.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa3 ON  TbFpa3.id_des_var= dv.id_des_var
				WHERE dv.id_des_var='$id_des_var'
				order by   dv.id_des_var desc";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     dv.id_des_var,
		                 DATE_FORMAT(dv.fec_suc, '%d/%m/%Y') AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         dv.detalle,
				         dv.num_cuotas,
				         dv.modalidad,
				         dv.cantidad,
				         dv.pagado,
				         dv.saldo,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         dv.tip_dscto,
				         tare.`des_larga` AS des_area,
				         dv.est_des_var,
				         dv.est_reg
				         FROM descuentos_varios dv
				INNER JOIN trabajador  tra ON
				dv.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= dv.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= dv.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				order by   dv.id_des_var desc";
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


	public function selectMedida()
	{
		$sql="SELECT tmep.cod_argumento AS  medida,
		         tmep.Des_Larga AS des_medida 
			FROM tabla_maestra_detalle tmep
			WHERE	 tmep.Cod_tabla='TMEP'
			ORDER BY  tmep.cod_argumento ASC";
		return ejecutarConsulta($sql);
	}


	










}

?>
