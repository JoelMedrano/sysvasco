<?php
 


session_start();





//ajuntar la libreria excel
include "Classes/PHPExcel.php";


$conexion=mysql_connect("192.168.1.29","admin","vasco123");
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
      'size' => 10
    )
));


$texto = new PHPExcel_Style(); //nuevo estilo

$texto->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array( //fuente
      'bold' => false,
      'size' => 8
    )
));


$texto_negrita = new PHPExcel_Style(); //nuevo estilo

$texto_negrita->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 8
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
 
//INICIO SEGUNDA HOJA  ADMINISTRACION
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("ADMINISTRACION"); //establecer titulo de hoja
 
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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DPTO. RECURSOS HUMANOS/CORPORACIÓN VASCO S.A.C.');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "CUADRO ACTUALIZADO DE VACACIONES");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:O$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:O$fila"); //establecer estilo
 
$fila=3;

//titulos de columnas
$fila+=1;

 

 
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'D.N.I');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'APELLIDO PATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'APELLIDO MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FECHA INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'PERIODO/AÑO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DEL');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'AL');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'DIAS PEND.');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'OBSERVACIONES');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'PERIODO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:O$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:O$fila")->getFont()->setBold(true); //negrita
  


$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setWrapText(true);
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








//rellenar con contenido

   
  
    $sql=mysql_query("SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE_FORMAT(vac.fec_del, '%d/%m/%Y') AS  fec_del, DATE_FORMAT(vac.fec_al, '%d/%m/%Y') AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
         pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle,
         tr.apepat_trab, tr.apemat_trab, tr.nom_trab, DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS  fec_ing_trab,
         tare.des_larga as area_trab, tfun.des_larga AS fun_trab
        FROM Vacaciones vac
        INNER JOIN Trabajador tr ON 
        tr.num_doc_trab= vac.nro_doc
        LEFT JOIN tabla_maestra_detalle  TbPea ON
        TbPea.cod_tabla='TPEA'
        AND TbPea.cod_argumento= vac.id_periodo
        LEFT JOIN tabla_maestra_detalle AS tare ON
        tare.cod_argumento= tr.id_area
        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle AS tfun ON
        tfun.cod_argumento= tr.id_funcion
        AND tfun.cod_tabla='TFUN'
        WHERE tr.id_area  IN ('25', '22', '1', '17', '6')
        AND tr.id_funcion NOT IN ('33')
        ORDER BY  YEAR(fec_ing_trab) ASC , nro_doc ASC,  vac.correlativo ASC
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;
 
 
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["nro_doc"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["fun_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["PeridoAnual"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["fec_del"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["fec_al"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["tot_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["pen_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["obser_detalle"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["obser"]));



  //Establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:O$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "A$fila:E$fila"); //establecer estilo
  
  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "G$fila:H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "J$fila:O$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getFont()->setBold(true); //negrita

  $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getFont()->setBold(true); //negrita

  $objPHPExcel->getActiveSheet() ->getStyle("A$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("N$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("O$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  




  $objPHPExcel->getActiveSheet()
    ->getStyle('C3:C100')
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
 


 }
 


  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);




/*FIN DE HOJA ADMINISTRACION */



//INICIO 1era HOJA
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("PRODUCCION"); //establecer titulo de hoja
 
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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DPTO. RECURSOS HUMANOS/CORPORACIÓN VASCO S.A.C.');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "CUADRO ACTUALIZADO DE VACACIONES");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:O$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:O$fila"); //establecer estilo
 
$fila=3;

//titulos de columnas
$fila+=1;

 

 
 
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'D.N.I');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'APELLIDO PATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'APELLIDO MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FECHA INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'PERIODO/AÑO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DEL');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'AL');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'DIAS PEND.');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'OBSERVACIONES');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'PERIODO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:O$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:O$fila")->getFont()->setBold(true); //negrita
  


$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setWrapText(true);
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








//rellenar con contenido

   
  
    $sql=mysql_query("SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE_FORMAT(vac.fec_del, '%d/%m/%Y') AS  fec_del, DATE_FORMAT(vac.fec_al, '%d/%m/%Y') AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
         pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle,
         tr.apepat_trab, tr.apemat_trab, tr.nom_trab, DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS  fec_ing_trab,
         tare.des_larga as area_trab, tfun.des_larga AS fun_trab
        FROM Vacaciones vac
        INNER JOIN Trabajador tr ON 
        tr.num_doc_trab= vac.nro_doc
        LEFT JOIN tabla_maestra_detalle  TbPea ON
        TbPea.cod_tabla='TPEA'
        AND TbPea.cod_argumento= vac.id_periodo
        LEFT JOIN tabla_maestra_detalle AS tare ON
        tare.cod_argumento= tr.id_area
        AND tare.cod_tabla='TARE'
        LEFT JOIN tabla_maestra_detalle AS tfun ON
        tfun.cod_argumento= tr.id_funcion
        AND tfun.cod_tabla='TFUN'
        WHERE  tr.num_doc_trab NOT IN ( SELECT nro_doc
                        FROM Vacaciones vac
                        INNER JOIN Trabajador tr ON 
                        tr.num_doc_trab= vac.nro_doc
                        LEFT JOIN tabla_maestra_detalle  TbPea ON
                        TbPea.cod_tabla='TPEA'
                        AND TbPea.cod_argumento= vac.id_periodo
                        LEFT JOIN tabla_maestra_detalle AS tare ON
                        tare.cod_argumento= tr.id_area
                        AND tare.cod_tabla='TARE'
                        LEFT JOIN tabla_maestra_detalle AS tfun ON
                        tfun.cod_argumento= tr.id_funcion
                        AND tfun.cod_tabla='TFUN'
                        WHERE tr.id_area  IN ('25', '22', '1', '17', '6')
                        AND tr.id_funcion NOT IN ('33')
                        ) 
        ORDER BY  YEAR(fec_ing_trab) ASC , nro_doc ASC,  vac.correlativo ASC
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;
 
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["nro_doc"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["fun_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["PeridoAnual"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["fec_del"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["fec_al"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["tot_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["pen_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["obser_detalle"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["obser"]));


  //Establecer estilo




  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:O$fila");

  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "A$fila:E$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "G$fila:H$fila"); //establecer estilo

  $objPHPExcel->getActiveSheet()->setSharedStyle($texto, "J$fila:O$fila"); //establecer estilo


  $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getFont()->setBold(true); //negrita

  $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getFont()->setBold(true); //negrita


  $objPHPExcel->getActiveSheet() ->getStyle("A$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);   
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
  $objPHPExcel->getActiveSheet() ->getStyle("N$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("O$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  


  $objPHPExcel->getActiveSheet()
    ->getStyle('C3:C100')
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
 


 }
 




  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);


/*FIN DE HOJA PRODUCCION */




//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003S
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="VacacionesGozadas.xls"');
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