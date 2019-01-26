<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$id_permiso=$_GET["id"];



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

$objPHPExcel->getProperties()->setCreator("leydi"); //autor
$objPHPExcel->getProperties()->setTitle("HojaTrabajador"); //titulo

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


//inicio estilos
$titulo4 = new PHPExcel_Style(); //nuevo estilo
$titulo4->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
    ),
    'font' => array( //fuente
      'size' => 10
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







$bordes_inferior = new PHPExcel_Style(); //nuevo estilo

$bordes_inferior->applyFromArray(
  array('borders' => array(
     'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_NONE)
      )
));
//fin estilos

$bordes_lateral_izquierdo = new PHPExcel_Style(); //nuevo estilo

$bordes_lateral_izquierdo->applyFromArray(
  array('borders' => array(
     'top' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_NONE),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
      )
));
//fin estilos

 $sqlPro=mysql_query("SELECT DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,
                 pp.dias,
                 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab , tr.nom_trab ) AS solicitante,
                 DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede,
                 DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta,
                 pp.tip_permiso, 
                 pp.id_trab, 
                 pp.id_permiso, 
                 CONCAT('N.',' ' , LPAD(pp.id_permiso,6,'0')  )  AS id,
                 pp.hora_ing, 
                 pp.hora_sal, 
                 pp.motivo,
                 tfun.des_larga AS Funcion, 
                 tare.des_larga AS Area,
                 IF(pp.est_apro='1', 'APROBADO', '') apro_jef_ope,
                 IF(pp.est_apro_rrhh='1', 'APROBADO', '') apro_rrhh,
                 tper.des_larga AS tipo_permiso,
                 IF(pp.imagen1='', 'nulos.jpg', pp.imagen1) AS imagen1,
                 IF(pp.imagen2='', 'nulos.jpg', pp.imagen2) AS imagen2,
                 IF(pp.imagen3='', 'nulos.jpg', pp.imagen3) AS imagen3,
                 IF(pp.imagen4='', 'nulos.jpg', pp.imagen4) AS imagen4             
                 FROM permiso_personal  pp
                 LEFT JOIN TRABAJADOR tr ON 
                 tr.id_trab= pp.id_trab
                 LEFT JOIN tabla_maestra_detalle AS tfun ON
                 tfun.cod_argumento= tr.id_funcion
                 AND tfun.cod_tabla='TFUN'
                 LEFT JOIN tabla_maestra_detalle AS tare ON
                 tare.cod_argumento= tr.id_area
                 AND tare.cod_tabla='TARE'
                 LEFT JOIN tabla_maestra_detalle AS tper ON
                 tper.des_corta= pp.tip_permiso
       WHERE pp.id_permiso=$id_permiso 
     /*  AND pp.tip_permiso NOT LIKE '%VC%' */ ") or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);


//INICIO QUINTA HOJA

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Adjunto4"); //establecer titulo de hoja

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


//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

  

  $fila=2;

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/permisos_personal/'.$resPro["imagen4"].''); //ruta
  $objDrawing->setWidthAndHeight(600,800);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('B2');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

 
 
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
//FIN QUINTA HOJA


//INICIO CUARTA HOJA

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Adjunto3"); //establecer titulo de hoja

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


//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

  

  $fila=2;

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/permisos_personal/'.$resPro["imagen3"].''); //ruta
  $objDrawing->setWidthAndHeight(600,800);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('B2');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

 
 
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
//FIN CUARTA HOJA



//INICIO TERCERA HOJA

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Adjunto2"); //establecer titulo de hoja

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


//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

  

  $fila=2;

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/permisos_personal/'.$resPro["imagen2"].''); //ruta
  $objDrawing->setWidthAndHeight(600,800);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('B2');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

 
 
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
//FIN TERCERA HOJA


//INICIO SEGUNDA HOJA

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Adjunto1"); //establecer titulo de hoja

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


//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

  

  $fila=2;

  //incluir una imagen
  $objDrawing = new PHPExcel_Worksheet_Drawing();
  $objDrawing->setPath('../files/permisos_personal/'.$resPro["imagen1"].''); //ruta
  $objDrawing->setWidthAndHeight(600,800);
  //$objDrawing->setWeight(100); //altura
  $objDrawing->setCoordinates('B2');
  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
  //fin: incluir una imagen

 
 
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
//FIN SEGUNDA HOJA


$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Papeleta de Permiso"); //establecer titulo de hoja

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
$margin = 0.1 / 3.54; // 0.5 centimetros
$marginBottom = 1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes








 $sqlPro=mysql_query("SELECT DATE_FORMAT(pp.fecha_emision, '%d/%m/%Y') AS fecha_emision,
                 pp.dias,
                 CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab , tr.nom_trab ) AS solicitante,
                 DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y') AS fecha_procede,
                 DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y') AS fecha_hasta,
                 pp.tip_permiso, 
                 pp.id_trab, 
                 pp.id_permiso, 
                 CONCAT('N.',' ' , LPAD(pp.id_permiso,6,'0')  )  AS id,
                 pp.hora_ing, 
                 pp.hora_sal, 
                 pp.motivo,
                 tfun.des_larga AS Funcion, 
                 tare.des_larga AS Area,
                 IF(pp.est_apro='1', 'APROBADO', '') apro_jef_ope,
                 IF(pp.est_apro_rrhh='1', 'APROBADO', '') apro_rrhh,
                 tper.des_larga AS tipo_permiso
                 FROM permiso_personal  pp
                 LEFT JOIN TRABAJADOR tr ON 
                 tr.id_trab= pp.id_trab
                 LEFT JOIN tabla_maestra_detalle AS tfun ON
                 tfun.cod_argumento= tr.id_funcion
                 AND tfun.cod_tabla='TFUN'
                 LEFT JOIN tabla_maestra_detalle AS tare ON
                 tare.cod_argumento= tr.id_area
                 AND tare.cod_tabla='TARE'
                 LEFT JOIN tabla_maestra_detalle AS tper ON
                 tper.des_corta= pp.tip_permiso
       WHERE pp.id_permiso=$id_permiso 
     /*  AND pp.tip_permiso NOT LIKE '%VC%' */ ") or die(mysql_error());





  $resPro=mysql_fetch_array($sqlPro);


  //incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform.png'); //ruta
