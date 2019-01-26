<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Vacaciones.php";

$vacaciones=new Vacaciones();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//

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




switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($nro_doc)){
			$rspta=$vacaciones->insertar($id_nomtrab,$_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],
				$_POST["pen_dias"],$_POST["obser_detalle"],$_POST["vencidas"],$_POST["truncas"],$_POST["fec_del_dec"],$_POST["fec_al_dec"],$_POST["tot_dias_dec"],
				$_POST["pen_dias_dec"],$_POST["obser"] ,   $usu_reg, $fec_reg, $pc_reg );
			echo $rspta ? "Vacacion registrada" : "No se pudieron registrar todos los datos de la vacacion";
		}

		else {
			
			
			$rspta=$vacaciones->editar($nro_doc, $_POST["correlativo"], $_POST["id_periodo"],$_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],$_POST["pen_dias"], $_POST["obser_detalle"], $_POST["obser"],   $usu_reg, $fec_reg, $pc_reg );
		    $rspta=$vacaciones->insertar2($nro_doc, $CantItems, $_POST["correlativo"], $_POST["id_periodo"], $_POST["fec_del"],$_POST["fec_al"],$_POST["tot_dias"],$_POST["pen_dias"], $_POST["obser_detalle"], $_POST["obser"],   $usu_reg, $fec_reg, $pc_reg );
			


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
                                    <th width="80px">Del</th>
                                    <th width="80px">Al</th>
                                    <th width="50px">Total Dias</th>
                                    <th width="50px">Dias Pend</th>
                                    <th width="500px">Observaciones</th>
                                    <th width="100px">Periodo</th>
                                    <th width="50px">Eliminar</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  >
					  <td><input type="text" readonly size="1" name="correlativo[]" value="'.$reg->correlativo.'"></td>
					  <td><input type="text"  readonly size="7" name="id_periodo[]" value="'.$reg->PeridoAnual.'" readonly></td>
					  <td><input type="date" size="5" name="fec_del[]" value="'.$reg->fec_del.'"></td>
					  <td><input type="date" size="5" name="fec_al[]" value="'.$reg->fec_al.'"></td>
					  <td><input type="text" size="1"  autocomplete="off" name="tot_dias[]" value="'.$reg->tot_dias.'"></td>
					  <td><input type="text" size="1"  autocomplete="off" name="pen_dias[]" value="'.$reg->pen_dias.'"></td>
					  <td><input type="text"  autocomplete="off" size="70" name="obser_detalle[]" value="'.$reg->obser_detalle.'"></td>
					  <td><input type="text" size="25"  autocomplete="off" name="obser[]" value="'.$reg->obser.'"></td>
					  <td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('.$cont.')">X</button></td></tr>';
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
 				"0"=>$reg->est_reg,
 				"1"=>$reg->num_doc_trab,
 				"2"=>$reg->id_trab,
 				"3"=>$reg->sucursal_anexo,
 				"4"=>$reg->area_trab,
 				"5"=>$reg->funcion,
 				"6"=>$reg->nombres,
 				"7"=>($reg->est_reg=='1')?'<span class="label bg-green">ACTIVO</span>':
 				'<span class="label bg-red">INACTIVO</span>',
 				"8"=>'<button class="btn btn-warning" onclick="mostrar(\''.$reg->nro_doc.'\')"><i class="fa fa-pencil"></i></button>',
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