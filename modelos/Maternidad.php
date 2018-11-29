<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Maternidad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(                       $id_trab,
													$fec_ini_lac,
													$fec_fin,
												    $fec_nac_c1,
												    $lugar_c1,
												    $observa_c1,
												    $data_adjunta_hij1_c1,
												    $data_adjunta_hij2_c1,
												    $data_adjunta_hij3_c1,
												    $fec_nac_c2,
												    $lugar_c2,
												    $observa_c2,
												    $data_adjunta_hij1_c2,
												    $data_adjunta_hij2_c2,
												    $data_adjunta_hij3_c2,
													$fec_nac_c3,
													$lugar_c3,
													$observa_c3,
													$data_adjunta_hij1_c3,
													$data_adjunta_hij2_c3,
													$data_adjunta_hij3_c3,
												    $fec_reg,
												    $usu_reg,
												    $pc_reg)
	{


		

			$sql="INSERT INTO maternidad (          id_trab,
													fec_ini_lac,
													fec_fin,
													fec_nac_c1,
													lugar_c1,
													observa_c1,
													data_adjunta_hij1_c1,
													data_adjunta_hij2_c1,
													data_adjunta_hij3_c1,
													fec_nac_c2,
													lugar_c2,
													observa_c2,
													data_adjunta_hij1_c2,
													data_adjunta_hij2_c2,
												    data_adjunta_hij3_c2,
													fec_nac_c3,
													lugar_c3,
													observa_c3,
													data_adjunta_hij1_c3,
													data_adjunta_hij2_c3,
													data_adjunta_hij3_c3,
													est_reg,
													fec_reg,
													usu_reg,
													pc_reg)
											VALUES ('$id_trab',	
												    '$fec_ini_lac',
													'$fec_fin',
		                                            '$fec_nac_c1',	
												    '$lugar_c1',
													'$observa_c1',
													'$data_adjunta_hij1_c1',
													'$data_adjunta_hij2_c1',
													'$data_adjunta_hij3_c1',
													'$fec_nac_c2',
													'$lugar_c2',
													'$observa_c2',
													'$data_adjunta_hij1_c2',
													'$data_adjunta_hij2_c2',
												    '$data_adjunta_hij3_c2',
													'$fec_nac_c3',
													'$lugar_c3',
													'$observa_c3',
													'$data_adjunta_hij1_c3',
													'$data_adjunta_hij2_c3',
													'$data_adjunta_hij3_c3',
													'1',
													'$fec_reg',
													'$usu_reg',
													'$pc_reg' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(                         $id_maternidad, 	
													$id_trab,
													$fec_ini_lac,
													$fec_fin,
												    $fec_nac_c1,
												    $lugar_c1,
												    $observa_c1,
												    $data_adjunta_hij1_c1,
												    $data_adjunta_hij2_c1,
												    $data_adjunta_hij3_c1,
												    $fec_nac_c2,
												    $lugar_c2,
												    $observa_c2,
												    $data_adjunta_hij1_c2,
												    $data_adjunta_hij2_c2,
												    $data_adjunta_hij3_c2,
													$fec_nac_c3,
													$lugar_c3,
													$observa_c3,
													$data_adjunta_hij1_c3,
													$data_adjunta_hij2_c3,
													$data_adjunta_hij3_c3,
												    $fec_reg,
												    $usu_reg,
												    $pc_reg)
	{
		$sql="UPDATE maternidad SET            id_trab='$id_trab',
											   fec_ini_lac='$fec_ini_lac',
											   fec_fin='$fec_fin',
											   fec_nac_c1='$fec_nac_c1',
											   lugar_c1='$lugar_c1',
											   observa_c1='$observa_c1',
											   data_adjunta_hij1_c1='$data_adjunta_hij1_c1',
											   data_adjunta_hij2_c1='$data_adjunta_hij2_c1',
											   data_adjunta_hij3_c1='$data_adjunta_hij3_c1',
											   fec_nac_c2='$fec_nac_c2',
											   lugar_c2='$lugar_c2',
											   observa_c2='$observa_c2',
											   data_adjunta_hij1_c2='$data_adjunta_hij1_c2',
											   data_adjunta_hij2_c2='$data_adjunta_hij2_c2',
											   data_adjunta_hij3_c2='$data_adjunta_hij3_c2',
											   fec_nac_c3='$fec_nac_c3',
											   lugar_c3='$lugar_c3',
											   observa_c3='$observa_c3',
											   data_adjunta_hij1_c3='$data_adjunta_hij1_c3',
											   data_adjunta_hij2_c3='$data_adjunta_hij2_c3',
											   data_adjunta_hij3_c3='$data_adjunta_hij3_c3',
											   fec_mod='$fec_reg',
											   usu_mod='$usu_reg',
											   pc_mod='$pc_reg'
										 WHERE id_maternidad='$id_maternidad'";
		return ejecutarConsulta($sql);
	}

	
	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_trab)
	{
		$sql="SELECT DISTINCT ma.id_trab AS id_trab ,
					DATE(ma.fec_ini_lac) AS fec_ini_lac,
					DATE(ma.fec_fin) AS fec_fin,
					tr.num_doc_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					ma.id_maternidad,
					DATE(ma.fec_nac_c1) AS  fec_nac_c1, ma.lugar_c1, ma.observa_c1, ma.data_adjunta_hij1_c1, ma.data_adjunta_hij2_c1,  ma.data_adjunta_hij3_c1,
					CASE 
					WHEN  DATE(DATE_ADD(fec_nac_c1, INTERVAL 1 YEAR)) >= CURDATE() THEN 'ACTIVO'
					ELSE 'INACTIVO' END
					AS estado_hij1,
					DATE(ma.fec_nac_c2) AS  fec_nac_c2,  ma.lugar_c2, ma.observa_c2, ma.data_adjunta_hij1_c2, ma.data_adjunta_hij2_c2, ma.data_adjunta_hij3_c2,
					CASE 
					WHEN  DATE(DATE_ADD(fec_nac_c2, INTERVAL 1 YEAR)) >= CURDATE() THEN 'ACTIVO'
					ELSE 'INACTIVO' END
					AS estado_hij2,
					DATE(ma.fec_nac_c3) AS  fec_nac_c3,  ma.lugar_c3, ma.observa_c3, ma.data_adjunta_hij1_c3, ma.data_adjunta_hij2_c3, ma.data_adjunta_hij3_c3,
					CASE 
					WHEN  DATE(DATE_ADD(fec_nac_c3, INTERVAL 1 YEAR)) >= CURDATE() THEN 'ACTIVO'
					ELSE 'INACTIVO' END
					AS estado_hij3
				FROM maternidad ma 
				LEFT JOIN trabajador tr ON
				ma.id_trab= tr.id_trab
				WHERE ma.id_trab='$id_trab'
		";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT DISTINCT ma.id_trab, ma.id_trab  AS id ,tr.num_doc_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tpla.des_larga AS tipo_planilla,
				tsua.des_larga AS sucursal_anexo, tfun.des_larga AS funcion, tare.des_larga AS area_trab, tr.est_reg, tr.num_doc_trab,  tr.num_doc_trab AS nro_doc
				FROM maternidad ma 
				LEFT JOIN trabajador tr ON
				ma.id_trab= tr.id_trab
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
				WHERE tr.id_tip_plan='1'
				And tr.id_genero='1'
				order by apepat_trab ASC";
		return ejecutarConsulta($sql);
	}


	
		//Implementar un método para listar las colaboradoras que esten en planilla
	public function selectColaboradorasPlanilla()
	{
		$sql="SELECT DISTINCT tr.id_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres
				FROM trabajador tr
				WHERE tr.id_tip_plan='1'
				And tr.id_genero='1'
				order by apepat_trab ASC";
		return ejecutarConsulta($sql);
	}














}

?>
