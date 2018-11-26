<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Planilla
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad, $id_est_civil, $id_tip_doc, $num_doc_trab,
		                     $num_tlf_dom,$num_tlf_cel, $email_trab, $id_sucursal, $id_funcion,$id_area, $id_turno,$fec_ing_trab, $id_tip_plan, $sueldo_trab,$bono_trab, $bono_des_trab, $asig_trab, 
		                     $id_pag_esp, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen, $id_com_act, $id_genero, $id_t_registro, 
				             $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg, $fec_ing_interno, $fec_sal_interno, $nro_cta_cts, $nro_cta_sue ,  $id_pag_vac_cts  )
	{
		$sql="INSERT INTO trabajador (nom_trab,apepat_trab,apemat_trab,dir_trab,urb_trab,id_distrito, departamento, fec_nac_trab,lug_nac_trab,nacionalidad, id_est_civil , id_tip_doc, num_doc_trab,
			                          num_tlf_dom,num_tlf_cel, email_trab, id_sucursal, id_funcion ,id_area, id_turno, fec_ing_trab, id_tip_plan, sueldo_trab, bono_trab, bono_des_trab,  asig_trab,
			                          id_pag_esp, obs_trab, id_cen_cost, id_tip_man_ob, id_categoria, id_form_pag, id_tip_cont, id_reg_pen,id_com_act, id_genero, id_t_registro, 
				 fecfin_con_ant, fecfin_con_act, cusp_trab, est_reg, usu_reg, pc_reg, fec_reg,  fec_ing_interno, fec_sal_interno,  nro_cta_cts, nro_cta_sue , id_pag_vac_cts  )
		VALUES ('$nom_trab','$apepat_trab','$apemat_trab','$dir_trab','$urb_trab', '$id_distrito', '$departamento', '$fec_nac_trab', '$lug_nac_trab', '$nacionalidad', '$id_est_civil', 
			    '$id_tip_doc', '$num_doc_trab', '$num_tlf_dom' ,'$num_tlf_cel', '$email_trab', '$id_sucursal', '$id_funcion', '$id_area', '$id_turno','$fec_ing_trab',
			    '$id_tip_plan', '$sueldo_trab', '$bono_trab', '$bono_des_trab', '$asig_trab', '$id_pag_esp', '$obs_trab', '$id_cen_cost', '$id_tip_man_ob', '$id_categoria', '$id_form_pag', '$id_tip_cont',
			    '$id_reg_pen','$id_com_act', '$id_genero', '$id_t_registro', '$fecfin_con_ant', '$fecfin_con_act', '$cusp_trab', '1', '$usu_reg', '$pc_reg', '$fec_reg',
			    '$fec_ing_interno', '$fec_sal_interno',  '$nro_cta_cts', '$nro_cta_sue', '$id_pag_vac_cts'  )";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_familia($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_familia(usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}



	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_estudios($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_estudios (usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}


	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_exp_laboral($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_exp_laboral (usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}



	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_conocimiento($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_conocimiento(usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_salud($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_salud(usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_afiliacion($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_afiliacion(usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}





	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_trabajador_data_adjunta($fec_reg, $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO trabajador_data_adjunta (usu_reg, pc_reg, fec_reg) VALUES ('$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}

   
   //Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar_idperiodovacaciones($anoperiodo)
	{
		$sql="SELECT TbPea.cod_argumento As id_ano_periodo
				from tabla_maestra_detalle TbPea
			 WHERE TbPea.cod_tabla='TPEA'
			 AND TbPea.Des_Corta= '$anoperiodo'";

		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros en la tabla de trabajador data adjunta
	public function insertar_primerperiodovacaciones( $num_doc_trab, $fec_ing_trab, $id_tip_plan,  $CantItems, $id_ano_periodo, $anoperiodo, $fec_reg, $usu_reg, $pc_reg  )
	{

		$sql="INSERT INTO vacaciones (nro_doc, correlativo, id_periodo,  usu_reg, pc_reg, fec_reg) VALUES ( '$num_doc_trab', '1', '$id_ano_periodo',  '$usu_reg', '$pc_reg', '$fec_reg')";
		return ejecutarConsulta($sql);

	}




	//Implementamos un método para editar registros
	public function editar($id_trab,$nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad,$id_est_civil,
				$id_tip_doc,$num_doc_trab,$num_tlf_dom,$num_tlf_cel,$email_trab,$id_sucursal,$id_funcion,$id_area,$id_turno,$fec_ing_trab,$fec_sal_trab, $id_tip_plan, $sueldo_trab,
				 $bono_trab, $bono_des_trab, $asig_trab, $id_pag_esp, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen,$id_com_act, $id_genero, $id_t_registro, 
				 $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg ,  $fec_ing_interno, $fec_sal_interno, $mot_sal_interno, $fec_ing2,  $fec_sal2, $mot_sal2,
				 $fec_ing1, $fec_sal1, $mot_sal1, $nro_cta_cts, $nro_cta_sue, $id_pag_vac_cts  )
	{
		$sql="UPDATE trabajador SET nom_trab='$nom_trab',apepat_trab='$apepat_trab',apemat_trab='$apemat_trab',dir_trab='$dir_trab',urb_trab='$urb_trab', id_distrito='$id_distrito',
		        departamento='$departamento',fec_nac_trab='$fec_nac_trab',lug_nac_trab='$lug_nac_trab',nacionalidad='$nacionalidad',id_est_civil='$id_est_civil',id_tip_doc='$id_tip_doc',
				num_doc_trab='$num_doc_trab',num_tlf_dom='$num_tlf_dom',num_tlf_cel='$num_tlf_cel',email_trab='$email_trab',id_sucursal='$id_sucursal',id_funcion='$id_funcion',
				id_area='$id_area',id_turno='$id_turno',fec_ing_trab='$fec_ing_trab',fec_sal_trab='$fec_sal_trab',id_tip_plan='$id_tip_plan',sueldo_trab='$sueldo_trab',
				bono_trab='$bono_trab',  bono_des_trab='$bono_des_trab',  asig_trab='$asig_trab', id_pag_esp='$id_pag_esp', obs_trab='$obs_trab',id_cen_cost='$id_cen_cost', id_tip_man_ob='$id_tip_man_ob',id_categoria='$id_categoria',
				id_form_pag='$id_form_pag', id_tip_cont='$id_tip_cont', id_reg_pen='$id_reg_pen',id_com_act='$id_com_act', id_genero='$id_genero',id_t_registro='$id_t_registro',
				fecfin_con_ant='$fecfin_con_ant', fecfin_con_act='$fecfin_con_act', cusp_trab='$cusp_trab', usu_mod='$usu_reg', pc_mod='$pc_reg', fec_mod='$fec_reg',
				fec_ing_interno='$fec_ing_interno', fec_sal_interno='$fec_sal_interno',  mot_sal_interno='$mot_sal_interno', fec_ing2='$fec_ing2',  fec_sal2='$fec_sal2',
				mot_sal2='$mot_sal2',fec_ing1='$fec_ing1', fec_sal1='$fec_sal1', mot_sal1='$mot_sal1', nro_cta_cts='$nro_cta_cts', nro_cta_sue='$nro_cta_sue',
				id_pag_vac_cts='$id_pag_vac_cts' 
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
	public function editar_datos($prueba, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, $tel_pad,
				$fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad,  $tel_mad, $viv_con, $nom_con, 
				$ocu_con, $dep_con,  $tel_con, $nac_hij1, $nom_hij1, $ocu_hij1, $dep_hij1, $tel_hij1,  $dat_hij1,  $nac_hij2, 
				$nom_hij2, $ocu_hij2, $dep_hij2, $tel_hij2, $nac_hij3, $nom_hij3, $ocu_hij3, $dep_hij3, $tel_hij3,
				$nac_hij4, $nom_hij4, $ocu_hij4, $dep_hij4, $tel_hij4, $nom_otro, $ocu_otro, $dep_otro, $tel_otro,  $nom_fam_con, $par_fam_con, $are_fam_con,
				$cen_est_pri, $grado_pri, $fec_ini_pri, $fec_fin_pri, $cen_est_sec, $grado_sec, $fec_ini_sec,
				$fec_fin_sec, $cen_est_sup, $carrera_sup, $fec_des_sup, $fec_has_sup, $cen_est_tec, $carrera_tec,
				$fec_ini_tec, $fec_fin_tec, $cen_est_esp, $especialidad, $fec_ini_esp, $fec_fin_esp, $cen_est_otros,
				$carrera_otros, $fec_ini_otros, $fec_fin_otros, $des_idioma, $cen_est_idioma, $nivel_idioma, $des_comp,
				$cen_est_comp, $nivel_comp, $nom_emp_exp1, $car_exp1, $fun_exp1, $fec_ini_exp1, $fec_fin_exp1, $mot_ces_exp1,
				$nom_emp_exp2, $car_exp2, $fun_exp2, $fec_ini_exp2, $fec_fin_exp2, $mot_ces_exp2, 
				$nom_emp_exp3, $car_exp3, $fun_exp3, $fec_ini_exp3, $fec_fin_exp3, $mot_ces_exp3,  
				$tie_enf_car_onc, $nom_enf_car_onc, $tie_enf_ale_rec, $id_gru_san, $talla, $peso, 
				$afi_onp, $afi_afp, $nom_afi_afp,
				$usu_reg, $pc_reg, $fec_reg)
	{
		$sql="UPDATE trabajador    AS tr
				LEFT JOIN trabajador_estudios AS te ON
				te.id_trab= tr.id_trab
				LEFT JOIN trabajador_conocimiento AS tc ON
				tc.id_trab= tr.id_trab
				LEFT JOIN trabajador_salud AS ts ON
				ts.id_trab= tr.id_trab
				LEFT JOIN trabajador_afiliacion AS ta ON
				ta.id_trab= tr.id_trab
				LEFT JOIN trabajador_exp_laboral AS tel ON
				tel.id_trab= tr.id_trab
				LEFT JOIN trabajador_familia  AS tf ON
				tr.id_trab= tf.id_trab
		 		SET  tf.viv_pad='$viv_pad', tf.nom_pad='$nom_pad', tf.ocu_pad='$ocu_pad', tf.dep_pad='$dep_pad', tf.tel_pad='$tel_pad', tf.fec_rec_dat='$fec_rec_dat',
				tf.viv_mad='$viv_mad', tf.nom_mad='$nom_mad', tf.ocu_mad='$ocu_mad', tf.dep_mad='$dep_mad', tf.tel_mad='$tel_mad',  tf.viv_con='$viv_con', tf.nom_con='$nom_con', 
				tf.ocu_con='$ocu_con', tf.dep_con='$dep_con', tf.tel_con='$tel_con', tf.nac_hij1='$nac_hij1', tf.nom_hij1='$nom_hij1', tf.ocu_hij1='$ocu_hij1',
				tf.dep_hij1='$dep_hij1',  tf.tel_hij1='$tel_hij1', tf.dat_hij1='$dat_hij1', tf.nac_hij2='$nac_hij2', tf.nom_hij2='$nom_hij2', tf.ocu_hij2='$ocu_hij2',
				tf.dep_hij2='$dep_hij2', tf.tel_hij2='$tel_hij2',  tf.nac_hij3='$nac_hij3', tf.nom_hij3='$nom_hij3', tf.ocu_hij3='$ocu_hij3', tf.dep_hij3='$dep_hij3', 
				tf.tel_hij3='$tel_hij3',  tf.nac_hij4='$nac_hij4', tf.nom_hij4='$nom_hij4', tf.ocu_hij4='$ocu_hij4', tf.dep_hij4='$dep_hij4', tf.tel_hij4='$tel_hij4',
				tf.nom_otro='$nom_otro',  tf.ocu_otro='$ocu_otro', tf.dep_otro='$dep_otro', tf.tel_otro='$tel_otro',
				tf.nom_fam_con='$nom_fam_con', tf.par_fam_con='$par_fam_con', tf.are_fam_con='$are_fam_con', te.cen_est_pri='$cen_est_pri', te.grado_pri='$grado_pri',
				te.fec_ini_pri='$fec_ini_pri', te.fec_fin_pri='$fec_fin_pri', te.cen_est_sec='$cen_est_sec', te.grado_sec='$grado_sec', te.fec_ini_sec='$fec_ini_sec',
				te.fec_fin_sec='$fec_fin_sec', te.cen_est_sup='$cen_est_sup', te.carrera_sup='$carrera_sup', te.fec_des_sup='$fec_des_sup', te.fec_has_sup='$fec_has_sup',
				te.cen_est_tec='$cen_est_tec', te.carrera_tec='$carrera_tec', te.fec_ini_tec='$fec_ini_tec', te.fec_fin_tec='$fec_fin_tec', te.cen_est_esp='$cen_est_esp', 
				te.especialidad='$especialidad', te.fec_ini_esp='$fec_ini_esp', te.fec_fin_esp='$fec_fin_esp', te.cen_est_otros='$cen_est_otros',
				te.carrera_otros='$carrera_otros', te.fec_ini_otros='$fec_ini_otros', te.fec_fin_otros='$fec_fin_otros', tc.des_idioma='$des_idioma',
				tc.cen_est_idioma='$cen_est_idioma', tc.nivel_idioma='$nivel_idioma', tc.des_comp='$des_comp',	tc.cen_est_comp='$cen_est_comp', tc.nivel_comp='$nivel_comp', 
				tel.nom_emp_exp1='$nom_emp_exp1', tel.car_exp1='$car_exp1', tel.fun_exp1='$fun_exp1', tel.fec_ini_exp1='$fec_ini_exp1', tel.fec_fin_exp1='$fec_fin_exp1',
				tel.mot_ces_exp1='$mot_ces_exp1', tel.nom_emp_exp2='$nom_emp_exp2', tel.car_exp2='$car_exp2', tel.fun_exp2='$fun_exp2', tel.fec_ini_exp2='$fec_ini_exp2',
				tel.mot_ces_exp2='$mot_ces_exp2', tel.fec_fin_exp2='$fec_fin_exp2', tel.nom_emp_exp3='$nom_emp_exp3', tel.car_exp3='$car_exp3', tel.fun_exp3='$fun_exp3',
				tel.fec_ini_exp3='$fec_ini_exp3', tel.fec_fin_exp3='$fec_fin_exp3', tel.mot_ces_exp3='$mot_ces_exp3', ts.tie_enf_car_onc='$tie_enf_car_onc',
				ts.nom_enf_car_onc='$nom_enf_car_onc', ts.tie_enf_ale_rec='$tie_enf_ale_rec', tr.id_gru_san='$id_gru_san', tr.talla='$talla', tr.peso='$peso',
				ta.afi_onp='$afi_onp', ta.afi_afp='$afi_afp', ta.nom_afi_afp='$nom_afi_afp', tf.usu_mod='$usu_reg', tf.pc_mod='$pc_reg', tf.fec_mod='$fec_reg'
		 WHERE tf.id_trab='$prueba'
		 AND te.id_trab='$prueba'
		 AND tc.id_trab='$prueba'
		 AND ts.id_trab='$prueba' 
		 AND ta.id_trab='$prueba'
		 AND tel.id_trab='$prueba'
		 AND tr.id_trab='$prueba' ";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros
	public function insertar_data_adjunta($prueba, $usu_reg, $pc_reg, $fec_reg )
	{

		$sql="INSERT INTO trabajador_familia (id_trab, usu_reg, pc_reg, fec_reg )
		VALUES ('$prueba', '$usu_reg,', '$pc_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function editar_data_adjunta($id_trab_data_adjunta, $foto_trab, 
				$dni_trab, $dat_dip_cur_esp, $dat_liquidacion, $dat_hij1,
				$dat_hij2 ,$dat_hij3 ,$dat_hij4 ,$dat_con, $dat_ant_pol,  $dat_luz_agua,
				$dat_cer_med, $dat_dec_dom, $dat_cv, $dat_gra_tit, $dat_idi , $dat_cer_tec, $dat_adi,
				$dat_cer_tra1,  $dat_cer_tra2,$dat_cer_tra3, $dat_cer_res1,  $dat_cer_res2, $dat_cer_res3,
				$dat_pas,$dat_bre, $dat_pla_liq1, $dat_pla_liq2, $dat_pla_liq3,  $dat_int_liq1, $dat_int_liq2,
				$dat_int_liq3, $dat_car_ret_cts1, $dat_car_ret_cts2, $dat_car_ret_cts3,$dat_alt_reg1, 
				$dat_alt_reg2, $dat_alt_reg3,$dat_baj_reg1,  $dat_baj_reg2, $dat_baj_reg3,
				$dat_car_ren, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="UPDATE trabajador_data_adjunta  AS tda
		 		SET   tda.foto_trab='$foto_trab', tda.dni_trab='$dni_trab', tda.dat_dip_cur_esp='$dat_dip_cur_esp', tda.dat_liquidacion='$dat_liquidacion',
		 		tda.dat_hij1='$dat_hij1', tda.dat_hij2='$dat_hij2', tda.dat_hij3='$dat_hij3', tda.dat_hij4='$dat_hij4', tda.dat_con='$dat_con',
		 		tda.dat_ant_pol='$dat_ant_pol',  tda.dat_luz_agua='$dat_luz_agua',  tda.dat_cer_med='$dat_cer_med',  tda.dat_dec_dom='$dat_dec_dom', tda.dat_cv='$dat_cv',
		 		tda.dat_gra_tit='$dat_gra_tit',  tda.dat_idi='$dat_idi',  tda.dat_cer_tec='$dat_cer_tec',  tda.dat_adi='$dat_adi',  tda.dat_cer_tra1='$dat_cer_tra1',
		 		tda.dat_cer_tra2='$dat_cer_tra2', tda.dat_cer_tra3='$dat_cer_tra3', tda.dat_cer_res1='$dat_cer_res1', tda.dat_cer_res2='$dat_cer_res2',
		 		tda.dat_cer_res3='$dat_cer_res3', tda.dat_pas='$dat_pas', tda.dat_bre='$dat_bre',  tda.dat_pla_liq1='$dat_pla_liq1', 
		 		tda.dat_pla_liq2='$dat_pla_liq2', tda.dat_pla_liq3='$dat_pla_liq3',  tda.dat_int_liq1='$dat_int_liq1',  tda.dat_int_liq2='$dat_int_liq2', 
		 		tda.dat_int_liq3='$dat_int_liq3', tda.dat_car_ret_cts1='$dat_car_ret_cts1', tda.dat_car_ret_cts2='$dat_car_ret_cts2',  tda.dat_car_ret_cts3='$dat_car_ret_cts3',
				tda.dat_alt_reg1='$dat_alt_reg1', tda.dat_alt_reg2='$dat_alt_reg2',  tda.dat_alt_reg3='$dat_alt_reg3', tda.dat_baj_reg1='$dat_baj_reg1', 
				tda.dat_baj_reg2='$dat_baj_reg2', tda.dat_baj_reg3='$dat_baj_reg3', tda.dat_car_ren='$dat_car_ren'
		 WHERE tda.id_trab='$id_trab_data_adjunta'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para desactivar registros
	public function cerrar_primeraquincena($primera_quincena)
	{
		$sql="UPDATE tabla_maestra_detalle SET valor_3='2' WHERE cod_tabla='TMES' AND  valor_1='$primera_quincena'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function cerrar_segundaquincena($segunda_quincena)
	{
		$sql="UPDATE tabla_maestra_detalle SET valor_4='2' WHERE cod_tabla='TMES' AND  valor_2='$segunda_quincena'";
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
		DATE(tr.fec_nac_trab) AS fec_nac_trab,
		tr.lug_nac_trab,
		tr.num_tlf_cel,
		tr.num_tlf_dom,
		tr.email_trab,
		tr.id_turno, ttur.des_larga AS turno,
		DATE(tr.fec_ing_trab) AS fec_ing_trab,
		DATE(tr.fec_sal_trab) AS fec_sal_trab,
		DATE(tr.fec_ing2) AS fec_ing2,
		DATE(tr.fec_sal2) AS fec_sal2,
		tr.mot_sal2,
		DATE(tr.fec_ing1) AS fec_ing1,
		DATE(tr.fec_sal1) AS fec_sal1,
		tr.mot_sal1,
		DATE(tr.fec_ing_interno) AS fec_ing_interno,
		DATE(tr.fec_sal_interno) AS fec_sal_interno,
		tr.mot_sal_interno,
		tr.sueldo_trab,
		tr.bono_trab,
		tr.bono_des_trab,
		tr.asig_trab,
		tr.id_pag_esp,
		tmpe.des_larga AS pago_especial,
		tr.obs_trab,
		DATE(tr.fecfin_con_act) AS fecfin_con_act,
		DATE(tr.fecfin_con_ant) AS fecfin_con_ant,
		tr.cusp_trab,
		YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
		tr.id_distrito , ubi.Distrito AS distrito,
		tpcv.des_larga AS pago_vac_cts,
		tr.id_pag_vac_cts,
		tr.nro_cta_cts, 
		tr.nro_cta_sue, 
		tf.nom_pad,
		tf.viv_pad,
		tf.ocu_pad,
		tf.dep_pad,
		tf.tel_pad,
		DATE(tf.fec_rec_dat) AS fec_rec_dat,
		tf.viv_mad,
		tf.nom_mad,
		tf.ocu_mad,
		tf.dep_mad,
		tf.tel_mad,
		tf.viv_con,
		tf.nom_con,
		tf.ocu_con,
		tf.dep_con,
		tf.tel_con,
		DATE(tf.nac_hij1) AS nac_hij1,
		tf.nom_hij1,
		tf.ocu_hij1,
		tf.dep_hij1,
		tf.tel_hij1,
		DATE(tf.nac_hij2) AS nac_hij2,
		tf.nom_hij2,
		tf.ocu_hij2,
		tf.dep_hij2,
		tf.tel_hij2,
		DATE(tf.nac_hij3) AS nac_hij3,
		tf.nom_hij3,
		tf.ocu_hij3,
		tf.dep_hij3,
		tf.tel_hij3,
		DATE(tf.nac_hij4) AS nac_hij4,
		tf.nom_hij4,
		tf.ocu_hij4,
		tf.dep_hij4,
		tf.tel_hij4,
		tf.nom_otro,
		tf.ocu_otro,
		tf.dep_otro,
		tf.tel_otro,
		tf.nom_fam_con,
		tf.par_fam_con,
		tf.are_fam_con,
		te.cen_est_pri,
		te.grado_pri,
		DATE(te.fec_ini_pri)   AS fec_ini_pri, 
		DATE(te.fec_fin_pri)   AS fec_fin_pri,
		te.cen_est_sec,
		te.grado_sec,
		DATE(te.fec_ini_sec) AS fec_ini_sec, 
		DATE(te.fec_fin_sec)   AS fec_fin_sec, 
		te.cen_est_sup,
		te.carrera_sup,
		DATE(te.fec_des_sup)  AS fec_des_sup,  
		DATE(te.fec_has_sup)   AS fec_has_sup, 
		te.cen_est_tec,
		te.carrera_tec,
		DATE(te.fec_ini_tec)   AS fec_ini_tec,
		DATE(te.fec_fin_tec)   AS fec_fin_tec, 
		te.cen_est_esp,
		te.especialidad,
		DATE(te.fec_ini_esp)   AS fec_ini_esp, 
		DATE(te.fec_fin_esp)   AS fec_fin_esp,
		te.cen_est_otros,
		te.carrera_otros,
		DATE(te.fec_ini_otros)  AS fec_ini_otros, 
		DATE(te.fec_fin_otros)  AS fec_fin_otros,
		tc.des_idioma,
		tc.cen_est_idioma,
		tc.nivel_idioma,
		tc.des_comp,
		tc.cen_est_comp,
		tc.nivel_comp,
		tel.nom_emp_exp1,
		tel.car_exp1,
		tel.fun_exp1,
		DATE(tel.fec_ini_exp1) AS fec_ini_exp1,
		DATE(tel.fec_fin_exp1) AS fec_fin_exp1,
		tel.mot_ces_exp1,
		tel.nom_emp_exp2,
		tel.car_exp2,
		tel.fun_exp2,
		DATE(tel.fec_ini_exp2) AS fec_ini_exp2,
		DATE(tel.fec_fin_exp2) AS fec_fin_exp2,
		tel.mot_ces_exp2,
		tel.nom_emp_exp3,
		tel.car_exp3,
		tel.fun_exp3,
		DATE(tel.fec_ini_exp3) AS fec_ini_exp3,
		DATE(tel.fec_fin_exp3) AS fec_fin_exp3,
		tel.mot_ces_exp3,
		ts.tie_enf_car_onc,
		ts.nom_enf_car_onc,
		ts.tie_enf_ale_rec,
		tr.id_gru_san,
		tgsa.des_larga AS grupo_sanguineo,
		tr.talla,
		tr.peso,
		ta.afi_onp,
		ta.afi_afp,
		ta.nom_afi_afp,
		tda.foto_trab,
		tda.dni_trab,
		tda.dat_dip_cur_esp,
		tda.dat_liquidacion,
		tda.dat_hij1,
		tda.dat_hij2,
		tda.dat_hij3,
		tda.dat_hij4,
		tda.dat_con,
		tda.dat_ant_pol,
		tda.dat_luz_agua,
		tda.dat_cer_med,
		tda.dat_dec_dom,
		tda.dat_cv,
		tda.dat_gra_tit,
		tda.dat_idi,
		tda.dat_cer_tec,
		tda.dat_adi,
		tda.dat_cer_tra1,
		tda.dat_cer_tra2,
		tda.dat_cer_tra3,
		tda.dat_cer_res1,
		tda.dat_cer_res2,
		tda.dat_cer_res3,
		tda.dat_pas,
		tda.dat_bre,
		tda.dat_pla_liq1,
		tda.dat_pla_liq2,
		tda.dat_pla_liq3,
		tda.dat_int_liq1,
		tda.dat_int_liq2,
		tda.dat_int_liq3,
		tda.dat_car_ret_cts1,
		tda.dat_car_ret_cts2,
		tda.dat_car_ret_cts3,
		tda.dat_alt_reg1,
		tda.dat_alt_reg2,
		tda.dat_alt_reg3,
		tda.dat_baj_reg1,
		tda.dat_baj_reg2,
		tda.dat_baj_reg3,
		tda.dat_car_ren,
		IFNULL(MAX(vac.correlativo),0) AS CantItems
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
				AND ttur.cod_tabla='TTUR'
				LEFT JOIN tabla_maestra_detalle AS tgsa ON
				tgsa.cod_argumento= tr.id_gru_san
				AND tgsa.cod_tabla='TGSA'
				LEFT JOIN tabla_maestra_detalle AS tmpe ON
				tmpe.cod_argumento= tr.id_pag_esp
				AND tmpe.cod_tabla='TMPE'
				LEFT JOIN tabla_maestra_detalle AS tpcv ON
				tpcv.cod_argumento= tr.id_pag_vac_cts
				AND tpcv.cod_tabla='TPCV'
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
				LEFT JOIN trabajador_data_adjunta AS tda ON
				tda.id_trab= tr.id_trab
				LEFT JOIN trabajador_exp_laboral AS tel ON
				tel.id_trab= tr.id_trab
				LEFT JOIN vacaciones AS vac ON
				vac.nro_doc= tr.num_doc_trab
			 WHERE tr.id_trab='$id_trab'";
		return ejecutarConsultaSimpleFila($sql);
	}





		

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  '-' AS pla,
		cod_argumento, 
        cod_tabla,  
        des_larga AS mes, 
        des_corta AS ano, 
        valor_1 AS primera_quincena, 
        valor_2  AS segunda_quincena,
        valor_3 AS est_reg_1eraquin,
        valor_4 AS est_reg_2daquin
		FROM `tabla_maestra_detalle` 
		WHERE COD_TABLA LIKE  'TMES' 
		ORDER BY DES_CORTA ASC, valor_1 ASC
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