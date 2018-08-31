<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;

header('Content-Type: text/html; charset=ISO-8859-1');

$id = $_GET["id"];

 
//ajuntar la libreria excel
include "Classes/PHPExcel.php";
include "../library/consulSQL.php";
 
 $conexion=mysql_connect("localhost","root","");
    mysql_select_db("vasco",$conexion);   

   
         $fecha=date("d/m/Y");

        $UsuReg=$_SESSION['usuario']['Login'];



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte de Nota de Ingreso"); //titulo
 
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


$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte de Notas de Ingreso"); //establecer titulo de hoja
 
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
 


// //incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// $objDrawing->setPath('phpexcel_logo.jpg'); //ruta
// $objDrawing->setHeight(75); //altura
// $objDrawing->setCoordinates('A1');
// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
// //fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);


	
    $sqlPro=mysql_query("SELECT distinct Nea.tNea, Nea.sNea, Nea.nNea,  (SELECT DISTINCT tb.Des_Larga FROM Tabla_M_Detalle  AS tb WHERE tb.Cod_Tabla='TEMI'AND tb.Cod_Argumento= Nea.TrGuia) AS TipDocGuia, Nea.SerGuia, Nea.NroGuia, Nea.TipOc, Nea.SerOc,DATE_FORMAT(Nea.FecEmi, '%d/%m/%Y') AS FecEmi , 
        Nea.Mo,(SELECT  distinct tb.Des_Larga FROM Tabla_M_Detalle  AS tb where tb.Cod_Tabla='TMON'and tb.Cod_Argumento= Nea.Mo) as moneda,
         Nea.trDcto, Nea.srDcto, Nea.nrDcto, Nea.EstReg, 
        pro.UbiPro,IFNULL((SELECT distinct ubi.Distrito FROM Ubigeo  AS ubi where ubi.Codigo= pro.UbiPro),'') as distrito,
          Nea.CodRuc, (SELECT distinct tb.Des_Larga FROM Tabla_M_Detalle  AS tb where tb.Cod_Tabla='TEMI'and tb.Cod_Argumento= Nea.trDcto) as TipDoc,
           pro.RazPro, CONCAT(pro.Telpro1 , ' - ', pro.TelPro2) AS telefono, pro.RucPro,  pro.DirPro AS DirPro, Nea.NroOc, Nea.UsuReg
    FROM    Nea As Nea,Proveedor As pro
    where  Nea.CodRuc = pro.CodRuc
    
            and Nea.nNea= $id " );
    
     
              
$resPro=mysql_fetch_array($sqlPro);



$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Empresa:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Tipo:');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resPro["tNea"]);   
$objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "G$fila");





$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Serie:');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resPro["sNea"]);   
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode('0000');    
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "G$fila");
 

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Registrado por:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["UsuReg"]);  
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Número:');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resPro["nNea"]);  
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode('000000');    

 
 $fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "");
			

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'T.Documento');  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Serie');  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Número');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $fecha); 
 $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $resPro["TipDoc"]);  
  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["srDcto"]); 
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('000'); 
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $resPro["nrDcto"]);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getNumberFormat()->setFormatCode('0000000'); 
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Nro OC');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila",  $resPro["NroOc"]);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode('000000');  
// $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "Hora:");  
// $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $hora); 

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'T.Documento');  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Serie');  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nro');



$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $resPro["TipDocGuia"]);  
  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["SerGuia"]); 
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('000'); 
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $resPro["NroGuia"]);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getNumberFormat()->setFormatCode('0000000'); 
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



$fila=9;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'F.Emision :');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["FecEmi"]);   
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Proveedor :'); 
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($resPro["RazPro"])); 
 $objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");
      
 

  $fila=10;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Moneda: ');  
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["moneda"]);  
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Direccion: ');    
   $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($resPro["DirPro"]));    
  $objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");
  

  $fila=11;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Almacen: ");  
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "MATERIA PRIMA");   
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Telefonos:"); 
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($resPro["telefono"]));  
   $objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");



$fila=13;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "NOTA DE INGRESO AL ALMACEN - MATERIA PRIMA");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:H$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:H$fila"); //establecer estilo

$fila=14;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');

//titulos de columnas
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITE');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'P.UNITARIO');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:H$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:H$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido

    $sql=mysql_query("SELECT  DISTINCT  pro.DesPro, pro.CodFab, TbCol.Des_Larga AS  color,  nd.Item, 
        nd.CanSol,  nd.CodPro,  nd.p_unitario, nd.Total AS Total1 
    FROM    NeaDet nd
    INNER JOIN Producto AS pro ON
      nd.CodPro=pro.CodPro
    LEFT JOIN Tabla_M_Detalle  AS TbUnd ON
       pro.UndPro=TbUnd.Cod_Argumento
      AND TbUnd.Cod_Tabla='TUND'
    LEFT JOIN  Tabla_M_Detalle AS TbCol  ON 
       pro.ColPro=TbCol.Cod_Argumento
      AND TbCol.Cod_Tabla='TCOL' 
    LEFT JOIN  ocomdet AS ocd  ON 
       ocd.Nro=nd.NDoc
       AND ocd.CodPro=pro.CodPro
    LEFT JOIN nea ne ON
       ne.nNea= nd.nNea
    WHERE  nd.nNea=$id 
        ORDER BY Item ASC

        ");
          
while($res=mysql_fetch_array($sql)){    

 
 

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila",  utf8_encode($res["Item"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila",  utf8_encode($res["CodPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila",  utf8_encode($res["DesPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  utf8_encode($res["color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($res["CanSol"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila",  utf8_encode($res["p_unitario"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila",  utf8_encode($res["Total1"]));

  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:H$fila");

  $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000');  
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 


 }
 
$sqlPro=mysql_query("SELECT  distinct SubTotal, Igv, Total
  FROM    Nea  
    where nNea=$id" );
                  
$resTot=mysql_fetch_array($sqlPro);

//insertar formula
$fila+=1;
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'SUB TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resTot["SubTotal"]);
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'I.G.V. 18%');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resTot["Igv"]);
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resTot["Total"]);

 


  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);





$fila+=1;
$fila+=1;
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Logistica");    
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", " V°B° Gerencia");
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "Elvis Huamana S.");
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    


$objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila"); //establecer estilo
 


 $fila+=1;
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "OBSERVACIONES: "); 
 $objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila");
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "1.- En la Factura y en la Guía de Remisión, hacer referencia al Número de Orden de Compra. "); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "2.- La mercadería se entregará en el Almacén adjuntando original de : Guía de Remisión, Factura y Letras si fuese el caso."); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "3.- El almacen recepcionará la documentación y derivara la misma a Logistica con su visto bueno. "); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "4.- La mercaderia de no ajustarse a las caracteristicas solicitadas, será devuelto. "); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "5.- Para el caso de Letras, el pago de las mismas no deberan coincidir con los dias 15 y 30 de cada Mes."); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "6.- El monto maximo en la generación de una Letra no deberá exceder los S/. 15000."); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "7.- Horario de Recepción de mercaderia : Lunes a Viernes 8:00 a 13:00  y  14:00 a 17:00 pm. / Sabados: 8:00 a 11:00 am. "); 
 $fila+=1;
 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "8.- Dirección : Calle Sto Toribio 259 Urb. Santa Luisa SMP - LIMA "); 
 



$objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila"); //establecer estilo




//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);






//Escribir archivo
 
// Establecer formado de Excel 2003


header("Content-Type: application/vnd.ms-excel");












 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_NotaIngreso.xls"');

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