<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_trab,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$area1,$login,$clave,$imagen,$permisos)
	{
		$sql="INSERT INTO usuario (id_trab,nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,area1,login,clave,imagen,condicion)
		VALUES ('$id_trab',UPPER('$nombre'),'$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$area1','$login','$clave','$imagen','1')";
		//return ejecutarConsulta($sql);
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$id_trab,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$area1,$login,$clave,$imagen,$permisos)
	{

		if (strlen($clave)>0)
       $sql="UPDATE usuario SET id_trab='$id_trab',nombre='$nombre',num_documento='$num_documento',email='$email',cargo='$cargo',area1=$area1,login='$login',clave='$clave',imagen='$imagen' WHERE idusuario='$idusuario'";
		else //Ya no se actualiza el campo clave.
       $sql="UPDATE usuario SET id_trab='$id_trab',nombre='$nombre',num_documento='$num_documento',email='$email',cargo='$cargo',area1=$area1,login='$login',imagen='$imagen' WHERE idusuario='$idusuario'";

		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT	idusuario,
									id_trab,
									UPPER(nombre) AS nombre,
									tipo_documento,
									num_documento,
									direccion,
									telefono,
									email,
									cargo,
									area1,
									login,
									clave,
									imagen,
									condicion
									FROM Usuario";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,cargo,imagen,login FROM usuario WHERE login='$login' AND clave='$clave' AND condicion='1'";
    	return ejecutarConsulta($sql);
    }
}

?>
