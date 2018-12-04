<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Regimen_Pensionario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(						$fec_des1,
													$id_ano, 
													$obs_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{

		$onp_apo_act=$onp_apo_obl +  $onp_com_men+ $onp_pri_seg;
		$int_apo_act=$int_apo_obl +  $int_com_men+ $int_pri_seg;
		$pri_apo_act=$pri_apo_obl +  $pri_com_men+ $pri_pri_seg;
		$pro_apo_act=$pro_apo_obl +  $pro_com_men+ $pro_pri_seg;
		$hab_apo_act=$hab_apo_obl +  $hab_com_men+ $hab_pri_seg;

		$onp_apo_mix=$onp_apo_obl +  $onp_com_men_rem+ $onp_pri_seg;
		$int_apo_mix=$int_apo_obl +  $int_com_men_rem+ $int_pri_seg;
		$pri_apo_mix=$pri_apo_obl +  $pri_com_men_rem+ $pri_pri_seg;
		$pro_apo_mix=$pro_apo_obl +  $pro_com_men_rem+ $pro_pri_seg;
		$hab_apo_mix=$hab_apo_obl +  $hab_com_men_rem+ $hab_pri_seg;



		$sql="INSERT INTO regimen_pensionario ( id_cp,
												id_ano,
												obs_reg_pen,
											    onp_apo_obl,
											    onp_com_men_rem,
											    onp_com_anu,
											    onp_com_men,
											    onp_pri_seg,
											    onp_apo_act,
											    onp_apo_mix,
											    int_apo_obl,
											    int_com_men_rem,
											    int_com_anu,
											    int_com_men,
											    int_pri_seg,
											    int_apo_act,
											    int_apo_mix,
											    pri_apo_obl,
											    pri_com_men_rem,
											    pri_com_anu,
											    pri_com_men,
											    pri_pri_seg,
											    pri_apo_act,
											    pri_apo_mix,
											    pro_apo_obl,
											    pro_com_men_rem,
											    pro_com_anu,
											    pro_com_men,
											    pro_pri_seg,
											    pro_apo_act,
											    pro_apo_mix,
											    hab_apo_obl,
											    hab_com_men_rem,
											    hab_com_anu,
											    hab_com_men,
											    hab_pri_seg,
											    hab_apo_act,
											    hab_apo_mix,
											    sj_apo_obl,
											    sj_com_men_rem,
											    sj_apo_mix,
											    est_reg_pen,
											    fec_reg,
											    usu_reg,
											    pc_reg)
										VALUES ('$fec_des1',
												'$id_ano',
											    '$obs_reg_pen',
											    '$onp_apo_obl',
											    '$onp_com_men_rem',
											    '$onp_com_anu',
											    '$onp_com_men',
										     	'$onp_pri_seg',
										     	'$onp_apo_act',
										     	'$onp_apo_mix',
										     	'$int_apo_obl',
										     	'$int_com_men_rem',
										     	'$int_com_anu',
										     	'$int_com_men',
										     	'$int_pri_seg',
										     	'$int_apo_act',
										     	'$int_apo_mix',
										     	'$pri_apo_obl',
										     	'$pri_com_men_rem',
										     	'$pri_com_anu',
										     	'$pri_com_men',
										     	'$pri_pri_seg',
										     	'$pri_apo_act',
										     	'$pri_apo_mix',
										     	'$pro_apo_obl',
										     	'$pro_com_men_rem',
										     	'$pro_com_anu',
										     	'$pro_com_men',
										     	'$pro_pri_seg',
										     	'$pro_apo_act',
										     	'$pro_apo_mix',
										     	'$hab_apo_obl',
										     	'$hab_com_men_rem',
										     	'$hab_com_anu',
										     	'$hab_com_men',
										     	'$hab_pri_seg',
										     	'$hab_apo_act',
										     	'$hab_apo_mix',
										     	'$sj_apo_obl',
										     	'$sj_com_men_rem',
										     	'$sj_apo_mix',
										     	'1',
										     	'$fec_reg',
										     	'$usu_reg',
										     	'$pc_reg'
										     	)";
		return ejecutarConsulta($sql);


	}

	//Implementamos un método para editar registros
	public function editar(					       
													$obs_reg_pen,
													$id_reg_pen,
													$onp_apo_obl,
													$onp_com_men_rem,
													$onp_com_anu,
													$onp_com_men,
													$onp_pri_seg,
													$onp_apo_act,
													$onp_apo_mix,
													$int_apo_obl,
													$int_com_men_rem,
													$int_com_anu,
													$int_com_men,
													$int_pri_seg,
													$int_apo_act,
													$int_apo_mix,
													$pri_apo_obl,
													$pri_com_men_rem,
													$pri_com_anu,
													$pri_com_men,
													$pri_pri_seg,
													$pri_apo_act,
													$pri_apo_mix,
													$pro_apo_obl,
													$pro_com_men_rem,
													$pro_com_anu,
													$pro_com_men,
													$pro_pri_seg,
													$pro_apo_act,
													$pro_apo_mix,
													$hab_apo_obl,
													$hab_com_men_rem,
													$hab_com_anu,
													$hab_com_men,
													$hab_pri_seg,
													$hab_apo_act,
													$hab_apo_mix,
													$sj_apo_obl,
													$sj_com_men_rem,
													$sj_apo_mix,
													$fec_reg,
													$usu_reg,
													$pc_reg)
	{


		$onp_apo_act=$onp_apo_obl +  $onp_com_men+ $onp_pri_seg;
		$int_apo_act=$int_apo_obl +  $int_com_men+ $int_pri_seg;
		$pri_apo_act=$pri_apo_obl +  $pri_com_men+ $pri_pri_seg;
		$pro_apo_act=$pro_apo_obl +  $pro_com_men+ $pro_pri_seg;
		$hab_apo_act=$hab_apo_obl +  $hab_com_men+ $hab_pri_seg;

		$onp_apo_mix=$onp_apo_obl +  $onp_com_men_rem+ $onp_pri_seg;
		$int_apo_mix=$int_apo_obl +  $int_com_men_rem+ $int_pri_seg;
		$pri_apo_mix=$pri_apo_obl +  $pri_com_men_rem+ $pri_pri_seg;
		$pro_apo_mix=$pro_apo_obl +  $pro_com_men_rem+ $pro_pri_seg;
		$hab_apo_mix=$hab_apo_obl +  $hab_com_men_rem+ $hab_pri_seg;



		$sql="UPDATE regimen_pensionario SET  
										      obs_reg_pen='$obs_reg_pen',
											  onp_apo_obl='$onp_apo_obl',
											  onp_com_men_rem='$onp_com_men_rem',
									  		  onp_com_anu='$onp_com_anu',
											  onp_com_men='$onp_com_men',
											  onp_pri_seg='$onp_pri_seg',
											  onp_apo_act='$onp_apo_act',
											  onp_apo_mix='$onp_apo_mix',
											  int_apo_obl='$int_apo_obl',
											  int_com_men_rem='$int_com_men_rem',
											  int_com_anu='$int_com_anu',
											  int_com_men='$int_com_men',
											  int_pri_seg='$int_pri_seg',
											  int_apo_act='$int_apo_act',
											  int_apo_mix='$int_apo_mix',
											  pri_apo_obl='$pri_apo_obl',
											  pri_com_men_rem='$pri_com_men_rem',
											  pri_com_anu='$pri_com_anu',
											  pri_com_men='$pri_com_men',
											  pri_pri_seg='$pri_pri_seg',
											  pri_apo_act='$pri_apo_act',
											  pri_apo_mix='$pri_apo_mix',
											  pro_apo_obl='$pro_apo_obl',
											  pro_com_men_rem='$pro_com_men_rem',
											  pro_com_anu='$pro_com_anu',
											  pro_com_men='$pro_com_men',
											  pro_pri_seg='$pro_pri_seg',
											  pro_apo_act='$pro_apo_act',
											  pro_apo_mix='$pro_apo_mix',
											  hab_apo_obl='$hab_apo_obl',
											  hab_com_men_rem='$hab_com_men_rem',
											  hab_com_anu='$hab_com_anu',
											  hab_com_men='$hab_com_men',
											  hab_pri_seg='$hab_pri_seg',
											  hab_apo_act='$hab_apo_act',
											  hab_apo_mix='$hab_apo_mix',
											  sj_apo_obl='$sj_apo_obl',
											  sj_com_men_rem='$sj_com_men_rem',
											  sj_apo_mix='$sj_apo_mix',
											  fec_reg='$fec_reg',
											  usu_reg='$usu_reg',
											  pc_reg='$pc_reg'
											  WHERE  id_reg_pen='$id_reg_pen' ";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_reg_pen, $fec_reg, $usu_reg, $pc_reg)
	{
		$sql="UPDATE regimen_pensionario SET est_reg_pen='0', fec_anu='$fec_reg', usu_anu='$usu_reg', pc_anu='$pc_reg' WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_reg_pen, $fec_reg, $usu_reg, $pc_reg)
	{
		$sql="UPDATE regimen_pensionario SET est_reg_pen='1', fec_act='$fec_reg', usu_act='$usu_reg', pc_act='$pc_reg'  WHERE id_reg_pen='$id_reg_pen'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_cp)
	{
		$sql="SELECT 	rp.id_cp AS fec_des1,
						TbFpa1.fecha1 AS fecha, 
						rp.id_reg_pen,
						rp.obs_reg_pen,
					    rp.onp_apo_obl,
					    rp.onp_com_men_rem,
					    rp.onp_com_anu,
					    rp.onp_com_men,
					    rp.onp_pri_seg,
					    rp.onp_apo_act,
					    rp.onp_apo_mix,
					    rp.int_apo_obl,
					    rp.int_com_men_rem,
					    rp.int_com_anu,
					    rp.int_com_men,
					    rp.int_pri_seg,
					    rp.int_apo_act,
					    rp.int_apo_mix,
					    rp.pri_apo_obl,
					    rp.pri_com_men_rem,
					    rp.pri_com_anu,
					    rp.pri_com_men,
					    rp.pri_pri_seg,
					    rp.pri_apo_act,
					    rp.pri_apo_mix,
					    rp.pro_apo_obl,
					    rp.pro_com_men_rem,
					    rp.pro_com_anu,
					    rp.pro_com_men,
					    rp.pro_pri_seg,
					    rp.pro_apo_act,
					    rp.pro_apo_mix,
					    rp.hab_apo_obl,
					    rp.hab_com_men_rem,
					    rp.hab_com_anu,
					    rp.hab_com_men,
					    rp.hab_pri_seg,
					    rp.hab_apo_act,
					    rp.hab_apo_mix,
					    (rp.sj_apo_obl*2) AS sum_sj_apo_obl,
					    rp.sj_apo_obl,
					    rp.sj_com_men_rem,
					    rp.sj_apo_mix,
					    rp.est_reg_pen
		FROM regimen_pensionario AS rp 
		LEFT JOIN 
				(SELECT  rp.id_cp,  CONCAT (TbPea.Des_Corta,' - ',TbFpa1.des_larga ) AS   fecha1
				 FROM regimen_pensionario AS rp 
				  LEFT JOIN  cronograma_pagos AS cp  ON    rp.id_cp=cp.id_cp
				  LEFT JOIN tabla_maestra_detalle AS TbFpa1 ON    TbFpa1.cod_argumento=  rp.id_cp AND TbFpa1.Cod_tabla='TFPA'
				  LEFT JOIN tabla_maestra_detalle AS TbPea ON   TbPea.cod_argumento=  cp.id_ano AND TbPea.Cod_tabla='TPEA'  
				)  AS TbFpa1 ON  TbFpa1.id_cp= rp.id_cp
		WHERE rp.id_cp='$id_cp'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT '-' AS pd ,
					 rp.id_cp,
					 rp.id_ano,
		 			 TbPea.Des_Corta AS Ano,
		 			 TbFpa.Des_Larga AS Descrip_fec_pag,
		 			 des_fec_pag, 
		 			 DATE(fec_pag) AS fec_pag,
		 			 DATE(desde) AS desde,
					 DATE(hasta) AS hasta,
					 IFNULL(DATEDIFF(hasta,desde),0) AS cant_dias,
					 est_reg 
			FROM regimen_pensionario rp
				LEFT JOIN cronograma_pagos cp ON
				cp.id_cp=rp.id_cp
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

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosCotizacion()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_cotizacion,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);
	}

}

?>
