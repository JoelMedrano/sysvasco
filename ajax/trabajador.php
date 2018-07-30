<?php 
require_once "../modelos/Trabajador.php";

$trabajador=new Trabajador();

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


$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";

//Agregado el 30/07/2018
$fec_nac_trab = date("Y-m-d",strtotime(str_replace('/','-',$fec_nac_trab)));
//Agregado el 30/07/2018



switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($id_trab)){
			$rspta=$trabajador->insertar($nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab,$id_distrito,$departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad, $id_est_civil, $id_tip_doc, $num_doc_trab,
				$num_tlf_dom,$num_tlf_cel, $email_trab, $id_sucursal, $id_funcion, $id_area, $id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab, $bono_trab, $asig_trab, $obs_trab, $id_cen_cost,
				 $id_tip_man_ob);
			echo $rspta ? "Trabajador registrado" : "Trabajador no se pudo registrar";
		}
		else {
			$rspta=$trabajador->editar($id_trab,$nom_trab,$apepat_trab,$apemat_trab,$dir_trab,$urb_trab, $id_distrito, $departamento, $fec_nac_trab,$lug_nac_trab,$nacionalidad,$id_est_civil,
				$id_tip_doc,$num_doc_trab,$num_tlf_dom,$num_tlf_cel,$email_trab,$id_sucursal,$id_funcion,$id_area,$id_turno,$fec_ing_trab,$fec_cese_trab, $id_tip_plan, $sueldo_trab,
				 $bono_trab, $asig_trab, $obs_trab, $id_cen_cost, $id_tip_man_ob, $id_categoria, $id_form_pag, $id_tip_cont, $id_reg_pen,$id_com_act, $id_genero, $id_t_registro, 
				 $fecfin_con_ant, $fecfin_con_act, $cusp_trab);
			echo $rspta ? "Trabajador actualizado" : "Trabajador no se pudo actualizar";
		}

	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$trabajador->mostrar($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	

	case 'listar':
		$rspta=$trabajador->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->tipo_planilla,
 				"1"=>$reg->sucursal_anexo,
 				"2"=>$reg->num_doc_trab,
 				"3"=>$reg->nombres,
 				"4"=>$reg->area_trab,
 				"5"=>$reg->funcion,
 				"6"=>($reg->est_reg)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"7"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>',
 				"8"=>'<a target="_blank" href="'.'../vistas/trabajador_datos.php?id_trab='.$reg->id_trab.'"  > <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',
 				"9"=>($reg->est_reg)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_trab.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_trab.')"><i class="fa fa-check"></i></button>'
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