<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Habilitardscto_Permisostardanzas_Xhorasenreloj.php";

$tpx=new Habilitardscto_Permisostardanzas_Xhorasenreloj();


$id_hor_per=isset($_POST["id_hor_per"])? limpiarCadena($_POST["id_hor_per"]):"";




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


	case 'habilitar_paradscto':
		$rspta=$tpx->habilitar_paradscto($id_hor_per);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "Por Descontar" : "El descuento no se puede habilitar";
	break;

	case 'desabilitar_paradscto':
		$rspta=$tpx->desabilitar_paradscto($id_hor_per);
 		//Codificar el resultado utilizando json
 		echo $rspta ? "No se descontara" : "El descuento no se puede desabilitar";
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
			     "4"=>$reg->tiempo_des,
			     "5"=>$reg->incidencia,
			     "6"=>$reg->situacion,
			     "7"=>($reg->descontar=='1')?
 					' <button class="btn btn-danger" onclick="desabilitar_paradscto('.$reg->id_hor_per.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="habilitar_paradscto('.$reg->id_hor_per.')"><i class="fa fa-check"></i></button>'	
 		//	 "8"=>' <button class="btn btn-success" onclick="mostrar('.$reg->id_hor_per.')"><i class="fa fa-pencil"></i></button>'
 					

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