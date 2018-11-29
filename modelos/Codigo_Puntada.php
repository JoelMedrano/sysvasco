<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Codigo_Puntada
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idtipo_maquina,$nombre,$descripcion)
	{
		$sql="INSERT INTO codigo_puntada (idtipo_maquina,nombre,descripcion,condicion)
		VALUES ('$idtipo_maquina','$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($idcodigo_puntada,$idtipo_maquina,$nombre,$descripcion)
	{
		$sql="UPDATE codigo_puntada SET idtipo_maquina='$idtipo_maquina',nombre='$nombre',descripcion='$descripcion' WHERE idcodigo_puntada='$idcodigo_puntada'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idcodigo_puntada)
	{
		$sql="UPDATE codigo_puntada SET condicion='0' WHERE idcodigo_puntada='$idcodigo_puntada'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idcodigo_puntada)
	{
		$sql="UPDATE codigo_puntada SET condicion='1' WHERE idcodigo_puntada='$idcodigo_puntada'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcodigo_puntada)
	{
		$sql="SELECT * FROM codigo_puntada WHERE idcodigo_puntada='$idcodigo_puntada'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT 
        cp.idcodigo_puntada,
        cp.idtipo_maquina,
        tm.nombre AS maquina,
        cp.nombre AS puntada,
        cp.condicion 
      FROM
        codigo_puntada cp 
        LEFT JOIN tipo_maquina tm 
          ON cp.idtipo_maquina = tm.idtipo_maquina ";
          
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idcodigo_puntada,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM codigo_puntada a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idcodigo_puntada,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idcodigo_puntada=a.idcodigo_puntada order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosCotizacion()
	{
		$sql="SELECT a.idcodigo_puntada,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idcodigo_puntada=a.idcodigo_puntada order by iddetalle_ingreso desc limit 0,1) as precio_cotizacion,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

}

?>
