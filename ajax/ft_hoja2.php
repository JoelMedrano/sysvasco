<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/FT_hoja2.php";

$mft=new FT_hoja2();

$idmft=isset($_POST["idmft"])? limpiarCadena($_POST["idmft"]):"";
$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";
$nom_mod=isset($_POST["nom_mod"])? limpiarCadena($_POST["nom_mod"]):"";
$molde=isset($_POST["molde"])? limpiarCadena($_POST["molde"]):"";
$idusuario=$_SESSION["idusuario"];


switch ($_GET["op"]){

  case 'guardaryeditar':

    if (!file_exists($_FILES['molde']['tmp_name']) || !is_uploaded_file($_FILES['molde']['tmp_name']))
    {
      $molde=$_POST["moldeactual_molde"];
    }
    else
    {
      $ext = explode(".", $_FILES["molde"]["name"]);
      if ($_FILES['molde']['type'] == "image/jpg" || $_FILES['molde']['type'] == "image/jpeg" || $_FILES['molde']['type'] == "image/png")
      {
        $molde = round(microtime(true)) . '.' . end($ext);
        move_uploaded_file($_FILES["molde"]["tmp_name"], "../files/moldes/" . $molde);
      }
    }

		if (($idmft>0)){
      $rspta=$mft->insertar(       $idmft,
                                   $molde,
                                   $_POST["idarticulo"],
                                   $_POST["desc_pieza"],
                                   $_POST["cant_pieza"],
                                   $_POST["sent_tela"],
                                   $_POST["tapete"],
                                   $_POST["collareta"],
                                   $_POST["consumo"],
                                   $_POST["tono"],
                                   $_POST["observaciones"]);
			echo $rspta ? "Detalle registrado" : "No se pudieron registrar todos los datos del detalle";
		}
		else {
		}
	break;

	case 'listar':
		$rspta=$mft->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){


      if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='3') {

        $url='../reportes/rptFT_hoja2.php?id=';

        $data[]=array(
          "0"=>$reg->idmft,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñador,
          "5"=>$reg->desarrollador,
          "6"=>$reg->fecha,
          "7"=>$reg->vb,
          "8"=>($reg->estado=='por aprobar')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='rechazado')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "9"=>($reg->estado=='por aprobar')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.
                                              
                                               '<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
                 (($reg->estado=='rechazado')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.
                                               
                                               ' <button class="btn btn-danger" onclick="eliminar('.$reg->idmft.')"><i class="fa fa-trash"></i></button>'.
                                               '<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
                                             ( '<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.
                                               
                                               '<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'))

        );

      }else {

        $url='../reportes/rptCotizacion.php?id=';

        $data[]=array(
          "0"=>$reg->idmft,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñador,
          "5"=>$reg->desarrollador,
          "6"=>$reg->fecha,
          "7"=>$reg->vb,
          "8"=>($reg->estado=='por aprobar')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='rechazado')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "9"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.'<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>':' <button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.'<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'

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

  case 'mostrar':
    $rspta=$mft->mostrar($idmft);
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
  break;

  case 'selectFT':
  require_once "../modelos/FT_hoja2.php";
  
  $rspta = $mft->selectFT();

  while ($reg = $rspta->fetch_object())

      {
      echo '<option value=' . $reg->cod_mod . '>' . $reg->ftmod . '</option>';
      }
break;

case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $mft->listarDetalle($id);
		
    echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Telas</th>
                                    <th>Desc. Pieza</th>
                                    <th>Cantidad</th>
                                    <th>Sentido Tela</th>
                                    <th>Tapete</th>
                                    <th>Collareta</th>
                                    <th>Consumo</th>
                                    <th>Tonalidad</th>
                                    <th>Observaciones</th>
                                    <th>Consumo Por Prenda</th>
          </thead>';

		while ($reg = $rspta->fetch_object())
				{
          echo '<tr class="filas">
                  <td></td>
                  <td>'.$reg->nombre.'</td>
                  <td>'.$reg->desc_pieza.'</td>
                  <td>'.$reg->cant_pieza.'</td>
                  <td>'.$reg->sent_tela.'</td>
                  <td>'.$reg->tapete.'</td>
                  <td>'.$reg->collareta.'</td>
                  <td>'.$reg->consumo.'</td>
                  <td>'.$reg->tono.'</td>
                  <td>'.$reg->observaciones.'</td>
                  <td>'.$reg->subtotal.'</td>
                </tr>';
					
				}
    echo '<tfoot>
                                    <th>Opciones</th>
                                    <th>Telas</th>
                                    <th>Desc. Pieza</th>
                                    <th>Cantidad</th>
                                    <th>Sentido Tela</th>
                                    <th>Tapete</th>
                                    <th>Collareta</th>
                                    <th>Consumo</th>
                                    <th>Tonalidad</th>
                                    <th>Observaciones</th>
                                    <th>Consumo Por Prenda</th>
            </tfoot>';
  break;
  
  case 'listarArticulosFicha':
  require_once "../modelos/ConsultasJ.php";
  $mp=new ConsultasJ();

  $rspta=$mp->selectMP();
   //Vamos a declarar un array
   $data= Array();

   while ($reg=$rspta->fetch_object()){
     $data[]=array(
       "0"=>'<button class="btn btn-success" onclick="agregarDetalle(\''.$reg->idarticulo.'\',\''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
       "1"=>$reg->nombre,
       "2"=>$reg->linea,
       "3"=>$reg->unidad,
       "4"=>$reg->idarticulo,
       "5"=>$reg->precio
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
$rspta=$mft->eliminar($idmft);
echo $rspta ? "FT lista para eliminar" : "FT no se puede eliminar";
break;



}
?>
