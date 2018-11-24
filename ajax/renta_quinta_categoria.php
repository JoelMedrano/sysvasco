<?php
require_once "../modelos/Renta_Quinta_Categoria.php";
session_start();



$rqc=new Renta_Quinta_Categoria();




//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_ren_qui_cat=isset($_POST["id_ren_qui_cat"])? limpiarCadena($_POST["id_ren_qui_cat"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$mon_total=isset($_POST["mon_total"])? limpiarCadena($_POST["mon_total"]):"";




switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_ren_qui_cat)){
			$rspta=$rqc->insertar(				$id_trab,
												$mon_total,	
												$fec_reg,
												$usu_reg,
												$pc_reg);
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$rqc->editar(              	
													$id_ren_qui_cat,
													$id_trab,
													$mon_total,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$rqc->desactivar(  $id_ren_qui_cat,
												       $fec_reg,
												       $usu_reg,
												       $pc_reg
												  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$rspta=$rqc->activar( $id_ren_qui_cat,
												   $fec_reg,
												   $usu_reg,
												   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$rqc->mostrar($id_ren_qui_cat);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$rqc->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->rqc,
 				"1"=>$reg->id_trab,
 				"2"=>$reg->trab_apellidosynombres,
 				"3"=>$reg->des_area,
 				"4"=>$reg->mon_total,
 				"5"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ren_qui_cat.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ren_qui_cat.')"><i class="fa fa-pencil"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectTrabajadoresActivos":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTrabajadoresActivos();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' . $reg->trabajador . '</option>';
				}
	break;


	



}
?>
