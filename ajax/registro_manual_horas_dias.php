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


$dato=$rmhd->consultar_cantidad_digitos_hora_ing_hora_sal($hora_ing, $hora_sal ); // Consultar si tiene registro dentro de la tabla del  reloj
$regc=$dato->fetch_object();
$cantdig_hora_ing=$regc->cantdig_hora_ing;
$cantdig_hora_sal=$regc->cantdig_hora_sal;


if ($cantdig_hora_ing<'8') {
	
$dato=$rmhd->formatear_hora_ing_hora_sal($hora_ing, $hora_sal ); // Consultar si tiene registro dentro de la tabla del  reloj
$regc=$dato->fetch_object();
$hora_ing=$regc->format_hora_ing;

}


if ($cantdig_hora_sal<'8') {
	
$dato=$rmhd->formatear_hora_ing_hora_sal($hora_ing, $hora_sal ); // Consultar si tiene registro dentro de la tabla del  reloj
$regc=$dato->fetch_object();
$hora_sal=$regc->format_hora_sal;

}



$dato=$rmhd->consultar_ExcepcionesHorarioPago($id_trab ); // Consultar si tiene registro dentro de la tabla del  reloj
$regc=$dato->fetch_object();
$id_excep=$regc->id_excep;

$codigo_ingresado=$rmhd->consultarCasoVigilancia($id_trab, $fecha, $hora);
$regc=$codigo_ingresado->fetch_object();
$id_casovigilancia=$regc->id_casovigilancia;
$cantidad_horas=$regc->cantidad_horas;
$fedo_canhoras_max=$regc->fedo_canhoras_max;
$por_pago_vig=$regc->por_pago_vig;

		

$codigo_ingresado=$rmhd->consultarCasoMovilidad($id_trab, $fecha, $hora);
$regc=$codigo_ingresado->fetch_object();
$id_casomovilidad=$regc->id_casomovilidad;
$canthoras_mov=$regc->canthoras_mov;


//CONSULTA CUAL FUE SU HORA DE INGRESO Y SALIDA  SEGUN DEL DIA SELECCIONADO
$codigo_ingresado=$rmhd->consultar_IngresoSalida_SegunReloj($id_trab, $fecha, $hora_ing,  $hora_sal ) ;
$regc=$codigo_ingresado->fetch_object();
$hora_salida_sh=$regc->hora_salida_sh;
$hora_ingreso_sh=$regc->hora_ingreso_sh;
$cant_dif_hish_hire=$regc->cant_dif_hish_hire;
$cant_dif_hssh_hsre=$regc->cant_dif_hssh_hsre;
//$cant_dif_hish_hire=$regc->cant_dif_hish_hire;
$dif_hish_hire=$regc->dif_hish_hire;
$dif_hssh_hsre=$regc->dif_hssh_hsre;
//$dif_hish_hire=$regc->dif_hish_hire;
$hora_ini_ref=$regc->hora_ini_ref;
$hora_fin_ref=$regc->hora_fin_ref;
$tiempo_refrigerio=$regc->tiempo_ref;
$dif_hssh_hsre_ref=$regc->dif_hssh_hsre_ref;
$dif_hfref_hsre_ref=$regc->dif_hfref_hsre_ref;
$dif_hish_hiref=$regc->dif_hish_hiref; //CASO 4  









$estado=$regc->estado_dia;

//PARA HORAS EXTRAS
$tiempo_ing=$dif_hish_hire;
$tiempo_sal=$dif_hssh_hsre;


$dato=$rmhd->calcular_redondeo_tiempo($tiempo_ing, $tiempo_sal);
$regc=$dato->fetch_object();
$tiempo_redondeado_ing=$regc->tiempo_redondeado_ing;  
$tiempo_redondeado_sal=$regc->tiempo_redondeado_sal;  
//FIN PARA HORAS EXTRAS




//PARA HORAS DSCTO
$tiempo_ing_dscto=$dif_hish_hire;
$tiempo_sal_dscto=$dif_hssh_hsre;

$tiempo_salconref_dscto=$dif_hssh_hsre_ref;

$tiempo_salconfinref_dscto=$dif_hfref_hsre_ref;


$tiempo_ingconref_dscto=$dif_hish_hiref;





