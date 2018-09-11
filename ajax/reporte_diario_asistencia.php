<?php 
require_once "../modelos/Reporte_Diario_Asistencia.php";
session_start();


$reporte_diario_asistencia=new Reporte_Diario_Asistencia();


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
$fec_ing_trab=isset($_POST["fec_ing_trab"])? limpiarCadena($_POST["fec_ing_trab"]):"";
$fec_cese_trab=isset($_POST["fec_cese_trab"])? limpiarCadena($_POST["fec_cese_trab"]):"";
$id_tip_plan=isset($_POST["id_tip_plan"])? limpiarCadena($_POST["id_tip_plan"]):"";
$sueldo_trab=isset($_POST["sueldo_trab"])? limpiarCadena($_POST["sueldo_trab"]):"";
$bono_trab=isset($_POST["bono_trab"])? limpiarCadena($_POST["bono_trab"]):"";
$asig_trab=isset($_POST["asig_trab"])? limpiarCadena($_POST["asig_trab"]):"";
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
$fecfin_con_ant=isset($_POST["fecfin_con_ant"])? limpiarCadena($_POST["fecfin_con_ant"]):"";
$fecfin_con_act=isset($_POST["fecfin_con_act"])? limpiarCadena($_POST["fecfin_con_act"]):"";
$cusp_trab=isset($_POST["cusp_trab"])? limpiarCadena($_POST["cusp_trab"]):"";
$fec_nac_trab = date("Y-m-d",strtotime(str_replace('/','-',$fec_nac_trab)));
$fec_ing_trab = date("Y-m-d",strtotime(str_replace('/','-',$fec_ing_trab)));
$fec_cese_trab = date("Y-m-d",strtotime(str_replace('/','-',$fec_cese_trab)));
$fecfin_con_act = date("Y-m-d",strtotime(str_replace('/','-',$fecfin_con_act)));
$fecfin_con_ant = date("Y-m-d",strtotime(str_replace('/','-',$fecfin_con_ant)));

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";

//FIN - DATOS DE INFORMACION PRINCIPAL DE TRABAJADOR


//INICIO - DATOS DE FAMILIARES DE TRABAJADOR
$viv_pad=isset($_POST["viv_pad"])? limpiarCadena($_POST["viv_pad"]):"";
$nom_pad=isset($_POST["nom_pad"])? limpiarCadena($_POST["nom_pad"]):"";
$ocu_pad=isset($_POST["ocu_pad"])? limpiarCadena($_POST["ocu_pad"]):"";
$dep_pad=isset($_POST["dep_pad"])? limpiarCadena($_POST["dep_pad"]):"";
$fec_rec_dat=isset($_POST["fec_rec_dat"])? limpiarCadena($_POST["fec_rec_dat"]):"";
$viv_mad=isset($_POST["viv_mad"])? limpiarCadena($_POST["viv_mad"]):"";
$nom_mad=isset($_POST["nom_mad"])? limpiarCadena($_POST["nom_mad"]):"";
$ocu_mad=isset($_POST["ocu_mad"])? limpiarCadena($_POST["ocu_mad"]):"";
$dep_mad=isset($_POST["dep_mad"])? limpiarCadena($_POST["dep_mad"]):"";
$viv_con=isset($_POST["viv_con"])? limpiarCadena($_POST["viv_con"]):"";
$nom_con=isset($_POST["nom_con"])? limpiarCadena($_POST["nom_con"]):"";
$ocu_con=isset($_POST["ocu_con"])? limpiarCadena($_POST["ocu_con"]):"";
$dep_con=isset($_POST["dep_con"])? limpiarCadena($_POST["dep_con"]):"";
$eda_hij1=isset($_POST["eda_hij1"])? limpiarCadena($_POST["eda_hij1"]):"";
$nom_hij1=isset($_POST["nom_hij1"])? limpiarCadena($_POST["nom_hij1"]):"";
$ocu_hij1=isset($_POST["ocu_hij1"])? limpiarCadena($_POST["ocu_hij1"]):"";
$dep_hij1=isset($_POST["dep_hij1"])? limpiarCadena($_POST["dep_hij1"]):"";

$dat_hij1=isset($_POST["dat_hij1"])? limpiarCadena($_POST["dat_hij1"]):"";

$eda_hij2=isset($_POST["eda_hij2"])? limpiarCadena($_POST["eda_hij2"]):"";
$nom_hij2=isset($_POST["nom_hij2"])? limpiarCadena($_POST["nom_hij2"]):"";
$ocu_hij2=isset($_POST["ocu_hij2"])? limpiarCadena($_POST["ocu_hij2"]):"";
$dep_hij2=isset($_POST["dep_hij2"])? limpiarCadena($_POST["dep_hij2"]):"";
$eda_hij3=isset($_POST["eda_hij3"])? limpiarCadena($_POST["eda_hij3"]):"";
$nom_hij3=isset($_POST["nom_hij3"])? limpiarCadena($_POST["nom_hij3"]):"";
$ocu_hij3=isset($_POST["ocu_hij3"])? limpiarCadena($_POST["ocu_hij3"]):"";
$dep_hij3=isset($_POST["dep_hij3"])? limpiarCadena($_POST["dep_hij3"]):"";
$eda_hij4=isset($_POST["eda_hij4"])? limpiarCadena($_POST["eda_hij4"]):"";
$nom_hij4=isset($_POST["nom_hij4"])? limpiarCadena($_POST["nom_hij4"]):"";
$ocu_hij4=isset($_POST["ocu_hij4"])? limpiarCadena($_POST["ocu_hij4"]):"";
$dep_hij4=isset($_POST["dep_hij4"])? limpiarCadena($_POST["dep_hij4"]):"";
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
$cent_est_comp=isset($_POST["cent_est_comp"])? limpiarCadena($_POST["cent_est_comp"]):"";
$nivel_comp=isset($_POST["nivel_comp"])? limpiarCadena($_POST["nivel_comp"]):"";
//FIN - OTROS CONOCIMIENTOS DEL TRABAJADOR


