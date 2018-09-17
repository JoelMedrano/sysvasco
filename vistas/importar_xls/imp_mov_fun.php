<?php
function insertar_datos($tipo,$documento,$taller,$fecha,$articulo,$almacen,$linea,$cliente,$nom_cliente,$vendedor,$cantidad,$precio,$dscto1,$dscto2,$total,$nombre_tipo){
	
	global $conexion;
	
	$sentencia = "INSERT INTO movimientosjf(tipo,documento,taller,fecha,articulo,almacen,linea,cliente,nom_cliente,vendedor,cantidad,precio,dscto1,dscto2,total,nombre_tipo) VALUES ('$tipo','$documento','$taller','$fecha','$articulo','$almacen','$linea','$cliente','$nom_cliente','$vendedor','$cantidad','$precio','$dscto1','$dscto2','$total','$nombre_tipo')";

	$ejecutar = mysqli_query($conexion,$sentencia);
 	
 	return $ejecutar;


}

 function borrar_datos()
 {
  global $conexion;
  $sentencia = "DELETE FROM movimientosjf WHERE fecha=CURDATE()";
  $ejecutar = mysqli_query($conexion,$sentencia);
  return $ejecutar;
 }
?>
