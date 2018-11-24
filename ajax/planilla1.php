<?php

if (strlen(session_id()) < 1)
  session_start();


require_once "../modelos/Planilla.php";

$planilla=new Planilla();

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$documento=isset($_POST["documento"])? limpiarCadena($_POST["documento"]):"";
$idusuario=$_SESSION["idusuario"];
$cliente=isset($_POST["cliente"])? limpiarCadena($_POST["cliente"]):"";
$nom_cliente=isset($_POST["nom_cliente"])? limpiarCadena($_POST["nom_cliente"]):"";
$vendedor=isset($_POST["vendedor"])? limpiarCadena($_POST["vendedor"]):"";
$und=isset($_POST["und"])? limpiarCadena($_POST["und"]):"";
$soles=isset($_POST["soles"])? limpiarCadena($_POST["soles"]):"";

switch ($_GET["op"]){

 

    case "selectFechaPago":
       

        $rspta = $planilla->selectFechaPago();

        while ($reg = $rspta->fetch_object())
                {
                    echo '<option value=' . $reg->fecha_pago . '>' . $reg->fecha . '</option>';
                }
    break;




}
?>
