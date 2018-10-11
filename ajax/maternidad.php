<?php
require_once "../modelos/Maternidad.php";
session_start();



$maternidad=new Maternidad();




//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";

$id_maternidad=isset($_POST["id_maternidad"])? limpiarCadena($_POST["id_maternidad"]):"";



$fec_nac_c1=isset($_POST["fec_nac_c1"])? limpiarCadena($_POST["fec_nac_c1"]):"";
$lugar_c1=isset($_POST["lugar_c1"])? limpiarCadena($_POST["lugar_c1"]):"";
$observa_c1=isset($_POST["observa_c1"])? limpiarCadena($_POST["observa_c1"]):"";
$data_adjunta_hij1_c1=isset($_POST["data_adjunta_hij1_c1"])? limpiarCadena($_POST["data_adjunta_hij1_c1"]):"";
$data_adjunta_hij2_c1=isset($_POST["data_adjunta_hij2_c1"])? limpiarCadena($_POST["data_adjunta_hij2_c1"]):"";
$data_adjunta_hij3_c1=isset($_POST["data_adjunta_hij3_c1"])? limpiarCadena($_POST["data_adjunta_hij3_c1"]):"";


$fec_nac_c2=isset($_POST["fec_nac_c2"])? limpiarCadena($_POST["fec_nac_c2"]):"";
$lugar_c2=isset($_POST["lugar_c2"])? limpiarCadena($_POST["lugar_c2"]):"";
$observa_c2=isset($_POST["observa_c2"])? limpiarCadena($_POST["observa_c2"]):"";
$data_adjunta_hij1_c2=isset($_POST["data_adjunta_hij1_c2"])? limpiarCadena($_POST["data_adjunta_hij1_c2"]):"";
$data_adjunta_hij2_c2=isset($_POST["data_adjunta_hij2_c2"])? limpiarCadena($_POST["data_adjunta_hij2_c2"]):"";
$data_adjunta_hij3_c2=isset($_POST["data_adjunta_hij3_c2"])? limpiarCadena($_POST["data_adjunta_hij3_c2"]):"";


$fec_nac_c3=isset($_POST["fec_nac_c3"])? limpiarCadena($_POST["fec_nac_c3"]):"";
$lugar_c3=isset($_POST["lugar_c3"])? limpiarCadena($_POST["lugar_c3"]):"";
$observa_c3=isset($_POST["observa_c3"])? limpiarCadena($_POST["observa_c3"]):"";
$data_adjunta_hij1_c3=isset($_POST["data_adjunta_hij_c3"])? limpiarCadena($_POST["data_adjunta_hij_c3"]):"";
$data_adjunta_hij2_c3=isset($_POST["data_adjunta_hij2_c3"])? limpiarCadena($_POST["data_adjunta_hij2_c3"]):"";
$data_adjunta_hij3_c3=isset($_POST["data_adjunta_hij3_c3"])? limpiarCadena($_POST["data_adjunta_hij3_c3"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_maternidad)){
			$rspta=$maternidad->insertar(			$id_trab,
												    $fec_nac_c1,
												    $lugar_c1,
												    $observa_c1,
												    $data_adjunta_hij1_c1,
												    $data_adjunta_hij2_c1,
												    $data_adjunta_hij3_c1,
												    $fec_nac_c2,
												    $lugar_c2,
												    $observa_c2,
												    $data_adjunta_hij1_c2,
												    $data_adjunta_hij2_c2,
												    $data_adjunta_hij3_c2,
													$fec_nac_c3,
													$lugar_c3,
													$observa_c3,
													$data_adjunta_hij1_c3,
													$data_adjunta_hij2_c3,
													$data_adjunta_hij3_c3,
												    $fec_reg,
												    $usu_reg,
												    $pc_reg);
			echo $rspta ? "Registro por maternidad registrado" : "El registro por maternidad no se pudo registrar";
		}
		else {
			$rspta=$maternidad->editar(             $id_maternidad, 	
													$id_trab,
												    $fec_nac_c1,
												    $lugar_c1,
												    $observa_c1,
												    $data_adjunta_hij1_c1,
												    $data_adjunta_hij2_c1,
												    $data_adjunta_hij3_c1,
												    $fec_nac_c2,
												    $lugar_c2,
												    $observa_c2,
												    $data_adjunta_hij1_c2,
												    $data_adjunta_hij2_c2,
												    $data_adjunta_hij3_c2,
													$fec_nac_c3,
													$lugar_c3,
													$observa_c3,
													$data_adjunta_hij1_c3,
													$data_adjunta_hij2_c3,
													$data_adjunta_hij3_c3,
												    $fec_reg,
												    $usu_reg,
												    $pc_reg);
			echo $rspta ? "Registro por maternidad actualizado" : "El registro por maternidad no se pudo actualizar";
		}
		
	break;

	

	case 'mostrar':
		$rspta=$maternidad->mostrar($id_trab); 
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$maternidad->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->est_reg,
 				"1"=>$reg->sucursal_anexo,
 				"2"=>$reg->area_trab,
 				"3"=>$reg->funcion,
 				"4"=>$reg->nombres,
 				"5"=>($reg->est_reg=='1')?'<span class="label bg-green">ACTIVO</span>':
 				'<span class="label bg-red">INACTIVO</span>',
 				"6"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>'
 				); 
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	


	case 'selectColaboradorasPlanilla':
	
		$rspta = $maternidad->selectColaboradorasPlanilla();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->id_trab . '>' . $reg->nombres . '</option>';
				}
	break;



}
?>
