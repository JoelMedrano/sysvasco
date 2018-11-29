<?php
require_once "../modelos/ConsultasJ.php";

$consultaj=new ConsultasJ();


switch ($_GET["op"]){

    case 'listarTardanzas':
    $rspta=$consultaj->listarTardanzas();
     //Vamos a declarar un array
     $data= Array();

     while ($reg=$rspta->fetch_object()){
         $data[]=array(
             "0"=>$reg->id_trab,
             "1"=>$reg->trabajador,
             "2"=>$reg->fecha,
             "3"=>$reg->hor_ent
             );
     }
     $results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
     echo json_encode($results);

    break;


}
?>
