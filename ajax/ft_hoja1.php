<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/FT_hoja1.php";

$mft=new FT_hoja1();

$idmft=isset($_POST["idmft"])? limpiarCadena($_POST["idmft"]):"";
$idusuario=$_SESSION["idusuario"];
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$total_cotizacion=isset($_POST["total_cotizacion"])? limpiarCadena($_POST["total_cotizacion"]):"";
$empresa=isset($_POST["empresa"])? limpiarCadena($_POST["empresa"]):"";
$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";
$color_mod=isset($_POST["color_mod"])? limpiarCadena($_POST["color_mod"]):"";
$tallas_mod=isset($_POST["tallas_mod"])? limpiarCadena($_POST["tallas_mod"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$div_mod=isset($_POST["div_mod"])? limpiarCadena($_POST["div_mod"]):"";
$temp_mod=isset($_POST["temp_mod"])? limpiarCadena($_POST["temp_mod"]):"";
$dest_mod=isset($_POST["dest_mod"])? limpiarCadena($_POST["dest_mod"]):"";
$tela1_mod=isset($_POST["tela1_mod"])? limpiarCadena($_POST["tela1_mod"]):"";
$tela2_mod=isset($_POST["tela2_mod"])? limpiarCadena($_POST["tela2_mod"]):"";
$tela3_mod=isset($_POST["tela3_mod"])? limpiarCadena($_POST["tela3_mod"]):"";
$bord_mod=isset($_POST["bord_mod"])? limpiarCadena($_POST["bord_mod"]):"";
$esta_mod=isset($_POST["esta_mod"])? limpiarCadena($_POST["esta_mod"]):"";
$manu_mod=isset($_POST["manu_mod"])? limpiarCadena($_POST["manu_mod"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$imagen2=isset($_POST["imagen2"])? limpiarCadena($_POST["imagen2"]):"";

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
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/fichas_tecnicas/" . $imagen);
      }
    }


    if (!file_exists($_FILES['imagen2']['tmp_name']) || !is_uploaded_file($_FILES['imagen2']['tmp_name']))
    {
      $imagen2=$_POST["imagenactual2"];
    }
    else
    {
      $ext = explode(".", $_FILES["imagen2"]["name"]);
      if ($_FILES['imagen2']['type'] == "image/jpg" || $_FILES['imagen2']['type'] == "image/jpeg" || $_FILES['imagen2']['type'] == "image/png")
      {
        $imagen2 = round(microtime(true)) . '.' . end($ext);
        move_uploaded_file($_FILES["imagen2"]["tmp_name"], "../files/fichas_tecnicas/" . $imagen2);
      }
    }



    if (empty($idmft)){
      $rspta=$mft->insertar(    $idusuario,
    														$fecha_hora,
    														$empresa,
    														$cod_mod,
    														$tallas_mod,
    														$temp_mod,
    														$div_mod,
    														$dest_mod,
    														$id_trab,
    														$color_mod,
    														$tela1_mod,
    														$tela2_mod,
    														$tela3_mod,
    														$bord_mod,
    														$esta_mod,
    														$manu_mod,
    														$imagen,
    														$imagen2,
                                $_POST['color']);
      echo $rspta ? "FT registrada" : "No se pudieron registrar todos los datos de la FT";
    }
    else {
      $rspta=$mft->editar(	   $idmft,
    													$id_trab,
    													$empresa,
    													$color_mod,
    													$tallas_mod,
    													$div_mod,
    													$temp_mod,
    													$dest_mod,
    													$tela1_mod,
    													$tela2_mod,
    													$tela3_mod,
    													$bord_mod,
    													$esta_mod,
    													$manu_mod,
    													$imagen,
    													$imagen2,
                              $_POST['color']);
        echo $rspta ? "FT actualizada" : "FT no se pudo actualizar";
    }
  break;


	case 'listar':
		$rspta=$mft->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){


      if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='3') {

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

  case 'selectModelos':
    require_once "../modelos/Modelo.php";
    $modelo = new Modelo();

    $rspta = $modelo->selectModelos();

    while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->cod_mod . '>' . $reg->modelo . '</option>';
        }
  break;

  case 'selectDiseñador':
    require_once "../modelos/ConsultasJ.php";
    $diseñador = new ConsultasJ();

    $rspta = $diseñador->selectDiseñador();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->id_trab . '>' . $reg->diseñador . '</option>';
        }
  break;

  case 'selectTela1':
    require_once "../modelos/ConsultasJ.php";
    $tela1 = new ConsultasJ();

    $rspta = $tela1->selectTela1();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->tela1_mod . '>' . $reg->tela . '</option>';
        }
  break;

  case 'selectTela2':
    require_once "../modelos/ConsultasJ.php";
    $tela2 = new ConsultasJ();

    $rspta = $tela2->selectTela2();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->tela2_mod . '>' . $reg->tela . '</option>';
        }
  break;

  case 'selectTela3':
    require_once "../modelos/ConsultasJ.php";
    $tela3 = new ConsultasJ();

    $rspta = $tela3->selectTela3();

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->tela3_mod . '>' . $reg->tela . '</option>';
        }
  break;

  case 'colores':
    //Obtenemos todos los permisos de la tabla permisos
    require_once "../modelos/ConsultasJ.php";
    $sonsultaj = new ConsultasJ();
    $rspta = $sonsultaj->color();

    //Obtener los permisos asignados al usuario
    $id=$_GET['id'];
    $marcados = $mft->listarmarcados($id);
    //Declaramos el array para almacenar todos los permisos marcados
    $valores=array();

    //Almacenar los permisos asignados al usuario en el array
    while ($per = $marcados->fetch_object())
      {
        array_push($valores, $per->cod_color);
      }

    //Mostramos la lista de permisos en la vista y si están o no marcados
    while ($reg = $rspta->fetch_object())
        {
          $sw=in_array($reg->cod_color,$valores)?'checked':'';
          echo '<li> <input type="checkbox" '.$sw.'  name="color[]" value="'.$reg->cod_color.'">'.$reg->color.'</li>';
        }
  break;

  case 'rechazar':
    $rspta=$mft->rechazar($idmft);
    echo $rspta ? "FT rechazada" : "FT no se puede rechazar";
  break;

  case 'aprobar':
    $rspta=$mft->aprobar($idmft,$idusuario);
    echo $rspta ? "FT aprobada" : "FT no se puede aprobar";
  break;

  case 'eliminar':
    $rspta=$mft->eliminar($idmft);
    echo $rspta ? "FT lista para eliminar" : "FT no se puede eliminar";
  break;



}
?>
