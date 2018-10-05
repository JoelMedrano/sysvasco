<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Descuentos_Judiciales
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                      $id_trab,
													$obs_des_jud,
													$fec_ini,
													$fec_fin,
													$mon_men,
													$data_adjunta,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO descuentos_judiciales (id_trab,
												 obs_des_jud,
												 fec_ini,
												 fec_fin,
												 mon_men,
												 data_adjunta,
												 est_des_jud,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$id_trab',
												'$obs_des_jud',
												'$fec_ini',
												'$fec_fin',
												'$mon_men',
												'$data_adjunta',
												'1',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg')";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                       $id_des_jud,
												  $id_trab,
												  $obs_des_jud,
												  $fec_ini,
												  $fec_fin,
												  $mon_men,
												  $data_adjunta,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_judiciales SET id_trab='$id_trab',
											   obs_des_jud='$obs_des_jud',
											   fec_ini='$fec_ini',
											   fec_fin='$fec_fin',
											   mon_men='$mon_men',
											   data_adjunta='$data_adjunta',
											   fec_reg='$fec_reg',
											   usu_reg='$usu_reg',
											   pc_reg='$pc_reg'
										 WHERE id_des_jud='$id_des_jud'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_des_jud,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_judiciales SET est_des_jud='0',
											   fec_anu='$fec_reg',
											   usu_anu='$usu_reg',
											   pc_anu='$pc_reg'
									     WHERE id_des_jud='$id_des_jud'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_des_jud,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE descuentos_judiciales SET est_des_jud='1',
			 								   fec_act='$fec_reg',
			 								   usu_act='$usu_reg',
			 								   pc_act='$pc_reg'
			 							 WHERE id_des_jud='$id_des_jud'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_des_jud)
	{
		$sql="SELECT  dj.id_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, 
				tsua.des_larga AS sucursal_anexo, tare.des_larga AS area_trab, dj.obs_des_jud, dj.est_des_jud,
				DATE(dj.fec_ini) AS fec_ini, DATE(dj.fec_fin) AS  fec_fin, dj.mon_men, dj.id_des_jud,
				dj.data_adjunta
				FROM descuentos_judiciales dj
				INNER JOIN trabajador tr ON
				tr.id_trab= dj.id_trab
				LEFT JOIN tabla_maestra_detalle AS tsua ON
				tsua.cod_argumento= tr.id_sucursal
				AND tsua.cod_tabla='TSUA'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tr.id_area
				AND tare.cod_tabla='TARE'
				WHERE dj.id_des_jud='$id_des_jud'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  dj.id_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, 
				tsua.des_larga AS sucursal_anexo, tare.des_larga AS area_trab, dj.obs_des_jud, dj.est_des_jud, dj.id_des_jud
				FROM descuentos_judiciales dj
				INNER JOIN trabajador tr ON
				tr.id_trab= dj.id_trab
				LEFT JOIN tabla_maestra_detalle AS tsua ON
				tsua.cod_argumento= tr.id_sucursal
				AND tsua.cod_tabla='TSUA'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tr.id_area
				AND tare.cod_tabla='TARE'
				order by  dj.id_des_jud desc";
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