$dato=$rmhd->calcular_redondeo_tiempo_dscto($tiempo_ing_dscto, $tiempo_sal_dscto,  $tiempo_salconref_dscto, $tiempo_salconfinref_dscto , $tiempo_ingconref_dscto);
$regc=$dato->fetch_object();
$tiempo_redondeado_ing_dscto=$regc->tiempo_redondeado_ing_dscto;  
$tiempo_redondeado_sal_dscto=$regc->tiempo_redondeado_sal_dscto;  
$tiempo_redondeado_salconref_dscto=$regc->tiempo_redondeado_salconref_dscto;  
$tiempo_redondeado_salconfinref_dscto=$regc->tiempo_redondeado_salconfinref_dscto; 
$tiempo_redondeado_ingconref_dscto=$regc->tiempo_redondeado_ingconref_dscto;   


//FIN PARA HORAS DSCTO




//INICIO - CONSULTAR QUE ID CORRESPONDE 
$dato=$rmhd->consultaridfechaasociada($fecha);
$regc=$dato->fetch_object();
$id_cp=$regc->id_cp;  


$id_fec_abono=$id_cp; //pasar dato para horas extras
$id_fec_dscto=$id_cp; //pasar dato para descuentos
//FIN - CONSULTAR QUE ID CORRESPONDE 








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

				


				if ($id==''  AND $id_accion=='1' ) {

						$rspta=$rmhd->insertar($id_trab,   $fecha,  $hora_ing,    $hora_sal,   $id_accion,   $obs,  $fec_reg,  $pc_reg,    $usu_reg );
			
	
						$rspta=$rmhd->insertar_reloj($id_trab,$fecha, $fec_reg, $pc_reg,  $usu_reg, $hora_ing,  $hora_sal,$id_tip_plan, $dia, $est_hor, $id_turno); 

						

					    

					   //DIA NO LABORABLE SEGUN TABLA DE FECHAS Y NO TIENE HORA DE INGRESO  ASIGNADO
					    if ($hora_ingreso_sh=='00:00:00' AND  $estado=='LABORABLE' AND  $id_excep=='' ) {

					    	//CASO ELASTICOS - SABADOS
					    	$hora_inicio=$hora_ing;
						    $hora_fin= $hora_sal;
						    $por_pago='25';

					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


					    //DIA NO LABORABLE(DOMINGO) O FERIADO SEGUN TABLA DE FECHAS Y NO TIENE HORA DE INGRESO ASIGNADO
					    }else if ($hora_ingreso_sh=='00:00:00' AND  $estado=='NO LABORABLE' OR $estado=='FERIADO'  AND  $id_excep=='' ) {

					    	
					    	$hora_inicio=$hora_ing;
						    $hora_fin= $hora_sal;
						    $por_pago='100';


						    if($id_casovigilancia==$id_trab AND $cant_dif_hssh_hsre>='14400'and  $cant_dif_hssh_hsre>='43200') {

							$tiempo_fin='12:00:00';
					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

					    	}else if ($id_casovigilancia!=$id_trab) {

					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

					    	}


					    }else if ($hora_ingreso_sh!='00:00:00'  AND  $estado=='LABORABLE'  AND  $id_excep=='') {
					   //DIA LABORABLE SEGUN HORARIO 
					    	 $por_pago='25';//General

					    	


							    	//CASO1: REGISTRAR HORAS EXTRAS ANTES DE LA HORA DE INGRESO
								    if ($hora_ingreso_sh>$hora_ing  AND  $cant_dif_hish_hire>='3600'  AND $cant_dif_hish_hire<='43200') {
								    	
								    	 $hora_inicio=$hora_ing;
								    	 $hora_fin= $hora_ingreso_sh;
								    	 $cantidad= $dif_hish_hire;
								    	 $tiempo_fin=$tiempo_redondeado_ing;  




								    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


								    }


								    //CASO2: REGISTRAR HORAS EXTRAS ANTES DESPUES DE LA HORA DE SALIDA
								    if ($hora_salida_sh<$hora_sal  AND  $cant_dif_hssh_hsre>='3600'  AND $cant_dif_hssh_hsre<='43200') {

								    	$hora_inicio=$hora_salida_sh;
								    	$hora_fin= $hora_sal;
								    	$cantidad= $dif_hssh_hsre;
								    	$tiempo_fin=$tiempo_redondeado_sal;  


													    //CASO VIGILANCIA 
												    	if ($id_trab==$id_casovigilancia) {


														    		//SI SUPERA LA HORAS MAXIMA PAGABLES SE LE PAGARA SOLO LA CANTIDAD MAXIMA
														    		if ($cant_dif_hssh_hsre>='14400' ) {
														    			$tiempo_fin=$cantidad_horas;
														    			$por_pago=$por_pago_vig;

														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}else if ($cant_dif_hssh_hsre<'14400') {
														    		//SI ES MENOR DE  LAS HORAS MAXIMAS PAGABLES SE LE PAGARA LAS HORAS REALIZADAS
														    			
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}


												    		

												    	//CASO MOVILIDAD
												    	}else if ($id_trab==$id_casomovilidad) {


														    		//SI SUPERA LA HORAS MAXIMA PAGABLES SE LE PAGARA SOLO LA CANTIDAD MAXIMA
														    		if ($cant_dif_hssh_hsre>='14400' ) {
														    			$tiempo_fin=$canthoras_mov;
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}else if ($cant_dif_hssh_hsre<'14400') {
														    		//SI ES MENOR DE  LAS HORAS MAXIMAS PAGABLES SE LE PAGARA LAS HORAS REALIZADAS
														    			
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}
												    		

												    		



												    	//NO ES CASO MOVILIDAD NI VIGILANCIA
												    	}else if ($id_trab!=$id_casomovilidad AND $id_trab!=$id_casovigilancia) {

												    				$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


												    	}
								    	
								    }

								    //CASO3: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO PERO ANTES DEL INICIO DE SU REFRIGERIO ASIGNADO - OK
								    
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_ini_ref>=$hora_ing ) {

								    	$hora_inicio=$hora_ingreso_sh;
								    	$hora_fin= $hora_ing;
								    	$cantidad= $dif_hish_hire;
								    	$tiempo_des= $dif_hish_hire;
								    	$tiempo_fin=$tiempo_redondeado_ing_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


									//CASO4: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO PERO DESDE EL INICIO O HASTA LA FINALIZACION DE SU REFRIGERIO ASIGNADO
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_ini_ref<=$hora_ing  and $hora_fin_ref>=$hora_ing  ) {

								    	

								    	$hora_inicio=$hora_ingreso_sh;
								    	$hora_fin= $hora_ini_ref;
								    	$cantidad= $dif_hish_hiref;
								    	$tiempo_des= $dif_hish_hiref;
								    	$tiempo_fin=$tiempo_redondeado_ingconref_dscto;

								    	


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


								    //CASO5: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO DESPUES DE LA HORA FIN  DE SU REFRIGERIO -  OK
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_fin_ref<$hora_ing  ) {

								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


								    //CASO5: REGISTRAR HORAS FALTAS  CUANDO SALIO ANTES DE LA HORA DE SALIDA PERO DESPUES DE SU REFRIFERIO - OK 
								    if ($hora_salida_sh>$hora_sal  AND $hora_fin_ref<$hora_sal    ) {


								    	$hora_inicio=$hora_ing;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hssh_hsre;
								    	$tiempo_des= $dif_hssh_hsre;
								    	$tiempo_fin=$tiempo_redondeado_sal_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	
								    } 


								    //CASO6: REGISTRAR HORAS FALTAS  CUANDO SALIO ANTES DE LA HORA DE SALIDA PERO ANTES DE SU REFRIFERIO OK
								    if ($hora_salida_sh>$hora_sal  AND $hora_ini_ref>=$hora_sal AND $hora_sal!='00:00:00' AND $hora_sal!='' ) {


								    	$hora_inicio=$hora_sal;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hssh_hsre;
								  
								    	$tiempo_fin=$tiempo_redondeado_salconref_dscto;

								    	$tiempo_ref=$tiempo_refrigerio;


								    	$tiempo_des=$tiempo_salconref_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	
								    } 


								      //CASO7: REGISTRAR HORAS FALTAS  CUANDO SALIO DENTRO DE SU HORARIO DE REFRIFERIO Y ANTES DE QUE TERMINE -  OK 
								    if ($hora_salida_sh>$hora_sal  AND $hora_ini_ref<=$hora_sal AND  $hora_fin_ref>=$hora_sal  ) {


								    	$hora_inicio=$hora_fin_ref;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hfref_hsre_ref;
								    	$tiempo_fin=$tiempo_redondeado_salconfinref_dscto;
								    	$tiempo_des=$tiempo_salconfinref_dscto;


								    	



								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								        

								    } 










					    }

					   

							



						echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";



				} else if ($id!='' AND $id_accion=='2') { //ELIMINAR  
					//$id!='' hay registro de ese dia con ese dia en la tabla del reloj

					//$id_accion=='2' elimina


					$hora_ing=$hor_ent_reloj;
					$hora_sal=$hor_sal_reloj;

					
					/*INICIO - RELOJ*/
					$rspta=$rmhd->insertar_reloj_data_eliminada(   $id_trab,
																   $fecha
											    );

					$rspta=$rmhd->actualizar_quienelimino_reloj(   $id_trab,
																   $fecha,
																   $fec_reg,
																   $pc_reg,
																   $usu_reg
											    );

					$rspta=$rmhd->eliminar_reloj($id_trab,
											     $fecha
											    );

					/*FIN - RELOJ*/





					/*INICIO - HORA EXTRA*/
					$rspta=$rmhd->insertar_hora_extra_data_eliminada($id_trab,
												   					 $fecha
																     );

					$rspta=$rmhd->actualizar_quienelimino_hora_extra(   $id_trab,
																	    $fecha,
																	    $fec_reg,
																	    $pc_reg,
																	    $usu_reg
											  					     );

					$rspta=$rmhd->eliminar_hora_extra(	$id_trab,
													     $fecha
													  );

					/*FIN - HORA EXTRA*/


					

					/*INICIO - HORA FALTA*/
					$rspta=$rmhd->insertar_hora_falta_data_eliminada($id_trab,
																     $fecha
																      );

					$rspta=$rmhd->actualizar_quienelimino_hora_falta(  $id_trab,
																	   $fecha,
																	   $fec_reg,
																	   $pc_reg,
																	   $usu_reg
											   						 );

					$rspta=$rmhd->eliminar_hora_falta(			 $id_trab,
															     $fecha
															    );

					/*INICIO - HORA FALTA*/



					echo $rspta ? "Se elimino la marcación y data asociada(H.E y H.F)" : "Marcación no se pudo eliminar";
					// ELIMINACION OK

					

				} else if ($id!='' AND $id_accion=='3') { //ACTUALIZAR - 
					


					//PRIMERO ELIMINA TODA LA INFORMACION ANTERIOR Y LA ACTUALIZA POR LA NUEVA

								/*INICIO - RELOJ*/
					$rspta=$rmhd->insertar_reloj_data_eliminada(   $id_trab,
																   $fecha
											    );

					$rspta=$rmhd->actualizar_quienelimino_reloj(   $id_trab,
																   $fecha,
																   $fec_reg,
																   $pc_reg,
																   $usu_reg
											    );

					$rspta=$rmhd->eliminar_reloj($id_trab,
											     $fecha
											    );

					/*FIN - RELOJ*/





					/*INICIO - HORA EXTRA*/
					$rspta=$rmhd->insertar_hora_extra_data_eliminada($id_trab,
												   					 $fecha
																     );

					$rspta=$rmhd->actualizar_quienelimino_hora_extra(   $id_trab,
																	    $fecha,
																	    $fec_reg,
																	    $pc_reg,
																	    $usu_reg
											  					     );

					$rspta=$rmhd->eliminar_hora_extra(	$id_trab,
													     $fecha
													  );

					/*FIN - HORA EXTRA*/


					

					/*INICIO - HORA FALTA*/
					$rspta=$rmhd->insertar_hora_falta_data_eliminada($id_trab,
																     $fecha
																      );

					$rspta=$rmhd->actualizar_quienelimino_hora_falta(  $id_trab,
																	   $fecha,
																	   $fec_reg,
																	   $pc_reg,
																	   $usu_reg
											   						 );

					$rspta=$rmhd->eliminar_hora_falta(			 $id_trab,
															     $fecha
															    );

					/*INICIO - HORA FALTA*/




					//SEGUNDO INGRESA LA INFORMACION ACTUALIZADA 


					$rspta=$rmhd->insertar($id_trab,   $fecha,  $hora_ing,    $hora_sal,   $id_accion,   $obs,  $fec_reg,  $pc_reg,    $usu_reg );
			
	
						$rspta=$rmhd->insertar_reloj($id_trab,$fecha, $fec_reg, $pc_reg,  $usu_reg, $hora_ing,  $hora_sal,$id_tip_plan, $dia, $est_hor, $id_turno); 

						

					    

					   //DIA NO LABORABLE SEGUN TABLA DE FECHAS Y NO TIENE HORA DE INGRESO  ASIGNADO
					    if ($hora_ingreso_sh=='00:00:00' AND  $estado=='LABORABLE'  AND  $id_excep=='') {

					    	//CASO ELASTICOS - SABADOS
					    	$hora_inicio=$hora_ing;
						    $hora_fin= $hora_sal;
						    $por_pago='25';

					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


					    //DIA NO LABORABLE(DOMINGO) O FERIADO SEGUN TABLA DE FECHAS Y NO TIENE HORA DE INGRESO ASIGNADO
					    }else if ($hora_ingreso_sh=='00:00:00' AND  $estado=='NO LABORABLE' OR $estado=='FERIADO' AND  $id_excep=='') {

					    	
					    	$hora_inicio=$hora_ing;
						    $hora_fin= $hora_sal;
						    $por_pago='100';


						    if($id_casovigilancia==$id_trab AND $cant_dif_hssh_hsre>='14400'and  $cant_dif_hssh_hsre>='43200' ) {

							$tiempo_fin='12:00:00';
					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

					    	}else if ($id_casovigilancia!=$id_trab) {

					    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

					    	}


					    }else if ($hora_ingreso_sh!='00:00:00'  AND  $estado=='LABORABLE' AND  $id_excep=='' ) {
					   //DIA LABORABLE SEGUN HORARIO 
					    	 $por_pago='25';//General

					    	


							    	//CASO1: REGISTRAR HORAS EXTRAS ANTES DE LA HORA DE INGRESO
								    if ($hora_ingreso_sh>$hora_ing  AND  $cant_dif_hish_hire>='3600'  AND $cant_dif_hish_hire<='43200') {
								    	
								    	 $hora_inicio=$hora_ing;
								    	 $hora_fin= $hora_ingreso_sh;
								    	 $cantidad= $dif_hish_hire;
								    	 $tiempo_fin=$tiempo_redondeado_ing;  




								    	$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


								    }


								    //CASO2: REGISTRAR HORAS EXTRAS ANTES DESPUES DE LA HORA DE SALIDA
								    if ($hora_salida_sh<$hora_sal  AND  $cant_dif_hssh_hsre>='3600'  AND $cant_dif_hssh_hsre<='43200') {

								    	$hora_inicio=$hora_salida_sh;
								    	$hora_fin= $hora_sal;
								    	$cantidad= $dif_hssh_hsre;
								    	$tiempo_fin=$tiempo_redondeado_sal;  


													    //CASO VIGILANCIA 
												    	if ($id_trab==$id_casovigilancia) {


														    		//SI SUPERA LA HORAS MAXIMA PAGABLES SE LE PAGARA SOLO LA CANTIDAD MAXIMA
														    		if ($cant_dif_hssh_hsre>='14400' ) {
														    			$tiempo_fin=$cantidad_horas;
														    			$por_pago=$por_pago_vig;

														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}else if ($cant_dif_hssh_hsre<'14400') {
														    		//SI ES MENOR DE  LAS HORAS MAXIMAS PAGABLES SE LE PAGARA LAS HORAS REALIZADAS
														    			
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}


												    		

												    	//CASO MOVILIDAD
												    	}else if ($id_trab==$id_casomovilidad) {


														    		//SI SUPERA LA HORAS MAXIMA PAGABLES SE LE PAGARA SOLO LA CANTIDAD MAXIMA
														    		if ($cant_dif_hssh_hsre>='14400' ) {
														    			$tiempo_fin=$canthoras_mov;
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}else if ($cant_dif_hssh_hsre<'14400') {
														    		//SI ES MENOR DE  LAS HORAS MAXIMAS PAGABLES SE LE PAGARA LAS HORAS REALIZADAS
														    			
														    			$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


														    		}
												    		

												    		



												    	//NO ES CASO MOVILIDAD NI VIGILANCIA
												    	}else if ($id_trab!=$id_casomovilidad AND $id_trab!=$id_casovigilancia) {

												    				$rspta=$rmhd->registrar_hora_extra($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


												    	}
								    	
								    }

								    //CASO3: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO PERO ANTES DEL INICIO DE SU REFRIGERIO ASIGNADO - OK
								    
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_ini_ref>=$hora_ing ) {

								    	$hora_inicio=$hora_ingreso_sh;
								    	$hora_fin= $hora_ing;
								    	$cantidad= $dif_hish_hire;
								    	$tiempo_des= $dif_hish_hire;
								    	$tiempo_fin=$tiempo_redondeado_ing_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


									//CASO4: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO PERO DESDE EL INICIO O HASTA LA FINALIZACION DE SU REFRIGERIO ASIGNADO
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_ini_ref<=$hora_ing  and $hora_fin_ref>=$hora_ing  ) {

								    	

								    	$hora_inicio=$hora_ingreso_sh;
								    	$hora_fin= $hora_ini_ref;
								    	$cantidad= $dif_hish_hiref;
								    	$tiempo_des= $dif_hish_hiref;
								    	$tiempo_fin=$tiempo_redondeado_ingconref_dscto;

								    	


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


								    //CASO5: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO DESPUES DE LA HORA FIN  DE SU REFRIGERIO -  OK
								    if ($hora_ingreso_sh<$hora_ing  AND $hora_fin_ref<$hora_ing  ) {

								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	


								    } 


								    //CASO5: REGISTRAR HORAS FALTAS  CUANDO SALIO ANTES DE LA HORA DE SALIDA PERO DESPUES DE SU REFRIFERIO - OK 
								    if ($hora_salida_sh>$hora_sal  AND $hora_fin_ref<$hora_sal    ) {


								    	$hora_inicio=$hora_sal;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hssh_hsre;
								    	$tiempo_des= $dif_hssh_hsre;
								    	$tiempo_fin=$tiempo_redondeado_sal_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	
								    } 


								    //CASO6: REGISTRAR HORAS FALTAS  CUANDO SALIO ANTES DE LA HORA DE SALIDA PERO ANTES DE SU REFRIFERIO OK
								    if ($hora_salida_sh>$hora_sal  AND $hora_ini_ref>=$hora_sal AND $hora_sal!='00:00:00' AND $hora_sal!='' ) {


								    	$hora_inicio=$hora_sal;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hssh_hsre;
								  
								    	$tiempo_fin=$tiempo_redondeado_salconref_dscto;

								    	$tiempo_ref=$tiempo_refrigerio;


								    	$tiempo_des=$tiempo_salconref_dscto;


								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								            	
								    } 


								      //CASO7: REGISTRAR HORAS FALTAS  CUANDO SALIO DENTRO DE SU HORARIO DE REFRIFERIO Y ANTES DE QUE TERMINE -  OK 
								    if ($hora_salida_sh>$hora_sal  AND $hora_ini_ref<=$hora_sal AND  $hora_fin_ref>=$hora_sal  ) {


								    	$hora_inicio=$hora_fin_ref;
								    	$hora_fin= $hora_salida_sh;
								    	$cantidad= $dif_hfref_hsre_ref;
								    	$tiempo_fin=$tiempo_redondeado_salconfinref_dscto;
								    	$tiempo_des=$tiempo_salconfinref_dscto;


								    	



								    	$rspta=$rmhd->registrar_dscto_despuesdelingresorefrigerio($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $fec_reg, $pc_reg, $usu_reg);
								        

								    } 










					    }





					    	echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";


 




				} else{ 

					echo  "No se registro, verifique su información"; // CUando no ingresa a ninguno de los casos

					} 




				

			
		}
		else {
			
			echo $rspta ? "Actualizado" : "No se puede actualizar la información, debe realizar un nuevo registro";
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
 				
 				"0"=>$reg->marca,
 				"1"=>$reg->fecha,
 				"2"=>$reg->sucursal_anexo,
 				"3"=>$reg->area_trab,
 				"4"=>$reg->nombres,
 				"5"=>($reg->est_reg)?' <button class="btn btn-success" onclick="mostrar('.$reg->id_rmhd.')"><i class="fa fa-pencil"></i></button>':
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