<?php 
require_once "../modelos/Permiso_Personal.php";
session_start();

$permiso_personal=new Permiso_Personal();

$id_permiso=isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";
$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";


$fecha_emision=isset($_POST["fecha_emision"])? limpiarCadena($_POST["fecha_emision"]):"";
$fecha_emision = date("Y-m-d",strtotime(str_replace('/','-',$fecha_emision)));



$fecha_procede=isset($_POST["fecha_procede"])? limpiarCadena($_POST["fecha_procede"]):"";
$fecha_procede = date("Y-m-d",strtotime(str_replace('/','-',$fecha_procede)));


$fecha_hasta=isset($_POST["fecha_hasta"])? limpiarCadena($_POST["fecha_hasta"]):"";
$fecha_hasta = date("Y-m-d",strtotime(str_replace('/','-',$fecha_hasta)));


//$dias=isset($_POST["dias"])? limpiarCadena($_POST["dias"]):"";

$tip_permiso=isset($_POST["tip_permiso"])? limpiarCadena($_POST["tip_permiso"]):"";
$hora_ing=isset($_POST["hora_ing"])? limpiarCadena($_POST["hora_ing"]):"";
$hora_sal=isset($_POST["hora_sal"])? limpiarCadena($_POST["hora_sal"]):"";
$motivo=isset($_POST["motivo"])? limpiarCadena($_POST["motivo"]):"";

$tip_permiso=isset($_POST["tip_permiso"])? limpiarCadena($_POST["tip_permiso"]):"";
$id_vac_com=isset($_POST["id_vac_com"])? limpiarCadena($_POST["id_vac_com"]):"";





$id_fecha_pago1=isset($_POST["id_fecha_pago1"])? limpiarCadena($_POST["id_fecha_pago1"]):"";
$id_fecha_pago2=isset($_POST["id_fecha_pago2"])? limpiarCadena($_POST["id_fecha_pago2"]):"";
$id_fecha_pago3=isset($_POST["id_fecha_pago3"])? limpiarCadena($_POST["id_fecha_pago3"]):"";
$id_fecha_pago4=isset($_POST["id_fecha_pago4"])? limpiarCadena($_POST["id_fecha_pago4"]):"";

//$monto_a_pagar=isset($_POST["monto_a_pagar"])? limpiarCadena($_POST["monto_a_pagar"]):"";





//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//




