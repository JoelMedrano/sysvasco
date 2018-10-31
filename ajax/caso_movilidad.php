<?php
require_once "../modelos/Caso_Movilidad.php";
session_start();



$caso_movilidad=new Caso_Movilidad();




//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_caso_mov=isset($_POST["id_caso_mov"])? limpiarCadena($_POST["id_caso_mov"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$canhoras_max=isset($_POST["canhoras_max"])? limpiarCadena($_POST["canhoras_max"]):"";
$porc_pago=isset($_POST["porc_pago"])? limpiarCadena($_POST["porc_pago"]):"";





switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_caso_mov)){
			$rspta=$caso_movilidad->insertar(	$id_trab,
												$canhoras_max,
												$porc_pago,	
												$fec_reg,
												$usu_reg,
												$pc_reg);
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$caso_movilidad->editar(              	
													$id_caso_mov,
													$id_trab,
													$canhoras_max,
													$porc_pago,	
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$caso_movilidad->desactivar(  $id_caso_mov,
												       $fec_reg,
												       $usu_reg,
												       $pc_reg
												  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$rspta=$caso_movilidad->activar( $id_caso_mov,
												   $fec_reg,
												   $usu_reg,
												   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$caso_movilidad->mostrar($id_caso_mov);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$caso_movilidad->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->cm,
 				"1"=>$reg->id_trab,
 				"2"=>$reg->trab_apellidosynombres,
 				"3"=>$reg->des_area,
 				"4"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_caso_mov.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_caso_mov.')"><i class="fa fa-pencil"></i></button>'
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
