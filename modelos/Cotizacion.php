<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cotizacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(	$idusuario,
														$empresa,
														$cod_mod,
														$color_mod,
														$tallas_mod,
														$id_trab,
														$div_mod,
														$temp_mod,
														$dest_mod,
														$tela1_mod,
														$tela2_mod,
														$tela3_mod,
														$bord_mod,
														$esta_mod,
														$manu_mod,
														$fecha_hora,
														$total_cotizacion,
														$idarticulo,
														$cantidad,
														$precio_cotizacion,
														$descuento)
	{
		$sql="INSERT INTO cotizacion (idusuario,
																	empresa,
																	cod_mod,
																	color_mod,
																	tallas_mod,
																	id_trab,
																	div_mod,
																	temp_mod,
																	dest_mod,
																	tela1_mod,
																	tela2_mod,
																	tela3_mod,
																	bord_mod,
																	esta_mod,
																	manu_mod,
																	fecha_hora,
																	total_cotizacion,
																	estado)

												VALUES	('$idusuario',
																 '$empresa',
																 '$cod_mod',
																 '$color_mod',
																 '$tallas_mod',
																 '$id_trab',
																 '$div_mod',
																 '$temp_mod',
																 '$dest_mod',
																 '$tela1_mod',
																 '$tela2_mod',
																 '$tela3_mod',
																 '$bord_mod',
																 '$esta_mod',
																 '$manu_mod',
																 '$fecha_hora',
																 '$total_cotizacion',
																 'por aprobar')";
		//return ejecutarConsulta($sql);
		$idcotizacionnew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_cotizacion(idcotizacion, idarticulo,cantidad,precio_cotizacion,descuento) VALUES ('$idcotizacionnew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_cotizacion[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	//Implementamos un método para anular la cotizacion
	public function rechazar($idcotizacion)
	{
		$sql="UPDATE cotizacion SET estado='rechazado' WHERE idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la cotizacion
	public function aprobar($idcotizacion,$idusuario)
	{
		$sql="UPDATE cotizacion SET estado='aprobado',editable='0',vb_cotizacion='$idusuario' WHERE idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la cotizacion
	public function editar($idcotizacion)
	{
		$sql="UPDATE cotizacion SET editable='1', estado='por aprobar' WHERE idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la cotizacion
	public function noeditar($idcotizacion)
	{
		$sql="UPDATE cotizacion SET editable='0', editable='por aprobar' WHERE idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para anular la cotizacion
	public function eliminar($idcotizacion)
	{
		$sql="DELETE FROM cotizacion WHERE idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcotizacion)
	{
		$sql="SELECT	c.idcotizacion,
									DATE(c.fecha_hora) AS fecha,
									m.id_marca,
									ma.nombre AS marca,
									c.cod_mod,
									m.nom_mod,
									c.id_trab,
									CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador,
									c.idusuario,
									UPPER(u.nombre) AS desarrollador,
									c.total_cotizacion,
									c.vb_cotizacion,
									(SELECT UPPER(nombre) FROM usuario u WHERE u.idusuario=c.vb_cotizacion) AS vb,
									c.estado,
									c.editable,
									c.empresa,
									c.color_mod,
									c.tallas_mod,
									c.div_mod,
									c.temp_mod,
									c.dest_mod,
									c.tela1_mod,
									c.tela2_mod,
									c.tela3_mod,
									c.bord_mod,
									c.esta_mod,
									c.manu_mod
									FROM cotizacion c
									LEFT JOIN modelojf m
									ON C.cod_mod=m.cod_mod
									LEFT JOIN marcas ma
									ON m.id_marca=ma.id_marca
									LEFT JOIN usuario u
									ON C.idusuario=u.idusuario
									LEFT JOIN trabajador t
									ON C.id_trab=t.id_trab
									WHERE c.idcotizacion='$idcotizacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idcotizacion)
	{
		$sql="SELECT	dc.idcotizacion,
									dc.idarticulo,
									mp.nombre,
									dc.cantidad,
									dc.precio_cotizacion,
									dc.descuento,
									(dc.cantidad*dc.precio_cotizacion-dc.descuento) AS subtotal
									FROM detalle_cotizacion dc
									LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS id_articulo,
										tmd.des_larga AS nombre,
										tmd.des_corta AS cod_linea,
										lin.linea,
										und.unidad,
										pre.precio
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
										LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										tmd.des_larga AS linea,
										tmd.des_corta AS cod_linea
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON LEFT(pro.codfab,3)=tmd.des_corta
										WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
									ON SUBSTRING(pro.codfab,1,6)=cod_sublinea
									LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										tmd.des_corta AS unidad
										FROM producto pro
										LEFT JOIN tabla_m_detalle AS tmd
										ON pro.undpro=tmd.cod_argumento
										WHERE pro.estpro='1' AND tmd.cod_tabla='tund'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS und
									ON SUBSTRING(pro.codfab,1,6)=und.cod_sublinea
									LEFT JOIN
										(SELECT
										SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
										MAX(GREATEST(
										CASE
										WHEN pmp.monprov1='DOLARES AMERICANOS' THEN pmp.preprov1*3.3
										ELSE pmp.preprov1 END,
										CASE
										WHEN pmp.monprov2='DOLARES AMERICANOS' THEN pmp.preprov2*3.3
										ELSE pmp.preprov2 END,
										CASE
										WHEN pmp.monprov3='DOLARES AMERICANOS' THEN pmp.preprov3*3.3
										ELSE pmp.preprov3 END)) AS precio
										FROM preciomp pmp
										LEFT JOIN producto pro
										ON pmp.codpro=pro.codpro
										WHERE pro.estpro='1'
										GROUP BY SUBSTRING(pro.CodFab,1,6)) AS pre
									ON SUBSTRING(pro.codfab,1,6)=pre.cod_sublinea
									WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea
									GROUP BY SUBSTRING(pro.CodFab,1,6)) AS mp
									ON dc.idarticulo=mp.id_articulo
									where dc.idcotizacion='$idcotizacion'";
									

		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros JOEL
	public function listar()
	{
		$sql="SELECT 	c.idcotizacion,
									DATE(c.fecha_hora) AS fecha,
									m.id_marca,
									ma.nombre AS marca,
									c.cod_mod,
									m.nom_mod,
									c.id_trab,
									CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñador,
									c.idusuario,
									UPPER(u.nombre) AS desarrollador,
									CASE
									WHEN c.total_cotizacion=np.subtotal THEN ROUND(c.total_cotizacion,6)
									ELSE ROUND(np.subtotal,6) END AS total_cotizacion,
									c.vb_cotizacion,
									(SELECT nombre FROM usuario u WHERE u.idusuario=c.vb_cotizacion) AS vb,
									c.estado,
									c.editable
									FROM cotizacion c
									LEFT JOIN modelojf m
									ON C.cod_mod=m.cod_mod
									LEFT JOIN marcas ma
									ON m.id_marca=ma.id_marca
									LEFT JOIN usuario u
									ON C.idusuario=u.idusuario
									LEFT JOIN trabajador t
									ON C.id_trab=t.id_trab
									LEFT JOIN
										(SELECT
										idcotizacion,
										SUM(cantidad*precio_cotizacion) AS subtotal
										FROM detalle_cotizacion dc
										GROUP BY idcotizacion) AS np
									ON c.idcotizacion=np.idcotizacion";
		return ejecutarConsulta($sql);
	}

	public function cotizacioncabecera($idcotizacion){
		$sql="SELECT c.idcotizacion,c.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,c.idusuario,u.nombre as usuario,c.tipo_comprobante,c.serie_comprobante,c.num_comprobante,date(c.fecha_hora) as fecha,c.impuesto,c.total_cotizacion FROM cotizacion c INNER JOIN persona p ON c.idcliente=p.idpersona INNER JOIN usuario u ON c.idusuario=u.idusuario WHERE c.idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}

	public function cotizaciondetalle($idcotizacion){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_cotizacion,d.descuento,(d.cantidad*d.precio_cotizacion-d.descuento) as subtotal FROM detalle_cotizacion d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idcotizacion='$idcotizacion'";
		return ejecutarConsulta($sql);
	}


	public function selectCot()
	{
		$sql="SELECT  c.idcotizacion,
									CONCAT('Cotizacion N°: ',c.idcotizacion,' - ',m.cod_mod) AS nombre
									FROM cotizacion c
									LEFT JOIN detalle_cotizacion dc
									ON c.idcotizacion=dc.idcotizacion
									LEFT JOIN modelojf m
									ON c.cod_mod=m.cod_mod
									WHERE c.editable='1'
									GROUP BY c.cod_mod";

		return ejecutarConsulta($sql);


	}

}
?>
