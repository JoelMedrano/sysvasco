<?php
 


session_start();





//ajuntar la libreria excel
include "Classes/PHPExcel.php";


$conexion=mysql_connect("192.168.1.26","admin","vasco123");
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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DPTO. RECURSOS HUMANOS/PLANILLAS');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CUADRO DE INFORMACION DE VACACIONES");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila"); //establecer estilo
 
$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "GOZADAS");
$objPHPExcel->getActiveSheet()->mergeCells("J$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "GOZADAS");
$objPHPExcel->getActiveSheet()->mergeCells("P$fila:R$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", "FECHA DE PROGRAMACION");
$objPHPExcel->getActiveSheet()->mergeCells("T$fila:V$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("J$fila:L$fila")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->getStyle("P$fila:R$fila")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->getStyle("T$fila:V$fila")->getFont()->setBold(true); //negrita


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
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Vencidas');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Trunco');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'DEL');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'AL');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'DIAS PEND.');
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'INICIO');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'SALIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'OBSERVACIONES');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:W$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:W$fila")->getFont()->setBold(true); //negrita
  











//rellenar con contenido

   
  
    $sql=mysql_query("SELECT tr.id_trab,CONCAT_WS(' ',  tr.apepat_trab, tr.apemat_trab,  tr.nom_trab ) AS nombres, tr.apepat_trab, tr.apemat_trab,  tr.nom_trab, tr.est_reg, tr.fecfin_con_ant, tr.fecfin_con_act,
    tr.id_tip_plan, tpla.des_larga AS tipo_planilla,
    tr.id_sucursal, IFNULL(tsua.des_larga,'')  AS sucursal_anexo,
    tr.id_funcion ,  tfun.des_larga AS funcion,
    tr.id_area, tare.des_larga AS area_trab, 
    tr.id_genero, tgen.des_larga AS genero,
    tr.id_tip_doc, tdoc.des_larga AS tipo_documento,
    tr.id_cen_cost, tcco.des_larga AS centro_costos,
        tr.id_tip_man_ob, ttmo.des_larga AS tipo_mano_obra,
    tr.id_categoria, tcal.des_larga AS categoria_laboral,
    tr.id_form_pag, tfop.des_larga AS forma_pago,
    tr.id_tip_cont, tcon.des_larga AS tipo_contrato,
    tr.id_est_civil, teci.des_larga AS estado_civil,
    tr.id_reg_pen, trep.des_larga AS regimen_pensionario,
    tr.id_com_act, ttca.des_larga AS comision_actual,
    tr.id_t_registro, ttre.des_larga AS t_registro,
    tr.num_doc_trab,
    tr.nacionalidad,
    tr.dir_trab,
    tr.urb_trab,
    tr.departamento,
    DATE_FORMAT(tr.fec_nac_trab, '%d/%m/%Y')   AS fec_nac_trab,
    tr.lug_nac_trab,
    tr.num_tlf_cel,
    tr.num_tlf_dom,
    tr.email_trab,
    tr.id_turno, ttur.des_larga AS turno,
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y')   AS fec_ing_trab,
    DATE_FORMAT(tr.fec_cese_trab, '%d/%m/%Y')   AS fec_cese_trab,
    tr.sueldo_trab,
    tr.bono_trab,
    tr.asig_trab,
    tr.obs_trab,
    DATE_FORMAT(tr.fecfin_con_act, '%d/%m/%Y')   AS fecfin_con_act,
    DATE_FORMAT(tr.fecfin_con_ant, '%d/%m/%Y')   AS fecfin_con_ant,
    tr.cusp_trab,
    YEAR(CURDATE())-YEAR(tr.fec_nac_trab) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(tr.fec_nac_trab,'%m-%d'), 0 , -1 ) AS edad_trab,
    tr.id_distrito , ubi.Distrito AS distrito
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
        and ubi.coddpto='15' 
        AND ubi.codprov='01'
        WHERE tr.id_tip_plan='1'
        order by id_trab asc
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

 
  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["id_area"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["id_funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["nom_trab"]));
  

  //Establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:W$fila");
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);




//INICIO SEGUNDA HOJA
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
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'DPTO. RECURSOS HUMANOS/PLANILLAS');



$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "CUADRO DE INFORMACION DE VACACIONES");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:W$fila"); //establecer estilo
 
