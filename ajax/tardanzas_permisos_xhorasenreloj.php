<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Tardanzas_Permisos_Xhorasenreloj.php";

$tpx=new Tardanzas_Permisos_Xhorasenreloj();

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

$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		

			$rspta=$tpx->editar($id_cp, $_POST["id_hor_per"], $_POST["tiempo_fin"], $_POST["observacion"] );
			


			echo $rspta ? "Actualizado" : "No se pudieron actualizar los datos";
		
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


	case 'habilitar_descuento':
		$rspta=$tpx->habilitar_descuento($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "Por descontar" : "El descuento no se puede habilitar";
	break;


	case 'desabilitar_descuento':
		$rspta=$tpx->desabilitar_descuento($id_cp);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "No se descuentara" : "El descuento no se puede desabilitar";
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
                                    <th width="100px">Tiempo</th>
                                    <th width="100px">Tie.Fin</th>
                                    <th width="50px">Incidencia</th>
                                    <th width="50px">Tipo.Permiso</th>
                                    <th width="700px">Observacion</th>
                                    <th width="100px">Situacion</th>
                                    <th width="100px">Estado</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S

				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  ><td><input type="text" size="1" readonly name="id_hor_per[]" value="'.$reg->id_hor_per.'"></td><td><input type="text" size="7" name="fecha[]" value="'.$reg->fecha.'" readonly></td><td><input type="text" size="30" readonly name="nombres[]" value="'.$reg->nombres.'"></td><td><input type="text" size="7" readonly name="tiempo_des[]" value="'.$reg->tiempo_des.'"></td><td><input type="text" size="7"  name="tiempo_fin[]" value="'.$reg->tiempo_fin.'"></td><td><input type="text" size="10" readonly name="incidencia[]" value="'.$reg->incidencia.'"></td><td><input type="text" size="15" readonly name="permiso[]" value="'.$reg->permiso.'"></td><td><input type="text" size="25"  name="observacion[]" value="'.$reg->observacion.'"></td><td><input type="text" size="15" readonly name="situacion[]" value="'.$reg->situacion.'"></td><td><input type="text" size="15" readonly name="estado[]" value="'.$reg->estado.'"></td></tr>';
					$total=$periodo;
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
			     "4"=>($reg->habilitar_dscto)=='1'?'<span class="label bg-green">Habilitado</span>':
 				'<span class="label bg-red">No habilitado</span>',
			     "5"=>($reg->habilitar_dscto=='1')?
 					' <button class="btn btn-primary" onclick="desabilitar_descuento('.$reg->id_cp.')"><i class="fa fa-check"></i></button>':
 					' <button class="btn btn-danger" onclick="habilitar_descuento('.$reg->id_cp.')"><i class="fa fa-close"></i></button>'
 					
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

	case 'selectPermisosTardanzasNoDescontadas':
		

		$rspta=$tpx->selectPermisosTardanzasNoDescontadas();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_hor_per.',\''.$reg->fecha.'\',\''.$reg->nombres.'\',\''.$reg->tiempo_des.'\',\''.$reg->tiempo_fin.'\',\''.$reg->incidencia.'\',\''.$reg->permiso.'\',\''.$reg->observacion.'\',\''.$reg->situacion.'\',\''.$reg->estado.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_hor_per,
 				"2"=>$reg->fecha,
 				"3"=>$reg->nombres,
 				"4"=>$reg->tiempo_des,
 				"5"=>$reg->tiempo_fin,
 				"6"=>$reg->incidencia,
 				"7"=>$reg->permiso,
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