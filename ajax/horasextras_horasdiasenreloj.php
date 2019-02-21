<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Horasextras_Horasdiasenreloj.php";

$tpx=new Horasextras_Horasdiasenreloj();

$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";


$nro_doc=isset($_POST["nro_doc"])? limpiarCadena($_POST["nro_doc"]):"";
$id_nomtrab=isset($_POST["id_nomtrab"])? limpiarCadena($_POST["id_nomtrab"]):"";


$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):"";


$id_hor_ext=isset($_POST["id_hor_ext"])? limpiarCadena($_POST["id_hor_ext"]):"";
$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$tiempo_fin=isset($_POST["tiempo_fin"])? limpiarCadena($_POST["tiempo_fin"]):"";
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";
$por_pago=isset($_POST["por_pago"])? limpiarCadena($_POST["por_pago"]):"";


$num=isset($_POST["num"])? limpiarCadena($_POST["num"]):"";





switch ($_GET["op"]){
	case 'guardaryeditar':
		
			

			$rspta=$tpx->editar($id_cp, $_POST["id_hor_ext"], $_POST["tiempo_fin"], $_POST["observacion"] , $_POST["por_pago"]  );

		    $rspta=$tpx->insertar2($id_cp, $_POST["id_hor_ext"], $_POST["tiempo_fin"], $_POST["observacion"] , $_POST["por_pago"] );
			

			echo $rspta ? "Vacaciones actualizadas" : "No se pudieron actualizar todos los datos de las vacaciones";
		
	break;

	case 'anular':
		$rspta=$tpx->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$tpx->mostrar($id_cp);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'habilitar_abono':
		$rspta=$tpx->habilitar_abono($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "Por abonar" : "El abono no se puede habilitar";
	break;


	case 'desabilitar_abono':
		$rspta=$tpx->desabilitar_abono($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "No se abonara" : "El abono no se puede desabilitar";
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id=$_GET['id'];

		$rspta = $tpx->listarDetalle($id);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="40px">Item</th>
                                    <th width="100px">Fecha</th>
                                    <th width="80px">Trabajador</th>
                                    <th width="80px">Estado de Dia</th>
                                    <th width="00px">% Pago</th>
                                    <th width="100px">Tiempo</th>
                                    <th width="50px">Tie.Final</th>
                                    <th width="700px">Observacion</th>
                                    <th width="100px">Situacion</th>
                                    <th width="100px">Estado</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S

				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  <td><input type="text" size="1" autocomplete="off" name="id_hor_ext[]" value="'.$reg->id_hor_ext.'"></td><td><input type="text" size="7" name="fecha[]" value="'.$reg->fecha.'" readonly></td><td><input type="text" size="30" readonly name="nombres[]" value="'.$reg->nombres.'"></td><td><input type="text" size="10" readonly name="estado_dia[]" value="'.$reg->estado_dia.'"></td><td><input type="text" size="4"  name="por_pago[]" value="'.$reg->por_pago.'"></td><td><input type="text" size="8" readonly name="cantidad[]" value="'.$reg->cantidad.'"></td><td><input type="text" size="8" autocomplete="off" name="tiempo_fin[]" value="'.$reg->tiempo_fin.'"></td><td><input type="text" size="45" autocomplete="off" name="observacion[]" value="'.$reg->observacion.'"></td><td><input type="text" size="8" autocomplete="off" readonly name="situacion[]" value="'.$reg->situacion.'"></td><td><input type="text" size="10" readonly name="estado[]" value="'.$reg->estado.'"></td></tr>';
					//$total=$periodo;
					$cont++;
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$tpx->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				 "0"=>$reg->pd,
			     "1"=>$reg->Ano,
			     "2"=>$reg->Descrip_fec_pag,
			     "3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cp.')"><i class="fa fa-pencil"></i></button>',
			     "4"=>($reg->habilitar_abono)=='1'?'<span class="label bg-green">Habilitado</span>':
 				'<span class="label bg-red">No habilitado</span>',
			     "5"=>($reg->habilitar_abono=='1')?
 					' <button class="btn btn-danger" onclick="desabilitar_abono('.$reg->id_cp.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="habilitar_abono('.$reg->id_cp.')"><i class="fa fa-check"></i></button>'
 				);
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

	case 'selectHorasExtrasNoAbonadas':
		

		$rspta=$tpx->selectHorasExtrasNoAbonadas();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_hor_ext.',\''.$reg->fecha.'\',\''.$reg->nombres.'\',\''.$reg->estado_dia.'\', \''.$reg->por_pago.'\',	\''.$reg->cantidad.'\',	\''.$reg->tiempo_fin.'\',\''.$reg->observacion.'\', \''.$reg->situacion.'\', \''.$reg->estado.'\'  )"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_hor_ext,
 				"2"=>$reg->fecha,
 				"3"=>$reg->nombres,
 				"4"=>$reg->estado_dia, 
 				"5"=>$reg->por_pago,
 				"6"=>$reg->cantidad,
 				"7"=>$reg->tiempo_fin,
 				"8"=>$reg->observacion,
 				"9"=>$reg->situacion,
 				"10"=>$reg->estado
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