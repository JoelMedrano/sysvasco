<?php
require_once "../modelos/Descuentos_Insumos_Destajeros.php";
session_start();



$descuentos_insumos_destajeros=new Descuentos_Insumos_Destajeros();

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


$id_ins_des=isset($_POST["id_ins_des"])? limpiarCadena($_POST["id_ins_des"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fec_suc=isset($_POST["fec_suc"])? limpiarCadena($_POST["fec_suc"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$num_cuotas=isset($_POST["num_cuotas"])? limpiarCadena($_POST["num_cuotas"]):"";
$modalidad=isset($_POST["modalidad"])? limpiarCadena($_POST["modalidad"]):"";
$tip_dscto=isset($_POST["modalidad"])? limpiarCadena($_POST["tip_dscto"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_ins_des)){
			$rspta=$prestamos->insertar(			$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Prestamo registrado" : "El prestamo no se pudo registrar";
		}
		else {
			$rspta=$prestamos->editar(              	
													$id_ins_des,
													$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Prestamo actualizado" : "El prestamo no se pudo actualizar";
		}
		
	break;

	case 'desaprobar':
		$rspta=$prestamos->desaprobar(            $id_ins_des,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg
												  );
 		echo $rspta ? "Prestamo desaprobado" : "El prestamo no se puede desaprobar";
	break;

	case 'aprobar':

		$id='0';
		$id=$prestamos->obtenerIdAprobador($usu_reg);

		$rspta=$prestamos->aprobar(			   $id_ins_des,
											   $fec_reg,
											   $usu_reg,
											   $pc_reg);
 		echo $rspta ? "Prestamo aprobado" : "El prestamo no se puede aprobar";
	break;

	case 'mostrar':
		$rspta=$prestamos->mostrar($id_ins_des);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$descuentos_insumos_destajeros->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->fec_sol,
 				"1"=>$reg->sol_apellidosynombres,
 				"2"=>$reg->apro_apellidosynombres,
 				"3"=>$reg->motivo,
 				"4"=>$reg->cantidad,
 				"5"=>$reg->des_modalidad,
 				"6"=>$reg->des_tip_dscto,
 				"7"=>($reg->est_pre)?'<span class="label bg-green">Pendiente</span>':
 				'<span class="label bg-red">Cancelado</span>',
 				"8"=>($reg->est_pre)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_pre.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_pre.')"><i class="fa fa-pencil"></i></button>'
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
