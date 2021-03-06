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


$id_ant_ade=isset($_POST["id_ant_ade"])? limpiarCadena($_POST["id_ant_ade"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fec_suc=isset($_POST["fec_suc"])? limpiarCadena($_POST["fec_suc"]):"";
$detalle=isset($_POST["detalle"])? limpiarCadena($_POST["detalle"]):"";
$num_cuotas=isset($_POST["num_cuotas"])? limpiarCadena($_POST["num_cuotas"]):"";
$modalidad=isset($_POST["modalidad"])? limpiarCadena($_POST["modalidad"]):"";
$tip_dscto=isset($_POST["modalidad"])? limpiarCadena($_POST["tip_dscto"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";

$fec_des1=isset($_POST["fec_des1"])? limpiarCadena($_POST["fec_des1"]):"";
$mon_des1=isset($_POST["mon_des1"])? limpiarCadena($_POST["mon_des1"]):"";

$fec_des2=isset($_POST["fec_des2"])? limpiarCadena($_POST["fec_des2"]):"";
$mon_des2=isset($_POST["mon_des2"])? limpiarCadena($_POST["mon_des2"]):"";

$fec_des3=isset($_POST["fec_des3"])? limpiarCadena($_POST["fec_des3"]):"";
$mon_des3=isset($_POST["mon_des3"])? limpiarCadena($_POST["mon_des3"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($id_ant_ade)){
			$rspta=$anticipo_adelanto->insertar(	$id_trab,	
													$fec_suc,
													$detalle,
													$num_cuotas,
													$modalidad,
													$tip_dscto,
													$cantidad,
													$pagado,
													$saldo,
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
			$rspta=$anticipo_adelanto->editar(              	
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

	case 'desactivar':
		$rspta=$anticipo_adelanto->desactivar(    $id_ant_ade,
												  $fec_reg,
												  $usu_reg,
												  $pc_reg
												  );
 		echo $rspta ? "Desactivado" : "No se puede desactivar";
	break;

	case 'activar':

		$id='0';
		$id=$anticipo_adelanto->obtenerIdAprobador($usu_reg);

		$rspta=$anticipo_adelanto->activar(			   $id_ant_ade,
											   $fec_reg,
											   $usu_reg,
											   $pc_reg);
 		echo $rspta ? "Activado" : "No se puede activar";
	break;

	case 'mostrar':
		$rspta=$anticipo_adelanto->mostrar($id_ant_ade);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$anticipo_adelanto->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
				"0"=>$reg->fec_suc,
 				"1"=>$reg->trab_apellidosynombres,
 				"2"=>$reg->des_area,
 				"3"=>$reg->detalle,
 				"4"=>($reg->est_ant_ade=='1')?'<span class="label bg-green">Pendiente</span>':
 				'<span class="label bg-red">Cancelado</span>',
 				"5"=>($reg->est_reg)?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-red">Inactivo</span>',
 				"6"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ant_ade.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ant_ade.')"><i class="fa fa-pencil"></i></button>',
 				"7"=>($reg->est_reg)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_ant_ade.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_ant_ade.')"><i class="fa fa-check"></i></button>'
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
