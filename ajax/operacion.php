<?php 
require_once "../modelos/Operacion.php";

$operacion=new Operacion();

$id_operacion=isset($_POST["id_operacion"])? limpiarCadena($_POST["id_operacion"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_operacion)){
			$rspta=$operacion->insertar($nombre,$descripcion);
			echo $rspta ? "Operacion registrada" : "Operacion no se pudo registrar";
		}
		else {
			$rspta=$operacion->editar($id_operacion,$nombre,$descripcion);
			echo $rspta ? "Operacion actualizada" : "Operacion no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$operacion->desactivar($id_operacion);
 		echo $rspta ? "Operacion Desactivada" : "Operacion no se puede desactivar";
	break;

	case 'activar':
		$rspta=$operacion->activar($id_operacion);
 		echo $rspta ? "Operacion activada" : "Operacion no se puede activar";
	break;

	case 'mostrar':
		$rspta=$operacion->mostrar($id_operacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$operacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_operacion.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_operacion.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_operacion.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_operacion.')"><i class="fa fa-check"></i></button>',
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