<?php
require_once "../modelos/Prestamos.php";
session_start();



$prestamos=new Prestamos();

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


$id_pre=isset($_POST["id_pre"])? limpiarCadena($_POST["id_pre"]):"";
$fec_sol=isset($_POST["fec_sol"])? limpiarCadena($_POST["fec_sol"]):"";
$solicitante=isset($_POST["solicitante"])? limpiarCadena($_POST["solicitante"]):"";
$aprob_por=isset($_POST["aprob_por"])? limpiarCadena($_POST["aprob_por"]):"";
$motivo=isset($_POST["motivo"])? limpiarCadena($_POST["motivo"]):"";
$num_cuotas=isset($_POST["num_cuotas"])? limpiarCadena($_POST["num_cuotas"]):"";
$modalidad=isset($_POST["modalidad"])? limpiarCadena($_POST["modalidad"]):"";
$tip_dscto=isset($_POST["modalidad"])? limpiarCadena($_POST["tip_dscto"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";
$data_adjunta=isset($_POST["data_adjunta"])? limpiarCadena($_POST["data_adjunta"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_pre)){
			$rspta=$prestamos->insertar(			$fec_sol,	
													$aprob_por,
													$solicitante,
													$motivo,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Prestamo registrado" : "El prestamo no se pudo registrar";
		}
		else {
			$rspta=$prestamos->editar(              	
													$id_pre,
													$fec_sol,
													$aprob_por,
													$solicitante,
													$motivo,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
													$data_adjunta,
													$fec_reg,
													$usu_reg,
													$pc_reg);
			echo $rspta ? "Prestamo actualizado" : "El prestamo no se pudo actualizar";
		}
		
	break;

	case 'desaprobar':
		$rspta=$prestamos->desaprobar(            $id_pre,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg
												  );
 		echo $rspta ? "Prestamo desaprobado" : "El prestamo no se puede desaprobar";
	break;

	case 'aprobar':

		$id='0';
		$id=$prestamos->obtenerIdAprobador($usu_reg);

		$rspta=$prestamos->aprobar(			   $id_pre,
											   $fec_reg,
											   $usu_reg,
											   $pc_reg);
 		echo $rspta ? "Prestamo aprobado" : "El prestamo no se puede aprobar";
	break;

	case 'mostrar':
		$rspta=$prestamos->mostrar($id_pre);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$prestamos->listar();

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
 				"7"=>($reg->est_pre)?'<span class="label bg-green">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',
 				"8"=>($reg->est_pre)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_pre.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_pre.')"><i class="fa fa-pencil"></i></button>',
 				"9"=>($reg->est_pre)?
 					' <button class="btn btn-danger" onclick="desaprobar('.$reg->id_pre.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobar('.$reg->id_pre.')"><i class="fa fa-check"></i></button>'
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
					echo '<option value=' . $reg->solicitante . '>' . $reg->sol_apellidosynombres . '</option>';
				}
	break;


	case "selectTrabajadorPermisoAprobacion":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTrabajadorPermisoAprobacion();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->aprob_por . '>' . $reg->apro_apellidosynombres . '</option>';
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
