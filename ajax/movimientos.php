<?php
require_once "../modelos/Movimientos.php";

$movimiento=new Movimientos();

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";


switch ($_GET["op"]){
	case 'movsfecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$movimiento->movsfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->mes,
        "2"=>($reg->mes)?'<button class="btn btn-danger" onclick="eliminar(\''.$reg->fecha.'\')"><i class="fa fa-trash"></i></button>':' <button class="btn btn-danger" onclick="eliminar('.$reg->fecha.')"><i class="fa fa-trash"></i></button>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'eliminar':
    $rspta=$movimiento->eliminar($fecha);
    echo $rspta ? "Fecha eliminada" : "Fecha no se puede eliminar";
  break;

	case "selectTipo":

		$rspta = $movimiento->selectTipo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tipo . '>' . $reg->descripcion . '</option>';
				}
	break;


	case 'movstipo':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$tipo=$_REQUEST["tipo"];

		$rspta=$movimiento->movstipo($fecha_inicio,$fecha_fin,$tipo);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->tipo,
 				"1"=>$reg->fecha,
 				"2"=>$reg->taller,
 				"3"=>$reg->documento,
 				"4"=>$reg->almacen,
 				"5"=>$reg->modelo,
				"6"=>$reg->color,
 				"7"=>($reg->t1>0)?'<span class="label bg-blue">'.$reg->t1.'</span>':'<span class="label bg-red"></span>',
				"8"=>($reg->t2>0)?'<span class="label bg-blue">'.$reg->t2.'</span>':'<span class="label bg-red"></span>',
				"9"=>($reg->t3>0)?'<span class="label bg-blue">'.$reg->t3.'</span>':'<span class="label bg-red"></span>',
				"10"=>($reg->t4>0)?'<span class="label bg-blue">'.$reg->t4.'</span>':'<span class="label bg-red"></span>',
				"11"=>($reg->t5>0)?'<span class="label bg-blue">'.$reg->t5.'</span>':'<span class="label bg-red"></span>',
				"12"=>($reg->t6>0)?'<span class="label bg-blue">'.$reg->t6.'</span>':'<span class="label bg-red"></span>',
				"13"=>($reg->t7>0)?'<span class="label bg-blue">'.$reg->t7.'</span>':'<span class="label bg-red"></span>',
				"14"=>($reg->t8>0)?'<span class="label bg-blue">'.$reg->t8.'</span>':'<span class="label bg-red"></span>'



 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarFacturas':
		$rspta=$movimiento->listarFacturas();

		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){

			$data[]=array(

				"0"=>$reg->tipo,
				"1"=>$reg->documento,
				"2"=>$reg->fecha,
				"3"=>$reg->codigo,
				"4"=>$reg->nom_cliente,
				"5"=>($reg->peso>0)?'<span class="label bg-black">'.$reg->peso.' KG'.'</span>':'<span class="label bg-red"></span>'

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
