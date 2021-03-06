<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/FT_hoja3.php";

$mft=new FT_hoja3();

$idavios=isset($_POST["idavios"])? limpiarCadena($_POST["idavios"]):"";
$idmft_color=isset($_POST["idmft_color"])? limpiarCadena($_POST["idmft_color"]):"";
$avios=isset($_POST["avios"])? limpiarCadena($_POST["avios"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['avios']['tmp_name']) || !is_uploaded_file($_FILES['avios']['tmp_name'])) {
			$avios = $_POST["aviosactual_avios"];
		} else {
			$ext = explode(".", $_FILES["avios"]["name"]);
			if ($_FILES['avios']['type'] == "image/jpg" || $_FILES['avios']['type'] == "image/jpeg" || $_FILES['avios']['type'] == "image/png") {
				$avios = round(microtime(true)).
				'.'.end($ext);
				move_uploaded_file($_FILES["avios"]["tmp_name"], "../files/avios/".$avios);
			}
		}

		if (empty($idavios)){
			$rspta=$mft->insertar(	$idmft_color,
									$avios,
									$_POST["idarticulo"],
									$_POST["ubicacion"],
									$_POST["consumo"],
									$_POST["consumo_tenido"]);
			echo $rspta ? "Avios registrado" : "No se pudieron registrar todos los datos de la Avios";
		}
		else {
		}
	break;


	case 'mostrar':
		$rspta=$mft->mostrar($idavios);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $mft->listarDetalle($id);
		//$total=0;
		echo '<thead style="background-color:#A9D0F5">
									<th>Opciones</th>
									<th>Artículo</th>
									<th>Detalle</th>
									<th>Cod. Fabrica</th>
									<th>Und. Medida</th>
									<th>Ubicacion Prenda</th>
									<th>Consumo x Pda.</th>
									<th>Consumo x Pda + % Teñido</th>
									<th>Proveedor</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->descripcion.'</td><td>'.$reg->color.'</td><td>'.$reg->cod_linea.'</td><td>'.$reg->und.'</td><td>'.$reg->ubicacion.'</td><td>'.$reg->consumo.'</td><td>'.$reg->consumo_tenido.'</td><td>'.$reg->prov.'</td></tr>';
					//$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
				}
		echo '<tfoot>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$mft->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

			$url='../reportes/rptFT_hoja3.php?id=';

 			$data[]=array(

 				"0"=>$reg->idavios,
				"1"=>$reg->idmft_color,
				"2"=>$reg->idmft,
 				"3"=>$reg->cod_mod,
 				"4"=>$reg->nom_mod,
 				"5"=>$reg->cod_color,
				"6"=>$reg->color,
				"7"=>($reg->estado=='por aprobar')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idavios.')"><i class="fa fa-eye"></i></button>'.                                       
				'<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
				(($reg->estado=='rechazado')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idavios.')"><i class="fa fa-eye"></i></button>'.
				' <button class="btn btn-danger" onclick="eliminar('.$reg->idavios.')"><i class="fa fa-trash"></i></button>'.
				'<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
			  	( '<button class="btn btn-warning" onclick="mostrar('.$reg->idavios.')"><i class="fa fa-eye"></i></button>'.
				'<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'))

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'combos':
		
		$rspta = $mft->combos();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idmft_color . '>' . $reg->color . '</option>';
				}
	break;

	case 'listarMP':
		
		$rspta=$mft->listarMP();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle(\''.$reg->codpro.'\',\''.$reg->descripcion.'\',\''.$reg->color.'\',\''.$reg->cod_linea.'\',\''.$reg->und.'\',\''.$reg->prov.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->cod_linea,
 				"2"=>$reg->linea,
 				"3"=>$reg->codpro,
 				"4"=>$reg->codfab,
				"5"=>$reg->descripcion,
				"6"=>$reg->color,
				"7"=>$reg->und,
				"8"=>$reg->stock,
				"9"=>$reg->cospro,
				"10"=>$reg->prov
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