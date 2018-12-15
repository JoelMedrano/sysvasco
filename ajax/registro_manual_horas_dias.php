<?php 
require_once "../modelos/Registro_Manual_Horas_Dias.php";
session_start();

$rmhd=new Registro_Manual_Horas_Dias();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//




$id_rmhd=isset($_POST["id_rmhd"])? limpiarCadena($_POST["id_rmhd"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$hora_ing=isset($_POST["hora_ing"])? limpiarCadena($_POST["hora_ing"]):"";
$hora_sal=isset($_POST["hora_sal"])? limpiarCadena($_POST["hora_sal"]):"";
$id_accion=isset($_POST["id_accion"])? limpiarCadena($_POST["id_accion"]):"";
$obs=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";


$codigo_ingresado=$rmhd->consultar_turno($fecha);
$regc=$codigo_ingresado->fetch_object();
$dia_texto=$regc->dia_texto;



$estado_horario =  date('a');


  if ($dia_texto=='Sabado'){
  	$dia='S';
 }else if($dia_texto=='Domingo'){
 	$dia='D';
 }else{
 	$dia='C'; 
 }


$codigo_ingresado=$rmhd->consultar_turno($id_trab);
$regc=$codigo_ingresado->fetch_object();
$id_turno=$regc->id_turno;


if($id_turno=='1'){
$est_hor='D';
}else if($id_turno=='2'){
$est_hor='N';
}


$data_personal=$rmhd->consultarDataPersonal($id_trab);
$dp=$data_personal->fetch_object();
$id_tip_plan=$dp->id_tip_plan;
// $id_turno=$dp->id_turno;




switch ($_GET["op"]){
	case 'guardaryeditar':



			$dato=$rmhd->consultar_registroenelreloj($id_trab, $fecha ); // Consultar si tiene registro dentro de la tabla del  reloj
	        $regc=$dato->fetch_object();
	        $id=$regc->id;// Si esta vacio es porque no tiene registro en el reloj
 			$hor_ent_reloj=$regc->hor_ent;
 			$hor_sal_reloj=$regc->hor_sal;


	//		$dato=$rmhd->consultar_registroenhorasextras($id_trab, $fecha ); // Consultar si tiene registro dentro de la tabla del  horas extras
	//        $regc=$dato->fetch_object();
	//        $id_hor_ext=$regc->id_hor_ext;

	//        $dato=$rmhd->consultar_registroenhorasfaltas($id_trab, $fecha );  // Consultar si tiene registro dentro de la tabla del  horas extras
	//	    $regc=$dato->fetch_object();
	//	    $id_hor_fal=$regc->id_hor_fal;


		if (empty($id_rmhd)){

				


				if ($id==''  AND $id_accion=='1') {

						$rspta=$rmhd->insertar($id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg
											    );
			
	
						$rspta=$rmhd->insertar_reloj($id_trab,
													 $fecha,
						 							 $fec_reg,
						 							 $pc_reg, 
													 $usu_reg,
													 $hora_ing, 
													 $hora_sal,
												     $id_tip_plan,
												     $dia,
												     $est_hor,
						      						 $id_turno); 
						echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";



				} else if ($id!='' AND $id_accion=='2') { //ELIMINAR  


					$hora_ing=$hor_ent_reloj;
					$hora_sal=$hor_sal_reloj;

					$rspta=$rmhd->insertar(	   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg
											    );

					$rspta=$rmhd->insertar_reloj_data_eliminada(   $id_trab,
																   $fecha,
																   $fec_reg,
																   $pc_reg,
																   $usu_reg
											    );

					$rspta=$rmhd->eliminar_reloj($id_trab,
											     $fecha
											    );



					$rspta=$rmhd->anular_hora_extra($id_trab,
												    $fecha,
												    $fec_reg,
												    $pc_reg,
												    $usu_reg
											    );

					$rspta=$rmhd->anular_hora_falta($id_trab,
											        $fecha,
											        $fec_reg,
											        $pc_reg,
											        $usu_reg
											    );



					echo $rspta ? "Se elimino la Marcación" : "Marcación no se pudo eliminar";
					// ELIMINACION OK

					

				} else if ($id!='' AND $id_accion=='3') { //ACTUALIZAR - 
					//Cuando  marcaron hora de ingreso pero no marcaron su hora de salida 
					//CUando  marcaron solo hora de salida y no hora de ingreso





				} else{ 

					echo  "No se registro, verifique su información"; // CUando no ingresa a ninguno de los casos

					} 




				

			
		}
		else {
			$rspta=$rmhd->editar(			  
											   $id_rmhd,
											   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg

											   );
			echo $rspta ? "Actualizado" : "No se pudo actualizar";
		}



	break;

	case 'desactivar':
		$rspta=$rmhd->desactivar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desactivado" : "Permiso no se puede desactivar";
	break;

	case 'activar':
		$rspta=$rmhd->activar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso activado" : "Permiso no se puede activar";
	break;

	case 'mostrar':
		$rspta=$rmhd->mostrar($id_rmhd);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;



	case 'filtrar':
		$rspta=$rmhd->filtrar($id_trab,  $fecha);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'aprobar':
		$rspta=$rmhd->aprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso aprobado" : "Permiso no se puede aprobar";
	break;


	case 'desaprobar':
		$rspta=$rmhd->desaprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desaprobado" : "Permiso no se puede desaprobar";
	break;



	case 'aprobarRRHH':
		$rspta=$rmhd->aprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso aprobado" : "Permiso no se puede aprobar";
	break;


	case 'desaprobarRRHH':
		$rspta=$rmhd->desaprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desaprobado" : "Permiso no se puede desaprobar";
	break;


	case 'listar':


		$idusuario=$_SESSION["idusuario"];

		if ($idusuario==1 || $idusuario==2 || $idusuario==7  || $idusuario==8 ) {
			
            $rspta=$rmhd->listar();


		}else{
			$rspta=$rmhd->listarfiltrado($idusuario);
		}

		
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

 				 $url='../reportes/rptPermisoTrabajador.php?id=';


    		

 			   $data[]=array(
 				
 				"0"=>$reg->sucursal_anexo,
 				"1"=>$reg->area_trab,
 				"2"=>$reg->nombres,
 				"3"=>$reg->fecha,
 				"4"=>($reg->est_reg)?' <button class="btn btn-success" onclick="mostrar('.$reg->id_rmhd.')"><i class="fa fa-pencil"></i></button>':
 					' <button class="btn btn-success" onclick="mostrar('.$reg->id_rmhd.')"><i class="fa fa-pencil"></i></button>',

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



	case "selectAccion":
	
		

		$rspta = $rmhd->selectAccion();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_accion . '>' . $reg->accion . '</option>';
				}
	break;


	




}
?>