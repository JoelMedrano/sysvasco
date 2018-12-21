<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro_Manual_Horas_Dias
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}



	public function consultar_dia_delafecha( $fecha )
	{
		
		$sql=" SELECT (ELT(WEEKDAY('$fecha') + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS dia_texto  ";
		return ejecutarConsulta($sql);

	}


	
	



	public function consultar_registroenelreloj( $id_trab, $fecha )
	{
		
		$sql="SELECT  id_trab AS id from reloj where fecha ='$fecha' AND id_trab ='$id_trab' ";
		return ejecutarConsulta($sql);

	}




	public function consultar_cantidad_digitos_hora_ing_hora_sal($hora_ing, $hora_sal  )
	{
		
		$sql=" SELECT LENGTH('$hora_ing') AS  cantdig_hora_ing,  LENGTH('$hora_sal') AS  cantdig_hora_sal  ";
		return ejecutarConsulta($sql);

	}


	public function formatear_hora_ing_hora_sal( $hora_ing, $hora_sal  )
	{
		
		$sql="SELECT  IF ( CONCAT('$hora_ing', ':00') =':00' , '',  CONCAT('$hora_ing', ':00') ) AS format_hora_ing,   IF(CONCAT('$hora_sal', ':00')=':00', '', CONCAT('$hora_sal', ':00')) AS format_hora_sal";
		return ejecutarConsulta($sql);

	}




	public function consultar_IngresoSalida_SegunReloj($id_trab, $fecha,  $hora_ing,  $hora_sal  )
	{
		$sql="SELECT    tr.id_trab, 
						ft.hora_salida AS hora_salida_sh,
						ft.hora_ingreso AS hora_ingreso_sh,
						REPLACE(TIMEDIFF( '$hora_ing', ft.hora_ingreso ) ,'-', '')  AS dif_hish_hire , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora_ing', ft.hora_ingreso ) ) ,'-', '')  AS cant_dif_hish_hire, 
						REPLACE(TIMEDIFF( '$hora_sal', ft.hora_salida ) ,'-', '')  AS dif_hssh_hsre , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora_sal', ft.hora_salida ) ) ,'-', '')  AS cant_dif_hssh_hsre,
						/*LINEA DE DIFERENICA ENTRE LAS SALIDAS CON EL REFRIGERIO*/
						TIMEDIFF(REPLACE(TIMEDIFF( '$hora_sal', ft.hora_salida ) ,'-', '') , REPLACE( ft.tiempo_ref  ,'-', '')  ) AS dif_hssh_hsre_ref,
						/*LINEA DE DIFERENCIA ENTRE HORA SALIDA Y HORA FIN DE REFRIGERIO*/
						REPLACE(TIMEDIFF( ft.hora_salida , ft.hora_fin_ref ) ,'-', '') AS dif_hfref_hsre_ref,
						/*LINEA DE DIFERENCIA ENTRE HORA DE INGRESO SEGUN HORARIO  Y HORA INICIO  DEL REFRIGERIO*/
						REPLACE(TIMEDIFF( ft.hora_ingreso , ft.hora_ini_ref ) ,'-', '') AS dif_hish_hiref,
						ft.hora_ini_ref,
						ft.hora_fin_ref,
						ft.tiempo_ref,
						ft.estado as estado_dia
				FROM trabajador tr 
				LEFT JOIN 	
				(SELECT  hrt.id_trab, CASE 
								WHEN  fe.nom_dia='LUNES' THEN hor.lunes_salida
								WHEN  fe.nom_dia='MARTES' THEN hor.martes_salida
								WHEN  fe.nom_dia='MIERCOLES' THEN hor.miercoles_salida
								WHEN  fe.nom_dia='JUEVES' THEN hor.jueves_salida
								WHEN  fe.nom_dia='VIERNES' THEN hor.viernes_salida
								WHEN  fe.nom_dia='SABADO' THEN hor.sabado_salida
								WHEN  fe.nom_dia='DOMINGO' THEN hor.domingo_salida
								ELSE '-'  END
								AS hora_salida,
								CASE 
								WHEN  fe.nom_dia='LUNES' THEN hor.lunes_ingreso
								WHEN  fe.nom_dia='MARTES' THEN hor.martes_ingreso
								WHEN  fe.nom_dia='MIERCOLES' THEN hor.miercoles_ingreso
								WHEN  fe.nom_dia='JUEVES' THEN hor.jueves_ingreso
								WHEN  fe.nom_dia='VIERNES' THEN hor.viernes_ingreso
								WHEN  fe.nom_dia='SABADO' THEN hor.sabado_ingreso
								WHEN  fe.nom_dia='DOMINGO' THEN hor.domingo_ingreso
								ELSE '-'  END
								AS hora_ingreso,
								ref.hora_ini AS hora_ini_ref,
								ref.hora_fin AS hora_fin_ref,
								ref.tiempo AS tiempo_ref,
								fe.estado
				FROM horario_refrigerio_trabajador AS hrt 
				LEFT JOIN horario  AS  hor ON
				hrt.id_horario= hor.id_horario
				LEFT JOIN refrigerio AS ref ON
				ref.cod_ref= hrt.cod_ref 
				LEFT JOIN(
					SELECT  fe.nom_dia, fe.estado ,  fe.fecha
					FROM fechas AS fe  
					WHERE fe.fecha='$fecha'
				) AS fe ON fe.fecha='$fecha'
				WHERE  hrt.id_trab='$id_trab'
				) AS ft  ON ft.id_trab= tr.id_trab
				WHERE ft.id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	 //Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_ExcepcionesHorarioPago($id_trab)
	{
		$sql=" SELECT  ehp.id_trab  AS id_excep 
			   FROM excepciones_horario_pago ehp 
			   WHERE  ehp.id_trab='$id_trab'
				  AND ehp.est_reg='1' ";
		return ejecutarConsulta($sql);

	}


	public function consultarCasoMovilidad($id_trab, $fecha )
	{
		$sql="  SELECT id_trab, 
					   id_trab AS id_casomovilidad,					   
					   canhoras_max AS canthoras_mov,
					   porc_pago  AS por_pago_mov
				FROM caso_movilidad 
				WHERE est_reg='1'
		         AND  id_trab='$id_trab'";
		return ejecutarConsulta($sql);

	}


	public function consultarCasoVigilancia($id_trab, $fecha )
	{
		$sql="SELECT  cv.id_trab, cv.id_trab AS id_casovigilancia, porc_pago   AS por_pago_vig , fedo_canhoras_max,  CASE 
								WHEN  fe.nom_dia='LUNES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='MARTES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='MIERCOLES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='JUEVES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='VIERNES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='SABADO' THEN cv.canhoras_max
								ELSE '-'  END
								AS cantidad_horas,
								fe.estado
				FROM caso_vigilancia AS cv
				LEFT JOIN(
					SELECT  fe.nom_dia, fe.estado ,  fe.fecha
					FROM fechas AS fe  
					WHERE fe.fecha='$fecha'
				) AS fe ON fe.fecha='$fecha'
		    WHERE cv.id_trab='$id_trab' ";
		return ejecutarConsulta($sql);

	}



	public function calcular_redondeo_tiempo($tiempo_ing, $tiempo_sal)
	{
		$sql="SELECT	CASE 
						WHEN  SUBSTRING('$tiempo_ing', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo_ing', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo_ing', 4, 2)>=30  AND SUBSTRING('$tiempo_ing', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo_ing', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado_ing,
						CASE 
						WHEN  SUBSTRING('$tiempo_sal', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo_sal', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo_sal', 4, 2)>=30  AND SUBSTRING('$tiempo_sal', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo_sal', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado_sal
						;";
		return ejecutarConsulta($sql);

	}


	public function calcular_redondeo_tiempo_dscto($tiempo_ing_dscto, $tiempo_sal_dscto,  $tiempo_salconref_dscto, $tiempo_salconfinref_dscto, $tiempo_ingconref_dscto)
	{
		$sql="SELECT	CASE 
						WHEN SUBSTRING('$tiempo_ing_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_dscto', 4, 2)<=30   AND SUBSTRING('$tiempo_ing_dscto', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_ing_dscto', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_ing_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_dscto', 4, 2)>30    AND SUBSTRING('$tiempo_ing_dscto', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_dscto', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_ing_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_dscto', 4, 2)>=30    AND SUBSTRING('$tiempo_ing_dscto', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_dscto', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_ing_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_dscto', 4, 2)<30    AND SUBSTRING('$tiempo_ing_dscto', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_ing_dscto,
						CASE 
						WHEN SUBSTRING('$tiempo_sal_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_sal_dscto', 4, 2)<=30   AND SUBSTRING('$tiempo_sal_dscto', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_sal_dscto', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_sal_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_sal_dscto', 4, 2)>30    AND SUBSTRING('$tiempo_sal_dscto', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_sal_dscto', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_sal_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_sal_dscto', 4, 2)>=30    AND SUBSTRING('$tiempo_sal_dscto', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_sal_dscto', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_sal_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_sal_dscto', 4, 2)<30    AND SUBSTRING('$tiempo_sal_dscto', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_sal_dscto,
						CASE 
						WHEN SUBSTRING('$tiempo_salconref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)<=30   AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_salconref_dscto', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_salconref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)>30    AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_salconref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_salconref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)>=30    AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_salconref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_salconref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)<30    AND SUBSTRING('$tiempo_salconref_dscto', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_salconref_dscto,
						CASE 
						WHEN SUBSTRING('$tiempo_salconfinref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)<=30   AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_salconfinref_dscto', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_salconfinref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)>30    AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_salconfinref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_salconfinref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)>=30    AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_salconfinref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_salconfinref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)<30    AND SUBSTRING('$tiempo_salconfinref_dscto', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_salconfinref_dscto,
						CASE 
						WHEN SUBSTRING('$tiempo_ingconref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)<=30   AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_ingconref_dscto', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_ingconref_dscto', 2, 2)>=1 AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)>30    AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ingconref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_ingconref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)>=30    AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ingconref_dscto', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_ingconref_dscto', 2, 2)='0:' AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)<30    AND SUBSTRING('$tiempo_ingconref_dscto', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_ingconref_dscto
						;";
		return ejecutarConsulta($sql);

	}



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultaridfechaasociada($fecha)
	{
		$sql="SELECT '-' AS pd ,
					 cp.id_cp  AS id_cp, 
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
					 fe.fecha,
					 est_reg 
			FROM cronograma_dsctos_abonos_horasdias cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN fechas fe ON
				fe.fecha BETWEEN cp.desde AND cp.hasta
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND fe.fecha='$fecha'
			ORDER BY  cp.id_cp ASC
				";
		return ejecutarConsulta($sql);

	}









	//Implementamos un método para insertar registros
	public function insertar(				   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg)
	{
		$sql="INSERT INTO registro_manual_horas_dias (id_trab,
											fecha, 
											hora_ing,
											hora_sal, 
											id_accion, 
											obs,   
											est_reg, 
											fec_reg, 
											pc_reg, 
											usu_reg )
									VALUES ('$id_trab',
										    '$fecha',
										    '$hora_ing',
										    '$hora_sal',
										    '$id_accion', 
										    '$obs', 
										    '1',
										    '$fec_reg', 
										    '$pc_reg', 
										    '$usu_reg')";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros
	public function insertar_reloj($id_trab,
									$fecha,
									$fec_reg,
									$pc_reg,
									$usu_reg,
									$hora_ing, 
									$hora_sal,
									$id_tip_plan,
									$dia,
									$est_hor,
									$id_turno )
	{


		$sql="INSERT INTO reloj (id_trab,  fecha , hor_ent,       hor_sal,       pc_reg,    usu_reg,   fec_reg,       tip_pla,     tip_mov,   est_hor,     turno )
					VALUES ('$id_trab', '$fecha', '$hora_ing' ,  '$hora_sal' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' ) ";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg)
	{									


		$sql="INSERT INTO horas_extras_personal (id_trab,   fecha ,    hora_inicio,      hora_fin,   cantidad,      tiempo_fin,   id_fec_abono,      abonar, abonado,    est_dia,   por_pago,   est_reg,   pc_reg,    usu_reg,    fec_reg)
					  					VALUES ('$id_trab', '$fecha', '$hora_inicio' , '$hora_fin', '$cantidad',  '$tiempo_fin',  '$id_fec_abono',    '1' ,    '2',      '$estado', '$por_pago',   '1',    '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}


	//Implementamos un método para insertar registros
	public function registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg)
	{
                   
		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,   hora_inicio,          hora_fin,      cantidad,     tiempo_ref,     tiempo_des,    tiempo_fin,        id_incidencia,     id_permiso,      id_fec_dscto,      descontar,  descontado, habilitar_dscto, est_reg,  pc_reg,    usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_inicio' ,   '$hora_fin' , '$cantidad',    '$tiempo_ref',  '$tiempo_des',  '$tiempo_fin',     '$id_incidencia',  '$id_permiso',   '$id_fec_dscto',    '$descontar',     '2',         '2',          '1',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}




	//Implementamos un método para insertar registros
	public function insertar_reloj_data_eliminada(  $id_trab,
													$fecha)
	{


		$sql="INSERT INTO reloj_data_eliminada
					SELECT * FROM reloj WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function actualizar_quienelimino_reloj(  $id_trab,
													$fecha,
													$fec_reg,
													$pc_reg,
													$usu_reg
											   )
	{
		$sql="UPDATE reloj_data_eliminada SET   fec_mod='$fec_reg', 
											  	pc_mod='$pc_reg', 
										 		usu_mod='$usu_reg' 
								    	  WHERE id_trab='$id_trab'
								          AND   fecha='$fecha' ";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para eliminar registros
	public function eliminar_reloj(  				$id_trab,
													$fecha)
	{
		$sql="DELETE FROM reloj WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);
	}




	//Implementamos un método para insertar registros
	public function insertar_hora_extra_data_eliminada(  $id_trab,
										 			     $fecha)
	{
		$sql="INSERT INTO horas_extras_personal_data_eliminada
					SELECT * FROM horas_extras_personal WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function actualizar_quienelimino_hora_extra(  $id_trab,
													$fecha,
													$fec_reg,
													$pc_reg,
													$usu_reg
											   )
	{
		$sql="UPDATE horas_extras_personal_data_eliminada SET   fec_mod='$fec_reg', 
															  	pc_mod='$pc_reg', 
														 		usu_mod='$usu_reg' 
												    	  WHERE id_trab='$id_trab'
												          AND   fecha='$fecha' ";
		return ejecutarConsulta($sql);
	}




	//Implementamos un método para eliminar registros
	public function eliminar_hora_extra(  			$id_trab,
													$fecha)
	{
		$sql="DELETE FROM horas_extras_personal WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros
	public function insertar_hora_falta_data_eliminada(  $id_trab,
										  $fecha)
	{
		$sql="INSERT INTO horas_permiso_personal_data_eliminada
					SELECT * FROM horas_permiso_personal WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function actualizar_quienelimino_hora_falta( $id_trab,
														$fecha,
														$fec_reg,
														$pc_reg,
														$usu_reg
												   )
	{
		$sql="UPDATE horas_permiso_personal_data_eliminada SET      fec_mod='$fec_reg', 
																  	pc_mod='$pc_reg', 
															 		usu_mod='$usu_reg' 
													    	  WHERE id_trab='$id_trab'
													          AND   fecha='$fecha' ";
		return ejecutarConsulta($sql);
	}




	//Implementamos un método para eliminar registros
	public function eliminar_hora_falta(  			$id_trab,
													$fecha)
	{
		$sql="DELETE FROM horas_permiso_personal WHERE fecha='$fecha' and id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);
	}








	






	//Implementamos un método para editar registros
	public function editar(				       $id_rmhd,
											   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg
											   )
	{
		$sql="UPDATE registro_manual_horas_dias SET id_trab='$id_trab',
										  fecha='$fecha',
										  hora_ing='$hora_ing',
										  hora_sal='$hora_sal', 
										  id_accion='$id_accion', 
										  obs='$obs',
										  fec_mod='$fec_reg', 
										  pc_mod='$pc_reg', 
										  usu_mod='$usu_reg' 
								    WHERE id_rmhd='$id_rmhd'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_tipodepagovacaciones( $id_trab, $fecha )
	{
		
		$sql="SELECT  id_trab AS id from horas_extras_personal where fecha ='$fecha' AND id_trab ='$id_trab'
 			 ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_pagodevacacionesjornal($id_trab, $dias  )
	{
		
		$sql="SELECT id_trab, ROUND( ((sueldo_trab/30) * '$dias'),2)  AS monto_a_pagar, sueldo_trab
			  FROM Trabajador  
			  WHERE id_trab='$id_trab' 
 			 ";
		return ejecutarConsulta($sql);

	}




	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_turno($id_trab)
	{
		$sql="SELECT hr.id_turno, hrt.id_trab  
			  FROM horario_refrigerio_trabajador hrt
			  LEFT JOIN horario hr  ON
			   hr.id_horario= hrt.id_horario
			  WHERE hrt.id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarDataPersonal($id_trab)
	{
		$sql="SELECT  id_tip_plan, id_turno FROM trabajador WHERE id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}




	//Implementamos un método para desactivar registros
	public function desactivar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_reg='0',  fec_anu='$fec_reg', pc_anu='$pc_reg', usu_anu='$usu_reg'   WHERE id_permiso='$id_permiso'  ";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_reg='1',  fec_mod='$fec_reg', pc_mod='$pc_reg', usu_mod='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para aprobar registros
	public function aprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro='1',  fec_apro='$fec_reg', pc_apro='$pc_reg', usu_apro='$usu_reg'   WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desaprobar registros
	public function desaprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro='0',  fec_desapro='$fec_reg', pc_desapro='$pc_reg', usu_desapro='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para aprobar registros
	public function aprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro_rrhh='1',  fec_apro_rrhh='$fec_reg', pc_apro_rrhh='$pc_reg', usu_apro_rrhh='$usu_reg'   WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desaprobar registros
	public function desaprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro_rrhh='0',  fec_desapro_rrhh='$fec_reg', pc_desapro_rrhh='$pc_reg', usu_desapro_rrhh='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	} 




	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_rmhd)
	{
		$sql="SELECT      id_rmhd, 
						  IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
						  tare.des_larga AS area_trab, 
						  CONCAT_WS(' ',    tr.nom_trab , tr.apepat_trab, tr.apemat_trab) AS nombres,
						  DATE(rm.fecha) AS fecha,
						  rm.id_trab,
						  rm.id_accion,
						  rm.hora_ing,
						  rm.hora_sal,
						  rm.obs
			 FROM registro_manual_horas_dias rm
			 LEFT JOIN Trabajador tr ON
			 tr.id_trab= rm.id_trab
			 LEFT JOIN tabla_maestra_detalle AS tsua ON
			 tsua.cod_argumento= tr.id_sucursal
			 AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL 
			 LEFT JOIN tabla_maestra_detalle AS tare ON
			 tare.cod_argumento= tr.id_area
			 AND tare.cod_tabla='TARE'
		     WHERE id_rmhd='$id_rmhd'";
		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function filtrar($id_trab, $fecha)
	{
		$sql="SELECT     '$id_trab' AS id_trab, 
						'$fecha' AS fecha, 
				CASE 
					WHEN  re.hor_ent='00:00:00' THEN '00:00:00'
					WHEN  re.hor_ent!='00:00:00' OR re.hor_ent!='' THEN re.hor_ent
					ELSE ''  END
				AS hora_ing,
		                  CASE 
					WHEN  re.hor_sal='00:00:00' THEN '00:00:00'
					WHEN  re.hor_sal!='00:00:00' OR re.hor_sal!='' THEN re.hor_sal
					ELSE ''  END
				AS hora_sal
			 FROM  trabajador  tr 
			 LEFT JOIN reloj re ON 
			 		  re.id_trab= tr.id_trab
			      AND re.id_trab='$id_trab'
			      AND re.fecha='$fecha'
		     WHERE tr.id_trab='$id_trab'
		     ";
		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT    ''  As marca,
						id_rmhd, 
				  IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
				  tare.des_larga AS area_trab, 
				  CONCAT_WS(' ',    tr.nom_trab , tr.apepat_trab, tr.apemat_trab) AS nombres,
				  DATE_FORMAT(rm.fecha, '%d/%m/%Y') AS fecha
			 FROM registro_manual_horas_dias rm
			 LEFT JOIN Trabajador tr ON
			 tr.id_trab= rm.id_trab
			 LEFT JOIN tabla_maestra_detalle AS tsua ON
			 tsua.cod_argumento= tr.id_sucursal
			 AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL 
			 LEFT JOIN tabla_maestra_detalle AS tare ON
			 tare.cod_argumento= tr.id_area
			 AND tare.cod_tabla='TARE'
			 ORDER  BY fecha DESC
				
		 ";
		return ejecutarConsulta($sql);	
	}

	//Implementar un método para listar los registros
	public function listarfiltrado($idusuario)
	{
		$sql="SELECT  CONCAT_WS(' ',  tr1.apepat_trab,  SUBSTRING_INDEX(tr1.nom_trab, ' ',1) ) AS solicitante,
		 CONCAT_WS(' ',   SUBSTRING_INDEX(tr.nom_trab, ' ',1) , tr.apepat_trab ) AS nombres,
		    DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,  DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta, DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.apepat_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro , pp.est_apro_rrhh, null as ninguno
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 INNER JOIN usuario usu ON
		 usu.login= pp.usu_reg
		 LEFT JOIN Trabajador tr1 ON
		 tr1.id_trab= usu.id_trab
		 WHERE usu.idusuario='$idusuario' 
		 order by pp.id_permiso DESC
		 ";
		return ejecutarConsulta($sql);	
	}



	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function selectFechaPagoVacaciones()
	{
		$sql="SELECT id_cp, 
		 			 id_ano,
		 			 TbPea.Des_Corta AS Ano,
					 TbFpa.Des_Larga AS Descrip_fec_pag,
					 des_fec_pag, 
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha1,
					 id_cp AS id_fecha_pago1,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha2,
					 id_cp AS id_fecha_pago2,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha3,
					 id_cp AS id_fecha_pago3,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha4,
					 id_cp AS id_fecha_pago4,
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






	//Implementar un método para listar los registros
	public function reporte()
	{
		$sql="SELECT DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,   DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.ape_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro 
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 ";
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
	public function selectAccion()
	{
		$sql=" SELECT  Cod_Argumento AS id_accion, des_larga AS accion 
		FROM tabla_maestra_detalle 
		WHERE cod_tabla='TACC'";
		return ejecutarConsulta($sql);
	}





}

?>