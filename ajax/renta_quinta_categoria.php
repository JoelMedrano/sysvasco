<?php
require_once "../modelos/Anticipo_Adelanto.php";
session_start();



$anticipo_adelanto=new Anticipo_Adelanto();

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


$id_ren_qui_cat=isset($_POST["id_ren_qui_cat"])? limpiarCadena($_POST["id_ren_qui_cat"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fec_ini1=isset($_POST["fec_ini1"])? limpiarCadena($_POST["fec_ini1"]):"";
$fec_fin1=isset($_POST["fec_fin1"])? limpiarCadena($_POST["fec_fin1"]):"";
$mon_ret1=isset($_POST["mon_ret1"])? limpiarCadena($_POST["mon_ret1"]):"";
$est_ret1=isset($_POST["est_ret1"])? limpiarCadena($_POST["est_ret1"]):"";
$fec_ini2=isset($_POST["fec_ini2"])? limpiarCadena($_POST["fec_ini2"]):"";
$fec_fin2=isset($_POST["fec_fin2"])? limpiarCadena($_POST["fec_fin2"]):"";
$mon_ret2=isset($_POST["mon_ret2"])? limpiarCadena($_POST["mon_ret2"]):"";
$est_ret2=isset($_POST["est_ret2"])? limpiarCadena($_POST["est_ret2"]):"";
$fec_ini3=isset($_POST["fec_ini3"])? limpiarCadena($_POST["fec_ini3"]):"";
$fec_fin3=isset($_POST["fec_fin3"])? limpiarCadena($_POST["fec_fin3"]):"";
$mon_ret3=isset($_POST["mon_ret3"])? limpiarCadena($_POST["mon_ret3"]):"";
$est_ret3=isset($_POST["est_ret3"])? limpiarCadena($_POST["est_ret3"]):"";
$fec_ini4=isset($_POST["fec_ini4"])? limpiarCadena($_POST["fec_ini4"]):"";
$fec_fin4=isset($_POST["fec_fin4"])? limpiarCadena($_POST["fec_fin4"]):"";
$mon_ret4=isset($_POST["mon_ret4"])? limpiarCadena($_POST["mon_ret4"]):"";
$est_ret4=isset($_POST["est_ret4"])? limpiarCadena($_POST["est_ret4"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_ren_qui_cat)){
			$rspta=$renta_quinta_categoria->insertar(			$id_trab,	
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
			echo $rspta ? "Registrado" : "No se pudo registrar";
		}
		else {
			$rspta=$renta_quinta_categoria->editar(              	
													$id_ant_ade,
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
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$renta_quinta_categoria->desactivar(            $id_ren_qui_cat,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg
												  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$id='0';
		$id=$renta_quinta_categoria->obtenerIdAprobador($usu_reg);

		$rspta=$renta_quinta_categoria->activar(			   $id_ren_qui_cat,
											   $fec_reg,
											   $usu_reg,
											   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$renta_quinta_categoria->mostrar($id_ren_qui_cat);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$renta_quinta_categoria->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->fec_suc,
 				"1"=>$reg->trab_apellidosynombres,
 				"2"=>$reg->des_area,
 				"3"=>$reg->detalle,
 				"4"=>$reg->cantidad,
 				"5"=>$reg->des_modalidad,
 				"6"=>$reg->des_tip_dscto,
 				"7"=>($reg->est_reg)?'<span class="label bg-green">Cancelado</span>':
 				'<span class="label bg-red">Pendiente</span>',
 				"8"=>($reg->est_reg)?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-red">Inactivo</span>',
 				"9"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ren_qui_cat.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ren_qui_cat.')"><i class="fa fa-pencil"></i></button>',
 				"10"=>($reg->est_reg)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_ren_qui_cat.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_ren_qui_cat.')"><i class="fa fa-check"></i></button>'
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
