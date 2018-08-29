<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Cotizacion.php";

$cotizacion=new Cotizacion();

$idcotizacion=isset($_POST["idcotizacion"])? limpiarCadena($_POST["idcotizacion"]):"";
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

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcotizacion)){
			$rspta=$cotizacion->insertar($idusuario,
                                   $empresa,
                                   $cod_mod,
                                   $color_mod,
                                   $tallas_mod,
                                   $id_trab,
                                   $div_mod,
                                   $temp_mod,
                                   $dest_mod,
                                   $tela1_mod,
                                   $tela2_mod,
                                   $tela3_mod,
                                   $bord_mod,
                                   $esta_mod,
                                   $manu_mod,
                                   $fecha_hora,
                                   $total_cotizacion,
                                   $_POST["idarticulo"],
                                   $_POST["cantidad"],
                                   $_POST["precio_cotizacion"],
                                   $_POST["descuento"]);
			echo $rspta ? "Cotizacion registrada" : "No se pudieron registrar todos los datos de la cotizacion";
		}
		else {
		}
	break;

	case 'rechazar':
		$rspta=$cotizacion->rechazar($idcotizacion);
 		echo $rspta ? "Cotizacion rechazada" : "Cotizacion no se puede rechazar";
	break;

  case 'aprobar':
    $rspta=$cotizacion->aprobar($idcotizacion,$idusuario);
    echo $rspta ? "Cotizacion aprobada" : "Cotizacion no se puede aprobar";
  break;




  case 'noeditar':
    $rspta=$cotizacion->noeditar($idcotizacion);
    echo $rspta ? "Cotizacion cerrada" : "Cotizacion no se puede cerrar";
  break;

  case 'editar':
    $rspta=$cotizacion->editar($idcotizacion);
    echo $rspta ? "Cotizacion lista para editar" : "Cotizacion no se puede editar";
  break;


  case 'eliminar':
    $rspta=$cotizacion->eliminar($idcotizacion);
    echo $rspta ? "Cotizacion lista para eliminar" : "Cotizacion no se puede eliminar";
  break;


	case 'mostrar':
		$rspta=$cotizacion->mostrar($idcotizacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $cotizacion->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Cotizacion</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_cotizacion.'</td><td>'.$reg->descuento.'</td><td>'.$reg->subtotal.'</td></tr>';
					$total=$total+($reg->precio_cotizacion*$reg->cantidad-$reg->descuento);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_cotizacion" id="total_cotizacion"></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$cotizacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

      if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='3') {

        $data[]=array(
          "0"=>$reg->idcotizacion,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñador,
          "5"=>$reg->desarrollador,
          "6"=>$reg->total_cotizacion,
          "7"=>$reg->fecha,
          "8"=>$reg->vb,
          "9"=>($reg->estado=='por aprobar')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='rechazado')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "10"=>($reg->estado=='por aprobar')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                               ' <button class="btn btn-success" onclick="aprobar('.$reg->idcotizacion.')"><i class="fa fa-check"></i></button>'):
                 (($reg->estado=='rechazado')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                               ' <button class="btn btn-success" onclick="aprobar('.$reg->idcotizacion.')"><i class="fa fa-check"></i></button>'.
                                               ' <button class="btn btn-danger" onclick="eliminar('.$reg->idcotizacion.')"><i class="fa fa-trash"></i></button>'):
                                             ( '<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                               ' <button class="btn btn-danger" onclick="rechazar('.$reg->idcotizacion.')"><i class="fa fa-close"></i></button>')),
          "11"=>($reg->editable=="0")?'<button class="btn btn-danger" onclick="editar('.$reg->idcotizacion.')"><i class="fa fa-folder"></i></button>':' <button class="btn btn-primary" onclick="noeditar('.$reg->idcotizacion.')"><i class="fa fa-folder-open-o"></i></button>'

        );

      }else {

        $data[]=array(
          "0"=>$reg->idcotizacion,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñador,
          "5"=>$reg->desarrollador,
          "6"=>$reg->total_cotizacion,
          "7"=>$reg->fecha,
          "8"=>$reg->vb,
          "9"=>($reg->estado=='por aprobar')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='rechazado')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "10"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>':' <button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>',
          "11"=>($reg->editable=='1')?'<span class="label bg-green">PARA CORREGIR</span>':'<span class="label bg-red"></span>'

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

	case 'selectCliente':
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$rspta = $persona->listarC();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
				}
	break;


  case 'selectMod':
    require_once "../modelos/Modelo.php";
    $modelo = new Modelo();

    $rspta = $modelo->selectMod();

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

	case 'listarArticulosCotizacion':
		require_once "../modelos/ConsultasJ.php";
		$mp=new ConsultasJ();

		$rspta=$mp->selectMP();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-success" onclick="agregarDetalle(\''.$reg->idarticulo.'\',\''.$reg->nombre.'\',\''.$reg->precio.'\')"><span class="fa fa-plus"></span></button>',
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
}
?>
