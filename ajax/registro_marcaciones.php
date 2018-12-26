<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Registro_Marcaciones.php";

$rm=new Registro_Marcaciones();

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

				$rspta=$contratos->editar( $id_trab,
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
									<th width="40px">Item</th>
                                    <th width="100px">Periodo</th>
                                    <th width="100px">Del</th>
                                    <th width="100px">Al</th>
                                    <th width="50px">Total Dias</th>
                                    <th width="50px">Dias Pend</th>
                                    <th width="700px">Obser Detalle</th>
                                    <th width="200px" >Observaciones</th>
                                    <th width="50px">Editar</th>
                                    <th width="50px">Opciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  ><td><input type="text" size="1" name="correlativo[]" value="'.$reg->correlativo.'"></td><td><input type="text" size="7" name="PeridoAnual[]" value="'.$reg->PeridoAnual.'" readonly></td><td><input type="date" size="8" name="fec_del[]" value="'.$reg->fec_del.'"></td><td><input type="date" size="8" name="fec_al[]" value="'.$reg->fec_al.'"></td><td><input type="text" size="1" name="tot_dias[]" value="'.$reg->tot_dias.'"></td><td><input type="text" size="1" name="pen_dias[]" value="'.$reg->pen_dias.'"></td><td><input type="text" size="100" name="obser_detalle[]" value="'.$reg->obser_detalle.'"></td><td><input type="text" size="25" name="obser[]" value="'.$reg->obser.'"></td><td><a data-toggle="modal" href="#myModal">
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

	$fecha_inicio=$_REQUEST["fecha_inicio"];
	$fecha_fin=$_REQUEST["fecha_fin"];
	$id_trab=$_REQUEST["id_trab"];

		$rspta=$rm->listar($fecha_inicio,$fecha_fin,$id_trab);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->mar,
 				"1"=>$reg->nom_dia,
 				"2"=>$reg->Fecha,
 				"3"=>$reg->sucursal_anexo,
 				"4"=>$reg->nombres,
 				"5"=>$reg->area_trab,
 				"6"=>$reg->hor_ent_sal,
 				"7"=>$reg->detalle,
 				"8"=>$reg->horas_extras,
 				"9"=>$reg->horas_faltas,
 				"10"=>$reg->min_tardanza

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

	case 'selectTrab':

	require_once "../modelos/ConsultasJ.php";

	$con = new ConsultasJ();

	echo '<option value="">SELECCIONE</option>';

	$rspta = $con->selectTrab();

	while ($reg = $rspta->fetch_object())
			{
			echo '<option value=' . $reg->id_trab . '>' . $reg->trabajador . '</option>';
			}
	break;


	
}
?>