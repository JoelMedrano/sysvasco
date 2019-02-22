<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Facturacion.php";

$facturacion=new Facturacion();

$idmov=isset($_POST["idmov"])? limpiarCadena($_POST["idmov"]):"";
$num_mov=isset($_POST["num_mov"])? limpiarCadena($_POST["num_mov"]):"";    
$cod_ven=isset($_POST["cod_ven"])? limpiarCadena($_POST["cod_ven"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$articulo=isset($_POST["articulo"])? limpiarCadena($_POST["articulo"]):"";
$cod_alm=isset($_POST["cod_alm"])? limpiarCadena($_POST["cod_alm"]):"";
$cod_cli=isset($_POST["cod_cli"])? limpiarCadena($_POST["cod_cli"]):"";

$nom_cli=isset($_POST["nom_cli"])? limpiarCadena($_POST["nom_cli"]):"";
$cod_ven=isset($_POST["cod_ven"])? limpiarCadena($_POST["cod_ven"]):"";
$cant_primera=isset($_POST["cant_primera"])? limpiarCadena($_POST["cant_primera"]):"";
$cant_segunda=isset($_POST["cant_segunda"])? limpiarCadena($_POST["cant_segunda"]):"";
$nom_ven=isset($_POST["nom_ven"])? limpiarCadena($_POST["nom_ven"]):"";


$idusuario=$_SESSION["idusuario"];
$nombre=$_SESSION["nombre"];

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_mov)){//SI id_mov no viene vacio

			if(empty($articulo)){//si articulo no viene vacio
				//sino pasa nada
			}else{

					$digito=substr($articulo, 0,1);

					

					if($digito=='0'){

						$rspta=$facturacion->limpiarNulos();
						$rspta=$facturacion->insertar8($num_mov,$cod_ven,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario);
						

						echo $rspta ? "$digito" : "error";
					
					}else{

						$rspta=$facturacion->limpiarNulos();
						$rspta=$facturacion->insertar7($num_mov,$cod_ven,$fecha_hora,$articulo,$cod_alm,$cod_cli,$idusuario);

						echo $rspta ? "$digito" : "error";

					}

				$Enum_nom=$_REQUEST["num_mov"];

					if($num_mov=$Enum_nom){//si num_del nuevo ingreso es igual al actual.

					$rspta=$facturacion->limpiarMov($num_mov);
					$rspta=$facturacion->insertarResumen($num_mov);

					}else{
						//sino no pasa nada
					}

			}

		}

	break;

	case 'mostrar':
	$rspta=$facturacion->mostrar($num_mov);
	//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'listarDetalle':
	//Recibimos el idingreso
	$id=$_GET['id'];

	$rspta = $facturacion->listarDetalle($id);
	$total=0;
	echo '<thead style="background-color:#A9D0F5">
																	<tr>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th>S</th>
																	<th>M</th>
																	<th>L</th>
																	<th>XL</th>
																	<th>XXL</th>
																	<th>XS</th>
																	<th></th>
																	<th></th>
																	<th></th>
																</tr>

																<tr>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th>28</th>
																	<th>30</th>
																	<th>32</th>
																	<th>34</th>
																	<th>36</th>
																	<th>38</th>
																	<th>40</th>
																	<th>42</th>
																	<th></th>
																</tr>

																<tr>
																	<th>Movimiento</th>
																	<th>Vendedor</th>
																	<th>Almacen</th>
																	<th>Modelo</th>
																	<th>Color</th>
																	<th>3</th>
																	<th>4</th>
																	<th>6</th>
																	<th>8</th>
																	<th>10</th>
																	<th>12</th>
																	<th>14</th>
																	<th>16</th>
																	<th>SUBTOTAL</th>
																</tr>
															</thead>';

	while ($reg = $rspta->fetch_object())
			{
				echo '<tr class="filas"><td>'.$reg->num_mov.'</td><td>'.$reg->cod_ven.'</td><td>'.$reg->cod_alm.'</td><td>'.$reg->modelo.'</td><td>'.$reg->color.'</td><td>'.$reg->t1.'</td><td>'.$reg->t2.'</td><td>'.$reg->t3.'</td><td>'.$reg->t4.'</td><td>'.$reg->t5.'</td><td>'.$reg->t6.'</td><td>'.$reg->t7.'</td><td>'.$reg->t8.'</td><td>'.$reg->subtotal.'</td></tr>';
				
			}
	echo '<tfoot>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th></th>
																	<th colspan="8"></th>
																	<th></th> 
															</tfoot>';
