<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Hoja_Cotizacion.php";

$hoja_cotizacion=new HojaCotizacion();


$idhojacotizacion=isset($_POST["idhojacotizacion"])? limpiarCadena($_POST["idhojacotizacion"]):"";
$cod_mod=isset($_POST["cod_mod"])? limpiarCadena($_POST["cod_mod"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$color_mod=isset($_POST["color_mod"])? limpiarCadena($_POST["color_mod"]):"";

$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idventa)){
			$rspta=$venta->insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"]);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$venta->anular($idventa);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$hoja_cotizacion->mostrar($idhojacotizacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $venta->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->descuento.'</td><td>'.$reg->subtotal.'</td></tr>';
					$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
				}
		echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/.'.$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$hoja_cotizacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

      if ($_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='11') {

        $data[]=array(
          "0"=>$reg->idhojacotizacion,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñado,
          "5"=>$reg->elaborado,
          "6"=>$reg->costo,
          "7"=>$reg->fec_creacion,
          "8"=>$reg->vb,
          "9"=>($reg->estado=='POR APROBAR')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='RECHAZADO')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
          "10"=>($reg->estado=='POR APROBAR')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-primary" onclick="aprobar('.$reg->idhojacotizacion.')"><i class="fa fa-check"></i></button>'):
                 (($reg->estado=='RECHAZADO')?('<button class="btn btn-warning" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-primary" onclick="aprobar('.$reg->idhojacotizacion.')"><i class="fa fa-check"></i></button>'.
                                              ' <button class="btn btn-danger" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-trash"></i></button>'):
                                             ('<button class="btn btn-warning" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-eye"></i></button>'.
                                              ' <button class="btn btn-danger" onclick="rechazar('.$reg->idhojacotizacion.')"><i class="fa fa-close"></i></button>')),
          "11"=>($reg->editable=='1')?'<button class="btn btn-success" onclick="editar('.$reg->idhojacotizacion.')"><i class="fa fa-check"></i></button>':' <button class="btn btn-danger" onclick="noeditar('.$reg->idhojacotizacion.')"><i class="fa fa-close"></i></button>'



          );
      }else {

        $data[]=array(
          "0"=>$reg->idhojacotizacion,
          "1"=>$reg->marca,
          "2"=>$reg->cod_mod,
          "3"=>$reg->nom_mod,
          "4"=>$reg->diseñado,
          "5"=>$reg->elaborado,
          "6"=>$reg->costo,
          "7"=>$reg->fec_creacion,
          "8"=>$reg->vb,
          "9"=>($reg->estado=='POR APROBAR')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='RECHAZADO')?('<span class="label bg-red">Rechazadp</span>'):('<span class="label bg-green">Aprobado</span>')),
          "10"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-eye"></i></button>':' <button class="btn btn-warning" onclick="mostrar('.$reg->idhojacotizacion.')"><i class="fa fa-eye"></i></button>',
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

        echo '<option>SELECCIONE</option>';

    while ($reg = $rspta->fetch_object())

        {
        echo '<option value=' . $reg->id_trab . '>' . $reg->diseñado . '</option>';
        }
  break;

	case 'listarArticulosVenta':
		require_once "../modelos/Articulo.php";
		$articulo=new Articulo();

		$rspta=$articulo->listarActivosVenta();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\',\''.$reg->precio_venta.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>$reg->precio_venta,
 				"6"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >"
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
