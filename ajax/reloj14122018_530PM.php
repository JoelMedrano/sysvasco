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
        //   $id_turno=$dp->id_turno;

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
    

		$por_pago='25';

        if ($id_turno=='1') { //TURNO DIA 

        									//PRIMER REGISTRO COMO HORA DE INGRESO DENTRO DEL RELOJ
			 	if ($codigo==''){



					 		if ($id_permitido=='') {


					 		}else if ($id_permitido==$id_trab) {

	  									

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

							            		//Tiempo de Tolerancia
							            		if ($cantidad_tiempo<='300') {
							            			$descontar='2';
							            		}else if ($cantidad_tiempo>='300') {
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
							            

							            }

							                //FIN - REGISTRO DE HORAS PERMISO ANTES DE LA HORA DE INGRESO ESTABLECIDO
							            	

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
								            }else if ($hora_ingreso='00:00:00') {
							 				 //INICIO - REGISTRO DE HORAS EXTRAS ANTES DE LA HORA DE INGRESO ESTABLECIDO  EN UN DIA LABORABLE PERO SIN INGRESO

							 				 	$tiempo='00:00:00'; 

								            //	$rspta=$reloj->registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
								            }
								            //FIN - REGISTRO DE HORAS EXTRAS ANTES DE LA HORA DE INGRESO ESTABLECIDO  EN UN DIA LABORABLE PERO SIN INGRESO



	 	


					 		}


					 					$rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
									    echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";


			 		        


				
	            }else{
	            	// REGISTRO DE HORA DE SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
	            	if ($primera_salida=='' OR $primera_salida=='00:00:00' ) { //Actualizado de '' a '00:00:00' 30/11/2018


	            		 $codigo_ingresado=$reloj->consultarIngresoEnReloj($id_trab, $fecha, $hora);
						 $regc=$codigo_ingresado->fetch_object();
						 $intervalo_1ing_1sal=$regc->intervalo_1ing_1sal;

	            		if ($intervalo_1ing_1sal<='300') {
	            			# code...
	            		}
	            		else if ($intervalo_1ing_1sal>'300') {

	            		//	$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
					        
	            		



						         	   $rspta=$reloj->editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 

						         	   

						         	    $codigo_ingresado=$reloj->consultarHoraExtra($id_trab, $fecha, $hora);
								        $regc=$codigo_ingresado->fetch_object();
								        $tiempo=$regc->tiempo_largo;

								       
								       //Porcentaje pago sr.pascual
									
								     
								        
								        //DIA DONDE TIENE SU HORARIO DE INGRESO(LABORABLE)
								        if ($hora_salida!='00:00:00' and $cant_tiempo_hs_he>='3600' )  
								        {

								        	if ($id_trab=$id_casovigilancia and $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<='43200' and $estado='LABORABLE') {
								        		
								        		
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
								        



								        	} else if ($id_trab=$id_casomovilidad and $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<'43200' and $estado='LABORABLE') {
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
								        	} else if ($id_trab!=$id_casovigilancia AND  $id_trab!=$id_casomovilidad) {


								        		// INICIO - Agregado el  051222018(Leydi Godos) 
								        		    $tiempo=$tiempo_largo_hs_he;
							 				 		
							 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
													$regc=$dato->fetch_object();
													$tiempo_redondeado=$regc->tiempo_redondeado;  

							 				 	// FIN - Agregado el  051222018(Leydi Godos)



												//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
							 				  	$id_cp=$id_cp_he;



								        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he,  $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
								        	
								        	}

								        	 //DIA DONDE NO REGISTRA HORARIO ASOCIADO DE INGRESO(FERIADO, DOMINGO(DIA NO LABORABLE) 
								        } else if ($hora_ingreso='00:00:00' ) 
								        {	

								        	if ($estado='NO LABORABLE' OR $estado='FERIADO') {
								        	     $por_pago='100';
								        	}else {
								        	     $por_pago='25';
								        	}


								        	
								        	if ($id_trab=$id_casovigilancia or $id_trab=$id_casomovilidad and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200' ) {
								        		// CASOS ESPECIALES(VIGILANCIA Y MOVILIDAD ) FERIADO, DOMINGO, DIA NO LABORABLE)
								        		$tiempo_fin=$tiempo;



								        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,  $tiempo_fin,  $por_pago );

								        	}else if ($cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200') {
								        		$tiempo_fin=$tiempo;
								        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,  $tiempo_fin, $por_pago );

								        	}else if ($id_trab=$id_casovigilancia and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {
								        		$tiempo_fin=$fedo_canhoras_max;
								        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,  $tiempo_fin, $por_pago );


								        	}else if ( $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {

								        		$tiempo_fin='12:00:00';
								        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,  $tiempo_fin, $por_pago );

								        	}

						         	   		

						         		}



						    }


						 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
					}
					// REGISTRO DE HORA DE SEGUNDO INGRESO ACTUALIZANDO LA LINEA DEL RELOJ
	 				else if ($segunda_entrada=='' OR $segunda_entrada=='00:00:00' ) {


				 					 $codigo_ingresado=$reloj->consultarPrimeraSalidaEnReloj($id_trab, $fecha, $hora);
									 $regc=$codigo_ingresado->fetch_object();
									 $intervalo_1sal_2ing=$regc->intervalo_1sal_2ing;

				            		if ($intervalo_1sal_2ing<='300') {
				            			
				            		}
				            		else if ($intervalo_1sal_2ing>'300') {


							 					 $rspta=$reloj->editar_segunda_entrada($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
										    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";

			 						}




	 				}
	 				// REGISTRO DE HORA DE SEGUNDA SALIDA ACTUALIZANDO LA LINEA DEL RELOJ
	 				else if ($segunda_salida=='') {

	 								 $codigo_ingresado=$reloj->consultarSegundoIngresoEnReloj($id_trab, $fecha, $hora);
									 $regc=$codigo_ingresado->fetch_object();
									 $intervalo_2ing_2sal=$regc->intervalo_2ing_2sal;

				            		if ($intervalo_2ing_2sal<='300') {
				            			
				            		}
				            		else if ($intervalo_2ing_2sal>'300') {
	 					 
							 					 $rspta=$reloj->editar_segunda_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
										    	 echo $rspta ? "Marcación actualizada" : "Marcación no se pudo actualizar";
	 								}


	 				}

	            }



        }else if ($id_turno=='2') { //TURNO NOCHE 

        	$dato=$reloj->consultarInformacionDiaAnterior($id_trab, $fecha);
			$regc=$dato->fetch_object();
			$fecha_dia_anterior=$regc->fecha_dia_anterior;
			$hora_ing_anterior=$regc->hora_ing_anterior;
			$hor_sal_anterior=$regc->hor_sal_anterior;



			// CASO 1 EXISTIERA MARCACION DEL DIA ANTERIOR 
        	// 	ACTUALIZAR LA FECHA DE SALIDA DEL DIA ANTERIOR, valida  que el dia anterior tenga fecha en el reloj, exista hora de ingreso y la hora de salida este vacia 
        	 if (  $fecha_dia_anterior!='' and $hora_ing_anterior!='' AND $hor_sal_anterior=='' ) {
        	 	    $rspta=$reloj->editar_primera_salida_noche($id_trab,  $fecha_noche, $fec_reg, $pc_reg, $usu_reg, $hora); 

        	 	    		$fecha=$fecha_noche;
        	 	         

        	 	           //DIA DONDE TIENE SU HORARIO DE INGRESO(LABORABLE)
					        if ($hora_salida!='' AND $cant_tiempo_hs_he>='3600' )  
					        {

					        	if ($id_trab=$id_casovigilancia AND $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<='43200' and $estado='LABORABLE') {
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

					        	} else if ($id_trab=$id_casomovilidad AND $cant_tiempo_hs_he>='14400' and  $cant_tiempo_hs_he<'43200' and $estado='LABORABLE') {
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


					        	} elseif ($id_trab!=$id_casovigilancia AND  $id_trab!=$id_casomovilidad  ) {

					        		      $tiempo_largo_hs_he=$tiempo; //DEBE SER VALIDADO DESDEEL INCIIO CON CASO DE PRUEBA  06/12/2018  LEYDI GODOS 
					        		
					        			// INICIO - Agregado el  051222018(Leydi Godos) 
								        		    $tiempo=$tiempo_largo_hs_he;
							 				 		
							 				 		$dato=$reloj->calcular_redondeo_tiempo($tiempo);
													$regc=$dato->fetch_object();
													$tiempo_redondeado=$regc->tiempo_redondeado;  

							 			// FIN - Agregado el  051222018(Leydi Godos)


										//Reemplaza el id_cp_des correspondinete al cronograma de horas extras
							 			$id_cp=$id_cp_he;


					        		$rspta=$reloj->registrar_hora_extra_despueshorasalida($id_trab, $fecha, $hora, $hora_salida, $tiempo_largo_hs_he, $tiempo_redondeado,  $id_cp,  $estado, $por_pago, $fec_reg, $pc_reg, $usu_reg); 
					        	

					        	}

					        	 //DIA DONDE NO REGISTRA HORARIO ASOCIADO DE INGRESO(FERIADO, DOMINGO, DIA NO LABORABLE)

					        } else if ($hora_ingreso='' ) 
					        {	

					        	if ($estado='NO LABORABLE' OR $estado='FERIADO') {
					        	     $por_pago='100';
					        	}else {
					        	     $por_pago='25';
					        	}

					        	if ($id_trab=$id_casovigilancia or $id_trab=$id_casomovilidad and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200' ) {
					        		// CASOS ESPECIALES(VIGILANCIA Y MOVILIDAD ) FERIADO, DOMINGO, DIA NO LABORABLE)
					        		$tiempo_fin=$tiempo;
					        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,  $tiempo_fin, $por_pago );

					        	}else if ($cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he<'43200') {
					        		$tiempo_fin=$tiempo;
					        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,   $tiempo_fin, $por_pago );

					        	}else if ($id_trab=$id_casovigilancia and $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {
					        		$tiempo_fin=$fedo_canhoras_max;
					        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,    $tiempo_fin, $por_pago );

					        	}else if ( $cant_tiempo_hs_he>='14400'and  $cant_tiempo_hs_he>='43200') {

					        		$tiempo_fin='12:00:00';
					        		$rspta=$reloj->editar_hora_extra( $id_trab, $fecha,   $hora,   $tiempo_fin, $por_pago );

					        	}


			         		}




			// 	CREAR UN REGISTRO NUEVO EN EL RELOJ CON LA FECHA ACTUAL  LA FECHA DE SALIDA DEL DIA ANTERIOR
			         		//Valida que no haiga un registro en este dia 
        	 } else if ( $codigo=='' ) {

        	 		$rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
        	 
        	 }


        		


        }
       

		//Declaramos el array para almacenar todos los permisos marcados

        
           
             
			    	



			
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