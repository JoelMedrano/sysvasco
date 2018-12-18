<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ConsultasJ
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Seleccionar desde la lista de trabajadores
	public function select()
	{
		$sql="SELECT	id_trab,
						CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab,' ',t.num_doc_trab,' - ',tf.des_larga,' - ',ta.des_larga) AS trabajador
						FROM trabajador t
						LEFT JOIN
						(SELECT
						cod_argumento,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tare') AS ta
						ON t.id_area=ta.cod_argumento
						LEFT JOIN
						(SELECT
						cod_argumento,
						cod_tabla,
						des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tfun') AS tf
						ON t.id_funcion=tf.cod_argumento
						ORDER BY apepat_trab";

		return ejecutarConsulta($sql);
	}

	//Seleccionar desde la lista de cargo
	public function selectCargo()
	{
		$sql="SELECT	cod_argumento as 'cargo',
									cod_tabla,
									des_larga
						FROM tabla_maestra_detalle tmd
						WHERE cod_tabla='tfun'";

		return ejecutarConsulta($sql);
	}

	//Seleccionar desde la lista de areas
	public function selectArea()
	{
		$sql="SELECT	cod_argumento as 'area1',
									cod_tabla,
									des_larga
									FROM tabla_maestra_detalle tmd
									WHERE cod_tabla='tare'";

		return ejecutarConsulta($sql);
	}

	public function selectDiseñador()
	{
		$sql="SELECT 
		t.id_trab,
		CONCAT(
		  t.apepat_trab,
		  ' ',
		  t.apemat_trab,
		  ' ',
		  t.nom_trab
		) AS diseñador 
	  FROM
		trabajador t 
	  WHERE id_area IN ('6', '7') 
		AND t.est_reg = '1'";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER 1ERA TELA PRINCIPAL

	public function selectTela1()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela1_mod,
										CONCAT(SUBSTRING(pro.codfab,1,6),' - ',tmd.des_larga) AS tela,
										tmd.des_corta AS cod_linea,
										lin.linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
										LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										tmd.des_larga AS linea,
										tmd.des_corta AS cod_linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON LEFT(pro.codfab,3)=tmd.des_corta
										WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
										ON SUBSTRING(pro.codfab,1,6)=lin.cod_sublinea
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%' OR  linea LIKE '%BLONDA%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER 2da TELA PRINCIPAL

	public function selectTela2()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela2_mod,
										CONCAT(SUBSTRING(pro.codfab,1,6),' - ',tmd.des_larga) AS tela,
										tmd.des_corta AS cod_linea,
										lin.linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
										LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										tmd.des_larga AS linea,
										tmd.des_corta AS cod_linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON LEFT(pro.codfab,3)=tmd.des_corta
										WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
										ON SUBSTRING(pro.codfab,1,6)=lin.cod_sublinea
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%' OR  linea LIKE '%BLONDA%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER tela Complemento

	public function selectTela3()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela3_mod,
										CONCAT(SUBSTRING(pro.codfab,1,6),' - ',tmd.des_larga) AS tela,
										tmd.des_corta AS cod_linea,
										lin.linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
										LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										tmd.des_larga AS linea,
										tmd.des_corta AS cod_linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON LEFT(pro.codfab,3)=tmd.des_corta
										WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
										ON SUBSTRING(pro.codfab,1,6)=lin.cod_sublinea
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%' OR  linea LIKE '%BLONDA%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	public function selectMP()
	{
		$sql="SELECT 	SUBSTRING(pro.codfab, 1, 6) AS idarticulo,
						CONCAT(SUBSTRING(pro.codfab, 1, 6),' - ',tmd.des_larga) AS nombre,
						tmd.des_corta AS cod_linea,
						lin.linea,
						und.unidad,
						pre.precio,
						CONCAT(
						SUBSTRING(pro.codfab, 1, 6),
						' / ',
						tmd.des_corta,
						' / ',
						lin.linea,
						' / ',
						tmd.des_larga,
						' / ',
						und.unidad,
						' / ',
						IFNULL(pre.precio, 0)
						) AS mp 
					FROM
						producto pro 
						LEFT JOIN tabla_m_detalle AS tmd 
						ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
						LEFT JOIN 
						(SELECT 
							SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
							tmd.des_larga AS linea,
							tmd.des_corta AS cod_linea 
						FROM
							producto pro 
							LEFT JOIN tabla_m_detalle AS tmd 
							ON LEFT(pro.codfab, 3) = tmd.des_corta 
						WHERE pro.estpro = '1' 
							AND tmd.cod_tabla = 'tlin' 
						GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
						ON SUBSTRING(pro.codfab, 1, 6) = cod_sublinea 
						LEFT JOIN 
						(SELECT 
							SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
							tmd.des_corta AS unidad 
						FROM
							producto pro 
							LEFT JOIN tabla_m_detalle AS tmd 
							ON pro.undpro = tmd.cod_argumento 
						WHERE pro.estpro = '1' 
							AND tmd.cod_tabla = 'tund' 
						GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS und 
						ON SUBSTRING(pro.codfab, 1, 6) = und.cod_sublinea 
						LEFT JOIN 
						(SELECT 
							SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
							MAX(
							GREATEST(
								CASE
								WHEN pmp.monprov1 = 'DOLARES AMERICANOS' 
								THEN pmp.preprov1 * 3.3 
								ELSE pmp.preprov1 
								END,
								CASE
								WHEN pmp.monprov2 = 'DOLARES AMERICANOS' 
								THEN pmp.preprov2 * 3.3 
								ELSE pmp.preprov2 
								END,
								CASE
								WHEN pmp.monprov3 = 'DOLARES AMERICANOS' 
								THEN pmp.preprov3 * 3.3 
								ELSE pmp.preprov3 
								END
							)
							) AS precio 
						FROM
							preciomp pmp 
							LEFT JOIN producto pro 
							ON pmp.codpro = pro.codpro 
						WHERE pro.estpro = '1' 
						GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS pre 
						ON SUBSTRING(pro.codfab, 1, 6) = pre.cod_sublinea 
					WHERE pro.estpro = '1' 
						AND tmd.cod_tabla = 'tsub' 
						AND tmd.des_corta = lin.cod_linea 
					GROUP BY SUBSTRING(pro.CodFab, 1, 6)";

				return	ejecutarConsulta($sql);
	}

	public function precioMP($idarticulo)
	{
		$sql="SELECT	SUBSTRING(pro.codfab,1,6) AS idarticulo,
									MAX(GREATEST(
									CASE
									WHEN pmp.monprov1='DOLARES AMERICANOS' THEN pmp.preprov1*3.3
									ELSE pmp.preprov1 END,
									CASE
									WHEN pmp.monprov2='DOLARES AMERICANOS' THEN pmp.preprov2*3.3
									ELSE pmp.preprov2 END,
									CASE
									WHEN pmp.monprov3='DOLARES AMERICANOS' THEN pmp.preprov3*3.3
									ELSE pmp.preprov3 END)) AS precio_cotizacion
									FROM preciomp pmp
									LEFT JOIN producto pro
									ON pmp.codpro=pro.codpro
									WHERE pro.estpro='1' AND SUBSTRING(pro.codfab,1,6) = '$idarticulo'
									GROUP BY SUBSTRING(pro.CodFab,1,6)";

									return ejecutarConsulta($sql);

	}


	public function prodMes(){

		$sql="SELECT	FORMAT(SUM(m.cantidad),0) AS prod
									FROM movimientosjf m
									WHERE MONTH(m.fecha)=MONTH(NOW()) AND m.tipo='E20'
									GROUP BY m.tipo";

		return ejecutarConsulta($sql);
	}

	public function ventMes(){

		$sql="SELECT		FORMAT(SUM(CASE WHEN m.tipo='e05' OR m.tipo='e21' THEN m.cantidad*-1 ELSE m.cantidad END),0) AS vent
										FROM movimientosjf m
										WHERE MONTH(m.fecha)=MONTH(NOW()) AND m.tipo IN ('E05','E21','S02','S03','S70')";

		return ejecutarConsulta($sql);
	}

	public function versus(){

		$sql="SELECT		m.codigo,
										m.descripcion as fecha,
										IFNULL(p.prod,0) AS prod,
										IFNULL(v.vent,0) AS vent
										FROM meses m
										LEFT JOIN
											(SELECT
											MONTH(fecha) AS mes,
											SUM(cantidad) AS prod
											FROM movimientosjf
											WHERE tipo IN ('e20')
											GROUP BY MONTH(fecha)) AS p
										ON m.codigo=p.mes
										LEFT JOIN
											(SELECT
											MONTH(fecha) AS mes,
											SUM(CASE WHEN tipo='e05' OR tipo='e21' THEN cantidad*-1 ELSE cantidad END) AS vent
											FROM movimientosjf
											WHERE tipo IN ('E05','E21','S02','S03','S70')
											GROUP BY MONTH(fecha)) AS v
										ON m.codigo=v.mes";

    return ejecutarConsulta($sql);
	}

	public function color(){

		$sql="SELECT	RIGHT(cod_argumento,2) AS cod_color,
									CONCAT((RIGHT(cod_argumento,2)),' - ',des_larga) AS color
									FROM tabla_m_detalle
									WHERE cod_tabla='tcol' AND cod_argumento < 100
									ORDER BY cod_argumento";

		return ejecutarConsulta($sql);
	}
	
	public function listarTardanzas()
	{
		$sql="SELECT  tr.id_trab,
					 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					 tpla.des_larga AS tipo_planilla,
					 tsua.des_larga AS sucursal_anexo,
					 tfun.des_larga AS funcion,
					 tare.des_larga AS area_trab,
					  'TARDANZA' AS incidencia,
					  re.hor_ent	
					FROM trabajador  tr
					LEFT JOIN reloj  re 
					ON re.id_trab= tr.id_trab 
					AND re.fecha= CURDATE()
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
					LEFT JOIN (
						SELECT  hrt.id_trab, CASE 
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
								ref.tiempo AS tiempo_ref,
								fe.estado
						FROM horario_refrigerio_trabajador AS hrt 
							LEFT JOIN horario  AS  hor ON
							hrt.id_horario= hor.id_horario
							LEFT JOIN refrigerio AS ref ON
							ref.cod_ref= hrt.cod_ref 
							LEFT JOIN(
								SELECT  fe.nom_dia, fe.estado ,  fe.fecha
								FROM fechas AS fe  
								WHERE fe.fecha=CURDATE()
							) AS fe ON fe.fecha=CURDATE()
					) AS ft  ON ft.id_trab= tr.id_trab
					WHERE   tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1')  
					AND re.hor_ent >ft.hora_ingreso
					AND ft.hora_ingreso!='00:00:00'
					AND  re.fecha= CURDATE() /*OK TARDANZA*/
					UNION ALL 
					SELECT  tr.id_trab,
					 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					 tpla.des_larga AS tipo_planilla,
					 tsua.des_larga AS sucursal_anexo,
					 tfun.des_larga AS funcion,
					 tare.des_larga AS area_trab,
					  'FALTA' AS incidencia	,
					  '' AS hor_ent
					FROM trabajador  tr
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
					LEFT JOIN (
						SELECT  hrt.id_trab, CASE 
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
								ref.tiempo AS tiempo_ref,
								fe.estado
						FROM horario_refrigerio_trabajador AS hrt 
							LEFT JOIN horario  AS  hor ON
							hrt.id_horario= hor.id_horario
							LEFT JOIN refrigerio AS ref ON
							ref.cod_ref= hrt.cod_ref 
							LEFT JOIN(
								SELECT  fe.nom_dia, fe.estado ,  fe.fecha
								FROM fechas AS fe  
								WHERE fe.fecha=CURDATE()
							) AS fe ON fe.fecha=CURDATE()
					) AS ft  ON ft.id_trab= tr.id_trab
					WHERE 
					 tr.id_trab NOT IN  ( SELECT  re.id_trab  FROM reloj  re  WHERE fecha= CURDATE() ) 
					AND tr.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
					AND tr.id_trab NOT IN  ( SELECT  pp.id_trab  FROM  permiso_personal pp WHERE CURDATE() BETWEEN  pp.fecha_procede  AND pp.fecha_hasta)
					AND tr.est_reg='1'  /*OK FALTA*/
					AND  DATE_FORMAT(NOW( ), '%H:%i:%S' )>ft.hora_ingreso /*OK FALTA*/
					AND ft.hora_ingreso!='00:00:00'
					UNION ALL 
					SELECT    tr.id_trab,
					    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					    tpla.des_larga AS tipo_planilla,
					    tsua.des_larga AS sucursal_anexo,
					    tfun.des_larga AS funcion,
					    tare.des_larga AS area_trab,
					     tbm.des_larga AS incidencia,
					     '' AS hor_ent  
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
					 WHERE CURDATE() BETWEEN  pp.fecha_procede  AND pp.fecha_hasta /*OK PERMISO O LICENCIA*/
					 AND tr.est_reg='1'  ";

		return ejecutarConsulta($sql);
	}

	public function selectTrab(){

		$sql="SELECT 
  t.id_trab,
  CONCAT(
    id_trab,
    ' - ',
  
    apepat_trab,
    ' ',
    apemat_trab,
    ', ',
    nom_trab
  ) AS trabajador 
FROM
  trabajador t
  ORDER BY apepat_trab";
		
		return ejecutarConsulta($sql);
	}
}

?>
