<?php
require_once "../modelos/Modelo.php";

$modelo=new Modelo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$id_marca=isset($_POST["id_marca"])? limpiarCadena($_POST["id_marca"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){

	case 'listar':
		$rspta=$modelo->listar();
    //Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$data[]=array(
        "0"=>$reg->id_modelo,
				"1"=>$reg->nombre,
 				"2"=>$reg->codigo,
 				"3"=>$reg->cod_mod,
 				"4"=>$reg->nom_mod,
        "5"=>$reg->est_mod,
        "6"=>$reg->tip_mod,
        "7"=>$reg->lin_mod,
 				"8"=>"<img src='../files/modelos/default/anonymous.png' height='50px' width='50px' >",
        "9"=>$reg->pb_mod,
        "10"=>$reg->fec_cre
      );
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectMarca":
		require_once "../modelos/Marca.php";

		$marca = new ModeloMarcas();

		$rspta = $marca->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_marca . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectTipo":
		require_once "../modelos/Modelo.php";

		$tipo = new Modelo();

		$rspta = $tipo->selectTipo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tip_mod . '>' . $reg->tip_mod . '</option>';
				}
	break;


}
?>
