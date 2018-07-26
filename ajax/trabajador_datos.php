<?php 

require_once "../modelos/Trabajador_Datos.php";

$trabajador_datos=new Trabajador_Datos();

$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$id_funcion=isset($_POST["id_funcion"])? limpiarCadena($_POST["id_funcion"]):"";
$id_area=isset($_POST["id_area"])? limpiarCadena($_POST["id_area"]):"";
$id_tip_doc=isset($_POST["id_tip_doc"])? limpiarCadena($_POST["id_tip_doc"]):"";
$id_tip_plan=isset($_POST["id_tip_plan"])? limpiarCadena($_POST["id_tip_plan"]):"";

$nom_trab=isset($_POST["nom_trab"])? limpiarCadena($_POST["nom_trab"]):"";
$apepat_trab=isset($_POST["apepat_trab"])? limpiarCadena($_POST["apepat_trab"]):"";
$apemat_trab=isset($_POST["apemat_trab"])? limpiarCadena($_POST["apemat_trab"]):"";

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["op"]){


	case 'mostrarDatos':
		$rspta=$trabajador_datos->mostrarDatos($id_trab);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;




}
?>