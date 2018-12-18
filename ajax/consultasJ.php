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
             "1"=>$reg->nombres,
             "2"=>($reg->tipo_planilla=='PLANILLA')?'<span class="label label-primary">PLANILLA</span>':'<span class="label label-success">INTERNO</span>',
             "3"=>$reg->sucursal_anexo,
             "4"=>$reg->funcion,
             "5"=>$reg->area_trab,
             "6"=>($reg->incidencia=="TARDANZA")?('<span class="label label-warning">TARDANZA</span>'):(($reg->incidencia=='FALTA')?('<span class="label label-danger">FALTA</span>'):('<span class="label label-info">('.$reg->incidencia.')</span>')),
             "7"=>$reg->hor_ent
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
