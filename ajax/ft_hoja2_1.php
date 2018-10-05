<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/FT_hoja2_1.php";

$mft=new FT_hoja2_1();

$idftc=isset($_POST["idftc"])? limpiarCadena($_POST["idftc"]):"";
$idmft=isset($_POST["idmft"])? limpiarCadena($_POST["idmft"]):"";
$tela1=isset($_POST["tela1"])? limpiarCadena($_POST["tela1"]):"";


switch ($_GET["op"]){

  case 'guardaryeditar':

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
      $rspta=$mft->editar(	    $idmft,
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

        $url='../reportes/rptFichaTecnica.php?id=';

        $data[]=array(
          "0"=>$reg->idmft,
          "1"=>$reg->cod_mod,
          "2"=>$reg->com_color,
          "3"=>$reg->tela1,
          "4"=>$reg->color1,
          "5"=>$reg->tela2,
          "6"=>$reg->color2,
          "7"=>$reg->tela3,
          "8"=>$reg->color3,
          "9"=>($reg->idftc)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idftc.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idftc.')"><i class="fa fa-close"></i></button>':
          '<button class="btn btn-warning" onclick="mostrar('.$reg->idftc.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-primary" onclick="activar('.$reg->idftc.')"><i class="fa fa-check"></i></button>',

        );

      }else {

        $url='../reportes/rptCotizacion.php?id=';

        $data[]=array(
          "0"=>$reg->idmft,
          "1"=>$reg->cod_mod,
          "2"=>$reg->com_color,
          "3"=>$reg->tela1,
          "4"=>$reg->color1,
          "5"=>$reg->tela2,
          "6"=>$reg->color2,
          "7"=>$reg->tela3,
          "8"=>$reg->color3,
          "9"=>($reg->idftc)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idftc.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-danger" onclick="desactivar('.$reg->idftc.')"><i class="fa fa-close"></i></button>':
          '<button class="btn btn-warning" onclick="mostrar('.$reg->idftc.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-primary" onclick="activar('.$reg->idftc.')"><i class="fa fa-check"></i></button>',
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
    $rspta=$mft->mostrar($idftc);
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
  break;

//TODO: selelct de fichas tenicas
  case 'selectFT':
        
    $rspta = $mft->selectFT();

        echo '<option value="">SELECCIONE</option>';

        while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->idmft . '>' . $reg->modelo . '</option>';
        }
  break;

//TODO: select para combos de ft
	case 'selectCombo':
		
    $rspta = $mft->selectCombo($idmft);
    
    echo '<option value="">SELECCIONE</option>';

				while ($reg = $rspta->fetch_object())

				{
				echo '<option value=' . $reg->cod_color . '>' . $reg->color . '</option>';
				}

  break;
  
  //TODO: select para traer tela 1
  case 'selectTela1':
		
  $rspta = $mft->selectTela1($idmft);
  
    while ($reg = $rspta->fetch_object())

      {
      echo '<option value=' . $reg->tela1_mod . '>' . $reg->tela1 . '</option>';
      }

break;

  //TODO: select para traer tela 2
  case 'selectTela2':
		
  $rspta = $mft->selectTela2($idmft);
  
    while ($reg = $rspta->fetch_object())

      {
      echo '<option value=' . $reg->tela2_mod . '>' . $reg->tela2 . '</option>';
      }

break;


  //TODO: select para traer tela 3
  case 'selectTela3':
		
  $rspta = $mft->selectTela3($idmft);
  
    while ($reg = $rspta->fetch_object())

      {
      echo '<option value=' . $reg->tela3_mod . '>' . $reg->tela3 . '</option>';
      }

break;


  //TODO: select para traer colores de la tela 1
  case 'selectColor1':
		
  $rspta = $mft->selectColor1($tela1);
  
    while ($reg = $rspta->fetch_object())

      {
      echo '<option value=' . $reg->cod_color . '>' . $reg->color . '</option>';
      }

break;


}
?>
