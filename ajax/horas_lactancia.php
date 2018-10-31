<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Horas_Lactancia.php";

$horas_lactancia=new Horas_Lactancia();

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//






$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";
$correlativo=isset($_POST["correlativo"])? limpiarCadena($_POST["correlativo"]):"";
$CantItems=isset($_POST["CantItems"])? limpiarCadena($_POST["CantItems"]):""; 

$cantidad_horas=isset($_POST["cantidad_horas"])? limpiarCadena($_POST["cantidad_horas"]):""; 
$id_hor_lac=isset($_POST["id_hor_lac"])? limpiarCadena($_POST["id_hor_lac"]):"";


$fec_des1=isset($_POST["fec_des1"])? limpiarCadena($_POST["fec_des1"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':


	    if (empty($id_hor_lac)){

	    	 $codigo_ingresado=$horas_lactancia->validar($fec_des1);
             $regc=$codigo_ingresado->fetch_object();
             $codigo=$regc->codigo;

			if ($codigo==''){

				$rspta=$horas_lactancia->insertar($fec_des1,
											  $cantidad_horas,
										      $fec_reg,
											  $usu_reg,
											  $pc_reg );	

				echo $rspta ? "Horas de lactancia registrada" : "No se pudieron registrar las horas de lactancia";
			
			}else if ($id_cp==$codigo) {

				$rspta=$horas_lactancia->insertar($fec_des1 );

	    	      echo $rspta ? "Horas de lactancia registrada" : "Ya existe registro con esa fecha asociada";


	    	}	
			

			
		}
		else 
		{	

			$rspta=$horas_lactancia->editar( $id_hor_lac,
											 $fec_des1,
											 $cantidad_horas,
										     $fec_reg,
									         $usu_reg,
											 $pc_reg  );
			

			echo $rspta ? "Horas de lactancia actualizada" : "No se pudieron actualizar las horas de lactancia";
		
		}


	break;

	case 'anular':
		$rspta=$horas_lactancia->anular($nro_doc);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$horas_lactancia->mostrar($id_hor_lac);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	

	case 'listar':
		$rspta=$horas_lactancia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			

 			$data[]=array(
 				"0"=>$reg->pd,
 				"1"=>$reg->Ano,
 				"2"=>$reg->Descrip_fec_pag,
 				"3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_hor_lac.')"><i class="fa fa-pencil"></i></button>'
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
		

		$rspta=$horas_lactancia->selectTrabajadoresDestajeros();
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