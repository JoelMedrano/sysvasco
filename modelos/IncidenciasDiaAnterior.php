<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Incidencia
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	


	public function listarIncidenciasDiaAnterior()
	{
		$sql="SELECT re.id_trab, CONCAT(tr.`apepat_trab`, ' ' , tr.`apemat_trab`, ' ', tr.`nom_trab` ) AS apellidosynombres, re.fecha, re.hor_ent, re.hor_sal, ''  AS seg_hor_sal, 'NO REGISTRO HORA DE SALIDA' AS incidencia  
					 FROM reloj  re
					 INNER JOIN trabajador tr ON 
					 re.id_trab= tr.id_trab
					 WHERE re.fecha=DATE_SUB(CURDATE(), INTERVAL 1 DAY) 
					 AND re.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
					 AND re.hor_sal=''
					 UNION ALL
					 SELECT re.id_trab, CONCAT(tr.`apepat_trab`, ' ' , tr.`apemat_trab`, ' ', tr.`nom_trab` )  AS apellidosynombres, re.fecha, re.hor_ent, re.hor_sal, segunda_hor_ent  AS seg_hor_sal, 'REGISTRO 2 VECES HORA DE SALIDA' AS incidencia   
					 FROM reloj  re
					 INNER JOIN trabajador tr ON 
					 re.id_trab= tr.id_trab
					 WHERE re.fecha=DATE_SUB(CURDATE(), INTERVAL 1 DAY) 
					 AND re.id_trab NOT IN  ( SELECT  ehp.id_trab  FROM excepciones_horario_pago ehp WHERE ehp.est_reg='1') 
					 AND re.segunda_hor_ent!='' ";

		return ejecutarConsulta($sql);
	}




	
}

?>
