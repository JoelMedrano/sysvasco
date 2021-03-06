<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Reporte_Diario_Asistencia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad, $id_est_civil, $id_tip_doc, $num_doc_trab,
		                     $num_tlf_dom,$num_tlf_cel, $email_trab, $id_sucursal, $id_funcion,$id_area, $id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab,$bono_trab, $asig_trab, 
		                     $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen, $id_com_act, $id_genero, $id_t_registro, 
				             $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="INSERT INTO trabajador (nom_trab,apepat_trab,apemat_trab,dir_trab,urb_trab,id_distrito, departamento, fec_nac_trab,lug_nac_trab,nacionalidad, id_est_civil , id_tip_doc, num_doc_trab,
			                          num_tlf_dom,num_tlf_cel, email_trab, id_sucursal, id_funcion ,id_area, id_turno, fec_ing_trab, fec_cese_trab, id_tip_plan, sueldo_trab, bono_trab, asig_trab,
			                          obs_trab, id_cen_cost, id_tip_man_ob, id_categoria, id_form_pag, id_tip_cont, id_reg_pen,id_com_act, id_genero, id_t_registro, 
				 fecfin_con_ant, fecfin_con_act, cusp_trab, est_reg, usu_reg, pc_reg, fec_reg )
		VALUES ('$nom_trab','$apepat_trab','$apemat_trab','$dir_trab','$urb_trab', '$id_distrito', '$departamento', '$fec_nac_trab', '$lug_nac_trab', '$nacionalidad', '$id_est_civil', 
			    '$id_tip_doc', '$num_doc_trab', '$num_tlf_dom' ,'$num_tlf_cel', '$email_trab', '$id_sucursal', '$id_funcion', '$id_area', '$id_turno','$fec_ing_trab','$fec_cese_trab', 
			    '$id_tip_plan', '$sueldo_trab', '$bono_trab', '$asig_trab', '$obs_trab', '$id_cen_cost', '$id_tip_man_ob', '$id_categoria', '$id_form_pag', '$id_tip_cont',
			    '$id_reg_pen','$id_com_act', '$id_genero', '$id_t_registro', '$fecfin_con_ant', '$fecfin_con_act', '$cusp_trab', '1', '$usu_reg', '$pc_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_trab,$nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad,$id_est_civil,
				$id_tip_doc,$num_doc_trab,$num_tlf_dom,$num_tlf_cel,$email_trab,$id_sucursal,$id_funcion,$id_area,$id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab,
				 $bono_trab, $asig_trab, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen,$id_com_act, $id_genero, $id_t_registro, 
				 $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="UPDATE trabajador SET nom_trab='$nom_trab',apepat_trab='$apepat_trab',apemat_trab='$apemat_trab',dir_trab='$dir_trab',urb_trab='$urb_trab', id_distrito='$id_distrito',
		        departamento='$departamento',fec_nac_trab='$fec_nac_trab',lug_nac_trab='$lug_nac_trab',nacionalidad='$nacionalidad',id_est_civil='$id_est_civil',id_tip_doc='$id_tip_doc',
				num_doc_trab='$num_doc_trab',num_tlf_dom='$num_tlf_dom',num_tlf_cel='$num_tlf_cel',email_trab='$email_trab',id_sucursal='$id_sucursal',id_funcion='$id_funcion',
				id_area='$id_area',id_turno='$id_turno',fec_ing_trab='$fec_ing_trab',fec_cese_trab='$fec_cese_trab',id_tip_plan='$id_tip_plan',sueldo_trab='$sueldo_trab',
				bono_trab='$bono_trab', asig_trab='$asig_trab', obs_trab='$obs_trab',id_cen_cost='$id_cen_cost', id_tip_man_ob='$id_tip_man_ob',id_categoria='$id_categoria',
				id_form_pag='$id_form_pag', id_tip_cont='$id_tip_cont', id_reg_pen='$id_reg_pen',id_com_act='$id_com_act', id_genero='$id_genero',id_t_registro='$id_t_registro',
				fecfin_con_ant='$fecfin_con_ant', fecfin_con_act='$fecfin_con_act', cusp_trab='$cusp_trab', usu_mod='$usu_reg', pc_mod='$pc_reg', fec_mod='$fec_reg'
		 WHERE id_trab='$id_trab'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para insertar registros
	public function insertar_datos($prueba, $usu_reg, $pc_reg, $fec_reg )
	{

		$sql="INSERT INTO trabajador_familia (id_trab, usu_reg, pc_reg, fec_reg )
		VALUES ('$prueba', '$usu_reg,', '$pc_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar_datos($prueba, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, 
				$fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad, $viv_con, $nom_con, 
				$ocu_con, $dep_con, $eda_hij1, $nom_hij1, $ocu_hij1, $dep_hij1, $dat_hij1, $eda_hij2, 
				$nom_hij2, $ocu_hij2, $dep_hij2, $eda_hij3, $nom_hij3, $ocu_hij3, $dep_hij3,
				$eda_hij4, $nom_hij4, $ocu_hij4, $dep_hij4, $nom_fam_con, $par_fam_con, $are_fam_con,
				$cen_est_pri, $grado_pri, $fec_ini_pri, $fec_fin_pri, $cen_est_sec, $grado_sec, $fec_ini_sec,
				$fec_fin_sec, $cen_est_sup, $carrera_sup, $fec_des_sup, $fec_has_sup, $cen_est_tec, $carrera_tec,
				$fec_ini_tec, $fec_fin_tec, $cen_est_esp, $especialidad, $fec_ini_esp, $fec_fin_esp, $cen_est_otros,
				$carrera_otros, $fec_ini_otros, $fec_fin_otros, $des_idioma, $cen_est_idioma, $nivel_idioma, $des_comp,
				$cen_est_comp, $nivel_comp, $tie_enf_car_onc, $nom_enf_car_onc, $afi_onp, $afi_afp, $nom_afi_afp,
				$usu_reg, $pc_reg, $fec_reg)
	{
		$sql="UPDATE trabajador_familia   AS tf 
				INNER JOIN trabajador_estudios AS te ON
				te.id_trab= tf.id_trab
				INNER JOIN trabajador_conocimiento AS tc ON
				tc.id_trab= tf.id_trab
				INNER JOIN trabajador_salud AS ts ON
				ts.id_trab= tf.id_trab
				INNER JOIN trabajador_afiliacion AS ta ON
				ta.id_trab= tf.id_trab
		 		SET  tf.viv_pad='$viv_pad', tf.nom_pad='$nom_pad', tf.ocu_pad='$ocu_pad', tf.dep_pad='$dep_pad', 
				tf.fec_rec_dat='$fec_rec_dat', tf.viv_mad='$viv_mad', tf.nom_mad='$nom_mad', tf.ocu_mad='$ocu_mad', tf.dep_mad='$dep_mad', tf.viv_con='$viv_con', 
				tf.nom_con='$nom_con', tf.ocu_con='$ocu_con', tf.dep_con='$dep_con', tf.eda_hij1='$eda_hij1', tf.nom_hij1='$nom_hij1', tf.ocu_hij1='$ocu_hij1',
				tf.dep_hij1='$dep_hij1', tf.dat_hij1='$dat_hij1', tf.eda_hij2='$eda_hij2', tf.nom_hij2='$nom_hij2', tf.ocu_hij2='$ocu_hij2', tf.dep_hij2='$dep_hij2', tf.eda_hij3='$eda_hij3', 
				tf.nom_hij3='$nom_hij3', tf.ocu_hij3='$ocu_hij3', tf.dep_hij3='$dep_hij3', tf.eda_hij4='$eda_hij4', tf.nom_hij4='$nom_hij4', tf.ocu_hij4='$ocu_hij4',
				tf.dep_hij4='$dep_hij4', tf.nom_fam_con='$nom_fam_con', tf.par_fam_con='$par_fam_con', tf.are_fam_con='$are_fam_con', te.cen_est_pri='$cen_est_pri', 
				te.grado_pri='$grado_pri', te.fec_ini_pri='$fec_ini_pri', te.fec_fin_pri='$fec_fin_pri', te.cen_est_sec='$cen_est_sec', te.grado_sec='$grado_sec', 
				te.fec_ini_sec='$fec_ini_sec', te.fec_fin_sec='$fec_fin_sec', te.cen_est_sup='$cen_est_sup', te.carrera_sup='$carrera_sup', te.fec_des_sup='$fec_des_sup', 
				te.fec_has_sup='$fec_has_sup', te.cen_est_tec='$cen_est_tec', te.carrera_tec='$carrera_tec', te.fec_ini_tec='$fec_ini_tec', te.fec_fin_tec='$fec_fin_tec', 
				te.cen_est_esp='$cen_est_esp', te.especialidad='$especialidad', te.fec_ini_esp='$fec_ini_esp', te.fec_fin_esp='$fec_fin_esp', te.cen_est_otros='$cen_est_otros',
				te.carrera_otros='$carrera_otros', te.fec_ini_otros='$fec_ini_otros', te.fec_fin_otros='$fec_fin_otros', tc.des_idioma='$des_idioma',
				tc.cen_est_idioma='$cen_est_idioma', tc.nivel_idioma='$nivel_idioma', tc.des_comp='$des_comp',	tc.cen_est_comp='$cen_est_comp', tc.nivel_comp='$nivel_comp', 
				ts.tie_enf_car_onc='$tie_enf_car_onc', ts.nom_enf_car_onc='$nom_enf_car_onc', ta.afi_onp='$afi_onp', ta.afi_afp='$afi_afp', 
				ta.nom_afi_afp='$nom_afi_afp', tf.usu_mod='$usu_reg', tf.pc_mod='$pc_reg', tf.fec_mod='$fec_reg'
		 WHERE tf.id_trab='$prueba'
		 AND te.id_trab='$prueba'
		 AND tc.id_trab='$prueba'
		 AND ts.id_trab='$prueba'
		 AND ta.id_trab='$prueba'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_trab, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="UPDATE trabajador SET est_reg='0', usu_anu='$usu_reg', pc_anu='$pc_reg', fec_anu='$fec_reg'  WHERE id_trab='$id_trab'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_trab)
	{
		$sql="UPDATE trabajador SET est_reg='1' WHERE id_trab='$id_trab'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_trab)
	{
		$sql="SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg, tr.fecfin_con_ant, tr.fecfin_con_act,
		tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
		tr.id_sucursal, IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
		tr.id_funcion ,  tfun.des_larga AS funcion,
		tr.id_area, tare.des_larga AS area_trab, 
		tr.id_genero, tgen.des_larga AS genero,
		tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
		tr.id_cen_cost, tcco.des_larga AS centro_costos,
        tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
		tr.id_categoria, tcal.des_larga AS categoria_laboral,
		tr.id_form_pag, tfop.des_larga AS forma_pago,
		tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
		tr.id_est_civil, teci.des_larga AS estado_civil,
		tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
		tr.id_com_act, ttca.des_larga AS comision_actual,
		tr.id_t_registro, ttre.des_larga AS t_registro,
		tr.num_doc_trab,
		tr.nacionalidad,
		tr.dir_trab,
		tr.urb_trab,
		tr.departamento,
		DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y')   AS fec_nac_trab,
		tr.lug_nac_trab,
		tr.num_tlf_cel,
		tr.num_tlf_dom,
		tr.email_trab,
		tr.id_turno, ttur.des_larga AS turno,
		DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y')   AS fec_ing_trab,
		DATE_FORMAT(tr.fec_cese_trab, '%d/%m/%Y')   AS fec_cese_trab,
		tr.sueldo_trab,
		tr.bono_trab,
		tr.asig_trab,
		tr.obs_trab,
		DATE_FORMAT(tr.fecfin_con_act, '%d/%m/%Y')   AS fecfin_con_act,
		DATE_FORMAT(tr.fecfin_con_ant, '%d/%m/%Y')   AS fecfin_con_ant,
		tr.cusp_trab,
		YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
		tr.id_distrito , ubi.Distrito AS distrito,
		tf.nom_pad,
		tf.viv_pad,
		tf.ocu_pad,
		tf.dep_pad,
		tf.fec_rec_dat,
		tf.viv_mad,
		tf.nom_mad,
		tf.ocu_mad,
		tf.dep_mad,
		tf.viv_con,
		tf.nom_con,
		tf.ocu_con,
		tf.dep_con,
		tf.eda_hij1,
		tf.nom_hij1,
		tf.ocu_hij1,
		tf.dep_hij1,
		tf.dat_hij1,
		tf.eda_hij2,
		tf.nom_hij2,
		tf.ocu_hij2,
		tf.dep_hij2,
		tf.dat_hij2,
		tf.eda_hij3,
		tf.nom_hij3,
		tf.ocu_hij3,
		tf.dep_hij3,
		tf.dat_hij3,
		tf.eda_hij4,
		tf.nom_hij4,
		tf.ocu_hij4,
		tf.dep_hij4,
		tf.dat_hij4,
		tf.nom_fam_con,
		tf.par_fam_con,
		tf.are_fam_con,
		te.cen_est_pri,
		te.grado_pri,
		DATE_FORMAT(te.fec_ini_pri, '%d/%m/%Y')   AS fec_ini_pri, 
		DATE_FORMAT(te.fec_fin_pri, '%d/%m/%Y')   AS fec_fin_pri,
		te.cen_est_sec,
		te.grado_sec,
		DATE_FORMAT(te.fec_ini_sec, '%d/%m/%Y')   AS fec_ini_sec, 
		DATE_FORMAT(te.fec_fin_sec, '%d/%m/%Y')   AS fec_fin_sec, 
		te.cen_est_sup,
		te.carrera_sup,
		DATE_FORMAT(te.fec_des_sup, '%d/%m/%Y')   AS fec_des_sup,  
		DATE_FORMAT(te.fec_has_sup, '%d/%m/%Y')   AS fec_has_sup, 
		te.cen_est_tec,
		te.carrera_tec,
		DATE_FORMAT(te.fec_ini_tec, '%d/%m/%Y')   AS fec_ini_tec,
		DATE_FORMAT(te.fec_fin_tec, '%d/%m/%Y')   AS fec_fin_tec, 
		te.cen_est_esp,
		te.especialidad,
		DATE_FORMAT(te.fec_ini_esp, '%d/%m/%Y')   AS fec_ini_esp, 
		DATE_FORMAT(te.fec_fin_esp, '%d/%m/%Y')   AS fec_fin_esp,
		te.cen_est_otros,
		te.carrera_otros,
		DATE_FORMAT(te.fec_ini_otros, '%d/%m/%Y')   AS fec_ini_otros, 
		DATE_FORMAT(te.fec_fin_otros, '%d/%m/%Y')   AS fec_fin_otros,
		tc.des_idioma,
		tc.cen_est_idioma,
		tc.nivel_idioma,
		tc.des_comp,
		tc.cen_est_comp,
		tc.nivel_comp,
		ts.tie_enf_car_onc,
		ts.nom_enf_car_onc,
		ta.afi_onp,
		ta.afi_afp,
		ta.nom_afi_afp
				FROM trabajador tr
				LEFT JOIN tabla_maestra_detalle AS tpla ON
				tpla.cod_argumento= tr.id_tip_plan
				AND tpla.cod_tabla='TPLA'
				LEFT JOIN tabla_maestra_detalle AS tsua ON
				tsua.cod_argumento= tr.id_sucursal
				AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL
				LEFT JOIN tabla_maestra_detalle AS tfun ON
				tfun.cod_argumento= tr.id_funcion
				AND tfun.cod_tabla='TFUN'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tr.id_area
				AND tare.cod_tabla='TARE'
                LEFT JOIN tabla_maestra_detalle AS tgen ON
				tgen.cod_argumento= tr.id_genero
				AND tgen.cod_tabla='TGEN' 
				LEFT JOIN tabla_maestra_detalle AS tdoc ON
				tdoc.cod_argumento= tr.id_tip_doc
				AND tdoc.cod_tabla='TDOC' 
				LEFT JOIN tabla_maestra_detalle AS tcco ON
				tcco.cod_argumento= tr.id_cen_cost
				AND tcco.cod_tabla='TCCO' 
				LEFT JOIN tabla_maestra_detalle AS ttmo ON
				ttmo.cod_argumento= tr.id_tip_man_ob
				AND ttmo.cod_tabla='TTMO' 
				LEFT JOIN tabla_maestra_detalle AS tcal ON
				tcal.cod_argumento= tr.id_categoria
				AND tcal.cod_tabla='TCAL' 
			    LEFT JOIN tabla_maestra_detalle AS tfop ON
				tfop.cod_argumento= tr.id_form_pag
				AND tfop.cod_tabla='TFOP' 
				LEFT JOIN tabla_maestra_detalle AS tcon ON
				tcon.cod_argumento= tr.id_tip_cont
				AND tcon.cod_tabla='TCON' 
				LEFT JOIN tabla_maestra_detalle AS teci ON
				teci.cod_argumento= tr.id_est_civil
				AND teci.cod_tabla='TECI' 
				LEFT JOIN tabla_maestra_detalle AS trep ON
				trep.cod_argumento= tr.id_reg_pen
				AND trep.cod_tabla='TREP' 
				LEFT JOIN tabla_maestra_detalle AS ttca ON
				ttca.cod_argumento= tr.id_com_act
				AND ttca.cod_tabla='TTCA' 
				LEFT JOIN tabla_maestra_detalle AS ttre ON
				ttre.cod_argumento= tr.id_t_registro
				AND ttre.cod_tabla='TTRE' 
				LEFT JOIN tabla_maestra_detalle AS ttur ON
				ttur.cod_argumento= tr.id_turno
				AND ttre.cod_tabla='TTUR'
				LEFT JOIN ubigeo AS ubi ON
				ubi.coddist= tr.id_distrito
				AND ubi.coddpto='15' 
				AND ubi.codprov='01'
				LEFT JOIN trabajador_familia AS tf ON
				tf.id_trab= tr.id_trab
				LEFT JOIN trabajador_estudios AS te ON
				te.id_trab= tr.id_trab
				LEFT JOIN trabajador_conocimiento AS tc ON
				tc.id_trab= tr.id_trab
				LEFT JOIN trabajador_salud AS ts ON
				ts.id_trab= tr.id_trab
				LEFT JOIN trabajador_afiliacion AS ta ON
				ta.id_trab= tr.id_trab
			 WHERE tr.id_trab='$id_trab'";
		return ejecutarConsultaSimpleFila($sql);
	}





		

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  tr.id_trab,
					 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					 tpla.des_larga AS tipo_planilla,
					 tsua.des_larga AS sucursal_anexo,
					 tfun.des_larga AS funcion,
					 tare.des_larga AS area_trab,
					  'TARDANZA' AS incidencia,
					  re.hor_ent	
					FROM trabajador  tr
					LEFT JOIN reloj  re 
					ON re.id_trab= tr.id_trab 
					AND re.fecha= CURDATE()
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
					LEFT JOIN (
						SELECT  hrt.id_trab, CASE 
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
								WHERE fe.fecha=CURDATE()
							) AS fe ON fe.fecha=CURDATE()
					) AS ft  ON ft.id_trab= tr.id_trab
					WHERE   tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1')  
					AND re.hor_ent >ft.hora_ingreso
					AND  re.fecha= CURDATE() /*OK TARDANZA*/
					UNION ALL 
					SELECT  tr.id_trab,
					 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					 tpla.des_larga AS tipo_planilla,
					 tsua.des_larga AS sucursal_anexo,
					 tfun.des_larga AS funcion,
					 tare.des_larga AS area_trab,
					  'FALTA' AS incidencia	,
					  '' AS hor_ent
					FROM trabajador  tr
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
					LEFT JOIN (
						SELECT  hrt.id_trab, CASE 
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
								WHERE fe.fecha=CURDATE()
							) AS fe ON fe.fecha=CURDATE()
					) AS ft  ON ft.id_trab= tr.id_trab
					WHERE tr.id_trab NOT IN  ( SELECT  re.id_trab  FROM reloj  re  WHERE fecha= CURDATE() ) 
					AND tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
					AND tr.id_trab NOT IN  ( SELECT  pp.id_trab  FROM  permiso_personal pp WHERE CURDATE() BETWEEN  pp.fecha_procede  AND pp.fecha_hasta)
					AND tr.est_reg='1'  /*OK FALTA*/
					AND  DATE_FORMAT(NOW( ), '%H:%i:%S' )>ft.hora_ingreso /*OK FALTA*/
					UNION ALL 
					SELECT    tr.id_trab,
					    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					    tpla.des_larga AS tipo_planilla,
					    tsua.des_larga AS sucursal_anexo,
					    tfun.des_larga AS funcion,
					    tare.des_larga AS area_trab,
					     tbm.des_larga AS incidencia,
					     '' AS hor_ent  
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
					 WHERE CURDATE() BETWEEN  pp.fecha_procede  AND pp.fecha_hasta /*OK PERMISO O LICENCIA*/
					 AND tr.est_reg='1';
					
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


}

?>