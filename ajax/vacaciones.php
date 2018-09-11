<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Vacaciones.php";

$vacaciones=new Vacaciones();

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


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($nro_doc)){
			$rspta=$vacaciones->insertar($id_nomtrab,$_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],
				$_POST["pen_dias"],$_POST["obser_detalle"],$_POST["vencidas"],$_POST["truncas"],$_POST["fec_del_dec"],$_POST["fec_al_dec"],$_POST["tot_dias_dec"],
				$_POST["pen_dias_dec"],$_POST["obser"]);
			echo $rspta ? "Vacacion registrada" : "No se pudieron registrar todos los datos de la vacacion";
		}
		else {
			$rspta=$vacaciones->editar($nro_doc,$_POST["correlativo"],$_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],$_POST["pen_dias"]);
			echo $rspta ? "Vacaciones actualizadas" : "No se pudieron actualizar todos los datos de las vacaciones";
		}
	break;

	case 'anular':
		$rspta=$vacaciones->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$vacaciones->mostrar($nro_doc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id=$_GET['id'];

		$rspta = $vacaciones->listarDetalle($id);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="40px">Item</th>
                                    <th width="100px">Periodo</th>
                                    <th width="70px">Del</th>
                                    <th width="70px">Al</th>
                                    <th width="40px">Total Dias</th>
                                    <th width="40px">Dias Pend</th>
                                    <th width="150px">Obser Detalle</th>
                                    <th width="50px">Vencidas</th>
                                    <th width="50px">Truncas</th>
                                    <th width="50px">Inicio</th>
                                    <th width="50px">Salida</th>
                                    <th width="40px">Tot.Dias</th>
                                    <th width="40px">Dias Pend</th>
                                    <th width="150px" >Observaciones</th>
                                    <th width="50px">Editar</th>
                                    <th width="50px">Opciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  ><td>'.$reg->correlativo.'</td><td>'.$reg->PeridoAnual.'</td><td>'.$reg->fec_del.'</td><td>'.$reg->fec_al.'</td><td>'.$reg->tot_dias.'</td><td>'.$reg->pen_dias.'</td><td>'.$reg->obser_detalle.'</td><td>'.$reg->vencidas.'</td><td>'.$reg->truncas.'</td><td>'.$reg->fec_del_dec.'</td><td>'.$reg->fec_al_dec.'</td><td>'.$reg->tot_dias_dec.'</td><td>'.$reg->pen_dias_dec.'</td><td>'.$reg->obser.'</td><td><a data-toggle="modal" href="#myModal">
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
		$rspta=$vacaciones->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->id_trab,
 				"1"=>$reg->num_doc_trab,
 				"2"=>$reg->sucursal_anexo,
 				"3"=>$reg->area_trab,
 				"4"=>$reg->funcion,
 				"5"=>$reg->nombres,
 				"6"=>($reg->est_reg=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>',
 				"7"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->nro_doc.')"><i class="fa fa-pencil"></i></button>',
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