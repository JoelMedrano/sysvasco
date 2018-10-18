<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Pago_Destajeros.php";

$pago_destajeros=new Pago_Destajeros();

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//






$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";
$id_pd=isset($_POST["id_pd"])? limpiarCadena($_POST["id_pd"]):"";
$correlativo=isset($_POST["correlativo"])? limpiarCadena($_POST["correlativo"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$sueldo=isset($_POST["sueldo"])? limpiarCadena($_POST["sueldo"]):"";
$prod_soles=isset($_POST["prod_soles"])? limpiarCadena($_POST["prod_soles"]):"";
$dif_soles=isset($_POST["dif_soles"])? limpiarCadena($_POST["dif_soles"]):"";


$data_adjunta=isset($_POST["data_adjunta"])? limpiarCadena($_POST["data_adjunta"]):"";


$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		
			

			$rspta=$pago_destajeros->editar(  $id_cp,
											  $_POST["correlativo"],
											  $_POST["id_trab"],
											  $_POST["sueldo"],
											  $_POST["prod_soles"],
											  $_POST["dif_soles"],
										      $fec_reg,
											  $usu_reg,
											  $pc_reg );

			$rspta=$pago_destajeros->insertar2(   $id_cp,
												  $CantItems,
												  $_POST["correlativo"],
												  $_POST["id_trab"],
												  $_POST["sueldo"],
												  $_POST["prod_soles"],
												  $_POST["dif_soles"],
												  $fec_reg,
												  $usu_reg,
												  $pc_reg  );
			

			echo $rspta ? "Pago destajeros  actualizado" : "No se pudieron actualizar los datos del pago";
		
	break;

	case 'anular':
		$rspta=$pago_destajeros->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$pago_destajeros->mostrar($id_cp);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id_cp=$_GET['id_cp'];

		$rspta = $pago_destajeros->listarDetalle($id_cp);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="100px">Item</th>
                                    <th width="600px">Trabajador</th>
                                    <th width="200px">Sueldo</th>
                                    <th width="200px">Bono Destajo</th>
                                    <th width="200px">Produccion(S/.)</th>
                                    <th width="200px">Diferencia</th>
                                    <th width="80px">Opciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  ><td><input type="text" size="1" name="correlativo[]" value="'.$reg->correlativo.'"></td><td><input type="text" size="100" readonly name="apellidosynombres[]" value="'.$reg->apellidosynombres.'" readonly></td><td><input type="text" size="20" name="sueldo[]" value="'.$reg->sueldo.'"></td><td><input type="text" size="20" name="bono_des_trab[]" value="'.$reg->bono_des_trab.'"></td><td><input type="text" size="20" name="prod_soles[]" value="'.$reg->prod_soles.'"></td><td><input type="text" size="20" readonly name="dif_soles[]" value="'.$reg->dif_soles.'"></td><a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span></button>
                            </a></td><td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('.$cont.')">X</button></td></tr>';
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
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$pago_destajeros->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->pd,
 				"1"=>$reg->Ano,
 				"2"=>$reg->Descrip_fec_pag,
 				"3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cp.')"><i class="fa fa-pencil"></i></button>'
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

	case 'selectTrabajadoresDestajeros':
		

		$rspta=$pago_destajeros->selectTrabajadoresDestajeros();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_trab.',\''.$reg->nombres.'\',\''.$reg->sueldo.'\',\''.$reg->bono_des_trab.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_trab,
 				"2"=>$reg->nombres,
 				"3"=>$reg->sueldo,
 				"4"=>$reg->bono_des_trab
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