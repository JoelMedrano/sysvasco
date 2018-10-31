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
$tip_dscto=isset($_POST["tip_dscto"])? limpiarCadena($_POST["tip_dscto"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$pagado=isset($_POST["pagado"])? limpiarCadena($_POST["pagado"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";
$data_adjunta=isset($_POST["data_adjunta"])? limpiarCadena($_POST["data_adjunta"]):"";
$medida=isset($_POST["medida"])? limpiarCadena($_POST["medida"]):"";


$fec_des1=isset($_POST["fec_des1"])? limpiarCadena($_POST["fec_des1"]):"";
$mon_des1=isset($_POST["mon_des1"])? limpiarCadena($_POST["mon_des1"]):"";

$fec_des2=isset($_POST["fec_des2"])? limpiarCadena($_POST["fec_des2"]):"";
$mon_des2=isset($_POST["mon_des2"])? limpiarCadena($_POST["mon_des2"]):"";

$fec_des3=isset($_POST["fec_des3"])? limpiarCadena($_POST["fec_des3"]):"";
$mon_des3=isset($_POST["mon_des3"])? limpiarCadena($_POST["mon_des3"]):"";

$fec_des4=isset($_POST["fec_des4"])? limpiarCadena($_POST["fec_des4"]):"";
$mon_des4=isset($_POST["mon_des4"])? limpiarCadena($_POST["mon_des4"]):"";

$fec_des5=isset($_POST["fec_des5"])? limpiarCadena($_POST["fec_des5"]):"";
$mon_des5=isset($_POST["mon_des5"])? limpiarCadena($_POST["mon_des5"]):"";

$fec_des6=isset($_POST["fec_des6"])? limpiarCadena($_POST["fec_des6"]):"";
$mon_des6=isset($_POST["mon_des6"])? limpiarCadena($_POST["mon_des6"]):"";

$fec_des7=isset($_POST["fec_des7"])? limpiarCadena($_POST["fec_des7"]):"";
$mon_des7=isset($_POST["mon_des7"])? limpiarCadena($_POST["mon_des7"]):"";

$fec_des8=isset($_POST["fec_des8"])? limpiarCadena($_POST["fec_des8"]):"";
$mon_des8=isset($_POST["mon_des8"])? limpiarCadena($_POST["mon_des8"]):"";

$fec_des9=isset($_POST["fec_des9"])? limpiarCadena($_POST["fec_des9"]):"";
$mon_des9=isset($_POST["mon_des9"])? limpiarCadena($_POST["mon_des9"]):"";

$fec_des10=isset($_POST["fec_des10"])? limpiarCadena($_POST["fec_des10"]):"";
$mon_des10=isset($_POST["mon_des10"])? limpiarCadena($_POST["mon_des10"]):"";

$fec_des11=isset($_POST["fec_des11"])? limpiarCadena($_POST["fec_des11"]):"";
$mon_des11=isset($_POST["mon_des11"])? limpiarCadena($_POST["mon_des11"]):"";

$fec_des12=isset($_POST["fec_des12"])? limpiarCadena($_POST["fec_des12"]):"";
$mon_des12=isset($_POST["mon_des12"])? limpiarCadena($_POST["mon_des12"]):"";

$fec_des13=isset($_POST["fec_des13"])? limpiarCadena($_POST["fec_des13"]):"";
$mon_des13=isset($_POST["mon_des13"])? limpiarCadena($_POST["mon_des13"]):"";

$fec_des14=isset($_POST["fec_des14"])? limpiarCadena($_POST["fec_des14"]):"";
$mon_des14=isset($_POST["mon_des14"])? limpiarCadena($_POST["mon_des14"]):"";

$fec_des15=isset($_POST["fec_des15"])? limpiarCadena($_POST["fec_des15"]):"";
$mon_des15=isset($_POST["mon_des15"])? limpiarCadena($_POST["mon_des15"]):"";

$fec_des16=isset($_POST["fec_des16"])? limpiarCadena($_POST["fec_des16"]):"";
$mon_des16=isset($_POST["mon_des16"])? limpiarCadena($_POST["mon_des16"]):"";

$fec_des17=isset($_POST["fec_des17"])? limpiarCadena($_POST["fec_des17"]):"";
$mon_des17=isset($_POST["mon_des17"])? limpiarCadena($_POST["mon_des17"]):"";

$fec_des18=isset($_POST["fec_des18"])? limpiarCadena($_POST["fec_des18"]):"";
$mon_des18=isset($_POST["mon_des18"])? limpiarCadena($_POST["mon_des18"]):"";

$fec_des19=isset($_POST["fec_des19"])? limpiarCadena($_POST["fec_des19"]):"";
$mon_des19=isset($_POST["mon_des19"])? limpiarCadena($_POST["mon_des19"]):"";

$fec_des20=isset($_POST["fec_des20"])? limpiarCadena($_POST["fec_des20"]):"";
$mon_des20=isset($_POST["mon_des20"])? limpiarCadena($_POST["mon_des20"]):"";

$fec_des21=isset($_POST["fec_des21"])? limpiarCadena($_POST["fec_des21"]):"";
$mon_des21=isset($_POST["mon_des21"])? limpiarCadena($_POST["mon_des21"]):"";

$fec_des22=isset($_POST["fec_des22"])? limpiarCadena($_POST["fec_des22"]):"";
$mon_des22=isset($_POST["mon_des22"])? limpiarCadena($_POST["mon_des22"]):"";

$fec_des23=isset($_POST["fec_des23"])? limpiarCadena($_POST["fec_des23"]):"";
$mon_des23=isset($_POST["mon_des23"])? limpiarCadena($_POST["mon_des23"]):"";

$fec_des24=isset($_POST["fec_des24"])? limpiarCadena($_POST["fec_des24"]):"";
$mon_des24=isset($_POST["mon_des24"])? limpiarCadena($_POST["mon_des24"]):"";

$fec_des25=isset($_POST["fec_des25"])? limpiarCadena($_POST["fec_des25"]):"";
$mon_des25=isset($_POST["mon_des25"])? limpiarCadena($_POST["mon_des25"]):"";

$fec_des26=isset($_POST["fec_des26"])? limpiarCadena($_POST["fec_des26"]):"";
$mon_des26=isset($_POST["mon_des26"])? limpiarCadena($_POST["mon_des26"]):"";

$fec_des27=isset($_POST["fec_des27"])? limpiarCadena($_POST["fec_des27"]):"";
$mon_des27=isset($_POST["mon_des27"])? limpiarCadena($_POST["mon_des27"]):"";

$fec_des28=isset($_POST["fec_des28"])? limpiarCadena($_POST["fec_des28"]):"";
$mon_des28=isset($_POST["mon_des28"])? limpiarCadena($_POST["mon_des28"]):"";

$fec_des29=isset($_POST["fec_des29"])? limpiarCadena($_POST["fec_des29"]):"";
$mon_des29=isset($_POST["mon_des29"])? limpiarCadena($_POST["mon_des29"]):"";

$fec_des30=isset($_POST["fec_des30"])? limpiarCadena($_POST["fec_des30"]):"";
$mon_des30=isset($_POST["mon_des30"])? limpiarCadena($_POST["mon_des30"]):"";



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
													$medida,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_des4,
													$mon_des4,
													$fec_des5,
													$mon_des5,
													$fec_des6,
													$mon_des6,
													$fec_des7,
													$mon_des7,
													$fec_des8,
													$mon_des8,
													$fec_des9,
													$mon_des9,
													$fec_des10,
													$mon_des10,
													$fec_des11,
													$mon_des11,
													$fec_des12,
													$mon_des12,
													$fec_des13,
													$mon_des13,
													$fec_des14,
													$mon_des14,
													$fec_des15,
													$mon_des15,
													$fec_des16,
													$mon_des16,
													$fec_des17,
													$mon_des17,
													$fec_des18,
													$mon_des18,
													$fec_des19,
													$mon_des19,
													$fec_des20,
													$mon_des20,
													$fec_des21,
													$mon_des21,
													$fec_des22,
													$mon_des22,
													$fec_des23,
													$mon_des23,
													$fec_des24,
													$mon_des24,
													$fec_des25,
													$mon_des25,
													$fec_des26,
													$mon_des26,
													$fec_des27,
													$mon_des27,
													$fec_des28,
													$mon_des28,
													$fec_des29,
													$mon_des29,
													$fec_des30,
													$mon_des30,
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
													$medida,
													$fec_des1,
													$mon_des1,
													$fec_des2,
													$mon_des2,
													$fec_des3,
													$mon_des3,
													$fec_des4,
													$mon_des4,
													$fec_des5,
													$mon_des5,
													$fec_des6,
													$mon_des6,
													$fec_des7,
													$mon_des7,
													$fec_des8,
													$mon_des8,
													$fec_des9,
													$mon_des9,
													$fec_des10,
													$mon_des10,
													$fec_des11,
													$mon_des11,
													$fec_des12,
													$mon_des12,
													$fec_des13,
													$mon_des13,
													$fec_des14,
													$mon_des14,
													$fec_des15,
													$mon_des15,
													$fec_des16,
													$mon_des16,
													$fec_des17,
													$mon_des17,
													$fec_des18,
													$mon_des18,
													$fec_des19,
													$mon_des19,
													$fec_des20,
													$mon_des20,
													$fec_des21,
													$mon_des21,
													$fec_des22,
													$mon_des22,
													$fec_des23,
													$mon_des23,
													$fec_des24,
													$mon_des24,
													$fec_des25,
													$mon_des25,
													$fec_des26,
													$mon_des26,
													$fec_des27,
													$mon_des27,
													$fec_des28,
													$mon_des28,
													$fec_des29,
													$mon_des29,
													$fec_des30,
													$mon_des30,
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


	case "selectFechaDscto1":
	
		

		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des1 . '>' . $reg->fecha1 . '</option>';
				}
	break;


	case "selectFechaDscto2":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des2 . '>' . $reg->fecha2 . '</option>';
				}
	break;




	case "selectFechaDscto3":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des3 . '>' . $reg->fecha3 . '</option>';
				}
	break;




	case "selectFechaDscto4":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des4 . '>' . $reg->fecha4 . '</option>';
				}
	break;



	case "selectFechaDscto5":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des5 . '>' . $reg->fecha5 . '</option>';
				}
	break;





	case "selectFechaDscto6":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des6 . '>' . $reg->fecha6 . '</option>';
				}
	break;




	case "selectFechaDscto7":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des7 . '>' . $reg->fecha7 . '</option>';
				}
	break;




	case "selectFechaDscto8":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des8 . '>' . $reg->fecha8 . '</option>';
				}
	break;




	case "selectFechaDscto9":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des9 . '>' . $reg->fecha9 . '</option>';
				}
	break;




	case "selectFechaDscto10":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des10 . '>' . $reg->fecha10 . '</option>';
				}
	break;



	case "selectFechaDscto11":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des11 . '>' . $reg->fecha11 . '</option>';
				}
	break;




	case "selectFechaDscto12":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des12 . '>' . $reg->fecha12 . '</option>';
				}
	break;





	case "selectFechaDscto13":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des13 . '>' . $reg->fecha13 . '</option>';
				}
	break;





	case "selectFechaDscto14":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des14 . '>' . $reg->fecha14 . '</option>';
				}
	break;




	case "selectFechaDscto15":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des15 . '>' . $reg->fecha15 . '</option>';
				}
	break;




	case "selectFechaDscto16":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des16 . '>' . $reg->fecha16 . '</option>';
				}
	break;



	case "selectFechaDscto17":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des17 . '>' . $reg->fecha17 . '</option>';
				}
	break;




	case "selectFechaDscto18":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des18 . '>' . $reg->fecha18 . '</option>';
				}
	break;




	case "selectFechaDscto19":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des19 . '>' . $reg->fecha19 . '</option>';
				}
	break;




	case "selectFechaDscto20":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des20 . '>' . $reg->fecha20 . '</option>';
				}
	break;




	case "selectFechaDscto21":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des21 . '>' . $reg->fecha21 . '</option>';
				}
	break;



	case "selectFechaDscto22":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des22 . '>' . $reg->fecha22 . '</option>';
				}
	break;




	case "selectFechaDscto23":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des23 . '>' . $reg->fecha23 . '</option>';
				}
	break;



	case "selectFechaDscto24":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des24 . '>' . $reg->fecha24 . '</option>';
				}
	break;


	case "selectFechaDscto25":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des25 . '>' . $reg->fecha25 . '</option>';
				}
	break;


	case "selectFechaDscto26":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des26 . '>' . $reg->fecha26 . '</option>';
				}
	break;



	case "selectFechaDscto27":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des27 . '>' . $reg->fecha27 . '</option>';
				}
	break;



	case "selectFechaDscto28":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des28 . '>' . $reg->fecha28 . '</option>';
				}
	break;




	case "selectFechaDscto29":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des29 . '>' . $reg->fecha29 . '</option>';
				}
	break;



	case "selectFechaDscto30":
		$rspta = $prestamos->selectFechas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->fec_des30 . '>' . $reg->fecha30 . '</option>';
				}
	break;



	case "selectMedida":
		$rspta = $prestamos->selectMedida();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->medida . '>' . $reg->des_medida . '</option>';
				}
	break;













}
?>
