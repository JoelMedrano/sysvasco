<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Renta_Quinta_Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Implementamos un método para editar registros
	public function editar(  $id_cp,
							 $id_trab,
							 $mon_total,
							 $fec_reg,
							 $usu_reg,
							 $pc_reg)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($id_trab))
		{			
			$sql_detalle="UPDATE renta_quinta_categoria SET     
								 mon_total='$mon_total[$num_elementos]' 
						 WHERE id_quin='$id_cp' AND id_trab='$id_trab[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	public function insertar2($id_cp,
							  $CantItems,
							  $id_trab,
							  $mon_total,
							  $fec_reg,
							  $usu_reg,
							  $pc_reg )
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;

		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		
		while ($num_elementos < count($id_trab))
		{	
			$item=$item + 1;
			$sql_detalle = "INSERT INTO renta_quinta_categoria(id_quin,
													    id_trab,
													    mon_total,
													    fec_reg,
													    usu_reg,
													    pc_reg ) 
 												VALUES( '$id_cp',
 														'$id_trab[$num_elementos]',
 														'$mon_total[$num_elementos]',
 														'$fec_reg',
 														'$usu_reg',
 														'$pc_reg'  )  ";
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
	public function mostrar($id_cp)
	{
		$sql="SELECT '-' as pd ,
					 cp.id_cp,
					 cp.id_ano,
					 IFNULL(MAX(pd.correlativo),0) AS CantItems,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 cp.des_fec_pag, 
		 			 DATE(cp.fec_pag) AS fec_pag,
		 			 DATE(cp.desde) AS desde,
					 DATE(cp.hasta) AS hasta,
					 IFNULL(DATEDIFF(cp.hasta,cp.desde),0) AS cant_dias,
					 cp.est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle AS TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle AS TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
				LEFT JOIN pago_destajeros AS pd ON 
				pd.id_pd=cp.id_cp
			WHERE  cp.id_cp='$id_cp'
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($id_cp)
	{
		$sql="SELECT rq.id_trab,
					 rq.mon_total,
					 rq.id_quin AS  id_cp ,  
					 CONCAT(Tra.apepat_trab, ' ' , Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres 
				FROM Renta_Quinta_Categoria rq
				LEFT JOIN Trabajador  Tra ON
				 Tra.id_trab= rq.id_trab
				where rq.id_quin='$id_cp'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' as pd ,
					 id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 est_reg 
			FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE  cp.des_fec_pag  NOT IN  ('0')
			AND id_cp>=24
			ORDER BY  cp.id_cp DESC;";
		return ejecutarConsulta($sql);		
	}



	//  Implementar un método para listar los trabajadores que son destajeros
	public function selectTrabajadoresDestajeros()
	{
		$sql="SELECT  id_trab,   CONCAT(apepat_trab, ' ' , apemat_trab, ' ', SUBSTRING_INDEX(nom_trab, ' ', 1))    AS nombres , (sueldo_trab/2) AS sueldo, bono_des_trab
		FROM trabajador 
		where id_form_pag='2' 
		order by apepat_trab ASC";
		return ejecutarConsulta($sql);		
	}





	
}
?>