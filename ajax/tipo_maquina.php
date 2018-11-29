<?php 
require_once "../modelos/Tipo_Maquina.php";

$tipo_maquina=new Tipo_Maquina();

$idtipo_maquina=isset($_POST["idtipo_maquina"])? limpiarCadena($_POST["idtipo_maquina"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtipo_maquina)){
			$rspta=$tipo_maquina->insertar($nombre,$descripcion);
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta=$tipo_maquina->editar($idtipo_maquina,$nombre,$descripcion);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo_maquina->desactivar($idtipo_maquina);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
	break;

	case 'activar':
		$rspta=$tipo_maquina->activar($idtipo_maquina);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;

	case 'mostrar':
		$rspta=$tipo_maquina->mostrar($idtipo_maquina);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$tipo_maquina->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idtipo_maquina.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idtipo_maquina.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idtipo_maquina.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idtipo_maquina.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>