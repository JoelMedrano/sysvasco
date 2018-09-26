<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Prestamos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $fec_sol,
	                                                $aprob_por,	
													$solicitante,
													$motivo,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO prestamos (            fec_sol,
												 aprob_por,
												 solicitante,
												 motivo,
												 num_cuotas,
												 modalidad,
												 tip_dscto,
												 cantidad,
												 pagado,
												 saldo,
												 data_adjunta,
												 est_pre,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$fec_sol',	
	                                            '$aprob_por',	
											    '$solicitante',
												'$motivo',
												'$num_cuotas',
												'$modalidad',
												'$tip_dscto',
												'$cantidad',
												'$pagado',
												'$saldo',
												'$data_adjunta',
												'0',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                       $id_pre,
												  $fec_sol,
												  $aprob_por,
												  $solicitante,
												  $motivo,
												  $num_cuotas,
												  $modalidad,
												  $tip_dscto,
												  $cantidad,
												  $pagado,
												  $saldo,
												  $data_adjunta,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE prestamos SET             fec_sol='$fec_sol',
											   aprob_por='$aprob_por',
		 									   solicitante='$solicitante',
											   motivo='$motivo',
											   num_cuotas='$num_cuotas',
											   modalidad='$modalidad',
											   tip_dscto='$tip_dscto',
											   cantidad='$cantidad',
											   pagado='$pagado',
											   saldo='$saldo',
											   data_adjunta='$data_adjunta',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_pre='$id_pre'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desaprobar(                   $id_pre,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE prestamos SET             est_pre='0',
											   fec_anu='$fec_reg',
											   usu_anu='$usu_reg',
											   pc_anu='$pc_reg'
									     WHERE id_pre='$id_pre'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function aprobar(                      $id_pre,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE prestamos SET             est_pre='1',
			 								   fec_act='$fec_reg',
			 								   usu_act='$usu_reg',
			 								   pc_act='$pc_reg'
			 							 WHERE id_pre='$id_pre'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_pre)
	{
		$sql="SELECT     pr.id_pre,
		                 DATE(pr.fec_sol) AS fec_sol,
						 CONCAT(sol.nom_trab , ' ' ,  sol.apepat_trab, ' ' ,  sol.apemat_trab) AS sol_apellidosynombres, 
				         CONCAT( apr.nom_trab , ' ' , apr.apepat_trab, ' ' ,  apr.apemat_trab )  AS apro_apellidosynombres, 
				         pr.motivo,
				         num_cuotas,
				         modalidad,
				         cantidad,
				         pagado,
				         saldo,
				         data_adjunta,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         modalidad,
				         tip_dscto,
				         solicitante,
				         aprob_por,
				         pr.usu_reg AS regis, 
				         CONCAT( SUBSTRING_INDEX(tur.nom_trab, ' ', 1) , ' ' ,  tur.apepat_trab)  AS registrante
				         FROM prestamos pr
				INNER JOIN trabajador sol ON
				sol.id_trab= pr.solicitante
				LEFT JOIN trabajador apr ON
				apr.id_trab= pr.aprob_por
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= pr.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= pr.modalidad
				AND tmod.cod_tabla='TMOD'
				INNER JOIN usuario AS usu ON
				usu.login= pr.usu_reg
				LEFT JOIN trabajador AS tur ON
				usu.id_trab= tur.id_trab
				WHERE pr.id_pre='$id_pre'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     pr.id_pre,
					     DATE_FORMAT(pr.fec_sol, '%d/%m/%Y')  AS fec_sol,
						 CONCAT(SUBSTRING_INDEX(sol.nom_trab, ' ', 1) , ' ' ,  sol.apepat_trab, ' ' )  AS sol_apellidosynombres, 
				         CONCAT(SUBSTRING_INDEX(apr.nom_trab, ' ', 1) , ' ' , apr.apepat_trab, ' ' )  AS apro_apellidosynombres, 
				         pr.motivo,
				         num_cuotas,
				         modalidad,
				         cantidad,
				         pagado,
				         saldo,
				         data_adjunta,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         modalidad,
				         tip_dscto,
				         solicitante,
				         aprob_por,
				         est_pre
				         FROM prestamos pr
				INNER JOIN trabajador sol ON
				sol.id_trab= pr.solicitante
				LEFT JOIN trabajador apr ON
				apr.id_trab= pr.aprob_por
				LEFT JOIN tabla_maestra_detalle AS ttpr ON
				ttpr.cod_argumento= pr.tip_dscto
				AND ttpr.cod_tabla='TTPR'
				LEFT JOIN tabla_maestra_detalle AS tmod ON
				tmod.cod_argumento= pr.modalidad
				AND tmod.cod_tabla='TMOD'
				order by   pr.id_pre desc";
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
