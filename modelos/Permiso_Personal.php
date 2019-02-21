<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso_Personal
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}



	public function consultar_diasdeintervalo( $fecha_procede, $fecha_hasta )
	{
		
		$sql="SELECT DATEDIFF( '$fecha_hasta', '$fecha_procede')+1 AS   dias;
 			 ";
		return ejecutarConsulta($sql);

	}


	


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_tipodepagovacaciones($id_trab, $tip_permiso, $dias )
	{
		
		$sql="SELECT id_trab,  id_pag_vac_cts
			  FROM Trabajador  
			  WHERE id_trab='$id_trab'  AND  '$tip_permiso'='VC'
			  AND '$dias'>'0'
 			 ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_pagodevacacionesjornal($id_trab, $dias  )
	{
		
		$sql="SELECT id_trab, ROUND( ((sueldo_trab/30) * '$dias'),2)  AS monto_a_pagar, sueldo_trab
			  FROM Trabajador  
			  WHERE id_trab='$id_trab' 
 			 ";
		return ejecutarConsulta($sql);

	}


		public function consultar_id_cronograma_pago( $fecha_procede, $fecha_hasta )
	{
		
		$sql="SELECT id_cp  FROM cronograma_pagos cp WHERE  '$fecha_procede' BETWEEN cp.desde and cp.hasta
 			 ";
		return ejecutarConsulta($sql);

	}





	//Implementamos un método para insertar registros
	public function insertar($id_permiso,
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
							 $imagen4)
	{
		$sql="INSERT INTO permiso_personal (id_permiso,
											id_trab, 
											fecha_emision,
											fecha_procede, 
											fecha_hasta, 
											dias,  
											tip_permiso,
											id_vac_com,
											id_cp, 
											hora_ing, 
											hora_sal,  
											motivo, 
											id_fecha_pago1,
											monto_a_pagar,
											id_fecha_pago2,
											id_fecha_pago3,
											id_fecha_pago4, 
											est_reg, 
											fec_reg, 
											pc_reg, 
											usu_reg, 
											imagen1, 
											imagen2, 
											imagen3, 
											imagen4 )
									VALUES ('$id_permiso',
										    '$id_trab',
										    '$fecha_emision',
										    '$fecha_procede',
										    '$fecha_hasta', 
										    '$dias', 
										    '$tip_permiso',
										    '$id_vac_com',
										    '$id_cp',
										    '$hora_ing', 
										    '$hora_sal',  
										    '$motivo', 
										    '$id_fecha_pago1',
										    '$monto_a_pagar',
											'$id_fecha_pago2',
							                '$id_fecha_pago3',
							                '$id_fecha_pago4', 
										    '1',  
										    '$fec_reg', 
										    '$pc_reg', 
										    '$usu_reg', 
										    '$imagen1', 
										    '$imagen2', 
										    '$imagen3', 
										    '$imagen4' )";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_permiso,
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
						   $imagen4)
	{
		$sql="UPDATE permiso_personal SET id_trab='$id_trab',
										  fecha_emision='$fecha_emision',
										  fecha_procede='$fecha_procede',
										  fecha_hasta='$fecha_hasta', 
										  dias='$dias',  
										  tip_permiso='$tip_permiso',
										  id_vac_com='$id_vac_com', 
										  hora_ing='$hora_ing',
										  hora_sal='$hora_sal', 
										  motivo='$motivo', 
										  id_fecha_pago1='$id_fecha_pago1',
										  monto_a_pagar='$monto_a_pagar',
										  id_fecha_pago2='$id_fecha_pago2',
										  id_fecha_pago3='$id_fecha_pago3',
										  id_fecha_pago4='$id_fecha_pago4', 
										  fec_mod='$fec_reg', 
										  pc_mod='$pc_reg', 
										  usu_mod='$usu_reg', 
										  imagen1='$imagen1', 
										  imagen2='$imagen2', 
										  imagen3='$imagen3', 
										  imagen4='$imagen4' 
								    WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_reg='0',  fec_anu='$fec_reg', pc_anu='$pc_reg', usu_anu='$usu_reg'   WHERE id_permiso='$id_permiso'  ";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_reg='1',  fec_mod='$fec_reg', pc_mod='$pc_reg', usu_mod='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}


	public function insertar_data_eliminada( $id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{


		$sql="INSERT INTO permiso_personal_data_eliminada
					SELECT * FROM permiso_personal WHERE  id_permiso='$id_permiso'  ";
		return ejecutarConsulta($sql);


	}

	

	//Implementamos un método para desactivar registros
	public function eliminar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="DELETE FROM  permiso_personal    WHERE id_permiso='$id_permiso'  ";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para aprobar registros
	public function aprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro='1',  fec_apro='$fec_reg', pc_apro='$pc_reg', usu_apro='$usu_reg'   WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desaprobar registros
	public function desaprobar($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro='0',  fec_desapro='$fec_reg', pc_desapro='$pc_reg', usu_desapro='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para aprobar registros
	public function aprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro_rrhh='1',  fec_apro_rrhh='$fec_reg', pc_apro_rrhh='$pc_reg', usu_apro_rrhh='$usu_reg'   WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desaprobar registros
	public function desaprobarRRHH($id_permiso, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET est_apro_rrhh='0',  fec_desapro_rrhh='$fec_reg', pc_desapro_rrhh='$pc_reg', usu_desapro_rrhh='$usu_reg'  WHERE id_permiso='$id_permiso'";
		return ejecutarConsulta($sql);
	} 




	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_permiso)
	{
		$sql="SELECT DATE(fecha_emision)  AS fecha_emision,
		   			 dias,
		             DATE(fecha_procede) AS fecha_procede,
		             DATE(fecha_hasta) AS fecha_hasta,
		             tip_permiso, 
		             id_trab, 
		             id_permiso, 
		             hora_ing, 
		             hora_sal, 
		             motivo, 
		             id_fecha_pago1,
		             monto_a_pagar,
		             id_fecha_pago2,
		             id_fecha_pago3,
		             id_fecha_pago4,
		             est_reg, 
		             imagen1, 
		             imagen2, 
		             imagen3, 
		             imagen4  
		             FROM permiso_personal 
		             WHERE id_permiso='$id_permiso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  '' as pp,  CONCAT_WS(' ',  tr1.apepat_trab,  SUBSTRING_INDEX(tr1.nom_trab, ' ',1) ) AS solicitante,
		 CONCAT(  tr.nom_trab, ' ' , tr.apepat_trab , ' ' , tr.apemat_trab ) AS nombres,
		    DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,  DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta, DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.apepat_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro , pp.est_apro_rrhh, NULL AS ninguno
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 INNER JOIN usuario usu ON
		 usu.login= pp.usu_reg
		 LEFT JOIN Trabajador tr1 ON
		 tr1.id_trab= usu.id_trab
		 ORDER BY YEAR(pp.fecha_procede) DESC, pp.id_permiso DESC
		 ";
		return ejecutarConsulta($sql);	
	}

	

	//Implementar un método para listar los registros
	public function listarfiltrado($idusuario)
	{
		$sql="SELECT  CONCAT_WS(' ',  tr1.apepat_trab,  SUBSTRING_INDEX(tr1.nom_trab, ' ',1) ) AS solicitante,
		 CONCAT_WS(' ',   SUBSTRING_INDEX(tr.nom_trab, ' ',1) , tr.apepat_trab ) AS nombres,
		    DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,  DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta, DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.apepat_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro , pp.est_apro_rrhh, null as ninguno
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 INNER JOIN usuario usu ON
		 usu.login= pp.usu_reg
		 LEFT JOIN Trabajador tr1 ON
		 tr1.id_trab= usu.id_trab
		 WHERE usu.idusuario='$idusuario' 
		 order by pp.id_permiso DESC
		 ";
		return ejecutarConsulta($sql);	
	}



	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function selectFechaPagoVacaciones()
	{
		$sql="SELECT id_cp, 
		 			 id_ano,
		 			 TbPea.Des_Corta AS Ano,
					 TbFpa.Des_Larga AS Descrip_fec_pag,
					 des_fec_pag, 
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha1,
					 id_cp AS id_fecha_pago1,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha2,
					 id_cp AS id_fecha_pago2,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha3,
					 id_cp AS id_fecha_pago3,
					 CONCAT(TbPea.Des_Corta, ' - ' ,TbFpa.Des_Larga, ' - DEL ',   DATE_FORMAT(cp.desde, '%d/%m/%Y'), ' AL ', DATE_FORMAT(cp.hasta, '%d/%m/%Y')  ) AS fecha4,
					 id_cp AS id_fecha_pago4,
					 est_reg 
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






	//Implementar un método para listar los registros
	public function reporte()
	{
		$sql="SELECT DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,   DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.ape_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro 
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 ";
		return ejecutarConsulta($sql);		
	}

	

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}


	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}




	//Implementamos un método para insertar registros
	public function insertar_reloj_data_eliminada( $id_trab, $fecha_procede , $fecha_hasta )
	{

		$sql="INSERT INTO reloj_data_eliminada
			  SELECT * FROM reloj 
			  WHERE  id_trab='$id_trab'  
			  AND fecha>='$fecha_procede' 
			  AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function actualizar_quienelimino_reloj(  $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg,	$usu_reg   )
	{
		$sql="UPDATE reloj_data_eliminada SET   fec_mod='$fec_reg', 
											  	pc_mod='$pc_reg', 
										 		usu_mod='$usu_reg' 
								    	  WHERE id_trab='$id_trab'
								          AND fecha>='$fecha_procede' 
								          AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para eliminar registros
	public function eliminar_reloj(  $id_trab, $fecha_procede, $fecha_hasta)
	{
		$sql="DELETE FROM reloj WHERE   id_trab='$id_trab' 
								AND fecha>='$fecha_procede' 
								AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}






	//Implementamos un método para insertar registros
	public function insertar_hora_falta_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta )
	{

		$sql="INSERT INTO horas_permiso_personal_data_eliminada
			  SELECT * FROM horas_permiso_personal WHERE  id_trab='$id_trab'  
			  										AND fecha>='$fecha_procede' 
								         			AND fecha<='$fecha_hasta'  ";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function actualizar_quienelimino_hora_falta(  $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg,	$usu_reg   )
	{
		$sql="UPDATE horas_permiso_personal_data_eliminada SET   fec_mod='$fec_reg', 
											  	pc_mod='$pc_reg', 
										 		usu_mod='$usu_reg' 
								    	  WHERE id_trab='$id_trab'
								          AND fecha>='$fecha_procede' 
								          AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para eliminar registros
	public function eliminar_hora_falta(  $id_trab, $fecha_procede, $fecha_hasta)
	{
		$sql="DELETE FROM horas_permiso_personal WHERE   id_trab='$id_trab'  
													AND fecha>='$fecha_procede' 
								         			AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}








	//Implementamos un método para insertar registros
	public function insertar_hora_extra_data_eliminada( $id_trab, $fecha_procede, $fecha_hasta )
	{

		$sql="INSERT INTO horas_extras_personal_data_eliminada
			  SELECT * FROM horas_extras_personal WHERE  id_trab='$id_trab'  
			  										AND fecha>='$fecha_procede' 
								         			AND fecha<='$fecha_hasta'  ";
		return ejecutarConsulta($sql);

	}

	//Implementamos un método para editar registros
	public function actualizar_quienelimino_hora_extra(  $id_trab, $fecha_procede, $fecha_hasta, $fec_reg, $pc_reg,	$usu_reg   )
	{
		$sql="UPDATE horas_extras_personal_data_eliminada SET   fec_mod='$fec_reg', 
											  	pc_mod='$pc_reg', 
										 		usu_mod='$usu_reg' 
								    	  WHERE id_trab='$id_trab'
								          AND fecha>='$fecha_procede' 
								          AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para eliminar registros
	public function eliminar_hora_extra(  $id_trab, $fecha_procede, $fecha_hasta)
	{
		$sql="DELETE FROM horas_extras_personal WHERE   id_trab='$id_trab'  AND fecha>='$fecha_procede' AND fecha<='$fecha_hasta' ";
		return ejecutarConsulta($sql);
	}
	



	//Implementamos un método para insertar registros como falta por suspension 
	public function insertar_faltas_desde_hasta( $id_trab, $fecha_procede, $fecha_hasta,  $fec_reg, $pc_reg, $usu_reg )
	{

		$sql="INSERT INTO horas_permiso_personal (id_trab,
												  fecha,
												  tiempo_des,
												  tiempo_fin, 
												  cant_dia_fin, 
												  id_incidencia, 
												  id_fec_dscto, 
												  descontar, 
												  descontado, 
												  habilitar_dscto,  
												  est_reg, 
												  fec_reg,
												  usu_reg, 
												  pc_reg
		                                          )
								                SELECT  
												'$id_trab' AS id_trab,
												 fe.fecha,
												 '00:00:00'  AS tiempo_des,
												 '00:00:00'  AS tiempo_fin,
												 '1' AS cantidad_dias,
												 '3' AS id_incidencia, 
												 cp.id_cp AS id_fec_dscto,
												 '1' AS descontar, 
												 '2' AS descontado, 
												 '2' AS habilitar_dscto,
												 '1' AS est_reg,
												 '$fec_reg',
												 '$usu_reg',
												 '$pc_reg'
												FROM fechas  fe
												LEFT JOIN ( SELECT   cp.id_cp, fe.fecha
													    FROM cronograma_dsctos_horasdias cp
													    LEFT  JOIN 	tabla_maestra_detalle TbPea ON
															TbPea.cod_argumento=  cp.id_ano
															AND TbPea.Cod_tabla='TPEA'
													    LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
															TbFpa.cod_argumento=  cp.des_fec_pag
															AND TbFpa.Cod_tabla='TFPA'
													    LEFT JOIN fechas fe ON
															fe.fecha BETWEEN cp.desde AND cp.hasta
													    WHERE  cp.des_fec_pag  NOT IN  ('0')
													) AS cp 
												ON cp.fecha= fe.fecha
												WHERE  fe.fecha>='$fecha_procede' AND fe.fecha<='$fecha_hasta' 
												AND NOT EXISTS ( 
																  SELECT     NULL
																  FROM horas_permiso_personal  pp
																  WHERE '$id_trab'= pp.id_trab
																  AND  pp.fecha>='$fecha_procede' AND pp.fecha<='$fecha_hasta'
												)
												/*COLOCAR QUE NO DEBE TENER REGISTRO COMO DIA FALTADOS*/
												 ";
		return ejecutarConsulta($sql);

	}





}

?>