<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class ConsultasD
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function comprasfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT DATE(i.fecha_hora) as fecha,u.nombre as usuario, p.nombre as proveedor,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
		return ejecutarConsulta($sql);		
	}

	public function ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente)
	{
		$sql="SELECT DATE(v.fecha_hora) as fecha,u.nombre as usuario, p.nombre as cliente,v.tipo_comprobante,v.serie_comprobante,v.num_comprobante,v.total_venta,v.impuesto,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.idcliente='$idcliente'";
		return ejecutarConsulta($sql);		
	}

	public function totalcomprahoy()
	{
		$sql="SELECT IFNULL(SUM(total_compra),0) as total_compra FROM ingreso WHERE DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function totalventahoy()
	{
		$sql="SELECT IFNULL(SUM(total_venta),0) as total_venta FROM venta WHERE DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function comprasultimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function ventasultimos_12meses()
	{
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(total_venta) as total FROM venta GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}


   // Permiso - Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM Trabajador";
		return ejecutarConsulta($sql);		
	}


	// Permiso - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoPermiso()
	{
		$sql="SELECT des_corta AS tip_permiso , des_larga AS  tipo_permiso FROM tabla_maestra_detalle where cod_tabla='TPER' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador -  Implementar un método para listar los registros y mostrar en el select
	public function selectFuncion()
	{
		$sql="SELECT cod_argumento AS id_funcion , des_larga AS  funcion FROM tabla_maestra_detalle where cod_tabla='TFUN' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectArea()
	{
		$sql="SELECT cod_argumento AS id_area , des_larga AS  area_trab FROM tabla_maestra_detalle where cod_tabla='TARE' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoDocumento()
	{
		$sql="SELECT cod_argumento AS id_tip_doc , des_larga AS  tipo_documento FROM tabla_maestra_detalle where cod_tabla='TDOC' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoPlanilla()
	{
		$sql="SELECT cod_argumento AS id_tip_plan , des_larga AS  tipo_planilla FROM tabla_maestra_detalle where cod_tabla='TPLA' ORDER BY cod_argumento DESC ";
		return ejecutarConsulta($sql);		
	}



   //  Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectCentroCostos()
	{
		$sql="SELECT cod_argumento AS id_cen_cost , des_larga AS  centro_costos FROM tabla_maestra_detalle where cod_tabla='TCCO' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador -  Implementar un método para listar los registros y mostrar en el select
	public function selectManoDeObra()
	{
		$sql="SELECT cod_argumento AS id_tip_man_ob , des_larga AS  tipo_mano_obra FROM tabla_maestra_detalle where cod_tabla='TTMO' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectSucursal()
	{
		$sql="SELECT cod_argumento AS id_sucursal , des_larga AS  sucursal_anexo FROM tabla_maestra_detalle where cod_tabla='TSUA' ";
		return ejecutarConsulta($sql);		
	}

	

	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectCategoriaLaboral()
	{
		$sql="SELECT cod_argumento AS id_categoria , des_larga AS  categoria_laboral FROM tabla_maestra_detalle where cod_tabla='TCAL' ORDER BY cod_argumento DESC ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectFormaDePago()
	{
		$sql="SELECT cod_argumento AS id_form_pag , des_larga AS  forma_pago FROM tabla_maestra_detalle where cod_tabla='TFOP' ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoContrato()
	{
		$sql="SELECT cod_argumento AS id_tip_cont , des_larga AS  tipo_contrato FROM tabla_maestra_detalle where cod_tabla='TCON' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectEstadoCivil()
	{
		$sql="SELECT cod_argumento AS id_est_civil, des_larga AS  estado_civil FROM tabla_maestra_detalle where cod_tabla='TECI' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}



	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectRegimenPensionario()
	{
		$sql="SELECT cod_argumento AS id_reg_pen, des_larga AS  regimen_pensionario FROM tabla_maestra_detalle where cod_tabla='TREP' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectComisionActual()
	{
		$sql="SELECT cod_argumento AS id_com_act, des_larga AS  comision_actual FROM tabla_maestra_detalle where cod_tabla='TTCA' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}



	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectGenero()
	{
		$sql="SELECT cod_argumento AS id_genero, des_larga AS  genero FROM tabla_maestra_detalle where cod_tabla='TGEN' ";
		return ejecutarConsulta($sql);		
	}



	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectTRegistro()
	{
		$sql="SELECT cod_argumento AS id_t_registro, des_larga AS  t_registro FROM tabla_maestra_detalle where cod_tabla='TTRE' ORDER BY cod_argumento ASC ";
		return ejecutarConsulta($sql);		
	}



	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectTurno()
	{
		$sql="SELECT cod_argumento AS id_turno, des_larga AS  turno FROM tabla_maestra_detalle where cod_tabla='TTUR' ";
		return ejecutarConsulta($sql);		
	}


    // Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectDistrito()
	{
		$sql="SELECT coddist AS id_distrito, Distrito AS  distrito FROM ubigeo where coddpto='15' AND codprov='01' ";
		return ejecutarConsulta($sql);		
	}


	// Vacaciones - Implementar un método para listar los registros y mostrar en el select
	public function selectTrabajadorVacaciones()
	{
		$sql="SELECT id_trab, num_doc_trab As id_nomtrab,  CONCAT(apepat_trab, ' ' , apemat_trab, ' ', nom_trab)    AS apellidosynombres 
		FROM Trabajador
		where id_tip_plan='1'";
		return ejecutarConsulta($sql);		
	}


	public function selectPeriodosVacaciones()
	{
		$sql="SELECT cod_argumento AS id_periodo , des_larga AS periodo 
		FROM tabla_maestra_detalle 
		where cod_tabla='TPEA'
		order by des_larga DESC ";
		return ejecutarConsulta($sql);		
	}


	// Prestamos - Implementar un método para listar los registros y mostrar en el select
	public function selectTrabajadoresActivos()
	{
		$sql="SELECT id_trab AS solicitante, id_trab, CONCAT(apepat_trab, ' ' , apemat_trab, ' ', SUBSTRING_INDEX(nom_trab, ' ', 1))    AS sol_apellidosynombres ,
		CONCAT(apepat_trab, ' ' , apemat_trab, ' ', SUBSTRING_INDEX(nom_trab, ' ', 1))    AS trabajador 
		FROM Trabajador
		where est_reg='1'";
		return ejecutarConsulta($sql);		
	}


	// Prestamos - Implementar un método para listar los registros y mostrar en el select
	public function selectTrabajadorPermisoAprobacion()
	{
		$sql="SELECT id_trab AS aprob_por,   CONCAT(apepat_trab, ' ' , apemat_trab, ' ', nom_trab   )    AS apro_apellidosynombres 
		FROM Trabajador
		where id_trab in ('11', '12', '103' , '37' )
		order by  apepat_trab DESC";
		return ejecutarConsulta($sql);		
	}




	// Prestamos - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoDsctoPrestamo()
	{
		$sql="SELECT cod_argumento as tip_dscto,  des_larga AS des_tip_dscto  FROM tabla_maestra_detalle
		where cod_tabla='TTPR'";
		return ejecutarConsulta($sql);		
	}



	// Prestamos - Implementar un método para listar los registros y mostrar en el select
	public function selectTipoAbono()
	{
		$sql="SELECT cod_argumento as tip_abono,  des_larga AS des_tip_abono  FROM tabla_maestra_detalle
		where cod_tabla='TTAB'";
		return ejecutarConsulta($sql);		
	}





	// Prestamos - Implementar un método para listar los registros y mostrar en el select
	public function selectModalidadPrestamo()
	{
		$sql="SELECT cod_argumento as modalidad,  des_larga AS des_modalidad  FROM tabla_maestra_detalle
		where cod_tabla='TMOD'";
		return ejecutarConsulta($sql);		
	}


	// Vacaciones - Implementar un método para listar los registros y mostrar en el select
	public function selectFechaAnualCronogramaPagos()
	{
		$sql="SELECT  TbPea.Cod_Argumento AS id_ano, TbPea.Des_Corta AS Ano
				FROM 	tabla_maestra_detalle TbPea 
				WHERE  TbPea.Cod_tabla='TPEA'
				ORDER BY   TbPea.Des_Corta DESC";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectGrupoSanguineo()
	{
		$sql="SELECT TbGsa.cod_argumento as id_gru_san,  TbGsa.des_larga AS grupo_sanguineo  
		FROM tabla_maestra_detalle TbGsa
		where TbGsa.cod_tabla='TGSA'
		order by TbGsa.cod_argumento ASC";
		return ejecutarConsulta($sql);		
	}


	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectSituacionInformativa()
	{
		$sql="SELECT TbSic.cod_argumento as id_sit_inf_act,  TbSic.des_larga AS situacion_informativa_actual ,
					TbSic.cod_argumento as id_sit_inf_ant,  TbSic.des_larga AS situacion_informativa_anterior   
		FROM tabla_maestra_detalle TbSic
		where TbSic.cod_tabla='TSIC'
		order by TbSic.cod_argumento ASC";
		return ejecutarConsulta($sql);		
	}



	// Trabajador - Implementar un método para listar los registros y mostrar en el select
	public function selectPagoEspecial()
	{
		$sql="SELECT TbMpe.cod_argumento as id_pag_esp,  TbMpe.des_larga AS pago_especial  
		FROM tabla_maestra_detalle TbMpe
		where TbMpe.cod_tabla='TMPE'
		order by TbMpe.cod_argumento ASC";
		return ejecutarConsulta($sql);		
	}






















	








}

?>