<?php
require_once "../modelos/Cronograma_Pagos.php";

$cronograma_pagos=new Cronograma_Pagos();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}

		
		if (empty($idarticulo)){
			$rspta=$cronograma_pagos->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$cronograma_pagos->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
		
	break;

	case 'desactivar':
		$rspta=$cronograma_pagos->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$cronograma_pagos->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cronograma_pagos->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cronograma_pagos->listar();

		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
 				
 				"0"=>$reg->nombre,
 				"1"=>$reg->categoria,
 				"2"=>$reg->codigo,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"4"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>'
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
