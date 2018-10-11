<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Contratos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}


	//Implementamos un método para actualizar el contrato
	public function editar($id_trab,
										   $id_con_trab,
										   $tie_ren_ant,
										   $fec_ini_ant,
										   $fec_fin_ant,
										   $id_sit_inf_ant,
										   $usu_reg,
										   $pc_reg,
										   $fec_reg  )
	{
		
		$sql="UPDATE contratos SET tie_ren_con='$tie_ren_ant', fec_ini_con='$fec_ini_ant', fec_fin_con='$fec_fin_ant',  id_sit_inf='$id_sit_inf_ant' WHERE id_trab='$id_trab' AND  id_con_trab='$id_con_trab' ";
		return ejecutarConsulta($sql);


	}

	
    


	


	public function insertar2(			 $id_trab,
										 $tie_ren_con,
										 $fec_ini_con,
										 $fec_fin_con,
										 $id_sit_inf_act,
										 $CantItems,
										 $usu_reg,
										 $pc_reg,
										 $fec_reg )
	{
		




	$CantItems=$CantItems+1;
		
			$sql= "INSERT INTO contratos  (   		   id_trab,
													   id_con_trab,
													   tie_ren_con,
													   fec_ini_con,
													   fec_fin_con,
													   id_sit_inf,
													   usu_reg,
													   pc_reg,
													   fec_reg  ) 
											   VALUES( '$id_trab',
											   		   '$CantItems',
											           '$tie_ren_con',
											           '$fec_ini_con',
											           '$fec_fin_con',
											           '$id_sit_inf_act',
											           '$usu_reg',
											           '$pc_reg',
											           '$fec_reg')  ";
		
			
			
		

			return ejecutarConsulta($sql);

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
              TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab, IFNULL(MAX(con.id_con_trab),0) AS CantItems,
               MAX(DATE(con.fec_ini_con)) AS  fec_ini_ant , MAX(DATE(con.fec_fin_con)) AS fec_fin_ant, con.tie_ren_con AS tie_ren_ant, con.id_con_trab,
               con.id_sit_inf AS id_sit_inf_ant,  TbSic.des_larga AS situacion_informativa_actual
				FROM Trabajador Tra
				LEFT JOIN contratos con ON
					con.id_trab= tra.id_trab
				LEFT JOIN tabla_maestra_detalle TbAre ON
					TbAre.cod_tabla='TARE'
					AND TbAre.cod_argumento= Tra.id_area
				LEFT JOIN tabla_maestra_detalle TbSua ON
					TbSua.cod_tabla='TSUA'
					AND TbSua.cod_argumento= Tra.id_sucursal
				LEFT JOIN tabla_maestra_detalle TbSic ON
					TbSic.cod_tabla='TSIC'
					AND TbSic.cod_argumento= con.id_sit_inf
				WHERE  tra.num_doc_trab='$nro_doc' 
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
		$sql="SELECT  DATE_FORMAT( MAX(co.fec_fin_con), '%d/%m/%Y')   AS fec_fin_con,
				       MAX(co.id_con_trab) AS id_con_trab,
				       tr.num_doc_trab AS nro_doc,
				       tr.id_trab,
				       CASE
						WHEN MONTH(MAX(co.fec_fin_con))=MONTH(CURDATE()) THEN 'POR RENOVAR'
						WHEN DATEDIFF(CURDATE(), tr.fec_ing_trab) >1460 THEN 'PROXIMO ESTABLE'
						WHEN co.fec_fin_con < CURDATE() THEN 'VIGENTE'
				        ELSE 'PENDIENTE' END
					AS situacion,
					tr.id_trab,
					tr.num_doc_trab,
					CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
					tsua.des_larga AS sucursal_anexo,
					tfun.des_larga AS funcion,
					tare.des_larga AS area_trab,
					tr.est_reg, tr.num_doc_trab,
					tr.num_doc_trab AS nro_doc
				FROM trabajador  tr  
					LEFT JOIN contratos co ON
					tr.id_trab= co.id_trab	
					LEFT JOIN tabla_maestra_detalle AS tsua ON
					tsua.cod_argumento= tr.id_sucursal
					AND tsua.cod_tabla='TSUA'
					LEFT JOIN tabla_maestra_detalle AS tfun ON
					tfun.cod_argumento= tr.id_funcion
					AND tfun.cod_tabla='TFUN'
					LEFT JOIN tabla_maestra_detalle AS tare ON
					tare.cod_argumento= tr.id_area
					AND tare.cod_tabla='TARE'
				WHERE DATEDIFF(CURDATE(), tr.fec_ing_trab) < 1825
				AND tr.id_tip_plan='1'
				AND tr.est_reg='1'
				GROUP BY tr.id_trab
				ORDER BY tr.apepat_trab";
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