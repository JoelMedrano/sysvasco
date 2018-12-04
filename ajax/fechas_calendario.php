<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Fechas_Calendario.php";

$fc=new Fechas_Calendario();
$idusuario=$_SESSION["idusuario"];


$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
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


$num=isset($_POST["num"])? limpiarCadena($_POST["num"]):"";


//$ano=isset($_POST["ano"])? limpiarCadena($_POST["ano"]):"";

$id_ano=isset($_POST["id_ano"])? limpiarCadena($_POST["id_ano"]):"";

$ano=isset($_POST["ano"])? limpiarCadena($_POST["ano"]):"";


$IdValidar=isset($_POST["IdValidar"])? limpiarCadena($_POST["IdValidar"]):"";





$dato=$fc->traerfechasdeintervalo($id_ano);
$regc=$dato->fetch_object();
$fecha_desde=$regc->fecha_desde;
$fecha_hasta=$regc->fecha_hasta;
$ano=$regc->ano;




switch ($_GET["op"]){
	case 'guardaryeditar':
		

			if ($IdValidar==''){
		    $rspta=$fc->insertar($fecha_desde, $fecha_hasta);
		    $rspta=$fc->actualizar($fecha_desde, $fecha_hasta);
		    $rspta=$fc->actualizar_nolaborables($fecha_desde, $fecha_hasta);
		    echo $rspta ? "Se Creo el Calendario Anual, Falta Actualizar los FERIADOS" : "No se pudo crear el calendario anual";


			}
		    else{
		    $rspta=$fc->editar($_POST["fecha"],$_POST["estado"]);
		    echo $rspta ? "Se actualizo el calendario anual" : "No se pudo actualizar el calendario anual";

		    }
			
		
	break;

	case 'anular':
		$rspta=$fc->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$fc->mostrar($id_ano);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'habilitar_abono':
		$rspta=$fc->habilitar_abono($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "Por abonar" : "El abono no se puede habilitar";
	break;


	case 'desabilitar_abono':
		$rspta=$fc->desabilitar_abono($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "No se abonara" : "El abono no se puede desabilitar";
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id=$_GET['id'];

		$rspta = $fc->listarDetalle($id);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="150px">Fecha</th>
                                    <th width="100px">Año</th>
                                    <th width="100px">Mes</th>
                                    <th width="80px">(#)Dia</th>
                                    <th width="200px">(Des.Larga)Dia</th>
                                    <th width="400px">Estado</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S

				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  <td><input type="text" size="15" autocomplete="off"  readonly name="fecha[]" value="'.$reg->fecha.'"></td><td><input type="text" size="5" name="ano[]" value="'.$reg->ano.'" readonly></td><td><input type="text" size="20" readonly name="MesLargo[]" value="'.$reg->MesLargo.'"></td><td><input type="text" size="10" readonly name="dia[]" value="'.$reg->dia.'"></td><td><input type="text" size="25" readonly name="nom_dia[]" value="'.$reg->nom_dia.'"></td><td><input type="text" size="75"  name="estado[]" value="'.$reg->estado.'"></td></tr>';
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
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$fc->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				 "0"=>$reg->ano,
			     "1"=>$reg->ano,
			     "2"=>$reg->ano,
			     "3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ano.')"><i class="fa fa-pencil"></i></button>',
			     "4"=>($reg->ano)=='1'?'<span class="label bg-green">Habilitado</span>':
 				'<span class="label bg-red">No habilitado</span>',
			     "5"=>($reg->ano=='1')?
 					' <button class="btn btn-danger" onclick="desabilitar_abono('.$reg->ano.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="habilitar_abono('.$reg->ano.')"><i class="fa fa-check"></i></button>'
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
		

		$rspta=$fc->selectHorasExtrasNoAbonadas();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_hor_ext.',\''.$reg->fecha.'\',\''.$reg->nombres.'\',\''.$reg->estado_dia.'\',\''.$reg->cantidad.'\',\''.$reg->tiempo_fin.'\',\''.$reg->observacion.'\', \''.$reg->situacion.'\', \''.$reg->estado.'\'  )"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_hor_ext,
 				"2"=>$reg->fecha,
 				"3"=>$reg->nombres,
 				"4"=>$reg->estado_dia, 
 				"5"=>$reg->cantidad,
 				"6"=>$reg->tiempo_fin,
 				"7"=>$reg->observacion,
 				"8"=>$reg->situacion,
 				"9"=>$reg->estado
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