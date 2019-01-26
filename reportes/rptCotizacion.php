<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$idcotizacion = $_GET["id"];



//ajuntar la libreria excel
include "Classes/PHPExcel.php";
//include "../library/consulSQL.php";

 $conexion=mysql_connect("192.168.1.29","admin","vasco123") or die("No se pudo conectar: " . mysql_error());
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

$sqlTit=mysql_query("SELECT
c.cod_mod

FROM cotizacion c

where c.idcotizacion=$idcotizacion" ) or die(mysql_error());

$resTit=mysql_fetch_array($sqlTit);

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle($resTit["cod_mod"]); //establecer titulo de hoja

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
$objDrawing->setPath('img/jacky01.png'); //ruta
$objDrawing->setHeight(70); //altura
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen






//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query("SELECT
c.idcotizacion,
c.cod_mod,
m.nom_mod,
c.tallas_mod,
c.id_trab,
c.tela1_mod,
m.imagen,
CONCAT(t.nom_trab,' ',t.apepat_trab,' ',SUBSTRING(t.apemat_trab,1,1),'.') AS disenador,
DATE(fecha_hora) AS fecha
FROM cotizacion c
LEFT JOIN modelojf m
ON c.cod_mod=m.cod_mod
LEFT JOIN trabajador t
ON t.id_trab=c.id_trab
where c.idcotizacion=$idcotizacion" ) or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);

  $fila=2;
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'HOJA DE COTIZACION');
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Fecha de Creación:');
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resPro["fecha"]);
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "J$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "D$fila:E$fila"); //establecer estilo



  $fila=3;

  $fila=4;

  $fila=5;


  $fila=6;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Código :");
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["cod_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/modelos/'.$resPro["imagen"].''); //ruta
  $objDrawing->setWidthAndHeight(300,200);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('G6');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

  $fila=7;

  $fila=8;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Nombre :");
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["nom_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=9;

  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Tallas :");
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tallas_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=11;

  $fila=12;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Descripción :");
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tela1_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=13;

  $fila=14;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Diseñadora :");
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["disenador"]));
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "B$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=15;

  $fila=16;
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", "1.- DATOS TEXTILES");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "D$fila:E$fila"); //establecer estilo

  $fila=16;

  $fila=17;

  //titulos de columnas
  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Código');
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Precio MP');
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Descripción');
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Unidad');
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Linea');
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Consumo');
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '');
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Costo Primo');
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:K$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->getStyle("B$fila:K$fila")->getFont()->setBold(true); //negrita

  //  <td style="mso-number-format:'0.00';">12346579.00</td>
  //  Exportar de PHP a Excel y dar formato a celdas

  // //rellenar con contenido



      $sql=mysql_query("SELECT
dc.idcotizacion,
dc.idarticulo,
mp.nombre,
dc.cantidad,
ROUND(dc.precio_cotizacion,6) AS precio_cotizacion,
dc.descuento,
ROUND((dc.cantidad*dc.precio_cotizacion-dc.descuento),6) AS subtotal,
unidad,
linea
FROM detalle_cotizacion dc
LEFT JOIN
(SELECT
SUBSTRING(pro.codfab,1,6) AS id_articulo,
tmd.des_larga AS nombre,
tmd.des_corta AS cod_linea,
lin.linea,
und.unidad,
pre.precio
FROM producto pro
LEFT JOIN tabla_m_detalle AS tmd
ON SUBSTRING(pro.codfab,4,3)=tmd.valor_3
LEFT JOIN
(SELECT
SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
tmd.des_larga AS linea,
tmd.des_corta AS cod_linea
FROM producto pro
LEFT JOIN tabla_m_detalle AS tmd
ON LEFT(pro.codfab,3)=tmd.des_corta
WHERE pro.estpro='1' AND tmd.cod_tabla='tlin'
GROUP BY SUBSTRING(pro.CodFab,1,6)) AS lin
ON SUBSTRING(pro.codfab,1,6)=cod_sublinea
LEFT JOIN
(SELECT
SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
tmd.des_corta AS unidad
FROM producto pro
LEFT JOIN tabla_m_detalle AS tmd
ON pro.undpro=tmd.cod_argumento
WHERE pro.estpro='1' AND tmd.cod_tabla='tund'
GROUP BY SUBSTRING(pro.CodFab,1,6)) AS und
ON SUBSTRING(pro.codfab,1,6)=und.cod_sublinea
LEFT JOIN
(SELECT
SUBSTRING(pro.codfab,1,6) AS cod_sublinea,
MAX(GREATEST(
CASE
WHEN pmp.monprov1='DOLARES AMERICANOS' THEN pmp.preprov1*3.3
ELSE pmp.preprov1 END,
CASE
WHEN pmp.monprov2='DOLARES AMERICANOS' THEN pmp.preprov2*3.3
ELSE pmp.preprov2 END,
CASE
WHEN pmp.monprov3='DOLARES AMERICANOS' THEN pmp.preprov3*3.3
ELSE pmp.preprov3 END)) AS precio
FROM preciomp pmp
LEFT JOIN producto pro
ON pmp.codpro=pro.codpro
WHERE pro.estpro='1'
GROUP BY SUBSTRING(pro.CodFab,1,6)) AS pre
ON SUBSTRING(pro.codfab,1,6)=pre.cod_sublinea
WHERE pro.estpro='1' AND tmd.cod_tabla='tsub' AND tmd.des_corta=lin.cod_linea
GROUP BY SUBSTRING(pro.CodFab,1,6)) AS mp
ON dc.idarticulo=mp.id_articulo
WHERE dc.idcotizacion=$idcotizacion") or die(mysql_error());




  while($res=mysql_fetch_array($sql)){


  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["idarticulo"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $res["precio_cotizacion"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:F$fila");
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["linea"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["cantidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["descuento"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["subtotal"]));






  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:K$fila");
 }


 $sql1=mysql_query("SELECT
 dc.idcotizacion,
 ROUND(SUM(dc.cantidad*dc.precio_cotizacion),6) AS total
 FROM detalle_cotizacion dc
 WHERE dc.idcotizacion=$idcotizacion
 GROUP BY dc.idcotizacion") or die(mysql_error());




$res1=mysql_fetch_array($sql1);

  $fila+=1;


  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "TOTAL COSTO - MATERIA PRIMA S/");
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:I$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "E$fila:I$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res1["total"]));
  $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "J$fila:K$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);



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