$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "GOZADAS");
$objPHPExcel->getActiveSheet()->mergeCells("J$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", "GOZADAS");
$objPHPExcel->getActiveSheet()->mergeCells("P$fila:R$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", "FECHA DE PROGRAMACION");
$objPHPExcel->getActiveSheet()->mergeCells("T$fila:V$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->getStyle("J$fila:L$fila")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->getStyle("P$fila:R$fila")->getFont()->setBold(true); //negrita
$objPHPExcel->getActiveSheet()->getStyle("T$fila:V$fila")->getFont()->setBold(true); //negrita


//titulos de columnas
$fila+=1;


 

    $objPHPExcel->getActiveSheet()
    ->getStyle('C3:C100')
    ->getAlignment()
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
 

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'D.N.I');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'APE.PATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'APE.MATERNO');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'NOMBRES');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'FEC.INGRESO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'AREA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'FUNCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'PERIODO/AÑO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DEL');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'AL');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'DIAS PEND.');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'OBS.DETALLE');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Vencidas');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Trunco');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'DEL');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'AL');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'DIAS PEND.');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'INICIO');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'SALIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("W$fila", 'TOTAL DIAS');
$objPHPExcel->getActiveSheet()->SetCellValue("X$fila", 'OBSERVACIONES');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:X$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:X$fila")->getFont()->setBold(true); //negrita



  
 






//rellenar con contenido

   
  
    $sql=mysql_query("SELECT tr.id_trab,
    tr.apepat_trab,
    tr.apemat_trab,  
    tr.nom_trab,
    tfun.des_larga AS funcion,
    tare.des_larga AS area_trab, 
    tr.num_doc_trab,
    DATE_FORMAT(tr.fec_ing_trab, '%d/%m/%Y')   AS fec_ing_trab,
    vac.PeridoAnual, 
    vac.fec_del,
    vac.fec_al, 
    vac.tot_dias,
    vac.pen_dias,
    vac.vencidas,
    vac.truncas,
    vac.fec_del_dec,
    vac.fec_al_dec,
    vac.tot_dias_dec,
    vac.pen_dias_dec,
    vac.inicio_prog,
    vac.salida_prog,
    vac.tot_dias_prog,
    vac.obser,
    vac.obser_detalle
        FROM trabajador tr
        LEFT JOIN tabla_maestra_detalle AS tfun ON
        tfun.cod_argumento= tr.id_funcion
        AND tfun.cod_tabla='TFUN'
        LEFT JOIN tabla_maestra_detalle AS tare ON
        tare.cod_argumento= tr.id_area
        AND tare.cod_tabla='TARE'
        LEFT JOIN (
        SELECT nro_doc, id_periodo, correlativo,TbPea.des_larga AS PeridoAnual, DATE_FORMAT(fec_del, '%d/%m/%Y') AS  fec_del, DATE_FORMAT(fec_al, '%d/%m/%Y') AS fec_al, tot_dias, pen_dias, vencidas, truncas, DATE_FORMAT(fec_del_dec, '%d/%m/%Y') AS   fec_del_dec, DATE_FORMAT(fec_al_dec, '%d/%m/%Y') AS  fec_al_dec, tot_dias_dec,
        pen_dias_dec, inicio_prog, salida_prog, tot_dias_prog, obser, obser_detalle
        FROM Vacaciones vac
        LEFT JOIN tabla_maestra_detalle  TbPea ON
        TbPea.cod_tabla='TPEA'
        AND TbPea.cod_argumento= vac.id_periodo
        ORDER BY  vac.correlativo ASC
        ) AS vac ON vac.nro_doc=tr.num_doc_trab
     WHERE tr.id_tip_plan='1'
     ORDER BY id_trab ASC
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    


  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($res["id_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["num_doc_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["apepat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["apemat_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["nom_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["fec_ing_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["area_trab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["funcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["PeridoAnual"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["fec_del"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["fec_al"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["tot_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["pen_dias"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["obser_detalle"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", utf8_encode($res["vencidas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($res["truncas"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", utf8_encode($res["fec_del_dec"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", utf8_encode($res["fec_al_dec"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", utf8_encode($res["tot_dias_dec"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", utf8_encode($res["pen_dias_dec"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", utf8_encode($res["inicio_prog"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", utf8_encode($res["salida_prog"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("W$fila", utf8_encode($res["tot_dias_prog"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("X$fila", utf8_encode($res["obser"]));
  //Establecer estilo



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:X$fila");
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(55);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(40);







//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="CONTROL VACACIONES GOZADAS.xls"');
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