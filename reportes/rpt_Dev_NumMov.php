<?php session_start();

header('Content-Type: text/html; charset=ISO-8859-1');

$num_mov=$_GET["id"];


//ajuntar la libreria excel
include "Classes/PHPExcel.php";

$conexion=mysql_connect("192.168.1.29", "admin", "vasco123") or die("No se pudo conectar: ".mysql_error());
mysql_select_db("db_corpvasco", $conexion);

$fechaactual=getdate();
// print_r($fechaactual);
$fecha="$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

$objPHPExcel=new PHPExcel(); //nueva instancia

$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("00000020"); //titulo

//TODO:inicio estilos
$titulo = new PHPExcel_Style();
$titulo->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array(
      'bold' => true,
      'underline' =>true,
      'size' => 14
    )
));

$titulo1 = new PHPExcel_Style();
$titulo1->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 12
    )
));

$subtitulo = new PHPExcel_Style();
$subtitulo->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array(
      'bold' => true,
      'size' => 12
    )
));

$subtitulo1 = new PHPExcel_Style(); //nuevo estilo
$subtitulo1->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo2 = new PHPExcel_Style(); //nuevo estilo
$subtitulo2->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo3 = new PHPExcel_Style(); //nuevo estilo
$subtitulo3->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo4 = new PHPExcel_Style(); //nuevo estilo
$subtitulo4->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo5  = new PHPExcel_Style(); //nuevo estilo
$subtitulo5 ->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical'    => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal'  => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo6 = new PHPExcel_Style(); //nuevo estilo
$subtitulo6->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$subtitulo7 = new PHPExcel_Style(); //nuevo estilo
$subtitulo7->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$sub = new PHPExcel_Style(); //nuevo estilo
$sub->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)      
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$sub1 = new PHPExcel_Style(); //nuevo estilo
$sub1->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)      
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));

$sub2 = new PHPExcel_Style(); //nuevo estilo
$sub2->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)      
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));

$sub3 = new PHPExcel_Style(); //nuevo estilo
$sub3->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)      
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

$sub4 = new PHPExcel_Style(); //nuevo estilo
$sub4->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)      
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));

$sub5 = new PHPExcel_Style(); //nuevo estilo
$sub5->applyFromArray(
  array('alignment' => array(
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)      
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 10
    )
));


//fin estilos



$sqlTit=mysql_query("SELECT 
mr.num_mov FROM mov_resumen mr WHERE mr.num_mov=$num_mov GROUP BY mr.num_mov" ) or die(mysql_error());

$resTit=mysql_fetch_array($sqlTit);

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle($resTit["num_mov"]); //establecer titulo de hoja

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
$margin=0.5 / 3.54; // 0.5 centimetros
$marginBottom=1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes


//incluir una imagen
$objDrawing=new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jacky01.png'); //ruta
$objDrawing->setWidthAndHeight(160,100);
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen





//TODO:CABECERA.

    $sqlPro=mysql_query("SELECT 
    mr.cod_mov,
    mr.num_mov,
    mr.cod_cli,
    CONCAT(
      mr.cod_cli,
      ' - ',
      c.nombre_cliente
    ) AS nom_cli,
    mr.cod_ven,
    v.nom_ven,
    DATE(mr.fecha_hora) AS fecha,
    SUM(mr.cant_mov) AS cantidad,
    SUM(
      CASE
        WHEN mr.cod_alm = '01' 
        THEN mr.cant_mov 
        ELSE 0 
      END
    ) AS 'cant_primera',
    SUM(
      CASE
        WHEN mr.cod_alm = 'SE' 
        THEN mr.cant_mov 
        ELSE 0 
      END
    ) AS 'cant_segunda',
    mr.estado,
    mr.idusuario,
    u1.nombre AS nom_ing,
    mr.idusu_apro,
    u.nombre AS nom_apro 
  FROM
    mov_resumen mr 
    LEFT JOIN usuario u 
      ON mr.idusu_apro = u.idusuario 
    LEFT JOIN usuario u1 
      ON mr.idusuario = u1.idusuario 
    LEFT JOIN clientesjf c 
      ON mr.cod_cli = c.cliente 
    LEFT JOIN 
      (SELECT 
        tmd.des_corta AS cod_ven,
        CONCAT(
          tmd.des_corta,
          ' - ',
          tmd.des_larga
        ) AS nom_ven 
      FROM
        tabla_maestra_detalle tmd 
      WHERE tmd.cod_tabla = 'TVEN') AS v 
      ON mr.cod_ven = v.cod_ven 
  WHERE mr.num_mov = $num_mov
    AND mr.cod_mov = 'I05' 
  GROUP BY mr.num_mov 
  ORDER BY mr.fecha_hora,
    mr.cod_alm" ) or die(mysql_error());

    $resPro=mysql_fetch_array($sqlPro);



$fila=2;
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Corporación Vasco S.A.C');
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "D$fila:H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "J$fila");

$objPHPExcel->getActiveSheet()->setCellValueExplicit("K$fila",utf8_encode($resPro["num_mov"]), PHPExcel_Cell_DataType::TYPE_STRING); 
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "K$fila:M$fila");

$fila=3;
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(19.03);

$fila=4;
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Cliente:');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["nom_cli"]));
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "D$fila:H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "K$fila:M$fila");

$fila=5;
$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["fecha"]));
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "K$fila:M$fila");

$fila=6;
$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Vendedor:');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila",utf8_encode($resPro["nom_ven"]));
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "D$fila:H$fila");

$fila=7;
$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(19.03);

$fila=8;
$objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(19.03);

$fila=9;
$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "A$fila:D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'S');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'M');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'L');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'XL');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'XXL');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'XS');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo2, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo1, "M$fila");

