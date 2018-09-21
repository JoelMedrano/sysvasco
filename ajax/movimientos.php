<?php

if (strlen(session_id()) < 1)
  session_start();


require_once "../modelos/Movimientos.php";

$movimiento=new Movimientos();

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

  case 'mostrar':
    $rspta=$movimiento->mostrar($documento);
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
  break;


	case 'movsfecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$movimiento->movsfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->mes,
        "2"=>($reg->mes)?'<button class="btn btn-danger" onclick="eliminar(\''.$reg->fecha.'\')"><i class="fa fa-trash"></i></button>':' <button class="btn btn-danger" onclick="eliminar('.$reg->fecha.')"><i class="fa fa-trash"></i></button>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'eliminar':
    $rspta=$movimiento->eliminar($fecha);
    echo $rspta ? "Fecha eliminada" : "Fecha no se puede eliminar";
  break;

	case "selectTipo":

		$rspta = $movimiento->selectTipo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tipo . '>' . $reg->descripcion . '</option>';
				}
	break;


	case 'movstipo':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$tipo=$_REQUEST["tipo"];

		$rspta=$movimiento->movstipo($fecha_inicio,$fecha_fin,$tipo);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->tipo,
 				"1"=>$reg->fecha,
 				"2"=>$reg->taller,
 				"3"=>$reg->documento,
 				"4"=>$reg->almacen,
 				"5"=>$reg->modelo,
				"6"=>$reg->color,
 				"7"=>($reg->t1>0)?'<span class="label bg-blue">'.$reg->t1.'</span>':'<span class="label bg-red"></span>',
				"8"=>($reg->t2>0)?'<span class="label bg-blue">'.$reg->t2.'</span>':'<span class="label bg-red"></span>',
				"9"=>($reg->t3>0)?'<span class="label bg-blue">'.$reg->t3.'</span>':'<span class="label bg-red"></span>',
				"10"=>($reg->t4>0)?'<span class="label bg-blue">'.$reg->t4.'</span>':'<span class="label bg-red"></span>',
				"11"=>($reg->t5>0)?'<span class="label bg-blue">'.$reg->t5.'</span>':'<span class="label bg-red"></span>',
				"12"=>($reg->t6>0)?'<span class="label bg-blue">'.$reg->t6.'</span>':'<span class="label bg-red"></span>',
				"13"=>($reg->t7>0)?'<span class="label bg-blue">'.$reg->t7.'</span>':'<span class="label bg-red"></span>',
				"14"=>($reg->t8>0)?'<span class="label bg-blue">'.$reg->t8.'</span>':'<span class="label bg-red"></span>'



 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarFacturas':
		$rspta=$movimiento->listarFacturas();

		//Vamos a declarar un array
		$data= Array();

		while ($reg=$rspta->fetch_object()){

			$data[]=array(

				"0"=>$reg->tipo,
				"1"=>$reg->documento,
				"2"=>$reg->fecha,
				"3"=>$reg->codigo,
				"4"=>$reg->nom_cliente,
				"5"=>($reg->peso>0)?'<span class="label bg-black">'.$reg->peso.' KG'.'</span>':'<span class="label bg-red"></span>',
				"6"=>($reg->rev_doc=='por aprobar')?('<span class="label bg-yellow">Por Aprobar</span>'):(($reg->rev_doc=='rechazado')?('<span class="label bg-red">Rechazado</span>'):('<span class="label bg-green">Aprobado</span>')),
				"7"=>($reg->rev_doc=='por aprobar')?('<button class="btn btn-success" onclick="aprobarPedido(\''.$reg->documento.'\')"><i class="fa fa-check"></i></button>'.' <button class="btn btn-danger" onclick="rechazarPedido(\''.$reg->documento.'\')"><i class="fa fa-ban"></i></button>'.' <button class="btn btn-info" onclick="mostrar(\''.$reg->documento.'\')"><i class="fa fa-search-plus"></i></button>'):
							 (($reg->rev_doc=='rechazado')?('<button class="btn btn-success" onclick="aprobarPedido(\''.$reg->documento.'\')"><i class="fa fa-check"></i></button>'.' <button class="btn btn-info" onclick="mostrar(\''.$reg->documento.'\')"><i class="fa fa-search-plus"></i></button>'):('<button class="btn btn-danger" onclick="rechazarPedido(\''.$reg->documento.'\')"><i class="fa fa-ban"></i></button>'.' <button class="btn btn-info" onclick="mostrar(\''.$reg->documento.'\')"><i class="fa fa-search-plus"></i></button>'))



				);
		}
		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);

	break;

	case 'aprobarPedido':
		$rspta=$movimiento->aprobarPedido($documento,$idusuario);
		echo $rspta ? "Documento aprobado" : "Documento no se puede aprobar";
	break;

	case 'rechazarPedido':
		$rspta=$movimiento->rechazarPedido($documento,$idusuario);
		echo $rspta ? "Documento rechazado" : "Documento no se puede rechazar";
	break;

  case 'listarDetalle':
    //Recibimos el idingreso
    $id=$_GET['id'];

    $rspta = $movimiento->listarDetalle($id);
    $total=0;
    echo '<thead style="background-color:#A9D0F5">
                                  <tr>
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
                                    <th>Opciones</th>
                                    <th>Modelo</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>6</th>
                                    <th>8</th>
                                    <th>10</th>
                                    <th>12</th>
                                    <th>14</th>
                                    <th>16</th>
                                    <th>Subtotal</th>
                                  </tr>
                                </thead>';

    while ($reg = $rspta->fetch_object())
        {
          echo '<tr class="filas">
            <td></td>
            <td>'.$reg->modelo.'</td>
            <td>'.$reg->nombre.'</td>
            <td>'.$reg->color.'</td>
            <td><span class="label bg-blue">'.$reg->t1.'</span></td>
            <td><span class="label bg-blue">'.$reg->t2.'</span></td>
            <td><span class="label bg-blue">'.$reg->t3.'</span></td>
            <td><span class="label bg-blue">'.$reg->t4.'</span></td>
            <td><span class="label bg-blue">'.$reg->t5.'</span></td>
            <td><span class="label bg-blue">'.$reg->t6.'</span></td>
            <td><span class="label bg-blue">'.$reg->t7.'</span></td>
            <td><span class="label bg-blue">'.$reg->t8.'</span></td>
            <td><span class="label bg-black">'.$reg->subtotal.'</span></td>
          </tr>';
          $total=$total+($reg->t1+$reg->t2+$reg->t3+$reg->t4+$reg->t5+$reg->t6+$reg->t7+$reg->t8);
        }
    echo '<tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total"><span class="label bg-black">'.$total.' Unidades</h4><input type="hidden" name="total_cotizacion" id="total_cotizacion"></th>
                                </tfoot>';
  break;



}
?>
