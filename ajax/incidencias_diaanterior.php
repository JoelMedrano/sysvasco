<?php
require_once "../modelos/IncidenciasDiaAnterior.php";

$incidencia=new Incidencia();



switch ($_GET["op"]){

    case 'listarIncidenciasDiaAnterior':
    $rspta=$incidencia->listarIncidenciasDiaAnterior();
     //Vamos a declarar un array
     $data= Array();

     while ($reg=$rspta->fetch_object()){
         $data[]=array(
             "0"=>$reg->fecha,
             "1"=>$reg->apellidosynombres,
             "2"=>$reg->hor_sal,
             "3"=>$reg->seg_hor_sal,
             "4"=>$reg->incidencia
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
