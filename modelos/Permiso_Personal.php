<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso_Personal
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_permiso,$id_trab,$fecha_emision,$fecha_procede, $fecha_hasta, $tip_permiso,$hora_ing, $hora_sal, $motivo, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="INSERT INTO permiso_personal (id_permiso, id_trab, fecha_emision,fecha_procede, fecha_hasta, tip_permiso, hora_ing, hora_sal,  motivo, est_reg, fec_reg, pc_reg, usu_reg )
		VALUES ('$id_permiso','$id_trab','$fecha_emision','$fecha_procede', '$fecha_hasta', '$tip_permiso','$hora_ing', '$hora_sal',  '$motivo', '1',  '$fec_reg', '$pc_reg', '$usu_reg' )";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_permiso,$id_trab,$fecha_emision,$fecha_procede, $fecha_hasta,$tip_permiso,$hora_ing, $hora_sal, $motivo, $fec_reg, $pc_reg, $usu_reg)
	{
		$sql="UPDATE permiso_personal SET id_trab='$id_trab',fecha_procede='$fecha_procede', fecha_hasta='$fecha_hasta', tip_permiso='$tip_permiso', hora_ing='$hora_ing',hora_sal='$hora_sal', motivo='$motivo', fec_mod='$fec_reg', pc_mod='$pc_reg', usu_mod='$usu_reg' WHERE id_permiso='$id_permiso'";
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



	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_permiso)
	{
		$sql="SELECT DATE_FORMAT(fecha_emision, '%d/%m/%Y') AS fecha_emision,   DATE_FORMAT(fecha_procede, '%d/%m/%Y') AS fecha_procede,   DATE_FORMAT(fecha_hasta, '%d/%m/%Y') AS fecha_hasta, tip_permiso, id_trab, id_permiso, hora_ing, hora_sal, motivo, est_reg  FROM permiso_personal WHERE id_permiso='$id_permiso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,   DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta, DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede, tr.ape_trab, tbm.des_larga AS tipo_permiso  , pp.tip_permiso, pp.id_trab, pp.id_permiso, pp.hora_ing, pp.hora_sal, pp.motivo, pp.est_reg, pp.est_apro 
		 FROM permiso_personal pp
		 LEFT JOIN Trabajador tr ON
		 tr.id_trab= pp.id_trab
		 LEFT JOIN tabla_maestra_detalle  tbm ON
		 tbm.des_corta= pp.tip_permiso
		 AND tbm.cod_tabla='TPER'
		 ";
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
}

?>