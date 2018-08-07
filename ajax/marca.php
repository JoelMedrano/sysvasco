<?php
require_once "../modelos/Marca.php";

$marca=new ModeloMarcas();

$id_marca=isset($_POST["id_marca"])? limpiarCadena($_POST["id_marca"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){

	case 'listar':
		$rspta=$marca->listar();
    //Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
        "0"=>$reg->id_marca,
 				"1"=>$reg->nombre,
        "2"=>$reg->fecha
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
