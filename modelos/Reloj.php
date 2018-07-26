<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";




Class Reloj
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno )
	{


		$sql="INSERT INTO reloj (id_trab, fecha , hor_ent,  pc_reg, usu_reg, fec_reg, tip_pla, tip_mov, est_hor, turno )
		VALUES ('$id_trab', '$fecha', '$hora' , '$pc_reg', '$usu_reg', '$fec_reg', '$id_tip_plan' ,  '$dia' , '$est_hor', '$id_turno' )";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora)
	{
		$sql="UPDATE reloj SET hor_sal='$hora'  WHERE id_trab='$id_trab'  and fecha='$fecha'    ";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
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



	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultar($id_trab, $fecha)
	{
		$sql="SELECT id_trab, tip_pla FROM reloj WHERE id_trab='$id_trab'  and fecha='$fecha' ";
		return ejecutarConsulta($sql);

	}





	//Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function consultarDataPersonal($id_trab)
	{
		$sql="SELECT  id_tip_plan, id_turno FROM trabajador WHERE id_trab='$id_trab'  ";
		return ejecutarConsulta($sql);

	}



}

?>