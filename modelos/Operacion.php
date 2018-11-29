<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Operacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO operacion (nombre,descripcion,condicion)
		VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_operacion,$nombre,$descripcion)
	{
		$sql="UPDATE operacion SET nombre='$nombre',descripcion='$descripcion' WHERE id_operacion='$id_operacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_operacion)
	{
		$sql="UPDATE operacion SET condicion='0' WHERE id_operacion='$id_operacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_operacion)
	{
		$sql="UPDATE operacion SET condicion='1' WHERE id_operacion='$id_operacion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_operacion)
	{
		$sql="SELECT * FROM operacion WHERE id_operacion='$id_operacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM operacion";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM operacion where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>