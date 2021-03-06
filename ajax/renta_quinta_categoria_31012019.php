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



$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";
$id_pd=isset($_POST["id_pd"])? limpiarCadena($_POST["id_pd"]):"";
$correlativo=isset($_POST["correlativo"])? limpiarCadena($_POST["correlativo"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$sueldo=isset($_POST["sueldo"])? limpiarCadena($_POST["sueldo"]):"";
$bono_des_trab=isset($_POST["bono_des_trab"])? limpiarCadena($_POST["bono_des_trab"]):"";
$prod_soles=isset($_POST["prod_soles"])? limpiarCadena($_POST["prod_soles"]):"";
$dif_soles=isset($_POST["dif_soles"])? limpiarCadena($_POST["dif_soles"]):"";


$data_adjunta=isset($_POST["data_adjunta"])? limpiarCadena($_POST["data_adjunta"]):"";


$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):"";


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
		$rspta=$rqc->mostrar($id_cp);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$rqc->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
 				"0"=>$reg->rq,
 				"1"=>$reg->Ano,
 				"2"=>$reg->Descrip_fec_pag,
 				"3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cp.')"><i class="fa fa-pencil"></i></button>'
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





	case 'selectTrabajadoresDestajeros':
		

		$rspta=$pago_destajeros->selectTrabajadoresDestajeros();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle(\''.$reg->id_trab.'\',\''.$reg->nombres.'\',\''.$reg->sueldo.'\',\''.$reg->bono_des_trab.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_trab,
 				"2"=>$reg->nombres,
 				"3"=>$reg->sueldo,
 				"4"=>$reg->bono_des_trab
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;


	


	



}
?>
