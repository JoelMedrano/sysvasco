<?php 
require_once "../modelos/Horario.php";
session_start();

$horario=new Horario();



$id_horario=isset($_POST["id_horario"])? limpiarCadena($_POST["id_horario"]):"";
$descrip=isset($_POST["descrip"])? limpiarCadena($_POST["descrip"]):"";
$id_turno=isset($_POST["id_turno"])? limpiarCadena($_POST["id_turno"]):"";



$lunes_ingreso=isset($_POST["lunes_ingreso"])? limpiarCadena($_POST["lunes_ingreso"]):"";
$lunes_salida=isset($_POST["lunes_salida"])? limpiarCadena($_POST["lunes_salida"]):"";
$martes_ingreso=isset($_POST["martes_ingreso"])? limpiarCadena($_POST["martes_ingreso"]):"";
$martes_salida=isset($_POST["martes_salida"])? limpiarCadena($_POST["martes_salida"]):"";
$miercoles_ingreso=isset($_POST["miercoles_ingreso"])? limpiarCadena($_POST["miercoles_ingreso"]):"";
$miercoles_salida=isset($_POST["miercoles_salida"])? limpiarCadena($_POST["miercoles_salida"]):"";
$jueves_ingreso=isset($_POST["jueves_ingreso"])? limpiarCadena($_POST["jueves_ingreso"]):"";
$jueves_salida=isset($_POST["jueves_salida"])? limpiarCadena($_POST["jueves_salida"]):"";
$viernes_ingreso=isset($_POST["viernes_ingreso"])? limpiarCadena($_POST["viernes_ingreso"]):"";
$viernes_salida=isset($_POST["viernes_salida"])? limpiarCadena($_POST["viernes_salida"]):"";
$sabado_ingreso=isset($_POST["sabado_ingreso"])? limpiarCadena($_POST["sabado_ingreso"]):"";
$sabado_salida=isset($_POST["sabado_salida"])? limpiarCadena($_POST["sabado_salida"]):"";
$domingo_ingreso=isset($_POST["domingo_ingreso"])? limpiarCadena($_POST["domingo_ingreso"]):"";
$domingo_salida=isset($_POST["domingo_salida"])? limpiarCadena($_POST["domingo_salida"]):"";

//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//




switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_horario)){
			$rspta=$horario->insertar($descrip,
							     	  $id_turno,
									  $lunes_ingreso, 
									  $lunes_salida,
									  $martes_ingreso,
									  $martes_salida,
									  $miercoles_ingreso,
									  $miercoles_salida,
									  $jueves_ingreso,
									  $jueves_salida,
									  $viernes_ingreso,
									  $viernes_salida,
									  $sabado_ingreso,
									  $sabado_salida,
									  $domingo_ingreso,
									  $domingo_salida,
									  $usu_reg, 
									  $pc_reg, 
									  $fec_reg );
			echo $rspta ? "Horario registrado" : "Horario no se pudo registrar";
		}
		else {
			$rspta=$horario->editar(  $id_horario,
									  $descrip, 
									  $id_turno,
									  $lunes_ingreso, 
									  $lunes_salida,
									  $martes_ingreso,
									  $martes_salida,
									  $miercoles_ingreso,
									  $miercoles_salida,
									  $jueves_ingreso,
									  $jueves_salida,
									  $viernes_ingreso,
									  $viernes_salida,
									  $sabado_ingreso,
									  $sabado_salida,
									  $domingo_ingreso,
									  $domingo_salida,
									  $usu_reg, 
									  $pc_reg, 
									  $fec_reg);
			echo $rspta ? "Horario actualizado" : "Horario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$horario->desactivar($id_horario);
 		echo $rspta ? "Horario Desactivado" : "Horario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$horario->activar($id_horario);
 		echo $rspta ? "Horario activado" : "Horario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$horario->mostrar($id_horario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$horario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->id_horario,
 				"1"=>$reg->descrip,
 				"2"=>($reg->est_reg)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"3"=>($reg->est_reg)?
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_horario.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_horario.')"><i class="fa fa-check"></i></button>',
 				"4"=>($reg->est_reg)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_horario.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->id_horario.')"><i class="fa fa-pencil"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;


	
}
?>