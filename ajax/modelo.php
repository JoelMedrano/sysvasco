<?php

if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Modelo.php";

$modelo=new Modelo();

$id_modelo=isset($_POST["id_modelo"])? limpiarCadena($_POST["id_modelo"]):"";
$id_marca=isset($_POST["id_marca"])? limpiarCadena($_POST["id_marca"]):"";
$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";
$nom_mod=isset($_POST["nom_mod"])? limpiarCadena($_POST["nom_mod"]):"";
$tip_mod=isset($_POST["tip_mod"])? limpiarCadena($_POST["tip_mod"]):"";
$lin_mod=isset($_POST["lin_mod"])? limpiarCadena($_POST["lin_mod"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$pv_mod=isset($_POST["pv_mod"])? limpiarCadena($_POST["pv_mod"]):"";
$cmp_mod=isset($_POST["cmp_mod"])? limpiarCadena($_POST["cmp_mod"]):"";
$idusuario=$_SESSION["idusuario"];

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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/modelos/" . $imagen);
			}
		}


		if (empty($id_modelo)){
			$rspta=$modelo->insertar($id_marca,$cod_mod,$nom_mod,$tip_mod,$lin_mod,$imagen,$pv_mod,$cmp_mod,$idusuario);
			echo $rspta ? "Modelo registrado" : "Modelo no se pudo registrar";
		}
		else {
			$rspta=$modelo->editar($id_modelo,$id_marca,$cod_mod,$nom_mod,$tip_mod,$lin_mod,$imagen,$pv_mod,$cmp_mod,$idusuario);
			echo $rspta ? "Modelo actualizado" : "Modelo no se pudo actualizar";
		}
	break;

	case 'listar':
		$rspta=$modelo->listar();
    //Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

        $data[]=array(
          "0"=>$reg->id_modelo,
          "1"=>$reg->nombre,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>($reg->est_mod==1)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Inactivo</span>',
          "5"=>$reg->tip_mod,
          "6"=>$reg->lin_mod,
          "7"=>($reg->imagen!='')?"<img src='../files/modelos/".$reg->imagen."' height='50px' width='50px'>":"<img src='../files/modelos/anonymous.png' height='50px' width='50px'>",
          "8"=>$reg->pv_mod,
          "9"=>$reg->fec_cre,
          "10"=>($reg->est_mod==1)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_modelo.')"><i class="fa fa-pencil"></i></button>'.
              ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_modelo.')"><i class="fa fa-close"></i></button>':
              '<button class="btn btn-warning" onclick="mostrar('.$reg->id_modelo.')"><i class="fa fa-pencil"></i></button>'.
              ' <button class="btn btn-success" onclick="activar('.$reg->id_modelo.')"><i class="fa fa-check"></i></button>'


        );


 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'mostrar':
		$rspta=$modelo->mostrar($id_modelo);
		//Codificar el resultado utilizando json
		echo json_encode($rspta);
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

	case 'desactivar':
		$rspta=$modelo->desactivar($id_modelo);
		echo $rspta ? "Modelo Desactivado" : "Modelo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$modelo->activar($id_modelo);
		echo $rspta ? "Modelo activado" : "Modelo no se puede activar";
	break;


}
?>
