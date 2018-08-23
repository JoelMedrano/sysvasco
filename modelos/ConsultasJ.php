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
		$sql="SELECT	t.id_trab,
									CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador
									FROM trabajador t
									WHERE id_area IN ('6','7')";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER 1ERA TELA PRINCIPAL

	public function selectTela1()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela1_mod,
										tmd.des_larga AS tela,
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
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER 2da TELA PRINCIPAL

	public function selectTela2()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela2_mod,
										tmd.des_larga AS tela,
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
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	//SELECT PARA ESCOGER tela Complemento

	public function selectTela3()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS tela3_mod,
										tmd.des_larga AS tela,
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
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea AND linea LIKE '%tela%'
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

		return ejecutarConsulta($sql);
	}

	public function selectMP()
	{
		$sql="SELECT		SUBSTRING(pro.codfab,1,6) AS codigo,
										tmd.des_larga AS nombre,
										tmd.des_corta AS cod_linea,
										lin.linea,
										und.unidad,
										pre.precio
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
										ON SUBSTRING(pro.codfab,1,6)=cod_sublinea
										LEFT JOIN
											(SELECT
											SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
											tmd.des_corta AS unidad
											FROM producto pro
											LEFT JOIN tabla_m_detalle AS tmd
											ON pro.undpro=tmd.cod_argumento
											WHERE pro.estpro='1' AND tmd.cod_tabla='tund'
											GROUP BY SUBSTRING(pro.CodFab,1,6)) AS und
										ON SUBSTRING(pro.codfab,1,6)=und.cod_sublinea
										LEFT JOIN
											(SELECT
											SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
											MAX(GREATEST(
											CASE
											WHEN pmp.monprov1='DOLARES AMERICANOS' THEN pmp.preprov1*3.3
											ELSE pmp.preprov1 END,
											CASE
											WHEN pmp.monprov2='DOLARES AMERICANOS' THEN pmp.preprov2*3.3
											ELSE pmp.preprov2 END,
											CASE
											WHEN pmp.monprov3='DOLARES AMERICANOS' THEN pmp.preprov3*3.3
											ELSE pmp.preprov3 END)) AS precio
											FROM preciomp pmp
											LEFT JOIN producto pro
											ON pmp.codpro=pro.codpro
											WHERE pro.estpro='1'
											GROUP BY SUBSTRING(pro.CodFab,1,6)) AS pre
										ON SUBSTRING(pro.codfab,1,6)=pre.cod_sublinea
										WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea
										GROUP BY SUBSTRING(pro.CodFab,1,6)";

				return	ejecutarConsulta($sql);
	}

}

?>
