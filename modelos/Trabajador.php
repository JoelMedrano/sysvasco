<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Trabajador
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
		VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo',nombre='$nombre',stock='$stock',descripcion='$descripcion',imagen='$imagen' WHERE idarticulo='$idarticulo'";
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
	public function mostrar($id_trab)
	{
		$sql="SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg,
		tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
		tr.id_sucursal, tsua.des_larga AS sucursal_anexo,
		tr.id_funcion ,  tfun.des_larga AS funcion,
		tr.id_area, tare.des_larga AS area_trab, 
		tr.id_genero, tgen.des_larga AS genero,
		tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
		tr.id_cen_cost, tcco.des_larga AS centro_costos,
        tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
		tr.id_categoria, tcal.des_larga AS categoria_laboral,
		tr.id_form_pag, tfop.des_larga AS forma_pago,
		tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
		tr.id_est_civil, teci.des_larga AS estado_civil,
		tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
		tr.id_com_act, ttca.des_larga AS comision_actual,
		tr.id_t_registro, ttre.des_larga AS t_registro,
		tr.num_doc_trab
				FROM trabajador tr
				LEFT JOIN tabla_maestra_detalle AS tpla ON
				tpla.cod_argumento= tr.id_tip_plan
				AND tpla.cod_tabla='TPLA'
				LEFT JOIN tabla_maestra_detalle AS tsua ON
				tsua.cod_argumento= tr.id_sucursal
				AND tsua.cod_tabla='TSUA'
				LEFT JOIN tabla_maestra_detalle AS tfun ON
				tfun.cod_argumento= tr.id_funcion
				AND tfun.cod_tabla='TFUN'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tr.id_area
				AND tare.cod_tabla='TARE'
                LEFT JOIN tabla_maestra_detalle AS tgen ON
				tgen.cod_argumento= tr.id_genero
				AND tgen.cod_tabla='TGEN' 
				LEFT JOIN tabla_maestra_detalle AS tdoc ON
				tdoc.cod_argumento= tr.id_tip_doc
				AND tdoc.cod_tabla='TDOC' 
				LEFT JOIN tabla_maestra_detalle AS tcco ON
				tcco.cod_argumento= tr.id_cen_cost
				AND tcco.cod_tabla='TCCO' 
				LEFT JOIN tabla_maestra_detalle AS ttmo ON
				ttmo.cod_argumento= tr.id_tip_man_ob
				AND ttmo.cod_tabla='TTMO' 
				LEFT JOIN tabla_maestra_detalle AS tcal ON
				tcal.cod_argumento= tr.id_categoria
				AND tcal.cod_tabla='TCAL' 
			    LEFT JOIN tabla_maestra_detalle AS tfop ON
				tfop.cod_argumento= tr.id_form_pag
				AND tfop.cod_tabla='TFOP' 
				LEFT JOIN tabla_maestra_detalle AS tcon ON
				tcon.cod_argumento= tr.id_tip_cont
				AND tcon.cod_tabla='TCON' 
				LEFT JOIN tabla_maestra_detalle AS teci ON
				teci.cod_argumento= tr.id_est_civil
				AND teci.cod_tabla='TECI' 
				LEFT JOIN tabla_maestra_detalle AS trep ON
				trep.cod_argumento= tr.id_reg_pen
				AND trep.cod_tabla='TREP' 
				LEFT JOIN tabla_maestra_detalle AS ttca ON
				ttca.cod_argumento= tr.id_com_act
				AND ttca.cod_tabla='TTCA' 
				LEFT JOIN tabla_maestra_detalle AS ttre ON
				ttre.cod_argumento= tr.id_t_registro
				AND ttre.cod_tabla='TTRE' 
			 WHERE tr.id_trab='$id_trab'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tpla.des_larga AS tipo_planilla,
				tsua.des_larga AS sucursal_anexo, tfun.des_larga AS funcion, tare.des_larga AS area_trab, tr.est_reg, tr.num_doc_trab
				FROM trabajador tr
				LEFT JOIN tabla_maestra_detalle AS tpla ON
				tpla.cod_argumento= tr.id_tip_plan
				AND tpla.cod_tabla='TPLA'
				LEFT JOIN tabla_maestra_detalle AS tsua ON
				tsua.cod_argumento= tr.id_sucursal
				AND tsua.cod_tabla='TSUA'
				LEFT JOIN tabla_maestra_detalle AS tfun ON
				tfun.cod_argumento= tr.id_funcion
				AND tfun.cod_tabla='TFUN'
				LEFT JOIN tabla_maestra_detalle AS tare ON
				tare.cod_argumento= tr.id_area
				AND tare.cod_tabla='TARE'
	";
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