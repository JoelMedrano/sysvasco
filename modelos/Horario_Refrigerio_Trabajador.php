<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Horario_Refrigerio_Trabajador
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                     			    $id_trab,
																$id_horario,
																$cod_ref,	
																$fec_reg,
																$usu_reg,
																$pc_reg)
	{
		$sql="INSERT INTO horario_refrigerio_trabajador ( 		 id_trab,
																 id_horario,
																 cod_ref,
																 est_reg,
																 fec_reg,
																 usu_reg,
																 pc_reg)
														VALUES ('$id_trab',	
															    '$id_horario',	
															    '$cod_ref',	
																'1',
																'$fec_reg',
																'$usu_reg',
																'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                       		    $id_hor_ref,
															$id_trab,
															$id_horario,
															$cod_ref,	
															$fec_reg,
															$usu_reg,
															$pc_reg)
	{
		$sql="UPDATE horario_refrigerio_trabajador SET 
														 id_horario='$id_horario',
														 cod_ref='$cod_ref',
														 fec_mod='$fec_reg',
														 usu_mod='$usu_reg',
														 pc_mod='$pc_reg'
									               WHERE id_hor_ref='$id_hor_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_hor_ref,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE horario_refrigerio_trabajador SET  est_reg='0',
													    fec_anu='$fec_reg',
														usu_anu='$usu_reg',
														pc_anu='$pc_reg'
							     				  WHERE id_hor_ref='$id_hor_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                        $id_hor_ref,
		                                            $fec_reg,
												    $usu_reg,
												    $pc_reg)
	{
		$sql="UPDATE horario_refrigerio_trabajador SET    est_reg='1',
									 					  fec_act='$fec_reg',
									 					  usu_act='$usu_reg',
									 					  pc_act='$pc_reg'
			 					  				    WHERE id_hor_ref='$id_hor_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_hor_ref)
	{
		$sql="SELECT     'HRT' AS hrt, 
						 hrt.id_hor_ref,
		                 hrt.id_trab,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
				         tare.`des_larga` AS des_area,
				         hrt.id_horario,
				         hrt.cod_ref,
				         hrt.est_reg
				         FROM horario_refrigerio_trabajador hrt
				LEFT JOIN trabajador  tra ON
				hrt.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				LEFT JOIN horario AS hor ON
				hor.id_horario=hrt.id_horario
				LEFT JOIN refrigerio AS ref ON
				ref.cod_ref= hrt.cod_ref
				WHERE hrt.id_hor_ref='$id_hor_ref'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     'HRT' AS hrt, 
						 hrt.id_hor_ref,
		                 hrt.id_trab,
					     CONCAT(tra.nom_trab , ' ' ,  tra.apepat_trab, ' ' ,  tra.apemat_trab) AS trab_apellidosynombres, 
				         tare.`des_larga` AS des_area,
				         hrt.id_horario,
				         hrt.cod_ref,
				         hrt.est_reg,
				         hor.descrip
				         FROM horario_refrigerio_trabajador hrt
				LEFT JOIN trabajador  tra ON
				hrt.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tra.id_area
				AND tare.cod_tabla='TARE'
				LEFT JOIN horario AS hor ON
				hor.id_horario=hrt.id_horario
				LEFT JOIN refrigerio AS ref ON
				ref.cod_ref= hrt.cod_ref
				WHERE tra.est_reg='1'";
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
