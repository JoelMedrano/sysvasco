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
													$mon_total,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="INSERT INTO renta_quinta_categoria (   id_trab,
													 mon_total,
													 est_reg,
													 fec_reg,
													 usu_reg,
													 pc_reg)
											VALUES ('$id_trab',	
												    '$mon_total',		
													'1',
													'$fec_reg',
													'$usu_reg',
													'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_ren_qui_cat,
													$id_trab,
													$mon_total,	
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{
		$sql="UPDATE renta_quinta_categoria SET  id_trab='$id_trab',
												 mon_total='$mon_total',
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
	public function activar(                        $id_caso_mov,
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
	public function mostrar($id_cp)
	{
		$sql="SELECT '-' as pd ,
					 cp.id_cp,
					 cp.id_ano,
					 IFNULL(MAX(pd.correlativo),0) AS CantItems,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 cp.des_fec_pag, 
		 			 DATE(cp.fec_pag) AS fec_pag,
		 			 DATE(cp.desde) AS desde,
					 DATE(cp.hasta) AS hasta,
					 IFNULL(DATEDIFF(cp.hasta,cp.desde),0) AS cant_dias,
					 cp.est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle AS TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle AS TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN pago_destajeros AS pd ON 
				pd.id_pd=cp.id_cp
			WHERE  cp.id_cp='$id_cp'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT   '-' as rq ,
					 id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			ORDER BY  cp.id_cp DESC;";
		return ejecutarConsulta($sql);
	}


	//  Implementar un método para listar los trabajadores que son destajeros
	public function selectTrabajadoresDestajeros()
	{
		$sql="SELECT  id_trab,   CONCAT(apepat_trab, ' ' , apemat_trab, ' ', SUBSTRING_INDEX(nom_trab, ' ', 1))    AS nombres , (sueldo_trab/2) AS sueldo, bono_des_trab
		FROM trabajador 
		where id_form_pag='2' 
		order by apepat_trab ASC";
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
