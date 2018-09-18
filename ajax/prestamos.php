<?php
require_once "../modelos/Descuentos_Judiciales.php";

$descuentos_judiciales=new Descuentos_Judiciales();

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


$id_des_jud=isset($_POST["id_des_jud"])? limpiarCadena($_POST["id_des_jud"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$obs_des_jud=isset($_POST["obs_des_jud"])? limpiarCadena($_POST["obs_des_jud"]):"";
$fec_ini=isset($_POST["fec_ini"])? limpiarCadena($_POST["fec_ini"]):"";
$fec_fin=isset($_POST["fec_fin"])? limpiarCadena($_POST["fec_fin"]):"";
$mon_men=isset($_POST["mon_men"])? limpiarCadena($_POST["mon_men"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_des_jud)){
			$rspta=$descuentos_judiciales->insertar($id_trab,
													$obs_des_jud,
													$fec_ini,
													$fec_fin,
													$mon_men,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Descuento judicial registrado" : "El descuento judicial no se pudo registrar";
		}
		else {
			$rspta=$descuentos_judiciales->editar($id_des_jud,
												  $id_trab,
												  $obs_des_jud,
												  $fec_ini,
												  $fec_fin,
												  $mon_men,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg);
			echo $rspta ? "Descuento judicial actualizado" : "El descuento judicial no se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$descuentos_judiciales->desactivar($id_des_jud,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg
												  );
 		echo $rspta ? "Descuento judicial desactivado" : "El descuento judicial no se puede desactivar";
	break;

	case 'activar':
		$rspta=$descuentos_judiciales->activar($id_des_jud,
											   $fec_reg,
											   $usu_reg,
											   $pc_reg);
 		echo $rspta ? "Descuento judicial activado" : "El descuento judicial no se puede activar";
	break;

	case 'mostrar':
		$rspta=$descuentos_judiciales->mostrar($id_des_jud);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$descuentos_judiciales->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
 				"0"=>$reg->id_trab,
 				"1"=>$reg->nombres,
 				"2"=>$reg->sucursal_anexo,
 				"3"=>$reg->area_trab,
 				"4"=>$reg->obs_des_jud,
 				"5"=>($reg->est_des_jud)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"6"=>($reg->est_des_jud)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_des_jud.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_des_jud.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_des_jud.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_des_jud.')"><i class="fa fa-check"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectTrabajador":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTrabajadorVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' . $reg->apellidosynombres . '</option>';
				}
	break;



}
?>
