<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Caso_Vigilancia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $id_trab,
													$canhoras_max,
													$fedo_canhoras_max,
													$porc_pago,	
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO caso_vigilancia ( 		 id_trab,
													 canhoras_max,
													 fedo_canhoras_max,
													 porc_pago,
													 est_reg,
													 fec_reg,
													 usu_reg,
													 pc_reg)
											VALUES ('$id_trab',	
												    '$canhoras_max',
												    '$fedo_canhoras_max',	
												    '$porc_pago',	
													'1',
													'$fec_reg',
													'$usu_reg',
													'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_caso_vig,
													$id_trab,
													$canhoras_max,
													$fedo_canhoras_max,
													$porc_pago,	
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE caso_vigilancia SET  id_trab='$id_trab',
										 canhoras_max='$canhoras_max',
										 fedo_canhoras_max='$fedo_canhoras_max',
										 porc_pago='$porc_pago',
										 fec_mod='$fec_reg',
										 usu_mod='$usu_reg',
										 pc_mod='$pc_reg'
					               WHERE id_caso_vig='$id_caso_vig'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_caso_vig,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE caso_vigilancia SET est_reg='0',
									    fec_anu='$fec_reg',
										usu_anu='$usu_reg',
										pc_anu='$pc_reg'
							      WHERE id_caso_mov='$id_caso_mov'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                        $id_caso_vig,
		                                            $fec_reg,
												    $usu_reg,
												    $pc_reg)
	{
		$sql="UPDATE caso_vigilancia SET   est_reg='1',
					 					  fec_act='$fec_reg',
					 					  usu_act='$usu_reg',
					 					  pc_act='$pc_reg'
			 					    WHERE id_caso_mov='$id_caso_mov'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_caso_vig)
	{
		$sql="SELECT     'counter_get_value(counter)' AS cv, 
						 cv.id_caso_vig,
						 cv.canhoras_max,
						 cv.fedo_canhoras_max,
						 cv.porc_pago,
		                 cv.id_trab,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
				         tare.`des_larga` AS des_area,
				         cv.est_reg
				         FROM caso_vigilancia cv
				LEFT JOIN trabajador  tra ON
				cv.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				WHERE  cv.id_caso_vig='$id_caso_vig'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     'CV' AS cv, 
						 cv.id_caso_vig,
		                 cv.id_trab,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
				         tare.`des_larga` AS des_area,
				         cv.est_reg
				         FROM caso_vigilancia cv
				LEFT JOIN trabajador  tra ON
				cv.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'";
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
