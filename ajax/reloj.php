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


$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		$codigo_ingresado=$reloj->consultar_turno($id_trab);
        $regc=$codigo_ingresado->fetch_object();
        $id_turno=$regc->id_turno;

       // console.log($ID_TURNO);
       

		 if($id_turno=='1'){
		 $est_hor='D';
		 }else if($id_turno=='2'){
		 $est_hor='N';
		 }


		$codigo_ingresado=$reloj->consultar_ultimoregistro_xtrabajador($id_trab);
        $regc=$codigo_ingresado->fetch_object();
        $fecha_noche=$regc->fecha_noche;
        $hor_sal_noche=$regc->hor_sal_noche;



        $codigo_ingresado=$reloj->consultar($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $codigo=$regc->id_trab;

        $data_personal=$reloj->consultarDataPersonal($id_trab);
        $dp=$data_personal->fetch_object();
        $id_tip_plan=$dp->id_tip_plan;
        //$id_turno=$dp->id_turno;

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
        $hora_ini_ref=$regc->hora_ini_ref;
        $tiempo_ref=$regc->tiempo_ref;
        $estado=$regc->estado;


        $codigo_ingresado=$reloj->restadehorasderefrigerio($id_trab, $tiempo, $tiempo_ref);
        $regc=$codigo_ingresado->fetch_object();
        $tiempo_dscto=$regc->tiempo_dscto;


        $codigo_ingresado=$reloj->consultarpermisoenesedia($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $id_permiso=$regc->id_permiso;


        $codigo_ingresado=$reloj->consultaridfechaasociada_horaextra($fecha);
        $regc=$codigo_ingresado->fetch_object();
        $id_cp_he=$regc->id_cp_he;


        $codigo_ingresado=$reloj->consultaridfechaasociada_descuentos($fecha);
        $regc=$codigo_ingresado->fetch_object();
        $id_cp_des=$regc->id_cp_des;

        // $id_cp x id_cp_des


        // $codigo_ingresado=$reloj->consultarDiaLaborable($fecha);
        // $regc=$codigo_ingresado->fetch_object();
        // $dia_lab=$regc->dia_lab;
        //INICIO - Informacion para editar el tiempo de horas_extras ya registrada

        $codigo_ingresado=$reloj->consultarHoraSalida_HoraExtra($id_trab, $fecha, $hora);
		$regc=$codigo_ingresado->fetch_object();
	    $hora_salida=$regc->hora_sal;
		$tiempo_largo_hs_he=$regc->tiempo_largo_hs_he;
		$cant_tiempo_hs_he=$regc->cant_tiempo_hs_he;
		$estado=$regc->estado;
		$hora_salida_sh=$regc->hora_salida_sh;
	    $hora_ingreso_sh=$regc->hora_ingreso_sh;
	    $tiempo_fin_25=$regc->tiempo_fin_25;
	    $tiempo_largo_35=$regc->tiempo_largo_35;





	    $codigo_ingresado=$reloj->consultarHoraSalida_HoraExtra_TurnoNoche($id_trab, $fecha_noche, $hora);
		$regc=$codigo_ingresado->fetch_object();
	    $tiempo_largo_hs_he_tn=$regc->tiempo_largo_hs_he_tn;
		$cant_tiempo_hs_he_tn=$regc->cant_tiempo_hs_he_tn;
		$hora_salida_sh_tn=$regc->hora_salida_sh_tn;
		$hora_ingreso_sh_tn=$regc->hora_ingreso_sh_tn;


	

		$codigo_ingresado=$reloj->consultarCasoVigilancia($id_trab, $fecha, $hora);
		$regc=$codigo_ingresado->fetch_object();
		$id_casovigilancia=$regc->id_casovigilancia;
	    $cantidad_horas=$regc->cantidad_horas;
		$fedo_canhoras_max=$regc->fedo_canhoras_max;
		$por_pago_vig=$regc->por_pago_vig;

		
	
		


		$codigo_ingresado=$reloj->consultarCasoMovilidad($id_trab, $fecha, $hora);
		$regc=$codigo_ingresado->fetch_object();
		$id_casomovilidad=$regc->id_casomovilidad;
		$canthoras_mov=$regc->canthoras_mov;


		$codigo_ingresado=$reloj->consultarDiferenciaHE_DOyFE($id_trab, $fecha, $hora);
		$regc=$codigo_ingresado->fetch_object();
		$tiempo_HE_DOyFE=$regc->tiempo_HE_DOyFE;
		$cantidad_HE_DOyFE=$regc->cantidad_HE_DOyFE;      


		/*EXCEPCIONES DE HORARIO Y PAGO */  

		$dato=$reloj->consultar_Excepciones_Horario_Pago($id_trab);
		$regc=$dato->fetch_object();
		$id_trab_excep=$regc->id_trab_excep;


		//CONSULTAR DIFERENCIA ENTRE LA HORA ACTUAL Y LA SALIDA CUANDO UN TRABAJADOR SALE DE PERMISO LUEGO DE HABER INGRESADO
		$dato=$reloj->consultar_Diferencia_HActual_HoraSalida($hora, $hora_salida_sh);
        $regc=$dato->fetch_object();
        $tiempo_largo_ha_hs=$regc->tiempo_largo_ha_hs;
        $cant_tiempo_ha_hs=$regc->cant_tiempo_ha_hs;

        //CONSULTAR SI EL TRABAJADOR ESTA DE  VACACIONES COMPRADAS
		$dato=$reloj->consultarVacacionesCompradas($id_trab, $fecha);
        $regc=$dato->fetch_object();
        $id_vacaciones_compradas=$regc->id_vacaciones_compradas;


        //CONSULTAR SI EL TRABAJADOR ESTA DE  VACACIONES 
		$dato=$reloj->consultarVacaciones($id_trab, $fecha);
        $regc=$dato->fetch_object();
        $id_vacaciones=$regc->id_vacaciones;

/**************INICIO DATOS PARA VACACIONES COMPRADAS**********************/


	    $codigo_ingresado=$reloj->consultar_reloj_vacaciones_compradas($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $codigo_vc=$regc->id_trab;
        $hor_ent_vc=$regc->hor_ent;
        $hor_sal_vc=$regc->hor_sal;



		//CONSULTA CUAL FUE SU HORA DE INGRESO Y SALIDA  SEGUN DEL DIA SELECCIONADO
		$dato=$reloj->consultar_IngresoSalida_SegunReloj($id_trab, $fecha, $hora ) ;
		$regc=$dato->fetch_object();
		$hora_salida_sh_vc=$regc->hora_salida_sh_vc;
		$hora_ingreso_sh_vc=$regc->hora_ingreso_sh_vc;
		$cant_dif_hish_hire_vc=$regc->cant_dif_hish_hire_vc;
		$dif_hish_hire_vc=$regc->dif_hish_hire_vc;
		$cant_dif_hssh_hsre_vc=$regc->cant_dif_hssh_hsre_vc;
		$dif_hssh_hsre_vc=$regc->dif_hssh_hsre_vc;
		$hora_ini_ref_vc=$regc->hora_ini_ref_vc;
		$hora_fin_ref_vc=$regc->hora_fin_ref_vc;
		$dif_hish_hire_ref_vc=$regc->dif_hish_hire_ref_vc;
		$dif_hish_hiref_vc=$regc->dif_hish_hiref_vc;
		$dif_hihevc_hsre_vc=$regc->dif_hihevc_hsre_vc;



		//PARA HORAS EXTRAS
		$tiempo_ing_vc=$dif_hish_hire_vc;
		$tiempo_sal_vc=$dif_hssh_hsre_vc;
		$tiempo_hihevc_hsre_vc=$dif_hihevc_hsre_vc;

		

		$dato=$reloj->calcular_redondeo_tiempo_vc($tiempo_ing_vc, $tiempo_sal_vc, $tiempo_hihevc_hsre_vc);
		$regc=$dato->fetch_object();
		$tiempo_redondeado_ing_vc=$regc->tiempo_redondeado_ing_vc;  
		$tiempo_redondeado_sal_vc=$regc->tiempo_redondeado_sal_vc;  
		$tiempo_redondeado_hihevc_hsre_vc=$regc->tiempo_redondeado_hihevc_hsre_vc;  

		//FIN PARA HORAS EXTRAS


		//PARA HORAS DSCTO
		$tiempo_ing_dscto_vc=$dif_hish_hire_vc;
		$tiempo_sal_dscto_vc=$dif_hssh_hsre_vc;
		$tiempo_ing_ref_dscto_vc=$dif_hish_hire_ref_vc;
		$tiempo_ing_iniref_dscto_vc=$dif_hish_hiref_vc;
		

		$dato=$reloj->calcular_redondeo_tiempo_dscto_vc($tiempo_ing_dscto_vc, $tiempo_sal_dscto_vc,  $tiempo_ing_ref_dscto_vc, $tiempo_ing_iniref_dscto_vc);
		$regc=$dato->fetch_object();
		$tiempo_redondeado_ing_dscto_vc=$regc->tiempo_redondeado_ing_dscto_vc;  
		$tiempo_redondeado_sal_dscto_vc=$regc->tiempo_redondeado_sal_dscto_vc; 
		$tiempo_redondeado_ing_ref_dscto_vc=$regc->tiempo_redondeado_ing_ref_dscto_vc; 
		$tiempo_redondeado_ing_iniref_dscto_vc=$regc->tiempo_redondeado_ing_iniref_dscto_vc; 
		 



		//FIN PARA HORAS DSCTO






        


/**************FIN DATOS PARA VACACIONES COMPRADAS**********************/

       

        
       if ($id_vacaciones_compradas==$id_trab) {
       //EN CASO QUE  TENGA VACACIONES COMPRADAS

       	 
			if ($codigo_vc==''){

			    //Ingresa a la tabla de reloj_vacacionescompradas
				$rspta=$reloj->insertar_reloj_vacacionescompradas($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
				echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";

					
				    if ($estado=='LABORABLE') {

									if ($hora_ingreso_sh_vc>$hora  AND  $cant_dif_hish_hire_vc>='3600'  AND $cant_dif_hish_hire_vc<='43200') {
									//INGRESO ANTES DE LA HORA SEGUN SU HORARIO
										
										$hora_inicio=$hora;
									    $hora_fin= $hora_ingreso_sh_vc;
										$cantidad= $dif_hish_hire_vc;
										$tiempo_fin=$tiempo_redondeado_ing_vc; 
										$id_fec_abono=$id_cp_des; 
										$por_pago='0';

										$rspta=$reloj->registrar_hora_extra_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);


									}else if ($hora_ingreso_sh_vc<$hora  AND $hora_ini_ref_vc>=$hora ) {
									//INGRESO DESPUES DE LA HORA DE ENTRADA SEGUN SU HORARIO 

											$hora_inicio=$hora_ingreso_sh_vc;
											$hora_fin= $hora;
											$cantidad= $dif_hish_hire_vc;
											$tiempo_des= $dif_hish_hire_vc;
											//$tiempo_fin= $tiempo_redondeado_ing_dscto_vc;
											$id_fec_dscto=$id_cp_des; 

											//Tiempo de Tolerancia 15 MINUTOS
											if ($cant_dif_hish_hire_vc<='900') { //NO DESCONTARA
													$tiempo_fin='00:00:00';
													$descontar='2';
													$habilitar_dscto='2';
											}else if ($cant_dif_hish_hire_vc>'900') { //SI DESCONTAR 
													$tiempo_fin=$tiempo_redondeado_ing_dscto_vc;
													$descontar='1';
													$habilitar_dscto='1';
											}

											$tiempo_ref='00:00:00';
											$rspta=$reloj->registrar_hora_dscto_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $habilitar_dscto, $fec_reg, $pc_reg, $usu_reg);					          

									}else if ($hora_ingreso_sh_vc<$hora  AND $hora_ini_ref_vc<=$hora  and $hora_fin_ref_vc>=$hora) { 
										//CASO: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO PERO DESDE EL INICIO O HASTA LA FINALIZACION DE SU REFRIGERIO ASIGNADO
										
										$hora_inicio=$hora_ingreso_sh_vc;
										$hora_fin= $hora_ini_ref_vc;
										$cantidad= $dif_hish_hiref_vc;
										$tiempo_des= $dif_hish_hiref_vc; 
										$tiempo_fin=$tiempo_redondeado_ing_iniref_dscto_vc;

										$tiempo_ref='00:00:00';

										$descontar='1';
										$habilitar_dscto='1';
										$id_fec_dscto=$id_cp_des; 
									

										$rspta=$reloj->registrar_hora_dscto_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $habilitar_dscto, $fec_reg, $pc_reg, $usu_reg);					          


									}else if ($hora_ingreso_sh_vc<$hora  AND $hora_fin_ref_vc<$hora  ) {
										//CASO5: REGISTRAR HORAS FALTAS  DESPUES DE LA HORA DE INGRESO DESPUES DE LA HORA FIN  DE SU REFRIGERIO -  OK

										$hora_inicio=$hora_ingreso_sh_vc;
										$hora_fin= $hora;
										$cantidad= $dif_hish_hire_vc;
										$tiempo_des= $dif_hish_hire_ref_vc;
					                    $tiempo_fin= $tiempo_redondeado_ing_ref_dscto_vc;

					                    $descontar='1';
										$habilitar_dscto='1';
										$id_fec_dscto=$id_cp_des; 
									

										$rspta=$reloj->registrar_hora_dscto_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $habilitar_dscto, $fec_reg, $pc_reg, $usu_reg);					          

									}


					}else if($estado!='LABORABLE') {
						//CASO: REGISTRA AQUELLOS QUE SON FERIADOS O NO LABORABLE - CREA UNA LINEA VACIA EN LA HORAS EXTRAS

						$hora_inicio=$hora;
						$hora_fin= '00:00:00';
						$cantidad= '00:00:00';
						$tiempo_fin= '00:00:00'; 
						$id_fec_abono=$id_cp_des; 
						$por_pago='100';

						$rspta=$reloj->registrar_hora_extra_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

					}





			} else if ($codigo_vc==$id_trab) {


				//Actualiza la hora de salida en la tabla de reloj_vacacionescompradas
				$rspta=$reloj->editar_primera_salida_vc($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
				echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";

				if($estado=='LABORABLE') {

						if ($hora_salida_sh_vc<$hora  AND  $cant_dif_hssh_hsre_vc>='3600'  AND $cant_dif_hssh_hsre_vc<='43200') {

							$hora_inicio=$hora_salida_sh_vc;
						    $hora_fin= $hora;
							$cantidad= $dif_hssh_hsre_vc;
							$tiempo_fin=$tiempo_redondeado_sal_vc; 
							$id_fec_abono=$id_cp_des; 
							$por_pago='0';

							$rspta=$reloj->registrar_hora_extra_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_fin, $id_fec_abono,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);

						}else if ($hora_salida_sh_vc>$hora) {

							$descontar='1';
							$habilitar_dscto='1';

							$hora_inicio= $hora;
							$hora_fin= $hora_salida_sh_vc;
							$cantidad= $dif_hssh_hsre_vc;
							$tiempo_des= $dif_hssh_hsre_vc;
							$tiempo_fin=$tiempo_redondeado_sal_dscto_vc; 
							$id_fec_dscto=$id_cp_des; 

							$tiempo_ref='00:00:00';
							$rspta=$reloj->registrar_hora_dscto_vacaciones($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad,  $tiempo_ref, $tiempo_des,  $tiempo_fin,  $id_incidencia,  $id_permiso,  $id_fec_dscto, $descontar, $habilitar_dscto, $fec_reg, $pc_reg, $usu_reg);
											        
						}

				}else if ($estado!='LABORABLE') {


							$hora_fin= $hora;

							$cantidad= $dif_hihevc_hsre_vc;

							$tiempo_fin=$tiempo_redondeado_hihevc_hsre_vc;
						

						$rspta=$reloj->actualizar_hora_extra_vacaciones($id_trab, $fecha,  $hora_fin, $cantidad, $tiempo_fin,  $fec_reg, $pc_reg, $usu_reg);

				}



			}

										

       		



/*************************************************************************************************************************************************************/
      
       }else if ($id_vacaciones_compradas!=$id_trab AND  $id_vacaciones!=$id_trab ) { 
       	//EN CASO QUE  NO TENGA VACACIONES COMPRADAS
       	
     
				    	

						$por_pago='25';

				        if ($id_turno=='1') { //TURNO DIA 

				        									//PRIMER REGISTRO COMO HORA DE INGRESO DENTRO DEL RELOJ
							 	if ($codigo==''){



									 		if ($id_permitido=='') {


									 		}else if ($id_permitido==$id_trab) {


									 				if ($estado=='LABORABLE') {
									 					

												 					//INICIO - REGISTRO DE HORAS PERMISO ANTES DE LA HORA DE INGRESO ESTABLECIDO, horas despues de su hora de entrada  
														            if ($hora_ingreso<$hora  AND $hora_ingreso!='00:00:00' ) {
														            	//15:08:00 < 08:00:00
														            		$id_incidencia='0';
														            		if ($id_permiso=='' ) {
														            			$id_incidencia='2';
														            			# code...
														            		}else  {
														            			$id_incidencia='1';
														            		}

														            		//Tiempo de Tolerancia 5 MINUTOS
														            		if ($cantidad_tiempo<='900') {
														            			$descontar='2';
														            		}else if ($cantidad_tiempo>'900') {
														            			$descontar='1';
														            		}



															            	if ( $hora_fin_ref<$hora ) { // Si la 15:00:00  es mayor a su hora almuerzo asignado 14:00:00
															            		
															            		// INICIO - Agregado el  061222018(Leydi Godos) 
															            		$tiempo=$tiempo_dscto;
														 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas($tiempo);
																				$regc=$dato->fetch_object();
																				$tiempo_dscto=$regc->tiempo_redondeado_falta;  

														 				 		// FIN - Agregado el  061222018(Leydi Godos)
																				//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
														 				 		$id_cp=$id_cp_des;


															            		$rspta=$reloj->registrar_hora_permiso($id_trab, $fecha, $hora, $tiempo_ref,  $hora_ingreso, $tiempo, $tiempo_dscto, $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);
															            	} else if ( $hora_fin_ref>$hora ) {// Si la hora de ingreso (13:15:00) es menor que  a su hora almuerzo asignado 14:00:00
															            		
															            		// INICIO - Agregado el  061222018(Leydi Godos) 
														 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas($tiempo);
																				$regc=$dato->fetch_object();
																				$tiempo_dscto=$regc->tiempo_redondeado_falta;  
														 				 		// FIN - Agregado el  061222018(Leydi Godos)

																				//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
														 				 		$id_cp=$id_cp_des;
															            		$rspta=$reloj->registrar_hora_permiso_sinrefrigerio($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);
															            	}
														            

														            }//FIN - REGISTRO DE HORAS PERMISO ANTES DE LA HORA DE INGRESO ESTABLECIDO
														            	

														 				//INICIO - REGISTRO DE HORAS EXTRAS ANTES DE LA HORA DE INGRESO ESTABLECIDO  EN UN DIA LABORABLE
														 				 if ($hora_ingreso>$hora  AND  $cantidad_tiempo>='3600'  ) {


														 				 		// INICIO - Agregado el  051222018(Leydi Godos) 
														 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																				$regc=$dato->fetch_object();
																				$tiempo_redondeado=$regc->tiempo_redondeado;  

														 				 		// FIN - Agregado el  051222018(Leydi Godos)

														 				 	//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
														 				  	$id_cp=$id_cp_he;

															            	$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
															            }else if ($hora_ingreso=='00:00:00') {
														 				 //INICIO - REGISTRO DE HORAS EXTRAS DE UN DIA LABORABLE PERO SIN INGRESO - CASO ELASTICOS / POR SU HORARIO NO ES NECESARIO QUE VENGAN 
														 				 	$tiempo='00:00:00'; 
														 				 	$id_cp=$id_cp_he;
															            	$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 															         
															           }

									 				}else if ($estado!='LABORABLE') {//DIAS FERIADOS Y NO LABORABLES QUE PERSONAS ASISTEN
									 					
												            $tiempo='00:00:00';
												            $hora_ingreso='00:00:00';
											 				$id_cp=$id_cp_he;
											 				$por_pago='100';

												            $rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
												     
									 				}
					  									



									 		}


									 		$rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
											echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";


							 		        


								
					            }else{

					            	// 1.- REGISTRO DE HORA DE SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
					            	if ($primera_salida=='' OR $primera_salida=='00:00:00' ) { //Actualizado de '' a '00:00:00' 30/11/2018


					            		 $codigo_ingresado=$reloj->consultarIngresoEnReloj($id_trab, $fecha, $hora);
										 $regc=$codigo_ingresado->fetch_object();
										 $intervalo_1ing_1sal=$regc->intervalo_1ing_1sal;

					            		if ($intervalo_1ing_1sal<='900') {
					            			# code...
					            		}
					            		else if ($intervalo_1ing_1sal>'900') {

					            		//	$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
									    
									    //EJECUTA PARA TODOS (INGRESA HORA DE SALIDA)
										$rspta=$reloj->editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 

					            		
						            		if ($id_permitido=='') {
										 	}else if ($id_permitido==$id_trab) {


										         	    $id_trab=$id_trab;
										         	    $codigo_ingresado=$reloj->consultarHoraExtra($id_trab, $fecha, $hora);
												        $regc=$codigo_ingresado->fetch_object();
												        $tiempo=$regc->tiempo_largo;
												       //Porcentaje pago sr.pascual

														//CASOS:
													    //1. PRIMER CASO: REGISTRAR HORA EXTRA DESPUES DE SU SALIDA(DIA LABORADBLE)
														//2. SEGUNDO CASO: REGISTRAR HORAS PERMISOS ANTES DE LA SALIDA

														if ($estado=='LABORABLE') {
																

																   //1. PRIMER CASO  //VALIDA QUE SOLO INGRESE A HORAS EXTRAS DESPUES DE SU HORA DE SALIDA  SEGUN HORARIO  (DIA LABORABLE)
															        if ($hora_salida<$hora ) {

																				        //DIA DONDE TIENE SU HORARIO DE INGRESO '00:00:00' PERO SI LABORABLE - CAOS DE ELASTICOS SABADOS
																				        if ($hora_ingreso=='00:00:00' and $cant_tiempo_hs_he>='3600' AND $id_trab!=$id_trab_excep  ) {

																				        	// INICIO - Agregado el  051222018(Leydi Godos) 
																				        		    $var_tiempo=$tiempo;
																			 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																									$regc=$dato->fetch_object();
																									$tiempo_redondeado=$regc->tiempo_redondeado;  
																			 				 	// FIN - Agregado el  051222018(Leydi Godos)

																									$tiempo_fin=$tiempo_redondeado;
																									$tiempo=$var_tiempo;
																				        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago ); 
																				        	
																				        }else if ($hora_salida!='00:00:00' and $cant_tiempo_hs_he>='3600' AND $id_trab!=$id_trab_excep  )  
																				        {

																				        //	$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
																				        
																				        	if($id_trab!=$id_casovigilancia  OR $id_trab!=$id_casomovilidad )
																				        	{
																				        		

																				        		if ( $cant_tiempo_hs_he>='14400' ) {

																				        			$hor_inicio=$hora; /*VAriable que luego se utilizara para el segundo registro*/

																									$id_cp=$id_cp_he;
																				        			$tiempo_redondeado='03:00:00';
																				        			$tiempo_largo_hs_he='03:00:00';
																				        			$por_pago='25';
																				        			$hora=$tiempo_fin_25;

																				        			


																				        			$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 


																				        				

	 																							   $tiempo=$tiempo_largo_35;
																			 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																									$regc=$dato->fetch_object();
																									$tiempo_redondeado=$regc->tiempo_redondeado; 

																									$hora_salida=$tiempo_fin_25; /*Hora inicio*/
																									$hora=$hor_inicio; /*Hora fn*/
																									$por_pago='35';
																									$tiempo_largo_hs_he=$tiempo_largo_35;

																									$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 



																				        		
																				        		}else if ($cant_tiempo_hs_he<'14400' ) {

																				        			// INICIO - Agregado el  051222018(Leydi Godos) 
																				        		    $tiempo=$tiempo_largo_hs_he;
																			 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																									$regc=$dato->fetch_object();
																									$tiempo_redondeado=$regc->tiempo_redondeado;  
																			 				 	    // FIN - Agregado el  051222018(Leydi Godos)
																								    //Reemplaza el id_cp_des correspondinete al cronograma de horas extras
																			 				  	    $id_cp=$id_cp_he;
																				        			$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
																				        		   /*Que sea de elasticos - Contabiliza horas normales*/

																				        		}

																				        	
																				        	}
																				        	else if ($id_trab==$id_casovigilancia and $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<='43200' and $estado=='LABORABLE' AND $id_trab!=$id_trab_excep ) 
																				        	{
																				        	
																				        		$tiempo_largo_hs_he=$cantidad_horas;
																				        	//	$tiempo=$cantidad_horas;
																				        	//	$hora_ingreso=$hora;
																				        	//	$hora=$hora_salida;

																				        		// INICIO - Agregado el  051222018(Leydi Godos) 
																				        		    $tiempo=$tiempo_largo_hs_he;
																			 				 		
																			 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																									$regc=$dato->fetch_object();
																									$tiempo_redondeado=$regc->tiempo_redondeado;  

																			 				 	// FIN - Agregado el  051222018(Leydi Godos)

																				        	  //Reemplaza el id_cp_des correspondinete al cronograma de horas extras
																			 				  	$id_cp=$id_cp_he;

																				        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado, $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 

																				        	//	$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg);  
																				        



																				        	} else if ($id_trab==$id_casomovilidad and $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<'43200' and $estado=='LABORABLE' AND $id_trab!=$id_trab_excep ) {
																				        		$tiempo_largo_hs_he=$canthoras_mov;


																				        		// INICIO - Agregado el  051222018(Leydi Godos) 
																				        		    $tiempo=$tiempo_largo_hs_he;
																			 				 	
																			 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																									$regc=$dato->fetch_object();
																									$tiempo_redondeado=$regc->tiempo_redondeado;  

																			 				 	// FIN - Agregado el  051222018(Leydi Godos)

																									//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
																			 				  	$id_cp=$id_cp_he;
																				        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 


																				        	//DIA LABORABLE QUE REGISTRA HORAS EXTRAS 
																				        	} 

																				        	 //DIA DONDE NO REGISTRA HORARIO ASOCIADO DE INGRESO(FERIADO, DOMINGO(DIA NO LABORABLE) 
																				        } else if ($hora_ingreso=='00:00:00' AND $id_trab!=$id_trab_excep) 
																				        {	

																				        	if ($estado=='NO LABORABLE' OR $estado=='FERIADO') {
																				        	     $por_pago='100';
																				        	}else {
																				        	     $por_pago='25';
																				        	}

																				        	
																				        	if ($id_trab==$id_casovigilancia or $id_trab==$id_casomovilidad and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200' ) {
																				        		// CASOS ESPECIALES(VIGILANCIA Y MOVILIDAD ) FERIADO, DOMINGO, DIA NO LABORABLE)
																				        		$tiempo_fin=$tiempo;
																				        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin,  $por_pago );

																				        	}else if ($cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200') {
																				        		$tiempo_fin=$tiempo;
																				        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago );

																				        	}else if ($id_trab==$id_casovigilancia and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {
																				        		$tiempo_fin=$fedo_canhoras_max;
																				        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago );


																				        	}else if ( $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {

																				        		$tiempo_fin='12:00:00';
																				        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago );

																				        	}


																		         		}

															        	
																	//2. SEGUNDO CASO  //VALIDA QUE INGRESE HORAS DE PERMISO ANTES DE LA SALIDA  SEGUN HORARIO  (DIA LABORABLE)						       
															        }  else if ($hora_salida>$hora ) {

															        		$id_incidencia='0';
														            		if ($id_permiso=='' ) {
														            			$id_incidencia='2';
														            			# code...
														            		}else  {
														            			$id_incidencia='1';
														            		}

														            		//Tiempo de Tolerancia
														            		if ($cantidad_tiempo<='900') {
														            			$descontar='2';
														            		}else if ($cantidad_tiempo>='900') {
														            			$descontar='1';
														            		}


														            		//CASO 1
														            		//LA HORA DE SALIDA REGISTRADO CON LA TARJETA ES MAYOR A LA HORA FIN DEL REFRIGERIO
															            	if ( $hora_fin_ref<$hora ) { 
															            		//14:00 pm < 15:20:00
															            		//14:00 pm < 15:40:00
																				$tiempo_des=$tiempo_largo_ha_hs;

															            		// INICIO - Agregado el  061222018(Leydi Godos)
														 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas_permisoconingreso($tiempo_largo_ha_hs);
																				$regc=$dato->fetch_object();
																				$tiempo_dscto=$regc->tiempo_redondeado_falta;  
														 				 		// FIN - Agregado el  061222018(Leydi Godos)

																				//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
														 				 		$id_cp=$id_cp_des;
														 				 		$tiempo_ref='00:00:00';
															            		$rspta=$reloj->registrar_hora_permiso_despuesdelingreso_sin_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,   $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);
															            	

															            	//CASO 2
														            		//LA HORA DE SALIDA REGISTRADO CON LA TARJETA ES MENOR A LA HORA FIN DEL REFRIGERIO Y MAYOR QUE LA HORA DE INICIO DEL REFRIGERIO 
															            	} else if ( $hora>=$hora_ini_ref  AND  $hora<=$hora_fin_ref ) {
															            	   //13:15 pm < 14:56:00
															            	   //13:00 pm < 13:53:00
															            		
															            		$dato=$reloj->calcular_diferencia_tiempodscto_tiemporef($hora_fin_ref, $hora_salida_sh);
																				$regc=$dato->fetch_object();
																				$tiempo_largo_ha_hs=$regc->tiempo_dscto_con_ref;  //SE ESTA USANDO LA MISMA FUNCION 

																				//HORA FIN DEL REFRIGERIO PASA A SER LA HORA DE INICIO DEL PERMISO
																				$hora=$hora_fin_ref;

															            		// INICIO - Agregado el  061222018(Leydi Godos)
														 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas_permisoconingreso($tiempo_largo_ha_hs);
																				$regc=$dato->fetch_object();
																				$tiempo_dscto=$regc->tiempo_redondeado_falta;  
														 				 		// FIN - Agregado el  061222018(Leydi Godos)

																				//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
														 				 		$id_cp=$id_cp_des;
														 				 		$tiempo_ref='00:00:00';
															            		$rspta=$reloj->registrar_hora_permiso_despuesdelingreso_sin_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,   $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);
															            	

															            	//CASO 3
														            		//LA HORA DE SALIDA REGISTRADO CON LA TARJETA ES MENOR A LA HORA HORA  DE INICIO DEL REFRIGERIO 
															            	// DESCONTAR AL TIEMPO DE DIFERENCIA 45 MINUTOS QUE ES EL TIEMPO ESTABLECIDO PARA EL REFRIGERIO
															            	} else if (  $hora<$hora_ini_ref){


															            		$dato=$reloj->consultar_Diferencia_HActual_HoraIngreso($hora, $hora_ingreso_sh);
																				$regc=$dato->fetch_object();
																				$cant_tiempo_hisr_hsre=$regc->cant_tiempo_hisr_hsre;  //SE ESTA USANDO LA MISMA FUNCION 
																				$tiempo_hisr_hsre=$regc->tiempo_hisr_hsre;

															            		 //Tiempo entre la hora de ingreso segun horario con hora de salida marcada
															            		 if ( $cant_tiempo_hisr_hsre<'3600' ) {

															            		 	$hora_inicio='00:00:00';
															            		 	$hora_fin='00:00:00';
															            		 	$cantidad='00:00:00';
															            		 	$tiempo_ref='00:00:00';
															            		 	$tiempo_des='00:00:00';
															            		 	$tiempo_fin='00:00:00';
															            		 	$cant_dia_fin='1';
															            		 	$id_incidencia='3';      
															            		 	$descontar='1';
															            		 	$descontado='2';
															            		 	$habilitar_dscto='2';

															            		 	//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
															 				 		$id_cp=$id_cp_des;
															            		 	$rspta=$reloj->registrar_dscto($id_trab, $fecha, $hora_inicio, $hora_fin, $cantidad, $tiempo_ref, $tiempo_des,  $tiempo_fin,  $cant_dia_fin,  $id_incidencia,   $id_cp, $descontar,  $descontado, $habilitar_dscto,  $fec_reg, $pc_reg, $usu_reg);
															            
															            		 }else if ($cant_tiempo_hisr_hsre>='3600' AND  $hora<$hora_salida_sh AND $dia=='C') {
															            		 	
															            		 	$dato=$reloj->calcular_diferencia_tiempodscto_tiemporef($tiempo_largo_ha_hs, $tiempo_ref);
																					$regc=$dato->fetch_object();
																					$tiempo_des=$regc->tiempo_dscto_con_ref;  //SE ESTA USANDO LA MISMA FUNCION 


																            		// INICIO - Agregado el  061222018(Leydi Godos)
															 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas_permisoconingreso($tiempo_des);
																					$regc=$dato->fetch_object();
																					$tiempo_dscto=$regc->tiempo_redondeado_falta;  
															 				 		// FIN - Agregado el  061222018(Leydi Godos)


																					//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
															 				 		$id_cp=$id_cp_des;
															            			$rspta=$reloj->registrar_hora_permiso_despuesdelingreso_dscto_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,   $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);												           
																				 } else if ($cant_tiempo_hisr_hsre>='3600' AND  $hora<$hora_salida_sh AND $dia!='C'  ) {
															            		 	
															            		 	$tiempo_des=$tiempo_largo_ha_hs; 
															            		 	$tiempo_ref='00:00:00';

																            		// INICIO - Agregado el  061222018(Leydi Godos)
															 				 		$dato=$reloj->calcular_redondeo_tiempo_horas_faltas_permisoconingreso($tiempo_largo_ha_hs);
																					$regc=$dato->fetch_object();
																					$tiempo_dscto=$regc->tiempo_redondeado_falta;  
															 				 		// FIN - Agregado el  061222018(Leydi Godos)

																					//Resemplaza el id_cp_des correspondinete al cronograma de descuentos
															 				 		$id_cp=$id_cp_des;
															            			$rspta=$reloj->registrar_hora_permiso_despuesdelingreso_dscto_refrigerio($id_trab, $fecha, $hora, $hora_salida_sh, $tiempo_largo_ha_hs,  $tiempo_ref, $tiempo_des,   $tiempo_dscto,  $id_incidencia,  $id_permiso,  $id_cp,  $descontar,  $fec_reg, $pc_reg, $usu_reg);												           
																				 } 



															            	}
														            


															        } 



														}else if ($estado!='LABORABLE') {

															// INICIO - Agregado el  051222018(Leydi Godos) 
																$var_tiempo=$tiempo;
																$dato=$reloj->calcular_redondeo_tiempo($tiempo);
															    $regc=$dato->fetch_object();
																$tiempo_redondeado=$regc->tiempo_redondeado;  
															// FIN - Agregado el  051222018(Leydi Godos)

																$tiempo_fin=$tiempo_redondeado;
																$tiempo=$var_tiempo;
																$por_pago='100'; 
														        $rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago ); 
																				        	


															

														}


														
													
												     
												        
												       


										         		 

											}

										}


									echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
									
									// REGISTRO DE HORA DE SEGUNDO INGRESO ACTUALIZANDO LA LINEA DEL RELOJ
					 				}else if ($segunda_entrada=='' OR $segunda_entrada=='00:00:00'  ) {


								 					 $codigo_ingresado=$reloj->consultarPrimeraSalidaEnReloj($id_trab, $fecha, $hora);
													 $regc=$codigo_ingresado->fetch_object();
													 $intervalo_1sal_2ing=$regc->intervalo_1sal_2ing;

								            		if ($intervalo_1sal_2ing<='900') {
								            			
								            		}
								            		else if ($intervalo_1sal_2ing>'900') {


											 					 $rspta=$reloj->editar_segunda_entrada($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
														    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";

							 						}




					 				}
					 				// REGISTRO DE HORA DE SEGUNDA SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
					 				else if ($segunda_salida=='') {

					 								 $codigo_ingresado=$reloj->consultarSegundoIngresoEnReloj($id_trab, $fecha, $hora);
													 $regc=$codigo_ingresado->fetch_object();
													 $intervalo_2ing_2sal=$regc->intervalo_2ing_2sal;

								            		if ($intervalo_2ing_2sal<='900') {
								            			
								            		}
								            		else if ($intervalo_2ing_2sal>'900') {
					 					 
											 					 $rspta=$reloj->editar_segunda_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
														    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
					 								}


					 				}

					            }



				        }else if ($id_turno=='2') { //TURNO NOCHE

				        	$dato=$reloj->consultarInformacionDiaAnterior($id_trab, $fecha, $hora);
							$regc=$dato->fetch_object();
							$fecha_dia_anterior=$regc->fecha_dia_anterior;
							$hora_ing_anterior=$regc->hora_ing_anterior;
							$hor_sal_anterior=$regc->hor_sal_anterior;
							$est_dia_anterior=$regc->est_dia_anterior;
							$dif_hida_hsho=$regc->dif_hida_hsho;
							$cant_dif_hida_hsho=$regc->cant_dif_hida_hsho;


							
				



							// CASO 1 EXISTIERA MARCACION DEL DIA ANTERIOR 
				        	// 	ACTUALIZAR LA FECHA DE SALIDA DEL DIA ANTERIOR, valida  que el dia anterior tenga fecha en el reloj, exista hora de ingreso y la hora de salida este vacia 

				        	 if (  $fecha_dia_anterior!='' and $hora_ing_anterior!='' AND $hor_sal_anterior=='' ) {
				        	 	    


				        	 	    $rspta=$reloj->editar_primera_salida_noche($id_trab,  $fecha_noche, $fec_reg, $pc_reg, $usu_reg, $hora); 

				        	 	    		
				        	 	    		$fecha=$fecha_noche;
				        	 	         

				        	 	           //DIA DONDE TIENE SU HORARIO DE INGRESO(LABORABLE)
									        if ($hora_salida!='' AND $cant_tiempo_hs_he>='3600'  AND $est_dia_anterior=='LABORABLE'  )  
									        {

													        	if ($id_trab==$id_casovigilancia AND $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<='43200' )
													        	{
													        		$tiempo_largo_hs_he=$cantidad_horas;
													        		$por_pago=$por_pago_vig;
													        			// INICIO - Agregado el  051222018(Leydi Godos) 
																        		    $tiempo=$tiempo_largo_hs_he;		
															 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																					$regc=$dato->fetch_object();
																					$tiempo_redondeado=$regc->tiempo_redondeado;  
															 			// FIN - Agregado el  051222018(Leydi Godos)
																		//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
															 		$id_cp=$id_cp_he;
													        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 

													        	} else if ($id_trab==$id_casomovilidad AND $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<'43200' ) {
													        		$tiempo_largo_hs_he=$canthoras_mov;
													        		  // INICIO - Agregado el  051222018(Leydi Godos) 
																        		    $tiempo=$tiempo_largo_hs_he;
															 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																					$regc=$dato->fetch_object();
																					$tiempo_redondeado=$regc->tiempo_redondeado;  
															 			// FIN - Agregado el  051222018(Leydi Godos)
																		//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
															 		$id_cp=$id_cp_he;
													        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 

													        	} elseif ($id_trab!=$id_casovigilancia AND  $id_trab!=$id_casomovilidad ) {
													        		    // INICIO - Agregado el  051222018(Leydi Godos) 
																		  $tiempo=$tiempo_largo_hs_he_tn;
																		  $dato=$reloj->calcular_redondeo_tiempo($tiempo);
																	      $regc=$dato->fetch_object();
																		  $tiempo_redondeado=$regc->tiempo_redondeado;  
																		// FIN - Agregado el  051222018(Leydi Godos)
																		//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
																	     $id_cp=$id_cp_he;
																		 $tiempo_largo_hs_he=$tiempo_largo_hs_he_tn;
															 			//INICIO - AGREGADO el dia  12/01/2019
															 			$hora_salida=$hora_salida_sh_tn;
															 			//$tiempo_redondeado  es tiempo fin  ;
													        		    $rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
													        	}




									         //DIA DONDE NO REGISTRA HORARIO ASOCIADO DE INGRESO(FERIADO, DOMINGO, DIA NO LABORABLE)
									        } else if ( $est_dia_anterior!='LABORABLE' ) 
									        {	

									        	 			$por_pago='100';
									        
												        	if ($id_trab==$id_casovigilancia or $id_trab==$id_casomovilidad and $cant_dif_hida_hsho>='43200' )
												        	{  // CASOS ESPECIALES(VIGILANCIA Y MOVILIDAD ) FERIADO, DOMINGO, DIA NO LABORABLE)
												        		$tiempo=$fedo_canhoras_max;
												        		$tiempo_fin=$fedo_canhoras_max;
												        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago );
												        	}else if ($id_trab!=$id_casovigilancia or $id_trab!=$id_casomovilidad and $cant_dif_hida_hsho>='43200')
												        	{
												        		$tiempo='12:00:00';
												        		$tiempo_fin='12:00:00';
												        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo,  $tiempo_fin, $por_pago );
												        	}else if ($cant_dif_hida_hsho<'43200') 
												        	{  // INICIO - Agregado el  051222018(Leydi Godos) 
																        		    $tiempo=$dif_hida_hsho;
															 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
																					$regc=$dato->fetch_object();
																					$tiempo_redondeado=$regc->tiempo_redondeado;  
															 	// FIN - Agregado el  051222018(Leydi Godos)
																//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
												        		$tiempo=$dif_hida_hsho;
												        		$tiempo_fin=$tiempo_redondeado;
												        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo,  $tiempo_fin, $por_pago );
												        	}



							         		}




							// 	CREAR UN REGISTRO NUEVO EN EL RELOJ CON LA FECHA ACTUAL  LA FECHA DE SALIDA DEL DIA ANTERIOR
							         		//Valida que no haiga un registro en este dia 
				        	 } else if ( $codigo=='' ) {

				        	 		$rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 

				        	 		if($estado=='LABORABLE' AND $hora_ingreso=='00:00:00' ) {

				        	 			$tiempo='00:00:00';
										$hora_ingreso='00:00:00';
										$id_cp=$id_cp_he;
										$por_pago='25';
				        	 	
				        	 			$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 


				        	 		}else if($estado!='LABORABLE') {

				        	 			$tiempo='00:00:00';
										$hora_ingreso='00:00:00';
										$id_cp=$id_cp_he;
										$por_pago='100';
				        	 	
				        	 			$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 										          
				        	 		}

				        	 
				        	 } else if ( $codigo!='' AND $hora_ingreso=='00:00:00'  ) {
				        	 	//AREA DE ELASTICOS QUE SABADOS VIENEN DURANTE EL DIA, NO SE CONTEMPLA DIA noche

				        	 	$rspta=$reloj->editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 

				        	 	 $id_trab=$id_trab;
								 $codigo_ingresado=$reloj->consultarHoraExtra($id_trab, $fecha, $hora);
								 $regc=$codigo_ingresado->fetch_object();
								 $tiempo=$regc->tiempo_largo;
												       //Porcentaje pago sr.pascual

								 // INICIO - Agregado el  01022019(Leydi Godos) 
								$var_tiempo=$tiempo;
								$dato=$reloj->calcular_redondeo_tiempo($tiempo);
								$regc=$dato->fetch_object();
								$tiempo_redondeado=$regc->tiempo_redondeado;  
							  // FIN - Agregado el  01022019(Leydi Godos)

								$tiempo_fin=$tiempo_redondeado;
								$tiempo=$var_tiempo;
								$por_pago='25';
								$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora, $tiempo, $tiempo_fin, $por_pago ); 
																	


				        	 		

				        	 } 


				        		


				        }
				       

		//Declaramos el array para almacenar todos los permisos marcados

        
           
             
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