<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pago_Destajeros
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	//Implementamos un método para editar registros
	public function editar(  $id_cp,
							 $correlativo,
							 $id_trab,
							 $sueldo,
							 $bono_des_trab,
							 $prod_soles,
							 $dif_soles,
							 $fec_reg,
							 $usu_reg,
							 $pc_reg)
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($correlativo))
		{			
			$sql_detalle="UPDATE pago_destajeros SET     
								 sueldo='$sueldo[$num_elementos]', 
								 bono_des_trab='$bono_des_trab[$num_elementos]',
								 prod_soles='$prod_soles[$num_elementos]',
								 dif_soles='$prod_soles[$num_elementos]'- '$sueldo[$num_elementos]'  
						 WHERE id_pd='$id_cp' AND correlativo='$correlativo[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	


	public function insertar2($id_cp,
							  $CantItems,
							  $correlativo,
							  $id_trab,
							  $sueldo,
							  $bono_des_trab,
							  $prod_soles,
							  $dif_soles,
							  $fec_reg,
							  $usu_reg,
							  $pc_reg )
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;

		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		
		while ($num_elementos < count($correlativo))
		{	
			$item=$item + 1;
			$sql_detalle = "INSERT INTO pago_destajeros(id_pd,
													    correlativo,
													    id_trab,
													    sueldo,
													    bono_des_trab,
													    prod_soles,
													    dif_soles,
													    fec_reg,
													    usu_reg,
													    pc_reg ) 
 												VALUES( '$id_cp',
 														'$item',
 														'$id_trab[$num_elementos]',
 														'$sueldo[$num_elementos]',
 														'$bono_des_trab[$num_elementos]',
 														'$prod_soles[$num_elementos]',
 														'$prod_soles[$num_elementos]'- '$sueldo[$num_elementos]' , 
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
		$sql="SELECT pd.id_trab,
					 pd.correlativo,
					 pd.id_pd, 
					 pd.sueldo,
					 pd.bono_des_trab, 
					 pd.prod_soles,
					 pd.dif_soles,  
					 CONCAT(Tra.apepat_trab, ' ' , Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres 
				FROM pago_destajeros pd
				LEFT JOIN Trabajador  Tra ON
				 Tra.id_trab= pd.id_trab
				where pd.id_pd='$id_cp'
				ORDER BY  pd.correlativo ASC";
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