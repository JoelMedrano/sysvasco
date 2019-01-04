<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Vacaciones_Compradas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Implementamos un método para editar registros
	public function editar(  $id_permiso,
							 $pago_vac_comp,
							 $id_cp_vac_com)
	{
		
		$sql="UPDATE permiso_personal SET pago_vac_comp='$pago_vac_comp', id_cp_vac_com='$id_cp_vac_com' WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);

	}

	

	//Implementamos un método para anular la venta
	public function anular($nro_doc)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_permiso)
	{
		$sql="	SELECT  pp.id_permiso,
						'-' AS mar, 
						DATE_FORMAT(re.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
						re.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						 CONCAT(re.hor_ent, ' - ', re.hor_sal) hor_ent_sal,
						fe.estado,
						'' AS detalle,
						IFNULL(hep.tiempo_he,'') AS  horas_extras,
						IF( IFNULL(hpp.tiempo_he,'')='00:00:00', '' , IFNULL(hpp.tiempo_he,'') ) AS horas_faltas,
						hpp_min.tiempo_tardanza AS min_tardanza,
						DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y')  AS fecha_procede,
						DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')  AS fecha_hasta,
						pp.pago_vac_comp,
						pp.id_cp_vac_com,
						cc.Descrip_fec_pag  AS  fechas_pago
				FROM  reloj_vacacionescompradas re 
					INNER JOIN trabajador  tr  ON  
					re.id_trab= tr.id_trab  
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
					LEFT JOIN fechas fe ON
					fe.fecha= re.fecha
					LEFT JOIN
					(     SELECT  hep.id_trab, hep.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_extras_personal_vacaciones_compradas hep	
					      GROUP BY hep.id_trab, hep.fecha
					)AS hep ON hep.id_trab=re.id_trab
					AND hep.fecha=re.fecha	
					LEFT JOIN
					(     SELECT  hpp.id_trab, hpp.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_permiso_personal_vacaciones_compradas hpp	
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp ON hpp.id_trab=re.id_trab
					AND hpp.fecha=re.fecha	
					LEFT JOIN
					(   SELECT  hpp.id_trab, hpp.fecha, 
								hpp.tiempo_des AS tiempo_tardanza
					      FROM   horas_permiso_personal_vacaciones_compradas hpp	
					      WHERE hpp.tiempo_des <'00:30:00'
					      AND  hpp.tiempo_des >'00:00:00'
					      AND hpp.tiempo_fin<'00:30:00'
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp_min ON hpp_min.id_trab=re.id_trab
					AND hpp_min.fecha=re.fecha
				INNER JOIN  permiso_personal pp ON 
				pp.id_trab= re.id_trab
				lEFT JOIN (
					SELECT id_cp,
				 			 TbFpa.Des_Larga AS Descrip_fec_pag
					FROM cronograma_pagos cp
						LEFT  JOIN 	tabla_maestra_detalle TbPea ON
						TbPea.cod_argumento=  cp.id_ano
						AND TbPea.Cod_tabla='TPEA'
						LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
						TbFpa.cod_argumento=  cp.des_fec_pag
						AND TbFpa.Cod_tabla='TFPA'
					WHERE  cp.des_fec_pag  NOT IN  ('0')
					ORDER BY  cp.id_cp DESC
				) AS cc On cc.id_cp= pp.id_cp_vac_com
				WHERE pp.id_permiso='$id_permiso'
				AND re.fecha BETWEEN pp.fecha_procede AND pp.fecha_hasta	
				/*FIN MARCACIONES EN RELOJ A LA FECHA */ 
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_permiso)
	{
		$sql="SELECT  	'-' AS mar, 
						DATE_FORMAT(re.Fecha, '%d/%m/%Y')  AS Fecha,
						SUBSTRING(fe.nom_dia,1,3)  AS nom_dia,
						fe.dia,
						fe.mes,
						fe.ano,
						re.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						 CONCAT(re.hor_ent, ' - ', re.hor_sal) hor_ent_sal,
						fe.estado,
						'' AS detalle,
						IFNULL(hep.tiempo_he,'') AS  horas_extras,
						IF( IFNULL(hpp.tiempo_he,'')='00:00:00', '' , IFNULL(hpp.tiempo_he,'') ) AS horas_faltas,
						hpp_min.tiempo_tardanza AS min_tardanza
				FROM  reloj_vacacionescompradas re 
					INNER JOIN trabajador  tr  ON  
					re.id_trab= tr.id_trab  
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
					LEFT JOIN fechas fe ON
					fe.fecha= re.fecha
					LEFT JOIN
					(     SELECT  hep.id_trab, hep.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_extras_personal_vacaciones_compradas hep	
					      GROUP BY hep.id_trab, hep.fecha
					)AS hep ON hep.id_trab=re.id_trab
					AND hep.fecha=re.fecha	
					LEFT JOIN
					(     SELECT  hpp.id_trab, hpp.fecha, 
						DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin ))), '%H:%i:%s')   AS tiempo_he
					      FROM   horas_permiso_personal_vacaciones_compradas hpp	
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp ON hpp.id_trab=re.id_trab
					AND hpp.fecha=re.fecha	
					LEFT JOIN
					(   SELECT  hpp.id_trab, hpp.fecha, 
								hpp.tiempo_des AS tiempo_tardanza
					      FROM   horas_permiso_personal_vacaciones_compradas hpp	
					      WHERE hpp.tiempo_des <'00:30:00'
					      AND  hpp.tiempo_des >'00:00:00'
					      AND hpp.tiempo_fin<'00:30:00'
					      GROUP BY hpp.id_trab, hpp.fecha
					)AS hpp_min ON hpp_min.id_trab=re.id_trab
					AND hpp_min.fecha=re.fecha
				INNER JOIN  permiso_personal pp ON 
				pp.id_trab= re.id_trab
				WHERE pp.id_permiso='$id_permiso'
				AND re.fecha BETWEEN pp.fecha_procede AND pp.fecha_hasta	
				/*FIN MARCACIONES EN RELOJ A LA FECHA */ 
";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' as vc ,
					  pp.id_trab,
					  pp.id_permiso,
					  CONCAT(tr.apepat_trab, ' ' ,tr.apemat_trab , ' ' ,tr.nom_trab) AS nombresyapellidos,
					  DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y')  AS fecha_procede, 
					  DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')  AS  fecha_hasta
				FROM permiso_personal pp
				LEFT JOIN  trabajador tr ON 
				tr.id_trab= pp.id_trab
				WHERE pp.tip_permiso='VC'
				AND pp.id_vac_com='1' ";
		return ejecutarConsulta($sql);		
	}



	//  Implementar un método para listar los trabajadores que son destajeros
	public function selectTrabajadoresDestajeros()
	{
		$sql="SELECT  id_trab,   CONCAT(apepat_trab, ' ' , apemat_trab, ' ', SUBSTRING_INDEX(nom_trab, ' ', 1))    AS nombres , (sueldo_trab/2) AS sueldo, bono_des_trab
		FROM trabajador 
		where id_form_pag='2' 
		order by apepat_trab ASC";
		return ejecutarConsulta($sql);		
	}


	//  Implementar un método para listar los trabajadores que son destajeros
	public function selectFechaspago()
	{
		$sql="SELECT id_cp AS id_cp_vac_com, 
		 			 TbPea.Des_Corta AS Ano,
		 			CONCAT( TbPea.Des_Corta, ' - ',  TbFpa.Des_Larga) AS fechas_pago,
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			 ORDER BY  TbPea.Des_Corta ASC, cp.des_fec_pag ASC";
		return ejecutarConsulta($sql);		
	}






	
}
?>