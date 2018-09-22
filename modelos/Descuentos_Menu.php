<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Descuentos_Menu
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
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO descuentos_menu (            id_trab,
												 fec_suc,
												 detalle,
												 num_cuotas,
												 modalidad,
												 tip_dscto,
												 cantidad,
												 pagado,
												 saldo,
												 est_des_men,
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
												'0',
												'1',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_des_men,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE descuentos_menu SET             id_trab='$id_trab',
											   fec_suc='$fec_suc',
		 									   detalle='$detalle',
											   num_cuotas='$num_cuotas',
											   modalidad='$modalidad',
											   tip_dscto='$tip_dscto',
											   cantidad='$cantidad',
											   pagado='$pagado',
											   saldo='$saldo',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_des_men='$id_des_men'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_des_men,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_menu SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_des_men='$id_des_men'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_des_men,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_menu SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_des_men='$id_des_men'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_des_men)
	{
		$sql="SELECT     dm.id_des_men,
		                 dm.id_trab,
		                 DATE(dm.fec_suc) AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         dm.detalle,
				         dm.num_cuotas,
				         dm.modalidad,
				         dm.cantidad,
				         dm.pagado,
				         dm.saldo,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         dm.tip_dscto,
				         tare.`des_larga` AS des_area,
				         dm.est_des_men,
				         dm.est_reg
				         FROM descuentos_menu dm
				INNER JOIN trabajador  tra ON
				dm.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= dm.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= dm.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				WHERE dm.id_des_men='$id_des_men'
				order by   dm.id_des_men DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     dm.id_des_men,
		                 dm.id_trab,
		                 DATE_FORMAT(dm.fec_suc, '%d/%m/%Y') AS fec_suc, 
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         dm.detalle,
				         dm.num_cuotas,
				         dm.modalidad,
				         dm.cantidad,
				         dm.pagado,
				         dm.saldo,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         dm.tip_dscto,
				         tare.`des_larga` AS des_area,
				         dm.est_des_men,
				         dm.est_reg
				         FROM descuentos_menu dm
				INNER JOIN trabajador  tra ON
				dm.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= dm.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= dm.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				order by   dm.id_des_men DESC";
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
