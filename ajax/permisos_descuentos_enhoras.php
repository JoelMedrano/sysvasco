<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Permisos_Descuentos_Enhoras.php";

$pde=new Permisos_Descuentos_Enhoras();



$id_cp=isset($_POST["id_cp"])? limpiarCadena($_POST["id_cp"]):"";


switch ($_GET["op"]){

  case 'guardaryeditar':

    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
    {
      $imagen=$_POST["imagenactual_imagen"];
    }
    else
    {
      $ext = explode(".", $_FILES["imagen"]["name"]);
      if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
      {
        $imagen = round(microtime(true)) . '.' . end($ext);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/fichas_tecnicas/" . $imagen);
      }
    }




    if (!file_exists($_FILES['imagen2']['tmp_name']) || !is_uploaded_file($_FILES['imagen2']['tmp_name']))
    {
      $imagen2=$_POST["imagenactual_imagen2"];
    }
    else
    {
      $ext = explode(".", $_FILES["imagen2"]["name"]);
      if ($_FILES['imagen2']['type'] == "image/jpg" || $_FILES['imagen2']['type'] == "image/jpeg" || $_FILES['imagen2']['type'] == "image/png")
      {
        $imagen2 = round(microtime(true)) .'2'. '.' . end($ext);
        move_uploaded_file($_FILES["imagen2"]["tmp_name"], "../files/fichas_tecnicas/" . $imagen2);
      }
    }



    if (empty($idmft)){
      $rspta=$pde->insertar(    $idusuario,
    														$fecha_hora,
    														$empresa,
    														$cod_mod,
    														$tallas_mod,
    														$temp_mod,
    														$div_mod,
    														$dest_mod,
    														$id_trab,
    														$color_mod,
    														$tela1_mod,
    														$tela2_mod,
    														$tela3_mod,
    														$bord_mod,
    														$esta_mod,
    														$manu_mod,
    														$imagen,
    														$imagen2,
                                $_POST['color']);
      echo $rspta ? "FT registrada" : "No se pudieron registrar todos los datos de la FT";
    }
    else {
      $rspta=$pde->editar(	    $idmft,
      													$id_trab,
      													$empresa,
      													$color_mod,
      													$tallas_mod,
      													$div_mod,
      													$temp_mod,
      													$dest_mod,
      													$tela1_mod,
      													$tela2_mod,
      													$tela3_mod,
      													$bord_mod,
      													$esta_mod,
      													$manu_mod,
      													$imagen,
      													$imagen2,
                                $_POST['color']);
        echo $rspta ? "FT actualizada" : "FT no se pudo actualizar";
    }
  break;


  case 'listar':
    $rspta=$pde->listar();
    //Vamos a declarar un array
    $data= Array();

    while ($reg=$rspta->fetch_object()){
      

      $data[]=array(
        "0"=>$reg->pd,
        "1"=>$reg->Ano,
        "2"=>$reg->Descrip_fec_pag,
        "3"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cp.')"><i class="fa fa-pencil"></i></button>'
        );
    }
    $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);

  break;




  case 'mostrar':
    $rspta=$pde->mostrar($id_cp);
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
  break;


  case 'colores':
    //Obtenemos todos los permisos de la tabla permisos

  
   
    $rspta = $pde->faltas_permisos_horas($id_cp);

    
    //Declaramos el array para almacenar todos los permisos marcados
    $valores=array();

    

  //Mostramos la lista de permisos en la vista y si están o no marcados
  while ($reg = $rspta->fetch_object())
        {
          $sw=in_array($reg->id_hor_per,$valores)?'checked':'';
          echo '<li> <input type="checkbox" '.$sw.'  name="id_hor_per[]" value="'.$reg->id_hor_per.'">'.$reg->sit.'</li>';
        }
  break;


  case 'rechazar':
    $rspta=$pde->rechazar($idmft);
    echo $rspta ? "FT rechazada" : "FT no se puede rechazar";
  break;

  case 'aprobar':
    $rspta=$pde->aprobar($idmft,$idusuario);
    echo $rspta ? "FT aprobada" : "FT no se puede aprobar";
  break;

  case 'eliminar':
    $rspta=$pde->eliminar($idmft);
    echo $rspta ? "FT lista para eliminar" : "FT no se puede eliminar";
  break;



}
?>
