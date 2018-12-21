<?php
require_once "../modelos/Horario_Refrigerio_Trabajador.php";
session_start();



$horario_refrigerio_trabajador=new Horario_Refrigerio_Trabajador();




//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_hor_ref=isset($_POST["id_hor_ref"])? limpiarCadena($_POST["id_hor_ref"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$id_horario=isset($_POST["id_horario"])? limpiarCadena($_POST["id_horario"]):"";
$cod_ref=isset($_POST["cod_ref"])? limpiarCadena($_POST["cod_ref"]):"";





switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_hor_ref)){
			$rspta=$horario_refrigerio_trabajador->insertar(	$id_trab,
																$id_horario,
																$cod_ref,	
																$fec_reg,
																$usu_reg,
																$pc_reg);
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$horario_refrigerio_trabajador->editar(              	
															$id_hor_ref,
															$id_trab,
															$id_horario,
															$cod_ref,	
															$fec_reg,
															$usu_reg,
															$pc_reg);
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$horario_refrigerio_trabajador->desactivar(  $id_hor_ref,
													        $fec_reg,
													        $usu_reg,
													        $pc_reg
												  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$rspta=$horario_refrigerio_trabajador->activar( $id_hor_ref,
													    $fec_reg,
													    $usu_reg,
													    $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$horario_refrigerio_trabajador->mostrar($id_hor_ref);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$horario_refrigerio_trabajador->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->hrt,
 				"1"=>$reg->id_trab,
 				"2"=>$reg->trab_apellidosynombres,
 				"3"=>$reg->des_area,
 				"4"=>$reg->descrip,
 				"5"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_hor_ref.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_hor_ref.')"><i class="fa fa-pencil"></i></button>'
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
