<?php 
require_once "../modelos/Refrigerio.php";
session_start();

$refrigerio=new Refrigerio();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


$cod_ref=isset($_POST["cod_ref"])? limpiarCadena($_POST["cod_ref"]):"";
$hora_ini=isset($_POST["hora_ini"])? limpiarCadena($_POST["hora_ini"]):"";
$hora_fin=isset($_POST["hora_fin"])? limpiarCadena($_POST["hora_fin"]):"";
$descrip=isset($_POST["descrip"])? limpiarCadena($_POST["descrip"]):"";
$tiempo=isset($_POST["tiempo"])? limpiarCadena($_POST["tiempo"]):"";


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//




switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($cod_ref)){
			$rspta=$refrigerio->insertar($hora_ini,$hora_fin, $tiempo, $descrip, $usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Refrigerio registrado" : "Refrigerio no se pudo registrar";
		}
		else {
			$rspta=$refrigerio->editar($cod_ref,$hora_ini,$hora_fin,  $tiempo, $descrip, $usu_reg, $pc_reg, $fec_reg );
			echo $rspta ? "Refrigerio actualizado" : "Refrigerio no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$refrigerio->desactivar($cod_ref);
 		echo $rspta ? "Refrigerio Desactivado" : "Refrigerio no se puede desactivar";
	break;

	case 'activar':
		$rspta=$refrigerio->activar($cod_ref);
 		echo $rspta ? "Refrigerio activado" : "Refrigerio no se puede activar";
	break;

	case 'mostrar':
		$rspta=$refrigerio->mostrar($cod_ref);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$refrigerio->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->cod_ref,
 				"1"=>$reg->hora_fin,
 				"2"=>$reg->hora_ini,
 				"3"=>$reg->descrip,
 				"4"=>($reg->est_ref)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"5"=>($reg->est_ref)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->cod_ref.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->cod_ref.')"><i class="fa fa-check"></i></button>',
 				"6"=>($reg->est_ref)?'<button class="btn btn-warning" onclick="mostrar('.$reg->cod_ref.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->cod_ref.')"><i class="fa fa-pencil"></i></button>'
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