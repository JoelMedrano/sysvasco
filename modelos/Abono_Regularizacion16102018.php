<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Abono_Regularizacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $id_trab,	
													$fec_suc,
													$motivo,
													$fec_abo_reg,
													$modalidad,
													$tip_abono,
													$cantidad,
													$pagado,
													$saldo,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO abono_regularizacion (            id_trab,
												 fec_suc,
												 motivo,
												 fec_abo_reg,
												 modalidad,
												 tip_abono,
												 cantidad,
												 pagado,
												 saldo,
												 est_abo_reg,
												 est_reg,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$id_trab',	
											    '$fec_suc',
												'$motivo',
												'$fec_abo_reg',
												'$modalidad',
												'$tip_abono',
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
	public function editar(                         $id_abo_reg,
													$id_trab,	
													$fec_suc,
													$motivo,
													$fec_abo_reg,
													$modalidad,
													$tip_abono,
													$cantidad,
													$pagado,
													$saldo,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE abono_regularizacion SET  id_trab='$id_trab',
											   fec_suc='$fec_suc',
		 									   motivo='$motivo',
											   fec_abo_reg='$fec_abo_reg',
											   modalidad='$modalidad',
											   tip_abono='$tip_abono',
											   cantidad='$cantidad',
											   pagado='$pagado',
											   saldo='$saldo',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_abo_reg='$id_abo_reg'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_abo_reg,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE abono_regularizacion SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_abo_reg='$id_abo_reg'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_abo_reg,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE abono_regularizacion SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_abo_reg='$id_abo_reg'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_abo_reg)
	{
		$sql="SELECT     ar.id_abo_reg,
		                 ar.id_trab,
		                 DATE(ar.fec_suc) AS fec_suc,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         ar.motivo,
				         DATE(ar.fec_abo_reg) AS fec_abo_reg,
				         ar.modalidad,
				         ar.cantidad,
				         ar.pagado,
				         ar.saldo,
				         ttpr.`des_larga` AS des_tip_abono,
				         tmod.`des_larga` AS des_modalidad,
				         ar.tip_abono,
				         tare.`des_larga` AS des_area,
				         ar.est_abo_reg,
				         ar.est_reg
				         FROM abono_regularizacion ar
				INNER JOIN trabajador  tra ON
				ar.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= ar.tip_abono
				AND ttpr.cod_tabla='TTAB'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= ar.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				WHERE ar.id_abo_reg='$id_abo_reg'
				order by   ar.id_abo_reg DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     ar.id_abo_reg,
		                 ar.id_trab,
		                 DATE_FORMAT(ar.fec_suc, '%d/%m/%Y') AS fec_suc, 
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres,  
				         ar.motivo,
				         ar.fec_abo_reg,
				         ar.modalidad,
				         ar.cantidad,
				         ar.pagado,
				         ar.saldo,
				         ttpr.`des_larga` AS des_tip_abono,
				         tmod.`des_larga` AS des_modalidad,
				         ar.tip_abono,
				         tare.`des_larga` AS des_area,
				         ar.est_abo_reg,
				         ar.est_reg
				         FROM abono_regularizacion ar
				INNER JOIN trabajador  tra ON
				ar.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= ar.tip_abono
				AND ttpr.cod_tabla='TTAB'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= ar.modalidad
				AND tmod.cod_tabla='TMOD'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				order by   ar.id_abo_reg DESC";
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
