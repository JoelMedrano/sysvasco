<?php
 


session_start();





   //ajuntar la libreria excel
include "Classes/PHPExcel.php";
include "../library/consulSQL.php";


 $conexion=mysql_connect("localhost","root","");
    mysql_select_db("vasco",$conexion);   


   $fecha=date("d/m/Y");

                $UsuReg=$_SESSION['usuario']['Login'];



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Kiuvox"); //autor
$objPHPExcel->getProperties()->setTitle("E - Reporte de Stock Actual"); //titulo
 
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
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Reporte de Stock Actual"); //establecer titulo de hoja
 
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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Empresa:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Fecha:');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $fecha);




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');
// $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Hora:');
// $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $hora);


$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Usuario:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $UsuReg);  


$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "RESUMEN - LISTADO OC EMITIDAS");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila"); //establecer estilo
 
//titulos de columnas
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NRO.OC');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'RAZON SOCIAL');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TELEFONO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TIPO');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'COD.FABRICA');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'UNIDAD');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'PRECIO');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'F.EMISION');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'F.PROGRAM');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'F.ENTREGA');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'CAN.PEDIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'CAN.RECIBIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'SALDO');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:S$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:S$fila")->getFont()->setBold(true); //negrita
 






//rellenar con contenido

   
  
    $sql=mysql_query("SELECT DISTINCT  oComDet.Nro AS Nro,
 Proveedor.RazPro,
 CONCAT(Proveedor.Telpro1 , ' - ', Proveedor.TelPro2) AS Telefono,
 oComDet.Tip AS TipDoc,
 NULL SerDoc,
 NULL NroDoc,
 oComDet.Item, 
 oComDet.CodPro,
 oComDet.CodFab, 
 Producto.DesPro,
Tabla_M_Detalle_1.Des_Larga AS Color,
 Tabla_M_Detalle_2.Des_Corta AS Unidad,
 oComDet.PrePro,
DATE_FORMAT(oCompra.FecEmi, '%d/%m/%Y')  AS FecEmi,
DATE_FORMAT(oCompra.Fecllegada, '%d/%m/%Y')  AS FecProg,
 NULL FecEnt,
 oComDet.CanPro AS CanPed, 
 IFNULL(nd.CanSol,0.000000) AS CanRec,
(oComDet.CanPro - ( IFNULL(nd.CanSol,0.000000))) AS Saldo, 
 'EMITIDO' AS Estado
    FROM    oComDet
     LEFT JOIN Producto ON 
         oComDet.CodPro = Producto.CodPro
     LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 ON 
         Producto.ColPro = Tabla_M_Detalle_1.Cod_Argumento
     LEFT JOIN  Tabla_M_Detalle AS Tabla_M_Detalle_2 ON 
         Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento
    LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_3 ON 
         ColProv = Tabla_M_Detalle_3.Cod_Argumento
         AND (Tabla_M_Detalle_3.Cod_Tabla = 'TCOL' OR Tabla_M_Detalle_3.Cod_Tabla IS NULL)
    LEFT JOIN oCompra  ON 
      oComDet.Nro = oCompra.Nro
     AND oCompra.estac='ABI'
     AND oCompra.EstOco='03'
     AND oCompra.FecEmi LIKE '%2018%'
    LEFT JOIN
    (SELECT DISTINCT NeaDet.CanSol AS CanSol,NeaDet.CodPro AS CodPro,  oComDet.Nro 
    FROM Nea, NeaDet, oComDet, oCompra 
  WHERE Nea.nNea= NeaDet.nNea 
  AND oComDet.Nro=Nea.NroOc
  AND neadet.CodPro = oComDet.CodPro
  AND neadet.FecReg LIKE '%2018%'
  AND neadet.EstReg='P'
  AND oCompra.estac='ABI'
        AND oCompra.EstOco='03'
        AND oCompra.FecEmi LIKE '%2018%'
    )  nd  ON nd.CodPro= oComDet.CodPro
      AND nd.Nro=oComDet.Nro
   LEFT JOIN Proveedor  ON oCompra.CodRuc = Proveedor.CodRuc
     WHERE (Tabla_M_Detalle_1.Cod_Tabla = 'TCOL'OR Tabla_M_Detalle_1.Cod_Tabla IS NULL) 
     AND (Tabla_M_Detalle_2.Cod_Tabla = 'TUND' OR Tabla_M_Detalle_2.Cod_Tabla IS NULL)
     AND oCompra.FecEmi LIKE '%2018%'
ORDER BY oComDet.Nro DESC, oComDet.Item ASC
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

  $CodPro=$res["CodPro"]; 
  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["CodPro"]);
 
  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["Nro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["RazPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["Telefono"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["TipDoc"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["Item"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["CodPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["CodFab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["DesPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["Color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["PrePro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["FecEmi"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["FecProg"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["FecEnt"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["CanPed"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["CanRec"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["Saldo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["Estado"]));
  

  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:S$fila");
  $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getNumberFormat()->setFormatCode('000000');
   $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode('00000');  
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
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("N$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("O$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("P$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("Q$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("R$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("S$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
 

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
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(55);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);



//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_OCEmitidas.xls"');
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