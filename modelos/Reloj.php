<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";




Class Reloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros


	public function insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno )
	{


		$sql="INSERT INTO reloj (id_trab, fecha , hor_ent,  pc_reg, usu_reg, fec_reg, tip_pla, tip_mov, est_hor, turno )
		VALUES ('$id_trab', '$fecha', '$hora' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' )";
		return ejecutarConsulta($sql);


	}


	//Implementamos un método para insertar registros
	public function insertar_reloj_vacacionescompradas($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno )
	{


		$sql="INSERT INTO reloj_vacacionescompradas (id_trab, fecha , hor_ent,  pc_reg, usu_reg, fec_reg, tip_pla, tip_mov, est_hor, turno )
		VALUES ('$id_trab', '$fecha', '$hora' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' )";
		return ejecutarConsulta($sql);


	}





	//Implementamos un método para editar registros
	public function editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para editar registros
	public function editar_primera_salida_noche($id_trab,  $fecha_noche, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET hor_sal='$hora'  WHERE id_trab='$id_trab'  AND  hor_sal=''
 			AND fecha= '$fecha_noche'";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function editar_segunda_entrada($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET segunda_hor_ent='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}



		//Implementamos un método para editar registros
	public function editar_segunda_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET segunda_hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
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

	public function consultar_ultimoregistro_xtrabajador($id_trab)
	{
		$sql="SELECT MAX(fecha)  AS fecha_noche, hor_sal AS hor_sal_noche FROM reloj WHERE id_trab='$id_trab'  AND  hor_sal=''  ";
		return ejecutarConsulta($sql);

	}


	// INICIO - AGREGADO EL 12/12/2018 - Leydi Godos

	public function consultarInformacionDiaAnterior($id_trab, $fecha, $hora)
	{
		$sql=" SELECT  DATE(DATE(NOW())-1) AS fecha_dia_anterior,
					re.hor_ent AS hora_ing_anterior,
					re.hor_sal AS hor_sal_anterior,
					fe.estado AS est_dia_anterior,
					REPLACE(TIMEDIFF(  '$hora', re.hor_ent ) ,'-', '')  AS dif_hida_hsho , /*DIFERENCIAS ENTRE INGRESO DIA ANTERIOR Y SALIDA DE DIA ACTUAL FORMTO: '00:00:00'*/
					REPLACE(TIME_TO_SEC( TIMEDIFF(  '$hora', re.hor_ent ) ) ,'-', '')  AS cant_dif_hida_hsho/*DIFERENCIAS ENTRE INGRESO DIA ANTERIOR Y SALIDA DE DIA ACTUAL NUMERICO*/
				  FROM reloj re
				  LEFT JOIN fechas fe ON 
				  DATE(DATE(NOW())-1)=fe.fecha
				  WHERE re.id_trab='$id_trab'  
				  AND  re.fecha= DATE(DATE(NOW())-1)  ";
		return ejecutarConsulta($sql);

	}

	// FIN  - AGREGADO EL 12/12/2018 - Leydi Godos/ MODIFICADO - 26/12/2018 Leydi Godos






	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' ";
		return ejecutarConsulta($sql);

	}



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarDataPersonal($id_trab)
	{
		$sql="SELECT  id_tip_plan, id_turno FROM trabajador WHERE id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarPrimeraSalida($id_trab, $fecha)
	{
		//$sql="SELECT id_trab, tip_pla, hor_sal FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  hor_sal!='' ";


	//HASTA EL 30112018	//$sql="SELECT id_trab,  id_trab as  id_trab_noche, tip_pla, hor_sal FROM reloj WHERE id_trab='$id_trab'  AND  hor_sal!=''
 		//	AND fecha= ( SELECT MAX(fecha) FROM reloj WHERE id_trab='$id_trab'  AND  hor_sal!='' )";


 		$sql="SELECT id_trab,  id_trab, fecha AS  id_trab_noche, tip_pla, hor_sal FROM reloj WHERE id_trab='$id_trab'
 			AND fecha= ( SELECT MAX(fecha) FROM reloj WHERE id_trab='$id_trab') ";


		return ejecutarConsulta($sql);

	}

	//AGREGADO EL 30112018 - VALIDA EL REGISTRO MAYOR A  MINUTOS 

	public function consultarIngresoEnReloj($id_trab, $fecha, $hora)
	{


	 $sql="SELECT r.id_trab, r.hor_ent, REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', r.hor_ent ) ) ,'-', '')  AS intervalo_1ing_1sal   FROM reloj r WHERE id_trab='$id_trab'  AND fecha='$fecha' ";

	 return ejecutarConsulta($sql);

	}


	//AGREGADO EL 30112018 - VALIDA EL REGISTRO MAYOR A  MINUTOS 
	public function consultarPrimeraSalidaEnReloj($id_trab, $fecha, $hora)
	{


	 $sql="SELECT r.id_trab, r.hor_sal, REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', r.hor_sal ) ) ,'-', '')  AS intervalo_1sal_2ing   FROM reloj r WHERE id_trab='$id_trab'  AND fecha='$fecha' ";

	 return ejecutarConsulta($sql);

	}


	//AGREGADO EL 30112018 - VALIDA EL REGISTRO MAYOR A  MINUTOS 
	public function consultarSegundoIngresoEnReloj($id_trab, $fecha, $hora)
	{


	 $sql="SELECT r.id_trab, r.segunda_hor_ent, REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', r.segunda_hor_ent ) ) ,'-', '')  AS intervalo_2ing_2sal  FROM reloj r WHERE id_trab='$id_trab'  AND fecha='$fecha' ";

	 return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarSegundaEntrada($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla, segunda_hor_ent FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  segunda_hor_ent!='' ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarSegundaSalida($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla, segunda_hor_sal FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  segunda_hor_sal!='' ";
		return ejecutarConsulta($sql);

	}



	



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarVacaciones($id_trab, $fecha)
	{
		$sql="SELECT pp.id_trab AS id_vacaciones
				FROM permiso_personal pp
				WHERE pp.tip_permiso='VC'
				AND pp.id_trab='$id_trab'
				AND '$fecha' BETWEEN pp.fecha_procede AND pp.fecha_hasta	";
		return ejecutarConsulta($sql);

	}



   //Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarUsuariosQuePuedenRealizarHE_FP($id_trab)
	{
		$sql="SELECT tr.id_trab AS id_permitido
				FROM trabajador tr
				WHERE tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
				AND tr.id_trab NOT IN  ( SELECT  cv.id_trab  FROM caso_vigilancia cv ) 
				AND tr.id_trab='$id_trab'";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultaridfechaasociada_horaextra($fecha)
	{
		$sql="SELECT '-' AS pd ,
					 cp.id_cp  AS id_cp_he, 
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



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultaridfechaasociada_descuentos($fecha)
	{
		$sql="SELECT '-' AS pd ,
					 cp.id_cp AS id_cp_des,
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




	





	public function consultarHoraIngreso($id_trab, $fecha, $hora )
	{
		$sql="SELECT    tr.id_trab, 
						REPLACE(TIMEDIFF( '$hora', ft.hora_ingreso ) ,'-', '')  AS tiempo_largo , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_ingreso ) ) ,'-', '')  AS cant_tiempo, 
						ft.hora_ingreso AS hora_ing,
						ft.hora_ini_ref,
						ft.hora_fin_ref,
						ft.tiempo_ref,
						ft.estado
				FROM trabajador tr 
				LEFT JOIN 	
				(SELECT  hrt.id_trab, CASE 
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
				WHERE ft.id_trab='$id_trab' ; ";
		return ejecutarConsulta($sql);

	}


	public function consultarHoraExtra($id_trab, $fecha, $hora )
	{
		$sql="SELECT  distinct	  hep.id_trab, 
						REPLACE(TIMEDIFF(  '$hora', hep.hora_inicio ) ,'-', '')  AS tiempo_largo , 
						REPLACE(TIME_TO_SEC( TIMEDIFF(  '$hora', hep.hora_inicio  ) ) ,'-', '')  AS cant_tiempo
				FROM  horas_extras_personal AS hep 
				WHERE  hep.id_trab= '$id_trab'
				AND hep.fecha= '$fecha'
				AND hep.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
				AND hep.id_trab='$id_trab'
				AND hep.est_reg='1'
			 ";
		return ejecutarConsulta($sql);

	}



	public function consultar_Excepciones_Horario_Pago($id_trab)
	{
		$sql="SELECT  ehp.id_trab AS id_trab_excep  FROM excepciones_horario_pago ehp WHERE id_trab='$id_trab' and  ehp.est_reg='1'
		     ";
		return ejecutarConsulta($sql);

	}




	public function consultarHoraSalida_HoraExtra($id_trab, $fecha, $hora )
	{
		$sql="SELECT    tr.id_trab, 
						REPLACE(TIMEDIFF( '$hora', ft.hora_salida ) ,'-', '')  AS tiempo_largo_hs_he , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_salida ) ) ,'-', '')  AS cant_tiempo_hs_he, 
						ft.hora_salida AS hora_sal,
						ft.hora_salida AS hora_salida_sh,
						ft.hora_ingreso AS hora_ingreso_sh,
						ft.hora_ini_ref,
						ft.hora_fin_ref,
						ft.tiempo_ref,
						ft.estado
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





	public function consultarHoraSalida_HoraExtra_TurnoNoche($id_trab, $fecha_noche, $hora )
	{
		$sql="SELECT    tr.id_trab, 
						REPLACE(TIMEDIFF( '$hora', ft.hora_salida ) ,'-', '')  AS tiempo_largo_hs_he_tn , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_salida ) ) ,'-', '')  AS cant_tiempo_hs_he_tn, 
						ft.hora_salida AS hora_salida_sh_tn,
						ft.hora_ingreso AS hora_ingreso_sh_tn
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
					WHERE fe.fecha='$fecha_noche'
				) AS fe ON fe.fecha='$fecha_noche'
				WHERE  hrt.id_trab='$id_trab'
				) AS ft  ON ft.id_trab= tr.id_trab
				WHERE ft.id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}



	
	public function consultarCasoVigilancia($id_trab, $fecha, $hora )
	{
		$sql="SELECT  cv.id_trab, cv.id_trab AS id_casovigilancia, porc_pago   AS por_pago_vig , fedo_canhoras_max,  CASE 
								WHEN  fe.nom_dia='LUNES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='MARTES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='MIERCOLES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='JUEVES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='VIERNES' THEN cv.canhoras_max
								WHEN  fe.nom_dia='SABADO' THEN cv.canhoras_max
								WHEN  fe.nom_dia='DOMINGO' THEN cv.canhoras_max
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


	public function consultarCasoMovilidad($id_trab, $fecha, $hora )
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


	public function consultarDiferenciaHE_DOyFE($id_trab, $fecha, $hora )
	{
		$sql="SELECT  DISTINCT  hep.id_trab, 
					  REPLACE(TIMEDIFF(  hep.hora_inicio, '$hora' ) ,'-', '')  AS tiempo_HE_DOyFE,
				      REPLACE(TIME_TO_SEC( TIMEDIFF(  hep.hora_inicio, '$hora' ) ) ,'-', '')  AS cantidad_HE_DOyFE		
			 FROM horas_extras_personal AS hep 
			 WHERE  hep.id_trab= '$id_trab'
			 AND hep.fecha='$fecha'
			 AND hep.est_reg='1' ";
		return ejecutarConsulta($sql);

	}






	 



	public function restadehorasderefrigerio($id_trab, $tiempo, $tiempo_ref)
	{
		$sql="SELECT   TIMEDIFF( '$tiempo', '$tiempo_ref' )  AS tiempo_dscto 
				FROM trabajador tr 
				WHERE tr.id_trab='$id_trab' ; ";
		return ejecutarConsulta($sql);

	}


	public function consultarpermisoenesedia($id_trab, $fecha)
	{
		$sql="SELECT  pp.id_trab, pp.tip_permiso, pp.motivo, pp.id_permiso
				FROM permiso_personal pp 
				WHERE pp.id_trab='$id_trab'
				AND  pp.fecha_procede='$fecha';";
		return ejecutarConsulta($sql);

	}



	public function calcular_redondeo_tiempo($tiempo)
	{
		$sql="SELECT	CASE 
						WHEN  SUBSTRING('$tiempo', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo', 4, 2)>=30  AND SUBSTRING('$tiempo', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado;";
		return ejecutarConsulta($sql);

	}



	public function calcular_redondeo_tiempo_horas_faltas($tiempo)
	{

		/*5MINUTOS DE TOLERANCIA LUEGO SE DESCONTARA MEDIA HORA*/
		$sql="SELECT CASE 
				WHEN SUBSTRING('$tiempo', 2, 2)>=1 AND SUBSTRING('$tiempo', 4, 2)<=30   AND SUBSTRING('$tiempo', 4, 2)>0    THEN CONCAT(SUBSTRING('$tiempo', 1, 2), ':30:00')	
				WHEN SUBSTRING('$tiempo', 2, 2)>=1 AND SUBSTRING('$tiempo', 4, 2)>30    AND SUBSTRING('$tiempo', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo', 1, 2)+1), 2, '0' ) , ':00:00')	
				WHEN SUBSTRING('$tiempo', 2, 2)=0  AND SUBSTRING('$tiempo', 4, 2)<30    AND SUBSTRING('$tiempo', 4, 2)<=5   THEN  '00:00:00'
				WHEN SUBSTRING('$tiempo', 2, 2)=0  AND SUBSTRING('$tiempo', 4, 2)<30    AND SUBSTRING('$tiempo', 4, 2)>5    THEN  '00:30:00'
				ELSE '-'  END
			AS tiempo_redondeado_falta;";
		return ejecutarConsulta($sql);

	}


		public function calcular_redondeo_tiempo_horas_faltas_permisoconingreso($tiempo)
	{
		$sql="SELECT	CASE 
				WHEN SUBSTRING('$tiempo', 2, 2)>=1 AND SUBSTRING('$tiempo', 4, 2)<=30   AND SUBSTRING('$tiempo', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo', 1, 2), ':30:00')	
				WHEN SUBSTRING('$tiempo', 2, 2)>=1 AND SUBSTRING('$tiempo', 4, 2)>30    AND SUBSTRING('$tiempo', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo', 1, 2)+1), 2, '0' ) , ':00:00')	
				WHEN SUBSTRING('$tiempo', 2, 2)='0:' AND SUBSTRING('$tiempo', 4, 2)>=30    AND SUBSTRING('$tiempo', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo', 1, 2)+1), 2, '0' ) , ':00:00')
				WHEN SUBSTRING('$tiempo', 2, 2)='0:' AND SUBSTRING('$tiempo', 4, 2)<30    AND SUBSTRING('$tiempo', 4, 2)>01  THEN  '00:30:00'
				ELSE '-'  END
				AS tiempo_redondeado_falta;";
		return ejecutarConsulta($sql);

	}



	public function consultar_Diferencia_HActual_HoraSalida($hora, $hora_salida_sh)
	{
		$sql="SELECT  REPLACE(TIMEDIFF( '$hora', '$hora_salida_sh' ) ,'-', '')  AS tiempo_largo_ha_hs , 
					  REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', '$hora_salida_sh' ) ) ,'-', '')  AS cant_tiempo_ha_hs
						 ";
		return ejecutarConsulta($sql);

	}


	public function calcular_diferencia_tiempodscto_tiemporef($tiempo_largo_ha_hs, $tiempo_ref)
	{
		$sql="SELECT  REPLACE(TIMEDIFF( '$tiempo_largo_ha_hs', '$tiempo_ref' ) ,'-', '')  AS tiempo_dscto_con_ref 
						 ";
		return ejecutarConsulta($sql);

	}


	public function consultar_Diferencia_HActual_HoraIngreso($hora, $hora_ingreso_sh)
	{
		$sql="SELECT  REPLACE(TIMEDIFF( '$hora', '$hora_ingreso_sh' ) ,'-', '')  AS tiempo_hisr_hsre , 
					  REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', '$hora_ingreso_sh' ) ) ,'-', '')  AS cant_tiempo_hisr_hsre
						 ";
		return ejecutarConsulta($sql);

	}








	//Implementamos un método para insertar registros
	public function registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado, $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg)
	{									


		$sql="INSERT INTO horas_extras_personal (id_trab,   fecha ,  hora_inicio,  hora_fin,    cantidad,  tiempo_fin,   id_fec_abono, abonar, abonado,   est_dia,   por_pago,   est_reg,   pc_reg,    usu_reg,    fec_reg)
					  					VALUES ('$id_trab', '$fecha', '$hora' , '$hora_ingreso', '$tiempo',  '$tiempo_redondeado',  '$id_cp',    '1' ,    '2',      '$estado', '$por_pago',   '1',    '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}




	//Implementamos un método para insertar registros de horas extras fuera del horario de salida en un dia laborable
	public function registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg)
	{									


		$sql="INSERT INTO horas_extras_personal (id_trab,    fecha ,     hora_inicio,   hora_fin,       cantidad,               tiempo_fin,        id_fec_abono,   abonar,   abonado,   est_dia,     por_pago,   est_reg,  fec_reg ,    usu_reg,    pc_reg  )
					  					VALUES ('$id_trab', '$fecha',   '$hora_salida', '$hora',   '$tiempo_largo_hs_he',  '$tiempo_redondeado',    '$id_cp',      '1' ,     '2',     '$estado',   '$por_pago',  '1',    '$fec_reg',  '$usu_reg', '$pc_reg'  )";
		return ejecutarConsulta($sql); 


	}



	
	




	//Implementamos un método para insertar registros
	public function editar_hora_extra($id_trab, $fecha, $hora, $tiempo, $tiempo_fin, $por_pago )
	{		
			$sql="UPDATE horas_extras_personal SET hora_fin='$hora',  cantidad='$tiempo', tiempo_fin='$tiempo_fin',  por_pago='$por_pago'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}

	




	//Implementamos un método para insertar registros
	public function registrar_hora_permiso($id_trab, $fecha, $hora, $tiempo_ref, $hora_ingreso, $tiempo,  $tiempo_dscto,  $id_incidencia, $id_permiso,  $id_cp, $descontar,  $fec_reg, $pc_reg, $usu_reg )
	{


		$sql="INSERT INTO horas_permiso_personal(id_trab,   fecha ,     hora_inicio,  hora_fin,    cantidad,    tiempo_ref,       tiempo_des,       tiempo_fin,     id_incidencia,   id_permiso,   id_fec_dscto,    descontar,  descontado,    est_reg,      pc_reg,   usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_ingreso' , '$hora' ,  '$tiempo',  '$tiempo_ref',  '$tiempo',  '$tiempo_dscto', '$id_incidencia', '$id_permiso',    '$id_cp',  '$descontar',  '2',            '1',      '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_hora_permiso_sinrefrigerio($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp, $descontar, $fec_reg, $pc_reg, $usu_reg)
	{
                   
		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,      hora_inicio,  hora_fin,    cantidad,   tiempo_des,  tiempo_fin,   id_incidencia,     id_permiso,   id_fec_dscto, descontar,  descontado, habilitar_dscto, est_reg,  pc_reg,    usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_ingreso' , '$hora' ,  '$tiempo',    '$tiempo',  '$tiempo_dscto',   '$id_incidencia',  '$id_permiso',   '$id_cp',  '$descontar',     '2',         '2',          '1',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}




	//Implementamos un método para insertar registros
	public function registrar_hora_permiso_despuesdelingreso_sin_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,  $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp, $descontar, $fec_reg, $pc_reg, $usu_reg)
	{
                   
		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,   hora_inicio,  hora_fin,              cantidad,             tiempo_ref,        tiempo_des,         tiempo_fin,   id_incidencia,     id_permiso,   id_fec_dscto, descontar,  descontado, habilitar_dscto, est_reg,  pc_reg,    usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora' ,   '$hora_salida_sh' , '$tiempo_largo_ha_hs',    '$tiempo_ref',  '$tiempo_largo_ha_hs',  '$tiempo_dscto',   '$id_incidencia',  '$id_permiso',   '$id_cp',  '$descontar',     '2',         '2',          '1',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}


	//Implementamos un método para insertar registros
	public function registrar_hora_permiso_despuesdelingreso_dscto_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,  $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp, $descontar, $fec_reg, $pc_reg, $usu_reg)
	{
                   
		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,   hora_inicio,  hora_fin,              cantidad,             tiempo_ref,        tiempo_des,         tiempo_fin,       id_incidencia,     id_permiso,   id_fec_dscto, descontar,  descontado, habilitar_dscto, est_reg,  pc_reg,    usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora' ,   '$hora_salida_sh' , '$tiempo_largo_ha_hs',    '$tiempo_ref',     '$tiempo_des',      '$tiempo_dscto',   '$id_incidencia',  '$id_permiso',   '$id_cp',  '$descontar',     '2',         '2',          '1',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_dscto($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_ref, $tiempo_des,  $tiempo_fin,  $cant_dia_fin,  $id_incidencia, $id_cp,  $descontar,  $descontado, $habilitar_dscto,  $fec_reg, $pc_reg, $usu_reg)
	{


		$sql="INSERT INTO horas_permiso_personal(id_trab,   fecha ,     hora_inicio,      hora_fin,     cantidad,    tiempo_ref,    tiempo_des,       tiempo_fin,    cant_dia_fin,    id_incidencia,     id_fec_dscto,    descontar,     descontado,     est_reg,  habilitar_dscto  ,   pc_reg,   usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_inicio' , '$hora_fin' ,  '$cantidad',  '$tiempo_ref',  '$tiempo_des',  '$tiempo_fin', '$cant_dia_fin',  '$id_incidencia',     '$id_cp',      '$descontar',  '$descontado',      '1',   '$habilitar_dscto',    '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}

	/********************************************************************VACACIONES COMPRADAS*******************************************************************/


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_reloj_vacaciones_compradas($id_trab, $fecha)
	{
		$sql="SELECT id_trab, hor_ent, hor_sal FROM reloj_vacacionescompradas WHERE id_trab='$id_trab'  and fecha='$fecha' ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarVacacionesCompradas($id_trab, $fecha)
	{
		$sql="SELECT pp.id_trab AS id_vacaciones_compradas
				FROM permiso_personal pp
				WHERE pp.tip_permiso='VC'
				AND pp.id_trab='$id_trab'
				AND '$fecha' BETWEEN pp.fecha_procede AND pp.fecha_hasta
				AND pp.id_vac_com='1'	";
		return ejecutarConsulta($sql);

	}






	public function consultar_IngresoSalida_SegunReloj($id_trab, $fecha,  $hora  )
	{
		$sql="SELECT    tr.id_trab, 
						ft.hora_salida AS hora_salida_sh_vc,
						ft.hora_ingreso AS hora_ingreso_sh_vc,
						REPLACE(TIMEDIFF( '$hora', ft.hora_ingreso ) ,'-', '')  AS dif_hish_hire_vc, 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_ingreso ) ) ,'-', '')  AS cant_dif_hish_hire_vc, 
						REPLACE(TIMEDIFF( '$hora', ft.hora_salida ) ,'-', '')  AS dif_hssh_hsre_vc, 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_salida ) ) ,'-', '')  AS cant_dif_hssh_hsre_vc,
						/*LINEA DE DIFERENICA ENTRE LAS SALIDAS CON EL REFRIGERIO*/
						TIMEDIFF(REPLACE(TIMEDIFF( '$hora', ft.hora_salida ) ,'-', '') , REPLACE( ft.tiempo_ref  ,'-', '')  ) AS dif_hssh_hsre_ref_vc,
						/*LINEA DE DIFERENICA ENTRE EL INGRESO CON EL REFRIGERIO*/
						TIMEDIFF(REPLACE(TIMEDIFF( '$hora', ft.hora_ingreso ) ,'-', '') , REPLACE( ft.tiempo_ref  ,'-', '')  ) AS dif_hish_hire_ref_vc,
						/*LINEA DE DIFERENCIA ENTRE HORA SALIDA Y HORA FIN DE REFRIGERIO*/
						REPLACE(TIMEDIFF( ft.hora_salida , ft.hora_fin_ref ) ,'-', '') AS dif_hfref_hsre_ref_vc,
						/*LINEA DE DIFERENCIA ENTRE HORA DE INGRESO SEGUN HORARIO  Y HORA INICIO  DEL REFRIGERIO*/
						REPLACE(TIMEDIFF( ft.hora_ingreso , ft.hora_ini_ref ) ,'-', '') AS dif_hish_hiref_vc,
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora_ing', '$hora_sal') ) ,'-', '')  AS cant_dif_hire_hsre_vc,
						REPLACE(TIMEDIFF( '$hora_ing', '$hora_sal')  ,'-', '')  AS dif_hire_hsre_vc,
						REPLACE(TIMEDIFF( '$hora' , he_vc.hor_ini_he_vc ) ,'-', '') AS dif_hihevc_hsre_vc,
						ft.hora_ini_ref AS hora_ini_ref_vc,
						ft.hora_fin_ref AS hora_fin_ref_vc,
						ft.tiempo_ref AS tiempo_ref_vc,
						ft.estado as estado_dia_vc
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
				LEFT JOIN(
					SELECT he_vc.id_trab, he_vc.fecha,  he_vc.hora_inicio AS hor_ini_he_vc
					FROM horas_extras_personal_vacaciones_compradas he_vc
					WHERE  he_vc.fecha='$fecha'
					AND he_vc.id_trab='$id_trab'
				) AS  he_vc  ON he_vc.id_trab=tr.id_trab
				WHERE ft.id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	//Implementamos un método para insertar registros
	public function registrar_hora_extra_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg)
	{									


		$sql="INSERT INTO horas_extras_personal_vacaciones_compradas(id_trab,   fecha ,    hora_inicio,      hora_fin,   cantidad,      tiempo_fin,   id_fec_abono,      abonar, abonado,    est_dia,   por_pago,   est_reg,   pc_reg,    usu_reg,    fec_reg)
					  					VALUES ('$id_trab', '$fecha', '$hora_inicio' , '$hora_fin', '$cantidad',  '$tiempo_fin',  '$id_fec_abono',    '1' ,    '2',      '$estado', '$por_pago',   '1',    '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_hora_dscto_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $habilitar_dscto, $fec_reg, $pc_reg, $usu_reg)
	{
                   
		$sql="INSERT INTO horas_permiso_personal_vacaciones_compradas(id_trab,   fecha ,   hora_inicio,          hora_fin,      cantidad,     tiempo_ref,     tiempo_des,    tiempo_fin,        id_incidencia,     id_permiso,      id_fec_dscto,      descontar,      descontado,       habilitar_dscto,      est_reg,   pc_reg,    usu_reg,    fec_reg)
					  		                                 VALUES ('$id_trab', '$fecha',  '$hora_inicio' ,   '$hora_fin' ,   '$cantidad',   '$tiempo_ref',  '$tiempo_des',  '$tiempo_fin',     '$id_incidencia',  '$id_permiso',   '$id_fec_dscto',    '$descontar',     '2',        '$habilitar_dscto',         '1',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}

	//Redondeo de tiempo para horas extras

	public function calcular_redondeo_tiempo_vc($tiempo_ing_vc, $tiempo_sal_vc,  $tiempo_hihevc_hsre_vc)
	{
		$sql="SELECT	CASE 
						WHEN  SUBSTRING('$tiempo_ing_vc', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo_ing_vc', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo_ing_vc', 4, 2)>=30  AND SUBSTRING('$tiempo_ing_vc', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo_ing_vc', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado_ing_vc,
						CASE 
						WHEN  SUBSTRING('$tiempo_sal_vc', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo_sal_vc', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo_sal_vc', 4, 2)>=30  AND SUBSTRING('$tiempo_sal_vc', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo_sal_vc', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado_sal_vc,
						CASE 
						WHEN  SUBSTRING('$tiempo_hihevc_hsre_vc', 4, 2)<30 THEN CONCAT(SUBSTRING('$tiempo_hihevc_hsre_vc', 1, 2), ':00:00')	
						WHEN  SUBSTRING('$tiempo_hihevc_hsre_vc', 4, 2)>=30  AND SUBSTRING('$tiempo_hihevc_hsre_vc', 4, 2)<60  THEN  CONCAT(SUBSTRING('$tiempo_hihevc_hsre_vc', 1, 2), ':30:00')	
						ELSE '-'  END
						AS tiempo_redondeado_hihevc_hsre_vc
						;";
		return ejecutarConsulta($sql);

	}

	public function calcular_redondeo_tiempo_dscto_vc($tiempo_ing_dscto_vc, $tiempo_sal_dscto_vc, $tiempo_ing_ref_dscto_vc, $tiempo_ing_iniref_dscto_vc)
	{
		$sql="SELECT	CASE 
						WHEN SUBSTRING('$tiempo_ing_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)<=30   AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_ing_dscto_vc', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_ing_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)>30    AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_ing_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)>=30    AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_ing_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)<30    AND SUBSTRING('$tiempo_ing_dscto_vc', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_ing_dscto_vc,
						CASE 
						WHEN SUBSTRING('$tiempo_sal_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)<=30   AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_sal_dscto_vc', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_sal_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)>30    AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_sal_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_sal_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)>=30    AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_sal_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_sal_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)<30    AND SUBSTRING('$tiempo_sal_dscto_vc', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_sal_dscto_vc,
						CASE 
						WHEN SUBSTRING('$tiempo_ing_ref_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)<=30   AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_ing_ref_dscto_vc', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_ing_ref_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)>30    AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_ref_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_ing_ref_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)>=30    AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_ref_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_ing_ref_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)<30    AND SUBSTRING('$tiempo_ing_ref_dscto_vc', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_ing_ref_dscto_vc,
						CASE 
						WHEN SUBSTRING('$tiempo_ing_iniref_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)<=30   AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)>0 THEN CONCAT(SUBSTRING('$tiempo_ing_iniref_dscto_vc', 1, 2), ':30:00')	
						WHEN SUBSTRING('$tiempo_ing_iniref_dscto_vc', 2, 2)>=1 AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)>30    AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)<=60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_iniref_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')	
						WHEN SUBSTRING('$tiempo_ing_iniref_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)>=30    AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)<60  THEN  CONCAT(   LPAD( (SUBSTRING('$tiempo_ing_iniref_dscto_vc', 1, 2)+1), 2, '0' ) , ':00:00')
						WHEN SUBSTRING('$tiempo_ing_iniref_dscto_vc', 2, 2)='0:' AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)<30    AND SUBSTRING('$tiempo_ing_iniref_dscto_vc', 4, 2)>01  THEN  '00:30:00'
						ELSE '-'  END
						AS tiempo_redondeado_ing_iniref_dscto_vc
						;";
		return ejecutarConsulta($sql);

	}




	//Implementamos un método para editar registros
	public function editar_primera_salida_vc($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj_vacacionescompradas SET hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function actualizar_hora_extra_vacaciones($id_trab, $fecha,  $hora_fin, $cantidad, $tiempo_fin,  $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE horas_extras_personal_vacaciones_compradas SET hora_fin='$hora_fin',  cantidad='$cantidad', tiempo_fin='$tiempo_fin'  WHERE id_trab='$id_trab'  and fecha='$fecha' ";
		return ejecutarConsulta($sql);
	}



















}

?>