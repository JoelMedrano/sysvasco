<?php
 


session_start();





//ajuntar la libreria excel
include "Classes/PHPExcel.php";


$conexion=mysql_connect("192.168.1.23","admin","vasco123");
mysql_select_db("db_corpvasco",$conexion);   


   $fecha=date("d/m/Y");

              



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi Godos"); //autor
$objPHPExcel->getProperties()->setTitle("Planilla"); //titulo


 
//Cabecera del titulo de horas extras en color entero
$cabecera_descuentos = new PHPExcel_Style(); //nuevo estilo
$cabecera_descuentos->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'F7BE81')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 9
    )
));
 //ABF489;

$cabecera_abonos = new PHPExcel_Style(); //nuevo estilo
$cabecera_abonos->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => '81F781')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 9
    )
));

$regularizaciones = new PHPExcel_Style(); //nuevo estilo
$regularizaciones->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'F4FA58')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 9
    )
));


$cab_principal = new PHPExcel_Style(); //nuevo estilo
$cab_principal->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => '58FAF4')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));





//
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


 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 9
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



$observaciones = new PHPExcel_Style(); //nuevo estilo
$observaciones->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 9
    )
));

 

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
 


 $sqlPro=mysql_query("SELECT
MAX(CASE WHEN r.id='1' THEN r.dia ELSE '-' END) AS 'd_ini1',
MAX(CASE WHEN r.id='2' THEN r.dia ELSE '-' END) AS 'd_ini2',
MAX(CASE WHEN r.id='3' THEN r.dia ELSE '-' END) AS 'd_ini3',
MAX(CASE WHEN r.id='4' THEN r.dia ELSE '-' END) AS 'd_ini4',
MAX(CASE WHEN r.id='5' THEN r.dia ELSE '-' END) AS 'd_ini5',
MAX(CASE WHEN r.id='6' THEN r.dia ELSE '-' END) AS 'd_ini6',
MAX(CASE WHEN r.id='7' THEN r.dia ELSE '-' END) AS 'd_ini7',
MAX(CASE WHEN r.id='8' THEN r.dia ELSE '-' END) AS 'd_ini8',
MAX(CASE WHEN r.id='9' THEN r.dia ELSE '-' END) AS 'd_ini9',
MAX(CASE WHEN r.id='10' THEN r.dia ELSE '-' END) AS 'd_ini10',
MAX(CASE WHEN r.id='11' THEN r.dia ELSE '-' END) AS 'd_ini11',
MAX(CASE WHEN r.id='12' THEN r.dia ELSE '-' END) AS 'd_ini12',
MAX(CASE WHEN r.id='13' THEN r.dia ELSE '-' END) AS 'd_ini13',
MAX(CASE WHEN r.id='14' THEN r.dia ELSE '-' END) AS 'd_ini14',
MAX(CASE WHEN r.id='15' THEN r.dia ELSE '-' END) AS 'd_ini15',
MAX(CASE WHEN r.id='16' THEN r.dia ELSE '-' END) AS 'd_ini16',
MAX(CASE WHEN r.id='1' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini1',
MAX(CASE WHEN r.id='2' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini2',
MAX(CASE WHEN r.id='3' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini3',
MAX(CASE WHEN r.id='4' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini4',
MAX(CASE WHEN r.id='5' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini5',
MAX(CASE WHEN r.id='6' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini6',
MAX(CASE WHEN r.id='7' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini7',
MAX(CASE WHEN r.id='8' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini8',
MAX(CASE WHEN r.id='9' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini9',
MAX(CASE WHEN r.id='10' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini10',
MAX(CASE WHEN r.id='11' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini11',
MAX(CASE WHEN r.id='12' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini12',
MAX(CASE WHEN r.id='13' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini13',
MAX(CASE WHEN r.id='14' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini14',
MAX(CASE WHEN r.id='15' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini15',
MAX(CASE WHEN r.id='16' THEN r.dia_letra ELSE '-' END) AS 'nom_d_ini16'
FROM fechas fe
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe.fecha) AS dia,
   MONTH(fe.fecha) AS mes,
   SUBSTRING(fe.nom_dia, 1, 3) AS dia_letra
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe
 WHERE fe.fecha BETWEEN '2019-04-28' AND '2019-05-13'
 ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
)  AS r
ON DAY(fe.fecha)=r.dia;" );
    
     
              
$resPro=mysql_fetch_array($sqlPro);




$fila=1;




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "REGISTRO FALTAS Y HORAS EXTRAS");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:D$fila"); //unir celdas
//$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:D$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->setSharedStyle($cab_principal, "B$fila:D$fila"); //establecer estilo


$objPHPExcel->getActiveSheet()->setSharedStyle($cabecera_descuentos, "M$fila:AF$fila"); //establecer estilo

$objPHPExcel->getActiveSheet()->setSharedStyle($cabecera_abonos, "AH$fila:BE$fila"); //establecer estilo
 
$fila=3;


$objPHPExcel->getActiveSheet()->SetCellValue("O$fila",  utf8_encode($resPro["nom_d_ini1"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila",  utf8_encode($resPro["nom_d_ini2"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila",  utf8_encode($resPro["nom_d_ini3"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila",  utf8_encode($resPro["nom_d_ini4"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila",  utf8_encode($resPro["nom_d_ini5"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila",  utf8_encode($resPro["nom_d_ini6"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila",  utf8_encode($resPro["nom_d_ini7"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila",  utf8_encode($resPro["nom_d_ini8"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila",  utf8_encode($resPro["nom_d_ini9"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila",  utf8_encode($resPro["nom_d_ini10"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila",  utf8_encode($resPro["nom_d_ini11"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila",  utf8_encode($resPro["nom_d_ini12"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila",  utf8_encode($resPro["nom_d_ini13"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila",  utf8_encode($resPro["nom_d_ini14"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila",  utf8_encode($resPro["nom_d_ini15"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila",  utf8_encode($resPro["nom_d_ini16"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro["nom_d_ini1"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro["nom_d_ini2"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro["nom_d_ini3"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro["nom_d_ini4"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro["nom_d_ini5"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro["nom_d_ini6"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro["nom_d_ini7"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro["nom_d_ini8"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro["nom_d_ini9"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro["nom_d_ini10"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro["nom_d_ini11"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro["nom_d_ini12"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro["nom_d_ini13"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro["nom_d_ini14"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro["nom_d_ini15"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro["nom_d_ini16"])); 


$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:BE$fila");

//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

$objPHPExcel->getActiveSheet()->freezePane('E5');


$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'DNI');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'APELLIDOS Y NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'FEC.INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FEC.CESE');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TIP.PLANILLA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'SUCURSAL');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'FORMA.PAGO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'CAT.LABORAL');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'REG - FALTAS HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'REG - FALTAS DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila",  utf8_encode($resPro["d_ini1"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila",  utf8_encode($resPro["d_ini2"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila",  utf8_encode($resPro["d_ini3"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila",  utf8_encode($resPro["d_ini4"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila",  utf8_encode($resPro["d_ini5"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila",  utf8_encode($resPro["d_ini6"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila",  utf8_encode($resPro["d_ini7"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila",  utf8_encode($resPro["d_ini8"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila",  utf8_encode($resPro["d_ini9"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila",  utf8_encode($resPro["d_ini10"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila",  utf8_encode($resPro["d_ini11"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila",  utf8_encode($resPro["d_ini12"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila",  utf8_encode($resPro["d_ini13"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila",  utf8_encode($resPro["d_ini14"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila",  utf8_encode($resPro["d_ini15"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila",  utf8_encode($resPro["d_ini16"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila",  'TOTAL HORAS FALTAS'); 
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila",  'TOTAL DIAS FALTAS');
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'Reg. H.EXTRA AL 25%');
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'Reg. H.EXTRA AL 35%');
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'Reg. DOMINGO');
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'Reg. FERIADO');
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro["d_ini1"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro["d_ini2"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro["d_ini3"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro["d_ini4"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro["d_ini5"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro["d_ini6"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro["d_ini7"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro["d_ini8"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro["d_ini9"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro["d_ini10"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro["d_ini11"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro["d_ini12"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro["d_ini13"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro["d_ini14"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro["d_ini15"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro["d_ini16"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("BB$fila",  'TOTAL H.EXTRA AL  25 %'); 
$objPHPExcel->getActiveSheet()->SetCellValue("BC$fila",  'TOTAL H.EXTRA AL  35 %');
$objPHPExcel->getActiveSheet()->SetCellValue("BD$fila",  'DOMINGO');    
$objPHPExcel->getActiveSheet()->SetCellValue("BE$fila",  'FERIADO');    






$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:BE$fila");

$objPHPExcel->getActiveSheet()->setSharedStyle($cabecera_descuentos, "AE$fila:AF$fila");

$objPHPExcel->getActiveSheet()->setSharedStyle($regularizaciones, "M$fila:N$fila");

$objPHPExcel->getActiveSheet()->setSharedStyle($regularizaciones, "AH$fila:AK$fila");

$objPHPExcel->getActiveSheet()->setSharedStyle($cabecera_abonos, "BB$fila:BE$fila");


$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("AE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AF$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("AH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AK$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("AY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AZ$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("BA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BD$fila")->getAlignment()->setWrapText(true);




//rellenar con contenido

$sql=mysql_query("SELECT  tr.id_trab,
        CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres,
        tpla.des_larga AS tipo_planilla,
        IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
        tr.id_form_pag, tfop.des_larga AS forma_pago,
        tfun.des_larga AS funcion,
        tare.des_larga AS area_trab, 
        tr.id_tip_doc, 
        tcal.des_larga AS categoria_laboral,
        tr.num_doc_trab,
        DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
        IF( DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')) AS fec_sal_trab,
  IF(hpp_reg.cant_horas='00:00' OR hpp_reg.cant_horas IS NULL, '', hpp_reg.cant_horas) AS horasdscto_regularizacion,
  IF(hpp_reg.cant_dias='0' OR hpp_reg.cant_dias IS NULL , '', hpp_reg.cant_dias ) AS diasdscto_regularizacion,
  MAX(CASE WHEN hpp.id_dscto='1' THEN hpp.dato ELSE '' END) AS 'd_ini1',
  MAX(CASE WHEN hpp.id_dscto='2' THEN hpp.dato ELSE '' END) AS 'd_ini2',
  MAX(CASE WHEN hpp.id_dscto='3' THEN hpp.dato ELSE '' END) AS 'd_ini3',
  MAX(CASE WHEN hpp.id_dscto='4' THEN hpp.dato ELSE '' END) AS 'd_ini4',
  MAX(CASE WHEN hpp.id_dscto='5' THEN hpp.dato ELSE '' END) AS 'd_ini5',
  MAX(CASE WHEN hpp.id_dscto='6' THEN hpp.dato ELSE '' END) AS 'd_ini6',
  MAX(CASE WHEN hpp.id_dscto='7' THEN hpp.dato ELSE '' END) AS 'd_ini7',
  MAX(CASE WHEN hpp.id_dscto='8' THEN hpp.dato ELSE '' END) AS 'd_ini8',
  MAX(CASE WHEN hpp.id_dscto='9' THEN hpp.dato ELSE '' END) AS 'd_ini9',
  MAX(CASE WHEN hpp.id_dscto='10' THEN hpp.dato ELSE '' END) AS 'd_ini10',
  MAX(CASE WHEN hpp.id_dscto='11' THEN hpp.dato ELSE '' END) AS 'd_ini11',
  MAX(CASE WHEN hpp.id_dscto='12' THEN hpp.dato ELSE '' END) AS 'd_ini12',
  MAX(CASE WHEN hpp.id_dscto='13' THEN hpp.dato ELSE '' END) AS 'd_ini13',
  MAX(CASE WHEN hpp.id_dscto='14' THEN hpp.dato ELSE '' END) AS 'd_ini14',
  MAX(CASE WHEN hpp.id_dscto='15' THEN hpp.dato ELSE '' END) AS 'd_ini15',
  MAX(CASE WHEN hpp.id_dscto='16' THEN hpp.dato ELSE '' END) AS 'd_ini16',
  IF(DATE_FORMAT( ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   )  , '%H:%i')='00:00' , '', DATE_FORMAT( ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   )  , '%H:%i') )AS tot_cant_horas,
   IF(
  SUM(
  CASE WHEN hpp_reg.cant_dias='' THEN  '0'
  WHEN hpp_reg.cant_dias IS NULL THEN '0' 
  ELSE hpp_reg.cant_dias  END
   + CASE WHEN fcc.cant_dias='' THEN '0' 
  WHEN fcc.cant_dias IS NULL THEN '0' 
  ELSE fcc.cant_dias   END 
   )='0' , '',SUM(
  CASE WHEN hpp_reg.cant_dias='' THEN  '0'
  WHEN hpp_reg.cant_dias IS NULL THEN '0' 
  ELSE hpp_reg.cant_dias  END
   + CASE WHEN fcc.cant_dias='' THEN '0' 
  WHEN fcc.cant_dias IS NULL THEN '0' 
  ELSE fcc.cant_dias   END 
   ))  AS tot_cant_dias,
  '-' AS separador, 
  fhe_reg.cant_horas_al25 AS horasal25_abono_regularizacion,
  fhe_reg.cant_horas_al35 AS horasal35_abono_regularizacion,
  fhe_reg.cant_horas_dom  AS horasdom_abono_regularizacion,  
  fhe_reg.cant_horas_fer  AS horasfer_abono_regularizacion,
  MAX(CASE WHEN r_ext.id='1' THEN hep.dato ELSE '' END) AS 'd_ini1_ext',
  MAX(CASE WHEN r_ext.id='2' THEN hep.dato ELSE '' END) AS 'd_ini2_ext',
  MAX(CASE WHEN r_ext.id='3' THEN hep.dato ELSE '' END) AS 'd_ini3_ext',
  MAX(CASE WHEN r_ext.id='4' THEN hep.dato ELSE '' END) AS 'd_ini4_ext',
  MAX(CASE WHEN r_ext.id='5' THEN hep.dato ELSE '' END) AS 'd_ini5_ext',
  MAX(CASE WHEN r_ext.id='6' THEN hep.dato ELSE '' END) AS 'd_ini6_ext',
  MAX(CASE WHEN r_ext.id='7' THEN hep.dato ELSE '' END) AS 'd_ini7_ext',
  MAX(CASE WHEN r_ext.id='8' THEN hep.dato ELSE '' END) AS 'd_ini8_ext',
  MAX(CASE WHEN r_ext.id='9' THEN hep.dato ELSE '' END) AS 'd_ini9_ext',
  MAX(CASE WHEN r_ext.id='10' THEN hep.dato ELSE '' END) AS 'd_ini10_ext',
  MAX(CASE WHEN r_ext.id='11' THEN hep.dato ELSE '' END) AS 'd_ini11_ext',
  MAX(CASE WHEN r_ext.id='12' THEN hep.dato ELSE '' END) AS 'd_ini12_ext',
  MAX(CASE WHEN r_ext.id='13' THEN hep.dato ELSE '' END) AS 'd_ini13_ext',
  MAX(CASE WHEN r_ext.id='14' THEN hep.dato ELSE '' END) AS 'd_ini14_ext',
  MAX(CASE WHEN r_ext.id='15' THEN hep.dato ELSE '' END) AS 'd_ini15_ext',
  MAX(CASE WHEN r_ext.id='16' THEN hep.dato ELSE '' END) AS 'd_ini16_ext',
  IF(DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   ), '%H:%i')='00:00', '', 
   DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   ), '%H:%i')
   ) AS tot_cant_horas_al25,
  IF(DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   ), '%H:%i') ='00:00', '' , 
  DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   ), '%H:%i')
   ) AS tot_cant_horas_al35, 
  IF(DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   ), '%H:%i') ='00:00', '', 
   DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   ), '%H:%i')
   ) AS tot_cant_horas_dom, 
  IF(DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   ), '%H:%i') ='00:00', '' ,
  DATE_FORMAT(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   ), '%H:%i')  
    )AS tot_cant_horas_fer
FROM Trabajador tr
LEFT JOIN tabla_maestra_detalle AS tpla ON
    tpla.cod_argumento= tr.id_tip_plan
    AND tpla.cod_tabla='TPLA'
LEFT JOIN tabla_maestra_detalle AS tsua ON
    tsua.cod_argumento= tr.id_sucursal
    AND tsua.cod_tabla='TSUA' OR tsua.cod_tabla IS NULL
LEFT JOIN tabla_maestra_detalle AS tfun ON
    tfun.cod_argumento= tr.id_funcion
    AND tfun.cod_tabla='TFUN'
LEFT JOIN tabla_maestra_detalle AS tare ON
    tare.cod_argumento= tr.id_area
    AND tare.cod_tabla='TARE'
LEFT JOIN tabla_maestra_detalle AS tcal ON
    tcal.cod_argumento= tr.id_categoria
    AND tcal.cod_tabla='TCAL' 
LEFT JOIN tabla_maestra_detalle AS tfop ON
    tfop.cod_argumento= tr.id_form_pag
    AND tfop.cod_tabla='TFOP' 
LEFT JOIN /*Regularizacion de horas y dias de descuento */
( SELECT tr.id_trab, DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))), '%H:%i') AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
       FROM horas_permiso_personal hpp
       WHERE  hpp.fecha NOT BETWEEN '2018-10-30' AND '2018-11-13'
       AND  hpp.id_fec_dscto='22'
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS hpp_reg ON tr.id_trab =  hpp_reg.id_trab
LEFT JOIN 
( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, r.id_dscto 
  FROM horas_permiso_personal hpp
  LEFT JOIN/* INICIO  - El que causa conflicto*/
  (SELECT  (@o := @o + 1)  AS id_dscto ,
     DAY(fe.fecha) AS dia_dscto,
     MONTH(fe.fecha) AS mes_dscto
   FROM (SELECT @o:=0) r
     INNER JOIN fechas fe
   WHERE fe.fecha BETWEEN '2018-10-30' AND '2018-11-13'
   ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
  )  AS r 
  ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
) AS hpp ON tr.id_trab =  hpp.id_trab
  AND hpp.fecha BETWEEN '2018-10-30' AND '2018-11-13'
LEFT JOIN 
( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
        FROM horas_permiso_personal hpp
  WHERE  hpp.fecha BETWEEN '2018-10-30' AND '2018-11-13'
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS fcc ON fcc.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
FROM horas_extras_personal hep
) AS hep ON tr.id_trab =  hep.id_trab
AND hep.fecha BETWEEN '2018-10-30' AND '2018-11-13' 
LEFT JOIN /*Regularizacion de horas y dias de abono */
( SELECT tr.id_trab, 
         CASE 
    WHEN  hep.por_pago='25' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')  
    ELSE ''  END
    AS cant_horas_al25,
         CASE 
    WHEN  hep.por_pago='35' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')  
    ELSE ''  END
    AS cant_horas_al35,
   CASE 
    WHEN  hep.por_pago='100' AND est_dia='NO LABORABLE' THEN DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))) , '%H:%i')  
    ELSE ''  END
    AS cant_horas_dom,
   CASE 
    WHEN  hep.por_pago='100' AND est_dia='FERIADO' THEN  DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.dato))), '%H:%i')   
    ELSE ''  END
    AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha, hep.tiempo_fin, hep.por_pago, hep.est_dia
       FROM horas_extras_personal hep
       WHERE  hep.fecha NOT BETWEEN '2018-10-30' AND '2018-11-13'
       AND  hep.id_fec_abono='22'
  )AS hep ON tr.id_trab =  hep.id_trab
  GROUP BY tr.id_trab  
) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT tr.id_trab, 
         CASE 
      WHEN  hep.por_pago='25' THEN SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin)))
      ELSE ''  END
     AS cant_horas_al25, 
   CASE 
      WHEN  hep.por_pago='35' THEN SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin)))
      ELSE ''  END
     AS cant_horas_al35,  
   CASE 
      WHEN  hep.por_pago='100' AND est_dia='NO LABORABLE' THEN SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin)))
      ELSE ''  END
     AS cant_horas_dom,
   CASE 
      WHEN  hep.por_pago='100' AND est_dia='FERIADO' THEN SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin)))
      ELSE ''  END
     AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha, hep.tiempo_fin, hep.por_pago, hep.est_dia
       FROM horas_extras_personal hep
       WHERE  hep.fecha BETWEEN '2018-10-30' AND '2018-11-13'
  )AS hep ON tr.id_trab =  hep.id_trab
  GROUP BY tr.id_trab  
) AS fhe ON fhe.id_trab= tr.id_trab 
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe_ext.fecha) AS dia,
   MONTH(fe_ext.fecha) AS mes,
   fr_ext.dia AS dia_reg,
   fr_ext.mes AS mes_reg
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe_ext
   LEFT JOIN (
  SELECT 
      DAY(fecha) AS dia,
      MONTH(fecha) AS mes
  FROM horas_extras_personal hep
  WHERE hep.fecha BETWEEN '2018-10-30' AND '2018-11-13'
  GROUP BY DAY(fecha)
   ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
 WHERE fe_ext.fecha BETWEEN '2018-10-30' AND '2018-11-13'
 ORDER BY MONTH(fe_ext.fecha) ASC,  DAY(fe_ext.fecha) ASC
)  AS r_ext
ON DAY(hep.fecha)=r_ext.dia
WHERE tr.est_reg='1'
GROUP BY tr.id_trab;

  ");  





    


         
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;

  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["nombres"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["fec_sal_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["tipo_planilla"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["sucursal_anexo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["forma_pago"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["categoria_laboral"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["horasdscto_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["diasdscto_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["d_ini1"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["d_ini2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["d_ini3"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["d_ini4"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["d_ini5"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($res["d_ini6"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($res["d_ini7"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($res["d_ini8"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($res["d_ini9"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", utf8_encode($res["d_ini10"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", utf8_encode($res["d_ini11"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", utf8_encode($res["d_ini12"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", utf8_encode($res["d_ini13"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", utf8_encode($res["d_ini14"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", utf8_encode($res["d_ini15"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", utf8_encode($res["d_ini16"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", utf8_encode($res["tot_cant_horas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", utf8_encode($res["tot_cant_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", '-');
  $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", utf8_encode($res["horasal25_abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", utf8_encode($res["horasal35_abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", utf8_encode($res["horasdom_abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", utf8_encode($res["horasfer_abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($res["d_ini1_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($res["d_ini2_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($res["d_ini3_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($res["d_ini4_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($res["d_ini5_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($res["d_ini6_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($res["d_ini7_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($res["d_ini8_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($res["d_ini9_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($res["d_ini10_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($res["d_ini11_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($res["d_ini12_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($res["d_ini13_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($res["d_ini14_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($res["d_ini15_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($res["d_ini16_ext"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", utf8_encode($res["tot_cant_horas_al25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", utf8_encode($res["tot_cant_horas_al35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", utf8_encode($res["tot_cant_horas_dom"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BE$fila", utf8_encode($res["tot_cant_horas_fer"]));
  


  
 


 
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
  $objPHPExcel->getActiveSheet() ->getStyle("T$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("U$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("W$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("X$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:BE$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "B$fila:BE$fila");
  


 


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
 



  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(23);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(10);

  







//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003S
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="PLANILLA.xls"');
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