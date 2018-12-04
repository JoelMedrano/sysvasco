<?php
require_once "../modelos/Confeccion.php";

$confeccion=new Confeccion();

$idconfeccion=isset($_POST["idconfeccion"])? limpiarCadena($_POST["idconfeccion"]):"";

$idmft=isset($_POST["idmft"])? limpiarCadena($_POST["idmft"]):"";
$id_operacion=isset($_POST["id_operacion"])? limpiarCadena($_POST["id_operacion"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$idtipo_maquina=isset($_POST["idtipo_maquina"])? limpiarCadena($_POST["idtipo_maquina"]):"";
$idcodigo_puntada=isset($_POST["idcodigo_puntada"])? limpiarCadena($_POST["idcodigo_puntada"]):"";
$ancho_costura=isset($_POST["ancho_costura"])? limpiarCadena($_POST["ancho_costura"]):"";
$puntadas_pulgadas=isset($_POST["puntadas_pulgadas"])? limpiarCadena($_POST["puntadas_pulgadas"]):"";





switch ($_GET["op"]){
	case 'guardaryeditar':

		
		if (empty($idconfeccion)){
			$rspta=$confeccion->insertar($idmft,$id_operacion,$descripcion,$idtipo_maquina,$idcodigo_puntada,$ancho_costura,$puntadas_pulgadas);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$confeccion->editar($idconfeccion,$idmft,$id_operacion,$descripcion,$idtipo_maquina,$idcodigo_puntada,$ancho_costura,$puntadas_pulgadas);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
		
    break;
    
    case 'eliminar':
    $rspta=$confeccion->eliminar($idconfeccion);
     echo $rspta ? "Artículo Desactivado" : "Artículo no se puede eliminar";
    break;

	case 'mostrar':
		$rspta=$confeccion->mostrar($idconfeccion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$confeccion->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
                            "0"=>$reg->idmft,
                            "1"=>$reg->cod_mod,
                            "2"=>$reg->nom_mod,
                            "3"=>$reg->operacion,
                            "4"=>$reg->tipo_maquina,
                            "5"=>$reg->codigo_puntada,
                            "6"=>$reg->ancho_costura,
                            "7"=>$reg->puntadas_pulgadas,
                            "8"=>($reg->idmft)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idconfeccion.')"><i class="fa fa-pencil"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->idconfeccion.')"><i class="fa fa-trash"></i></button>':
                            '<button class="btn btn-warning" onclick="mostrar('.$reg->idconfeccion.')"><i class="fa fa-pencil"></i></button>'.' <button class="btn btn-danger" onclick="eliminar('.$reg->idconfeccion.')"><i class="fa fa-trash"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
        
	case "selectFT":

    $rspta = $confeccion->selectFT();

    while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idmft . '>' . $reg->ft . '</option>';
            }
    break;


	case "selectOP":

    $rspta = $confeccion->selectOP();

    while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->id_operacion . '>' . $reg->nombre . '</option>';
            }
    break;

    
	case "selectTM":

    $rspta = $confeccion->selectTM();

    while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idtipo_maquina . '>' . $reg->nombre . '</option>';
            }
    break;


    case 'selectCP':
		
    $rspta = $confeccion->selectCP($idtipo_maquina);
    
    echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idcodigo_puntada . '>' . $reg->nombre . '</option>';
				}

    break;
    

    case "selectCP2":

    $rspta = $confeccion->selectCP2();

    while ($reg = $rspta->fetch_object())
            {
                echo '<option value=' . $reg->idcodigo_puntada . '>' . $reg->nombre . '</option>';
            }
    break;


}
?>
