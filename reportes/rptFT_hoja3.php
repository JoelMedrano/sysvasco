<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$idmft = $_GET["id"];



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
$objPHPExcel->getProperties()->setTitle("sadasdas"); //titulo

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
      'color' => array('rgb' => 'B2ACAB')
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


/*======================================================
  ======================================================
  ======================================================*/

  $tituloG = new PHPExcel_Style(); //nuevo estilo
  $tituloG->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 50
      )
  ));

  //TEXTOS

  //inicio estilos
  $tex1 = new PHPExcel_Style(); //nuevo estilo
  $tex1->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 36
      )
  ));

  $tex2 = new PHPExcel_Style(); //nuevo estilo
  $tex2->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 36
      )
  ));

  $tex3 = new PHPExcel_Style(); //nuevo estilo
  $tex3->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 45
      )
  ));


  //SUBTITULOS//
  $sub1 = new PHPExcel_Style(); //nuevo estilo
  $sub1->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => false,
        'size' => 28
      )
  ));

  $sub2 = new PHPExcel_Style(); //nuevo estilo
  $sub2->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $sub3 = new PHPExcel_Style(); //nuevo estilo
  $sub3->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));


  $sub4 = new PHPExcel_Style(); //nuevo estilo
  $sub4->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'fill' => array( //relleno de color
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'd6d0d0')
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => true,
        'size' => 42
      )
  ));

  $sub5 = new PHPExcel_Style(); //nuevo estilo
  $sub5->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 40
      )
  ));

  $sub6 = new PHPExcel_Style(); //nuevo estilo
  $sub6->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
      ),
      'borders' => array( //bordes
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $sub7 = new PHPExcel_Style(); //nuevo estilo
  $sub7->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
      'font' => array( //fuente
        'bold' => true,
        'size' => 36
      )
  ));

  $sub8 = new PHPExcel_Style(); //nuevo estilo
  $sub8->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => true,
        'size' => 50
      )
  ));

  $sub9 = new PHPExcel_Style(); //nuevo estilo
  $sub9->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => true,
        'size' => 48
      )
  ));

  $sub10 = new PHPExcel_Style(); //nuevo estilo
  $sub10->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  $sub11 = new PHPExcel_Style(); //nuevo estilo
  $sub11->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  $sub12 = new PHPExcel_Style(); //nuevo estilo
  $sub12->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  //TODO:RELLENO DE CUERPO
  $sub13 = new PHPExcel_Style(); //nuevo estilo
  $sub13->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => true,
        'size' => 48
      )
  ));

  $sub14 = new PHPExcel_Style(); //nuevo estilo
  $sub14->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  $sub15 = new PHPExcel_Style(); //nuevo estilo
  $sub15->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  $sub16 = new PHPExcel_Style(); //nuevo estilo
  $sub16->applyFromArray(
    array('alignment' => array( //alineacion
        'wrap' => false,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
      ),
      'borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      ),
        'font' => array( //fuente
        'bold' => false,
        'size' => 48
      )
  ));

  
//TODO:FIN DE RELLENO DE CUERPO

//TODO:ESTILOS PARA LAS ESPECIFICACIONES

$sub17 = new PHPExcel_Style(); //nuevo estilo
$sub17->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 48
    )
));

$sub18 = new PHPExcel_Style(); //nuevo estilo
$sub18->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array( //fuente
      'bold' => true,
      'size' => 45
    )
));

$sub19 = new PHPExcel_Style(); //nuevo estilo
$sub19->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 40
    )
));

$sub20 = new PHPExcel_Style(); //nuevo estilo
$sub20->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 40
    )
));

$sub21 = new PHPExcel_Style(); //nuevo estilo
$sub21->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 45
    )
));

