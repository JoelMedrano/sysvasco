<?php

   session_start();

header('Content-Type: text/html; charset=ISO-8859-1');



$idcotizacion = $_GET["id"];



//ajuntar la libreria excel
include "Classes/PHPExcel.php";
//include "../library/consulSQL.php";

 $conexion=mysql_connect("192.168.1.24","admin","vasco123");
    mysql_select_db("db_corpvasco",$conexion);

      $fechaactual = getdate();
        // print_r($fechaactual);
        $fecha="$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

        //$UsuReg=$_SESSION['usuario']['Login'];



$objPHPExcel = new PHPExcel(); //nueva instancia

$objPHPExcel->getProperties()->setCreator("Joel"); //autor
$objPHPExcel->getProperties()->setTitle("COTIZACION"); //titulo

//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));

//inicio estilos
$titulo2 = new PHPExcel_Style(); //nuevo estilo
$titulo2->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 12
    )
));


//inicio estilos
$titulo3 = new PHPExcel_Style(); //nuevo estilo
$titulo3->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 14
    )
));


$observaciones = new PHPExcel_Style(); //nuevo estilo
$observaciones->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 8
    )
));

$subtitulo = new PHPExcel_Style(); //nuevo estilo
$subtitulo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FF3399FF')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));

$subtitulo2 = new PHPExcel_Style(); //nuevo estilo
$subtitulo2->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FF3399FF')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));

$subtitulo3 = new PHPExcel_Style(); //nuevo estilo
$subtitulo3->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => '#D4E6F1')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));





$bordes = new PHPExcel_Style(); //nuevo estilo

$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
//fin estilos

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("COTIZACION"); //establecer titulo de hoja

//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa


//establecer margenes
$margin = 0.5 / 3.54; // 0.5 centimetros
$marginBottom = 1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes


//incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform.png'); //ruta
$objDrawing->setHeight(70); //altura
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen






//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query("SELECT    c.idcotizacion,
                                c.cod_mod,
                                m.nom_mod,
                                c.tallas_mod,
                                c.tela1_mod,
                                m.imagen,
                                CONCAT(t.apepat_trab,t.apemat_trab,t.nom_trab) AS diseñador
                                FROM cotizacion c
                                LEFT JOIN modelojf m
                                ON c.cod_mod=m.cod_mod
                                LEFT JOIN trabajador t
                                ON c.id_trab=t.id_trab
                                WHERE c.idcotizacion=$idcotizacion" );


$resPro=mysql_fetch_array($sqlPro);

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'HOJA DE COTIZACION');
$objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "E$fila:F$fila"); //establecer estilo



$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'R.U.C. :');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '20536422928');
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Dirección :');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'LIMA - PERU');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Fecha Emisión:');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resPro["fecha"]);
$objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "H$fila"); //establecer estilo
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

// $objPHPExcel->getActiveSheet()->getStyle('A3')->getNumberFormat()->setFormatCode('0000');


$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'E-mail :');
$objPHPExcel->getActiveSheet()->SetCellValue("d$fila", 'ventas@sircomce.com');
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);




$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Telefono(s) :');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", '989525324');
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "C$fila"); //establecer estilo
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$fila=7;

  $fila=8;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Cliente :");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "Moneda :");
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "S/ - SOLES");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "H$fila:I$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "DNI/RUC :");
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($resPro["num_documento"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "E$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);






  $fila=9;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Dirección :");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["direccion"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Empresa :");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["empresa"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=11;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Sede :");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["sede"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=12;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Email:");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["email"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=13;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Telefono:");
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["telefono"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $fila=14;

  $fila=15;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Sirvase a revisar nuestra Cotizacion :");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo

   $fila=16;

//titulos de columnas
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Codigo');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Categoria');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Articulo');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Marca');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Caracteristica 1');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Caracteristica 2');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Cantidad');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'P.Unitario');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Dscto');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Subtotal');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:K$fila")->getFont()->setBold(true); //negrita

