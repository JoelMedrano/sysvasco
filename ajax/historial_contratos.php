<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Historial_Contratos.php";

$contratos=new Historial_Contratos();

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
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";



$id_con_trab=isset($_POST["id_con_trab"])? limpiarCadena($_POST["id_con_trab"]):"";
$tie_ren_ant=isset($_POST["tie_ren_ant"])? limpiarCadena($_POST["tie_ren_ant"]):"";
$fec_ini_ant=isset($_POST["fec_ini_ant"])? limpiarCadena($_POST["fec_ini_ant"]):"";
$fec_fin_ant=isset($_POST["fec_fin_ant"])? limpiarCadena($_POST["fec_fin_ant"]):"";
$id_sit_inf_ant=isset($_POST["id_sit_inf_ant"])? limpiarCadena($_POST["id_sit_inf_ant"]):"";

$tie_ren_con=isset($_POST["tie_ren_con"])? limpiarCadena($_POST["tie_ren_con"]):"";
$fec_ini_con=isset($_POST["fec_ini_con"])? limpiarCadena($_POST["fec_ini_con"]):"";
$fec_fin_con=isset($_POST["fec_fin_con"])? limpiarCadena($_POST["fec_fin_con"]):"";
$id_sit_inf_act=isset($_POST["id_sit_inf_act"])? limpiarCadena($_POST["id_sit_inf_act"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($tie_ren_con)){

				$rspta=$contratos->editar($id_trab,
										   $id_con_trab,
										   $tie_ren_ant,
										   $fec_ini_ant,
										   $fec_fin_ant,
										   $id_sit_inf_ant,
										   $usu_reg,
										   $pc_reg,
										   $fec_reg 
									 );

			
			echo $rspta ? "Contrato actualizado" : "No se pudieron actualizar todos los datos del contrato"; 


		}
		else {


			$rspta=$contratos->insertar2($id_trab,
										 $tie_ren_con,
										 $fec_ini_con,
										 $fec_fin_con,
										 $id_sit_inf_act,
										 $CantItems,
										 $usu_reg,
										 $pc_reg,
										 $fec_reg 
										 );

										
			
			

			echo $rspta ? "Contrato registrado" : "Contrato no se pudo registrar";
			
		}


	break;

	case 'anular':
		$rspta=$contratos->anular($nro_doc);
 		echo $rspta ? "Contrato anulada" : "Contrato no se puede anular";
	break;

	case 'mostrar':
		$rspta=$contratos->mostrar($nro_doc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		
		$id=$_GET['id'];

		$rspta = $contratos->listarDetalle($id);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="10px">Item</th>
                                    <th width="50px">Fecha Desde</th>
                                    <th width="50px">Fecha Hasta</th>
                                    <th width="30px">Meses Renovados</th>
                                    <th width="100px">Situacion Informativa</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  >
					<td><input type="text" size="10" name="correlativo[]" value="'.$reg->correlativo.'"></td>
					<td><input type="text" size="30" name="PeridoAnual[]" value="'.$reg->fec_ini_con.'" readonly></td>
					<td><input type="text" size="30" name="fec_del[]" value="'.$reg->fec_fin_con.'"></td>
					<td><input type="text" size="30" name="fec_al[]" value="'.$reg->tie_ren_ant.'"></td>
					<td><input type="text" size="50" name="pen_dias[]" value="'.$reg->situacion_informativa_actual.'"></td>
                    </tr>';
					$total=$periodo;
					$cont++;
				}
		echo '<tfoot>
                                    
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$contratos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->est_reg,
 				"1"=>$reg->sucursal_anexo,
 				"2"=>$reg->area_trab,
 				"3"=>$reg->funcion,
 				"4"=>$reg->nombres,
 				"5"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->nro_doc.')"><i class="fa fa-pencil"></i></button>',
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

	case 'selectPeriodosVacaciones':
		require_once "../modelos/ConsultasD.php";
		$consultasD=new ConsultasD();

		$rspta=$consultasD->selectPeriodosVacaciones();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->id_periodo.',\''.$reg->periodo.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->id_periodo,
 				"2"=>$reg->periodo
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