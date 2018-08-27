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

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idventa)){
			$rspta=$vacaciones->insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"]);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
		}
		else {
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
		echo '<thead style="background-color:#A9D0F5">
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
                                    <th width="50px">Opciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td>'.$reg->PeridoAnual.'</td><td>'.$reg->fec_del.'</td><td>'.$reg->fec_al.'</td><td>'.$reg->tot_dias.'</td><td>'.$reg->pen_dias.'</td><td>'.$reg->obser_detalle.'</td><td>'.$reg->vencidas.'</td><td>'.$reg->truncas.'</td><td>'.$reg->fec_del_dec.'</td><td>'.$reg->fec_al_dec.'</td><td>'.$reg->tot_dias_dec.'</td><td>'.$reg->pen_dias_dec.'</td><td>'.$reg->obser.'</td><td></td></tr>';
					$total=$periodo;
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
 				"1"=>$reg->sucursal_anexo,
 				"2"=>$reg->area,
 				"3"=>$reg->funcion,
 				"4"=>$reg->nombres,
 				"5"=>($reg->est_reg=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>',
 				"6"=>(($reg->est_reg=='Aceptado')?'<button class="btn btn-warning" onclick="mostrar('.$reg->nro_doc.')"><i class="fa fa-eye"></i></button>'.
 					' <button class="btn btn-danger" onclick="anular('.$reg->nro_doc.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->nro_doc.')"><i class="fa fa-eye"></i></button>').
 					'<a target="_blank" href="'.$url.$reg->nro_doc.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>'
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