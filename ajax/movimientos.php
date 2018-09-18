<?php
require_once "../modelos/Movimientos.php";

$movimiento=new Movimientos();

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";


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
    echo $rspta ? "Cotizacion lista para eliminar" : "Cotizacion no se puede eliminar";
  break;


}
?>
