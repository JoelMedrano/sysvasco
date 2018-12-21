<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Compensacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    
	
	public function insertar($id_trab,$id_hor_per,$hor_per,$id_hor_ext,$hor_ext,$total)
	{
        
        $sql="INSERT INTO compensacion (id_trab,id_hor_per,hor_per,id_hor_ext,hor_ext,total)
        VALUES ('$id_trab','$id_hor_per','$hor_per','$id_hor_ext','$hor_ext','$total')";
        
		return ejecutarConsulta($sql);

    }
    
    public function UpdPermiso($id_trab,$id_hor_per,$total)
    {
        $sql="UPDATE horas_permiso_personal SET tiempo_fin='$total' WHERE id_trab='$id_trab' AND id_hor_per='$id_hor_per';";

        return ejecutarConsulta($sql);
    }

    public function UpdExtra($id_trab,$id_hor_ext,$total)
    {
        $sql="UPDATE horas_extras_personal SET tiempo_fin='$total' WHERE id_trab='$id_trab' AND id_hor_ext='$id_hor_ext';";

        return ejecutarConsulta($sql);
    }

    public function evaluarHoras($id_hor_per,$id_hor_ext)
    {
        $sql="SELECT 
        hpp.id_trab,
        hpp.id_hor_per,
        hpp.tiempo_fin,
        hep.id_hor_ext,
        hep.tiempo_fin,
        CASE
          WHEN hpp.tiempo_fin < hep.tiempo_fin 
          THEN '-1' 
          ELSE '1' 
        END AS dif 
      FROM
        horas_permiso_personal hpp 
        LEFT JOIN horas_extras_personal hep 
          ON hpp.id_trab = hep.id_trab 
      WHERE hpp.id_hor_per = '$id_hor_per' 
        AND hep.id_hor_ext = '$id_hor_ext'";

        return ejecutarConsulta($sql);
    }

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_trab)
	{
		$sql="SELECT * FROM trabajador t WHERE t.id_trab='$id_trab'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT   '' AS comp,
                        tr.id_trab,
                        CONCAT_WS(
                            ' ',
                            tr.apepat_trab,
                            tr.apemat_trab,
                            tr.nom_trab
                        ) AS nombres,
                        tpla.des_larga AS tipo_planilla,
                        tsua.des_larga AS sucursal_anexo,
                        tfun.des_larga AS funcion,
                        tare.des_larga AS area_trab,
                        tr.est_reg,
                        tr.num_doc_trab,
                        'TR' AS TR ,
                        DATE_FORMAT(co.fecha , '%d/%m/%Y') AS fecha_registro
                        FROM compensacion AS co
                        LEFT JOIN trabajador tr ON 
                            tr.id_trab= co.id_trab
                        LEFT JOIN tabla_maestra_detalle AS tpla 
                            ON tpla.cod_argumento = tr.id_tip_plan 
                            AND tpla.cod_tabla = 'TPLA' 
                        LEFT JOIN tabla_maestra_detalle AS tsua 
                            ON tsua.cod_argumento = tr.id_sucursal 
                            AND tsua.cod_tabla = 'TSUA' 
                        LEFT JOIN tabla_maestra_detalle AS tfun 
                            ON tfun.cod_argumento = tr.id_funcion 
                            AND tfun.cod_tabla = 'TFUN' 
                        LEFT JOIN tabla_maestra_detalle AS tare 
                            ON tare.cod_argumento = tr.id_area 
                            AND tare.cod_tabla = 'TARE' 
                        WHERE tr.est_reg = '1' 
                        ORDER BY co.fecha  DESC";

        return ejecutarConsulta($sql);		

    }

    public function selectTrab()
    {
        $sql="SELECT 
                        t.id_trab,
                        CONCAT(t.id_trab,' - ',
                        t.apepat_trab,
                        ' ',
                        t.apemat_trab,
                        ' ',
                        SUBSTRING_INDEX(t.nom_trab, ' ', 1)
                        ) AS nombres 
                    FROM
                        trabajador t";

        return ejecutarConsulta($sql);
    }


    //TODO: QUERY SELECT TARDANZAS
    public function selectTardanza($id_trab)
    {
        $sql="SELECT 
                        hpp.id_hor_per,
                        CONCAT(
                            hpp.id_hor_per,
                            ' - ',
                            hpp.fecha,
                            ' - ',
                            tr.id_trab,
                            ' - ',
                            tr.nombres,
                            ' - ',
                            hpp.tiempo_fin,
                            ' - ',
                            hpp.observacion
                        ) AS tardanza,
                        hpp.fecha,
                        tr.id_trab,
                        tr.nombres,
                        hpp.tiempo_fin,
                        hpp.observacion,
                        IF(
                            hpp.descontar = '1',
                            'X DESCONTAR',
                            'NO DESCONTAR'
                        ) AS situacion,
                        IF(
                            hpp.descontado = '2',
                            'NO DESCONTADO',
                            'DESCONTADO'
                        ) AS estado 
                        FROM
                        horas_permiso_personal hpp 
                        LEFT JOIN 
                            (SELECT 
                            tr.id_trab,
                            CONCAT(
                                tr.apepat_trab,
                                ' ',
                                tr.apemat_trab,
                                ' ',
                                SUBSTRING_INDEX(tr.nom_trab, ' ', 1)
                            ) AS nombres 
                            FROM
                            trabajador tr) AS tr 
                            ON tr.id_trab = hpp.id_trab 
                        LEFT JOIN 
                            (SELECT 
                            pp.id_trab,
                            pp.tip_permiso,
                            pp.fecha_procede,
                            TbPer.Des_Larga AS Permiso,
                            pp.motivo 
                            FROM
                            permiso_personal pp 
                            LEFT JOIN tabla_maestra_detalle Tbper 
                                ON TbPer.des_corta = pp.tip_permiso) AS pp 
                            ON pp.id_trab = hpp.id_trab 
                            AND pp.fecha_procede = hpp.fecha 
                        WHERE hpp.id_incidencia IN ('1', '2') 
                        AND hpp.descontado = '2' 
                        AND hpp.descontar = '1' 
                        AND tr.id_trab = '$id_trab'
                        AND  hpp.tiempo_fin <> '00:00:00'";

        return ejecutarConsulta($sql);
    }

    //TODO: select para horas de tardanzas

    public function selectHorasT($id_trab,$id_hor_per)
    {
        $sql="SELECT 
                        tr.id_trab,
                        hpp.id_hor_per,
                        hpp.fecha,
                        hpp.tiempo_fin 
                    FROM
                        horas_permiso_personal hpp 
                        LEFT JOIN 
                        (SELECT 
                            tr.id_trab,
                            CONCAT(
                            tr.apepat_trab,
                            ' ',
                            tr.apemat_trab,
                            ' ',
                            SUBSTRING_INDEX(tr.nom_trab, ' ', 1)
                            ) AS nombres 
                        FROM
                            trabajador tr) AS tr 
                        ON tr.id_trab = hpp.id_trab 
                    WHERE hpp.id_incidencia IN ('1', '2') 
                        AND hpp.descontado = '2' 
                        AND hpp.descontar = '1' 
                        AND tr.id_trab = '$id_trab' 
                        AND hpp.id_hor_per = '$id_hor_per'";

        return ejecutarConsulta($sql);
    }

    //TODO: SELECT HORAS EXTRA
    public function selectExtras($id_trab)
    {
        $sql="SELECT DISTINCT 
        hep.id_hor_ext,
        DATE_FORMAT(hep.fecha, '%d/%m/%Y') AS fecha,
        CONCAT(
          hep.id_hor_ext,
          ' - ',
          hep.fecha,
          ' - ',
          tr.id_trab,
          ' - ',
          tr.nombres,
          ' - ',
          hep.tiempo_fin,
          ' - ',
          hep.observacion
        ) AS extra,
        tr.id_trab,
        tr.nombres,
        hep.tiempo_fin,
        fe.estado AS estado_dia,
        hep.por_pago,
        hep.observacion,
        IF(
          hep.abonar = '1',
          'X ABONAR',
          'NO ABONAR'
        ) AS situacion,
        IF(
          hep.abonado = '2',
          'NO ABONADO',
          'ABONADO'
        ) AS estado 
      FROM
        horas_extras_personal hep 
        LEFT JOIN 
          (SELECT 
            tr.id_trab,
            CONCAT(
              tr.apepat_trab,
              ' ',
              tr.apemat_trab,
              ' ',
              SUBSTRING_INDEX(tr.nom_trab, ' ', 1)
            ) AS nombres 
          FROM
            trabajador tr) AS tr 
          ON tr.id_trab = hep.id_trab 
        LEFT JOIN fechas fe 
          ON fe.fecha = hep.fecha 
        LEFT JOIN 
          (SELECT 
            COUNT(hep.id_hor_ext) AS num,
            hep.id_fec_abono 
          FROM
            horas_extras_personal hep) AS ff 
          ON ff.id_fec_abono = hep.id_fec_abono 
      WHERE hep.abonar = '1' 
        AND hep.abonado = '2' 
        AND tr.id_trab = '$id_trab'
        AND hep.tiempo_fin<>'00:00:00'";

        return ejecutarConsulta($sql);
    }

    public function selectHorasE($id_trab,$id_hor_ext)
    {
        $sql="SELECT DISTINCT 
                        tr.id_trab,
                        hep.id_hor_ext,
                        DATE_FORMAT(hep.fecha, '%d/%m/%Y') AS fecha,
                        hep.tiempo_fin 
                        FROM
                        horas_extras_personal hep 
                        LEFT JOIN 
                            (SELECT 
                            tr.id_trab,
                            CONCAT(
                                tr.apepat_trab,
                                ' ',
                                tr.apemat_trab,
                                ' ',
                                SUBSTRING_INDEX(tr.nom_trab, ' ', 1)
                            ) AS nombres 
                            FROM
                            trabajador tr) AS tr 
                            ON tr.id_trab = hep.id_trab 
                        LEFT JOIN fechas fe 
                            ON fe.fecha = hep.fecha 
                        LEFT JOIN 
                            (SELECT 
                            COUNT(hep.id_hor_ext) AS num,
                            hep.id_fec_abono 
                            FROM
                            horas_extras_personal hep) AS ff 
                            ON ff.id_fec_abono = hep.id_fec_abono 
                        WHERE hep.abonar = '1' 
                        AND hep.abonado = '2' 
                        AND tr.id_trab = '$id_trab' 
                        AND hep.id_hor_ext = '$id_hor_ext'";

        return ejecutarConsulta($sql);
    }

}

?>