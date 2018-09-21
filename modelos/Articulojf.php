<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Articulojf
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para editar registros
	public function editar($articulo,$peso_art)
	{
		$sql="UPDATE articulojf SET peso_art='$peso_art' WHERE articulo='$articulo'";
		return ejecutarConsulta($sql);
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

	public function mostrar($articulo){

		$sql="SELECT 	a.articulo,
									CONCAT(a.modelo,' - ',a.nombre,' - ',a.color,' - ',a.talla) AS descripcion,
									a.peso_art
		 							FROM articulojf a
									where a.articulo='$articulo'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function activar($articulo){

		$sql="UPDATE articulojf a SET a.estado='ACTIVO' WHERE a.articulo='$articulo'";

		return ejecutarConsulta($sql);

	}

	public function desactivar($articulo){

		$sql="UPDATE articulojf a SET a.estado='DESCONTINUADO' WHERE a.articulo='$articulo'";

		return ejecutarConsulta($sql);

	}


}

?>
