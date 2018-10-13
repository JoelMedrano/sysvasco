<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Planilla
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	

	


	//  Implementar un método para listar los trabajadores que son destajeros
	public function selectFechaPago()
	{
		$sql="SELECT 
					 id_cp AS fecha_pago,
		 			 CONCAT(TbPea.Des_Corta, ' - ' ,  TbFpa.Des_Larga)   AS  fecha
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




}

?>