$sub22 = new PHPExcel_Style(); //nuevo estilo
$sub22->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array( //fuente
      'bold' => false,
      'size' => 45
    )
));


  $bordes1 = new PHPExcel_Style(); //nuevo estilo
  $bordes1->applyFromArray(
    array('borders' => array( //bordes
        'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));

  $bordes2 = new PHPExcel_Style(); //nuevo estilo
  $bordes2->applyFromArray(
    array('borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      )
  ));

  $bordes3 = new PHPExcel_Style(); //nuevo estilo
  $bordes3->applyFromArray(
    array('borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));

  $bordes4 = new PHPExcel_Style(); //nuevo estilo
  $bordes4->applyFromArray(
    array('borders' => array( //bordes
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));

  $bordes5 = new PHPExcel_Style(); //nuevo estilo
  $bordes5->applyFromArray(
    array('borders' => array( //bordes
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
  ));


  /*======================================================
    ======================================================
    ======================================================*/




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
$objPHPExcel->getActiveSheet()->setTitle("PRESENTACION"); //establecer titulo de hoja

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
$margin = 1.75 / 3.54; // 0.5 centimetros
$marginBottom = 1.625 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginBottom);
//fin: establecer margenes


//incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyft.png'); //ruta
$objDrawing->setWidthAndHeight(333,200);
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen






//establecer titulos de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query(" SELECT         mft.idmft,
                                      DATE(mft.fecha_hora) AS fecha,
                                      DATE(mft.fecha_mod) AS fecha_mod,
                                      m.id_marca,
                                      ma.nombre AS marca,
                                      mft.cod_mod,
                                      m.nom_mod,
                                      mft.id_trab,
                                      CONCAT(
                                        SUBSTRING_INDEX(nom_trab, ' ', 1),
                                        ' ',
                                        t.apepat_trab,
                                        ' ',
                                        SUBSTRING(t.apemat_trab, 1, 1),
                                        '.'
                                      ) AS disenador,
                                      mft.idusuario,
                                      UPPER(u.nombre) AS desarrollador,
                                      mft.total_mft,
                                      mft.vb_mft,
                                      SUBSTRING_INDEX(
                                        (SELECT 
                                          UPPER(nombre) 
                                        FROM
                                          usuario u 
                                        WHERE u.idusuario = mft.vb_mft),
                                        ' ',
                                        2
                                      ) AS vb,
                                      mft.estado,
                                      mft.editable,
                                      CASE
                                        WHEN mft.empresa = '1' 
                                        THEN 'CORPORACION VASCO' 
                                        WHEN mft.empresa = '2' 
                                        THEN 'INSUSTRIAS VASQUEZ' 
                                        ELSE 'JOSE VASQUEZ CORTEZ' 
                                      END AS empresa,
                                      mft.color_mod,
                                      mft.tallas_mod,
                                      mft.div_mod,
                                      mft.temp_mod,
                                      mft.dest_mod,
                                      t1.tela1 AS tela1_mod,
                                      t2.tela2 AS tela2_mod,
                                      t3.tela3 AS tela3_mod,
                                      mft.tela1_mod AS t1,
                                      mft.tela2_mod AS t2,
                                      mft.tela3_mod AS t3,
                                      CASE
                                        WHEN mft.bord_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS bord_mod,
                                      CASE
                                        WHEN mft.esta_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS esta_mod,
                                      CASE
                                        WHEN mft.manu_mod = '0' 
                                        THEN 'NO' 
                                        ELSE 'SI' 
                                      END AS manu_mod,
                                      mft.imagen,
                                      mft.imagen2 
                                      FROM
                                      maestro_ficha_tecnica mft 
                                      LEFT JOIN modelojf m 
                                        ON mft.cod_mod = m.cod_mod 
                                      LEFT JOIN marcas ma 
                                        ON m.id_marca = ma.id_marca 
                                      LEFT JOIN usuario u 
                                        ON mft.idusuario = u.idusuario 
                                      LEFT JOIN trabajador t 
                                        ON mft.id_trab = t.id_trab 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela1_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela1,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t1 
                                        ON mft.tela1_mod = t1.tela1_mod 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela2_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela2,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t2 
                                        ON mft.tela2_mod = t2.tela2_mod 
                                      LEFT JOIN 
                                        (SELECT 
                                          SUBSTRING(pro.codfab, 1, 6) AS tela3_mod,
                                          CONCAT(
                                            SUBSTRING(pro.codfab, 1, 6),
                                            ' - ',
                                            tmd.des_larga
                                          ) AS tela3,
                                          tmd.des_corta AS cod_linea,
                                          lin.linea 
                                        FROM
                                          producto pro 
                                          LEFT JOIN tabla_m_detalle AS tmd 
                                            ON SUBSTRING(pro.codfab, 4, 3) = tmd.valor_3 
                                          LEFT JOIN 
                                            (SELECT 
                                              SUBSTRING(pro.codfab, 1, 6) AS cod_sublinea,
                                              tmd.des_larga AS linea,
                                              tmd.des_corta AS cod_linea 
                                            FROM
                                              producto pro 
                                              LEFT JOIN tabla_m_detalle AS tmd 
                                                ON LEFT(pro.codfab, 3) = tmd.des_corta 
                                            WHERE pro.estpro = '1' 
                                              AND tmd.cod_tabla = 'tlin' 
                                            GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS lin 
                                            ON SUBSTRING(pro.codfab, 1, 6) = lin.cod_sublinea 
                                        WHERE pro.estpro = '1' 
                                          AND tmd.cod_tabla = 'tsub' 
                                          AND tmd.des_corta = lin.cod_linea 
                                          AND linea LIKE '%tela%' OR  linea LIKE '%blonda%' 
                                        GROUP BY SUBSTRING(pro.CodFab, 1, 6)) AS t3 
                                        ON mft.tela3_mod = t3.tela3_mod 
                                      WHERE mft.idmft = $idmft" ) or die(mysql_error());


  $resPro=mysql_fetch_array($sqlPro);

  $fila=2;
  $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(116.25);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'HOJA DE CORTE / MOLDES / COMBOS');
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'UDP');
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "Q$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:P$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tituloG, "B$fila:P$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tituloG, "Q$fila");

  
  $fila=3;
  $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CLIENTE:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["empresa"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "DISEÑADORA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["disenador"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "BORDADO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["bord_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");


  $fila=4;
  $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "MARCA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["marca"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "ELABORADO POR:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["desarrollador"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "ESTAMPADO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["esta_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");


  $fila=5;
  $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TEMPORADA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["temp_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "DESTINO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["dest_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "MANUALIDADES:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["manu_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");


  $fila=6;
  $objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DIVISION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["div_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "COLORES");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["color_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "FECHA DE ELABORACION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["fecha"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");


  $fila=7;
  $objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CODIGO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["cod_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "TELA PRINCIPAL:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["tela1_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "FECHA DE MODIFICACION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["fecha_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");

  $fila=8;
  $objPHPExcel->getActiveSheet()->getRowDimension('8')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DESCRIPCION:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["nom_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "TELA COMPLEMENTO 1:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["tela2_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "MOTIVO:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");


  $fila=9;
  $objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(52.50);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TALLAS:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["tallas_mod"]));
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "E$fila:F$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "TELA COMPLEMENTO 2:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "K$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["tela3_mod"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex1, "L$fila");


  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "V.B:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub3, "P$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($resPro["vb"]));
  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");

  $fila=10;
  $objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(30);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");

  $fila=11;
  $objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(64.75);

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "RUTA DE PRENDA:");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub8, "B$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub8, "B$fila:D$fila");

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "CORTE - COSTURA - ACABADOS - EMPAQUE");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub8, "E$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:Q$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub8, "E$fila:Q$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


  $fila=12;
  $objPHPExcel->getActiveSheet()->getRowDimension('12')->setRowHeight(9.75);

  $objPHPExcel->getActiveSheet()->setSharedStyle($sub2, "B$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($tex2, "Q$fila");

  $fila=13; 
  $objPHPExcel->getActiveSheet()->getRowDimension('13')->setRowHeight(203.25);


  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "N°");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "DESCRIPCION");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "C$fila");
  $objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "C$fila:E$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "ITEM");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "F$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "UNIDAD DE MEDIDA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "G$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setWrapText(true); 

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "UBICACION DE PRENDA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "H$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "CONSUMO x PRENDA");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "I$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setWrapText(true); 

  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "CONSUMO x PDA. + % TEÑIDO");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "J$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setWrapText(true); 

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", "PROVEEDOR");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "K$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", "COMBO 1");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "L$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", "COMBO 2");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", "COMBO 3");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "N$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("N$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", "COMBO 4");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "O$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("O$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", "COMBO 5");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "P$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("P$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", "COMBO 6");
  $objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "Q$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("Q$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


    //TODO:DETALLE DE TELAS

    $sql=mysql_query("SELECT 
                              fc.idmft,
                              fc.cod_color,
                              da.ubicacion,
                              da.consumo,
                              da.consumo_tenido,
                              mp.cod_linea,
                              mp.descripcion,
                              mp.und,
                              mp.prov,
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '1' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '1',
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '2' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '2',
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '3' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '3',
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '4' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '4',
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '5' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '5',
                              MAX(
                                
                                CASE
                                  
                                  WHEN cc.contador = '6' 
                                  THEN mp.color 
                                  ELSE '-' 
                                END
                              ) AS '6' 
                            FROM
                              fictec_color fc 
                              LEFT JOIN 
                                (SELECT 
                                  (@i := @i + 1) AS contador,
                                  idmft_color 
                                FROM
                                  
                                  (SELECT 
                                    @i := 0) r,
                                  fictec_color fc 
                                WHERE fc.idmft = '$idmft') AS cc 
                                ON fc.idmft_color = cc.idmft_color 
                              LEFT JOIN avios a 
                                ON fc.idmft_color = a.idmft_color 
                              LEFT JOIN detalle_avios da 
                                ON a.idavios = da.idavios 
                              LEFT JOIN 
                                (SELECT DISTINCT 
                                  SUBSTRING(p.CodFab, 1, 6) AS cod_linea,
                                  p.Codpro AS codpro,
                                  p.DesPro AS descripcion,
                                  tmd.Des_Larga AS color,
                                  Tb2.Des_Corta AS und,
                                  IFNULL(prov.razpro, 'PENDIENTE') AS prov 
                                FROM
                                  Producto AS p 
                                  LEFT JOIN 
                                    (SELECT 
                                      pmp.codpro,
                                      pro.razpro 
                                    FROM
                                      preciomp pmp 
                                      LEFT JOIN proveedor pro 
                                        ON pmp.CodProv1 = pro.CodRuc) AS prov 
                                    ON prov.codpro = p.Codpro,
                                  Tabla_M_Detalle AS tmd,
                                  Tabla_M_Detalle AS Tb1,
                                  Tabla_M_Detalle AS Tb2,
                                  Tabla_M_Detalle AS Tb4 
                                WHERE tmd.Cod_Tabla IN ('TCOL') 
                                  AND Tb2.Cod_Tabla IN ('TUND') 
                                  AND tB4.Cod_Tabla IN ('TLIN') 
                                  AND Tb1.Cod_Tabla IN ('TSUB') 
                                  AND tmd.Cod_Argumento = p.ColPro 
                                  AND Tb2.Cod_Argumento = p.UndPro 
                                  AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
                                  AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
                                  AND Tb4.Des_Corta = Tb1.Des_Corta) AS mp 
                                ON da.idarticulo = mp.codpro 
                            WHERE fc.idmft = '$idmft' 
                              AND a.idavios IS NOT NULL 
                            GROUP BY fc.idmft,
                              mp.descripcion ") or die(mysql_error());




while($res=mysql_fetch_array($sql)){


$fila+=1;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);


$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["descripcion"]));
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["cod_linea"]));
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["und"]));
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["ubicacion"]));
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["consumo"]));
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["consumo_tenido"]));
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["prov"]));
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["1"]));
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["2"]));
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["3"]));
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["4"]));
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["5"]));
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["6"]));


