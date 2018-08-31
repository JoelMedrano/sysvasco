<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Detalle_Cotizacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcotizacion,$idarticulo,$cantidad,$precio_cotizacion)
	{
		$sql="INSERT INTO detalle_cotizacion (idcotizacion,idarticulo,cantidad,precio_cotizacion)
		VALUES ('$idcotizacion','$idarticulo','$cantidad','$precio_cotizacion')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($iddetalle_cotizacion,$idarticulo,$cantidad,$precio_cotizacion)
	{
		$sql="UPDATE detalle_cotizacion SET idarticulo='$idarticulo',cantidad='$cantidad',precio_cotizacion='$precio_cotizacion' WHERE iddetalle_cotizacion='$iddetalle_cotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function eliminar($iddetalle_cotizacion)
	{
		$sql="DELETE FROM detalle_cotizacion WHERE iddetalle_cotizacion='$iddetalle_cotizacion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($iddetalle_cotizacion)
	{
		$sql="SELECT			c.idcotizacion,
											c.cod_mod,
											dc.iddetalle_cotizacion,
											dc.idarticulo,
											dc.cantidad,
											dc.precio_cotizacion,
											dc.descuento
											FROM cotizacion c
											LEFT JOIN detalle_cotizacion dc
											ON c.idcotizacion=dc.idcotizacion
										 	WHERE dc.iddetalle_cotizacion='$iddetalle_cotizacion'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT  c.idcotizacion,
                  c.cod_mod,
                  dc.iddetalle_cotizacion,
                  dc.idarticulo,
                  dc.nombre,
                  dc.cantidad,
                  dc.precio_cotizacion,
                  IFNULL(ROUND((dc.cantidad*dc.precio_cotizacion-dc.descuento),6),0) AS subtotal,
									c.editable
                  FROM cotizacion c
                  LEFT JOIN
                    (SELECT
                    dc.idcotizacion,
                    dc.iddetalle_cotizacion,
                    dc.idarticulo,
                    mp.nombre,
                    dc.cantidad,
                    dc.precio_cotizacion,
                    dc.descuento,
                    (dc.cantidad*dc.precio_cotizacion-dc.descuento) AS subtotal
                    FROM detalle_cotizacion dc
                    LEFT JOIN
                      (SELECT
                      SUBSTRING(pro.codfab,1,6) AS id_articulo,
                      tmd.des_larga AS nombre,
                      tmd.des_corta AS cod_linea,
                      lin.linea,
                      und.unidad,
                      pre.precio
                      FROM producto pro
                      LEFT JOIN tabla_m_detalle AS tmd
                      ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
                      LEFT JOIN
                        (SELECT
                        SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
                        tmd.des_larga AS linea,
                        tmd.des_corta AS cod_linea
                        FROM producto pro
                        LEFT JOIN tabla_m_detalle AS tmd
                        ON LEFT(pro.codfab,3)=tmd.des_corta
                        WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
                        GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
                      ON SUBSTRING(pro.codfab,1,6)=cod_sublinea
                      LEFT JOIN
                        (SELECT
                        SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
                        tmd.des_corta AS unidad
                        FROM producto pro
                        LEFT JOIN tabla_m_detalle AS tmd
                        ON pro.undpro=tmd.cod_argumento
                        WHERE pro.estpro='1' AND tmd.cod_tabla='tund'
                        GROUP BY SUBSTRING(pro.CodFab,1,6)) AS und
                      ON SUBSTRING(pro.codfab,1,6)=und.cod_sublinea
                      LEFT JOIN
                        (SELECT
                        SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
                        MAX(GREATEST(
                        CASE
                        WHEN pmp.monprov1='DOLARES AMERICANOS' THEN pmp.preprov1*3.3
                        ELSE pmp.preprov1 END,
                        CASE
                        WHEN pmp.monprov2='DOLARES AMERICANOS' THEN pmp.preprov2*3.3
                        ELSE pmp.preprov2 END,
                        CASE
                        WHEN pmp.monprov3='DOLARES AMERICANOS' THEN pmp.preprov3*3.3
                        ELSE pmp.preprov3 END)) AS precio
                        FROM preciomp pmp
                        LEFT JOIN producto pro
                        ON pmp.codpro=pro.codpro
                        WHERE pro.estpro='1'
                        GROUP BY SUBSTRING(pro.CodFab,1,6)) AS pre
                      ON SUBSTRING(pro.codfab,1,6)=pre.cod_sublinea
                      WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea
                      GROUP BY SUBSTRING(pro.CodFab,1,6)) AS mp
                    ON dc.idarticulo=mp.id_articulo) AS dc
                  ON c.idcotizacion=dc.idcotizacion
                  WHERE c.editable='1'";

		return ejecutarConsulta($sql);
	}

}

?>
