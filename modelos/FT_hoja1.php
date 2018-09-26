<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class FT_hoja1
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
		$sql="SELECT		mft.idmft,
										DATE(mft.fecha_hora) AS fecha,
										m.id_marca,
										ma.nombre AS marca,
										mft.cod_mod,
										m.nom_mod,
										mft.id_trab,
										CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador,
										mft.idusuario,
										UPPER(u.nombre) AS desarrollador,
										(SELECT nombre FROM usuario u WHERE u.idusuario=mft.vb_mft) AS vb,
										mft.estado,
										mft.editable
										FROM maestro_ficha_tecnica mft
										LEFT JOIN modelojf m
										ON mft.cod_mod=m.cod_mod
										LEFT JOIN marcas ma
										ON m.id_marca=ma.id_marca
										LEFT JOIN usuario u
										ON mft.idusuario=u.idusuario
										LEFT JOIN trabajador t
										ON mft.id_trab=t.id_trab";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmft)
	{
		$sql="SELECT 	mft.idmft,
									DATE(mft.fecha_hora) AS fecha,
									m.id_marca,
									ma.nombre AS marca,
									mft.cod_mod,
									m.nom_mod,
									mft.id_trab,
									CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador,
									mft.idusuario,
									UPPER(u.nombre) AS desarrollador,
									mft.total_mft,
									mft.vb_mft,
									(SELECT UPPER(nombre) FROM usuario u WHERE u.idusuario=mft.vb_mft) AS vb,
									mft.estado,
									mft.editable,
									mft.empresa,
									mft.color_mod,
									mft.tallas_mod,
									mft.div_mod,
									mft.temp_mod,
									mft.dest_mod,
									mft.tela1_mod,
									mft.tela2_mod,
									mft.tela3_mod,
									mft.bord_mod,
									mft.esta_mod,
									mft.manu_mod,
									mft.imagen,
									mft.imagen2
									FROM maestro_ficha_tecnica mft
									LEFT JOIN modelojf m
									ON mft.cod_mod=m.cod_mod
									LEFT JOIN marcas ma
									ON m.id_marca=ma.id_marca
									LEFT JOIN usuario u
									ON mft.idusuario=u.idusuario
									LEFT JOIN trabajador t
									ON mft.id_trab=t.id_trab
									WHERE mft.idmft='$idmft'";

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



}
?>