$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");

}
//NOTAS:FIN DE WHILE DETALLES

//NOTAS:INICIO DE RELLENO

$fila=14;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=15;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "2");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=16;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "3");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=17;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "4");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=18;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "5");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=19;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "6");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=20;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "7");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=21;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "8");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=22;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "9");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=23;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "10");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=24;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "11");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=25;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "12");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=26;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "13");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=27;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "14");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=28;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "15");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=29;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "16");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=30;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "17");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=31;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "18");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=32;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "19");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=33;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "20");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=34;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "21");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=35;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "22");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");


$fila=36;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(84);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "23");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub9, "B$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila");
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "C$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "F$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "J$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "N$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "O$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub21, "P$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub12, "Q$fila");




//NOTAS:FIN DE RELLENO

//NOTAS: SEGUNDA PARTE DEL CUERPO

$fila=37;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(81);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "GRAFICO DE AVIOS");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:Q$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($sub4, "B$fila:Q$fila");
$objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  //TODO:incluir una imagen

  $sqlIma=mysql_query(" SELECT 
                        fc.idmft,
                        a.avios 
                      FROM
                        fictec_color fc 
                        LEFT JOIN avios a 
                          ON fc.idmft_color = a.idmft_color 
                      WHERE fc.idmft = '$idmft' 
                        AND avios IS NOT NULL 
                      GROUP BY fc.idmft " ) or die(mysql_error());


$resIma=mysql_fetch_array($sqlIma);


  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/avios/'.$resIma["avios"].''); //ruta
  $objDrawing->setWidthAndHeight(3430,2404);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('B38');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen





  //TODO:fin: incluir una imagen


  //FIXME:LARGO DE CELDAS

  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3.86);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(67.57);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(26.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(96.29 );
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(37.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(54.86);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(153.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(62.71);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(66.57);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(119.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(74.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(74.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(74.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(74.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(74.14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(74.14);




//establecer pie de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo

        $sqlTit=mysql_query("SELECT   CONCAT('F.T ',mft.cod_mod,' ',m.nom_mod) AS modelo,
                                      mft.cod_mod,
                                      m.nom_mod
                                      FROM maestro_ficha_tecnica mft
                                      LEFT JOIN modelojf m
                                      ON mft.cod_mod=m.cod_mod
                                      where mft.idmft=$idmft" ) or die(mysql_error());

        $resTit=mysql_fetch_array($sqlTit);

header('Content-Disposition: attachment; filename="'.$resTit["modelo"].'.xls"');
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
