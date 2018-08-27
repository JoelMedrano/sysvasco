<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Vacaciones
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
	public function anular($nro_doc)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($nro_doc)
	{
		$sql="SELECT Tra.id_trab, Tra.num_doc_trab AS nro_doc, Tra.num_doc_trab AS id_nomtrab ,  CONCAT(Tra.apepat_trab, ' ' , Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres ,   Tra.apemat_trab, Tra.apepat_trab, Tra.nom_trab, Tra.id_sucursal, Tra.id_area, TbAre.Des_Larga AS area_trab,
              TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab
				FROM Trabajador Tra
				LEFT JOIN tabla_maestra_detalle TbAre ON
					TbAre.cod_tabla='TARE'
					AND TbAre.cod_argumento= Tra.id_area
				LEFT JOIN tabla_maestra_detalle TbSua ON
					TbSua.cod_tabla='TSUA'
					AND TbSua.cod_argumento= Tra.id_sucursal
				where num_doc_trab='$nro_doc' 
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($nro_doc)
	{
		$sql="SELECT nro_doc, id_periodo, TbPea.des_larga AS PeridoAnual, DATE_FORMAT(fec_del, '%d/%m/%Y') AS  fec_del, DATE_FORMAT(fec_al, '%d/%m/%Y') AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
				 pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle
				FROM Vacaciones vac
				LEFT JOIN tabla_maestra_detalle  TbPea ON
				TbPea.cod_tabla='TPEA'
				AND TbPea.cod_argumento= vac.id_periodo
				where vac.nro_doc='$nro_doc'
				ORDER BY vac.Nro_doc ASC, vac.id_periodo ASC";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tpla.des_larga AS tipo_planilla,
				tsua.des_larga AS sucursal_anexo, tfun.des_larga AS funcion, tare.des_larga AS area_trab, tr.est_reg, tr.num_doc_trab,  tr.num_doc_trab AS nro_doc
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
				WHERE tr.id_tip_plan='1'";
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