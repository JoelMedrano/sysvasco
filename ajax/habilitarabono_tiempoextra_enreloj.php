<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Habilitarabono_Tiempoextra_Enreloj.php";

$tpx=new Habilitarabono_Tiempoextra_Enreloj();


$id_hor_ext=isset($_POST["id_hor_ext"])? limpiarCadena($_POST["id_hor_ext"]):"";




switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($nro_doc)){
			$rspta=$tpx->insertar($id_nomtrab,$_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],
				$_POST["pen_dias"],$_POST["obser_detalle"],$_POST["vencidas"],$_POST["truncas"],$_POST["fec_del_dec"],$_POST["fec_al_dec"],$_POST["tot_dias_dec"],
				$_POST["pen_dias_dec"],$_POST["obser"]);
			echo $rspta ? "Vacacion registrada" : "No se pudieron registrar todos los datos de la vacacion";
		}
		else {
			
			

			$rspta=$tpx->editar($nro_doc, $_POST["correlativo"], $_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],$_POST["pen_dias"], $_POST["obser_detalle"], $_POST["obser"] );
			$rspta=$tpx->insertar2($nro_doc, $CantItems, $_POST["correlativo"],$_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],$_POST["pen_dias"], $_POST["obser_detalle"], $_POST["obser"] );
			


			echo $rspta ? "Vacaciones actualizadas" : "No se pudieron actualizar todos los datos de las vacaciones";
		}
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
		$rspta=$tpx->habilitar_abono($id_hor_ext);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "Por Abonar" : "El abono no se puede habilitar";
	break;

	case 'desabilitar_abono':
		$rspta=$tpx->desabilitar_abono($id_hor_ext);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "No se abonora" : "El abono no se puede desabilitar";
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
                                    <th width="100px">Trabajador</th>
                                    <th width="100px">Tiempo</th>
                                    <th width="50px">Incidencia</th>
                                    <th width="50px">Tipo.Permiso</th>
                                    <th width="700px">Motivo</th>
                                    <th width="100px">Situacion</th>
                                    <th width="100px">Estado</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S

				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  ><td><input type="text" size="1" name="id_hor_per[]" value="'.$reg->id_hor_per.'"></td><td><input type="text" size="7" name="fecha[]" value="'.$reg->fecha.'" readonly></td><td><input type="text" size="35" readonly name="nombres[]" value="'.$reg->nombres.'"></td><td><input type="text" size="7" readonly name="tiempo_des[]" value="'.$reg->tiempo_des.'"></td><td><input type="text" size="10" readonly name="incidencia[]" value="'.$reg->incidencia.'"></td><td><input type="text" size="15" readonly name="permiso[]" value="'.$reg->permiso.'"></td><td><input type="text" size="20" readonly name="motivo[]" value="'.$reg->motivo.'"></td><td><input type="text" size="15" readonly name="situacion[]" value="'.$reg->situacion.'"></td><td><input type="text" size="15" readonly name="estado[]" value="'.$reg->estado.'"></td></tr>';
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
 				 "0"=>$reg->Ano,
			     "1"=>$reg->Descrip_fec_pag,
			     "2"=>$reg->fecha,
			     "3"=>$reg->nombres,
			     "4"=>$reg->cantidad,
			     "5"=>$reg->tiempo_fin,
			     "6"=>$reg->estado_dia,
			     "7"=>$reg->observacion,
			     "8"=>$reg->situacion,
			     "9"=>($reg->abonar=='1')?
 					' <button class="btn btn-danger" onclick="desabilitar_abono('.$reg->id_hor_ext.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="habilitar_abono('.$reg->id_hor_ext.')"><i class="fa fa-check"></i></button>'	
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
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_hor_per.',\''.$reg->fecha.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_hor_per,
 				"2"=>$reg->fecha
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