<?php 
require_once "../modelos/Reloj.php";
session_start();

$reloj=new Reloj();


//Campos de Seguridad//
$usu_reg=$_SESSION['login'];
$pc_reg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fec_emi =  date("d/m/Y H:i:s");
$fec_reg = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fec_emi)));
//Campos de Seguridad//


$fecha = date("Y-m-d",strtotime(str_replace('/','-',$fec_emi)));
$hora = date("H:i:s",strtotime(str_replace('/','-',$fec_emi)));
$dia_texto =  date('l');
$estado_horario =  date('a');


  if ($dia_texto=='Saturday'){
  	$dia='S';
 }else if($dia_texto=='Sunday'){
 	$dia='D';
 }else{
 	$dia='C'; 
 }



 if($estado_horario=='am'){
  $est_hor='D';
 }else if($estado_horario=='pm'){
  $est_hor='N';
 }



$id_trab=isset($_POST["id_trab"])? limpiarCadena($_POST["id_trab"]):"";

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

	

        $codigo_ingresado=$reloj->consultar($id_trab, $fecha);
        $regc=$codigo_ingresado->fetch_object();
        $codigo=$regc->id_trab;

        $data_personal=$reloj->consultarDataPersonal($id_trab);
        $dp=$data_personal->fetch_object();
        $id_tip_plan=$dp->id_tip_plan;
        $id_turno=$dp->id_turno;

		//Declaramos el array para almacenar todos los permisos marcados


		 	if ($codigo=='') {
         	   $rspta=$reloj->insertar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora, $id_tip_plan,  $dia, $est_hor, $id_turno); 
			    echo $rspta ? "Marcación registrada" : "Marcación no se pudo registrar";
            }else{
         	  $rspta=$reloj->editar($id_trab, $fecha, $fec_reg, $pc_reg, $usu_reg, $hora); 
			    echo $rspta ? "Marcación registrada" : "Marcación no se pudo actualizar";
            }
			
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>