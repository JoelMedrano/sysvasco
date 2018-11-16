<?php 
require_once "../modelos/Reloj.php";
session_start();

$reloj=new Reloj();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$fecha = date("Y-m-d",strtotime(str_replace('/','-',$fec_emi)));
$hora = date("H:i:s",strtotime(str_replace('/','-',$fec_emi)));
$dia_texto =  date('l');
$estado_horario =  date('a');


  if ($dia_texto=='Saturday'){
  	$dia='S';
 }else if($dia_texto=='Sunday'){
 	$dia='D';
 }else{
 	$dia='C'; 
 }



 if($estado_horario=='am'){
  $est_hor='D';
 }else if($estado_horario=='pm'){
  $est_hor='N';
 }



$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':



        $codigo_ingresado=$reloj->consultar($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $codigo=$regc->id_trab;

        $data_personal=$reloj->consultarDataPersonal($id_trab);
        $dp=$data_personal->fetch_object();
        $id_tip_plan=$dp->id_tip_plan;
        $id_turno=$dp->id_turno;

        $codigo_ingresado=$reloj->consultarPrimeraSalida($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $primera_salida=$regc->hor_sal;


        $codigo_ingresado=$reloj->consultarSegundaEntrada($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $segunda_entrada=$regc->segunda_hor_ent;

        $codigo_ingresado=$reloj->consultarSegundaSalida($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $segunda_salida=$regc->segunda_hor_sal;

        $codigo_ingresado=$reloj->consultarUsuariosQuePuedenRealizarHE_FP($id_trab);
        $regc=$codigo_ingresado->fetch_object();
        $id_permitido=$regc->id_permitido;
       
       
        $codigo_ingresado=$reloj->consultarHoraIngreso($id_trab, $fecha, $hora);
        $regc=$codigo_ingresado->fetch_object();
        $hora_ingreso=$regc->hora_ing;
        $cantidad_tiempo=$regc->cant_tiempo;
        $tiempo=$regc->tiempo_largo;
        $hora_fin_ref=$regc->hora_fin_ref;
        $tiempo_ref=$regc->tiempo_ref;


        $codigo_ingresado=$reloj->restadehorasderefrigerio($id_trab, $tiempo, $tiempo_ref);
        $regc=$codigo_ingresado->fetch_object();
        $tiempo_dscto=$regc->tiempo_dscto;


        $codigo_ingresado=$reloj->consultarpermisoenesedia($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $id_permiso=$regc->id_permiso;


        $codigo_ingresado=$reloj->consultaridfechaasociada($fecha);
        $regc=$codigo_ingresado->fetch_object();
        $id_cp=$regc->id_cp;


       // $codigo_ingresado=$reloj->consultarDiaLaborable($fecha);
      //  $regc=$codigo_ingresado->fetch_object();
      //  $dia_lab=$regc->dia_lab;





       

		//Declaramos el array para almacenar todos los permisos marcados

        	//PRIMER REGISTRO COMO HORA DE INGRESO DENTRO DEL RELOJ
		 	if ($codigo==''){

				 		if ($id_permitido=='') {
				 			


				 		}else if ($id_permitido==$id_trab) {



						 			//INICIO - REGISTRO DE HORAS PERMISO ANTES DE LA HORA DE INGRESO ESTABLECIDO, horas despues de su hora de entrada  
						            if ($hora_ingreso<$hora  ) {
						            	//15:08:00 < 08:00:00
						            		$id_incidencia='0';
						            		if ($id_permiso=='' ) {
						            			$id_incidencia='2';
						            			# code...
						            		}else  {
						            			$id_incidencia='1';
						            		}

							            	if ( $hora_fin_ref<$hora ) { // Si la 15:00:00  es mayor a su hora almuerzo asignado 14:00:00
							            		$rspta=$reloj->registrar_hora_permiso($id_trab, $fecha, $hora, $tiempo_ref,  $hora_ingreso, $tiempo, $tiempo_dscto, $id_incidencia,  $id_permiso,  $id_cp, $fec_reg, $pc_reg, $usu_reg);
							            	} else if ( $hora_fin_ref>$hora ) {// Si la hora de ingreso (13:15:00) es menor que  a su hora almuerzo asignado 14:00:00
							            		$rspta=$reloj->registrar_hora_permiso_sinrefrigerio($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $id_incidencia,  $id_permiso,  $id_cp,  $fec_reg, $pc_reg, $usu_reg);
							            	}
						            

						            }

						            //FIN - REGISTRO DE HORAS PERMISO ANTES DE LA HORA DE INGRESO ESTABLECIDO


					 				//INICIO - REGISTRO DE HORAS EXTRAS ANTES DE LA HORA DE INGRESO ESTABLECIDO
					 				 if ($hora_ingreso>$hora  AND  $cantidad_tiempo>='3600'  ) {
						            	$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $id_cp, $fec_reg, $pc_reg, $usu_reg); 
						            }
						            //FIN - REGISTRO DE HORAS EXTRAS ANTES DE LA HORA DE INGRESO ESTABLECIDO




				 		}


				 		 $rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
								    echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";


		 		        


			
            }else{
            	// REGISTRO DE HORA DE SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
            	if ($primera_salida=='') {
		         	 $rspta=$reloj->editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
					 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
				}
				// REGISTRO DE HORA DE SEGUNDO INGRESO ACTUALIZANDO LA LINEA DEL RELOJ
 				else if ($segunda_entrada=='') {
 					 $rspta=$reloj->editar_segunda_entrada($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
			    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
 				}
 				// REGISTRO DE HORA DE SEGUNDA SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
 				else if ($segunda_salida=='') {
 					 $rspta=$reloj->editar_segunda_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
			    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
 				}

            }

           
             
			    	



			
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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