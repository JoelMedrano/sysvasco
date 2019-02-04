<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Renta_Quinta_Categoria.php";

$renta_quinta_categoria=new Renta_Quinta_Categoria();

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//



$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";
$id_pd=isset($_POST["id_pd"])? limpiarCadena($_POST["id_pd"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$mon_total=isset($_POST["mon_total"])? limpiarCadena($_POST["mon_total"]):"";




$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		
			

			$rspta=$renta_quinta_categoria->editar(   $id_cp,
													  $_POST["id_trab"],
													  $_POST["mon_total"],
												      $fec_reg,
													  $usu_reg,
													  $pc_reg );

			$rspta=$renta_quinta_categoria->insertar2(    $id_cp,
													      $CantItems,
														  $_POST["id_trab"],
														  $_POST["mon_total"],
														  $fec_reg,
														  $usu_reg,
														  $pc_reg  );
			

			echo $rspta ? "Renta de quinta actualizada" : "No se pudieron actualizar los datos";
		
	break;

	case 'anular':
		$rspta=$renta_quinta_categoria->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$renta_quinta_categoria->mostrar($id_cp);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Referente a V-Art
		$id_cp=$_GET['id_cp'];

		$rspta = $renta_quinta_categoria->listarDetalle($id_cp);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="100px">Id.Trab</th>
                                    <th width="300px">Trabajador</th>
                                    <th width="100px">Monto</th>
                                    <th width="80px">Opciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="5" id="fila'.$cont.'">  ><td><input type="text" size="3" readonly  name="id_trab[]" value="'.$reg->id_trab.'"></td>
					<td><input type="text" size="80" readonly name="id_trab[]" value="'.$reg->apellidosynombres.'" readonly></td>
					<td><input type="text" size="15"  name="mon_total[]" value="'.$reg->mon_total.'"></td>
					<a data-toggle="modal" href="#myModal">
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
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$renta_quinta_categoria->listar();
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
		

		$rspta=$renta_quinta_categoria->selectTrabajadoresDestajeros();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle(\''.$reg->id_trab.'\',\''.$reg->nombres.'\',\''.$reg->sueldo.'\',\''.$reg->bono_des_trab.'\')"><span class="fa fa-plus"></span></button>',
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