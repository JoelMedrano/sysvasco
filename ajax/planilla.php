<?php 
require_once "../modelos/Planilla.php";
session_start();


$planilla=new Planilla();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


//INICIO - DATOS DE INFORMACION PRINCIPAL DE TRABAJADOR

$nom_trab=isset($_POST["nom_trab"])? limpiarCadena($_POST["nom_trab"]):"";
$apepat_trab=isset($_POST["apepat_trab"])? limpiarCadena($_POST["apepat_trab"]):"";
$apemat_trab=isset($_POST["apemat_trab"])? limpiarCadena($_POST["apemat_trab"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$dir_trab=isset($_POST["dir_trab"])? limpiarCadena($_POST["dir_trab"]):"";
$urb_trab=isset($_POST["urb_trab"])? limpiarCadena($_POST["urb_trab"]):"";
$id_distrito=isset($_POST["id_distrito"])? limpiarCadena($_POST["id_distrito"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$fec_nac_trab=isset($_POST["fec_nac_trab"])? limpiarCadena($_POST["fec_nac_trab"]):"";
$lug_nac_trab=isset($_POST["lug_nac_trab"])? limpiarCadena($_POST["lug_nac_trab"]):"";
$nacionalidad=isset($_POST["nacionalidad"])? limpiarCadena($_POST["nacionalidad"]):"";
$id_est_civil=isset($_POST["id_est_civil"])? limpiarCadena($_POST["id_est_civil"]):"";
$id_tip_doc=isset($_POST["id_tip_doc"])? limpiarCadena($_POST["id_tip_doc"]):"";
$num_doc_trab=isset($_POST["num_doc_trab"])? limpiarCadena($_POST["num_doc_trab"]):"";
$num_tlf_dom=isset($_POST["num_tlf_dom"])? limpiarCadena($_POST["num_tlf_dom"]):"";
$num_tlf_cel=isset($_POST["num_tlf_cel"])? limpiarCadena($_POST["num_tlf_cel"]):"";
$email_trab=isset($_POST["email_trab"])? limpiarCadena($_POST["email_trab"]):"";
$id_sucursal=isset($_POST["id_sucursal"])? limpiarCadena($_POST["id_sucursal"]):"";
$id_funcion=isset($_POST["id_funcion"])? limpiarCadena($_POST["id_funcion"]):"";
$id_area=isset($_POST["id_area"])? limpiarCadena($_POST["id_area"]):"";
$id_turno=isset($_POST["id_turno"])? limpiarCadena($_POST["id_turno"]):"";

$id_tip_plan=isset($_POST["id_tip_plan"])? limpiarCadena($_POST["id_tip_plan"]):"";
$sueldo_trab=isset($_POST["sueldo_trab"])? limpiarCadena($_POST["sueldo_trab"]):"";
$bono_trab=isset($_POST["bono_trab"])? limpiarCadena($_POST["bono_trab"]):""; 
$bono_des_trab=isset($_POST["bono_des_trab"])? limpiarCadena($_POST["bono_des_trab"]):"";
$asig_trab=isset($_POST["asig_trab"])? limpiarCadena($_POST["asig_trab"]):"";
$id_pag_esp=isset($_POST["id_pag_esp"])? limpiarCadena($_POST["id_pag_esp"]):"";


$obs_trab=isset($_POST["obs_trab"])? limpiarCadena($_POST["obs_trab"]):"";
$id_cen_cost=isset($_POST["id_cen_cost"])? limpiarCadena($_POST["id_cen_cost"]):"";
$id_tip_man_ob=isset($_POST["id_tip_man_ob"])? limpiarCadena($_POST["id_tip_man_ob"]):"";
$id_categoria=isset($_POST["id_categoria"])? limpiarCadena($_POST["id_categoria"]):"";
$id_form_pag=isset($_POST["id_form_pag"])? limpiarCadena($_POST["id_form_pag"]):"";
$id_tip_cont=isset($_POST["id_tip_cont"])? limpiarCadena($_POST["id_tip_cont"]):"";
$id_reg_pen=isset($_POST["id_reg_pen"])? limpiarCadena($_POST["id_reg_pen"]):"";
$id_com_act=isset($_POST["id_com_act"])? limpiarCadena($_POST["id_com_act"]):"";
$id_genero=isset($_POST["id_genero"])? limpiarCadena($_POST["id_genero"]):"";
$id_t_registro=isset($_POST["id_t_registro"])? limpiarCadena($_POST["id_t_registro"]):"";
$cusp_trab=isset($_POST["cusp_trab"])? limpiarCadena($_POST["cusp_trab"]):"";

$id_pag_vac_cts=isset($_POST["id_pag_vac_cts"])? limpiarCadena($_POST["id_pag_vac_cts"]):"";



$fec_ing_trab=isset($_POST["fec_ing_trab"])? limpiarCadena($_POST["fec_ing_trab"]):"";
$fec_sal_trab=isset($_POST["fec_sal_trab"])? limpiarCadena($_POST["fec_sal_trab"]):"";


$fec_ing2=isset($_POST["fec_ing2"])? limpiarCadena($_POST["fec_ing2"]):"";
$fec_sal2=isset($_POST["fec_sal2"])? limpiarCadena($_POST["fec_sal2"]):"";
$mot_sal2=isset($_POST["mot_sal2"])? limpiarCadena($_POST["mot_sal2"]):"";

$fec_ing1=isset($_POST["fec_ing1"])? limpiarCadena($_POST["fec_ing1"]):"";
$fec_sal1=isset($_POST["fec_sal1"])? limpiarCadena($_POST["fec_sal1"]):"";
$mot_sal1=isset($_POST["mot_sal1"])? limpiarCadena($_POST["mot_sal1"]):"";

$fec_sal_interno=isset($_POST["fec_sal_interno"])? limpiarCadena($_POST["fec_sal_interno"]):"";
$fec_ing_interno=isset($_POST["fec_ing_interno"])? limpiarCadena($_POST["fec_ing_interno"]):"";
$mot_sal_interno=isset($_POST["mot_sal_interno"])? limpiarCadena($_POST["mot_sal_interno"]):"";


$fecfin_con_ant=isset($_POST["fecfin_con_ant"])? limpiarCadena($_POST["fecfin_con_ant"]):"";
$fecfin_con_act=isset($_POST["fecfin_con_act"])? limpiarCadena($_POST["fecfin_con_act"]):"";


$nro_cta_sue=isset($_POST["nro_cta_sue"])? limpiarCadena($_POST["nro_cta_sue"]):"";
$nro_cta_cts=isset($_POST["nro_cta_cts"])? limpiarCadena($_POST["nro_cta_cts"]):"";

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
//FIN - DATOS DE INFORMACION PRINCIPAL DE TRABAJADOR 




	//INICIO - DATA ADJUNTADA  DEL TRABAJADOR
    $foto_trab=isset($_POST["foto_trab"])? limpiarCadena($_POST["foto_trab"]):"";
    $dni_trab=isset($_POST["dni_trab"])? limpiarCadena($_POST["dni_trab"]):"";
    $dat_dip_cur_esp=isset($_POST["dat_dip_cur_esp"])? limpiarCadena($_POST["dat_dip_cur_esp"]):"";
    $dat_liquidacion=isset($_POST["dat_liquidacion"])? limpiarCadena($_POST["dat_liquidacion"]):"";






	$dat_hij1=isset($_POST["dat_hij1"])? limpiarCadena($_POST["dat_hij1"]):"";
	$dat_hij2=isset($_POST["dat_hij2"])? limpiarCadena($_POST["dat_hij2"]):"";
	$dat_hij3=isset($_POST["dat_hij3"])? limpiarCadena($_POST["dat_hij3"]):"";
	$dat_hij4=isset($_POST["dat_hij4"])? limpiarCadena($_POST["dat_hij4"]):"";
	$dat_con=isset($_POST["dat_con"])? limpiarCadena($_POST["dat_con"]):"";
	$dat_luz_agua=isset($_POST["dat_luz_agua"])? limpiarCadena($_POST["dat_luz_agua"]):"";
	$dat_ant_pol=isset($_POST["dat_ant_pol"])? limpiarCadena($_POST["dat_ant_pol"]):"";
	$dat_cer_med=isset($_POST["dat_cer_med"])? limpiarCadena($_POST["dat_cer_med"]):"";
	$dat_dec_dom=isset($_POST["dat_dec_dom"])? limpiarCadena($_POST["dat_dec_dom"]):"";
	$dat_cv=isset($_POST["dat_cv"])? limpiarCadena($_POST["dat_cv"]):"";
    $dat_gra_tit=isset($_POST["dat_gra_tit"])? limpiarCadena($_POST["dat_gra_tit"]):"";
	$dat_idi=isset($_POST["dat_idi"])? limpiarCadena($_POST["dat_idi"]):"";
	$dat_cer_tec=isset($_POST["dat_cer_tec"])? limpiarCadena($_POST["dat_cer_tec"]):"";
	$dat_adi=isset($_POST["dat_adi"])? limpiarCadena($_POST["dat_adi"]):"";
	
	$dat_cer_tra1=isset($_POST["dat_cer_tra1"])? limpiarCadena($_POST["dat_cer_tra1"]):"";
	$dat_cer_tra2=isset($_POST["dat_cer_tra2"])? limpiarCadena($_POST["dat_cer_tra2"]):"";
	$dat_cer_tra3=isset($_POST["dat_cer_tra3"])? limpiarCadena($_POST["dat_cer_tra3"]):"";

	$dat_cer_res1=isset($_POST["dat_cer_res1"])? limpiarCadena($_POST["dat_cer_res1"]):"";
	$dat_cer_res2=isset($_POST["dat_cer_res2"])? limpiarCadena($_POST["dat_cer_res2"]):"";
	$dat_cer_res3=isset($_POST["dat_cer_res3"])? limpiarCadena($_POST["dat_cer_res3"]):"";
	
	$dat_pas=isset($_POST["dat_pas"])? limpiarCadena($_POST["dat_pas"]):"";
	$dat_bre=isset($_POST["dat_bre"])? limpiarCadena($_POST["dat_bre"]):"";

	$dat_pla_liq1=isset($_POST["dat_pla_liq1"])? limpiarCadena($_POST["dat_pla_liq1"]):"";
	$dat_pla_liq2=isset($_POST["dat_pla_liq2"])? limpiarCadena($_POST["dat_pla_liq2"]):"";
	$dat_pla_liq3=isset($_POST["dat_pla_liq3"])? limpiarCadena($_POST["dat_pla_liq3"]):"";
	
	$dat_int_liq1=isset($_POST["dat_int_liq1"])? limpiarCadena($_POST["dat_int_liq1"]):"";
	$dat_int_liq2=isset($_POST["dat_int_liq2"])? limpiarCadena($_POST["dat_int_liq2"]):"";
	$dat_int_liq3=isset($_POST["dat_int_liq3"])? limpiarCadena($_POST["dat_int_liq3"]):"";
		

	$dat_car_ret_cts1=isset($_POST["dat_car_ret_cts1"])? limpiarCadena($_POST["dat_car_ret_cts1"]):"";
    $dat_car_ret_cts2=isset($_POST["dat_car_ret_cts2"])? limpiarCadena($_POST["dat_car_ret_cts2"]):"";
    $dat_car_ret_cts3=isset($_POST["dat_car_ret_cts3"])? limpiarCadena($_POST["dat_car_ret_cts3"]):"";
    
 	$dat_alt_reg1=isset($_POST["dat_alt_reg1"])? limpiarCadena($_POST["dat_alt_reg1"]):"";
    $dat_alt_reg2=isset($_POST["dat_alt_reg2"])? limpiarCadena($_POST["dat_alt_reg2"]):"";
    $dat_alt_reg3=isset($_POST["dat_alt_reg3"])? limpiarCadena($_POST["dat_alt_reg3"]):"";
    
    $dat_baj_reg1=isset($_POST["dat_baj_reg1"])? limpiarCadena($_POST["dat_baj_reg1"]):"";
    $dat_baj_reg2=isset($_POST["dat_baj_reg2"])? limpiarCadena($_POST["dat_baj_reg2"]):"";
    $dat_baj_reg3=isset($_POST["dat_baj_reg3"])? limpiarCadena($_POST["dat_baj_reg3"]):"";
    

    $dat_car_ren=isset($_POST["dat_car_ren"])? limpiarCadena($_POST["dat_car_ren"]):"";

	//INICIO - DATA ADJUNTADA  DEL TRABAJADOR




//FIN - DATOS DE INFORMACION PRINCIPAL DE TRABAJADOR



//INICIO - DATOS DE FAMILIARES DE TRABAJADOR
$viv_pad=isset($_POST["viv_pad"])? limpiarCadena($_POST["viv_pad"]):"";
$nom_pad=isset($_POST["nom_pad"])? limpiarCadena($_POST["nom_pad"]):"";
$ocu_pad=isset($_POST["ocu_pad"])? limpiarCadena($_POST["ocu_pad"]):"";
$dep_pad=isset($_POST["dep_pad"])? limpiarCadena($_POST["dep_pad"]):"";
$tel_pad=isset($_POST["tel_pad"])? limpiarCadena($_POST["tel_pad"]):"";

$fec_rec_dat=isset($_POST["fec_rec_dat"])? limpiarCadena($_POST["fec_rec_dat"]):"";

$viv_mad=isset($_POST["viv_mad"])? limpiarCadena($_POST["viv_mad"]):"";
$nom_mad=isset($_POST["nom_mad"])? limpiarCadena($_POST["nom_mad"]):"";
$ocu_mad=isset($_POST["ocu_mad"])? limpiarCadena($_POST["ocu_mad"]):"";
$dep_mad=isset($_POST["dep_mad"])? limpiarCadena($_POST["dep_mad"]):"";
$tel_mad=isset($_POST["tel_mad"])? limpiarCadena($_POST["tel_mad"]):"";


$viv_con=isset($_POST["viv_con"])? limpiarCadena($_POST["viv_con"]):"";
$nom_con=isset($_POST["nom_con"])? limpiarCadena($_POST["nom_con"]):"";
$ocu_con=isset($_POST["ocu_con"])? limpiarCadena($_POST["ocu_con"]):"";
$dep_con=isset($_POST["dep_con"])? limpiarCadena($_POST["dep_con"]):"";
$tel_con=isset($_POST["tel_con"])? limpiarCadena($_POST["tel_con"]):"";

$nac_hij1=isset($_POST["nac_hij1"])? limpiarCadena($_POST["nac_hij1"]):"";
$nom_hij1=isset($_POST["nom_hij1"])? limpiarCadena($_POST["nom_hij1"]):"";
$ocu_hij1=isset($_POST["ocu_hij1"])? limpiarCadena($_POST["ocu_hij1"]):"";
$dep_hij1=isset($_POST["dep_hij1"])? limpiarCadena($_POST["dep_hij1"]):"";
$tel_hij1=isset($_POST["tel_hij1"])? limpiarCadena($_POST["tel_hij1"]):"";

$nac_hij2=isset($_POST["nac_hij2"])? limpiarCadena($_POST["nac_hij2"]):"";
$nom_hij2=isset($_POST["nom_hij2"])? limpiarCadena($_POST["nom_hij2"]):"";
$ocu_hij2=isset($_POST["ocu_hij2"])? limpiarCadena($_POST["ocu_hij2"]):"";
$dep_hij2=isset($_POST["dep_hij2"])? limpiarCadena($_POST["dep_hij2"]):"";
$tel_hij2=isset($_POST["tel_hij2"])? limpiarCadena($_POST["tel_hij2"]):"";

$nac_hij3=isset($_POST["nac_hij3"])? limpiarCadena($_POST["nac_hij3"]):"";
$nom_hij3=isset($_POST["nom_hij3"])? limpiarCadena($_POST["nom_hij3"]):"";
$ocu_hij3=isset($_POST["ocu_hij3"])? limpiarCadena($_POST["ocu_hij3"]):"";
$dep_hij3=isset($_POST["dep_hij3"])? limpiarCadena($_POST["dep_hij3"]):"";
$tel_hij3=isset($_POST["tel_hij3"])? limpiarCadena($_POST["tel_hij3"]):"";


$nac_hij4=isset($_POST["nac_hij4"])? limpiarCadena($_POST["nac_hij4"]):"";
$nom_hij4=isset($_POST["nom_hij4"])? limpiarCadena($_POST["nom_hij4"]):"";
$ocu_hij4=isset($_POST["ocu_hij4"])? limpiarCadena($_POST["ocu_hij4"]):"";
$dep_hij4=isset($_POST["dep_hij4"])? limpiarCadena($_POST["dep_hij4"]):"";
$tel_hij4=isset($_POST["tel_hij4"])? limpiarCadena($_POST["tel_hij4"]):"";

$nom_otro=isset($_POST["nom_otro"])? limpiarCadena($_POST["nom_otro"]):"";
$ocu_otro=isset($_POST["ocu_otro"])? limpiarCadena($_POST["ocu_otro"]):"";
$dep_otro=isset($_POST["dep_otro"])? limpiarCadena($_POST["dep_otro"]):"";
$tel_otro=isset($_POST["tel_otro"])? limpiarCadena($_POST["tel_otro"]):"";




$nom_fam_con=isset($_POST["nom_fam_con"])? limpiarCadena($_POST["nom_fam_con"]):"";
$par_fam_con=isset($_POST["par_fam_con"])? limpiarCadena($_POST["par_fam_con"]):"";
$are_fam_con=isset($_POST["are_fam_con"])? limpiarCadena($_POST["are_fam_con"]):"";
//FIN - DATOS DE FAMILIARES DE TRABAJADOR


//INICIO - ESTUDIOS REALIZADOS POR EL TRABAJADOR
$cen_est_pri=isset($_POST["cen_est_pri"])? limpiarCadena($_POST["cen_est_pri"]):"";
$grado_pri=isset($_POST["grado_pri"])? limpiarCadena($_POST["grado_pri"]):"";
$fec_ini_pri=isset($_POST["fec_ini_pri"])? limpiarCadena($_POST["fec_ini_pri"]):"";
$fec_fin_pri=isset($_POST["fec_fin_pri"])? limpiarCadena($_POST["fec_fin_pri"]):"";
$cen_est_sec=isset($_POST["cen_est_sec"])? limpiarCadena($_POST["cen_est_sec"]):"";
$grado_sec=isset($_POST["grado_sec"])? limpiarCadena($_POST["grado_sec"]):"";
$fec_ini_sec=isset($_POST["fec_ini_sec"])? limpiarCadena($_POST["fec_ini_sec"]):"";
$fec_fin_sec=isset($_POST["fec_fin_sec"])? limpiarCadena($_POST["fec_fin_sec"]):"";
$cen_est_sup=isset($_POST["cen_est_sup"])? limpiarCadena($_POST["cen_est_sup"]):"";
$carrera_sup=isset($_POST["carrera_sup"])? limpiarCadena($_POST["carrera_sup"]):"";
$fec_des_sup=isset($_POST["fec_des_sup"])? limpiarCadena($_POST["fec_des_sup"]):"";
$fec_has_sup=isset($_POST["fec_has_sup"])? limpiarCadena($_POST["fec_has_sup"]):"";
$cen_est_tec=isset($_POST["cen_est_tec"])? limpiarCadena($_POST["cen_est_tec"]):"";
$carrera_tec=isset($_POST["carrera_tec"])? limpiarCadena($_POST["carrera_tec"]):"";
$fec_ini_tec=isset($_POST["fec_ini_tec"])? limpiarCadena($_POST["fec_ini_tec"]):"";
$fec_fin_tec=isset($_POST["fec_fin_tec"])? limpiarCadena($_POST["fec_fin_tec"]):"";
$cen_est_esp=isset($_POST["cen_est_esp"])? limpiarCadena($_POST["cen_est_esp"]):"";
$especialidad=isset($_POST["especialidad"])? limpiarCadena($_POST["especialidad"]):"";
$fec_ini_esp=isset($_POST["fec_ini_esp"])? limpiarCadena($_POST["fec_ini_esp"]):"";
$fec_fin_esp=isset($_POST["fec_fin_esp"])? limpiarCadena($_POST["fec_fin_esp"]):"";
$cen_est_otros=isset($_POST["cen_est_otros"])? limpiarCadena($_POST["cen_est_otros"]):"";
$carrera_otros=isset($_POST["carrera_otros"])? limpiarCadena($_POST["carrera_otros"]):"";
$fec_ini_otros=isset($_POST["fec_ini_otros"])? limpiarCadena($_POST["fec_ini_otros"]):"";
$fec_fin_otros=isset($_POST["fec_fin_otros"])? limpiarCadena($_POST["fec_fin_otros"]):"";
//FIN - ESTUDIOS REALIZADOS POR EL TRABAJADOR



//INICIO - OTROS CONOCIMIENTOS DEL TRABAJADOR
$des_idioma=isset($_POST["des_idioma"])? limpiarCadena($_POST["des_idioma"]):"";
$cen_est_idioma=isset($_POST["cen_est_idioma"])? limpiarCadena($_POST["cen_est_idioma"]):"";
$nivel_idioma=isset($_POST["nivel_idioma"])? limpiarCadena($_POST["nivel_idioma"]):"";
$des_comp=isset($_POST["des_comp"])? limpiarCadena($_POST["des_comp"]):"";
$cen_est_comp=isset($_POST["cen_est_comp"])? limpiarCadena($_POST["cen_est_comp"]):"";
$nivel_comp=isset($_POST["nivel_comp"])? limpiarCadena($_POST["nivel_comp"]):"";
//FIN - OTROS CONOCIMIENTOS DEL TRABAJADOR



//INICIO - EXPERIENCIA LABORAL DEL TRABAJADOR
$nom_emp_exp1=isset($_POST["nom_emp_exp1"])? limpiarCadena($_POST["nom_emp_exp1"]):"";
$car_exp1=isset($_POST["car_exp1"])? limpiarCadena($_POST["car_exp1"]):"";
$fun_exp1=isset($_POST["fun_exp1"])? limpiarCadena($_POST["fun_exp1"]):"";
$fec_ini_exp1=isset($_POST["fec_ini_exp1"])? limpiarCadena($_POST["fec_ini_exp1"]):"";
$fec_fin_exp1=isset($_POST["fec_fin_exp1"])? limpiarCadena($_POST["fec_fin_exp1"]):"";
$mot_ces_exp1=isset($_POST["mot_ces_exp1"])? limpiarCadena($_POST["mot_ces_exp1"]):"";

$nom_emp_exp2=isset($_POST["nom_emp_exp2"])? limpiarCadena($_POST["nom_emp_exp2"]):"";
$car_exp2=isset($_POST["car_exp2"])? limpiarCadena($_POST["car_exp2"]):"";
$fun_exp2=isset($_POST["fun_exp2"])? limpiarCadena($_POST["fun_exp2"]):"";
$fec_ini_exp2=isset($_POST["fec_ini_exp2"])? limpiarCadena($_POST["fec_ini_exp2"]):"";
$fec_fin_exp2=isset($_POST["fec_fin_exp2"])? limpiarCadena($_POST["fec_fin_exp2"]):"";
$mot_ces_exp2=isset($_POST["mot_ces_exp2"])? limpiarCadena($_POST["mot_ces_exp2"]):"";

$nom_emp_exp3=isset($_POST["nom_emp_exp3"])? limpiarCadena($_POST["nom_emp_exp3"]):"";
$car_exp3=isset($_POST["car_exp3"])? limpiarCadena($_POST["car_exp3"]):"";
$fun_exp3=isset($_POST["fun_exp3"])? limpiarCadena($_POST["fun_exp3"]):"";
$fec_ini_exp3=isset($_POST["fec_ini_exp3"])? limpiarCadena($_POST["fec_ini_exp3"]):"";
$fec_fin_exp3=isset($_POST["fec_fin_exp3"])? limpiarCadena($_POST["fec_fin_exp3"]):"";
$mot_ces_exp3=isset($_POST["mot_ces_exp3"])? limpiarCadena($_POST["mot_ces_exp3"]):"";
//FIN - EXPERIENCIA LABORAL DEL TRABAJADOR


$id_gru_san=isset($_POST["id_gru_san"])? limpiarCadena($_POST["id_gru_san"]):"";
$talla=isset($_POST["talla"])? limpiarCadena($_POST["talla"]):"";
$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";



//INICIO - ENFERMEDADES DEL TRABAJADOR
$tie_enf_car_onc=isset($_POST["tie_enf_car_onc"])? limpiarCadena($_POST["tie_enf_car_onc"]):"";
$nom_enf_car_onc=isset($_POST["nom_enf_car_onc"])? limpiarCadena($_POST["nom_enf_car_onc"]):"";
$tie_enf_ale_rec=isset($_POST["tie_enf_ale_rec"])? limpiarCadena($_POST["tie_enf_ale_rec"]):"";
//FIN - ENFERMEDADES DEL TRABAJADOR


//INICIO - AFILIACION DEL TRABAJADOR
$afi_onp=isset($_POST["afi_onp"])? limpiarCadena($_POST["afi_onp"]):"";
$afi_afp=isset($_POST["afi_afp"])? limpiarCadena($_POST["afi_afp"]):"";
$nom_afi_afp=isset($_POST["nom_afi_afp"])? limpiarCadena($_POST["nom_afi_afp"]):"";
//FIN - AFILIACION DEL TRABAJADOR



$prueba=isset($_POST["prueba"])? limpiarCadena($_POST["prueba"]):"";




$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):"";



$anoperiodo = date("Y", strtotime($fec_ing_trab));


$primera_quincena=isset($_POST["primera_quincena"])? limpiarCadena($_POST["primera_quincena"]):"";
$segunda_quincena=isset($_POST["segunda_quincena"])? limpiarCadena($_POST["segunda_quincena"]):"";
$est_reg_1eraquin=isset($_POST["est_reg_1eraquin"])? limpiarCadena($_POST["est_reg_1eraquin"]):"";
$est_reg_2daquin=isset($_POST["est_reg_2daquin"])? limpiarCadena($_POST["est_reg_2daquin"]):"";




switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($id_trab)){
			$rspta=$planilla->insertar($nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito,$departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad, $id_est_civil, $id_tip_doc, $num_doc_trab,
										 $num_tlf_dom,$num_tlf_cel, $email_trab, $id_sucursal, $id_funcion, $id_area, $id_turno,$fec_ing_trab, $id_tip_plan, $sueldo_trab, $bono_trab, $bono_des_trab, $asig_trab, $id_pag_esp, $obs_trab, $id_cen_cost,
									     $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen, $id_com_act, $id_genero, $id_t_registro,  $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg, 
									     $fec_ing_interno, $fec_sal_interno, $nro_cta_cts, $nro_cta_sue, $id_pag_vac_cts );

			$rspta=$trabajador->insertar_trabajador_familia( $fec_reg, $usu_reg, $pc_reg );
			$rspta=$trabajador->insertar_trabajador_estudios( $fec_reg, $usu_reg, $pc_reg );
			$rspta=$trabajador->insertar_trabajador_conocimiento( $fec_reg, $usu_reg, $pc_reg );
			$rspta=$trabajador->insertar_trabajador_exp_laboral( $fec_reg, $usu_reg, $pc_reg );
            $rspta=$trabajador->insertar_trabajador_salud( $fec_reg, $usu_reg, $pc_reg );
			$rspta=$trabajador->insertar_trabajador_afiliacion( $fec_reg, $usu_reg, $pc_reg );
			$rspta=$trabajador->insertar_trabajador_data_adjunta( $fec_reg, $usu_reg, $pc_reg );

			

			  $rsptac = $trabajador->mostrar_idperiodovacaciones($anoperiodo); 
			  $regc=$rsptac->fetch_object();
			  $id_ano_periodo=$regc->id_ano_periodo;



			if ($id_tip_plan=='1') {
			$rspta=$trabajador->insertar_primerperiodovacaciones( $num_doc_trab, $fec_ing_trab, $id_tip_plan,  $CantItems, $id_ano_periodo, $anoperiodo, $fec_reg, $usu_reg, $pc_reg  );
			}

			echo $rspta ? "Trabajador registrado" : "Trabajador no se pudo registrar";


		}
		else {
			$rspta=$trabajador->editar($id_trab,$nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab, $id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad,$id_est_civil,
				$id_tip_doc,$num_doc_trab,$num_tlf_dom,$num_tlf_cel,$email_trab,$id_sucursal,$id_funcion,$id_area,$id_turno,$fec_ing_trab,$fec_sal_trab, $id_tip_plan, $sueldo_trab,
				 $bono_trab, $bono_des_trab, $asig_trab, $id_pag_esp, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen,$id_com_act, $id_genero, $id_t_registro, 
				 $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg, $fec_ing_interno, $fec_sal_interno, $mot_sal_interno, $fec_ing2,  $fec_sal2, $mot_sal2,
				 $fec_ing1, $fec_sal1, $mot_sal1, $nro_cta_cts, $nro_cta_sue , $id_pag_vac_cts  );
		



			$rsptac = $trabajador->mostrar_idperiodovacaciones($anoperiodo); 
			$regc=$rsptac->fetch_object();
			$id_ano_periodo=$regc->id_ano_periodo;



			if ($id_tip_plan=='1' AND  $CantItems=='0') {
			$rspta=$trabajador->insertar_primerperiodovacaciones( $num_doc_trab, $fec_ing_trab, $id_tip_plan,  $CantItems, $id_ano_periodo, $anoperiodo, $fec_reg, $usu_reg, $pc_reg  );
			}

			echo $rspta ? "Trabajador actualizado" : "Trabajador no se pudo actualizar";


		}

	break;




	case 'guardaryeditar_datos':

		if (empty($prueba)){
			$rspta=$trabajador->insertar_datos($prueba, $usu_reg, $pc_reg, $fec_reg, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, $fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad, $viv_con, $nom_con, $ocu_con, $dep_con );
			echo $rspta ? "Datos registrados" : "Los datos no se pudieron registrar";
		}
		else {
			$rspta=$trabajador->editar_datos($prueba, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, $tel_pad,
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
				$usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Datos actualizados" : "Los datos no se pudieron actualizar";
		}

	break;


	case 'guardaryeditar_data_adjunta':



		if (!file_exists($_FILES['foto_trab']['tmp_name']) || !is_uploaded_file($_FILES['foto_trab']['tmp_name']))
		{
			$foto_trab=$_POST["imagenactual_foto_trab"];
		}
		else
		{
			$ext = explode(".", $_FILES["foto_trab"]["name"]);
			if ($_FILES['foto_trab']['type'] == "image/jpg" || $_FILES['foto_trab']['type'] == "image/jpeg" || $_FILES['foto_trab']['type'] == "image/png")
			{
				$foto_trab = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["foto_trab"]["tmp_name"], "../files/trabajador_data_adjunta/" . $foto_trab);
			}
		}




		if (!file_exists($_FILES['dni_trab']['tmp_name']) || !is_uploaded_file($_FILES['dni_trab']['tmp_name']))
		{
			$dni_trab=$_POST["imagenactual_dni_trab"];
		}
		else
		{
			$ext = explode(".", $_FILES["dni_trab"]["name"]);
			if ($_FILES['dni_trab']['type'] == "image/jpg" || $_FILES['dni_trab']['type'] == "image/jpeg" || $_FILES['dni_trab']['type'] == "image/png")
			{
				$dni_trab = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dni_trab"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dni_trab);
			}
		}

		



		if (!file_exists($_FILES['dat_dip_cur_esp']['tmp_name']) || !is_uploaded_file($_FILES['dat_dip_cur_esp']['tmp_name']))
		{
			$dat_dip_cur_esp=$_POST["imagenactual_dat_dip_cur_esp"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_dip_cur_esp"]["name"]);
			if ($_FILES['dat_dip_cur_esp']['type'] == "image/jpg" || $_FILES['dat_dip_cur_esp']['type'] == "image/jpeg" || $_FILES['dat_dip_cur_esp']['type'] == "image/png")
			{
				$dat_dip_cur_esp = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_dip_cur_esp"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_dip_cur_esp);
			}
		}



		if (!file_exists($_FILES['dat_liquidacion']['tmp_name']) || !is_uploaded_file($_FILES['dat_liquidacion']['tmp_name']))
		{
			$dat_liquidacion=$_POST["imagenactual_dat_liquidacion"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_liquidacion"]["name"]);
			if ($_FILES['dat_liquidacion']['type'] == "image/jpg" || $_FILES['dat_liquidacion']['type'] == "image/jpeg" || $_FILES['dat_liquidacion']['type'] == "image/png")
			{
				$dat_liquidacion = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_liquidacion"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_liquidacion);
			}
		}











		if (!file_exists($_FILES['dat_hij1']['tmp_name']) || !is_uploaded_file($_FILES['dat_hij1']['tmp_name']))
		{
			$dat_hij1=$_POST["imagenactual_dat_hij1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_hij1"]["name"]);
			if ($_FILES['dat_hij1']['type'] == "image/jpg" || $_FILES['dat_hij1']['type'] == "image/jpeg" || $_FILES['dat_hij1']['type'] == "image/png")
			{
				$dat_hij1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_hij1"]["tmp_name"], "../files/trabajador_familia/" . $dat_hij1);
			}
		}




		if (!file_exists($_FILES['dat_hij2']['tmp_name']) || !is_uploaded_file($_FILES['dat_hij2']['tmp_name']))
		{
			$dat_hij2=$_POST["imagenactual_dat_hij2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_hij2"]["name"]);
			if ($_FILES['dat_hij2']['type'] == "image/jpg" || $_FILES['dat_hij2']['type'] == "image/jpeg" || $_FILES['dat_hij2']['type'] == "image/png")
			{
				$dat_hij2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_hij2"]["tmp_name"], "../files/trabajador_familia/" . $dat_hij2);
			}
		}




		if (!file_exists($_FILES['dat_hij3']['tmp_name']) || !is_uploaded_file($_FILES['dat_hij3']['tmp_name']))
		{
			$dat_hij3=$_POST["imagenactual_dat_hij3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_hij3"]["name"]);
			if ($_FILES['dat_hij3']['type'] == "image/jpg" || $_FILES['dat_hij3']['type'] == "image/jpeg" || $_FILES['dat_hij3']['type'] == "image/png")
			{
				$dat_hij3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_hij3"]["tmp_name"], "../files/trabajador_familia/" . $dat_hij3);
			}
		}



		if (!file_exists($_FILES['dat_hij4']['tmp_name']) || !is_uploaded_file($_FILES['dat_hij4']['tmp_name']))
		{
			$dat_hij4=$_POST["imagenactual_dat_hij4"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_hij4"]["name"]);
			if ($_FILES['dat_hij4']['type'] == "image/jpg" || $_FILES['dat_hij4']['type'] == "image/jpeg" || $_FILES['dat_hij4']['type'] == "image/png")
			{
				$dat_hij4 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_hij4"]["tmp_name"], "../files/trabajador_familia/" . $dat_hij4);
			}
		}



		if (!file_exists($_FILES['dat_con']['tmp_name']) || !is_uploaded_file($_FILES['dat_con']['tmp_name']))
		{
			$dat_con=$_POST["imagenactual_dat_con"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_con"]["name"]);
			if ($_FILES['dat_con']['type'] == "image/jpg" || $_FILES['dat_con']['type'] == "image/jpeg" || $_FILES['dat_con']['type'] == "image/png")
			{
				$dat_con = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_con"]["tmp_name"], "../files/trabajador_familia/" . $dat_con);
			}
		}



		if (!file_exists($_FILES['dat_luz_agua']['tmp_name']) || !is_uploaded_file($_FILES['dat_luz_agua']['tmp_name']))
		{
			$dat_luz_agua=$_POST["imagenactual_dat_luz_agua"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_luz_agua"]["name"]);
			if ($_FILES['dat_luz_agua']['type'] == "image/jpg" || $_FILES['dat_luz_agua']['type'] == "image/jpeg" || $_FILES['dat_luz_agua']['type'] == "image/png")
			{
				$dat_luz_agua = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_luz_agua"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_luz_agua);
			}
		}






		if (!file_exists($_FILES['dat_ant_pol']['tmp_name']) || !is_uploaded_file($_FILES['dat_ant_pol']['tmp_name']))
		{
			$dat_ant_pol=$_POST["imagenactual_dat_ant_pol"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_ant_pol"]["name"]);
			if ($_FILES['dat_ant_pol']['type'] == "image/jpg" || $_FILES['dat_ant_pol']['type'] == "image/jpeg" || $_FILES['dat_ant_pol']['type'] == "image/png")
			{
				$dat_ant_pol = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_ant_pol"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_ant_pol);
			}
		}



		if (!file_exists($_FILES['dat_cer_med']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_med']['tmp_name']))
		{
			$dat_cer_med=$_POST["imagenactual_dat_cer_med"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_med"]["name"]);
			if ($_FILES['dat_cer_med']['type'] == "image/jpg" || $_FILES['dat_cer_med']['type'] == "image/jpeg" || $_FILES['dat_cer_med']['type'] == "image/png")
			{
				$dat_cer_med = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_med"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_med);
			}
		}



		if (!file_exists($_FILES['dat_dec_dom']['tmp_name']) || !is_uploaded_file($_FILES['dat_dec_dom']['tmp_name']))
		{
			$dat_dec_dom=$_POST["imagenactual_dat_dec_dom"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_dec_dom"]["name"]);
			if ($_FILES['dat_dec_dom']['type'] == "image/jpg" || $_FILES['dat_dec_dom']['type'] == "image/jpeg" || $_FILES['dat_dec_dom']['type'] == "image/png")
			{
				$dat_dec_dom = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_dec_dom"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_dec_dom);
			}
		}



		if (!file_exists($_FILES['dat_cv']['tmp_name']) || !is_uploaded_file($_FILES['dat_cv']['tmp_name']))
		{
			$dat_cv=$_POST["imagenactual_dat_cv"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cv"]["name"]);
			if ($_FILES['dat_cv']['type'] == "image/jpg" || $_FILES['dat_cv']['type'] == "image/jpeg" || $_FILES['dat_cv']['type'] == "image/png")
			{
				$dat_cv = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cv"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cv);
			}
		}



		if (!file_exists($_FILES['dat_gra_tit']['tmp_name']) || !is_uploaded_file($_FILES['dat_gra_tit']['tmp_name']))
		{
			$dat_gra_tit=$_POST["imagenactual_dat_gra_tit"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_gra_tit"]["name"]);
			if ($_FILES['dat_gra_tit']['type'] == "image/jpg" || $_FILES['dat_gra_tit']['type'] == "image/jpeg" || $_FILES['dat_gra_tit']['type'] == "image/png")
			{
				$dat_gra_tit = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_gra_tit"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_gra_tit);
			}
		}



		if (!file_exists($_FILES['dat_idi']['tmp_name']) || !is_uploaded_file($_FILES['dat_idi']['tmp_name']))
		{
			$dat_idi=$_POST["imagenactual_dat_idi"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_idi"]["name"]);
			if ($_FILES['dat_idi']['type'] == "image/jpg" || $_FILES['dat_idi']['type'] == "image/jpeg" || $_FILES['dat_idi']['type'] == "image/png")
			{
				$dat_idi = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_idi"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_idi);
			}
		}



		if (!file_exists($_FILES['dat_cer_tec']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_tec']['tmp_name']))
		{
			$dat_cer_tec=$_POST["imagenactual_dat_cer_tec"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_tec"]["name"]);
			if ($_FILES['dat_cer_tec']['type'] == "image/jpg" || $_FILES['dat_cer_tec']['type'] == "image/jpeg" || $_FILES['dat_cer_tec']['type'] == "image/png")
			{
				$dat_cer_tec = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_tec"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_tec);
			}
		}



		if (!file_exists($_FILES['dat_adi']['tmp_name']) || !is_uploaded_file($_FILES['dat_adi']['tmp_name']))
		{
			$dat_adi=$_POST["imagenactual_dat_adi"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_adi"]["name"]);
			if ($_FILES['dat_adi']['type'] == "image/jpg" || $_FILES['dat_adi']['type'] == "image/jpeg" || $_FILES['dat_adi']['type'] == "image/png")
			{
				$dat_adi = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_adi"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_adi);
			}
		}



		if (!file_exists($_FILES['dat_cer_tra1']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_tra1']['tmp_name']))
		{
			$dat_cer_tra1=$_POST["imagenactual_dat_cer_tra1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_tra1"]["name"]);
			if ($_FILES['dat_cer_tra1']['type'] == "image/jpg" || $_FILES['dat_cer_tra1']['type'] == "image/jpeg" || $_FILES['dat_cer_tra1']['type'] == "image/png")
			{
				$dat_cer_tra1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_tra1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_tra1);
			}
		}


		if (!file_exists($_FILES['dat_cer_tra2']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_tra2']['tmp_name']))
		{
			$dat_cer_tra2=$_POST["imagenactual_dat_cer_tra2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_tra2"]["name"]);
			if ($_FILES['dat_cer_tra2']['type'] == "image/jpg" || $_FILES['dat_cer_tra2']['type'] == "image/jpeg" || $_FILES['dat_cer_tra2']['type'] == "image/png")
			{
				$dat_cer_tra2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_tra2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_tra2);
			}
		}


		if (!file_exists($_FILES['dat_cer_tra3']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_tra3']['tmp_name']))
		{
			$dat_cer_tra3=$_POST["imagenactual_dat_cer_tra3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_tra3"]["name"]);
			if ($_FILES['dat_cer_tra3']['type'] == "image/jpg" || $_FILES['dat_cer_tra3']['type'] == "image/jpeg" || $_FILES['dat_cer_tra3']['type'] == "image/png")
			{
				$dat_cer_tra3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_tra3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_tra3);
			}
		}



		if (!file_exists($_FILES['dat_cer_res1']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_res1']['tmp_name']))
		{
			$dat_cer_res1=$_POST["imagenactual_dat_cer_res1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_res1"]["name"]);
			if ($_FILES['dat_cer_res1']['type'] == "image/jpg" || $_FILES['dat_cer_res1']['type'] == "image/jpeg" || $_FILES['dat_cer_res1']['type'] == "image/png")
			{
				$dat_cer_res1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_res1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_res1);
			}
		}


		if (!file_exists($_FILES['dat_cer_res2']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_res2']['tmp_name']))
		{
			$dat_cer_res2=$_POST["imagenactual_dat_cer_res2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_res2"]["name"]);
			if ($_FILES['dat_cer_res2']['type'] == "image/jpg" || $_FILES['dat_cer_res2']['type'] == "image/jpeg" || $_FILES['dat_cer_res2']['type'] == "image/png")
			{
				$dat_cer_res2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_res2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_res2);
			}
		}


		if (!file_exists($_FILES['dat_cer_res3']['tmp_name']) || !is_uploaded_file($_FILES['dat_cer_res3']['tmp_name']))
		{
			$dat_cer_res3=$_POST["imagenactual_dat_cer_res3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_cer_res3"]["name"]);
			if ($_FILES['dat_cer_res3']['type'] == "image/jpg" || $_FILES['dat_cer_res3']['type'] == "image/jpeg" || $_FILES['dat_cer_res3']['type'] == "image/png")
			{
				$dat_cer_res3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_cer_res3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_cer_res3);
			}
		}












		if (!file_exists($_FILES['dat_pas']['tmp_name']) || !is_uploaded_file($_FILES['dat_pas']['tmp_name']))
		{
			$dat_pas=$_POST["imagenactual_dat_pas"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_pas"]["name"]);
			if ($_FILES['dat_pas']['type'] == "image/jpg" || $_FILES['dat_pas']['type'] == "image/jpeg" || $_FILES['dat_pas']['type'] == "image/png")
			{
				$dat_pas = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_pas"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_pas);
			}
		}



		if (!file_exists($_FILES['dat_bre']['tmp_name']) || !is_uploaded_file($_FILES['dat_bre']['tmp_name']))
		{
			$dat_bre=$_POST["imagenactual_dat_bre"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_bre"]["name"]);
			if ($_FILES['dat_bre']['type'] == "image/jpg" || $_FILES['dat_bre']['type'] == "image/jpeg" || $_FILES['dat_bre']['type'] == "image/png")
			{
				$dat_bre = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_bre"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_bre);
			}
		}



		if (!file_exists($_FILES['dat_pla_liq1']['tmp_name']) || !is_uploaded_file($_FILES['dat_pla_liq1']['tmp_name']))
		{
			$dat_pla_liq1=$_POST["imagenactual_dat_pla_liq1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_pla_liq1"]["name"]);
			if ($_FILES['dat_pla_liq1']['type'] == "image/jpg" || $_FILES['dat_pla_liq1']['type'] == "image/jpeg" || $_FILES['dat_pla_liq1']['type'] == "image/png")
			{
				$dat_pla_liq1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_pla_liq1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_pla_liq1);
			}
		}


		if (!file_exists($_FILES['dat_pla_liq2']['tmp_name']) || !is_uploaded_file($_FILES['dat_pla_liq2']['tmp_name']))
		{
			$dat_pla_liq2=$_POST["imagenactual_dat_pla_liq2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_pla_liq2"]["name"]);
			if ($_FILES['dat_pla_liq2']['type'] == "image/jpg" || $_FILES['dat_pla_liq2']['type'] == "image/jpeg" || $_FILES['dat_pla_liq2']['type'] == "image/png")
			{
				$dat_pla_liq2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_pla_liq2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_pla_liq2);
			}
		}


		if (!file_exists($_FILES['dat_pla_liq3']['tmp_name']) || !is_uploaded_file($_FILES['dat_pla_liq3']['tmp_name']))
		{
			$dat_pla_liq3=$_POST["imagenactual_dat_pla_liq3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_pla_liq3"]["name"]);
			if ($_FILES['dat_pla_liq3']['type'] == "image/jpg" || $_FILES['dat_pla_liq3']['type'] == "image/jpeg" || $_FILES['dat_pla_liq3']['type'] == "image/png")
			{
				$dat_pla_liq3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_pla_liq3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_pla_liq3);
			}
		}


		if (!file_exists($_FILES['dat_int_liq1']['tmp_name']) || !is_uploaded_file($_FILES['dat_int_liq1']['tmp_name']))
		{
			$dat_int_liq1=$_POST["imagenactual_dat_int_liq1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_int_liq1"]["name"]);
			if ($_FILES['dat_int_liq1']['type'] == "image/jpg" || $_FILES['dat_int_liq1']['type'] == "image/jpeg" || $_FILES['dat_int_liq1']['type'] == "image/png")
			{
				$dat_int_liq1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_int_liq1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_int_liq1);
			}
		}


		if (!file_exists($_FILES['dat_int_liq2']['tmp_name']) || !is_uploaded_file($_FILES['dat_int_liq2']['tmp_name']))
		{
			$dat_int_liq2=$_POST["imagenactual_dat_int_liq2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_int_liq2"]["name"]);
			if ($_FILES['dat_int_liq2']['type'] == "image/jpg" || $_FILES['dat_int_liq2']['type'] == "image/jpeg" || $_FILES['dat_int_liq2']['type'] == "image/png")
			{
				$dat_int_liq2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_int_liq2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_int_liq2);
			}
		}



		if (!file_exists($_FILES['dat_int_liq3']['tmp_name']) || !is_uploaded_file($_FILES['dat_int_liq3']['tmp_name']))
		{
			$dat_int_liq3=$_POST["imagenactual_dat_int_liq3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_int_liq3"]["name"]);
			if ($_FILES['dat_int_liq3']['type'] == "image/jpg" || $_FILES['dat_int_liq3']['type'] == "image/jpeg" || $_FILES['dat_int_liq3']['type'] == "image/png")
			{
				$dat_int_liq3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_int_liq3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_int_liq3);
			}
		}









		if (!file_exists($_FILES['dat_car_ret_cts1']['tmp_name']) || !is_uploaded_file($_FILES['dat_car_ret_cts1']['tmp_name']))
		{
			$dat_car_ret_cts1=$_POST["imagenactual_dat_car_ret_cts1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_car_ret_cts1"]["name"]);
			if ($_FILES['dat_car_ret_cts1']['type'] == "image/jpg" || $_FILES['dat_car_ret_cts1']['type'] == "image/jpeg" || $_FILES['dat_car_ret_cts1']['type'] == "image/png")
			{
				$dat_car_ret_cts1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_car_ret_cts1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_car_ret_cts1);
			}
		}


		if (!file_exists($_FILES['dat_car_ret_cts2']['tmp_name']) || !is_uploaded_file($_FILES['dat_car_ret_cts2']['tmp_name']))
		{
			$dat_car_ret_cts2=$_POST["imagenactual_dat_car_ret_cts2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_car_ret_cts2"]["name"]);
			if ($_FILES['dat_car_ret_cts2']['type'] == "image/jpg" || $_FILES['dat_car_ret_cts2']['type'] == "image/jpeg" || $_FILES['dat_car_ret_cts2']['type'] == "image/png")
			{
				$dat_car_ret_cts2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_car_ret_cts2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_car_ret_cts2);
			}
		}



		if (!file_exists($_FILES['dat_car_ret_cts3']['tmp_name']) || !is_uploaded_file($_FILES['dat_car_ret_cts3']['tmp_name']))
		{
			$dat_car_ret_cts3=$_POST["imagenactual_dat_car_ret_cts3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_car_ret_cts3"]["name"]);
			if ($_FILES['dat_car_ret_cts3']['type'] == "image/jpg" || $_FILES['dat_car_ret_cts3']['type'] == "image/jpeg" || $_FILES['dat_car_ret_cts3']['type'] == "image/png")
			{
				$dat_car_ret_cts3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_car_ret_cts3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_car_ret_cts3);
			}
		}





		if (!file_exists($_FILES['dat_alt_reg1']['tmp_name']) || !is_uploaded_file($_FILES['dat_alt_reg1']['tmp_name']))
		{
			$dat_alt_reg1=$_POST["imagenactual_dat_alt_reg1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_alt_reg1"]["name"]);
			if ($_FILES['dat_alt_reg1']['type'] == "image/jpg" || $_FILES['dat_alt_reg1']['type'] == "image/jpeg" || $_FILES['dat_alt_reg1']['type'] == "image/png")
			{
				$dat_alt_reg1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_alt_reg1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_alt_reg1);
			}
		}


		if (!file_exists($_FILES['dat_alt_reg2']['tmp_name']) || !is_uploaded_file($_FILES['dat_alt_reg2']['tmp_name']))
		{
			$dat_alt_reg2=$_POST["imagenactual_dat_alt_reg2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_alt_reg2"]["name"]);
			if ($_FILES['dat_alt_reg2']['type'] == "image/jpg" || $_FILES['dat_alt_reg2']['type'] == "image/jpeg" || $_FILES['dat_alt_reg2']['type'] == "image/png")
			{
				$dat_alt_reg2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_alt_reg2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_alt_reg2);
			}
		}



		if (!file_exists($_FILES['dat_alt_reg3']['tmp_name']) || !is_uploaded_file($_FILES['dat_alt_reg3']['tmp_name']))
		{
			$dat_alt_reg3=$_POST["imagenactual_dat_alt_reg3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_alt_reg3"]["name"]);
			if ($_FILES['dat_alt_reg3']['type'] == "image/jpg" || $_FILES['dat_alt_reg3']['type'] == "image/jpeg" || $_FILES['dat_alt_reg3']['type'] == "image/png")
			{
				$dat_alt_reg3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_alt_reg3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_alt_reg3);
			}
		}



		if (!file_exists($_FILES['dat_baj_reg1']['tmp_name']) || !is_uploaded_file($_FILES['dat_baj_reg1']['tmp_name']))
		{
			$dat_baj_reg1=$_POST["imagenactual_dat_baj_reg1"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_baj_reg1"]["name"]);
			if ($_FILES['dat_alt_reg3']['type'] == "image/jpg" || $_FILES['dat_baj_reg1']['type'] == "image/jpeg" || $_FILES['dat_baj_reg1']['type'] == "image/png")
			{
				$dat_baj_reg1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_baj_reg1"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_baj_reg1);
			}
		}



		if (!file_exists($_FILES['dat_baj_reg2']['tmp_name']) || !is_uploaded_file($_FILES['dat_baj_reg2']['tmp_name']))
		{
			$dat_baj_reg2=$_POST["imagenactual_dat_baj_reg2"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_baj_reg2"]["name"]);
			if ($_FILES['dat_baj_reg2']['type'] == "image/jpg" || $_FILES['dat_baj_reg2']['type'] == "image/jpeg" || $_FILES['dat_baj_reg2']['type'] == "image/png")
			{
				$dat_baj_reg2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_baj_reg2"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_baj_reg2);
			}
		}


		if (!file_exists($_FILES['dat_baj_reg3']['tmp_name']) || !is_uploaded_file($_FILES['dat_baj_reg3']['tmp_name']))
		{
			$dat_baj_reg3=$_POST["imagenactual_dat_baj_reg3"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_baj_reg3"]["name"]);
			if ($_FILES['dat_baj_reg3']['type'] == "image/jpg" || $_FILES['dat_baj_reg3']['type'] == "image/jpeg" || $_FILES['dat_baj_reg3']['type'] == "image/png")
			{
				$dat_baj_reg3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_baj_reg3"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_baj_reg3);
			}
		}



		if (!file_exists($_FILES['dat_car_ren']['tmp_name']) || !is_uploaded_file($_FILES['dat_car_ren']['tmp_name']))
		{
			$dat_car_ren=$_POST["imagenactual_dat_car_ren"];
		}
		else
		{
			$ext = explode(".", $_FILES["dat_car_ren"]["name"]);
			if ($_FILES['dat_car_ren']['type'] == "image/jpg" || $_FILES['dat_car_ren']['type'] == "image/jpeg" || $_FILES['dat_car_ren']['type'] == "image/png")
			{
				$dat_car_ren = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["dat_car_ren"]["tmp_name"], "../files/trabajador_data_adjunta/" . $dat_car_ren);
			}
		}














		if (empty($id_trab_data_adjunta)){
			$rspta=$trabajador->insertar_data_adjunta($id_trab_data_adjunta, $usu_reg, $pc_reg, $fec_reg, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, $fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad, $viv_con, $nom_con, $ocu_con, $dep_con );
			echo $rspta ? "Data adjunta registrada" : "Data adjunta no se pudo registrar";
		}
		else {
			$rspta=$trabajador->editar_data_adjunta($id_trab_data_adjunta, $foto_trab, 
				$dni_trab, $dat_dip_cur_esp, $dat_liquidacion, $dat_hij1,
				$dat_hij2 ,$dat_hij3 ,$dat_hij4 ,$dat_con, $dat_ant_pol,  $dat_luz_agua,
				$dat_cer_med, $dat_dec_dom, $dat_cv, $dat_gra_tit, $dat_idi , $dat_cer_tec, $dat_adi,
				$dat_cer_tra1,  $dat_cer_tra2,$dat_cer_tra3, $dat_cer_res1,  $dat_cer_res2, $dat_cer_res3,
				$dat_pas,$dat_bre, $dat_pla_liq1, $dat_pla_liq2, $dat_pla_liq3,  $dat_int_liq1, $dat_int_liq2,
				$dat_int_liq3, $dat_car_ret_cts1, $dat_car_ret_cts2, $dat_car_ret_cts3,$dat_alt_reg1, 
				$dat_alt_reg2, $dat_alt_reg3,$dat_baj_reg1,  $dat_baj_reg2, $dat_baj_reg3,
				$dat_car_ren, $usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Data adjunta actualizada" : "Data adjunta no se pudo actualizar";
		}

	break;


	

	case 'desactivar':
		$rspta=$trabajador->desactivar($id_trab, $usu_reg, $pc_reg, $fec_reg );
 		echo $rspta ? "Trabajador Inactivo" : "Trabajador no se puede desactivar";
	break;

	case 'activar':
		$rspta=$trabajador->activar($id_trab);
 		echo $rspta ? "Trabajador Activo" : "Trabajador no se puede activar";
	break;

	case 'mostrar':
		$rspta=$trabajador->mostrar($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'mostrar_datos':
		$rspta=$trabajador->mostrar($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'mostrar_data_adjunta':
		$rspta=$trabajador->mostrar($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'cerrar_primeraquincena':

		$rspta=$planilla->cerrar_primeraquincena($primera_quincena);
	//  $rspta=$planilla->ingresar_informacion_tablaplanillaquincenal($primera_quincena);
 		echo $rspta ? "Quincena Cerrada" : "Quincena no se puede cerrar";
	break;

	case 'cerrar_segundaquincena':
		$rspta=$planilla->cerrar_segundaquincena($segunda_quincena);
	//	$rspta=$planilla->ingresar_informacion_tablaplanillaquincenal($segunda_quincena);
 		echo $rspta ? "Quincena Cerrada" : "Quincena no se puede cerrar";
	break;




	case 'listar':
		$rspta=$planilla->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		 

 		while ($reg=$rspta->fetch_object()){

 			 $url='../reportes/rpt_xls_planillaquincenal.php?id=';

 			 $url1='../reportes/rpt_xls_planillacerrada.php?id=';
 			 
           
 			$data[]=array(
 				"0"=>$reg->pla,
 				"1"=>$reg->ano,
 				"2"=>$reg->mes,
 				"3"=>'<a target="_blank" href="'.$url.$reg->cod_argumento.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',
 				"4"=>($reg->est_reg_1eraquin=='1')?'<span class="label bg-blue">Abierto</span>': 
 				'<span class="label bg-red">Cerrado</span>', 
 				"5"=>($reg->est_reg_2daquin=='1')?'<span class="label bg-blue">Abierto</span>': 
 				'<span class="label bg-red">Cerrado</span>', 
 				"6"=>($reg->est_reg_1eraquin=='1')?
 					' <button class="btn btn-primary"  onclick="cerrar_primeraquincena('.$reg->primera_quincena.')"><i class="fa fa-check"></i></button>':
 					' <button class="btn btn-danger"   onclick="cerrar_primeraquincena('.$reg->primera_quincena.')"><i class="fa fa-close"></i></button>',
 				"7"=>($reg->est_reg_2daquin=='1')?
 					' <button class="btn btn-primary"   onclick="cerrar_segundaquincena('.$reg->segunda_quincena.')"><i class="fa fa-check"></i></button>':
 					' <button class="btn btn-danger"    onclick="cerrar_segundaquincena('.$reg->segunda_quincena.')"><i class="fa fa-close"></i></button>',
 				"8"=>'<a target="_blank" href="'.$url1.$reg->cod_argumento.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;





	
}
?>