break;
	
	case 'limpiarNulos':
	$rspta=$facturacion->limpiarNulos();
	 echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
	break;
    

  case 'listarProd':
    
        $num_mov=$_REQUEST["num_mov"];
        
		$rspta=$facturacion->listarProd($num_mov);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->num_mov,
                "1"=>$reg->cod_ven,
                "2"=>($reg->modelo)?'<b>'.$reg->modelo.'</b>':'<b>'.$reg->modelo.'</b>',
				"3"=>$reg->color,
				"4"=>($reg->t1==0)?('<span class="label bg-yellow"></span>'):(($reg->s1<='0')?('<span class="label bg-blue">'.$reg->t1.'</span>'.' <span class="label bg-red">'.$reg->s1.'</span>'):('<span class="label bg-blue">'.$reg->t1.'</span>'.' <span class="label bg-green">'.$reg->s1.'</span>')),

				"5"=>($reg->t2==0)?('<span class="label bg-yellow"></span>'):(($reg->s2<='0')?('<span class="label bg-blue">'.$reg->t2.'</span>'.' <span class="label bg-red">'.$reg->s2.'</span>'):('<span class="label bg-blue">'.$reg->t2.'</span>'.' <span class="label bg-green">'.$reg->s2.'</span>')),

				"6"=>($reg->t3==0)?('<span class="label bg-yellow"></span>'):(($reg->s3<='0')?('<span class="label bg-blue">'.$reg->t3.'</span>'.' <span class="label bg-red">'.$reg->s3.'</span>'):('<span class="label bg-blue">'.$reg->t3.'</span>'.' <span class="label bg-green">'.$reg->s3.'</span>')),

				"7"=>($reg->t4==0)?('<span class="label bg-yellow"></span>'):(($reg->s4<='0')?('<span class="label bg-blue">'.$reg->t4.'</span>'.' <span class="label bg-red">'.$reg->s4.'</span>'):('<span class="label bg-blue">'.$reg->t4.'</span>'.' <span class="label bg-green">'.$reg->s4.'</span>')),

				"8"=>($reg->t5==0)?('<span class="label bg-yellow"></span>'):(($reg->s5<='0')?('<span class="label bg-blue">'.$reg->t5.'</span>'.' <span class="label bg-red">'.$reg->s5.'</span>'):('<span class="label bg-blue">'.$reg->t5.'</span>'.' <span class="label bg-green">'.$reg->s5.'</span>')),
				
				"9"=>($reg->t6==0)?('<span class="label bg-yellow"></span>'):(($reg->s6<='0')?('<span class="label bg-blue">'.$reg->t6.'</span>'.' <span class="label bg-red">'.$reg->s6.'</span>'):('<span class="label bg-blue">'.$reg->t6.'</span>'.' <span class="label bg-green">'.$reg->s6.'</span>')),

				"10"=>($reg->t7==0)?('<span class="label bg-yellow"></span>'):(($reg->s7<='0')?('<span class="label bg-blue">'.$reg->t7.'</span>'.' <span class="label bg-red">'.$reg->s7.'</span>'):('<span class="label bg-blue">'.$reg->t7.'</span>'.' <span class="label bg-green">'.$reg->s7.'</span>')),

				"11"=>($reg->t8==0)?('<span class="label bg-yellow"></span>'):(($reg->s8<='0')?('<span class="label bg-blue">'.$reg->t8.'</span>'.' <span class="label bg-red">'.$reg->s8.'</span>'):('<span class="label bg-blue">'.$reg->t8.'</span>'.' <span class="label bg-green">'.$reg->s8.'</span>')),

				"12"=>($reg->subtotal>0)?'<span class="label bg-blue">'.$reg->subtotal.'</span>':'<span class="label bg-red"></span>'

				//($reg->s1='0')?('<span class="label bg-yellow"></span>'):(($reg->s1<'0')?('<span class="label bg-red">INACTIVO</span>'):('<span class="label bg-green">ACTIVO</span>')),

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectVendedor":

	$rspta = $facturacion->selectVendedor();

	while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->cod_ven . '>' . $reg->nom_ven . '</option>';
			}
	break;

	case "selectTaller":

	$rspta = $facturacion->selectTaller();

	while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->cod_taller . '>' . $reg->nom_taller . '</option>';
			}
	break;
    
	case "selectAlmacen":

	$rspta = $facturacion->selectAlmacen();

	while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->cod_alm . '>' . $reg->nom_alm . '</option>';
			}
	break;

	case 'listarDoc':

	$fecha_inicio=$_REQUEST["fecha_inicio"];
	$fecha_fin=$_REQUEST["fecha_fin"];

	$rspta=$facturacion->listarDoc($fecha_inicio,$fecha_fin);
		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){

		$url='../reportes/rpt_Dev_NumMov.php?id=';

			$data[]=array(
			"0"=>$reg->cod_mov,
			"1"=>$reg->num_mov,
			"2"=>$reg->cod_cli,
			"3"=>$reg->nom_cli,
			"4"=>$reg->fecha,
			"5"=>$reg->cod_alm,
			"6"=>$reg->cantidad,
			"7"=>($reg->idusu_apro=='0')?'':$reg->nombre,
			"8"=>($reg->estado=='0')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->estado=='2')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),		
			"9"=>($reg->estado=='0')?('<button class="btn btn-success" onclick="aprobar(\''.$reg->num_mov.'\',\''.$reg->cod_alm.'\')"><i class="fa fa-check"></i></button>'.' <button class="btn btn-danger" onclick="rechazar(\''.$reg->num_mov.'\',\''.$reg->cod_alm.'\')"><i class="fa fa-times"></i></button>'):(($reg->estado=='1')?('<button class="btn btn-danger" onclick="rechazar(\''.$reg->num_mov.'\',\''.$reg->cod_alm.'\')"><i class="fa fa-times"></i></button>'):('<button class="btn btn-success" onclick="aprobar(\''.$reg->num_mov.'\',\''.$reg->cod_alm.'\')"><i class="fa fa-check"></i></button>')),			
			"10"=>($reg->estado=='0')?'<button class="btn btn-info" onclick="mostrar(\''.$reg->num_mov.'\')"><i class="fa fa-folder-open"></i></button>'.'<a target="_blank" href="'.$url.$reg->num_mov.'"> <button class="btn btn-primary"><i class="fa fa-download"></i></button></a>':'<button class="btn btn-info" onclick="mostrar(\''.$reg->num_mov.'\')"><i class="fa fa-folder-open"></i></button>'.'<a target="_blank" href="'.$url.$reg->num_mov.'"> <button class="btn btn-primary"><i class="fa fa-download"></i></button></a>'


				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);

	break;


	case 'aprobar':
		$rspta=$facturacion->aprobar($num_mov,$cod_alm,$idusuario);
		echo $rspta ? "Documento aprobado por: ".$nombre : "Documento no se pudo aprobar";
	break;

	case 'rechazar':
		$rspta=$facturacion->rechazar($num_mov,$cod_alm,$idusuario);
		echo $rspta ? "Documento rechazado por: ".$nombre : "Documento no se pudo rechazar";
	break;



}
?>