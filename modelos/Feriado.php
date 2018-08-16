<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Feriado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($hora_ini,$hora_fin,$descrip, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="INSERT INTO refrigerio (hora_ini,hora_fin,descrip, usu_reg, pc_reg, fec_reg )
		VALUES ('$hora_ini','$hora_fin','$descrip', '$usu_reg', '$pc_reg', '$fec_reg' )";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($cod_ref,$hora_ini,$hora_fin,$descrip, $usu_reg, $pc_reg, $fec_reg )
	{
		$sql="UPDATE refrigerio SET hora_ini='$hora_ini',hora_fin='$hora_fin',descrip='$descrip', usu_mod='$usu_reg', pc_mod='$pc_reg', fec_mod='$fec_reg'  WHERE cod_ref='$cod_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($cod_ref)
	{
		$sql="UPDATE refrigerio SET est_ref='0' WHERE cod_ref='$cod_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($cod_ref)
	{
		$sql="UPDATE refrigerio SET est_ref='1' WHERE cod_ref='$cod_ref'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($cod_ref)
	{
		$sql="SELECT * FROM refrigerio WHERE cod_ref='$cod_ref' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tabla_maestra_cabecera  WHERE cod_tabla LIKE 'FE%' ";
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