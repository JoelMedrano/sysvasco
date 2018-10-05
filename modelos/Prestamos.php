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
													$medida,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_des4,
													$mon_des4,
													$fec_des5,
													$mon_des5,
													$fec_des6,
													$mon_des6,
													$fec_des7,
													$mon_des7,
													$fec_des8,
													$mon_des8,
													$fec_des9,
													$mon_des9,
													$fec_des10,
													$mon_des10,
													$fec_des11,
													$mon_des11,
													$fec_des12,
													$mon_des12,
													$fec_des13,
													$mon_des13,
													$fec_des14,
													$mon_des14,
													$fec_des15,
													$mon_des15,
													$fec_des16,
													$mon_des16,
													$fec_des17,
													$mon_des17,
													$fec_des18,
													$mon_des18,
													$fec_des19,
													$mon_des19,
													$fec_des20,
													$mon_des20,
													$fec_des21,
													$mon_des21,
													$fec_des22,
													$mon_des22,
													$fec_des23,
													$mon_des23,
													$fec_des24,
													$mon_des24,
													$fec_des25,
													$mon_des25,
													$fec_des26,
													$mon_des26,
													$fec_des27,
													$mon_des27,
													$fec_des28,
													$mon_des28,
													$fec_des29,
													$mon_des29,
													$fec_des30,
													$mon_des30,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{


		

			$sql="INSERT INTO prestamos (           fec_sol,
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
													medida,
												    fec_des1,
													mon_des1,
													fec_des2,
													mon_des2,
													fec_des3,
													mon_des3,
													fec_des4,
													mon_des4,
													fec_des5,
													mon_des5,
													fec_des6,
													mon_des6,
													fec_des7,
													mon_des7,
													fec_des8,
													mon_des8,
													fec_des9,
													mon_des9,
													fec_des10,
													mon_des10,
													fec_des11,
													mon_des11,
													fec_des12,
													mon_des12,
													fec_des13,
													mon_des13,
													fec_des14,
													mon_des14,
													fec_des15,
													mon_des15,
													fec_des16,
													mon_des16,
													fec_des17,
													mon_des17,
													fec_des18,
													mon_des18,
													fec_des19,
													mon_des19,
													fec_des20,
													mon_des20,
													fec_des21,
													mon_des21,
													fec_des22,
													mon_des22,
													fec_des23,
													mon_des23,
													fec_des24,
													mon_des24,
													fec_des25,
													mon_des25,
													fec_des26,
													mon_des26,
													fec_des27,
													mon_des27,
													fec_des28,
													mon_des28,
													fec_des29,
													mon_des29,
													fec_des30,
													mon_des30,
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
													'$medida',
												    '$fec_des1',
													'$mon_des1',
													'$fec_des2',
													'$mon_des2',
													'$fec_des3',
													'$mon_des3',
													'$fec_des4',
													'$mon_des4',
													'$fec_des5',
													'$mon_des5',
													'$fec_des6',
													'$mon_des6',
													'$fec_des7',
													'$mon_des7',
													'$fec_des8',
													'$mon_des8',
													'$fec_des9',
													'$mon_des9',
													'$fec_des10',
													'$mon_des10',
													'$fec_des11',
													'$mon_des11',
													'$fec_des12',
													'$mon_des12',
													'$fec_des13',
													'$mon_des13',
													'$fec_des14',
													'$mon_des14',
													'$fec_des15',
													'$mon_des15',
													'$fec_des16',
													'$mon_des16',
													'$fec_des17',
													'$mon_des17',
													'$fec_des18',
													'$mon_des18',
													'$fec_des19',
													'$mon_des19',
													'$fec_des20',
													'$mon_des20',
													'$fec_des21',
													'$mon_des21',
													'$fec_des22',
													'$mon_des22',
													'$fec_des23',
													'$mon_des23',
													'$fec_des24',
													'$mon_des24',
													'$fec_des25',
													'$mon_des25',
													'$fec_des26',
													'$mon_des26',
													'$fec_des27',
													'$mon_des27',
													'$fec_des28',
													'$mon_des28',
													'$fec_des29',
													'$mon_des29',
													'$fec_des30',
													'$mon_des30',
													'1',
													'$fec_reg',
													'$usu_reg',
													'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_pre,
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
												    $medida,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_des4,
													$mon_des4,
													$fec_des5,
													$mon_des5,
													$fec_des6,
													$mon_des6,
													$fec_des7,
													$mon_des7,
													$fec_des8,
													$mon_des8,
													$fec_des9,
													$mon_des9,
													$fec_des10,
													$mon_des10,
													$fec_des11,
													$mon_des11,
													$fec_des12,
													$mon_des12,
													$fec_des13,
													$mon_des13,
													$fec_des14,
													$mon_des14,
													$fec_des15,
													$mon_des15,
													$fec_des16,
													$mon_des16,
													$fec_des17,
													$mon_des17,
													$fec_des18,
													$mon_des18,
													$fec_des19,
													$mon_des19,
													$fec_des20,
													$mon_des20,
													$fec_des21,
													$mon_des21,
													$fec_des22,
													$mon_des22,
													$fec_des23,
													$mon_des23,
													$fec_des24,
													$mon_des24,
													$fec_des25,
													$mon_des25,
													$fec_des26,
													$mon_des26,
													$fec_des27,
													$mon_des27,
													$fec_des28,
													$mon_des28,
													$fec_des29,
													$mon_des29,
													$fec_des30,
													$mon_des30,
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
											   medida='$medida',
											   fec_des1='$fec_des1',
											   mon_des1='$mon_des1',
											   fec_des2='$fec_des2',
											   mon_des2='$mon_des2',
											   fec_des3='$fec_des3',
											   mon_des3='$mon_des3',
											   fec_des4='$fec_des4',
											   mon_des4='$mon_des4',
											   fec_des5='$fec_des5',
											   mon_des5='$mon_des5',
											   fec_des6='$fec_des6',
											   mon_des6='$mon_des6',
											   fec_des7='$fec_des7',
											   mon_des7='$mon_des7',
											   fec_des8='$fec_des8',
											   mon_des8='$mon_des8',
											   fec_des9='$fec_des9',
											   mon_des9='$mon_des9',
											   fec_des10='$fec_des10',
											   mon_des10='$mon_des10',
											   fec_des11='$fec_des11',
											   mon_des11='$mon_des11',
											   fec_des12='$fec_des12',
											   mon_des12='$mon_des12',
											   fec_des13='$fec_des13',
											   mon_des13='$mon_des13',
											   fec_des14='$fec_des14',
											   mon_des14='$mon_des14',
											   fec_des15='$fec_des15',
											   mon_des15='$mon_des15',
											   fec_des16='$fec_des16',
											   mon_des16='$mon_des16',
											   fec_des17='$fec_des17',
											   mon_des17='$mon_des17',
											   fec_des18='$fec_des18',
											   mon_des18='$mon_des18',
											   fec_des19='$fec_des19',
											   mon_des19='$mon_des19',
											   fec_des20='$fec_des20',
											   mon_des20='$mon_des20',
											   fec_des21='$fec_des21',
											   mon_des21='$mon_des21',
											   fec_des22='$fec_des22',
											   mon_des22='$mon_des22',
											   fec_des23='$fec_des23',
											   mon_des23='$mon_des23',
											   fec_des24='$fec_des24',
											   mon_des24='$mon_des24',
											   fec_des25='$fec_des25',
											   mon_des25='$mon_des25',
											   fec_des26='$fec_des26',
											   mon_des26='$mon_des26',
											   fec_des27='$fec_des27',
											   mon_des27='$mon_des27',
											   fec_des28='$fec_des28',
											   mon_des28='$mon_des28',
											   fec_des29='$fec_des29',
											   mon_des29='$mon_des29',
											   fec_des30='$fec_des30',
											   mon_des30='$mon_des30',
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
				         medida,
				         tmep.des_larga AS des_medida,
				         ttpr.`des_larga` AS des_tip_dscto,
				         tmod.`des_larga` AS des_modalidad,
				         modalidad,
				         tip_dscto,
				         solicitante,
				         aprob_por,
				         pr.usu_reg AS regis, 
				         CONCAT( SUBSTRING_INDEX(tur.nom_trab, ' ', 1) , ' ' ,  tur.apepat_trab)  AS registrante,
				         DATE_FORMAT(fec_des1, '%d/%m/%Y') fec_des1, 
				         mon_des1,
				         DATE_FORMAT(fec_des2, '%d/%m/%Y') fec_des2,
				         mon_des2,
				         DATE_FORMAT(fec_des3, '%d/%m/%Y') fec_des3,
				         mon_des3,
				         DATE_FORMAT(fec_des4, '%d/%m/%Y') fec_des4,
				         mon_des4,
				         DATE_FORMAT(fec_des5, '%d/%m/%Y') fec_des5,
				         mon_des5,
				         DATE_FORMAT(fec_des6, '%d/%m/%Y') fec_des6,
				         mon_des6,
				         DATE_FORMAT(fec_des7, '%d/%m/%Y') fec_des7,
				         mon_des7,
				         DATE_FORMAT(fec_des8, '%d/%m/%Y') fec_des8,
				         mon_des8,
				         DATE_FORMAT(fec_des9, '%d/%m/%Y') fec_des9,
				         mon_des9,
				         DATE_FORMAT(fec_des10, '%d/%m/%Y') fec_des10,
				         mon_des10,
				         DATE_FORMAT(fec_des11, '%d/%m/%Y') fec_des11,
				         mon_des11,
				         DATE_FORMAT(fec_des12, '%d/%m/%Y') fec_des12,
				         mon_des12,
				         DATE_FORMAT(fec_des13, '%d/%m/%Y') fec_des13,
				         mon_des13,
				         DATE_FORMAT(fec_des14, '%d/%m/%Y') fec_des14,
				         mon_des14,
				         DATE_FORMAT(fec_des15, '%d/%m/%Y') fec_des15,
				         mon_des15,
				         DATE_FORMAT(fec_des16, '%d/%m/%Y') fec_des16,
				         mon_des16,
				         DATE_FORMAT(fec_des17, '%d/%m/%Y') fec_des17,
				         mon_des17,
				         DATE_FORMAT(fec_des18, '%d/%m/%Y') fec_des18,
				         mon_des18,
				         DATE_FORMAT(fec_des19, '%d/%m/%Y') fec_des19,
				         mon_des19,
				         DATE_FORMAT(fec_des20, '%d/%m/%Y') fec_des20,
				         mon_des20,
				         DATE_FORMAT(fec_des21, '%d/%m/%Y') fec_des21,
				         mon_des21,
				         DATE_FORMAT(fec_des22, '%d/%m/%Y') fec_des22,
				         mon_des22,
				         DATE_FORMAT(fec_des23, '%d/%m/%Y') fec_des23,
				         mon_des23,
				         DATE_FORMAT(fec_des24, '%d/%m/%Y') fec_des24,
				         mon_des24,
				         DATE_FORMAT(fec_des25, '%d/%m/%Y') fec_des25,
				         mon_des25,
				         DATE_FORMAT(fec_des26, '%d/%m/%Y') fec_des26,
				         mon_des26,
				         DATE_FORMAT(fec_des27, '%d/%m/%Y') fec_des27,
				         mon_des27,
				         DATE_FORMAT(fec_des28, '%d/%m/%Y') fec_des28,
				         mon_des28,
				         DATE_FORMAT(fec_des29, '%d/%m/%Y') fec_des29,
				         mon_des29,
						 DATE_FORMAT(fec_des30, '%d/%m/%Y') fec_des30,
						 mon_des30
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
				LEFT JOIN tabla_maestra_detalle AS tmep ON
				tmep.cod_argumento= pr.medida
				AND tmep.cod_tabla='TMEP'
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


	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function selectFechas()
	{
		$sql="SELECT id_cp, 
		 			 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		             TbFpa.Des_Larga AS Descrip_fec_pag,
		             des_fec_pag, 
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des1,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des2,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des3,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des4,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des5,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des6,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des7,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des8,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des9,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des10,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des11,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des12,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des13,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des14,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des15,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des16,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des17,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des18,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des19,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des20,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des21,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des22,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des23,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des24,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des25,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des26,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des27,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des28,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des29,
					 DATE_FORMAT(fec_pag, '%d/%m/%Y') AS fec_des30,
		             est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE cp.id_ano='12'

			ORDER BY  cp.des_fec_pag ASC";
		return ejecutarConsulta($sql);
	}



	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
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
