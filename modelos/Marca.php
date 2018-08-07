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
		$sql="SELECT * FROM MARCAS";

		return ejecutarConsulta($sql);
	}

  static public function mdlIngresarMarca($datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO marcas(nombre) VALUES (:nombre)");
    $stmt->bindParam(":nombre",$datos,PDO::PARAM_STR);

    if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

  }



}

?>
