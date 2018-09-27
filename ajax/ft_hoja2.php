<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/FT_hoja2.php";

$mft=new FT_hoja2();

$idmft=isset($_POST["idmft"])? limpiarCadena($_POST["idmft"]):"";
$idusuario=$_SESSION["idusuario"];


switch ($_GET["op"]){

	case 'listar':
		$rspta=$mft->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){


      if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='3') {

        $url='../reportes/rptFichaTecnica.php?id=';

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
                                               ' <button class="btn btn-success" onclick="aprobar('.$reg->idmft.')"><i class="fa fa-check"></i></button>'.
                                               '<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
                 (($reg->estado=='rechazado')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.
                                               ' <button class="btn btn-success" onclick="aprobar('.$reg->idmft.')"><i class="fa fa-check"></i></button>'.
                                               ' <button class="btn btn-danger" onclick="eliminar('.$reg->idmft.')"><i class="fa fa-trash"></i></button>'.
                                               '<a target="_blank" href="'.$url.$reg->idmft.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'):
                                             ( '<button class="btn btn-warning" onclick="mostrar('.$reg->idmft.')"><i class="fa fa-eye"></i></button>'.
                                               ' <button class="btn btn-danger" onclick="rechazar('.$reg->idmft.')"><i class="fa fa-close"></i></button>'.
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





}
?>
