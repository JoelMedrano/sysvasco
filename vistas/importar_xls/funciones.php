<?php
 function insertar_datos($ruc,$nombre,$fecha,$saldo){
 		global $conexion;
 	$sentencia = "insert into cliente (ruc,nombrecliente,fecha,saldo) values ($ruc,'$nombre','$fecha','$saldo')";
 	$ejecutar = mysqli_query($conexion,$sentencia);
 	return $ejecutar;
 }

 function borrar_datos()
 {
  global $conexion;
  $sentencia = "delete from cliente";
  $ejecutar = mysqli_query($conexion,$sentencia);
  return $ejecutar;
 }
?>
