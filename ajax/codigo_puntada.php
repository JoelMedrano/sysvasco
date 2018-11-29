<?php
require_once "../modelos/Codigo_Puntada.php";

$codigo_puntada=new Codigo_Puntada();

$idcodigo_puntada=isset($_POST["idcodigo_puntada"])? limpiarCadena($_POST["idcodigo_puntada"]):"";
$idtipo_maquina=isset($_POST["idtipo_maquina"])? limpiarCadena($_POST["idtipo_maquina"]):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

	
		if (empty($idcodigo_puntada)){
			$rspta=$codigo_puntada->insertar($idtipo_maquina,$nombre,$descripcion);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$codigo_puntada->editar($idcodigo_puntada,$idtipo_maquina,$nombre,$descripcion);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$codigo_puntada->desactivar($idcodigo_puntada);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$codigo_puntada->activar($idcodigo_puntada);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$codigo_puntada->mostrar($idcodigo_puntada);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$codigo_puntada->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcodigo_puntada.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcodigo_puntada.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idcodigo_puntada.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcodigo_puntada.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->puntada,
                "2"=>$reg->maquina,
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

	case "select":
		require_once "../modelos/Tipo_maquina.php";
		$tipo_maquina = new Tipo_maquina();

		$rspta = $tipo_maquina->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idtipo_maquina . '>' . $reg->nombre . '</option>';
				}
	break;



}
?>
