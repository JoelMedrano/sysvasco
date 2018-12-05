<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Registro_Manual_Horas_Dias
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}



	public function consultar_dia_delafecha( $fecha )
	{
		
		$sql=" SELECT (ELT(WEEKDAY('$fecha') + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS dia_texto  ";
		return ejecutarConsulta($sql);

	}


	
	



	public function consultar_registroenelreloj( $id_trab, $fecha )
	{
		
		$sql="SELECT  id_trab AS id from reloj where fecha ='$fecha' AND id_trab ='$id_trab' ";
		return ejecutarConsulta($sql);

	}


	


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_tipodepagovacaciones( $id_trab, $fecha )
	{
		
		$sql="SELECT  id_trab AS id from horas_extras_personal where fecha ='$fecha' AND id_trab ='$id_trab'
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




	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar_turno($id_trab)
	{
		$sql="SELECT hr.id_turno, hrt.id_trab  
			  FROM horario_refrigerio_trabajador hrt
			  LEFT JOIN horario hr  ON
			   hr.id_horario= hrt.id_horario
			  WHERE hrt.id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarDataPersonal($id_trab)
	{
		$sql="SELECT  id_tip_plan, id_turno FROM trabajador WHERE id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}






	//Implementamos un método para insertar registros
	public function insertar(				   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg)
	{
		$sql="INSERT INTO registro_manual_horas_dias (id_trab,
											fecha, 
											hora_ing,
											hora_sal, 
											id_accion, 
											obs,   
											est_reg, 
											fec_reg, 
											pc_reg, 
											usu_reg )
									VALUES ('$id_trab',
										    '$fecha',
										    '$hora_ing',
										    '$hora_sal',
										    '$id_accion', 
										    '$obs', 
										    '1',
										    '$fec_reg', 
										    '$pc_reg', 
										    '$usu_reg')";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para insertar registros
	public function insertar_reloj($id_trab,
									$fecha,
									$fec_reg,
									$pc_reg,
									$usu_reg,
									$hora_ing, 
									$hora_sal,
									$id_tip_plan,
									$dia,
									$est_hor,
									$id_turno )
	{


		$sql="INSERT INTO reloj (id_trab,  fecha , hor_ent,       hor_sal,       pc_reg,    usu_reg,   fec_reg,       tip_pla,     tip_mov,   est_hor,     turno )
					VALUES ('$id_trab', '$fecha', '$hora_ing' ,  '$hora_sal' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' )";
		return ejecutarConsulta($sql);


	}




	//Implementamos un método para editar registros
	public function editar(				       $id_rmhd,
											   $id_trab,
											   $fecha,
											   $hora_ing, 
											   $hora_sal, 
											   $id_accion, 
											   $obs, 
											   $fec_reg, 
											   $pc_reg, 
											   $usu_reg
											   )
	{
		$sql="UPDATE registro_manual_horas_dias SET id_trab='$id_trab',
										  fecha='$fecha',
										  hora_ing='$hora_ing',
										  hora_sal='$hora_sal', 
										  id_accion='$id_accion', 
										  obs='$obs',
										  fec_mod='$fec_reg', 
										  pc_mod='$pc_reg', 
										  usu_mod='$usu_reg' 
								    WHERE id_rmhd='$id_rmhd'";
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
		$sql="SELECT DATE_FORMAT(fecha_emision, '%d/%m/%Y') AS fecha_emision,
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
		$sql="SELECT    id_rmhd, 
				  IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
				  tare.des_larga AS area_trab, 
				  CONCAT_WS(' ',    tr.nom_trab , tr.apepat_trab, tr.apemat_trab) AS nombres,
				  DATE_FORMAT(rm.fecha, '%d/%m/%Y') AS fecha
			 FROM registro_manual_horas_dias rm
			 LEFT JOIN Trabajador tr ON
			 tr.id_trab= rm.id_trab
			 LEFT JOIN tabla_maestra_detalle AS tsua ON
			 tsua.cod_argumento= tr.id_sucursal
			 AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL 
			 LEFT JOIN tabla_maestra_detalle AS tare ON
			 tare.cod_argumento= tr.id_area
			 AND tare.cod_tabla='TARE'
				
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






	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function selectAccion()
	{
		$sql=" SELECT  Cod_Argumento AS id_accion, des_larga AS accion 
		FROM tabla_maestra_detalle 
		WHERE cod_tabla='TACC'";
		return ejecutarConsulta($sql);
	}





}

?>