$objDrawing->setHeight(75); //altura
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 



  $fila=3;
 
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "AVISO A RECURSOS HUMANOS");
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:J$fila");
  

  
   // $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "F$fila:J$fila");

    $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

    $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
   

    $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getFont()  ->setUnderline(true);




  $fila=5;
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "PAPELETA DE PERMISO");
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getFont()  ->setUnderline(true);


 

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["id"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "L$fila"); //establecer estilo

  

  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  

  $fila=7;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TIPO PERMISO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tipo_permiso"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila:G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");


 
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "FECHA DE EMISION:");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fecha_emision"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "L$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=8;
 




  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "FECHA QUE PROCEDE:");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fecha_procede"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "L$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "SIRVASE A TOMAR NOTA QUE EL TRABAJADOR(A):");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo



  $fila=11;

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["solicitante"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);





  $fila=12;  
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DE LA SECCION:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo



 


  $fila=13;

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["Area"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=14;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CARGO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo





  $fila=15;
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["Funcion"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=16;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "MOTIVO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo






  $filaX=17;
  $filaY=19;


  $objPHPExcel->getActiveSheet()->SetCellValue("B$filaX", utf8_encode($resPro["motivo"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$filaY"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("B$filaX:M$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$filaX:M$filaY");
  $objPHPExcel->getActiveSheet() ->getStyle("B$filaX")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);






  $fila=20;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "H.SALIDA:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["hora_sal"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo
  

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "H.INGRESO:");
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["hora_ing"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo
  

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");

   $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



 


  $fila=21;


  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Trabajador");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  "Jefe de Operaciones");
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo
  

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "Recursos Humanos");
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila",  "Jefe de Area");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo
  

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
 

  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=22;

  $filaX=22;
  $filaY=25;

 

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["des_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$filaX:D$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["apro_jef_ope"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("E$filaX:G$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($resPro["apro_rrhh"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("H$filaX:J$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["nivel_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("K$filaX:M$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$filaX"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$filaX:M$filaY");
 
  $objPHPExcel->getActiveSheet() ->getStyle("B$filaX:M$filaY")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  //incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform.png'); //ruta
$objDrawing->setHeight(75); //altura
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B29');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 



  $fila=30;
 
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", " AVISO A RECURSOS HUMANOS");
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:J$fila");
  

  
   // $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "F$fila:J$fila");

    $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

    $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  
   

    $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getFont()  ->setUnderline(true);




  $fila=32;
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "PAPELETA DE PERMISO");
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "F$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getFont()  ->setUnderline(true);


 

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["id"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo2, "L$fila"); //establecer estilo

  

  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  

  $fila=34;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "TIPO PERMISO");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["tipo_permiso"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila:G$fila"); //establecer estilo
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:G$fila");


 
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:G$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "FECHA DE EMISION:");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fecha_emision"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "L$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



  $fila=35;
 




  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", "FECHA QUE PROCEDE:");
  $objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "I$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($resPro["fecha_procede"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "L$fila"); //establecer estilo

  
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "L$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




  $fila=37;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "SIRVASE A TOMAR NOTA QUE EL TRABAJADOR(A):");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:F$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo



  $fila=38;

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["solicitante"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);





  $fila=39;  
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DE LA SECCION:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo



 


  $fila=40;

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["Area"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=41;

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CARGO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo





  $fila=42;
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["Funcion"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("D$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "D$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



  $fila=43;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "MOTIVO:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo






  $filaX=44;
  $filaY=46;


  $objPHPExcel->getActiveSheet()->SetCellValue("B$filaX", utf8_encode($resPro["motivo"])); 
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "D$filaY"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->mergeCells("B$filaX:M$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$filaX:M$filaY");
  $objPHPExcel->getActiveSheet() ->getStyle("B$filaX")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);






  $fila=47;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "H.SALIDA:");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["hora_sal"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo
  

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "H.INGRESO:");
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["hora_ing"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo
  

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");

   $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



 


  $fila=48;


  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Trabajador");
  $objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  "Jefe de Operaciones");
  $objPHPExcel->getActiveSheet()->mergeCells("E$fila:G$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$fila"); //establecer estilo
  

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", "Recursos Humanos");
  $objPHPExcel->getActiveSheet()->mergeCells("H$fila:J$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila",  "Jefe de Area");
  $objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$fila"); //establecer estilo
  

   $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:M$fila");
 

  $objPHPExcel->getActiveSheet() ->getStyle("B$fila:M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $fila=49;

  $filaX=49;
  $filaY=52;

 

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($resPro["des_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("B$filaX:D$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "B$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($resPro["apro_jef_ope"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("E$filaX:G$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "E$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($resPro["apro_rrhh"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("H$filaX:J$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "H$filaX"); //establecer estilo

  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($resPro["nivel_idioma"])); 
  $objPHPExcel->getActiveSheet()->mergeCells("K$filaX:M$filaY");
  $objPHPExcel->getActiveSheet()->setSharedStyle($titulo4, "K$filaX"); //establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$filaX:M$filaY");
 
  $objPHPExcel->getActiveSheet() ->getStyle("B$filaX:M$filaY")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);











  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(6);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);







//establecer pie de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="PapeletaPermiso.xls"');
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
