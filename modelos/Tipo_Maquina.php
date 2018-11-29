<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tipo_Maquina
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO tipo_maquina (nombre,descripcion,condicion)
		VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idtipo_maquina,$nombre,$descripcion)
	{
		$sql="UPDATE tipo_maquina SET nombre='$nombre',descripcion='$descripcion' WHERE idtipo_maquina='$idtipo_maquina'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idtipo_maquina)
	{
		$sql="UPDATE tipo_maquina SET condicion='0' WHERE idtipo_maquina='$idtipo_maquina'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idtipo_maquina)
	{
		$sql="UPDATE tipo_maquina SET condicion='1' WHERE idtipo_maquina='$idtipo_maquina'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idtipo_maquina)
	{
		$sql="SELECT * FROM tipo_maquina WHERE idtipo_maquina='$idtipo_maquina'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_maquina";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM tipo_maquina where condicion=1";
		return ejecutarConsulta($sql);		
	}
}

?>