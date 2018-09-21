<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Articulo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT    a.articulo,
                    a.marca,
                    a.modelo,
                    a.nombre,
                    a.color,
                    a.talla,
                    a.peso_art,
                    a.estado
                    FROM articulojf a
                    ORDER BY a.articulo";
		return ejecutarConsulta($sql);
	}


}

?>
