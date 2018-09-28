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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DPTO. RECURSOS HUMANOS/PLANILLAS');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CUADRO DE INFORMACION DE TRABAJADOR");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila"); //establecer estilo
 
$fila=3;

//titulos de columnas
$fila+=1;

 

 
 

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'GENERO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CIVIL');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'LUGAR NAC.');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'D.N.I');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'APE. PATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'APE. MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'FECHA INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'HIJ.MEN.EDAD');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'HIJ.MAY.EDAD');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'FEC.ING.ACTUAL');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", '2DA FEC.ING.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", '2DA FEC.SAL.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", '2DA DETALE SALIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", '1ERA FEC.ING.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", '1ERA FEC.SAL.ANT');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", '1ERA DETALE SALIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'INGRESO INTERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'SALIDA INTERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'DETALLE SAL.INTERNO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:X$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:X$fila")->getFont()->setBold(true); //negrita
  











//rellenar con contenido

   
  
    $sql=mysql_query("SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg, tr.fecfin_con_ant, tr.fecfin_con_act,
    tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
    tr.id_sucursal, IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
    tr.id_funcion ,  tfun.des_larga AS funcion,
    tr.id_area, tare.des_larga AS area_trab, 
    tr.id_genero, tgen.des_corta AS genero,
    tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
    tr.id_cen_cost, tcco.des_larga AS centro_costos,
                tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
    tr.id_categoria, tcal.des_larga AS categoria_laboral,
    tr.id_form_pag, tfop.des_larga AS forma_pago,
    tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
    tr.id_est_civil, teci.des_corta AS estado_civil,
    tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
    tr.id_com_act, ttca.des_larga AS comision_actual,
    tr.id_t_registro, ttre.des_larga AS t_registro,
    tr.num_doc_trab,
    tr.nacionalidad,
    tr.dir_trab,
    tr.urb_trab,
    tr.departamento,
    DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y') AS fec_nac_trab,
    tr.lug_nac_trab,
    tr.num_tlf_cel,
    tr.num_tlf_dom,
    tr.email_trab,
    tr.id_turno, ttur.des_larga AS turno,
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y') AS fec_ing_trab,
    DATE_FORMAT(tr.fec_sal_trab, '%d/%m/%Y') AS fec_sal_trab,
    DATE_FORMAT(tr.fec_ing2, '%d/%m/%Y')  AS fec_ing2,
    DATE_FORMAT(tr.fec_sal2, '%d/%m/%Y')  AS fec_sal2,
    tr.mot_sal2,
    DATE_FORMAT(tr.fec_ing1, '%d/%m/%Y')  AS fec_ing1,
    DATE_FORMAT(tr.fec_sal1, '%d/%m/%Y')  AS fec_sal1,
    tr.mot_sal1,
    DATE_FORMAT(tr.fec_ing_interno, '%d/%m/%Y')  AS fec_ing_interno,
    DATE_FORMAT(tr.fec_sal_interno, '%d/%m/%Y')  AS fec_sal_interno,
    tr.mot_sal_interno,
    tr.sueldo_trab,
    tr.bono_trab,
    tr.asig_trab,
    tr.obs_trab,
    DATE(tr.fecfin_con_act) AS fecfin_con_act,
    DATE(tr.fecfin_con_ant) AS fecfin_con_ant,
    tr.cusp_trab,
    YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
    tr.id_distrito , ubi.Distrito AS distrito,
    tf.h1,
    tf.h2,
    tf.h3,
    tf.h4,
    tf.edad_hij1,
    tf.edad_hij2,
    tf.edad_hij3,
    tf.edad_hij4,
    SUM(IF(h1=1,1,0)+ IF(h2=1,1,0) + IF(h3=1,1,0) + IF(h4=1,1,0)) AS MayoresEdad,
    SUM(IF(h1=2,1,0)+ IF(h2=2,1,0) + IF(h3=2,1,0) + IF(h4=2,1,0)) AS MenoresEdad
    FROM trabajador tr
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
                                LEFT JOIN tabla_maestra_detalle AS tgen ON
        tgen.cod_argumento= tr.id_genero
        AND tgen.cod_tabla='TGEN' 
        LEFT JOIN tabla_maestra_detalle AS tdoc ON
        tdoc.cod_argumento= tr.id_tip_doc
        AND tdoc.cod_tabla='TDOC' 
        LEFT JOIN tabla_maestra_detalle AS tcco ON
        tcco.cod_argumento= tr.id_cen_cost
        AND tcco.cod_tabla='TCCO' 
        LEFT JOIN tabla_maestra_detalle AS ttmo ON
        ttmo.cod_argumento= tr.id_tip_man_ob
        AND ttmo.cod_tabla='TTMO' 
        LEFT JOIN tabla_maestra_detalle AS tcal ON
        tcal.cod_argumento= tr.id_categoria
        AND tcal.cod_tabla='TCAL' 
              LEFT JOIN tabla_maestra_detalle AS tfop ON
        tfop.cod_argumento= tr.id_form_pag
        AND tfop.cod_tabla='TFOP' 
        LEFT JOIN tabla_maestra_detalle AS tcon ON
        tcon.cod_argumento= tr.id_tip_cont
        AND tcon.cod_tabla='TCON' 
        LEFT JOIN tabla_maestra_detalle AS teci ON
        teci.cod_argumento= tr.id_est_civil
        AND teci.cod_tabla='TECI' 
        LEFT JOIN tabla_maestra_detalle AS trep ON
        trep.cod_argumento= tr.id_reg_pen
        AND trep.cod_tabla='TREP' 
        LEFT JOIN tabla_maestra_detalle AS ttca ON
        ttca.cod_argumento= tr.id_com_act
        AND ttca.cod_tabla='TTCA' 
        LEFT JOIN tabla_maestra_detalle AS ttre ON
        ttre.cod_argumento= tr.id_t_registro
        AND ttre.cod_tabla='TTRE' 
        LEFT JOIN tabla_maestra_detalle AS ttur ON
        ttur.cod_argumento= tr.id_turno
        AND ttre.cod_tabla='TTUR'
        LEFT JOIN ubigeo AS ubi ON
        ubi.coddist= tr.id_distrito
        AND ubi.coddpto='15' 
        AND ubi.codprov='01'
        LEFT JOIN 
        (SELECT tf1.id_trab, 
        tf2.edad_hij1,
        tf2.edad_hij2,
        tf2.edad_hij3,
        tf2.edad_hij4,
          CASE WHEN tf2.edad_hij1>=18 AND tf2.edad_hij1 !='' THEN 1  
               WHEN tf2.edad_hij1<18  AND tf2.edad_hij1>=0  AND tf2.edad_hij1 !='-' THEN 2
               WHEN tf2.edad_hij1='-'  THEN '-'
               ELSE 'X' 
               END 
               AS h1,
          CASE WHEN tf2.edad_hij2>=18 AND tf2.edad_hij2 !='' THEN 1
               WHEN tf2.edad_hij2<18  AND tf2.edad_hij2>=0  AND tf2.edad_hij2 !='-' THEN 2
               WHEN tf2.edad_hij2='-'  THEN '-'
               ELSE 'X' 
               END
               AS h2,
          CASE WHEN tf2.edad_hij3>=18 AND tf2.edad_hij3 !='' THEN 1 
               WHEN tf2.edad_hij3<18  AND tf2.edad_hij3>=0  AND tf2.edad_hij3 !='-'  THEN 2
               WHEN tf2.edad_hij3='-'  THEN '-'
               ELSE 'X' 
               END AS h3,
          CASE WHEN tf2.edad_hij4>=18 AND tf2.edad_hij4 !='' THEN 1 
               WHEN tf2.edad_hij4<18  AND tf2.edad_hij4>=0  AND   tf2.edad_hij4 !='-' THEN 2
               WHEN tf2.edad_hij4='-'  THEN '-'
               ELSE 'X' 
               END AS h4
        FROM trabajador_familia tf1
        LEFT JOIN 
        (SELECT  id_trab,IF (nac_hij1='', '-' , YEAR(CURDATE())-YEAR(nac_hij1) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nac_hij1,'%m-%d'), 0 , -1 )) AS edad_hij1,
          IF (nac_hij1='', '-' , YEAR(CURDATE())-YEAR(nac_hij2) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nac_hij2,'%m-%d'), 0 , -1 )) AS edad_hij2,
          IF (nac_hij1='', '-' , YEAR(CURDATE())-YEAR(nac_hij3) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nac_hij3,'%m-%d'), 0 , -1 )) AS edad_hij3,
          IF (nac_hij1='', '-' , YEAR(CURDATE())-YEAR(nac_hij4) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(nac_hij4,'%m-%d'), 0 , -1 )) AS edad_hij4
        FROM trabajador_familia ) AS tf2 ON tf2.id_trab=tf1.id_trab
         ) AS tf ON
        tf.id_trab= tr.id_trab
        GROUP BY tr.id_trab
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;
 

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["genero"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["estado_civil"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["lug_nac_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["MenoresEdad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["MayoresEdad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["fec_ing2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["fec_sal2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["mot_sal2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["fec_ing1"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($res["fec_sal1"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($res["mot_sal1"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($res["fec_ing_interno"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($res["fec_sal_interno"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", utf8_encode($res["mot_sal_interno"]));


  //Establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:X$fila");
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(35);









//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003S
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="DATOS_TRABAJADOR.xls"');
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