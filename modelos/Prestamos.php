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
	public function eliminar(                   $id_pre,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg)
	{
		$sql="DELETE FROM  prestamos    WHERE id_pre='$id_pre'";
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
		$sql="SELECT   pr.id_pre, DATE(pr.fec_sol) AS fec_sol, CONCAT(sol.nom_trab,' ',sol.apepat_trab,' ',sol.apemat_trab) AS sol_apellidosynombres,  pr.motivo, num_cuotas, modalidad,
         cantidad, pagado, saldo, data_adjunta, medida, tmep.des_larga AS des_medida, ttpr.`des_larga` AS des_tip_dscto, tmod.`des_larga` AS des_modalidad, tip_dscto,
	 solicitante, aprob_por, pr.usu_reg AS regis,  CONCAT( SUBSTRING_INDEX(tur.nom_trab, ' ', 1) , ' ' ,  tur.apepat_trab)  AS registrante,
	 TbFpa1.fecha1,  fec_des1, TbFpa2.fecha2,  fec_des2, TbFpa3.fecha3,  fec_des3, TbFpa4.fecha4,  fec_des4, TbFpa5.fecha5,  fec_des5, TbFpa6.fecha6,  fec_des6,
	 TbFpa7.fecha7,  fec_des7, TbFpa8.fecha8,  fec_des8, TbFpa9.fecha9,  fec_des9, TbFpa10.fecha10,  fec_des10, TbFpa11.fecha11,  fec_des11, TbFpa12.fecha12,  fec_des12,
	 TbFpa13.fecha13,  fec_des13, TbFpa14.fecha14,  fec_des14, TbFpa15.fecha15,  fec_des15, TbFpa16.fecha16,  fec_des16, TbFpa17.fecha17,  fec_des17,TbFpa18.fecha18,  fec_des18,
	 TbFpa19.fecha19,  fec_des19, TbFpa20.fecha20,  fec_des20, TbFpa21.fecha21,  fec_des21, TbFpa22.fecha22,  fec_des22, TbFpa23.fecha23,  fec_des23, TbFpa24.fecha24,  fec_des24,
	 TbFpa25.fecha25,  fec_des25, TbFpa26.fecha26,  fec_des26, TbFpa27.fecha27,  fec_des27, TbFpa28.fecha28,  fec_des28, TbFpa29.fecha29,  fec_des29, TbFpa30.fecha30,  fec_des30,
	 pr.mon_des1, pr.mon_des2, pr.mon_des3, pr.mon_des4,  pr.mon_des5, pr.mon_des6,  pr.mon_des7, pr.mon_des8,  pr.mon_des9, pr.mon_des10,
	 pr.mon_des11, pr.mon_des12, pr.mon_des13, pr.mon_des14, pr.mon_des15, pr.mon_des16, pr.mon_des17, pr.mon_des18, pr.mon_des18, pr.mon_des19,
	 pr.mon_des20, pr.mon_des20, pr.mon_des21, pr.mon_des22, pr.mon_des23, pr.mon_des24, pr.mon_des25, pr.mon_des26, pr.mon_des27, pr.mon_des28,
	 pr.mon_des29, pr.mon_des30 
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
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa1.des_larga ) AS   fecha1
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON    pr.fec_des1=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa1 ON    TbFpa1.cod_argumento=  pr.fec_des1 AND TbFpa1.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON   TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa1 ON  TbFpa1.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa2.des_larga ) AS   fecha2
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des2=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa2 ON  TbFpa2.cod_argumento=  pr.fec_des2 AND TbFpa2.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa2 ON  TbFpa2.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa3.des_larga ) AS   fecha3
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des3=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa3 ON  TbFpa3.cod_argumento=  pr.fec_des3 AND TbFpa3.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa3 ON  TbFpa3.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa4.des_larga ) AS   fecha4
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des4=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa4 ON  TbFpa4.cod_argumento=  pr.fec_des4 AND TbFpa4.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa4 ON  TbFpa4.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa5.des_larga ) AS   fecha5
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des5=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa5 ON  TbFpa5.cod_argumento=  pr.fec_des5 AND TbFpa5.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa5 ON  TbFpa5.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa6.des_larga ) AS   fecha6
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des6=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa6 ON  TbFpa6.cod_argumento=pr.fec_des6 AND TbFpa6.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa6 ON  TbFpa6.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa7.des_larga ) AS   fecha7
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des7=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa7 ON  TbFpa7.cod_argumento=pr.fec_des7 AND TbFpa7.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa7 ON  TbFpa7.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa8.des_larga ) AS   fecha8
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des8=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa8 ON  TbFpa8.cod_argumento=pr.fec_des8 AND TbFpa8.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa8 ON  TbFpa8.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa9.des_larga ) AS   fecha9
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des9=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa9 ON  TbFpa9.cod_argumento=pr.fec_des9 AND TbFpa9.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa9 ON  TbFpa9.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa10.des_larga ) AS   fecha10
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des10=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa10 ON  TbFpa10.cod_argumento=pr.fec_des10 AND TbFpa10.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa10 ON  TbFpa10.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa11.des_larga ) AS   fecha11
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des11=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa11 ON  TbFpa11.cod_argumento=pr.fec_des11 AND TbFpa11.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa11 ON  TbFpa11.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa12.des_larga ) AS   fecha12
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des12=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa12 ON  TbFpa12.cod_argumento=pr.fec_des12 AND TbFpa12.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa12 ON  TbFpa12.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa13.des_larga ) AS   fecha13
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des13=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa13 ON  TbFpa13.cod_argumento=pr.fec_des13 AND TbFpa13.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa13 ON  TbFpa13.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa14.des_larga ) AS   fecha14
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des14=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa14 ON  TbFpa14.cod_argumento=pr.fec_des14 AND TbFpa14.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa14 ON  TbFpa14.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa15.des_larga ) AS   fecha15
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des15=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa15 ON  TbFpa15.cod_argumento=pr.fec_des15 AND TbFpa15.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa15 ON  TbFpa15.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa16.des_larga ) AS   fecha16
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des16=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa16 ON  TbFpa16.cod_argumento=pr.fec_des16 AND TbFpa16.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa16 ON  TbFpa16.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa17.des_larga ) AS   fecha17
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des17=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa17 ON  TbFpa17.cod_argumento=pr.fec_des17 AND TbFpa17.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa17 ON  TbFpa17.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa18.des_larga ) AS   fecha18
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des18=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa18 ON  TbFpa18.cod_argumento=pr.fec_des18 AND TbFpa18.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa18 ON  TbFpa18.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa19.des_larga ) AS   fecha19
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des19=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa19 ON  TbFpa19.cod_argumento=pr.fec_des19 AND TbFpa19.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa19 ON  TbFpa19.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa20.des_larga ) AS   fecha20
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des20=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa20 ON  TbFpa20.cod_argumento=pr.fec_des20 AND TbFpa20.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa20 ON  TbFpa20.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa21.des_larga ) AS   fecha21
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des21=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa21 ON  TbFpa21.cod_argumento=pr.fec_des21 AND TbFpa21.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa21 ON  TbFpa21.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa22.des_larga ) AS   fecha22
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des22=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa22 ON  TbFpa22.cod_argumento=pr.fec_des22 AND TbFpa22.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa22 ON  TbFpa22.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa23.des_larga ) AS   fecha23
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des23=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa23 ON  TbFpa23.cod_argumento=pr.fec_des23 AND TbFpa23.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa23 ON  TbFpa23.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa24.des_larga ) AS   fecha24
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des24=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa24 ON  TbFpa24.cod_argumento=pr.fec_des24 AND TbFpa24.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa24 ON  TbFpa24.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa25.des_larga ) AS   fecha25
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des25=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa25 ON  TbFpa25.cod_argumento=pr.fec_des25 AND TbFpa25.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa25 ON  TbFpa25.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa26.des_larga ) AS   fecha26
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des26=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa26 ON  TbFpa26.cod_argumento=pr.fec_des26 AND TbFpa26.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa26 ON  TbFpa26.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa27.des_larga ) AS   fecha27
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des27=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa27 ON  TbFpa27.cod_argumento=pr.fec_des27 AND TbFpa27.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa27 ON  TbFpa27.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa28.des_larga ) AS   fecha28
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des28=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa28 ON  TbFpa28.cod_argumento=pr.fec_des28 AND TbFpa28.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa28 ON  TbFpa28.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa29.des_larga ) AS   fecha29
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des29=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa29 ON  TbFpa29.cod_argumento=pr.fec_des29 AND TbFpa29.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa29 ON  TbFpa29.id_pre= pr.id_pre
				LEFT JOIN 
				(SELECT  pr.id_pre,  CONCAT (TbPea.Des_Corta,' - ',TbFpa30.des_larga ) AS   fecha30
				 FROM prestamos pr 
				  LEFT JOIN  cronograma_pagos AS cp  ON   pr.fec_des30=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa30 ON  TbFpa30.cod_argumento=pr.fec_des30 AND TbFpa30.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON TbPea.cod_argumento=cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa30 ON  TbFpa30.id_pre= pr.id_pre
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
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha1,
					 id_cp AS fec_des1,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS copia_fecha1,
					 id_cp AS copia_fec_des1,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha2,
					 id_cp AS fec_des2,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha3,
					 id_cp AS fec_des3,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha4,
					 id_cp AS fec_des4,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha5,
					 id_cp AS fec_des5,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha6,
					 id_cp AS fec_des6,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha7,
					 id_cp AS fec_des7,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha8,
					 id_cp AS fec_des8,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha9,
					 id_cp AS fec_des9,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha10,
					 id_cp AS fec_des10,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha11,
					 id_cp AS fec_des11,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha12,
					 id_cp AS fec_des12,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha13,
					 id_cp AS fec_des13,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha14,
					 id_cp AS fec_des14,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha15,
					 id_cp AS fec_des15,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha16,
					 id_cp AS fec_des16,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha17,
					 id_cp AS fec_des17,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha18,
					 id_cp AS fec_des18,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha19,
					 id_cp AS fec_des19,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha20,
					 id_cp AS fec_des20,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha21,
					 id_cp AS fec_des21,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha22,
					 id_cp AS fec_des22,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha23,
					 id_cp AS fec_des23,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha24,
					 id_cp AS fec_des24,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha25,
					 id_cp AS fec_des25,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha26,
					 id_cp AS fec_des26,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha27,
					 id_cp AS fec_des27,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha28,
					 id_cp AS fec_des28,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha29,
					 id_cp AS fec_des29,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga) AS fecha30,
					 id_cp AS fec_des30,
		             est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			ORDER BY  TbPea.Des_Corta ASC, cp.des_fec_pag ASC";
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
