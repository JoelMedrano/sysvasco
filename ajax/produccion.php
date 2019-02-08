<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Produccion.php";

$produccion=new Produccion();

$idmov=isset($_POST["idmov"])? limpiarCadena($_POST["idmov"]):"";
$num_mov=isset($_POST["num_mov"])? limpiarCadena($_POST["num_mov"]):"";    
$cod_taller=isset($_POST["cod_taller"])? limpiarCadena($_POST["cod_taller"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$articulo=isset($_POST["articulo"])? limpiarCadena($_POST["articulo"]):"";
$cod_alm=isset($_POST["cod_alm"])? limpiarCadena($_POST["cod_alm"]):"";
$cod_cli=isset($_POST["cod_cli"])? limpiarCadena($_POST["cod_cli"]):"";
$idusuario=$_SESSION["idusuario"];


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_mov)){//SI id_mov no viene vacio

			if(empty($articulo)){//si articulo no viene vacio
				//sino pasa nada
			}else{

					$digito=substr($articulo, 0,1);

					

					if($digito=='0'){

						$rspta=$produccion->limpiarNulos();
						$rspta=$produccion->insertar8($num_mov,$cod_taller,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario);
						

						echo $rspta ? "$digito" : "error";
					
					}else{

						$rspta=$produccion->limpiarNulos();
						$rspta=$produccion->insertar7($num_mov,$cod_taller,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario);

						echo $rspta ? "$digito" : "error";

					}

				$Enum_nom=$_REQUEST["num_mov"];

					if($num_mov=$Enum_nom){//si num_del nuevo ingreso es igual al actual.

					$rspta=$produccion->limpiarMov($num_mov);
					$rspta=$produccion->insertarResumen($num_mov);

					}else{
						//sino no pasa nada
					}

			}

		}

	break;
	
	case 'limpiarNulos':
	$rspta=$produccion->limpiarNulos();
	 echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;
    

    case 'listarProd':
    
        $num_mov=$_REQUEST["num_mov"];
        
		$rspta=$produccion->listarProd($num_mov);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->num_mov,
 				"1"=>$reg->cod_taller,
				"2"=>$reg->cod_alm,
				
				"3"=>($reg->modelo)?'<b>'.$reg->modelo.'</b>':'<b>'.$reg->modelo.'</b>',
				"4"=>$reg->color,
				"5"=>($reg->t1>0)?'<span class="label bg-blue">'.$reg->t1.'</span>':'<span class="label bg-red"></span>',
				"6"=>($reg->t2>0)?'<span class="label bg-blue">'.$reg->t2.'</span>':'<span class="label bg-red"></span>',
				"7"=>($reg->t3>0)?'<span class="label bg-blue">'.$reg->t3.'</span>':'<span class="label bg-red"></span>',
				"8"=>($reg->t4>0)?'<span class="label bg-blue">'.$reg->t4.'</span>':'<span class="label bg-red"></span>',
				"9"=>($reg->t5>0)?'<span class="label bg-blue">'.$reg->t5.'</span>':'<span class="label bg-red"></span>',
				"10"=>($reg->t6>0)?'<span class="label bg-blue">'.$reg->t6.'</span>':'<span class="label bg-red"></span>',
				"11"=>($reg->t7>0)?'<span class="label bg-blue">'.$reg->t7.'</span>':'<span class="label bg-red"></span>',
				"12"=>($reg->t8>0)?'<span class="label bg-blue">'.$reg->t8.'</span>':'<span class="label bg-red"></span>',
				"13"=>($reg->subtotal>0)?'<span class="label bg-blue">'.$reg->subtotal.'</span>':'<span class="label bg-red"></span>'


 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectTaller":

	$rspta = $produccion->selectTaller();

	while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->cod_taller . '>' . $reg->nom_taller . '</option>';
			}
	break;
    
	case "selectAlmacen":

	$rspta = $produccion->selectAlmacen();

	while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->cod_alm . '>' . $reg->nom_alm . '</option>';
			}
	break;

	case 'listarDoc':

	$fecha_inicio=$_REQUEST["fecha_inicio"];
	$fecha_fin=$_REQUEST["fecha_fin"];

	$rspta=$produccion->listarDoc($fecha_inicio,$fecha_fin);
	 //Vamos a declarar un array
	 $data= Array();

	 while ($reg=$rspta->fetch_object()){
		 $data[]=array(
			 "0"=>$reg->cod_mov,
			 "1"=>$reg->num_mov,
			 "2"=>$reg->fecha,
			 "3"=>$reg->cantidad,
			 "4"=>($reg->estado=='0')?('<span class="label bg-yellow">POR APROBAR</span>'):(($reg->estado=='1')?('<span class="label bg-red">APROBADO</span>'):('<span class="label bg-green">RECHAZADO</span>'))
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