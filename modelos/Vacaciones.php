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
	public function insertar($id_nomtrab,$id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias,$obser_detalle,$vencidas,$truncas,$fec_del_dec,$fec_al_dec,$tot_dias_dec,$pen_dias_dec,$obser, $usu_reg, $fec_reg, $pc_reg)
	{
		

		$num_elementos=0;
		$sw=true;
		$item=1;

		while ($num_elementos <count($id_periodo))
		{
			$sql_detalle = "INSERT INTO vacaciones(nro_doc,correlativo, id_periodo,fec_del,fec_al,tot_dias,pen_dias,obser_detalle,vencidas,truncas,fec_del_dec,fec_al_dec,tot_dias_dec,pen_dias_dec,obser, usu_reg, fec_reg, pc_reg) 
			VALUES ('$id_nomtrab','$item', '$id_periodo[$num_elementos]','$fec_del[$num_elementos]','$fec_al[$num_elementos]','$tot_dias[$num_elementos]','$pen_dias[$num_elementos]','$obser_detalle[$num_elementos]',
				'$vencidas[$num_elementos]','$truncas[$num_elementos]','$fec_del_dec[$num_elementos]','$fec_al_dec[$num_elementos]','$tot_dias_dec[$num_elementos]','$pen_dias_dec[$num_elementos]',
				'$obser[$num_elementos]',  '$usu_reg', '$fec_reg', '$pc_reg')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			$item=$item + 1;
		
		}

		return $sw;
	}


	//Implementamos un método para editar registros
	public function editar($nro_doc, $correlativo, $id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias, $obser_detalle, $obser ,   $usu_reg, $fec_reg, $pc_reg)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($correlativo))
		{			
			$sql_detalle="UPDATE vacaciones SET  correlativo='$correlativo[$num_elementos]', fec_del='$fec_del[$num_elementos]' ,fec_al='$fec_al[$num_elementos]' , tot_dias='$tot_dias[$num_elementos]', pen_dias='$pen_dias[$num_elementos]', obser_detalle='$obser_detalle[$num_elementos]', 
			 obser='$obser[$num_elementos]',  usu_reg='$usu_reg', fec_reg='$fec_reg', pc_reg='$pc_reg' WHERE nro_doc='$nro_doc' AND correlativo='$correlativo[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	public function insertar2($nro_doc, $CantItems,  $correlativo, $id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias, $obser_detalle, $obser,   $usu_reg, $fec_reg, $pc_reg)
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;
		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		while ($num_elementos < count($correlativo))
		{	
			$item=$item + 1;

	

			$sql_detalle = "INSERT INTO vacaciones  (  nro_doc, correlativo,id_periodo,fec_del,fec_al, tot_dias, pen_dias,  obser_detalle, obser, usu_reg, fec_reg, pc_reg) VALUES( '$nro_doc', '$item','$id_periodo[$num_elementos]','$fec_del[$num_elementos]','$fec_al[$num_elementos]','$tot_dias[$num_elementos]','$pen_dias[$num_elementos]' ,  '$obser_detalle[$num_elementos]', '$obser[$num_elementos]', '$usu_reg', '$fec_reg', '$pc_reg'  )  "; 

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
              TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab, IFNULL(MAX(vac.correlativo) , 0) AS CantItems
				FROM Trabajador Tra
				LEFT JOIN tabla_maestra_detalle TbAre ON
					TbAre.cod_tabla='TARE'
					AND TbAre.cod_argumento= Tra.id_area
				LEFT JOIN tabla_maestra_detalle TbSua ON
					TbSua.cod_tabla='TSUA'
					AND TbSua.cod_argumento= Tra.id_sucursal
				LEFT JOIN vacaciones vac ON
					vac.nro_doc= tra.num_doc_trab
				WHERE  num_doc_trab='$nro_doc' 
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($nro_doc)
	{
		$sql="SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE(fec_del) AS  fec_del, DATE(fec_al) AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
				 pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle
				FROM Vacaciones vac
				LEFT JOIN tabla_maestra_detalle  TbPea ON
				TbPea.cod_tabla='TPEA'
				AND TbPea.cod_argumento= vac.id_periodo
				where vac.nro_doc='$nro_doc'
				ORDER BY  vac.correlativo ASC";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT tr.id_trab, tr.num_doc_trab, CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tpla.des_larga AS tipo_planilla,
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
				WHERE tr.id_tip_plan='1'
				AND tr.est_reg='1'
				order by apepat_trab ASC";
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

	//Implementar un método para listar los registros
	public function obtenercantidaditems($nro_doc)
	{
		$sql="SELECT MAX(correlativo)
		 FROM vacaciones 
		 WHERE nro_doc='$nro_doc' 
		 ";
		return ejecutarConsulta($sql);	
	}



	
}
?>