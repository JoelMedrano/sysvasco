<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Cotizacion.php";

$cotizacion=new Cotizacion();

$idcotizacion=isset($_POST["idcotizacion"])? limpiarCadena($_POST["idcotizacion"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_cotizacion=isset($_POST["total_cotizacion"])? limpiarCadena($_POST["total_cotizacion"]):"";

$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcotizacion)){
			$rspta=$cotizacion->insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_cotizacion,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_cotizacion"],$_POST["descuento"]);
			echo $rspta ? "Cotizacion registrada" : "No se pudieron registrar todos los datos de la cotizacion";
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$cotizacion->anular($idcotizacion);
 		echo $rspta ? "Cotizacion anulada" : "Cotizacion no se puede anular";
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
          "9"=>($reg->estado=='POR APROBAR')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='RECHAZADO')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "10"=>($reg->estado=='POR APROBAR')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-primary" onclick="aprobar('.$reg->idcotizacion.')"><i class="fa fa-check"></i></button>'):
                 (($reg->estado=='RECHAZADO')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-primary" onclick="aprobar('.$reg->idcotizacion.')"><i class="fa fa-check"></i></button>'.
                                              ' <button class="btn btn-danger" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-trash"></i></button>'):
                                             ('<button class="btn btn-warning" onclick="mostrar('.$reg->idcotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-danger" onclick="rechazar('.$reg->idcotizacion.')"><i class="fa fa-close"></i></button>')),
          "11"=>($reg->editable=='1')?'<button class="btn btn-success" onclick="editar('.$reg->idcotizacion.')"><i class="fa fa-check"></i></button>':' <button class="btn btn-danger" onclick="noeditar('.$reg->idcotizacion.')"><i class="fa fa-close"></i></button>'

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
          "9"=>($reg->estado=='POR APROBAR')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='RECHAZADO')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
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
 				"0"=>'<button class="btn btn-success" onclick="agregarDetalle('.$reg->codigo.',\''.$reg->nombre.'\',\''.$reg->precio.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre,
        "2"=>$reg->linea,
        "3"=>$reg->unidad,
 				"4"=>$reg->codigo,
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
