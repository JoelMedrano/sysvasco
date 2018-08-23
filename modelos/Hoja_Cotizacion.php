<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class HojaCotizacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_venta,$idarticulo,$cantidad,$precio_venta,$descuento)
	{
		$sql="INSERT INTO venta (idcliente,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_venta,estado)
		VALUES ('$idcliente','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_venta','Aceptado')";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,precio_venta,descuento) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	//Implementamos un método para anular la venta
	public function anular($idventa)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idhojacotizacion)
	{
		$sql="SELECT    h.idhojacotizacion,
                    ma.nombre as marca,
                    h.cod_mod,
                    m.nom_mod,
                    h.id_trab,
                    CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñado,
                    h.idusuario,
                    UPPER(u.nombre) AS elaborado,
                    h.cmp_mod AS costo,
										DATE(h.fec_creacion) AS fec_creacion,
                    h.vb_cotizacion,
                    (SELECT nombre FROM usuario u WHERE u.idusuario=h.vb_cotizacion) AS vb,
                    h.estado,
                    h.editable
                    FROM hoja_cotizacion h
                    LEFT JOIN modelojf m
                    ON h.cod_mod=m.cod_mod
                    LEFT JOIN marcas ma
                    ON m.id_marca=ma.id_marca
                    LEFT JOIN usuario u
                    ON h.idusuario=u.idusuario
                    LEFT JOIN trabajador t
                    ON h.id_trab=t.id_trab
										WHERE v.idhojacotizacion='$idhojacotizacion'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa)
	{
		$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv inner join articulo a on dv.idarticulo=a.idarticulo where dv.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT    h.idhojacotizacion,
                    ma.nombre as marca,
                    h.cod_mod,
                    m.nom_mod,
                    h.id_trab,
                    CONCAT(t.apepat_trab,' ',t.apemat_trab,' ',t.nom_trab) AS diseñado,
                    h.idusuario,
                    UPPER(u.nombre) AS elaborado,
                    h.cmp_mod AS costo,
										DATE(h.fec_creacion) AS fec_creacion,
                    h.vb_cotizacion,
                    (SELECT nombre FROM usuario u WHERE u.idusuario=h.vb_cotizacion) AS vb,
                    h.estado,
                    h.editable
                    FROM hoja_cotizacion h
                    LEFT JOIN modelojf m
                    ON h.cod_mod=m.cod_mod
                    LEFT JOIN marcas ma
                    ON m.id_marca=ma.id_marca
                    LEFT JOIN usuario u
                    ON h.idusuario=u.idusuario
                    LEFT JOIN trabajador t
                    ON h.id_trab=t.id_trab";
		return ejecutarConsulta($sql);
	}

	public function ventacabecera($idventa){
		$sql="SELECT v.idventa,v.idcliente,p.nombre as cliente,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,v.idusuario,u.nombre as usuario,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,date(v.fecha_hora) as fecha,v.impuesto,v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

}
?>
