<?php 
require_once "../modelos/Permiso_Personal.php";
session_start();

$permiso_personal=new Permiso_Personal();

$id_permiso=isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fecha_emision=isset($_POST["fecha_emision"])? limpiarCadena($_POST["fecha_emision"]):"";


$fecha_emision = date("Y-m-d",strtotime(str_replace('/','-',$fecha_emision)));



$fecha_procede=isset($_POST["fecha_procede"])? limpiarCadena($_POST["fecha_procede"]):"";
$fecha_procede = date("Y-m-d",strtotime(str_replace('/','-',$fecha_procede)));


$fecha_hasta=isset($_POST["fecha_hasta"])? limpiarCadena($_POST["fecha_hasta"]):"";
$fecha_hasta = date("Y-m-d",strtotime(str_replace('/','-',$fecha_hasta)));



$tip_permiso=isset($_POST["tip_permiso"])? limpiarCadena($_POST["tip_permiso"]):"";
$hora_ing=isset($_POST["hora_ing"])? limpiarCadena($_POST["hora_ing"]):"";
$hora_sal=isset($_POST["hora_sal"])? limpiarCadena($_POST["hora_sal"]):"";
$motivo=isset($_POST["motivo"])? limpiarCadena($_POST["motivo"]):"";


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//




switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($id_permiso)){
			$rspta=$permiso_personal->insertar($id_permiso,$id_trab,$fecha_emision,$fecha_procede, $fecha_hasta,$tip_permiso,$hora_ing, $hora_sal, $motivo,  $fec_reg, $pc_reg, $usu_reg);
			echo $rspta ? "Permiso registrado" : "Permiso no se pudo registrar";
		}
		else {
			$rspta=$permiso_personal->editar($id_permiso,$id_trab,$fecha_emision,$fecha_procede, $fecha_hasta,$tip_permiso,$hora_ing, $hora_sal, $motivo,  $fec_reg, $pc_reg, $usu_reg);
			echo $rspta ? "Permiso actualizado" : "Permiso no se pudo actualizar";
		}

	break;

	case 'desactivar':
		$rspta=$permiso_personal->desactivar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desactivado" : "Permiso no se puede desactivar";
	break;

	case 'activar':
		$rspta=$permiso_personal->activar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso activado" : "Permiso no se puede activar";
	break;

	case 'mostrar':
		$rspta=$permiso_personal->mostrar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'aprobar':
		$rspta=$permiso_personal->aprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso aprobado" : "Permiso no se puede aprobar";
	break;


	case 'desaprobar':
		$rspta=$permiso_personal->desaprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desaprobado" : "Permiso no se puede desaprobar";
	break;


	case 'listar':
		$rspta=$permiso_personal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->fecha_emision,
 				"1"=>$reg->fecha_procede,
 				"2"=>$reg->apepat_trab,
 				"3"=>$reg->tipo_permiso,
 				"4"=>$reg->motivo,

 				"5"=>($reg->est_apro)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',

 				"6"=>($reg->est_reg)?'<span class="label bg-blue">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',

 				"7"=>($reg->est_reg)?' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>':
 					' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>',

 				"8"=>($reg->est_apro)?' <button class="btn btn-danger" onclick="desaprobar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

 				"9"=>($reg->est_reg)?' <button class="btn btn-danger" onclick="desactivar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',
 					
 						
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>