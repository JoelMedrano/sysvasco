<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Vacaciones_Compradas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Implementamos un método para editar registros
	public function editar(  $id_cp,
							 $correlativo,
							 $id_trab,
							 $sueldo,
							 $bono_des_trab,
							 $prod_soles,
							 $dif_soles,
							 $fec_reg,
							 $usu_reg,
							 $pc_reg)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($correlativo))
		{			
			$sql_detalle="UPDATE pago_destajeros SET     
								 sueldo='$sueldo[$num_elementos]', 
								 bono_des_trab='$bono_des_trab[$num_elementos]',
								 prod_soles='$prod_soles[$num_elementos]',
								 dif_soles='$prod_soles[$num_elementos]'- '$sueldo[$num_elementos]'  
						 WHERE id_pd='$id_cp' AND correlativo='$correlativo[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	public function insertar2($id_cp,
							  $CantItems,
							  $correlativo,
							  $id_trab,
							  $sueldo,
							  $bono_des_trab,
							  $prod_soles,
							  $dif_soles,
							  $fec_reg,
							  $usu_reg,
							  $pc_reg )
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;

		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		
		while ($num_elementos < count($correlativo))
		{	
			$item=$item + 1;
			$sql_detalle = "INSERT INTO pago_destajeros(id_pd,
													    correlativo,
													    id_trab,
													    sueldo,
													    bono_des_trab,
													    prod_soles,
													    dif_soles,
													    fec_reg,
													    usu_reg,
													    pc_reg ) 
 												VALUES( '$id_cp',
 														'$item',
 														'$id_trab[$num_elementos]',
 														'$sueldo[$num_elementos]',
 														'$bono_des_trab[$num_elementos]',
 														'$prod_soles[$num_elementos]',
 														'$prod_soles[$num_elementos]'- '$sueldo[$num_elementos]' , 
 														'$fec_reg',
 														'$usu_reg',
 														'$pc_reg'  )  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			
		}

			return $sw;

	}


	//Implementamos un método para anular la venta
	public function anular($nro_doc)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_permiso)
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
			WHERE  cp.id_cp='$id_cp'
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_cp)
	{
		$sql="SELECT  * FROM (/*INICIO MARCACIONES EN RELOJ A LA FECHA */ 
				SELECT  	'-' AS mar, 
						DATE_FORMAT(re.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						re.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						 CONCAT(re.hor_ent, ' - ', re.hor_sal) hor_ent_sal,
						fe.estado,
						'' AS detalle,
						IFNULL(hep.tiempo_he,'') AS  horas_extras,
						IF( IFNULL(hpp.tiempo_he,'')='00:00:00', '' , IFNULL(hpp.tiempo_he,'') ) AS horas_faltas,
						hpp_min.tiempo_tardanza AS min_tardanza
				FROM  reloj re 
					INNER JOIN trabajador  tr  ON  
					re.id_trab= tr.id_trab  
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
					LEFT JOIN fechas fe ON
					fe.fecha= re.fecha
					LEFT JOIN
					(     SELECT  hep.id_trab, hep.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_extras_personal hep	
					      GROUP BY hep.id_trab, hep.fecha
					)AS hep ON hep.id_trab=re.id_trab
					AND hep.fecha=re.fecha	
					LEFT JOIN
					(     SELECT  hpp.id_trab, hpp.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_permiso_personal hpp	
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp ON hpp.id_trab=re.id_trab
					AND hpp.fecha=re.fecha	
					LEFT JOIN
					(   SELECT  hpp.id_trab, hpp.fecha, 
								hpp.tiempo_des AS tiempo_tardanza
					      FROM   horas_permiso_personal hpp	
					      WHERE hpp.tiempo_des <'00:30:00'
					      AND  hpp.tiempo_des >'00:00:00'
					      AND hpp.tiempo_fin<'00:30:00'
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp_min ON hpp_min.id_trab=re.id_trab
					AND hpp_min.fecha=re.fecha	
				/*FIN MARCACIONES EN RELOJ A LA FECHA */ 
				UNION ALL
				/*INICIO  -  FALTAS REGISTRADAS EN LA TABLA CON DIAS INTEGROS*/
				SELECT  '-' AS mar, 
						DATE_FORMAT(hpp.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						hpp.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						'FALTA' hor_ent_sal,
						fe.estado,
						pp.permiso AS detalle,
						null AS  horas_extras,
						null AS horas_faltas,
						null AS min_tardanza
				FROM  horas_permiso_personal hpp
				INNER JOIN trabajador  tr  ON  
					hpp.id_trab= tr.id_trab  
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
					LEFT JOIN fechas fe ON
					fe.fecha= hpp.fecha
					LEFT JOIN(
						SELECT  pp.fecha_procede, pp.fecha_hasta , pp.id_trab, tbm.des_larga AS permiso
						FROM permiso_personal pp 
						LEFT JOIN tabla_maestra_detalle  tbm ON
						tbm.des_corta= pp.tip_permiso
						AND tbm.cod_tabla='TPER'
						WHERE pp.tip_permiso NOT IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM')
					) AS pp ON pp.id_trab= hpp.id_trab
					AND hpp.fecha BETWEEN pp.fecha_procede AND  pp.fecha_hasta 
					WHERE hpp.cant_dia_fin='1'
					/*FIN  -  FALTAS REGISTRADAS EN LA TABLA CON DIAS INTEGROS*/
					 UNION ALL 
					 /*INICIO -  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					 SELECT  '-' AS mar, 
						DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						pp.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						tbm.des_larga AS  hor_ent_sal, /**/
						fe.estado,
						CONCAT(re.hor_ent, ' - ', re.hor_sal)  AS detalle,
						null AS  horas_extras,
						null AS horas_faltas,
						null AS min_tardanza
					 FROM fechas fe
					 INNER JOIN permiso_personal pp ON
					 fe.fecha BETWEEN  pp.fecha_procede  AND pp.fecha_hasta 
					 LEFT JOIN Trabajador tr ON
					 pp.id_trab= tr.id_trab
					 LEFT JOIN tabla_maestra_detalle  tbm ON
					 tbm.des_corta= pp.tip_permiso
					 AND tbm.cod_tabla='TPER'
					 LEFT JOIN tabla_maestra_detalle AS tpla ON
						tpla.cod_argumento= tr.id_tip_plan
						AND tpla.cod_tabla='TPLA'
					 LEFT JOIN tabla_maestra_detalle AS tsua ON
						tsua.cod_argumento= tr.id_sucursal
						AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
						tfun.cod_argumento= tr.id_funcion
						AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
						tare.cod_argumento= tr.id_area
						AND tare.cod_tabla='TARE'
					LEFT JOIN  reloj re  ON 
					    pp.id_trab= re.id_trab 
					    AND fe.fecha= re.fecha
					/*NOT EXISTS (  SELECT  NULL FROM reloj re WHERE pp.id_trab= re.id_trab AND fe.fecha= re.fecha)*/
					WHERE pp.tip_permiso IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM')
					AND fe.fecha <= CURDATE()
					/*FIN  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					UNION ALL
					/* FERIADOS Y DOMINGOS*/
					SELECT   '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						    fe.dia,
		                    fe.mes,
		                    tr.id_trab,
		                    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
		                    tsua.des_larga AS sucursal_anexo,
		                    tfun.des_larga AS funcion,
		                    tare.des_larga AS area_trab,
		                    tr.num_doc_trab,
		                    fe.estado AS  hor_ent_sal, /**/
	                    	fe.estado,
		                    '' AS detalle,
		                    null AS  horas_extras,
							null AS horas_faltas,
							null AS min_tardanza
				    FROM Trabajador AS tr CROSS JOIN  Fechas AS fe
					LEFT JOIN tabla_maestra_detalle AS tpla ON
						tpla.cod_argumento= tr.id_tip_plan
						AND tpla.cod_tabla='TPLA'
					LEFT JOIN tabla_maestra_detalle AS tsua ON
						tsua.cod_argumento= tr.id_sucursal
						AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
						tfun.cod_argumento= tr.id_funcion
						AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
						tare.cod_argumento= tr.id_area
						AND tare.cod_tabla='TARE'
					WHERE fe.fecha<= CURDATE()
				    AND fe.estado IN ('FERIADO','NO LABORABLE')
                    AND  NOT EXISTS(  SELECT  NULL 
		  				              FROM reloj re 
		  							  WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha
	    		    ) /*CASOS COMO VIGILANCIA*/
					AND NOT EXISTS(  SELECT NULL 
		 							 FROM permiso_personal pp 
		  							 WHERE  fe.fecha BETWEEN  pp.fecha_procede  AND pp.fecha_hasta 
		 							 AND pp.id_trab=tr.id_trab
	    			)
					/*FIN - FERIADOS Y DOMINGOS */
					UNION ALL
					/*INICIO - DIAS NO LABORABLES SEGUN HORARIO */
					SELECT  '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3) AS nom_dia,
							fe.dia,
							fe.mes,
							tr.id_trab,
							CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
							tsua.des_larga AS sucursal_anexo,
							tfun.des_larga AS funcion,
							tare.des_larga AS area_trab,
							tr.num_doc_trab,
							'NO LABORABLE SEGUN HORARIO' AS  hor_ent_sal, /**/
							fe.estado,
							'' AS detalle,
							null AS  horas_extras,
							null AS horas_faltas,
							null AS min_tardanza
						FROM  trabajador tr CROSS JOIN fechas fe
						LEFT JOIN tabla_maestra_detalle AS tpla ON
							  tpla.cod_argumento= tr.id_tip_plan
							  AND tpla.cod_tabla='TPLA'
						LEFT JOIN tabla_maestra_detalle AS tsua ON
							  tsua.cod_argumento= tr.id_sucursal
							  AND tsua.cod_tabla='TSUA'
						LEFT JOIN tabla_maestra_detalle AS tfun ON
							 tfun.cod_argumento= tr.id_funcion
							 AND tfun.cod_tabla='TFUN'
						LEFT JOIN tabla_maestra_detalle AS tare ON
							 tare.cod_argumento= tr.id_area
							AND tare.cod_tabla='TARE'
						LEFT JOIN 
						( 				SELECT  hrt.id_trab, fe.fecha, 
										CASE 
														WHEN  fe.nom_dia='LUNES' THEN hor.lunes_ingreso
														WHEN  fe.nom_dia='MARTES' THEN hor.martes_ingreso
														WHEN  fe.nom_dia='MIERCOLES' THEN hor.miercoles_ingreso 
														WHEN  fe.nom_dia='JUEVES' THEN hor.jueves_ingreso 
														WHEN  fe.nom_dia='VIERNES' THEN hor.viernes_ingreso 
														WHEN  fe.nom_dia='SABADO' THEN hor.sabado_ingreso 
														WHEN  fe.nom_dia='DOMINGO' THEN hor.domingo_ingreso 
														ELSE '-'  END
														AS hora_ingreso
										FROM horario_refrigerio_trabajador AS hrt 
										LEFT JOIN horario  AS  hor ON
										hrt.id_horario= hor.id_horario
										LEFT JOIN refrigerio AS ref ON
										ref.cod_ref= hrt.cod_ref 
										LEFT JOIN  fechas AS fe  ON
										fe.estado='LABORABLE'
										
						) AS dato  ON dato.id_trab= tr.id_trab
						AND dato.fecha=fe.fecha
						WHERE  fe.fecha <= CURDATE()
						AND dato.hora_ingreso='00:00:00'
						AND  NOT EXISTS (  SELECT  NULL FROM reloj re WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha)
				    UNION ALL
					/*FIN - DIAS NO LABORABLES SEGUN HORARIO*/
					/*INICIO - FALTAS EN SABADOS LABORABLES SON 04:30:00 EN DURO*/
					SELECT  '-' AS mar, 
						DATE_FORMAT(hpp.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						hpp.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						'FALTA' hor_ent_sal,
						fe.estado,
						pp.permiso AS detalle,
						NULL AS  horas_extras,
						hpp.tiempo_fin AS horas_faltas,
						NULL AS min_tardanza
				 FROM  horas_permiso_personal hpp
				 INNER JOIN trabajador  tr  ON  
				 	hpp.id_trab= tr.id_trab  
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
					LEFT JOIN fechas fe ON
					fe.fecha= hpp.fecha
					LEFT JOIN(
						SELECT  pp.fecha_procede, pp.fecha_hasta , pp.id_trab, tbm.des_larga AS permiso
						FROM permiso_personal pp 
						LEFT JOIN tabla_maestra_detalle  tbm ON
						tbm.des_corta= pp.tip_permiso
						AND tbm.cod_tabla='TPER'
						WHERE pp.tip_permiso NOT IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM')
					) AS pp ON pp.id_trab= hpp.id_trab
					AND hpp.fecha BETWEEN pp.fecha_procede AND  pp.fecha_hasta 
					WHERE hpp.cant_dia_fin='0'
					AND SUBSTRING(fe.nom_dia,1,3)='SAB' 
					AND hpp.tiempo_fin>='04:30:00'
					/*FIN - FALTAS EN SABADOS LABORABLES*/

					) rm  WHERE  rm.id_trab LIKE '%$id_trab%'
						ORDER BY rm.mes DESC, rm.dia DESC
			    /*	AND DATE(re.fecha)>='$fecha_inicio' AND DATE(re.fecha)<='$fecha_fin' */
				/*	AND rm.Fecha BETWEEN '$fecha_inicio' AND  '$fecha_fin'*/
";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' as vc ,
					  pp.id_trab,
					  pp.id_permiso,
					  CONCAT(tr.apepat_trab, ' ' ,tr.apemat_trab , ' ' ,tr.nom_trab) AS nombresyapellidos,
					  DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y')  AS fecha_procede, 
					  DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')  AS  fecha_hasta
				FROM permiso_personal_prueba pp
				LEFT JOIN  trabajador tr ON 
				tr.id_trab= pp.id_trab
				WHERE pp.tip_permiso='VC'
				AND pp.id_vac_com='1' ";
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





	
}
?>