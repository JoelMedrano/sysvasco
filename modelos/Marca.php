
<?php
//Incluímos inicialmente la conexión a la base de datos

require "../config/Conexion.php";
require_once "conexion.php";


Class ModeloMarcas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

  //Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM marcas";

		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM marcas";
		return ejecutarConsulta($sql);
	}

		
}

?>
