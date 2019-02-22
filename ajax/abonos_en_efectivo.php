<?php
require_once "../modelos/Abonos_En_Efectivo.php";
session_start();



$descuentos_en_efectivo=new Abonos_En_Efectivo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";



//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$id_abo_efe=isset($_POST["id_abo_efe"])? limpiarCadena($_POST["id_abo_efe"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fec_suc=isset($_POST["fec_suc"])? limpiarCadena($_POST["fec_suc"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$num_cuotas=isset($_POST["num_cuotas"])? limpiarCadena($_POST["num_cuotas"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";


$fec_des1=isset($_POST["fec_des1"])? limpiarCadena($_POST["fec_des1"]):"";
$mon_des1=isset($_POST["mon_des1"])? limpiarCadena($_POST["mon_des1"]):"";

$fec_des2=isset($_POST["fec_des2"])? limpiarCadena($_POST["fec_des2"]):"";
$mon_des2=isset($_POST["mon_des2"])? limpiarCadena($_POST["mon_des2"]):"";

$fec_des3=isset($_POST["fec_des3"])? limpiarCadena($_POST["fec_des3"]):"";
$mon_des3=isset($_POST["mon_des3"])? limpiarCadena($_POST["mon_des3"]):"";


$data_adjunta=isset($_POST["data_adjunta"])? limpiarCadena($_POST["data_adjunta"]):"";






switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_abo_efe)){
			$rspta=$descuentos_en_efectivo->insertar($id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$descuentos_en_efectivo->editar( $id_abo_efe,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'eliminar':
		$rspta=$descuentos_en_efectivo->eliminar(   $id_abo_efe,
													$fec_reg,
													$usu_reg,
													$pc_reg
											    );
 		echo $rspta ? "Eliminado" : "No se puede eliminar";
	break;

	case 'desactivar':
		$rspta=$descuentos_en_efectivo->desactivar(   $id_ins_des,
													  $fec_reg,
													  $usu_reg,
													  $pc_reg
													  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$id='0';
		$id=$descuentos_en_efectivo->obtenerIdAprobador($usu_reg);

		$rspta=$descuentos_en_efectivo->activar(   $id_ins_des,
												   $fec_reg,
												   $usu_reg,
												   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$descuentos_en_efectivo->mostrar($id_abo_efe);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$descuentos_en_efectivo->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->fec_suc,
 				"1"=>$reg->trab_apellidosynombres,
 				"2"=>$reg->detalle,
 				"3"=>($reg->est_abo_efe=='2')?'<span class="label bg-green">Pendiente</span>':
 				'<span class="label bg-red">Cancelado</span>',
 				"4"=>($reg->est_reg=='1')?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-red">Inactivo</span>',
 				"5"=>($reg->est_reg=='1')?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_abo_efe.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_abo_efe.')"><i class="fa fa-check"></i></button>',
 				"6"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_abo_efe.')"><i class="fa fa-pencil"></i></button>',
 				"7"=>'<button class="btn btn-danger" onclick="eliminar('.$reg->id_abo_efe.')"><i class="fa fa-close"></i></button>'
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





	case "selectTipoDsctoPrestamo":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTipoDsctoPrestamo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tip_dscto . '>' . $reg->des_tip_dscto . '</option>';
				}
	break;


	case "selectModalidadPrestamo":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectModalidadPrestamo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->modalidad . '>' . $reg->des_modalidad . '</option>';
				}
	break;






}
?>
