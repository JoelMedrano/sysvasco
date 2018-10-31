<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Horas_Lactancia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	



    //Implementar un método para mostrar los datos de un registro a modificar Fecha:12072018 - LDGP
	public function validar($fec_des1)
	{
		$sql="SELECT id_cp  As codigo FROM horas_lactancia WHERE id_cp='$fec_des1'  ";
		return ejecutarConsulta($sql);

	}



	public function insertar( $fec_des1,
							  $cantidad_horas,
							  $fec_reg,
						      $usu_reg,
							  $pc_reg)
	{
		


		
			$sql = "INSERT INTO horas_lactancia(		id_cp,
													    cantidad_horas,
													    fec_reg,
													    usu_reg,
													    pc_reg ) 
 												VALUES( '$fec_des1',
 														'$cantidad_horas',
 														'$fec_reg',
 														'$usu_reg',
 														'$pc_reg'  )  ";
			
			return ejecutarConsulta($sql);




	}



	//Implementamos un método para editar registros
	public function editar(  $id_hor_lac,
							 $fec_des1,
							 $cantidad_horas,
						     $fec_reg,
					         $usu_reg,
							 $pc_reg)
	{
		
			
			$sql="UPDATE horas_lactancia SET    id_cp='$fec_des1',
								 cantidad_horas='$cantidad_horas'
						 WHERE id_hor_lac='$id_hor_lac' ";
			

			return ejecutarConsulta($sql);


	}

	





	//Implementamos un método para anular la venta
	public function anular($id_hor_lac)
	{
		$sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_hor_lac)
	{
		$sql="SELECT '-' AS pd ,
					 hl.id_hor_lac AS id_hor_lac,
					 hl.id_cp,
					 hl.id_cp AS fec_des1,
					 hl.cantidad_horas,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 hl.est_reg 
			FROM horas_lactancia hl
			INNER JOIN cronograma_pagos cp ON
				cp.id_cp= hl.id_cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				LEFT  JOIN 	tabla_maestra_detalle TbFpa ON
				TbFpa.cod_argumento=  cp.des_fec_pag
				AND TbFpa.Cod_tabla='TFPA'
			WHERE   hl.id_hor_lac='$id_hor_lac'
              ";
		return ejecutarConsultaSimpleFila($sql);
	}

	

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' AS pd ,
					 hl.id_hor_lac,
					 hl.id_cp,
					 id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 hl.est_reg 
			FROM horas_lactancia hl
			INNER JOIN cronograma_pagos cp ON
				cp.id_cp= hl.id_cp
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