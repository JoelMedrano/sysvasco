<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Renta_Quinta_Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $id_trab,
												 	$fec_ini1,
												 	fec_fin1,
													$mon_ret1,
													$est_ret1,
													$fec_ini2,
													$fec_fin2,
													$mon_ret2,
													$est_ret2,
													$fec_ini3,
													$fec_fin3,
													$mon_ret3,
													$est_ret3,
													$fec_ini4,
													$fec_fin4,
													$mon_ret4,
													$est_ret4,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO renta_quinta_categoria (id_trab,
												 fec_ini1,
												 fec_fin1,
												 mon_ret1,
												 est_ret1,
												 fec_ini2,
												 fec_fin2,
												 mon_ret2,
												 est_ret2,
												 fec_ini3,
												 fec_fin3,
												 mon_ret3,
												 est_ret3,
												 fec_ini4,
												 fec_fin4,
												 mon_ret4,
												 est_ret4,
												 est_reg,
												 fec_reg,
												 usu_reg,
												 pc_reg)
										VALUES ('$id_trab',	
											    '$fec_ini1',
												'$fec_fin1',
												'$mon_ret1',
												'$est_ret1',
												'$fec_ini2',
												'$fec_fin2',
												'$mon_ret2',
												'$est_ret2',
												'$fec_ini3',
												'$fec_fin3',
												'$mon_ret3',
												'$est_ret3',
												'$fec_ini4',
												'$fec_fin4',
												'$mon_ret4',
												'$est_ret4',
												'1',
												'$fec_reg',
												'$usu_reg',
												'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_ren_qui_cat,
													$id_trab,	
													$fec_ini1,
													$fec_fin1,
													$mon_ret1,
													$est_ret1,
													$fec_ini2,
													$fec_fin2,
													$mon_ret2,
													$est_ret2,
													$fec_ini3,
													$fec_fin3,
													$mon_ret3,
													$est_ret3,
													$fec_ini4,
													$fec_fin4,
													$mon_ret4,
													$est_ret4,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE renta_quinta_categoria SET        id_trab='$id_trab',
											   fec_ini1='$fec_ini1',
		 									   fec_fin1='$fec_fin1',
											   mon_ret1='$mon_ret1',
											   est_ret1='$est_ret1',
											   fec_ini2='$fec_ini2',
											   fec_fin2='$fec_fin2',
											   mon_ret2='$mon_ret2',
											   est_ret2='$est_ret2',
											   fec_ini3='$fec_ini3',
		 									   fec_fin3='$fec_fin3',
											   mon_ret3='$mon_ret3',
											   est_ret3='$est_ret3',
											   fec_ini4='$fec_ini4',
											   fec_fin4='$fec_fin4',
											   mon_ret4='$mon_ret4',
											   est_ret4='$est_ret4',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_ren_qui_cat='$id_ren_qui_cat'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar(                   $id_ren_qui_cat,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE renta_quinta_categoria SET est_reg='0',
													   fec_anu='$fec_reg',
													   usu_anu='$usu_reg',
													   pc_anu='$pc_reg'
									     WHERE id_ren_qui_cat='$id_ren_qui_cat'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar(                      $id_ren_qui_cat,
		                                          $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="UPDATE renta_quinta_categoria SET   est_reg='1',
					 								     fec_act='$fec_reg',
					 								     usu_act='$usu_reg',
					 								     pc_act='$pc_reg'
			 							 WHERE id_ren_qui_cat='$id_ren_qui_cat'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ren_qui_cat)
	{
		$sql="SELECT     rqc.id_ren_qui_cat,
		                 rqc.id_trab,
		                 DATE_FORMAT(rqc.fec_ini1, '%d/%m/%Y') AS fec_ini1, 
		                 DATE_FORMAT(rqc.fec_fin1, '%d/%m/%Y') AS fec_fin1,
		                 rqc.mon_ret1,
		                 rqc.est_ret1,
						 DATE_FORMAT(rqc.fec_ini2, '%d/%m/%Y') AS fec_ini2, 
		                 DATE_FORMAT(rqc.fec_fin2, '%d/%m/%Y') AS fec_fin2,
		                 rqc.mon_ret2,
		                 rqc.est_ret2,
		                 DATE_FORMAT(rqc.fec_ini3, '%d/%m/%Y') AS fec_ini3, 
		                 DATE_FORMAT(rqc.fec_fin3, '%d/%m/%Y') AS fec_fin3,
		                 rqc.mon_ret3,
		                 rqc.est_ret3,
		                 DATE_FORMAT(rqc.fec_ini4, '%d/%m/%Y') AS fec_ini4, 
		                 DATE_FORMAT(rqc.fec_fin4, '%d/%m/%Y') AS fec_fin4,
		                 rqc.mon_ret4,
		                 rqc.est_ret4,
				         rqc.est_reg
				         FROM renta_quinta_categoria rqc
				INNER JOIN trabajador  tra ON
				rqc.id_trab= tra.id_trab
				WHERE rqc.id_ren_qui_cat='$id_ren_qui_cat'
				order by   rqc.id_ren_qui_cat DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT     rqc.id_ren_qui_cat,
		                 rqc.id_trab,
		                 DATE_FORMAT(rqc.fec_ini1, '%d/%m/%Y') AS fec_ini1, 
		                 DATE_FORMAT(rqc.fec_fin1, '%d/%m/%Y') AS fec_fin1,
		                 rqc.mon_ret1,
		                 rqc.est_ret1,
						 DATE_FORMAT(rqc.fec_ini2, '%d/%m/%Y') AS fec_ini2, 
		                 DATE_FORMAT(rqc.fec_fin2, '%d/%m/%Y') AS fec_fin2,
		                 rqc.mon_ret2,
		                 rqc.est_ret2,
		                 DATE_FORMAT(rqc.fec_ini3, '%d/%m/%Y') AS fec_ini3, 
		                 DATE_FORMAT(rqc.fec_fin3, '%d/%m/%Y') AS fec_fin3,
		                 rqc.mon_ret3,
		                 rqc.est_ret3,
		                 DATE_FORMAT(rqc.fec_ini4, '%d/%m/%Y') AS fec_ini4, 
		                 DATE_FORMAT(rqc.fec_fin4, '%d/%m/%Y') AS fec_fin4,
		                 rqc.mon_ret4,
		                 rqc.est_ret4,
				         rqc.est_reg
				         FROM renta_quinta_categoria rqc
				INNER JOIN trabajador  tra ON
				rqc.id_trab= tra.id_trab
				order by   rqc.id_ren_qui_cat DESC";
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
