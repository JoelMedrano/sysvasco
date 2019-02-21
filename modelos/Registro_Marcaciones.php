<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro_Marcaciones
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementamos un método para actualizar el contrato
	public function editar($id_trab,
										   $id_con_trab,
										   $tie_ren_ant,
										   $fec_ini_ant,
										   $fec_fin_ant,
										   $id_sit_inf_ant,
										   $usu_reg,
										   $pc_reg,
										   $fec_reg  )
	{
		
		$sql="UPDATE contratos SET tie_ren_con='$tie_ren_ant', fec_ini_con='$fec_ini_ant', fec_fin_con='$fec_fin_ant',  id_sit_inf='$id_sit_inf_ant' WHERE id_trab='$id_trab' AND  id_con_trab='$id_con_trab' ";
		return ejecutarConsulta($sql);


	}

	
    


	


	public function insertar2(			 $id_trab,
										 $tie_ren_con,
										 $fec_ini_con,
										 $fec_fin_con,
										 $id_sit_inf_act,
										 $CantItems,
										 $usu_reg,
										 $pc_reg,
										 $fec_reg )
	{
		




	$CantItems=$CantItems+1;
		
			$sql= "INSERT INTO contratos  (   		   id_trab,
													   id_con_trab,
													   tie_ren_con,
													   fec_ini_con,
													   fec_fin_con,
													   id_sit_inf,
													   usu_reg,
													   pc_reg,
													   fec_reg  ) 
											   VALUES( '$id_trab',
											   		   '$CantItems',
											           '$tie_ren_con',
											           '$fec_ini_con',
											           '$fec_fin_con',
											           '$id_sit_inf_act',
											           '$usu_reg',
											           '$pc_reg',
											           '$fec_reg')  ";
		
			
			
		

			return ejecutarConsulta($sql);

	}


	//Implementamos un método para anular la venta
	public function anular($nro_doc)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($nro_doc)
	{
		$sql="SELECT Tra.id_trab, Tra.num_doc_trab AS nro_doc, Tra.num_doc_trab AS id_nomtrab ,  CONCAT(Tra.apepat_trab, ' ' , Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres ,   Tra.apemat_trab, Tra.apepat_trab, Tra.nom_trab, Tra.id_sucursal, Tra.id_area, TbAre.Des_Larga AS area_trab,
              TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab, IFNULL(MAX(con.id_con_trab),0) AS CantItems,
               MAX(DATE(con.fec_ini_con)) AS  fec_ini_ant , MAX(DATE(con.fec_fin_con)) AS fec_fin_ant, con.tie_ren_con AS tie_ren_ant, con.id_con_trab,
               con.id_sit_inf AS id_sit_inf_ant,  TbSic.des_larga AS situacion_informativa_actual
				FROM Trabajador Tra
				LEFT JOIN contratos con ON
					con.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle TbAre ON
					TbAre.cod_tabla='TARE'
					AND TbAre.cod_argumento= Tra.id_area
				LEFT JOIN tabla_maestra_detalle TbSua ON
					TbSua.cod_tabla='TSUA'
					AND TbSua.cod_argumento= Tra.id_sucursal
				LEFT JOIN tabla_maestra_detalle TbSic ON
					TbSic.cod_tabla='TSIC'
					AND TbSic.cod_argumento= con.id_sit_inf
				WHERE  tra.num_doc_trab='$nro_doc' 
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($nro_doc)
	{
		$sql="SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE(fec_del) AS  fec_del, DATE(fec_al) AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
				 pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle
				FROM Vacaciones vac
				LEFT JOIN tabla_maestra_detalle  TbPea ON
				TbPea.cod_tabla='TPEA'
				AND TbPea.cod_argumento= vac.id_periodo
				where vac.nro_doc='$nro_doc'
				ORDER BY  vac.correlativo ASC";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($fecha_inicio,$fecha_fin,$id_trab)
	{
		$sql="SELECT  * FROM (/*INICIO MARCACIONES EN RELOJ A LA FECHA */ 
				SELECT  	'-' AS mar, 
						DATE_FORMAT(re.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
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
						hpp_min.tiempo_tardanza AS min_tardanza,
						IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
						fe.ano,
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
						null AS min_tardanza,
						IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
					/*INICIO - FALTAS DEL DIA ACTUAL SE ACTUALIZAN AL DIA SIGUIENTE,HABRA MARCACION O ALGUN TIPO DE PERMISO*/
					SELECT 	'-' AS mar, 
						DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
						tr.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						'FALTA' hor_ent_sal,
						fe.estado,
						null AS detalle,
						null AS  horas_extras,
						null AS horas_faltas,
						null AS min_tardanza,
						IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
					  FROM trabajador tr
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
					  fe.fecha= CURDATE()
					  LEFT JOIN (
							 SELECT   fe.nom_dia,
								 CASE 
								 WHEN  fe.nom_dia='LUNES'     THEN '1'
								 WHEN  fe.nom_dia='MARTES'    THEN '1'
								 WHEN  fe.nom_dia='MIERCOLES' THEN '1'
								 WHEN  fe.nom_dia='JUEVES'    THEN '1'
								 WHEN  fe.nom_dia='VIERNES'   THEN '1'
								 ELSE '0'  END
								 AS cantidad_dias,
								 CASE 
								 WHEN  fe.nom_dia='SABADO'     THEN 
								 TIMEDIFF(hr.sabado_salida ,  hr.sabado_ingreso )
								 ELSE ''  END
								 AS cantidad_horas,
								 CASE 
								 WHEN  fe.nom_dia='LUNES'     THEN hr.lunes_ingreso
								 WHEN  fe.nom_dia='MARTES'    THEN hr.martes_ingreso
								 WHEN  fe.nom_dia='MIERCOLES' THEN hr.miercoles_ingreso
								 WHEN  fe.nom_dia='JUEVES'    THEN hr.jueves_ingreso
								 WHEN  fe.nom_dia='VIERNES'   THEN hr.viernes_ingreso
								 WHEN  fe.nom_dia='SABADO'   THEN  hr.sabado_ingreso
								 ELSE ''  END
								 AS hora_ingreso_deldia, 
								 TIMEDIFF(hr.sabado_salida ,  
								 hr.sabado_ingreso ) AS tiempo,
								 fe.estado,
								 hrt.id_trab
							FROM horario_refrigerio_trabajador AS hrt
							LEFT JOIN horario AS hr ON 
							hr.id_horario=  hrt.id_horario
							LEFT JOIN fechas AS fe ON 
							fe.fecha= CURDATE()
							/*WHERE  TIMEDIFF(hr.sabado_salida , hr.sabado_ingreso ) >'00:00:00'*/
					 )AS hrt ON  hrt.id_trab= tr.id_trab
					LEFT JOIN ( SELECT   cp.id_cp, fe.fecha
					FROM cronograma_dsctos_horasdias cp
						LEFT  JOIN 	tabla_maestra_detalle TbPea ON
						TbPea.cod_argumento=  cp.id_ano
						AND TbPea.Cod_tabla='TPEA'
						LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
						TbFpa.cod_argumento=  cp.des_fec_pag
						AND TbFpa.Cod_tabla='TFPA'
						LEFT JOIN fechas fe ON
						fe.fecha BETWEEN cp.desde AND cp.hasta
					WHERE  cp.des_fec_pag  NOT IN  ('0')
					AND fe.fecha= CURDATE()
					) AS cp ON cp.fecha= CURDATE()
					 WHERE NOT EXISTS (SELECT NULL
							     FROM reloj re
							    WHERE tr.id_trab = re.id_trab
							    AND re.fecha= CURDATE()
							    )
					 AND NOT EXISTS (SELECT NULL
							     FROM excepciones_horario_pago ehp
							    WHERE ehp.id_trab = tr.id_trab)
					 AND NOT EXISTS ( SELECT NULL 
					       FROM trabajador AS tr1
							LEFT JOIN (
 							         SELECT  fe.nom_dia,
								 CASE 
								 WHEN  fe.nom_dia='LUNES'     THEN hr.lunes_ingreso
								 WHEN  fe.nom_dia='MARTES'    THEN hr.martes_ingreso
								 WHEN  fe.nom_dia='MIERCOLES' THEN hr.miercoles_ingreso
								 WHEN  fe.nom_dia='JUEVES'    THEN hr.jueves_ingreso
								 WHEN  fe.nom_dia='VIERNES'   THEN hr.viernes_ingreso
								 WHEN  fe.nom_dia='SABADO'   THEN  hr.sabado_ingreso
								 ELSE ''  END
								 AS hora_ingreso_deldia,
								 CASE 
								 WHEN  fe.nom_dia='SABADO'     THEN 
								 TIMEDIFF(hr.sabado_salida ,  hr.sabado_ingreso )
								 ELSE ''  END
								 AS cantidad_horas, 
								 TIMEDIFF(hr.sabado_salida ,  
								 hr.sabado_ingreso ) AS tiempo,
								 fe.estado,
								 hrt.id_trab
							FROM horario_refrigerio_trabajador AS hrt
							LEFT JOIN horario AS hr ON 
							hr.id_horario=  hrt.id_horario
							LEFT JOIN fechas AS fe ON 
							fe.fecha= CURDATE() ) AS  hrd ON hrd.id_trab= tr1.id_trab
							WHERE hrd.hora_ingreso_deldia='00:00:00'
							AND tr1.id_trab= tr.id_trab
					 ) 
					 AND NOT EXISTS ( 
					  SELECT      NULL
					  FROM permiso_personal  pp
					  WHERE pp.tip_permiso IN ('VC', 'LS', 'LC', 'LM','LP','FD', 'FF','DM','CO', 'ND')
					  AND  CURDATE() BETWEEN  DATE(pp.fecha_procede) AND   DATE(pp.fecha_hasta)
					  AND pp.id_trab= tr.id_trab
					)
					AND hrt.estado='LABORABLE' 
					AND tiempo IS NOT NULL
					AND TIME (NOW()) > hrt.hora_ingreso_deldia
					AND tr.est_reg='1'
					/*INICIO - FALTAS DEL DIA ACTUAL SE ACTUALIZAN AL DIA SIGUIENTE,HABRA MARCACION O ALGUN TIPO DE PERMISO*/
					 /*INICIO -  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					UNION ALL
					SELECT  '-' AS mar, 
						DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
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
						null AS min_tardanza,
						IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
					WHERE pp.tip_permiso IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM', 'ND')
					AND fe.fecha <= CURDATE()
					/*FIN  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					UNION ALL
					/* FERIADOS Y DOMINGOS - TRABAJADORES ACTIVOS*/
					SELECT   '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						    fe.dia,
		                    fe.mes,
		                    fe.ano,
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
							null AS min_tardanza,
							IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
					AND tr.est_reg='1'
				    AND fe.estado IN ('FERIADO','NO LABORABLE')
				    AND fe.fecha > tr.fec_ing_trab
                    AND  NOT EXISTS(  SELECT  NULL 
		  				              FROM reloj re 
		  							  WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha
	    		    ) /*CASOS COMO VIGILANCIA*/
					AND NOT EXISTS(  SELECT NULL 
		 							 FROM permiso_personal pp 
		  							 WHERE  fe.fecha BETWEEN  pp.fecha_procede  AND pp.fecha_hasta 
		 							 AND pp.id_trab=tr.id_trab
	    			)
					/*FIN - FERIADOS Y DOMINGOS  - trabajadores activos */
					UNION ALL
					/* FERIADOS Y DOMINGOS - TRABAJADORES CESADOS*/
					SELECT   '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						    fe.dia,
		                    fe.mes,
		                    fe.ano,
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
							null AS min_tardanza,
							IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
					WHERE fe.fecha<= tr.fec_sal_trab
					AND tr.est_reg='0'
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
					/*FIN - FERIADOS Y DOMINGOS - Trabajadores Cesados*/
					UNION ALL 
					/*INICIO - DIAS NO LABORABLES SEGUN HORARIO - Trabajadores activos */
					SELECT  '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3) AS nom_dia,
							fe.dia,
							fe.mes,
							fe.ano,
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
							null AS min_tardanza,
							IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
						AND fe.fecha >= tr.fec_ing_trab
						AND tr.est_reg='1'
						AND dato.hora_ingreso='00:00:00'
						AND  NOT EXISTS (  SELECT  NULL FROM reloj re WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha)
				    UNION ALL
					/*FIN - DIAS NO LABORABLES SEGUN HORARIO - Trabajadores Activos*/
					/*INICIO - DIAS NO LABORABLES SEGUN HORARIO - Trabajadores Cesados */
					SELECT  '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							SUBSTRING(fe.nom_dia,1,3) AS nom_dia,
							fe.dia,
							fe.mes,
							fe.ano,
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
							null AS min_tardanza,
							IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
						WHERE  fe.fecha <= tr.fec_sal_trab
						AND tr.est_reg='0'
						AND dato.hora_ingreso='00:00:00'
						AND  NOT EXISTS (  SELECT  NULL FROM reloj re WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha)
				    UNION ALL
					/*FIN - DIAS NO LABORABLES SEGUN HORARIO - Trabajadores Cesados*/
					/*INICIO - FALTAS EN SABADOS LABORABLES SON 04:30:00 EN DURO*/
					SELECT  '-' AS mar, 
						DATE_FORMAT(hpp.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
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
						NULL AS min_tardanza,
						IF(tr.est_reg='1', 'ACTIVO', 'CESADO') AS estado_trab
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
						WHERE pp.tip_permiso NOT IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM', 'ND')
					) AS pp ON pp.id_trab= hpp.id_trab
					AND hpp.fecha BETWEEN pp.fecha_procede AND  pp.fecha_hasta 
					WHERE hpp.cant_dia_fin='0'
					AND SUBSTRING(fe.nom_dia,1,3)='SAB' 
					AND hpp.tiempo_fin>='04:30:00'
					/*FIN - FALTAS EN SABADOS LABORABLES*/

					) rm  WHERE  rm.id_trab LIKE '%$id_trab%'
						ORDER BY rm.ano DESC, rm.mes DESC, rm.dia DESC
			    /*	AND DATE(re.fecha)>='$fecha_inicio' AND DATE(re.fecha)<='$fecha_fin' */
				/*	AND rm.Fecha BETWEEN '$fecha_inicio' AND  '$fecha_fin'*/



				 ";

		return ejecutarConsulta($sql);		
	}

	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function obtenercantidaditems($nro_doc)
	{
		$sql="SELECT MAX(correlativo)
		 FROM vacaciones 
		 WHERE nro_doc='$nro_doc' 
		 ";
		return ejecutarConsulta($sql);	
	}



	
}
?>