$fila=10;
$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo3, "A$fila:D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '3');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '4');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '6');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '8');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '10');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '12');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '14');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '16');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo4, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo3, "M$fila");

$fila=11;
$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'VEN');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo5, "A$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ALMACEN');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "B$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '28');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo5, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '30');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '32');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '34');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '36');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "I$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '38');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '40');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "K$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '42');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo6, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo7, "M$fila");

//TODO:FIN CABECERA

//TODO:INICIO CUERPO

$sql=mysql_query("SELECT 
                          m.cod_mov,
                          m.num_mov,
                          m.cod_ven,
                          m.cod_alm,
                          IFNULL(a.modelo, 'Limpiar') AS modelo,
                          IFNULL(a.cod_color, '-') AS cod_color,
                          IFNULL(a.color, '-') AS color,
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '1' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '1' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't1',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '2' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '2' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't2',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '3' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '3' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't3',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '4' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '4' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't4',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '5' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '5' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't5',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '6' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '6' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't6',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '7' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '7' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't7',
                          IF(
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '8' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ) > 0,
                            (
                              SUM(
                                CASE
                                  WHEN a.cod_talla = '8' 
                                  THEN m.cant_mov 
                                  ELSE 0 
                                END
                              )
                            ),
                            ''
                          ) AS 't8',
                          SUM(m.cant_mov) AS 'subtotal' 
                          FROM
                          movimientos m 
                          LEFT JOIN articulojf a 
                            ON m.articulo = a.articulo 
                          WHERE m.num_mov = $num_mov
                          AND m.cod_mov = 'I05' 
                          GROUP BY m.cod_mov,
                          m.num_mov,
                          m.cod_taller,
                          m.cod_alm,
                          a.modelo,
                          a.cod_color,
                          a.color 
                          ORDER BY m.cod_alm ASC,
                          m.cod_taller,
                          a.modelo,
                          a.cod_color") or die(mysql_error());




while($res=mysql_fetch_array($sql)){


$fila+=1;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila",utf8_encode($res["cod_ven"]), PHPExcel_Cell_DataType::TYPE_STRING); 
$objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila",utf8_encode($res["cod_alm"]), PHPExcel_Cell_DataType::TYPE_STRING); 
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["modelo"]));
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["color"]));
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["t1"]));
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["t2"]));
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["t3"]));
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["t4"]));
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["t5"]));
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["t6"]));
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["t7"]));
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["t8"]));
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["subtotal"]));

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


}

//TODO:FIN CUERPO

//TODO:INICIO RELLENO

$fila=12;
$objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=13;
$objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=14;
$objPHPExcel->getActiveSheet()->getRowDimension('14')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=15;
$objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=16;
$objPHPExcel->getActiveSheet()->getRowDimension('16')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=17;
$objPHPExcel->getActiveSheet()->getRowDimension('17')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=18;
$objPHPExcel->getActiveSheet()->getRowDimension('18')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=19;
$objPHPExcel->getActiveSheet()->getRowDimension('19')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=20;
$objPHPExcel->getActiveSheet()->getRowDimension('20')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=21;
$objPHPExcel->getActiveSheet()->getRowDimension('21')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=22;
$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=23;
$objPHPExcel->getActiveSheet()->getRowDimension('23')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=24;
$objPHPExcel->getActiveSheet()->getRowDimension('24')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=25;
$objPHPExcel->getActiveSheet()->getRowDimension('25')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=26;
$objPHPExcel->getActiveSheet()->getRowDimension('26')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=27;
$objPHPExcel->getActiveSheet()->getRowDimension('27')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");

$fila=28;
$objPHPExcel->getActiveSheet()->getRowDimension('28')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=29;
$objPHPExcel->getActiveSheet()->getRowDimension('29')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=30;
$objPHPExcel->getActiveSheet()->getRowDimension('30')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=31;
$objPHPExcel->getActiveSheet()->getRowDimension('31')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=32;
$objPHPExcel->getActiveSheet()->getRowDimension('32')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=33;
$objPHPExcel->getActiveSheet()->getRowDimension('33')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=34;
$objPHPExcel->getActiveSheet()->getRowDimension('34')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=35;
$objPHPExcel->getActiveSheet()->getRowDimension('35')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=36;
$objPHPExcel->getActiveSheet()->getRowDimension('36')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=37;
$objPHPExcel->getActiveSheet()->getRowDimension('37')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=38;
$objPHPExcel->getActiveSheet()->getRowDimension('38')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub1, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "M$fila");


$fila=39;
$objPHPExcel->getActiveSheet()->getRowDimension('39')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "A$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub5, "M$fila");

$fila=40;
$objPHPExcel->getActiveSheet()->getRowDimension('40')->setRowHeight(19.03);

$fila=41;
$objPHPExcel->getActiveSheet()->getRowDimension('41')->setRowHeight(19.03);

$fila=42;
$objPHPExcel->getActiveSheet()->getRowDimension('42')->setRowHeight(19.03);

$fila=43;
$objPHPExcel->getActiveSheet()->getRowDimension('43')->setRowHeight(19.03);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Entregado por:');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "C$fila:E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Recibido por:');
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "H$fila:L$fila");

//TODO:FIN RELLENO



//AJUSTAR TAMAÑO DE COLUMNAS    
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(6.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8.57);



//establecer pie de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter=new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");


$sqlNom=mysql_query("SELECT 
mr.num_mov FROM mov_resumen mr WHERE mr.num_mov=$num_mov GROUP BY mr.num_mov" ) or die(mysql_error());

$resTit=mysql_fetch_array($sqlNom);


// nombre del archivo
header('Content-Disposition: attachment; filename="'.$resTit["num_mov"].'.xls"');
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
