<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Compensacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcategoria)
	{
		$sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT    tr.id_trab,
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
                        'TR' AS TR 
                        FROM
                        trabajador tr 
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
                        ORDER BY tr.apepat_trab ASC";

        return ejecutarConsulta($sql);		

        }

}

?>