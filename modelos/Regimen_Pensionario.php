<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Regimen_Pensionario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_ano, $obs_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix)
	{
		$sql="INSERT INTO regimen_pensionario (id_ano,
				obs_reg_pen,
			    onp_apo_obl,
			    onp_com_men_rem,
			    onp_com_anu,
			    onp_com_men,
			    onp_pri_seg,
			    onp_apo_act,
			    onp_apo_mix,
			    int_apo_obl,
			    int_com_men_rem,
			    int_com_anu,
			    int_com_men,
			    int_pri_seg,
			    int_apo_act,
			    int_apo_mix,
			    pri_apo_obl,
			    pri_com_men_rem,
			    pri_com_anu,
			    pri_com_men,
			    pri_pri_seg,
			    pri_apo_act,
			    pri_apo_mix,
			    pro_apo_obl,
			    pro_com_men_rem,
			    pro_com_anu,
			    pro_com_men,
			    pro_pri_seg,
			    pro_apo_act,
			    pro_apo_mix,
			    hab_apo_obl,
			    hab_com_men_rem,
			    hab_com_anu,
			    hab_com_men,
			    hab_pri_seg,
			    hab_apo_act,
			    hab_apo_mix,
			    sj_apo_obl,
			    sj_com_men_rem,
			    sj_apo_mix,
			    est_reg_pen)
		VALUES ('$id_ano',
			    '$obs_reg_pen',
			    '$onp_apo_obl',
			    '$onp_com_men_rem',
			    '$onp_com_anu',
			    '$onp_com_men',
		     	'$onp_pri_seg',
		     	'$onp_apo_act',
		     	'$onp_apo_mix',
		     	'$int_apo_obl',
		     	'$int_com_men_rem',
		     	'$int_com_anu',
		     	'$int_com_men',
		     	'$int_pri_seg',
		     	'$int_apo_act',
		     	'$int_apo_mix',
		     	'$pri_apo_obl',
		     	'$pri_com_men_rem',
		     	'$pri_com_anu',
		     	'$pri_com_men',
		     	'$pri_pri_seg',
		     	'$pri_apo_act',
		     	'$pri_apo_mix',
		     	'$pro_apo_obl',
		     	'$pro_com_men_rem',
		     	'$pro_com_anu',
		     	'$pro_com_men',
		     	'$pro_pri_seg',
		     	'$pro_apo_act',
		     	'$pro_apo_mix',
		     	'$hab_apo_obl',
		     	'$hab_com_men_rem',
		     	'$hab_com_anu',
		     	'$hab_com_men',
		     	'$hab_pri_seg',
		     	'$hab_apo_act',
		     	'$hab_apo_mix',
		     	'$sj_apo_obl',
		     	'$sj_com_men_rem',
		     	'$sj_apo_mix',
		     	'1')";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar($id_reg_pen,$id_ano,$obs_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix)
	{
		$sql="UPDATE regimen_pensionario SET  id_ano='$id_ano',
											  obs_reg_pen='$obs_reg_pen',
											  onp_apo_obl='$onp_apo_obl',
											  onp_com_men_rem='$onp_com_men_rem',
											  onp_com_anu='$onp_com_anu',
											  onp_com_men='$onp_com_men',
											  onp_pri_seg='$onp_pri_seg',
											  onp_apo_act='$onp_apo_act',
											  onp_apo_mix='$onp_apo_mix',
											  int_apo_obl='$int_apo_obl',
											  int_com_men_rem='$int_com_men_rem',
											  int_com_anu='$int_com_anu',
											  int_com_men='$int_com_men',
											  int_pri_seg='$int_pri_seg', 
											  int_apo_act='$int_apo_act',
											  int_apo_mix='$int_apo_mix',
											  pri_apo_obl='$pri_apo_obl',
											  pri_com_men_rem='$pri_com_men_rem',
											  pri_com_anu='$pri_com_anu',
											  pri_com_men='$pri_com_men',
											  pri_pri_seg='$pri_pri_seg',
											  pri_apo_act='$pri_apo_act',
											  pri_apo_mix='$pri_apo_mix',
											  pro_apo_obl='$pro_apo_obl',
											  pro_com_men_rem='$pro_com_men_rem',
											  pro_com_anu='$pro_com_anu',
											  pro_com_men='$pro_com_men',
											  pro_pri_seg='$pro_pri_seg',
											  pro_apo_act='$pro_apo_act',
											  pro_apo_mix='$pro_apo_mix',
											  hab_apo_obl='$hab_apo_obl',
											  hab_com_men_rem='$hab_com_men_rem',
											  hab_com_anu='$hab_com_anu',
											  hab_com_men='$hab_com_men',
											  hab_pri_seg='$hab_pri_seg',
											  hab_apo_act='$hab_apo_act',
											  hab_apo_mix='$hab_apo_mix',
											  sj_apo_obl='$sj_apo_obl',
											  sj_com_men_rem='$sj_com_men_rem',
											  sj_apo_mix='$sj_apo_mix'
											  WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_reg_pen)
	{
		$sql="UPDATE regimen_pensionario SET est_reg_pen='0' WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_reg_pen)
	{
		$sql="UPDATE regimen_pensionario SET est_reg_pen='1' WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_reg_pen)
	{
		$sql="SELECT * FROM regimen_pensionario WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from regimen_pensionario";
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

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosCotizacion()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_cotizacion,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

}

?>