//  <td style="mso-number-format:'0.00';">12346579.00</td>
//  Exportar de PHP a Excel y dar formato a celdas

// //rellenar con contenido



    $sql=mysql_query("     SELECT
                              a.idarticulo AS codigo,
                              c1.nombre,
                              a.nombre AS articulo,
                              a.descripcion,
                              c.cantidad,
                              c.precio_cotizacion,
                              c.descuento,
                              (c.cantidad*c.precio_cotizacion-c.descuento) AS subtotal
                              FROM detalle_cotizacion c
                              INNER JOIN articulo a
                              ON c.idarticulo=a.idarticulo
                              INNER JOIN categoria c1
                              ON c1.idcategoria=a.idcategoria
                              WHERE c.idcotizacion=$idcotizacion
                              ORDER BY c1.nombre");




while($res=mysql_fetch_array($sql)){

  $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getNumberFormat()->setFormatCode('00000');
  // $CodPro=$res["CodPro"];
  // ITE COD PROD  DESCRIPCION COLOR COLOR PROV. CANTIDAD  UND P.UNITARIO  % DSCTO TOTAL



  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["codigo"]);

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $res["nombre"]);

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["articulo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["marca"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["descripcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["caracteristica2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["cantidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["precio_cotizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["descuento"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["subtotal"]));




  //Establecer estilo
   $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000');



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:K$fila");
 }


 $sql1=mysql_query("SELECT
                            c.idcotizacion,
                            c.total_cotizacion as total,
                            SUM(d.descuento) AS dscto,
                            SUM(d.cantidad) AS unidades
                            FROM cotizacion c
                            INNER JOIN detalle_cotizacion d
                            ON c.idcotizacion=d.idcotizacion
                            WHERE c.idcotizacion=$idcotizacion
                            GROUP BY c.idcotizacion");




$res1=mysql_fetch_array($sql1);

 $fila+=1;

 $fila+=1;


  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "Valor Cotizacion S/");
  $objPHPExcel->getActiveSheet()->mergeCells("G$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "G$fila:I$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res1["total"]));
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "J$fila:K$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);





  /*$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "Valor Venta " .$res1["total"] );
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $res1["total"]);
 $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "I.G.V. " .$res1["total"] );
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $res1["total"]);

 $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "Total: ");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:J$fila");
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $res1["total"]);*/



// //insertar formula
// $fila+=2;
// $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'SUMA');
// $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '=1+2');

//recorrer las columnas
// foreach (range( 'C', 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J') as $columnID) {
//   //autodimensionar las columnas
//   $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
// }

  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);






 $fila+=1;
 $fila+=1;
 $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Logistica");
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", " V°B° Gerencia");
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Katheryn Salcedo Duran");
   $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila"); //establecer estilo



 $fila+=1;
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "OBSERVACIONES: ");
 $objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila");
$fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1.- Revisar si sus datos son correctos.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "2.- Los utiles se entregaran en el lugar acordado.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "3.- Las Cotizaciones tienen un tiempo valido de dos dias.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "4.- Revisar si la lista de utiles cumplen los requisitos.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "5.- El pago debe ser efectuado antes de entregar los utiles.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "6.- Las entregas seran realizadas los dias MARTES Y JUEVES de cada semana.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "7.- Indicar los siguientes datos para el forrado de los cuadernos: Color, Colegio, Profesor(a), Grado, etc.");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "8.- Solo seran validas las cotizaciones confirmadas por correo electronico: ventas@sircomce.com.");




//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="Cotizacion.xls"');
//**********************************************************************

//****************Guardar como excel 2007*******************************
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
//
//// Establecer formado de Excel 2007
//header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//
//// nombre del archivo
//header('Content-Disposition: attachment; filename="kiuvox.xlsx"');
//**********************************************************************

//forzar a descarga por el navegador
$objWriter->save('php://output');
