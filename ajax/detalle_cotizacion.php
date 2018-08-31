<?php

if (strlen(session_id()) < 1)
  session_start();


require_once "../modelos/Detalle_Cotizacion.php";

$detalle_cotizacion=new Detalle_Cotizacion();

$iddetalle_cotizacion=isset($_POST["iddetalle_cotizacion"])? limpiarCadena($_POST["iddetalle_cotizacion"]):"";
$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$precio_cotizacion=isset($_POST["precio_cotizacion"])? limpiarCadena($_POST["precio_cotizacion"]):"";
$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";
$idcotizacion=isset($_POST["idcotizacion"])? limpiarCadena($_POST["idcotizacion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($iddetalle_cotizacion)){
			$rspta=$detalle_cotizacion->insertar($idcotizacion,$idarticulo,$cantidad,$precio_cotizacion);
			echo $rspta ? "Detalle registrado" : "Detalle no se pudo registrar";
		}
		else {
			$rspta=$detalle_cotizacion->editar($iddetalle_cotizacion,$idarticulo,$cantidad,$precio_cotizacion);
			echo $rspta ? "Detalle actualizado" : "Detalle no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$detalle_cotizacion->eliminar($iddetalle_cotizacion);
 		echo $rspta ? "Detalle eliminado" : "Detalle eliminador";
	break;

	case 'mostrar':
		$rspta=$detalle_cotizacion->mostrar($iddetalle_cotizacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$detalle_cotizacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='3' || $_SESSION["idusuario"]=='4') {

				 			$data[]=array(

												"0"=>$reg->iddetalle_cotizacion,
								        "1"=>$reg->idarticulo,
								        "2"=>$reg->nombre,
								        "3"=>$reg->cantidad,
								        "4"=>$reg->precio_cotizacion,
								        "5"=>$reg->subtotal,
												"6"=>($reg->editable=='1')?'<button class="btn btn-info" onclick="mostrar('.$reg->iddetalle_cotizacion.')"><i class="fa fa-pencil"></i></button>'.
								 					' <button class="btn btn-danger" onclick="eliminar('.$reg->iddetalle_cotizacion.')"><i class="fa fa-trash"></i></button>':
								 					'<button class="btn btn-info" onclick="mostrar('.$reg->iddetalle_cotizacion.')"><i class="fa fa-pencil"></i></button>'
				 				);

			}else {

				 			$data[]=array(

												"0"=>$reg->iddetalle_cotizacion,
								        "1"=>$reg->idarticulo,
								        "2"=>$reg->nombre,
								        "3"=>$reg->cantidad,
								        "4"=>$reg->precio_cotizacion,
								        "5"=>$reg->subtotal,
												"6"=>($reg->editable=='1')?'<span class="label bg-green">PARA CORREGIR</span>':'<span class="label bg-red"></span>'
				 				);
			}

 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'selectMP':
		require_once "../modelos/ConsultasJ.php";
		$mp = new ConsultasJ();

		$rspta = $mp->selectMP();

				while ($reg = $rspta->fetch_object())

				{
				echo '<option value=' . $reg->idarticulo . '>' . $reg->mp . '</option>';
				}

	break;

	case 'precioMP':
		require_once "../modelos/ConsultasJ.php";
		$mp = new ConsultasJ();

		$rspta = $mp->precioMP($idarticulo);

				while ($reg = $rspta->fetch_object())

				{
				echo '<option value=' . $reg->precio_cotizacion . '>' . $reg->precio_cotizacion . '</option>';
				}

	break;

  case 'selectModDC':
    require_once "../modelos/Modelo.php";
    $mp = new Modelo();

    $rspta = $mp->selectModDC();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->cod_mod . '>' . $reg->nombre . '</option>';
        }

  break;

  case 'selectCot':
    require_once "../modelos/Cotizacion.php";
    $cot = new Cotizacion();

    $rspta = $cot->selectCot();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->idcotizacion . '>' . $reg->nombre . '</option>';
        }

  break;

}
?>
