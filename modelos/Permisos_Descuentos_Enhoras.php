<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permisos_Descuentos_Enhoras
{
	//Implementamos nuestro constructor
	public function __construct()
	{

  }

	//Implementamos un método para insertar registros
	public function insertar( $idusuario,
														$fecha_hora,
														$empresa,
														$cod_mod,
														$tallas_mod,
														$temp_mod,
														$div_mod,
														$dest_mod,
														$id_trab,
														$color_mod,
														$tela1_mod,
														$tela2_mod,
														$tela3_mod,
														$bord_mod,
														$esta_mod,
														$manu_mod,
														$imagen,
														$imagen2,
														$colores)
	{
		$sql="INSERT INTO maestro_ficha_tecnica (		idusuario,
																								fecha_hora,
																								estado,
																								empresa,
																								cod_mod,
																								tallas_mod,
																								temp_mod,
																								div_mod,
																								dest_mod,
																								id_trab,
																								color_mod,
																								tela1_mod,
																								tela2_mod,
																								tela3_mod,
																								bord_mod,
																								esta_mod,
																								manu_mod,
																								imagen,
																								imagen2)

																		VALUES(			'$idusuario',
																								'$fecha_hora',
																								'por aprobar',
																								'$empresa',
																								'$cod_mod',
																								'$tallas_mod',
																								'$temp_mod',
																								'$div_mod',
																								'$dest_mod',
																								'$id_trab',
																								'$color_mod',
																								'$tela1_mod',
																								'$tela2_mod',
																								'$tela3_mod',
																								'$bord_mod',
																								'$esta_mod',
																								'$manu_mod',
																								'$imagen',
																								'$imagen2')";
		//return ejecutarConsulta($sql);
		$idmftnew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($colores))
		{
			$sql_detalle = "INSERT INTO fictec_color (idmft, cod_color) VALUES('$idmftnew', '$colores[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}



	//Implementamos un método para editar registros
	public function editar(	$idmft,
													$id_trab,
													$empresa,
													$color_mod,
													$tallas_mod,
													$div_mod,
													$temp_mod,
													$dest_mod,
													$tela1_mod,
													$tela2_mod,
													$tela3_mod,
													$bord_mod,
													$esta_mod,
													$manu_mod,
													$imagen,
													$imagen2,
													$colores)
	{


			 $sql="UPDATE maestro_ficha_tecnica SET id_trab='$id_trab',
			 																				empresa='$empresa',
																							color_mod='$color_mod',
																							tallas_mod='$tallas_mod',
																							div_mod='$div_mod',
																							temp_mod='$temp_mod',
																							dest_mod='$dest_mod',
																							tela1_mod='$tela1_mod',
																							tela2_mod='$tela2_mod',
																							tela3_mod='$tela3_mod',
																							bord_mod='$bord_mod',
																							esta_mod='$esta_mod',
																							manu_mod='$manu_mod',
																							imagen='$imagen',
																							imagen2='$imagen2'
																							WHERE idmft='$idmft'";


		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM fictec_color WHERE idmft='$idmft'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($colores))
		{
			$sql_detalle = "INSERT INTO fictec_color(idmft, cod_color) VALUES('$idmft', '$colores[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	public function listar()
	{
		$sql="SELECT '-' as pd ,
					 id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			ORDER BY  cp.id_cp DESC;";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_cp)
	{
		$sql="SELECT hpp.id_hor_per,
    				 hpp.fecha, 
					 hpp.id_trab, 
					 hpp.tiempo_des, 
					 hpp.situacion,  
					 hpp.id_fec_dscto As id_cp, 
					 CONCAT('Fecha: ',
					 hpp.fecha ,
					 '    /    Trabajador: ',
					 tr.nombres,
					 '    /    Tiempo: ',
					 hpp.tiempo_des,
					 '    /    Incidencia: ',
					 IF(hpp.id_incidencia='1', 'PERMISO', 'TARDANZA'),
					 '    /    Tipo: ',
					 IFNULL(pp.Permiso,''),
					 '    /    Motivo: ',
					 IFNULL(pp.motivo,'')
					 ) AS sit,
					 hpp.id_fec_dscto  
				FROM horas_permiso_personal hpp
				LEFT JOIN (
					Select  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', SUBSTRING_INDEX(tr.nom_trab, ' ', 1)) As nombres
					FROM  trabajador tr
					) As tr ON  tr.id_trab=hpp.id_trab  
				LEFT JOIN (
					SELECT  pp.id_trab, pp.tip_permiso, pp.fecha_procede, TbPer.Des_Larga AS Permiso, pp.motivo
					FROM permiso_personal pp 
					LEFT JOIN tabla_maestra_detalle  Tbper ON 
					TbPer.des_corta= pp.tip_permiso
					) AS pp ON pp.id_trab= hpp.id_trab
				     AND       pp.fecha_procede=hpp.fecha 
				     WHERE hpp.id_fec_dscto='$id_cp'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idmft)
	{
		$sql="SELECT * FROM fictec_color WHERE idmft='$idmft'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para anular la maestro_ficha_tecnica
	public function rechazar($idmft)
	{
		$sql="UPDATE maestro_ficha_tecnica SET estado='rechazado' WHERE idmft='$idmft'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la maestro_ficha_tecnica
	public function aprobar($idmft,$idusuario)
	{
		$sql="UPDATE maestro_ficha_tecnica SET estado='aprobado',editable='0',vb_mft='$idusuario' WHERE idmft='$idmft'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la maestro_ficha_tecnica
	public function eliminar($idmft)
	{
		$sql="DELETE FROM maestro_ficha_tecnica WHERE idmft='$idmft'";
		return ejecutarConsulta($sql);
	}

	public function selectFT(){
		$sql="	SELECT 
					mft.idmft as idmft1,
					mft.cod_mod,
					m.nom_mod,
					CONCAT(
					mft.idmft,
					' - ',
					mft.cod_mod,
					' - ',
					m.nom_mod
					) AS modelo 
				FROM
					maestro_ficha_tecnica mft 
					LEFT JOIN modelojf m 
					ON mft.cod_mod = m.cod_mod";

		return ejecutarConsulta($sql);
	}



	public function faltas_permisos_horas(  ){

    $sql="SELECT     hpp.id_hor_per,
    				 hpp.fecha, 
					 hpp.id_trab, 
					 hpp.tiempo_des, 
					 hpp.situacion,  
					 CONCAT('Fecha: ',
					 hpp.fecha ,
					 '    /    Trabajador: ',
					 tr.nombres,
					 '    /    Tiempo: ',
					 hpp.tiempo_des,
					 '    /    Incidencia: ',
					 IF(hpp.id_incidencia='1', 'PERMISO', 'TARDANZA'),
					 '    /    Tipo: ',
					 IFNULL(pp.Permiso,''),
					 '    /    Motivo: ',
					 IFNULL(pp.motivo,'')
					 ) AS sit,
					 hpp.id_fec_dscto 
				FROM horas_permiso_personal hpp
				LEFT JOIN (
					Select  tr.id_trab,  CONCAT(tr.apepat_trab, ' ' , tr.apemat_trab, ' ', tr.nom_trab ) As nombres
					FROM  trabajador tr
					) As tr ON  tr.id_trab=hpp.id_trab  
				LEFT JOIN (
					SELECT  pp.id_trab, pp.tip_permiso, pp.fecha_procede, TbPer.Des_Larga AS Permiso, pp.motivo
					FROM permiso_personal pp 
					LEFT JOIN tabla_maestra_detalle  Tbper ON 
					TbPer.des_corta= pp.tip_permiso
					) AS pp ON pp.id_trab= hpp.id_trab
				     AND       pp.fecha_procede=hpp.fecha 
				  

	";

    return ejecutarConsulta($sql);
  }




}
?>
