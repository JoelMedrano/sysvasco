<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cronograma_Pagos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($id_ano, $des_fec_pag, $fec_pag)
	{
		

		$num_elementos=0;
		$sw=true;
		$item=1;

		while ($num_elementos <count($des_fec_pag))
		{
			$sql_detalle = "INSERT INTO cronograma_pagos(id_ano, des_fec_pag, fec_pag) 
			VALUES ('$id_ano','$des_fec_pag[$num_elementos]','$fec_pag[$num_elementos]',
				'$obser[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			$item=$item + 1;
		
		}

		return $sw;
	}


	//Implementamos un método para editar registros
	public function editar($id_ano, $des_fec_pag, $fec_pag, $desde, $hasta  )
	{
		
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($des_fec_pag))
		{			
			$sql_detalle="UPDATE cronograma_pagos SET    fec_pag='$fec_pag[$num_elementos]',  desde='$desde[$num_elementos]',   hasta='$hasta[$num_elementos]'     WHERE id_ano='$id_ano' AND des_fec_pag='$des_fec_pag[$num_elementos]'  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	public function insertar2($nro_doc, $CantItems,  $correlativo, $id_periodo,$fec_del,$fec_al,$tot_dias,$pen_dias, $obser_detalle, $obser)
	{
		


		$item=$CantItems;


		$num_elementos=$CantItems;
		$sw=true;
		//while ($num_elementos < count($correlativo) AND $correlativo > $cantidaditems)
		while ($num_elementos < count($correlativo))
		{	

			$sql_detalle = "INSERT INTO vacaciones  (  nro_doc, correlativo,id_periodo,fec_del,fec_al, tot_dias, pen_dias ) VALUES( '$nro_doc', '$item','$CantItems','$fec_del[$num_elementos]','$fec_al[$num_elementos]','$tot_dias[$num_elementos]','$pen_dias[$num_elementos]' )  ";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
			$item=$item + 1;
		
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
	public function mostrar($id_ano)
	{
		$sql="SELECT id_cp, id_ano,
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
			WHERE cp.id_ano='$id_ano'
			ORDER BY  cp.des_fec_pag ASC
              ";
		return ejecutarConsultaSimpleFila($sql);
	}


	public function listarDetalle($id_ano)
	{
		$sql="SELECT id_cp,
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
			WHERE cp.id_ano='$id_ano'
			AND cp.des_fec_pag  NOT IN  ('0')
			ORDER BY  cp.des_fec_pag ASC";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT DISTINCT 'CP' AS cp, obs,   id_ano, TbPea.Des_Corta AS Ano, est_reg FROM cronograma_pagos cp
				LEFT  JOIN 	tabla_maestra_detalle TbPea ON
				TbPea.cod_argumento=  cp.id_ano
				AND TbPea.Cod_tabla='TPEA'
				order by id_ano DESC ";
		return ejecutarConsulta($sql);		
	}

	


	
}
?>