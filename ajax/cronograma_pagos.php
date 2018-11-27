<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Cronograma_Pagos.php";

$cronograma_pagos=new Cronograma_Pagos();


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


$id_ano=isset($_POST["id_ano"])? limpiarCadena($_POST["id_ano"]):"";
$des_fec_pag=isset($_POST["des_fec_pag"])? limpiarCadena($_POST["des_fec_pag"]):"";
$fec_pag=isset($_POST["fec_pag"])? limpiarCadena($_POST["fec_pag"]):"";
$desde=isset($_POST["desde"])? limpiarCadena($_POST["desde"]):"";
$hasta=isset($_POST["hasta"])? limpiarCadena($_POST["hasta"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_ano)){
			$rspta=$cronograma_pagos->insertar($id_ano	,$_POST["des_fec_pag"], $_POST["fec_pag"]);
			echo $rspta ? "Cronograma registrado" : "No se pudieron registrar todos los datos del cronograma";
		}
		else {
			

			$rspta=$cronograma_pagos->editar($id_ano, $_POST["des_fec_pag"],$_POST["fec_pag"], $_POST["desde"],$_POST["hasta"] );
			
			echo $rspta ? "Cronograma actualizado" : "No se pudieron actualizar todos los datos del cronograma";
		

		}
	break;

	case 'anular':
		$rspta=$cronograma_pagos->anular($id_ano);
 		echo $rspta ? "Cronograma anulado" : "Cronograma no se puede anular";
	break;

	case 'mostrar':
		$rspta=$cronograma_pagos->mostrar($id_ano);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarDetalle':
		//Referente a V-Art 
		$id=$_GET['id'];

		$rspta = $cronograma_pagos->listarDetalle($id);
		$total=0;
		$cont=0;
		echo '<thead style="background-color:#A9D0F5">
									<th width="20px">Item</th>
                                    <th width="50px">Cronograma</th>
                                    <th width="50px">Fecha</th>
                                    <th width="50px">Desde</th>
                                    <th width="50px">Hasta</th>
                                    <th width="50px">Dias</th>
                                </thead>';

		while ($reg = $rspta->fetch_object()) //COLOCAR NAME'S
				{
					echo '<tr class="filas" size="3" id="fila'.$cont.'">  >
								<td><input type="text" size="1" name="des_fec_pag[]" value="'.$reg->des_fec_pag.'"></td>
								<td><input type="text" size="40" name="Descrip_fec_pag[]" value="'.$reg->Descrip_fec_pag.'" readonly></td>
								<td><input type="date" size="25" name="fec_pag[]" value="'.$reg->fec_pag.'" ></td>
								<td><input type="date" size="25" name="desde[]" value="'.$reg->desde.'" ></td>
								<td><input type="date" size="25" name="hasta[]" value="'.$reg->hasta.'" ></td>
								<td><input type="text" readonly size="25" name="cant_dias[]" value="'.$reg->cant_dias.'" ></td>
						  </tr>';
					$total=$periodo;
					$cont++;
				}
		echo '<tfoot>
                                    
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>';
	break;

	case 'listar':
		$rspta=$cronograma_pagos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->cp,
 				"1"=>$reg->Ano,
 				"2"=>$reg->obs,
 				"3"=>($reg->est_reg=='1')?'<span class="label bg-green">Activo</span>':
 				'<span class="label bg-red">Inactivo</span>',
 				"4"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ano.')"><i class="fa fa-pencil"></i></button>',
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