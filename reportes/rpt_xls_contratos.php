<?php
 


session_start();





//ajuntar la libreria excel
include "Classes/PHPExcel.php";


$conexion=mysql_connect("192.168.1.24","admin","vasco123");
mysql_select_db("db_corpvasco",$conexion);   


   $fecha=date("d/m/Y");

              



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi Godos"); //autor
$objPHPExcel->getProperties()->setTitle("Vacaciones"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 20
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
 

//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("RESUMEN"); //establecer titulo de hoja
 
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
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'CONTRATOS');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CUADRO DE INFORMACION DE CONTRATOS");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila"); //establecer estilo
 
$fila=3;

//titulos de columnas
$fila+=1;

 

 
 

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ID');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'D.N.I');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'APELLIDOS Y NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'FECHA INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'SUCURSAL');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'MESES');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'FEC.INICIO');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'FEC.FIN');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:K$fila")->getFont()->setBold(true); //negrita
  










//rellenar con contenido

   
  
    $sql=mysql_query("SELECT  Tra.id_trab, Tra.num_doc_trab AS nro_doc,   CONCAT(Tra.apepat_trab, ' ' , 
  Tra.apemat_trab, ' ', Tra.nom_trab)   AS apellidosynombres,  TbAre.Des_Larga AS area_trab,
        TbSua.des_larga AS sucursal, DATE_FORMAT(fec_ing_trab, '%d/%m/%Y')  AS fec_ing_trab, 
                con.tie_ren_con AS tie_ren_ant, DATE_FORMAT(fec_ini_con, '%d/%m/%Y') AS fec_ini_con,
               DATE_FORMAT(fec_fin_con, '%d/%m/%Y') AS  fec_fin_con  
        FROM Trabajador Tra
        LEFT JOIN tabla_maestra_detalle TbAre ON
          TbAre.cod_tabla='TARE'
          AND TbAre.cod_argumento= Tra.id_area
        LEFT JOIN tabla_maestra_detalle TbSua ON
          TbSua.cod_tabla='TSUA'
          AND TbSua.cod_argumento= Tra.id_sucursal
        INNER JOIN contratos con ON
          con.id_trab= tra.id_trab
        ORDER BY fec_fin_con ASC;
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;
 

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["nro_doc"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["apellidosynombres"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["sucursal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["tie_ren_ant"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["fec_ini_con"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["fec_fin_con"]));


  //Establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:K$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  


  $objPHPExcel->getActiveSheet()
    ->getStyle('C3:C100')
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
 


 }
 
//insertar formula
// $fila+=2;
// $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'SUMA');
// $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '=1+2');
 
//recorrer las columnas
// foreach (range( 'C', 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J', 'K') as $columnID) {
//   //autodimensionar las columnas
//   $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
// }
 



  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);









//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003S
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="DATA_CONTRATOS.xls"');
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