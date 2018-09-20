<?php
require_once "../modelos/Regimen_Pensionario.php";
session_start();


$regimen_pensionario=new Regimen_Pensionario();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//

//INICIO//
$id_reg_pen=isset($_POST["id_reg_pen"])? limpiarCadena($_POST["id_reg_pen"]):"";

$id_ano=isset($_POST["id_ano"])? limpiarCadena($_POST["id_ano"]):"";  
$obs_reg_pen=isset($_POST["obs_reg_pen"])? limpiarCadena($_POST["obs_reg_pen"]):""; 

$onp_apo_obl=isset($_POST["onp_apo_obl"])? limpiarCadena($_POST["onp_apo_obl"]):"";
$onp_com_men_rem=isset($_POST["onp_com_men_rem"])? limpiarCadena($_POST["onp_com_men_rem"]):"";
$onp_com_anu=isset($_POST["onp_com_anu"])? limpiarCadena($_POST["onp_com_anu"]):"";
$onp_com_men=isset($_POST["onp_com_men"])? limpiarCadena($_POST["onp_com_men"]):"";
$onp_pri_seg=isset($_POST["onp_pri_seg"])? limpiarCadena($_POST["onp_pri_seg"]):"";
$onp_apo_act=isset($_POST["onp_apo_act"])? limpiarCadena($_POST["onp_apo_act"]):"";
$onp_apo_mix=isset($_POST["onp_apo_mix"])? limpiarCadena($_POST["onp_apo_mix"]):"";
$int_apo_obl=isset($_POST["int_apo_obl"])? limpiarCadena($_POST["int_apo_obl"]):"";
$int_com_men_rem=isset($_POST["int_com_men_rem"])? limpiarCadena($_POST["int_com_men_rem"]):"";
$int_com_anu=isset($_POST["int_com_anu"])? limpiarCadena($_POST["int_com_anu"]):"";
$int_com_men=isset($_POST["int_com_men"])? limpiarCadena($_POST["int_com_men"]):"";
$int_pri_seg=isset($_POST["int_pri_seg"])? limpiarCadena($_POST["int_pri_seg"]):"";
$int_apo_act=isset($_POST["int_apo_act"])? limpiarCadena($_POST["int_apo_act"]):"";
$int_apo_mix=isset($_POST["int_apo_mix"])? limpiarCadena($_POST["int_apo_mix"]):"";
$pri_apo_obl=isset($_POST["pri_apo_obl"])? limpiarCadena($_POST["pri_apo_obl"]):"";
$pri_com_men_rem=isset($_POST["pri_com_men_rem"])? limpiarCadena($_POST["pri_com_men_rem"]):"";
$pri_com_anu=isset($_POST["pri_com_anu"])? limpiarCadena($_POST["pri_com_anu"]):"";
$pri_com_men=isset($_POST["pri_com_men"])? limpiarCadena($_POST["pri_com_men"]):"";
$pri_pri_seg=isset($_POST["pri_pri_seg"])? limpiarCadena($_POST["pri_pri_seg"]):"";
$pri_apo_act=isset($_POST["pri_apo_act"])? limpiarCadena($_POST["pri_apo_act"]):"";
$pri_apo_mix=isset($_POST["pri_apo_mix"])? limpiarCadena($_POST["pri_apo_mix"]):"";
$pro_apo_obl=isset($_POST["pro_apo_obl"])? limpiarCadena($_POST["pro_apo_obl"]):"";
$pro_com_men_rem=isset($_POST["pro_com_men_rem"])? limpiarCadena($_POST["pro_com_men_rem"]):"";
$pro_com_anu=isset($_POST["pro_com_anu"])? limpiarCadena($_POST["pro_com_anu"]):"";
$pro_com_men=isset($_POST["pro_com_men"])? limpiarCadena($_POST["pro_com_men"]):"";
$pro_pri_seg=isset($_POST["pro_pri_seg"])? limpiarCadena($_POST["pro_pri_seg"]):"";
$pro_apo_act=isset($_POST["pro_apo_act"])? limpiarCadena($_POST["pro_apo_act"]):"";
$pro_apo_mix=isset($_POST["pro_apo_mix"])? limpiarCadena($_POST["pro_apo_mix"]):"";
$hab_apo_obl=isset($_POST["hab_apo_obl"])? limpiarCadena($_POST["hab_apo_obl"]):"";
$hab_com_men_rem=isset($_POST["hab_com_men_rem"])? limpiarCadena($_POST["hab_com_men_rem"]):"";
$hab_com_anu=isset($_POST["hab_com_anu"])? limpiarCadena($_POST["hab_com_anu"]):"";
$hab_com_men=isset($_POST["hab_com_men"])? limpiarCadena($_POST["hab_com_men"]):"";
$hab_pri_seg=isset($_POST["hab_pri_seg"])? limpiarCadena($_POST["hab_pri_seg"]):"";
$hab_apo_act=isset($_POST["hab_apo_act"])? limpiarCadena($_POST["hab_apo_act"]):"";
$hab_apo_mix=isset($_POST["hab_apo_mix"])? limpiarCadena($_POST["hab_apo_mix"]):"";
$sj_apo_obl=isset($_POST["sj_apo_obl"])? limpiarCadena($_POST["sj_apo_obl"]):"";
$sj_com_men_rem=isset($_POST["sj_com_men_rem"])? limpiarCadena($_POST["sj_com_men_rem"]):"";
$sj_apo_mix=isset($_POST["sj_apo_mix"])? limpiarCadena($_POST["sj_apo_mix"]):"";

//FIN






switch ($_GET["op"]){
	case 'guardaryeditar':
		
		if (empty($id_reg_pen)){
			$rspta=$regimen_pensionario->insertar($id_ano,
													$obs_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix,
													$fec_reg,
													$usu_reg,
													$pc_reg
													);
			echo $rspta ? "Regimen pensionario registrado" : "Regimen pensionario no se pudo registrar";
		}
		else {
			$rspta=$regimen_pensionario->editar($id_reg_pen, $id_ano,
													$obs_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Regimen pensionario actualizado" : "Regimen pensionario no se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$regimen_pensionario->desactivar($id_reg_pen, $fec_reg, $usu_reg, $pc_reg);
 		echo $rspta ? "Regimen pensionario Desactivado" : "Regimen pensionario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$regimen_pensionario->activar($id_reg_pen, $fec_reg, $usu_reg, $pc_reg);
 		echo $rspta ? "Regimen pensionario activado" : "Regimen pensionario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$regimen_pensionario->mostrar($id_reg_pen);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$regimen_pensionario->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
 				"0"=>$reg->id_reg_pen,
 				"1"=>$reg->id_reg_pen,
 				"2"=>$reg->obs_reg_pen,
 				"3"=>($reg->id_reg_pen)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_reg_pen.')"><i class="fa fa-pencil"></i></button>'
 			        	:'<button class="btn btn-warning" onclick="mostrar('.$reg->id_reg_pen.')"><i class="fa fa-pencil"></i></button>',
 			    "4"=>($reg->est_reg_pen)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_reg_pen.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_reg_pen.')"><i class="fa fa-check"></i></button>'
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
