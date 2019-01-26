<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Planilla
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	


	//Implementamos un método para desactivar registros
	public function cerrar_primeraquincena($primera_quincena, $fec_reg,  $usu_reg, $pc_reg)
	{
		$sql="UPDATE tabla_maestra_detalle SET valor_3='2' WHERE cod_tabla='TMES' AND  valor_1='$primera_quincena'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para activar registros
	public function cerrar_segundaquincena($segunda_quincena, $fec_reg,  $usu_reg, $pc_reg)
	{
		$sql="UPDATE tabla_maestra_detalle SET valor_4='2' WHERE cod_tabla='TMES' AND  valor_2='$segunda_quincena'";
		return ejecutarConsulta($sql);
	}

	

		

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  '-' AS pla,
		cod_argumento, 
        cod_tabla,  
        des_larga AS mes, 
        des_corta AS ano, 
        valor_1 AS primera_quincena, 
        valor_2  AS segunda_quincena,
        valor_3 AS est_reg_1eraquin,
        valor_4 AS est_reg_2daquin
		FROM `tabla_maestra_detalle` 
		WHERE COD_TABLA LIKE  'TMES' 
		ORDER BY DES_CORTA ASC, valor_1 ASC
	";
		return ejecutarConsulta($sql);		
	}



	/*INICIO - INSERTAR INFORMACION QUINCENAL A LA TABLA*/

	//Implementamos un método para insertar registros en la tabla 
	public function insertar_informacion_atabla($primera_quincena, $fec_reg,  $usu_reg, $pc_reg )
	{
		$sql="INSERT INTO planilla_quincenal(     id_quin,
												  id_trab,
												  estado_civil,
												  tipo_contrato,
												  comision_actual,
												  genero,
												  cod_centro_costos,
												  centro_costos,
												  tipo_mano_obra,
												  t_registro,
												  tipo_planilla,
												  sucursal_anexo,
												  num_doc_trab,
												  apepat_trab,
												  apemat_trab,
												  nom_trab,
												  fec_nac_trab,
												  fec_ing_trab,
												  fec_sal_trab,
												  nro_cta_sue_con,
												  nro_cta_cts_con,
												  forma_pago,
												  area_trab,
												  funcion,
												  categoria_laboral,
												  regimen_pensionario,
												  cusp_trab,
												  sueldo_trab,
												  asig_trab,
												  horas_lactancia,
												  horas_trabajadas,
												  dias_trabajados,
												  pre_hor_ext_25,
												  pre_hor_ext_35,
												  pre_hor_ext_dominical,
												  pre_hor_ext_feriado,
												  cant_hor_ext_25,
												  cant_hor_ext_35,
												  cant_hor_ext_dominical,
												  cant_hor_ext_feriado,
												  fecha_vacaciones,
												  cant_dias_vacaciones,
												  fecha_descanso_medico,
												  cant_dias_descanso_medico,
												  fecha_subsidio,
												  cant_dias_subsidio,
												  fecha_lic_con_goce_haber,
												  cant_dias_lic_con_goce_haber,
												  fecha_lic_sin_goce_haber,
												  cant_dias_lic_sin_goce_haber,
												  cant_horas_faltadas,
												  cant_dias_falta,
												  dscto_dom_hsxdias_semanal,
												  total_dsctoxhoras,
												  total_dsctoxfaltas,
												  sueldo_quincenal,
												  asig_familiar,
												  mon_destajo,
												  mon_vacaciones,
												  mon_licenciaxsubsidio,
												  mon_descansomedico,
												  mon_licenciacongocedehaber,
												  monto_lactancia,
												  mon_total_sueldo_quincenal,
												  mon_hor_ext_25,
												  mon_hor_ext_35,
												  mon_hor_ext_dominical,
												  mon_hor_ext_feriado,
												  mon_total_horas_extras,
												  mon_total_remuneracionafecto,
												  dscto_fondopension,
												  dscto_rentaquinta,
												  dscto_segurovida,
												  dscto_basedestajo,
												  dscto_judicial,
												  dscto_prestamo,
												  dscto_insumodestajeros,
												  dscto_varios,
												  dscto_menu,
												  dscto_anticipo,
												  total_dsctos,
												  total_deposito_quincenal,
												  abono_regularizacion,
												  otros_exceso_dscto_quincenal,
												  total_deposito_bcp_quincenal,
												  bono_quincenal,
												  bono_destajo_quincenal,
												  vacaciones_compradas_otros,
												  total_hextras,
												  total_dscto_varios,
												  pago_efectivo,
												  cant_billetes_100,
												  cant_billetes_50,
												  cant_billetes_20,
												  cant_billetes_10,
												  cant_monedas_5,
												  cant_monedas_2,
												  cant_monedas_1,
												  est_reg,
												  fec_reg,
												  usu_reg,
												  pc_reg) 
		          SELECT  DISTINCT  	'$id_pri_quin' AS  id_pri_quin,
		          						tr.id_trab,
									    teci.des_corta AS estado_civil,
									    tcon.des_larga AS tipo_contrato,
									    ttca.des_larga AS comision_actual,
									    tgen.des_corta AS genero,
									    tr.id_cen_cost AS cod_centro_costos,
									    tcco.des_larga AS centro_costos,
									    ttmo.des_corta AS tipo_mano_obra,
									    ttre.des_larga AS t_registro,
									    tpla.des_larga AS tipo_planilla,
									    IFNULL(tsua.des_larga,'')  AS sucursal_anexo, 
									    tr.num_doc_trab,
									    tr.apepat_trab,
									    tr.apemat_trab,
									    tr.nom_trab,
									    tr.fec_nac_trab AS fec_nac_trab,  
									    tr.fec_ing_trab AS fec_ing_trab,
									    tr.fec_sal_trab AS fec_sal_trab, 
									    tr.nro_cta_sue AS nro_cta_sue_con,
									    tr.nro_cta_cts AS nro_cta_cts_con,
									    tfop.des_larga AS forma_pago, 
									    tare.des_larga AS area_trab, 
									    tfun.des_larga AS funcion,
									    tcal.des_larga AS categoria_laboral,
									    trep.des_larga AS regimen_pensionario,
									    tr.cusp_trab,
									    tr.sueldo_trab,
									    IF(tr.asig_trab=0,'' , asig_trab) AS asig_trab,
									    IFNULL(hl_ma.dias_lab_sh,'')  AS horas_lactancia,
									    ((15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0')  - IFNULL(het.cant_dscto_endias,'')  ) *8) - IF(hl_ma.dias_lab_sh IS NULL , '0', hl_ma.dias_lab_sh)  AS horas_trabajadas,
									    (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) AS dias_trabajados,
									    trcop.pre_hor_ext_25,
									    trcop.pre_hor_ext_35,
									    trcop.pre_hor_ext_dominical,
									    trcop.pre_hor_ext_feriado,
									    het.cant_abono_horas_al25 AS cant_hor_ext_25,
									    het.cant_abono_horas_al35 AS cant_hor_ext_35,
									    het.cant_abono_horas_dom AS cant_hor_ext_dominical,
									    het.cant_abono_horas_fer AS cant_hor_ext_feriado,
									    IFNULL(vac.fechas,'') AS fecha_vacaciones,
									    IFNULL(vac.dias,'')   AS cant_dias_vacaciones,
									    IF(dme.dias>0, dme.fechas, '' )  AS fecha_descanso_medico,
									    IF(dme.dias>0, dme.dias, '' )    AS cant_dias_descanso_medico,  
									    IF(sub.dias>0, sub.fechas, '' )  AS fecha_subsidio,
									    IF(sub.dias>0, sub.dias, '' )    AS cant_dias_subsidio,
									    IF(lco.dias>0, lco.fechas, '' )  AS fecha_lic_con_goce_haber, 
									    IF(lco.dias>0, lco.dias, '' )    AS cant_dias_lic_con_goce_haber,
									    IF(lsi.dias>0, lsi.fechas, '' )  AS fecha_lic_sin_goce_haber,
									    IF(lsi.dias>0, lsi.dias, '' )  AS cant_dias_lic_sin_goce_haber,
									    het.cant_dscto_enhoras AS cant_horas_faltadas,
									    het.cant_dscto_endias AS cant_dias_falta,
									     CASE 
									    WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
									    WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
									    WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
									    WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
									    WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
									    ELSE ''  END
									    AS dscto_dom_hsxdias_semanal,  /*AL FINAL AUTOCALCULABLE*/
									    IF(ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) ='0.00', '', ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) )  AS total_dsctoxhoras,  /*AL FINAL AUTOCALCULABLE*/
									    ROUND( ((tr.sueldo_trab/30)* cant_dscto_endias) + het.dscto_dom_hsxdias_semanal , 2) AS total_dsctoxfaltas,  /*AL FINAL AUTOCALCULABLE*/
									    ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)  AS sueldo_quincenal,  /* CORREGIR - AL FINAL AUTOCALCULABLE*/
									    IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))AS asig_familiar,
									    IF(pd.dif_soles IS NULL,'',pd.dif_soles) AS mon_destajo,
									    IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' ) AS mon_vacaciones,
									    IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) ) AS mon_licenciaxsubsidio,
									    IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) ) AS mon_descansomedico,
									    IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) ) AS mon_licenciacongocedehaber,
									   /* IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) ) AS mon_licenciasingocedehaber, NO SE PAGA POR LICENCIA SIN GOCE*/
									    IF(ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2)='0.00', '', ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) )  AS monto_lactancia,
									    ROUND(
									      (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									      (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									      (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									      (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									      (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									      (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									      (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									      /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  COMENTADO PORQUE NO SE PAGA*/
									      ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2)
									   , 2)    
									    AS mon_total_sueldo_quincenal,
									    ROUND((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25), 2)        AS mon_hor_ext_25,
									    ROUND((het.cant_abono_horas_al35 * trcop.pre_hor_ext_35), 2)        AS mon_hor_ext_35,
									    ROUND((het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical), 2)  AS mon_hor_ext_dominical,
									    ROUND((het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado), 2)    AS mon_hor_ext_feriado,
									    ROUND
									    (
									    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
									    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
									    )
									    AS mon_total_horas_extras,
									    /*INI TOTAL REMUNERACION AFECTO*/
									    ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) 
									    /*FIN TOTAL REMUNERACION AFECTO*/ AS mon_total_remuneracionafecto,
									      ROUND(/*MRA*/(ROUND(
									      (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									      (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									      (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									      (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									      (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									      (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									      (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									      /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									      ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									      ,2) )/*MRA*/ *  ( rp.monto_reg_pen/100)  +   IF (tr.id_reg_pen_sj='6',  rp.sj_apo_obl, '0.00'  )
									       + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2) 
									      AS dscto_fondopension,
									    IFNULL(rqc.mon_quin, '') AS dscto_rentaquinta,
									    '' AS dscto_segurovida,
									    '' AS dscto_basedestajo,
									    IFNULL(ROUND(dj.mon_men,2),0.00)  AS dscto_judicial,
									    IFNULL(ROUND(dp.monto,2),0.00)  AS dscto_prestamo,
									    IFNULL(ROUND(did.monto,2),0.00)   AS dscto_insumodestajeros,
									    IFNULL(ROUND(dv.monto,2),0.00)  AS dscto_varios,
									    IFNULL(ROUND(dm.monto,2),0.00)  AS dscto_menu,
									    IFNULL(ROUND(aa.monto,2),0.00)        AS dscto_anticipo,
									    /*INICIO TOTAL DESCUENTOS */
									    /*INI- fondo de pension*/
									     ROUND(
									     ROUND(/*MRA*/(ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) )/*MRA*/ *  ( rp.monto_reg_pen/100)  +   IF (tr.id_reg_pen_sj='6',  rp.sj_apo_obl, '0.00'  )
									     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
									    IFNULL(rqc.mon_quin, '') /*dscto_rentaquinta*/  + 
									    IFNULL(dj.mon_men,0.00) +
									    IFNULL(dp.monto,0.00) +
									    IFNULL(did.monto,0.00) +
									    IFNULL(dv.monto,0.00) +
									    IFNULL(dm.monto,0.00) +
									    IFNULL(aa.monto,0.00) 
									    + 0.0000000001 ,2)
									    /*FIN TOTAL DESCUENTOS */
									    AS total_dsctos,
									    /*INICIO TOTAL REMUNERACION AFECTO*/
									    ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) 
									    /*FIN TOTAL REMUNERACION AFECTO*/ 
									    /*RESTAR*/
									    -
									    /*INI- fondo de pension*/
									     ROUND(
									     ROUND(/*MRA*/(ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) )/*MRA*/ *  ( rp.monto_reg_pen/100)  +   IF (tr.id_reg_pen_sj='6',  rp.sj_apo_obl, '0.00'  )
									     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
									    IFNULL(rqc.mon_quin, '') /*dscto_rentaquinta*/  + 
									    IFNULL(dj.mon_men,0.00) +
									    IFNULL(dp.monto,0.00) +
									    IFNULL(did.monto,0.00) +
									    IFNULL(dv.monto,0.00) +
									    IFNULL(dm.monto,0.00) +
									    IFNULL(aa.monto,0.00) 
									    + 0.0000000001 ,2)
									    /*FIN TOTAL DESCUENTOS */
									      AS total_deposito_quincenal,
									    /*------------------------------------NUEVA FILA------------------------------------*/
									    /*INICIO - ABONO REGULARIZACION*/
									    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
									    /*FIN - ABONO REGULARIZACION*/
									     AS abono_regularizacion,
									    '' AS otros_exceso_dscto_quincenal,
									    /*INICIO - TOTAL BCP DEPOSITO QUINCENAL --------------- NUEVA FILA------------------ */
									    /*INICIO TOTAL REMUNERACION AFECTO*/
									    ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) 
									    /*FIN TOTAL REMUNERACION AFECTO*/ 
									    /*RESTAR*/
									    -
									    /*INI- fondo de pension*/
									     ROUND(
									     ROUND(/*MRA*/(ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) )/*MRA*/ *  ( rp.monto_reg_pen/100)  +   IF (tr.id_reg_pen_sj='6',  rp.sj_apo_obl, '0.00'  )
									     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
									    IFNULL(rqc.mon_quin, '') /*dscto_rentaquinta*/  + 
									    IFNULL(dj.mon_men,0.00) +
									    IFNULL(dp.monto,0.00) +
									    IFNULL(did.monto,0.00) +
									    IFNULL(dv.monto,0.00) +
									    IFNULL(dm.monto,0.00) +
									    IFNULL(aa.monto,0.00) 
									    + 0.0000000001 ,2)
									    /*FIN TOTAL DESCUENTOS */
									    /*FIN TOTAL DEPOSITO QUINCENAL */
									    /**/
									    + 
									     /*INICIO - ABONO REGULARIZACION*/
									    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
									    /*FIN - ABONO REGULARIZACION*/

									    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
									    AS total_despositobcp_quincenal,
									    /*------------------------------------NUEVA FILA------------------------------------*/
									    (tr.bono_trab/2) AS bono_quincenal,
									    IFNULL(pd.bono_des_trab,0.00) AS bono_destajo_quincenal,
									      /*------------------------------------NUEVA FILA------------------------------------*/
									    IFNULL(mvc.pago_vac_comp, '0.00') AS vacaciones_compradas_otros, /* FALTA CALCULAR DESDE LA PANTALLLA  */
									      /*------------------------------------NUEVA FILA------------------------------------*/
									    ROUND(
									    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
									    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado))  
									     + 0.0000000001 
									     , 2) AS total_hextras,
									     /*------------------------------------NUEVA FILA------------------------------------*/
									    '' AS dscto_varios,
									    /* --------------- NUEVA FILA------------------SIGUINTE FILA*/
									      CASE 
									      /*Cuando estan planilla*/
									       WHEN  tr.id_trab LIKE 'P%'  THEN 
									      (ROUND( (tr.bono_trab/2)   /*BONO SUELDO */+
									             IFNULL(pd.bono_des_trab,0.00) +
									            /*LINEA DE VACACIONES COMPRADAS*/
									            IFNULL (mvc.pago_vac_comp, '0.00') +  
									             ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
									            (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
									             , 0))
									      /*Cuando son internos*/          
									       ELSE 
									    ROUND(
									     /*INICIO - TOTAL BCP DEPOSITO QUINCENAL */
									    /*INICIO TOTAL REMUNERACION AFECTO*/
									    ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) 
									    /*FIN TOTAL REMUNERACION AFECTO*/ 
									    /*RESTAR*/
									    -
									    /*INI- fondo de pension*/
									     ROUND(
									     ROUND(/*MRA*/(ROUND(
									    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
									    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
									    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
									    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
									    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
									    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
									    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
									    ROUND((tr.sueldo_trab/240) * IFNULL(hl_ma.dias_lab_sh,'0'), 2) /*FIN TOTAL REMUNERACION AFECTO*/
									    ,2) )/*MRA*/ *  ( rp.monto_reg_pen/100)  +   IF (tr.id_reg_pen_sj='6',  rp.sj_apo_obl, '0.00'  )
									     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
									    IFNULL(dj.mon_men,0.00) +
									    IFNULL(dp.monto,0.00) +
									    IFNULL(did.monto,0.00) +
									    IFNULL(dv.monto,0.00) +
									    IFNULL(dm.monto,0.00) +
									    IFNULL(aa.monto,0.00) 
									    + 0.0000000001 ,2)
									    /*FIN TOTAL DESCUENTOS */
									    /*FIN TOTAL DEPOSITO QUINCENAL */
									    /**/
									    + 
									     /*INICIO - ABONO REGULARIZACION*/
									    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
									    /*FIN - ABONO REGULARIZACION*/
									    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
									     
									    /*INICIO SUMAR CON LOS PAGOS EN EFECTIVOS*/
									    +
									     ( (tr.bono_trab/2)   /*BONO SUELDO */+
									       IFNULL(pd.bono_des_trab,0.00) +
									      /*LINEA DE VACACIONES COMPRADAS*/  
									      ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
									       (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
									     )
									    /*FIN SUMAR CON LOS PAGOS EN EFECTIVOS*/
									    ,0 )
									   END
									       pago_efectivo,
									    NULL AS cant_billetes_100,
									    NULL AS cant_billetes_50,
									    NULL AS cant_billetes_20,
									    NULL AS cant_billetes_10,
									    NULL AS cant_monedas_5,
									    NULL AS cant_monedas_2,
									    NULL AS cant_monedas_1,
									    tr.est_reg,
										'$fec_reg',
										'$usu_reg',
										'$pc_reg'
									        FROM trabajador tr
									        CROSS JOIN (SELECT @i := 0) tr
									        LEFT JOIN (
									    SELECT ma.id_trab , COUNT( dl.estado) AS dias_lab_sh
									    FROM maternidad ma
									    LEFT JOIN (
									    SELECT   hr.id_trab,fe.fecha, fe.nom_dia, fe.estado, fe.ano,
									       CASE 
									       WHEN  fe.nom_dia='LUNES'     THEN hr.lunes_ingreso
									       WHEN  fe.nom_dia='MARTES'    THEN hr.martes_ingreso
									       WHEN  fe.nom_dia='MIERCOLES' THEN hr.miercoles_ingreso
									       WHEN  fe.nom_dia='JUEVES'    THEN hr.jueves_ingreso
									       WHEN  fe.nom_dia='VIERNES'   THEN hr.viernes_ingreso
									       WHEN  fe.nom_dia='SABADO'    THEN hr.sabado_ingreso
									       ELSE ''  END
									      AS hora_ingreso,
									      cp.hasta
									      FROM fechas  fe
									      LEFT JOIN cronograma_pagos cp
									      ON  cp.id_cp='$id_pri_quin'
									      LEFT JOIN 
									      ( SELECT lunes_ingreso,
									         martes_ingreso,
									         miercoles_ingreso,
									         jueves_ingreso,
									         viernes_ingreso,
									         sabado_ingreso,
									         id_trab,
									         hrt.est_reg 
									        FROM  horario_refrigerio_trabajador AS hrt
									        LEFT JOIN horario AS hr ON 
									        hr.id_horario=  hrt.id_horario
									      )  AS hr ON hr.est_reg='1'
									      WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
									      AND  fe.estado NOT IN ('FERIADO', 'NO LABORABLE')
									    ) AS dl ON   dl.id_trab=ma.id_trab
									    WHERE  dl.hora_ingreso!='00:00:00'
									    AND  dl.hasta<=ma.fec_fin 
									        ) AS hl_ma ON hl_ma.id_trab= tr.id_trab
									        LEFT JOIN (
									        SELECT pp.id_trab,  pp.id_cp_vac_com, pp.pago_vac_comp  
									        FROM permiso_personal pp
									        WHERE pp.tip_permiso='VC'
									        AND id_vac_com='1'
									        ) AS mvc  ON mvc.id_trab= tr.id_trab
									        AND mvc.id_cp_vac_com='$id_pri_quin'
									        LEFT JOIN (
									        SELECT  id_trab, mon_total,  ROUND((mon_total/2),2) AS mon_quin
									        FROM renta_quinta_categoria
									        WHERE  est_reg='1'  
									        ) AS  rqc ON rqc.id_trab= tr.id_trab
									        LEFT JOIN (SELECT  ma.id_trab,
									               ma.fec_nac_c1,
									               hl.cantidad_horas,
									               IF(ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2) IS NULL, '', ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2)) AS mon_permisoxhoralactancia
									             FROM maternidad  ma
									             LEFT JOIN trabajador tr
									             ON tr.id_trab= ma.id_trab
									             LEFT JOIN (SELECT hl.id_cp, hl.cantidad_horas
									             FROM horas_lactancia hl  
									             ) AS hl ON hl.id_cp='$id_pri_quin'
									            WHERE DATEDIFF(CURDATE(), fec_nac_c1) <=365
									        ) AS hl ON hl.id_trab=tr.id_trab
									        LEFT JOIN (
									        SELECT  tr.id_trab,
									          ROUND(((tr.sueldo_trab/240)* 0.25)+ (tr.sueldo_trab/240), 2) AS pre_hor_ext_25,
									          ROUND(  (((tr.sueldo_trab/240)* 0.35)+ (tr.sueldo_trab/240)) +  0.0000000001 , 2) AS pre_hor_ext_35,
									          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001  , 2) AS pre_hor_ext_dominical,
									          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001 , 2) AS pre_hor_ext_feriado
									        FROM trabajador  tr
									        ) AS trcop ON trcop.id_trab= tr.id_trab
									        LEFT JOIN (
									          SELECT  tr.id_trab,
									          het.cant_dscto_enhoras,
									          het.cant_dscto_endias,
									          het.cant_abono_horas_al25,
									          het.cant_abono_horas_al35,
									          het.cant_abono_horas_dom,
									          het.cant_abono_horas_fer,
									          CASE 
									          WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
									          WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
									          WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
									          WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
									          WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
									          ELSE ''  END
									          AS dscto_dom_hsxdias_semanal
									          FROM trabajador tr
									          LEFT JOIN ( 
									            SELECT  tr.id_trab,
									            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)  IS NULL , '',
									            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)) AS cant_dscto_enhoras,
									            tr1.tot_cant_dias AS cant_dscto_endias,
									            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)  IS NULL , '',
									            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al25,
									            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)  IS NULL , '',
									            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al35,
									            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)  IS NULL , '',
									            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_dom,
									            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)  IS NULL , '',
									            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_fer
									            FROM trabajador tr 
									            LEFT JOIN ( 
									            SELECT  tr.id_trab,  
									              IF(DATE_FORMAT( ADDTIME(
									              CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
									              WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
									              ELSE hpp_reg.cant_horas   END
									               , CASE WHEN fcc.cant_horas='' THEN '00:00'
									              WHEN fcc.cant_horas IS NULL THEN '00:00' 
									              ELSE fcc.cant_horas   END 
									               )  , '%H:%i')='00:00' , '', DATE_FORMAT( ADDTIME(
									              CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
									              WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
									              ELSE hpp_reg.cant_horas   END
									               , CASE WHEN fcc.cant_horas='' THEN '00:00'
									              WHEN fcc.cant_horas IS NULL THEN '00:00' 
									              ELSE fcc.cant_horas   END 
									               )  , '%H:%i') )AS tot_cant_horas,
									              IF(
									              (
									              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
									              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
									              ELSE hpp_reg.cant_dias  END
									               + CASE WHEN fcc.cant_dias='' THEN '0' 
									              WHEN fcc.cant_dias IS NULL THEN '0' 
									              ELSE fcc.cant_dias   END 
									               )='0' , '',(
									              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
									              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
									              ELSE hpp_reg.cant_dias  END
									               + CASE WHEN fcc.cant_dias='' THEN '0' 
									              WHEN fcc.cant_dias IS NULL THEN '0' 
									              ELSE fcc.cant_dias   END 
									               ))   AS tot_cant_dias,
									              '-' AS separador, 
									              IF(DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_al25   END
									               , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
									              WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_al25   END 
									               ), '%H:%i')='00:00', '', 
									               DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_al25   END
									               , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
									              WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_al25   END 
									               ), '%H:%i')
									               ) AS tot_cant_horas_al25,
									              IF(DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_al35   END
									              , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
									              WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_al35   END 
									               ), '%H:%i') ='00:00', '' , 
									              DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_al35   END
									              , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
									              WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_al35   END 
									               ), '%H:%i')
									               ) AS tot_cant_horas_al35, 
									              IF(DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_dom   END
									              , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
									              WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_dom   END 
									               ), '%H:%i') ='00:00', '', 
									               DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_dom   END
									              , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
									              WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_dom   END 
									               ), '%H:%i')
									               ) AS tot_cant_horas_dom, 
									              IF(DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_fer   END
									              , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
									              WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_fer   END 
									               ), '%H:%i') ='00:00', '' ,
									              DATE_FORMAT(ADDTIME(
									              CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
									              WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
									              ELSE fhe_reg.cant_horas_fer   END
									              , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
									              WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
									              ELSE fhe.cant_horas_fer   END 
									               ), '%H:%i')  
									                )AS tot_cant_horas_fer
									            FROM Trabajador tr
									            LEFT JOIN cronograma_pagos cp ON 
									                 cp.id_cp='$id_pri_quin'
									            LEFT JOIN tabla_maestra_detalle AS tpla ON
									                tpla.cod_argumento= tr.id_tip_plan
									                AND tpla.cod_tabla='TPLA'
									            LEFT JOIN tabla_maestra_detalle AS tsua ON
									                tsua.cod_argumento= tr.id_sucursal
									                AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL
									            LEFT JOIN tabla_maestra_detalle AS tfun ON
									                tfun.cod_argumento= tr.id_funcion
									                AND tfun.cod_tabla='TFUN'
									            LEFT JOIN tabla_maestra_detalle AS tare ON
									                tare.cod_argumento= tr.id_area
									                AND tare.cod_tabla='TARE'
									            LEFT JOIN tabla_maestra_detalle AS tcal ON
									                tcal.cod_argumento= tr.id_categoria
									                AND tcal.cod_tabla='TCAL' 
									            LEFT JOIN tabla_maestra_detalle AS tfop ON
									                tfop.cod_argumento= tr.id_form_pag
									                AND tfop.cod_tabla='TFOP' 
									            LEFT JOIN /*Regularizacion de horas y dias de descuento */
									            ( SELECT tr.id_trab, DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))), '%H:%i') AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
									              FROM Trabajador tr
									              LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
									                   FROM horas_permiso_personal hpp
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                   cp.id_cp='$id_pri_quin'
									                   WHERE  hpp.fecha NOT BETWEEN cp.desde AND cp.hasta
									                   AND  hpp.id_fec_dscto='$id_pri_quin'
									              )AS hpp ON tr.id_trab =  hpp.id_trab
									              GROUP BY tr.id_trab
									            ) AS hpp_reg ON tr.id_trab =  hpp_reg.id_trab
									            LEFT JOIN 
									            ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, r.id_dscto 
									              FROM horas_permiso_personal hpp
									              LEFT JOIN/* INICIO  - El que causa conflicto*/
									              (SELECT  (@o := @o + 1)  AS id_dscto ,
									                 DAY(fe.fecha) AS dia_dscto,
									                 MONTH(fe.fecha) AS mes_dscto
									               FROM (SELECT @o:=0) r
									                 INNER JOIN fechas fe
									                 LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                            cp.id_cp= '$id_pri_quin'
									               WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
									               ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
									              )  AS r 
									              ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
									            ) AS hpp ON tr.id_trab =  hpp.id_trab
									              AND hpp.fecha BETWEEN cp.desde AND cp.hasta
									            LEFT JOIN 
									            ( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
									              FROM Trabajador tr
									              LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
									              FROM horas_permiso_personal hpp
									              LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									              cp.id_cp= '$id_pri_quin'
									              WHERE  hpp.fecha BETWEEN cp.desde AND cp.hasta
									              )AS hpp ON tr.id_trab =  hpp.id_trab
									              GROUP BY tr.id_trab
									            ) AS fcc ON fcc.id_trab= tr.id_trab 
									            LEFT JOIN 
									            ( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
									            FROM horas_extras_personal hep
									            ) AS hep ON tr.id_trab =  hep.id_trab
									            AND hep.fecha BETWEEN cp.desde AND cp.hasta
									            LEFT JOIN /*Regularizacion de horas y dias de abono */
									            ( SELECT tr.id_trab, 
									               CASE 
									                WHEN  hep.por_pago='25' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')  
									                ELSE ''  END
									                AS cant_horas_al25,
									               CASE 
									                WHEN  hep.por_pago='35' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')  
									                ELSE ''  END
									                AS cant_horas_al35,
									               CASE 
									                WHEN  hep.por_pago='100' AND est_dia='NO LABORABLE' THEN DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))) , '%H:%i')  
									                ELSE ''  END
									                AS cant_horas_dom,
									               CASE 
									                WHEN  hep.por_pago='100' AND est_dia='FERIADO' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')   
									                ELSE ''  END
									                AS cant_horas_fer
									              FROM Trabajador tr
									              LEFT JOIN ( SELECT DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha, hep.tiempo_fin, hep.por_pago, hep.est_dia
									                   FROM horas_extras_personal hep
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp='$id_pri_quin'
									                   WHERE  hep.fecha NOT BETWEEN cp.desde AND cp.hasta
									                   AND  hep.id_fec_abono='$id_pri_quin'
									              )AS hep ON tr.id_trab =  hep.id_trab
									              GROUP BY tr.id_trab  
									            ) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
									            LEFT JOIN 
									             /*INICIO DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
									            ( SELECT tr.id_trab,  
									       IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
									       IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
									       IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
									       IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
									FROM Trabajador tr
									               LEFT JOIN ( SELECT 
									                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
									                hep.id_trab,
									                hep.fecha,
									                hep.tiempo_fin,
									                hep.por_pago,
									                hep.est_dia,
									                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
									                   FROM horas_extras_personal hep
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp= '$id_pri_quin'
									                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
									                   AND hep.por_pago='25' 
									                   AND est_dia='LABORABLE'
									                   GROUP BY id_trab
									              )AS he_25 ON tr.id_trab =  he_25.id_trab
									              LEFT JOIN ( SELECT 
									                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
									                hep.id_trab,
									                hep.fecha,
									                hep.tiempo_fin,
									                hep.por_pago,
									                hep.est_dia,
									                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
									                   FROM horas_extras_personal hep
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp= '$id_pri_quin'
									                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
									                   AND hep.por_pago='35' 
									                   AND est_dia='LABORABLE'
									                   GROUP BY id_trab
									              )AS he_35 ON tr.id_trab =  he_35.id_trab
									              LEFT JOIN ( SELECT 
									                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
									                hep.id_trab,
									                hep.fecha,
									                hep.tiempo_fin,
									                hep.por_pago,
									                hep.est_dia,
									                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
									                   FROM horas_extras_personal hep
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp= '$id_pri_quin'
									                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
									                    AND hep.por_pago='100' 
									                    AND est_dia='NO LABORABLE'
									                  GROUP BY id_trab
									              )AS he_nl ON tr.id_trab =  he_nl.id_trab
									               LEFT JOIN ( SELECT 
									                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
									                hep.id_trab,
									                hep.fecha,
									                hep.tiempo_fin,
									                hep.por_pago,
									                hep.est_dia,
									                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
									                   FROM horas_extras_personal hep
									                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp= '$id_pri_quin'
									                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
									                    AND hep.por_pago='100' 
									                    AND est_dia='FERIADO'
									               GROUP BY id_trab
									              )AS he_fe ON tr.id_trab =  he_fe.id_trab
									              /*FIN DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
									            ) AS fhe ON fhe.id_trab= tr.id_trab 
									            LEFT JOIN
									            (SELECT (@i := @i + 1) AS id ,
									               DAY(fe_ext.fecha) AS dia,
									               MONTH(fe_ext.fecha) AS mes,
									               fr_ext.dia AS dia_reg,
									               fr_ext.mes AS mes_reg
									             FROM (SELECT @i:=0) r
									               INNER JOIN fechas fe_ext
									               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                          cp.id_cp= '$id_pri_quin'
									               LEFT JOIN (
									              SELECT 
									                  DAY(fecha) AS dia,
									                  MONTH(fecha) AS mes
									              FROM horas_extras_personal hep
									               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
									                              cp.id_cp= '$id_pri_quin'
									              WHERE hep.fecha BETWEEN  cp.desde AND cp.hasta
									              GROUP BY DAY(fecha)
									               ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
									             WHERE fe_ext.fecha BETWEEN cp.desde AND cp.hasta
									             ORDER BY MONTH(fe_ext.fecha) ASC,  DAY(fe_ext.fecha) ASC
									            )  AS r_ext
									            ON DAY(hep.fecha)=r_ext.dia
									            WHERE tr.est_reg='1'
									            GROUP BY tr.id_trab
									            ) AS tr1 ON tr1.id_trab=tr.id_trab
									            WHERE est_reg='1'
									            GROUP BY tr.id_trab
									          ) AS het   ON het.id_trab =tr.id_trab /*HORAS EXTRAS Y TARDANZAS*/
									          )AS het ON  het.id_trab=tr.id_trab
									        LEFT JOIN (
									        SELECT  id_trab,  CASE 
									          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='1' AND tr.id_reg_pen_sj!=rp.id_sj THEN  onp_apo_act
									          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='0' AND tr.id_reg_pen_sj!=rp.id_sj THEN  onp_apo_act
									          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='1' AND tr.id_reg_pen_sj!=rp.id_sj THEN  int_apo_act
									          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='2' AND tr.id_reg_pen_sj!=rp.id_sj THEN  int_apo_mix
									          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='1' AND tr.id_reg_pen_sj!=rp.id_sj THEN  pri_apo_act
									          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='2' AND tr.id_reg_pen_sj!=rp.id_sj THEN  pri_apo_mix
									          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='1' AND tr.id_reg_pen_sj!=rp.id_sj THEN  pro_apo_act
									          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='2' AND tr.id_reg_pen_sj!=rp.id_sj THEN  pro_apo_mix
									          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='1' AND tr.id_reg_pen_sj!=rp.id_sj THEN  hab_apo_act
									          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='2' AND tr.id_reg_pen_sj!=rp.id_sj THEN  hab_apo_mix
									          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='1' AND tr.id_reg_pen_sj=rp.id_sj THEN  sj_com_men_rem
									          ELSE ''  END
									          AS monto_reg_pen,
									          tr.id_reg_pen_sj,
									          rp.id_sj,
									          sj_apo_obl,
									          sj_com_men_rem
									        FROM trabajador  tr
									        LEFT JOIN  regimen_pensionario rp
									        ON id_cp='$id_pri_quin'
									        ) AS rp ON rp.id_trab= tr.id_trab
									        LEFT JOIN tabla_maestra_detalle   AS tpla ON tpla.cod_argumento=tr.id_tip_plan    AND tpla.cod_tabla='TPLA'
									        LEFT JOIN tabla_maestra_detalle   AS tsua ON tsua.cod_argumento=tr.id_sucursal    AND tsua.cod_tabla='TSUA'
									        LEFT JOIN tabla_maestra_detalle   AS tfun ON tfun.cod_argumento=tr.id_funcion     AND tfun.cod_tabla='TFUN'
									        LEFT JOIN tabla_maestra_detalle   AS tare ON tare.cod_argumento=tr.id_area        AND tare.cod_tabla='TARE'
									        LEFT JOIN tabla_maestra_detalle   AS tgen ON tgen.cod_argumento=tr.id_genero      AND tgen.cod_tabla='TGEN' 
									        LEFT JOIN tabla_maestra_detalle   AS tcco ON tcco.cod_argumento=tr.id_cen_cost    AND tcco.cod_tabla='TCCO' 
									        LEFT JOIN tabla_maestra_detalle   AS ttmo ON ttmo.cod_argumento=tr.id_tip_man_ob  AND ttmo.cod_tabla='TTMO' 
									        LEFT JOIN tabla_maestra_detalle   AS tcal ON tcal.cod_argumento=tr.id_categoria   AND tcal.cod_tabla='TCAL' 
									        LEFT JOIN tabla_maestra_detalle   AS tfop ON tfop.cod_argumento=tr.id_form_pag    AND tfop.cod_tabla='TFOP' 
									        LEFT JOIN tabla_maestra_detalle   AS tcon ON tcon.cod_argumento=tr.id_tip_cont    AND tcon.cod_tabla='TCON' 
									        LEFT JOIN tabla_maestra_detalle   AS teci ON teci.cod_argumento=tr.id_est_civil   AND teci.cod_tabla='TECI' 
									        LEFT JOIN tabla_maestra_detalle   AS trep ON trep.cod_argumento=tr.id_reg_pen     AND trep.cod_tabla='TREP' 
									        LEFT JOIN tabla_maestra_detalle   AS ttca ON ttca.cod_argumento=tr.id_com_act     AND ttca.cod_tabla='TTCA' 
									        LEFT JOIN tabla_maestra_detalle   AS ttre ON ttre.cod_argumento=tr.id_t_registro  AND ttre.cod_tabla='TTRE' 
									        LEFT JOIN tabla_maestra_detalle   AS tmpe ON tmpe.cod_argumento=tr.id_pag_esp     AND tmpe.cod_tabla='TMPE'
									        LEFT JOIN vacaciones              AS vac  ON vac.nro_doc= tr.num_doc_trab
									        LEFT JOIN pago_destajeros     AS pd   ON pd.id_trab=tr.id_trab    AND pd.id_pd='$id_pri_quin'
									        LEFT JOIN abono_regularizacion    AS ar   ON ar.id_trab=tr.id_trab    AND ar.fec_abo_reg='$id_pri_quin'
									        LEFT JOIN descuentos_judiciales   AS dj   ON dj.id_trab=tr.id_trab    AND dj.est_des_jud='1'
									        LEFT JOIN 
									        ( SELECT pre.id_trab, CASE 
									          WHEN  pre.fec_des1='$id_pri_quin' THEN mon_des1
									          WHEN  pre.fec_des2='$id_pri_quin' THEN mon_des2
									          WHEN  pre.fec_des3='$id_pri_quin' THEN mon_des3 
									          WHEN  pre.fec_des4='$id_pri_quin' THEN mon_des4
									          WHEN  pre.fec_des5='$id_pri_quin' THEN mon_des5 
									          WHEN  pre.fec_des6='$id_pri_quin' THEN mon_des6
									          WHEN  pre.fec_des7='$id_pri_quin' THEN mon_des7 
									          WHEN  pre.fec_des8='$id_pri_quin' THEN mon_des8
									          WHEN  pre.fec_des9='$id_pri_quin' THEN mon_des9 
									          WHEN  pre.fec_des10='$id_pri_quin' THEN mon_des10
									          WHEN  pre.fec_des11='$id_pri_quin' THEN mon_des11
									          WHEN  pre.fec_des12='$id_pri_quin' THEN mon_des12
									          WHEN  pre.fec_des13='$id_pri_quin' THEN mon_des13
									          WHEN  pre.fec_des14='$id_pri_quin' THEN mon_des14
									          WHEN  pre.fec_des15='$id_pri_quin' THEN mon_des15
									          WHEN  pre.fec_des16='$id_pri_quin' THEN mon_des16
									          WHEN  pre.fec_des17='$id_pri_quin' THEN mon_des17
									          WHEN  pre.fec_des18='$id_pri_quin' THEN mon_des18
									          WHEN  pre.fec_des19='$id_pri_quin' THEN mon_des19
									          WHEN  pre.fec_des20='$id_pri_quin' THEN mon_des20
									          WHEN  pre.fec_des21='$id_pri_quin' THEN mon_des21
									          WHEN  pre.fec_des22='$id_pri_quin' THEN mon_des22 
									          WHEN  pre.fec_des23='$id_pri_quin' THEN mon_des23
									          WHEN  pre.fec_des24='$id_pri_quin' THEN mon_des24
									          WHEN  pre.fec_des25='$id_pri_quin' THEN mon_des25
									          WHEN  pre.fec_des26='$id_pri_quin' THEN mon_des26
									          WHEN  pre.fec_des27='$id_pri_quin' THEN mon_des27
									          WHEN  pre.fec_des28='$id_pri_quin' THEN mon_des28
									          WHEN  pre.fec_des29='$id_pri_quin' THEN mon_des29
									          WHEN  pre.fec_des30='$id_pri_quin' THEN mon_des30  
									          ELSE '0.00'  END
									          AS monto
									          FROM prestamos AS pre 
									        ) AS dp  ON dp.id_trab=tr.id_trab
									        LEFT JOIN 
									        ( SELECT did.id_trab, CASE 
									          WHEN  did.fec_des1='$id_pri_quin' THEN mon_des1
									          WHEN  did.fec_des2='$id_pri_quin' THEN mon_des2
									          WHEN  did.fec_des3='$id_pri_quin' THEN mon_des3 
									          ELSE '0.00'  END
									          AS monto
									          FROM descuentos_insumos_destajeros AS did 
									        ) AS did  ON did.id_trab=tr.id_trab
									        LEFT JOIN 
									        ( SELECT dv.id_trab, CASE 
									          WHEN  dv.fec_des1='$id_pri_quin' THEN mon_des1
									          WHEN  dv.fec_des2='$id_pri_quin' THEN mon_des2
									          WHEN  dv.fec_des3='$id_pri_quin' THEN mon_des3 
									          ELSE '0.00'  END
									          AS monto
									          FROM descuentos_varios AS dv 
									        ) AS dv  ON dv.id_trab=tr.id_trab
									        LEFT JOIN 
									        ( SELECT dm.id_trab, CASE 
									          WHEN  dm.fec_des1='$id_pri_quin' THEN mon_des1
									          WHEN  dm.fec_des2='$id_pri_quin' THEN mon_des2
									          WHEN  dm.fec_des3='$id_pri_quin' THEN mon_des3 
									          ELSE '0.00'  END
									          AS monto
									          FROM descuentos_menu AS dm 
									        ) AS dm  ON dm.id_trab=tr.id_trab
									        LEFT JOIN 
									        ( SELECT aa.id_trab, CASE 
									          WHEN  aa.fec_des1='$id_pri_quin' THEN mon_des1
									          WHEN  aa.fec_des2='$id_pri_quin' THEN mon_des2
									          WHEN  aa.fec_des3='$id_pri_quin' THEN mon_des3 
									          ELSE '0.00'  END
									          AS monto
									          FROM anticipo_adelanto AS aa 
									        ) AS aa  ON aa.id_trab=tr.id_trab
									        LEFT JOIN 
									        (      SELECT   pp.id_trab, 
									               IF( pp.id_cp='$id_pri_quin',  'SI', '0.00')  AS monto,
									               ROUND( (tr.sueldo_trab/30)*pd.dias_vc + 0.0000000001 ,2) AS monto_a_pagar,
									               pd.fechas,
									               pd.dias_vc AS  dias
									               FROM permiso_personal pp
									               LEFT JOIN trabajador tr ON
									               tr.id_trab= pp.id_trab
									               LEFT JOIN  cronograma_pagos cp ON 
									               cp.id_cp='$id_pri_quin'
									               LEFT JOIN (
									                   SELECT  pp.id_trab,
									                   CASE 
									                    WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
									                    WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta   THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d'),' AL ' , DATE_FORMAT( DATE_SUB(cp.hasta, INTERVAL (   REPLACE( 15-( ( IFNULL(DATEDIFF(pp.fecha_procede, cp.desde),0))+  (IFNULL(DATEDIFF(cp.hasta, pp.fecha_procede),0) +1 )) ,'-', '')  ) DAY), '%d/%m/%Y'))     
									                    ELSE ''  END
									                    AS fechas,
									                   CASE
									                    WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  IFNULL(DATEDIFF( pp.fecha_hasta, pp.fecha_procede),0) +1 
									                    WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta   THEN   IFNULL(DATEDIFF( DATE_SUB(cp.hasta, INTERVAL ( REPLACE( 15-( ( IFNULL(DATEDIFF(pp.fecha_procede, cp.desde),0))+  (IFNULL(DATEDIFF(cp.hasta, pp.fecha_procede),0) +1 )) ,'-', '')) DAY), pp.fecha_procede),0) +1      
									                    ELSE ''  END
									                    AS dias_vc,
									                        REPLACE( 15-( ( IFNULL(DATEDIFF(pp.fecha_procede, cp.desde),0))+  (IFNULL(DATEDIFF(cp.hasta, pp.fecha_procede),0) +1 )) ,'-', '')    AS dato
									                       FROM permiso_personal pp
									                       LEFT JOIN  cronograma_pagos cp ON 
									                       cp.id_cp='$id_pri_quin'
									                       WHERE pp.tip_permiso='VC'
									                       AND pp.fecha_procede BETWEEN   cp.desde AND cp.hasta 
									                ) AS pd ON  pd.id_trab= pp.id_trab
									                          WHERE pp.tip_permiso='VC'
									                          AND pp.fecha_procede BETWEEN   cp.desde AND cp.hasta          
									            UNION ALL
									              SELECT      pp.id_trab, 
									                           IF( pp.id_cp='$id_pri_quin',  'SI', '0.00')  AS monto,
									                           ROUND( (tr.sueldo_trab/30)*( (pd.dias_vc)+ cps.dias_faltantes ) + 0.0000000001 ,2) AS monto_a_pagar,
									                           CASE 
									                WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta     THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
									                WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(cp.desde, '%d'),' AL ' , DATE_FORMAT( (DATE_ADD(pp.fecha_hasta, INTERVAL + cps.dias_faltantes DAY)), '%d/%m/%Y'))   
									                ELSE ''  END
									                     AS fechas,
									                     (pd.dias_vc)+ cps.dias_faltantes AS dias
									                           FROM permiso_personal pp
									                           LEFT JOIN trabajador tr ON
									                           tr.id_trab= pp.id_trab
									                           LEFT JOIN  cronograma_pagos cp ON 
									                           cp.id_cp='$id_pri_quin'
									                           LEFT JOIN 
									                           ( SELECT  pp.id_permiso, pp.id_trab,  sq.id_cp_desde, sq.id_cp_hasta,
									                                     REPLACE(15-( ( IFNULL(DATEDIFF(pp.fecha_procede, cp.desde),0))+  (IFNULL(DATEDIFF(cp.hasta, pp.fecha_procede),0) +1 ))  ,'-', '')     AS dias_faltantes
									                                  FROM permiso_personal pp 
									                  LEFT JOIN (
									                    SELECT pp.id_permiso, cp_desde.id_cp  AS id_cp_desde, cp_hasta.id_cp AS id_cp_hasta, id_trab
									                    FROM permiso_personal pp 
									                    LEFT JOIN cronograma_pagos cp_desde  ON 
									                    pp.`fecha_procede` BETWEEN  cp_desde.desde AND cp_desde.hasta
									                    LEFT JOIN cronograma_pagos cp_hasta  ON 
									                    pp.`fecha_hasta` BETWEEN  cp_hasta.desde AND cp_hasta.hasta
									                    WHERE pp.tip_permiso='VC'
									                  ) AS sq  ON  sq.id_permiso= pp.id_permiso
									                  LEFT JOIN  cronograma_pagos cp ON 
									                        cp.id_cp=sq.id_cp_desde
									                      WHERE  pp.tip_permiso='VC'
									                      AND sq.id_cp_desde!=sq.id_cp_hasta
									                           ) AS cps ON cps.id_permiso= pp.id_permiso
									                     LEFT JOIN (
									                       SELECT  pp.id_trab,
									                       pp.id_permiso,
									                   CASE
									                    WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta      THEN  IFNULL(DATEDIFF( pp.fecha_hasta, pp.fecha_procede),0) +1 
									                    WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN  IFNULL(DATEDIFF( pp.fecha_hasta, cp.desde),0) +1     
									                    ELSE ''  END
									                    AS dias_vc
									                       FROM permiso_personal pp
									                       LEFT JOIN  cronograma_pagos cp ON 
									                       cp.id_cp='$id_pri_quin'
									                       WHERE pp.tip_permiso='VC'
									                        AND pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta 
									                ) AS pd ON  pd.id_permiso= pp.id_permiso
									                          WHERE pp.tip_permiso='VC'
									                          AND pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta 
									                          AND pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta 
									        ) AS vac  ON vac.id_trab=tr.id_trab
									        LEFT JOIN 
									        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar,  pp.id_fecha_pago1, pp.id_cp,
									                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
									          IF( pp.id_cp='$id_pri_quin',  'SI', '0.00')  AS monto
									          FROM permiso_personal pp
									          WHERE pp.tip_permiso='DM'
									        ) AS dme  ON dme.id_trab=tr.id_trab
									        AND dme.id_cp='$id_pri_quin'
									        LEFT JOIN 
									        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
									                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
									          IF( pp.id_cp='$id_pri_quin',  'SI', '0.00')  AS monto
									          FROM permiso_personal pp
									          WHERE pp.tip_permiso IN ('LM','LP','FD', 'FF')
									        ) AS sub  ON sub.id_trab=tr.id_trab
									        AND sub.id_cp='$id_pri_quin'
									        LEFT JOIN 
									        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
									                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
									          IF( pp.id_cp='$id_pri_quin',  'SI', '0.00')  AS monto
									          FROM permiso_personal pp
									          WHERE pp.tip_permiso IN ('LC')
									        ) AS lco  ON lco.id_trab=tr.id_trab
									        AND lco.id_cp='$id_pri_quin'
									        LEFT JOIN 
									        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
									                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
									          IF( pp.id_cp='$id_pri_quin' ,  'SI', '0.00')  AS monto
									          FROM permiso_personal pp
									          WHERE pp.tip_permiso IN ('LS')
									        ) AS lsi  ON lsi.id_trab=tr.id_trab
									        AND lsi.id_cp='$id_pri_quin'
									        LEFT JOIN 
									        (SELECT tr.id_trab, 
									                DATEDIFF(cp.hasta,cp.desde)AS dias_cronograma,
									                IFNULL(ss.dias_asistidos, 0),
									               IF(tt.cantidad>0, 0 , IFNULL((DATEDIFF(cp.hasta,cp.desde) -  IFNULL(ss.dias_asistidos,0)) , DATEDIFF(ss.hasta,ss.desde) ))  AS dias_faltados 
									         FROM trabajador tr
									         LEFT JOIN
									           ( SELECT  tr.id_trab,cp.desde,  cp.hasta, re.fecha,  COUNT(re.fecha) AS dias_asistidos
									            FROM Trabajador tr 
									            LEFT JOIN reloj AS re ON
									            tr.id_trab= re.id_trab
									            LEFT JOIN  cronograma_pagos AS cp ON 
									              cp.id_cp='$id_pri_quin'
									             WHERE re.fecha BETWEEN cp.desde AND cp.hasta
									            GROUP BY tr.id_trab
									           ) AS  ss ON ss.id_trab= tr.id_trab
									        LEFT JOIN  cronograma_pagos AS cp ON 
									           cp.id_cp='$id_pri_quin'
									        LEFT JOIN
									          ( SELECT tr.id_trab, COUNT(pp.dias) AS cantidad
									            FROM Trabajador tr 
									             LEFT JOIN permiso_personal AS pp ON
									            pp.id_trab= tr.id_trab
									            LEFT JOIN  cronograma_pagos AS cp ON 
									              cp.id_cp='$id_pri_quin'
									            WHERE pp.fecha_procede BETWEEN cp.desde AND cp.hasta 
									          ) AS tt ON
									         tt.id_trab= tr.id_trab
									        ) AS difa ON difa.id_trab= tr.id_trab
									      WHERE tr.est_reg='1' 
									      ORDER BY tr.id_tip_plan ASC, tr.id_trab ASC 
		          ";
		return ejecutarConsulta($sql);

	}


	/*FIN - INSERTAR INFORMACION QUINCENAL A LA TABLA*/





}

?>