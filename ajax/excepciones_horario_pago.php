<?php
require_once "../modelos/Excepciones_Horario_Pago.php";
session_start();



$excepciones_horario_pago=new Excepciones_Horario_Pago();




//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_excepcion=isset($_POST["id_excepcion"])? limpiarCadena($_POST["id_excepcion"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_excepcion)){
			$rspta=$excepciones_horario_pago->insertar(	$id_trab,	
														$fec_reg,
														$usu_reg,
														$pc_reg);
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$excepciones_horario_pago->editar(              	
													$id_excepcion,
													$id_trab,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'anular':
		$rspta=$excepciones_horario_pago->anular(  $id_excepcion,
												       $fec_reg,
												       $usu_reg,
												       $pc_reg
												  );
 		echo $rspta ? "Anulado" : "No se puede anular";
	break;

	case 'activar':

		$rspta=$excepciones_horario_pago->activar( $id_excepcion,
												   $fec_reg,
												   $usu_reg,
												   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$excepciones_horario_pago->mostrar($id_excepcion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$excepciones_horario_pago->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->ehp,
 				"1"=>$reg->id_trab,
 				"2"=>$reg->trab_apellidosynombres,
 				"3"=>$reg->des_area,
 				"4"=>($reg->est_reg=='1')?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Anulado</span>',
 				"5"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_excepcion.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_excepcion.')"><i class="fa fa-pencil"></i></button>',
 				"6"=>($reg->est_reg)=='1'?
 					' <button class="btn btn-danger" onclick="anular('.$reg->id_excepcion.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_excepcion.')"><i class="fa fa-check"></i></button>'
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
