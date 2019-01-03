<?php
 


session_start();




$id_cp=$_GET["id"];




//ajuntar la libreria excel
include "Classes/PHPExcel.php";


$conexion=mysql_connect("192.168.1.26","admin","vasco123");
mysql_select_db("db_corpvasco",$conexion);   


   $fecha=date("d/m/Y");




$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi Godos"); //autor

$objPHPExcel->getProperties()->setTitle("Planilla Primera Quincena"); //titulo


 
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



//PARA TODAS LAS HOJAS
$sqlPro=mysql_query("SELECT  cod_argumento, 
                      cod_tabla,  
                      des_larga AS mes, 
                      des_corta AS ano, 
                      valor_1 AS primera_quincena, 
                      valor_2  AS segunda_quincena ,
                      CONCAT( 'PLANILLA', ' ' ,des_larga , ' ' ,des_corta) AS nombre
                   FROM    tabla_maestra_detalle  
                    WHERE cod_tabla='TMES' 
                   AND cod_argumento='".$id_cp."'" );
                  
$resTot=mysql_fetch_array($sqlPro);    


$id_pri_quin=$resTot["primera_quincena"];

$id_seg_quin=$resTot["segunda_quincena"];
//PARA TODAS LAS HOJAS
 




//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Dsctos y Abonos 2da Quincena"); //establecer titulo de hoja
 
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
MAX(CASE WHEN r_falta.id='1' THEN r_falta.dia ELSE '-' END) AS 'd_ini1',
MAX(CASE WHEN r_falta.id='2' THEN r_falta.dia ELSE '-' END) AS 'd_ini2',
MAX(CASE WHEN r_falta.id='3' THEN r_falta.dia ELSE '-' END) AS 'd_ini3',
MAX(CASE WHEN r_falta.id='4' THEN r_falta.dia ELSE '-' END) AS 'd_ini4',
MAX(CASE WHEN r_falta.id='5' THEN r_falta.dia ELSE '-' END) AS 'd_ini5',
MAX(CASE WHEN r_falta.id='6' THEN r_falta.dia ELSE '-' END) AS 'd_ini6',
MAX(CASE WHEN r_falta.id='7' THEN r_falta.dia ELSE '-' END) AS 'd_ini7',
MAX(CASE WHEN r_falta.id='8' THEN r_falta.dia ELSE '-' END) AS 'd_ini8',
MAX(CASE WHEN r_falta.id='9' THEN r_falta.dia ELSE '-' END) AS 'd_ini9',
MAX(CASE WHEN r_falta.id='10' THEN r_falta.dia ELSE '-' END) AS 'd_ini10',
MAX(CASE WHEN r_falta.id='11' THEN r_falta.dia ELSE '-' END) AS 'd_ini11',
MAX(CASE WHEN r_falta.id='12' THEN r_falta.dia ELSE '-' END) AS 'd_ini12',
MAX(CASE WHEN r_falta.id='13' THEN r_falta.dia ELSE '-' END) AS 'd_ini13',
MAX(CASE WHEN r_falta.id='14' THEN r_falta.dia ELSE '-' END) AS 'd_ini14',
MAX(CASE WHEN r_falta.id='15' THEN r_falta.dia ELSE '-' END) AS 'd_ini15',
MAX(CASE WHEN r_falta.id='16' THEN r_falta.dia ELSE '-' END) AS 'd_ini16',
MAX(CASE WHEN r_falta.id='1' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini1',
MAX(CASE WHEN r_falta.id='2' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini2',
MAX(CASE WHEN r_falta.id='3' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini3',
MAX(CASE WHEN r_falta.id='4' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini4',
MAX(CASE WHEN r_falta.id='5' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini5',
MAX(CASE WHEN r_falta.id='6' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini6',
MAX(CASE WHEN r_falta.id='7' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini7',
MAX(CASE WHEN r_falta.id='8' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini8',
MAX(CASE WHEN r_falta.id='9' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini9',
MAX(CASE WHEN r_falta.id='10' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini10',
MAX(CASE WHEN r_falta.id='11' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini11',
MAX(CASE WHEN r_falta.id='12' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini12',
MAX(CASE WHEN r_falta.id='13' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini13',
MAX(CASE WHEN r_falta.id='14' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini14',
MAX(CASE WHEN r_falta.id='15' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini15',
MAX(CASE WHEN r_falta.id='16' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini16'
FROM fechas fe
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe.fecha) AS dia,
   MONTH(fe.fecha) AS mes,
   SUBSTRING(fe.nom_dia, 1, 3) AS dia_letra
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
   cp.id_cp= '".$id_seg_quin."'
 WHERE fe.fecha BETWEEN cp.`desde` AND cp.`hasta`
 ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
)  AS r_falta
ON DAY(fe.fecha)=r_falta.dia
;" );
    
     
              
$resPro=mysql_fetch_array($sqlPro);




 $sqlPro2=mysql_query("SELECT
MAX(CASE WHEN r_he.id='1' THEN r_he.dia ELSE '-' END) AS 'd_ini1_he',
MAX(CASE WHEN r_he.id='2' THEN r_he.dia ELSE '-' END) AS 'd_ini2_he',
MAX(CASE WHEN r_he.id='3' THEN r_he.dia ELSE '-' END) AS 'd_ini3_he',
MAX(CASE WHEN r_he.id='4' THEN r_he.dia ELSE '-' END) AS 'd_ini4_he',
MAX(CASE WHEN r_he.id='5' THEN r_he.dia ELSE '-' END) AS 'd_ini5_he',
MAX(CASE WHEN r_he.id='6' THEN r_he.dia ELSE '-' END) AS 'd_ini6_he',
MAX(CASE WHEN r_he.id='7' THEN r_he.dia ELSE '-' END) AS 'd_ini7_he',
MAX(CASE WHEN r_he.id='8' THEN r_he.dia ELSE '-' END) AS 'd_ini8_he',
MAX(CASE WHEN r_he.id='9' THEN r_he.dia ELSE '-' END) AS 'd_ini9_he',
MAX(CASE WHEN r_he.id='10' THEN r_he.dia ELSE '-' END) AS 'd_ini10_he',
MAX(CASE WHEN r_he.id='11' THEN r_he.dia ELSE '-' END) AS 'd_ini11_he',
MAX(CASE WHEN r_he.id='12' THEN r_he.dia ELSE '-' END) AS 'd_ini12_he',
MAX(CASE WHEN r_he.id='13' THEN r_he.dia ELSE '-' END) AS 'd_ini13_he',
MAX(CASE WHEN r_he.id='14' THEN r_he.dia ELSE '-' END) AS 'd_ini14_he',
MAX(CASE WHEN r_he.id='15' THEN r_he.dia ELSE '-' END) AS 'd_ini15_he',
MAX(CASE WHEN r_he.id='16' THEN r_he.dia ELSE '-' END) AS 'd_ini16_he',
MAX(CASE WHEN r_he.id='1' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini1_he',
MAX(CASE WHEN r_he.id='2' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini2_he',
MAX(CASE WHEN r_he.id='3' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini3_he',
MAX(CASE WHEN r_he.id='4' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini4_he',
MAX(CASE WHEN r_he.id='5' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini5_he',
MAX(CASE WHEN r_he.id='6' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini6_he',
MAX(CASE WHEN r_he.id='7' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini7_he',
MAX(CASE WHEN r_he.id='8' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini8_he',
MAX(CASE WHEN r_he.id='9' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini9_he',
MAX(CASE WHEN r_he.id='10' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini10_he',
MAX(CASE WHEN r_he.id='11' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini11_he',
MAX(CASE WHEN r_he.id='12' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini12_he',
MAX(CASE WHEN r_he.id='13' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini13_he',
MAX(CASE WHEN r_he.id='14' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini14_he',
MAX(CASE WHEN r_he.id='15' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini15_he',
MAX(CASE WHEN r_he.id='16' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini16_he'
FROM fechas fe
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe.fecha) AS dia,
   MONTH(fe.fecha) AS mes,
   SUBSTRING(fe.nom_dia, 1, 3) AS dia_letra
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
   cp.id_cp= '".$id_seg_quin."'
 WHERE fe.fecha BETWEEN cp.`desde` AND cp.`hasta`
 ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
)  AS r_he
ON DAY(fe.fecha)=r_he.dia
;" );
    
     
              
$resPro2=mysql_fetch_array($sqlPro2);



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
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro2["nom_d_ini1_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro2["nom_d_ini2_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro2["nom_d_ini3_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro2["nom_d_ini4_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro2["nom_d_ini5_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro2["nom_d_ini6_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro2["nom_d_ini7_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro2["nom_d_ini8_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro2["nom_d_ini9_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro2["nom_d_ini10_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro2["nom_d_ini11_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro2["nom_d_ini12_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro2["nom_d_ini13_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro2["nom_d_ini14_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro2["nom_d_ini15_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro2["nom_d_ini16_he"])); 


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
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro2["d_ini1_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro2["d_ini2_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro2["d_ini3_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro2["d_ini4_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro2["d_ini5_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro2["d_ini6_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro2["d_ini7_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro2["d_ini8_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro2["d_ini9_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro2["d_ini10_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro2["d_ini11_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro2["d_ini12_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro2["d_ini13_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro2["d_ini14_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro2["d_ini15_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro2["d_ini16_he"])); 
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

$sql=mysql_query("SELECT DISTINCT tr.id_trab,
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
  MAX(CASE WHEN hpp.id_dscto='1' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini1',
  MAX(CASE WHEN hpp.id_dscto='2' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini2',
  MAX(CASE WHEN hpp.id_dscto='3' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini3',
  MAX(CASE WHEN hpp.id_dscto='4' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini4',
  MAX(CASE WHEN hpp.id_dscto='5' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini5',
  MAX(CASE WHEN hpp.id_dscto='6' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini6',
  MAX(CASE WHEN hpp.id_dscto='7' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini7',
  MAX(CASE WHEN hpp.id_dscto='8' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini8',
  MAX(CASE WHEN hpp.id_dscto='9' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini9',
  MAX(CASE WHEN hpp.id_dscto='10' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini10',
  MAX(CASE WHEN hpp.id_dscto='11' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini11',
  MAX(CASE WHEN hpp.id_dscto='12' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini12',
  MAX(CASE WHEN hpp.id_dscto='13' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini13',
  MAX(CASE WHEN hpp.id_dscto='14' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini14',
  MAX(CASE WHEN hpp.id_dscto='15' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini15',
  MAX(CASE WHEN hpp.id_dscto='16' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini16',
  IF( ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   ) ='00:00' , '', ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   )   )AS tot_cant_horas,
   IF(
  (
  CASE WHEN hpp_reg.cant_dias='' THEN  '0'
  WHEN hpp_reg.cant_dias IS NULL THEN '0' 
  ELSE hpp_reg.cant_dias  END
   + CASE WHEN fcc.cant_dias='' THEN '0' 
  WHEN fcc.cant_dias IS NULL THEN '0' 
  ELSE fcc.cant_dias   END 
   )='0' , '',(
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
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   )='00:00', '', 
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   )
   ) AS tot_cant_horas_al25,
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   ) ='00:00', '' , 
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   )
   ) AS tot_cant_horas_al35, 
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   ) ='00:00', '', 
   ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   )
   ) AS tot_cant_horas_dom, 
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   ) ='00:00', '' ,
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   )
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
LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
    cp.id_cp='".$id_seg_quin."' 
LEFT JOIN  cronograma_dsctos_abonos_horasdias ch ON 
    ch.id_cp='".$id_seg_quin."' 
LEFT JOIN  cronograma_dsctos_abonos_horasdias cd ON 
    cd.id_cp='".$id_seg_quin."' 
LEFT JOIN /*Regularizacion de horas y dias de descuento */
( SELECT tr.id_trab, DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))), '%H:%i') AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
       FROM horas_permiso_personal hpp
       LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_seg_quin."' 
       WHERE  hpp.fecha NOT BETWEEN cp.desde AND cp.hasta
       AND  hpp.id_fec_dscto='".$id_seg_quin."' 
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS hpp_reg ON tr.id_trab =  hpp_reg.id_trab
LEFT JOIN  /* HORAS Y DIAS DE DESCUENTOS */
( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, r.id_dscto 
  FROM horas_permiso_personal hpp
  LEFT JOIN/* INICIO  - El que causa conflicto*/
  (SELECT  (@o := @o + 1)  AS id_dscto ,
     DAY(fe.fecha) AS dia_dscto,
     MONTH(fe.fecha) AS mes_dscto
   FROM (SELECT @o:=0) r
     INNER JOIN fechas fe
     LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_seg_quin."' 
   WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
   ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
  )  AS r 
  ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
) AS hpp ON tr.id_trab =  hpp.id_trab
  AND hpp.fecha BETWEEN cd.desde AND cd.hasta
LEFT JOIN 
( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
        FROM horas_permiso_personal hpp
        LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_seg_quin."' 
  WHERE  hpp.fecha BETWEEN cp.desde AND cp.hasta
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS fcc ON fcc.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
FROM horas_extras_personal hep
) AS hep ON tr.id_trab =  hep.id_trab
AND hep.fecha BETWEEN ch.desde AND ch.hasta
LEFT JOIN /*Regularizacion de horas y dias de abono */
( SELECT tr.id_trab, 
   IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
   IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
   IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
   IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha NOT BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_seg_quin."' 
                   GROUP BY id_trab
   )AS he_25 ON tr.id_trab =  he_25.id_trab
   LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha NOT  BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_seg_quin."' 
                   GROUP BY id_trab
   )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha NOT BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                    AND hep.id_fec_abono='".$id_seg_quin."' 
                  GROUP BY id_trab
   )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha NOT  BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
                    AND hep.id_fec_abono='".$id_seg_quin."' 
               GROUP BY id_trab
   )AS he_fe ON tr.id_trab =  he_fe.id_trab
  GROUP BY tr.id_trab   
) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT tr.id_trab, 
         IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
         IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
   IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
   IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_seg_quin."' 
                   GROUP BY id_trab
   )AS he_25 ON tr.id_trab =  he_25.id_trab
   LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_seg_quin."' 
                   GROUP BY id_trab
   )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                    AND hep.id_fec_abono='".$id_seg_quin."' 
                  GROUP BY id_trab
   )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."' 
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
                    AND hep.id_fec_abono='".$id_seg_quin."' 
               GROUP BY id_trab
   )AS he_fe ON tr.id_trab =  he_fe.id_trab
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
      MONTH(fecha) AS mes,
      cp.desde,
      cp.hasta
  FROM fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
           cp.id_cp='".$id_seg_quin."' 
  WHERE fe.fecha BETWEEN  cp.desde AND cp.hasta
  GROUP BY DAY(fecha)
   ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
 WHERE fe_ext.fecha BETWEEN fr_ext.desde AND fr_ext.hasta
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

  
//FIN DE SEGUNDA HOJA



//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja 2 
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora 2
$objPHPExcel->getActiveSheet()->setTitle("Planilla 2da Quincena"); //establecer titulo de hoja
 
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




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "PAGO DE PLANILLA DE HABERES");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:V$fila"); //unir celdas
//$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:D$fila"); //establecer estilo


 
$fila=3;


//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

$objPHPExcel->getActiveSheet()->freezePane('W5');


$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'EST.CIVIL');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TIP.CONTRATO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CONTRATO FIN.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CONTRATO FIN.ACTU');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TIEMPO LABOR');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'TIP.COMISION ACTUAL');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'GENERO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'CORREO');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'TELEFONO');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'CODIGO COSTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'CONCEPTO DE COSTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'TIP.MANO DE OBRA');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'T.REGISTRO');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'TIP.PLANILLA'); 
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila",  'SUCURSAL ANEXO');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila",  'DNI');  
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila",  'APELLIDO PATERNO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila",  'APELLIDO MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila",  'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila",  'APELLIDOS Y NOMBRES'); 
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila",  'FECHA NACIMIENTO');  
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila",  'FECHA INGRESO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila",  'FECHA CESE');
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila",  'NUMERO CTA SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila",  'NUMERO CTA SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila",  'NUMERO CTA CTS');
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila",  'NUMERO CTA CTS');
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila",  'FORMA DE PAGO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila",  'AREA'); 
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'CATEGORIA');
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'REG. PENSIONARIO AFP/ONP');
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'CODIGO CUSP');
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'REMUNERACION MENSUAL');
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'ASIG. FAMILIAR');
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", 'HORAS DE LACTANCIA');
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'HORAS TRABAJADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'DIAS TRABAJADOS');
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", 'H.E 25%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", 'H.E 35%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", 'H.E DOMINCIAL 100%');   
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", 'H.E FERIADO 100%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", 'CANTIDAD AL 25%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", 'CANTIDAD AL 35%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", 'CANTIDAD DOMINCIAL 100%');   
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", 'CANTIDAD FERIADO 100%');     
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", 'FECHA VACACIONES');  
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", 'DIAS VACACIONES');  
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", 'FECHA DESCANSO MEDICO');    
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", 'DIAS DESCANSO MEDICO');  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", 'FECHA SUBSIDIO');  
$objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", 'DIAS SUBSIDIO');   
$objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", 'FECHA LICENCIA CON GOCE DE HABER');  
$objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", 'DIAS LICENCIA CON GOCE DE HABER');    
$objPHPExcel->getActiveSheet()->SetCellValue("BE$fila", 'FECHA LICENCIA SIN GOCE DE HABER'); 
$objPHPExcel->getActiveSheet()->SetCellValue("BF$fila", 'DIAS LICENCIA SIN GOCE DE HABER');     
$objPHPExcel->getActiveSheet()->SetCellValue("BG$fila", 'FECHA FALTA');
$objPHPExcel->getActiveSheet()->SetCellValue("BH$fila", 'HORAS FALTADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BI$fila", 'DIAS FALTADOS');
$objPHPExcel->getActiveSheet()->SetCellValue("BJ$fila", 'DSCTO DOMINICAL H.S');
$objPHPExcel->getActiveSheet()->SetCellValue("BK$fila", 'TOTAL DSCTO POR HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BL$fila", 'TOTAL DSCTO POR FALTAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BM$fila", 'SUELDO QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("BN$fila", 'ASIG.FAMILIAR');
$objPHPExcel->getActiveSheet()->SetCellValue("BO$fila", 'DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("BP$fila", 'VACACIONES');
$objPHPExcel->getActiveSheet()->SetCellValue("BQ$fila", 'LICENCIA POR SUBSIDIO');
$objPHPExcel->getActiveSheet()->SetCellValue("BR$fila", 'DESCANSO MEDICO');
$objPHPExcel->getActiveSheet()->SetCellValue("BS$fila", 'LICENCIA CON GOCE DE HABER');
$objPHPExcel->getActiveSheet()->SetCellValue("BT$fila", 'LICENCIA SIN GOCE DE HABER');
$objPHPExcel->getActiveSheet()->SetCellValue("BU$fila", 'PERMISO HORA LACTANCIA');
$objPHPExcel->getActiveSheet()->SetCellValue("BV$fila", 'TOTAL SUELDO QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("BW$fila", 'CANTIDAD AL 25%');
$objPHPExcel->getActiveSheet()->SetCellValue("BX$fila", 'CANTIDAD AL 35%');
$objPHPExcel->getActiveSheet()->SetCellValue("BY$fila", 'CANTIDAD DOMINICAL 100%');
$objPHPExcel->getActiveSheet()->SetCellValue("BZ$fila", 'CANTIDAD FERIADO 100%');
$objPHPExcel->getActiveSheet()->SetCellValue("CA$fila", 'MONTO TOTAL HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CB$fila", 'TOTAL REMUNERACION AFECTO');
$objPHPExcel->getActiveSheet()->SetCellValue("CC$fila", 'DSCTO FONDO DE PENSION ');
$objPHPExcel->getActiveSheet()->SetCellValue("CD$fila", 'DSCTO RENTA 5TA');
$objPHPExcel->getActiveSheet()->SetCellValue("CE$fila", 'VIDA SEGURO DE ACCIDENTE');
$objPHPExcel->getActiveSheet()->SetCellValue("CF$fila", 'DSCTO BASE A DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("CG$fila", 'DSCTO JUDICIALES');
$objPHPExcel->getActiveSheet()->SetCellValue("CH$fila", 'DSCTO PRESTAMOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CI$fila", 'DSCTO INSUMOS Y DESTAJEROS');
$objPHPExcel->getActiveSheet()->SetCellValue("CJ$fila", 'DSCTO VARIOS   (PRENDAS)');
$objPHPExcel->getActiveSheet()->SetCellValue("CK$fila", 'DSCTO MENU');
$objPHPExcel->getActiveSheet()->SetCellValue("CL$fila", 'ANTICIPO - ADELANTO,  VACACIONES CHEQUE / EFECTIVO');
$objPHPExcel->getActiveSheet()->SetCellValue("CM$fila", 'TOTAL DESCUENTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CN$fila", 'TOTAL DEPOSITAR QUICENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("CO$fila", 'REGULARIZACION');
$objPHPExcel->getActiveSheet()->SetCellValue("CP$fila", 'OTROS VARIOS    (EXCESO)');
$objPHPExcel->getActiveSheet()->SetCellValue("CQ$fila", 'TOTAL A DEPOSITAR BCP QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("CR$fila", 'BONO SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("CS$fila", 'BONO DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("CT$fila", 'VACACIONES COMPRADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CU$fila", 'TOTAL  H.EXTRAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CV$fila", 'DESCUENTOS VARIOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CW$fila", 'TOTAL PAGO EFECTIVO');
$objPHPExcel->getActiveSheet()->SetCellValue("CX$fila", 'OBSERVACIONES ');
$objPHPExcel->getActiveSheet()->SetCellValue("CY$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("CZ$fila", '100');
$objPHPExcel->getActiveSheet()->SetCellValue("DA$fila", '50');
$objPHPExcel->getActiveSheet()->SetCellValue("DB$fila", '20');
$objPHPExcel->getActiveSheet()->SetCellValue("DC$fila", '10');
$objPHPExcel->getActiveSheet()->SetCellValue("DD$fila", '5');
$objPHPExcel->getActiveSheet()->SetCellValue("DE$fila", '2');
$objPHPExcel->getActiveSheet()->SetCellValue("DF$fila", '1');
$objPHPExcel->getActiveSheet()->SetCellValue("DG$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("DH$fila", '100');
$objPHPExcel->getActiveSheet()->SetCellValue("DI$fila", '50');
$objPHPExcel->getActiveSheet()->SetCellValue("DJ$fila", '20');
$objPHPExcel->getActiveSheet()->SetCellValue("DK$fila", '10');
$objPHPExcel->getActiveSheet()->SetCellValue("DL$fila", '5');
$objPHPExcel->getActiveSheet()->SetCellValue("DM$fila", '2');
$objPHPExcel->getActiveSheet()->SetCellValue("DN$fila", '1');
  






$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:DN$fila");


$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setVisible(false);


$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("X$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Y$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Z$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AZ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BZ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CZ$fila")->getAlignment()->setWrapText(true);

//rellenar con contenido  

$sql=mysql_query("SELECT  DISTINCT   tr.id_trab,
    teci.des_corta AS estado_civil,
    tcon.des_larga AS tipo_contrato,
    ttca.des_larga AS comision_actual,
    tgen.des_corta AS genero,
    tr.id_cen_cost AS cod_centro_costos,
    tcco.des_larga AS centro_costos,
    ttmo.des_corta AS tipo_mano_obra,
    ttre.des_larga AS t_registro,
    tpla.des_larga AS tipo_planilla,
    IFNULL(tsua.des_larga,'')  AS sucursal_anexo, 
    tr.num_doc_trab,
    tr.apepat_trab,
    tr.apemat_trab,
    tr.nom_trab,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, 
    DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y') AS fec_nac_trab,  
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
    IF( DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')) AS fec_sal_trab, 
    tr.nro_cta_sue AS nro_cta_sue_con,
    REPLACE(tr.nro_cta_sue,'-','') AS nro_cta_sue_sin,
    tr.nro_cta_cts AS nro_cta_cts_con,
    REPLACE(tr.nro_cta_cts,'-','') AS nro_cta_cts_sin,
    tfop.des_larga AS forma_pago, 
    tare.des_larga AS area_trab, 
    tfun.des_larga AS funcion,
    tcal.des_larga AS categoria_laboral,
    trep.des_larga AS regimen_pensionario,
    tr.cusp_trab,
    tr.sueldo_trab,
    IF(tr.asig_trab=0,'' , asig_trab) AS asig_trab,
    IF(hl.cantidad_horas IS NULL , '', hl.cantidad_horas) AS horas_lactancia,
    ((15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0')  - IFNULL(het.cant_dscto_endias,'')  ) *8) - IF(hl.cantidad_horas IS NULL , '0', hl.cantidad_horas)  AS horas_trabajadas,
    (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) AS dias_trabajados,
    trcop.pre_hor_ext_25,
    trcop.pre_hor_ext_35,
    trcop.pre_hor_ext_dominical,
    trcop.pre_hor_ext_feriado,
    het.cant_abono_horas_al25  AS cant_hor_ext_25,
    het.cant_abono_horas_al35 AS cant_hor_ext_35,
    het.cant_abono_horas_dom AS cant_hor_ext_dominical,
    het.cant_abono_horas_fer AS cant_hor_ext_feriado,
    IFNULL(vac.fechas,'') AS fecha_vacaciones,
    IFNULL(vac.dias,'')   AS cant_dias_vacaciones,
    IF(dme.dias>0, dme.fechas, '' )  AS fecha_descanso_medico,
    IF(dme.dias>0, dme.dias, '' )    AS cant_dias_descanso_medico,  
    IF(sub.dias>0, sub.fechas, '' )  AS fecha_subsidio,
    IF(sub.dias>0, sub.dias, '' )    AS cant_dias_subsidio,
    IF(lco.dias>0, lco.fechas, '' )  AS fecha_lic_con_goce_haber, 
    IF(lco.dias>0, lco.dias, '' )    AS cant_dias_lic_con_goce_haber,
    IF(lsi.dias>0, lsi.fechas, '' )  AS fecha_lic_sin_goce_haber,
    IF(lsi.dias>0, lsi.dias, '' )  AS cant_dias_lic_sin_goce_haber,
    het.cant_dscto_enhoras AS cant_horas_faltadas,
    het.cant_dscto_endias AS cant_dias_falta,
     CASE 
    WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
    WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
    WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
    WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
    WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
    ELSE ''  END
    AS dscto_dom_hsxdias_semanal,  /*AL FINAL AUTOCALCULABLE*/
    IF(ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) ='0.00', '', ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) )  AS total_dsctoxhoras,  /*AL FINAL AUTOCALCULABLE*/
    ROUND( ((tr.sueldo_trab/30)* cant_dscto_endias) + het.dscto_dom_hsxdias_semanal , 2) AS total_dsctoxfaltas,  /*AL FINAL AUTOCALCULABLE*/
    ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)  AS sueldo_quincenal,  /* CORREGIR - AL FINAL AUTOCALCULABLE*/
    IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))AS asig_familiar,
    IF(pd.dif_soles IS NULL,'',pd.dif_soles) AS mon_destajo,
    IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' ) AS mon_vacaciones,
    IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) ) AS mon_licenciaxsubsidio,
    IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) ) AS mon_descansomedico,
    IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) ) AS mon_licenciacongocedehaber,
   /* IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) ) AS mon_licenciasingocedehaber, NO SE PAGA POR LICENCIA SIN GOCE*/
    IFNULL(hl.mon_permisoxhoralactancia, '') AS monto_lactancia,
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  COMENTADO PORQUE NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') )
    AS mon_total_sueldo_quincenal,
    het.cant_abono_horas_al25  AS cant_hor_ext_25,
    ROUND((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25), 2)        AS mon_hor_ext_25,
    het.cant_abono_horas_al35 cant_hor_ext_35,
    ROUND((het.cant_abono_horas_al35 * trcop.pre_hor_ext_35), 2)        AS mon_hor_ext_35,
    het.cant_abono_horas_dom AS cant_hor_ext_dominical,
    ROUND((het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical), 2)  AS mon_hor_ext_dominical,
    het.cant_abono_horas_fer AS cant_hor_ext_feriado,
    ROUND((het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado), 2)    AS mon_hor_ext_feriado,
    ROUND
    (
    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
    )
    AS mon_total_horas_extras,
    /*INI TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ AS mon_total_remuneracionafecto,
    ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)  AS dscto_fondopension,
     rp.monto_reg_pen,
    IFNULL(rqc.mon_quin, '') AS dscto_rentaquinta,
    '' AS dscto_segurovida,
    '' AS dscto_basedestajo,
    IFNULL(ROUND(dj.mon_men,2),0.00)  AS dscto_judicial,
    IFNULL(ROUND(dp.monto,2),0.00)  AS dscto_prestamo,
    IFNULL(ROUND(did.monto,2),0.00)   AS dscto_insumodestajeros,
    IFNULL(ROUND(dv.monto,2),0.00)  AS dscto_varios,
    IFNULL(ROUND(dm.monto,2),0.00)  AS dscto_menu,
    IFNULL(ROUND(aa.monto,2),0.00)        AS dscto_anticipo,
    /*INICIO TOTAL DESCUENTOS */
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    AS total_dsctos,
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
      AS total_deposito_quincenal,
    /*------------------------------------NUEVA FILA------------------------------------*/
    /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/
     AS abono_regularizacion,
    '' AS otros_exceso_dscto_quincenal,
    /*INICIO - TOTAL BCP DEPOSITO QUINCENAL --------------- NUEVA FILA------------------ */
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    /*FIN TOTAL DEPOSITO QUINCENAL */
    /**/
    + 
     /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/

    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
    AS total_despositobcp_quincenal,
    /*------------------------------------NUEVA FILA------------------------------------*/
    (tr.bono_trab/2) AS bono_quincenal,
    IFNULL(pd.bono_des_trab,0.00) AS bono_destajo_quincenal,
      /*------------------------------------NUEVA FILA------------------------------------*/
    '0' AS vacaciones_compradas_otros, /* FALTA CALCULAR DESDE LA PANTALLLA  */
      /*------------------------------------NUEVA FILA------------------------------------*/
    ROUND(
    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado))  
     + 0.0000000001 
     , 2) AS total_hextras,
     /*------------------------------------NUEVA FILA------------------------------------*/
    '' AS dscto_varios,
    /* --------------- NUEVA FILA------------------SIGUINTE FILA*/
      CASE 
      /*Cuando estan planilla*/
       WHEN  tr.id_trab LIKE 'P%'  THEN 
      (ROUND( (tr.bono_trab/2)   /*BONO SUELDO */+
             IFNULL(pd.bono_des_trab,0.00) +
            /*LINEA DE VACACIONES COMPRADAS*/  
             ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
            (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
             , 0))
      /*Cuando son internos*/          
       ELSE 
    ROUND(
     /*INICIO - TOTAL BCP DEPOSITO QUINCENAL */
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    /*FIN TOTAL DEPOSITO QUINCENAL */
    /**/
    + 
     /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/
    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
     
    /*INICIO SUMAR CON LOS PAGOS EN EFECTIVOS*/
    +
     ( (tr.bono_trab/2)   /*BONO SUELDO */+
       IFNULL(pd.bono_des_trab,0.00) +
      /*LINEA DE VACACIONES COMPRADAS*/  
      ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
       (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
     )
    /*FIN SUMAR CON LOS PAGOS EN EFECTIVOS*/
    ,0 )
   END
       pago_efectivo,
    NULL AS observaciones,
    NULL AS cant_billetes_100,
    NULL AS cant_billetes_50,
    NULL AS cant_billetes_20,
    NULL AS cant_billetes_10,
    NULL AS cant_monedas_5,
    NULL AS cant_monedas_2,
    NULL AS cant_monedas_1
        FROM trabajador tr
        CROSS JOIN (SELECT @i := 0) tr
        LEFT JOIN (
        SELECT  id_trab, mon_total,  ROUND((mon_total/2),2) AS mon_quin
        FROM renta_quinta_categoria
        WHERE  est_reg='1'  
        ) AS  rqc ON rqc.id_trab= tr.id_trab
        LEFT JOIN (SELECT  ma.id_trab,
               ma.fec_nac_c1,
               hl.cantidad_horas,
               IF(ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2) IS NULL, '', ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2)) AS mon_permisoxhoralactancia
             FROM maternidad  ma
             LEFT JOIN trabajador tr
             ON tr.id_trab= ma.id_trab
             LEFT JOIN (SELECT hl.id_cp, hl.cantidad_horas
             FROM horas_lactancia hl  
             ) AS hl ON hl.id_cp='".$id_seg_quin."'
            WHERE DATEDIFF(CURDATE(), fec_nac_c1) <=365
        ) AS hl ON hl.id_trab=tr.id_trab
        LEFT JOIN (
        SELECT  tr.id_trab,
          ROUND(((tr.sueldo_trab/240)* 0.25)+ (tr.sueldo_trab/240), 2) AS pre_hor_ext_25,
          ROUND(  (((tr.sueldo_trab/240)* 0.35)+ (tr.sueldo_trab/240)) +  0.0000000001 , 2) AS pre_hor_ext_35,
          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001  , 2) AS pre_hor_ext_dominical,
          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001 , 2) AS pre_hor_ext_feriado
        FROM trabajador  tr
        ) AS trcop ON trcop.id_trab= tr.id_trab
        LEFT JOIN (
          SELECT  tr.id_trab,
          het.cant_dscto_enhoras,
          het.cant_dscto_endias,
          het.cant_abono_horas_al25,
          het.cant_abono_horas_al35,
          het.cant_abono_horas_dom,
          het.cant_abono_horas_fer,
          CASE 
          WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
          WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
          WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
          WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
          WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
          ELSE ''  END
          AS dscto_dom_hsxdias_semanal
          FROM trabajador tr
          LEFT JOIN ( 
            SELECT  tr.id_trab,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)) AS cant_dscto_enhoras,
            tr1.tot_cant_dias AS cant_dscto_endias,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al25,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al35,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_dom,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_fer
            FROM trabajador tr 
            LEFT JOIN ( 
            SELECT  tr.id_trab,  
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
              (
              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
              ELSE hpp_reg.cant_dias  END
               + CASE WHEN fcc.cant_dias='' THEN '0' 
              WHEN fcc.cant_dias IS NULL THEN '0' 
              ELSE fcc.cant_dias   END 
               )='0' , '',(
              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
              ELSE hpp_reg.cant_dias  END
               + CASE WHEN fcc.cant_dias='' THEN '0' 
              WHEN fcc.cant_dias IS NULL THEN '0' 
              ELSE fcc.cant_dias   END 
               ))   AS tot_cant_dias,
              '-' AS separador, 
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
            LEFT JOIN cronograma_pagos cp ON 
                 cp.id_cp='".$id_seg_quin."'
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
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                   cp.id_cp='".$id_seg_quin."'
                   WHERE  hpp.fecha NOT BETWEEN cp.desde AND cp.hasta
                   AND  hpp.id_fec_dscto='".$id_seg_quin."'
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
                 LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                            cp.id_cp= '".$id_seg_quin."'
               WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
               ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
              )  AS r 
              ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
            ) AS hpp ON tr.id_trab =  hpp.id_trab
              AND hpp.fecha BETWEEN cp.desde AND cp.hasta
            LEFT JOIN 
            ( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
              FROM Trabajador tr
              LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
              FROM horas_permiso_personal hpp
              LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
              cp.id_cp= '".$id_seg_quin."'
              WHERE  hpp.fecha BETWEEN cp.desde AND cp.hasta
              )AS hpp ON tr.id_trab =  hpp.id_trab
              GROUP BY tr.id_trab
            ) AS fcc ON fcc.id_trab= tr.id_trab 
            LEFT JOIN 
            ( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
            FROM horas_extras_personal hep
            ) AS hep ON tr.id_trab =  hep.id_trab
            AND hep.fecha BETWEEN cp.desde AND cp.hasta
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
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp='".$id_seg_quin."'
                   WHERE  hep.fecha NOT BETWEEN cp.desde AND cp.hasta
                   AND  hep.id_fec_abono='".$id_seg_quin."'
              )AS hep ON tr.id_trab =  hep.id_trab
              GROUP BY tr.id_trab  
            ) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
            LEFT JOIN 
             /*INICIO DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
            ( SELECT tr.id_trab,  
                   IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
                   IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
                   IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
                   IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
            FROM Trabajador tr
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   GROUP BY id_trab
              )AS he_25 ON tr.id_trab =  he_25.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   GROUP BY id_trab
              )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                  GROUP BY id_trab
              )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
               GROUP BY id_trab
              )AS he_fe ON tr.id_trab =  he_fe.id_trab
              /*FIN DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
            ) AS fhe ON fhe.id_trab= tr.id_trab 
            LEFT JOIN
            (SELECT (@i := @i + 1) AS id ,
               DAY(fe_ext.fecha) AS dia,
               MONTH(fe_ext.fecha) AS mes,
               fr_ext.dia AS dia_reg,
               fr_ext.mes AS mes_reg
             FROM (SELECT @i:=0) r
               INNER JOIN fechas fe_ext
               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                          cp.id_cp= '".$id_seg_quin."'
               LEFT JOIN (
              SELECT 
                  DAY(fecha) AS dia,
                  MONTH(fecha) AS mes
              FROM horas_extras_personal hep
               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_seg_quin."'
              WHERE hep.fecha BETWEEN  cp.desde AND cp.hasta
              GROUP BY DAY(fecha)
               ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
             WHERE fe_ext.fecha BETWEEN cp.desde AND cp.hasta
             ORDER BY MONTH(fe_ext.fecha) ASC,  DAY(fe_ext.fecha) ASC
            )  AS r_ext
            ON DAY(hep.fecha)=r_ext.dia
            WHERE tr.est_reg='1'
            GROUP BY tr.id_trab
            ) AS tr1 ON tr1.id_trab=tr.id_trab
            WHERE est_reg='1'
            GROUP BY tr.id_trab
          ) AS het   ON het.id_trab =tr.id_trab /*HORAS EXTRAS Y TARDANZAS*/
          )AS het ON  het.id_trab=tr.id_trab
        LEFT JOIN (
        SELECT  id_trab,  CASE 
          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='1' THEN  onp_apo_act
          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='0' THEN  onp_apo_act
          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='1'  THEN  int_apo_act
          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='2'  THEN  int_apo_mix
          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='1'  THEN  pri_apo_act
          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='2'  THEN  pri_apo_mix
          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='1' THEN  pro_apo_act
          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='2' THEN  pro_apo_mix
          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='1'  THEN  hab_apo_act
          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='2'  THEN  hab_apo_mix
          WHEN  tr.id_reg_pen=rp.id_sj  THEN   (sj_apo_obl* sj_com_men_rem)
          ELSE ''  END
          AS monto_reg_pen
        FROM trabajador  tr
        LEFT JOIN  regimen_pensionario rp
        ON id_cp='".$id_seg_quin."'
        ) AS rp ON rp.id_trab= tr.id_trab
        LEFT JOIN tabla_maestra_detalle   AS tpla ON tpla.cod_argumento=tr.id_tip_plan    AND tpla.cod_tabla='TPLA'
        LEFT JOIN tabla_maestra_detalle   AS tsua ON tsua.cod_argumento=tr.id_sucursal    AND tsua.cod_tabla='TSUA'
        LEFT JOIN tabla_maestra_detalle   AS tfun ON tfun.cod_argumento=tr.id_funcion     AND tfun.cod_tabla='TFUN'
        LEFT JOIN tabla_maestra_detalle   AS tare ON tare.cod_argumento=tr.id_area        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle   AS tgen ON tgen.cod_argumento=tr.id_genero      AND tgen.cod_tabla='TGEN' 
        LEFT JOIN tabla_maestra_detalle   AS tcco ON tcco.cod_argumento=tr.id_cen_cost    AND tcco.cod_tabla='TCCO' 
        LEFT JOIN tabla_maestra_detalle   AS ttmo ON ttmo.cod_argumento=tr.id_tip_man_ob  AND ttmo.cod_tabla='TTMO' 
        LEFT JOIN tabla_maestra_detalle   AS tcal ON tcal.cod_argumento=tr.id_categoria   AND tcal.cod_tabla='TCAL' 
        LEFT JOIN tabla_maestra_detalle   AS tfop ON tfop.cod_argumento=tr.id_form_pag    AND tfop.cod_tabla='TFOP' 
        LEFT JOIN tabla_maestra_detalle   AS tcon ON tcon.cod_argumento=tr.id_tip_cont    AND tcon.cod_tabla='TCON' 
        LEFT JOIN tabla_maestra_detalle   AS teci ON teci.cod_argumento=tr.id_est_civil   AND teci.cod_tabla='TECI' 
        LEFT JOIN tabla_maestra_detalle   AS trep ON trep.cod_argumento=tr.id_reg_pen     AND trep.cod_tabla='TREP' 
        LEFT JOIN tabla_maestra_detalle   AS ttca ON ttca.cod_argumento=tr.id_com_act     AND ttca.cod_tabla='TTCA' 
        LEFT JOIN tabla_maestra_detalle   AS ttre ON ttre.cod_argumento=tr.id_t_registro  AND ttre.cod_tabla='TTRE' 
        LEFT JOIN tabla_maestra_detalle   AS tmpe ON tmpe.cod_argumento=tr.id_pag_esp     AND tmpe.cod_tabla='TMPE'
        LEFT JOIN vacaciones              AS vac  ON vac.nro_doc= tr.num_doc_trab
        LEFT JOIN pago_destajeros     AS pd   ON pd.id_trab=tr.id_trab    AND pd.id_pd='".$id_seg_quin."'
        LEFT JOIN abono_regularizacion    AS ar   ON ar.id_trab=tr.id_trab    AND ar.fec_abo_reg='".$id_seg_quin."'
        LEFT JOIN descuentos_judiciales   AS dj   ON dj.id_trab=tr.id_trab    AND dj.est_des_jud='1'
        LEFT JOIN 
        ( SELECT pre.id_trab, CASE 
          WHEN  pre.fec_des1='".$id_seg_quin."' THEN mon_des1
          WHEN  pre.fec_des2='".$id_seg_quin."' THEN mon_des2
          WHEN  pre.fec_des3='".$id_seg_quin."' THEN mon_des3 
          WHEN  pre.fec_des4='".$id_seg_quin."' THEN mon_des4
          WHEN  pre.fec_des5='".$id_seg_quin."' THEN mon_des5 
          WHEN  pre.fec_des6='".$id_seg_quin."' THEN mon_des6
          WHEN  pre.fec_des7='".$id_seg_quin."' THEN mon_des7 
          WHEN  pre.fec_des8='".$id_seg_quin."' THEN mon_des8
          WHEN  pre.fec_des9='".$id_seg_quin."' THEN mon_des9 
          WHEN  pre.fec_des10='".$id_seg_quin."' THEN mon_des10
          WHEN  pre.fec_des11='".$id_seg_quin."' THEN mon_des11
          WHEN  pre.fec_des12='".$id_seg_quin."' THEN mon_des12
          WHEN  pre.fec_des13='".$id_seg_quin."' THEN mon_des13
          WHEN  pre.fec_des14='".$id_seg_quin."' THEN mon_des14
          WHEN  pre.fec_des15='".$id_seg_quin."' THEN mon_des15
          WHEN  pre.fec_des16='".$id_seg_quin."' THEN mon_des16
          WHEN  pre.fec_des17='".$id_seg_quin."' THEN mon_des17
          WHEN  pre.fec_des18='".$id_seg_quin."' THEN mon_des18
          WHEN  pre.fec_des19='".$id_seg_quin."' THEN mon_des19
          WHEN  pre.fec_des20='".$id_seg_quin."' THEN mon_des20
          WHEN  pre.fec_des21='".$id_seg_quin."' THEN mon_des21
          WHEN  pre.fec_des22='".$id_seg_quin."' THEN mon_des22 
          WHEN  pre.fec_des23='".$id_seg_quin."' THEN mon_des23
          WHEN  pre.fec_des24='".$id_seg_quin."' THEN mon_des24
          WHEN  pre.fec_des25='".$id_seg_quin."' THEN mon_des25
          WHEN  pre.fec_des26='".$id_seg_quin."' THEN mon_des26
          WHEN  pre.fec_des27='".$id_seg_quin."' THEN mon_des27
          WHEN  pre.fec_des28='".$id_seg_quin."' THEN mon_des28
          WHEN  pre.fec_des29='".$id_seg_quin."' THEN mon_des29
          WHEN  pre.fec_des30='".$id_seg_quin."' THEN mon_des30  
          ELSE '0.00'  END
          AS monto
          FROM prestamos AS pre 
        ) AS dp  ON dp.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT did.id_trab, CASE 
          WHEN  did.fec_des1='".$id_seg_quin."' THEN mon_des1
          WHEN  did.fec_des2='".$id_seg_quin."' THEN mon_des2
          WHEN  did.fec_des3='".$id_seg_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_insumos_destajeros AS did 
        ) AS did  ON did.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT dv.id_trab, CASE 
          WHEN  dv.fec_des1='".$id_seg_quin."' THEN mon_des1
          WHEN  dv.fec_des2='".$id_seg_quin."' THEN mon_des2
          WHEN  dv.fec_des3='".$id_seg_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_varios AS dv 
        ) AS dv  ON dv.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT dm.id_trab, CASE 
          WHEN  dm.fec_des1='".$id_seg_quin."' THEN mon_des1
          WHEN  dm.fec_des2='".$id_seg_quin."' THEN mon_des2
          WHEN  dm.fec_des3='".$id_seg_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_menu AS dm 
        ) AS dm  ON dm.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT aa.id_trab, CASE 
          WHEN  aa.fec_des1='".$id_seg_quin."' THEN mon_des1
          WHEN  aa.fec_des2='".$id_seg_quin."' THEN mon_des2
          WHEN  aa.fec_des3='".$id_seg_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM anticipo_adelanto AS aa 
        ) AS aa  ON aa.id_trab=tr.id_trab
        LEFT JOIN 
        (  SELECT pp.id_trab,  pp.monto_a_pagar,
                  IF( pp.id_cp='".$id_seg_quin."',  'SI', '0.00')  AS monto,
                  CASE 
                  WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(cp.hasta, '%d/%m/%Y'))     
                  ELSE ''  END
                  AS fechas,
                  CASE 
                  WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  REPLACE(DATEDIFF(pp.fecha_procede,pp.fecha_hasta)-1      ,'-', '')
                  WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta  THEN   REPLACE(DATEDIFF(pp.fecha_procede,cp.hasta)-1   ,'-', '')    
                  ELSE ''  END
                  AS dias
              FROM permiso_personal pp
              LEFT JOIN  cronograma_pagos cp ON 
              cp.id_cp='".$id_seg_quin."'
              WHERE pp.tip_permiso='VC'
              AND pp.fecha_procede BETWEEN   cp.desde AND cp.hasta 
           UNION ALL
           SELECT pp.id_trab,  pp.monto_a_pagar,  
                  IF( pp.id_cp='".$id_seg_quin."',  'SI', '0.00')  AS monto,
                  CASE 
                  WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(cp.desde, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  ELSE ''  END
                  AS fechas,
                  CASE 
                  WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta  THEN  REPLACE(DATEDIFF(pp.fecha_procede,pp.fecha_hasta)-1      ,'-', '')
                  WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN   REPLACE(DATEDIFF(cp.desde,pp.fecha_hasta)-1   ,'-', '')    
                  ELSE ''  END
                 AS dias
           FROM permiso_personal pp
           LEFT JOIN  cronograma_pagos cp ON 
           cp.id_cp='".$id_seg_quin."'
           WHERE pp.tip_permiso='VC'
           AND  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta 
        ) AS vac  ON vac.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar,  pp.id_fecha_pago1, pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_seg_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso='DM'
        ) AS dme  ON dme.id_trab=tr.id_trab
        AND dme.id_cp='".$id_seg_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_seg_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LM','LP','FD', 'FF')
        ) AS sub  ON sub.id_trab=tr.id_trab
        AND sub.id_cp='".$id_seg_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_seg_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LC')
        ) AS lco  ON lco.id_trab=tr.id_trab
        AND lco.id_cp='".$id_seg_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_seg_quin."' ,  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LS')
        ) AS lsi  ON lsi.id_trab=tr.id_trab
        AND lsi.id_cp='".$id_seg_quin."'
        LEFT JOIN 
        (SELECT tr.id_trab, 
                DATEDIFF(cp.hasta,cp.desde)AS dias_cronograma,
                IFNULL(ss.dias_asistidos, 0),
               IF(tt.cantidad>0, 0 , IFNULL((DATEDIFF(cp.hasta,cp.desde) -  IFNULL(ss.dias_asistidos,0)) , DATEDIFF(ss.hasta,ss.desde) ))  AS dias_faltados 
         FROM trabajador tr
         LEFT JOIN
           ( SELECT  tr.id_trab,cp.desde,  cp.hasta, re.fecha,  COUNT(re.fecha) AS dias_asistidos
            FROM Trabajador tr 
            LEFT JOIN reloj AS re ON
            tr.id_trab= re.id_trab
            LEFT JOIN  cronograma_pagos AS cp ON 
              cp.id_cp='".$id_seg_quin."'
             WHERE re.fecha BETWEEN cp.desde AND cp.hasta
            GROUP BY tr.id_trab
           ) AS  ss ON ss.id_trab= tr.id_trab
        LEFT JOIN  cronograma_pagos AS cp ON 
           cp.id_cp='".$id_seg_quin."'
        LEFT JOIN
          ( SELECT tr.id_trab, COUNT(pp.dias) AS cantidad
            FROM Trabajador tr 
             LEFT JOIN permiso_personal AS pp ON
            pp.id_trab= tr.id_trab
            LEFT JOIN  cronograma_pagos AS cp ON 
              cp.id_cp='".$id_seg_quin."'
            WHERE pp.fecha_procede BETWEEN cp.desde AND cp.hasta 
          ) AS tt ON
         tt.id_trab= tr.id_trab
        ) AS difa ON difa.id_trab= tr.id_trab
      WHERE tr.est_reg='1' 
      ORDER BY tr.id_tip_plan ASC, tr.id_trab ASC
        ;
        
  ");  





    


         
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;

  

 $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["estado_civil"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["tipo_contrato"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["comision_actual"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["genero"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["cod_centro_costos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["centro_costos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["tipo_mano_obra"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["t_registro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["tipo_planilla"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["sucursal_anexo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($res["nombres"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($res["fec_nac_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", utf8_encode($res["fec_sal_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", utf8_encode($res["nro_cta_sue_con"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", utf8_encode($res["nro_cta_sue_sin"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", utf8_encode($res["nro_cta_cts_con"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", utf8_encode($res["nro_cta_cts_sin"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", utf8_encode($res["forma_pago"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", utf8_encode($res["categoria_laboral"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", utf8_encode($res["regimen_pensionario"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", utf8_encode($res["cusp_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", utf8_encode($res["sueldo_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", utf8_encode($res["asig_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($res["horas_lactancia"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($res["horas_trabajadas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($res["dias_trabajados"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($res["pre_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($res["pre_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($res["pre_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($res["pre_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($res["cant_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($res["cant_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($res["cant_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($res["cant_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($res["fecha_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($res["cant_dias_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($res["fecha_descanso_medico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($res["cant_dias_descanso_medico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($res["fecha_subsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", utf8_encode($res["cant_dias_subsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", utf8_encode($res["fecha_lic_con_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", utf8_encode($res["cant_dias_lic_con_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BE$fila", utf8_encode($res["fecha_lic_sin_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BF$fila", utf8_encode($res["cant_dias_lic_sin_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BG$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BH$fila", utf8_encode($res["cant_horas_faltadas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BI$fila", utf8_encode($res["cant_dias_falta"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BJ$fila", utf8_encode($res["dscto_dom_hsxdias_semanal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BK$fila", utf8_encode($res["total_dsctoxhoras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BL$fila", utf8_encode($res["total_dsctoxfaltas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BM$fila", utf8_encode($res["sueldo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BN$fila", utf8_encode($res["asig_familiar"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BO$fila", utf8_encode($res["mon_destajo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BP$fila", utf8_encode($res["mon_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BQ$fila", utf8_encode($res["mon_licenciaxsubsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BR$fila", utf8_encode($res["mon_descansomedico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BS$fila", utf8_encode($res["mon_licenciacongocedehaber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BT$fila", utf8_encode($res["mon_licenciasingocedehaber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BU$fila", utf8_encode($res["monto_lactancia"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BV$fila", utf8_encode($res["mon_total_sueldo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BW$fila", utf8_encode($res["mon_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BX$fila", utf8_encode($res["mon_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BY$fila", utf8_encode($res["mon_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BZ$fila", utf8_encode($res["mon_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CA$fila", utf8_encode($res["mon_total_horas_extras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CB$fila", utf8_encode($res["mon_total_remuneracionafecto"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CC$fila", utf8_encode($res["dscto_fondopension"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CD$fila", utf8_encode($res["dscto_rentaquinta"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CE$fila", utf8_encode($res["dscto_segurovida"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CF$fila", utf8_encode($res["dscto_basedestajo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CG$fila", utf8_encode($res["dscto_judicial"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CH$fila", utf8_encode($res["dscto_prestamo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CI$fila", utf8_encode($res["dscto_insumodestajeros"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CJ$fila", utf8_encode($res["dscto_varios"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CK$fila", utf8_encode($res["dscto_menu"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CL$fila", utf8_encode($res["dscto_anticipo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CM$fila", utf8_encode($res["total_dsctos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CN$fila", utf8_encode($res["total_deposito_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CO$fila", utf8_encode($res["abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CP$fila", utf8_encode($res["otros_exceso_dscto_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CQ$fila", utf8_encode($res["total_despositobcp_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CR$fila", utf8_encode($res["bono_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CS$fila", utf8_encode($res["bono_destajo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CT$fila", utf8_encode($res["vacaciones_compradas_otros"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CU$fila", utf8_encode($res["total_hextras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CV$fila", utf8_encode($res["dscto_varios"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CW$fila", utf8_encode($res["pago_efectivo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CX$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CY$fila", utf8_encode($res["cant_billetes_100"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CZ$fila", utf8_encode($res["cant_billetes_50"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DA$fila", utf8_encode($res["cant_billetes_20"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DB$fila", utf8_encode($res["cant_billetes_10"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DC$fila", utf8_encode($res["cant_monedas_5"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DD$fila", utf8_encode($res["cant_monedas_2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DE$fila", utf8_encode($res["cant_monedas_1"]));

  
 


 
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


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:DN$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "B$fila:DN$fila");
  


 


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
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CU')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CV')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CX')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DH')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DI')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DM')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DZ')->setWidth(10);


  



  


//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Dsctos y Abonos 1era Quincena"); //establecer titulo de hoja
 
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
MAX(CASE WHEN r_falta.id='1' THEN r_falta.dia ELSE '-' END) AS 'd_ini1',
MAX(CASE WHEN r_falta.id='2' THEN r_falta.dia ELSE '-' END) AS 'd_ini2',
MAX(CASE WHEN r_falta.id='3' THEN r_falta.dia ELSE '-' END) AS 'd_ini3',
MAX(CASE WHEN r_falta.id='4' THEN r_falta.dia ELSE '-' END) AS 'd_ini4',
MAX(CASE WHEN r_falta.id='5' THEN r_falta.dia ELSE '-' END) AS 'd_ini5',
MAX(CASE WHEN r_falta.id='6' THEN r_falta.dia ELSE '-' END) AS 'd_ini6',
MAX(CASE WHEN r_falta.id='7' THEN r_falta.dia ELSE '-' END) AS 'd_ini7',
MAX(CASE WHEN r_falta.id='8' THEN r_falta.dia ELSE '-' END) AS 'd_ini8',
MAX(CASE WHEN r_falta.id='9' THEN r_falta.dia ELSE '-' END) AS 'd_ini9',
MAX(CASE WHEN r_falta.id='10' THEN r_falta.dia ELSE '-' END) AS 'd_ini10',
MAX(CASE WHEN r_falta.id='11' THEN r_falta.dia ELSE '-' END) AS 'd_ini11',
MAX(CASE WHEN r_falta.id='12' THEN r_falta.dia ELSE '-' END) AS 'd_ini12',
MAX(CASE WHEN r_falta.id='13' THEN r_falta.dia ELSE '-' END) AS 'd_ini13',
MAX(CASE WHEN r_falta.id='14' THEN r_falta.dia ELSE '-' END) AS 'd_ini14',
MAX(CASE WHEN r_falta.id='15' THEN r_falta.dia ELSE '-' END) AS 'd_ini15',
MAX(CASE WHEN r_falta.id='16' THEN r_falta.dia ELSE '-' END) AS 'd_ini16',
MAX(CASE WHEN r_falta.id='1' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini1',
MAX(CASE WHEN r_falta.id='2' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini2',
MAX(CASE WHEN r_falta.id='3' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini3',
MAX(CASE WHEN r_falta.id='4' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini4',
MAX(CASE WHEN r_falta.id='5' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini5',
MAX(CASE WHEN r_falta.id='6' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini6',
MAX(CASE WHEN r_falta.id='7' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini7',
MAX(CASE WHEN r_falta.id='8' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini8',
MAX(CASE WHEN r_falta.id='9' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini9',
MAX(CASE WHEN r_falta.id='10' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini10',
MAX(CASE WHEN r_falta.id='11' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini11',
MAX(CASE WHEN r_falta.id='12' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini12',
MAX(CASE WHEN r_falta.id='13' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini13',
MAX(CASE WHEN r_falta.id='14' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini14',
MAX(CASE WHEN r_falta.id='15' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini15',
MAX(CASE WHEN r_falta.id='16' THEN r_falta.dia_letra ELSE '-' END) AS 'nom_d_ini16'
FROM fechas fe
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe.fecha) AS dia,
   MONTH(fe.fecha) AS mes,
   SUBSTRING(fe.nom_dia, 1, 3) AS dia_letra
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
   cp.id_cp= '".$id_pri_quin."'
 WHERE fe.fecha BETWEEN cp.`desde` AND cp.`hasta`
 ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
)  AS r_falta
ON DAY(fe.fecha)=r_falta.dia
;" );
    
     
              
$resPro=mysql_fetch_array($sqlPro);




 $sqlPro2=mysql_query("SELECT
MAX(CASE WHEN r_he.id='1' THEN r_he.dia ELSE '-' END) AS 'd_ini1_he',
MAX(CASE WHEN r_he.id='2' THEN r_he.dia ELSE '-' END) AS 'd_ini2_he',
MAX(CASE WHEN r_he.id='3' THEN r_he.dia ELSE '-' END) AS 'd_ini3_he',
MAX(CASE WHEN r_he.id='4' THEN r_he.dia ELSE '-' END) AS 'd_ini4_he',
MAX(CASE WHEN r_he.id='5' THEN r_he.dia ELSE '-' END) AS 'd_ini5_he',
MAX(CASE WHEN r_he.id='6' THEN r_he.dia ELSE '-' END) AS 'd_ini6_he',
MAX(CASE WHEN r_he.id='7' THEN r_he.dia ELSE '-' END) AS 'd_ini7_he',
MAX(CASE WHEN r_he.id='8' THEN r_he.dia ELSE '-' END) AS 'd_ini8_he',
MAX(CASE WHEN r_he.id='9' THEN r_he.dia ELSE '-' END) AS 'd_ini9_he',
MAX(CASE WHEN r_he.id='10' THEN r_he.dia ELSE '-' END) AS 'd_ini10_he',
MAX(CASE WHEN r_he.id='11' THEN r_he.dia ELSE '-' END) AS 'd_ini11_he',
MAX(CASE WHEN r_he.id='12' THEN r_he.dia ELSE '-' END) AS 'd_ini12_he',
MAX(CASE WHEN r_he.id='13' THEN r_he.dia ELSE '-' END) AS 'd_ini13_he',
MAX(CASE WHEN r_he.id='14' THEN r_he.dia ELSE '-' END) AS 'd_ini14_he',
MAX(CASE WHEN r_he.id='15' THEN r_he.dia ELSE '-' END) AS 'd_ini15_he',
MAX(CASE WHEN r_he.id='16' THEN r_he.dia ELSE '-' END) AS 'd_ini16_he',
MAX(CASE WHEN r_he.id='1' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini1_he',
MAX(CASE WHEN r_he.id='2' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini2_he',
MAX(CASE WHEN r_he.id='3' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini3_he',
MAX(CASE WHEN r_he.id='4' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini4_he',
MAX(CASE WHEN r_he.id='5' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini5_he',
MAX(CASE WHEN r_he.id='6' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini6_he',
MAX(CASE WHEN r_he.id='7' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini7_he',
MAX(CASE WHEN r_he.id='8' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini8_he',
MAX(CASE WHEN r_he.id='9' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini9_he',
MAX(CASE WHEN r_he.id='10' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini10_he',
MAX(CASE WHEN r_he.id='11' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini11_he',
MAX(CASE WHEN r_he.id='12' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini12_he',
MAX(CASE WHEN r_he.id='13' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini13_he',
MAX(CASE WHEN r_he.id='14' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini14_he',
MAX(CASE WHEN r_he.id='15' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini15_he',
MAX(CASE WHEN r_he.id='16' THEN r_he.dia_letra ELSE '-' END) AS 'nom_d_ini16_he'
FROM fechas fe
LEFT JOIN
(SELECT (@i := @i + 1) AS id ,
   DAY(fe.fecha) AS dia,
   MONTH(fe.fecha) AS mes,
   SUBSTRING(fe.nom_dia, 1, 3) AS dia_letra
 FROM (SELECT @i:=0) r
   INNER JOIN fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
   cp.id_cp= '".$id_pri_quin."'
 WHERE fe.fecha BETWEEN cp.`desde` AND cp.`hasta`
 ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
)  AS r_he
ON DAY(fe.fecha)=r_he.dia
;" );
    
     
              
$resPro2=mysql_fetch_array($sqlPro2);



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
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro2["nom_d_ini1_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro2["nom_d_ini2_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro2["nom_d_ini3_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro2["nom_d_ini4_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro2["nom_d_ini5_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro2["nom_d_ini6_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro2["nom_d_ini7_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro2["nom_d_ini8_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro2["nom_d_ini9_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro2["nom_d_ini10_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro2["nom_d_ini11_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro2["nom_d_ini12_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro2["nom_d_ini13_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro2["nom_d_ini14_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro2["nom_d_ini15_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro2["nom_d_ini16_he"])); 


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
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($resPro2["d_ini1_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($resPro2["d_ini2_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($resPro2["d_ini3_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($resPro2["d_ini4_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($resPro2["d_ini5_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($resPro2["d_ini6_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($resPro2["d_ini7_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($resPro2["d_ini8_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($resPro2["d_ini9_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($resPro2["d_ini10_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($resPro2["d_ini11_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($resPro2["d_ini12_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($resPro2["d_ini13_he"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($resPro2["d_ini14_he"]));
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($resPro2["d_ini15_he"]));  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($resPro2["d_ini16_he"])); 
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

$sql=mysql_query("SELECT DISTINCT tr.id_trab,
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
  MAX(CASE WHEN hpp.id_dscto='1' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini1',
  MAX(CASE WHEN hpp.id_dscto='2' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini2',
  MAX(CASE WHEN hpp.id_dscto='3' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini3',
  MAX(CASE WHEN hpp.id_dscto='4' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini4',
  MAX(CASE WHEN hpp.id_dscto='5' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini5',
  MAX(CASE WHEN hpp.id_dscto='6' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini6',
  MAX(CASE WHEN hpp.id_dscto='7' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini7',
  MAX(CASE WHEN hpp.id_dscto='8' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini8',
  MAX(CASE WHEN hpp.id_dscto='9' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini9',
  MAX(CASE WHEN hpp.id_dscto='10' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini10',
  MAX(CASE WHEN hpp.id_dscto='11' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini11',
  MAX(CASE WHEN hpp.id_dscto='12' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini12',
  MAX(CASE WHEN hpp.id_dscto='13' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini13',
  MAX(CASE WHEN hpp.id_dscto='14' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini14',
  MAX(CASE WHEN hpp.id_dscto='15' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini15',
  MAX(CASE WHEN hpp.id_dscto='16' THEN IF(hpp.dato='00:00', '', hpp.dato) ELSE '' END) AS 'd_ini16',
  IF( ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   ) ='00:00' , '', ADDTIME(
  CASE WHEN hpp_reg.cant_horas='' THEN  '00:00'
  WHEN hpp_reg.cant_horas IS NULL THEN '00:00' 
  ELSE hpp_reg.cant_horas   END
   , CASE WHEN fcc.cant_horas='' THEN '00:00'
  WHEN fcc.cant_horas IS NULL THEN '00:00' 
  ELSE fcc.cant_horas   END 
   )   )AS tot_cant_horas,
   IF(
  (
  CASE WHEN hpp_reg.cant_dias='' THEN  '0'
  WHEN hpp_reg.cant_dias IS NULL THEN '0' 
  ELSE hpp_reg.cant_dias  END
   + CASE WHEN fcc.cant_dias='' THEN '0' 
  WHEN fcc.cant_dias IS NULL THEN '0' 
  ELSE fcc.cant_dias   END 
   )='0' , '',(
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
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   )='00:00', '', 
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al25='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al25   END
   , CASE WHEN fhe.cant_horas_al25='' THEN '00:00:00'
  WHEN fhe.cant_horas_al25 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al25   END 
   )
   ) AS tot_cant_horas_al25,
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   ) ='00:00', '' , 
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_al35='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_al35   END
  , CASE WHEN fhe.cant_horas_al35='' THEN '00:00:00'
  WHEN fhe.cant_horas_al35 IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_al35   END 
   )
   ) AS tot_cant_horas_al35, 
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   ) ='00:00', '', 
   ADDTIME(
  CASE WHEN fhe_reg.cant_horas_dom='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_dom   END
  , CASE WHEN fhe.cant_horas_dom='' THEN '00:00:00'
  WHEN fhe.cant_horas_dom IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_dom   END 
   )
   ) AS tot_cant_horas_dom, 
  IF(ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   ) ='00:00', '' ,
  ADDTIME(
  CASE WHEN fhe_reg.cant_horas_fer='' THEN  '00:00:00'
  WHEN fhe_reg.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe_reg.cant_horas_fer   END
  , CASE WHEN fhe.cant_horas_fer='' THEN '00:00:00'
  WHEN fhe.cant_horas_fer IS NULL THEN '00:00:00' 
  ELSE fhe.cant_horas_fer   END 
   )
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
LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
    cp.id_cp='".$id_pri_quin."'
LEFT JOIN  cronograma_dsctos_abonos_horasdias ch ON 
    ch.id_cp='".$id_pri_quin."'
LEFT JOIN  cronograma_dsctos_abonos_horasdias cd ON 
    cd.id_cp='".$id_pri_quin."'
LEFT JOIN /*Regularizacion de horas y dias de descuento */
( SELECT tr.id_trab, DATE_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))), '%H:%i') AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
       FROM horas_permiso_personal hpp
       LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_pri_quin."'
       WHERE  hpp.fecha NOT BETWEEN cp.desde AND cp.hasta
       AND  hpp.id_fec_dscto='".$id_pri_quin."'
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS hpp_reg ON tr.id_trab =  hpp_reg.id_trab
LEFT JOIN  /* HORAS Y DIAS DE DESCUENTOS */
( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, r.id_dscto 
  FROM horas_permiso_personal hpp
  LEFT JOIN/* INICIO  - El que causa conflicto*/
  (SELECT  (@o := @o + 1)  AS id_dscto ,
     DAY(fe.fecha) AS dia_dscto,
     MONTH(fe.fecha) AS mes_dscto
   FROM (SELECT @o:=0) r
     INNER JOIN fechas fe
     LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_pri_quin."'
   WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
   ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
  )  AS r 
  ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
) AS hpp ON tr.id_trab =  hpp.id_trab
  AND hpp.fecha BETWEEN cd.desde AND cd.hasta
LEFT JOIN 
( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
  FROM Trabajador tr
  LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
        FROM horas_permiso_personal hpp
        LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
          cp.id_cp='".$id_pri_quin."'
  WHERE  hpp.fecha BETWEEN cp.desde AND cp.hasta
  )AS hpp ON tr.id_trab =  hpp.id_trab
  GROUP BY tr.id_trab
) AS fcc ON fcc.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
FROM horas_extras_personal hep
) AS hep ON tr.id_trab =  hep.id_trab
AND hep.fecha BETWEEN ch.desde AND ch.hasta
LEFT JOIN /*Regularizacion de horas y dias de abono */
( SELECT tr.id_trab, 
   IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
   IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
   IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
   IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha NOT BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_pri_quin."'
                   GROUP BY id_trab
   )AS he_25 ON tr.id_trab =  he_25.id_trab
   LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha NOT  BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_pri_quin."'
                   GROUP BY id_trab
   )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha NOT BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                    AND hep.id_fec_abono='".$id_pri_quin."'
                  GROUP BY id_trab
   )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha NOT  BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
                    AND hep.id_fec_abono='".$id_pri_quin."'
               GROUP BY id_trab
   )AS he_fe ON tr.id_trab =  he_fe.id_trab
  GROUP BY tr.id_trab   
) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
LEFT JOIN 
( SELECT tr.id_trab, 
         IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
         IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
   IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
   IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
  FROM Trabajador tr
  LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_pri_quin."'
                   GROUP BY id_trab
   )AS he_25 ON tr.id_trab =  he_25.id_trab
   LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   AND hep.id_fec_abono='".$id_pri_quin."'
                   GROUP BY id_trab
   )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                    AND hep.id_fec_abono='".$id_pri_quin."'
                  GROUP BY id_trab
   )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
                    AND hep.id_fec_abono='".$id_pri_quin."'
               GROUP BY id_trab
   )AS he_fe ON tr.id_trab =  he_fe.id_trab
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
      MONTH(fecha) AS mes,
      cp.desde,
      cp.hasta
  FROM fechas fe
   LEFT JOIN cronograma_dsctos_abonos_horasdias cp ON 
           cp.id_cp='".$id_pri_quin."'
  WHERE fe.fecha BETWEEN  cp.desde AND cp.hasta
  GROUP BY DAY(fecha)
   ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
 WHERE fe_ext.fecha BETWEEN fr_ext.desde AND fr_ext.hasta
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

  
//FIN DE SEGUNDA HOJA



//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja 2 
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora 2
$objPHPExcel->getActiveSheet()->setTitle("Planilla 1era Quincena"); //establecer titulo de hoja
 
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




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "PAGO DE PLANILLA DE HABERES");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:V$fila"); //unir celdas
//$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:D$fila"); //establecer estilo


 
$fila=3;


//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

$objPHPExcel->getActiveSheet()->freezePane('W5');


$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'EST.CIVIL');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'TIP.CONTRATO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CONTRATO FIN.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CONTRATO FIN.ACTU');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TIEMPO LABOR');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'TIP.COMISION ACTUAL');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'GENERO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'CORREO');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'TELEFONO');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'CODIGO COSTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'CONCEPTO DE COSTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'TIP.MANO DE OBRA');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'T.REGISTRO');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'TIP.PLANILLA'); 
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila",  'SUCURSAL ANEXO');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila",  'DNI');  
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila",  'APELLIDO PATERNO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila",  'APELLIDO MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila",  'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila",  'APELLIDOS Y NOMBRES'); 
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila",  'FECHA NACIMIENTO');  
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila",  'FECHA INGRESO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("Y$fila",  'FECHA CESE');
$objPHPExcel->getActiveSheet()->SetCellValue("Z$fila",  'NUMERO CTA SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("AA$fila",  'NUMERO CTA SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("AB$fila",  'NUMERO CTA CTS');
$objPHPExcel->getActiveSheet()->SetCellValue("AC$fila",  'NUMERO CTA CTS');
$objPHPExcel->getActiveSheet()->SetCellValue("AD$fila",  'FORMA DE PAGO'); 
$objPHPExcel->getActiveSheet()->SetCellValue("AE$fila",  'AREA'); 
$objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", 'CATEGORIA');
$objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", 'REG. PENSIONARIO AFP/ONP');
$objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", 'CODIGO CUSP');
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", 'REMUNERACION MENSUAL');
$objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", 'ASIG. FAMILIAR');
$objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", 'HORAS DE LACTANCIA');
$objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", 'HORAS TRABAJADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", 'DIAS TRABAJADOS');
$objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", 'H.E 25%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", 'H.E 35%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", 'H.E DOMINCIAL 100%');   
$objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", 'H.E FERIADO 100%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", 'CANTIDAD AL 25%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", 'CANTIDAD AL 35%');  
$objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", 'CANTIDAD DOMINCIAL 100%');   
$objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", 'CANTIDAD FERIADO 100%');     
$objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", 'FECHA VACACIONES');  
$objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", 'DIAS VACACIONES');  
$objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", 'FECHA DESCANSO MEDICO');    
$objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", 'DIAS DESCANSO MEDICO');  
$objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", 'FECHA SUBSIDIO');  
$objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", 'DIAS SUBSIDIO');   
$objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", 'FECHA LICENCIA CON GOCE DE HABER');  
$objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", 'DIAS LICENCIA CON GOCE DE HABER');    
$objPHPExcel->getActiveSheet()->SetCellValue("BE$fila", 'FECHA LICENCIA SIN GOCE DE HABER'); 
$objPHPExcel->getActiveSheet()->SetCellValue("BF$fila", 'DIAS LICENCIA SIN GOCE DE HABER');     
$objPHPExcel->getActiveSheet()->SetCellValue("BG$fila", 'FECHA FALTA');
$objPHPExcel->getActiveSheet()->SetCellValue("BH$fila", 'HORAS FALTADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BI$fila", 'DIAS FALTADOS');
$objPHPExcel->getActiveSheet()->SetCellValue("BJ$fila", 'DSCTO DOMINICAL H.S');
$objPHPExcel->getActiveSheet()->SetCellValue("BK$fila", 'TOTAL DSCTO POR HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BL$fila", 'TOTAL DSCTO POR FALTAS');
$objPHPExcel->getActiveSheet()->SetCellValue("BM$fila", 'SUELDO QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("BN$fila", 'ASIG.FAMILIAR');
$objPHPExcel->getActiveSheet()->SetCellValue("BO$fila", 'DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("BP$fila", 'VACACIONES');
$objPHPExcel->getActiveSheet()->SetCellValue("BQ$fila", 'LICENCIA POR SUBSIDIO');
$objPHPExcel->getActiveSheet()->SetCellValue("BR$fila", 'DESCANSO MEDICO');
$objPHPExcel->getActiveSheet()->SetCellValue("BS$fila", 'LICENCIA CON GOCE DE HABER');
$objPHPExcel->getActiveSheet()->SetCellValue("BT$fila", 'LICENCIA SIN GOCE DE HABER');
$objPHPExcel->getActiveSheet()->SetCellValue("BU$fila", 'PERMISO HORA LACTANCIA');
$objPHPExcel->getActiveSheet()->SetCellValue("BV$fila", 'TOTAL SUELDO QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("BW$fila", 'CANTIDAD AL 25%');
$objPHPExcel->getActiveSheet()->SetCellValue("BX$fila", 'CANTIDAD AL 35%');
$objPHPExcel->getActiveSheet()->SetCellValue("BY$fila", 'CANTIDAD DOMINICAL 100%');
$objPHPExcel->getActiveSheet()->SetCellValue("BZ$fila", 'CANTIDAD FERIADO 100%');
$objPHPExcel->getActiveSheet()->SetCellValue("CA$fila", 'MONTO TOTAL HORAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CB$fila", 'TOTAL REMUNERACION AFECTO');
$objPHPExcel->getActiveSheet()->SetCellValue("CC$fila", 'DSCTO FONDO DE PENSION ');
$objPHPExcel->getActiveSheet()->SetCellValue("CD$fila", 'DSCTO RENTA 5TA');
$objPHPExcel->getActiveSheet()->SetCellValue("CE$fila", 'VIDA SEGURO DE ACCIDENTE');
$objPHPExcel->getActiveSheet()->SetCellValue("CF$fila", 'DSCTO BASE A DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("CG$fila", 'DSCTO JUDICIALES');
$objPHPExcel->getActiveSheet()->SetCellValue("CH$fila", 'DSCTO PRESTAMOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CI$fila", 'DSCTO INSUMOS Y DESTAJEROS');
$objPHPExcel->getActiveSheet()->SetCellValue("CJ$fila", 'DSCTO VARIOS   (PRENDAS)');
$objPHPExcel->getActiveSheet()->SetCellValue("CK$fila", 'DSCTO MENU');
$objPHPExcel->getActiveSheet()->SetCellValue("CL$fila", 'ANTICIPO - ADELANTO,  VACACIONES CHEQUE / EFECTIVO');
$objPHPExcel->getActiveSheet()->SetCellValue("CM$fila", 'TOTAL DESCUENTOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CN$fila", 'TOTAL DEPOSITAR QUICENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("CO$fila", 'REGULARIZACION');
$objPHPExcel->getActiveSheet()->SetCellValue("CP$fila", 'OTROS VARIOS    (EXCESO)');
$objPHPExcel->getActiveSheet()->SetCellValue("CQ$fila", 'TOTAL A DEPOSITAR BCP QUINCENAL');
$objPHPExcel->getActiveSheet()->SetCellValue("CR$fila", 'BONO SUELDO');
$objPHPExcel->getActiveSheet()->SetCellValue("CS$fila", 'BONO DESTAJO');
$objPHPExcel->getActiveSheet()->SetCellValue("CT$fila", 'VACACIONES COMPRADAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CU$fila", 'TOTAL  H.EXTRAS');
$objPHPExcel->getActiveSheet()->SetCellValue("CV$fila", 'DESCUENTOS VARIOS');
$objPHPExcel->getActiveSheet()->SetCellValue("CW$fila", 'TOTAL PAGO EFECTIVO');
$objPHPExcel->getActiveSheet()->SetCellValue("CX$fila", 'OBSERVACIONES ');
$objPHPExcel->getActiveSheet()->SetCellValue("CY$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("CZ$fila", '100');
$objPHPExcel->getActiveSheet()->SetCellValue("DA$fila", '50');
$objPHPExcel->getActiveSheet()->SetCellValue("DB$fila", '20');
$objPHPExcel->getActiveSheet()->SetCellValue("DC$fila", '10');
$objPHPExcel->getActiveSheet()->SetCellValue("DD$fila", '5');
$objPHPExcel->getActiveSheet()->SetCellValue("DE$fila", '2');
$objPHPExcel->getActiveSheet()->SetCellValue("DF$fila", '1');
$objPHPExcel->getActiveSheet()->SetCellValue("DG$fila", '-');
$objPHPExcel->getActiveSheet()->SetCellValue("DH$fila", '100');
$objPHPExcel->getActiveSheet()->SetCellValue("DI$fila", '50');
$objPHPExcel->getActiveSheet()->SetCellValue("DJ$fila", '20');
$objPHPExcel->getActiveSheet()->SetCellValue("DK$fila", '10');
$objPHPExcel->getActiveSheet()->SetCellValue("DL$fila", '5');
$objPHPExcel->getActiveSheet()->SetCellValue("DM$fila", '2');
$objPHPExcel->getActiveSheet()->SetCellValue("DN$fila", '1');
  






$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:DN$fila");


$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setVisible(false);

$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setVisible(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setVisible(false);


$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("U$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("V$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("W$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("X$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Y$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("Z$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("AZ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("BZ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CA$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CB$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CC$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CD$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CE$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CF$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CG$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CH$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CI$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CJ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CK$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CL$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CM$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CN$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CO$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CP$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CQ$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CR$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CS$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CT$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CU$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CV$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CW$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CX$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CY$fila")->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("CZ$fila")->getAlignment()->setWrapText(true);

//rellenar con contenido  

$sql=mysql_query("SELECT  DISTINCT   tr.id_trab,
    teci.des_corta AS estado_civil,
    tcon.des_larga AS tipo_contrato,
    ttca.des_larga AS comision_actual,
    tgen.des_corta AS genero,
    tr.id_cen_cost AS cod_centro_costos,
    tcco.des_larga AS centro_costos,
    ttmo.des_corta AS tipo_mano_obra,
    ttre.des_larga AS t_registro,
    tpla.des_larga AS tipo_planilla,
    IFNULL(tsua.des_larga,'')  AS sucursal_anexo, 
    tr.num_doc_trab,
    tr.apepat_trab,
    tr.apemat_trab,
    tr.nom_trab,
    CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, 
    DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y') AS fec_nac_trab,  
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
    IF( DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')='00/00/0000', '', DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y')) AS fec_sal_trab, 
    tr.nro_cta_sue AS nro_cta_sue_con,
    REPLACE(tr.nro_cta_sue,'-','') AS nro_cta_sue_sin,
    tr.nro_cta_cts AS nro_cta_cts_con,
    REPLACE(tr.nro_cta_cts,'-','') AS nro_cta_cts_sin,
    tfop.des_larga AS forma_pago, 
    tare.des_larga AS area_trab, 
    tfun.des_larga AS funcion,
    tcal.des_larga AS categoria_laboral,
    trep.des_larga AS regimen_pensionario,
    tr.cusp_trab,
    tr.sueldo_trab,
    IF(tr.asig_trab=0,'' , asig_trab) AS asig_trab,
    IF(hl.cantidad_horas IS NULL , '', hl.cantidad_horas) AS horas_lactancia,
    ((15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0')  - IFNULL(het.cant_dscto_endias,'')  ) *8) - IF(hl.cantidad_horas IS NULL , '0', hl.cantidad_horas)  AS horas_trabajadas,
    (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) AS dias_trabajados,
    trcop.pre_hor_ext_25,
    trcop.pre_hor_ext_35,
    trcop.pre_hor_ext_dominical,
    trcop.pre_hor_ext_feriado,
    het.cant_abono_horas_al25  AS cant_hor_ext_25,
    het.cant_abono_horas_al35 AS cant_hor_ext_35,
    het.cant_abono_horas_dom AS cant_hor_ext_dominical,
    het.cant_abono_horas_fer AS cant_hor_ext_feriado,
    IFNULL(vac.fechas,'') AS fecha_vacaciones,
    IFNULL(vac.dias,'')   AS cant_dias_vacaciones,
    IF(dme.dias>0, dme.fechas, '' )  AS fecha_descanso_medico,
    IF(dme.dias>0, dme.dias, '' )    AS cant_dias_descanso_medico,  
    IF(sub.dias>0, sub.fechas, '' )  AS fecha_subsidio,
    IF(sub.dias>0, sub.dias, '' )    AS cant_dias_subsidio,
    IF(lco.dias>0, lco.fechas, '' )  AS fecha_lic_con_goce_haber, 
    IF(lco.dias>0, lco.dias, '' )    AS cant_dias_lic_con_goce_haber,
    IF(lsi.dias>0, lsi.fechas, '' )  AS fecha_lic_sin_goce_haber,
    IF(lsi.dias>0, lsi.dias, '' )  AS cant_dias_lic_sin_goce_haber,
    het.cant_dscto_enhoras AS cant_horas_faltadas,
    het.cant_dscto_endias AS cant_dias_falta,
     CASE 
    WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
    WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
    WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
    WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
    WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
    ELSE ''  END
    AS dscto_dom_hsxdias_semanal,  /*AL FINAL AUTOCALCULABLE*/
    IF(ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) ='0.00', '', ROUND(((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2) )  AS total_dsctoxhoras,  /*AL FINAL AUTOCALCULABLE*/
    ROUND( ((tr.sueldo_trab/30)* cant_dscto_endias) + het.dscto_dom_hsxdias_semanal , 2) AS total_dsctoxfaltas,  /*AL FINAL AUTOCALCULABLE*/
    ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)  AS sueldo_quincenal,  /* CORREGIR - AL FINAL AUTOCALCULABLE*/
    IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))AS asig_familiar,
    IF(pd.dif_soles IS NULL,'',pd.dif_soles) AS mon_destajo,
    IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' ) AS mon_vacaciones,
    IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) ) AS mon_licenciaxsubsidio,
    IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) ) AS mon_descansomedico,
    IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) ) AS mon_licenciacongocedehaber,
   /* IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) ) AS mon_licenciasingocedehaber, NO SE PAGA POR LICENCIA SIN GOCE*/
    IFNULL(hl.mon_permisoxhoralactancia, '') AS monto_lactancia,
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  COMENTADO PORQUE NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') )
    AS mon_total_sueldo_quincenal,
    het.cant_abono_horas_al25  AS cant_hor_ext_25,
    ROUND((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25), 2)        AS mon_hor_ext_25,
    het.cant_abono_horas_al35 cant_hor_ext_35,
    ROUND((het.cant_abono_horas_al35 * trcop.pre_hor_ext_35), 2)        AS mon_hor_ext_35,
    het.cant_abono_horas_dom AS cant_hor_ext_dominical,
    ROUND((het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical), 2)  AS mon_hor_ext_dominical,
    het.cant_abono_horas_fer AS cant_hor_ext_feriado,
    ROUND((het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado), 2)    AS mon_hor_ext_feriado,
    ROUND
    (
    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
    )
    AS mon_total_horas_extras,
    /*INI TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ AS mon_total_remuneracionafecto,
    ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)  AS dscto_fondopension,
     rp.monto_reg_pen,
    IFNULL(rqc.mon_quin, '') AS dscto_rentaquinta,
    '' AS dscto_segurovida,
    '' AS dscto_basedestajo,
    IFNULL(ROUND(dj.mon_men,2),0.00)  AS dscto_judicial,
    IFNULL(ROUND(dp.monto,2),0.00)  AS dscto_prestamo,
    IFNULL(ROUND(did.monto,2),0.00)   AS dscto_insumodestajeros,
    IFNULL(ROUND(dv.monto,2),0.00)  AS dscto_varios,
    IFNULL(ROUND(dm.monto,2),0.00)  AS dscto_menu,
    IFNULL(ROUND(aa.monto,2),0.00)        AS dscto_anticipo,
    /*INICIO TOTAL DESCUENTOS */
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    AS total_dsctos,
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
      AS total_deposito_quincenal,
    /*------------------------------------NUEVA FILA------------------------------------*/
    /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/
     AS abono_regularizacion,
    '' AS otros_exceso_dscto_quincenal,
    /*INICIO - TOTAL BCP DEPOSITO QUINCENAL --------------- NUEVA FILA------------------ */
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    /*FIN TOTAL DEPOSITO QUINCENAL */
    /**/
    + 
     /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/

    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
    AS total_despositobcp_quincenal,
    /*------------------------------------NUEVA FILA------------------------------------*/
    (tr.bono_trab/2) AS bono_quincenal,
    IFNULL(pd.bono_des_trab,0.00) AS bono_destajo_quincenal,
      /*------------------------------------NUEVA FILA------------------------------------*/
    '0' AS vacaciones_compradas_otros, /* FALTA CALCULAR DESDE LA PANTALLLA  */
      /*------------------------------------NUEVA FILA------------------------------------*/
    ROUND(
    ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
    (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado))  
     + 0.0000000001 
     , 2) AS total_hextras,
     /*------------------------------------NUEVA FILA------------------------------------*/
    '' AS dscto_varios,
    /* --------------- NUEVA FILA------------------SIGUINTE FILA*/
      CASE 
      /*Cuando estan planilla*/
       WHEN  tr.id_trab LIKE 'P%'  THEN 
      (ROUND( (tr.bono_trab/2)   /*BONO SUELDO */+
             IFNULL(pd.bono_des_trab,0.00) +
            /*LINEA DE VACACIONES COMPRADAS*/  
             ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
            (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
             , 0))
      /*Cuando son internos*/          
       ELSE 
    ROUND(
     /*INICIO - TOTAL BCP DEPOSITO QUINCENAL */
    /*INICIO TOTAL REMUNERACION AFECTO*/
    ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) 
    /*FIN TOTAL REMUNERACION AFECTO*/ 
    /*RESTAR*/
    -
    /*INI- fondo de pension*/
     ROUND(
     ROUND(/*MRA*/(ROUND(
    (ROUND(((tr.sueldo_trab/30)* (15- IFNULL(vac.dias,'0') - IFNULL(dme.dias,'0') - IFNULL(sub.dias,'0')  - IFNULL(lco.dias,'0') - IFNULL(lsi.dias,'0') - IFNULL(het.cant_dscto_endias,'')) )  - het.dscto_dom_hsxdias_semanal - ((tr.sueldo_trab/240) * het.cant_dscto_enhoras), 2)) + 
    (IF((tr.asig_trab/2)='0', '', (tr.asig_trab/2))) +
    (IF(pd.dif_soles IS NULL,'',pd.dif_soles)) +
    (IF(vac.monto='SI', ROUND(vac.monto_a_pagar,2), '' )) +   
    (IF(ROUND(((tr.sueldo_trab/30)* sub.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* sub.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* dme.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* dme.dias), 2) )) +
    (IF(ROUND(((tr.sueldo_trab/30)* lco.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lco.dias), 2) )) +
    /*(IF(ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) IS NULL, '', ROUND(((tr.sueldo_trab/30)* lsi.dias), 2) )) +  NO SE PAGA*/
    (IFNULL(hl.mon_permisoxhoralactancia, '') ) /*FIN TOTAL REMUNERACION AFECTO*/
    ,2) )/*MRA*/ * (rp.monto_reg_pen/100)
     + 0.0000000001 /*AGREGADO PARA QUE REDONDEE CORRECTAMENTE*/,2)/*FIN- fondo de pension*/ +
    IFNULL(dj.mon_men,0.00) +
    IFNULL(dp.monto,0.00) +
    IFNULL(did.monto,0.00) +
    IFNULL(dv.monto,0.00) +
    IFNULL(dm.monto,0.00) +
    IFNULL(aa.monto,0.00) 
    + 0.0000000001 ,2)
    /*FIN TOTAL DESCUENTOS */
    /*FIN TOTAL DEPOSITO QUINCENAL */
    /**/
    + 
     /*INICIO - ABONO REGULARIZACION*/
    IFNULL(ROUND(ar.cantidad + 0.0000000001 ,2 ),0.00) 
    /*FIN - ABONO REGULARIZACION*/
    /*FIN  - TOTAL BCP DEPOSITO QUINCENAL*/
     
    /*INICIO SUMAR CON LOS PAGOS EN EFECTIVOS*/
    +
     ( (tr.bono_trab/2)   /*BONO SUELDO */+
       IFNULL(pd.bono_des_trab,0.00) +
      /*LINEA DE VACACIONES COMPRADAS*/  
      ((het.cant_abono_horas_al25 * trcop.pre_hor_ext_25)       +  (het.cant_abono_horas_al35 * trcop.pre_hor_ext_35) +
       (het.cant_abono_horas_dom * trcop.pre_hor_ext_dominical) +  (het.cant_abono_horas_fer * trcop.pre_hor_ext_feriado)) 
     )
    /*FIN SUMAR CON LOS PAGOS EN EFECTIVOS*/
    ,0 )
   END
       pago_efectivo,
    NULL AS observaciones,
    NULL AS cant_billetes_100,
    NULL AS cant_billetes_50,
    NULL AS cant_billetes_20,
    NULL AS cant_billetes_10,
    NULL AS cant_monedas_5,
    NULL AS cant_monedas_2,
    NULL AS cant_monedas_1
        FROM trabajador tr
        CROSS JOIN (SELECT @i := 0) tr
        LEFT JOIN (
        SELECT  id_trab, mon_total,  ROUND((mon_total/2),2) AS mon_quin
        FROM renta_quinta_categoria
        WHERE  est_reg='1'  
        ) AS  rqc ON rqc.id_trab= tr.id_trab
        LEFT JOIN (SELECT  ma.id_trab,
               ma.fec_nac_c1,
               hl.cantidad_horas,
               IF(ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2) IS NULL, '', ROUND(((tr.sueldo_trab/240)* hl.cantidad_horas), 2)) AS mon_permisoxhoralactancia
             FROM maternidad  ma
             LEFT JOIN trabajador tr
             ON tr.id_trab= ma.id_trab
             LEFT JOIN (SELECT hl.id_cp, hl.cantidad_horas
             FROM horas_lactancia hl  
             ) AS hl ON hl.id_cp='".$id_pri_quin."'
            WHERE DATEDIFF(CURDATE(), fec_nac_c1) <=365
        ) AS hl ON hl.id_trab=tr.id_trab
        LEFT JOIN (
        SELECT  tr.id_trab,
          ROUND(((tr.sueldo_trab/240)* 0.25)+ (tr.sueldo_trab/240), 2) AS pre_hor_ext_25,
          ROUND(  (((tr.sueldo_trab/240)* 0.35)+ (tr.sueldo_trab/240)) +  0.0000000001 , 2) AS pre_hor_ext_35,
          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001  , 2) AS pre_hor_ext_dominical,
          ROUND(  ((tr.sueldo_trab/240)* 2) +  0.0000000001 , 2) AS pre_hor_ext_feriado
        FROM trabajador  tr
        ) AS trcop ON trcop.id_trab= tr.id_trab
        LEFT JOIN (
          SELECT  tr.id_trab,
          het.cant_dscto_enhoras,
          het.cant_dscto_endias,
          het.cant_abono_horas_al25,
          het.cant_abono_horas_al35,
          het.cant_abono_horas_dom,
          het.cant_abono_horas_fer,
          CASE 
          WHEN  het.cant_dscto_endias='1' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*40), 2) 
          WHEN  het.cant_dscto_endias='2' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*32), 2) 
          WHEN  het.cant_dscto_endias='3' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*24), 2) 
          WHEN  het.cant_dscto_endias='4' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*16), 2) 
          WHEN  het.cant_dscto_endias='5' THEN ROUND((tr.sueldo_trab/30)-(((tr.sueldo_trab/30)/48)*8) , 2) 
          ELSE ''  END
          AS dscto_dom_hsxdias_semanal
          FROM trabajador tr
          LEFT JOIN ( 
            SELECT  tr.id_trab,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas) ) ,'-', '') /(3600*1.0)) AS cant_dscto_enhoras,
            tr1.tot_cant_dias AS cant_dscto_endias,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al25) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al25,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_al35) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_al35,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_dom) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_dom,
            IF(REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0) ='' OR REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)  IS NULL , '',
            REPLACE(TIME_TO_SEC( TIMEDIFF( '00:00', tr1.tot_cant_horas_fer) ) ,'-', '') /(3600*1.0)) AS cant_abono_horas_fer
            FROM trabajador tr 
            LEFT JOIN ( 
            SELECT  tr.id_trab,  
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
              (
              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
              ELSE hpp_reg.cant_dias  END
               + CASE WHEN fcc.cant_dias='' THEN '0' 
              WHEN fcc.cant_dias IS NULL THEN '0' 
              ELSE fcc.cant_dias   END 
               )='0' , '',(
              CASE WHEN hpp_reg.cant_dias='' THEN  '0'
              WHEN hpp_reg.cant_dias IS NULL THEN '0' 
              ELSE hpp_reg.cant_dias  END
               + CASE WHEN fcc.cant_dias='' THEN '0' 
              WHEN fcc.cant_dias IS NULL THEN '0' 
              ELSE fcc.cant_dias   END 
               ))   AS tot_cant_dias,
              '-' AS separador, 
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
            LEFT JOIN cronograma_pagos cp ON 
                 cp.id_cp='".$id_pri_quin."'
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
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                   cp.id_cp='".$id_pri_quin."'
                   WHERE  hpp.fecha NOT BETWEEN cp.desde AND cp.hasta
                   AND  hpp.id_fec_dscto='".$id_pri_quin."'
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
                 LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                            cp.id_cp= '".$id_pri_quin."'
               WHERE fe.fecha BETWEEN cp.desde AND cp.hasta
               ORDER BY MONTH(fe.fecha) ASC,  DAY(fe.fecha) ASC
              )  AS r 
              ON DAY(hpp.fecha)=r.dia_dscto /* FIN  - El que causa conflicto*/
            ) AS hpp ON tr.id_trab =  hpp.id_trab
              AND hpp.fecha BETWEEN cp.desde AND cp.hasta
            LEFT JOIN 
            ( SELECT tr.id_trab, SEC_TO_TIME(SUM(TIME_TO_SEC(hpp.tiempo_fin))) AS cant_horas, SUM(IF(hpp.dato='F', 1, 0)) AS cant_dias  
              FROM Trabajador tr
              LEFT JOIN ( SELECT IF (hpp.cant_dia_fin='0', DATE_FORMAT(hpp.tiempo_fin, '%H:%i'), 'F'  ) AS dato, hpp.id_trab, hpp.fecha, hpp.tiempo_fin
              FROM horas_permiso_personal hpp
              LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
              cp.id_cp= '".$id_pri_quin."'
              WHERE  hpp.fecha BETWEEN cp.desde AND cp.hasta
              )AS hpp ON tr.id_trab =  hpp.id_trab
              GROUP BY tr.id_trab
            ) AS fcc ON fcc.id_trab= tr.id_trab 
            LEFT JOIN 
            ( SELECT  DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato, hep.id_trab, hep.fecha
            FROM horas_extras_personal hep
            ) AS hep ON tr.id_trab =  hep.id_trab
            AND hep.fecha BETWEEN cp.desde AND cp.hasta
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
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp='".$id_pri_quin."'
                   WHERE  hep.fecha NOT BETWEEN cp.desde AND cp.hasta
                   AND  hep.id_fec_abono='".$id_pri_quin."'
              )AS hep ON tr.id_trab =  hep.id_trab
              GROUP BY tr.id_trab  
            ) AS fhe_reg ON fhe_reg.id_trab= tr.id_trab 
            LEFT JOIN 
             /*INICIO DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
            ( SELECT tr.id_trab,  
       IFNULL(he_25.cant_horas_al25,'') AS cant_horas_al25, 
       IFNULL(he_35.cant_horas_al35,'') AS cant_horas_al35,  
       IFNULL(he_nl.cant_horas_dom,'') AS cant_horas_dom,
       IFNULL(he_fe.cant_horas_fer,'') AS cant_horas_fer
FROM Trabajador tr
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al25
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='25' 
                   AND est_dia='LABORABLE'
                   GROUP BY id_trab
              )AS he_25 ON tr.id_trab =  he_25.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_al35
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                   AND hep.por_pago='35' 
                   AND est_dia='LABORABLE'
                   GROUP BY id_trab
              )AS he_35 ON tr.id_trab =  he_35.id_trab
              LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_dom
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='NO LABORABLE'
                  GROUP BY id_trab
              )AS he_nl ON tr.id_trab =  he_nl.id_trab
               LEFT JOIN ( SELECT 
                DATE_FORMAT(hep.tiempo_fin, '%H:%i') AS dato,
                hep.id_trab,
                hep.fecha,
                hep.tiempo_fin,
                hep.por_pago,
                hep.est_dia,
                IFNULL(SEC_TO_TIME(SUM(TIME_TO_SEC(hep.tiempo_fin))),'') AS cant_horas_fer
                   FROM horas_extras_personal hep
                   LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
                   WHERE  hep.fecha BETWEEN  cp.desde AND cp.hasta
                    AND hep.por_pago='100' 
                    AND est_dia='FERIADO'
               GROUP BY id_trab
              )AS he_fe ON tr.id_trab =  he_fe.id_trab
              /*FIN DE HORAS EXTRAS AL  25, 35 DOMINGOS Y FERIADOS*/
            ) AS fhe ON fhe.id_trab= tr.id_trab 
            LEFT JOIN
            (SELECT (@i := @i + 1) AS id ,
               DAY(fe_ext.fecha) AS dia,
               MONTH(fe_ext.fecha) AS mes,
               fr_ext.dia AS dia_reg,
               fr_ext.mes AS mes_reg
             FROM (SELECT @i:=0) r
               INNER JOIN fechas fe_ext
               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                          cp.id_cp= '".$id_pri_quin."'
               LEFT JOIN (
              SELECT 
                  DAY(fecha) AS dia,
                  MONTH(fecha) AS mes
              FROM horas_extras_personal hep
               LEFT JOIN  cronograma_dsctos_abonos_horasdias cp ON 
                              cp.id_cp= '".$id_pri_quin."'
              WHERE hep.fecha BETWEEN  cp.desde AND cp.hasta
              GROUP BY DAY(fecha)
               ) AS fr_ext ON  fr_ext.dia= DAY(fe_ext.fecha) AND fr_ext.mes= MONTH(fe_ext.fecha)
             WHERE fe_ext.fecha BETWEEN cp.desde AND cp.hasta
             ORDER BY MONTH(fe_ext.fecha) ASC,  DAY(fe_ext.fecha) ASC
            )  AS r_ext
            ON DAY(hep.fecha)=r_ext.dia
            WHERE tr.est_reg='1'
            GROUP BY tr.id_trab
            ) AS tr1 ON tr1.id_trab=tr.id_trab
            WHERE est_reg='1'
            GROUP BY tr.id_trab
          ) AS het   ON het.id_trab =tr.id_trab /*HORAS EXTRAS Y TARDANZAS*/
          )AS het ON  het.id_trab=tr.id_trab
        LEFT JOIN (
        SELECT  id_trab,  CASE 
          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='1' THEN  onp_apo_act
          WHEN  tr.id_reg_pen=rp.id_onp  AND tr.id_com_act='0' THEN  onp_apo_act
          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='1'  THEN  int_apo_act
          WHEN  tr.id_reg_pen=rp.id_int  AND tr.id_com_act='2'  THEN  int_apo_mix
          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='1'  THEN  pri_apo_act
          WHEN  tr.id_reg_pen=rp.id_pri  AND tr.id_com_act='2'  THEN  pri_apo_mix
          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='1' THEN  pro_apo_act
          WHEN  tr.id_reg_pen=rp.id_pro  AND tr.id_com_act='2' THEN  pro_apo_mix
          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='1'  THEN  hab_apo_act
          WHEN  tr.id_reg_pen=rp.id_hab  AND tr.id_com_act='2'  THEN  hab_apo_mix
          WHEN  tr.id_reg_pen=rp.id_sj  THEN   (sj_apo_obl* sj_com_men_rem)
          ELSE ''  END
          AS monto_reg_pen
        FROM trabajador  tr
        LEFT JOIN  regimen_pensionario rp
        ON id_cp='".$id_pri_quin."'
        ) AS rp ON rp.id_trab= tr.id_trab
        LEFT JOIN tabla_maestra_detalle   AS tpla ON tpla.cod_argumento=tr.id_tip_plan    AND tpla.cod_tabla='TPLA'
        LEFT JOIN tabla_maestra_detalle   AS tsua ON tsua.cod_argumento=tr.id_sucursal    AND tsua.cod_tabla='TSUA'
        LEFT JOIN tabla_maestra_detalle   AS tfun ON tfun.cod_argumento=tr.id_funcion     AND tfun.cod_tabla='TFUN'
        LEFT JOIN tabla_maestra_detalle   AS tare ON tare.cod_argumento=tr.id_area        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle   AS tgen ON tgen.cod_argumento=tr.id_genero      AND tgen.cod_tabla='TGEN' 
        LEFT JOIN tabla_maestra_detalle   AS tcco ON tcco.cod_argumento=tr.id_cen_cost    AND tcco.cod_tabla='TCCO' 
        LEFT JOIN tabla_maestra_detalle   AS ttmo ON ttmo.cod_argumento=tr.id_tip_man_ob  AND ttmo.cod_tabla='TTMO' 
        LEFT JOIN tabla_maestra_detalle   AS tcal ON tcal.cod_argumento=tr.id_categoria   AND tcal.cod_tabla='TCAL' 
        LEFT JOIN tabla_maestra_detalle   AS tfop ON tfop.cod_argumento=tr.id_form_pag    AND tfop.cod_tabla='TFOP' 
        LEFT JOIN tabla_maestra_detalle   AS tcon ON tcon.cod_argumento=tr.id_tip_cont    AND tcon.cod_tabla='TCON' 
        LEFT JOIN tabla_maestra_detalle   AS teci ON teci.cod_argumento=tr.id_est_civil   AND teci.cod_tabla='TECI' 
        LEFT JOIN tabla_maestra_detalle   AS trep ON trep.cod_argumento=tr.id_reg_pen     AND trep.cod_tabla='TREP' 
        LEFT JOIN tabla_maestra_detalle   AS ttca ON ttca.cod_argumento=tr.id_com_act     AND ttca.cod_tabla='TTCA' 
        LEFT JOIN tabla_maestra_detalle   AS ttre ON ttre.cod_argumento=tr.id_t_registro  AND ttre.cod_tabla='TTRE' 
        LEFT JOIN tabla_maestra_detalle   AS tmpe ON tmpe.cod_argumento=tr.id_pag_esp     AND tmpe.cod_tabla='TMPE'
        LEFT JOIN vacaciones              AS vac  ON vac.nro_doc= tr.num_doc_trab
        LEFT JOIN pago_destajeros     AS pd   ON pd.id_trab=tr.id_trab    AND pd.id_pd='".$id_pri_quin."'
        LEFT JOIN abono_regularizacion    AS ar   ON ar.id_trab=tr.id_trab    AND ar.fec_abo_reg='".$id_pri_quin."'
        LEFT JOIN descuentos_judiciales   AS dj   ON dj.id_trab=tr.id_trab    AND dj.est_des_jud='1'
        LEFT JOIN 
        ( SELECT pre.id_trab, CASE 
          WHEN  pre.fec_des1='".$id_pri_quin."' THEN mon_des1
          WHEN  pre.fec_des2='".$id_pri_quin."' THEN mon_des2
          WHEN  pre.fec_des3='".$id_pri_quin."' THEN mon_des3 
          WHEN  pre.fec_des4='".$id_pri_quin."' THEN mon_des4
          WHEN  pre.fec_des5='".$id_pri_quin."' THEN mon_des5 
          WHEN  pre.fec_des6='".$id_pri_quin."' THEN mon_des6
          WHEN  pre.fec_des7='".$id_pri_quin."' THEN mon_des7 
          WHEN  pre.fec_des8='".$id_pri_quin."' THEN mon_des8
          WHEN  pre.fec_des9='".$id_pri_quin."' THEN mon_des9 
          WHEN  pre.fec_des10='".$id_pri_quin."' THEN mon_des10
          WHEN  pre.fec_des11='".$id_pri_quin."' THEN mon_des11
          WHEN  pre.fec_des12='".$id_pri_quin."' THEN mon_des12
          WHEN  pre.fec_des13='".$id_pri_quin."' THEN mon_des13
          WHEN  pre.fec_des14='".$id_pri_quin."' THEN mon_des14
          WHEN  pre.fec_des15='".$id_pri_quin."' THEN mon_des15
          WHEN  pre.fec_des16='".$id_pri_quin."' THEN mon_des16
          WHEN  pre.fec_des17='".$id_pri_quin."' THEN mon_des17
          WHEN  pre.fec_des18='".$id_pri_quin."' THEN mon_des18
          WHEN  pre.fec_des19='".$id_pri_quin."' THEN mon_des19
          WHEN  pre.fec_des20='".$id_pri_quin."' THEN mon_des20
          WHEN  pre.fec_des21='".$id_pri_quin."' THEN mon_des21
          WHEN  pre.fec_des22='".$id_pri_quin."' THEN mon_des22 
          WHEN  pre.fec_des23='".$id_pri_quin."' THEN mon_des23
          WHEN  pre.fec_des24='".$id_pri_quin."' THEN mon_des24
          WHEN  pre.fec_des25='".$id_pri_quin."' THEN mon_des25
          WHEN  pre.fec_des26='".$id_pri_quin."' THEN mon_des26
          WHEN  pre.fec_des27='".$id_pri_quin."' THEN mon_des27
          WHEN  pre.fec_des28='".$id_pri_quin."' THEN mon_des28
          WHEN  pre.fec_des29='".$id_pri_quin."' THEN mon_des29
          WHEN  pre.fec_des30='".$id_pri_quin."' THEN mon_des30  
          ELSE '0.00'  END
          AS monto
          FROM prestamos AS pre 
        ) AS dp  ON dp.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT did.id_trab, CASE 
          WHEN  did.fec_des1='".$id_pri_quin."' THEN mon_des1
          WHEN  did.fec_des2='".$id_pri_quin."' THEN mon_des2
          WHEN  did.fec_des3='".$id_pri_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_insumos_destajeros AS did 
        ) AS did  ON did.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT dv.id_trab, CASE 
          WHEN  dv.fec_des1='".$id_pri_quin."' THEN mon_des1
          WHEN  dv.fec_des2='".$id_pri_quin."' THEN mon_des2
          WHEN  dv.fec_des3='".$id_pri_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_varios AS dv 
        ) AS dv  ON dv.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT dm.id_trab, CASE 
          WHEN  dm.fec_des1='".$id_pri_quin."' THEN mon_des1
          WHEN  dm.fec_des2='".$id_pri_quin."' THEN mon_des2
          WHEN  dm.fec_des3='".$id_pri_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM descuentos_menu AS dm 
        ) AS dm  ON dm.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT aa.id_trab, CASE 
          WHEN  aa.fec_des1='".$id_pri_quin."' THEN mon_des1
          WHEN  aa.fec_des2='".$id_pri_quin."' THEN mon_des2
          WHEN  aa.fec_des3='".$id_pri_quin."' THEN mon_des3 
          ELSE '0.00'  END
          AS monto
          FROM anticipo_adelanto AS aa 
        ) AS aa  ON aa.id_trab=tr.id_trab
        LEFT JOIN 
        (  SELECT pp.id_trab,  pp.monto_a_pagar,
                  IF( pp.id_cp='".$id_pri_quin."',  'SI', '0.00')  AS monto,
                  CASE 
                  WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(cp.hasta, '%d/%m/%Y'))     
                  ELSE ''  END
                  AS fechas,
                  CASE 
                  WHEN  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta  THEN  REPLACE(DATEDIFF(pp.fecha_procede,pp.fecha_hasta)-1      ,'-', '')
                  WHEN  pp.fecha_hasta NOT BETWEEN   cp.desde AND cp.hasta  THEN   REPLACE(DATEDIFF(pp.fecha_procede,cp.hasta)-1   ,'-', '')    
                  ELSE ''  END
                  AS dias
              FROM permiso_personal pp
              LEFT JOIN  cronograma_pagos cp ON 
              cp.id_cp='".$id_pri_quin."'
              WHERE pp.tip_permiso='VC'
              AND pp.fecha_procede BETWEEN   cp.desde AND cp.hasta 
           UNION ALL
           SELECT pp.id_trab,  pp.monto_a_pagar,  
                  IF( pp.id_cp='".$id_pri_quin."',  'SI', '0.00')  AS monto,
                  CASE 
                  WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN  CONCAT (DATE_FORMAT(cp.desde, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y'))     
                  ELSE ''  END
                  AS fechas,
                  CASE 
                  WHEN  pp.fecha_procede BETWEEN   cp.desde AND cp.hasta  THEN  REPLACE(DATEDIFF(pp.fecha_procede,pp.fecha_hasta)-1      ,'-', '')
                  WHEN  pp.fecha_procede NOT BETWEEN   cp.desde AND cp.hasta  THEN   REPLACE(DATEDIFF(cp.desde,pp.fecha_hasta)-1   ,'-', '')    
                  ELSE ''  END
                 AS dias
           FROM permiso_personal pp
           LEFT JOIN  cronograma_pagos cp ON 
           cp.id_cp='".$id_pri_quin."'
           WHERE pp.tip_permiso='VC'
           AND  pp.fecha_hasta BETWEEN   cp.desde AND cp.hasta 
        ) AS vac  ON vac.id_trab=tr.id_trab
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar,  pp.id_fecha_pago1, pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_pri_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso='DM'
        ) AS dme  ON dme.id_trab=tr.id_trab
        AND dme.id_cp='".$id_pri_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_pri_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LM','LP','FD', 'FF')
        ) AS sub  ON sub.id_trab=tr.id_trab
        AND sub.id_cp='".$id_pri_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_pri_quin."',  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LC')
        ) AS lco  ON lco.id_trab=tr.id_trab
        AND lco.id_cp='".$id_pri_quin."'
        LEFT JOIN 
        ( SELECT pp.id_trab, pp.dias, pp.monto_a_pagar, pp.tip_permiso, pp.id_fecha_pago1,  pp.id_cp,
                 CONCAT (DATE_FORMAT(pp.fecha_procede, '%d/%m/%Y'),' AL ' , DATE_FORMAT(pp.fecha_hasta, '%d/%m/%Y')) AS fechas,
          IF( pp.id_cp='".$id_pri_quin."' ,  'SI', '0.00')  AS monto
          FROM permiso_personal pp
          WHERE pp.tip_permiso IN ('LS')
        ) AS lsi  ON lsi.id_trab=tr.id_trab
        AND lsi.id_cp='".$id_pri_quin."'
        LEFT JOIN 
        (SELECT tr.id_trab, 
                DATEDIFF(cp.hasta,cp.desde)AS dias_cronograma,
                IFNULL(ss.dias_asistidos, 0),
               IF(tt.cantidad>0, 0 , IFNULL((DATEDIFF(cp.hasta,cp.desde) -  IFNULL(ss.dias_asistidos,0)) , DATEDIFF(ss.hasta,ss.desde) ))  AS dias_faltados 
         FROM trabajador tr
         LEFT JOIN
           ( SELECT  tr.id_trab,cp.desde,  cp.hasta, re.fecha,  COUNT(re.fecha) AS dias_asistidos
            FROM Trabajador tr 
            LEFT JOIN reloj AS re ON
            tr.id_trab= re.id_trab
            LEFT JOIN  cronograma_pagos AS cp ON 
              cp.id_cp='".$id_pri_quin."'
             WHERE re.fecha BETWEEN cp.desde AND cp.hasta
            GROUP BY tr.id_trab
           ) AS  ss ON ss.id_trab= tr.id_trab
        LEFT JOIN  cronograma_pagos AS cp ON 
           cp.id_cp='".$id_pri_quin."'
        LEFT JOIN
          ( SELECT tr.id_trab, COUNT(pp.dias) AS cantidad
            FROM Trabajador tr 
             LEFT JOIN permiso_personal AS pp ON
            pp.id_trab= tr.id_trab
            LEFT JOIN  cronograma_pagos AS cp ON 
              cp.id_cp='".$id_pri_quin."'
            WHERE pp.fecha_procede BETWEEN cp.desde AND cp.hasta 
          ) AS tt ON
         tt.id_trab= tr.id_trab
        ) AS difa ON difa.id_trab= tr.id_trab
      WHERE tr.est_reg='1' 
      ORDER BY tr.id_tip_plan ASC, tr.id_trab ASC
        ;
        
  ");  





    


         
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;

  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["estado_civil"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["tipo_contrato"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["comision_actual"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["genero"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["cod_centro_costos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["centro_costos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["tipo_mano_obra"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["t_registro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["tipo_planilla"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["sucursal_anexo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($res["nombres"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($res["fec_nac_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Y$fila", utf8_encode($res["fec_sal_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Z$fila", utf8_encode($res["nro_cta_sue_con"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AA$fila", utf8_encode($res["nro_cta_sue_sin"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AB$fila", utf8_encode($res["nro_cta_cts_con"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AC$fila", utf8_encode($res["nro_cta_cts_sin"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AD$fila", utf8_encode($res["forma_pago"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AE$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AF$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AG$fila", utf8_encode($res["categoria_laboral"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AH$fila", utf8_encode($res["regimen_pensionario"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AI$fila", utf8_encode($res["cusp_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AJ$fila", utf8_encode($res["sueldo_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", utf8_encode($res["asig_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", utf8_encode($res["horas_lactancia"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AM$fila", utf8_encode($res["horas_trabajadas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AN$fila", utf8_encode($res["dias_trabajados"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AO$fila", utf8_encode($res["pre_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AP$fila", utf8_encode($res["pre_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AQ$fila", utf8_encode($res["pre_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", utf8_encode($res["pre_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AS$fila", utf8_encode($res["cant_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AT$fila", utf8_encode($res["cant_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AU$fila", utf8_encode($res["cant_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AV$fila", utf8_encode($res["cant_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AW$fila", utf8_encode($res["fecha_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AX$fila", utf8_encode($res["cant_dias_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AY$fila", utf8_encode($res["fecha_descanso_medico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("AZ$fila", utf8_encode($res["cant_dias_descanso_medico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BA$fila", utf8_encode($res["fecha_subsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", utf8_encode($res["cant_dias_subsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", utf8_encode($res["fecha_lic_con_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", utf8_encode($res["cant_dias_lic_con_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BE$fila", utf8_encode($res["fecha_lic_sin_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BF$fila", utf8_encode($res["cant_dias_lic_sin_goce_haber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BG$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BH$fila", utf8_encode($res["cant_horas_faltadas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BI$fila", utf8_encode($res["cant_dias_falta"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BJ$fila", utf8_encode($res["dscto_dom_hsxdias_semanal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BK$fila", utf8_encode($res["total_dsctoxhoras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BL$fila", utf8_encode($res["total_dsctoxfaltas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BM$fila", utf8_encode($res["sueldo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BN$fila", utf8_encode($res["asig_familiar"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BO$fila", utf8_encode($res["mon_destajo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BP$fila", utf8_encode($res["mon_vacaciones"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BQ$fila", utf8_encode($res["mon_licenciaxsubsidio"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BR$fila", utf8_encode($res["mon_descansomedico"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BS$fila", utf8_encode($res["mon_licenciacongocedehaber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BT$fila", utf8_encode($res["mon_licenciasingocedehaber"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BU$fila", utf8_encode($res["monto_lactancia"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BV$fila", utf8_encode($res["mon_total_sueldo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BW$fila", utf8_encode($res["mon_hor_ext_25"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BX$fila", utf8_encode($res["mon_hor_ext_35"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BY$fila", utf8_encode($res["mon_hor_ext_dominical"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("BZ$fila", utf8_encode($res["mon_hor_ext_feriado"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CA$fila", utf8_encode($res["mon_total_horas_extras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CB$fila", utf8_encode($res["mon_total_remuneracionafecto"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CC$fila", utf8_encode($res["dscto_fondopension"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CD$fila", utf8_encode($res["dscto_rentaquinta"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CE$fila", utf8_encode($res["dscto_segurovida"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CF$fila", utf8_encode($res["dscto_basedestajo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CG$fila", utf8_encode($res["dscto_judicial"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CH$fila", utf8_encode($res["dscto_prestamo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CI$fila", utf8_encode($res["dscto_insumodestajeros"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CJ$fila", utf8_encode($res["dscto_varios"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CK$fila", utf8_encode($res["dscto_menu"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CL$fila", utf8_encode($res["dscto_anticipo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CM$fila", utf8_encode($res["total_dsctos"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CN$fila", utf8_encode($res["total_deposito_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CO$fila", utf8_encode($res["abono_regularizacion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CP$fila", utf8_encode($res["otros_exceso_dscto_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CQ$fila", utf8_encode($res["total_despositobcp_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CR$fila", utf8_encode($res["bono_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CS$fila", utf8_encode($res["bono_destajo_quincenal"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CT$fila", utf8_encode($res["vacaciones_compradas_otros"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CU$fila", utf8_encode($res["total_hextras"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CV$fila", utf8_encode($res["dscto_varios"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CW$fila", utf8_encode($res["pago_efectivo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CX$fila", utf8_encode($res[""]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CY$fila", utf8_encode($res["cant_billetes_100"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("CZ$fila", utf8_encode($res["cant_billetes_50"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DA$fila", utf8_encode($res["cant_billetes_20"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DB$fila", utf8_encode($res["cant_billetes_10"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DC$fila", utf8_encode($res["cant_monedas_5"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DD$fila", utf8_encode($res["cant_monedas_2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("DE$fila", utf8_encode($res["cant_monedas_1"]));

  
 


 
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


  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:DN$fila");
  $objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "B$fila:DN$fila");
  


 


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
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CU')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CV')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CX')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('CZ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DA')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DB')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DC')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DD')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DE')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DF')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DG')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DH')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DI')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DJ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DK')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DL')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DM')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DN')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DO')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DP')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DQ')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DR')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DS')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DT')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DU')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DV')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DW')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DX')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DY')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('DZ')->setWidth(10);


  






//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003S
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="'.$resTot["nombre"].'.xls"');
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