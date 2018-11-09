<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";




Class Reloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno )
	{


		$sql="INSERT INTO reloj (id_trab, fecha , hor_ent,  pc_reg, usu_reg, fec_reg, tip_pla, tip_mov, est_hor, turno )
		VALUES ('$id_trab', '$fecha', '$hora' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar_primera_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}



	//Implementamos un método para editar registros
	public function editar_segunda_entrada($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET segunda_hor_ent='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}



		//Implementamos un método para editar registros
	public function editar_segunda_salida($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET segunda_hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
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



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' ";
		return ejecutarConsulta($sql);

	}



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarDataPersonal($id_trab)
	{
		$sql="SELECT  id_tip_plan, id_turno FROM trabajador WHERE id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarPrimeraSalida($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla, hor_sal FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  hor_sal!='' ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarSegundaEntrada($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla, segunda_hor_ent FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  segunda_hor_ent!='' ";
		return ejecutarConsulta($sql);

	}


	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarSegundaSalida($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla, segunda_hor_sal FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' AND  segunda_hor_sal!='' ";
		return ejecutarConsulta($sql);

	}



   //Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarUsuariosQuePuedenRealizarHE_FP($id_trab)
	{
		$sql="SELECT tr.id_trab AS id_permitido
				FROM trabajador tr
				WHERE tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
				AND tr.id_trab='$id_trab'";
		return ejecutarConsulta($sql);

	}

	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultaridfechaasociada($fecha)
	{
		$sql="SELECT '-' AS pd ,
					 cp.id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
					 fe.fecha,
					 est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN fechas fe ON
				fe.fecha BETWEEN cp.desde AND cp.hasta
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND fe.fecha='$fecha'
			ORDER BY  cp.id_cp ASC
				";
		return ejecutarConsulta($sql);

	}


	





	public function consultarHoraIngreso($id_trab, $fecha, $hora )
	{
		$sql="SELECT    tr.id_trab, 
						REPLACE(TIMEDIFF( '$hora', ft.hora_ingreso ) ,'-', '')  AS tiempo_largo , 
						REPLACE(TIME_TO_SEC( TIMEDIFF( '$hora', ft.hora_ingreso ) ) ,'-', '')  AS cant_tiempo, 
						ft.hora_ingreso AS hora_ing,
						ft.hora_ini_ref,
						ft.hora_fin_ref,
						ft.tiempo_ref
				FROM trabajador tr 
				LEFT JOIN 	
				(SELECT  hrt.id_trab, CASE 
								WHEN  fe.nom_dia='LUNES' THEN hor.lunes_ingreso
								WHEN  fe.nom_dia='MARTES' THEN hor.martes_ingreso
								WHEN  fe.nom_dia='MIERCOLES' THEN hor.miercoles_ingreso 
								WHEN  fe.nom_dia='JUEVES' THEN hor.jueves_ingreso 
								WHEN  fe.nom_dia='VIERNES' THEN hor.viernes_ingreso 
								WHEN  fe.nom_dia='SABADO' THEN hor.sabado_ingreso 
								WHEN  fe.nom_dia='DOMINGO' THEN hor.domingo_ingreso 
								ELSE '-'  END
								AS hora_ingreso,
								ref.hora_ini AS hora_ini_ref,
								ref.hora_fin AS hora_fin_ref,
								ref.tiempo AS tiempo_ref
				FROM horario_refrigerio_trabajador AS hrt 
				LEFT JOIN horario  AS  hor ON
				hrt.id_horario= hor.id_horario
				LEFT JOIN refrigerio AS ref ON
				ref.cod_ref= hrt.cod_ref 
				LEFT JOIN(
					SELECT  fe.nom_dia, fe.estado ,  fe.fecha
					FROM fechas AS fe  
					WHERE fe.fecha='$fecha'
				) AS fe ON fe.fecha='$fecha'
				WHERE  hrt.id_trab='$id_trab'
				) AS ft  ON ft.id_trab= tr.id_trab
				WHERE ft.id_trab='$id_trab' ; ";
		return ejecutarConsulta($sql);

	}

	public function restadehorasderefrigerio($id_trab, $tiempo, $tiempo_ref)
	{
		$sql="SELECT   TIMEDIFF( '$tiempo', '$tiempo_ref' )  AS tiempo_dscto 
				FROM trabajador tr 
				WHERE tr.id_trab='$id_trab' ; ";
		return ejecutarConsulta($sql);

	}


	public function consultarpermisoenesedia($id_trab, $fecha)
	{
		$sql="SELECT  pp.id_trab, pp.tip_permiso, pp.motivo, pp.id_permiso
				FROM permiso_personal pp 
				WHERE pp.id_trab='$id_trab'
				AND  pp.fecha_procede='$fecha';";
		return ejecutarConsulta($sql);

	}






	//Implementamos un método para insertar registros
	public function registrar_hora_extra($id_trab, $fecha, $hora, $hora_ingreso, $tiempo,  $id_cp, $fec_reg, $pc_reg, $usu_reg)
	{


		$sql="INSERT INTO horas_extras_personal (id_trab,   fecha ,  hora_inicio,  hora_fin,    cantidad,    id_fec_pag, abonar, abonado,  pc_reg,    usu_reg,    fec_reg)
					  					VALUES ('$id_trab', '$fecha', '$hora' , '$hora_ingreso', '$tiempo',   '$id_cp',    '1' ,   '2'   ,  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_hora_permiso($id_trab, $fecha, $hora, $tiempo_ref, $hora_ingreso, $tiempo, $tiempo_dscto,  $id_incidencia, $id_permiso,  $id_cp,  $fec_reg, $pc_reg, $usu_reg )
	{


		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,     hora_inicio,  hora_fin,    cantidad,    tiempo_ref,     tiempo_des,        id_incidencia,   id_permiso,   id_fec_dscto,  descontar,  descontado,  pc_reg,   usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_ingreso' , '$hora' ,  '$tiempo',  '$tiempo_ref',  '$tiempo_dscto',  '$id_incidencia', '$id_permiso',    '$id_cp',  '1', '2',  '$pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}



	//Implementamos un método para insertar registros
	public function registrar_hora_permiso_sinrefrigerio($id_trab, $fecha, $hora, $hora_ingreso, $tiempo, $id_incidencia,  $id_permiso,  $id_cp,  $fec_reg, $pc_reg, $usu_reg)
	{


		$sql="INSERT INTO horas_permiso_personal (id_trab,   fecha ,      hora_inicio,  hora_fin,    cantidad,   tiempo_des,  id_incidencia,   id_permiso,  id_fec_dscto, descontar,  descontado, habilitar_dscto, pc_reg,    usu_reg,    fec_reg)
					  		            VALUES ('$id_trab', '$fecha',  '$hora_ingreso' , '$hora' ,  '$tiempo',    '$tiempo',  '$id_incidencia',  '$id_permiso', '$id_cp',  '1',           '2',          '2',       $pc_reg', '$usu_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);


	}

	







}

?>