switch ($_GET["op"]){
	case 'guardaryeditar':


		if (!file_exists($_FILES['imagen1']['tmp_name']) || !is_uploaded_file($_FILES['imagen1']['tmp_name']))
		{
			$imagen1=$_POST["imagenactual1"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen1"]["name"]);
			if ($_FILES['imagen1']['type'] == "image/jpg" || $_FILES['imagen1']['type'] == "image/jpeg" || $_FILES['imagen1']['type'] == "image/png")
			{
				$imagen1 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen1"]["tmp_name"], "../files/permisos_personal/" . $imagen1);
			}
		}



		if (!file_exists($_FILES['imagen2']['tmp_name']) || !is_uploaded_file($_FILES['imagen2']['tmp_name']))
		{
			$imagen2=$_POST["imagenactual2"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen2"]["name"]);
			if ($_FILES['imagen2']['type'] == "image/jpg" || $_FILES['imagen2']['type'] == "image/jpeg" || $_FILES['imagen2']['type'] == "image/png")
			{
				$imagen2 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen2"]["tmp_name"], "../files/permisos_personal/" . $imagen2);
			}
		}



		if (!file_exists($_FILES['imagen3']['tmp_name']) || !is_uploaded_file($_FILES['imagen3']['tmp_name']))
		{
			$imagen3=$_POST["imagenactual3"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen3"]["name"]);
			if ($_FILES['imagen3']['type'] == "image/jpg" || $_FILES['imagen3']['type'] == "image/jpeg" || $_FILES['imagen3']['type'] == "image/png")
			{
				$imagen3 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen3"]["tmp_name"], "../files/permisos_personal/" . $imagen3);
			}
		}




		if (!file_exists($_FILES['imagen4']['tmp_name']) || !is_uploaded_file($_FILES['imagen4']['tmp_name']))
		{
			$imagen4=$_POST["imagenactual4"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen4"]["name"]);
			if ($_FILES['imagen4']['type'] == "image/jpg" || $_FILES['imagen4']['type'] == "image/jpeg" || $_FILES['imagen4']['type'] == "image/png")
			{
				$imagen4 = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen4"]["tmp_name"], "../files/permisos_personal/" . $imagen4);
			}
		}

			

			$ci=$permiso_personal->consultar_diasdeintervalo($fecha_procede, $fecha_hasta ); // (Jornal, Destajero o Comision)
	        $regc=$ci->fetch_object();
	        $dias=$regc->dias;


			$ci=$permiso_personal->consultar_tipodepagovacaciones($id_trab, $tip_permiso,$dias ); // (Jornal, Destajero o Comision)
	        $regc=$ci->fetch_object();
	        $id_pag_vac_cts=$regc->id_pag_vac_cts;

	        $ci=$permiso_personal->consultar_pagodevacacionesjornal($id_trab,$dias ); //(Jornal =1 )
		    $regc=$ci->fetch_object();
		    $monto_a_pagar=$regc->monto_a_pagar;

		    $ci=$permiso_personal->consultar_id_cronograma_pago($fecha_procede, $fecha_hasta ); // (Jornal, Destajero o Comision)
	        $regc=$ci->fetch_object();
	        $id_cp=$regc->id_cp;



		if (empty($id_permiso)){

			

	        if ($id_pag_vac_cts=='1') { // Pago de vacaciones como Jornal
	        	
	        	

	        }

	        if ($tip_permiso=='VC') {
	        	
	        }else if ($tip_permiso!='VC') {
	        	$monto_a_pagar='0.00';
	        }


			$rspta=$permiso_personal->insertar($id_permiso,
											   $id_trab,
											   $fecha_emision,
											   $fecha_procede, 
											   $fecha_hasta,  
											   $dias, 
											   $tip_permiso,
											   $id_vac_com,
											   $id_cp,
											   $hora_ing, 
											   $hora_sal, 
											   $motivo,  
											   $id_fecha_pago1,
											   $monto_a_pagar,
											   $id_fecha_pago2,
											   $id_fecha_pago3,
											   $id_fecha_pago4,
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg, 
											   $imagen1, 
											   $imagen2, 
											   $imagen3, 
											   $imagen4 );

				/*INICIO - AGREGADO EL  08/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS Y HORAS DE PERMISO*/

					if ($tip_permiso=='VC' AND $id_vac_com=='0') {
						
					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada($id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 


					}

			

				/*FIN  - AGREGADO EL  08/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS Y HORAS DE PERMISO*/


		    	/*INICIO  - AGREGADO EL  19/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS, HORAS DE PERMISO Y COLOQUE COMO FALTA*/
				
					if ($tip_permiso=='SU') {


					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada($id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 


					$rspta=$permiso_personal->insertar_faltas_desde_hasta( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg  ); 

					}


					if ($tip_permiso=='ND') {


					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada($id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 


					
					}


				/*INICIO  - AGREGADO EL  19/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS, HORAS DE PERMISO Y COLOQUE COMO FALTA*/
				



			echo $rspta ? "Permiso registrado" : "Permiso no se pudo registrar";
		}
		else {
			
			$rspta=$permiso_personal->editar($id_permiso,
											 $id_trab,
											 $fecha_emision,
											 $fecha_procede, 
											 $fecha_hasta, 
											 $dias, 
											 $tip_permiso,
											 $id_vac_com,
											 $id_cp,
											 $hora_ing, 
											 $hora_sal, 
											 $motivo,
											 $id_fecha_pago1,
										//	 $monto_a_pagar,
											 $id_fecha_pago2,
											 $id_fecha_pago3,
											 $id_fecha_pago4,  
											 $fec_reg, 
											 $pc_reg, 
											 $usu_reg, 
											 $imagen1,  
											 $imagen2, 
											 $imagen3, 
											 $imagen4);

			/*INICIO - AGREGADO EL  08/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS Y HORAS DE PERMISO*/

					if ($tip_permiso=='VC' AND $id_vac_com=='0') {
						
					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj($id_trab,	$fecha_procede, $fecha_hasta , $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 

					
					}

			/*FIN  - AGREGADO EL  08/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS Y HORAS DE PERMISO*/

			
		    	/*INICIO  - AGREGADO EL  19/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS, HORAS DE PERMISO Y COLOQUE COMO FALTA*/
				
					if ($tip_permiso=='SU') {


					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada($id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 


					$rspta=$permiso_personal->insertar_faltas_desde_hasta( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg  ); 

					}


					if ($tip_permiso=='ND') {


					$rspta=$permiso_personal->insertar_reloj_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_reloj( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_reloj( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_falta($id_trab,	$fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_falta( $id_trab, $fecha_procede, $fecha_hasta );


					$rspta=$permiso_personal->insertar_hora_extra_data_eliminada($id_trab, $fecha_procede, $fecha_hasta );
					$rspta=$permiso_personal->actualizar_quienelimino_hora_extra($id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg, $usu_reg);
					$rspta=$permiso_personal->eliminar_hora_extra( $id_trab, $fecha_procede, $fecha_hasta ); 


					
					}


				/*INICIO  - AGREGADO EL  19/01/2019 PARA QUE ELIMINE LOS REGISTROS DE FALTAS, HORAS EXTRAS, HORAS DE PERMISO Y COLOQUE COMO FALTA*/
				




			echo $rspta ? "Permiso actualizado" : "Permiso no se pudo actualizar";
		}



	break;

	case 'desactivar':
		$rspta=$permiso_personal->desactivar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desactivado" : "Permiso no se puede desactivar";
	break;

	case 'activar':
		$rspta=$permiso_personal->activar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso activado" : "Permiso no se puede activar";
	break;


	case 'eliminar':

		$rspta=$permiso_personal->insertar_data_eliminada($id_permiso, $fec_reg, $pc_reg, $usu_reg);
		$rspta=$permiso_personal->eliminar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso eliminado" : "Permiso no se puede eliminar";

 		
	break;

	case 'mostrar':
		$rspta=$permiso_personal->mostrar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'aprobar':
		$rspta=$permiso_personal->aprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso aprobado" : "Permiso no se puede aprobar";
	break;


	case 'desaprobar':
		$rspta=$permiso_personal->desaprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desaprobado" : "Permiso no se puede desaprobar";
	break;



	case 'aprobarRRHH':
		$rspta=$permiso_personal->aprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso aprobado" : "Permiso no se puede aprobar";
	break;


	case 'desaprobarRRHH':
		$rspta=$permiso_personal->desaprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg);
 		echo $rspta ? "Permiso desaprobado" : "Permiso no se puede desaprobar";
	break;


	case 'listar':


		$idusuario=$_SESSION["idusuario"];

		if ($idusuario==1 || $idusuario==2 || $idusuario==7  || $idusuario==8 ) {
			
            $rspta=$permiso_personal->listar();


		}else{
			$rspta=$permiso_personal->listarfiltrado($idusuario);
		}

		
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){

 				 $url='../reportes/rptPermisoTrabajador.php?id=';


    		if ( $_SESSION["idusuario"]=='1' || $_SESSION["idusuario"]=='2' || $_SESSION["idusuario"]=='7') {


 			   $data[]=array(
 				"0"=>$reg->pp,
 				"1"=>$reg->fecha_procede,
 				"2"=>$reg->fecha_hasta,
 				"3"=>$reg->nombres,
 				"4"=>$reg->tipo_permiso,
 				"5"=>$reg->motivo,

 				"6"=>($reg->est_apro)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',

 				"7"=>($reg->est_apro_rrhh)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',

 				"8"=>($reg->est_reg)?'<span class="label bg-blue">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',

 				"9"=>($reg->est_reg)?' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>':
 					' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>',

 				"10"=>($reg->est_apro)?' <button class="btn btn-danger" onclick="desaprobar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

 				"11"=>($reg->est_apro_rrhh)?' <button class="btn btn-danger" onclick="desaprobarRRHH('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobarRRHH('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

 				"12"=>($reg->est_reg)?' <button class="btn btn-danger" onclick="desactivar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

                "13"=>'<a target="_blank" href="'.$url.$reg->id_permiso.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',

                "14"=>' <button class="btn btn-danger" onclick="eliminar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>'
 						
 				);

 			  }else  if ($_SESSION["idusuario"]=='8')  {


 			   $data[]=array(
 				"0"=>$reg->pp,
 				"1"=>$reg->fecha_procede,
 				"2"=>$reg->fecha_hasta,
 				"3"=>$reg->nombres,
 				"4"=>$reg->tipo_permiso,
 				"5"=>$reg->motivo,
 				"6"=>($reg->est_apro)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',
 				"7"=>($reg->est_apro_rrhh)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',
 				"8"=>($reg->est_reg)?'<span class="label bg-blue">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"9"=>($reg->est_reg)?' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>':
 					' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>',

 				"10"=>($reg->est_apro)?' <button class="btn btn-danger" onclick="desaprobar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

 				"11"=>($reg->est_apro_rrhh)?' <button class="btn btn-danger" onclick="desaprobarRRHH('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="aprobarRRHH('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',

 				"12"=>($reg->est_reg)?' <button class="btn btn-danger" onclick="desactivar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>':
 					' <button class="btn btn-primary" onclick="activar('.$reg->id_permiso.')"><i class="fa fa-check"></i></button>',
                "13"=>'<a target="_blank" href="'.$url.$reg->id_permiso.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',

                "14"=>' <button class="btn btn-danger" onclick="eliminar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>'
 					

 				);


            }else  {



             $data[]=array(

 				"0"=>$reg->pp,
 				"1"=>$reg->fecha_procede,
 				"2"=>$reg->fecha_hasta,
 				"3"=>$reg->nombres,
 				"4"=>$reg->tipo_permiso,
 				"5"=>$reg->motivo,
 				"6"=>($reg->est_apro)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',

 				"7"=>($reg->est_apro_rrhh)?'<span class="label bg-blue">Aprobado</span>':
 				'<span class="label bg-red">Desaprobado</span>',

 				"8"=>($reg->est_reg)?'<span class="label bg-blue">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',

 				"9"=>($reg->est_reg)?'<button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>':
 					' <button class="btn btn-success" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>',
 				"10"=>$reg->ninguno,
 				"11"=>$reg->ninguno,
 				"12"=>$reg->ninguno,
 				"13"=>'<a target="_blank" href="'.$url.$reg->id_permiso.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',

 				"14"=>' <button class="btn btn-danger" onclick="eliminar('.$reg->id_permiso.')"><i class="fa fa-close"></i></button>'

 				);

			 }


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



	case "selectFechaPagoVacaciones1":
	
		

		$rspta = $permiso_personal->selectFechaPagoVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_fecha_pago1 . '>' . $reg->fecha1 . '</option>';
				}
	break;


	case "selectFechaPagoVacaciones2":
		$rspta = $permiso_personal->selectFechaPagoVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_fecha_pago2 . '>' . $reg->fecha2 . '</option>';
				}
	break;




	case "selectFechaPagoVacaciones3":
		$rspta = $permiso_personal->selectFechaPagoVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_fecha_pago3 . '>' . $reg->fecha3 . '</option>';
				}
	break;




	case "selectFechaPagoVacaciones4":
		$rspta = $permiso_personal->selectFechaPagoVacaciones();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_fecha_pago4 . '>' . $reg->fecha4 . '</option>';
				}
	break;





}
?>