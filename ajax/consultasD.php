<?php 
require_once "../modelos/ConsultasD.php";

$consultad=new ConsultasD();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//





switch ($_GET["op"]){
	case 'comprasfecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$consulta->comprasfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->usuario,
 				"2"=>$reg->proveedor,
 				"3"=>$reg->tipo_comprobante,
 				"4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
 				"5"=>$reg->total_compra,
 				"6"=>$reg->impuesto,
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'ventasfechacliente':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$idcliente=$_REQUEST["idcliente"];

		$rspta=$consulta->ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->usuario,
 				"2"=>$reg->cliente,
 				"3"=>$reg->tipo_comprobante,
 				"4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
 				"5"=>$reg->total_venta,
 				"6"=>$reg->impuesto,
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;



//Permiso - Agregado DG 13072018
	case "selectPersonal":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' .$reg->nom_trab. ' ' . $reg->apepat_trab.  ' ' .$reg->apemat_trab. '</option>';
				}
	break;


	//Permiso - Agregado DG 13072018
	case "selectPersonalNombreCorto":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectPersonalNombreCorto();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' .$reg->apellidosynombres. ' </option>';
				}
	break;



	//Permiso - Agregado DG 13072018
	case "selectPersonalNombreLargo":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectPersonalNombreLargo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' .$reg->apellidosynombres. ' </option>';
				}
	break;




// Permiso - Agregado DG 18072018
	case "selectTipoPermiso":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTipoPermiso();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tip_permiso . '>' . $reg->tipo_permiso . '</option>';
				}
	break;

// Trabajador - Agregado DG 19072018
	case "selectFuncion":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectFuncion();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_funcion . '>' . $reg->funcion . '</option>';
				}
	break;


//Trabajador - Agregado DG 19072018
	case "selectArea":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectArea();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_area . '>' . $reg->area_trab . '</option>';
				}
	break;





// Trabajador - Agregado DG 19072018
	case "selectTipoDocumento":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTipoDocumento();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_tip_doc . '>' . $reg->tipo_documento . '</option>';
				}
	break;




// Trabajador - Agregado DG 19072018
	case "selectTipoPlanilla":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTipoPlanilla();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_tip_plan . '>' . $reg->tipo_planilla. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectCentroCostos":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectCentroCostos();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_cen_cost . '>' . $reg->centro_costos. '</option>';
				}
	break;


// Trabajador -Agregado DG 20072018
	case "selectManoDeObra":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectManoDeObra();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_tip_man_ob . '>' . $reg->tipo_mano_obra. '</option>';
				}
	break;



// Trabajador - Agregado DG 20072018
	case "selectSucursal":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectSucursal();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_sucursal . '>' . $reg->sucursal_anexo. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectCategoriaLaboral":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectCategoriaLaboral();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_categoria . '>' . $reg->categoria_laboral. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectFormaDePago":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectFormaDePago();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_form_pag . '>' . $reg->forma_pago. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectTipoContrato":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTipoContrato();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_tip_cont . '>' . $reg->tipo_contrato. '</option>';
				}
	break;




// Trabajador - Agregado DG 20072018
	case "selectEstadoCivil":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectEstadoCivil();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_est_civil . '>' . $reg->estado_civil. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectRegimenPensionario":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectRegimenPensionario();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_reg_pen . '>' . $reg->regimen_pensionario. '</option>';
				}
	break;



// Trabajador - Agregado DG 20072018
	case "selectComisionActual":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectComisionActual();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_com_act . '>' . $reg->comision_actual. '</option>';
				}
	break;



// Trabajador - Agregado DG 20072018
	case "selectGenero":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectGenero();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_genero . '>' . $reg->genero. '</option>';
				}
	break;


// Trabajador - Agregado DG 20072018
	case "selectTRegistro":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTRegistro();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_t_registro . '>' . $reg->t_registro. '</option>';
				}
	break;




// Trabajador - Agregado DG 20072018
	case "selectTurno":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTurno();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_turno . '>' . $reg->turno. '</option>';
				}
	break;



// Trabajador - Agregado DG 27072018
	case "selectDistrito":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectDistrito();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_distrito . '>' . $reg->distrito. '</option>';
				}
	break;



// Trabajador de vacaciones - Agregado DG 27082018
	case "selectTrabajadorVacaciones":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectTrabajadorVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_nomtrab . '>' . $reg->apellidosynombres. '</option>';
				}
	break;



// Trabajador de vacaciones - Agregado DG 27082018
	case "selectPeriodosVacaciones":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectPeriodosVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_periodo . '>' . $reg->periodo. '</option>';
				}
	break;

// Trabajador de vacaciones - Agregado DG 27082018
	case "selectFechaAnualCronogramaPagos":
		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();

		$rspta = $consultasD->selectFechaAnualCronogramaPagos();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_ano . '>' . $reg->ano. '</option>';
				}
	break;


// Trabajador
	case "selectGrupoSanguineo":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectGrupoSanguineo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_gru_san . '>' . $reg->grupo_sanguineo . '</option>';
				}
	break;



	// Trabajador 23112018

	case "selectPagoVacacionesCts":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectPagoVacacionesCts();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_pag_vac_cts . '>' . $reg->pago_vac_cts . '</option>';
				}
	break;






	case "selectSituacionInformativaAnterior":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectSituacionInformativa();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_sit_inf_ant . '>' . $reg->situacion_informativa_anterior . '</option>';
				}
	break;



	case "selectSituacionInformativaActual":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectSituacionInformativa();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_sit_inf_act . '>' . $reg->situacion_informativa_actual . '</option>';
				}
	break;



	case "selectPagoEspecial":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectPagoEspecial();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_pag_esp . '>' . $reg->pago_especial . '</option>';
				}
	break;



	case "selectHorarios":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectHorarios();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_horario . '>' . $reg->horario . '</option>';
				}
	break;



	case "selectRefrigerios":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectRefrigerios();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->cod_ref . '>' . $reg->refrigerio . '</option>';
				}
	break;




	case "selectMesesyAno":

		require_once "../modelos/ConsultasD.php";
		$consultasD = new ConsultasD();
		
		$rspta = $consultasD->selectMesesyAno();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_mes . '>' . $reg->mes . '</option>';
				}
	break;





































}
?>