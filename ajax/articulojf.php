<?php
require_once "../modelos/Articulojf.php";

$articulojf=new Articulojf();

$articulo=isset($_POST["articulo"])? limpiarCadena($_POST["articulo"]):"";
$peso_art=isset($_POST["peso_art"])? limpiarCadena($_POST["peso_art"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($articulo)){
			$rspta=$articulojf->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulojf->editar($articulo,$peso_art);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}

	break;

	case 'mostrar':
		$rspta=$articulojf->mostrar($articulo);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
	break;



	case 'listar':
		$rspta=$articulojf->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(

 				"0"=>$reg->articulo,
 				"1"=>$reg->marca,
 				"2"=>$reg->modelo,
				"3"=>$reg->nombre,
 				"4"=>$reg->color,
				"5"=>$reg->talla,
				"6"=>$reg->peso_art,
				"7"=>($reg->estado=='CAMPAÑAD')?('<span class="label bg-yellow">CAMPAÑA</span>'):(($reg->estado=='DESCONTINUADO')?('<span class="label bg-red">INACTIVO</span>'):('<span class="label bg-green">ACTIVO</span>')),
				"8"=>($reg->estado=='ACTIVO')?'<button class="btn btn-warning" onclick="mostrar(\''.$reg->articulo.'\')"><i class="fa fa-search-plus"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar(\''.$reg->articulo.'\')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar(\''.$reg->articulo.'\')"><i class="fa fa-search-plus"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar(\''.$reg->articulo.'\')"><i class="fa fa-check"></i></button>',
				//"7"=>($reg->estado=='CAMPAÑAD')?('<span class="label bg-yellow">CAMPAÑA</span>'):(($reg->estado=='DESCONTINUADO')?('<span class="label bg-red">INACTIVO</span>'):('<span class="label bg-green">ACTIVO</span>')),
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'desactivar':
		$rspta=$articulojf->desactivar($articulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulojf->activar($articulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;




}
?>
