<?php 
require_once "../modelos/Compensacion.php";

$compensacion=new Compensacion();

$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$id_hor_per=isset($_POST["id_hor_per"])? limpiarCadena($_POST["id_hor_per"]):"";
$id_hor_ext=isset($_POST["id_hor_ext"])? limpiarCadena($_POST["id_hor_ext"]):"";

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$rspta=$categoria->insertar($nombre,$descripcion);
			echo $rspta ? "Categoría registrada" : "Categoría no se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idcategoria,$nombre,$descripcion);
			echo $rspta ? "Categoría actualizada" : "Categoría no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$categoria->desactivar($idcategoria);
 		echo $rspta ? "Categoría Desactivada" : "Categoría no se puede desactivar";
	break;

	case 'activar':
		$rspta=$categoria->activar($idcategoria);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;

	case 'mostrar':
		$rspta=$compensacion->mostrar($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$compensacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->id_trab,
 				"1"=>$reg->nombres,
                "2"=>$reg->tipo_planilla,
                "3"=>$reg->sucursal_anexo,
                "4"=>$reg->funcion,
                "5"=>$reg->area_trab,
                "6"=>$reg->est_reg,
                "7"=>$reg->num_doc_trab,
                "8"=>($reg->id_trab)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_trab.')"><i class="fa fa-pencil"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	//TODO: select trabajador
	case "selectTrab":
		
		$rspta = $compensacion->selectTrab();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_trab . '>' . $reg->nombres . '</option>';
				}
	break;

	//TODO: select para tardanzas
	case 'selectTardanza':
		
    $rspta = $compensacion->selectTardanza($id_trab);
    
    echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->id_hor_per . '>' . $reg->tardanza . '</option>';
				}

	break;

	//TODO: select para horas de tardanza
	case 'selectHorasT':
	
	$rspta = $compensacion->selectHorasT($id_trab,$id_hor_per);
	
	echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->tiempo_fin . '>' . $reg->tiempo_fin . '</option>';
				}

	break;
	
	//TODO: select para horas extra
	case 'selectExtras':
		
    $rspta = $compensacion->selectExtras($id_trab);
    
    echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->id_hor_ext . '>' . $reg->extra . '</option>';
				}

	  break;
	  
	//TODO: select para horas de tardanza
	case 'selectHorasE':
	
	$rspta = $compensacion->selectHorasE($id_trab,$id_hor_ext);
	
	echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->tiempo_fin . '>' . $reg->tiempo_fin . '</option>';
				}

	break;

}
?>