<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Vacaciones_Compradas.php";

$vac_compradas=new Vacaciones_Compradas();

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//



$id_permiso=isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";



$pago_vac_comp=isset($_POST["pago_vac_comp"])? limpiarCadena($_POST["pago_vac_comp"]):"";


$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";

$id_cp_vac_com=isset($_POST["id_cp_vac_com"])? limpiarCadena($_POST["id_cp_vac_com"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		
			

			$rspta=$vac_compradas->editar(  $id_permiso,
											$pago_vac_comp,
											$id_cp_vac_com);

			
			

			echo $rspta ? "Vacaciones compradas  actualizadas" : "No se actualizaron los datos de las compras actualizadas";
		
	break;

	case 'anular':
		$rspta=$vac_compradas->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$vac_compradas->mostrar($id_permiso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id_permiso=$_GET['id_permiso'];

		$rspta = $vac_compradas->listarDetalle($id_permiso);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="5px">Dia</th>
                                    <th width="5px">Fecha</th>
                                    <th width="5px">Estado</th>
                                    <th width="5px">Ingreso-Salida</th>
                                    <th width="5px">H.Extras</th>
                                    <th width="5px">H.Faltas</th>
                                    <th width="5px">Tardanzas</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="5" id="fila'.$cont.'">  >
					<td><input type="text" size="3" name="nom_dia[]" value="'.$reg->nom_dia.'"></td>
					<td><input type="text" size="10" readonly name="Fecha[]" value="'.$reg->Fecha.'" readonly></td>
					<td><input type="text" size="15"  name="estado[]" value="'.$reg->estado.'"></td>
					<td><input type="text" size="15" readonly name="hor_ent_sal[]" value="'.$reg->hor_ent_sal.'"></td>
					<td><input type="text" size="15" name="horas_extras[]" value="'.$reg->horas_extras.'"></td>
					<td><input type="text" size="15" readonly name="horas_faltas[]" value="'.$reg->horas_faltas.'"></td>
					<td><input type="text" size="15" readonly name="min_tardanza[]" value="'.$reg->min_tardanza.'"></td>
					</td></tr>';
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
		$rspta=$vac_compradas->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->vc,
 				"1"=>$reg->fecha_procede,
 				"2"=>$reg->fecha_hasta,
 				"3"=>$reg->nombresyapellidos,
 				"4"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;



	case 'selectTrabajadoresDestajeros':
		

		$rspta=$vac_compradas->selectTrabajadoresDestajeros();
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


	case 'selectFechaspago':
		

		$rspta=$vac_compradas->selectFechaspago();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->id_cp_vac_com . '>' . $reg->fechas_pago . '</option>';
				}
	break;



	




}
?>