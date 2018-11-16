<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Horario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(		  $descrip,
	                              	  $id_turno,
									  $lunes_ingreso, 
									  $lunes_salida,
									  $martes_ingreso,
									  $martes_salida,
									  $miercoles_ingreso,
									  $miercoles_salida,
									  $jueves_ingreso,
									  $jueves_salida,
									  $viernes_ingreso,
									  $viernes_salida,
									  $sabado_ingreso,
									  $sabado_salida,
									  $domingo_ingreso,
									  $domingo_salida,
									  $usu_reg, 
									  $pc_reg, 
									  $fec_reg )
	{
		$sql="INSERT INTO horario (descrip,
								   id_turno,
								   lunes_ingreso,
								   lunes_salida, 
								   martes_ingreso, 
								   martes_salida,
								   miercoles_ingreso, 
								   miercoles_salida,
								   jueves_ingreso, 
								   jueves_salida,
								   viernes_ingreso, 
								   viernes_salida,
								   sabado_ingreso, 
								   sabado_salida,
								   domingo_ingreso, 
								   domingo_salida,
								   usu_reg, 
								   pc_reg, 
								   fec_reg )
						  VALUES ('$descrip',
						  	      '$id_turno',
						  		  '$lunes_ingreso',
						  		  '$lunes_salida',
						  		  '$martes_ingreso',
						  		  '$martes_salida',
						  		  '$miercoles_ingreso',
						  		  '$miercoles_salida',
						  		  '$jueves_ingreso',
						  		  '$jueves_salida',
						  		  '$viernes_ingreso',
						  		  '$viernes_salida',
						  		  '$sabado_ingreso',
						  		  '$sabado_salida',
						  		  '$domingo_ingreso',
						  		  '$domingo_ingreso',
						  		  '$usu_reg', 
						  		  '$pc_reg', 
						  		  '$fec_reg' )";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_horario,
						   $descrip,
						   $id_turno,
						   $lunes_ingreso, 
						   $lunes_salida,
						   $martes_ingreso,
						   $martes_salida,
						   $miercoles_ingreso,
						   $miercoles_salida,
						   $jueves_ingreso,
						   $jueves_salida,
						   $viernes_ingreso,
						   $viernes_salida,
						   $sabado_ingreso,
						   $sabado_salida,
						   $domingo_ingreso,
						   $domingo_salida,
						   $usu_reg, 
						   $pc_reg, 
						   $fec_reg)
	{
		$sql="UPDATE horario SET descrip='$descrip',
								 id_turno='$id_turno',
		                         lunes_ingreso='$lunes_ingreso',
		                         lunes_salida='$lunes_salida', 
		                         martes_ingreso='$martes_ingreso',
		                         martes_salida='$martes_salida', 
		                         miercoles_ingreso='$miercoles_ingreso',
		                         miercoles_salida='$miercoles_salida', 
		                         jueves_ingreso='$jueves_ingreso',
		                         jueves_salida='$jueves_salida', 
		                         viernes_ingreso='$viernes_ingreso',
		                         viernes_salida='$viernes_salida', 
		                         sabado_ingreso='$sabado_ingreso',
		                         sabado_salida='$sabado_salida',
		                         domingo_ingreso='$domingo_ingreso',
		                         domingo_salida='$domingo_salida',
		                         usu_mod='$usu_reg', 
		                         pc_mod='$pc_reg', 
		                         fec_mod='$fec_reg'  
		      WHERE id_horario='$id_horario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_horario)
	{
		$sql="UPDATE horario SET est_reg='0' WHERE id_horario='$id_horario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_horario)
	{
		$sql="UPDATE horario SET est_reg='1' WHERE id_horario='$id_horario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_horario)
	{
		$sql="SELECT hr.id_horario,
					 hr.descrip, 
					 hr.id_turno, 
					 ttur.des_larga AS turno,
					 hr.lunes_ingreso, 
					 hr.lunes_salida,  
					 hr.martes_ingreso, 
					 hr.martes_salida, 
					 hr.miercoles_ingreso, 
					 hr.miercoles_salida ,  
					 hr.jueves_ingreso,
					 hr.jueves_salida,
					 hr.viernes_ingreso,
					 hr.viernes_salida,
					 hr.sabado_ingreso,
					 hr.sabado_salida,
					 hr.domingo_ingreso,
					 hr.domingo_salida
		 FROM horario hr
		LEFT JOIN tabla_maestra_detalle AS ttur ON
		ttur.cod_argumento= hr.id_turno
		AND ttur.cod_tabla='TTUR' 
		WHERE hr.id_horario='$id_horario' ";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql=" SELECT * from horario ";
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