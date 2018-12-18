<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro_Marcaciones
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementamos un método para actualizar el contrato
	public function editar($id_trab,
										   $id_con_trab,
										   $tie_ren_ant,
										   $fec_ini_ant,
										   $fec_fin_ant,
										   $id_sit_inf_ant,
										   $usu_reg,
										   $pc_reg,
										   $fec_reg  )
	{
		
		$sql="UPDATE contratos SET tie_ren_con='$tie_ren_ant', fec_ini_con='$fec_ini_ant', fec_fin_con='$fec_fin_ant',  id_sit_inf='$id_sit_inf_ant' WHERE id_trab='$id_trab' AND  id_con_trab='$id_con_trab' ";
		return ejecutarConsulta($sql);


	}

	
    


	


	public function insertar2(			 $id_trab,
										 $tie_ren_con,
										 $fec_ini_con,
										 $fec_fin_con,
										 $id_sit_inf_act,
										 $CantItems,
										 $usu_reg,
										 $pc_reg,
										 $fec_reg )
	{
		




	$CantItems=$CantItems+1;
		
			$sql= "INSERT INTO contratos  (   		   id_trab,
													   id_con_trab,
													   tie_ren_con,
													   fec_ini_con,
													   fec_fin_con,
													   id_sit_inf,
													   usu_reg,
													   pc_reg,
													   fec_reg  ) 
											   VALUES( '$id_trab',
											   		   '$CantItems',
											           '$tie_ren_con',
											           '$fec_ini_con',
											           '$fec_fin_con',
											           '$id_sit_inf_act',
											           '$usu_reg',
											           '$pc_reg',
											           '$fec_reg')  ";
		
			
			
		

			return ejecutarConsulta($sql);

	}


	//Implementamos un método para anular la venta
	public function anular($nro_doc)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($nro_doc)
	{
		$sql="SELECT Tra.id_trab, Tra.num_doc_trab AS nro_doc, Tra.num_doc_trab AS id_nomtrab ,  CONCAT(Tra.apepat_trab, ' ' , Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres ,   Tra.apemat_trab, Tra.apepat_trab, Tra.nom_trab, Tra.id_sucursal, Tra.id_area, TbAre.Des_Larga AS area_trab,
              TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab, IFNULL(MAX(con.id_con_trab),0) AS CantItems,
               MAX(DATE(con.fec_ini_con)) AS  fec_ini_ant , MAX(DATE(con.fec_fin_con)) AS fec_fin_ant, con.tie_ren_con AS tie_ren_ant, con.id_con_trab,
               con.id_sit_inf AS id_sit_inf_ant,  TbSic.des_larga AS situacion_informativa_actual
				FROM Trabajador Tra
				LEFT JOIN contratos con ON
					con.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle TbAre ON
					TbAre.cod_tabla='TARE'
					AND TbAre.cod_argumento= Tra.id_area
				LEFT JOIN tabla_maestra_detalle TbSua ON
					TbSua.cod_tabla='TSUA'
					AND TbSua.cod_argumento= Tra.id_sucursal
				LEFT JOIN tabla_maestra_detalle TbSic ON
					TbSic.cod_tabla='TSIC'
					AND TbSic.cod_argumento= con.id_sit_inf
				WHERE  tra.num_doc_trab='$nro_doc' 
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($nro_doc)
	{
		$sql="SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE(fec_del) AS  fec_del, DATE(fec_al) AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
				 pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle
				FROM Vacaciones vac
				LEFT JOIN tabla_maestra_detalle  TbPea ON
				TbPea.cod_tabla='TPEA'
				AND TbPea.cod_argumento= vac.id_periodo
				where vac.nro_doc='$nro_doc'
				ORDER BY  vac.correlativo ASC";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  * FROM (/*INICIO MARCACIONES EN RELOJ A LA FECHA */ 
				SELECT  	'-' AS mar, 
						DATE_FORMAT(re.Fecha, '%d/%m/%Y')  AS Fecha,
						fe.nom_dia AS nom_dia,
						fe.dia,
						fe.mes,
						re.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						 CONCAT(re.hor_ent, ' - ', re.hor_sal) hor_ent_sal,
						fe.estado,
						'' AS detalle
				FROM  reloj re 
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
				/*FIN MARCACIONES EN RELOJ A LA FECHA */ 
				UNION ALL
				/*INICIO  -  FALTAS REGISTRADAS EN LA TABLA CON DIAS INTEGROS*/
				SELECT  '-' AS mar, 
						DATE_FORMAT(hpp.Fecha, '%d/%m/%Y')  AS Fecha,
						fe.nom_dia AS nom_dia,
						fe.dia,
						fe.mes,
						hpp.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						'FALTA' hor_ent_sal,
						fe.estado,
						pp.permiso AS detalle
				FROM  horas_permiso_personal hpp
				INNER JOIN trabajador  tr  ON  
					hpp.id_trab= tr.id_trab  
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
					fe.fecha= hpp.fecha
					LEFT JOIN(
						SELECT  pp.fecha_procede, pp.fecha_hasta , pp.id_trab, tbm.des_larga AS permiso
						FROM permiso_personal pp 
						LEFT JOIN tabla_maestra_detalle  tbm ON
						tbm.des_corta= pp.tip_permiso
						AND tbm.cod_tabla='TPER'
						WHERE pp.tip_permiso NOT IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM')
					) AS pp ON pp.id_trab= hpp.id_trab
					AND hpp.fecha BETWEEN pp.fecha_procede AND  pp.fecha_hasta 
					WHERE hpp.cant_dia_fin='1'
					/*FIN  -  FALTAS REGISTRADAS EN LA TABLA CON DIAS INTEGROS*/
					 UNION ALL 
					 /*INICIO -  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					 SELECT  '-' AS mar, 
						DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
						fe.nom_dia AS nom_dia,
						fe.dia,
						fe.mes,
						pp.id_trab,
						CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
						tsua.des_larga AS sucursal_anexo,
						tfun.des_larga AS funcion,
						tare.des_larga AS area_trab,
						tr.num_doc_trab,
						tbm.des_larga AS  hor_ent_sal, /**/
						fe.estado,
						'' AS detalle
					 FROM fechas fe
					 INNER JOIN permiso_personal pp ON
					 fe.fecha BETWEEN  pp.fecha_procede  AND pp.fecha_hasta 
					 LEFT JOIN Trabajador tr ON
					 pp.id_trab= tr.id_trab
					 LEFT JOIN tabla_maestra_detalle  tbm ON
					 tbm.des_corta= pp.tip_permiso
					 AND tbm.cod_tabla='TPER'
					 LEFT JOIN tabla_maestra_detalle AS tpla ON
						tpla.cod_argumento= tr.id_tip_plan
						AND tpla.cod_tabla='TPLA'
					 LEFT JOIN tabla_maestra_detalle AS tsua ON
						tsua.cod_argumento= tr.id_sucursal
						AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
						tfun.cod_argumento= tr.id_funcion
						AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
						tare.cod_argumento= tr.id_area
						AND tare.cod_tabla='TARE'
					WHERE  NOT EXISTS (  SELECT  NULL FROM reloj re WHERE pp.id_trab= re.id_trab AND fe.fecha= re.fecha)
					AND pp.tip_permiso IN ('VC', 'LC','LS', 'LM', 'LP', 'FD' , 'FF', 'DM')
					AND fe.fecha <= CURDATE()
					/*FIN  VACACIONES , PERMISO Y LICENCIAS CON DIAS INTEGROS*/
					UNION ALL
					/* FERIADOS Y DOMINGOS*/
					SELECT   '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							fe.nom_dia AS nom_dia,
						    fe.dia,
		                    fe.mes,
		                    tr.id_trab,
		                    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
		                    tsua.des_larga AS sucursal_anexo,
		                    tfun.des_larga AS funcion,
		                    tare.des_larga AS area_trab,
		                    tr.num_doc_trab,
		                    fe.estado AS  hor_ent_sal, /**/
	                    	fe.estado,
		                    '' AS detalle
				    FROM Trabajador AS tr CROSS JOIN  Fechas AS fe
					LEFT JOIN tabla_maestra_detalle AS tpla ON
						tpla.cod_argumento= tr.id_tip_plan
						AND tpla.cod_tabla='TPLA'
					LEFT JOIN tabla_maestra_detalle AS tsua ON
						tsua.cod_argumento= tr.id_sucursal
						AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
						tfun.cod_argumento= tr.id_funcion
						AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
						tare.cod_argumento= tr.id_area
						AND tare.cod_tabla='TARE'
					WHERE fe.fecha<= CURDATE()
				    AND fe.estado IN ('FERIADO','NO LABORABLE')
                    AND  NOT EXISTS(  SELECT  NULL 
		  				              FROM reloj re 
		  							  WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha
	    		    ) /*CASOS COMO VIGILANCIA*/
					AND NOT EXISTS(  SELECT NULL 
		 							 FROM permiso_personal pp 
		  							 WHERE  fe.fecha BETWEEN  pp.fecha_procede  AND pp.fecha_hasta 
		 							 AND pp.id_trab=tr.id_trab
	    			)
					/*FIN - FERIADOS Y DOMINGOS */
					UNION ALL
					/*INICIO - DIAS NO LABORABLES SEGUN HORARIO */
					SELECT  '-' AS mar, 
							DATE_FORMAT(fe.fecha, '%d/%m/%Y')  AS Fecha,
							fe.nom_dia AS nom_dia,
							fe.dia,
							fe.mes,
							tr.id_trab,
							CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
							tsua.des_larga AS sucursal_anexo,
							tfun.des_larga AS funcion,
							tare.des_larga AS area_trab,
							tr.num_doc_trab,
							'NO LABORABLE SEGUN HORARIO' AS  hor_ent_sal, /**/
							fe.estado,
							'' AS detalle
						FROM  trabajador tr CROSS JOIN fechas fe
						LEFT JOIN tabla_maestra_detalle AS tpla ON
							  tpla.cod_argumento= tr.id_tip_plan
							  AND tpla.cod_tabla='TPLA'
						LEFT JOIN tabla_maestra_detalle AS tsua ON
							  tsua.cod_argumento= tr.id_sucursal
							  AND tsua.cod_tabla='TSUA'
						LEFT JOIN tabla_maestra_detalle AS tfun ON
							 tfun.cod_argumento= tr.id_funcion
							 AND tfun.cod_tabla='TFUN'
						LEFT JOIN tabla_maestra_detalle AS tare ON
							 tare.cod_argumento= tr.id_area
							AND tare.cod_tabla='TARE'
						LEFT JOIN 
						( 				SELECT  hrt.id_trab, fe.fecha, 
										CASE 
														WHEN  fe.nom_dia='LUNES' THEN hor.lunes_ingreso
														WHEN  fe.nom_dia='MARTES' THEN hor.martes_ingreso
														WHEN  fe.nom_dia='MIERCOLES' THEN hor.miercoles_ingreso 
														WHEN  fe.nom_dia='JUEVES' THEN hor.jueves_ingreso 
														WHEN  fe.nom_dia='VIERNES' THEN hor.viernes_ingreso 
														WHEN  fe.nom_dia='SABADO' THEN hor.sabado_ingreso 
														WHEN  fe.nom_dia='DOMINGO' THEN hor.domingo_ingreso 
														ELSE '-'  END
														AS hora_ingreso
										FROM horario_refrigerio_trabajador AS hrt 
										LEFT JOIN horario  AS  hor ON
										hrt.id_horario= hor.id_horario
										LEFT JOIN refrigerio AS ref ON
										ref.cod_ref= hrt.cod_ref 
										LEFT JOIN  fechas AS fe  ON
										fe.estado='LABORABLE'
										
						) AS dato  ON dato.id_trab= tr.id_trab
						AND dato.fecha=fe.fecha
						WHERE  fe.fecha <= CURDATE()
						AND dato.hora_ingreso='00:00:00'
						AND  NOT EXISTS (  SELECT  NULL FROM reloj re WHERE tr.id_trab= re.id_trab AND fe.fecha= re.fecha)

					/*FIN - DIAS NO LABORABLES SEGUN HORARIO*/

					) rm order by rm.mes DESC, rm.dia DESC
					";
		return ejecutarConsulta($sql);		
	}

	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function obtenercantidaditems($nro_doc)
	{
		$sql="SELECT MAX(correlativo)
		 FROM vacaciones 
		 WHERE nro_doc='$nro_doc' 
		 ";
		return ejecutarConsulta($sql);	
	}



	
}
?>