//INICIO - ENFERMEDADES DEL TRABAJADOR
$tie_enf_car_onc=isset($_POST["tie_enf_car_onc"])? limpiarCadena($_POST["tie_enf_car_onc"]):"";
$nom_enf_car_onc=isset($_POST["nom_enf_car_onc"])? limpiarCadena($_POST["nom_enf_car_onc"]):"";
//FIN - ENFERMEDADES DEL TRABAJADOR


//INICIO - AFILIACION DEL TRABAJADOR
$afi_onp=isset($_POST["afi_onp"])? limpiarCadena($_POST["afi_onp"]):"";
$afi_afp=isset($_POST["afi_afp"])? limpiarCadena($_POST["afi_afp"]):"";
$nom_afi_afp=isset($_POST["nom_afi_afp"])? limpiarCadena($_POST["nom_afi_afp"]):"";
//FIN - AFILIACION DEL TRABAJADOR





$prueba=isset($_POST["prueba"])? limpiarCadena($_POST["prueba"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($id_trab)){
			$rspta=$trabajador->insertar($nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito,$departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad, $id_est_civil, $id_tip_doc, $num_doc_trab,
				$num_tlf_dom,$num_tlf_cel, $email_trab, $id_sucursal, $id_funcion, $id_area, $id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab, $bono_trab, $asig_trab, $obs_trab, $id_cen_cost,
				 $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen, $id_com_act, $id_genero, $id_t_registro,  $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Trabajador registrado" : "Trabajador no se pudo registrar";
		}
		else {
			$rspta=$trabajador->editar($id_trab,$nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab, $id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad,$id_est_civil,
				$id_tip_doc,$num_doc_trab,$num_tlf_dom,$num_tlf_cel,$email_trab,$id_sucursal,$id_funcion,$id_area,$id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab,
				 $bono_trab, $asig_trab, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen,$id_com_act, $id_genero, $id_t_registro, 
				 $fecfin_con_ant, $fecfin_con_act, $cusp_trab, $usu_reg, $pc_reg, $fec_reg  );
			echo $rspta ? "Trabajador actualizado" : "Trabajador no se pudo actualizar";
		}

	break;



	case 'guardaryeditar_datos':

		if (empty($prueba)){
			$rspta=$trabajador->insertar_datos($prueba, $usu_reg, $pc_reg, $fec_reg, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, $fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad, $viv_con, $nom_con, $ocu_con, $dep_con );
			echo $rspta ? "Trabajador registrado" : "Trabajador no se pudo registrar";
		}
		else {
			$rspta=$trabajador->editar_datos($prueba, $viv_pad, $nom_pad, $ocu_pad, $dep_pad, 
				$fec_rec_dat, $viv_mad, $nom_mad, $ocu_mad, $dep_mad, $viv_con, $nom_con, 
				$ocu_con, $dep_con, $eda_hij1, $nom_hij1, $ocu_hij1, $dep_hij1, $dat_hij1,  $eda_hij2, 
				$nom_hij2, $ocu_hij2, $dep_hij2, $eda_hij3, $nom_hij3, $ocu_hij3, $dep_hij3,
				$eda_hij4, $nom_hij4, $ocu_hij4, $dep_hij4, $nom_fam_con, $par_fam_con, $are_fam_con,
				$cen_est_pri, $grado_pri, $fec_ini_pri, $fec_fin_pri, $cen_est_sec, $grado_sec, $fec_ini_sec,
				$fec_fin_sec, $cen_est_sup, $carrera_sup, $fec_des_sup, $fec_has_sup, $cen_est_tec, $carrera_tec,
				$fec_ini_tec, $fec_fin_tec, $cen_est_esp, $especialidad, $fec_ini_esp, $fec_fin_esp, $cen_est_otros,
				$carrera_otros, $fec_ini_otros, $fec_fin_otros, $des_idioma, $cen_est_idioma, $nivel_idioma, $des_comp,
				$cen_est_comp, $nivel_comp, $tie_enf_car_onc, $nom_enf_car_onc, $afi_onp, $afi_afp, $nom_afi_afp,
				$usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Trabajador actualizado" : "Trabajador no se pudo actualizar";
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


	case 'listar':
		$rspta=$reporte_diario_asistencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		 $url='../vistas/trabajador_datos.php?id=';

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->id_trab,
 				"1"=>$reg->tipo_planilla,
 				"2"=>$reg->sucursal_anexo,
 				"3"=>$reg->num_doc_trab,
 				"4"=>$reg->nombres,
 				"5"=>$reg->area_trab,
 				"6"=>$reg->funcion,
 				"7"=>($reg->est_reg)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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